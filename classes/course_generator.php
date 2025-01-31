<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *
 *
 * @package    local_edai_course_generator_client
 * @copyright  2024 Edunao SAS (contact@edunao.com)
 * @author     Pierre FACQ <pierre.facq@edunao.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_edai_course_generator_client;

use moodle_database;
use stdClass;
use moodle_exception;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/filelib.php');
require_once($CFG->libdir . '/enrollib.php');
require_once($CFG->dirroot . '/mod/lti/lib.php');
require_once($CFG->dirroot . '/mod/lti/locallib.php');

/**
 * Class course_generator
 *
 * Handles the generation of courses using AI.
 */
class course_generator {
    /** @var string The external platform url. */
    private string $platformurl;

    /** @var string The course description. */
    private string $description;

    /** @var array|null Uploaded files associated with the course. */
    private ?array $files;

    /** @var string API token for authentication. */
    private string $token;

    /** @var int LTI type ID. */
    private int $ltitypeid;

    /** @var \curl cURL instance for making HTTP requests. */
    private \curl $curl;

    /** @var string Name of the category where the course will be created. */
    private string $categoryname;

    /** @var moodle_database Moodle database instance. */
    private moodle_database $db;

    /** @var stdClass User object. */
    private stdClass $user;

    /** @var stdClass Configuration object. */
    private stdClass $cfg;

    /**
     * CourseGenerator constructor.
     *
     * @param moodle_database $db Moodle database instance.
     * @param stdClass $user User object.
     * @param stdClass $cfg Configuration object.
     * @param string $description Course description.
     * @param array|null $files Uploaded files.
     * @throws \dml_exception
     */
    public function __construct(
        moodle_database $db,
        stdClass $user,
        stdClass $cfg,
        string $description,
        ?array $files = null
    ) {
        $this->db = $db;
        $this->user = $user;
        $this->cfg = $cfg;
        $this->description = $description;
        $this->files = $files;

        // Retrieve configuration settings.
        $this->token = get_config('local_edai_course_generator_client', 'apikey');
        $this->categoryname = get_config('local_edai_course_generator_client', 'categoryname');

        // Get platform url from settings (add https if neither http nor https are found).
        $this->platformurl = get_config('local_edai_course_generator_client', 'platformurl');
        if (!preg_match('#^https?://#', $this->platformurl)) {
            $this->platformurl = 'https://' . $this->platformurl;
        }

        // Get LTI type ID.
        $sql = <<<SQL
        SELECT id
        FROM {lti_types} tp
        WHERE baseurl = '{$this->platformurl}/enrol/lti/launch.php'
        SQL;
        $this->ltitypeid = $db->get_field_sql($sql, null, MUST_EXIST);

        // Initialize cURL.
        $this->curl = new \curl();
    }

    /**
     * Generates a course based on the description and files provided.
     *
     * @return int The ID of the created course.
     * @throws moodle_exception
     * @throws \dml_exception
     */
    public function generate_course(): int {
        // Prepare parameters.
        $params = [
            'platformurl' => $this->cfg->wwwroot,
            'user[id]' => $this->user->id,
            'user[email]' => $this->user->email,
            'user[firstname]' => $this->user->firstname,
            'user[lastname]' => $this->user->lastname,
            'description' => $this->description,
        ];

        // Upload files if any.
        if (!empty($this->files)) {
            $itemids = $this->upload_files();
            foreach ($itemids as $key => $itemid) {
                $params["files[$key]"] = $itemid;
            }
        }

        // Call external web service.
        $response = $this->call_external_service($params);
        $responsedata = json_decode($response, true);

        if (isset($responsedata['error'])) {
            throw new moodle_exception($responsedata['error']);
        }

        // Create course.
        $course = $this->create_course($responsedata);

        // Enrol user to newly created course.
        $this->enrol_user($course->id, $this->user->id);

        // Setup LTI module.
        $this->setup_lti_module($course, $responsedata);

        // Return course ID.
        return $course->id;
    }

    /**
     * Uploads files to the server.
     *
     * @return array List of item IDs for the uploaded files.
     * @throws moodle_exception
     */
    private function upload_files(): array {
        $itemids = [];
        $filecount = count($this->files['name']);

        for ($i = 0; $i < $filecount; $i++) {
            $uploadurl = "{$this->platformurl}/webservice/upload.php?token={$this->token}";
            $filedata = [
                'file_1' => new \CURLFile(
                    $this->files['tmp_name'][$i],
                    $this->files['type'][$i],
                    $this->files['name'][$i]
                ),
            ];

            $response = $this->curl->post($uploadurl, $filedata);
            if (!$response) {
                throw new moodle_exception("Error during upload of file: {$this->files['name'][$i]}");
            }

            $responsedata = json_decode($response, true);
            if (isset($responsedata['error'])) {
                throw new moodle_exception('Error during file upload: ' . $responsedata['error']);
            }

            $itemids[] = (int)$responsedata[0]['itemid'];
        }

        return $itemids;
    }

    /**
     * Calls the external service to generate course data.
     *
     * @param array $params Parameters to send to the external service.
     * @return string The response from the external service.
     * @throws moodle_exception
     */
    private function call_external_service(array $params): string {
        $serviceurl = "{$this->platformurl}/webservice/rest/server.php"
            . "?wstoken={$this->token}"
            . "&wsfunction=local_edai_course_generator"
            . "&moodlewsrestformat=json";

        $response = $this->curl->post($serviceurl, $params);
        if (!$response) {
            throw new moodle_exception('Error during course generation on Edunao 123');
        }

        return $response;
    }

    /**
     * Creates a Moodle course based on the data from the external service.
     *
     * @param array $responsedata Data received from the external service.
     * @return stdClass The created course object.
     * @throws \dml_exception
     * @throws moodle_exception
     */
    private function create_course(array $responsedata): stdClass {
        $shortname = $responsedata['courseshortname'];
        $fullname = $responsedata['coursefullname'];
        $summary = $responsedata['coursesummary'];

        $categoryid = $this->db->get_field('course_categories', 'id', ['name' => $this->categoryname]);
        if ($categoryid === false) {
            $category = \core_course_category::create([
                'name' => $this->categoryname,
                'parent' => 0,
                'description' => '',
                'descriptionformat' => FORMAT_HTML,
            ]);
            $categoryid = $category->id;
        }

        $courseconfig = (object)[
            'fullname' => $fullname,
            'shortname' => $shortname,
            'summary' => $summary,
            'summaryformat' => FORMAT_HTML,
            'category' => $categoryid,
            'format' => 'singleactivity',
            'visible' => 1,
            'activitytype' => 'lti',
        ];

        $course = create_course($courseconfig);

        // Force course format option in case it was not set to lti due to permission issue.
        if ($course->activitytype !== 'lti') {
            $courseformatoption = $this->db->get_record('course_format_options', [
                'courseid' => $course->id,
                'name' => 'activitytype',
            ]);
            $courseformatoption->value = 'lti';
            $this->db->update_record('course_format_options', $courseformatoption);
        }

        return $course;
    }

    private function enrol_user(int $courseid, int $userid): void {
        // Enroll the current user in the newly created course.
        $enrol = enrol_get_plugin('manual');
        if (!$enrol) {
            throw new \Exception("No manual enrolment plugin found.");
        }
        $enrolinstances = enrol_get_instances($courseid, false);
        foreach ($enrolinstances as $instance) {
            if ($instance->enrol !== 'manual') {
                continue;
            }

            $enrol->enrol_user($instance, $userid, $this->cfg->creatornewroleid);
        }
    }

    /**
     * Sets up the LTI module within the course.
     *
     * @param stdClass $course The course object.
     * @param array $responsedata Data received from the external service.
     * @throws \dml_exception
     */
    private function setup_lti_module(stdClass $course, array $responsedata): void {
        $ltiparams = $responsedata['ltiparameters'];
        $moduleid = $this->db->get_field('modules', 'id', ['name' => 'lti'], MUST_EXIST);

        $ltimodule = (object)[
            'course' => $course->id,
            'name' => $responsedata['coursefullname'],
            'intro' => $responsedata['coursesummary'],
            'introformat' => FORMAT_HTML,
            'typeid' => $this->ltitypeid,
            'toolurl' => "{$this->platformurl}/enrol/lti/launch.php",
            'instructorcustomparameters' => $ltiparams,
            'grade' => 100,
            'launchcontainer' => LTI_LAUNCH_CONTAINER_WINDOW,
            'instructorchoicesendname' => 1,
            'instructorchoicesendemailaddr' => 1,
            'debuglaunch' => 0,
            'showtitlelaunch' => 1,
            'showdescriptionlaunch' => 1,
            'instructorchoiceacceptgrades' => 1,
        ];

        $instanceid = lti_add_instance($ltimodule, null);

        $cm = (object)[
            'course' => $course->id,
            'module' => $moduleid,
            'instance' => $instanceid,
            'section' => 0,
            'visible' => 1,
            'visibleoncoursepage' => 1,
        ];
        $cmid = add_course_module($cm);

        // Add the module to the specified course section.
        course_add_cm_to_section($course->id, $cmid, 0);

        rebuild_course_cache($course->id, true);
    }
}

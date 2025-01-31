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

use local_edai_course_generator_client\webservice;

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/lti/locallib.php');

global $DB;

require_login();
require_capability('moodle/course:create', context_system::instance());

$clientid = optional_param('clientid', null, PARAM_TEXT);
$tooldomain = optional_param('tooldomain', null, PARAM_URL);

// Activate the tool on the client side
if ($clientid && $tooldomain) {
    $domain = lti_get_domain_from_url(new moodle_url($tooldomain));
    $conditions = [
        'state' => LTI_TOOL_STATE_PENDING,
        'clientid' => $clientid,
        'tooldomain' => $domain,
    ];
    if ($ltitype = $DB->get_record('lti_types', $conditions)) {
        $ltitype->state = LTI_TOOL_STATE_CONFIGURED;
        $DB->update_record('lti_types', $ltitype);
    }
}

// Check enrol LTI is enabled.
if (! enrol_is_enabled('lti')) {
    throw new moodle_exception(get_string('error_lti_disabled', 'local_edai_course_generator_client'));
}

// Check apikey available.
$apikey = get_config('local_edai_course_generator_client', 'apikey');
if ($apikey === '') {
    throw new moodle_exception(get_string('apikey_desc', 'local_edai_course_generator_client'));
}

// Check if platformurl is available.
$platformurl = get_config('local_edai_course_generator_client', 'platformurl');
if ($platformurl === '') {
    throw new moodle_exception(get_string('platformurl_desc', 'local_edai_course_generator_client'));
}

$PAGE->set_url(new moodle_url('/local/edai_course_generator_client/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('pluginname', 'local_edai_course_generator_client'));
$PAGE->set_heading(get_string('pluginname', 'local_edai_course_generator_client'));

// Register plafform if not already registered
if (!webservice::call('check', $platformurl, $apikey)) {
    webservice::call('registration', $platformurl, $apikey);
}

echo $OUTPUT->header();

echo $OUTPUT->render_from_template('local_edai_course_generator_client/course_generator_form', []);
$PAGE->requires->js_call_amd('local_edai_course_generator_client/form', 'init');

echo $OUTPUT->footer();

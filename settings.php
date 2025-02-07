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

defined('MOODLE_INTERNAL') || die();

$settings = new admin_externalpage(
    'local_edai_course_generator_client',
    get_string('pluginname', 'local_edai_course_generator_client'),
    new moodle_url('/local/edai_course_generator_client/index.php'),
    'moodle/course:create'
);
$ADMIN->add('courses', $settings);

// Finalize registration of client platform
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


if ($hassiteconfig) {
    $settings = new admin_settingpage(
        'local_edai_course_generator_client_settings',
        get_string('settings', 'local_edai_course_generator_client')
    );
    $ADMIN->add('courses', $settings);

    // Check if the platform is already registered
    $apikey = get_config('local_edai_course_generator_client', 'apikey');
    $platformurl = get_config('local_edai_course_generator_client', 'platformurl');

    // Create a fake button for disabled registration.
    $registerbutton = \html_writer::tag(
        'button',
        new \lang_string('register', 'local_edai_course_generator_client'),
        array('class' => 'btn btn-secondary disabled', 'onclick' => 'return false;', 'style' => 'cursor: default;')
    );

    // Register plafform if not already registered
    if (!empty($apikey) && !empty($platformurl)) {
        if (!webservice::call('check', $platformurl, $apikey)) {
            // Check if the user wants to register the platform
            $register = optional_param('register', false, PARAM_BOOL);

            if ($register) {
                if (!webservice::call('registration', $platformurl, $apikey)) {
                    $instructions = 'error_invalidurlandkey';
                }
            } else {
                // Create a button to trigger registration
                $url = new \moodle_url(
                    '\admin\settings.php',
                    array(
                        'section' => 'local_edai_course_generator_client_settings',
                        'register' => true
                    )
                );

                // Create a button to trigger registration
                $registerbutton = \html_writer::link(
                    $url,
                    new \lang_string('register', 'local_edai_course_generator_client'),
                    array('class' => 'btn btn-primary mb-3')
                );

                $instructions = 'needsregistration';
            }
        } else {
            $instructions = 'alreadyregistered';
        }
    } else {
        $instructions = 'enterurlandkey';
    }

    $registrationlink = \html_writer::tag(
        'p',
        new \lang_string($instructions, 'local_edai_course_generator_client'),
        array('class' => 'bold')
    ) . $registerbutton;

    // Add platform URL setting.
    $settings->add(new admin_setting_configtext(
        'local_edai_course_generator_client/platformurl',
        get_string('platformurl', 'local_edai_course_generator_client'),
        get_string('platformurl_desc', 'local_edai_course_generator_client'),
        get_string('default_platformurl', 'local_edai_course_generator_client'),
        PARAM_URL
    ));

    // Add api key setting.
    $settings->add(new admin_setting_configtext(
        'local_edai_course_generator_client/apikey',
        get_string('apikey', 'local_edai_course_generator_client'),
        get_string('apikey_desc', 'local_edai_course_generator_client'),
        get_string('default_apikey', 'local_edai_course_generator_client'),
        PARAM_TEXT
    ));

    // Add course generation category name setting.
    $settings->add(new admin_setting_configtext(
        'local_edai_course_generator_client/categoryname',
        get_string('categoryname', 'local_edai_course_generator_client'),
        get_string('categoryname_desc', 'local_edai_course_generator_client') . $registrationlink,
        '123-generated courses',
        PARAM_TEXT
    ));
}

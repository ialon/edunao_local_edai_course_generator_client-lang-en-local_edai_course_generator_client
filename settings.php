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

defined('MOODLE_INTERNAL') || die();

$settings = new admin_externalpage(
    'local_edai_course_generator_client',
    get_string('pluginname', 'local_edai_course_generator_client'),
    new moodle_url('/local/edai_course_generator_client/index.php'),
    'moodle/course:create'
);
$ADMIN->add('courses', $settings);

if ($hassiteconfig) {
    $settings = new admin_settingpage(
        'local_edai_course_generator_client_settings',
        get_string('settings', 'local_edai_course_generator_client')
    );
    $ADMIN->add('courses', $settings);

    // Add api key setting.
    $settings->add(new admin_setting_configtext(
        'local_edai_course_generator_client/apikey',
        get_string('apikey', 'local_edai_course_generator_client'),
        get_string('apikey_desc', 'local_edai_course_generator_client'),
        '',
        PARAM_TEXT
    ));

    // Add course generation category name setting.
    $settings->add(new admin_setting_configtext(
        'local_edai_course_generator_client/categoryname',
        get_string('categoryname', 'local_edai_course_generator_client'),
        get_string('categoryname_desc', 'local_edai_course_generator_client'),
        '123-generated courses',
        PARAM_TEXT
    ));

    $settings->add(new admin_setting_configtext(
        'local_edai_course_generator_client/platformurl',
        get_string('platformurl', 'local_edai_course_generator_client'),
        get_string('platformurl_desc', 'local_edai_course_generator_client'),
        'https://123.edunao.com',
        PARAM_URL
    ));
}

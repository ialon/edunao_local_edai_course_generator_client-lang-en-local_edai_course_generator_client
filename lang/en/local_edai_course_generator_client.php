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
 * @package    local_ai_course_generator
 * @copyright  2024 Edunao SAS (contact@edunao.com)
 * @author     Pierre FACQ <pierre.facq@edunao.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = '123 Course Generator';
$string['settings'] = '123 Course Generator settings';
$string['form_header'] = 'Generate a course using AI !';
$string['course_description_label'] = 'Course description';
$string['course_description_placeholder'] = <<<TEXT
Enter the course you want to generate: topic, number of sections, and quizz if needed.
TEXT;
$string['course_files_upload'] = 'Upload files';
$string['course_use_context'] = 'Use ONLY uploaded file(s) as source to generate the course';
$string['generate'] = 'Generate';
$string['loading'] = 'Generating your course, please wait... (~1 minute)';
$string['course_creation_success'] = 'Course generated successfully!';
$string['course_creation_redirection'] = 'Click here to view the course';
$string['error_lti_disabled'] = "123 course generation requires to enable LTI enrolment on your platform";
$string['error_platform_not_registered'] = "Your platform is not registered on the 123 platform. Please contact your administrator.";

// Settings.
$string['apikey'] = '123 API key';
$string['apikey_desc'] = "Enter the API key given by Edunao to activate the course generation.";
$string['categoryname'] = 'Category for created courses';
$string['categoryname_desc'] = 'Enter the name of the local category where courses will be created.';
$string['platformurl'] = '123 platform URL';
$string['platformurl_desc'] = 'Enter the base URL of the Edunao 123 platform. The plugin will prepend https:// automatically.';
$string['register'] = 'Register';
$string['needsregistration'] = '<p><b>You need to register your platform to use the course generator.</b></p>';

// Defaults
$string['default_apikey'] = 'fa2e6c8adab11e9dcdb171681f11fdc1';
$string['default_platformurl'] = 'https://123.edunao.com';

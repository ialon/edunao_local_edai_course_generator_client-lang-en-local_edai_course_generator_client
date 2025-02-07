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
 * @package    local_edai_course_generator
 * @copyright  2024 Edunao SAS (contact@edunao.com)
 * @author     Pierre FACQ <pierre.facq@edunao.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Generador de Cursos 123';
$string['settings'] = 'Configuración del Generador de Cursos 123';
$string['form_header'] = '¡Genera un curso utilizando IA!';
$string['course_description_label'] = 'Descripción del curso';
$string['course_description_placeholder'] = <<<TEXT
Introduce el curso que deseas generar: tema, número de secciones y quiz si es necesario.
TEXT;
$string['course_files_upload'] = 'Subir archivos';
$string['course_use_context'] = 'Usar SOLO el(los) archivo(s) subido(s) como fuente para generar el curso';
$string['generate'] = 'Generar';
$string['loading'] = 'Generando tu curso, por favor espera... (~1 minuto)';
$string['course_creation_success'] = '¡Curso generado con éxito!';
$string['course_creation_redirection'] = 'Haz clic aquí para ver el curso';
$string['error_lti_disabled'] = "La generación de cursos 123 requiere habilitar la inscripción LTI en su plataforma";
$string['error_platform_not_registered'] = "Su plataforma no está registrada en la plataforma 123. Por favor, contacte a su administrador.";

// Settings.
$string['apikey'] = 'Clave API 123';
$string['apikey_desc'] = "Ingrese la clave API proporcionada por Edunao para activar la generación de cursos.";
$string['categoryname'] = 'Categoría para cursos creados';
$string['categoryname_desc'] = 'Ingrese el nombre de la categoría local donde se crearán los cursos.';
$string['platformurl'] = 'URL de la plataforma 123';
$string['platformurl_desc'] = 'Ingrese la URL base de la plataforma Edunao 123. El plugin agregará https:// automáticamente.';
$string['register'] = 'Registrar';
$string['enterurlandkey'] = '<i class="icon fa fa-exclamation-triangle text-warning fa-fw" aria-hidden="true"></i>Ingrese la URL y la clave API de la plataforma 123 para registrar su sitio.';
$string['error_invalidurlandkey'] = '<i class="icon fa fa-exclamation-triangle text-danger fa-fw" aria-hidden="true"></i>No pudimos registrar su plataforma. Por favor, verifique la URL y la clave API.';
$string['needsregistration'] = '<i class="icon fa fa-exclamation-triangle text-warning fa-fw" aria-hidden="true"></i>Necesita registrar su plataforma para usar el generador de cursos.';
$string['alreadyregistered'] = '<i class="icon fa fa-check text-success fa-fw" aria-hidden="true"></i>Su plataforma ya está registrada.';

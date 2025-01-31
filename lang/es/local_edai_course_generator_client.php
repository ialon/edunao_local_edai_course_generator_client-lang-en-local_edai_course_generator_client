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

$string['pluginname'] = 'Generador de Cursos IA';
$string['settings'] = 'Configuración del Generador de Cursos IA';
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

// Capability strings for the edai_course_generator block.
$string['edai_course_generator:addinstance'] = 'Permite a un usuario agregar un nuevo bloque Generador de Cursos IA a un curso';
$string['edai_course_generator:myaddinstance'] = 'Permite a un usuario agregar un nuevo bloque Generador de Cursos IA a su panel de Moodle';

// Settings.
$string['apikey'] = 'Clave API';
$string['apikey_desc'] = 'Introduce la clave API proporcionada por Edunao para activar la generación de cursos.';
$string['categoryname'] = 'Categoría de cursos generados';
$string['categoryname_desc'] = 'Introduce el nombre de la categoría donde se crearán los cursos generados.';
$string['platformurl'] = 'URL de la plataforma';
$string['platformurl_desc'] = 'Introduce la URL base de la plataforma externa (por ejemplo, 123-mysite.edunao.com). El plugin añadirá automáticamente https://.';


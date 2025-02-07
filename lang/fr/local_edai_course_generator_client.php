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

$string['pluginname'] = 'Générateur de cours 123';
$string['settings'] = 'Paramètres du Générateur de Cours 123';
$string['form_header'] = "Générer un cours avec l'IA !";
$string['course_description_label'] = 'Description du cours';
$string['course_description_placeholder'] = <<<TEXT
Saisissez le cours que vous souhaitez générer : sujet, nombre de sections, et quizz si nécessaire.
TEXT;
$string['course_files_upload'] = 'Téléverser des fichiers source';
$string['course_use_context'] = 'Utilisez UNIQUEMENT les fichiers téléversés comme source de génération.';
$string['generate'] = 'Générer';
$string['loading'] = 'Génération en cours, veuillez patienter... (~1 minute)';
$string['course_creation_success'] = 'Génération de cours réussie!';
$string['course_creation_redirection'] = 'Cliquer ici pour afficher le cours';
$string['error_lti_disabled'] = "La génération de cours 123 nécessite l'activation de l'inscription via LTI sur votre plateforme";
$string['error_platform_not_registered'] = "Votre plateforme n'est pas enregistrée sur la plateforme 123. Veuillez contacter votre administrateur.";

// Settings.
$string['apikey'] = 'Clé API 123';
$string['apikey_desc'] = "Entrez la clé API fournie par Edunao pour activer la génération de cours.";
$string['categoryname'] = 'Catégorie pour les cours créés';
$string['categoryname_desc'] = 'Entrez le nom de la catégorie locale où les cours seront créés.';
$string['platformurl'] = 'URL de la plateforme 123';
$string['platformurl_desc'] = 'Entrez l\'URL de base de la plateforme Edunao 123. Le plugin ajoutera automatiquement https://.';
$string['register'] = 'Enregistrer';
$string['enterurlandkey'] = '<i class="icon fa fa-exclamation-triangle text-warning fa-fw" aria-hidden="true"></i>Entrez l\'URL et la clé API de la plateforme 123 pour enregistrer votre site.';
$string['error_invalidurlandkey'] = '<i class="icon fa fa-exclamation-triangle text-danger fa-fw" aria-hidden="true"></i>Nous n\'avons pas pu enregistrer votre plateforme. Veuillez vérifier l\'URL et la clé API.';
$string['needsregistration'] = '<i class="icon fa fa-exclamation-triangle text-warning fa-fw" aria-hidden="true"></i>Vous devez enregistrer votre plateforme pour utiliser le générateur de cours.';
$string['alreadyregistered'] = '<i class="icon fa fa-check text-success fa-fw" aria-hidden="true"></i>Votre plateforme est déjà enregistrée.';
 
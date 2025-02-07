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

$string['pluginname'] = 'Generatore di corsi 123';
$string['settings'] = 'Impostazioni del Generatore di Corsi 123';
$string['form_header'] = "Genera un corso utilizzando l'IA!";
$string['course_description_label'] = 'Descrizione del corso';
$string['course_description_placeholder'] = <<<TEXT
Inserisci il corso che vuoi generare: argomento, numero di sezioni, e quiz se necessario.
TEXT;
$string['course_files_upload'] = 'Carica file';
$string['course_use_context'] = 'Usa SOLO i file caricati come fonte per generare il corso';
$string['generate'] = 'Genera';
$string['loading'] = 'Generazione del corso in corso, attendere prego... (~1 minuto)';
$string['course_creation_success'] = 'Corso generato con successo!';
$string['course_creation_redirection'] = 'Clicca qui per visualizzare il corso';
$string['error_lti_disabled'] = "La generazione del corso 123 richiede l'attivazione dell'iscrizione tramite LTI sulla tua piattaforma";
$string['error_platform_not_registered'] = "La tua piattaforma non è registrata sulla piattaforma 123. Si prega di contattare l'amministratore.";

// Settings.
$string['apikey'] = 'Chiave API 123';
$string['apikey_desc'] = "Inserisci la chiave API fornita da Edunao per attivare la generazione del corso.";
$string['categoryname'] = 'Categoria per i corsi creati';
$string['categoryname_desc'] = 'Inserisci il nome della categoria locale in cui verranno creati i corsi.';
$string['platformurl'] = 'URL della piattaforma 123';
$string['platformurl_desc'] = 'Inserisci l\'URL di base della piattaforma Edunao 123. Il plugin aggiungerà automaticamente https://.';
$string['register'] = 'Registra';
$string['enterurlandkey'] = '<i class="icon fa fa-exclamation-triangle text-warning fa-fw" aria-hidden="true"></i>Inserisci l\'URL e la chiave API della piattaforma 123 per registrare il tuo sito.';
$string['error_invalidurlandkey'] = '<i class="icon fa fa-exclamation-triangle text-danger fa-fw" aria-hidden="true"></i>Non siamo riusciti a registrare la tua piattaforma. Si prega di verificare l\'URL e la chiave API.';
$string['needsregistration'] = '<i class="icon fa fa-exclamation-triangle text-warning fa-fw" aria-hidden="true"></i>Devi registrare la tua piattaforma per utilizzare il generatore di corsi.';
$string['alreadyregistered'] = '<i class="icon fa fa-check text-success fa-fw" aria-hidden="true"></i>La tua piattaforma è già registrata.';

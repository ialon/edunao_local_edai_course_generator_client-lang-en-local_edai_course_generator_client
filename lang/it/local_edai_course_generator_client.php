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

$string['pluginname'] = 'Generatore di Corsi IA';
$string['settings'] = 'Impostazioni Generatore di Corsi IA';
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

// Capability strings for the edai_course_generator block.
$string['edai_course_generator:addinstance'] = 'Consente a un utente di aggiungere un nuovo blocco Generatore di Corsi IA a un corso';
$string['edai_course_generator:myaddinstance'] = 'Consente a un utente di aggiungere un nuovo blocco Generatore di Corsi IA al proprio dashboard di Moodle';

// Settings.
$string['apikey'] = 'Chiave API';
$string['apikey_desc'] = 'Inserisci la chiave API fornita da Edunao per attivare la generazione dei corsi.';
$string['categoryname'] = 'Categoria di corsi generati';
$string['categoryname_desc'] = 'Inserisci il nome della categoria in cui verranno creati i corsi generati.';
$string['platformurl'] = 'URL della piattaforma';
$string['platformurl_desc'] = "Inserisci l'URL di base della piattaforma esterna (ad esempio, 123-mysite.edunao.com). Il plugin aggiungerà automaticamente https://.";


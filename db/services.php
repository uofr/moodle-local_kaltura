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
 * External functions/services description.
 *
 * @package    local_mymedia
 */

defined('MOODLE_INTERNAL') || die();

$functions = [
    'local_kaltura_get_video_picker_data' => [
        'classname'     => 'local_kaltura_external',
        'methodname'    => 'get_video_picker_data',
        'classpath'     => 'local/kaltura/classes/external.php',
        'description'   => 'Gets kaltura entries for the current user.',
        'type'          => 'read',
        'ajax'          => true
    ],
    'local_kaltura_get_upload_modal_data' => [
        'classname'     => 'local_kaltura_external',
        'methodname'    => 'get_upload_modal_data',
        'classpath'     => 'local/kaltura/classes/external.php',
        'description'   => 'Gets data needed to render modal_kaltura_upload',
        'type'          => 'read',
        'ajax'          => true
    ],
    'local_kaltura_get_upload_credentials' => [
        'classname'     => 'local_kaltura_external',
        'methodname'    => 'get_upload_credentials',
        'classpath'     => 'local/kaltura/classes/external.php',
        'description'   => 'Gets data needed to upload video.',
        'type'          => 'read',
        'ajax'          => true
    ],
    'local_kaltura_get_entry' => [
        'classname'     => 'local_kaltura_external',
        'methodname'    => 'get_entry',
        'classpath'     => 'local/kaltura/classes/external.php',
        'description'   => 'Gets entry specified by entryid',
        'type'          => 'read',
        'ajax'          => true
    ],
];

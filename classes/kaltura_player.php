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
 * kaltura_player class file.
 * 
 * @package local_kaltura
 */

namespace local_kaltura;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../API/KalturaClient.php');

/**
 * Static functions related to the Kaltura player.
 */
class kaltura_player {

    public static function get_js_url() {
        $host = get_config('local_kaltura', 'uri');
        $partner_id = get_config('local_kaltura', 'partner_id');
        $uiconf_id = get_config('local_kaltura', 'player_resource');
        if (!$uiconf_id) {
            $uiconf_id = get_config('local_kaltura', 'player_resource_custom');
        }

        return new \moodle_url("{$host}/p/{$partner_id}/sp/{$partner_id}00/embedIframeJs/uiconf_id/{$uiconf_id}/partner_id/{$partner_id}");
    }
}
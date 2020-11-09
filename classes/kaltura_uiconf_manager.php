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
 * kaltura_uiconf_manager class file.
 *
 * @package    local_mymedia
 */

namespace local_kaltura;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../API/KalturaClient.php');

/**
 * Kaltura uiconf functions.
 */
class kaltura_uiconf_manager {

    public static function get_kaltura_capture_conf(\KalturaClient $client) {
        $uiconf_filter = new \KalturaUiConfFilter();
        $uiconf_filter->nameLike = "KalturaCaptureVersioning";

        return $client->uiConf->listTemplates($uiconf_filter);
    }

    public static function get_kaltura_capture_download_urls($json_config) {
        $config = json_decode($json_config);
        return array($config->win_downloadUrl, $config->osx_downloadUrl);
    }

}
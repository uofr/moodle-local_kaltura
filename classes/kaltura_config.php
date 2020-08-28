<?php

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
 * kaltura_config class file.
 * 
 * @package local_kaltura
 */

namespace local_kaltura;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../API/KalturaClient.php');

/**
 * Kaltura config static class.
 */
class kaltura_config {

    public static function get_kaltura_url() {
        return 'https://kaltura.com';
    }

    public static function get_host() {
        return get_config('local_kaltura', 'uri');
    }


    public static function get_partner_id() {
        return get_config('local_kaltura', 'partner_id');
    }

    public static function get_uiconf_id() {
        $uiconf_id = get_config('local_kaltura', 'player_resource');
        if (empty($uiconf_id)) {
            $uiconf_id = get_config('local_kaltura', 'player_resource_custom');
        }
        return $uiconf_id;
    }

    public static function entries_per_page() {
        return get_config('local_kaltura', 'mymedia_items_per_page');
    }

    public static function get_root_category_id() {
        return get_config('local_kaltura', 'rootcategory_id');
    }

    public static function get_version() {
        return get_config('local_kaltura', 'version');
    }

    public static function get_admin_secret() {
        return get_config('local_kaltura', 'adminsecret');
    }

    public static function get_legacy_host() {
        return 'https://urcourses-video.uregina.ca';
    }

    public static function get_legacy_partnerid() {
        return 104;
    }

    public static function get_legacy_secret() {
        return '5797ccb7ce30a75213d7e049419663f5';
    }

}
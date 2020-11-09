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
 * kaltura_app_token_manager class file.
 *
 * @package    local_mymedia
 */

namespace local_kaltura;

use KalturaSessionType;
use moodle_url;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../API/KalturaClient.php');

/**
 * Kaltura app token functions.
 */
class kaltura_app_token_manager {

    public static function get_app_tokens(\KalturaClient $client) {
        global $USER;

        $app_token_filter = new \KalturaAppTokenFilter();
        $app_token_filter->sessionUserIdEqual = $USER->username;

        return $client->appToken->listAction($app_token_filter);
    }

    public static function find_kaltura_capture_app_token($app_tokens) {
        $k_capture_version = \local_kaltura\kaltura_config::get_kaltura_capture_version();
        foreach ($app_tokens->objects as $app_token) {
            $data = json_decode($app_token->description);
            if ($data->type === 'kalturaCaptureAppToken' && $data->version === $k_capture_version) return $app_token;
        }
        return null;
    }

    public static function add_kaltura_capture_app_token($client) {
        global $USER;

        $role_id = \local_kaltura\kaltura_role_manager::get_kaltura_capture_role($client);
        $k_capture_version = \local_kaltura\kaltura_config::get_kaltura_capture_version();
        
        $app_token = new \KalturaAppToken();
        $app_token->sessionType = KalturaSessionType::ADMIN;
        $app_token->sessionUserId = $USER->username;
        $app_token->sessionPrivileges = 'setrole:' . $role_id . ',editadmintags:*';
        $app_token->hashType = \KalturaAppTokenHashType::SHA256;
        $app_token->description = '{"type": "kalturaCaptureAppToken", "version":'.$k_capture_version.'}';

        return $client->appToken->add($app_token);
    }

    public static function get_kaltura_capture_launch_url($app_token) {
        global $USER;

        $partner_id = \local_kaltura\kaltura_config::get_partner_id();

        $launch_data = [
            "appToken" => $app_token->token,
            "appTokenId" => $app_token->id,
            "userId" => $USER->username,
            "partnerId" => $partner_id,
            "serviceUrl" => \local_kaltura\kaltura_config::get_host(),
            "appHost" => (new \moodle_url('/local/mymedia/view.php'))->out() . '?entryid=',
            "entryURL" => "",
            "hostingAppType" => "",
            "hashType" => "SHA256"
        ];

        return base64_encode(json_encode($launch_data));
    }

}
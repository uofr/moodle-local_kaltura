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
 * kaltura_client class file.
 *
 * @package local_kaltura
 */
namespace local_kaltura;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../API/KalturaClient.php');

/**
 * Kaltura client utility functions.
 */
class kaltura_client {

    /**
     * Sets up and returns a KalturaConfiguration object.
     * 
     * @return \KalturaConfiguration
     */
    public static function get_config() {
        global $CFG;

        $partner_id = get_config('local_kaltura',  'partner_id');
        $server_url = get_config('local_kaltura', 'uri');
        $version = get_config('local_kaltura', 'version');

        $config = new \KalturaConfiguration($partner_id);
        $config->serviceUrl = $server_url;
        $config->cdnUrl = $server_url;
        $config->clientTag = 'moodle_kaltura_' . $version;

        if (!empty($CFG->proxyhost)) {
            $config->proxyHost = $CFG->proxyhost;
            $config->proxyPort = $CFG->proxyport;
            $config->proxyType = $CFG->proxytype;
            $config->proxyUser = ($CFG->proxyuser) ? $CFG->proxyuser : null;
            $config->proxyPassword = ($CFG->proxypassword && $CFG->proxyuser) ? $CFG->proxypassword : null;
        }

        return $config;
    }

    public static function get_client() {
        global $USER;

        $admin_secret = get_config('local_kaltura', 'adminsecret');
        $partner_id = get_config('local_kaltura', 'partner_id');

        $client = new \KalturaClient(self::get_config());
        $session = $client->generateSessionV2($admin_secret, $USER->username, \KalturaSessionType::USER, $partner_id, 10800, '');
        $client->setKs($session);
        return $client;
    }

}

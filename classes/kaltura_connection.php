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
 * kaltura_connection class file.
 * 
 * @package local_kaltura
 */

namespace local_kaltura;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../API/KalturaClient.php');

/**
 * Static functions for connecting to the Kaltura API.
 */
class kaltura_connection {

    /**
     * Sets up and returns a KalturaConfiguration object.
     * 
     * @return KalturaConfiguration
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

    /**
     * Creates KalturaClient with a new session.
     * 
     * @param \KalturaConfiguration $config
     * @return \KalturaClient
     */
    public static function get_client(\KalturaConfiguration $config, int $timeout = 10800) {
        global $USER;

        $secret = get_config('local_kaltura', 'adminsecret');
        $partner_id = get_config('local_kaltura', 'partner_id');

        $client = new \KalturaClient($config);
        $session = $client->generateSession($secret, $USER->username, \KalturaSessionType::ADMIN, $partner_id, $timeout);
        $client->setKs($session);
        return $client;
    }

}
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
 * Kaltura player static class.
 */
class kaltura_player {

    /**
     * Gets javascript url for player.
     * @return \moodle_url
     */
    public static function get_js_url() {
        $host = \local_kaltura\kaltura_config::get_kaltura_url();
        $partner_id = \local_kaltura\kaltura_config::get_partner_id();
        $uiconf_id = \local_kaltura\kaltura_config::get_uiconf_id();

        return new \moodle_url("{$host}/p/{$partner_id}/sp/{$partner_id}00/embedIframeJs/uiconf_id/{$uiconf_id}/partner_id/{$partner_id}");
    }

    /**
     * Returns player embed link.
     * @return string
     */
    public static function get_embed_url($entry_id) {
        $server_url = \local_kaltura\kaltura_config::get_host();
        $partner_id = \local_kaltura\kaltura_config::get_partner_id();
        $uiconf_id = \local_kaltura\kaltura_config::get_uiconf_id();
        return "{$server_url}/index.php/kwidget/wid/_{$partner_id}/uiconf_id/{$uiconf_id}/entry_id/{$entry_id}/v/flash";
    }

    /**
     * Returns player embed link.
     * @return string
     */
    public static function get_embed_url_legacy($entry_id) {
        $server_url = \local_kaltura\kaltura_config::get_host_legacy();
        $partner_id = \local_kaltura\kaltura_config::get_legacy_partnerid();
        $uiconf_id = \local_kaltura\kaltura_config::get_uiconf_id_legacy();
        return "{$server_url}/index.php/kwidget/wid/_{$partner_id}/uiconf_id/{$uiconf_id}/entry_id/{$entry_id}/v/flash";
    }

    /**
     * Returns the player for the given entry.
     * 
     * @param $entryid
     * @return string
     */
    public static function get_player($entryobj) {
        $host = \local_kaltura\kaltura_config::get_host();
        if (strpos($entryobj->capabilities, 'quiz.quiz') !== false) {
            $uiconf = \local_kaltura\kaltura_config::get_uiconf_id_quiz();
        } else {
            $uiconf = \local_kaltura\kaltura_config::get_uiconf_id();
        }
        $client = \local_kaltura\kaltura_client::get_client();
        $ks = \local_kaltura\kaltura_session_manager::get_user_session($client, 10800, 'sview:'.$entryobj->id);

        $uid  = floor(microtime(true));
        $uid .= '_' . mt_rand();

        $output = "<iframe id=\"kaltura_player_{$uid}\" src=\"{$host}/p/{$entryobj->partnerId}/sp/{$entryobj->partnerId}00/embedIframeJs/uiconf_id/{$uiconf}/partner_id/{$entryobj->partnerId}?iframeembed=true&playerId=kaltura_player_{$uid}&entry_id={$entryobj->id}&ks={$ks}\" width=\"560\" height=\"395\" allowfullscreen webkitallowfullscreen mozAllowFullScreen allow=\"autoplay *; fullscreen *; encrypted-media *\" frameborder=\"0\"></iframe>";

        return $output;
    }

    public static function get_player_legacy($entryobj) {
        $host = \local_kaltura\kaltura_config::get_legacy_host();
        $uiconf = \local_kaltura\kaltura_config::get_uiconf_id_legacy();
        $client = \local_kaltura\kaltura_client::get_client('ce');
        $ks = \local_kaltura\kaltura_session_manager::get_user_session_legacy($client, 10800, 'sview:'.$entryobj->id);

        $uid  = floor(microtime(true));
        $uid .= '_' . mt_rand();

        $output = "<iframe id=\"kaltura_player_{$uid}\" src=\"{$host}/p/{$entryobj->partnerId}/sp/{$entryobj->partnerId}00/embedIframeJs/uiconf_id/{$uiconf}/partner_id/{$entryobj->partnerId}?iframeembed=true&playerId=kaltura_player_{$uid}&entry_id={$entryobj->id}&ks={$ks}\" width=\"560\" height=\"395\" allowfullscreen webkitallowfullscreen mozAllowFullScreen allow=\"autoplay *; fullscreen *; encrypted-media *\" frameborder=\"0\"></iframe>";

        return $output;
    }
}
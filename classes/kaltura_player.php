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
        $server_url = get_config('local_kaltura', 'uri');
        $partner_id = get_config('local_kaltura', 'partner_id');
        $uiconf_id = get_config('local_kaltura', 'player_resource');
        if (empty($uiconf_id)) {
            $uiconf_id = get_config('local_kaltura', 'player_resource_custom');
        }
        return "{$server_url}/index.php/kwidget/wid/_{$partner_id}/uiconf_id/{$uiconf_id}/entry_id/{$entry_id}/v/flash";
    }

    /**
     * Returns the player for the given entry.
     * 
     * @param $entryid
     * @return string
     */
    public static function get_player($entryobj) {
        $host = get_config('local_kaltura', 'uri');

        $uiconf = get_config('local_kaltura', 'player_resource');
        if (empty($uiconf)) {
              $uiconf = get_config('local_kaltura', 'player_resource_custom');
        }

        $uid  = floor(microtime(true));
        $uid .= '_' . mt_rand();

        $output = '';

        $output .= "<object id=\"kaltura_player_{$uid}\" name=\"kaltura_player_{$uid}\" ";
        $output .= "type=\"application/x-shockwave-flash\" allowFullScreen=\"true\" allowNetworking=\"all\" ";
        $output .= "allowScriptAccess=\"always\"";
        $output .= "xmlns:dc=\"http://purl.org/dc/terms/\" xmlns:media=\"http://search.yahoo.com/searchmonkey/media/\" ";
        $output .= "rel=\"media:{$entryobj->mediaType}\" ";
        $output .= "resource=\"{$host}/index.php/kwidget/wid/_{$entryobj->partnerId}/uiconf_id/{$uiconf}/entry_id/{$entryobj->id}\" ";
        $output .= "data=\"{$host}/index.php/kwidget/wid/_{$entryobj->partnerId}/uiconf_id/{$uiconf}";
        $output .= "/entry_id/{$entryobj->id}\"> " . PHP_EOL;
        $output .= "<param name=\"allowFullScreen\" value=\"true\" />" . PHP_EOL;
        $output .= "<param name=\"allowNetworking\" value=\"all\" />" . PHP_EOL;
        $output .= "<param name=\"allowScriptAccess\" value=\"always\" />" . PHP_EOL;
        $output .= "<param name=\"bgcolor\" value=\"#000000\" /> " . PHP_EOL;
        $output .= "<param name=\"wmode\" value=\"opaque\" /> " . PHP_EOL;
    
        $output .= "<param name=\"movie\" value=\"{$host}/index.php/kwidget/wid/_{$entryobj->partnerId}";
        $output .= "/uiconf_id/{$uiconf}/entry_id/{$entryobj->id}\" />" . PHP_EOL;
    
        $output .= "<a rel=\"media:thumbnail\" href=\"{$host}/width/120/height/90/bgcolor/000000/type/2\"></a>". PHP_EOL;
        $output .= "<span property=\"dc:description\" content=\"{$entryobj->description}\"></span>" . PHP_EOL;
        $output .= "<span property=\"media:title\" content=\"{$entryobj->name}\"></span>" . PHP_EOL;
        $output .= "<span property=\"media:width\" content=\"{$entryobj->width}\"></span>" . PHP_EOL;
        $output .= "<span property=\"media:height\" content=\"{$entryobj->height}\"></span>" . PHP_EOL;
        $output .= "<span property=\"media:type\" content=\"application/x-shockwave-flash\"></span>" . PHP_EOL;
        $output .= "<span property=\"media:duration\" content=\"{$entryobj->duration}\"></span>". PHP_EOL;
        $output .= "</object>" . PHP_EOL;

        return $output;
    }
}
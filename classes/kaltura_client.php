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

namespace local_kaltura;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../API/KalturaClient.php');

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

    public static function get_entries($search, $sort, $page, $per_page) {
        $client = self::get_client();

        $filter = new \KalturaMediaEntryFilter();
        if (!empty($search)) {
            $search_terms = preg_replace('/(\s+)/', ',', $search);
            $filter->freeText = $search_terms;
        }
        if ($sort == 'recent') {
            $filter->orderBy = \KalturaBaseEntryOrderBy::CREATED_AT_DESC;
        } else if ($sort == 'oldest') {
            $filter->orderBy = \KalturaBaseEntryOrderBy::CREATED_AT_ASC;
        } else if ($sort == 'medianameasc') {
             $filter->orderBy = \KalturaBaseEntryOrderBy::NAME_ASC;
        } else if ($sort == 'medianamedesc') {
             $filter->orderBy = \KalturaBaseEntryOrderBy::NAME_DESC;
        } else if ($sort == 'mediadurasc') {
             $filter->orderBy = \KalturaMediaEntryOrderBy::DURATION_ASC;
        } else if ($sort == 'mediadurdesc') {
             $filter->orderBy = \KalturaMediaEntryOrderBy::DURATION_DESC;
        }
        $filter->statusIn = \KalturaEntryStatus::READY .','.
                            \KalturaEntryStatus::PRECONVERT .','.
                            \KalturaEntryStatus::IMPORT;

        $pager = new \KalturaFilterPager();
        $pager->pageIndex = $page + 1;
        $pager->pageSize = $per_page;

        $client = \local_kaltura\kaltura_client::get_client();
        $entries = $client->media->listAction($filter, $pager);
        $client->session->end();

        return $entries;
    }

}
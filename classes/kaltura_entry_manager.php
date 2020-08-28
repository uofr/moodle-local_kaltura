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
 * kaltura_entry_manager class file.
 * 
 * @package local_kaltura
 */

namespace local_kaltura;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../API/KalturaClient.php');

/**
 * Kaltura media entry utility functions.
 */
class kaltura_entry_manager {

    public static $order_by = [
        'recent' => \KalturaBaseEntryOrderBy::CREATED_AT_DESC,
        'oldest' => \KalturaBaseEntryOrderBy::CREATED_AT_ASC,
        'medianameasc' => \KalturaBaseEntryOrderBy::NAME_ASC,
        'medianamedesc' => \KalturaBaseEntryOrderBy::NAME_DESC,
        'mediadurasc' => \KalturaMediaEntryOrderBy::DURATION_ASC,
        'mediadurdesc' => \KalturaMediaEntryOrderBy::DURATION_DESC,
    ];

    /**
     * Get the current user's entries.
     * 
     * @param \KalturaClient $client
     * @param string $search
     * @param string $sort
     * @param int $page
     * @param int $per_page
     * @return \KalturaMediaListResponse
     */
    public static function get_entries($client, $search, $sort, $page, $per_page) {
        global $USER;

        $filter = new \KalturaMediaEntryFilter();
        $filter->userIdEqual = $USER->username;
        if (!empty($search)) {
            $search_terms = preg_replace('/(\s+)/', ',', $search);
            $filter->freeText = $search_terms;
        }
        $filter->orderBy = self::$order_by[$sort];
        $filter->statusIn = \KalturaEntryStatus::READY .','.
                            \KalturaEntryStatus::PRECONVERT .','.
                            \KalturaEntryStatus::IMPORT;

        $pager = new \KalturaFilterPager();
        $pager->pageIndex = $page + 1;
        $pager->pageSize = $per_page;

        return  $client->media->listAction($filter, $pager);
    }

    public static function count_entries(\KalturaClient $client) {
        global $USER;

        $filter = new \KalturaMediaEntryFilter();
        $filter->userIdEqual = $USER->username;
        $filter->statusIn = \KalturaEntryStatus::READY .','.
                            \KalturaEntryStatus::PRECONVERT .','.
                            \KalturaEntryStatus::IMPORT;
        
        return $client->media->count($filter);
    }

    /**
     * Gets the specified entry. Throws exception if entry does not belong to user.
     * 
     * @param KalturaClient $client
     * @param string $entryid
     * @return \KalturaMediaEntry
     * @throws moodle_exception
     */
    public static function get_entry($client, $entryid) {
        global $USER;

        $entry = \KalturaStaticEntries::getEntry($entryid, $client->baseEntry, true);

        if ($entry->userId !== $USER->username) {
            throw new \moodle_exception('error_entry_permission', 'local_mymedia');
        }

        return $entry;
    }

}

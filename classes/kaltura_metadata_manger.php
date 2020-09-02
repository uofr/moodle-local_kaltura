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
 * kaltura_metadata_manger class file.
 * 
 * @package local_kaltura
 */

namespace local_kaltura;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../API/KalturaClient.php');

/**
 * Kaltura metadata static class.
 */
class kaltura_metadata_manger {

    public static function get_custom_metadata($client, $entryid) {
        $filter = new \KalturaMetadataFilter();
        $filter->metadataObjectTypeEqual = \KalturaMetadataObjectType::ENTRY;
        $filter->objectIdEqual = $entryid;
        $filter->metadataProfileIdEqual = \local_kaltura\kaltura_config::get_metadata_id();

        $metadata = $client->metadata->listaction($filter);

        return $metadata->objects[0];
    }

}
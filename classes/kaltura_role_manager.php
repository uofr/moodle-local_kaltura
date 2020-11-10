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
 * kaltura_role_manager class file.
 *
 * @package    local_mymedia
 */

namespace local_kaltura;

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__ . '/../API/KalturaClient.php');

/**
 * Kaltura role functions.
 */
class kaltura_role_manager {

    public static function get_role($client, $role_name) {
        $filter = new \KalturaUserRoleFilter();
        $filter->nameEqual = $role_name;
        
        return $client->userRole->listAction($filter);
    }

    public static function add_role($client, $role_name, $description, $permissions, $tags) {
        $role = new \KalturaUserRole();

        $role->name = $role_name;
        $role->description = $description;
        $role->permissionNames = $permissions;
        $role->tags = $tags;

        return $client->userRole->add($role);
    }

    public static function get_kaltura_capture_role($client) {
        $role_name = 'KalturaCapture';
        $role = self::get_role($client, $role_name);
        if (!$role->totalCount) {
            $desc = 'Upload by kalturacapture client.';
            $permissions = "CONTENT_INGEST_UPLOAD,CONTENT_MANAGE_BASE,cuePoint.MANAGE, CONTENT_MANAGE_THUMBNAIL, STUDIO_BASE"; 
            $tags = 'kalturacapture';
            $role = self::add_role($client, $role_name, $desc, $permissions, $tags);
        } else {
            $role = $role->objects[0];
        }
        return $role->id;
    }

}
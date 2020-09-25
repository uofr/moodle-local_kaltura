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
 * kaltura_entry class file.
 *
 * @package local_kaltura
 */

namespace local_kaltura\output;

use renderer_base;

defined('MOODLE_INTERNAL') || die();

class kaltura_entry implements \renderable, \templatable {

    public $entry;

    public function __construct($entry) {
        $this->entry = $entry;
    }

    public function export_for_template(renderer_base $output) {
        return [
            'id' => $this->entry->id,
            'name' => $this->entry->name,
            'tags' => $this->entry->tags,
            'description' => $this->entry->description,
            'thumbnailUrl' => $this->entry->thumbnailUrl,
            'createdAt' => $this->entry->createdAt,
            'duration' => $this->format_duration($this->entry->duration),
            'views' => $this->entry->views,
            'downloadUrl' => $this->entry->downloadUrl,
            'entry_ready' => $this->entry->status == \KalturaEntryStatus::READY
        ];
    }
    
    private function format_duration($duration) {
        return (floor($duration / 60) . ':' . str_pad(($duration % 60), 2, '0', STR_PAD_LEFT));
    }

}
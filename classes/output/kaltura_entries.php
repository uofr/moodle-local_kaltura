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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>

/**
 * kaltura_entries class file.
 * 
 * @package local_kaltura
 */

namespace local_kaltura\output;

use renderer_base;

defined('MOODLE_INTERNAL') || die();

class kaltura_entries implements \renderable, \templatable {

    /** @var array */
    public $entries;

    public function __construct(array $entries) {
        $this->entries = $entries;
    }

    public function export_for_template(renderer_base $output) {
        $entry_data = [];

        foreach($this->entries as $entry) {
            $entry_renderable = new \local_kaltura\output\kaltura_entry($entry);
            $entry_data[] = $entry_renderable->export_for_template($output);
        }

        return $entry_data;
    }
}
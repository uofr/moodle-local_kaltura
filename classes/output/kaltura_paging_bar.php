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
 * kaltura_paging_bar class file.
 *
 * @package local_kaltura
 */

namespace local_kaltura\output;
defined('MOODLE_INTERNAL') || die();

class kaltura_paging_bar implements \renderable, \templatable {

    public $total;

    public $per_page;

    public $current_page;

    public function __construct(int $total, int $per_page, int $current_page) {
        $this->total = $total;
        $this->per_page = $per_page;
        $this->current_page = $current_page;
    }

    public function export_for_template(\renderer_base $output) {
        $num_pages = $this->total / $this->per_page;
        $pages = [];

        if ($num_pages > 1) {
            for ($i = 0; $i < $num_pages; $i++) {
                $pages[] = [
                    'active' => $i === $this->current_page,
                    'page' => $i + 1,
                    'page_index' => $i
                ];
            }
        }

        return [
            'has_pages' => $num_pages > 1,
            'pages' => $pages
        ];
    }
}

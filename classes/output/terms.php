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
 * terms class file
 * @package local_kaltura
 */

namespace local_kaltura\output;

defined('MOODLE_INTERNAL') || die();

/**
 * terms renderable class.
 */
class terms implements \renderable, \templatable {

    /** @var currently selected term. */
    public $current_term;

    public function __construct(string $current_term = "") {
        $this->current_term = $current_term;
    }

    public function export_for_template(\renderer_base $output) {
        $terms = [];

        $curyr = $countyr = date('Y');
        $curmo = date('m');
        $endyr = $curyr + 1;

        $term_opts = array('Winter','Spring/Summer','Fall');

        if ($curmo < 5) {
            $current_index = 0;
        } else if ($curmo < 9) {
            $current_index = 1;
        } else {
            $current_index = 2;
        }

        while ($countyr <= $endyr) {
            for ($i = $current_index; $i < 3; $i++) {
                $terms[] = [
                    'term' => $countyr . ' ' . $term_opts[$i],
                    'selected' => $this->current_term === $countyr . ' ' . $term_opts[$i]
                ];
            }
            $countyr++;
            $current_index = 0;
        }

        $terms[] = [
            'term' => 'Multiple Terms',
            'selected' => $this->current_term === 'Multiple Terms'
        ];

        return $terms;
    }
}

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
 * Modal for displaying kaltura upload progress.
 *
 * @module local_kaltura/modal_kaltura_progress
 * @package local_kaltura
 * @author John Lane
 */

import $ from 'jquery';

import Modal from 'core/modal';
import ModalRegistry from 'core/modal_registry';

const SELECTORS = {
    PROGRESS_BAR: '#modal_progress_bar',
};

/**
 * Kaltura progress modal class.
 *
 * @class ModalKalutraProgress
 */
export default class ModalKalturaProgress extends Modal {

    /**
     * Constructor.
     * @param {String} root
     */
    constructor(root) {
        super(root);
    }

    /**
     * Event listener setup.
     * Overridden so the modal can't be closed prematurely.
     */
    registerEventListeners() {
    }

    /**
     * Progress event callback function. Animates progress bar based on event progress.
     * @param {Event} e
     */
    progressCallback(e) {
        const progress = parseInt(e.loaded / e.total * 100);
        $(SELECTORS.PROGRESS_BAR).css({width: progress + '%'});
        $(SELECTORS.PROGRESS_BAR).text(progress + '%');
    }

    /**
     * Returns modal type. Used for creating modal using core/modal_factory.
     * @returns {String}
     */
    static getType() {
        return 'local_kalutra_modal_kaltura_progress';
    }

}

let registered = false;
if (!registered) {
    ModalRegistry.register(ModalKalturaProgress.getType(), ModalKalturaProgress, 'local_kaltura/modal_kaltura_progress');
    registered = true;
}
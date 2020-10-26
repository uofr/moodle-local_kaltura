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
 * Modal for displaying kaltura upload forms.
 *
 * @module local_kaltura/modal_kaltura_upload
 * @package local_kaltura
 * @author John Lane
 */

import Templates from 'core/templates';
import {get_string as getString} from 'core/str';
import {publish} from 'core/pubsub';

import Modal from 'core/modal';
import ModalRegistry from 'core/modal_registry';
import ModalEvents from 'core/modal_events';

import KalturaAjax from 'local_kaltura/kaltura_ajax';
import KalturaEvents from 'local_kaltura/kaltura_events';

const templates = {
    media: 'local_kaltura/upload_form_media',
    record: 'local_kaltura/upload_form_record'
};

const titles = {
    media: 'media_upload',
    record: 'webcam_upload'
};

/**
 * Kaltura upload modal class.
 *
 * @class ModalKalturaUpload
 */
export default class ModalKalturaUpload extends Modal {

    /**
     * Constructor.
     * @param {String} root
     */
    constructor(root) {
        super(root);
    }

    /**
     * Event listener setup.
     */
    registerEventListeners() {
        super.registerEventListeners();

        this.getRoot().on(ModalEvents.hidden, () => {
            this.setBody('');
            publish(KalturaEvents.uploadModalClose);
        });

    }

    /**
     * Renders the specified upload form.
     * @param {String} type - Type of upload form to render (media, recording, youtube, etc).
     * @param {Number} contextid
     */
    async renderUploadForm(type, contextid) {
        const data = await KalturaAjax.getUploadModalData(contextid);

        const renderPromise = Templates.render(templates[type], data);
        this.setBody(renderPromise);

        const title = await getString(titles[type], 'local_kaltura');
        this.setTitle(title);

        this.show();
    }

    /**
     * Returns modal type. Used for creating modal using core/modal_factory.
     * @returns {String}
     */
    static getType() {
        return 'local_kalutra_modal_kaltura_upload';
    }

}

let registered = false;
if (!registered) {
    ModalRegistry.register(ModalKalturaUpload.getType(), ModalKalturaUpload, 'local_kaltura/modal_kaltura_upload');
    registered = true;
}

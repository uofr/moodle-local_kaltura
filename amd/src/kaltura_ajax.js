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
 * Kaltura ajax functions.
 *
 * @module local_kaltura/kaltura_ajax
 * @package local_kaltura
 * @author John Lane
 */

import Ajax from 'core/ajax';

export default {
    /**
     * Gets data needed to render video picker template.
     *
     * @method getVideoPickerData
     * @param {Number} contextid
     * @param {String} search
     * @param {String} sort
     * @param {Number} page
     * @param {Number} source
     * @returns {Promise}
     */
    getVideoPickerData: (contextid, search, sort, page, source) => {
        return Ajax.call([{
            methodname: 'local_kaltura_get_video_picker_data',
            args: {
                contextid: contextid,
                search: search,
                sort: sort,
                page: page,
                source: source
            }
        }])[0];
    },
    /**
     * Gets data needed to render upload modal.
     *
     * @method getUploadModalData
     * @param {Number} contextid
     * @returns {Promise}
     */
    getUploadModalData: (contextid) => {
        return Ajax.call([{
            methodname: 'local_kaltura_get_upload_modal_data',
            args: {
                contextid: contextid
            }
        }])[0];
    },
    /**
     * Gets host, session, and other data needed to upload to kaltura.
     *
     * @method getUploadCredentials
     * @returns {Promise}
     */
    getUploadCredentials: () => {
        return Ajax.call([{
            methodname: 'local_kaltura_get_upload_credentials',
            args: {}
        }])[0];
    },
    /**
     * Gets kaltura entry render data.
     *
     * @method getEntry
     * @param {Number} contextid
     * @param {String} entryid
     * @returns {Promise}
     */
    getEntry: (contextid, entryid) => {
        return Ajax.call([{
            methodname: 'local_kaltura_get_entry',
            args: {
                contextid: contextid,
                entryid: entryid
            }
        }])[0];
    }
};

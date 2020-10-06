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

import $ from 'jquery';
import {get_string as getString} from 'core/str';
import {publish} from 'core/pubsub';
import Notification from 'core/notification';

import KalturaAjax from 'local_kaltura/kaltura_ajax';
import KalturaUploader from 'local_kaltura/kaltura_uploader';
import KalturaEvents from 'local_kaltura/kaltura_events';

import ModalFactory from 'core/modal_factory';
import ModalKalturaProgress from 'local_kaltura/modal_kaltura_progress';

const ALLOWED_TYPES = [
    'video/3gpp',
    'video/avi',
    'video/dvd',
    'video/mp4',
    'video/mpeg',
    'video/mts',
    'video/ogg',
    'video/quicktime',
    'video/vnd.rn-realvideo',
    'video/VP8',
    'video/webm',
    'video/x-msvideo',
    'video/x-flv',
    'video/x-f4v',
    'video/x-ms-asf',
    'video/x-ms-wmv',
    'video/x-matroska'
];

const CSS = {
    HIDDEN: 'hidden',
    HOVER: 'highlighted',
    ERROR: 'file-error'
};

const SELECTORS = {
    NAME: '#entry_name',
    TAGS: '#entry_tags',
    DESC: '#entry_desc',
    FILE_PICKER: '#entry_file',
    STUDENT_CONTENT: '[name="student"]',
    TERM: '#entry_term',
    FILE_DROP_AREA: '[data-region="file-drop-area"]',
    FILE_INFO: '[data-region="file-info"]',
    FILE_ERROR: '[data-region="file-error"]',
    UPLOAD_PART_2: '[data-region="upload-part-2"]'
};

let root;
let selectedFile;

export const init = (rootSelector) => {
    root = $(rootSelector);
    registerEventListeners();
};

const registerEventListeners = () => {
    root.find(SELECTORS.FILE_DROP_AREA).on('dragenter dragover dragleave drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
    });

    root.find(SELECTORS.FILE_DROP_AREA).on('dragenter dragover', (e) => {
        $(e.currentTarget).addClass(CSS.HOVER);
    });

    root.find(SELECTORS.FILE_DROP_AREA).on('dragleave drop', (e) => {
        $(e.currentTarget).removeClass(CSS.HOVER);
    });

    root.find(SELECTORS.FILE_DROP_AREA).on('drop', (e) => {
        const file = e.originalEvent.dataTransfer.files[0];
        handleFile(file);
    });

    root.find(SELECTORS.FILE_PICKER).on('change', (e) => {
        const file = e.currentTarget.files[0];
        handleFile(file);
    });

    root.on('submit', (e) => {
        e.preventDefault();
        if (checkFile(selectedFile)) {
            upload();
        }
    });

    root.on('reset', () => {
        selectedFile = null;
        updateFileInfo(null);
        showFileError(null);
        root.find(SELECTORS.UPLOAD_PART_2).addClass(CSS.HIDDEN);
        root.find(SELECTORS.TERM).prop('disabled', false);
    });

    root.on('change', SELECTORS.STUDENT_CONTENT, (e) => {
        root.find(SELECTORS.TERM).prop('disabled', $(e.currentTarget).val() === 'Yes');
    });

};

const handleFile = (file) => {
    updateFileInfo(file);
    if (checkFile(file)) {
        selectedFile = file;
        root.find(SELECTORS.NAME).val(file.name);
        root.find(SELECTORS.UPLOAD_PART_2).removeClass(CSS.HIDDEN);
    }
};

const checkFile = (file) => {
    const error = getFileError(file);
    showFileError(error);
    if (error) return false;
    else return true;
};

const getFileError = (file) => {
    if (!file) {
        return {key: 'video_required', component: 'local_kaltura'};
    } else if (ALLOWED_TYPES.indexOf(file.type) === -1) {
        return {key: 'video_valid_type', component: 'local_kaltura'};
    } else {
        return null;
    }
};

const showFileError = async (error) => {
    const string = error ? await getString(error.key, error.component) : '';
    root.find(SELECTORS.FILE_ERROR).text(string);
    root.find(SELECTORS.FILE_DROP_AREA).toggleClass(CSS.ERROR, error ? true : false);
};

const updateFileInfo = async (file) => {
    const string = file ? getString('file_selected', 'local_kaltura', file.name) : getString('no_file_selected', 'local_kaltura');
    root.find(SELECTORS.FILE_INFO).text(await string);
};

const upload = async () => {
    let uploadCredentials, progressModal;
    try {
        const formData = getFormData();
        [uploadCredentials, progressModal] = await Promise.all([
            KalturaAjax.getUploadCredentials(),
            ModalFactory.create({type: ModalKalturaProgress.getType()})
        ]);
        progressModal.show();
        const xml = await KalturaUploader.upload(formData, uploadCredentials, progressModal.progressCallback);
        const newEntryId = $(xml).find('entryId').text();
        publish(KalturaEvents.uploadComplete, newEntryId);
    } catch (error) {
        Notification.exception(error);
    } finally {
        progressModal.hide();
        progressModal.destroy();
    }
};

const getFormData = () => {
    return {
        file: selectedFile,
        name: root.find(SELECTORS.NAME).val().trim(),
        tags: root.find(SELECTORS.TAGS).val().trim(),
        desc: root.find(SELECTORS.DESC).val().trim(),
        studentContent: root.find(SELECTORS.STUDENT_CONTENT + ':checked').val(),
        term: root.find(SELECTORS.STUDENT_CONTENT + ':checked').val() === 'Yes' ? '' : root.find(SELECTORS.TERM).val(),
        assessment: 'No'
    };
};

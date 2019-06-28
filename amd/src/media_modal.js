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
 * Kalvidres and Kalvidassign modal scripts.
 *
 * @module local_kaltura/properties
 */

define(['jquery', 'core/modal_factory', 'core/url'], function($, modalFactory, url) {

    var SELECTORS = {
        ADD_MEDIA_BTN : '#id_add_media',
        UPLOAD_MEDIA_BTN : '#id_upload_media',
        RECORD_MEDIA_BTN : '#id_record_media'
    };

    var _getIframe = function(iframeUrl) {
        var iframeContainer = $('<div></div>');
        var iframe = $('<iframe></iframe>');

        iframeContainer.addClass('embed-responsive embed-responsive-16by9');
        iframe.attr('src', iframeUrl);
        iframeContainer.append(iframe);

        return iframeContainer[0].outerHTML;
    };

    var _createSelectorModal = function() {
        var iframeUrl = url.relativeUrl('/local/kaltura/simple_selector.php');
        var trigger = $(SELECTORS.ADD_MEDIA_BTN);
        var modalConfig = {
            title : 'My Media',
            body: _getIframe(iframeUrl),
            large: true
        };
        modalFactory.create(modalConfig, trigger);
    };

    var _createUploadModal = function() {
        var iframeUrl = url.relativeUrl('/local/mymedia/simple_uploader.php', {embedded : 1});
        var trigger = $(SELECTORS.UPLOAD_MEDIA_BTN);
        var modalConfig = {
            title : 'Upload Media',
            body: _getIframe(iframeUrl),
            large: true
        };
        modalFactory.create(modalConfig, trigger);
    };

    var _createRecordModal = function() {
        var iframeUrl = url.relativeUrl('/local/mymedia/webcam_uploader.php', {embedded : 1});
        var trigger = $(SELECTORS.RECORD_MEDIA_BTN);
        var modalConfig = {
            title : 'Record Media',
            body: _getIframe(iframeUrl),
            large: true
        };
        modalFactory.create(modalConfig, trigger);
    };

    var init = function() {
        _createSelectorModal();
        _createUploadModal();
        _createRecordModal();
    };

    return {
        init : init
    };

});
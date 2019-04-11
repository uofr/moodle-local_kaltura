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
 * Script for video selector in mod_kalvidres and mod_kalvidassign.
 *
 * @package     local_kaltura
 * @module      local_kaltura/simpleselector
 */


 define(['jquery', 'core/url'], function($, url) {
    
    // selectors
    var gridButton = "#ss-sortgrid";
    var listButton = '#ss-sortlist';
    var sort = '#selectorSort';
    var uploadButton = "#uploader_open";
    var webcamUploadButton = "#webcam_open";
    var mediaEntry = '.mymedia.mm-media.entry';
    var mediaEntryThumbnail = '.mymedia.mm-media.entry .mm-thumb-grp';
    var mediaEntryMetadata = '.mymedia.mm-media.entry .mm-entry-grp';

    // modal selectors (located in parent.document)
    var selectedVidThumb = '#selected_video_thumbnail';
    var selectedVidName = '#selected_video_name';
    var selectedVidId = '#selected_video_id';
    var submitButton = "#submit_btn";

    // elements in parent.document
    var entryId = "#entry_id";
    var entryName = "#id_name";
    var entryThumbnail = "#media_thumbnail";
    var idMediaProperties = "#id_media_properties"; 
    var submitMedia = "#submit_media";

    function init() {
        // event listeners
        $(gridButton).click(layoutGrid);
        $(listButton).click(layoutList);
        $(sort).change(sortMedia);
        $(uploadButton).click(openUploader);
        $(webcamUploadButton).click(openWebcamUploader);
        $(mediaEntry).click(selectMedia);
        $(submitButton, parent.document).click(submit);
    }

    // displays media as a grid
    function layoutGrid() {
        $(gridButton).addClass('active');
        $(listButton).removeClass('active');

        document.cookie = "ss-sort-style=grid;expires=January 12, 2025";
        if ($(mediaEntry).hasClass('col-sm-12')) {
            $(mediaEntry).removeClass('col-sm-12').addClass('col-sm-4');
        }
        $(mediaEntryThumbnail).removeClass('col-sm-4').addClass('col-sm-12');
        $(mediaEntryMetadata).removeClass('col-sm-8').addClass('col-sm-12');
    }

    // displays media as a list
    function layoutList() {
        $(listButton).addClass('active');
        $(gridButton).removeClass('active');
        
        document.cookie = "ss-sort-style=list;expires=January 12, 2025";
        if ($(mediaEntry).hasClass('col-sm-4')) {
            $(mediaEntry).removeClass('col-sm-4').addClass('col-sm-12');
        }
        $(mediaEntryThumbnail).removeClass('col-sm-12').addClass('col-sm-4');
        $(mediaEntryMetadata).removeClass('col-sm-12').addClass('col-sm-8');
    }

    function sortMedia() {
        window.location.href = $(this).val();
    }

    function openUploader() {
        var urlParams = new URLSearchParams(window.location.search);
        var seltype = (urlParams.get('seltype')) ? '&seltype=' + urlParams.get('seltype') : '';
        location.href = "./../mymedia/simple_uploader.php?embedded=1" + seltype;
    }

    function openWebcamUploader() {
        var urlParams = new URLSearchParams(window.location.search);
        var seltype = (urlParams.get('seltype')) ? '&seltype=' + urlParams.get('seltype') : '';
        location.href = "./../mymedia/webcam_uploader.php?embedded=1" + seltype;
    }

    function selectMedia() {
        var selectedId = $(this).attr('id');
        var selectedName = $('#th_' + selectedId).attr('alt');
        var selectedThumbnail = $('#th_' + selectedId).attr('src');

        $(mediaEntry).removeClass('selected');
        $(this).addClass('selected');
        
        $(selectedVidId, parent.document).val(selectedId);
        $(selectedVidThumb, parent.document).attr('src', selectedThumbnail);
        $(selectedVidName, parent.document).text(selectedName);

        $(submitButton, parent.document).prop("disabled", false);
    }

    function submit() {
        var selectedId = $(selectedVidId, parent.document).val();
        var selectedName = $(selectedVidName, parent.document).text();
        var selectedThumb = $(selectedVidThumb, parent.document).attr('src');

        if ($(entryId, parent.document) !== null) {
            if (selectedId !== null && selectedId !== '') {
                $(entryId, parent.document).val(selectedId);
            }
        }

        if ($(entryName, parent.document) !== null) {
            if (selectedName !== null && selectedName !== '') {
                $(entryName, parent.document).val(selectedName);
            }
        }

        if ($(entryThumbnail, parent.document !== null)) {
            if (selectedThumb !== null && selectedThumb !== '') {
                $(entryThumbnail, parent.document).attr('src', selectedThumb);
            }
        }
        
        if ($(idMediaProperties, parent.document) !== null) {
            $(idMediaProperties, parent.document).css({visibility: "visible"});
        }

        if ($(submitMedia, parent.document) !== null) {
            $(submitMedia, parent.document).prop("disabled", false);
        }
    }

    return {init: init};

 });
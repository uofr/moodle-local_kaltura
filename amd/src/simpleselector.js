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


 define(['jquery'], function($) {

    var SELECTORS = {
        GRID_BTN: '#ss-sortgrid',
        LIST_BTN: '#ss-sortlist',
        SORT: '#selectorSort',
        MEDIA_ENTRY: '.mymedia.mm-media.entry',
        MEDIA_ENTRY_THUMBNAIL: '.mymedia.mm-media.entry .mm-thumb-grp',
        MEDIA_ENTRY_METADATA: '.mymedia.mm-media.entry .mm-entry-grp',
        SELECTED_MEDIA_THUMB: '#selected_video_thumbnail',
        SELECTED_MEDIA_NAME: '#selected_video_name',
        SELECTED_MEDIA_ID: '#selected_video_id',
        ENTRY_ID: '#entry_id',
        ENTRY_NAME: '#id_name',
        ENTRY_THUMBNAIL: '#media_thumbnail',
        ID_MEDIA_PROPERTIES: '#id_media_properties',
        SUBMIT_BTN: '#selector_submit',
        ASSGN_SUBMIT_BTN: '#submit_media'
    };

    var _selectedMediaId = null;
    var _selectedMediaName = null;
    var _selectedMediaImg = null;

    var _registerEventListeners = function() {
        $(SELECTORS.GRID_BTN).click(_layoutGrid);
        $(SELECTORS.LIST_BTN).click(_layoutList);
        $(SELECTORS.SORT).change(_sortMedia);
        $(SELECTORS.MEDIA_ENTRY).click(_selectMedia);
        $(SELECTORS.MEDIA_ENTRY).dblclick(_selectMediaSubmit);
        $(SELECTORS.SUBMIT_BTN, parent.document).click(_submit);
    };

    var _layoutGrid = function() {
        $(SELECTORS.GRID_BTN).addClass('active');
        $(SELECTORS.LIST_BTN).removeClass('active');

        document.cookie = "ss-sort-style=grid;expires=January 12, 2025";
        if ($(SELECTORS.MEDIA_ENTRY).hasClass('col-sm-12')) {
            $(SELECTORS.MEDIA_ENTRY).removeClass('col-sm-12').addClass('col-sm-4');
        }
        $(SELECTORS.MEDIA_ENTRY_THUMBNAIL).removeClass('col-sm-4').addClass('col-sm-12');
        $(SELECTORS.MEDIA_ENTRY_METADATA).removeClass('col-sm-8').addClass('col-sm-12');
    };

    var _layoutList = function() {
        $(SELECTORS.LIST_BTN).addClass('active');
        $(SELECTORS.GRID_BTN).removeClass('active');
        document.cookie = "ss-sort-style=list;expires=January 12, 2025";
        if ($(SELECTORS.MEDIA_ENTRY).hasClass('col-sm-4')) {
            $(SELECTORS.MEDIA_ENTRY).removeClass('col-sm-4').addClass('col-sm-12');
        }
        $(SELECTORS.MEDIA_ENTRY_THUMBNAIL).removeClass('col-sm-12').addClass('col-sm-4');
        $(SELECTORS.MEDIA_ENTRY_METADATA).removeClass('col-sm-12').addClass('col-sm-8');
    };

    var _sortMedia = function() {
        window.location.href = $(this).val();
    };

    var _selectMedia = function() {
        var selectedId = $(this).attr('id');

        _selectedMediaId = $(this).attr('id');
        _selectedMediaName = $('#th_' + selectedId).attr('alt');
        _selectedMediaImg = $('#th_' + selectedId).attr('src');

        $(SELECTORS.MEDIA_ENTRY).removeClass('selected');
        $(this).addClass('selected');
    };

    var _submit = function(event) {
        var selectedId = _selectedMediaId;
        var selectedName = _selectedMediaName;
        var selectedThumb = _selectedMediaImg;

        if ($(SELECTORS.ENTRY_ID, parent.document) !== null) {
            if (selectedId !== null && selectedId !== '') {
                $(SELECTORS.ENTRY_ID, parent.document).val(selectedId);
            }
        }
        if ($(SELECTORS.ENTRY_NAME, parent.document) !== null) {
            if (selectedName !== null && selectedName !== '') {
                $(SELECTORS.ENTRY_NAME, parent.document).val(selectedName);
            }
        }
        if ($(SELECTORS.ENTRY_THUMBNAIL, parent.document !== null)) {
            if (selectedThumb !== null && selectedThumb !== '') {
                $(SELECTORS.ENTRY_THUMBNAIL, parent.document).attr('src', selectedThumb);
            }
        }

        //if mod_kalvidassign, need to enable submit button if media has been selected
        if ($(SELECTORS.ASSGN_SUBMIT_BTN, parent.document) !== null) {
            if ($(SELECTORS.ENTRY_ID, parent.document).val() != '') {
                if ($(SELECTORS.ASSGN_SUBMIT_BTN, parent.document).prop('disabled') == true) {
                    $(SELECTORS.ASSGN_SUBMIT_BTN, parent.document).prop('disabled', false);
                }
            }
        }
    };

    var _selectMediaSubmit = function() {
       //console.log('process dbl click');
       $(this).trigger('click');
       $(SELECTORS.SUBMIT_BTN, parent.document).trigger('click');
       //console.log('triggered');
    };

    var init = function() {
        _registerEventListeners();
    };

    return {
        init: init
    };

 });
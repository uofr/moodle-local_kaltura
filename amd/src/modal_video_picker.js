import $ from 'jquery';
import Ajax from 'core/ajax';
import Notification from 'core/notification';
import Templates from 'core/templates';
import {get_string as getString} from 'core/str';

import Modal from 'core/modal';
import ModalRegistry from 'core/modal_registry';
import ModalEvents from 'core/modal_events';

import KalturaAjax from 'local_kaltura/kaltura_ajax';

const SELECTORS = {
    VIDEO_PICKER_MAIN: '[data-region="video-picker-main"]',
    ENTRY_LIST: '[data-region="entry-list"]',
    ENTRY: '[data-entry]',
    PAGING_BAR: '[data-region="paging-bar"]',
    PAGE_ITEM: '.page-item',
    PAGE_LINK: '[data-region="paging-bar"] [data-action="switch-page"]',
    NEXT_PAGE: '[data-action="next-page"]',
    PREV_PAGE: '[data-action="prev-page"]',
    SEARCH_FORM: '[data-action="kaltura-search"]',
    SEARCH_INPUT: '#kaltura_search_box',
    SEARCH_CLEAR: '[data-action="kaltura-clear-search"]',
    SORT: '#kaltura_sort',
    ENTRY_CHECKBOX: '.kaltura-entry-checkbox',
    CONFIRM: '[data-action="confirm-entry-selection"]',
    ENTRY_ID: '#entry_id',
    ENTRY_NAME: '#id_name',
    ENTRY_THUMB: '#media_thumbnail',
    ENTRY_SELECTED_HDR: '[data-region="selected-entry-header"]',
    VIDEO_TITLE: '#video_title'
};

const TEMPLATES = {
    OVERLAY_LOADING: 'core/overlay_loading',
    VIDEO_PICKER_MAIN: 'local_kaltura/modal_video_picker_main'
};

export default class ModalVideoPicker extends Modal {

    constructor(root) {
        super(root);
        this.contextid = null;
        this.search = '';
        this.sort = 'recent';
        this.page = 0;
        this.source = 1;
        this.selectedEntryId = null;
        this.selectedEntryName = null;
        this.selectedEntryThumb = null;
    }

    registerEventListeners() {
        super.registerEventListeners();

        this.getRoot().on(ModalEvents.shown, () => {
            this.refreshModal();
        });

        this.getRoot().on(ModalEvents.hidden, () => {
            $(SELECTORS.VIDEO_PICKER_MAIN).html('');
            this.reset();
            if (this.selectedEntryId && this.selectedEntryName && this.selectedEntryThumb) {
                this.setSelectedEntry(this.selectedEntryId, this.selectedEntryName, this.selectedEntryThumb);
            }
        });

        this.getRoot().on('click', SELECTORS.PAGE_LINK, (e) => {
            this.setPage($(e.currentTarget).attr('data-page-index'));
            this.refreshModal();
        });

        this.getRoot().on('click', SELECTORS.NEXT_PAGE, () => {
            const lastPage = $(SELECTORS.PAGE_LINK).last().attr('data-page-index');
            if (this.page == lastPage) return;
            this.setPage(++this.page);
            this.refreshModal();
        });

        this.getRoot().on('click', SELECTORS.PREV_PAGE, () => {
            if (this.page == 0) return;
            this.setPage(--this.page);
            this.refreshModal();
        });

        this.getRoot().on('submit', SELECTORS.SEARCH_FORM, (e) => {
            e.preventDefault();
            this.search = $(SELECTORS.SEARCH_INPUT).val();
            this.setPage(0);
            this.refreshModal();
        });

        this.getRoot().on('click', SELECTORS.SEARCH_CLEAR, () => {
            this.search = '';
            $(SELECTORS.SEARCH_INPUT).val('');
            this.setPage(0);
            this.refreshModal();
        });

        this.getRoot().on('change', SELECTORS.SORT, (e) => {
            e.preventDefault();
            this.setPage(0);
            this.sort = $(e.currentTarget).val();
            this.refreshModal();
        });

        this.getRoot().on('change', SELECTORS.ENTRY_CHECKBOX, (e) => {
            $(SELECTORS.ENTRY_CHECKBOX).not($(e.currentTarget)).prop('checked', false);
            $(SELECTORS.CONFIRM).prop('disabled', !$(e.currentTarget).prop('checked'));

            if ($(e.currentTarget).prop('checked')) {
                const entry = $(e.currentTarget).closest(SELECTORS.ENTRY);
                const entryId = entry.attr('data-entry');
                const entryName = entry.find('.card-title').text();
                const entryThumb = entry.find('img').attr('src');
                this.selectedEntryId = entryId;
                this.selectedEntryName = entryName;
                this.selectedEntryThumb = entryThumb;
            } else {
                this.selectedEntryId = null;
                this.selectedEntryName = null;
                this.selectedEntryThumb = null;
            }
        });

        this.getRoot().on('click', SELECTORS.CONFIRM, () => {
            this.setSelectedEntry(this.selectedEntryId, this.selectedEntryName, this.selectedEntryThumb);
            this.hide();
        });
    }

    setPage(pageIndex) {
        this.page = pageIndex;
        $(SELECTORS.PAGE_ITEM).removeClass('active');
        const pageLinks = $(SELECTORS.PAGE_LINK).filter(`[data-page-index="${pageIndex}"]`);
        pageLinks.each((index, element) => {
            $(element).parent().addClass('active');
        });
    }

    async refreshModal() {
        const promises = Ajax.call([
            KalturaAjax.getVideoPickerData(this.contextid, this.search, this.sort, this.page, this.source),
        ]);
        promises[0]
            .then(response => this.replace(response, TEMPLATES.VIDEO_PICKER_MAIN, SELECTORS.VIDEO_PICKER_MAIN))
            .then(() => $(`[data-entry="${this.selectedEntryId}"]`).find(SELECTORS.ENTRY_CHECKBOX).prop('checked', true))
            .catch(Notification.exception);
        this.loadUntilPromisesDone(SELECTORS.VIDEO_PICKER_MAIN, promises)
            .catch(Notification.exception);
    }

    loadUntilPromisesDone(areaSelector, promises) {
        return Templates.render(TEMPLATES.OVERLAY_LOADING, {})
            .then((html) => {
                const loadingIcon = $(html);
                $(areaSelector).append(loadingIcon);
                loadingIcon.fadeIn(150);

                return $.when(loadingIcon.promise(), Promise.all(promises));
            })
            .then((loadingIcon) => {
                loadingIcon.fadeOut(100);
                loadingIcon.remove();

                return;
            });
    }

    setSelectedEntry(entryid, entryname, entrythumb) {
        $(SELECTORS.ENTRY_ID).val(entryid);
        $(SELECTORS.ENTRY_NAME).val(entryname);
        $(SELECTORS.ENTRY_THUMB).attr('src', entrythumb);
        $(SELECTORS.VIDEO_TITLE).val(entryname);
        getString('selected_entry', 'local_kaltura', entryname)
        .then(string => $(SELECTORS.ENTRY_SELECTED_HDR).text(string));
    }

    replace(data, template, areaSelector) {
        return Templates.render(template, data)
        .then((html, js) => Templates.replaceNodeContents(areaSelector, html, js));
    }

    reset() {
        this.search = '';
        $(SELECTORS.SEARCH_INPUT).val('');
        this.sort = 'recent';
        $(SELECTORS.SORT).prop('selectedIndex', 0);
        this.setPage(0);
        this.source = 1;
    }

    static getType() {
        return 'local_kaltura_modal_video_picker';
    }
}

let registered = false;
if (!registered) {
    ModalRegistry.register(ModalVideoPicker.getType(), ModalVideoPicker, 'local_kaltura/modal_video_picker');
    registered = true;
}

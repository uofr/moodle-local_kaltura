import $ from 'jquery';
import Notification from 'core/notification';
import Templates from 'core/templates';
import {get_string as getString} from 'core/str';
import {publish} from 'core/pubsub';

import Modal from 'core/modal';
import ModalRegistry from 'core/modal_registry';
import ModalEvents from 'core/modal_events';
import ModalVideoPickerEvents from 'local_kaltura/modal_video_picker_events';

import KalturaAjax from 'local_kaltura/kaltura_ajax';

const SELECTORS = {
    VIDEO_PICKER_ENTRY_LIST: '[data-region="video-picker-entry-list"]',
    ENTRY_LIST: '[data-region="entry-list"]',
    ENTRY: '[data-entry]',
    ENTRY_NAME: '[data-region="entry-name"]',
    ENTRY_THUMBNAIL: '[data-region="entry-thumbnail"]',
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
    SELECTED_ENTRY_NAME: '[data-region="selected_entry_name"]'
};

const TEMPLATES = {
    OVERLAY_LOADING: 'core/overlay_loading',
    VIDEO_PICKER_BODY: 'local_kaltura/modal_video_picker_body',
    VIDEO_PICKER_ENTRY_LIST: 'local_kaltura/modal_video_picker_entry_list'
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
        this.selectedEntryThumbnail = null;
    }

    registerEventListeners() {
        super.registerEventListeners();

        this.getRoot().on(ModalEvents.shown, async () => {
            this.renderBody();
            if (this.selectedEntryId && this.selectedEntryName && this.selectedEntryThumbnail) {
                const selectedEntryText = await getString('selected_entry', 'local_kaltura', this.selectedEntryName);
                $(SELECTORS.SELECTED_ENTRY_NAME).text(selectedEntryText);
            }
        });

        this.getRoot().on(ModalEvents.bodyRendered, () => {
            $(`[data-entry="${this.selectedEntryId}"]`).find(SELECTORS.ENTRY_CHECKBOX).prop('checked', true);
        });

        this.getRoot().on(ModalEvents.hidden, () => {
            this.setBody('');
            this.search = '';
            this.sort = 'recent';
            this.page = 0;
            this.source = 1;
            if (this.selectedEntryId && this.selectedEntryName && this.selectedEntryThumbnail) {
                publish(ModalVideoPickerEvents.entrySelected, {
                    entryId: this.selectedEntryId,
                    entryName: this.selectedEntryName,
                    entryThumbnail: this.selectedEntryThumbnail
                });
            }
        });

        this.getRoot().on('click', SELECTORS.CONFIRM, () => {
            this.hide();
        });

        this.getRoot().on('click', SELECTORS.PAGE_LINK, (e) => {
            this.setPage($(e.currentTarget).attr('data-page-index'));
            this.refreshEntryList();
        });

        this.getRoot().on('click', SELECTORS.NEXT_PAGE, () => {
            const lastPage = $(SELECTORS.PAGE_LINK).last().attr('data-page-index');
            if (this.page == lastPage) return;
            this.setPage(++this.page);
            this.refreshEntryList();
        });

        this.getRoot().on('click', SELECTORS.PREV_PAGE, () => {
            if (this.page == 0) return;
            this.setPage(--this.page);
            this.refreshEntryList();
        });

        this.getRoot().on('submit', SELECTORS.SEARCH_FORM, (e) => {
            e.preventDefault();
            this.search = $(SELECTORS.SEARCH_INPUT).val();
            this.setPage(0);
            this.refreshEntryList();
        });

        this.getRoot().on('click', SELECTORS.SEARCH_CLEAR, () => {
            this.search = '';
            $(SELECTORS.SEARCH_INPUT).val('');
            this.setPage(0);
            this.refreshEntryList();
        });

        this.getRoot().on('change', SELECTORS.SORT, (e) => {
            e.preventDefault();
            this.setPage(0);
            this.sort = $(e.currentTarget).val();
            this.refreshEntryList();
        });

        this.getRoot().on('change', SELECTORS.ENTRY_CHECKBOX, async (e) => {
            $(SELECTORS.ENTRY_CHECKBOX).not($(e.currentTarget)).prop('checked', false);
            $(SELECTORS.CONFIRM).prop('disabled', !$(e.currentTarget).prop('checked'));
            const entry = $(e.currentTarget).closest(SELECTORS.ENTRY);
            if ($(e.currentTarget).prop('checked')) {
                this.selectedEntryId = entry.attr('data-entry');
                this.selectedEntryName = entry.find(SELECTORS.ENTRY_NAME).text();
                this.selectedEntryThumbnail = entry.find(SELECTORS.ENTRY_THUMBNAIL).attr('src');
                const selectedEntryText = await getString('selected_entry', 'local_kaltura', this.selectedEntryName);
                $(SELECTORS.SELECTED_ENTRY_NAME).text(selectedEntryText);
            } else {
                this.selectedEntryId = null;
                this.selectedEntryName = null;
                this.selectedEntryThumbnail = null;
                const selectedEntryText = await getString('no_selected_entry', 'local_kaltura');
                $(SELECTORS.SELECTED_ENTRY_NAME).text(selectedEntryText);
            }
        });

    }

    async renderBody() {
        const data = await KalturaAjax.getVideoPickerData(this.contextid, this.search, this.sort, this.page, this.source);
        const renderPromise = Templates.render(TEMPLATES.VIDEO_PICKER_BODY, data);
        this.setBody(renderPromise);
    }

    async refreshEntryList() {
        const promise = KalturaAjax.getVideoPickerData(this.contextid, this.search, this.sort, this.page, this.source)
            .then(response => this.replace(response, TEMPLATES.VIDEO_PICKER_ENTRY_LIST, SELECTORS.VIDEO_PICKER_ENTRY_LIST))
            .then(() => $(`[data-entry="${this.selectedEntryId}"]`).find(SELECTORS.ENTRY_CHECKBOX).prop('checked', true))
            .catch(Notification.exception);

        this.loadUntilPromiseDone(this.getModal(), promise)
            .catch(Notification.exception);
    }

    setPage(pageIndex) {
        this.page = pageIndex;
        $(SELECTORS.PAGE_ITEM).removeClass('active');
        const pageLinks = $(SELECTORS.PAGE_LINK).filter(`[data-page-index="${pageIndex}"]`);
        pageLinks.each((index, element) => {
            $(element).parent().addClass('active');
        });
    }

    loadUntilPromiseDone(area, promise) {
        return Templates.render(TEMPLATES.OVERLAY_LOADING, {})
            .then((html) => {
                const loadingIcon = $(html);
                area.append(loadingIcon);
                loadingIcon.fadeIn(150);

                return $.when(loadingIcon.promise(), promise);
            })
            .then((loadingIcon) => {
                loadingIcon.fadeOut(100);
                loadingIcon.remove();

                return;
            });
    }

    replace(data, template, areaSelector) {
        return Templates.render(template, data)
        .then((html, js) => Templates.replaceNodeContents(areaSelector, html, js));
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

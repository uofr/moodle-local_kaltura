import Templates from 'core/templates';

import Modal from 'core/modal';
import ModalRegistry from 'core/modal_registry';
import ModalEvents from 'core/modal_events';

import KalturaAjax from 'local_kaltura/kaltura_ajax';

const TEMPLATES = {
    BODY: 'local_kaltura/modal_kaltura_view_body'
};

export default class ModalKalturaView extends Modal {

    constructor(root) {
        super(root);
    }

    registerEventListeners() {
        super.registerEventListeners();

        this.getRoot().on(ModalEvents.hidden, () => {
            this.setBody('');
        });
    }

    async renderEntryPlayer(entryid) {
        const player = await KalturaAjax.getEntryPlayer(entryid);
        this.setBody(Templates.render(TEMPLATES.BODY, player));
        this.show();
    }

    static getType() {
        return 'local_kaltura_modal_kaltura_view';
    }

}

let registered = false;
if (!registered) {
    ModalRegistry.register(ModalKalturaView.getType(), ModalKalturaView, 'local_kaltura/modal_kaltura_view');
    registered = true;
}
import $ from 'jquery';
import Notification from 'core/notification';
import {subscribe, publish} from 'core/pubsub';
import {get_strings as getStrings} from 'core/str';
import Templates from 'core/templates';

import ModalFactory from 'core/modal_factory';
import ModalKalturaProgress from 'local_kaltura/modal_kaltura_progress';

import KalturaAjax from 'local_kaltura/kaltura_ajax';
import KalturaUploader from 'local_kaltura/kaltura_uploader';
import KalturaTimer from 'local_kaltura/kaltura_timer';
import KalturaEvents from 'local_kaltura/kaltura_events';

let root;
let stream;
let recorder;
let file;
let constraints = {
    video: {deviceId: undefined},
    audio: {deviceId: undefined}
};

const CSS = {
    HIDDEN: 'hidden',
    ACTIVE: 'active',
    NO_STREAM: 'kaltura-no-stream',
    RECORDING: 'kaltura-recording',
    RECORDING_DONE: 'kaltura-recording-complete'
};

const ERROR = {
    NotAllowedError: {
        title: {key: 'not_allowed_hdr', component: 'local_kaltura'},
        message: {key: 'not_allowed', component: 'local_kaltura'}
    },
    NotFoundError: {
        title: {key: 'not_found_hdr', component: 'local_kaltura'},
        message: {key: 'not_found', component: 'local_kaltura'}
    },
    NotReadableError: {
        title: {key: 'not_readable_hdr', component: 'local_kaltura'},
        message: {key: 'not_readable', component: 'local_kaltura'}
    }
};

const SELECTORS = {
    NAME: '#entry_name',
    TAGS: '#entry_tags',
    DESC: '#entry_desc',
    TERM: '#entry_term',
    STUDENT_CONTENT: '[name="student"]',
    RECORDER: '[data-region="kaltura-recorder"]',
    PREVIEW: '#entry_preview',
    PREVIEW_BUTTON: '[data-action="start-preview"]',
    RECORD_BUTTON: '[data-action="start-recording"]',
    STOP_BUTTON: '[data-action="stop-recording"]',
    TIME: '[data-region="kaltura-recorder-time"]',
    AUDIO_OPTIONS: '[data-region="audio-options"]',
    VIDEO_OPTIONS: '[data-region="video-options"]',
    SWITCH_DEVICE: '[data-action="switch-device"]:not(.active)',
    DEVICE_OPTION: '[data-action="switch-device"]',
    UPLOAD_PART_2: '[data-region="upload-part-2"]'
};

const TEMPLATES = {
    DISMISSABLE_ALERT: 'local_kaltura/kaltura_dismissable_alert',
    DEVICE_OPTIONS: 'local_kaltura/kaltura_device_options'
};

export const init = async (rootSelector) => {
    root = $(rootSelector);
    registerEventListeners();
    startStream();
};

const registerEventListeners = () => {
    subscribe(KalturaEvents.mediaStreamStart, (stream) => {
        previewStream(stream);
        updateDeviceOptions();
    });

    root.on('click', SELECTORS.SWITCH_DEVICE, async (e) => {
        const deviceOption = $(e.currentTarget);
        const deviceType = deviceOption.attr('data-device-type');
        const deviceId = deviceOption.attr('data-device-id');
        deviceOption.parent().find(SELECTORS.DEVICE_OPTION).removeClass(CSS.ACTIVE);
        deviceOption.addClass(CSS.ACTIVE);
        if (deviceType === 'audioinput') {
            constraints.audio.deviceId = deviceId;
        } else if (deviceType === 'videoinput') {
            constraints.video.deviceId = deviceId;
        }
        stopStream();
        await startStream();
    });


    root.on('click', SELECTORS.RECORD_BUTTON, () => {
        if (!stream) return;
        startRecording(stream);
    });

    root.on('click', SELECTORS.PREVIEW_BUTTON, () => {
        startStream();
    });

    root.on('click', SELECTORS.STOP_BUTTON, () => {
        stopRecording();
    });

    root.on('submit', (e) => {
        e.preventDefault();
        upload();
    });

    root.on('reset', () => {
        root.find(SELECTORS.UPLOAD_PART_2).addClass(CSS.HIDDEN);
        root.find(SELECTORS.TERM).prop('disabled', false);
        root.removeClass(CSS.RECORDING_DONE);
        file = null;
        startStream();
    });

    subscribe(KalturaEvents.uploadModalClose, () => {
        if (stream) {
            stopStream();
        }
    });

    root.on('change', SELECTORS.STUDENT_CONTENT, (e) => {
        root.find(SELECTORS.TERM).prop('disabled', $(e.currentTarget).val() === 'Yes');
    });
};

const startStream = async () => {
    try {
        stream = await navigator.mediaDevices.getUserMedia(constraints);
        root.removeClass(CSS.NO_STREAM);
        publish(KalturaEvents.mediaStreamStart, stream);
    } catch (error) {
        root.addClass(CSS.NO_STREAM);
        errorHandler(error);
    }
};

const stopStream = () => {
    const preview = $(SELECTORS.PREVIEW)[0];
    for (const track of stream.getTracks()) {
        track.stop();
    }
    stream = null;
    preview.srcObject = null;
};

const startRecording = (stream) => {
    try {
        recorder = new MediaRecorder(stream);
        recorder.ondataavailable = (e) => {
            stopStream();
            previewVideo(URL.createObjectURL(e.data));
            file = e.data;
            $(SELECTORS.UPLOAD_PART_2).removeClass(CSS.HIDDEN);
        };
        recorder.onstart = () => {
            root.toggleClass(CSS.RECORDING, true);
            $(SELECTORS.UPLOAD_PART_2).toggleClass(CSS.HIDDEN, true);
            KalturaTimer.startTimer(() => {
                updateTime(KalturaTimer.getTime());
            });
        };
        recorder.onstop = () => {
            root.toggleClass(CSS.RECORDING, false);
            root.toggleClass(CSS.RECORDING_DONE, true);
            KalturaTimer.stopTimer();
            updateTime('00:00');
        };
        recorder.onerror = (e) => {
            errorHandler(e.error);
        };
        recorder.start();
    } catch (error) {
        errorHandler(error);
    }
};

const stopRecording = () => {
    recorder.stop();
};

const previewStream = (stream) => {
    const preview = $(SELECTORS.PREVIEW)[0];
    preview.autoplay = true;
    preview.controls = false;
    preview.muted = true;
    if (preview.src) {
        URL.revokeObjectURL(preview.src);
        preview.src = null;
    }
    preview.srcObject = stream;

};

const previewVideo = (url) => {
    const preview = $(SELECTORS.PREVIEW)[0];
    preview.src = url;
    preview.autoplay = false;
    preview.controls = true;
    preview.muted = false;
};

const updateTime = (time) => {
    $(SELECTORS.TIME).text(time);
};

const errorHandler = async (error) => {
    if (!ERROR[error.name]) {
        Notification.exception(error);
        return;
    }
    const [title, message] = await getStrings([
        ERROR[error.name].title,
        ERROR[error.name].message
    ]);
    renderAlert(title, message);
};

const renderAlert = (title, message) => {
    return Templates.render(TEMPLATES.DISMISSABLE_ALERT, {
        title: title,
        message: message
    })
    .then((html, js) => Templates.prependNodeContents(SELECTORS.RECORDER, html, js))
    .catch(Notification.exception);
};

const updateDeviceOptions = async () => {
    const devices = await navigator.mediaDevices.enumerateDevices();
    const audioDevices = devices.filter(device => device.kind === 'audioinput');
    const videoDevices = devices.filter(device => device.kind === 'videoinput');

    console.log(audioDevices);
    console.log(videoDevices);

    Templates.render(TEMPLATES.DEVICE_OPTIONS, {devices: audioDevices})
        .then((html, js) => Templates.replaceNodeContents(SELECTORS.AUDIO_OPTIONS, html, js))
        .catch(Notification.exception);

    Templates.render(TEMPLATES.DEVICE_OPTIONS, {devices: videoDevices})
        .then((html, js) => Templates.replaceNodeContents(SELECTORS.VIDEO_OPTIONS, html, js))
        .catch(Notification.exception);
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
        file: file,
        name: root.find(SELECTORS.NAME).val().trim(),
        tags: root.find(SELECTORS.TAGS).val().trim(),
        desc: root.find(SELECTORS.DESC).val().trim(),
        studentContent: root.find(SELECTORS.STUDENT_CONTENT + ':checked').val(),
        term: root.find(SELECTORS.STUDENT_CONTENT + ':checked').val() === 'Yes' ? '' : root.find(SELECTORS.TERM).val(),
        assessment: 'No'
    };
};
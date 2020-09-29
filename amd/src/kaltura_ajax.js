import Ajax from 'core/ajax';

export default {
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
    }
};

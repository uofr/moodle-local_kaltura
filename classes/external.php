<?php
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
 * External functions for mymedia.
 *
 * @package    local_mymedia
 */

require_once("$CFG->libdir/externallib.php");

defined ('MOODLE_INTERNAL') || die();

class local_kaltura_external extends external_api {

    public static function get_video_picker_data_parameters() {
        return new external_function_parameters([
            'contextid' => new external_value(PARAM_INT),
            'search' => new external_value(PARAM_TEXT),
            'sort' => new external_value(PARAM_TEXT),
            'page' => new external_value(PARAM_INT),
            'source' => new external_value(PARAM_INT),
            'has_ce' => new external_value(PARAM_BOOL)
        ]);
    }

    public static function get_video_picker_data($contextid, $search, $sort, $page, $source, $has_ce) {
        global $PAGE;

        $params = self::validate_parameters(self::get_video_picker_data_parameters(), [
            'contextid' => $contextid,
            'search' => $search,
            'sort' => $sort,
            'page' => $page,
            'source' => $source,
            'has_ce' => $has_ce
        ]);

        $context = context::instance_by_id($params['contextid']);
        self::validate_context($context);

        $renderer = $PAGE->get_renderer('local_kaltura');

        $per_page = \local_kaltura\kaltura_config::entries_per_page();

        if ($params['source'] === 1) {
            $client = \local_kaltura\kaltura_client::get_client('kaltura');
            $client->setKs(\local_kaltura\kaltura_session_manager::get_user_session($client));
        } else if ($params['source'] === 0) {
            $client = \local_kaltura\kaltura_client::get_client('ce');
            $client->setKs(\local_kaltura\kaltura_session_manager::get_user_session_legacy($client));
        }
        $entries = \local_kaltura\kaltura_entry_manager::get_entries($client, $params['search'], $params['sort'], $params['page'], $per_page);
        $client->session->end();

        $entries_renderable = new \local_kaltura\output\kaltura_entries($entries->objects);

        $paging_bar = new \local_kaltura\output\kaltura_paging_bar($entries->totalCount, $per_page, $params['page']);

        $search_result_str = '';
        if ($params['search']) {
            if ($entries->totalCount)
                $search_result_str = get_string('showing_results_for', 'local_kaltura', $params['search']);
            else 
                $search_result_str = get_string('no_results', 'local_kaltura', $params['search']);
        }

        return [
            'entries' => $entries_renderable->export_for_template($renderer),
            'paging_bar' => $paging_bar->export_for_template($renderer),
            'search_result_str' => $search_result_str,
            'source' => $params['source'],
            'has_ce' => $params['has_ce']
        ];
    }

    public static function get_video_picker_data_returns() {
        return new external_single_structure([
            'entries' => new external_multiple_structure(new external_single_structure([
                'thumbnailUrl' => new external_value(PARAM_TEXT),
                'name' => new external_value(PARAM_TEXT),
                'description' => new external_value(PARAM_RAW),
                'id' => new external_value(PARAM_TEXT),
                'createdAt' => new external_value(PARAM_INT),
                'tags' => new external_value(PARAM_TEXT),
                'views' => new external_value(PARAM_INT),
                'duration' => new external_value(PARAM_TEXT),
                'downloadUrl' => new external_value(PARAM_TEXT),
                'entry_ready' => new external_value(PARAM_BOOL),
            ])),
            'paging_bar' => new external_single_structure([
                'has_pages' => new external_value(PARAM_BOOL),
                'pages' => new external_multiple_structure(new external_single_structure([
                    'active' => new external_value(PARAM_BOOL, '', VALUE_OPTIONAL),
                    'page' => new external_value(PARAM_INT, '', VALUE_OPTIONAL),
                    'page_index' => new external_value(PARAM_INT, '', VALUE_OPTIONAL)
                ]))
            ]),
            'search_result_str' => new external_value(PARAM_TEXT, '', VALUE_OPTIONAL),
            'source' => new external_value(PARAM_INT),
            'has_ce' => new external_value(PARAM_BOOL)
        ]);
    }

    public static function get_upload_modal_data_parameters() {
        return new external_function_parameters([
            'contextid' => new external_value(PARAM_INT),
            'type' => new external_value(PARAM_TEXT)
        ]);
    }

    public static function get_upload_modal_data($contextid, $type) {
        global $PAGE;

        $params = self::validate_parameters(self::get_upload_modal_data_parameters(), [
            'contextid' => $contextid,
            'type' => $type
        ]);

        $context = context::instance_by_id($params['contextid']);
        self::validate_context($context);

        $renderer = $PAGE->get_renderer('local_kaltura');

        $terms = new \local_kaltura\output\terms();

        if ($params['type'] === 'capture') {
            $client = \local_kaltura\kaltura_client::get_client('kaltura', 'admin');

            $filter = new KalturaUiConfFilter();
            $filter->nameLike = "KalturaCaptureVersioning";

            $ui_confs = $client->uiConf->listTemplates($filter);

            $config = json_decode($ui_confs->objects[0]->config);
            $windows = $config->win_downloadUrl;
            $osx = $config->osx_downloadUrl;

            $client->session->end();
        }

        return [
            'terms' => $terms->export_for_template($renderer),
            'k_capture_download_link_windows' => $windows,
            'k_capture_download_link_mac' => $osx
        ];
    }

    public static function get_upload_modal_data_returns() {
        return new external_single_structure([
            'terms' => new external_multiple_structure(new external_single_structure([
                'term' => new external_value(PARAM_TEXT),
                'selected' => new external_value(PARAM_BOOL)
            ])),
            'k_capture_download_link_windows' => new external_value(PARAM_URL, '', VALUE_OPTIONAL),
            'k_capture_download_link_mac' => new external_value(PARAM_URL, '', VALUE_OPTIONAL)
        ]);
    }

    public static function get_upload_credentials_parameters() {
        return new external_function_parameters([]);
    }

    public static function get_upload_credentials() {
        global $USER;

        self::validate_parameters(self::get_upload_credentials_parameters(), []);

        $client = \local_kaltura\kaltura_client::get_client();

        return [
            'serverhost' => \local_kaltura\kaltura_config::get_host(),
            'ks' => \local_kaltura\kaltura_session_manager::get_user_session($client),
            'categoryid' => \local_kaltura\kaltura_config::get_root_category_id(),
            'creatorid' => $USER->username,
            'metadataid' => \local_kaltura\kaltura_config::get_metadata_id()
        ];
    }

    public static function get_upload_credentials_returns() {
        return new external_single_structure([
            'serverhost' => new external_value(PARAM_TEXT),
            'ks' => new external_value(PARAM_TEXT),
            'categoryid' => new external_value(PARAM_INT),
            'creatorid' => new external_value(PARAM_TEXT),
            'metadataid' => new external_value(PARAM_INT)
        ]);
    }

    public static function get_entry_parameters() {
        return new external_function_parameters([
            'contextid' => new external_value(PARAM_INT),
            'entryid' => new external_value(PARAM_TEXT)
        ]);
    }

    public static function get_entry($contextid, $entryid) {
        global $PAGE;

        $params = self::validate_parameters(self::get_entry_parameters(), [
            'contextid' => $contextid,
            'entryid' => $entryid
        ]);

        $context = context::instance_by_id($params['contextid']);
        self::validate_context($context);

        $client = \local_kaltura\kaltura_client::get_client();
        $client->setKs(\local_kaltura\kaltura_session_manager::get_user_session($client));
        $entry = \local_kaltura\kaltura_entry_manager::get_entry($client, $params['entryid']);
        $client->session->end();

        $renderer = $PAGE->get_renderer('local_kaltura');
        $entry_renderable = new \local_kaltura\output\kaltura_entry($entry->objects[0]);

        return $entry_renderable->export_for_template($renderer);
    }

    public static function get_entry_returns() {
        return new external_single_structure([
            'thumbnailUrl' => new external_value(PARAM_TEXT),
            'name' => new external_value(PARAM_TEXT),
            'description' => new external_value(PARAM_RAW),
            'id' => new external_value(PARAM_TEXT),
            'createdAt' => new external_value(PARAM_INT),
            'tags' => new external_value(PARAM_TEXT),
            'views' => new external_value(PARAM_INT),
            'duration' => new external_value(PARAM_TEXT),
            'downloadUrl' => new external_value(PARAM_TEXT),
            'entry_ready' => new external_value(PARAM_BOOL)
        ]);
    }

    public static function get_entry_player_parameters() {
        return new external_function_parameters([
            'entryid' => new external_value(PARAM_TEXT)
        ]);
    }

    public static function get_entry_player($entryid) {
        $params = self::validate_parameters(self::get_entry_player_parameters(), ['entryid' => $entryid]);

        $client = \local_kaltura\kaltura_client::get_client();
        $client->setKs(\local_kaltura\kaltura_session_manager::get_admin_session($client));

        $client_legacy = \local_kaltura\kaltura_client::get_client('ce');
        $client_legacy->setKs(\local_kaltura\kaltura_session_manager::get_admin_session_legacy($client_legacy));

        $entry = \local_kaltura\kaltura_entry_manager::get_entry($client, $params['entryid'], false);
        if ($entry->totalCount) {
            $player = \local_kaltura\kaltura_player::get_player($entry->objects[0]);
        } else {
            $entry = \local_kaltura\kaltura_entry_manager::get_entry($client_legacy, $params['entryid'], false);
            $player = \local_kaltura\kaltura_player::get_player_legacy($entry->objects[0]);
        }

        $client->session->end();
        $client_legacy->session->end();

        return [
            'player' => $player
        ];
    }

    public static function get_entry_player_returns() {
        return new external_single_structure([
            'player' => new external_value(PARAM_RAW)
        ]);
    }

}

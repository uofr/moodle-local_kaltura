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
 * My Media display library
 *
 * @package    local_kaltura
 * @subpackage kaltura
 * @copyright  (C) 2016-2017 Yamaguchi University <info-cc@ml.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(dirname(dirname(dirname(__FILE__))) . '/lib/tablelib.php');

/**
 * Renderer class of local_yukaltura
 * @package local_yukaltura
 * @copyright  (C) 2016-2017 Yamaguchi University <gh-cc@mlex.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class local_kaltura_renderer extends \plugin_renderer_base {

    /**
     * This function outputs a table layout for display media
     *
     * @param array $medialist - array of Kaltura media entry objects
     *
     * @return string - HTML markup for media table
     */
    public function create_media_table($medialist = array()) {

        $output      = '';
        $maxcolumns = 3;

        $table = new html_table();

        $table->id = 'selector_media';
        $table->size = array('25%', '25%', '25%');
        $table->colclasses = array('column 1', 'column 2', 'column 3');

        $table->align = array('center', 'center', 'center');
        $table->data = array();

        $i = 0;
        $x = 0;
        $data = array();
        
        $output .= '<div class="container-fluid">';

		$output .= '<div class="row">';
        foreach ($medialist as $key => $media) {
            if (KalturaEntryStatus::READY == $media->status) {
                $output .= $this->create_media_entry_markup($media, true);
            } else {
                $output .= $this->create_media_entry_markup($media, false);
            }
			
			if ($x==2) {
                $output .= '</div>';
                $output .= '<div class="row">';
				$x=0;
			} else $x++;
        }

		$output .= '</div>';
		
        echo $output;
    }

    /**
     * This function creates HTML markup used to sort the media listing.
     * @return string - HTML markup for sorting pulldown.
     */
    public function create_sort_option() {
        global $SESSION;

        $recent = null;
        $old = null;
        $nameasc = null;
        $namedesc = null;
        $sorturl = new moodle_url('/local/kaltura/simple_selector.php?sort=');

        if (isset($SESSION->selectorsort) && !empty($SESSION->selectorsort)) {
            $sort = $SESSION->selectorsort;
            if ($sort == 'recent') {
                $button_text = get_string('mostrecent', 'local_kaltura');
            } else if ($sort == 'old') {
                $button_text = get_string('oldest', 'local_kaltura');
            } else if ($sort == 'name_asc') {
               $button_text = get_string('medianameasc', 'local_kaltura');
            } else if ($sort == 'name_desc') {
                $button_text = get_string('medianamedesc', 'local_kaltura');
            } else {
                $button_text = get_string('recent', 'local_kaltura');
            }
        } else {
           $button_text = get_string('recent', 'local_kaltura');
        }

        $sort = '';

        $sort .= html_writer::start_tag('div', ['class' => 'btn-group mr-2']);

        $sort .= html_writer::tag('button', $button_text, ['class' => 'btn btn-secondary']);
        $sort .= html_writer::tag('button', '', ['class' => 'dropdown-toggle dropdown-toggle-split btn btn-secondary', 'data-toggle' => 'dropdown']);
        
        $sort .= html_writer::start_tag('div', ['class' => 'dropdown-menu dropdown-menu-right']);
        $sort .= html_writer::tag('a', get_string('mostrecent', 'local_kaltura'), ['class' => 'dropdown-item', 'href' => $sorturl . '=recent']);
        $sort .= html_writer::tag('a', get_string('oldest', 'local_kaltura'), ['class' => 'dropdown-item', 'href' => $sorturl . '=old']);
        $sort .= html_writer::tag('a', get_string('medianameasc', 'local_kaltura'), ['class' => 'dropdown-item', 'href' => $sorturl . '=name_asc']);
        $sort .= html_writer::tag('a', get_string('medianamedesc', 'local_kaltura'), ['class' => 'dropdown-item', 'href' => $sorturl . '=name_desc']);
        $sort .= html_writer::end_tag('div');

        $sort .= html_writer::end_tag('div');
       
        return $sort;
    }


    /**
     * This function creates HTML markup used to display table upper options.
     *
     * @param string $page - HTML text (paging markup).
     * @return string - HTML text added sorting pulldown.
     */
    public function create_options_table_upper($page) {
        global $USER;
        $context = context_user::instance($USER->id);

        $output = '';

        $output .= html_writer::start_tag('div', ['class' => 'container-fluid']);

        // search
        if (has_capability('local/mymedia:search', $context, $USER)) {
            $output .= html_writer::tag('div', $this->create_search_markup(), ['class'=>'mb-3']);
        }

        // sort and layout

        if (isset($_COOKIE["ss-sort-style"]) && $_COOKIE["ss-sort-style"] == 'grid') {
            $gridActive = ' active';
            $listActive = '';
        }
        else {
            $gridActive = '';
            $listActive = ' active';
        }

        $output .= html_writer::start_tag('div');
        $output .= $this->create_sort_option();
        $output .= '<a href="#" id="ss-sortlist" class="btn btn-secondary mr-2'.$listActive.'" title="View as list"><i class="fa fa-th-list" aria-hidden="true"></i></a>';
        $output .= '<a href="#" id="ss-sortgrid" class="btn btn-secondary'.$gridActive.'" title="View as grid"><i class="fa fa-th" aria-hidden="true"></i></a>';
        $output .= html_writer::end_tag('div');

        // page
        $output .= html_writer::start_tag('div', ['class' => 'row']);
        $output .= html_writer::start_tag('div', ['class' => 'col-sm-12']);
        if (!empty($page)) {
            $output .= html_writer::start_tag('div', ['class' => 'float-right']);
            $output .= $page;
            $output .= html_writer::end_tag('div');
        }
        $output .= html_writer::end_tag('div');
        $output .= html_writer::end_tag('div');


        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');

        return $output;
    }

    /**
     * This function creates HTML markup used to display table lower options.
     *
     * @param string $page - HTML text (paging markup).
     * @return string - HTML markup for sorting pulldown.
     */
    public function create_options_table_lower($page) {

        $output = '';

        $output .= html_writer::start_tag('div', array('class' => 'float-right'));

        $output .= $page;

        $output .= html_writer::end_tag('div');

        return $output;
    }

    /**
     * This function creates HTML markup used to display the media name
     *
     * @param string $name - name of media entry.
     *
     * @return string - HTML markup for media name part.
     */
    public function create_media_name_markup($name) {

        $output = '';
        $attr = array('class' => 'selector kmedia name',
                        'title' => $name);

        $output .= html_writer::start_tag('div', $attr);
        $output .= html_writer::tag('label', $name);
        $output .= html_writer::end_tag('div');

        return $output;
    }

    /**
     * This function creates HTML markup used to display the media thumbnail
     *
     * @param string $url - thumbnail URL
     * @param string $alt - alternate text
     * @param string $entryid - id of Kaltura Media entry.
     *
     * @return string - HTML markup
     */
    public function create_media_thumbnail_markup($url, $alt, $entryid) {

        $output = '';

        $attr   = array('class' => 'kmedia kthumbnail');
        $output .= html_writer::start_tag('div', $attr);

        $attr    = array('src' => $url . '/width/120/height/80/type/3',
                         'class' => 'media_thumbnail',
                         'id' => 'th_'.$entryid,
                         'alt' => $alt,
                         'height' => '80',
                         'width'  => '120',
                         'title' => $alt);

        $output .= html_writer::empty_tag('img', $attr);

        $output .= html_writer::end_tag('div');

        return $output;
    }

    /**
     * This function creates HTML markup used to display the media created daytime.
     *
     * @param string $date - name of media
     *
     * @return string - HTML markup
     */
    public function create_media_created_markup($date) {

        $output = '';
        $attr = array('class' => 'selector kmedia created',
                      'title' => userdate($date));

        $output .= html_writer::start_tag('div', $attr);
        $output .= html_writer::tag('label', userdate($date));
        $output .= html_writer::end_tag('div');

        return $output;
    }

    /**
     * This function creates HTML markup for a media entry
     *
     * @param obj $entry - Kaltura media object
     * @param bool $entryready - true if entry is ready,
     *
     * @return string - HTML Markup for media entry.
     */
    public function create_media_entry_markup($entry, $entryready = true) {

        $output = '';

		$mm_entry_span = '';

        if (isset($_COOKIE["ss-sort-style"])&&$_COOKIE["ss-sort-style"]=='grid') {
			$mm_entry_span = ' col-sm-4';
		} else {
			$mm_entry_span = ' col-sm-12';
		}

        $attr   = array('class' => 'mymedia mm-media selector kmedia entry'. $mm_entry_span,
                        'id' => $entry->id);

        $output .= html_writer::start_tag('div', $attr);
        

        $originalurl = $entry->thumbnailUrl;

        $httppattern = '/^http:\/\/[A-Za-z0-9\-\.]{1,61}\//';
        $httpspattern = '/^https:\/\/[A-Za-z0-9\-\.]{1,61}\//';

        $replace = local_kaltura_get_host() . '/';

        $modifiedurl = preg_replace($httpspattern, $replace, $originalurl, 1, $count);
        if ($count != 1) {
            $modifiedurl = preg_replace($httppattern, $replace, $originalurl, 1, $count);
            if ($count != 1) {
                $modifiedurl = $originalurl;
            }
        }
		
		if (isset($_COOKIE["ss-sort-style"])&&$_COOKIE["ss-sort-style"]=='grid') {
			$thumbspan = 'col-sm-12';
			$entryspan = 'col-sm-12';
		} else {
			$thumbspan = 'col-sm-4';
			$entryspan = 'col-sm-8';
		}
        
        $attr = array('class' => 'row');
        $output .= html_writer::start_tag('div', $attr);
        
		$output .= '<div class="mm-thumb-grp '.$thumbspan.'">';
		
        if ($entryready) {

            $output .= $this->create_media_thumbnail_markup($modifiedurl,
                                                            $entry->name, $entry->id);
        } else {

            $output .= $this->create_media_thumbnail_markup($modifiedurl,
                                                            $entry->name, $entry->id);
        }

        $output .= html_writer::end_tag('div');
		
        $attr = array('id' => 'meta_'. $entry->id, 'class' => 'mm-entry-grp '.$entryspan);
        $output .= html_writer::start_tag('div', $attr);
		
        $attr = array('id' => 'name_'. $entry->id);
        $output .= html_writer::start_tag('div', $attr);
        $output .= html_writer::tag('h7', $entry->name, null);
		$output .= html_writer::end_tag('div');
		
		$dateformat = '%b %e, %Y %I:%M %p';
		
		$output .= '<small title="Entry ID"><i class="fa fa-hashtag" aria-hidden="true"></i> ' . $entry->id . '</small> <br/>
			<small title="Uploaded"><i class="fa fa-clock-o" aria-hidden="true" title="Uploaded"></i> '.userdate($entry->createdAt, $dateformat).'</small>';
				
        $output .= html_writer::end_tag('div');
		
        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');

        // Add entry to cache.
        KalturaStaticEntries::addEntryObject($entry);
        return $output;

    }

    /**
     * This function creates HTML markup for a search tool box.
     *
     * @return string - HTML markup for search tool box.
     */
    public function create_search_markup() {
        global $SESSION;

        $output = '';

        $output .= html_writer::start_tag('form', ['action' => new moodle_url('/local/kaltura/simple_selector.php'), 'method' => 'post']);

        $output .= html_writer::start_tag('div', ['class' => 'input-group']);

        $attr = array('type' => 'hidden',
                      'id' => 'sesskey_id',
                      'name' => 'sesskey',
                      'value' => sesskey());
        $output .= html_writer::empty_tag('input', $attr);
        
        $defaultvalue = (isset($SESSION->selector) && !empty($SESSION->selector)) ? $SESSION->selector : '';
        $attr = array('type' => 'text',
                      'id' => 'simple_search',
                      'class' => 'form-control expanding-search',
                      'name' => 'simple_search_name',
                      'value' => $defaultvalue,
                      'placeholder' => get_string('search', 'local_kaltura'),
                      'title' => get_string('search_text_tooltip', 'local_kaltura'),
                      'style' => 'display: inline;');
        $output .= html_writer::empty_tag('input', $attr);

        $attr = array('type' => 'submit',
                      'id'   => 'simple_search_btn',
                      'name' => 'simple_search_btn_name',
                      'value' => get_string('search', 'local_kaltura'),
                      'class' => 'btn btn-primary',
                      'title' => get_string('search', 'local_kaltura'));
        $output .= html_writer::start_tag('button', $attr);
        $output .= html_writer::tag('i', '', ['class' => 'fa fa-search']);
        $output .= html_writer::end_tag('button');
        
        $attr   = array('type' => 'submit',
                        'id'   => 'clear_simple_search_btn',
                        'name' => 'clear_simple_search_btn_name',
                        'value' => get_string('search_clear', 'local_kaltura'),
                        'class' => 'btn btn-secondary',
                        'title' => get_string('search_clear', 'local_kaltura'));
        $output .= html_writer::empty_tag('input', $attr);

        $output .= html_writer::end_tag('div');


        $output .= html_writer::end_tag('form');

        return $output;
    }

    /**
     * This function creates HTML markup for loading screen.
     *
     * @return string - HTML markup for loading screen.
     */
    public function create_loading_screen_markup() {

        $output = '';

        $attr = array('id' => 'wait');
        $output .= html_writer::start_tag('div', $attr);

        $attr = array('class' => 'hd');
        $output .= html_writer::tag('div', '', $attr);

        $attr = array('class' => 'bd');

        $output .= html_writer::tag('div', '', $attr);

        $output .= html_writer::end_tag('div');

        return $output;
    }

    /**
     * This function creates HTML markup for selected media name, submit button, and cancel button.
     *
     * @return string - HTML markup for selected media name, submit button, and cancel button.
     */
    public function create_selector_submit_form() {

        $output = '<div class="kmr-selectbar container-fluid"><div class="kmr-selected row">';

		$output .= '<div class="col-sm-2">';
        $output .= '<p>Selected Media:</p>';
				
        $output .= '<p><img src="pix/vidThumb.png" id="kmr_selected_thumb" class="kmr-selected-thumbnail" height="80" width="120" /></p>';
        $output .= '</div>';
        
        $output .= '<div class="col-sm-10">';  
                
        $attr = array('id' => 'select_name', 'name' => 'select_name');
        $output .= html_writer::start_tag('h6', $attr);
        $output .= 'Please make a selection';
        $output .= html_writer::end_tag('h6');
                        
        $output .= '</div>';
        $output .= '</div>';

        $attr = array('type' => 'hidden', 'id' => 'select_id', 'name' => 'select_id', 'value' => '');
        $output .= html_writer::empty_tag('input', $attr);

        $attr = array('type' => 'hidden', 'id' => 'select_thumbnail', 'name' => 'select_thumbnail', 'value' => '');
        $output .= html_writer::empty_tag('input', $attr);

		$attr = array();
        $output .= html_writer::start_tag('div', $attr);

        $attr = array('type' => 'button', 'id' => 'submit_btn', 'name' => 'submit_btn',
                      'value' => 'OK', 'disabled' => 'true');
        $output .= html_writer::empty_tag('input', $attr);


        $attr = array('type' => 'button', 'id' => 'cancel_btn', 'name' => 'cancel_btn',
                      'value' => 'Cancel');
        $output .= html_writer::empty_tag('input', $attr);

        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');

        return $output;
    }

    /**
     * This function creates HTML markup used to display media properties.
     *
     * @return string - HTML markup for media properties.
     */
    public function create_properties_markup() {
        $output = '';

        // Panel markup to set media properties.

        $attr = array('class' => 'hd');
        $output .= html_writer::tag('div', '<center>' . get_string('media_prop_header', 'local_kaltura') . '</center>', $attr);
        $output .= html_writer::start_tag('br', array());

        $attr = array('class' => 'bd');

        $propertiesmarkup = $this->get_media_preferences_markup();

        $output .= html_writer::tag('div', $propertiesmarkup, $attr);

        $output .= html_writer::start_tag('br', array());

        $output .= $this->create_properties_submit_markup();

        return $output;
    }

    /**
     * Create player properties panel markup.  Default values are loaded from
     * the javascript (see function "handle_cancel" in kaltura.js
     *
     * @return string - HTML markup of media preferences.
     */
    public function get_media_preferences_markup() {
        $output = '';

        // Display section element for player design.
        $output .= html_writer::start_tag('div', ['class' => 'form-inline']);
        $attr = array('for' => 'media_prop_player');
        $output .= html_writer::tag('label', get_string('media_prop_player', 'local_kaltura'), $attr);
        $output .= '&nbsp;';

        list($options, $defaultoption) = $this->get_media_resource_players();

        $attr = array('id' => 'media_prop_player', 'class' => 'form-control');
        $output .= html_writer::select($options, 'media_prop_player', $defaultoption, false, $attr);
        $output .= html_writer::end_tag('div');

        // Display player size drop down button.
        $output .= html_writer::start_tag('div', ['class' => 'form-inline']);
        
        $attr = array('for' => 'media_prop_size');
        $output .= html_writer::tag('label', get_string('media_prop_size', 'local_kaltura'), $attr);
        $output .= '&nbsp;';

        $options = array(0 => get_string('media_prop_size_large', 'local_kaltura'),
                         1 => get_string('media_prop_size_small', 'local_kaltura'),
                         2 => get_string('media_prop_size_custom', 'local_kaltura')
                         );

        $attr = array('id' => 'media_prop_size');
        $selected = !empty($defaults) ? $defaults['media_prop_size'] : array();

        $output .= html_writer::select($options, 'media_prop_size', $selected, array(), $attr);

        // Display custom player size.
        $output .= '&nbsp;&nbsp;';

        $attr = array('type' => 'text',
                      'id' => 'media_prop_width',
                      'name' => 'media_prop_width',
                      'class' => 'form-control',
                      'value' => '',
                      'maxlength' => '4',
                      'size' => '4'
                      );
        $output .= html_writer::empty_tag('input', $attr);

        $output .= '&nbsp;x&nbsp;';

        $attr = array('type' => 'text',
                      'id' => 'media_prop_height',
                      'name' => 'media_prop_height',
                      'class' => 'form-control',
                      'value' => '',
                      'maxlength' => '4',
                      'size' => '4'
                      );
        $output .= html_writer::empty_tag('input', $attr);

        $output .= html_writer::end_tag('div');

        $output .= html_writer::tag('span', '* ' . get_string('custom_size_info', 'local_kaltura'), ['id' => 'custom_size_info', 'class' => 'form-text', 'style' => 'display: none;']);

        return $output;
    }

    /**
     * This function returns an array of media resource players.
     *
     * If the override configuration option is checked, then this function will
     * only return a single array entry with the overridden player
     *
     * @return array - First element will be an array whose keys are player ids
     * and values are player name.  Second element will be the default selected
     * player.  The default player is determined by the Kaltura configuraiton
     * settings (local_kaltura).
     */
    public function get_media_resource_players() {

        // Get user's players.
        $players = local_kaltura_get_custom_players();

        // Kaltura regular player selection.
        $choices = array(KALTURA_PLAYER_PLAYERREGULARDARK  => get_string('player_regular_dark', 'local_kaltura'),
                         KALTURA_PLAYER_PLAYERREGULARLIGHT => get_string('player_regular_light', 'local_kaltura'),
                         );

        if (!empty($players)) {
            $choices = $choices + $players;
        }

        // Set default player only if the user is adding a new activity instance.
        $defaultplayerid = local_kaltura_get_player_uiconf('player_resource');

        // If the default player id does not exist in the list of choice.
        // Then the user must be using a custom player id, add it to the list.
        if (!array_key_exists($defaultplayerid, $choices)) {
            $choices = $choices + array($defaultplayerid => get_string('custom_player', 'local_kaltura'));
        }

        // Check if player selection is globally overridden.
        if (local_kaltura_get_player_override()) {
            return array(array( $defaultplayerid => $choices[$defaultplayerid]),
                         $defaultplayerid
                        );
        }

        return array($choices, $defaultplayerid);
    }

    /**
     * This function creates HTML markup used to display properties submit block.
     *
     * @return string - HTML markup for propertied submit block.
     */
    public function create_properties_submit_markup() {
        $output = '';

        $attr = array('border' => '0', 'align' => 'right', 'cellpadding' => '0');
        $output .= html_writer::start_tag('table', $attr);

        $output .= html_writer::start_tag('tr', array());

        $output .= html_writer::start_tag('td', array());

        $attr = array('type' => 'button', 'class'=>'btn btn-primary mr-2', 'id' => 'prop_submit_btn', 'name' => 'prop_submit_btn',
                      'value' => 'OK');
        $output .= html_writer::empty_tag('input', $attr);

        $output .= html_writer::end_tag('td');

        $output .= html_writer::start_tag('td', array());

        $output .= html_writer::end_tag('td');

        $output .= html_writer::end_tag('tr');

        $output .= html_writer::end_tag('table');

        return $output;

    }

    /**
     * This function creates HTML markup used to display no permission message.
     *
     * @return string - HTML markup for no permission message.
     */
    public function create_permission_message() {
        $output = '';

        $output .= html_writer::start_tag('center');

        $output .= get_string('permission_disable', 'local_kaltura');

        $output .= html_writer::empty_tag('br');
        $output .= html_writer::empty_tag('br');

        $attr = array('type' => 'button',
                      'name' => 'faedeout',
                      'id' => 'fadeout',
                      'value' => 'Close'
                     );

        $output .= html_writer::empty_tag('input', $attr);

        $output .= html_writer::end_tag('center');

        return $output;
    }

    public function create_selector_modal() {
        $href = new \moodle_url('/local/kaltura/simple_selector.php');
        $title = get_string('pluginname', 'local_mymedia');
        $footer = '';
        $footer .= '<button id="selector_submit" class="btn btn-primary" data-dismiss="modal">'.get_string('confirm', 'core').'</button>';
        $footer .= '<button class="btn btn-secondary" data-dismiss="modal">'.get_string('cancel', 'core').'</button>';
        return $this->create_iframe_modal('selector_modal', $href, $title, $footer);
    }

    public function create_upload_modal() {
        $href = new \moodle_url('/local/mymedia/simple_uploader.php', ['embedded'=>1]);
        $title = get_string('nav_upload', 'local_mymedia');
        $footer = '';
        $footer .= '<button class="btn btn-primary" data-dismiss="modal">'.get_string('simple_upload', 'local_mymedia').'</button>';
        $footer .= '<button class="btn btn-secondary" data-dismiss="modal">'.get_string('cancel', 'core').'</button>';
        return $this->create_iframe_modal('upload_modal', $href, $title, $footer);
    }

    public function create_record_modal() {
        $href = new \moodle_url('/local/mymedia/webcam_uploader.php', ['embedded'=>1]);
        $title = get_string('webcam_upload', 'local_mymedia');
        $footer = '';
        $footer .= '<button class="btn btn-primary">'.get_string('simple_upload', 'local_mymedia').'</button>';
        $footer .= '<button class="btn btn-secondary" data-dismiss="modal">'.get_string('cancel', 'core').'</button>';
        return $this->create_iframe_modal('record_modal', $href, $title, $footer);
    }

    /**
     * @param string $id - Modal ID.
     * @param \moodle_url $href - Link to iframe page.
     * @param string $title - Modal title.
     * @param string $footer - HTML markup that appears inside footer.
     * @return string - Modal HTML markup.
     */
    private function create_iframe_modal(string $id, \moodle_url $href, string $title, string $footer) {
        $output = '';

        $output .= '<div id="'.$id.'" class="modal">';
        $output .= '<div class="modal-dialog modal-dialog-scrollable modal-lg">';
        $output .= '<div class="modal-content">';

        $output .= '<div class="modal-header">';
        $output .= '<h5>'.$title.'</h5>';
        $output .= '<button class="close" data-dismiss="modal">&times;</button>';
        $output .= '</div>';

        $output .= '<div class="modal-body embed-responsive embed-responsive-1by1">';
        $output .= '<iframe src="'.$href.'"></iframe>';
        $output .= '</div>';

        $output .= '<div class="modal-footer">';
        $output .= $footer;
        $output .= '</div>';

        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }

    public function create_progress_modal() {
        $output = '';

        $output .= '<div id="kaltura_upload_modal" class="modal">';
        $output .= '<div class="modal-dialog">';
        $output .= '<div class="modal-content">';

        $output .= '<div class="modal-header">';
        $output .= '<h5>'.get_string('video_uploading', 'local_kaltura').'</h5>';
        $output .= '</div>';

        $output .= '<div class="modal-body">';
        $output .= '<p>'.get_string('video_uploading_body', 'local_kaltura').'</p>';
        $output .= '<div class="progress">';
        $output .= '<div id="kaltura_upload_progress" class="progress-bar"></div>';
        $output .= '</div>';
        $output .= '</div>';

        $output .= '<div class="modal-footer" style="opacity:0">';
        $output .= '<button class="btn btn-primary" data-dismiss="modal">Upload Another</button>';
        $output .= '<a class="btn btn-secondary" href='.new \moodle_url('/local/mymedia/mymedia.php').'>Done</a>';
        $output .= '</div>';

        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }

}

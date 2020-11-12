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
 * Local libraries of Kaltura Media package
 *
 * @package    local_kaltura
 * @subpackage kaltura
 * @copyright  (C) 2016-2017 Yamaguchi University <info-cc@ml.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once(dirname(__FILE__) . '/API/KalturaClient.php');
require_once(dirname(__FILE__) . '/kaltura_entries.class.php');

require_once($CFG->dirroot.'/mod/lti/locallib.php');

defined('MOODLE_INTERNAL') || die();

/**
 * KALTURA_PLUGIN_NAME - local plugin name.
 */
define('KALTURA_PLUGIN_NAME', 'local_kaltura');

/**
 * KALTURA_DEFAULT_URI - URL of Kaltura SaaS Edition.
 */
define('KALTURA_DEFAULT_URI', 'http://www.kaltura.com');

/**
 * KALTURA_REPORT_DEFAULT_URI - Report page URL of Kaltura SaaS Edition.
 */
define('KALTURA_REPORT_DEFAULT_URI', 'http://apps.kaltura.com/hosted_pages');

/**
 * KALTURA_PLAYER_PLAYERREGULARDARK - UiConf id of KDP dark.
 */
define('KALTURA_PLAYER_PLAYERREGULARDARK', 6709411);

/**
 * KALTURA_PLAYER_PLAYERREGULARLIGHT - UiConf id of KDP light.
 */
define('KALTURA_PLAYER_PLAYERREGULARLIGHT', 6709421);

/**
 * KALTURA_PLAYER_PLAYERMEDIAPRESENTATION - UiConf Kaltura Media Presentation.
 */
define('KALTURA_PLAYER_PLAYERMEDIAPRESENTATION', 4860481);

/**
 * KALTURA_ASSIGN_MEDIA_WIDTH - Player width of Kaltura Media Assignment.
 */
 define('KALTURA_ASSIGN_MEDIA_WIDTH', 400);

/**
 * KALTURA_ASSIGN_MEDIA_HEIGHT - Player height of Kaltura Media Assignment.
 */
define('KALTURA_ASSIGN_MEDIA_HEIGHT', 365);

/**
 * KALTURA_ASSIGN_POPUP_MEDIA_WIDTH - Pop up Player width of Kaltura Media Assignment.
 */
define('KALTURA_ASSIGN_POPUP_MEDIA_WIDTH', 500);

/**
 * KALTURA_ASSIGN_POPUP_MEDIA_WIDTH - Pop up Player height of Kaltura Media Assignment.
 */
define('KALTURA_ASSIGN_POPUP_MEDIA_HEIGHT', 460);

/**
 * YUI panel popup border adjustment to make the embedded video look centered.
 */
define('KALTURA_POPUP_WIDTH_ADJUSTMENT', 30);

/**
 * YUI panel popup border adjustment to make the embedded video look centered.
 */
define('KALTURA_POPUP_HEIGHT_ADJUSTMENT', 50);

/**
 * Time lengh (sec) of Kaltura Session.
 */
define('KALTURA_SESSION_LENGTH', 10800); // Three hours.

/**
 * Label of Access Restriction.
 */
define('KALTURA_IPADDRESS_ANY', 'ANY');

/**
 * Label of Access Restriction.
 */
define('KALTURA_IPADDRESS_INT', 'INTERNAL');

/**
 * Moodle database key name of acess control (internal).
 */
define('KALTURA_INTERNAL_ACCESS_CONFIG_NAME', 'access_control_internal_id');

/**
 * Moodle database key name of acess control.
 */
define('KALTURA_INTERNAL_ACCESS_CONTROL_NAME', 'Internal Access');

/**
 * Access control (internal only) description for Kaltura Server.
 */
define('KALTURA_INTERNAL_ACCESS_CONTROL_DESC', 'Access conrtorl for internal only');

/**
 * Access control (inetrnal only) system name for Kaltura Server.
 */
define('KALTURA_INTERNAL_ACCESS_CONTROL_SYSTEM_NAME', 'moodleprofile');

/**
 * Access control (inetrnal only) name for Kaltura Server.
 */
define('KALTURA_DEFAULT_ACCESS_CONTROL_NAME', 'Default');

/**
 * Access control (default) name for Kaltura Server.
 */
define('KALTURA_DEFAULT_ACCESS_CONTROL_DESC', 'Default access control profile');

/**
 * Access control (default) system name for Kaltura Server.
 */
define('KALTURA_DEFAULT_ACCESS_CONTROL_SYSTEM_NAME', 'Default');

/**
 * Moodle database key name of acess control (default).
 */
define('KALTURA_DEFAULT_ACCESS_CONFIG_NAME', 'acecss_control_default_id');

/**
 * Image width for desktop theme.
 */
define('KALTURA_IMAGE_DESKTOP_WIDTH', 640);

/**
 * Image height for desktop theme.
 */
define('KALTURA_IMAGE_DESKTOP_HEIGHT', 480);

/**
 * Image width for mobile theme.
 */
define('KALTURA_IMAGE_MOBILE_WIDTH', 320);

/**
 * Image height for mobile theme.
 */
define('KALTURA_IMAGE_MOBILE_HEIGHT', 240);



/**
 * KALTURA_PLAYER_PLAYERAUDIO - UiConf id of audio player.
 */
define('KALTURA_PLAYER_PLAYERAUDIO', 11170258); // UofR Audio player


/**
 * KALTURA_FILTER_VIDEO_WIDTH - default width for video player.
 */
define('KALTURA_FILTER_VIDEO_WIDTH', 400);

/**
 * KALTURA_FILTER_VIDEO_HEIGHT - default height for video player.
 */

define('KALTURA_FILTER_VIDEO_HEIGHT', 300);



//define('KALTURA_PLUGIN_NAME', 'local_kaltura');
//define('KALTURA_DEFAULT_URI', 'www.kaltura.com');
//define('KALTURA_REPORT_DEFAULT_URI', 'http://apps.kaltura.com/hosted_pages');
define('KAF_MYMEDIA_MODULE', 'mymedia');
define('KAF_MEDIAGALLERY_MODULE', 'coursegallery');
define('KAF_BROWSE_EMBED_MODULE', 'browseembed');
define('KAF_MYMEDIA_ENDPOINT', 'hosted/index/my-media');
define('KAF_MEDIAGALLERY_ENDPOINT', 'hosted/index/course-gallery');
define('KAF_BROWSE_EMBED_ENDPOINT', 'browseandembed/index/browseandembed');

define('KALTURA_LOG_REQUEST', 'REQ');
define('KALTURA_LOG_RESPONSE', 'RES');

define('KALTURA_PANEL_HEIGHT', 580);
define('KALTURA_PANEL_WIDTH', 1100);
define('KALTURA_LTI_LEARNER_ROLE', 'Learner');
define('KALTURA_LTI_INSTRUCTOR_ROLE', 'Instructor');
define('KALTURA_LTI_ADMIN_ROLE', 'urn:lti:sysrole:ims/lis/Administrator');
//define('KALTURA_REPO_NAME', 'kaltura');
define('KALTURA_URI_TOKEN', 'kaltura-kaf-uri.com');

/**
 * This function validates whether a requested KAF module is valid.
 * @param string $module The name of the module.
 * @return bool True if valid, otherwise false.
 */
function local_kaltura_validate_kaf_module_request($module) {
    $valid = false;

    switch ($module) {
        case KAF_MYMEDIA_MODULE:
            $valid = true;
            break;
        case KAF_MEDIAGALLERY_MODULE:
            $valid = true;
            break;
        case KAF_BROWSE_EMBED_MODULE:
            $valid = true;
            break;
    }
    return $valid;
}


/**
 * Initialize the kaltura account and obtain the secrets and partner ID
 *
 * @param string $login - username (email address)
 * @param string $password - password
 * @param string $uri - URI
 *
 * @return boolean - true on success or false
 */
function local_kaltura_initialize_account($login, $password, $uri = '') {
    global $CFG;

    try {
        $config_obj = new KalturaConfiguration(0);

        $config_obj->clientTag = local_kaltura_create_client_tag();

        if (!empty($CFG->proxyhost)) {
            $config_obj->proxyHost = $CFG->proxyhost;
            $config_obj->proxyPort = $CFG->proxyport;
            $config_obj->proxyType = $CFG->proxytype;
            $config_obj->proxyUser = ($CFG->proxyuser)? $CFG->proxyuser : null;
            $config_obj->proxyPassword = ($CFG->proxypassword && $CFG->proxyuser)? $CFG->proxypassword: null;
        }

        if (!empty($uri)) {
            $config_obj->serviceUrl = $uri;
        }

        $config_obj->serviceUrl = local_kaltura_get_host();
        $config_obj->cdnUrl = local_kaltura_get_host();

        $client_obj = new KalturaClient($config_obj);

        if (empty($client_obj)) {
            return false;
        }

        $admin_session = $client_obj->adminUser->login($login, $password);

        $client_obj->setKs($admin_session);

        $user_info = $client_obj->partner->getInfo();

        if (isset($user_info->secret)) {
            set_config('secret', $user_info->secret, KALTURA_PLUGIN_NAME);
        }

        if (isset($user_info->adminSecret)) {
            set_config('adminsecret', $user_info->adminSecret, KALTURA_PLUGIN_NAME);
        }

        if (isset($user_info->id)) {
            set_config('partner_id', $user_info->id, KALTURA_PLUGIN_NAME);
        }

        // Check if this is a hosted initialization
        $connection_type = get_config(KALTURA_PLUGIN_NAME, 'conn_server');

        if (0 == strcmp('hosted', $connection_type)) {

            // May need to set the URI setting.
            // Beause if was originally disabled then the form will not submit the default URI.
            set_config('uri', KALTURA_DEFAULT_URI, KALTURA_PLUGIN_NAME);

            local_kaltura_send_initialization($admin_session);

        }

        return true;

    } catch (KalturaException $ex) {
        return false;

    } catch (KalturaClientException $ex) {
        return false;
    }
}

/**
 * Uninitialize the kaltura account.
 */
function local_kaltura_uninitialize_account() {
    set_config('secret', '', KALTURA_PLUGIN_NAME);
    set_config('adminsecret', '', KALTURA_PLUGIN_NAME);
    set_config('partner_id', '', KALTURA_PLUGIN_NAME);
}

/**
 * Send initializations information to the Kaltura server
 *
 * @param string $session - The Kaltura session string
 */
function local_kaltura_send_initialization($session) {
    $plugin = new stdClass();
    // We always want the version information even if it was already loaded by something else.
    include(dirname(__FILE__).'/version.php');

    $ch = curl_init();

    $uri = "http://corp.kaltura.com/signup/activate_application?".
           "type=moodle&kaltura_version={$plugin->version}&system_version={$plugin->system_version}&ks={$session}";

    $options = array(CURLOPT_URL => $uri,
                     CURLOPT_POST => false,
                     CURLOPT_RETURNTRANSFER => true);

    curl_setopt_array($ch, $options);

    curl_exec($ch);
    curl_close($ch);
}

/**
 * Log in with the user's credentials.  General a kaltura session locally
 *
 * @param boolean $admin - true to login as an administrator or false to login as user.
 * @param string $privileges - privleges give to the user.
 * @param int $expiry - number of seconds to keep the session alive.
 * @param boolean $testconn - use of test connection.
 *
 * @return obj - KalturaClient
 */
function local_kaltura_login($admin = false, $privileges = '', $expiry = 10800, $test_conn = false) {
    global $USER;

    list($login, $password) = local_kaltura_get_credentials();

    if (empty($login) || empty($password)) {
        return false;
    }

    $config_obj = local_kaltura_get_configuration_obj();

    if (empty($config_obj) || !($config_obj instanceof KalturaConfiguration)) {
        return false;
    }

    $client_obj = new KalturaClient($config_obj);

    if (empty($client_obj)) {
        return false;
    }

    $partner_id = $client_obj->getConfig()->partnerId;
    $secret     = get_config(KALTURA_PLUGIN_NAME, 'adminsecret');

    if (isloggedin()) {
        $username = $USER->username;
    } else {
        $username = null;
    }

    if ($admin) {

        $session = $client_obj->generateSession($secret, $username, KalturaSessionType::ADMIN,
                                     $partner_id, $expiry, $privileges);
    } else {

        $session = $client_obj->generateSession($secret, $username, KalturaSessionType::USER,
                                     $partner_id, $expiry, $privileges);
    }

    if (!empty($session)) {

        $client_obj->setKs($session);

        if ($test_conn) {
            $result = local_kaltura_test_connection($client_obj);

            if (empty($result)) {
                return false;
            }
        }

        return $client_obj;

    } else {
        return false;
    }
}


/**
 * Log in with the user's credentials.  General a kaltura session locally
 *
 * @param boolean $admin - true to login as an administrator or false to login as user.
 * @param string $privileges - privleges give to the user.
 * @param int $expiry - number of seconds to keep the session alive.
 * @param boolean $testconn - use of test connection.
 *
 * @return obj - KalturaClient
 */
function local_kaltura_legacy_login($admin = false, $privileges = '', $expiry = 10800, $test_conn = false) {
    global $USER;

    list($login, $password) = local_kaltura_get_legacy_credentials();

    if (empty($login) || empty($password)) {
        return false;
    }

    $config_obj = local_kaltura_get_legacy_configuration_obj();

    if (empty($config_obj) || !($config_obj instanceof KalturaConfiguration)) {
        return false;
    }

    $client_obj = new KalturaClient($config_obj);

    if (empty($client_obj)) {
        return false;
    }

    $partner_id = $client_obj->getConfig()->partnerId;
    $secret     = get_config(KALTURA_PLUGIN_NAME, 'adminsecret_legacy');

    if (isloggedin()) {
        $username = $USER->username;
    } else {
        $username = null;
    }

    if ($admin) {

        $session = $client_obj->generateSession($secret, $username, KalturaSessionType::ADMIN,
                                     $partner_id, $expiry, $privileges);
    } else {

        $session = $client_obj->generateSession($secret, $username, KalturaSessionType::USER,
                                     $partner_id, $expiry, $privileges);
    }

    if (!empty($session)) {

        $client_obj->setKs($session);

        if ($test_conn) {
            $result = local_kaltura_test_connection($client_obj);

            if (empty($result)) {
                return false;
            }
        }

        return $client_obj;

    } else {
        return false;
    }
}


/**
 * This function is refactored code from login(). It only generates and
 * returns a user Kaltura session. The session value returned is mainly used for
 * inclusion into the video markup flashvars query string.
 *
 * @param string $medialist - privilege string.
 * @return array - an array of Kaltura media entry ids
 */
function local_kaltura_generate_kaltura_session($video_list = array()) {
    global $USER;

    $config_obj = local_kaltura_get_configuration_obj();

    if (empty($config_obj) || !($config_obj instanceof KalturaConfiguration)) {
        return false;
    }

    $client_obj = new KalturaClient($config_obj);

    if (empty($client_obj) || empty($video_list)) {
        return false;
    }

    $privilege  = 'sview:' . implode(',sview:', $video_list);

    $secret     = get_config(KALTURA_PLUGIN_NAME, 'adminsecret');
    $partner_id = get_config(KALTURA_PLUGIN_NAME, 'partner_id');

    if (isloggedin()) {
        $username = $USER->username;
    } else {
        $username = null;
    }
    $session = $client_obj->generateSession($secret, $username, KalturaSessionType::USER,
                                            $partner_id, KALTURA_SESSION_LENGTH, $privilege);

    return $session;
}


/**
 * This function is refactored code from login(). It only generates and
 * returns a user Kaltura session. The session value returned is mainly used for
 * inclusion into the video markup flashvars query string.
 *
 * @param string $medialist - privilege string.
 * @return array - an array of Kaltura media entry ids
 */
function local_kaltura_generate_legacy_kaltura_session($video_list = array()) {
    global $USER;

    $config_obj = local_kaltura_get_legacy_configuration_obj();

    if (empty($config_obj) || !($config_obj instanceof KalturaConfiguration)) {
        return false;
    }

    $client_obj = new KalturaClient($config_obj);

    if (empty($client_obj) || empty($video_list)) {
        return false;
    }

    $privilege  = 'sview:' . implode(',sview:', $video_list);

    $secret     = get_config(KALTURA_PLUGIN_NAME, 'adminsecret_legacy');
    $partner_id = '104';

    if (isloggedin()) {
        $username = $USER->username;
    } else {
        $username = null;
    }
    $session = $client_obj->generateSession($secret, $username, KalturaSessionType::USER,
                                            $partner_id, KALTURA_SESSION_LENGTH, $privilege);

    return $session;
}
/**
 * Returns an array with the login and password as values respectively
 *
 * @return array - login, password or an array of false values if none were found.
 */
function local_kaltura_get_credentials() {

    $login = false;
    $password = false;

    $login = get_config(KALTURA_PLUGIN_NAME, 'login');
    $password = get_config(KALTURA_PLUGIN_NAME, 'password');

    return array($login, $password);
}

/**
 * Returns an array with the login and password as values respectively
 *
 * @return array - login, password or an array of false values if none were found.
 */
function local_kaltura_get_legacy_credentials() {

    $login = false;
    $password = false;

    $login = get_config(KALTURA_PLUGIN_NAME, 'login_legacy');
    $password = get_config(KALTURA_PLUGIN_NAME, 'password_legacy');

    return array($login, $password);
}

/**
 * Retrieve an instance of the KalturaConfiguration class
 *
 * @return obj - KalturaConfiguration object
 */
function local_kaltura_get_configuration_obj() {
    global $CFG;

    $partner_id = local_kaltura_get_partner_id();

    if (empty($partner_id)) {
        return false;
    }

    $config_obj = new KalturaConfiguration($partner_id);
    $config_obj->serviceUrl = local_kaltura_get_host();
    $config_obj->cdnUrl = local_kaltura_get_host();
    $config_obj->clientTag = local_kaltura_create_client_tag();

    if (!empty($CFG->proxyhost)) {
        $config_obj->proxyHost = $CFG->proxyhost;
        $config_obj->proxyPort = $CFG->proxyport;
        $config_obj->proxyType = $CFG->proxytype;
        $config_obj->proxyUser = ($CFG->proxyuser) ? $CFG->proxyuser : null;
        $config_obj->proxyPassword = ($CFG->proxypassword && $CFG->proxyuser) ? $CFG->proxypassword : null;
    }
    return $config_obj;
}


function local_kaltura_get_legacy_configuration_obj() {
    global $CFG;

    $partner_id = \local_kaltura\kaltura_config::get_legacy_partnerid();

    if (empty($partner_id)) {
        return false;
    }

    $config_obj = new KalturaConfiguration($partner_id);
    $config_obj->serviceUrl = \local_kaltura\kaltura_config::get_legacy_host();
    $config_obj->cdnUrl = \local_kaltura\kaltura_config::get_legacy_host();
    $config_obj->clientTag = 'moodle_kaltura_legacy';

    if (!empty($CFG->proxyhost)) {
        $config_obj->proxyHost = $CFG->proxyhost;
        $config_obj->proxyPort = $CFG->proxyport;
        $config_obj->proxyType = $CFG->proxytype;
        $config_obj->proxyUser = ($CFG->proxyuser) ? $CFG->proxyuser : null;
        $config_obj->proxyPassword = ($CFG->proxypassword && $CFG->proxyuser) ? $CFG->proxypassword : null;
    }
    return $config_obj;
}

/**
 * Returns the test connection markup
 * @return string - HTML markup for test connection
 */
function local_kaltura_testconnection_markup() {

    $markup = '';

    $markup .= html_writer::start_tag('center');

    $attr = array('id' => 'open_button',
                  'value' => get_string('start', 'local_kaltura'),
                  'type' => 'button');
    $markup .= html_writer::tag('input', '', $attr);

    $markup .= html_writer::end_tag('center');

    return $markup;
}

/**
 * Retrieve a list of all the custom players available to the account.
 *
 * @return string|bool - The session ID string value or false on error.
 */

function local_kaltura_get_custom_players() {

    try {
        $custom_players = array();

        $client_obj = local_kaltura_login(true, '');

        if (empty($client_obj)) {
            return $custom_players;
        }

        $allowed_types = array(KalturaUiConfObjType::PLAYER, KalturaUiConfObjType::PLAYER_V3);

        $filter = new KalturaUiConfFilter();
        $filter->objTypeEqual = implode(',', $allowed_types);
        $filter->tagsMultiLikeOr = 'player';

        $players = $client_obj->uiConf->listAction($filter, null);

        if ((!empty($players->objects)) && ($players instanceof KalturaUiConfListResponse)) {
            foreach ($players->objects as $uiconfid => $player) {

                $custom_players["{$player->id}"] = "{$player->name} ({$player->id})";
            }
        }

        return $custom_players;
    } catch (KalturaClientException $e) {
        //print_object($e);
        return false;
    } catch (KalturaException $ex) {
        return false;
    }
}

/**
 * Retrieves the default player UIConf ID or the custom UIConf ID
 *
 * @param string $type - type of player uiconf to return, accepted values
 * are player, uploader and presentation
 *
 * @return int - UiConf id of the type of player requested.
 */
function local_kaltura_get_player_uiconf($type = 'player') {

    $uiconf = 0;

    switch ($type) {
        case 'player':
        case 'player_resource':
        case 'res_uploader':
        case 'pres_uploader':
        case 'presentation':
        case 'mymedia_uploader':
        case 'mymedia_screen_recorder':
        case 'assign_uploader':
        case 'player_filter':
        case 'simple_uploader';

            $uiconf = get_config(KALTURA_PLUGIN_NAME, $type);

            if (empty($uiconf)) {
                $uiconf = get_config(KALTURA_PLUGIN_NAME, "{$type}_custom");
            }
            break;
        default:
            break;
    }

    return $uiconf;
}

function local_kaltura_get_legacy_player_uiconf($type = 'player') {

    $uiconf = 0;

    switch ($type) {
        case 'player':
        case 'player_resource':
        case 'res_uploader':
        case 'pres_uploader':
        case 'presentation':
        case 'mymedia_uploader':
        case 'mymedia_screen_recorder':
        case 'assign_uploader':
        case 'player_filter':
        case 'simple_uploader';

            $uiconf = '23448572';//get_config(KALTURA_PLUGIN_NAME, $type);

            if (empty($uiconf)) {
                $uiconf = get_config(KALTURA_PLUGIN_NAME, "{$type}_custom");
            }
            break;
        default:
            break;
    }

    return $uiconf;
}

/**
 * Retrives the player resource override configuration value
 *
 * @return string - 1 if override is required, else 0
 */
function local_kaltura_get_player_override() {
    return get_config(KALTURA_PLUGIN_NAME, 'player_resource_override');
}

/**
 * Return the host URI and removes trailing slash
 *
 * @return string - host URI
 */
function local_kaltura_get_host() {

    $uri = get_config(KALTURA_PLUGIN_NAME, 'uri');

    // Remove trailing slash
    $trailing_slash = strrpos($uri, '/') + 1;
    $length         = strlen($uri);

    if ($trailing_slash == $length) {
        $uri = rtrim($uri, '/');
    }

    return $uri;
}

/**
 * Return the host URI and removes trailing slash
 *
 * @return string - host URI
 */
function local_kaltura_get_legacy_host() {

    $uri = \local_kaltura\kaltura_config::get_legacy_host();

    // Remove trailing slash
    $trailing_slash = strrpos($uri, '/') + 1;
    $length         = strlen($uri);

    if ($trailing_slash == $length) {
        $uri = rtrim($uri, '/');
    }

    return $uri;
}

/**
 * Return the partner Id
 *
 * @return int - partner Id
 */
function local_kaltura_get_partner_id() {
    return get_config(KALTURA_PLUGIN_NAME, 'partner_id');
}

/**
 * Return the admin secret
 *
 * @return string - admin secret
 */
function local_kaltura_get_admin_secret() {
    return get_config(KALTURA_PLUGIN_NAME, 'adminsecret');
}

/**
 * Return the user secret
 *
 * @return string - user secret
 */
function local_kaltura_get_secret() {
    return get_config(KALTURA_PLUGIN_NAME, 'secret');
}

/**
 * Return the publiser name
 *
 * @return string - publisher name
 */
function local_kaltura_get_publisher_name() {
    return get_config(KALTURA_PLUGIN_NAME, 'login');
}

/**
 * Initialize the KalturaUser object
 *
 * @param bool $admin - true to set isAdmin
 *
 * @return object - KalturaUser object
 */
function local_kaltura_init_kaltura_user($admin = false) {
    global $USER;

    $user               = new KalturaUser();
    $user->id           = $USER->username;
    $user->screenName   = $USER->username;
    $user->email        = $USER->email;
    $user->firstName    = $USER->firstname;
    $user->lastName     = $USER->lastname;
    $user->isAdmin      = $admin;

    return $user;
}

/**
 * Create html image markup string.
 *
 * @param object $entryobj - KalturaMediaEntry object.
 * @param string $title - media title used to alt property.
 * @param string $theme - moodle theme, is desktop or mobile.
 * @param int $maxwidth - maximum width of thumbnail.
 * @param int $maxheight - maximum height of thumbnail.
 * @return string - image markup.
 */
function local_kaltura_create_image_markup($entryobj, $title, $theme,
                                           $maxwidth = KALTURA_IMAGE_DESKTOP_WIDTH,
                                           $maxheight = KALTURA_IMAGE_DESKTOP_HEIGHT) {

    $output = '';

    $originalsource = $entryobj->dataUrl;

    $httppattern = '/^http:\/\/[A-Za-z0-9\-\.]{1,61}\//';
    $httpspattern = '/^https:\/\/[A-Za-z0-9\-\.]{1,61}\//';

    $replace = local_kaltura_get_host() . '/';

    $modifiedsource = preg_replace($httpspattern, $replace, $originalsource, 1, $count);
    if ($count != 1) {
            $modifiedsource = preg_replace($httppattern, $replace, $originalsource, 1, $count);
        if ($count != 1) {
            $modifiedsource = $originalsource;
        }
    }

    if (0 == strcmp($theme, 'mymobile')) {
        $maxwidth = KALTURA_IMAGE_MOBILE_WIDTH;
        $maxheight = KALTURA_IAMGE_MOBILE_HEIGHT;
    }

    if ($entryobj->width > $maxwidth || $entryobj->height > $maxheight) {
        $originalwidth = $entryobj->width;
        $originalheight = $entryobj->height;

        $ratiowidth = $entryobj->width / $maxwidth;
        $ratioheight = $entryobj->height / $maxheight;
        if ($ratiowidth >= $ratioheight) {
            $modifiedwidth = $entryobj->width / $ratiowidth;
            $modifiedheight = $entryobj->height / $ratiowidth;
        } else {
            $modifiedwidth = $entryobj->width / $ratioheight;
            $modifiedheight = $entryobj->height / $ratioheight;
        }

        list($beforestr, $afterstr) = preg_split('/\/def_height\//', $modifiedsource);
        $afterstr = strstr($afterstr, '/');
        $modifiedsource = $beforestr . '/def_height/' . $entryobj->height . $afterstr;
        list($beforestr, $afterstr) = preg_split('/\/def_width\//', $modifiedsource);
        $afterstr = strstr($afterstr, '/');
        $modifiedsource = $beforestr . '/def_width/' . $entryobj->width . $afterstr;

        $linksource = $modifiedsource;

        list($beforestr, $afterstr) = preg_split('/\/def_height\//', $linksource);
        $afterstr = strstr($afterstr, '/');
        $linksource = $beforestr . '/def_height/' . $originalheight . $afterstr;
        list($beforestr, $afterstr) = preg_split('/\/def_width\//', $linksource);
        $afterstr = strstr($afterstr, '/');
        $linksource = $beforestr . '/def_width/' . $originalwidth . $afterstr;

        $output .= '<a href="' . $linksource . '" target="_new">';
        $output .= '<img src="' . $modifiedsource . '" width="' . $modifiedwidth;
        $output .= '" height="' . $modifiedheight . '" alt="' . $title . '" title = "' . $title . '" border="0"/>';
        $output .= '</a>';
    } else {
        $output .= '<img src="' . $modifiedsource . '" width="' . $entryobj->width;
        $output .= '" height="' . $entryobj->height. '" alt="' . $title . '" title = "' . $title . '" border="0"/>';
    }

    return $output;
}

/**
 * This functions returns the HTML markup for the Kaltura dynamic player.
 *
 * @param obj $entryobj - KalturaMedia object
 * @param int $uiconfid - player ui_conf_id (optional).  If no value is specified the
 * default player will be used.
 * @param int - Moodle course id (optional).  This parameter is required in
 * order to generate Kaltura analytics data.
 * @param string $session - A kaltura session string
 * @param int $uid - a unique identifier, this value is appented to 'kaltura_player_'
 * and is used as the id of the object tag
 * @param bool $autoplay - whether we should autoplay this entry if possible
 *
 * @return string - HTML markup
 */
function local_kaltura_get_kdp_code($entryobj, $uiconf_id = 0, $courseid = 0, $session = '', $uid = 0, $autoplay = 0) {

    if (!local_kaltura_is_valid_entry_object($entryobj)) {
        return 'Unable to play video ('. $entryobj->id . ') please contact your site administrator.';
    }

    if (0 == $uid) {
        $uid  = floor(microtime(true));
        $uid .= '_' . mt_rand();
    }

    $host = local_kaltura_get_legacy_host();
    $flashvars = local_kaltura_get_kdp_flashvars($courseid, $session);
    if (KalturaMediaType::IMAGE == $entryobj->mediaType) {
        $varstr = '&amp;IframeCustomPluginCss1=' .  new moodle_url('/local/kaltura/css/hiddenPlayButton.css');
        $flashvars .= $varstr;
    }
		
		if ($autoplay == 1) {
			$flashvars .= '&amp;autoPlay=1';
		}

    if (empty($uiconfid)) {
        $uiconf = local_kaltura_get_legacy_player_uiconf('player');
    } else {
        $uiconf = $uiconfid;
    }

    $originalurl = $entryobj->thumbnailUrl;

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

    $output = '';

    $output .= "<object id=\"kaltura_player_{$uid}\" name=\"kaltura_player_{$uid}\" ";
    $output .= "type=\"application/x-shockwave-flash\" allowFullScreen=\"true\" allowNetworking=\"all\" ";
    $output .= "allowScriptAccess=\"always\"";
    $output .= "xmlns:dc=\"http://purl.org/dc/terms/\" xmlns:media=\"http://search.yahoo.com/searchmonkey/media/\" ";
    $output .= "rel=\"media:{$entryobj->mediaType}\" ";
    $output .= "resource=\"{$host}/index.php/kwidget/wid/_{$entryobj->partnerId}/uiconf_id/{$uiconf}/entry_id/{$entryobj->id}\" ";
    $output .= "data=\"{$host}/index.php/kwidget/wid/_{$entryobj->partnerId}/uiconf_id/{$uiconf}";
    $output .= "/entry_id/{$entryobj->id}\"> " . PHP_EOL;
    $output .= "<param name=\"allowFullScreen\" value=\"true\" />" . PHP_EOL;
    $output .= "<param name=\"allowNetworking\" value=\"all\" />" . PHP_EOL;
    $output .= "<param name=\"allowScriptAccess\" value=\"always\" />" . PHP_EOL;
    $output .= "<param name=\"bgcolor\" value=\"#000000\" /> " . PHP_EOL;
    $output .= "<param name=\"flashvars\" value=\"{$flashvars}\" /> " . PHP_EOL;
    $output .= "<param name=\"wmode\" value=\"opaque\" /> " . PHP_EOL;

    $output .= "<param name=\"movie\" value=\"{$host}/index.php/kwidget/wid/_{$entryobj->partnerId}";
    $output .= "/uiconf_id/{$uiconf}/entry_id/{$entryobj->id}\" />" . PHP_EOL;

    $output .= "<a rel=\"media:thumbnail\" href=\"{$modifiedurl}/width/120/height/90/bgcolor/000000/type/2\"></a>". PHP_EOL;
    $output .= "<span property=\"dc:description\" content=\"{$entryobj->description}\"></span>" . PHP_EOL;
    $output .= "<span property=\"media:title\" content=\"{$entryobj->name}\"></span>" . PHP_EOL;
    $output .= "<span property=\"media:width\" content=\"{$entryobj->width}\"></span>" . PHP_EOL;
    $output .= "<span property=\"media:height\" content=\"{$entryobj->height}\"></span>" . PHP_EOL;
    $output .= "<span property=\"media:type\" content=\"application/x-shockwave-flash\"></span>" . PHP_EOL;
    $output .= "<span property=\"media:duration\" content=\"{$entryobj->duration}\"></span>". PHP_EOL;
    $output .= "</object>" . PHP_EOL;

    return $output;
}

/**
 * This function returns a string of flash variables required for Kaltura
 * analytics
 *
 * @param courseid
 * @param string - Kaltura session string
 * @return string - query string of flash variables
 *
 */
function local_kaltura_get_kdp_flashvars($courseid = 0, $session = '') {
    global $USER;

    if (isloggedin()) {
        $flash_vars = "userId={$USER->username}";
    } else {
        $flash_vars = '';
    }
    if (!empty($session)) {
       $flash_vars .= '&amp;ks='.$session;
    }

    $application_name = get_config(KALTURA_PLUGIN_NAME, 'mymedia_application_name');

    $application_name = empty($application_name) ? 'Moodle' : $application_name;

    $flash_vars .= '&amp;applicationName='.$application_name;

    $enabled = local_kaltura_kaltura_repository_enabled();

    if (!$enabled && 0 != $courseid) {
        return $flash_vars;
    }

    // Require the Repository library for category information
    require_once(dirname(dirname(dirname(__FILE__))) . '/repository/kaltura/locallib.php');

    $kaltura = new kaltura_connection();
    $connection = $kaltura->get_legacy_connection(true, KALTURA_SESSION_LENGTH);

    if (!$connection) {
        return '';
    }

    $category = repository_kaltura_create_course_category($connection, $courseid);

    if ($category) {
        $flash_vars .= '&amp;playbackContext=' . $category->id;
    }

    return $flash_vars;
}

/**
 * This function checks to see if the Kaltura repository plugin is enabled.
 * Because there is not easy wasy of verifying in the database and it would
 * require instanciating multiple classes, we're only going to check if the
 * required values are set in the database.
 *
 * @param none
 * @return bool - true if it exists and is enabled, otherwise false
 */
function local_kaltura_kaltura_repository_enabled() {
    global $CFG;

    $enabled = false;

    if (file_exists($CFG->dirroot . '/repository/kaltura/lib.php')) {
        require_once($CFG->dirroot . '/repository/kaltura/lib.php');

        if (!function_exists('repository_kaltura_create_course_category') ||
            !function_exists('repository_kaltura_add_video_course_reference')) {
            return $enabled;
        }

        $root_id   = get_config(REPOSITORY_KALTURA_PLUGIN_NAME, 'rootcategory_id');
        $root_path = get_config(REPOSITORY_KALTURA_PLUGIN_NAME, 'rootcategory');


        if (empty($root_id) || empty($root_path)) {
            return $enabled;
        }

        $enabled = true;
    }

    return $enabled;
}

function local_kaltura_get_root_category() {
    global $CFG;

    $rootid = '';
    $rootpath = '';

    if (!function_exists('local_kaltura_create_user_category')) {
        return null;
    }

    $rootid   = get_config(KALTURA_PLUGIN_NAME, 'rootcategory_id');
    $rootpath = get_config(KALTURA_PLUGIN_NAME, 'rootcategory');
	
	//die('$rootid:'.print_r($rootid,1).' $rootpath:'.print_r($rootpath,1));
	
    if (empty($rootid) || empty($rootpath)) {
        return null;
    }

    return array('id' => $rootid, 'name' => $rootpath);
}

/**
 * This function checks for the existance of required entry object
 * properties.  See KALDEV-28 for details.
 *
 * @param object $entryobj - entry object
 * @return bool - true if valid, else false
 */
function local_kaltura_is_valid_entry_object($entry_obj) {
    if (isset($entry_obj->mediaType)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Retrieves an entry object and cache the object only if the entry status is
 * set to 'ready'.  If the second parameter is set to true, this function will
 * only return an entry object if the status is set to true.  Otherwise it will
 * return false.
 *
 * @param string $entryid - entry id of Kaltura Media.
 * @param bool $readyonly - true if this function is the only return an entry object
 * when the entry status is set to 'ready'.
 * False, to return the entry object regardless of it's status.
 *
 * @return mixed - entry object, or false (depending on the entry status and the
 * second prameter
 */
function local_kaltura_get_ready_entry_object($entry_id, $ready_only = true) {

    try {
        $client_obj = local_kaltura_legacy_login(true, '');

        if (empty($client_obj)) {
            return false;
        }

        // Check if the entry object is cached
        $entries = new KalturaStaticEntries();
        $entry_obj = KalturaStaticEntries::getEntry($entry_id, $client_obj->baseEntry, false);

        if (!empty($entry_obj)) {
            return $entry_obj;
        }

        // Check if the entry object is ready, by making an API call
        $entry_obj = $client_obj->baseEntry->get($entry_id);

        // If the entry object is ready then return it
        if (KalturaEntryStatus::READY == $entry_obj->status) {

            KalturaStaticEntries::addEntryObject($entry_obj);

            return $entry_obj;

        } else {
        // If it's not ready, check if the request is for a ready only object

            if (true === $ready_only) {
                $entry_obj = false;
            }
        }

        return $entry_obj;

    } catch (Exception $ex) {
        // Connection failed for some reason.  Maybe proxy settings?
        /*
		$errormessage = 'check conversion(' . $ex->getMessage() . ')';
        print_error($errormessage, 'local_kaltura');
        */
		return false;
    }
}

/**
 * Check that the account has mobile flavours enabled
 *
 * @return bool - true if enabled, otherwise false
 */
function local_kaltura_has_mobile_flavor_enabled() {

    $filter = new KalturaPermissionFilter();
    $filter->nameEqual = 'FEATURE_MOBILE_FLAVORS';

    $pager = new KalturaFilterPager();
    $pager->pageSize = 30;
    $pager->pageIndex = 1;

    try {
        $client_obj = local_kaltura_login(true);

        if (empty($client_obj)) {
            throw new Exception("Unable to connect");
        }

        $results = $client_obj->permission->listAction($filter, $pager);

        if ( 0 == count($results->objects) ||
            $results->objects[0]->status != KalturaPermissionStatus::ACTIVE) {

            throw new Exception("partner doesn't have permission");

        }

        return true;

    } catch (Exception $ex) {
        $errormessage = 'mobile flavor on(' . $ex->getMessage() . ')';
				debugging($errormessage, DEBUG_DEVELOPER);
        //print_error($errormessage, 'local_kaltura');
        return false;
    }
}

/**
 * This function test connection to kaltura server.
 * @param obj $clientobj - Kaltura Client
 * @return mixed - list of permission if succeeded, false if failed.
 */
function local_kaltura_test_connection($client_obj) {
    $results = false;

    $filter = new KalturaPermissionFilter();
    $filter->nameEqual = 'KMC_READ_ONLY';

    $pager = new KalturaFilterPager();
    $pager->pageSize = 30;
    $pager->pageIndex = 1;

    try {

        $results = $client_obj->permission->listAction($filter, $pager);

        return $results;

    } catch (Exception $ex) {
        $errormessage = 'test connection(' . $ex->getMessage() . ')';
				debugging($errormessage, DEBUG_DEVELOPER);
        //print_error($errormessage, 'local_kaltura');
        return false;
    }
}

/**
 * Return the Kaltura HTML5 javascript library URL
 * @param int $uiconfid - uiconf_id of the player to use
 *
 * @return string - url to the Kaltura HTML5 library URL
 */
function local_kaltura_htm5_javascript_url($uiconf_id) {

    $host       = local_kaltura_get_host();
    $partner_id = local_kaltura_get_partner_id();

    return "{$host}/p/{$partner_id}/sp/{$partner_id}00/embedIframeJs/uiconf_id/{$uiconf_id}/partner_id/{$partner_id}";

}

function local_kaltura_legacy_htm5_javascript_url($uiconf_id) {

    $host       = local_kaltura_get_legacy_host();
    $partner_id = '104';

    return "{$host}/p/{$partner_id}/sp/{$partner_id}00/embedIframeJs/uiconf_id/{$uiconf_id}/partner_id/{$partner_id}";

}


/**
 * Retrives the enable html 5 flavour configuration option
 *
 * @return string - 1 if enabled, else 0
 */
function local_kaltura_get_enable_html5() {
    return get_config(KALTURA_PLUGIN_NAME, 'enable_html5');
}

/**
 * This function saves standard media metadata
 *
 * @param obj $connection - Kaltura connection object
 * @param string $entryid - Kaltura media id
 * @param array $param - array of properties to update (accepted keys/value
 * pairs 'name', 'tags', 'desc', 'catids')
 *
 * @return bool - true of successful or false
 */
function local_kaltura_update_video_metadata($connection, $entry_id, $param) {

    $media_entry = new KalturaMediaEntry();

    if (array_key_exists('name', $param)) {
        $media_entry->name = $param['name'];
    }

    if (array_key_exists('tags', $param)) {
        $media_entry->tags = $param['tags'];
    }

    if (array_key_exists('desc', $param)) {
        $media_entry->description = $param['desc'];
    }

    if (array_key_exists('catids', $param)) {
        $media_entry->categoriesIds = $param['catids'];
    }

    $result = $connection->media->update($entry_id, $media_entry);

    if (!$result instanceof KalturaMediaEntry) {
        return false;
    }

    return true;

}

/**
 * This function validates media objects.  Checks to see if the media is of a
 * media type "mix".  If so, then an API call is made to get all media entries
 * that make up the mix. If the mix contains one entry then only the one entry
 * is returned.  If the mix contains more than one entry then boolean true is
 * returned.  This function will one day become deprecated; but it for now it is
 * needed because of KALDEV-28
 *
 * @param object $entryobj - entry object
 *
 * @return boolean - true of the entry type is valid, false if invliad AND the
 * id parameter of the entry_object is overwritten and must be retrieve from the
 * kaltura server again
 */
function local_kaltura_video_type_valid($entry_obj) {
    try {
        $client_obj = local_kaltura_login(true, '');

        if (empty($client_obj)) {
            throw new Exception('Invalid client object');
        }

        // If we encounter a entry of type "mix", we must find the regular "video" type and display that for playback
        if (KalturaEntryType::MIX == $entry_obj->type and
            0 >= $entry_obj->duration) {

            // This call returns an array of "video" type entries that exist in the "mix" entry
            $media_entries = $client_obj->mixing->getReadyMediaEntries($entry_obj->id);

            if (!empty($media_entries)) {

                if (count($media_entries) == 1) {
                    $entry_obj->id = $media_entries[0]->id;
                    return false;
                } else {
                    return true;
                }

            }
        }
    } catch (Exception $ex) {
        // Connection failed for some reason.  Maybe proxy settings?
        $errormessage = 'convert to valid entry type(' . $ex->getMessage() . ')';
        print_error($errormessage, 'local_kaltura');
        return false;
    }

}

/**
 * This function deletes a video from the Kaltura server
 *
 * @param obj $connection - Kaltura connection object
 * @param string $entryid - Kaltura media entry id
 *
 * @return bool - true of success, false
 */
function local_kaltura_delete_video($connection, $entry_id) {

    return $connection->media->delete($entry_id);
}

/**
 * This function determins whether Moodle is at 2.2 or newer.
 *
 * @param - none
 * @return bool - true if this version of Moodle is newer than Moodel 2.3rc1
 * otherwise false
 */
function local_kaltura_is_moodle_pre_twothree() {
    // Retrieve the release number from the config table
    $release = get_config('', 'release');

    // If version is empty for some reason, return false and hope it works out okay.
    if (empty($release)) {
        return false;
    }

    // Parse the release number
    $release_num = substr($release, 0, 3);

    // If this version of Moodle is lerger then Moodle 2.3rc1
    if (0 == strcmp($release_num, '2.2')) {
        return true;
    } else if (0 == strcmp($release_num, '2.1')) {
        return true;
    } else if (0 == strcmp($release_num, '2.0')) {
        return true;
    } else {
        return false;
    }
}

/**
 * This function creates a client tag used to identify API requests to the
 * Kaltura server
 * @return string - client tag
 */
function local_kaltura_create_client_tag() {

    $client_tag      = 'moodle';
    $release         = get_config('', 'release');
    $release_array   = explode(' ', $release);
    $kaltura_version = get_config(KALTURA_PLUGIN_NAME, 'version');

    if (!empty($release_array) && is_array($release_array)) {
        $client_tag .= '_' . $release_array[0];
    }

    $client_tag .= "_k_{$kaltura_version}";

    return $client_tag;

}

/**
 * This function returns HTML markup and javascript required to use kwidget to
 * embed the HTML5 video markup. As of KALDEV-201, this function is used
 * exclusively by the filter plug-in because of the issues faced by Moodle's
 * caching filtered text and the XHR loading of course section by the MyMobile
 * theme.
 *
 * @param obj $entryobj - Kaltura media object
 * @param int $uiconfid - player ui_conf_id (optional).  If no value is specified the
 * default player will be used.
 * @param string $session - A kaltura session string
 * @param int $uid - a unique identifier, this value is appented to 'kaltura_player_'
 * and is used as the id of the object tag
 * @param bool $autoplay - whether we should autoplay this entry if possible
 * @return string - HTML tags of kwidget player.
 *
 */
function local_kaltura_get_kwidget_code($entryobj, $uiconfid = 0, $courseid = 0, $session = '', $uid = 0, $autoplay = 0) {

    if (!local_kaltura_is_valid_entry_object($entryobj)) {
        return 'Unable to play media ('. $entryobj->id . ') please contact your site administrator.';
    }

    if (0 == $uid) {
        $uid  = floor(microtime(true));
        $uid .= '_' . mt_rand();
    }

    $flashvars        = local_kaltura_get_kdp_flashvars($entryobj->creatorId, $session);
    $flashvars        = explode('&amp;', $flashvars);
    $kwidgetflashvar  = '';

    // Re-format the flashvars into javascript object properties.
    foreach ($flashvars as $var) {
        $proval = explode('=', $var);
        $kwidgetflashvar .= ",'". $proval[0] ."' : '". $proval[1] . "'";
    }

    if (KalturaMediaType::IMAGE == $entryobj->mediaType) {
        $kwidgetflashvar .= ", 'IframeCustomPluginCss1' : '". new moodle_url('/local/kaltura/css/hiddenPlayButton.css') . "'";
    }

    if (empty($uiconf_id)) {
        $uiconf = local_kaltura_get_legacy_player_uiconf('player');
    } else {
        $uiconf = $uiconf_id;
    }
		
		$doAutoPlay = ($autoplay==1) ? 'true' : 'false';
		
    $markup = '';
    $markup .= "<div id=\"kaltura_player_{$uid}\" style=\"width:{$entryobj->width}px;height:{$entryobj->height}px;\">" . PHP_EOL;
    $markup .= "    <span property=\"dc:description\" content=\"{$entryobj->description}\"></span>" . PHP_EOL;
    $markup .= "    <span property=\"media:title\" content=\"{$entryobj->name}\"></span>" . PHP_EOL;
    $markup .= "    <span property=\"media:width\" content=\"{$entryobj->width}\"></span>" . PHP_EOL;
    $markup .= "    <span property=\"media:height\" content=\"{$entryobj->height}\"></span>". PHP_EOL;
    $markup .= "</div>" . PHP_EOL;
    $markup .= "<script language=javascript>". PHP_EOL;
    $markup .= "    if (document.readyState === \"complete\") {" . PHP_EOL;
    $markup .= "        local_kaltura_kwidget_{$entryobj->id}();" . PHP_EOL;
    $markup .= "    } else {" . PHP_EOL;
    $markup .= "        window.addEventListener(\"onload\", ";
    $markup .= "function() { local_kaltura_kwidget_{$entryobj->id}(); }, false);" . PHP_EOL;
    $markup .= "        document.addEventListener(\"DOMContentLoaded\", ";
    $markup .= "function () { local_kaltura_kwidget_{$entryobj->id}(); }, false);" . PHP_EOL;
    $markup .= "    }" . PHP_EOL;
    $markup .= PHP_EOL;
    $markup .= "    function local_kaltura_kwidget_{$entryobj->id}() {" . PHP_EOL;
    $markup .= "        console.log('calling kwidget.embed for - kaltura_player_{$uid}');" . PHP_EOL;
    $markup .= "        kWidget.embed({" . PHP_EOL;
    $markup .= "            'targetId': 'kaltura_player_{$uid}'," . PHP_EOL;
    $markup .= "            'wid': '_{$entryobj->partnerId}'," . PHP_EOL;
    $markup .= "            'uiconf_id' : '{$uiconfid}'," . PHP_EOL;
    $markup .= "            'entry_id'  : '{$entryobj->id}'," . PHP_EOL;
    $markup .= "            'width'     : '{$entryobj->width}'," . PHP_EOL;
    $markup .= "            'height'    : '{$entryobj->height}'," . PHP_EOL;
    $markup .= "            'flashvars' :{" . PHP_EOL;
    $markup .= "                'externalInterfaceDisabled' : false," . PHP_EOL;
    $markup .= "                'autoPlay' : {$doAutoPlay}{$kwidgetflashvar}" . PHP_EOL;
    $markup .= "            }" . PHP_EOL;
    $markup .= "        });" . PHP_EOL;
    $markup .= "    }". PHP_EOL;
    $markup .= "</script>";

    return $markup;
}

/**
 * Kaltura connection class
 * @package    local_yukaltura
 * @copyright  (C) 2016-2017 Yamaguchi University <gh-cc@mlex.cc.yamaguchi-u.ac.jp>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class kaltura_connection {

    /** @var object - kaltura connection object */
    private static $connection  = null;
    /** @var object - kaltura ce connection object */
    private static $connection_ce  = null;
    /** @var int - time length until session is expired. */
    private static $timeout = 0;
    /** @var int - start time of Kaltura session. */
    private static $timestarted = 0;
    /** @var int - time length until ce session is expired. */
    private static $timeout_ce = 0;
    /** @var int - start time of Kaltura ce session. */
    private static $timestarted_ce = 0;

    /**
     * Constructor for Kaltura connection class.
     *
     * @param int $timeout - Length of timeout for Kaltura session in minutes
     */
    public function __construct($timeout = KALTURA_SESSION_LENGTH) {
        self::$connection = local_kaltura_login(true, '', $timeout);
        if (!empty(self::$connection)) {
            self::$timestarted = time();
            self::$timeout = $timeout;
        }
        self::$connection_ce = local_kaltura_legacy_login(true, '', $timeout);
        if (!empty(self::$connection_ce)) {
            self::$timestarted_ce = time();
            self::$timeout_ce = $timeout;
        }
    }

    /**
     * Get the connection object.  Pass true to renew the connection
     *
     * @param bool $admin if true, get connection as admin, otherwise, as user.
     * @param int $timeout seconds to keep the session alive, if zero is passed the
     * last time out value will be used
     * @return object A Kaltura KalturaClient object
     */
    public function get_connection($admin, $timeout = 0) {
        self::$connection = local_kaltura_login($admin, '', $timeout);
        return self::$connection;
    }
	
	
	public function get_legacy_connection($admin, $timeout = 0) {
        self::$connection_ce = local_kaltura_legacy_login($admin, '', $timeout);
        return self::$connection_ce;
    }
    /**
     * Return the number of seconds the session is alive for
     * @return int - number of seconds the session is set to live
     */
    public function get_timeout() {

        return self::$timeout;
    }

    /**
     * Return the time the session started
     * @return int - unix timestamp
     */
    public function get_timestarted() {
        return self::$timestarted;
    }

    /**
     * Descruct connnection instance.
     */
    public function __destruct() {
        global $SESSION;

        $SESSION->kaltura_con             = serialize(self::$connection);
        $SESSION->kaltura_con_timeout     = self::$timeout;
        $SESSION->kaltura_con_timestarted = self::$timestarted;

    }

}

/**
 * Search for Moodle courses with the given query
 *
 * @param string $query The course to search for
 * @return mixed An array of Moodle courses on success; false, otherwise
 */
function search_course($query) {
    global $CFG, $DB;

    $courses = array();
    $limit = get_config(KALTURA_PLUGIN_NAME, 'search_courses_display_limit');

    if (empty($query)) {
        return $courses;
    }

    $sql = "SELECT id, fullname, shortname, idnumber
             FROM {$CFG->prefix}course
            WHERE (".$DB->sql_like('fullname', '?', false)."
               OR ".$DB->sql_like('shortname', '?', false).")
              AND id != 1
         ORDER BY fullname ASC";

    if (($records = $DB->get_records_sql($sql, array('%'.$query.'%', '%'.$query.'%'), 0, $limit)) === false) {
        return false;
    }

    foreach ($records as $crs) {
        $context = context_course::instance($crs->id);
        if (has_capability('local/kaltura:view_report', $context, null, true)) {
            $course = new stdclass;
            $course->id = $crs->id;
            $course->fullname = $crs->fullname;
            $course->idnumber = $crs->idnumber;
            $course->shortname = $crs->shortname;
            $courses[] = $course;
        }
    }

    return $courses;
}

/**
 * Returns a list of recently accessed Moodle courses
 *
 * @return mixed An array of courses on success; false, otherwise
 */
function recent_course_history_listing() {
    global $USER, $DB;

    $limit = get_config(KALTURA_PLUGIN_NAME, 'recent_courses_display_limit');
    $courses = array();

    // Get the most recently accessed courses by this user
    // NOTE: JOIN on course table to only get courses which currently still exist
    $sql = "SELECT ul.courseid AS course, ul.timeaccess
              FROM {user_lastaccess} ul
        INNER JOIN {course} c ON c.id = ul.courseid
             WHERE ul.userid = :userid
          ORDER BY ul.timeaccess DESC";

    if (($records = $DB->get_records_sql($sql, array('userid' => $USER->id), 0, $limit)) === false) {
        return false;
    }

    foreach ($records as $crs) {
        if ($DB->record_exists('course', array('id' => $crs->course))) {
            $context = context_course::instance($crs->course);
            if (has_capability('local/kaltura:view_report', $context, null, true)) {
                if ($course = $DB->get_record('course', array('id' => $crs->course), 'id, idnumber, fullname, shortname', IGNORE_MISSING)) {
                    $courses[] = $course;
                }
            }
        }
    }

    return $courses;
}

/**
 * This function determines whether a user has any local/kaltura:view_report capabilities on a course context.
 * This is a similar and more efficient implementation of the get_user_capability_course function.
 * Currently this is used to determine if the "Kaltura Course Media Reports" link gets displayed to the user.
 *
 * @return boolean Returns true if user has permission; otherwise, false
 */
function kaltura_course_report_view_permission() {
    global $DB, $USER;

    $sql = "SELECT context.id
              FROM {context} context
              JOIN {role_assignments} role_assign ON context.id = role_assign.contextid
              JOIN {role} role ON role_assign.roleid = role.id
              JOIN {role_capabilities} role_cap ON role_cap.roleid = role.id
             WHERE context.contextlevel = :context
               AND role_cap.capability = :capability
               AND role_assign.userid = :userid
               AND role_cap.permission = :permission";

    $params = array(
        'context' => CONTEXT_COURSE,
        'capability' => 'local/kaltura:view_report',
        'userid' => $USER->id,
        'permission' => CAP_ALLOW
    );

    if ($DB->record_exists_sql($sql, $params)) {
        return true;
    }

    return false;
}

/*
 * This function retrieve client ip address.
 *
 * @param bool $checkproxy - if true, check proxy forwarder variable.
 *
 * @return string - client ip address.
 */

function local_kaltura_get_client_ipaddress($checkproxy = true) {

    if ($checkproxy && local_kaltura_get_server_variable('HTTP_CLIENT_IP') != null) {
        $ip = local_kaltura_get_server_variable('HTTP_CLIENT_IP');
    } else if ($checkproxy && local_kaltura_get_server_variable('HTTP_X_FORWARDED_FOR') != null) {
        $ip = getServer('HTTP_X_FORWARDED_FOR');
    } else { // Not through a proxy.
        $ip = local_kaltura_get_server_variable('REMOTE_ADDR');
    }
    return $ip;
}

/**
 * This function retrieve server variables.
 *
 * @param string $key - server variable name.
 * @param string $default  - return this value if there does not exist the variable.
 *
 * @return string - value of the variable.
 */
function local_kaltura_get_server_variable($key, $default = null) {
    return (isset($_SERVER[$key])) ? $_SERVER[$key] : $default;
}

/**
 * This function checks whether the IP address of the client is internal.
 *
 * @param string $ipaddress - IP address of client.
 *
 * @return bool - true if the IP adrress is internal, otherwise false.
 */
function local_kaltura_check_internal($ipaddress) {
    try {
        $addresslist = get_config(KALTURA_PLUGIN_NAME, 'internal_ipaddress');

        $subnetarray = array();
        if (strpos($addresslist, ' ') === false) {
            $subnetarray[] = $addresslist;
        } else {
            $subnetarray = explode(" ", $addresslist);
        }

        foreach ($subnetarray as $subnet) {
            if ($subnet == "0.0.0.0" or $subnet == "0.0.0.0/0") {
                return true;
            }

            if (strpos($subnet, '/') === false) {
                if ($ipaddress == $subnet) {
                    return true;
                }
            }

            $elements = explode("/", $subnet);

            if (count($elements) == 2) {
                $networkaddress = $elements[0];
                $networkprefix = (int)$elements[1];
                $segments = explode(".", $networkaddress);
                if (count($segments) == 4 and
                    (int)$segments[0] >= 0 and (int)$segments[0] <= 255 and
                    (int)$segments[1] >= 0 and (int)$segments[1] <= 255 and
                    (int)$segments[2] >= 0 and (int)$segments[2] <= 255 and
                    (int)$segments[3] >= 0 and (int)$segments[3] <= 255 and
                    $networkprefix >= 1 && $networkprefix <= 32) {

                    if (check_ipaddress_in_range($ipaddress, $subnet)) {
                        return true;
                    }
                }
            }
        }
    } catch (Exception $ex) {
        return false;
    }

    return false;
}

/**
 * This function checks whether the IP address of the client is within a predetermined range.
 *
 * @param string $ip - IP address.
 * @param string $range - range of IP address.
 *
 * @return bool - true if the IP adrress is within the predetermined range, otherwise false.
 */
function check_ipaddress_in_range($ip, $range) {
    try {
        if (!($ip = ip2long($ip))) {
            return false;
        }

        if (strpos($range, '/') !== false) { // Case in subnet.
            list($net, $mask) = explode('/', $range);

            if (!($net = ip2long($net))) {
                return false;
            }

            if (is_numeric($mask)) {
                $mask = long2ip(bindec(str_repeat('1', $mask) . str_repeat('0', 32 - $mask)));
            }

            if (!($mask = ip2long($mask))) {
                return false;
            }

            return (($ip & $mask) === ($net & $mask)) ? true : false;
        } else if (strpos($range, '-') !== false) {  // Case in range.
            $range = explode('-', $range);
            if (!($range[0] = ip2long($range[0]))) {
                return false;
            }
            if (!($range[1] = ip2long($range[1]))) {
                return false;
            }
            return ($range[0] <= $ip && $ip <= $range[1]) ? true : false;

        } else if ($range = ip2long($range)) {
            return ($range === $ip) ? true : false;
        }
    } catch (Exception $ex) {
        return false;
    }

    return false;
}

/**
 * This function retrieves defaul access control of Kaltura server.
 *
 * @param object $connection - connection object for Kaltura server.
 *
 * @return object - object of defaul access control.
 */
function local_kaltura_get_default_access_control($connection) {
    try {

        $result = $connection->accessControl->listAction();

        if (is_null($result)) {
            return null;
        }

        $controllist = $result->objects;

        if (is_null($controllist) or count($controllist) == 0) {
            return null;
        }

        foreach ($controllist as $control) {
            if ($control->name == KALTURA_DEFAULT_ACCESS_CONTROL_NAME and
                $control->systemName == KALTURA_DEFAULT_ACCESS_CONTROL_SYSTEM_NAME) {
                return $control;
            }
        }
    } catch (Exception $ex) {
        $errormessage = 'Error in local_kaltura_get_internal_profile(' . $ex->getMessage() . ')';
        print_error($errormessage, 'local_kaltura');
        return null;
    }

    return null;
}

/**
 * This function retrieves internal access control of Kaltura server.
 *
 * @param object $connection - connection object for Kaltura server.
 *
 * @return object - object of internal access control.
 */
function local_kaltura_get_internal_access_control($connection) {
    try {

        $result = $connection->accessControl->listAction();

        if (is_null($result)) {
            return null;
        }

        $controllist = $result->objects;

        if (is_null($controllist) or count($controllist) == 0) {
            return null;
        }

        foreach ($controllist as $control) {
            if ($control->name == KALTURA_INTERNAL_ACCESS_CONTROL_NAME and
                $control->systemName == KALTURA_INTERNAL_ACCESS_CONTROL_SYSTEM_NAME) {
                return $control;
            }
        }
    } catch (Exception $ex) {
        $errormessage = 'Error in local_kaltura_get_internal_control(' . $ex->getMessage() . ')';
        print_error($errormessage, 'local_kaltura');
        return null;
    }

    return null;
}

/**
 * This function creates default access control of Kaltura server.
 *
 * @param object $connection - connection object for Kaltura server.
 *
 * @return object - object of internal access control.
 */
function local_kaltura_create_default_access_control($connection) {
    $control = new KalturaAccessControl();

    try {
        $control->name = KALTURA_DEFAULT_ACCESS_CONTROL_NAME;
        $control->systemName = KALTURA_DEFAULT_ACCESS_CONTROL_SYSTEM_NAME;
        $control->description = KALTURA_DEFAULT_ACCESS_CONTROL_DESC;
        $control->isDefault = KalturaNullableBoolean::TRUE_VALUE;
        $control->restrictions = array();
        $control = $connection->accessControl->add($control);
    } catch (Exception $ex) {
        $errormessage = 'Error in local_kaltura_create_internal_profile(' . $ex->getMessage() . ')';
        print_error($errormessage, 'local_kaltura');
        return null;
    }

    return $control;
}

/**
 * This function creates internal access control of Kaltura server.
 *
 * @param object $connection - connection object for Kaltura server.
 *
 * @return object - object of internal access control.
 */
function local_kaltura_create_internal_access_control($connection) {
    $control = new KalturaAccessControl();

    try {
        $control->name = KALTURA_INTERNAL_ACCESS_CONTROL_NAME;
        $control->systemName = KALTURA_INTERNAL_ACCESS_CONTROL_SYSTEM_NAME;
        $control->description = KALTURA_INTERNAL_ACCESS_CONTROL_DESC;
        $control->isDefault = KalturaNullableBoolean::NULL_VALUE;
        $restriction = new KalturaIpAddressRestriction();
        $restriction->ipAddressRestrictionType = KalturaIpAddressRestrictionType::ALLOW_LIST;

        $addresses = get_config(KALTURA_PLUGIN_NAME, 'internal_ipaddress');

        if ($addresses != null and $addresses != '') {
            $addressarray = explode(" ", $addresses);
            if (count($addressarray) >= 2) {
                $addresses = implode(",", $addressarray);
            }
        }

        $restriction->ipAddressList = $addresses;
        $control->restrictions = array($restriction);
        $control = $connection->accessControl->add($control);
    } catch (Exception $ex) {
        $errormessage = 'Error in local_kaltura_create_internal_profile(' . $ex->getMessage() . ')';
        print_error($errormessage, 'local_kaltura');
        return null;
    }

    return $control;
}

/**
 * This function updates internal access control of Kaltura server.
 *
 * @param object $connection - connection object for Kaltura server.
 * @param int $id - id of access control.
 *
 * @return bool - true if update is scceeded, otherwise false.
 */
function local_kaltura_update_internal_access_control($connection, $id) {
    $control = new KalturaAccessControl();

    try {
        $control->id = $id;
        $control->name = KALTURA_INTERNAL_ACCESS_CONTROL_NAME;
        $control->systemName = KALTURA_INTERNAL_ACCESS_CONTROL_SYSTEM_NAME;
        $control->description = KALTURA_INTERNAL_ACCESS_CONTROL_DESC;
        $control->isDefault = KalturaNullableBoolean::NULL_VALUE;
        $restriction = new KalturaIpAddressRestriction();
        $restriction->ipAddressRestrictionType = KalturaIpAddressRestrictionType::ALLOW_LIST;

        $addresses = get_config(KALTURA_PLUGIN_NAME, 'internal_ipaddress');

        if ($addresses != null and $addresses != '') {
            $addressarray = explode(" ", $addresses);
            if (count($addressarray) >= 2) {
                $addresses = implode(",", $addressarray);
            }
        }

        $restriction->ipAddressList = $addresses;
        $control->restrictions = array($restriction);
        $connection->accessControl->update($id, $control);
    } catch (Exception $ex) {
        $errormessage = 'Error in local_kaltura_update_internal_profile(' . $ex->getMessage() . ')';
        print_error($errormessage, 'local_kaltura');
        return null;
    }
    return $control;
}

/**
 * This function checks if the user can use My Media..
 *
 * @return - true if user can use My Media, otherwise false.
 */
function local_kaltura_get_mymedia_permission() {
    global $USER;

    $check = get_config(KALTURA_PLUGIN_NAME, 'mymedia_limited_access');
    $keyword = get_config(KALTURA_PLUGIN_NAME, 'mymedia_access_keyword');

    if ($check == '0' || $keyword == null || $keyword == '') {
        return true;
    }

    $rule = get_config(KALTURA_PLUGIN_NAME, 'mymedia_access_rule');

    if ($rule == 'contain_firstname' && strpos($USER->firstname, $keyword) !== false) {
        return true;
    } else if ($rule == 'not_contain_firstname' && strpos($USER->firstname, $keyword) === false) {
        return true;
    } else if ($rule == 'contain_lastname' && strpos($USER->lastname, $keyword) !== false) {
        return true;
    } else if ($rule == 'not_contain_lastname' && strpos($USER->lastname, $keyword) === false) {
        return true;
    } else if ($rule == 'contain_email' && strpos($USER->email, $keyword) !== false) {
        return true;
    } else if ($rule == 'not_contain_email' && strpos($USER->email, $keyword) === false) {
        return true;
    }

    return false;
}

/**
 * Create the root category structure.
 *
 * @param obj $connection - Kaltura connection object
 * @return mixed - an array with the root category path and the root category id
 *  or false if something wrong happened
 */
function local_kaltura_create_root_category($connection) {

    $first = true;
    $parentid = '';
    $categories = array();
    $rootcategory = get_config(KALTURA_PLUGIN_NAME, 'rootcategory');
    $duplicate = false;

    // Split categories into an array.
    if (!empty($rootcategory)) {
        $categories = explode('>', $rootcategory);
    }

    $categorytocreated = '';

    // Check if categories already exist in the KMC.
    foreach ($categories as $categoryname) {

        if (empty($categorytocreated)) {
            $categorytocreated = $categoryname;
        } else {
            $categorytocreated = $categorytocreated . '>' . $categoryname;
        }

        // Check if the category already exists.  If any exists then we cannot create the category.
        if (local_kaltura_category_path_exists($connection, $categorytocreated)) {
            $duplicate = true;
            break;
        }
    }

    // If thre is a duplicate, the user must specify a different root category format.
    if ($duplicate) {
        return false;
    }

    $result = null;

    // Create categories.
    foreach ($categories as $categoryname) {

        if ($first) {
            $result = local_kaltura_create_category($connection, $categoryname);
        } else {
            $result = local_kaltura_create_category($connection, $categoryname, $parentid);
        }

        if (!empty($result)) {

            if ($first) {
                $rootcategory = $result->name;
            } else {
                $rootcategory .= '>' . $result->name;
            }

            $first = false;
            $parentid = $result->id;
        }
    }

    // Save configuration.
    set_config('rootcategory', $rootcategory, KALTURA_PLUGIN_NAME);
    set_config('rootcategory_id', $result->id, KALTURA_PLUGIN_NAME);

    return array($rootcategory, $result->id);
}

/**
 * Create a category in the KMC.  If a perent id is passed then the category
 * will be created as a sub category of the parent id
 *
 * @param object $connection - Kaltura connection object
 * @param string $name - category name
 * @param int $parentid - (optional) parent id
 * @return object - KalturaCategory if category was created, otherwise false
 */
function local_kaltura_create_category($connection, $name, $parentid = 0) {

    if (empty($name)) {
        return false;
    }

    $category = new KalturaCategory();
    $category->name = $name;

    if (!empty($parentid)) {
        $category->parentId = $parentid;
    }

    $result = $connection->category->add($category);

    if ($result instanceof KalturaCategory) {
        return $result;
    }

    return false;
}

/**
 * Checks if a specific category has a matching fullName value
 * @param obj $connection - Kaltura connection object
 * @param int $categoryid - category id
 * @param string $path - category fullName path
 * @return bool - true if category with fullName path exists. Else false
 */
function local_kaltura_category_id_path_exists($connection, $categoryid, $path) {
    if (empty($path) || empty($categoryid)) {
        return false;
    }

    $filter = new KalturaCategoryFilter();
    $filter->fullNameEqual = $path;
    $filter->idEqual = $categoryid;
    $result = $connection->category->listAction($filter);

    if ($result instanceof KalturaCategoryListResponse &&
        1 == $result->totalCount) {

        if ($result->objects[0] instanceof KalturaCategory) {
            return $result->objects[0];
        }
    }

    return false;

}

/**
 * Checks if a category path exists, if path exists then it returns the
 * a KalturaCategory object.  Otherwise false.  The API does not allow searching
 * for categories (using the 'category' service) by name
 *
 * @param object $connection - An instance of the yukaltura_connection class.
 * @param string $path - The Kaltura root path.
 * @return bool|KalturaCategory - A KalturaCategory if path exists, otherwise false
 */
function local_kaltura_category_path_exists($connection, $path) {
    global $SESSION;

    if (empty($path)) {
        return false;
    }

    // Retrieve access data from the session global.
    if (isset($SESSION->kalrepo)) {

        if (isset($SESSION->kalrepo["$path"]) && !empty($SESSION->kalrepo["$path"])) {
            // Gonen - 2nd change - unserialize the found object before returning.
            $obj = unserialize($SESSION->kalrepo["$path"]);
            if ($obj !== false) {
                return $obj;
            }
        }
    } else {
        $SESSION->kalrepo = array(array());
    }

    $filter = new KalturaCategoryFilter();
    $filter->fullNameEqual = $path;
    $result = $connection->category->listAction($filter);

    if ($result instanceof KalturaCategoryListResponse &&
        1 <= $result->totalCount) {

        if ($result->objects[0] instanceof KalturaCategory) {
            // Gonen - 1st change - save serialized object to session.
            $SESSION->kalrepo["$path"] = serialize($result->objects[0]);
            return $result->objects[0];
        }
    }

    return false;
}

/**
 * This function creates a Kaltura category, if one doesn't exist, whose name is
 * the Moodle username; and returns the category
 *
 * @param obj $connection - Kaltura connection object
 * @param int $username - Moodle username
 *
 * @return mixed - KalturaCategory object, or false if it failed to create one
 */
function local_kaltura_create_user_category($connection, $username) {

    // Get the root category path.
    $rootpath = get_config(KALTURA_PLUGIN_NAME, 'rootcategory');

    // Check if the root category path is an empty string.
    if (empty($rootpath)) {
        return false;
    }
    $path = $rootpath . '>' . $username;

    // Check if the category exists.
    $usercategory = local_kaltura_category_path_exists($connection, $path);

    if (!$usercategory) {

        $rootid = get_config(KALTURA_PLUGIN_NAME, 'rootcategory_id');

        // Create category.
        $usercategory = local_kaltura_create_category($connection, $username, $rootid);

        if (!$usercategory) {
            return false;
        }
    }

    return $usercategory;
}

/**
 * Refactored code from search_own_medias(), except it also returns medias
 * that are still being converted.
 *
 * @param object $connection - Kaltura connection object
 * @param string $search - Search string (optional)
 * @param int $pageindex - Pager index
 * @param int $mediasperpage - Number of medias to display on a single page (optional override)
 * @param string $sort - Optional sort (most recent or alphabetical)
 *
 * @return array - List of medias
 */
function local_kaltura_search_mymedia_medias($connection, $search = '', $pageindex = 0, $mediasperpage = 0, $sort = null) {

    global $USER;

    $results = array();

    // Create filter.
    $filter = local_kaltura_create_mymedia_filter($search, $sort);

    // Filter medias with the user's username as the user id.
    $filter->userIdEqual = $USER->username;

    // Create pager object.
    $pager = local_kaltura_create_pager($pageindex, $mediasperpage);

    // Get results.
    $results = $connection->media->listAction($filter, $pager);

    return $results;

}

/**
 * This function returns a KalturaMediaEntryFilter object with specific
 * properties based on the arguments passed.  A freeText search is used when
 * name and tags are not empty.  A tagsMultiLikeOr is used when tags is not
 * empty.  A nameMultiLikeOr is used when name is not empty
 *
 * @param string $name - media name search criteria
 * @param string $tags - media tags serach criteria
 * @param string $multioverride - (optional) generic search criteria override.  Forces the
 * function to use tagsNameMultiLikeOr search filter
 *
 * @return obj - KalturaMediaEntryFilter object
 */
function local_kaltura_create_media_filter($name, $tags, $multioverride = '') {

    $filter = new KalturaMediaEntryFilter();

    if (!empty($multioverride)) {
        $searchname = explode(' ', $multioverride);

        // Removing duplicate search terms.
        $search = array_flip(array_flip($searchname));

        $filter->tagsNameMultiLikeOr = implode(',', $search);

    } else if (!empty($name) && !empty($tags)) {
        // If name and tag is not empty use tagsNameMultiLikeOr search.
        $searchtags = explode(' ', $tags);
        $searchname = explode(' ', $name);

        // Removing duplicate search terms.
        $search = array_flip(array_flip(array_merge($searchtags, $searchname)));

        $filter->tagsNameMultiLikeOr = implode(',', $search);

    } else if (!empty($tags)) {

        $searchtags = explode(' ', $tags);
        $searchtags = implode(',', $searchtags);
        $filter->tagsMultiLikeOr = $searchtags;
    } else if (!empty($name)) {

        $searchname = explode(' ', $name);
        $searchname = implode(',', $searchname);
        $filter->nameMultiLikeOr = $searchname;
    }

    $filter->orderBy = 'name';

    return $filter;
}

/**
 * Refactored code from create_media_filter(), except it only uses
 * tagsNameMultiLikeOr and uses KalturaEntryStatus::READY, KalturaEntryStatus::
 * PRECONVERT, KalturaEntryStatus::IMPORT to retrieve medias that are still
 * being converted.
 *
 * @param string $search - Media search string (separated by spaces)
 * @param string $sort - Optional sort (most recent or alphabetical)
 * @return obj - KalturaMediaEntryFilter object
 */
function local_kaltura_create_mymedia_filter($search, $sort = null) {

    $filter = new KalturaMediaEntryFilter();

    $searchname = explode(' ', $search);

    // Removing duplicate search terms.
    $searchname = array_flip(array_flip($searchname));

    $filter->freeText = implode(',', $searchname);

    $filter->statusIn = KalturaEntryStatus::READY .','.
                        KalturaEntryStatus::PRECONVERT .','.
                        KalturaEntryStatus::IMPORT;

    if ($sort == 'recent') {
        $filter->orderBy = KalturaBaseEntryOrderBy::CREATED_AT_DESC;
    } else if ($sort == 'old') {
        $filter->orderBy = KalturaBaseEntryOrderBy::CREATED_AT_ASC;
    } else if ($sort == 'name_asc') {
         $filter->orderBy = KalturaBaseEntryOrderBy::NAME_ASC;
    } else if ($sort == 'name_desc') {
         $filter->orderBy = KalturaBaseEntryOrderBy::NAME_DESC;
    } else if ($sort == 'duration_asc') {
         $filter->orderBy = KalturaMediaEntryOrderBy::DURATION_ASC;
    } else if ($sort == 'duration_desc') {
         $filter->orderBy = KalturaMediaEntryOrderBy::DURATION_DESC;
    } else {
        $filter->orderBy = KalturaBaseEntryOrderBy::CREATED_AT_DESC;
    }

    return $filter;
}


/**
 * This function creates and returns a KalturaFilterPager object.  If a page
 * index greater than 0 is passed, the pager object will be created with a
 * pageIndex equal to the parameter.  The size of the page is determined by the
 * itemsperpage plug-in configuration setting.
 *
 * @param int $pageindex - pager index value
 * @param int $itemsperpage - number of items to display on a page (optinal override)
 *
 * @return obj - KalturaFilterPager object
 */
function local_kaltura_create_pager($pageindex = 0, $itemsperpage = 0) {

    $page = new KalturaFilterPager();

    if (empty($itemsperpage)) {
        $page->pageSize = get_config(KALTURA_PLUGIN_NAME, 'mymedia_items_per_page');
    } else {
        $page->pageSize = $itemsperpage;
    }

    if (0 <= (int) $pageindex) {
        $page->pageIndex = '+' . (int) $pageindex;
    } else {
        $page->pageIndex = 0;
    }

    return $page;

}

/**
 * This function checks if the user can use webcamera.
 *
 * @return - true if user can use webcamera, otherwise false.
 */
function local_kaltura_get_webcam_permission() {
    $check = get_config(KALTURA_PLUGIN_NAME, 'enable_webcam');

    if ($check == '1') {
        return true;
    } else {
        return false;
    }
}



function local_kaltura_get_report($entryIds) {
	
	$client_obj = local_kaltura_login(true, '');
	
	$reportType = KalturaReportType::CONTENT_INTERACTIONS;
	  $reportInputFilter = new KalturaReportInputFilter();
	  $pager = new KalturaFilterPager();
	  $order = "";
	  $objectIds = $entryIds;
	  $responseOptions = new KalturaReportResponseOptions();
    
	  $result = $client_obj->report->getTable($reportType, $reportInputFilter, $pager, $order, $objectIds);
	  
	  return $result;
}


/**
 * This function gets the local configuration and sanitizes the settings.
 * @return object Returns object containing configuration settings for kaltura local plugin.
 */
function local_kaltura_get_config() {
    $configsettings = get_config(KALTURA_PLUGIN_NAME);
    //if (empty($configsettings->kaf_uri)) {
        $configsettings->kaf_uri = "https://regina-moodle-dev.kaf.ca.kaltura.com";
		//}
    // If a https url is needed for kaf_uri it should be entered into the kaf_uri setting as https://.
    if (!empty($configsettings->kaf_uri) && !preg_match('#^https?://#', $configsettings->kaf_uri)) {
        $configsettings->kaf_uri = 'https://'.$configsettings->kaf_uri;
    }
	//error_log('config:'.print_r($configsettings,1));
    return $configsettings;
}

/**
 * This functions checks if a URL contains the host name that is configiured for the plug-in.
 * @param string $url The URL to validate.
 * @return bool Returns true if the URL contains the configured host name.  Otherwise false.
 */
function local_kaltura_url_contains_configured_hostname($url) {
    $configuration = local_kaltura_get_config();
    $configuri = local_kaltura_format_uri($configuration->kaf_uri);

    if (empty($configuri)) {
        return false;
    }
    $position = strpos($url, $configuri);
    if (false === $position) {
        return false;
    }

    return true;
}

/**
 * This function returns the URL parameter with a protocol prefixed, if non was detected.  http:// is used by default if no protocol is found.
 * @param string $url The URL to verify.
 * @return string Returns the URL with the protocol.  An empty string is returned in the case of an exception being thrown.
 */
function local_kaltura_add_protocol_to_url($url) {
    $newurl = '';
    if (0 === strpos($url, 'https://')) {
        $newurl = $url;
    } else if (0 === strpos($url, 'http://')) {
        $newurl = $url;
    } else {
        $newurl = 'http://'.$url;
    }

    try {
        $newurl = validate_param($newurl, PARAM_URL);
    } catch (invalid_parameter_exception $e) {
        return '';
    }

    return $newurl;
}

/**
 * This functions removes the HTTP protocol and the trailing slash from a URI.
 * @param string $uri The URI to format.
 * @return string The formatted URI with the protocol and trailing slash removed.
 */
function local_kaltura_format_uri($uri) {
    $newuri = str_replace('https://', '', $uri);
    $newuri = str_replace('http://', '', $newuri);
    $newuri = str_replace('www.', '', $newuri);
    $newuri = rtrim($newuri, '/');
    return $newuri;
}

/**
 * This function formats an array that is passed to mod_lti locallib.php functions.
 * @param object $lti An object returned from @see local_kaltura_format_lti_instance_object().
 * @param bool $withblocks Set to true to display blocks.  Otherwise false.
 * @return array An array formatted for use by mod_lti locallib.php functions.
 */
function local_kaltura_format_typeconfig($lti, $withblocks = true) {
    $typeconfig = array();
    $typeconfig['sendname'] = $lti->instructorchoicesendname;
    $typeconfig['sendemailaddr'] = $lti->instructorchoicesendemailaddr;
    $typeconfig['customparameters'] = $lti->instructorcustomparameters;
    $typeconfig['acceptgrades'] = $lti->instructorchoiceacceptgrades;
    $typeconfig['allowroster'] = $lti->instructorchoiceallowroster;
    $typeconfig['launchcontainer'] = local_kaltura_get_lti_launch_container($withblocks);
    return $typeconfig;
}

/**
 * This function calls @see lti_get_launch_container() to an LTI launch container to display the content.
 * @param bool $withblocks Set to true to dislay embed content with Moodle blocks.  Otherwise set to false.
 * @return int Container value
 */
function local_kaltura_get_lti_launch_container($withblocks = true) {
    $lti = new stdClass();
    $container = 0;

    if (!empty($withblocks)) {
        $lti->launchcontainer = LTI_LAUNCH_CONTAINER_EMBED;
        $container = lti_get_launch_container($lti, array('launchcontainer' => LTI_LAUNCH_CONTAINER_EMBED));
    } else {
        $lti->launchcontainer = LTI_LAUNCH_CONTAINER_EMBED_NO_BLOCKS;
        $container = lti_get_launch_container($lti, array('launchcontainer' => LTI_LAUNCH_CONTAINER_EMBED_NO_BLOCKS));
    }

    return $container;
}


/**
 * This function validates the parameters to see if all of the requirements for the module are met.
 * @param array $params An array of parameters
 * @return bool true if valid, otherwise false
 */
function local_kaltura_validate_browseembed_required_params($params) {
    $valid = true;

    $expectedkeys = array(
        // The activity instance id
        'id' => '',
        // The KAL module requested
        'module' => '',
        'course' => new stdClass(),
        'title' => '',
        'width' => '',
        'height' => '',
        'cmid' => '',
        'custom_publishdata' => '',
    );

    // Get keys that reside in both parameters and expectedkeys
    $matchingkeys = array_intersect_key($params, $expectedkeys);

    // The number of keys in the result should equal the number of expectedkeys
    if (count($expectedkeys) != count($matchingkeys)) {
        return false;
    }

    $invalid = !is_numeric($params['id']) || !is_numeric($params['width']) || !is_numeric($params['height']) || !is_numeric($params['cmid']) || !is_object($params['course']);

    if ($invalid) {
        return false;
    }

    return true;
}


/**
 * This function returns the endpoint URL belonging to the module that was requested.
 * @param string $module The name of the module being requested.
 * @param string Part of the URL that makes up the endpoint pertaining to the module requested.
 * @return string Part of the URL for the end point designated for the module.  Otherwise an empty string.
 */
function local_kaltura_get_endpoint($module) {
    switch ($module) {
        case KAF_MYMEDIA_MODULE:
            return KAF_MYMEDIA_ENDPOINT;
            break;
        case KAF_MEDIAGALLERY_MODULE:
            return KAF_MEDIAGALLERY_ENDPOINT;
            break;
        case KAF_BROWSE_EMBED_MODULE:
            return KAF_BROWSE_EMBED_ENDPOINT;
            break;
    }
    return '';
}

/**
 * This function replaces the KALTURA_TOKEN_URI in a source URL with KAF URI domain.
 * @param string $url A url which need the kaf_uri added.
 * @return string Returns url with added KAF URI domain.
 */
function local_kaltura_add_kaf_uri_token($url) {
    $configsettings = local_kaltura_get_config();
    // For records that have been migrated from old kaf uri to token format by search and replace.
    if (preg_match('/https?:\/\/'.KALTURA_URI_TOKEN.'/', $url)) {
        $url = preg_replace('/https?:\/\/'.KALTURA_URI_TOKEN.'/', $configsettings->kaf_uri, $url);
    }
    return $url;
}

/**
 * This function formats and returns an object that will be passed to mod_lti locallib.php functions.
 * @param array $ltirequest An array of parameters to be converted into a properly formatted mod_lti instance.
 * @return object Returns an object that meets the requirements for use with mod_lti locallib.php functions.
 */
function local_kaltura_format_lti_instance_object($ltirequest) {
    $configsettings = local_kaltura_get_config();

    // Convert request parameters into mod_lti friendly format for consumption.
    $lti = new stdClass();
    $lti->course = $ltirequest['course']->id;
    $lti->id = $ltirequest['id'];
    $lti->name = $ltirequest['title'];
    $lti->intro = isset($ltirequest['intro']) ? $ltirequest['intro'] : '';
    $lti->instructorchoicesendname = LTI_SETTING_ALWAYS;
    $lti->instructorchoicesendemailaddr = LTI_SETTING_ALWAYS;
    $lti->custom_publishdata = '';
    $lti->instructorcustomparameters = '';
    $lti->instructorchoiceacceptgrades = LTI_SETTING_NEVER;
    $lti->instructorchoiceallowroster = LTI_SETTING_NEVER;
    $lti->resourcekey  = $configsettings->partner_id;
    $lti->password = $configsettings->adminsecret;
    $lti->introformat = FORMAT_MOODLE;
    // The Kaltura tool URL includes the account partner id.
    $newuri = $configsettings->kaf_uri;
    $lti->toolurl = $newuri;
    if (!preg_match('/\/$/',$newuri)) {
        $lti->toolurl .= '/';
    }
    $lti->toolurl .= local_kaltura_get_endpoint($ltirequest['module']);
    // Do not force SSL. At the module level.
    $lti->forcessl = 0;
    $lti->cmid = $ltirequest['cmid'];

    // Check if a source URL was passed.  This means that a plug-in has requested to view a media entry and not a KAF interface.
    if (!isset($ltirequest['source']) || empty($ltirequest['source'])) {
        // If the Moodle site is configured to use HTTPS then this property will be used.
        $lti->securetool = 'https://'.local_kaltura_format_uri(trim($lti->toolurl));
        $lti->toolurl = 'http://'.local_kaltura_format_uri(trim($lti->toolurl));
    } else {
        $url = local_kaltura_format_uri($ltirequest['source']);
        // If the Moodle site is configured to use HTTPS then this property will be used.
        $lti->securetool = 'https://'.trim($url);
        $lti->toolurl = 'http://'.trim($url);
    }

    return $lti;
}

/**
 * This function converts an LTI request object into a properly formatted LTI request that can be consumed by Moodle's LTI local library.
 * The function is modeled closely after @see lti_view().  The code was refactored because the original function relied too heavily on
 * there being an LTI tool defined in the LTI activity instance table.
 * @param array $ltirequest An array with parameters specifying some required information for an LTI launch.
 * @param array $withblocks True if Moodle blocks are to be included on the page else false.
 * @return string Returns HTML required to initiate an LTI launch.
 */
function local_kaltura_request_lti_launch($ltirequest, $withblocks = true, $editor = null) {
    global $CFG, $USER;

    if(is_null($editor))
    {
        $editor = 'tinymce';
    }

    $requestparams = array();

    $lti = local_kaltura_format_lti_instance_object($ltirequest);

    $typeconfig = local_kaltura_format_typeconfig($lti, $withblocks);

    // This line was taken from @see lti_add_type.
    // Create a salt value to be used for signing passed data to extension services
    // The outcome service uses the service salt on the instance. This can be used
    // for communication with services not related to a specific LTI instance.
    $lti->servicesalt = uniqid('', true);

    // If SSL is forced, use HTTPS.
    $endpoint = $lti->toolurl;
    if (lti_request_is_using_ssl()) {
        $endpoint = $lti->securetool;
    }

    $requestparams = array_merge(lti_build_standard_request((object) $lti, null, false), lti_build_request((object) $lti, $typeconfig, $ltirequest['course']));
    if(!isset($requestparams['resource_link_id'])) // fix to moodle 2.8 issue where this function (lti_build_request) does not set resource_link_id value
    {
        $requestparams['resource_link_id'] = $lti->id;
    }

    // Moodle by default uses the Moodle user id.  Overriding this parameter to user the Moodle username.
    $requestparams['user_id'] = $USER->username;

    // This block of code is loosly based off code from @see lti_view().
    $urlparts = parse_url($CFG->wwwroot);
    $requestparams['tool_consumer_instance_guid'] = $urlparts['host'];

    $returnurlparams['unsigned'] = '0';
    $returnurlparams['editor'] = $editor;
    $returnurlparams['url'] = $endpoint;
    $returnurlparams['width'] = '100%';
    $returnurlparams['height'] = '600px';
//    $returnurlparams['entry_id'] = $ltirequest['entry_id'];
    $returnurlparams['title'] = $ltirequest['title'];

    // Add the return URL. We send the launch container along to help us avoid frames-within-frames when the user returns.
    $url = new moodle_url('/local/kaltura/service.php', $returnurlparams);
    $requestparams['launch_presentation_return_url'] = $url->out(false);

    $serviceurl = new moodle_url('/local/kaltura/service.php');
    $requestparams['lis_outcome_service_url'] = $serviceurl->out(false);

    // Add custom parameters
    $requestparams['custom_publishdata'] = local_kaltura_get_kaf_publishing_data();
    $requestparams['custom_publishdata_encoded'] = '1';
    $requestparams['custom_moodle_plugin_version'] = local_kaltura_get_config()->version;

    if (isset($ltirequest['submission'])) {
        $requestparams['assignment'] = $ltirequest['submission'];
    }

    // Specific settings for video presentation requests.
    if (isset($ltirequest['custom_disable_add_new'])) {
        $requestparams['custom_disable_add_new'] = $ltirequest['custom_disable_add_new'];
    }

    if (isset($ltirequest['custom_filter_type'])) {
        $requestparams['custom_filter_type'] = $ltirequest['custom_filter_type'];
    }

    $params = lti_sign_parameters($requestparams, $endpoint, 'POST', $lti->resourcekey, $lti->password);

    local_kaltura_strip_querystring($endpoint, $params);

    $debuglaunch = 0;

    $content = lti_post_launch_html($params, $endpoint, $debuglaunch);

    // Check if debugging is enabled.
    $enablelogging = get_config(KALTURA_PLUGIN_NAME, 'enable_logging');
    if (!empty($enablelogging)) {
        local_kaltura_log_data($ltirequest['module'], $endpoint, $params, true);
    }

    return $content;
}

/**
 * This function creates a JSON string of the courses the user is enrolled in and the LTI roles the user has in the course.
 * The JSON string is cached in the user's session global for efficiency purposes.
 * @return string A JSON data structure outlining the user's LTI roles in all of their enroled courses.
 */
function local_kaltura_get_kaf_publishing_data() {
    global $USER, $SITE;

    $role = is_siteadmin($USER->id) ? KALTURA_LTI_ADMIN_ROLE : KALTURA_LTI_INSTRUCTOR_ROLE;
    $json = new stdClass();
    $json->courses = array();
    $hascap = false;

    // If the user is not an admin then retrieve all of the user's enroled courses.
    if (KALTURA_LTI_ADMIN_ROLE != $role) {
        $courses = enrol_get_users_courses($USER->id, true, 'id,fullname,shortname', 'fullname ASC');
    } else {
        // Calling refactored code that allows for a limit on the number of courses returned.
        $courses = local_kaltura_get_user_capability_course('moodle/course:manageactivities', $USER->id, true, 'id,fullname,shortname', 'fullname ASC');
    }

    foreach ($courses as $course) {
        if ($course->id === $SITE->id) {
            // Don't want to include the site id in this list
            continue;
        }

        if (KALTURA_LTI_ADMIN_ROLE != $role) {
            // Check if the user has the manage capability in the course.
            $hascap = has_capability('moodle/course:manageactivities', context_course::instance($course->id), $USER->id, false);
            $role = $hascap ? KALTURA_LTI_INSTRUCTOR_ROLE : KALTURA_LTI_LEARNER_ROLE;
        }

        // The properties must be nameed "courseId", "courseName" and "roles".
        $data = new stdClass();
        $data->courseId = $course->id;
        $data->courseName = $course->fullname;
        $data->courseShortName = $course->shortname;
        $data->roles = $role;
        $json->courses[$course->id] = $data;
    }

    // Return an array with no pre-defined keys to structure the JSON the way Kaltura needs it to be.
    $json->courses = array_values($json->courses);

    return base64_encode(json_encode($json));
}


/**
 * NOTE: This function is refactored from @see get_user_capability_course() from accesslib.php.  The difference is the ability to
 * limit the number of records returned.
 *
 * This function gets the list of courses that this user has a particular capability in.
 * It is still not very efficient.
 *
 * @param string $capability Capability in question.
 * @param int $userid User ID or null for current user.
 * @param bool $doanything True if 'doanything' is permitted (default).
 * @param string $fieldsexceptid Leave blank if you only need 'id' in the course records;
 *   otherwise use a comma-separated list of the fields you require, not including id.
 * @param string $orderby If set, use a comma-separated list of fields from course
 *   table with sql modifiers (DESC) if needed.
 * @param string $limit Limit the set of data returned.
 * @return array Array of courses, may have zero entries. Or false if query failed.
 */
function local_kaltura_get_user_capability_course($capability, $userid = null, $doanything = true, $fieldsexceptid = '', $orderby = '', $limit = 200) {
    global $DB;

    // Convert fields list and ordering.
    $fieldlist = '';
    if ($fieldsexceptid) {
        $fields = explode(',', $fieldsexceptid);
        foreach($fields as $field) {
            $fieldlist .= ',c.'.$field;
        }
    }
    if ($orderby) {
        $fields = explode(',', $orderby);
        $orderby = '';
        foreach($fields as $field) {
            if ($orderby) {
                $orderby .= ',';
            }
            $orderby .= 'c.'.$field;
        }
        $orderby = 'ORDER BY '.$orderby;
    }

    // Obtain a list of everything relevant about all courses including context.
    // Note the result can be used directly as a context (we are going to), the course
    // fields are just appended.

    $contextpreload = context_helper::get_preload_record_columns_sql('x');

    $courses = array();
    $sql = "SELECT c.id $fieldlist, $contextpreload
              FROM {course} c
              JOIN {context} x ON (c.id=x.instanceid
                   AND x.contextlevel=".CONTEXT_COURSE.")
                   $orderby";
    $rs = $DB->get_recordset_sql($sql, null, 0, $limit);

    // Check capability for each course in turn.
    foreach ($rs as $course) {
        context_helper::preload_from_record($course);
        $context = context_course::instance($course->id);
        if (has_capability($capability, $context, $userid, $doanything)) {
            // We've got the capability. Make the record look like a course record
            // and store it
            $courses[] = $course;
        }
    }
    $rs->close();
    return empty($courses) ? array() : $courses;
}


/**
 * This function is based off of the code from @see lti_view().
 * @param string $endpoint The URL to access the KAF LTI tool.
 * @param string $params The signed parameters returned by @see lti_sign_parameters().
 */
function local_kaltura_strip_querystring($endpoint, $params) {
    $endpointurl = new moodle_url($endpoint);
    $endpointparams = $endpointurl->params();

    // Strip querystring params in endpoint url from $parms to avoid duplication.
    if (!empty($endpointparams) && !empty($parms)) {
        foreach (array_keys($endpointparams) as $paramname) {
            if (isset($parms[$paramname])) {
                unset($parms[$paramname]);
            }
        }
    }
}

/**
 * This function validates the parameters to see if all of the requirements for the module are met.
 * @param array $params An array of parameters
 * @return bool true if valid, otherwise false
 */
function local_kaltura_validate_mymedia_required_params($params) {
    $valid = true;

    $expectedkeys = array(
        // The activity instance id
        'id' => '',
        // The KAL module requested
        'module' => '',
        'course' => new stdClass(),
        'title' => '',
        'width' => '',
        'height' => '',
        'cmid' => '',
        'custom_publishdata' => '',
    );

    // Get keys that reside in both parameters and expectedkeys
    $matchingkeys = array_intersect_key($params, $expectedkeys);

    // The number of keys in the result should equal the number of expectedkeys
    if (count($expectedkeys) != count($matchingkeys)) {
        return false;
    }

    $invalid = !is_numeric($params['id']) || !is_numeric($params['width']) || !is_numeric($params['height']) || !is_numeric($params['cmid']) || !is_object($params['course']);

    if ($invalid) {
        return false;
    }

    return true;
}

/**
 * This function validates the parameters to see if all of the requirements for the module are met.
 * @param array $params An array of parameters
 * @return bool true if valid, otherwise false
 */
function local_kaltura_validate_mediagallery_required_params($params) {
    $valid = true;

    $expectedkeys = array(
        // The activity instance id
        'id' => '',
        // The KAL module requested
        'module' => '',
        'course' => new stdClass(),
        'title' => '',
        'width' => '',
        'height' => '',
        'cmid' => '',
        'custom_publishdata' => '',
    );

    // Get keys that reside in both parameters and expectedkeys
    $matchingkeys = array_intersect_key($params, $expectedkeys);

    // The number of keys in the result should equal the number of expectedkeys
    if (count($expectedkeys) != count($matchingkeys)) {
        return false;
    }

    $invalid = !is_numeric($params['id']) || !is_numeric($params['width']) || !is_numeric($params['height']) || !is_numeric($params['cmid']) || !is_object($params['course']);

    if ($invalid) {
        return false;
    }

    return true;
}


/**
 * This function searlizes an object or array and base 64 encodes it for storage into a table.
 * @param array|object $object An object or array.
 * @return string A base 64 encoded string of the parameter.
 */
function local_kaltura_encode_object_for_storage($object) {
    // Check if the parameter either an object or array of if it's empty.
    $data = $object;
    if (!is_array($data)) {
        $data = (array) $data;
    }

    if (empty($data) || (!is_array($object) && !is_object($object))) {
        return '';
    }

    return base64_encode(serialize($object));
}

/**
 * This function base 64 decodes and unsearlizes an object.
 * @param string $object A base 64 encoded string.
 * @return array|object An array or object.
 */
function local_kaltura_decode_object_for_storage($object) {
    // Check if the parameter is empty.
    if (empty($object)) {
        return '';
    }

    return unserialize(base64_decode($object));
}


/**
 * This function takes a KalturaMediaEntry or KalturaDataEntry object and converts it into a Moodle metadata object.
 * @param KalturaMediaEntry $object A KalturaMediaEntry object
 * @return object|bool A slimed down version of the KalturaMediaEntry object, with slightly different object property names.  Or false if an error was found.
 */
function local_kaltura_convert_kaltura_base_entry_object($object) {
    $metadata = new stdClass;

    if ($object instanceof KalturaMediaEntry) {

        $metadata->url = '';
        $metadata->dataurl = $object->dataUrl;
        $metadata->width = $object->width;
        $metadata->height = $object->height;
        $metadata->entryid = $object->id;
        $metadata->title = $object->name;
        $metadata->thumbnailurl = $object->thumbnailUrl;
        $metadata->duration = $object->duration;
        $metadata->description = $object->description;
        $metadata->createdat = $object->createdAt;
        $metadata->owner = $object->creatorId;
        $metadata->tags = $object->tags;
        $metadata->showtitle = 'on';
        $metadata->showdescription = 'on';
        $metadata->showowner = 'on';
        $metadata->player = '';
        $metadata->size = '';
    } else if ($object instanceof KalturaDataEntry) {

        $metadata->url = '';
        $metadata->dataurl = '';
        $metadata->url = '';
        $metadata->width = 0;
        $metadata->height = 0;
        $metadata->entryid = $object->id;
        $metadata->title = $object->name;
        $metadata->thumbnailurl = $object->thumbnailUrl;
        $metadata->duration = 0;
        $metadata->description = $object->description;
        $metadata->createdat = $object->createdAt;
        $metadata->owner = $object->creatorId;
        $metadata->tags = $object->tags;
        $metadata->showtitle = 'on';
        $metadata->showdescription = 'on';
        $metadata->showowner = 'on';
        $metadata->player = '';
        $metadata->size = '';
    } else {
        $metadata = false;
    }

    return $metadata;
}

function local_kaltura_build_kaf_uri($source_url) {
    $kaf_uri = local_kaltura_get_config()->kaf_uri;
    $parsed_source_url = parse_url($source_url);
    if ($parsed_source_url['host'] == KALTURA_URI_TOKEN) {
        return $source_url;
    }
    if(!empty($parsed_source_url['path'])) {
        $kaf_uri = parse_url($kaf_uri);
        $source_host_and_path = $parsed_source_url['host'] . $parsed_source_url['path'];
        $kaf_uri_host_and_path = $kaf_uri['host'] . (isset($kaf_uri['path']) ? $kaf_uri['path'] : '');

        $source_url = str_replace($kaf_uri_host_and_path, '', $source_host_and_path);
        $source_url = 'http://' . KALTURA_URI_TOKEN . $source_url;
    }

    return $source_url;
}


function local_kaltura_validate_entry_id($kalvidres) {
    $lulist =
    '0_ddjjlwnu,0_aqwhe2ha;0_8d4ytpkx,0_jp1aliei;0_xpa941y3,0_uc1fvw58;0_3kgxsm11,0_bm65skwv;0_v8lbtpnm,0_blabhtj0;0_s74u6058,0_6oaqe81x;0_x2qx6z77,0_vw0j8kke;0_bvykjm7p,0_eohrdrt7;0_jk5bx5tr,0_csnnruub;
    0_yam5eqqi,0_et7u5ada;0_7e5r5v2v,0_qpx6fmsu;0_72h4hgr8,0_pehbn663;0_93vcfriz,0_d2ihhuo5;0_edk5mof6,0_v5qh09jg;0_sf7p4xk1,0_bmx8kh0o;0_73ioqapg,0_ix2gzz6c;0_cdc9mhif,0_zi3negub;0_w6bfa416,0_s42sq582;
    0_lh2554sc,0_jmk2wacj;0_urdspowe,0_xqb7hm2n;0_gb0vg4wu,0_ogi1b5bc;0_p1awwuvg,0_guspzr9y;0_qogqxgyk,0_jztn4x0b;0_3vwn1sqn,0_f0nkpzqs;0_2xn48hqw,0_7y42mjaj;0_uvd9r1b4,0_5omsxh5s;0_renps3j4,0_ao8l0r65;
    0_o8bv5vc4,0_vp4t60sw;0_7vb6o6fq,0_s7a13vix;0_s0hbompn,0_k7pwqmtb;0_1tss73wz,0_hryapl7x;0_f3fbc1pv,0_8zptvicz;0_mls9ezia,0_t5r2svwh;0_ntbo0gt9,0_eca0b1cj;0_qbwvnzza,0_erkr3k84;0_g0wdjwhe,0_zdmmeffa;
    0_2mdx7uns,0_aydxl3jp;0_1me53dzv,0_yfajfq7e;0_xbcddjq6,0_v6wdiu32;0_la31xlqj,0_plygqref;0_mc9km3pk,0_ctwrn6ie;0_87eg6naw,0_sj4k0a2w;0_t3ku4p60,0_chvnucyo;0_ajewf6ze,0_tj6zhxac;0_svgoqo6i,0_4z8ugv6r;
    0_53228c1i,0_6iq3jcyy;0_5quki5km,0_qo3bsv2g;0_flketvlb,0_ussn2l1f;0_0lmveflh,0_1qmlgypl;0_6oxetqbw,0_01igcwup;0_k31zlf74,0_nyxcy30s;0_4niobcor,0_6kucmia6;0_e8nhoa1b,0_gcj0t0va;0_j1edkihn,0_u1v9thit;
    0_n2ouebv6,0_o3ab5smg;0_6gmz2mtz,0_jc7pbcnt;0_ctvdtwpc,0_uhjrkcw4;0_hf5g7b5m,0_9mwdtqud;0_ld58jkii,0_fg8ihire;0_8vach6nm,0_trkytfgh;0_m7eghm5q,0_ljpp1532;0_oxs0loae,0_4bl3iie9;0_dnif7i5z,0_l7s4ntc1;
    0_ztn9td56,0_tf1ksu95;0_po9h66on,0_9bxtzekk;0_f7t9u3xn,0_wlo2pqj7;0_ejctn85d,0_kxr2cq3r;0_54b7qvuq,0_vbowg6gc;0_m5wg104o,0_iwmob0k6;0_zznysy0g,0_2alt4njy;0_gvw1ztet,0_cmgctbdl;0_sj6mzmol,0_9oq1hkdp;
    0_a9wmnk6n,0_ape4or2f;0_zujs1i76,0_ic58jp08;0_yk4o743s,0_f6swo29b;0_flfwq5kd,0_9y1m2z94;0_paabfzqh,0_m6aqsm90;0_3r1moyg9,0_6wgskbwn;0_3vvr5rud,0_3uac9d36;0_9jd4yxli,0_umu9sfg6;0_vf6aui21,0_23ajagcj;
    0_j8u9dxn5,0_9cfolmea;0_0k4a34rm,0_0yk2guqb;0_qv66dbvz,0_wn9s42j5;0_gppm3645,0_wt6n6f4p;0_zubfjj0k,0_3sxd2z50;0_c4d695e3,0_85ef5q79;0_t090bwc1,0_gkhyxifv;0_291e1whq,0_8nqgrauf;0_vbpn4002,0_in8ycw7l;
    0_i17fxd15,0_j3dftcmc;0_wpz738w2,0_0vhcbsp2;0_5kk0xgxa,0_m3o90o54;0_7jk9r2kz,0_8ge8jhed;0_1qughcgy,0_yj90giu2;0_3yeafa8h,0_cq1hm53e;0_kn2844s5,0_j0mxyikg;0_zbo2gyhh,0_6694dego;0_dd0cqvn3,0_ihk0wo14;
    0_6aajm4s3,0_yimzpbzg;0_f5w3cera,0_qfzj3cye;0_6548zwz3,0_937e5jn6;0_srmyq1bg,0_lnvs1qep;0_frh32kvd,0_w7xbfidn;0_delgiueb,0_x9xqvrtd;0_52a7obwu,0_pvfgeoja;0_rwrnjpio,0_aimk3pxa;0_imt8ia3q,0_6y8j540o;
    0_tqpp596j,0_spld83s6;0_yyr05i2b,0_vpmop4ro;0_is0souw2,0_sl9ol30r;0_c2c30a6v,0_wmvs2xtm;0_fhv2tmmu,0_yb9v1ibd;0_0eg3du2g,0_q1drz6ci;0_m957m6c7,0_xgsivw5i;0_ey9u73al,0_sa2ib8x8;0_ydip4rsc,0_ir56b9t8;
    0_62q8mvno,0_m58w6ev3;0_vza2t5gj,0_49r6r7ew;0_eukk1qeu,0_tk826106;0_i65vjfph,0_hzipgkqp;0_090kew55,0_amk1bx98;0_i1tsbq3i,0_mcx0uc5x;0_t8n7hilj,0_5mf7s9cp;0_dsdjssl4,0_bsfixtlp;0_1mmo55xl,0_yoz4hdy0;
    0_62upwkpc,0_7i5diwlp;0_pl0frmqd,0_qidswil9;0_u1a4kr6p,0_wpq3tdkd;0_nzynkyvo,0_ji8nrgo4;0_849rc69i,0_pqud6eb1;0_imtqzr4p,0_q5m844ac;0_qj8jnjf5,0_9r74gvo6;0_0uhye1af,0_pqlynzaw;0_s8apvsh9,0_5gf5rz1l;
    0_qh6pjp3b,0_lwfsvyyf;0_70vj1z6v,0_hckf5nyd;0_m9gyg43q,0_pshc20cr;0_db8qai5q,0_763d55yd;0_ujx0r8i0,0_ubdk3w8y;0_phy8g45q,0_o7qjvv53;0_a257wspd,0_xeielv2t;0_ryt3ig57,0_64srj3cj;0_rajo45j9,0_tz9i3s6p;
    0_4zdgsrvw,0_fr620sx6;0_9x6ym2pf,0_l0ryodv9;0_igvkcaoa,0_kwykbwm0;0_2jtem444,0_dxax34f5;0_6jkyblkm,0_ydys1byx;0_emd82djp,0_06rmk2k4;0_d3exuyit,0_f49b1dm4;0_acbdy4ym,0_idy3f2et;0_89ym81fs,0_ktvsoc1t;
    0_p4j9kskq,0_a4vp8in3;0_9tnaun2w,0_eedy6wks;0_9nucfxa5,0_sn3emf1l;0_70zkcefp,0_kwjiizf8;0_anyy5xbk,0_wiiaizmf;0_p1bf19y5,0_gf23t7fv;0_s9y6e5fw,0_xnjl6dao;0_30fxr5za,0_ak12gzx8;0_8mvifsao,0_wuv6cweo;
    0_yq5cyqc4,0_khvjbe4s;0_x8hej5q5,0_ncehxqdj;0_rditzy5e,0_qoprgo6i;0_2xbhmwr0,0_jzc7ysel;0_8t9wogay,0_fjq8qm5c;0_n3nibju6,0_3krxm4r5;0_hg9irgsn,0_u9pp53w9;0_f4rni15y,0_2snzln6f;0_0v1wnjrp,0_ih2gxgxa;
    0_jzlr127y,0_hyjw5osx;0_9gzx0la9,0_xp6ub8h0;0_kuazxxy2,0_o3wz9aao;0_kpwgbsqg,0_xppdamyx;0_5z2zdyz2,0_zn15xfjm;0_gqcpratb,0_moiv7dsw;0_x1vv21ct,0_cfbg72bh;0_rs3jr657,0_j5xrjjl4;0_1tmywqu9,0_ilc6rhh8;
    0_k7iogr55,0_kzb3kcg5;0_ru375r0l,0_g3alnvtf;0_ujhkc1zo,0_5k1h75e2;0_ad7325bn,0_h4zpfgny;0_1ddeu6ka,0_1tbowig5;0_l5owrq6v,0_o994hq20;0_fqedj9i1,0_th1jndgs;0_v2tnwxrt,0_tm0txvi8;0_ivkwp3l2,0_sdue0j3b;
    0_z44e1240,0_t68ffshz;0_harbzuwq,0_jskgvy19;0_exbjq1l2,0_nbzoziby;0_nv4cxua7,0_94ydpmle;0_6y9u3f5b,0_0ehvw2se;0_t57wrphn,0_jont1buu;0_obcy3xvw,0_te71mq7i;0_mxqg1c9g,0_869gbcv7;0_02d1i4gu,0_arxmj1on;
    0_xrff49tj,0_lpcmzneh;0_y3wxq1zu,0_y7t1pr0a;0_789awail,0_htupcbtx;0_b5po3abr,0_8j8s84mh;0_g3lhimtk,0_jystksd3;0_jdwp7m5n,0_avoo8afg;0_gthguymc,0_qma1yaqx;0_paih1yda,0_4eusgozb;0_xdly4hye,0_tlppu84c;
    0_odpg4v57,0_fz8t0mj1;0_mkczhgt7,0_209yuacq;0_oiyy2nxj,0_10pafzdm;0_78n0asoi,0_ro2wxcl8;0_l10jlgtn,0_5gng9z6c;0_rcs9dp7g,0_p9dd836a;0_h8u3g4xg,0_0cnpt7zx;0_qafmo4f8,0_15acfkm5;0_azk1chec,0_fqjnwba7;
    0_k45ojcvl,0_uax13q0h;0_vpnfrebb,0_6ehkhbyo;0_5xnzlqvl,0_n6fn4bfi;0_ra0rhvg8,0_uh9s5csw;0_xc77vbo5,0_nnxrwf85;0_r8206s0h,0_etuyun1i;0_mypes7e0,0_995fyaap;0_a8gp643l,0_ytoy2b03;0_8fbo45zp,0_qlxtv9fd;
    0_uggsffvh,0_8kwu8bki;0_j5juheg2,0_qv5xd12o;0_wqbdfx1o,0_ipjaj3c3;0_36mpx3ur,0_9bxnhj8p;0_ktcouo08,0_5s6b1los;0_eabkjy8u,0_alav4f4v;0_5kmory56,0_gsnvny6g;0_3wa12za1,0_4ygfj3jb;0_9pe3jdea,0_gezbjabb;
    0_fsy2ofc8,0_0ofrccmp;0_jzwcdrl5,0_elwapakk;0_upqlvlt8,0_l346zr1h;0_osqpmt1t,0_pph9gg6y;0_ysclzmag,0_38rfhlvs;0_boviifgl,0_f9d38bvt;0_ykblun6b,0_hkvz5lvo;0_7t0slvjt,0_h6clapz1;0_d5p4lyoj,0_daieam6v;
    0_dr45joq4,0_sp7kyklt;0_dt9t6yqy,0_oy6trxwd;0_ofbkvlbk,0_o9hx6h2s;0_uf3ezvc1,0_jsn4qwkh;0_rmovgy8n,0_ne43iak3;0_8rtpx48q,0_2l5c6ot8;0_clm6ky9v,0_lmmoibi4;0_g6qk62yi,0_1g1knzk8;0_ilsivb47,0_yh0fk52c;
    0_45oh8ooq,0_jh2hgqgp;0_ol8nyl55,0_dwwzfxnb;0_yi0ap3jx,0_o2nzpbcb;0_5k77ap8b,0_6pd027mb;0_sqeninjf,0_odvp3lu6;0_ry3ve50a,0_11qjox0x;0_5yywqidj,0_fzkz63g5;0_lc84n16k,0_kqmqppzq;0_f0f8787v,0_10b3eh0h;
    0_j3hoi29p,0_6iyjkbvk;0_ld4j0pkv,0_8ma7rlm8;0_1cvijbre,0_be7dtc46;0_ukg9107e,0_1mwph5qw;0_eqxvvx5c,0_k4fbdhan;0_hed3p5we,0_lfw9wfkv;0_dhkhv6cs,0_5oxyz1kk;0_vke0psoe,0_obozgjcc;0_n8obygiz,0_eobyp8z9;
    0_ledv5d7u,0_t20k1u4v;0_jo0ol17n,0_95k1xaki;0_ylm3uksy,0_qbcnlhen;0_58tt49we,0_00ez4pek;0_ec6ge7vc,0_7fpgupa0;0_wo09l82v,0_2m7rpl5y;0_k1inuesb,0_hif11srq;0_52r7ggrj,0_7ifmin6w;0_6k12z3ty,0_e3rx36h8;
    0_yud5mibp,0_3581ci54;0_mp3u8jw6,0_ugcny81k;0_eqpk2g77,0_1n7157c9;0_y8s53tdv,0_o7b9cdds;0_3qt6a96p,0_fb4q467d;0_4mq0tah0,0_hton60ly;0_8dbqa4wj,0_gmdbbzur;0_8knjtsrs,0_14f9wk8q;0_k7vfhh9a,0_kaz1xli5;
    0_tzo872mp,0_rpsg7f7g;0_241d7jom,0_byto79y1;0_umuyx017,0_6iwkkmqm;0_dd3rdnox,0_3sgva299;0_x9oraz4q,0_aqdccefl;0_sdpmry6c,0_1koy0uyv;0_123ucezc,0_bqlsys02;0_rjm3dg09,0_cjrjk7lk;0_rj0y0ja5,0_lifaopge;
    0_4wst11pa,0_d8wuse0m;0_zehg8b3v,0_2qldxp3t;0_vb0mj854,0_vhzf9hfu;0_ymecm9wa,0_7glcohsu;0_czl74va7,0_6maj4ohy;0_7ex7ro40,0_a3i139gr;0_p8hny87x,0_vrurhv68;0_mvnm6j31,0_3vpnx30i;0_heh0qz1w,0_62aqkupd;
    0_gza4na3s,0_duk4gjr8;0_qhomc539,0_ui5404ur;0_zstndsjs,0_ypykhr60;0_w5lipc38,0_997y0mdl;0_wr24u2yn,0_e662dmza;0_w7ll37w3,0_dkb1daa5;0_bhyf2kd4,0_442az8px;0_c3a43n4m,0_2kjo6kpe;0_8yu25ywz,0_ojbs17j3;
    0_l1uf8vmk,0_xdmzbl9x;0_unh8r5w3,0_eet06sbh;0_s06g9iv2,0_aorir9d4;0_p21kp44r,0_dj8qaeil;0_xt5nutj7,0_6bu282sf;0_eud6cvuy,0_dge0q92w;0_hfb0bdbo,0_8n9r5mr4;0_h1nzycpf,0_3pbxt57d;0_6rd0szs3,0_12g9tdjk;
    0_d2pa8ack,0_na6qfp6h;0_m50djl60,0_4u599evg;0_twma0tin,0_s7lwsdt1;0_bgoihuqk,0_tvic5bw1;0_ij9snvi7,0_5l2sq104;0_ummlrogt,0_wc3hdl8u;0_5sbls80i,0_u3ky4fzd;0_sevliml6,0_xjz7wtki;0_63li3dls,0_vpte6w45;
    0_m23o0duw,0_9ndvxrce;0_vfrrh94h,0_zm655j07;0_brmr01s8,0_ofv33z4j;0_szrfpqdr,0_rxhvmwwd;0_apqolyqw,0_o9200qqg;0_16hl3qpq,0_c4m8zlj0;0_4koo8nug,0_03j3mmh6;0_lt8di8u7,0_26va7yar;0_crh50sa1,0_q8kopjag;
    0_dp9ipspw,0_ng1pgdm2;0_wjv2kvfu,0_spzzff1h;0_8ta9hdyx,0_l5xqju40;0_w336npwu,0_xseelwp5;0_6z7cu5im,0_b5rqaizt;0_75fbcfwf,0_ghpe5y5v;0_bs8a2gmn,0_bcvbkrg4;0_mypc9prq,0_40ofsx3x;0_0szlyl36,0_pl6dicfa;
    0_7d96b9bu,0_snc8bt13;0_6hi0tmdp,0_i17m26pu;0_00yt04ju,0_r7pdel1o;0_tbik3i64,0_8gyvr3qv;0_eip1pil3,0_xadm1raa;0_xp9kswv4,0_irpjd6dq;0_k0jlgnck,0_9xkgxvg1;0_anjdatrf,0_xekrsou5;0_pgus6vre,0_s1a0yy0b;
    0_8y3a4213,0_0zh9rzuf;0_5ruw43ps,0_ybs5i8hi;0_75db4bl4,0_eqx45otg;0_6vrejjty,0_uk4pgix3;0_zr2jsiuu,0_sdujmlvi;0_9vnk1u8g,0_7yawkdu2;0_pg95bwey,0_5h6ia3nt;0_y5s6w93g,0_kxbbb2qf;0_vjzszskc,0_ox64kfth;
    0_5euoq0bi,0_ixmbjn0r;0_lmy79uvr,0_quepquwx;0_ewtqlv9x,0_ge76xb4i;0_jbsyxk4f,0_eapr1j71;0_tyvpm0o3,0_nxw5qcmq;0_6k7s5pwf,0_7321n81z;0_2xchxrmj,0_o2sz3bjk;0_ihac7r56,0_pjo3etr9;0_earwew1u,0_nohd9btz;
    0_8z13qeph,0_9ua5glvz;0_lwq02dnx,0_0zeiwc6t;0_n01mwwl4,0_rwmldnl3;0_dkrw1ydv,0_po06h8os;0_g6aczuap,0_wm2org0z;0_aqd64v82,0_xobgipqa;0_w3znmgac,0_6lmxzkd1;0_cbl308yn,0_ovoct3xx;0_utyvqo2t,0_d6gkrh5r;
    0_e8lgatzn,0_fr0s6b04;0_sog2hhsw,0_0t16njy1;0_koxr4ouf,0_nuexfpc9;0_ukih60ed,0_xbfahfom;0_nkubjdnb,0_xd9eqfqs;0_v4mh7a5c,0_gm0j9xtr;0_8i9slrdm,0_82w0eb3j;0_82qp44cy,0_idzmy42j;0_ciytzzc7,0_91uu6yxa;
    0_faa4zicr,0_xj0pgpk7;0_4v39ui07,0_rb3oaudp;0_rbjznia8,0_zcawadkg;0_9ueba0bq,0_5t0ym1k9;0_1ani8owi,0_4pjmlj3z;0_pdno503o,0_y2ocs3m0;0_d0453vzi,0_i12ql9rv;0_llx975az,0_nlwwnz66;0_xbtw39ub,0_ivhgz1ee;
    0_yei6q3a0,0_80nnlpxi;0_lw2m81a0,0_4mtkrxzx;0_iid9lpvs,0_gg7ih07g;0_kvvd527x,0_34y8do73;0_rk5fries,0_uj5zgg8y;0_3302ta5c,0_rse1a7tx;0_29j6bb5p,0_l0n9kfnv;0_6mr260qz,0_41i9jui5;0_yr9m4pmy,0_4nky06m3;
    0_0xb27z7p,0_gflfv2bt;0_764k0xpu,0_3mxl27an;0_h8i6biau,0_jouhbg7m;0_itcr0nid,0_y2w0yfp4;0_tqipizxe,0_59f1yb0r;0_66zv7980,0_tnhx7fxk;0_purdctfw,0_9zp77qfl;0_hkw6cmpu,0_gd0l9ibi;0_b6yl4apg,0_amjcobeb;
    0_a4xm4ln0,0_9oo80iu9;0_hm2974qu,0_mpqrvgzp;0_00hxx4s8,0_s3qn03w9;0_sy46w5yv,0_5t9tj1mj;0_jn95g93w,0_l9fue2zm;0_e1qhbtpe,0_gn8ns3jv;0_zv6tnpr9,0_ixm7gxk0;0_9phjnduo,0_aa4izpis;0_4osh5sq5,0_ixq3osjv;
    0_2vxzv71n,0_k13ge4e1;0_aoqyft74,0_snunfavs;0_qsww82le,0_pbzqbsmf;0_9nj1go5j,0_ful0ult0;0_4k2s2uyd,0_7q7ot5zj;0_z8fdrzgr,0_mk8kkd7o;0_uj13m1m4,0_jehyijln;0_cpx9h1ob,0_urcbh8b9;0_dfdfobrn,0_41ct1cv1;
    0_m9m3tluj,0_qijq2jqj;0_13dxcxrj,0_l348uxfn;0_2vmdg00r,0_vnijpmvc;0_2iprisub,0_i06hkezi;0_d399wu5m,0_plvsqryk;0_wxe73zfc,0_u3tbjbbs;0_a79z3vhi,0_iqwvwa4c;0_tr75xmn6,0_1bufeakp;0_yet77mam,0_szv22q73;
    0_pkj3nsf5,0_h1dt1ka8;0_d3l1zht5,0_8z31vck2;0_0s3zvscs,0_bpy8p3vm;0_1qoivz46,0_gqpsyy2i;0_ylnatds8,0_osg4bsd4;0_o3olsuaw,0_x8u14kcf;0_o4toj82e,0_zkmu6384;0_08mhliff,0_fojor3q8;0_jqhlk7qd,0_8n04jnc7;
    0_yxpmwdim,0_1mc1rbnj;0_365tb833,0_c3pmmhcc;0_atzlohnr,0_g0j2r4b7;0_j7wnqnvw,0_3jkk7f2y;0_p5sccrlm,0_i9smc59i;0_zdvws0jp,0_vj76aufk;0_79ssqrgh,0_bxvdssj6;0_0m42plxk,0_v9qbwt7n;0_ukhks76i,0_3lwcs7yy;
    0_av8c8bfw,0_mvvnbcya;0_2z3b5o5f,0_8heqhp0e;0_nu60nwa1,0_t3rzucd1;0_6gwcl8wh,0_wivdilgk;0_3dxgfann,0_2gma5y26;0_c5xzaj3n,0_du616k7f;0_2jztzsae,0_hxsczb6q;0_x1gp2fsw,0_waukq1bm;0_ed1p682k,0_7ukhcfwk;
    0_8bjt46as,0_cqzztkgi;0_djdyxg6k,0_sz3yws0h;0_m2foezjl,0_9quik631;0_ywql7zaz,0_am84473v;0_apqd5dhd,0_r0leea5k;0_n0t79mvj,0_rfk16qua;0_6ru4v5jm,0_5d3t26bz;0_udx8vl0g,0_pfcdatwi;0_3j20ptga,0_tzlbobux;
    0_3kc8jcht,0_fkd9r2vn;0_9nwuxtfz,0_o83oo9x8;0_6cgkpddl,0_uw1p2kqj;0_xv4eztnx,0_r91jxmtd;0_get2n4e4,0_x6ir79fu;0_nk5jd1x0,0_dawib78u;0_uw1mbf81,0_0igzogvu;0_652dmbdg,0_pjfcjlny;0_ef4i9sjr,0_pndds1og;
    0_2ue9opph,0_e40x006h;0_0vg3phq7,0_0as38x7d;0_zz8qwk3q,0_btt88d2i;0_l2464343,0_gd3kmel9;0_7ql3zbes,0_350cpp2g;0_xethmku4,0_iciws6qv;0_97lgfmva,0_d5jkna8i;0_kdvlcwly,0_5velxaji;0_pv85beom,0_nq5g02a2;
    0_818i2jm2,0_ev7kf07q;0_3gaunulr,0_m6lcsx1l;0_l77tbqgd,0_gnpmzte7;0_68v8u2ot,0_kmlbl5vp;0_ufagsjqf,0_5kefbqix;0_8u80apa0,0_rtxqck4e;0_cacyvexw,0_inmubuep;0_fzo89vh4,0_nd1rgjw6;0_kfzznvca,0_pbib4fhm;
    0_ow844lqd,0_1dbk15xd;0_df309y7c,0_nrs304ka;0_6qrg9t6r,0_p5fh4nq4;0_z3sgou42,0_xs23woj5;0_eluvwg02,0_rsfnloz3;0_53th4ixm,0_cs6ffokv;0_ksdlhbg9,0_uv573o38;0_rxofcw4t,0_nh3kcspe;0_3clmsdhy,0_wugktya7;
    0_0lminan0,0_ekowl46d;0_aruyqqwm,0_6unnmhse;0_7u33y1kq,0_uypdhxs6;0_l7y8cbix,0_xqsdig3w;0_792eqwi3,0_tturt4u7;0_h8398mi5,0_v8jq47cv;0_o91ypsdw,0_6lnxktwt;0_8wswk8f2,0_544stn7l;0_cqrha8zf,0_rn5mak07;
    0_iks5k4i1,0_mv0jrs70;0_tdys54z5,0_fmxuf9qn;0_z10910gd,0_pwkennl9;0_9oom05xv,0_1mezlw0h;0_5r2s3u9j,0_wqwtibgy;0_er0nhxxx,0_32vj1tdd;0_yv17nps3,0_r2iykghn;0_wujkmd7t,0_fcvkatqh;0_rb9aucwg,0_gv9ekb0l;
    0_dzniuewp,0_coj2wjz7;0_c8xi5q2e,0_rkl0y2nb;0_ja6s6wpk,0_xx3a4721;0_72wjrspf,0_wyatmv13;0_w819gkyi,0_pe79wg0g;0_s3eu2wcj,0_yab90jgl;0_taq66n2x,0_e5hwtqjx;0_emwhrdlr,0_s3j9abyx;0_tb24741z,0_nxvvp2t1;
    0_o9qxy8mn,0_1gv0ik2e;0_r6mvmzj7,0_0n7s12ag;0_tp3actmf,0_oj29qied;0_vpmemj2y,0_k1juqcvl;0_uju0obdc,0_vk49kqlf;0_422qpjwe,0_g20p5a5x;0_ntr9fcse,0_8dfsqwag;0_b8u1opv7,0_id5a7wy9;0_zd6aau14,0_x9d60jp0;
    0_39nv3u9j,0_167l0ahl;0_1gi2jp6l,0_819do9m0;0_zhpodp0l,0_9090bhbi;0_fv5edce6,0_t3nb68iq;0_bjo22juv,0_fg4cxss9;0_0287f8k0,0_wtbdpq64;0_4mcpi86f,0_tkwwargj;0_2pe4kr8p,0_5wqysh4g;0_nuso4mrb,0_21io2z50;
    0_uqe4s3h0,0_2rc6ug54;0_chi1erod,0_e4d1bc28;0_c1brczqc,0_qy8xg4p5;0_9dp0n5bh,0_7lfxmdz5;0_g83vlx5n,0_cm1wa1ek;0_5eructhk,0_l1m2jyae;0_31wl71l5,0_zjix65e4;0_v1il0amk,0_dkyyb3mn;0_vvmm54el,0_6h83i4ox;
    0_d54vcpb8,0_em6bhqf8;0_u8s9v72o,0_aov4lkmd;0_e4pn5uj7,0_za1s9h6u;0_sqklnkrl,0_0tbzwd4h;0_c4ftgwb5,0_24qd7mv2;0_z2wjkq7q,0_wtxn9rro;0_761lyjcg,0_41vw2z04;0_9r7scpvs,0_cxtw7tbs;0_bely9sel,0_mmboy3rt;
    0_imdjgs3g,0_vpn9mbii;0_5ydspuxg,0_mhw2ic8f;0_mw5snims,0_0dolevr0;0_bpa5dm5h,0_4joytxq2;0_8ilerjc5,0_ujkhz9hj;0_yauwdz1f,0_68xg3e9k;0_d10ncqx6,0_789liorg;0_ded5fzes,0_nrysxszs;0_jz0yd677,0_1pxtwuid;
    0_h7dtkzcb,0_lp4sj823;0_qxkzyrzd,0_bjgaeql1;0_b4cc2zg1,0_z53c3kjw;0_ajmqbivb,0_fdh3vwc9;0_rj68p23v,0_qo09v98b;0_79ifvel8,0_5uxr1tou;0_w9m7hija,0_gpqsnasr;0_vsr0qvcw,0_yqt8zy9l;0_92npvzjo,0_lfd8glq7;
    0_04u1eaqb,0_onrgttpm;0_tzlrlshq,0_b8xyg0qq;0_cd3gxdni,0_ra1fjpye;0_7xx9ikns,0_qxfz2chb;0_cam3gcxf,0_3w755tmm;0_qph6j4xv,0_revk8zve;0_953nh4lq,0_ply3lwk2;0_brvv8oo2,0_mgilbi4x;0_fs06qvdp,0_ue8e4mmt;
    0_bxvugq6u,0_94do5vrz;0_9xo30lvh,0_sktmpekt;0_sxja6836,0_88dyrta1;0_nqdzmw2p,0_u0n5yl37;0_r0v2094l,0_wc4dgw97;0_q9h9awm5,0_2fbz02fu;0_w571s3nr,0_o6xqis8n;0_9yl8wzyg,0_sqwsav1n;0_ks5flgly,0_2hrxjnco;
    0_ws8xrjpx,0_un93pvg6;0_7wygc3g8,0_fdi3ycf0;0_1orcxlai,0_33ovhpgr;0_zsefovj9,0_cb66drtd;0_ezkraqmx,0_8fecfn8c;0_e4cb8gak,0_9qa7knpb;0_w9xyyjqh,0_6osgstv0;0_0mnux2gz,0_bnh9og81;0_t5y0i76n,0_c3vq2f2e;
    0_g5yvdchv,0_h4dm28s1;0_s5gljyxw,0_3hpd9z58;0_27n48eg8,0_dxwtor66;0_s93rm07x,0_ptbig65a;0_lq3hobby,0_o5qn84qu;0_fdi6s7hf,0_w52xsi48;0_faw55ocf,0_bllfmdha;0_8zv3j498,0_k7yb6psh;0_aiye21sj,0_6z3ddr81;
    0_okdog8o1,0_a2sh9inc;0_wssmky8l,0_kjsdoowo;0_187w9n9h,0_owp9j062;0_kswu6av3,0_p8d0q7az;0_rcbz4irk,0_6x8hlay4;0_52tjcx59,0_caxy03tn;0_n08ilt3e,0_wz9432uf;0_q8uetidk,0_pa5zf4jb;0_rzput1xp,0_s4oa28su;
    0_xxtgm51y,0_djc9upgl;0_hljuf29h,0_3m0txrvj;0_n1ii5yrg,0_k0mkkp14;0_a0zl5kfc,0_degplorf;0_cdnavavp,0_3lvgj1gw;0_kz8evsly,0_gkallukn;0_f75s5bfx,0_f9bqkn8t;0_hw763b2h,0_cmk6yquo;0_fvevqs7x,0_ldf108bm;
    0_y1in7flv,0_e6cyczer;0_ygs0v5qv,0_3nkuzb1x;0_g2ixsb4b,0_78idob19;0_dj9hzvle,0_ndao3apx;0_hzc7l0c7,0_5y7h5ifi;0_vy4srhjc,0_gal62fji;0_k8sqbhs4,0_p5qjhnnd;0_rogpzzzn,0_l5nr962k;0_2fe4wk28,0_k3cgvztx;
    0_l4wqxezd,0_mtghoya7;0_z8j0pp1p,0_lgsoq8wx;0_ff9xiqmk,0_1skr5im8;0_9jzp2pia,0_oa7xdd35;0_2272fyqy,0_ev7h756a;0_i82i3sf8,0_upmdv1c1;0_2w4vzpod,0_yemvexwp;0_i8ok3lbl,0_jeeutr4j;0_72to796c,0_xwunkzbn;
    0_x5w355w4,0_3wc99pnl;0_wksdqsr8,0_doahxeyt;0_wdzxzdnb,0_ng6vywqo;0_zff1p5v1,0_pn2w3spc;0_wjxdm920,0_rzp3bb7n;0_xcjylhly,0_n47fulck;0_nqo7nng5,0_19fo1wmh;0_sz8rvl7h,0_wfp46k3b;0_aztx4rf6,0_560af8v7;
    0_42zjpjd9,0_s46ryp5r;0_up3sylro,0_6yz81lu2;0_w5nl8re6,0_o7krkytv;0_5s9m3tro,0_zoxoxmry;0_x4mx0fj0,0_6tcbn0xl;0_0n2t7t8j,0_33qtsi34;0_jmo6ltxy,0_hur67n7x;0_pqgd6kz2,0_7zg77otp;0_yhpptatz,0_7lx3hpb4;
    0_183sfzr7,0_g7huu9le;0_uqv5xl42,0_n0pc45yp;0_kbbp79u4,0_kgqppl4m;0_so2k9jhk,0_885vbg0q;0_mfabuwc6,0_jg7inrma;0_11sp02iq,0_obmr9axv;0_bmsrsuif,0_kc2fgwah;0_jscqo16o,0_wfvgf0mn;0_g7pc59fg,0_p0c8ws2o;
    0_xejhe13y,0_c1nvi8re;0_w33sw6d8,0_il50ufzo;0_6hnmiovt,0_h82z4c1t;0_dcslkh3i,0_k0qcjb8p;0_223wuv6q,0_tr7rfy52;0_as8z1o89,0_5pkqpj14;0_pncxcexz,0_4jkziu88;0_8po78orq,0_z7vupy6x;0_qn767s06,0_xqdtq77n;
    0_6jj1olv5,0_hbvg4hx2;0_jg78ztah,0_llhewi41;0_mt0l5f69,0_lyz5n87m;0_bfkuhelm,0_gqdgr49q;0_qwbu16q4,0_o9zzsl9v;0_qfpzji6z,0_tphuojx4;0_wcq2fbts,0_0dljscmt;0_b6ebpwkz,0_nkkmnu6k;0_fd1n94m4,0_3e1od8ep;
    0_efovtfre,0_743xa5cv;0_35jtx4jf,0_o2iq0kf7;0_ihohd62b,0_gpajwumt;0_4xkja4nk,0_m88q4fjp;0_d11ms1vm,0_u9sgwbav;0_3mf0qurl,0_5vaj30ad;0_89hvow4t,0_rz9zkck1;0_gll8l3fd,0_yme4umxz;0_binn32jv,0_6j1x4igi;
    0_5v5s4jbj,0_yik0wxft;0_kvfrv70f,0_e0wce63k;0_jsjup9on,0_ooyh950u;0_nbqmqhig,0_caleezwt;0_ux5mwpxj,0_z2l0i0ha;0_eedasup4,0_llb144g7;0_mr7jwy7h,0_f8bgil3d;0_69kffbr6,0_tz558l8t;0_scudz3a2,0_n4erufrn;
    0_q5ifrshe,0_o03c779i;0_t0ryh7x0,0_0939oaob;0_t94o63dg,0_k1vtnmru;0_p8j0pcup,0_cig863dn;0_f0zyuy15,0_ftf26rpn;0_ssx1kk27,0_sw96fufb;0_4q0ztb2e,0_p3iz207o;0_0jqqqlec,0_bqjvqjkx;0_njvqm583,0_z2czq6a0;
    0_ku8dfmc8,0_bapqfcit;0_h5bwbesq,0_u7av1qvu;0_aqp3u2cc,0_jh3ggntx;0_aniuhlsj,0_o7b0isw2;0_x1wgg15v,0_48ptx8yk;0_q96nwwcv,0_o4tm9s2u;0_shxl7m9n,0_dyrrwk9o;0_xz5o8urm,0_zps5p4aq;0_01mlju57,0_v41owko7;
    0_5nkh2owt,0_iwhq12sj;0_cmin3tqw,0_qws57n9t;0_u6kf2typ,0_wnsmbicv;0_ppxeeaap,0_urwj457v;0_ky65j8y9,0_sceh7sz0;0_21rszab1,0_kb9iag7j;0_jpqy29bk,0_t2g4ddls;0_56ig3pn0,0_o6bmn3nb;0_yn1hm8cl,0_434s07c4;
    0_e59yddop,0_4qe2m37w;0_zdme8ra9,0_q4hhbwrw;0_q8t4e39l,0_hyt91r8c;0_e137xo22,0_5mshsg41;0_b4xvilak,0_brzs6ofa;0_8yec7j9k,0_bnixs4eq;0_1qqxceqc,0_phsb0rfx;0_7bd2mosf,0_20e6cqg9;0_jmogjygn,0_ogi2z1yy;
    0_tdhsejee,0_1iy0gd03;0_79qoyous,0_gylgh19z;0_20ti0kvc,0_kd8515jo;0_i4umkyyp,0_ub97nhjs;0_96prsxrc,0_zftkezz4;0_2vijfzq0,0_fd3bu6oy;0_y77oxi4l,0_wgpk3m15;0_omausotc,0_67rgtr8m;0_id3p7w06,0_twnrucpf;
    0_9ntyo66d,0_znwqwsad;0_owzc678m,0_g4gjkeof;0_hjfnl5ku,0_d27x77qt;0_c8q4389l,0_azcplvzd;0_6xjyyylu,0_canxrpzt;0_0k1is3ol,0_6rwdffu6;0_dvi4atka,0_yd3i2orx;0_1ks2tvet,0_kvy973fh;0_whw3uxv3,0_mvjsoici;
    0_o8refis0,0_nvs6wc0s;0_4pgci2kl,0_bu5649hg;0_2wiw94bb,0_ro0kh0xb;0_191namwo,0_d5tcy4x4;0_8uffy4bd,0_e8q7lqmk;0_8ik5v6mb,0_wrvu7b2h;0_5k6qkhy6,0_9aacwkm1;0_oo7kgv3f,0_2mk3erhl;0_6rfumsy8,0_dpm8mws7;
    0_y3tkg3m7,0_llj2tmcx;0_mmo1jf0y,0_tstxfxp6;0_ufhmqmqc,0_khtiyihe;0_he5o5bvu,0_nim8jr59;0_rcu054xw,0_y5k0o98j;0_w7da9mtc,0_qi4kf0z0;0_n0l1buw9,0_m15txvim;0_laidet87,0_yk18kfwg;0_8uxm7hft,0_0c9qs43s;
    0_4fblv2hi,0_d8onj3sh;0_fstllrc0,0_tx532i4y;0_857oxx58,0_86j82lyp;0_4pnu1lko,0_ab1vgzb5;0_fomsz6kg,0_k19pq3sq;0_lsadx2o4,0_xwo6n5xj;0_s6c1uyoy,0_8fadqsqz;0_3ksu53th,0_0pz8lyyo;0_0ooqqa21,0_37abm425;
    0_ve7jzc74,0_g3yjw5qy;0_kcrlgbt8,0_rwup17w9;0_6rns6u41,0_l7dzkxua;0_vw0qu9po,0_0204mdwd;0_a7s7678e,0_l80p3l0p;0_ymb2ma8p,0_fqnww879;0_lzesi493,0_mm7pshbh;0_vaietn3r,0_368grpve;0_liykudif,0_485ttqc3;
    0_7jy6qm1z,0_n4lf1yel;0_k7h89yiw,0_adzi62pq;0_c3gab69k,0_ly93v60j;0_66blz5yc,0_kr32c9kx;0_ccgj9dlv,0_kmjcb2th;0_zd95cf2p,0_4jlsaros;0_0auph06h,0_w3qw1jdh;0_23kcatun,0_3lsi7x4l;0_cmkuv0d4,0_4975kpiz;
    0_8dvbcpgy,0_x91t0ap6;0_fzhf1w4l,0_pxdumdze;0_07ph3wud,0_a6wukph5;0_ces9bl0t,0_xh2fmi1a;0_y81p6rcb,0_c54m7y1a;0_r2obqrnx,0_2q2yoaxz;0_78frmb5q,0_e6ktbfn5;0_l22lp3up,0_48nmvxw1;0_52jnudsn,0_244j53rn;
    0_tv1fe10o,0_ycrhvl7q;0_y0ti3rm1,0_5x6jj1j9;0_4twxjdvb,0_2uq9ivs1;0_7pu2vjkz,0_qlhlgsxv;0_hzbani9f,0_mbqaoo0b;0_tan5oeo2,0_b6uzktck;0_956nc9ez,0_1lu2iats;0_ndaye7eu,0_c2v0ecxh;0_lp7hxshh,0_hi8ofrnv;
    0_ivser5ji,0_4fzlite5;0_4xuffx8u,0_i5cubbuh;0_014xvvil,0_xwl8taws;0_m0xerju0,0_xnqo7q55;0_8mufdc37,0_2k1g71p3;0_4qyyeu4z,0_aift94mg;0_yqrr7jtp,0_jzp1po4i;0_9on9ro01,0_4372ciju;0_88f4am3m,0_6l79fdka;
    0_x5vnap43,0_9nfo3e4x;0_8efmye2e,0_m4cn7u96;0_bbkt5hcp,0_rp2ayqni;0_lluzo2hu,0_z334stso;0_1t21nlzw,0_fr2ni4hx;0_6u0gl10a,0_wmmeice1;0_9jaseo7q,0_puwfu067;0_qex0sijo,0_pycevfnc;0_mge17lc8,0_353ejat3;
    0_2iczluu2,0_cxuiiv24;0_5t1h7ihz,0_kxjk8zon;0_0i905yyz,0_o8na0m2l;0_4azxvkrx,0_8xqht3jv;0_d6i14gmq,0_w70sofok;0_mefvenas,0_7lnvikm7;0_ajqlw8nd,0_774wsxm3;0_8k0jxmas,0_xuj7su4e;0_tnkc8p6l,0_ub386egj;
    0_7f7s3j59,0_wuneh2xy;0_fzhnx90u,0_lz16xo2m;0_kw84fsac,0_xst0rz6v;0_dada6t75,0_4drhaiy6;0_h0brrno0,0_yok9trgp;0_q8jtpchr,0_lp5muf6s;0_ey447bui,0_u07770fl;0_nycmlyhf,0_nm0wha2g;0_iyjpp9cg,0_behuf411;
    0_7483rrh9,0_uw0dak2a;0_1wh84akh,0_q5j06emb;0_tyf8xanw,0_bu6e67zi;0_812xfgvz,0_d4we164w;0_eycp67wj,0_isx1bfrs;0_gbqvqn1n,0_4dsvw2uc;0_s3ew1n09,0_8bi2qdti;0_ot7o519j,0_lfifttd2;0_j21n0xa4,0_im2ffo4z;
    0_uf7o1m6w,0_636rwa8v;0_vqsz9lo8,0_t85e8f4a;0_3gfpucx6,0_f09lil5z;0_vy9q2jjq,0_0qkhgnrn;0_3eh5sko4,0_xteoj7oi;0_bzuqlp00,0_bo80zqu2;0_z8frq9em,0_51cmcyle;0_ou4q2yx4,0_ab6lkieh;0_ty9ouun6,0_fitkhbxs;
    0_rii8q519,0_p3rvm7p7;0_mrdlsfz4,0_3fe5zgbr;0_r55nf9xu,0_q1fa4fhu;0_t2iycevb,0_l423cta9;0_gfamf1nm,0_9lm24qpd;0_adxa1hqg,0_7p3ygiqp;0_ert8hrev,0_r70nvswi;0_wmehrbvn,0_gqwt70h8;0_0l856ch4,0_2kzw05yc;
    0_17ccx4l5,0_1zo6ikew;0_242u227o,0_pxc6j64a;0_3m4qdka2,0_lw7th85z;0_banubivk,0_qsfu968t;0_qtfepe38,0_fje8xj45;0_h075h9f2,0_s7a2zx4p;0_wt4iylz8,0_xmvyr9na;0_iwybuxsu,0_1x28rlz5;0_0yg4xi6e,0_j6zqs97q;
    0_y42mkq4f,0_9js97evr;0_nspfho5e,0_o6upl6rj;0_53kaztxv,0_0grvry7h;0_0gouqn4o,0_x8ckxci1;0_6kohmmsa,0_5wcw1t9m;0_a65c03jw,0_gzw7c5st;0_gzjfffiv,0_j44uzpec;0_yxqz73r8,0_4811jqwm;0_nbw3h5ey,0_byaypi6f;
    0_xs19evsc,0_j4t31229;0_bw92n5h4,0_1lxqv1so;0_0eg9hsfm,0_gjsmmgld;0_yilhpvcw,0_qzrar6qn;0_ceo4b4su,0_blqj0bxy;0_janavdh5,0_6ob480ua;0_5k5wldtt,0_eqgvoyl8;0_d6a79iay,0_36ppuud6;0_l0qdngk5,0_sbxesa40;
    0_pon0b22c,0_t8gsnygy;0_y7rogyh2,0_8nmv8nm3;0_z205lhvc,0_ratxgz0b;0_teyr9k0b,0_ssacakqo;0_ns2yptql,0_dqmbkdr4;0_rtl69nvl,0_nrwjfmne;0_e4makl57,0_npa5vz8p;0_h15xmty6,0_vb7dcmqy;0_598ea4ly,0_ecqx8ad1;
    0_477i8xrr,0_38tf6lp7;0_8d7lpjxv,0_aovzllcj;0_d7cnjkb9,0_90ztb8gp;0_uwdh3ara,0_e6pi0smw;0_1gswvczi,0_2r93hcul;0_yyy07l8c,0_w1ew6u4q;0_1uqzjomf,0_bt6k4snv;0_g8psb7o3,0_gnrvakno;0_uk89clou,0_ecp4n2vb;
    0_1483arxi,0_3znkgy1n;0_2qagioo6,0_hm7mzm1i;0_vkiv9klh,0_hutkdr4g;0_t0qym166,0_ozmhugtr;0_k9x7urmb,0_n9rsbspy;0_6lyxp4ly,0_agltsqor;0_49yrit1i,0_vmfy2jnf;0_ie4bexza,0_n0fa7pkr;0_sindh6uk,0_089kvcxw;
    0_v0ol2s9k,0_pu660anh;0_88jvyc6d,0_lxp3ejyv;0_4pepweia,0_w15zkei9;0_6sqhstgi,0_2679cvfx;0_gd6tgx64,0_05biu57w;0_nlig7513,0_9xsjj8vs;0_2esb53wx,0_57obdy8p;0_p6y5g65n,0_t3iziuto;0_96dlngo4,0_1wcjymyt;
    0_0frvrz4j,0_0y95n6hg;0_g76r6v5c,0_3q8s8e7s;0_a7w5kn4h,0_fs4hll5v;0_3y1ursbp,0_2xftzvnv;0_ssxkghi7,0_4vbu8occ;0_kx6p7med,0_770pu3a3;0_qxg3l2d0,0_2zmmtp2n;0_px4odo2d,0_m25pz9wb;0_slchi9du,0_87tyjrz3;
    0_4k501yy8,0_as8t9idz;0_38i4eznu,0_mix222k1;0_2coqirqa,0_j4592cug;0_p8386nxi,0_pg6k052u;0_r0w6ujg1,0_ir8zd5l3;0_ovs1ojm4,0_xf8x9cvp;0_4bzv5zq1,0_0gx7aqmq;0_5mf5a9c8,0_ukyncvwd;0_tl944sa1,0_4awknzq8;
    0_qhxkfreq,0_xmcoboak;0_x5437ra5,0_tzbg7ght;0_um6widsv,0_g88oyp4m;0_1uk3flu3,0_yy1a4qkr;0_xk6j2d1v,0_62ofc3n7;0_6y22jwlj,0_wrttd2co;0_an3z7p4b,0_twv7lwkg;0_5vqfz6w6,0_woz75apz;0_pin1par5,0_lhieqjoq;
    0_vlvkvdv2,0_u69o8o76;0_2aq37cv5,0_uaub7yfn;0_7qaep4q2,0_7vn0hmhw;0_uq84vq1h,0_x5zccogv;0_z3nzbl9q,0_aiz2su2w;0_w8y0wfpc,0_qa947jut;0_7capdq24,0_lmw2u83f;0_qwp6htz9,0_s86w42e3;0_utocbx11,0_ar27sqne;
    0_d2h59cfo,0_j66yywr3;0_7sc4i2ic,0_sfv5ml1r;0_74msttdk,0_7x5m3lpv;0_fttuvm21,0_zvzrsfip;0_yaqt61kg,0_suaq7oq1;0_tfm7k7sg,0_oxttpoxg;0_5gg4tukl,0_4ic7dqnm;0_3mgb6kmu,0_ov12hcbv;0_8qttp9u8,0_2rbd1a2d;
    0_xfxm8f8v,0_6sn1kult;0_kp1stuxo,0_1okzxbjw;0_jt3hc12m,0_kudoq9lk;0_q8plcpaq,0_mq55lvas;0_ny10xdrm,0_6k8fodkv;0_du7yuuzy,0_0goabtg6;0_sv90u5bd,0_cceff6yc;0_fuuvlb6c,0_q14jzi8t;0_yzc81ynq,0_pf3k4tch;
    0_rpvzz9ac,0_fxwm7408;0_yc3imjob,0_hty1393v;0_rq42239i,0_w3siydgo;0_ysxtdu6w,0_df6w0q2o;0_cn87rs46,0_9o9i6iis;0_eylwxa3l,0_f2kr3n20;0_szhhnyfd,0_3h87vo53;0_tkxeuq2f,0_bk9e8gun;0_rrh9aznh,0_c4x9ai0m;
    0_032ypltg,0_kn4p5mha;0_o37ol51f,0_6gfjgal1;0_w3p3yc2p,0_1uhd9exy;0_0328au9r,0_pxbde2md;0_e8pifr8g,0_sgx4eire;0_f9djarm2,0_f6aw7jt8;0_vg889a13,0_7pmrnmel;0_txqflyq7,0_3gr9ccj7;0_eepwj45a,0_x5m7uqf4;
    0_m8z200bh,0_w3avs0un;0_pit6ftwa,0_mauc24z5;0_az1d29r5,0_hkb7dtg4;0_oap08u0x,0_kio1vsp6;0_dk39sngi,0_75ym5ewv;0_l22wm5wl,0_1vz7ro9l;0_bx56pker,0_ywniwjyr;0_n8ejd45a,0_q14jdgbf;0_k9ij0a4l,0_h5w4edoj;
    0_wlzjguag,0_q0dq200k;0_95rf3cl2,0_efhobhv4;0_y6fpikhm,0_s1vykmcj;0_vnvkydoy,0_ruuhk8b7;0_yooz076w,0_gq8cqw3h;0_f70xum8s,0_93gvwien;0_7xjvlb7i,0_kgg09klv;0_6medw92b,0_34daiwi9;0_06238cqn,0_1xx01pye;
    0_45lfi3ev,0_ri9drdjq;0_sfiqqz9d,0_xzffbwnw;0_le30g767,0_5mmerhyq;0_hwdznzc0,0_1cvdwj6v;0_n8t35lut,0_zxyasgj4;0_bc8u477g,0_e2vtrzrn;0_s1pscln8,0_7qkq0l8q;0_n5ibf8s8,0_jvtis1xz;0_1aztzil4,0_te5xg372;
    0_gpxdyewo,0_pmsqrzyp;0_6t03cy4a,0_zt4axbzh;0_p3k25dlv,0_31oggzoe;0_a6zvd1wy,0_isj5ueqa;0_be9ay2jt,0_pb035g5x;0_9zbp7o6p,0_3fbs3cia;0_9lzogh0t,0_ilzsx3fr;0_a7chfuio,0_yyv8koki;0_m0h7ork9,0_95y7c980;
    0_xrkiw77q,0_6rge0h1p;0_c6mbuxos,0_c44gzodj;0_q0nyfu2r,0_7u4md3t6;0_c4krk3uu,0_qe7sgtd0;0_gvnhc3z9,0_nsfo1h5v;0_tnc7oo5k,0_e15nip8n;0_n8pi6kjq,0_0t8czpdo;0_54njve22,0_ifi5wyw7;0_k5cnv5bo,0_1mbcak0q;
    0_rzftji52,0_wflua43m;0_nnnmhdib,0_j8hw8kjv;0_bo1qppdy,0_vzi2hrry;0_npgabwl6,0_tg7vknqe;0_h9cybcvp,0_cwb07ylk;0_akmjupf5,0_bqgxktp7;0_vavkgbqi,0_c0rv7hsd;0_vbsra8g1,0_8a048er3;0_kq6ym1o2,0_u8depw0v;
    0_zzdezfc6,0_bbmtoyep;0_f80fi7uj,0_1ndta9ll;0_wfvycf9l,0_98vhlqcj;0_x2sj6mi5,0_9okk0jhl;0_ceg01qbs,0_xsg3h1nw;0_bunxbc4b,0_4chzc1em;0_g9q1tlpr,0_474izwk4;0_ara7a0jq,0_hfgy3rs9;0_4ytp6su8,0_y84ix0bl;
    0_krtocqzq,0_vhc7qa4v;0_zw4xxscv,0_3dz6yua3;0_dvy4kjvm,0_mo8zp8t4;0_u5c12597,0_05r0ygns;0_m37h5y14,0_xk1n7soj;0_9gr9le07,0_qo6r3jab;0_mpcjti1d,0_luotpvlk;0_clg8wpil,0_7v5ot0k2;0_8stad2kw,0_3azd93rh;
    0_5c2ed5sw,0_cbfpl2mb;0_oydlz2mc,0_bsxmr9z0;0_n94kfk7d,0_g45kyf4x;0_8ohedzah,0_86gqwhhz;0_9dru1ajh,0_des50d4s;0_vdd5e4om,0_h3bqwp20;0_hsrgjzrr,0_1tnt8ucp;0_gd3iczu6,0_j1mhoxvm;0_wpga8pph,0_kn7u7au6;
    0_8hfen48b,0_nsff9cgf;0_skeuga9e,0_wgb9o7qi;0_7cz0v28c,0_5szg2u1v;0_v0eb465g,0_djovd3o8;0_oaggmjdy,0_oojwttvl;0_7pqtguim,0_6d1m9946;0_eay7azu3,0_a6w8iaxv;0_m1m2lflx,0_2xfsjgqi;0_mvfueobi,0_cz0e15h2;
    0_9s13u2jt,0_fysa1jay;0_xfq2hf7o,0_onkr3br7;0_xrl6cf90,0_rmzcfidg;0_x4cdm820,0_jr56lam2;0_uheixry1,0_z15myk2x;0_kl614k9k,0_lawlssqn;0_s1ef6hlv,0_bbawnezd;0_pv63vzar,0_25iqzjrr;0_zmrfx060,0_14cclkkg;
    0_l2m4n9x3,0_3ocw32h3;0_0yd9c5ij,0_b1murgpp;0_obj1lmvf,0_c39i2fpp;0_pmld2kc7,0_tv5dskq6;0_bs1kyqrt,0_7npqawpl;0_qz5jvawj,0_us4ndb4u;0_fy1g90fz,0_5jtwnfcf;0_rq5lpkfy,0_eo0hlyrs;0_f0r8yto3,0_xb5ro1yf;
    0_ei6moe5h,0_upf8qzj0;0_f49jqj2y,0_aem5rruv;0_p0aeba38,0_uff3bo2j;0_pwupnoy6,0_9cvr3uh9;0_tz17tot3,0_c7ate35x;0_sc1klz13,0_gsb53hhx;0_4wrp96in,0_t0uyoao8;0_irrelys0,0_279hiinv;0_i7ecej3x,0_g3q43pcw;
    0_8wha9ntz,0_jklpqmwu;0_xx54dukv,0_02x73mwd;0_vg9bxniw,0_mbd0rtps;0_p19xihi7,0_mh1766l8;0_usizwbzn,0_3xyyvk57;0_j283q826,0_zk8j1s76;0_dtcd4l0d,0_h7tgyzbf;0_zs4ry135,0_vpbdm369;0_cykmiwlz,0_7pat08cx;
    0_53vosxm2,0_tjhsmmza;0_ipf8k8z6,0_3d5e2cml;0_rkbhcmje,0_r4kgzwdy;0_i5mz4uq0,0_b3nmhsaf;0_zqpjqime,0_svmynkm0;0_13hjiy68,0_u7gl00h9;0_huvydck0,0_x2tdqxr9;0_s8kbes3h,0_zbg2ym05;0_69780hwo,0_hq65cap7;
    0_08nc6p4m,0_k7lo7fqt;0_or6pzysb,0_9fedjoi3;0_3fqp9n78,0_p9d7np1x;0_732ewyaw,0_baao5uvo;0_zqosx3j6,0_vaue67ia;0_g2x3tmbu,0_9y95jsts;0_zq5e6qsh,0_nkab14k9;0_m441obb2,0_8e8v6id6;0_7nrsi1yr,0_uwp9hzq5;
    0_yb4gvusj,0_2b9sed7i;0_59usn3rf,0_h223x0ny;0_eanwlgv7,0_ike3r42u;0_2za07a9q,0_9l9qvjqa;0_b00by1pi,0_h60chnzz;0_soktiriu,0_7uoq6iqh;0_tnf8jebc,0_klnt93ko;0_50ieyfgs,0_lmvwrmdz;0_na2txlem,0_hmetiqn1;
    0_biro1eha,0_fjltk235;0_97i7o3sk,0_nqtnqeze;0_v4vv7tnc,0_hr0g0eoy;0_vfjuquxw,0_xhkg1mxu;0_z7vtesnk,0_idvcnng9;0_3cqz31vo,0_v9u4ni25;0_rrewyywn,0_7uj71y6e;0_7fyw295r,0_bd4qgvu1;0_mvjnjdlk,0_c09vn670;
    0_0s9lmht0,0_veaumkg1;0_g1pukjck,0_d6w2zbce;0_inbseah1,0_upnaa4d7;0_oxtwba6a,0_4yxbdxha;0_j9bwnxyl,0_du0ptxei;0_40cv6b5y,0_oovp9aq3;0_rca4i8tu,0_9x1ab0ay;0_6vkh7hbd,0_bw9upp3d;0_hde0t5k1,0_j2cygdml;
    0_3rzjkv19,0_x1y4dscc;0_6b0o0vqf,0_5hsi2ldd;0_y4q4vk8v,0_irygzbwc;0_e0q50aa0,0_n9tkxti4;0_j66nuztf,0_tbuchhy6;0_8xw3paaj,0_u2joinnb;0_717j39jb,0_ti9hijb7;0_o886wv9f,0_o38px54k;0_aer7n8rn,0_k5qoklak;
    0_kuyklw0t,0_klmwpl6n;0_m91nktim,0_8xyer7wn;0_4bpnx3c2,0_sgrcjkg9;0_lbnf85co,0_atdd61yg;0_726f0jw3,0_27jq0jm3;0_bm53bg0c,0_pmhjas57;0_jrrdi6tc,0_g27z4mc7;0_jbl3q5bn,0_fsctt9sg;0_kf4cfk3n,0_25ne07au;
    0_19u75rpy,0_4e5nw13d;0_yiwunhhr,0_zncc2299;0_7mq5vi1o,0_85hbyvfp;0_dhjis1bl,0_eq3j3rw3;0_vua4iim6,0_1s141hw2;0_7sy1jvdd,0_7moh2eoj;0_ic0c32v2,0_z9ei4sl1;0_byro8m4i,0_e222z5n8;0_37ukcc8d,0_4wyzpm95;
    0_axz1gon0,0_hyaajm6p;0_zmurt2zv,0_i26ahe74;0_szyc3jrk,0_9evpjdk1;0_s49fnvp8,0_idjyuy65;0_1vybxr92,0_ckb1qm8k;0_j3z0o57p,0_to2hpazt;0_qkxycuy0,0_2kpxhptb;0_zm0n77lu,0_7ad08so4;0_3t6afxfh,0_9dy5xwrl;
    0_t7vcmcqv,0_0tks61zh;0_6tqb81cv,0_s9x08p68;0_s9gpstvs,0_fte3zjks;0_3j3y0bfv,0_ew0pg3fw;0_399b2sjx,0_q7kx9mol;0_708on2cv,0_y71glrhv;0_m6i39bk1,0_95bf5il2;0_q7jdhq28,0_4att7tsm;0_fw8ds6c2,0_0m40n1r2;
    0_m755r7qe,0_wjzal88h;0_w7q349zi,0_n9fmxnqq;0_2a6zpshc,0_lle3c0ho;0_fjeoqtpa,0_y4i4vbbi;0_jcqw1rpf,0_17z69vu8;0_8uyqgfro,0_2m5j9gb9;0_kvlnaf88,0_dtjaysek;0_8vzr6z4l,0_e55awvwr;0_od9dkans,0_88vospfd;
    0_rzdu2xg2,0_4hggwgwp;0_nf26edrc,0_qe64k54f;0_2t7v4cgo,0_1u8mkulb;0_mzu67yt0,0_gmdjx54a;0_o48id6ra,0_uqv2ym2r;0_ev6nrxw5,0_kkz2xykh;0_a6tps8wy,0_95fjvacw;0_fhznvf7m,0_wwu0dnjy;0_pv001wus,0_y6sliagm;
    0_787vwv5o,0_3wnv5vhs;0_zewhnshu,0_j80ar1lq;0_wogyf56b,0_aul33a55;0_469do7s0,0_vzyd1yem;0_yi46ayfc,0_nk6k8nj4;0_bva5ao7f,0_3rxtxtyj;0_eu7tmemp,0_7dks5iui;0_3ftr6gwz,0_nmczqne7;0_v20gv501,0_yu4lvmw0;
    0_nq8apaw4,0_6jtno93g;0_c7ry69ay,0_bv27ju50;0_8gcotavl,0_kz90inkh;0_x55qdrqk,0_h0e6cnqp;0_ly5yv6fn,0_o190x9en;0_7pyh4qwd,0_k856jsnk;0_fobpkz4v,0_ii9w3mtc;0_wbjc1rp3,0_ukj7xhat;0_yq0rmwqy,0_snb5oc9a;
    0_let4awxb,0_7vi7lhkf;0_ob60qm09,0_satwb9lb;0_kte5g9r9,0_xqqmt06j;0_6gv36tiz,0_dgc3rd2u;0_02wgtty8,0_bw3hi61n;0_cecnkyco,0_oprgf551;0_lj5eyy0r,0_mg3m6jvz;0_ycum8e2p,0_ioujikz7;0_ntvdgy52,0_fhuporl1;
    0_ryriemue,0_pkvv79r2;0_tfcyhhf7,0_tyhhy9df;0_rz5bhqtc,0_wucmuduo;0_v2wz9pdw,0_bge4nqb4;0_6r5rswzu,0_end1kpyl;0_alowpgsb,0_m06j99hi;0_47zayygh,0_6en0gex9;0_kgh1j69x,0_grxhk8db;0_2glo5utt,0_8qcn0hw8;
    0_8h2fh0sn,0_1p1r8dsb;0_0cl1mods,0_5m02amxp;0_u6f0qzmx,0_9vyczl16;0_d9xjsknz,0_nr3m1n7g;0_r55dflzr,0_57l60ftv;0_0hd2cyca,0_m4v12lw6;0_0u6we5g5,0_yx3c9w11;0_qsqvc2uv,0_emslynxd;0_6zswt4q1,0_272ahxjs;
    0_ethnbwdz,0_8u1zvk49;0_fsejszqc,0_3ckhwil2;0_6ny957wx,0_vameua49;0_scv5p5kg,0_mi2uw575;0_smapd4re,0_n23i6rds;0_kohrjlwn,0_3sy4yr9a;0_anpuq76o,0_lk275abr;0_n5r68e3m,0_d66v0xnu;0_7x64ddzu,0_fv8s7fub;
    0_rn6tq2kb,0_wnna1fph;0_z0r9fern,0_k011578n;0_shn5nt3o,0_z3awhm1o;0_85bjx5aw,0_lvm5jh74;0_ebi7dzkq,0_0p13v4t0;0_sslxjm8b,0_dkrrrqzu;0_btf3pv8b,0_xtclhwvb;0_wzz37ary,0_0pypeqn5;0_y8td42e0,0_ycl9orso;
    0_vfggjc4f,0_3wk40voz;0_n4m9k1hl,0_l6gzp4hj;0_xd8fbsp0,0_d7t6j3q4;0_2luwppcp,0_jjx1eu06;0_6tzvmb4q,0_od11cqcn;0_me3we4c8,0_whmlnvih;0_o2icuv9b,0_w2kwewa6;0_xk99k8f7,0_lm0ax14c;0_wmblrs0f,0_aif722pr;
    0_4bb8wi48,0_28shbqo0;0_khxyoeke,0_zww1o7pq;0_wij7pxfl,0_hlgxr0os;0_w0t248kf,0_5p5p63ht;0_z4vy4wl6,0_4mi0m0ls;0_ejw02s3s,0_srr1fo6f;0_ki4um7f3,0_n0gm2l70;0_kq2zuu49,0_jhxmat1o;0_ufaq1zhe,0_27ftnee2;
    0_9bn0mqcr,0_q3ghj2q0;0_drbz7bk1,0_em0dvyne;0_tvf5gvct,0_2c5zqkdo;0_52bp1t54,0_ws4sgnis;0_s534oz2p,0_02y67hso;0_52rziteq,0_vttpi2eg;0_qtdichgi,0_5geuil1v;0_awisceia,0_cv6x7eag;0_f5eny6q9,0_bnecggsj;
    0_cf9b4kxi,0_jyhivc48;0_5cmj0h49,0_yw90kbxk;0_3nafsubg,0_7svqcyia;0_ugy57ma5,0_c7xrsdfl;0_vo0ae213,0_7izticvz;0_l1xbqpaz,0_bojvc3by;0_7yqf2k3u,0_0uez2q8z;0_xkyabrrm,0_vw1krmr8;0_0x2cogzh,0_2rm1dk0o;
    0_6zvowyot,0_elz0x0qp;0_zl847rne,0_gwshoxx9;0_rmi8fdlx,0_rzu4572y;0_xv4n9oak,0_eqfyd6df;0_g2us8itf,0_x65nqoyg;0_5epjh2lu,0_r0aqq9i3;0_ys91cadi,0_3f2uw6yf;0_9x7gcrzh,0_v8n9n3t3;0_7bn5r3kc,0_rtj74tv9;
    0_n2luixpl,0_u80srp21;0_e1r2bsli,0_aot61fdz;0_c7io7s5p,0_xfcwzux6;0_807579hx,0_jq80i1r8;0_ihrxy735,0_lgx9j2h6;0_ijq9u3mt,0_58vh75a5;0_er66wc59,0_bdccmu5b;0_2xjo2zep,0_klf6z6ul;0_5f2lg8p4,0_zo6z52do;
    0_s6r77ifp,0_nmx3y7u7;0_sg8wfxob,0_opqxn625;0_zpbk5stv,0_dqkaut2t;0_erbt6hr1,0_r2von28k;0_hsfcitvk,0_jpdhzipl;0_mpunp6t0,0_4o988lab;0_0z0e9deu,0_50agx4ox;0_39nuuequ,0_plgym41i;0_9jgalwdf,0_17ettakv;
    0_vk3zs6wc,0_86jweysk;0_uju078jv,0_2vbxugd1;0_h0oaas78,0_u2nzn0mh;0_lajf3uhf,0_xacbcg0v;0_hje34npr,0_yy6ehje0;0_bpko92n1,0_hki3kju7;0_0pto4vmq,0_uanvqfco;0_doe69s5v,0_x782n23b;0_aq4xv77s,0_ayy8zb01;
    0_rzhux1l5,0_kjizvfw2;0_hmq3w4pr,0_4c37uaie;0_rcwbaeg7,0_xi30re0w;0_p179cj87,0_wp207xk5;0_6qme8otx,0_4ontg9cd;0_z6foknx8,0_axheba63;0_2x798b61,0_jmybman2;0_8hqm6vmj,0_q2nx90zn;0_p0gtn6hn,0_fuff0mr4;
    0_mdh7qnhc,0_jckc7fhg;0_3mnrcc2d,0_x9yfrvtn;0_f0ggls6f,0_te9pt0k0;0_awmxveqp,0_2dog4z3n;0_lg1e9j29,0_qfhtih04;0_7plmg9cz,0_uuvzd0ga;0_b2u9hxqd,0_11slwc76;0_1bs3ouo8,0_k02zguel;0_vqj1tt68,0_846dd8ib;
    0_eilht3it,0_oiquzovh;0_1f0j49ei,0_rwmwvrx7;0_3w881js2,0_rkq5ki8p;0_um17lxei,0_4wt2ijc9;0_wqrmknxk,0_mw5mnrw2;0_vdqdeu8j,0_yzi3e3x1;0_dtv4kbtm,0_vzigmmye;0_r2lmr785,0_pc1rzbar;0_etrmg87r,0_niyiq96o;
    0_9g49cqj0,0_d5s1m9mn;0_0086hndk,0_r1k09wq3;0_dkn856u0,0_pd3v7v0k;0_pntcvwfs,0_n2zxep2d;0_dm0kd9xq,0_3y452lv2;0_po829pti,0_p1xagang;0_3d2r4ojt,0_lrl8i4hl;0_2b0e1r4r,0_hoqb8uw9;0_mjteli2q,0_zfnm4h37;
    0_nabjgo76,0_i1stcwhn;0_nkb9kzsk,0_qrduzvx3;0_yryzfjz8,0_w4iyq9s1;0_mnlt4g9j,0_f2nk2bbo;0_p9r31set,0_jzy7bn4b;0_irgdbjx6,0_2kzz3m8q;0_8qni4q8u,0_iodz826i;0_f4l373su,0_rmk8x9kp;0_3jal77dz,0_kuqhmmvx;
    0_v9m55krh,0_6zk4q45n;0_rwh652cl,0_3gpc92n0;0_fcg8ua3v,0_aekddhdx;0_ihwdcnx0,0_nakva91b;0_tfal11kr,0_eb5o2gla;0_dp06czu0,0_yaosugdc;0_4huol5ey,0_csct8zbe;0_qlh9uiun,0_8nbbzv0c;0_de00p04e,0_a3qe6j23;
    0_pm2wphfl,0_pkg935dk;0_b9owy330,0_oiot1lbo;0_l7npew5s,0_q02gr4gk;0_ffl9qmkc,0_mwooczkh;0_sonn1lbn,0_f0p086z6;0_mtpr5g6n,0_9fmtrtdc;0_o6o19or6,0_i60qlv3y;0_kcsm1f3j,0_ahm2ynnu,0_xg16wgi7,0_jo86ajy6;
    0_s3swrwz8,0_5a5b5wue;0_zkqjuob8,0_dqvzh267;0_q1gv0oy5,0_uf1u7idi;0_gqfauks1,0_crtprxj4;0_oucuht0g,0_9hfck1zb;0_7v6oa65n,0_zec2mh11;0_ncabkshy,0_nl3opk0y;0_ytgp5pq8,0_z8tiv7zy;0_3vyzkncz,0_tjvxv5e5;
    0_pwprcgab,0_z140h69b;0_s6xi10ly,0_mxd8fc4k;0_927bw8ji,0_pe7edrqh;0_2tbcdqsf,0_r3met00b;0_tm4irkx4,0_dqjatjyg;0_7x4pvvaw,0_1xjxg428;0_5yj6kufl,0_vzfbaqkg;0_2q2njqff,0_suyjs1f9;0_gn4hj880,0_grsqc3uv;
    0_x2svjulh,0_eyodz1g3;0_sdf6prnd,0_ck91ln1a;0_j5abac2s,0_bm685a3b;0_fjv6m56l,0_6n2xxhb1;0_syzaybnf,0_xzx4m0t5;0_vtqcnq5j,0_wfid0hv5;0_het1c8yk,0_we3ohca9;0_zx83ttm4,0_uccpak8p;0_7jt33q3z,0_tmr719l4;
    0_7qt1ntvv,0_bzcaomlv;0_xvcqbdu9,0_z4no9l1o;0_8ohtmers,0_u9njxlo5;0_qrrhh45c,0_oue5r68c;0_elyh8z0i,0_9jz4hc8h;0_cedz7kdn,0_cuwtgzhw;0_iptkzpk7,0_0k9hai8u;0_furrursn,0_qmrp71d6;0_44jgoxur,0_hk7yxi7l;
    0_3n476yvh,0_1vxqlfvj;0_6kyapufb,0_4wdkpkg1;0_87ay4ds0,0_mrdoyg4w;0_2w83kt58,0_2ppw39hc;0_qa68nq27,0_ot009lcb;0_rnz4k2jp,0_hayep6bp;0_mzne3wsp,0_yced971s;0_j0qx9cbn,0_481m4hqt;0_8jzfydts,0_lidf21gg;
    0_ikjo273p,0_3smwtjii';

$lulist .= ';0_962ysmt7,0_1pxwdaaq;0_k6ckufyo,0_ozubq19h;0_81hipfee,0_ik5c2osx;0_c982ixg3,0_swjiqjzo';

    $id_map = array();

    $entryrefs = explode(';',$lulist);
    foreach ($entryrefs as $entryref) {
        $elms = explode(',',$entryref);
        $id_map[$elms[1]] = $elms[0];
    }

    if (array_key_exists($kalvidres->entry_id, $id_map)) {
        $kalvidres->entry_id = $id_map[$kalvidres->entry_id];
        $kalvidres->uiconf_id = local_kaltura_get_player_uiconf('player_resource');
    }
}

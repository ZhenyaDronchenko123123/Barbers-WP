<?php

include_once(QLIGG_PLUGIN_DIR . 'includes/models/Token.php');
include_once(QLIGG_PLUGIN_DIR . 'includes/models/Feed.php');

class QLIGG_Compatibility {

    protected static $instance;

    function premium_compatibility() {

        global $qligg, $qligg_token;

        include_once(QLIGG_PLUGIN_DIR . 'includes/models/Setting.php');
        include_once(QLIGG_PLUGIN_DIR . 'includes/models/Token.php');

        $token_model = new QLIGG_Token();

        $qligg_token = $token_model->get_tokens();

        $setting_model = new QLIGG_Setting();

        $qligg = $setting_model->get_settings();
    }

    function rename_insta_gallery_token($token = array()) {

        if (isset($token['access_token'])) {

            $access_token = base64_decode($token['access_token']);

            $access_token_id = explode('.', $access_token);

            $token = array(
                $access_token_id[0] => $access_token
            );
        }

        return $token;
    }

    function rename_insta_gallery_items_223($instagram_feeds = array()) {

        $token_model = new QLIGG_Token();
        $tokens = $token_model->get_tokens();

        // Backward compatibility v2.2.3
        // -----------------------------------------------------------------------

        foreach ($instagram_feeds as $id => $instagram_feed) {

            if (!isset($instagram_feed['insta_username']) && !empty($instagram_feed['insta_user'])) {
                $instagram_feeds[$id]['insta_username'] = key($tokens);
            }

            if (!isset($instagram_feed['insta_source']) && !empty($instagram_feed['ig_select_from'])) {
                $instagram_feeds[$id]['insta_source'] = $instagram_feed['ig_select_from'];
            }

            if (!isset($instagram_feed['insta_layout']) && !empty($instagram_feed['ig_display_type'])) {
                $instagram_feeds[$id]['insta_layout'] = $instagram_feed['ig_display_type'];
            }

            if (empty($instagram_feed['insta_button-text'])) {
                $instagram_feeds[$id]['insta_button-text'] = 'View on Instagram';
            }
            if (empty($instagram_feed['insta_thumb']) && !empty($instagram_feed['insta_thumb-size'])) {
                $instagram_feeds[$id]['insta_size'] = $instagram_feed['insta_thumb-size'];
            }
            if (empty($instagram_feed['insta_button']) && !empty($instagram_feed['insta_instalink'])) {
                $instagram_feeds[$id]['insta_button'] = $instagram_feed['insta_instalink'];
            }
            if (empty($instagram_feed['insta_button-text']) && !empty($instagram_feed['insta_instalink-text'])) {
                $instagram_feeds[$id]['insta_button-text'] = $instagram_feed['insta_instalink-text'];
            }
            if (empty($instagram_feed['insta_button-background']) && !empty($instagram_feed['insta_instalink-bgcolor'])) {
                $instagram_feeds[$id]['insta_button-background'] = $instagram_feed['insta_instalink-bgcolor'];
            }
            if (empty($instagram_feed['insta_button-background-hover']) && !empty($instagram_feed['insta_instalink-hvrcolor'])) {
                $instagram_feeds[$id]['insta_button-background-hover'] = $instagram_feed['insta_instalink-hvrcolor'];
            }

            if (!isset($instagram_feed['insta_limit'])) {

                $instagram_feeds[$id]['insta_limit'] = 12;

                if (isset($instagram_feed['insta_source']) && $instagram_feed['insta_source'] == 'username') {
                    $instagram_feeds[$id]['insta_limit'] = absint($instagram_feed['insta_user-limit']);
                }

                if (isset($instagram_feed['insta_source']) && $instagram_feed['insta_source'] == 'tag') {
                    $instagram_feeds[$id]['insta_limit'] = absint($instagram_feed['insta_tag-limit']);
                }
            }

            if (!isset($instagram_feed['insta_spacing'])) {

                $instagram_feeds[$id]['insta_spacing'] = 0;

                if (!empty($instagram_feed['insta_gal-spacing']) && $instagram_feed['insta_layout'] == 'gallery') {
                    $instagram_feeds[$id]['insta_spacing'] = 10;
                }

                if (!empty($instagram_feed['insta_car-spacing']) && $instagram_feed['insta_layout'] == 'carousel') {
                    $instagram_feeds[$id]['insta_spacing'] = 10;
                }
            }

            if (!isset($instagram_feed['insta_hover'])) {

                $instagram_feeds[$id]['insta_hover'] = true;

                if (isset($instagram_feed['insta_gal-hover']) && $instagram_feed['insta_layout'] == 'gallery') {
                    $instagram_feeds[$id]['insta_hover'] = $instagram_feed['insta_gal-hover'];
                }

                if (isset($instagram_feed['insta_car-hover']) && $instagram_feed['insta_layout'] == 'carousel') {
                    $instagram_feeds[$id]['insta_hover'] = $instagram_feed['insta_car-hover'];
                }
            }

            if (!isset($instagram_feed['insta_popup'])) {

                $instagram_feeds[$id]['insta_popup'] = true;

                if (isset($instagram_feed['insta_gal-popup']) && $instagram_feed['insta_layout'] == 'gallery') {
                    $instagram_feeds[$id]['insta_popup'] = $instagram_feed['insta_gal-popup'];
                }

                if (isset($instagram_feed['insta_car-popup']) && $instagram_feed['insta_layout'] == 'carousel') {
                    $instagram_feeds[$id]['insta_popup'] = $instagram_feed['insta_car-popup'];
                }
            }
        }

        return $instagram_feeds;
    }

    // Backward compatibility v2.6.6 to 2.6.8
    // ----------------------------------------------------------------------- 
    function rename_insta_gallery_items_266($new_instagram_feeds = array()) {

        // if dosent exists return
        if (!$old_instagram_feeds = get_option('insta_gallery_items')) {
            return $new_instagram_feeds;
        }
        // replace keys
        foreach ($old_instagram_feeds as $id => $old_instagram_feed) {

            $new_instagram_feeds[$id]['id'] = $id;
            $new_instagram_feeds[$id]['order'] = $id;

            if (isset($old_instagram_feed['insta_source'])) {
                $new_instagram_feeds[$id]['type'] = $old_instagram_feed['insta_source'];
            }
            if (isset($old_instagram_feed['insta_tag'])) {
                $new_instagram_feeds[$id]['tag'] = $old_instagram_feed['insta_tag'];
            }
            if (isset($old_instagram_feed['insta_username'])) {
                $new_instagram_feeds[$id]['username'] = $old_instagram_feed['insta_username'];
            }
            if (isset($old_instagram_feed['insta_layout'])) {
                $new_instagram_feeds[$id]['layout'] = $old_instagram_feed['insta_layout'];
            }
            if (isset($old_instagram_feed['insta_box'])) {
                $new_instagram_feeds[$id]['box']['display'] = $old_instagram_feed['insta_box'];
            }
            if (isset($old_instagram_feed['insta_box-padding'])) {
                $new_instagram_feeds[$id]['box']['padding'] = $old_instagram_feed['insta_box-padding'];
            }
            if (isset($old_instagram_feed['insta_box-radius'])) {
                $new_instagram_feeds[$id]['box']['radius'] = $old_instagram_feed['insta_box-radius'];
            }
            if (isset($old_instagram_feed['insta_box-background'])) {
                $new_instagram_feeds[$id]['box']['background'] = $old_instagram_feed['insta_box-background'];
            }
            if (isset($old_instagram_feed['insta_box-profile'])) {
                $new_instagram_feeds[$id]['box']['profile'] = $old_instagram_feed['insta_box-profile'];
            }
            if (isset($old_instagram_feed['insta_box-desc'])) {
                $new_instagram_feeds[$id]['box']['desc'] = $old_instagram_feed['insta_box-desc'];
            }
            if (isset($old_instagram_feed['insta_highlight-tag'])) {
                $new_instagram_feeds[$id]['highlight']['tag'] = $old_instagram_feed['insta_highlight-tag'];
            }
            if (isset($old_instagram_feed['insta_highlight-id'])) {
                $new_instagram_feeds[$id]['highlight']['id'] = $old_instagram_feed['insta_highlight-id'];
            }
            if (isset($old_instagram_feed['insta_highlight-position'])) {
                $new_instagram_feeds[$id]['highlight']['position'] = $old_instagram_feed['insta_highlight-position'];
            }
            if (isset($old_instagram_feed['insta_car-position'])) {
                $new_instagram_feeds[$id]['carousel']['slidespv'] = $old_instagram_feed['insta_car-slidespv'];
            }
            if (isset($old_instagram_feed['insta_car-autoplay'])) {
                $new_instagram_feeds[$id]['carousel']['autoplay'] = $old_instagram_feed['insta_car-autoplay'];
            }
            if (isset($old_instagram_feed['insta_car-interval'])) {
                $new_instagram_feeds[$id]['carousel']['autoplay_interval'] = $old_instagram_feed['insta_car-interval'];
            }
            if (isset($old_instagram_feed['insta_car-navarrows'])) {
                $new_instagram_feeds[$id]['carousel']['navarrows'] = $old_instagram_feed['insta_car-navarrows'];
            }
            if (isset($old_instagram_feed['insta_car-navarrows-color'])) {
                $new_instagram_feeds[$id]['carousel']['navarrows_color'] = $old_instagram_feed['insta_car-navarrows-color'];
            }
            if (isset($old_instagram_feed['insta_car-pagination'])) {
                $new_instagram_feeds[$id]['carousel']['pagination'] = $old_instagram_feed['insta_car-pagination'];
            }
            if (isset($old_instagram_feed['insta_car-pagination-color'])) {
                $new_instagram_feeds[$id]['carousel']['pagination-color'] = $old_instagram_feed['insta_car-pagination-color'];
            }
            if (isset($old_instagram_feed['insta_gal-cols'])) {
                $new_instagram_feeds[$id]['carousel']['columns'] = $old_instagram_feed['insta_gal-cols'];
            }
            if (isset($old_instagram_feed['insta_limit'])) {
                $new_instagram_feeds[$id]['limit'] = $old_instagram_feed['insta_limit'];
            }
            if (isset($old_instagram_feed['insta_spacing'])) {
                $new_instagram_feeds[$id]['spacing'] = $old_instagram_feed['insta_spacing'];
            }
            if (isset($old_instagram_feed['insta_size'])) {
                $new_instagram_feeds[$id]['size'] = $old_instagram_feed['insta_size'];
            }
            if (isset($old_instagram_feed['insta_hover'])) {
                $new_instagram_feeds[$id]['mask']['display'] = $old_instagram_feed['insta_hover'];
            }
            if (isset($old_instagram_feed['insta_hover-color'])) {
                $new_instagram_feeds[$id]['mask']['background'] = $old_instagram_feed['insta_hover-color'];
            }
            if (isset($old_instagram_feed['insta_likes'])) {
                $new_instagram_feeds[$id]['mask']['likes'] = $old_instagram_feed['insta_likes'];
            }
            if (isset($old_instagram_feed['insta_comments'])) {
                $new_instagram_feeds[$id]['mask']['comments'] = $old_instagram_feed['insta_comments'];
            }
            if (isset($old_instagram_feed['insta_button'])) {
                $new_instagram_feeds[$id]['button']['display'] = $old_instagram_feed['insta_button'];
            }
            if (isset($old_instagram_feed['insta_button-text'])) {
                $new_instagram_feeds[$id]['button']['text'] = $old_instagram_feed['insta_button-text'];
            }
            if (isset($old_instagram_feed['insta_button-background'])) {
                $new_instagram_feeds[$id]['button']['background'] = $old_instagram_feed['insta_button-background'];
            }
            if (isset($old_instagram_feed['insta_button-background-hover'])) {
                $new_instagram_feeds[$id]['button']['background_hover'] = $old_instagram_feed['insta_button-background-hover'];
            }
            if (isset($old_instagram_feed['insta_popup'])) {
                $new_instagram_feeds[$id]['popup']['display'] = $old_instagram_feed['insta_popup'];
            }
            if (isset($old_instagram_feed['insta_popup'])) {
                $new_instagram_feeds[$id]['popup']['display'] = $old_instagram_feed['insta_popup'];
            }
            if (isset($old_instagram_feed['insta_popup-profile'])) {
                $new_instagram_feeds[$id]['popup']['profile'] = $old_instagram_feed['insta_popup-profile'];
            }
            if (isset($old_instagram_feed['insta_popup-caption'])) {
                $new_instagram_feeds[$id]['popup']['caption'] = $old_instagram_feed['insta_popup-caption'];
            }
            if (isset($old_instagram_feed['insta_popup-likes'])) {
                $new_instagram_feeds[$id]['popup']['likes'] = $old_instagram_feed['insta_popup-likes'];
            }
            if (isset($old_instagram_feed['insta_popup-align'])) {
                $new_instagram_feeds[$id]['popup']['align'] = $old_instagram_feed['insta_popup-align'];
            }
            if (isset($old_instagram_feed['insta_button_load'])) {
                $new_instagram_feeds[$id]['button_load']['display'] = $old_instagram_feed['insta_button_load'];
            }
            if (isset($old_instagram_feed['insta_button_load-text'])) {
                $new_instagram_feeds[$id]['button_load']['text'] = $old_instagram_feed['insta_button_load-text'];
            }
            if (isset($old_instagram_feed['insta_button_load-background'])) {
                $new_instagram_feeds[$id]['button_load']['background'] = $old_instagram_feed['insta_button_load-background'];
            }
            if (isset($old_instagram_feed['insta_button_load-background-hover'])) {
                $new_instagram_feeds[$id]['button_load']['background_hover'] = $old_instagram_feed['insta_button_load-background-hover'];
            }
            if (isset($old_instagram_feed['insta_card'])) {
                $new_instagram_feeds[$id]['card']['display'] = $old_instagram_feed['insta_card'];
            }
            if (isset($old_instagram_feed['insta_card-radius'])) {
                $new_instagram_feeds[$id]['card']['radius'] = $old_instagram_feed['insta_card-radius'];
            }
            if (isset($old_instagram_feed['insta_card-font-size'])) {
                $new_instagram_feeds[$id]['card']['font_size'] = $old_instagram_feed['insta_card-font-size'];
            }
            if (isset($old_instagram_feed['insta_card-background'])) {
                $new_instagram_feeds[$id]['card']['background'] = $old_instagram_feed['insta_card-background'];
            }
            if (isset($old_instagram_feed['insta_card-padding'])) {
                $new_instagram_feeds[$id]['card']['padding'] = $old_instagram_feed['insta_card-padding'];
            }
            if (isset($old_instagram_feed['insta_card-info'])) {
                $new_instagram_feeds[$id]['card']['info'] = $old_instagram_feed['insta_card-info'];
            }
            if (isset($old_instagram_feed['insta_card-length'])) {
                $new_instagram_feeds[$id]['card']['length'] = $old_instagram_feed['insta_card-length'];
            }
            if (isset($old_instagram_feed['insta_card-caption'])) {
                $new_instagram_feeds[$id]['card']['caption'] = $old_instagram_feed['insta_card-caption'];
            }
        }
        return $new_instagram_feeds;
    }

    // Backward compatibility v2.7.1 to 2.8.0
    // ----------------------------------------------------------------------- 
    function rename_insta_gallery_token_271($new_accounts = array()) {

        // if dosent exists return
        if (!$old_accounts = get_option('insta_gallery_token')) {
            return $new_accounts;
        }

        // create compatibility
        foreach ($old_accounts as $id => $access_token) {
            $new_accounts[$id] = array(
                'id' => $id,
                'account_type' => 'BASIC',
                'access_token' => $access_token
            );
        }

        return $new_accounts;
    }

    function init() {
        add_filter('option_insta_gallery_iac ', array($this, 'rename_insta_gallery_token'), 10);
        add_filter('option_insta_gallery_token', array($this, 'rename_insta_gallery_token'), 10);
        add_filter('option_insta_gallery_items', array($this, 'rename_insta_gallery_items_223'), 10);
        add_filter('default_option_insta_gallery_feeds', array($this, 'rename_insta_gallery_items_266'), 10);
        add_filter('default_option_insta_gallery_accounts', array($this, 'rename_insta_gallery_token_271'), 10);
        add_action('init', array($this, 'premium_compatibility'));
    }

    public static function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
            //self::$instance->defaults();
            self::$instance->init();
        }
        return self::$instance;
    }

}

QLIGG_Compatibility::instance();

// Get user feed
// -----------------------------------------------------------------------------
function qligg_get_user_items_old($user_id = null, $limit = 12, $next_max_id = null, $max_id = null) {

    global $qliggAPI;

    if (!$user_id) {
        $qliggAPI->BASIC->set_message(esc_html__('Please update Instagram User in the gallery settings tab.', 'insta-gallery'));
        return;
    }

    $token_model = new QLIGG_Token();
    $tokens = $token_model->get_tokens();

    if (empty($tokens[$user_id])) {
        $qliggAPI->BASIC->set_message(esc_html__('Please update Instagram Access Token in the account settings tab.', 'insta-gallery'));
        return;
    }

    $settings_model = new QLIGG_Setting();
    $settings = $settings_model->get_settings();

    $tk = "insta_gallery_user_items_{$user_id}_{$max_id}";

    // Get any existing copy of our transient data
    if (QLIGG_DEVELOPER || false === ($response = get_transient($tk))) {
        if ($response = $qliggAPI->BASIC->get_user_items($tokens[$user_id], $max_id)) {
            set_transient($tk, $response, absint($settings['insta_reset']) * HOUR_IN_SECONDS);
        }
    }

    if (!isset($response['data'])) {
        return;
    }

    if (count($feeds = $qliggAPI->BASIC->setup_user_item($response['data'], $next_max_id, $max_id)) >= $limit) {
        return $feeds;
    }

    if (!$next_max_id) {
        return $feeds;
    }

    if (!isset($response['pagination']['next_max_id'])) {
        return $feeds;
    }

    $max_id = $response['pagination']['next_max_id'];

    return array_merge($feeds, qligg_get_user_items($user_id, $limit, $next_max_id, $max_id));
}

if (!class_exists('QLIGG_Settings')) {

    class QLIGG_Settings {

        protected static $instance;

        // fix required header in license tab
        function settings_header() {
            global $submenu;
            include(QLIGG_PLUGIN_DIR . '/includes/view/backend/pages/parts/header.php');
        }

        public static function instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

    }

}

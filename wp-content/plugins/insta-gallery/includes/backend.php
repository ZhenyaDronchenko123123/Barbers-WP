<?php

class QLIGG_Backend
{

    protected static $instance;

    public static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
            self::$instance->init();
            self::$instance->includes();
        }
        return self::$instance;
    }

    function init()
    {
        add_action('admin_enqueue_scripts', array($this, 'add_js'));
        add_action('admin_enqueue_scripts', array($this, 'dequeue_js'), 999);

        //delete generate_db
        add_filter('default_option_qligg', array($this, 'generate_db'));
        add_filter('sanitize_option_qligg', 'wp_unslash');
    }

    function generate_db()
    {
        $db = new QLIGG_Model();
        return $db->options();
    }

    function includes()
    {
        include_once(QLIGG_PLUGIN_DIR . 'includes/controllers/WelcomeController.php');
        include_once(QLIGG_PLUGIN_DIR . 'includes/controllers/AccountController.php');
        include_once(QLIGG_PLUGIN_DIR . 'includes/controllers/FeedController.php');
        include_once(QLIGG_PLUGIN_DIR . 'includes/controllers/SettingController.php');
        include_once(QLIGG_PLUGIN_DIR . 'includes/controllers/PremiumController.php');
        include_once(QLIGG_PLUGIN_DIR . 'includes/controllers/SuggestionsController.php');
    }

    function dequeue_js()
    {
        // Fix Instagram Feed compatibility
        if (isset($_GET['page']) && strpos($_GET['page'], QLIGG_DOMAIN) !== false) {
            wp_deregister_script('sb_instagram_admin_js');
            wp_dequeue_script('sb_instagram_admin_js');
        }
    }

    function add_js()
    {
        wp_register_script('jquery-serializejson', plugins_url('/assets/backend/jquery-serializejson/jquery-serializejson' . QLIGG::is_min() . '.js', QLIGG_PLUGIN_FILE), array('jquery'), QLIGG_PLUGIN_VERSION, true);
        wp_register_script('wp-color-picker-alpha', plugins_url('/assets/backend/rgba/wp-color-picker-alpha.min.js', QLIGG_PLUGIN_FILE), array('jquery', 'wp-color-picker'), QLIGG_PLUGIN_VERSION, true);
        wp_register_style('qligg-admin', plugins_url('/assets/backend/css/qligg-admin' . QLIGG::is_min() . '.css', QLIGG_PLUGIN_FILE), array('wp-color-picker', 'media-views'), QLIGG_PLUGIN_VERSION, 'all');
        wp_localize_script('wp-color-picker-alpha', 'wpColorPickerL10n', array(
            'clear'            => __('Clear', 'insta-gallery'),
            'clearAriaLabel'   => __('Clear color', 'insta-gallery'),
            'defaultString'    => __('Default', 'insta-gallery'),
            'defaultAriaLabel' => __('Select default color', 'insta-gallery'),
            'pick'             => __('Select Color', 'insta-gallery'),
            'defaultLabel'     => __('Color value', 'insta-gallery'),
        ));

        if (isset($_GET['page']) && strpos($_GET['page'], QLIGG_PREFIX) !== false) {
            wp_enqueue_style('qligg-admin');
        }
    }
}

QLIGG_Backend::instance();

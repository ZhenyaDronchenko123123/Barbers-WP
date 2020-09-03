<?php

include_once(QLIGG_PLUGIN_DIR . 'includes/models/Setting.php');
include_once(QLIGG_PLUGIN_DIR . 'includes/controllers/SettingController.php');

class QLIGG_Setting_Controller extends QLIGG_Controller {

  protected static $instance;
  protected static $slug = QLIGG_DOMAIN . '_setting';

  function add_menu() {
    add_submenu_page(QLIGG_DOMAIN, esc_html__('Setting', 'insta-gallery'), esc_html__('Setting', 'insta-gallery'), 'manage_options', self::$slug, array($this, 'add_panel'));
  }

  function add_panel() {
    global $submenu;
    $settings_model = new QLIGG_Setting();
    $settings = $settings_model->get_settings();

    include (QLIGG_PLUGIN_DIR . '/includes/view/backend/pages/parts/header.php');
    include (QLIGG_PLUGIN_DIR . '/includes/view/backend/pages/settings.php');
  }

  function init() {
    add_action('wp_ajax_qligg_save_settings', array($this, 'ajax_save_settings'));
    add_action('admin_enqueue_scripts', array($this, 'add_js'));
    add_action('admin_menu', array($this, 'add_menu'));
  }

  function ajax_save_settings() {

    if (!empty($_REQUEST['settings_data']) && current_user_can('manage_options') && check_admin_referer('qligg_save_settings', 'nonce')) {
      $settings_model = new QLIGG_Setting();

      $settings_data = array();
      parse_str($_REQUEST['settings_data'], $settings_data);

      $settings_model->save_settings($settings_data);
      parent::success_ajax(esc_html__('Settings updated successfully', 'insta-gallery'));
    }

    parent::error_ajax(esc_html__('Invalid Request', 'insta-gallery'));
  }

  function add_js() {
    if (isset($_GET['page']) && ($_GET['page'] === self::$slug)) {
      wp_enqueue_media();
      wp_enqueue_script('qligg-admin-settings', plugins_url('/assets/backend/js/qligg-admin-settings' . QLIGG::is_min() . '.js', QLIGG_PLUGIN_FILE), array('wp-util', 'jquery', 'backbone', 'jquery-serializejson', 'wp-color-picker-alpha'), QLIGG_PLUGIN_VERSION, true);
      wp_localize_script('qligg-admin-settings', 'qligg_settings', array(
          'nonce' => array(
              'qligg_save_settings' => wp_create_nonce('qligg_save_settings'),
          )
      ));
    }
  }

  public static function instance() {
    if (!isset(self::$instance)) {
      self::$instance = new self();
      self::$instance->init();
    }
    return self::$instance;
  }

}

QLIGG_Setting_Controller::instance();


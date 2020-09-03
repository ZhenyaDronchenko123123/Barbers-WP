<?php

class QLIGG_Suggestions_Controller {

  protected static $instance;
  protected static $slug = QLIGG_DOMAIN . '_suggestions';

  function add_menu() {
    add_submenu_page(QLIGG_DOMAIN, esc_html__('Suggestions', 'insta-gallery'), sprintf('%s', esc_html__('Suggestions', 'insta-gallery')), 'edit_posts', QLIGG_DOMAIN . '_suggestions', array($this, 'add_panel'), 99);
  }

  function add_panel() {
    global $submenu;
    include_once(QLIGG_PLUGIN_DIR . 'includes/models/Suggestions.php');
    $wp_list_table = new QLIGG_Suggestions_List_Table();
    $wp_list_table->prepare_items();
    include (QLIGG_PLUGIN_DIR . '/includes/view/backend/pages/parts/header.php');
    include (QLIGG_PLUGIN_DIR . '/includes/view/backend/pages/suggestions.php');
  }

  function init() {
    add_action('admin_menu', array($this, 'add_menu'));
    add_action('admin_init', array($this, 'add_redirect'));
    add_filter('network_admin_url', array($this, 'network_admin_url'), 10, 2);
  }

  public function add_redirect() {

    if (isset($_REQUEST['activate']) && $_REQUEST['activate'] == 'true') {
      if (wp_get_referer() == admin_url('admin.php?page=' . QLIGG_DOMAIN . '_suggestions')) {
        wp_redirect(admin_url('admin.php?page=' . QLIGG_DOMAIN . '_suggestions'));
      }
    }
  }

// fix for activateUrl on install now button
  public function network_admin_url($url, $path) {

    if (wp_doing_ajax() && !is_network_admin()) {
      if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'install-plugin') {
        if (strpos($url, 'plugins.php') !== false) {
          $url = self_admin_url($path);
        }
      }
    }
    return $url;
  }

  public static function instance() {
    if (!isset(self::$instance)) {
      self::$instance = new self();
      self::$instance->init();
    }
    return self::$instance;
  }

}

QLIGG_Suggestions_Controller ::instance();

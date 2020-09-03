<?php

class QLIGG_Welcome_Controller {

  protected static $instance;

  public static function instance() {
    if (!isset(self::$instance)) {
      self::$instance = new self();
      self::$instance->init();
    }
    return self::$instance;
  }

  function init() {
    add_action('admin_menu', array($this, 'add_menu'));
  }

  function add_menu() {
    add_menu_page(QLIGG_PLUGIN_NAME, QLIGG_PLUGIN_NAME, 'edit_posts', QLIGG_DOMAIN, array($this, 'add_panel'), 'dashicons-camera');
    add_submenu_page(QLIGG_DOMAIN, esc_html__('Welcome', 'insta-gallery'), esc_html__('Welcome', 'insta-gallery'), 'edit_posts', QLIGG_DOMAIN, array($this, 'add_panel'));
  }

  function add_panel() {
    global $submenu;
    include (QLIGG_PLUGIN_DIR . '/includes/view/backend/pages/parts/header.php');
    include (QLIGG_PLUGIN_DIR . '/includes/view/backend/pages/welcome.php');
  }

}

QLIGG_Welcome_Controller ::instance();

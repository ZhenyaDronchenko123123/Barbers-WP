<?php

class QLIGG_Premium_Controller {

  protected static $instance;
  protected static $slug = QLIGG_DOMAIN . '_premium';

  function add_menu() {
    add_submenu_page(QLIGG_DOMAIN, esc_html__('Premium', 'insta-gallery'), sprintf('%s <i class="dashicons dashicons-awards"></i>', esc_html__('Premium', 'insta-gallery')), 'edit_posts', self::$slug, array($this, 'add_panel'));
  }

  function add_panel() {
    global $submenu;
    include (QLIGG_PLUGIN_DIR . '/includes/view/backend/pages/parts/header.php');
    include (QLIGG_PLUGIN_DIR . '/includes/view/backend/pages/premium.php');
  }

  function init() {
    add_action('admin_menu', array($this, 'add_menu'));
    add_action('admin_footer', array($this, 'add_css'));
  }

  function add_css() {

    if (isset($_GET['page']) && strpos($_GET['page'], QLIGG_DOMAIN) !== false) {
      if (!class_exists('QLIGG_PRO')) {
        ?>
        <style>
          .qligg-premium-field {
            opacity: 0.5; 
            pointer-events: none;
          }
          .qligg-premium-field .description {
            display: inline-block!important;
          }
        </style>
        <?php
      }
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

QLIGG_Premium_Controller::instance();

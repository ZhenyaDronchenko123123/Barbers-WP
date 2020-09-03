<?php

include_once(QLIGG_PLUGIN_DIR . 'includes/models/Feed.php');
include_once(QLIGG_PLUGIN_DIR . 'includes/controllers/QLIGG_Controller.php');

class QLIGG_Feed_Controller extends QLIGG_Controller
{

  protected static $instance;
  protected static $slug = QLIGG_DOMAIN . '_feeds';

  function add_menu()
  {
    add_submenu_page(QLIGG_DOMAIN, esc_html__('Feeds', 'insta-gallery'), esc_html__('Feeds', 'insta-gallery'), 'manage_options', self::$slug, array($this, 'add_panel'));
  }

  function add_panel()
  {
    global $submenu, $qliggAPI;
    $feed_model = new QLIGG_Feed();
    $feeds = $feed_model->get_feeds();
    $account_model = new QLIGG_Account();
    $accounts = $account_model->get_accounts();

    include(QLIGG_PLUGIN_DIR . '/includes/view/backend/pages/parts/header.php');
    include(QLIGG_PLUGIN_DIR . '/includes/view/backend/pages/feeds.php');
  }

  function get_feed($feed_id)
  {

    function get_the_title1($id)
    {
      return ($id == 'all') ? esc_html__('All', 'insta-gallery') : get_the_title($id);
    }

    $feed_model = new QLIGG_Feed();
    $feed = $feed_model->get_feed($feed_id);
    return $feed;
  }

  function ajax_edit_feed()
  {
    if (current_user_can('manage_options') && check_ajax_referer('qligg_edit_feed', 'nonce', false)) {

      $feed_id = (isset($_REQUEST['feed_id'])) ? absint($_REQUEST['feed_id']) : -1;

      if ($feed_id != -1) {
        $feed = $this->get_feed($feed_id);
        if ($feed) {
          return parent::success_ajax($feed);
        }
      }
      parent::error_reload_page();
    }
    parent::error_access_denied();
  }

  function ajax_save_feed()
  {

    if (isset($_REQUEST['feed']) && current_user_can('manage_options') && check_ajax_referer('qligg_save_feed', 'nonce', false)) {

      $feed = json_decode(stripslashes($_REQUEST['feed']), true);

      if (is_array($feed)) {

        $feed_model = new QLIGG_Feed();

        if (isset($feed['id'])) {
          return parent::success_ajax($feed_model->update_feed($feed));
        } else {
          return parent::success_ajax($feed_model->add_feed($feed));
        }

        return parent::error_reload_page();
      }
    }
    return parent::error_access_denied();
  }

  function ajax_delete_feed()
  {

    if (isset($_REQUEST['feed_id']) && current_user_can('manage_options') && check_ajax_referer('qligg_delete_feed', 'nonce', false)) {

      $feed_id = absint($_REQUEST['feed_id']);

      $feed_model = new QLIGG_Feed();

      $feed = $feed_model->delete_feed($feed_id);

      if ($feed['type'] == 'username') {
        $tk = "%%insta_gallery_v2_user_media_{$feed['username']}_%%";
      } else {
        $tk = "%%insta_gallery_v2_tag_media_{$feed['tag']}_%%";
      }

      $feed_model->clear_cache($tk);

      if ($feed_id) {
        return parent::success_ajax($feed);
      }

      parent::error_reload_page();
    }

    parent::error_access_denied();
  }

  function ajax_clear_cache()
  {

    global $wpdb;

    if (isset($_REQUEST['feed_id']) && current_user_can('manage_options') && check_ajax_referer('qligg_clear_cache', 'nonce', false)) {

      $feed_id = absint($_REQUEST['feed_id']);

      $feed_model = new QLIGG_Feed();

      $feed = $feed_model->get_feed($feed_id);

      if ($feed['type'] == 'username') {
        $tk = "%%insta_gallery_v2_user_media_{$feed['username']}_%%";
      } else {
        $tk = "%%insta_gallery_v2_tag_media_{$feed['tag']}_%%";
      }

      $feed_model->clear_cache($tk);

      return parent::success_ajax(esc_html__('Feed cache cleared', 'insta-gallery'));
    }

    parent::error_access_denied();
  }

  function init()
  {
    add_action('wp_ajax_qligg_edit_feed', array($this, 'ajax_edit_feed'));
    add_action('wp_ajax_qligg_save_feed', array($this, 'ajax_save_feed'));
    add_action('wp_ajax_qligg_delete_feed', array($this, 'ajax_delete_feed'));
    add_action('wp_ajax_qligg_clear_cache', array($this, 'ajax_clear_cache'));
    add_action('admin_enqueue_scripts', array($this, 'add_js'));
    add_action('admin_menu', array($this, 'add_menu'));
  }

  function add_js()
  {
    if (isset($_GET['page']) && ($_GET['page'] === self::$slug)) {
      $feed_model = new QLIGG_Feed();
      $account_model = new QLIGG_Account();
      wp_enqueue_media();
      wp_enqueue_script('qligg-admin-feed', plugins_url('/assets/backend/js/qligg-admin-feed' . QLIGG::is_min() . '.js', QLIGG_PLUGIN_FILE), array('wp-util', 'jquery', 'backbone', 'jquery-serializejson', 'wp-color-picker-alpha', 'jquery-ui-sortable'), QLIGG_PLUGIN_VERSION, true);
      wp_localize_script('qligg-admin-feed', 'qligg_feed', array(
        'nonce' => array(
          'qligg_edit_feed' => wp_create_nonce('qligg_edit_feed'),
          'qligg_save_feed' => wp_create_nonce('qligg_save_feed'),
          'qligg_delete_feed' => wp_create_nonce('qligg_delete_feed'),
          'qligg_clear_cache' => wp_create_nonce('qligg_clear_cache'),
        ),
        'message' => array(
          'save' => __('Please save feed settings to update user account.', 'insta-gallery'),
          'confirm_delete' => __('Do you want to delete the feed?', 'insta-gallery'),
          'confirm_clear_cache' => __('Do you want to delete the feed?', 'insta-gallery'),
          'confirm_username' => __('You need to create token before creating a feed.', 'insta-gallery'),
        ),
        'accounts' => $account_model->get_accounts(),
        'args' => $feed_model->get_args(),
        'redirect' => array(
          'accounts' =>  admin_url('admin.php?page=qligg_account')
        )
      ));
    }
  }

  public static function instance()
  {
    if (!isset(self::$instance)) {
      self::$instance = new self();
      self::$instance->init();
    }
    return self::$instance;
  }
}

QLIGG_Feed_Controller::instance();

<?php
if (!defined('ABSPATH'))
  exit;

include_once(QLIGG_PLUGIN_DIR . 'includes/models/Feed.php');

if (!class_exists('QLIGG_Frontend')) {

  class QLIGG_Frontend
  {

    protected static $instance;

    function add_js()
    {

      wp_register_style('insta-gallery', plugins_url('/assets/frontend/css/qligg' . QLIGG::is_min() . '.css', QLIGG_PLUGIN_FILE), null, QLIGG_PLUGIN_VERSION);

      wp_register_script('insta-gallery', plugins_url('/assets/frontend/js/qligg' . QLIGG::is_min() . '.js', QLIGG_PLUGIN_FILE), array('jquery'), QLIGG_PLUGIN_VERSION, true);

      wp_localize_script('insta-gallery', 'qligg', array(
        'ajax_url' => admin_url('admin-ajax.php')
      ));

      // Masonry
      // -----------------------------------------------------------------------
      wp_register_script('masonry', plugins_url('/assets/frontend/masonry/masonry.pkgd.min.js', QLIGG_PLUGIN_FILE), null, QLIGG_PLUGIN_VERSION, true);

      // Swiper
      // -----------------------------------------------------------------------
      wp_register_style('swiper', plugins_url('/assets/frontend/swiper/swiper.min.css', QLIGG_PLUGIN_FILE), null, QLIGG_PLUGIN_VERSION);
      wp_register_script('swiper', plugins_url('/assets/frontend/swiper/swiper.min.js', QLIGG_PLUGIN_FILE), array('jquery'), QLIGG_PLUGIN_VERSION, true);

      // Popup
      // -----------------------------------------------------------------------
      wp_register_style('magnific-popup', plugins_url('/assets/frontend/magnific-popup/magnific-popup.min.css', QLIGG_PLUGIN_FILE), null, QLIGG_PLUGIN_VERSION);
      wp_register_script('magnific-popup', plugins_url('/assets/frontend/magnific-popup/jquery.magnific-popup.min.js', QLIGG_PLUGIN_FILE), array('jquery'), QLIGG_PLUGIN_VERSION, true);
    }

    function get_items($feed = false, $next_max_id = false)
    {
      if (isset($feed['type'])) {

        if ($feed['type'] == 'username') {
          return qligg_get_user_media($feed, $next_max_id);
        }

        if ($feed['type'] == 'tag') {
          return qligg_get_tag_items($feed, $next_max_id);
        }
      }

      return array();
    }

    function ajax_load_item_images()
    {

      global $qliggAPI;

      if (!isset($_REQUEST['feed'])) {
        wp_send_json_error(esc_html__('Invalid item id', 'insta-gallery'));
      }

      $feed = json_decode(stripslashes($_REQUEST['feed']), true);

      $next_max_id = isset($_REQUEST['next_max_id']) ? $_REQUEST['next_max_id'] : null;

      ob_start();

      if (is_array($feed_items = $this->get_items($feed, $next_max_id))) {

        // Template
        // ---------------------------------------------------------------------

        $i = 1;

        foreach ($feed_items as $item) {

          $image = $item['images'][$feed['resolution']];

          // premium compatibility 2.6.6
          $instagram_feed = $feed;
          $instagram_feed['hover'] = $feed['mask']['display'];
          $instagram_feed['likes'] = $feed['mask']['likes'];
          $instagram_feed['comments'] = $feed['mask']['comments'];

          include($this->template_path('item/item.php'));

          $i++;

          if (($feed['limit'] != 0) && ($i > $feed['limit'])) {
            break;
          }
        }

        wp_send_json_success(ob_get_clean());
      }

      $messages = $qliggAPI->FEED->getMessages();

      include($this->template_path('alert.php'));

      wp_send_json_error(ob_get_clean());
    }

    function template_path($template_name, $template_file = false)
    {

      if (file_exists(QLIGG_PLUGIN_DIR . "templates/{$template_name}")) {
        $template_file = QLIGG_PLUGIN_DIR . "templates/{$template_name}";
      }

      if (file_exists(trailingslashit(get_stylesheet_directory()) . "insta-gallery/{$template_name}")) {
        $template_file = trailingslashit(get_stylesheet_directory()) . "insta-gallery/{$template_name}";
      }

      return apply_filters('qligg_template_file', $template_file, $template_name);
    }

    function do_shortcode($atts, $content = null)
    {

      global $qliggAPI;

      $feed_model = new QLIGG_Feed();
      $feeds = $feed_model->get_feeds();
      $settings_model = new QLIGG_Setting();
      $settings = $settings_model->get_settings();

      $atts = shortcode_atts(array(
        'id' => 0
      ), $atts);

      // Start loading
      // -----------------------------------------------------------------------
      $id = absint($atts['id']);

      if (count($feeds)) {
        if (isset($feeds[$id])) {

          $feed = wp_parse_args($feeds[$id], $feed_model->get_args());

          // premium compatibility 2.6.6

          if (isset($feed['type'])) {

            $profile_info =  $feed['profile'];

            //if ($feed['type'] == 'username') {
              $profile_info = qligg_get_user_profile($feed['username']);

              $feed['profile'] = array_merge($profile_info, array_filter($feed['profile']));
            //}

          }

          $profile_info['user'] = @$profile_info['username'];
          $profile_info['name'] = @$profile_info['name'];
          $profile_info['pic_url'] = @$profile_info['profile_picture_url'];
          $profile_info['picture'] = @$profile_info['profile_picture_url'];

          $feed['box']['desc'] = $feed['profile']['biography'];

          $feed['spacing'] = $feed['spacing'] / 2;

          $feed['insta_layout'] = $feed['layout'];
          $feed['insta_box'] = $feed['box']['display'];
          $feed['insta_box-padding'] = $feed['box']['padding'];
          $feed['insta_box-radius'] = $feed['box']['radius'];
          $feed['insta_box-background'] = $feed['box']['background'];
          $feed['insta_box-profile'] = $feed['box']['profile'];
          $feed['insta_box-desc'] = $feed['box']['desc'];

          $feed['insta_button_load'] = $feed['button_load']['display'];
          $feed['insta_button_load-background-hover'] = $feed['button_load']['background_hover'];
          $feed['insta_button_load-background'] = $feed['button_load']['background'];
          $feed['insta_button_load-text'] = $feed['button_load']['text'];

          $feed['insta_button'] = $feed['button']['display'];
          $feed['insta_button-background-hover'] = $feed['button']['background_hover'];
          $feed['insta_button-background'] = $feed['button']['background'];
          $feed['insta_button-text'] = $feed['button']['text'];

          $feed['insta_card'] = $feed['card']['display'];
          $feed['insta_card-font-size'] = $feed['card']['font_size'];
          $feed['insta_card-padding'] = $feed['card']['padding'];
          $feed['insta_card-radius'] = $feed['card']['radius'];
          $feed['insta_card-background'] = $feed['card']['background'];
          $feed['highlight'] = explode(',', trim(str_replace(' ', '', "{$feed['highlight']['tag']},{$feed['highlight']['id']},{$feed['highlight']['position']}"), ','));

          $options = $instagram_feed = $feed;

          wp_enqueue_style('insta-gallery');
          wp_enqueue_script('insta-gallery');

          if (!empty($feed['popup']['display'])) {
            wp_enqueue_style('magnific-popup');
            wp_enqueue_script('magnific-popup');
          }

          if ($feed['layout'] == 'carousel') {
            wp_enqueue_style('swiper');
            wp_enqueue_script('swiper');
          }

          if (in_array($feed['layout'], array('masonry', 'highlight'))) {
            wp_enqueue_script('masonry');
          }

          $item_selector = "insta-gallery-feed-{$id}";

          ob_start();
?>
          <style>
            <?php
            if ($feed['layout'] != 'carousel') {
              if (!empty($feed['spacing'])) {
                echo "#{$item_selector} .insta-gallery-list {margin: 0 -{$feed['spacing']}px;}";
              }
              if (!empty($feed['spacing'])) {
                echo "#{$item_selector} .insta-gallery-list .insta-gallery-item {padding: {$feed['spacing']}px;}";
              }
            }
            if ($feed['layout'] == 'carousel') {
              if (!empty($feed['carousel']['pagination_color'])) {
                echo "#{$item_selector} .swiper-pagination-bullet-active {background-color: {$feed['carousel']['pagination_color']};}";
              }
              if (!empty($feed['carousel']['navarrows_color'])) {
                echo "#{$item_selector} .swiper-button-next > i, #{$item_selector} .swiper-button-prev > i {color: {$feed['carousel']['navarrows_color']};}";
              }
            }
            if (!empty($feed['mask']['background'])) {
              echo "#{$item_selector} .insta-gallery-list .insta-gallery-item .insta-gallery-image-wrap .insta-gallery-image-mask {background-color: {$feed['mask']['background']};}";
            }
            if (!empty($feed['button']['background'])) {
              echo "#{$item_selector} .insta-gallery-actions .insta-gallery-button {background-color: {$feed['button']['background']};}";
            }
            if (!empty($feed['button']['background_hover'])) {
              echo "#{$item_selector} .insta-gallery-actions .insta-gallery-button:hover {background-color: {$feed['button']['background_hover']};}";
            }

            if (!empty($settings['insta_spinner_image_id'])) {

              $spinner = wp_get_attachment_image_src($settings['insta_spinner_image_id'], 'full');

              if (!empty($spinner[0])) {
                echo "#{$item_selector} .insta-gallery-spinner {background-image:url($spinner[0])}";
              }
            }
            do_action('qligg_template_style', $item_selector, $feed);
            ?>
          </style>
<?php
          if ($template_file = $this->template_path("{$feed['layout']}.php")) {
            include($template_file);
            return ob_get_clean();
          }

          $messages = array(
            sprintf(esc_html__('The layout %s is not a available.', 'insta-gallery'), $feed['layout'])
          );

          include($this->template_path('alert.php'));

          return ob_get_clean();
        }
      }
    }

    //        }

    function init()
    {
      add_action('wp_ajax_nopriv_qligg_load_item_images', array($this, 'ajax_load_item_images'));
      add_action('wp_ajax_qligg_load_item_images', array($this, 'ajax_load_item_images'));
      add_action('wp_enqueue_scripts', array($this, 'add_js'));
      add_action('admin_enqueue_scripts', array($this, 'add_js'));
      add_shortcode('insta-gallery', array($this, 'do_shortcode'));
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

  QLIGG_Frontend::instance();
}

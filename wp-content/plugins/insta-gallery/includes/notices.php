<?php

class QLIGG_Notices
{

  protected static $instance;

  public static function instance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
      self::$instance->init();
    }
    return self::$instance;
  }

  function init()
  {
    add_filter('plugin_action_links_' . plugin_basename(QLIGG_PLUGIN_FILE), array($this, 'add_action_links'));
    add_action('admin_notices', array($this, 'add_notices'));
    add_action('wp_ajax_qligg_dismiss_notice', array($this, 'ajax_dismiss_notice'));
  }

  function ajax_dismiss_notice()
  {

    if (check_admin_referer('qligg_dismiss_notice', 'nonce') && isset($_REQUEST['notice_id'])) {

      $notice_id = sanitize_key($_REQUEST['notice_id']);

      update_user_meta(get_current_user_id(), $notice_id, true);

      wp_send_json($notice_id);
    }

    wp_die();
  }

  function add_notices()
  {

    /*if (!get_transient('qligg-first-rating') && !get_user_meta(get_current_user_id(), 'qligg-user-rating', true)) {
?>
      <div id="qligg-admin-rating" class="qligg-notice notice is-dismissible" data-notice_id="qligg-user-rating">
        <div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
          <div class="notice-image">
            <img style="border-radius:50%;max-width: 90px;" src="<?php echo plugins_url('/assets/backend/img/icon-128x128.gif', QLIGG_PLUGIN_FILE); ?>" alt="<?php echo esc_html(QLIGG_PLUGIN_NAME); ?>>">
          </div>
          <div class="notice-content" style="margin-left: 15px;">
            <p>
              <?php printf(esc_html__('Hello! Thank you for choosing the %s plugin!', 'insta-gallery'), QLIGG_PLUGIN_NAME); ?>
              <br />
              <?php esc_html_e('Could you please give it a 5-star rating on WordPress? We know its a big favor, but we\'ve worked very much and very hard to release this great product. Your feedback will boost our motivation and help us promote and continue to improve this product.', 'insta-gallery'); ?>
            </p>
            <a href="<?php echo esc_url(QLIGG_DOCUMENTATION_URL); ?>/api" class="button-primary" target="_blank">
              <?php esc_html_e('More info', 'insta-gallery'); ?>
            </a>
            <a href="<?php echo esc_url(QLIGG_SUPPORT_URL); ?>" class="button-secondary" target="_blank">
              <?php esc_html_e('Update tokens', 'insta-gallery'); ?>
            </a>
          </div>
        </div>
      </div>
    <?php
    }*/
    if (!get_user_meta(get_current_user_id(), 'qligg-api-tag', true)) {
    ?>
    <div id="qligg-admin-rating" class="qligg-notice notice is-dismissible error" data-notice_id="qligg-api-tag">
      <div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
        <div class="notice-image">
          <img style="border-radius:50%;max-width: 90px;" src="<?php echo plugins_url('/assets/backend/img/icon-128x128.gif', QLIGG_PLUGIN_FILE); ?>" alt="<?php echo esc_html(QLIGG_PLUGIN_NAME); ?>>">
        </div>
        <div class="notice-content" style="margin-left: 15px;">
          <p>
            <?php printf(esc_html__('Important! Update tokens required', 'insta-gallery'), QLIGG_PLUGIN_NAME); ?>
            <br />
            <?php esc_html_e('Instagram is deprecating their old API for Personal accounts on June 29, 2020. The plugin supports their new API, however, some features are not yet available in their new API. ', 'insta-gallery'); ?>
            <br />
            <?php esc_html_e('You may also experience some API limits in the tags feeds. We\'re working on the fix that will require a business or creator Instagram account.', 'insta-gallery'); ?>
          </p>
          <a href="https://quadlayers.com/documentation/instagram-feed-gallery/api/tokens/?utm_source=qligg_admin" class="button-primary" target="_blank">
            <?php esc_html_e('More Info!', 'insta-gallery'); ?>
          </a>
          <a href="<?php echo admin_url('admin.php?page=qligg_account'); ?>" class="button-secondary">
            <?php esc_html_e('Update Tokens', 'insta-gallery'); ?>
          </a>
        </div>
      </div>
    </div>
    <?php
    }
    ?>
    <script>
      (function($) {
        $('.qligg-notice').on('click', '.notice-dismiss', function(e) {
          e.preventDefault();
          var notice_id = $(e.delegateTarget).data('notice_id');
          $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
              notice_id: notice_id,
              action: 'qligg_dismiss_notice',
              nonce: '<?php echo wp_create_nonce('qligg_dismiss_notice'); ?>'
            },
            success: function(response) {
              console.log(response);
            },
          });
        });
      })(jQuery);
    </script>
<?php
  }

  public function add_action_links($links)
  {

    $links[] = '<a target="_blank" href="' . QLIGG_PURCHASE_URL . '">' . esc_html__('Premium', 'insta-gallery') . '</a>';
    $links[] = '<a href="' . admin_url('admin.php?page=' . sanitize_title(QLIGG_PREFIX)) . '">' . esc_html__('Settings', 'insta-gallery') . '</a>';

    return $links;
  }
}

QLIGG_Notices::instance();

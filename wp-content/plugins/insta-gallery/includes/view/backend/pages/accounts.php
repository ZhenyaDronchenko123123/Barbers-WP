<div class="wrap about-wrap full-width-layout">
  <p>
    <a class="<?php
              if (is_array($accounts) && count($accounts)) {
                echo 'qligg-premium-field';
              }
              ?>" id="qligg-generate-token" target="_self" href="<?php echo esc_url($qliggAPI->PERSONAL->getAccessTokenLink()); ?>" title="<?php esc_html_e('Add Personal Account', 'insta-gallery'); ?>">
      <?php esc_html_e('Add Personal Account', 'insta-gallery'); ?>
    </a>
    <a class="<?php
              if (is_array($accounts) && count($accounts)) {
                echo 'qligg-premium-field';
              }
              ?>" id="qligg-generate-token" target="_self" href="<?php echo esc_url($qliggAPI->BUSINESS->getAccessTokenLink()); ?>" title="<?php esc_html_e('Add Business Account', 'insta-gallery'); ?>">
      <?php esc_html_e('Add Business Account', 'insta-gallery'); ?>
    </a>
    <!-- <span style="float: none; margin-top: 0;" class="spinner"></span> -->
    <a style="margin: 0 30px" target="_blank" href="https://quadlayers.com/documentation/instagram-feed-gallery/api/business/?utm_source=qligg_admin"><?php esc_html_e('Create business account', 'insta-gallery'); ?></a>
    <!-- <a id="qligg-add-token" href="javascript:;"><?php esc_html_e('Button not working?', 'insta-gallery'); ?></a> -->
    <span class="qligg-premium-field">
      <span class="description hidden"><small><?php esc_html_e('Multiple feeds are only allowed in the premium version.', 'insta-gallery'); ?></small></span>
    </span>
  </p>

  <?php if (is_array($accounts) && count($accounts)) : ?>
    <table id="qligg_account_table" class="form-table widefat striped">
      <thead>
        <tr>
          <th><?php esc_html_e('Image', 'insta-gallery'); ?></th>
          <th><?php esc_html_e('Userame', 'insta-gallery'); ?></th>
          <th><?php esc_html_e('Account', 'insta-gallery'); ?></th>
          <th><?php esc_html_e('Token', 'insta-gallery'); ?></th>
          <th><?php esc_html_e('Type', 'insta-gallery'); ?></th>
          <th><?php esc_html_e('Expires', 'insta-gallery'); ?></th>
          <th><?php esc_html_e('Action', 'insta-gallery'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($accounts as $account_id => $account) {

          $profile = qligg_get_user_profile($account_id);

        ?>
          <tr class="<?php echo esc_attr(strtolower($account['token_type'])); ?>" data-account_id="<?php echo esc_attr($account_id) ?>">
            <td width="1%">
              <img class="qligg-avatar" src="<?php echo esc_url($profile['profile_picture_url']); ?>" />
            </td>
            <td>
              <?php echo esc_html($profile['username']); ?>
            </td>
            <td>
              <?php echo esc_html($account['id']); ?>
            </td>
            <td style="width: 300px;">
              <input type="hidden" name="account_id" value="<?php echo esc_attr($account_id); ?>">
              <input id="<?php echo esc_attr($account_id); ?>-access-token" type="text" value="<?php echo esc_attr($account['access_token']); ?>" readonly />
              <a href="javascript:;" data-qligg-copy-token="#<?php echo esc_attr($account_id); ?>-access-token" class="button button-primary">
                <i class="dashicons dashicons-admin-page"></i>
              </a>
            </td>
            <td>
              <?php echo esc_html($account['token_type']); ?>
            </td>
            <td>
              <?php echo esc_html(date('Y-m-d', (int) $account['expiration_date'])); ?>
            </td>
            <td>
              <a href="javascript:;" data-qligg-delete-token="<?php echo esc_attr($account_id); ?>" class="button button-secondary">
                <i class="dashicons dashicons-trash"></i>
              </a>
              <span class="spinner"></span>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<?php include_once('modals/template-scripts-account.php'); ?>
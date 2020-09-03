<div class="wrap about-wrap full-width-layout">
  <form method="post">
    <p class="submit">
      <?php submit_button(esc_html__('+ Feed', 'btn-instagram'), 'primary', 'submit', false, array('id' => 'qligg-add-feed')); ?>
      <!--<span class="settings-save-status qligg-premium-field">
      <?php submit_button(esc_html__('Save reorder', 'insta-gallery'), 'secondary', 'submit', false, array('id' => 'qligg_feeds_order', 'disabled' => 'disabled')); ?>
    <span class="saved"><?php esc_html_e('Saved successfully!'); ?></span>
    </span>-->
      <span class="spinner"></span>
      <a style="margin: 0 30px" target="_blank" href="https://quadlayers.com/documentation/instagram-feed-gallery/api/tag/?utm_source=qligg_admin"><?php esc_html_e('Create tag feed', 'insta-gallery'); ?></a>
    </p>
    <table id="qligg_feeds_table" class="form-table widefat striped">
      <thead>
        <tr>
          <th><?php esc_html_e('Image', 'insta-gallery'); ?></th>
          <th><?php esc_html_e('Token', 'insta-gallery'); ?></th>
          <th><?php esc_html_e('Feed', 'insta-gallery'); ?></th>
          <th><?php esc_html_e('Layout', 'insta-gallery'); ?></th>
          <th><?php esc_html_e('Shortcode', 'insta-gallery'); ?></th>
          <th><?php esc_html_e('Action', 'insta-gallery'); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $position = 1;

        foreach ($feeds as $id => $feed) {

          if (!isset($feed['type']))
            continue;

          $profile = qligg_get_user_profile($feed['username']);

          unset($profile['profile_picture_url']);
          
          $profile = array_merge($profile, array_filter($feed['profile']));

          //$profile = $feed['profile'];

        ?>
          <tr data-feed_id="<?php echo esc_attr($id) ?>" data-feed_position="<?php echo esc_attr($position) ?>">
            <td width="1%">
              <img class="qligg-avatar" src="<?php echo esc_url($profile['profile_picture_url']); ?>" />
            </td>
            <td width="1%">
              <?php echo esc_html($feed['username']); ?>
            </td>
            <td width="1%">
              <?php echo esc_html($feed['type']  == 'tag' ? $feed['tag'] : $profile['username']); ?>
            </td>
            <td>
              <?php echo esc_html(ucfirst($feed['layout'])); ?>
            </td>
            <td style="width: 216px;">
              <input style="width:142px" id="<?php echo esc_attr($id); ?>-feed-shortcode" type="text" value='[insta-gallery id="<?php echo esc_attr($id); ?>"]' readonly />
              <a href="javascript:;" data-qligg-copy-feed-shortcode="#<?php echo esc_attr($id); ?>-feed-shortcode" class="button button-primary">
                <i class="dashicons dashicons-admin-page"></i>
              </a>
            </td>
            <td>
              <a href="javascript:;" class="qligg_edit_feed button button-primary" title="<?php esc_html_e('Edit feed', 'insta-gallery'); ?>"><?php esc_html_e('Edit'); ?></a>
              <a href="javascript:;" class="qligg_clear_cache button button-secondary" title="<?php esc_html_e('Clear feed cache', 'insta-gallery'); ?>"><i class="dashicons dashicons dashicons-update"></i><?php esc_html_e('Cache', 'insta-gallery'); ?></a>
              <a href="javascript:;" class="qligg_delete_feed button button-secondary" title="<?php esc_html_e('Delete feed', 'insta-gallery'); ?>"><i class="dashicons dashicons-trash"></i></a>
              <span class="spinner"></span>
            </td>
          </tr>
        <?php
          $position++;
        }
        unset($i);
        ?>
      </tbody>
    </table>
  </form>
</div>

<?php include_once('modals/template-scripts-feed.php'); ?>
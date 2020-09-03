<div id="tab_panel_feed_profile" class="panel qligg_options_panel <# if (data.panel != 'tab_panel_feed_profile') { #>hidden<# } #>">
  <div class="attachment-info" style="
    position: absolute;
    right: 0;
    width:300px;
">
    <div id="panel-info">
      <span class="settings-save-status">
        <span class="spinner"></span>
        <span class="saved"><?php esc_html_e('Saved.'); ?></span>
      </span>

      <div class="details">
        <div class="filename"><strong><?php esc_html_e('Feed', 'insta-gallery'); ?>:</strong> {{data.username}}</div>
      </div>

      <div class="settings">
        <div class="upload">
          <img id="cavatar-img" class="qligg-avatar" data-src="{{data.profile.profile_picture_url}}" src="{{data.profile.profile_picture_url}}" width="150" height="150" />
          <div>
            <input type="hidden" name="profile[profile_picture_url]" id="cavatar" value="{{data.profile.profile_picture_url}}" />
            <button type="button" class="upload_image_button button"><?php esc_html_e('Upload', 'insta-gallery'); ?></button>
            <button type="button" class="remove_image_button button">&times;</button>
          </div>
        </div>
      </div>

      <div class="actions">
        <a target="_blank" href="<?php echo QLIGG_PURCHASE_URL; ?>"><?php esc_html_e('Premium', 'insta-gallery'); ?></a> |
        <a target="_blank" href="<?php echo QLIGG_DOCUMENTATION_URL; ?>"><?php esc_html_e('Documentation', 'insta-gallery'); ?></a>
      </div>
    </div>
  </div>

  <div style="padding-right: 300px;">
    <div class="options_group">
      <p class="form-field">
        <label><?php esc_html_e('Full Name', 'insta-gallery'); ?></label>
        <input name="profile[name]" type="text" value="{{data.profile.name}}" />
        <span class="description"><small><?php esc_html_e('Feed profile full name', 'insta-gallery'); ?></small></span>
      </p>
    </div>

    <div class="options_group">
      <p class="form-field">
        <label><?php esc_html_e('Biography', 'insta-gallery'); ?></label>
        <textarea name="profile[biography]" placeholder="<?php esc_html_e('Feed profile biography', 'insta-gallery'); ?>">{{data.profile.biography}}</textarea>
      </p>
    </div>
  </div>
</div>
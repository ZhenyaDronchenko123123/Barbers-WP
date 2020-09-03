<div class="media-modal-backdrop">&nbsp;</div>
<div tabindex="0" id="<?php echo esc_attr(QLIGG_PREFIX . '_modal'); ?>" class="media-modal qligg-modal-token wp-core-ui upload-php" role="dialog" aria-modal="true" aria-labelledby="media-frame-title">
  <form class="media-modal-form" method="POST">
    <div class="media-modal-content" role="document">
      <div class="edit-attachment-frame mode-select hide-menu hide-router">
        <div class="edit-media-header"> 
          <button type="button" class="media-modal-close"><span class="media-modal-icon"><span class="screen-reader-text"><?php esc_html_e('Close dialog'); ?></span></span></button>
        </div> 
        <div class="media-frame-title">
          <h1><?php esc_html_e('Manually connect an account', 'insta-gallery'); ?></h1>
        </div>
        <div class="panel" style="
             top: 50px;
             position: absolute;
             width: 100%;
             border-top: 1px solid #ddd;
             ">
          <div class="options_group">
            <p class="form-field">
              <label><?php esc_html_e('Account ID:', 'insta-gallery'); ?></label>
              <input style="min-width: 260px;" name="id" type="text" maxlength="200" placeholder="<?php esc_html_e('Enter a user id', 'insta-gallery'); ?>" required />
              <span class="description"><a style="margin: 0 15px" target="_blank" href="https://quadlayers.com/insta-token/"><?php esc_html_e('Get access token', 'insta-gallery'); ?></a></span> 
            </p>
            <p class="form-field">
              <label><?php esc_html_e('Account Token', 'insta-gallery'); ?></label>
              <input style="min-width: 260px;" name="access_token" type="text" maxlength="200" placeholder="<?php esc_html_e('Enter a valid access token', 'insta-gallery'); ?>" required />
              <span class="description"><a style="margin: 0 15px" target="_blank" href="https://quadlayers.com/insta-token/"><?php esc_html_e('Get access token', 'insta-gallery'); ?></a></span> 
            </p>
          </div>
          <div class="options_group" style="border-bottom: none">
            <p class="form-field">
              Once you click the button you'll be prompted to log into your Instagram account and authorize the website to read your information. Once authorized you'll be returned back to this page with both your Access Token and User ID.
            </p>
          </div>          
        </div>
        <div class="media-frame-toolbar" style="left:0;">
          <div class="media-toolbar">
            <div class="media-toolbar-secondary">
              <span class="settings-save-status media-button" style="float:left">
                <span class="saved"><?php esc_html_e('Saved successfully!'); ?></span>
                <span class="spinner"></span>
              </span>
            </div>
            <div class="media-toolbar-primary search-form">
              <button type="submit" class="media-modal-submit button button-primary media-button button-large" <# if ( data.id != undefined ) { #>disabled="disabled"<# } #>><?php esc_html_e('Save'); ?></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="media-modal-backdrop">&nbsp;</div>
<div tabindex="0" id="<?php echo esc_attr(QLIGG_PREFIX . '_modal'); ?>" class="media-modal qligg-modal-feed wp-core-ui upload-php processing" role="dialog" aria-modal="true" aria-labelledby="media-frame-title">
  <div class="media-modal-content" role="document">
    <form class="media-modal-form" method="POST">
      <# if ( data.id != undefined ) { #>
      <input type="hidden" name="id" value="{{data.id}}" />
      <input type="hidden" name="order" value="{{data.order}}" />
      <# } #>
      <div class="edit-attachment-frame mode-select hide-menu hide-router">
        <div class="edit-media-header">
          <# if ( data.id != undefined ) { #>
          <button type="button" class="media-modal-prev left dashicons" <# if ( data.order == 1 ) { #>disabled="disabled"<# } #>><span class="screen-reader-text"><?php esc_html_e('Edit previous media item'); ?></span></button>
          <button type="button" class="media-modal-next right dashicons" <# if ( data.order == <?php echo esc_attr(count($feeds)); ?> ) { #>disabled="disabled"<# } #> ><span class="screen-reader-text"><?php esc_html_e('Edit next media item'); ?></span></button>
          <# } #>
          <button type="button" class="media-modal-close"><span class="media-modal-icon"><span class="screen-reader-text"><?php esc_html_e('Close dialog'); ?></span></span></button>
        </div>
        <div class="media-frame-title">
          <h1><?php esc_html_e('Edit feed', 'insta-gallery'); ?> # <# if ( data.id != undefined ) { #>{{data.id}}<# } else { #><?php echo esc_html_e('New', 'insta-gallery'); ?><# } #></h1>
        </div>
        <div class="media-frame-content" style="bottom:61px;">
          <div class="attachment-details" style="overflow: hidden;">
            <div class="attachment-media-view landscape">
              <div id="woocommerce-product-data" style="height:100%;">
                <div class="panel-wrap" style="height:100%;">
                  <div id="qligg-modal-tabs">
                  </div>
                  <div id="qligg-modal-panels" style="height: 100%;overflow-x: hidden;">
                  </div>
                </div>
              </div>
            </div>
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
              <button type="button" class="media-modal-close button button-secondary media-button button-large" style="
                      height: auto;
                      float: none;
                      position: inherit;
                      padding: inherit;
                      "><?php esc_html_e('Close'); ?></button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
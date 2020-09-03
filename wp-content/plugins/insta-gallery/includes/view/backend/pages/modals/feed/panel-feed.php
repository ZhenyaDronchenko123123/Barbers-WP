<div id="tab_panel_feed" class="panel qligg_options_panel <# if (data.panel != 'tab_panel_feed') { #>hidden<# } #>">

  <div class="disabled-feature options_group">
    <p class="form-field">
      Instagram is deprecating their old API for Personal accounts on June 29, 2020. The plugin supports their new API, however, some features are will be no longuer available in their new API.
    </p>
  </div>

  <div class="options_group <?php if (!count($accounts)) { ?>disabled-feature<?php } ?>">

    <p class="form-field">
      <label><?php esc_html_e('Account', 'insta-gallery'); ?></label>
      <select class="media-modal-render-panels" name="username" <# if ( data.username=='username' ) {#>required="required"<#}#>>
        <?php foreach ($accounts as $account_id => $account) : ?>
          <?php $profile_info = qligg_get_user_profile($account_id); ?>
          <option value="<?php echo esc_attr($account_id) ?>" <# if ( data.username==<?php echo $account_id; ?> ) { #>selected="selected"<# } #> > <?php echo esc_html($profile_info['username']); ?></option>
        <?php endforeach; ?>
      </select>
      <span class="description"><small><?php esc_html_e('Please select Instagram account', 'insta-gallery'); ?></small></span>
    </p>

    <# if (data.username && !qligg_feed.accounts[data.username]){ #>
      <p class="form-field">
        <span class="notice error" style="margin-left:0; margin-right:0; padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
          <strong>
            <?php printf(esc_html__('No Instagram account connected. Please connect your account <a href="%s">here</a>.', 'insta-gallery'), admin_url('admin.php?page=qligg_account')); ?>
          </strong>
        </span>
      </p>
      <# } #>

        <p class="form-field">
          <label><?php esc_html_e('Feed', 'insta-gallery'); ?></label>
          <input type="radio" class="media-modal-render-panels" name="type" value="tag" <# if(data.type=='tag' ) { #>checked="checked"<# } #> />
            <label><?php esc_html_e('Tag', 'insta-gallery'); ?></label>
            <input type="radio" class="media-modal-render-panels" name="type" value="username" <# if(data.type=='username' ) { #>checked="checked"<# } #> />
              <label><?php esc_html_e('Username', 'insta-gallery'); ?></label>
        </p>

  </div>

  <div class="options_group <# if ( data.type != 'tag') {#>hidden<#}#>">
    <# if ( data.username && qligg_feed.accounts[data.username] && qligg_feed.accounts[data.username].token_type=='BUSINESS' ){ #>
      <p class="form-field">
        <label><?php esc_html_e('Tag', 'insta-gallery'); ?></label>
        <input name="tag" type="text" <# if ( data.type=='tag' ) {#>required="required"<#}#> placeholder="beautiful" value="{{data.tag}}" />
        <span class="description">
          <small>
            <?php esc_html_e('Please enter Instagram tag', 'insta-gallery'); ?>
          </small>
        </span>
      </p>
      <p class="form-field">
        <label><?php esc_html_e('Order by', 'insta-gallery'); ?></label>
        <select class="media-modal-render-panels" name="order_by" <# if ( data.username=='username' ) {#>required="required"<#}#>>
          <option value="recent_media" <# if ( data.order_by=='recend_media' ) { #>selected="selected"<# } #> ><?php echo esc_html('Recent (Within 24 hours)', 'insta-gallery'); ?></option>
          <option value="top_media" <# if ( data.order_by=='top_media' ) { #>selected="selected"<# } #> ><?php echo esc_html('Top (Most popular first)', 'insta-gallery'); ?></option>
        </select>
        <span class="description">
          <small>
            <?php esc_html_e('Please enter Instagram tag order', 'insta-gallery'); ?>
          </small>
        </span>
      </p>

        <# if(data.order_by=='recent_media' ) { #>
          <p class="form-field">
            <span class="notice error" style="margin-left:0; margin-right:0; padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
              <strong>
                <?php esc_html_e('Due to the restrictions of the new Instagram API the recent order will only return the most recent images from the past 24 hours.', 'insta-gallery'); ?>
              </strong>
            </span>
          </p>
        <# } #>

      <# } else { #>
        <p class="form-field">
          <span class="notice error" style="margin-left:0; margin-right:0; padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
            <strong>
              <?php printf(esc_html__('Due to the restrictions of the new Instagram <a target="_blank" href="%s">API</a> it is necessary to connect a business account <a href="%s">here</a>.', 'insta-gallery'), 'https://quadlayers.com/documentation/instagram-feed-gallery/api/business/?utm_source=qligg_admin', admin_url('admin.php?page=qligg_account')); ?>
            </strong>
          </span>
        </p>
      <# } #>
  </div>

  <div class="options_group">
    <div class="form-field">
      <ul class="list-images">
        <li class="media-modal-image <# if ( data.layout == 'gallery') {#>active<#}#>">
          <input type="radio" name="layout" value="gallery" <# if (data.layout=='gallery' ){ #>checked<# } #> />
            <label for="insta_layout-gallery"><?php esc_html_e('Gallery', 'insta-gallery'); ?></label>
            <img src="<?php echo plugins_url('/assets/backend/img/gallery.png', QLIGG_PLUGIN_FILE); ?>" />
        </li>
        <li class="media-modal-image <# if ( data.layout == 'carousel') {#>active<# } #>">
          <input type="radio" name="layout" value="carousel" <# if (data.layout== 'carousel'){ #>checked<# } #> />
                 <label for="insta_layout-carousel"><?php esc_html_e('Carousel', 'insta-gallery'); ?></label>
          <img src="<?php echo plugins_url('/assets/backend/img/carousel.png', QLIGG_PLUGIN_FILE); ?>"/>
        </li>
        <li class="media-modal-image qligg-premium-field <# if ( data.layout == 'masonry') {#>active<#}#>">
          <input type="radio" name="layout" value="masonry" <# if (data.layout=='masonry' ){ #>checked<# } #> />
            <label for="insta_layout-masonry"><?php esc_html_e('Masonry', 'insta-gallery'); ?>
              <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
            </label>
            <img src="<?php echo plugins_url('/assets/backend/img/masonry.png', QLIGG_PLUGIN_FILE); ?>" />
        </li>
        <li class="media-modal-image qligg-premium-field <# if ( data.layout == 'highlight') {#>active<#}#>">
          <input type="radio" id="insta_layout-highlight" name="layout" value="highlight" <# if (data.layout=='highlight' ){ #>checked<# } #> />
            <label for="insta_layout-highlight"><?php esc_html_e('Highlight', 'insta-gallery'); ?>
              <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
            </label>
            <img src="<?php echo plugins_url('/assets/backend/img/highlight.png', QLIGG_PLUGIN_FILE); ?>" />
        </li>
      </ul>
    </div>
  </div>

  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Limit', 'insta-gallery'); ?></label>
      <input name="limit" type="number" min="1" max="50" value="{{data.limit}}" />
      <span class="description"><small><?php esc_html_e('Number of images to display', 'insta-gallery'); ?></small></span>
    </p>
  </div>

  <div class="options_group <# if(!_.contains(['gallery', 'masonry', 'highlight'], data.layout)) { #>hidden<# } #>">
    <p class="form-field">
      <label><?php esc_html_e('Columns', 'insta-gallery'); ?></label>
      <input name="columns" type="number" min="1" max="20" value="{{data.columns}}" />
      <span class="description"><small><?php esc_html_e('Number of images in a row', 'insta-gallery'); ?></small></span>
    </p>
  </div>

  <div class="options_group qligg-premium-field <# if(!_.contains(['highlight', 'masonry'], data.layout)) { #>hidden<# } #>">
    <p class="form-field">
      <label><?php esc_html_e('Highlight by tag', 'insta-gallery'); ?></label>
      <textarea name="highlight[tag]" placeholder="tag1, tag2, tag3">{{data.highlight.tag}}</textarea>
      <span class="description"><small><?php esc_html_e('Highlight feeds items with this tags', 'insta-gallery'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Highlight by id', 'insta-gallery'); ?></label>
      <textarea name="highlight[id]" placeholder="101010110101010">{{data.highlight.id}}</textarea>
      <span class="description"><small><?php esc_html_e('Highlight feeds items with this ids', 'insta-gallery'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Highlight by position', 'insta-gallery'); ?></label>
      <textarea name="highlight[position]" placeholder="1, 5, 7">{{data.highlight.position}}</textarea>
      <span class="description"><small><?php esc_html_e('Highlight feeds items in this positions', 'insta-gallery'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p>
  </div>

</div>
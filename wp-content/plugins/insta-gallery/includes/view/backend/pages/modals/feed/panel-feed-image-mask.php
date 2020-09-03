<div id="tab_panel_feed_image_mask" class="panel qligg_options_panel <# if (data.panel != 'tab_panel_feed_image_mask') { #>hidden<# } #>" >

  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Images mask', 'insta-gallery'); ?></label>
      <input class="media-modal-render-panels" name="mask[display]" type="checkbox" value="true" <# if (data.mask.display){ #>checked<# } #>/>
             <span class="description"><small><?php esc_html_e('Image mouseover effect', 'insta-gallery'); ?></small></span>
    </p>
  </div>

  <div class="options_group <# if (!data.mask.display){ #>disabled-field<# } #>">
    <p class="form-field">
      <label><?php esc_html_e('Images mask color', 'insta-gallery'); ?></label>
      <input data-alpha="true" name="mask[background]"  type="text"  placeholder="#007aff" value="{{data.mask.background}}" class="color-picker"/>

      <span class="description"><small><?php esc_html_e('Color which is displayed when displayed over images', 'insta-gallery'); ?></small></span>
    </p>
  </div>

  <div class="<# if (data.username && qligg_feed.accounts[data.username] && qligg_feed.accounts[data.username].token_type!='BUSINESS') {#>disabled-feature<#}#> options_group <# if (!data.mask.display){ #>disabled-field<# } #>">
    <p class="form-field">
      <label><?php esc_html_e('Images mask likes', 'insta-gallery'); ?></label>
      <input name="mask[likes]" type="checkbox" value="true" <# if (data.mask.likes ){ #>checked<# } #>/>
             <span class="description"><small><?php esc_html_e('Display likes count of images', 'insta-gallery'); ?></small></span>
    </p>

    <p class="form-field">
      <label><?php esc_html_e('Images mask comments', 'insta-gallery'); ?></label>
      <input name="mask[comments]" type="checkbox" value="true" <# if (data.mask.comments ){ #>checked<# } #>/>
             <span class="description"><small><?php esc_html_e('Display comments count of images', 'insta-gallery'); ?></small></span>
    </p>
    <p class="form-field <# if (data.username && qligg_feed.accounts[data.username] && qligg_feed.accounts[data.username].token_type=='BUSINESS') {#>hidden<#}#>">
      Instagram is deprecating their old API for Personal accounts on June 29, 2020. The plugin supports their new API, however, some features (such as this one) are not yet available in their new API. We're working to get this feature back as soon as possible.
    </p>
  </div>

</div>
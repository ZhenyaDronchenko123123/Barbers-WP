<div id="tab_panel_feed_image_popup" class="panel qligg_options_panel <# if (data.panel != 'tab_panel_feed_image_popup') { #>hidden<# } #>" >

  <div class="options_group"> 
    <p class="form-field"> 
      <label><?php esc_html_e('Images popup', 'insta-gallery'); ?></label>
      <input class="media-modal-render-panels" name="popup[display]" type="checkbox" value="true" <# if (data.popup.display){ #>checked<# } #>/>
             <span class="description"><small><?php esc_html_e('Display popup gallery by clicking on image', 'insta-gallery'); ?></small></span>
    </p>
  </div>

  <div class="options_group qligg-premium-field <# if (!data.popup.display){ #>disabled-field<# } #>">
    <p class="form-field"> 
      <label><?php esc_html_e('Images popup profile', 'insta-gallery'); ?></label> 
      <input name="popup[profile]" type="checkbox" value="true" <# if (data.popup.profile){ #>checked<# } #> />
             <span class="description"><small><?php esc_html_e('Display user profile or tag info', 'insta-gallery'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p>
  </div>

  <div class="options_group qligg-premium-field <# if (!data.popup.display){ #>disabled-field<# } #>">
    <p class="form-field"> 
      <label><?php esc_html_e('Images popup caption', 'insta-gallery'); ?></label>
      <input name="popup[caption]" type="checkbox" value="true" <# if (data.popup.caption){ #>checked<# } #> /> 
             <span class="description"><small><?php esc_html_e('Display caption in the popup', 'insta-gallery'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p>
  </div>

  <div class="options_group qligg-premium-field <# if (!data.popup.display){ #>disabled-field<# } #> <# if (data.username && qligg_feed.accounts[data.username] && qligg_feed.accounts[data.username].token_type!='BUSINESS') {#>disabled-feature<#}#> options_group <# if (!data.mask.display){ #>disabled-field<# } #>">
    <p class="form-field"> 
      <label><?php esc_html_e('Images popup likes', 'insta-gallery'); ?></label>
      <input name="popup[likes]" type="checkbox" value="true" <# if (data.popup.likes){ #>checked<# } #>/>
             <span class="description"><small><?php esc_html_e('Display likes count of images', 'insta-gallery'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p>
    <p class="form-field"> 
      <label><?php esc_html_e('Images popup comments', 'insta-gallery'); ?></label>
      <input name="popup[comments]" type="checkbox" value="true" <# if (data.popup.comments){ #>checked<# } #>/>
             <span class="description"><small><?php esc_html_e('Display comments count of images', 'insta-gallery'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p>
    <p class="form-field <# if (data.username && qligg_feed.accounts[data.username] && qligg_feed.accounts[data.username].token_type=='BUSINESS') {#>hidden<#}#>">
      Instagram is deprecating their old API for Personal accounts on June 29, 2020. The plugin supports their new API, however, some features (such as this one) are not yet available in their new API. We're working to get this feature back as soon as possible.
    </p>
  </div>

  <div class="options_group qligg-premium-field <# if (!data.popup.display){ #>disabled-field<# } #>">
    <p class="form-field"> 
      <label><?php esc_html_e('Images popup align', 'insta-gallery'); ?></label>
      <select name="popup[align]">
        <option <# if ( data.popup.align == 'left') { #>selected="selected"<# } #> value="left"><?php esc_html_e('Left', 'insta-gallery'); ?> </option>
        <option <# if ( data.popup.align == 'right') { #>selected="selected"<# } #> value="right"><?php esc_html_e('Right', 'insta-gallery'); ?> </option>
        <option <# if ( data.popup.align == 'bottom') { #>selected="selected"<# } #> value="bottom"><?php esc_html_e('Bottom', 'insta-gallery'); ?> </option>
        <option <# if ( data.popup.align == 'top') { #>selected="selected"<# } #> value="top"><?php esc_html_e('Top', 'insta-gallery'); ?> </option>
      </select>
      <span class="description"><small><?php esc_html_e('Align item description in popup', 'insta-gallery'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p>
  </div>

</div>
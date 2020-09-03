<div id="tab_panel_feed_button" class="panel qligg_options_panel <# if (data.panel != 'tab_panel_feed_button') { #>hidden<# } #>" >

  <div class="options_group">
    <p class="form-field">
      <label><?php esc_html_e('Instagram button', 'insta-gallery'); ?></label>
      <input class="media-modal-render-panels" name="button[display]" type="checkbox" value="true" <# if (data.button.display){ #>checked<# } #>/>
             <span class="description"><small><?php esc_html_e('Display the button to open Instagram site link', 'insta-gallery'); ?></small></span>
    </p>
    <p class="form-field <# if (!data.button.display){ #>disabled-field<# } #>">
      <label><?php esc_html_e('Instagram button text', 'insta-gallery'); ?></label>
      <input name="button[text]" type="text" placeholder="Instagram" value="{{data.button.text}}"/>
             <span class="description"><small><?php esc_html_e('Instagram button text here', 'insta-gallery'); ?></small></span>
  </div>
  
  <div class="options_group <# if (!data.button.display){ #>disabled-field<# } #> ">
    <p class="form-field">
      <label><?php esc_html_e('Instagram button background', 'insta-gallery'); ?></label>
      <input class="color-picker" data-alpha="true" name="button[background]" type="text" placeholder="#c32a67" value="{{data.button.background}}"/>
             <span class="description"><small><?php esc_html_e('Color which is displayed on button background', 'insta-gallery'); ?></small></span>
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Instagram button hover background', 'insta-gallery'); ?></label>
      <input class="color-picker" data-alpha="true" name="button[background_hover]" type="text" placeholder="#da894a" value="{{data.button.background_hover}}"/>
             <span class="description"><small><?php esc_html_e('Color which is displayed when hovered over button', 'insta-gallery'); ?></small></span>
    </p>
  </div>

</div>
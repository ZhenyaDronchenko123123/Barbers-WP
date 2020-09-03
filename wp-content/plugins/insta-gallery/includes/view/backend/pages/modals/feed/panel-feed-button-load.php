<div id="tab_panel_feed_button_load" class="panel qligg_options_panel <# if (data.panel != 'tab_panel_feed_button_load') { #>hidden<# } #>" >

  <div class="options_group qligg-premium-field">
    <p class="form-field">
      <label><?php esc_html_e('Instagram button', 'insta-gallery'); ?></label>
      <input class="media-modal-render-panels" name="button_load[display]" type="checkbox" value="true" <# if (data.button_load.display){ #>checked<# } #>/>
             <span class="description"><small><?php esc_html_e('Display the button to open Instagram site link', 'insta-gallery'); ?></small></span>
    </p>
    <p class="form-field <# if (!data.button_load.display){ #>disabled-field<# } #>">
      <label><?php esc_html_e('Instagram button text', 'insta-gallery'); ?></label>
      <input name="button_load[text]" type="text" placeholder="Instagram" value="{{data.button_load.text}}"/>
             <span class="description"><small><?php esc_html_e('Instagram button text here', 'insta-gallery'); ?></small></span>
  </div>
  
  <div class="options_group qligg-premium-field <# if (!data.button_load.display){ #>disabled-field<# } #>">
    <p class="form-field">
      <label><?php esc_html_e('Instagram button background', 'insta-gallery'); ?></label>
      <input class="color-picker" data-alpha="true" name="button_load[background]" type="text" placeholder="#c32a67" value="{{data.button_load.background}}"/>
             <span class="description"><small><?php esc_html_e('Color which is displayed on button background', 'insta-gallery'); ?></small></span>
    </p>
    <p class="form-field">
      <label><?php esc_html_e('Instagram button hover background', 'insta-gallery'); ?></label>
      <input class="color-picker" data-alpha="true" name="button_load[background_hover]" type="text" placeholder="#da894a" value="{{data.button_load.background_hover}}"/>
             <span class="description"><small><?php esc_html_e('Color which is displayed when hovered over button', 'insta-gallery'); ?></small></span>
    </p>
  </div>

</div>
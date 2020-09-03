<div id="tab_panel_feed_box" class="panel qligg_options_panel <# if (data.panel != 'tab_panel_feed_box') { #>hidden<# } #> " >

  <div class="options_group qligg-premium-field">
    <p class="form-field">
      <label><?php esc_html_e('Box', 'insta-gallery'); ?></label>
      <input class="media-modal-render-panels" name="box[display]" type="checkbox" value="true" <# if (data.box.display){ #>checked<# } #> /> 
             <span class="description"><small><?php esc_html_e('Display the Instagram Feed inside a customizable box', 'insta-gallery'); ?></small></span> 
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p>
  </div> 

  <div class="options_group <# if (!data.box.display){ #>disabled-field<# } #>"> 	 
    <p class="form-field">
      <label><?php esc_html_e('Box padding', 'insta-gallery'); ?></label>
      <input name="box[padding]" type="number" value="{{data.box.padding}}" min="0"/>
      <span class="description"><small><?php esc_html_e('Add padding to the Instagram Feed', 'insta-gallery'); ?></small></span> 
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p> 

    <p class="form-field">
      <label><?php esc_html_e('Box radius', 'insta-gallery'); ?></label>
      <input name="box[radius]" type="number" value="{{data.box.radius}}" min="0"/>
      <span class="description"><small><?php esc_html_e('Add radius to the Instagram Feed', 'insta-gallery'); ?></small></span> 
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p> 

    <p class="form-field"> 
      <label><?php esc_html_e('Box background', 'insta-gallery'); ?></label>
      <input data-alpha="true" name="box[background]" type="text" placeholder="#c32a67" value="{{data.box.background}}" class="color-picker"/>
      <span class="description"><small><?php esc_html_e('Color which is displayed on box background', 'insta-gallery'); ?></small></span> 
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p>
  </div>

  <div class="options_group qligg-premium-fielsd <# if (!data.box.display){ #>disabled-field<# } #>"> 
    <p class="form-field"> 
      <label><?php esc_html_e('Profile', 'insta-gallery'); ?></label> 
      <input class="media-modal-render-panels" name="box[profile]" type="checkbox" value="true" <# if (data.box.profile){ #>checked<# } #> />
             <span class="description"><small><?php esc_html_e('Display user profile or tag info', 'insta-gallery'); ?> </small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p> 
    <!-- <p class="form-field <# if (!data.box.profile){ #>disabled-field<# } #>"> 
      <label><?php esc_html_e('Profile description', 'insta-gallery'); ?></label> 
      <input name="box[desc]" type="text" placeholder="Instagram" value="{{data.box.desc}}"/>
      <span class="description"><small><?php esc_html_e('Box description here', 'insta-gallery'); ?></small></span>
      <span class="description hidden"><small><?php esc_html_e('(This is a premium feature)', 'insta-gallery'); ?></small></span>
    </p>  -->
  </div>

</div>
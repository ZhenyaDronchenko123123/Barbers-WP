<div id="tab_panel_feed" class="panel qligg_options_panel <# if (data.panel != 'tab_panel_carousel') { #>hidden<# } #>" > 

  <div class="options_group"> 
    <p class="form-field"> 
      <label><?php esc_html_e('Slides per view', 'insta-gallery'); ?></label> 
      <input name="carousel[slidespv]" type="number" min="1" max="10" value="{{data.carousel.slidespv}}" />
      <span class="description"><small><?php esc_html_e('Number of images per slide', 'insta-gallery'); ?></small> </span>
    </p>
  </div>
  <div class="options_group"> 
    <p class="form-field"> 
      <label><?php esc_html_e('Autoplay', 'insta-gallery'); ?></label> 
      <input class="media-modal-render-panels" name="carousel[autoplay]" type="checkbox" value="true" <# if (data.carousel.autoplay){ #>checked<# } #> />
             <span class="description"><small><?php esc_html_e('Autoplay carousel items', 'insta-gallery'); ?></small></span>
    </p>
  </div>
  <div class="options_group <# if (!data.carousel.autoplay){ #>disabled-field<# } #>"> 
    <p class="form-field"> 
      <label><?php esc_html_e('Autoplay Interval', 'insta-gallery'); ?></label> 
      <input name="carousel[autoplay_interval]" type="number" min="1000" max="300000" step="100" value="{{data.carousel.autoplay_interval}}" />
             <span class="description"><small><?php esc_html_e('Moves to next picture after specified time interval', 'insta-gallery'); ?></small></span>
   
  </div>
  <div class="options_group"> 
    <p class="form-field">
      <label><?php esc_html_e('Navigation', 'insta-gallery'); ?></label> 
      <input name="carousel[navarrows]" type="checkbox" value="true" <# if (data.carousel.navarrows){ #>checked<# } #> />
             <span class="description"><small><?php esc_html_e('Display navigation arrows', 'insta-gallery'); ?></small></span>
    </p>
  </div>
  <div class="options_group"> 
    <p class="form-field">
      <label><?php esc_html_e('Navigation color', 'insta-gallery'); ?></label> 
      <input class="color-picker" data-alpha="true" name="carousel[navarrows_color]" type="text" placeholder="#c32a67" value="{{data.carousel.navarrows_color}}" />
      <span class="description"><small><?php esc_html_e('Change navigation arrows color', 'insta-gallery'); ?></small></span>
    </p>
  </div>
  <div class="options_group"> 
    <p class="form-field"> 
      <label><?php esc_html_e('Pagination', 'insta-gallery'); ?></label>
      <input name="carousel[pagination]" type="checkbox" value="true" <# if (data.carousel.pagination){ #>checked<# } #> />
             <span class="description"><small><?php esc_html_e('Display pagination dots', 'insta-gallery'); ?></small></span>
    </p>
  </div>
  <div class="options_group"> 
    <p class="form-field"> 
      <label><?php esc_html_e('Pagination color', 'insta-gallery'); ?></label> 
      <input class="color-picker" data-alpha="true" name="carousel[pagination_color]" type="text" placeholder="#c32a67" value="{{data.carousel.pagination_color}}" /> 
      <span class="description"><small><?php esc_html_e('Change pagination dotts color', 'insta-gallery'); ?></small></span>
    </p>
  </div>

</div>
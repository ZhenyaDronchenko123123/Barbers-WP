<div class="wrap about-wrap full-width-layout">
  <div class="has-2-columns is-wider-left" style="max-width: 100%">
    <div class="column">
      <div class="welcome-header">
        <h1><?php esc_html_e('Premium', 'insta-gallery'); ?></h1>
        <div class="about-description">
          <?php printf(esc_html__('Unlock the power of our premium %s plugin which allows you to add unlimited Instagram accounts and offers you more layout options.', 'insta-gallery'), QLIGG_PLUGIN_NAME); ?>
        </div>
        <br/>
        <a style="background-color: #006cff;color: #ffffff;text-decoration: none;padding: 10px 30px;border-radius: 30px;margin: 10px 0 0 0;display: inline-block;" target="_blank" href="<?php echo esc_url(QLIGG_PURCHASE_URL); ?>"><?php esc_html_e('Purchase Now', 'insta-gallery'); ?></a>
        <a style="background-color: #ffffff;color: #626262;text-decoration: none;padding: 10px 30px;border-radius: 30px;margin: 10px 0 0 0;display: inline-block;" target="_blank" href="<?php echo QLIGG_DEMO_URL; ?>"><?php esc_html_e('View demo', 'insta-gallery'); ?></a>
      </div>
      <hr/>
      <div class="feature-section" style="margin: 15px 0;">
        <h3><?php esc_html_e('Multiple accounts', 'insta-gallery'); ?></h3>
        <p>
          <?php esc_html_e('Include unlimited user accounts and create feeds galleries for different users with their own layout and settings.', 'insta-gallery'); ?>
        </p>
      </div>
      <div class="feature-section" style="margin: 15px 0;">
        <h3><?php esc_html_e('Customize colors', 'insta-gallery'); ?></h3>
        <p>
          <?php esc_html_e('Customize the colors of the Instagram Feed with a custom background, padding, and a rounded border. It also includes the user or tag profile info in the header of the box.', 'insta-gallery'); ?>
        </p>
      </div>    
      <div class="feature-section" style="margin: 15px 0;">
        <h3><?php esc_html_e('Load more button', 'insta-gallery'); ?></h3>
        <p>
          <?php esc_html_e('Allow your users to load more images in the gallery providing an improved user experience.', 'insta-gallery'); ?>
        </p>
      </div>
    </div>
    <div class="column">
      <img src="<?php echo plugins_url('/assets/backend/img/instagram-feed.png', QLIGG_PLUGIN_FILE); ?>">
    </div>
  </div>
  <div class="has-2-columns" style="max-width: 100%">
    <div class="column">
      <img src="<?php echo plugins_url('/assets/backend/img/instagram-feed-popup-macbook.png', QLIGG_PLUGIN_FILE); ?>">
    </div>
    <div class="column">
      <br/>
      <div class="welcome-header">
        <h1><?php esc_html_e('More content', 'insta-gallery'); ?></h1>
        <div class="about-description">
          <?php esc_html_e('Include some extra content for the images and the images popup.', 'insta-gallery'); ?>
        </div>
      </div>
      <hr/>
      <div class="feature-section" style="margin: 15px 0;">
        <h3><?php esc_html_e('Popup content', 'insta-gallery'); ?></h3>
        <p>
          <?php esc_html_e('Our premium version allows you to include some extra content in the image popup, like the user profile, the image caption, and the number of comments and likes.', 'insta-gallery'); ?>
        </p>
      </div>
    </div>
  </div>
  <div class="has-2-columns is-wider-left" style="max-width: 100%">
    <div class="column">
      <div class="welcome-header">
        <h1><?php esc_html_e('Layouts', 'insta-gallery'); ?></h1>
        <div class="about-description">
          <?php esc_html_e('Unlock the power of the masonry and highlight layouts that allows you to display the Instagram Feeds in a grid that supports items of variable size.', 'insta-gallery'); ?>
        </div>
      </div>
      <hr/>
      <div class="feature-section" style="margin: 15px 0;">
        <h3><?php esc_html_e('Masonry layout', 'insta-gallery'); ?></h3>
        <p>
          <?php esc_html_e('The masonry layout is a grid that displays the images with a fixed with and variable height size.', 'insta-gallery'); ?>
        </p>
      </div>
      <div class="feature-section" style="margin: 15px 0;">
        <h3><?php esc_html_e('Highlight layout', 'insta-gallery'); ?></h3>
        <p>
          <?php esc_html_e('The highlight layout is a masonry grid that allows you to stand out some images with two or three columns width size.', 'insta-gallery'); ?>
        </p>
      </div>
    </div>
    <div class="column">
      <img src="<?php echo plugins_url('/assets/backend/img/instagram-feed-load-more.png', QLIGG_PLUGIN_FILE); ?>">
    </div>
  </div>
</div>
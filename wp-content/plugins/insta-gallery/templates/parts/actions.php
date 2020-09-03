<?php if (!empty($feed['button']['display'])) : ?>
  <div class="insta-gallery-actions">
    <a href="https://www.instagram.com/<?php echo esc_attr($profile_info['username']); ?>" target="blank" class="insta-gallery-button follow"><i class="qligg-icon-instagram-o"></i><?php echo esc_html($feed['button']['text']); ?></a>
  </div>
<?php endif; ?>
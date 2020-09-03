<div class="insta-gallery-image-wrap">
  <a class="insta-gallery-link" href="<?php echo esc_url($item['link']); ?>" target="_blank">
    <img alt="Instagram" class="insta-gallery-image" src="<?php echo esc_url($image); ?>"/>
    <?php if ($feed['mask']['display']): ?>
      <?php include($this->template_path('item/item-image-mask.php')); ?>
    <?php endif; ?>
  </a>
  <?php if ($item['type'] == 'video'): ?>
    <i class="insta-gallery-icon qligg-icon-video"></i>
  <?php elseif ($item['type'] == 'carousel'): ?>
    <i class="insta-gallery-icon qligg-icon-gallery"></i>
  <?php endif; ?>
  <a class="insta-gallery-icon qligg-icon-instagram" href="<?php echo esc_url($item['link']); ?>" target="_blank"></a>
</div>
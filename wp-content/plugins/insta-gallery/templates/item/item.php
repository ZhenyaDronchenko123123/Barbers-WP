<div id="insta-gallery-item-<?php echo esc_attr($item['id']); ?>" class="insta-gallery-item insta-gallery-cols-<?php echo esc_attr($feed['columns']); ?> <?php echo ($feed['layout'] == 'carousel') ? ' swiper-slide nofancybox' : '' ?>" data-item="<?php echo htmlentities(json_encode($item), ENT_QUOTES, 'UTF-8'); ?>" data-elementor-open-lightbox="no">
  <div class="insta-gallery-item-wrap">
    <?php include($this->template_path('item/item-image.php')); ?>
  </div>
</div>
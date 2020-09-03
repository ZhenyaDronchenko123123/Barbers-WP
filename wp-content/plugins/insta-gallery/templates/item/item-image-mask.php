<div class="insta-gallery-image-mask">
</div>
<div class="insta-gallery-image-mask-content">
  <?php if ($feed['mask']['likes'] && $item['likes'] !== false): ?>
    <span class="ig-likes-likes">
      <i class="qligg-icon-heart"></i>
      <?php echo esc_attr($item['likes']); ?>
    </span>
  <?php endif; ?>
  <?php if ($feed['mask']['comments'] && $item['comments'] !== false): ?>
    <span class="ig-likes-comments">
      <i class="qligg-icon-comment"></i>
      <?php echo esc_attr($item['comments']); ?>
    </span>
  <?php endif; ?>
</div> 
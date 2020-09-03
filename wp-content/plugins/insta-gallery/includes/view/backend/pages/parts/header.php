<div class="wrap about-wrap full-width-layout">

  <h1><?php echo esc_html(QLIGG_PLUGIN_NAME); ?></h1>

  <p class="about-text"><?php printf(esc_html__('Thanks for using %s! We will do our best to offer you the best and improved communication experience with your users.', 'insta-gallery'), QLIGG_PLUGIN_NAME); ?></p>

  <p class="about-text">
    <?php printf('<a href="%s" target="_blank">%s</a>', QLIGG_PURCHASE_URL, esc_html__('Purchase', 'insta-gallery')); ?></a> | 
    <?php printf('<a href="%s" target="_blank">%s</a>', QLIGG_DEMO_URL, esc_html__('Demo', 'insta-gallery')); ?></a> | 
    <?php printf('<a href="%s" target="_blank">%s</a>', QLIGG_DOCUMENTATION_URL, esc_html__('Documentation', 'insta-gallery')); ?></a>
  </p>

  <?php printf('<a href="%s" target="_blank"><div style="
               background: #006bff url(%s) no-repeat;
               background-position: top center;
               background-size: 130px 130px;
               color: #fff;
               font-size: 14px;
               text-align: center;
               font-weight: 600;
               margin: 5px 0 0;
               padding-top: 120px;
               height: 40px;
               display: inline-block;
               width: 140px;
               " class="wp-badge">%s</div></a>', 'https://quadlayers.com/?utm_source=qligg_admin', plugins_url('/assets/backend/img/quadlayers.jpg', QLIGG_PLUGIN_FILE), esc_html__('QuadLayers', 'insta-gallery')); ?>

</div>
<?php
if (isset($submenu[QLIGG_DOMAIN])) {
  if (is_array($submenu[QLIGG_DOMAIN])) {
    ?>
    <div class="wrap about-wrap full-width-layout">
      <h2 class="nav-tab-wrapper">
        <?php
        foreach ($submenu[QLIGG_DOMAIN] as $tab) {
          if (strpos($tab[2], '.php') !== false)
            continue;
          ?>
          <a href="<?php echo admin_url('admin.php?page=' . esc_attr($tab[2])); ?>" class="nav-tab<?php echo (isset($_GET['page']) && $_GET['page'] == $tab[2]) ? ' nav-tab-active' : ''; ?>"><?php echo $tab[0]; ?></a>
          <?php
        }
        ?>
      </h2>
    </div>
    <?php
  }
}

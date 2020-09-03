<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
  die(-1);
}

if (!is_multisite()) {
  $qligg = get_option('insta_gallery_settings');
  if (!empty($qligg['insta_flush'])) {
    delete_option('insta_gallery_settings');
    delete_option('insta_gallery_setting');
    delete_option('insta_gallery_items');
    delete_option('insta_gallery_feeds');
    delete_option('insta_gallery_token');
    delete_option('insta_gallery_iac');
  }
}

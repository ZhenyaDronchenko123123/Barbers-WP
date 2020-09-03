<?php

include_once(QLIGG_PLUGIN_DIR . 'includes/models/Token.php');
include_once(QLIGG_PLUGIN_DIR . 'includes/models/Setting.php');

function qligg_sanitize_instagram_feed($feed)
{

  global $qliggAPI;

  // Removing @, # and trimming input
  // ---------------------------------------------------------------------

  $feed = sanitize_text_field($feed);

  $feed = trim($feed);
  $feed = str_replace('@', '', $feed);
  $feed = str_replace('#', '', $feed);
  $feed = str_replace($qliggAPI->FEED->instagram_url, '', $feed);
  $feed = str_replace('/explore/tags/', '', $feed);
  $feed = str_replace('/', '', $feed);

  return $feed;
}

// Return user profile
// -----------------------------------------------------------------------------
function qligg_get_user_profile($account_id = null)
{

  global $qliggAPI;

  $defaults = array(
    'id' =>  $account_id,
    'username' =>  '',
    'website' =>  '',
    'biography' => '',
    'name' => '',
    'followers_count' =>  0,
    'media_count' =>  0,
    'profile_picture_url' =>  'http://2.gravatar.com/avatar/b642b4217b34b1e8d3bd915fc65c4452?s=320&d=mm&r=g',
    'link' => '',
  );

  if (empty($account_id)) {
    return $defaults;
  }

  $account_model = new QLIGG_Account();

  if (!$account = $account_model->get_account($account_id)) {
    return $defaults;
  }

  $tk = "insta_gallery_v2_user_profile_{$account_id}"; // transient key

  if (!QLIGG_DEVELOPER && false !== ($profile_info = get_transient($tk))) {
    return wp_parse_args($profile_info, $defaults);
  }

  if (!$account['access_token']) {
    return $defaults;
  }

  //detect token type old || new
  //validate token based on type

  if ($account['token_type'] === 'BASIC') {
    $_profile_info = $qliggAPI->BASIC->get_user_profile($account['access_token']);
    $_profile_info['name'] = esc_html__('This token expires soon!');
  }

  if ($account['token_type'] === 'PERSONAL') {
    $_profile_info = $qliggAPI->PERSONAL->getUserProfile($account['access_token']);
  }

  if ($account['token_type'] === 'BUSINESS') {
    $_profile_info = $qliggAPI->BUSINESS->getUserProfile($account_id, $account['access_token']);
  }

  $settings_model = new QLIGG_Setting();
  $settings = $settings_model->get_settings();

  $profile_info = wp_parse_args($_profile_info, $defaults);

  set_transient($tk, $profile_info, absint($settings['insta_reset']) * HOUR_IN_SECONDS);

  return $profile_info;
}

// Return tag info
// -----------------------------------------------------------------------------
function qligg_get_tag_profile($hashtag = null)
{

  global $qliggAPI;

  $defaults = array(
    'id' => '',
    'account_type' => 'TAG',
    'username' => $hashtag,
    'name' => $hashtag,
    'profile_picture_url' => 'http://2.gravatar.com/avatar/b642b4217b34b1e8d3bd915fc65c4452?s=150&d=mm&r=g',
    'link' => "{$qliggAPI->FEED->instagram_url}/explore/tags/{$hashtag}"
  );

  if (empty($hashtag)) {
    return $defaults;
  }

  $tk = "insta_gallery_v2_tag_profile_{$hashtag}"; // transient key

  if (!QLIGG_DEVELOPER && false !== ($profile_info = get_transient($tk))) {
    return wp_parse_args($profile_info, $defaults);
  }

  $_profile_info = array();

  // business token to get profile pic

  $profile_info = wp_parse_args($_profile_info, $defaults);
  $settings_model = new QLIGG_Setting();
  $settings = $settings_model->get_settings();

  set_transient($tk, $profile_info, absint($settings['insta_reset']) * HOUR_IN_SECONDS);

  return $profile_info;
}

// Get user feed
// -----------------------------------------------------------------------------
function qligg_get_user_media($feed, $last_id = null, $after = null)
{

  global $qliggAPI;

  $account_id = $feed['username'];
  $limit = $feed['limit'];

  if (!$account_id) {
    $qliggAPI->FEED->setMessage(esc_html__('Please update Instagram User in the feed settings.', 'insta-gallery'));
    return;
  }

  $account_model = new QLIGG_Account();

  $account = $account_model->get_account($account_id);

  if (!isset($account['access_token'])) {
    $qliggAPI->FEED->setMessage(esc_html__('Please update Instagram Access Token in the account settings.', 'insta-gallery'));
    return;
  }

  // compatibility with 2.7.1
  // ---------------------------------------------------------------------------
  if ($account['token_type'] === 'BASIC' && $qliggAPI->BASIC->validate_token($account['access_token'])) {
    return qligg_get_user_items_old($account_id, $limit, $last_id, $after);
  }

  $md5 = hash('md5', $after);

  $tk = "insta_gallery_v2_user_media_{$account_id}_{$md5}";

  // Get any existing copy of our transient data
  if (QLIGG_DEVELOPER || false === ($response = get_transient($tk))) {

    if ($account['token_type'] === 'PERSONAL') {
      $response = $qliggAPI->PERSONAL->getUserMedia($account['access_token'], $after);
    }

    if ($account['token_type'] === 'BUSINESS') {
      $response = $qliggAPI->BUSINESS->getUserMedia($account_id, $account['access_token'], $after);
    }

    if (!isset($response['data'])) {
      return;
    }

    if (!count($response['data'])) {
      return;
    }

    $settings_model = new QLIGG_Setting();
    $settings = $settings_model->get_settings();

    set_transient($tk, $response, absint($settings['insta_reset']) * HOUR_IN_SECONDS);
  }

  $feeds = $qliggAPI->PERSONAL->setupMediaItems($response['data'], $last_id);

  if (!$last_id) {
    return $feeds;
  }

  if (count($feeds) >= $limit) {
    return $feeds;
  }

  if (!isset($response['paging']['next'])) {
    return $feeds;
  }

  if (!isset($response['paging']['cursors']['after'])) {
    return $feeds;
  }

  $after = $response['paging']['cursors']['after'];

  if ($new_feeds = qligg_get_user_media($feed, $last_id, $after)) {
    $feeds = array_merge($feeds, (array) $new_feeds);
  }

  return $feeds;
}

// Get tag items
// ----------------------------------------------------------------------------
//function qligg_get_user_media($account_id = null, $limit = 12, $last_id = null, $after = null) {

function qligg_get_tag_items($feed, $last_id = null, $after = null)
{

  global $qliggAPI;

  $account_id = $feed['username'];
  $tag = $feed['tag'];
  $limit = $feed['limit'];
  $order_by = $feed['order_by'];

  $md5 = hash('md5', $after);

  $tk = "insta_gallery_v2_tag_media_{$tag}_{$order_by}_{$md5}";

  // Get any existing copy of our transient data
  if (QLIGG_DEVELOPER || false === ($response = get_transient($tk))) {

    $response = $qliggAPI->BUSINESS->getTagMedia($account_id, $tag, $order_by, $after);

    if (!isset($response['data'])) {
      return;
    }

    if (!count($response['data'])) {
      return;
    }

    $settings_model = new QLIGG_Setting();
    $settings = $settings_model->get_settings();

    set_transient($tk, $response, absint($settings['insta_reset']) * HOUR_IN_SECONDS);
  }

  $feeds = $qliggAPI->BUSINESS->setupMediaItems($response['data'], $last_id);

  if (!$last_id) {
    return $feeds;
  }

  if (count($feeds) >= $limit) {
    return $feeds;
  }

  if (!isset($response['paging']['next'])) {
    return $feeds;
  }

  if (!isset($response['paging']['cursors']['after'])) {
    return $feeds;
  }

  $after = $response['paging']['cursors']['after'];

  if ($new_feeds = qligg_get_tag_items($feed, $last_id, $after)) {
    $feeds = array_merge($feeds, (array) $new_feeds);
  }

  return $feeds;
}

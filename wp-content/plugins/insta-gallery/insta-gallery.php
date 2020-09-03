<?php

/**
 * Plugin Name:       Social Feed Gallery
 * Plugin URI:        https://quadlayers.com/portfolio/instagram-feed-gallery/
 * Description:       Display beautiful and responsive galleries on your website from your Instagram feed account.
 * Version:           3.0.0
 * Author:            QuadLayers
 * Author URI:        https://quadlayers.com
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       insta-gallery
 * Domain Path:       /languages
 */
if (!defined('ABSPATH'))
    exit;

if (!defined('QLIGG_PLUGIN_NAME')) {
    define('QLIGG_PLUGIN_NAME', 'Social Feed Gallery');
}
if (!defined('QLIGG_PLUGIN_VERSION')) {
    define('QLIGG_PLUGIN_VERSION', '3.0.0');
}
if (!defined('QLIGG_PLUGIN_FILE')) {
    define('QLIGG_PLUGIN_FILE', __FILE__);
}
if (!defined('QLIGG_PLUGIN_DIR')) {
    define('QLIGG_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR);
}
if (!defined('QLIGG_DOMAIN')) {
    define('QLIGG_DOMAIN', 'qligg');
}
if (!defined('QLIGG_PREFIX')) {
    define('QLIGG_PREFIX', QLIGG_DOMAIN);
}
if (!defined('QLIGG_WORDPRESS_URL')) {
    define('QLIGG_WORDPRESS_URL', 'https://wordpress.org/plugins/insta-gallery/');
}
if (!defined('QLIGG_REVIEW_URL')) {
    define('QLIGG_REVIEW_URL', 'https://wordpress.org/support/plugin/insta-gallery/reviews/?filter=5#new-post');
}
if (!defined('QLIGG_DEMO_URL')) {
    define('QLIGG_DEMO_URL', 'https://quadlayers.com/instagram-feed/?utm_source=qligg_admin');
}
if (!defined('QLIGG_PURCHASE_URL')) {
    define('QLIGG_PURCHASE_URL', 'https://quadlayers.com/portfolio/instagram-feed-gallery/?utm_source=qligg_admin');
}
if (!defined('QLIGG_SUPPORT_URL')) {
    define('QLIGG_SUPPORT_URL', 'https://quadlayers.com/account/support/?utm_source=qligg_admin');
}
if (!defined('QLIGG_DOCUMENTATION_URL')) {
    define('QLIGG_DOCUMENTATION_URL', 'https://quadlayers.com/documentation/instagram-feed-gallery/?utm_source=qligg_admin');
}
if (!defined('QLIGG_GROUP_URL')) {
    define('QLIGG_GROUP_URL', 'https://www.facebook.com/groups/quadlayers');
}
if (!defined('QLIGG_DEVELOPER')) {
    define('QLIGG_DEVELOPER', false);
}

if (!class_exists('QLIGG')) {
    include_once( QLIGG_PLUGIN_DIR . 'includes/qligg.php' );
}
register_activation_hook(QLIGG_PLUGIN_FILE, array('QLIGG', 'do_activation'));

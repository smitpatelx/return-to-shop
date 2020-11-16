<?php
/**
 * Plugin Name:         Return to shop
 * Description:         Modify return to shop button url for WooCoomerce. (This button show up when cart is empty)
 * Plugin URI:          https://wordpress.org/plugins/return-to-shop
 * Text Domain:         return-to-shop
 * Author:              Smit Patel
 * Author URI:          https://smitpatelx.com
 * Version:             1.0.1
 * Requires at least:   5.2
 * Requires PHP:        7.1
 * License:             MIT
 * License URI:         https://github.com/smitpatelx/return-to-shop/blob/master/LICENSE
 */

if(!defined('ABSPATH')){
    exit;//Exit if accessed directly
}

require_once(__DIR__.'/includes/rts_modify_url.php');
require_once(__DIR__.'/includes/rts_page_registration.php');
require_once(__DIR__.'/includes/activation.php');
require_once(__DIR__.'/includes/deactivation.php');

register_activation_hook( __FILE__, 'rts_activation');
register_deactivation_hook( __FILE__, 'rts_deactivation');

// Register submenu page
add_action('admin_menu', 'register_rts_submenu_page', 99);

// Change button url
add_filter( 'woocommerce_return_to_shop_redirect', 'rts_modify_url' );

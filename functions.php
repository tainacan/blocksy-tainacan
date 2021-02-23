<?php
/*
Plugin Name: Blocksy Tainacan
Plugin URI: https://tainacan.org/
Description: Tainacan support for Blocksy theme
Author: tainacan
Version: 0.1.0
Text Domain: blocksy-tainacan
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if (! defined('WP_DEBUG') ) {
	die( 'Direct access forbidden.' );
}

/** Theme/plugin version */
const BLOCKSY_TAINACAN_VERSION = '0.1.0';
const BLOCKSY_TAINACAN_IS_PLUGIN = false;

$plugin_root_url = BLOCKSY_TAINACAN_IS_PLUGIN ? plugin_dir_url(__FILE__) : get_stylesheet_directory_uri();
define('BLOCKSY_TAINACAN_PLUGIN_URL_PATH', $plugin_root_url);

$plugin_root_dir = BLOCKSY_TAINACAN_IS_PLUGIN ? plugin_dir_path(__FILE__) : get_stylesheet_directory() ;
define('BLOCKSY_TAINACAN_PLUGIN_DIR_PATH', $plugin_root_dir);

/* Basic styles and script enqueues */
require BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/enqueues.php';

/* Template redirection necessary only if in a plugin */
if ( BLOCKSY_TAINACAN_IS_PLUGIN ) {
	require BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/plugin.php';
}

/* Requires several settings, functions and helpers */
require BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/integration.php';
require BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/customizer.php';
require BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/navigation.php';
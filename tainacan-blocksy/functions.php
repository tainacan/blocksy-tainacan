<?php
/*
Plugin Name: Tainacan Support for Blocksy
Plugin URI: https://tainacan.org/
Description: Tainacan plugin support for Blocksy theme
Author: tainacan
Version: 0.1.9
Text Domain: tainacan-blocksy
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if (! defined('WP_DEBUG') ) {
	die( 'Direct access forbidden.' );
}

/** Theme/plugin version */
const TAINACAN_BLOCKSY_VERSION = '0.1.9';
const TAINACAN_BLOCKSY_IS_CHILD_THEME = false;

/* Tools to define our next constants */
require 'utils.php';

$plugin_root_url = tainacan_blocksy_get_plugin_dir_url();
define('TAINACAN_BLOCKSY_PLUGIN_URL_PATH', $plugin_root_url);

$plugin_root_dir = tainacan_blocksy_get_plugin_dir_path();
define('TAINACAN_BLOCKSY_PLUGIN_DIR_PATH', $plugin_root_dir);

$tainacan_blocksy_is_blocksy_activated = tainacan_blocksy_is_blocksy_activated();
define('TAINACAN_BLOCKSY_IS_BLOCKSY_ACTIVATED', $tainacan_blocksy_is_blocksy_activated);

$tainacan_blocksy_theme_version = tainacan_blocksy_get_theme_version();
define('TAINACAN_BLOCKSY_BLOCKSY_THEME_VERSION', $tainacan_blocksy_theme_version);

/* This should only be used if we're in the child theme or if is a plugin and blocksy theme is installed */
if ( TAINACAN_BLOCKSY_IS_CHILD_THEME || ( TAINACAN_BLOCKSY_IS_BLOCKSY_ACTIVATED && !TAINACAN_BLOCKSY_IS_CHILD_THEME ) ) {

	/* Basic styles and script enqueues */
	require TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/enqueues.php';

	/* Template redirection necessary only if in a plugin */
	if ( !TAINACAN_BLOCKSY_IS_CHILD_THEME ) {
		require TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/plugin.php';
	}

	/* Requires several settings, functions and helpers */
	require TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/integration.php';
	require TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/customizer.php';
	require TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/navigation.php';
}
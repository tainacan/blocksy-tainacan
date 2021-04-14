<?php
/*
Plugin Name: Blocksy Tainacan
Plugin URI: https://tainacan.org/
Description: Tainacan support for Blocksy theme
Author: tainacan
Version: 0.1.1
Text Domain: blocksy-tainacan
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if (! defined('WP_DEBUG') ) {
	die( 'Direct access forbidden.' );
}

/** Theme/plugin version */
const BLOCKSY_TAINACAN_VERSION = '0.1.1';
const BLOCKSY_TAINACAN_IS_CHILD_THEME = false;

/* Tools to define our next constants */
require 'utils.php';

$plugin_root_url = blocksy_tainacan_get_plugin_dir_url();
define('BLOCKSY_TAINACAN_PLUGIN_URL_PATH', $plugin_root_url);

$plugin_root_dir = blocksy_tainacan_get_plugin_dir_path();
define('BLOCKSY_TAINACAN_PLUGIN_DIR_PATH', $plugin_root_dir);

$blocksy_tainacan_is_blocksy_activated = blocksy_tainacan_is_blocksy_activated();
define('BLOCKSY_TAINACAN_IS_BLOCKSY_ACTIVATED', $blocksy_tainacan_is_blocksy_activated);

/* This should only be used if we're in the child theme or if is a plugin and blocksy theme is installed */
if ( BLOCKSY_TAINACAN_IS_CHILD_THEME || ( BLOCKSY_TAINACAN_IS_BLOCKSY_ACTIVATED && !BLOCKSY_TAINACAN_IS_CHILD_THEME ) ) {

	/* Basic styles and script enqueues */
	require BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/enqueues.php';

	/* Template redirection necessary only if in a plugin */
	if ( !BLOCKSY_TAINACAN_IS_CHILD_THEME ) {
		require BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/plugin.php';
	}

	/* Requires several settings, functions and helpers */
	require BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/integration.php';
	require BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/customizer.php';
	require BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/navigation.php';
}
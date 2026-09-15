<?php

// phpcs:disable WordPress.WP.I18n.TextDomainMismatch -- All translatable strings in this file reuse translations from the Blocksy theme.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- Blocksy option include contract ($prefix, $options, $enabled).

$options = [
	blocksy_get_options(
		(
			$prefix !== 'tainacan-repository-items' ?
				TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/archive-elements/page-header.php' :
				TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/archive-elements/page-header-simpler.php'
		), [
		'prefix' => $prefix . '_archive'
	], false),
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/archive-elements/search-control.php', [
		'prefix' => $prefix . '_archive'
	], false),

	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/archive-elements/filters-panel.php', [
		'prefix' => $prefix . '_archive',
		'enabled' => 'yes'
	], false),

	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/archive-elements/pagination.php', [
		'prefix' => $prefix . '_archive',
		'enabled' => 'yes'
	], false),

	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/archive-elements/color-palettes.php', [
		'prefix' => $prefix . '_archive'
	], false),
	$prefix . '_archive_container-width' => [
		'label' => __( 'Container Width', 'blocksy' ),
		'type' => 'ct-radio',
		'value' => 'fluid',
		'view' => 'text',
		'design' => 'block',
		'sync' => '',
		'choices' => [
			'fixed' => __( 'Default', 'blocksy' ),
			'fluid' => __( 'Full Width', 'blocksy' ),
		],
	],
];

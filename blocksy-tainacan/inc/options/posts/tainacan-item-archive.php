<?php

$options = [
	[
		blocksy_rand_md5() => [
			'type' => 'ct-title',
			'label' => __( 'Page Elements', 'blocksy' ),
		],
	],

	blocksy_get_options(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/options/archive-elements/page-header.php', [
		'prefix' => $prefix . '_archive'
	], false),

	blocksy_get_options(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/options/archive-elements/search-control.php', [
		'prefix' => $prefix . '_archive'
	], false),

	blocksy_get_options(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/options/archive-elements/filters-panel.php', [
		'prefix' => $prefix . '_archive',
		'enabled' => 'yes'
	], false),

	blocksy_get_options(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/options/archive-elements/pagination.php', [
		'prefix' => $prefix . '_archive',
		'enabled' => 'yes'
	], false),

	blocksy_get_options(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/options/archive-elements/color-palettes.php', [
		'prefix' => $prefix . '_archive'
	], false),
];

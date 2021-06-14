<?php

$options = [
	[
		blocksy_rand_md5() => [
			'type' => 'ct-title',
			'label' => __( 'Page Elements', 'blocksy' ),
		],
	],

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
];

<?php

$options = [
	$prefix . '_notification' => [
			'type' => 'ct-notification',
			'attr' => [ 'data-type' => 'background:white' ],
			'text' => '<strong>' . __('This customizations are usually overridden by the collection item single page options.', 'tainacan-blocksy') . '</strong> ' . __('If you wish this options to have impact on a collection, go to it\'s settings page in the Tainacan Admin and change the value for the "Source of the appearence options" to allow usage of general options inherited from here.', 'tainacan-blocksy')
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

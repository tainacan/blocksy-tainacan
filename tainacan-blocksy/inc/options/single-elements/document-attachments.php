<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- Blocksy option include contract ($prefix, $options, $enabled).

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$has_media_item_actions = function_exists( 'tainacan_get_the_media_item_expand_control' );

$general_main_view_options = [
	[
		blocksy_rand_md5() => [
			'type' => 'ct-title',
			'label' => __( 'Main slider', 'tainacan' ) // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
		]
	],
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-files-caption-main.php', [
		'prefix' => $prefix,
		'enabled' => 'yes'
	], false),
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-files-name-main.php', [
		'prefix' => $prefix,
		'enabled' => 'yes'
	], false),
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-files-description-main.php', [
		'prefix' => $prefix,
		'enabled' => 'yes'
	], false),
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-download-button.php', [
		'prefix' => $prefix,
		'enabled' => 'no'
	], false),
];

if ( $has_media_item_actions ) {
	$general_main_view_options[] = blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-expand-button.php', [
		'prefix' => $prefix,
		'enabled' => 'no'
	], false);
}

$general_tab_options = array_merge(
	[
		blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-attachments-structure.php', [
			'prefix' => $prefix,
			'enabled' => 'no'
		], false),
		blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-attachments-columns.php', [
			'prefix' => $prefix
		], false),
		blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-attachments-affix.php', [
			'prefix' => $prefix
		], false),
	],
	$general_main_view_options,
	[
		[
			blocksy_rand_md5() => [
				'type' => 'ct-title',
				'label' => __( 'Thumbnails', 'tainacan' ) // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
			]
		],
		blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-files-name.php', [
			'prefix' => $prefix,
			'enabled' => 'no'
		], false),
		[
			blocksy_rand_md5() => [
				'type' => 'ct-title',
				'label' => __( 'Lightbox', 'tainacan-blocksy' )
			]
		],
		blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/disable-gallery-lightbox.php', [
			'prefix' => $prefix,
			'enabled' => 'no'
		], false),
		blocksy_rand_md5() => [
			'type' => 'ct-condition',
			'condition' => [
				$prefix . 'disable_gallery_lightbox'  => 'no'
			],
			'options' => [
				blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-files-caption-lightbox.php', [
					'prefix' => $prefix,
					'enabled' => 'no'
				], false),
				blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-files-name-lightbox.php', [
					'prefix' => $prefix,
					'enabled' => 'no'
				], false),
				blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-files-description-lightbox.php', [
					'prefix' => $prefix,
					'enabled' => 'no'
				], false)
			]
		]
	]
);

$design_main_options = [
	[
		blocksy_rand_md5() => [
			'type' => 'ct-title',
			'label' => __( 'Main slider', 'tainacan' ) // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
		]
	],
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-height.php', [
		'prefix' => $prefix
	], false),
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-width.php', [
		'prefix' => $prefix
	], false),
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-typography.php', [
		'prefix' => $prefix
	], false),
];

if ( $has_media_item_actions ) {
	$design_main_options[] = blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/gallery-metadata-alignment.php', [
		'prefix' => $prefix
	], false);
	$design_main_options[] = blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/gallery-media-actions.php', [
		'prefix' => $prefix
	], false);
}

$design_tab_options = array_merge(
	$design_main_options,
	[
		[
			blocksy_rand_md5() => [
				'type' => 'ct-title',
				'label' => __( 'Thumbnails', 'tainacan' ) // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
			]
		],
		blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/attachments-carousel-width.php', [
			'prefix' => $prefix
		], false),
		blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/attachments-size.php', [
			'prefix' => $prefix
		], false),
		blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/attachments-typography.php', [
			'prefix' => $prefix
		], false),
		[
			blocksy_rand_md5() => [
				'type' => 'ct-title',
				'label' => __( 'Lightbox', 'tainacan-blocksy' )
			]
		],
		blocksy_rand_md5() => [
			'type' => 'ct-condition',
			'condition' => [
				$prefix . 'disable_gallery_lightbox'  => 'no'
			],
			'options' => [
				blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/gallery-color-scheme.php', [
					'prefix' => $prefix
				], false)
			]
		],
		blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-attachments-colors.php', [
			'prefix' => $prefix
		], false),
	]
);

$options = [
	$prefix . 'document-attachments' => [
		'label' => __( 'Document and attachments', 'tainacan-blocksy' ),
		'type' => 'ct-panel',
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [
			blocksy_rand_md5() => [
				'title' => __( 'General', 'blocksy' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Blocksy theme translation.
				'type' => 'tab',
				'options' => $general_tab_options
			],
			blocksy_rand_md5() => [
				'title' => __( 'Design', 'blocksy' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Blocksy theme translation.
				'type' => 'tab',
				'options' => $design_tab_options
			]
		]
	]
];

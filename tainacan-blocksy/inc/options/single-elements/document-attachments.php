<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$options = [
	$prefix . 'document-attachments' => [
		'label' => __( 'Document and attachments', 'tainacan-blocksy' ),
		'type' => 'ct-panel',
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [
            blocksy_rand_md5() => [
                'title' => __( 'General', 'blocksy' ),
                'type' => 'tab',
                'options' => [
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-attachments-structure.php', [
                        'prefix' => $prefix,
                        'enabled' => 'no'
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-attachments-columns.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-download-button.php', [
                        'prefix' => $prefix,
                        'enabled' => 'no'
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/disable-gallery-lightbox.php', [
                        'prefix' => $prefix,
                        'enabled' => 'no'
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-files-name.php', [
                        'prefix' => $prefix,
                        'enabled' => 'no'
                    ], false),
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
            ],

            blocksy_rand_md5() => [
                'title' => __( 'Design', 'blocksy' ),
                'type' => 'tab',
                'options' => [
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-attachments-colors.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-height.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-width.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/attachments-carousel-width.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-typography.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/attachments-size.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/attachments-typography.php', [
                        'prefix' => $prefix
                    ], false),
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
                    ]
                ]
            ]
        ]
    ]
];
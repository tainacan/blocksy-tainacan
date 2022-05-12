<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$options = [
	$prefix . 'metadata-list' => [
		'label' => __( 'Item metadata list', 'tainacan-blocksy' ),
		'type' => 'ct-panel',
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [

            blocksy_rand_md5() => [
                'title' => __( 'General', 'blocksy' ),
                'type' => 'tab',
                'options' => [
                    [
                        blocksy_rand_md5() => [
                            'type' => 'ct-title',
                            'label' => __( 'Metadata Sections', 'tainacan-blocksy' ),
                        ],
                    ],
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/metadata-sections.php', [
                        'prefix' => $prefix
                    ], false),
                    [
                        blocksy_rand_md5() => [
                            'type' => 'ct-title',
                            'label' => __( 'Metadata List', 'tainacan-blocksy' ),
                        ],
                    ],
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/metadata-list-structure.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/metadata-columns.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/show-title-metadata.php', [
                        'prefix' => $prefix,
                        'enabled' => 'yes'
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/show-thumbnail.php', [
                        'prefix' => $prefix,
                        'enabled' => 'no'
                    ], false),
                ],
            ],

            blocksy_rand_md5() => [
                'title' => __( 'Design', 'blocksy' ),
                'type' => 'tab',
                'options' => [
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/metadata-labels.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/metadata-values.php', [
                        'prefix' => $prefix
                    ], false)
                ],
            ]
        ]
    ]
];
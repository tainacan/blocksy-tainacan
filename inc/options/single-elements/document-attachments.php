<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$options = [
	$prefix . 'document-attachments' => [
		'label' => __( 'Document and attachments', 'blocksy-tainacan' ),
		'type' => 'ct-panel',
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [

            blocksy_rand_md5() => [
                'title' => __( 'General', 'blocksy' ),
                'type' => 'tab',
                'options' => [
                    blocksy_get_options(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-attachments-structure.php', [
                        'prefix' => $prefix,
                        'enabled' => 'no'
                    ], false),
                    blocksy_get_options(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-attachments-columns.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-download-button.php', [
                        'prefix' => $prefix,
                        'enabled' => 'no'
                    ], false),
                    blocksy_get_options(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/options/single-elements/hide-files-name.php', [
                        'prefix' => $prefix,
                        'enabled' => 'no'
                    ], false)
                ]
            ],

            blocksy_rand_md5() => [
                'title' => __( 'Design', 'blocksy' ),
                'type' => 'tab',
                'options' => [
                    blocksy_get_options(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/options/single-elements/attachments-typography.php', [
                        'prefix' => $prefix
                    ], false),
                    blocksy_get_options(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/inc/options/single-elements/attachments-size.php', [
                        'prefix' => $prefix
                    ], false)
                ],
            ]
        ]
    ]
];
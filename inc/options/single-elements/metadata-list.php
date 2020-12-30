<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$options = [
	$prefix . 'metadata-list' => [
		'label' => __( 'Metadata list', 'blocksy-tainacan' ),
		'type' => 'ct-panel',
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [
            blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/show-title-metadata.php', [
                'prefix' => $prefix,
                'enabled' => 'yes'
            ], false),
            blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/show-thumbnail.php', [
                'prefix' => $prefix,
                'enabled' => 'no'
            ], false),
            blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/metadata-columns.php', [
                'prefix' => $prefix
            ], false)
        ]
    ]
];
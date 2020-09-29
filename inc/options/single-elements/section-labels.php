<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

if (! isset($enabled)) {
	$enabled = 'yes';
}

$options = [
	$prefix . 'display_section_labels' => [
		'label' => __( 'Display section labels', 'blocksy' ),
		'type' => 'ct-panel',
		'switch' => true,
		'value' => $enabled,
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [
			// $prefix . 'test_title_metadata' => [
            //     'label' => __( 'Test title in the metadata list', 'blocksy-tainacan' ),
            //     'type' => 'ct-switch',
            //     'value' => 'yes',
            //     'setting' => [ 'transport' => 'postMessage' ],
            //     'desc' => __( 'Toggle to hide or not the core title from the metadada list, as it already appears on the page title.', 'blocksy' ),
            //     'sync' => blocksy_sync_single_post_container([
            //         'prefix' => $prefix
            //     ])
            // ]
		],
	],
];

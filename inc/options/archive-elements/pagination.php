<?php

if (! isset($prefix)) {
	$prefix = '';
	$initial_prefix = '';
} else {
	$initial_prefix = $prefix;
	$prefix = $prefix . '_';
}

if (! isset($enabled)) {
	$enabled = 'yes';
}

$options = [
	$prefix . 'has_pagination' => [
		'label' => __( 'Pagination', 'blocksy' ),
		'type' => 'ct-panel',
		'switch' => true,
		'value' => $enabled,
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
			'loader_selector' => 'section'
		]),
		'inner-options' => [
            $prefix . 'show_items_per_page_button' => [
                'label' => __( 'Show the "Items per page" button', 'blocksy-tainacan' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                'setting' => [ 'transport' => 'postMessage' ],
                'desc' => __( 'Display the button for choosing how many items per page shoulb be loaded.', 'blocksy-tainacan' ),
                'sync' => blocksy_sync_whole_page([
                    'prefix' => $prefix
                ])
            ],
            $prefix . 'show_go_to_page_button' => [
                'label' => __( 'Show the "Go to page" button', 'blocksy-tainacan' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                'setting' => [ 'transport' => 'postMessage' ],
                'desc' => __( 'Display the button for jumping to an specific page.', 'blocksy-tainacan' ),
                'sync' => blocksy_sync_whole_page([
                    'prefix' => $prefix
                ])
            ]
		],
	],
];

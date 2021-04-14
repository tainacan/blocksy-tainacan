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
		'sync' => '',
		'inner-options' => [
            $prefix . 'show_items_per_page_button' => [
                'label' => __( 'Show the "Items per page" button', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                                'desc' => __( 'Display the button for choosing how many items per page shoulb be loaded.', 'tainacan-blocksy' ),
                'sync' => ''
            ],
            $prefix . 'show_go_to_page_button' => [
                'label' => __( 'Show the "Go to page" button', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                                'desc' => __( 'Display the button for jumping to an specific page.', 'tainacan-blocksy' ),
                'sync' => ''
            ]
		],
	],
];

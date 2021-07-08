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
	$prefix . 'display_items_related_to_this' => [
		'label' => __( 'Display "Items related to this"', 'tainacan-blocksy' ),
		'type' => 'ct-panel',
		'switch' => true,
		'value' => $enabled,
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [
            $prefix . 'items_related_to_this_max_items_per_screen' => [
				'label' => __( 'Max amount of items per slide', 'blocksy' ),
				'type' => 'ct-number',
				'design' => 'inline',
				'value' => 6,
				'min' => 1,
				'max' => 10,
				'sync' => ''
			],
        ]
    ]
];
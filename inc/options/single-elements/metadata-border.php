<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [
    $prefix . 'metadata_label_border' => [
        'label' => __( 'Metadata label border', 'blocksy' ),
        'type' => 'ct-border',
        'design' => 'block',
        'responsive' => true,
        'setting' => [ 'transport' => 'postMessage' ],
        'value' => [
            'width' => 0,
            'style' => 'solid',
            'color' => [
                'color' => 'rgba(125, 125, 125, 0.5)',
            ],
        ],
        'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
    ],
    $prefix . 'metadata_value_border' => [
        'label' => __( 'Metadata value border', 'blocksy' ),
        'type' => 'ct-border',
        'design' => 'block',
        'responsive' => true,
        'setting' => [ 'transport' => 'postMessage' ],
        'value' => [
            'width' => 0,
            'style' => 'solid',
            'color' => [
                'color' => 'rgba(125, 125, 125, 0.5)',
            ],
        ],
        'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
    ],
];
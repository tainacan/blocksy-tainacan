<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [
    $prefix . 'metadata_border' => [
        'label' => __( 'Border', 'blocksy' ),
        'type' => 'ct-border',
        'design' => 'block',
        'responsive' => true,
        'setting' => [ 'transport' => 'postMessage' ],
        'value' => [
            'width' => 1,
            'style' => 'solid',
            'color' => [
                'color' => '#e0e5eb',
            ],
        ],
        'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
    ],
];
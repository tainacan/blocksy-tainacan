<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [	
	$prefix . 'metadata_columns' => [
		'label' => __( 'Metadata columns width', 'blocksy-tainacan' ),
		'type' => 'ct-slider',
		'value' => [
			'mobile' => '200px',
			'tablet' => '300px',
			'desktop' => '400px',
		],
		'units' => blocksy_units_config([
			[
				'unit' => 'px',
				'min' => 200,
				'max' => 1200,
			],
			[
				'unit' => 'vw',
				'min' => 20,
				'max' => 100,
			],
		]),
		'responsive' => true,
		'divider' => 'top',
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
];
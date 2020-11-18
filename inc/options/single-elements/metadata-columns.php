<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$options = [	
	$prefix . 'metadata_columns' => [
		'label' => __( 'Metadata columns width', 'blocksy' ),
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
		'sync' => 'live',
	],
];
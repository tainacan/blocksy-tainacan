<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [	
	$prefix . 'attachments_size' => [
		'label' => __( 'Attachments size on carousel', 'blocksy-tainacan' ),
		'type' => 'ct-slider',
		'value' => [
			'mobile' => '120px',
			'tablet' => '130px',
			'desktop' => '140px',
		],
		'units' => blocksy_units_config([
			[
				'unit' => 'px',
				'min' => 80,
				'max' => 200,
			]
		]),
		'responsive' => true,
		'divider' => 'bottom',
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
];
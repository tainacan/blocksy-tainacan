<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [	
	$prefix . 'document_height' => [
		'label' => __( 'Document max height main slider', 'tainacan-blocksy' ),
		'type' => 'ct-slider',
		'value' => 60,
		'min' => 10,
		'max' => 140,
		'unit' => 'vh',
		'defaultUnit' => 'vh',
		'responsive' => true,
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
];
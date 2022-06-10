<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [	
	$prefix . 'document_width' => [
		'label' => __( 'Maximum width of the main document slider', 'tainacan-blocksy' ),
		'type' => 'ct-slider',
		'value' => 100,
		'min' => 20,
		'max' => 100,
		'unit' => '%',
		'defaultUnit' => '%',
		'responsive' => true,
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	]
];
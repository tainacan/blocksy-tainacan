<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

if (! isset($enabled)) {
	$enabled = 'no';
}

$options = [	
	$prefix . 'gallery_mode' => [
		'label' => __( 'Gallery Mode', 'blocksy-tainacan' ),
		'type' => 'ct-switch',
		'value' => $enabled,
		'setting' => [ 'transport' => 'postMessage' ],
		'desc' => __( 'Merges Document and Attachments section in a single carousel.', 'blocksy-tainacan' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	]
];
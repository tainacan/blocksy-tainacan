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
	$prefix . 'show_thumbnail' => [
		'label' => __( 'Item thumbnail in the metadata list', 'blocksy-tainacan' ),
		'type' => 'ct-switch',
		'value' => $enabled,
		'setting' => [ 'transport' => 'postMessage' ],
		'desc' => __( 'Toggle to show or not the item thumbnail on the metadada list.', 'blocksy-tainacan' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	]
];
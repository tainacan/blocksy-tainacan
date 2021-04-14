<?php

if (! isset($prefix)) {
	$prefix = '';
}

if (! isset($enabled)) {
	$enabled = 'yes';
}

$options = [	
	$prefix . 'show_title_metadata' => [
		'label' => __( 'Core title in the metadata list', 'tainacan-blocksy' ),
		'type' => 'ct-switch',
		'value' => $enabled,
		'setting' => [ 'transport' => 'postMessage' ],
		'desc' => __( 'Toggle to hide or not the core title from the metadada list, as it already appears on the page title.', 'tainacan-blocksy' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	]
];
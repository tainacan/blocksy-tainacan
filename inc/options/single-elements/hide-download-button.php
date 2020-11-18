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
	$prefix . 'hide_download_button' => [
		'label' => __( ' Document download button', 'blocksy-tainacan' ),
		'type' => 'ct-switch',
		'value' => $enabled,
		'setting' => [ 'transport' => 'postMessage' ],
		'desc' => __( 'Toggle to never display a "Download" button when hovering the document.', 'blocksy-tainacan' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	]
];
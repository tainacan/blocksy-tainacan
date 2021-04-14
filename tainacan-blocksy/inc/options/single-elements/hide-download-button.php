<?php

if (! isset($prefix)) {
	$prefix = '';
}
if (! isset($enabled)) {
	$enabled = 'no';
}

$options = [	
	$prefix . 'hide_download_button' => [
		'label' => __( 'Hide document download button', 'tainacan-blocksy' ),
		'type' => 'ct-switch',
		'value' => $enabled,
		'setting' => [ 'transport' => 'postMessage' ],
		'desc' => __( 'Toggle to never display a "Download" button when hovering the document.', 'tainacan-blocksy' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix,
		]),
	]
];
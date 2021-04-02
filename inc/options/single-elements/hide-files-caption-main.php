<?php

if (! isset($prefix)) {
	$prefix = '';
}
if (! isset($enabled)) {
	$enabled = 'yes';
}

$options = [	
	$prefix . 'hide_files_caption_main' => [
		'label' => __( 'Hide files caption', 'blocksy-tainacan' ),
		'type' => 'ct-switch',
		'value' => $enabled,
		'setting' => [ 'transport' => 'postMessage' ],
		'desc' => __( 'Toggle to hide the attachments and document caption on the main view.', 'blocksy-tainacan' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix,
		]),
	]
];
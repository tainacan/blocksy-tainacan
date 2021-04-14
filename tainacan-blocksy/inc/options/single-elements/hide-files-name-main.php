<?php

if (! isset($prefix)) {
	$prefix = '';
}
if (! isset($enabled)) {
	$enabled = 'yes';
}

$options = [	
	$prefix . 'hide_files_name_main' => [
		'label' => __( 'Hide files name', 'tainacan-blocksy' ),
		'type' => 'ct-switch',
		'value' => $enabled,
		'setting' => [ 'transport' => 'postMessage' ],
		'desc' => __( 'Toggle to hide the attachments and document name on the main view.', 'tainacan-blocksy' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix,
		]),
	]
];
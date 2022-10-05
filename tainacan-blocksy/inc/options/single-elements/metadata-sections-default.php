<?php

if (! isset($prefix)) {
	$prefix = '';
}

if (! isset($enabled)) {
	$enabled = 'no';
}

$options = [	
	$prefix . 'metadata_sections_separate_default_section' => [
		'label' => __( 'Separate default section', 'tainacan-blocksy' ),
		'type' => 'ct-switch',
		'value' => $enabled,
		'setting' => [ 'transport' => 'postMessage' ],
		'desc' => __( 'Toggle to show or not the default section separated from the other sections layout.', 'tainacan-blocksy' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	]
];
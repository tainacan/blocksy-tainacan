<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

if (! isset($enabled)) {
	$enabled = 'yes';
}

$options = [
	$prefix . 'has_title_metadata' => [
		'label' => __( 'Title metadata in the metadata list.', 'blocksy-tainacan' ),
		'type' => 'ct-panel',
		'switch' => true,
		'value' => $enabled,
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],

];
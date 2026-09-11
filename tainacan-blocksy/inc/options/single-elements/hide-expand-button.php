<?php

if (! isset($prefix)) {
	$prefix = '';
}
if (! isset($enabled)) {
	$enabled = 'no';
}

$options = [
	$prefix . 'hide_expand_button' => [
		'label' => __( 'Hide expand control', 'tainacan-blocksy' ),
		'type' => 'ct-switch',
		'value' => $enabled,
		'setting' => [ 'transport' => 'postMessage' ],
		'desc' => __( 'Toggle to never display the "Expand" control that opens the large gallery viewer for video, audio and embeds.', 'tainacan-blocksy' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix,
		])
	]
];

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- Blocksy option include contract ($prefix, $options, $enabled).

if (! isset($prefix)) {
	$prefix = '';
}

$options = [	
	$prefix . 'attachments_carousel_width' => [
		'label' => __( 'Maximum width of the area containing the attachments carousel', 'tainacan-blocksy' ),
		'type' => 'ct-slider',
		'value' => 100,
		'min' => 20,
		'max' => 100,
		'unit' => '%',
		'defaultUnit' => '%',
		'responsive' => true,
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	]
];
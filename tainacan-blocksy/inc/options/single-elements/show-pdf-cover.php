<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- Blocksy option include contract ($prefix, $options, $enabled).

if (! isset($prefix)) {
	$prefix = '';
}
if (! isset($enabled)) {
	$enabled = 'no';
}

$options = [];

if ( function_exists( 'tainacan_blocksy_has_media_cover_mime_types' )
	&& tainacan_blocksy_has_media_cover_mime_types() ) {

	if (! isset($sync)) {
		$sync = blocksy_sync_single_post_container([
			'prefix' => $prefix,
		]);
	}

	$options = [
		$prefix . 'show_pdf_cover' => [
			'label' => __( 'Show PDF cover instead of embedded reader', 'tainacan-blocksy' ),
			'type' => 'ct-switch',
			'value' => $enabled,
			'setting' => [ 'transport' => 'postMessage' ],
			'desc' => __( 'The lightbox can still show the PDF reader.', 'tainacan-blocksy' ),
			'sync' => $sync
		]
	];
}

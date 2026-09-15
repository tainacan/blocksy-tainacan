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

$hide_files_name_option = [
	$prefix . 'hide_files_name' => [
		'label' => __( 'Hide files name on carousel', 'tainacan-blocksy' ),
		'type' => 'ct-switch',
		'value' => $enabled,
		'setting' => [ 'transport' => 'postMessage' ],
		'desc' => __( 'Toggle to hide the attachments and document name on the carousel.', 'tainacan-blocksy' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix,
		])
	]
];

$has_thumbs_layout = function_exists( 'tainacan_blocksy_has_media_thumbs_layout' )
	&& tainacan_blocksy_has_media_thumbs_layout();

if ( $has_thumbs_layout ) {
	$options = [
		blocksy_rand_md5() => [
			'type' => 'ct-condition',
			'condition' => [
				$prefix . 'thumbs_layout' => '!list',
			],
			'options' => $hide_files_name_option,
		],
	];
} else {
	$options = $hide_files_name_option;
}

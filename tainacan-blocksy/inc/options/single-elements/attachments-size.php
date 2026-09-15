<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (! isset($prefix)) {
	$prefix = '';
}

$thumbnails_image_size_option = [
	$prefix . 'thumbnails_image_size' => [
		'label' => __('Thumbnails image size', 'blocksy'), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Blocksy theme translation.
		'type' => 'ct-select',
		'value' => 'tainacan-medium',
		'view' => 'text',
		'design' => 'inline',
		'sync' => '',
		'choices' => blocksy_ordered_keys(
			blocksy_get_all_image_sizes()
		),
	],
];

$attachments_size_option = [
	$prefix . 'attachments_size' => [
		'label' => __( 'Attachments size on carousel', 'tainacan-blocksy' ),
		'type' => 'ct-slider',
		'value' => [
			'mobile' => '120px',
			'tablet' => '130px',
			'desktop' => '140px',
		],
		'units' => blocksy_units_config([
			[
				'unit' => 'px',
				'min' => 42,
				'max' => 300,
			]
		]),
		'responsive' => true,
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
];

$thumbs_have_fixed_height_option = [
	$prefix . 'thumbs_have_fixed_height' => [
		'label' => __( 'Thumbnails have fixed height', 'tainacan' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
		'type' => 'ct-switch',
		'value' => 'no',
		'desc' => __( 'If checked, the thumbnails will have fixed the attachment size height, otherwise they will have fixed the attachment size width.', 'tainacan-blocksy' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
];

$has_thumbs_layout = function_exists( 'tainacan_blocksy_has_media_thumbs_layout' )
	&& tainacan_blocksy_has_media_thumbs_layout();

$image_size_controls = array_merge(
	$thumbnails_image_size_option,
	$attachments_size_option
);

if ( $has_thumbs_layout ) {
	$options = [
		blocksy_rand_md5() => [
			'type' => 'ct-condition',
			'condition' => [
				$prefix . 'thumbs_layout' => '!list',
			],
			'options' => array_merge(
				$image_size_controls,
				$thumbs_have_fixed_height_option
			),
		],
		blocksy_rand_md5() => [
			'type' => 'ct-condition',
			'condition' => [
				$prefix . 'thumbs_layout' => 'list',
				$prefix . 'hide_image_thumbnails' => '!yes',
			],
			'options' => $image_size_controls,
		],
	];
} else {
	$options = array_merge(
		$thumbnails_image_size_option,
		$attachments_size_option,
		$thumbs_have_fixed_height_option
	);
}

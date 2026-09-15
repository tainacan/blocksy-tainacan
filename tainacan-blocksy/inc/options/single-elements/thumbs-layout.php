<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (! isset($prefix)) {
	$prefix = '';
}

$has_thumbs_layout = function_exists( 'tainacan_blocksy_has_media_thumbs_layout' )
	&& tainacan_blocksy_has_media_thumbs_layout();

$options = [];

if ( $has_thumbs_layout ) {
	$options = [
		$prefix . 'thumbs_layout' => [
			'label' => __( 'Thumbnails layout', 'tainacan-blocksy' ),
			'type' => 'ct-select',
			'value' => 'carousel',
			'view' => 'text',
			'design' => 'inline',
			'desc' => __( 'Same files as the carousel: images and icons, not live embeds. List rows always show the file name.', 'tainacan-blocksy' ),
			'sync' => blocksy_sync_single_post_container([
				'prefix' => $prefix
			]),
			'choices' => blocksy_ordered_keys(
				[
					'carousel' => __( 'Carousel', 'tainacan' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
					'grid' => __( 'Grid', 'tainacan' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
					'list' => __( 'List', 'tainacan' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
				]
			),
		],
		blocksy_rand_md5() => [
			'type' => 'ct-condition',
			'condition' => [
				$prefix . 'thumbs_layout' => 'list',
			],
			'options' => [
				$prefix . 'hide_image_thumbnails' => [
					'label' => __( 'Hide thumbnail image', 'tainacan' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
					'type' => 'ct-switch',
					'value' => 'no',
					'setting' => [ 'transport' => 'postMessage' ],
					'desc' => __( 'Toggle to hide the file thumbnail and show only the name.', 'tainacan-blocksy' ),
					'sync' => blocksy_sync_single_post_container([
						'prefix' => $prefix,
					])
				],
			],
		],
	];
}

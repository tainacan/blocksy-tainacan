<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [	
	$prefix . 'thumbnails_image_size' => [
		'label' => __('Thumbnails image size', 'blocksy'),
		'type' => 'ct-select',
		'value' => 'tainacan-medium',
		'view' => 'text',
		'design' => 'inline',
		'sync' => '',
		'choices' => blocksy_ordered_keys(
			blocksy_get_all_image_sizes()
		),
	],
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
	$prefix . 'thumbs_have_fixed_height' => [
		'label' => __( 'Thumbnails have fixed height', 'tainacan-blocksy' ),
		'type' => 'ct-switch',
		'value' => 'no',
		'desc' => __( 'If checked, the thumbnails will have fixed the attachment size height, otherwise they will have fixed the attachment size width.', 'tainacan-blocksy' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],

];
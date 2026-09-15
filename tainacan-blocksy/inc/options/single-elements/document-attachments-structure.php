<?php

if (! isset($prefix)) {
	$prefix = '';
}
if (! isset($enabled)) {
	$enabled = 'no';
}

$has_thumbs_layout = function_exists( 'tainacan_blocksy_has_media_thumbs_layout' )
	&& tainacan_blocksy_has_media_thumbs_layout();

$position_condition = [
	$prefix . 'document_attachments_structure' => 'gallery-type-2',
];

if ( $has_thumbs_layout ) {
	$position_condition[ $prefix . 'thumbs_layout' ] = 'carousel';
}

$options = [
	$prefix . 'document_attachments_structure' => [
		'label' => false,
		'type' => 'ct-image-picker',
		'value' => 'gallery-type-1',
		'design' => 'block',
		'setting' => [ 'transport' => 'postMessage' ],
		'choices' => [
			'gallery-type-1' => [
				'src'   => tainacan_blocksy_image_picker_url( 'gallery-type-1.svg' ),
				'title' => __( 'Document and Attachments separate', 'tainacan-blocksy' )
			],
			'gallery-type-2' => [
				'src'   => tainacan_blocksy_image_picker_url( 'gallery-type-2.svg' ),
				'title' => __( 'Document and Attachments merged', 'tainacan-blocksy' )
			]
		],
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
];

if ( $has_thumbs_layout ) {
	$thumbs_layout_options = blocksy_get_options(
		TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/thumbs-layout.php',
		[
			'prefix' => $prefix,
		],
		false
	);

	if ( is_array( $thumbs_layout_options ) ) {
		$options = array_merge( $options, $thumbs_layout_options );
	}
}

$options[ blocksy_rand_md5() ] = [
	'type' => 'ct-condition',
	'condition' => $position_condition,
	'options' => [
		$prefix . 'document_attachments_position' => [
			'label' => __( 'Thumbnails position', 'tainacan-blocksy' ),
			'type' => 'ct-radio',
			'value' => 'below',
			'view' => 'text',
			'design' => 'block',
			'sync' => '',
			'choices' => [
				'left' => __( 'Left', 'tainacan-blocksy' ),
				'below' => __( 'Below', 'tainacan-blocksy' ),
				'right' => __( 'Right', 'tainacan-blocksy' ),
			],
		]
	]
];

$options[ $prefix . 'document_attachments_spacing' ] = [
	'label' => __( 'Inner spacing', 'tainacan-blocksy' ),
	'desc' => __( 'Prefer using minimum only if your gallery contains mostly images which can be croped withour loss of information', 'tainacan-blocksy' ),
	'type' => 'ct-radio',
	'value' => 'default',
	'view' => 'text',
	'design' => 'block',
	'sync' => '',
	'choices' => [
		'default' => __( 'Default', 'tainacan-blocksy' ),
		'minimum' => __( 'Minimum', 'tainacan-blocksy' ),
	],
];

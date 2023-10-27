<?php

if (! isset($prefix)) {
	$prefix = '';
}
if (! isset($enabled)) {
	$enabled = 'no';
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
	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'document_attachments_structure' => 'gallery-type-2'
		],
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
	],
	$prefix . 'document_attachments_spacing' => [
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
	]
];
<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [	
	$prefix . 'metadata_sections_layout_type' => [
		'label' => false,
		'type' => 'ct-image-picker',
		'value' => 'metadata-section-type-1',
		'design' => 'block',
		'setting' => [ 'transport' => 'postMessage' ],
		'choices' => [
			'metadata-section-type-1' => [
				'src'   => tainacan_blocksy_image_picker_url( 'metadata-section-type-1.svg' ),
				'title' => __( 'Default', 'tainacan-blocksy' ),
            ],
            'metadata-section-type-2' => [
				'src'   => tainacan_blocksy_image_picker_url( 'metadata-section-type-2.svg' ),
				'title' => __( 'Tabs', 'tainacan-blocksy' ),
            ],
            'metadata-section-type-3' => [
				'src'   => tainacan_blocksy_image_picker_url( 'metadata-section-type-3.svg' ),
				'title' => __( 'Collapses', 'tainacan-blocksy' ),
            ],
            'metadata-section-type-4' => [
				'src'   => tainacan_blocksy_image_picker_url( 'metadata-section-type-4.svg' ),
				'title' => __( 'Accordion', 'tainacan-blocksy' ),
            ]
        ],
        'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
];
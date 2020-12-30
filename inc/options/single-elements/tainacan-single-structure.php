<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$options = [	
	$prefix . 'page_structure_type' => [
		'label' => false,
		'type' => 'ct-image-picker',
		'value' => 'type-dam',
		'design' => 'block',
		'setting' => [ 'transport' => 'postMessage' ],
		'choices' => [
			'type-dam' => [
				'src'   => blocksy_tainacan_image_picker_url( 'type-dam.svg' ),
				'title' => __( 'Document, Attachments, Metadata', 'blocksy-tainacan' ),
            ],
            
            'type-dma' => [
				'src'   => blocksy_tainacan_image_picker_url( 'type-dma.svg' ),
				'title' => __( 'Document, Metadata, Attachments', 'blocksy-tainacan' ),
            ],
            
            'type-mda' => [
				'src'   => blocksy_tainacan_image_picker_url( 'type-mda.svg' ),
				'title' => __( 'Metadata, Document, Attachments', 'blocksy-tainacan' ),
            ],
            
            'type-gm' => [
				'src'   => blocksy_tainacan_image_picker_url( 'type-gm.svg' ),
				'title' => __( 'Metadata to the right', 'blocksy-tainacan' ),
			],

            'type-mg' => [
				'src'   => blocksy_tainacan_image_picker_url( 'type-mg.svg' ),
				'title' => __( 'Metadata to the left', 'blocksy-tainacan' ),
			],
        ],
        'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
];
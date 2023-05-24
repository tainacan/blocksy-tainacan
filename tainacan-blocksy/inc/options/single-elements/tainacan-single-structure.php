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
		'choices' => [
			'type-dam' => [
				'src'   => tainacan_blocksy_image_picker_url( 'type-dam.svg' ),
				'title' => __( 'Document, Attachments, Metadata', 'tainacan-blocksy' )
            ],
            
            'type-dma' => [
				'src'   => tainacan_blocksy_image_picker_url( 'type-dma.svg' ),
				'title' => __( 'Document, Metadata, Attachments', 'tainacan-blocksy' )
            ],
            
            'type-mda' => [
				'src'   => tainacan_blocksy_image_picker_url( 'type-mda.svg' ),
				'title' => __( 'Metadata, Document, Attachments', 'tainacan-blocksy' )
            ],
            
            'type-gm' => [
				'src'   => tainacan_blocksy_image_picker_url( 'type-gm.svg' ),
				'title' => __( 'Metadata to the right', 'tainacan-blocksy' )
			],

            'type-mg' => [
				'src'   => tainacan_blocksy_image_picker_url( 'type-mg.svg' ),
				'title' => __( 'Metadata to the left', 'tainacan-blocksy' )
			],

            'type-gtm' => [
				'src'   => tainacan_blocksy_image_picker_url( 'type-gtm.svg' ),
				'title' => __( 'Document and Attachments above Title', 'tainacan-blocksy' ),
			]
        ],
        'sync' => ''
	]
];
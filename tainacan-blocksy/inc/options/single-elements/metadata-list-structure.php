<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [	
	$prefix . 'metadata_list_structure_type' => [
		'label' => false,
		'type' => 'ct-image-picker',
		'value' => 'metadata-type-1',
		'design' => 'block',
		'setting' => [ 'transport' => 'postMessage' ],
		'choices' => [
			'metadata-type-1' => [
				'src'   => tainacan_blocksy_image_picker_url( 'metadata-type-1.svg' ),
				'title' => __( 'Label above values', 'tainacan-blocksy' )
            ],
            
            'metadata-type-2' => [
				'src'   => tainacan_blocksy_image_picker_url( 'metadata-type-2.svg' ),
				'title' => __( 'Label aside values', 'tainacan-blocksy' )
            ]
        ],
        'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	]
];
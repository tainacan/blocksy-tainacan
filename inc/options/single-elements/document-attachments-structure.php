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
				'src'   => blocksy_tainacan_image_picker_url( 'gallery-type-1.svg' ),
				'title' => __( 'Document and Attachments separate', 'blocksy-tainacan' ),
            ],
            'gallery-type-2' => [
				'src'   => blocksy_tainacan_image_picker_url( 'gallery-type-2.svg' ),
				'title' => __( 'Document and Attachments merged', 'blocksy-tainacan' ),
            ],
        ],
        'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		]),
		'divider' => 'bottom',
	],
];
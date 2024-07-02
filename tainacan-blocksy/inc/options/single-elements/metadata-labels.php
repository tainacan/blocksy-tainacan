<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [
	[
		blocksy_rand_md5() => [
			'type' => 'ct-title',
			'label' => __( 'Metadata Label', 'tainacan-blocksy' )
		]
	],
	$prefix . 'tainacan_metadata_label_font' => [
		'type' => 'ct-typography',
		'label' => __( 'Font settings', 'tainacan-blocksy' ),
		'value' => blocksy_typography_default_values([
			'size' => '20px',
			'variation' => 'n6',
			'line-height' => '1.2'
		]),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
	$prefix . 'tainacan_metadata_label_alignment' => [
		'type' => 'ct-radio',
		'label' => __( 'Text alignment', 'blocksy' ),
		'value' => 'left',
		'view' => 'text',
		'attr' => [ 'data-type' => 'alignment' ],
		'responsive' => true,
		'design' => 'block',
		'choices' => [
			'left' => '',
			'center' => '',
			'right' => '',
		],
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
	$prefix . 'metadata_label_border' => [
        'label' => __( 'Separator', 'blocksy' ),
        'type' => 'ct-border',
        'design' => 'block',
        'setting' => [ 'transport' => 'postMessage' ],
        'value' => [
            'width' => 0,
            'style' => 'solid',
            'color' => [
                'color' => 'rgba(125, 125, 125, 0.5)',
            ]
        ],
        'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
    ]
];
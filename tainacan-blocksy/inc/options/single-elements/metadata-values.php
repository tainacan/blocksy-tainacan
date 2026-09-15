<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- Blocksy option include contract ($prefix, $options, $enabled).

if (! isset($prefix)) {
	$prefix = '';
}

$options = [
    [
		blocksy_rand_md5() => [
			'type' => 'ct-title',
			'label' => __( 'Metadata Value', 'tainacan-blocksy' )
		]
	],
    $prefix . 'tainacan_metadata_value_font' => [
		'type' => 'ct-typography',
		'label' => __( 'Font settings', 'tainacan-blocksy' ),
		'value' => blocksy_typography_default_values([
			'size' => '17px'
		]),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		]),
		'divider' => 'bottom',
    ],
	$prefix . 'tainacan_metadata_value_alignment' => [
		'type' => 'ct-radio',
		'label' => __( 'Text alignment', 'blocksy' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Blocksy theme translation.
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
    $prefix . 'metadata_value_border' => [
        'label' => __( 'Separator', 'blocksy' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Blocksy theme translation.
        'type' => 'ct-border',
        'design' => 'block',
        'responsive' => true,
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
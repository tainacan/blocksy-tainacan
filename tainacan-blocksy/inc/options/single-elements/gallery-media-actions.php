<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [
	$prefix . 'gallery_media_actions_appearance' => [
		'label' => __( 'Actions appearance', 'tainacan-blocksy' ),
		'type' => 'ct-radio',
		'value' => 'icon',
		'view' => 'text',
		'design' => 'block',
		'choices' => [
			'icon' => __( 'Icon', 'tainacan-blocksy' ),
			'button' => __( 'Button', 'tainacan-blocksy' ),
			'link' => __( 'Link', 'tainacan-blocksy' ),
		],
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
	$prefix . 'gallery_media_actions_behavior' => [
		'label' => __( 'Actions visibility', 'tainacan-blocksy' ),
		'type' => 'ct-radio',
		'value' => 'hover',
		'view' => 'text',
		'design' => 'block',
		'choices' => [
			'hover' => __( 'On hover', 'tainacan-blocksy' ),
			'always' => __( 'Always visible', 'tainacan-blocksy' ),
		],
		'desc' => __( 'On hover shows the controls over the media. Always visible places them inline below the media.', 'tainacan-blocksy' ),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'hide_download_button' => '!yes'
		],
		'options' => [
			$prefix . 'gallery_download_alignment' => [
				'type' => 'ct-radio',
				'label' => __( 'Download alignment', 'tainacan-blocksy' ),
				'value' => 'center',
				'view' => 'text',
				'attr' => [ 'data-type' => 'alignment' ],
				'design' => 'block',
				'choices' => [
					'left' => '',
					'center' => '',
					'right' => '',
				],
				'sync' => blocksy_sync_single_post_container([
					'prefix' => $prefix
				])
			]
		]
	],
	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'hide_expand_button' => '!yes'
		],
		'options' => [
			$prefix . 'gallery_expand_alignment' => [
				'type' => 'ct-radio',
				'label' => __( 'Expand alignment', 'tainacan-blocksy' ),
				'value' => 'center',
				'view' => 'text',
				'attr' => [ 'data-type' => 'alignment' ],
				'design' => 'block',
				'choices' => [
					'left' => '',
					'center' => '',
					'right' => '',
				],
				'sync' => blocksy_sync_single_post_container([
					'prefix' => $prefix
				])
			]
		]
	]
];

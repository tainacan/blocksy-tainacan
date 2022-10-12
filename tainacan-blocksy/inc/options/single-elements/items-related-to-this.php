<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

if (! isset($enabled)) {
	$enabled = 'yes';
}

$options = [
	$prefix . 'display_items_related_to_this' => [
		'label' => __( 'Display "Items related to this"', 'tainacan-blocksy' ),
		'type' => 'ct-panel',
		'switch' => true,
		'value' => $enabled,
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [
			$prefix . 'items_related_to_this_layout' => [
				'label' => false,
				'type' => 'ct-image-picker',
				'value' => 'carousel',
				'design' => 'block',
				'setting' => [ 'transport' => 'postMessage' ],
				'choices' => [
					'carousel' => [
						'src'   => tainacan_blocksy_image_picker_url( 'items-carousel.svg' ),
						'title' => __( 'Carousel', 'tainacan-blocksy' )
					],
					'grid' => [
						'src'   => tainacan_blocksy_image_picker_url( 'items-grid.svg' ),
						'title' => __( 'Grid', 'tainacan-blocksy' )
					],
					'list' => [
						'src'   => tainacan_blocksy_image_picker_url( 'items-list.svg' ),
						'title' => __( 'List', 'tainacan-blocksy' )
					]
				],
				'sync' => blocksy_sync_single_post_container([
					'prefix' => $prefix
				])
			],
			blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'items_related_to_this_layout'  => 'carousel'
                ],
                'options' => [
					$prefix . 'items_related_to_this_max_items_per_screen' => [
						'label' => __( 'Max amount of items per slide', 'blocksy' ),
						'type' => 'ct-number',
						'design' => 'inline',
						'value' => 6,
						'min' => 1,
						'max' => 10,
						'sync' => ''
					]
				]
			],
			blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'items_related_to_this_layout'  => 'grid | list'
                ],
                'options' => [
					$prefix . 'items_related_to_this_max_columns_count' => [
						'label' => __( 'Max amount of items columns', 'blocksy' ),
						'type' => 'ct-number',
						'design' => 'inline',
						'value' => 4,
						'min' => 1,
						'max' => 8,
						'sync' => ''
					]
				]
			]
        ]
    ]
];
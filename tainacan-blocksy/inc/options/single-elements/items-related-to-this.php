<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

if (! isset($enabled)) {
	$enabled = 'yes';
}

$order_options = tainacan_get_default_order_choices();

$view_modes = tainacan_get_default_view_mode_choices();

$layout_choices = [
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
];

if ( null !== TAINACAN_VERSION && version_compare( TAINACAN_VERSION, '0.21.5' ) >= 0  ) {
	$layout_choices['tainacan-view-modes'] = [
		'src'   => tainacan_blocksy_image_picker_url( 'items-records.svg' ),
		'title' => __( 'Tainacan View Modes', 'tainacan-blocksy' )
	];
}

if ( method_exists('\Tainacan\Theme_Helper', 'get_tainacan_items_gallery') ) {
	$layout_choices['gallery-slider'] = [
		'src'   => tainacan_blocksy_image_picker_url( 'items-gallery-slider.svg' ),
		'title' => __( 'Gallery slider, documents with zoom and thumbnails', 'tainacan-blocksy' )
	];
	$layout_choices['gallery-thumbs'] = [
		'src'   => tainacan_blocksy_image_picker_url( 'items-gallery-thumbs.svg' ),
		'title' => __( 'Gallery carousel, thumbnails with zoom', 'tainacan-blocksy' )
	];
}

$inner_options = [
	$prefix . 'items_related_to_this_layout' => [
		'label' => false,
		'type' => 'ct-image-picker',
		'value' => 'carousel',
		'design' => 'block',
		'setting' => [ 'transport' => 'postMessage' ],
		'choices' => $layout_choices,
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
	],
	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'items_related_to_this_layout'  => 'grid | list'
		],
		'options' => [
			$prefix . 'items_related_to_this_max_columns_count' => [
				'label' => __( 'Max amount of items columns', 'tainacan-blocksy' ),
				'type' => 'ct-number',
				'design' => 'inline',
				'value' => 4,
				'min' => 1,
				'max' => 8,
				'sync' => ''
			]
		]
	],
	$prefix . 'items_related_to_this_max_items_number' => [
		'label' => __( 'Max amount of items to fetch', 'tainacan-blocksy' ),
		'type' => 'ct-number',
		'design' => 'inline',
		'value' => 12,
		'min' => 1,
		'max' => 96,
		'sync' => ''
	],
	$prefix . 'items_related_to_this_order' => [
		'label' => __('Order by', 'blocksy'),
		'type' => 'ct-select',
		'value' => 'title_asc',
		'view' => 'text',
		'design' => 'inline',
		'sync' => '',
		'choices' => blocksy_ordered_keys(
			$order_options
		)
	],
];

if ( null !== TAINACAN_VERSION && version_compare( TAINACAN_VERSION, '0.21.5' ) >= 0  ) {
	$inner_options[ $prefix . 'items_related_to_this_hide_collection_heading' ] = [
		'label' => __( 'Hide collection heading', 'tainacan-blocksy' ),
		'type' => 'ct-switch',
		'value' => 'no',
		'desc' => __( 'Toggle to hide the relationship collection heading.', 'tainacan-blocksy' ),
		'sync' => ''
	]; 
	$inner_options[ $prefix . 'items_related_to_this_hide_metadata_label' ] = [
		'label' => __( 'Hide related metadata label', 'tainacan-blocksy' ),
		'type' => 'ct-switch',
		'value' => 'no',
		'desc' => __( 'Toggle to hide the relationship metadata label.', 'tainacan-blocksy' ),
		'sync' => ''
	];
}

if ( method_exists('\Tainacan\Theme_Helper', 'get_tainacan_items_gallery') ) {
	$inner_options[$prefix . 'items_related_to_this_view_more_links_position'] = [
		'label' => __( '"View more" links position', 'tainacan-blocksy' ),
		'type' => 'ct-select',
		'value' => 'bottom-left',
		'view' => 'text',
		'design' => 'inline',
		'sync' => '',
		'choices' => [
			'bottom-left' => __( 'Bottom left', 'tainacan-blocksy' ),
			'bottom-right' => __( 'Bottom right', 'tainacan-blocksy' ),
			'top-right' => __( 'Top right', 'tainacan-blocksy' ),
		]
	];
	$inner_options[$prefix . 'items_related_to_this_view_more_links_style'] = [
		'label' => __( '"View more" links style', 'tainacan-blocksy' ),
		'type' => 'ct-radio',
		'value' => 'button',
		'view' => 'text',
		'design' => 'block',
		'sync' => '',
		'choices' => [
			'button' => __( 'Button', 'tainacan-blocksy' ),
			'link' => __( 'Link', 'tainacan-blocksy' ),
		],
	];
}

$inner_options[blocksy_rand_md5()] = [
	'type' => 'ct-divider',
];
$inner_options[blocksy_rand_md5()] = [
	'type' => 'ct-condition',
	'condition' => [
		$prefix . 'items_related_to_this_layout'  => 'tainacan-view-modes'
	],
	'options' => [
		$prefix . 'items_related_to_this_tainacan_view_mode' => [
			'label' => __('Tainacan view mode', 'tainacan-blocksy'),
			'type' => 'ct-select',
			'value' => $view_modes['default_view_mode'],
			'view' => 'text',
			'design' => 'inline',
			'sync' => '',
			'choices' => blocksy_ordered_keys(
				$view_modes['enabled_view_modes']
			)
		]
	],
];
$inner_options[blocksy_rand_md5()] = [
	'type' => 'ct-condition',
	'condition' => [
		$prefix . 'items_related_to_this_layout'  => 'grid | list | carousel | gallery-slider | gallery-thumbs'
	],
	'options' => [
		$prefix . 'items_related_to_this_image_size' => [
			'label' => __('Image size', 'blocksy'),
			'type' => 'ct-select',
			'value' => 'tainacan-medium',
			'view' => 'text',
			'design' => 'inline',
			'sync' => '',
			'choices' => blocksy_ordered_keys(
				blocksy_get_all_image_sizes()
			),
		],
	]
];

if ( null !== TAINACAN_VERSION && version_compare( TAINACAN_VERSION, '0.21.8' ) >= 0 ) {
	$inner_options[blocksy_rand_md5()] = [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'items_related_to_this_layout'  => 'carousel',
			$prefix . 'items_related_to_this_variable_items_width' => 'no',
		],
		'options' => [
			$prefix . 'items_related_to_this_max_items_per_screen' => [
				'label' => __( 'Max amount of items per slide', 'tainacan-blocksy' ),
				'type' => 'ct-number',
				'design' => 'inline',
				'value' => 6,
				'min' => 1,
				'max' => 10,
				'sync' => ''
			]
		]
	];
	$inner_options[blocksy_rand_md5()] = [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'items_related_to_this_layout'  => 'carousel | gallery-slider | gallery-thumbs',
		],
		'options' => [
			$prefix . 'items_related_to_this_variable_items_width' => [
				'label' => __( 'Variable items width', 'tainacan-blocksy' ),
				'type' => 'ct-switch',
				'value' => 'no',
				'desc' => __( 'Toggle to define each slide size based on its content natural width.', 'tainacan-blocksy' ),
				'sync' => ''
			]
		]
	];
} else {
	$inner_options[blocksy_rand_md5()] = [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'items_related_to_this_layout'  => 'carousel',
		],
		'options' => [
			$prefix . 'items_related_to_this_max_items_per_screen' => [
				'label' => __( 'Max amount of items per slide', 'tainacan-blocksy' ),
				'type' => 'ct-number',
				'design' => 'inline',
				'value' => 6,
				'min' => 1,
				'max' => 10,
				'sync' => ''
			]
		]
	];
}

if ( method_exists('\Tainacan\Theme_Helper', 'get_tainacan_items_gallery') ) {
	$inner_options[blocksy_rand_md5()] = [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'items_related_to_this_layout'  => 'gallery-slider | gallery-thumbs',
		],
		'options' => [
			$prefix . 'items_related_to_this_enable_lightbox' => [
				'label' => __( 'Open lightbox on click', 'tainacan-blocksy' ),
				'type' => 'ct-switch',
				'value' => 'yes',
				'sync' => ''
			]
		]
	];
	$inner_options[blocksy_rand_md5()] = [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'items_related_to_this_layout'  => 'gallery-slider'
		],
		'options' => [
			$prefix . 'items_related_to_this_gallery_max_height' => [
				'label' => __('Gallery main slider max height', 'tanacan-blocksy'),
				'type' => 'ct-slider',
				'value' => 60,
				'min' => 10,
				'max' => 140,
				'unit' => 'vh',
				'defaultUnit' => 'vh',
				'responsive' => true,
				'sync' => ''
			],
			$prefix . 'items_related_to_this_gallery_spacing' => [
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
		]
	];
	$inner_options[blocksy_rand_md5()] = [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'items_related_to_this_layout'  => 'gallery-slider | gallery-thumbs'
		],
		'options' => [
			$prefix . 'items_related_to_this_thumbs_size' => [
				'label' => __( 'Thumbnails size gallery on carousel', 'tainacan-blocksy' ),
				'type' => 'ct-slider',
				'value' => [
					'mobile' => '120px',
					'tablet' => '130px',
					'desktop' => '140px',
				],
				'units' => blocksy_units_config([
					[
						'unit' => 'px',
						'min' => 42,
						'max' => 300,
					]
				]),
				'responsive' => true,
				'sync' => ''
			],
		]
	];
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
		'inner-options' => $inner_options
    ]
];
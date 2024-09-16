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

$inner_options = [
	$prefix . 'items_related_to_this_layout' => [
		'label' => false,
		'type' => 'ct-image-picker',
		'value' => 'carousel',
		'design' => 'block',
		'setting' => [ 'transport' => 'postMessage' ],
		'choices' => $layout_choices,
		'sync' => '',
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
	blocksy_rand_md5() => [
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
	],
	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'items_related_to_this_layout'  => 'grid | list | carousel'
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
	]
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
			$prefix . 'items_related_to_this_layout'  => 'carousel'
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
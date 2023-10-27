<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$default_hero_elements = [];

$default_hero_elements[] = [
	'id' => 'custom_title',
	'enabled' => true,
	'heading_tag' => 'h1'
];
$default_hero_elements[] = [
    'id' => 'breadcrumbs',
    'enabled' => false
];

$options = [
	$prefix . 'page-header-panel' => [
		'label' => __( 'Page header', 'tainacan-blocksy' ),
		'type' => 'ct-panel',
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [
            $prefix . 'page_header_background_style' => [
                'label' => __('Header style', 'tainacan-blocksy'),
                'type' => 'ct-image-picker',
                'value' => 'boxed',
                'design' => 'block',
                'choices' => [
                    'type-1' => [
                        'title' => __('Classic', 'tainacan-blocksy'),
                        'src' => tainacan_blocksy_image_picker_url('header-type-1.svg'),
                    ],
                    'type-2' => [
                        'title' => __('Banner', 'tainacan-blocksy'),
                        'src' => tainacan_blocksy_image_picker_url('header-type-2.svg'),
                    ],
                    'simple' => [
                        'title' => __('Gradient', 'tainacan-blocksy'),
                        'src' => tainacan_blocksy_image_picker_url('header-simple.svg'),
                    ],
                    'boxed' => [
                        'title' => __('Boxed', 'tainacan-blocksy'),
                        'src' => tainacan_blocksy_image_picker_url('header-boxed.svg')
                    ],
                ]
            ],
            $prefix . 'hero_elements' => [
                'label' => __('Elements', 'blocksy'),
                'type' => 'ct-layers',
                'attr' => [ 'data-layers' => 'title-elements' ],
                'design' => 'block',
				'manageable' => false,
                'value' => $default_hero_elements,
                'sync' => '',
    
                'settings' => [
                    'custom_title' => [
                        'label' => __('Title', 'blocksy'),
                        'options' => [
                            [
                                'heading_tag' => [
                                    'label' => __('Heading tag', 'blocksy'),
                                    'type' => 'ct-select',
                                    'value' => 'h1',
                                    'view' => 'text',
                                    'design' => 'inline',
                                    'sync' => [
                                        'id' => $prefix . 'hero_elements_heading_tag',
                                    ],
                                    'choices' => blocksy_ordered_keys(
                                        [
                                            'h1' => 'H1',
                                            'h2' => 'H2',
                                            'h3' => 'H3',
                                            'h4' => 'H4',
                                            'h5' => 'H5',
                                            'h6' => 'H6',
                                        ]
                                    )
                                ]
                            ],

                            'hero_item_spacing' => [
                                'label' => __( 'Top Spacing', 'blocksy' ),
                                'type' => 'ct-slider',
                                'value' => 20,
                                'min' => 0,
                                'max' => 100,
                                'responsive' => true,
                                'sync' => [
                                    'id' => $prefix . 'hero_elements_spacing',
                                ]
                            ]
                        ]
                    ],
                    'breadcrumbs' => [
                        'label' => __('Breadcrumbs', 'blocksy'),
                        'options' => [
                            'hero_item_spacing' => [
                                'label' => __( 'Top Spacing', 'blocksy' ),
                                'type' => 'ct-slider',
                                'value' => 20,
                                'min' => 0,
                                'max' => 100,
                                'responsive' => true,
                                'sync' => [
                                    'id' => $prefix . 'hero_elements_spacing',
                                ]
                            ]
                        ]
                    ],
                ]
            ]
		]
	]
];

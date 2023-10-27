<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$default_hero_elements = [];

$default_hero_elements[] = [
	'id' => 'custom_thumbnail',
	'enabled' => true,
];

$default_hero_elements[] = [
	'id' => 'custom_title',
	'enabled' => true,
	'heading_tag' => 'h1'
];

$default_hero_elements[] = [
	'id' => 'breadcrumbs',
	'enabled' => true
];

$default_hero_elements[] = [
	'id' => 'custom_description',
	'enabled' => true,
	'description_visibility' => [
		'desktop' => true,
		'tablet' => true,
		'mobile' => false,
	]
];

add_filter( 'blocksy:options:page-title:archives-have-hero', function() use ($prefix) {
    return str_contains($prefix, 'tnc_col_') || $prefix === 'tainacan-terms-items_archive_';
});

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
                'value' => $default_hero_elements,
                'sync' => '',
    
                'settings' => [
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

                    'custom_thumbnail' => [
                        'label' => __('Thumbnail', 'blocksy')
                    ],
                    
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
    
                            
                            [
                                [
                                    'has_category_label' => [
                                        'label' => __('Category Label', 'blocksy'),
                                        'type' => 'ct-switch',
                                        'value' => $prefix === 'tainacan-terms-items_archive_' ? 'yes' : 'no',
                                    ]
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
    
                    'custom_description' => [
                        'label' => __('Description', 'blocksy'),
                        'options' => [
    
                            'description_visibility' => [
                                'label' => __( 'Visibility', 'blocksy' ),
                                'type' => 'ct-visibility',
                                'design' => 'block',
    
                                'value' => [
                                    'desktop' => true,
                                    'tablet' => true,
                                    'mobile' => false,
                                ],
    
                                'choices' => blocksy_ordered_keys([
                                    'desktop' => __( 'Desktop', 'blocksy' ),
                                    'tablet' => __( 'Tablet', 'blocksy' ),
                                    'mobile' => __( 'Mobile', 'blocksy' )
                                ]),
    
                                'sync' => [
                                    'id' => $prefix . 'hero_elements_spacing',
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
                    ]
                ]
            ]
		]
	]
];

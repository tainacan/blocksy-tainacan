<?php

if (! isset($prefix)) {
    $initial_prefix = '';
	$prefix = '';
} else {
    $initial_prefix = $prefix;
	$prefix = $prefix . '_';
}

if (! isset($enabled)) {
	$enabled = 'yes';
}

$inner_options = [
    $prefix . 'filters_panel_background_style' => [
        'label' => __('Panel style', 'blocksy'),
        'type' => 'ct-radio',
        'value' => 'boxed',
        'view' => 'text',
        'choices' => [
            'simple' => __('Simple', 'blocksy'),
            'boxed' => __('Boxed', 'blocksy')
        ]
    ],
    blocksy_rand_md5() => [
        'type' => 'ct-condition',
        'condition' => [
            $prefix . 'filters_as_modal'  => 'no',
            $prefix . 'display_filters_horizontally' => 'no'
        ],
        'options' => [
            $prefix . 'filters_panel_size' => [
                'label' => __( 'Panel size', 'tainacan-blocksy' ),
                'type' => 'ct-slider',
                'value' => '20%',
                'units' => blocksy_units_config([
                    [
                        'unit' => '%',
                        'min' => 10,
                        'max' => 80,
                    ]
                ]),
                'sync' => '',
                'divider' => 'bottom'
            ]
        ]
    ],
    $prefix . 'start_with_filters_hidden' => [
        'label' => __( 'Start with filters hidden', 'tainacan-blocksy' ),
        'type' => 'ct-switch',
        'value' => 'no',
        'desc' => __( 'Load page with filters panel initially hidden.', 'tainacan-blocksy' ),
        'sync' => ''
    ],
    $prefix . 'show_hide_filters_button' => [
        'label' => __( 'Show the "Hide filters" button', 'tainacan-blocksy' ),
        'type' => 'ct-switch',
        'value' => 'yes',
        'desc' => __( 'Display the button for hiding the filters panel.', 'tainacan-blocksy' ),
        'sync' => ''
    ],
    blocksy_rand_md5() => [
        'type' => 'ct-condition',
        'condition' => [
            $prefix . 'show_hide_filters_button'  => 'yes'
        ],
        'options' => [
            $prefix . 'show_filters_button_inside_search_control' => [
                'label' => __( 'Show filters button inside search control', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                
                'desc' => __( 'Display the filters button inside the search control bar instead of floating aside.', 'tainacan-blocksy' ),
                'sync' => ''
            ],
            $prefix . 'filters_as_modal' => [
                'label' => __( 'Filters as modal', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'no',
                'desc' => __( 'Display the filters panel as a full screen modal instead of aside, even on desktop.', 'tainacan-blocksy' ),
                'sync' => ''
            ]
        ],
    ],
    blocksy_rand_md5() => [
        'type' => 'ct-condition',
        'condition' => [
            $prefix . 'display_filters_horizontally'  => 'no',
            $prefix . 'filters_as_modal'  => 'no'
        ],
        'options' => [
            $prefix . 'filters_fixed_on_scroll' => [
                'label' => __( 'Filters fixed on scroll', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'no',
                'desc' => __( 'If you want filters panel to get fixed on screen when scrolling down the items list. This will only take effect if the items list itself is taller than the screen height.', 'tainacan-blocksy' ),
                'sync' => ''
            ],
        ]
    ]
];

if ( null !== TAINACAN_VERSION && version_compare( TAINACAN_VERSION, '0.21.7' ) >= 0  ) {
    $inner_options[ $prefix . 'hide_filters_area_header' ] = [
        'label' => __( 'Hide filters area header', 'tainacan-blocksy' ),
        'type' => 'ct-switch',
        'value' => 'no',
        'desc' => __( 'Toggle to not display the "Filter" label in the header of the filters area.', 'tainacan-blocksy' ),
        'sync' => ''
    ];
    $inner_options[ $prefix . 'hide_filter_collapses' ] = [
        'label' => __( 'Hide filter collapses', 'tainacan-blocksy' ),
        'type' => 'ct-switch',
        'value' => 'no',
        'desc' => __( 'Toggle to not display each filter label as a collapsable button. This is suggested when you have a small amount of filters.', 'tainacan-blocksy' ),
        'sync' => ''
    ];
    $inner_options = array_merge(
        $inner_options,
        [
            blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'filters_as_modal'  => 'no'
                ],
                'options' => [
                    $prefix . 'display_filters_horizontally' => [
                        'label' => __( 'Display filters horizontally', 'tainacan-blocksy' ),
                        'type' => 'ct-switch',
                        'value' => 'no',
                        'desc' => __( 'Toggle to show filters in an horizontal pane above the search control instead of a vertical sidebar. This layout fits better with select and textual input filters.', 'tainacan-blocksy' ),
                        'sync' => ''
                    ],
                    $prefix . 'should_not_hide_filters_on_mobile' => [
                        'label' => __( 'Should not hide filters even on mobile', 'tainacan-blocksy' ),
                        'type' => 'ct-switch',
                        'value' => 'no',
                        'desc' => __( 'Toggle to keep filters area visible even on small screen sizes.', 'tainacan-blocksy' ),
                        'sync' => ''
                    ],
                ]
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'display_filters_horizontally' => 'yes'
                ],
                'options' => [
                    $prefix . 'filters_inline_size' => [
                        'label' => __( 'Filters inline size', 'tainacan-blocksy' ),
                        'type' => 'ct-slider',
                        'value' => '272px',
                        'units' => blocksy_units_config([
                            [
                                'unit' => 'px',
                                'min' => 100,
                                'max' => 600,
                            ],
                            [
                                'unit' => 'vw',
                                'min' => 5,
                                'max' => 100,
                            ]
                        ]),
                        'sync' => '',
                    ]
                ]
            ],
            $prefix . 'filter_label_border' => [
                'label' => __( 'Filter label bottom border', 'blocksy' ),
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
                'sync' => ''
            ]
        ],
    );
}

$options = [
	$prefix . 'display_filters_panel' => [
		'label' => __( 'Filters panel', 'tainacan-blocksy' ),
		'type' => 'ct-panel',
		'switch' => true,
		'value' => $enabled,
		'sync' => '',
		'inner-options' => $inner_options
	]
];

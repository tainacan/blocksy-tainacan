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

$options = [
	$prefix . 'display_filters_panel' => [
		'label' => __( 'Filters panel', 'tainacan-blocksy' ),
		'type' => 'ct-panel',
		'switch' => true,
		'value' => $enabled,
		'sync' => '',
		'inner-options' => [
            $prefix . 'filters_panel_background_style' => [
                'label' => __('Panel style', 'blocksy'),
                'type' => 'ct-radio',
                'value' => 'boxed',
                'view' => 'text',
                'choices' => [
                    'simple' => __('Simple', 'blocksy'),
                    'boxed' => __('Boxed', 'blocksy'),
                ],
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'filters_as_modal'  => 'no'
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
                'desc' => __( 'Display the button for hidding the filters panel.', 'tainacan-blocksy' ),
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
                ],
            ],
            $prefix . 'filters_fixed_on_scroll' => [
                'label' => __( 'Filters fixed on scroll', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'no',
                'desc' => __( 'If you want filters panel to get fixed on screen when scrolling down the items list. This will only take effect if the items list itself is taller than the screen height.', 'tainacan-blocksy' ),
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
];

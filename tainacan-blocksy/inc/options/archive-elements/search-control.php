<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}


$options = [
	$prefix . 'search-control-panel' => [
		'label' => __( 'Search control', 'tainacan-blocksy' ),
		'type' => 'ct-panel',
		'sync' => '',
		'inner-options' => [
            blocksy_rand_md5() => [
                'type' => 'ct-title',
                'label' => __( 'Textual search', 'tainacan-blocksy' ),
            ],
            $prefix . 'show_search' => [
                'label' => __( 'Show simple search', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                                'desc' => __( 'Display a simple textual search input for items title and description.', 'tainacan-blocksy' ),
                'sync' => ''
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'show_search' => 'yes'
                ],
                'options' => [
                    $prefix . 'show_advanced_search' => [
                        'label' => __( 'Show advanced search', 'tainacan-blocksy' ),
                        'type' => 'ct-switch',
                        'value' => 'yes',
                        
                        'desc' => __( 'Display a link to open the advanced search panel.', 'tainacan-blocksy' ),
                        'sync' => ''
                    ],
                ],
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-title',
                'label' => __( 'Sorting', 'tainacan-blocksy' ),
            ],
            $prefix . 'show_sorting_area' => [
                'label' => __( 'Show sorting options', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                                'desc' => __( 'Display options related to the search such as the "Sort by" button and "Sort direction"', 'tainacan-blocksy' ),
                'sync' => ''
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'show_sorting_area' => 'yes'
                ],
                'options' => [
                    $prefix . 'show_sort_by_button' => [
                        'label' => __( 'Show "Sort by" button', 'tainacan-blocksy' ),
                        'type' => 'ct-switch',
                        'value' => 'yes',
                        
                        'desc' => __( 'Display the "Sort by" button, to select a metadata to sort by.', 'tainacan-blocksy' ),
                        'sync' => ''
                    ],
                ],
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-title',
                'label' => __( 'View modes', 'tainacan-blocksy' ),
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix !== 'tainacan-terms-items_archive_'
                ],
                'options' => blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/archive-elements/default-view-mode.php' , [
                    'prefix' => $prefix
                ], false)
            ],
            $prefix . 'show_inline_view_mode_options' => [
                'label' => __( 'Show inline view mode options', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'no',
                                'desc' => __( 'Display view mode options as inline buttons instead of a dropdown.', 'tainacan-blocksy' ),
                'sync' => ''
            ],
            $prefix . 'show_fullscreen_with_view_modes' => [
                'label' => __( 'Show full screen with view modes', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'no',
                                'desc' => __( 'Offers full screen view mode options alongside other view modes instead of separated in the search control bar.', 'tainacan-blocksy' ),
                'sync' => ''
            ],
            $prefix . 'show_displayed_metadata_dropdown' => [
                'label' => __( 'Show "Displayed metadata" dropdown', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                                'desc' => __( 'Display a dropdown for selecting the displayed metadata. This option may or not be present according to the current selected view mode.', 'tainacan-blocksy' ),
                'sync' => ''
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-title',
                'label' => __( 'Exposers', 'tainacan-blocksy' ),
            ],
            $prefix . 'show_exposers_button' => [
                'label' => __( 'Show "View as..." button', 'tainacan-blocksy' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                                'desc' => __( 'Display the "View as..." button, which opens the exposers modal.', 'tainacan-blocksy' ),
                'sync' => ''
            ],
		],
	],
];

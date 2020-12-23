<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$options = [
	$prefix . 'search-control-panel' => [
		'label' => __( 'Search control', 'blocksy-tainacan' ),
		'type' => 'ct-panel',
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [
            blocksy_rand_md5() => [
                'type' => 'ct-title',
                'label' => __( 'Textual search', 'blocksy-tainacan' ),
            ],
            $prefix . 'show_search' => [
                'label' => __( 'Show simple search', 'blocksy-tainacan' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                'setting' => [ 'transport' => 'postMessage' ],
                'desc' => __( 'Display a simple textual search input for items title and description.', 'blocksy-tainacan' ),
                'sync' => blocksy_sync_whole_page([
                    'prefix' => $prefix
                ])
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'show_search' => 'yes'
                ],
                'options' => [
                    $prefix . 'show_advanced_search' => [
                        'label' => __( 'Show advanced search', 'blocksy-tainacan' ),
                        'type' => 'ct-switch',
                        'value' => 'yes',
                        'setting' => [ 'transport' => 'postMessage' ],
                        'desc' => __( 'Display a link to open the advanced search panel.', 'blocksy-tainacan' ),
                        'sync' => blocksy_sync_whole_page([
                            'prefix' => $prefix
                        ])
                    ],
                ],
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-title',
                'label' => __( 'Sorting', 'blocksy-tainacan' ),
            ],
            $prefix . 'show_sorting_area' => [
                'label' => __( 'Show sorting options', 'blocksy-tainacan' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                'setting' => [ 'transport' => 'postMessage' ],
                'desc' => __( 'Display options related to the search such as the "Sort by" button and "Sort direction"', 'blocksy-tainacan' ),
                'sync' => blocksy_sync_whole_page([
                    'prefix' => $prefix
                ])
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'show_sorting_area' => 'yes'
                ],
                'options' => [
                    $prefix . 'show_sort_by_button' => [
                        'label' => __( 'Show "Sort by" button', 'blocksy-tainacan' ),
                        'type' => 'ct-switch',
                        'value' => 'yes',
                        'setting' => [ 'transport' => 'postMessage' ],
                        'desc' => __( 'Display the "Sort by" button, to select a metadata to sort by.', 'blocksy-tainacan' ),
                        'sync' => blocksy_sync_whole_page([
                            'prefix' => $prefix
                        ])
                    ],
                ],
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-title',
                'label' => __( 'View modes', 'blocksy-tainacan' ),
            ],
            $prefix . 'show_inline_view_mode_options' => [
                'label' => __( 'Show inline view mode options', 'blocksy-tainacan' ),
                'type' => 'ct-switch',
                'value' => 'no',
                'setting' => [ 'transport' => 'postMessage' ],
                'desc' => __( 'Display view mode options as inline buttons instead of a dropdown.', 'blocksy-tainacan' ),
                'sync' => blocksy_sync_whole_page([
                    'prefix' => $prefix
                ])
            ],
            $prefix . 'show_fullscreen_with_view_modes' => [
                'label' => __( 'Show full screen with view modes', 'blocksy-tainacan' ),
                'type' => 'ct-switch',
                'value' => 'no',
                'setting' => [ 'transport' => 'postMessage' ],
                'desc' => __( 'Offers full screen view mode options alongside other view modes instead of separated in the search control bar.', 'blocksy-tainacan' ),
                'sync' => blocksy_sync_whole_page([
                    'prefix' => $prefix
                ])
            ],
            $prefix . 'show_displayed_metadata_dropdown' => [
                'label' => __( 'Show "Displayed metadata" dropdown', 'blocksy-tainacan' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                'setting' => [ 'transport' => 'postMessage' ],
                'desc' => __( 'Display a dropdown for selecting the displayed metadata. This option may or not be present according to the current selected view mode.', 'blocksy-tainacan' ),
                'sync' => blocksy_sync_whole_page([
                    'prefix' => $prefix
                ])
            ],
            blocksy_rand_md5() => [
                'type' => 'ct-title',
                'label' => __( 'Exposers', 'blocksy-tainacan' ),
            ],
            $prefix . 'show_exposers_button' => [
                'label' => __( 'Show "View as..." button', 'blocksy-tainacan' ),
                'type' => 'ct-switch',
                'value' => 'yes',
                'setting' => [ 'transport' => 'postMessage' ],
                'desc' => __( 'Display the "View as..." button, which opens the exposers modal.', 'blocksy-tainacan' ),
                'sync' => blocksy_sync_whole_page([
                    'prefix' => $prefix
                ])
            ],
		],
	],
];

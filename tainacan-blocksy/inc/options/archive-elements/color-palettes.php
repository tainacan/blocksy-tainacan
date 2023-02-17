<?php

if (! isset($prefix)) {
	$prefix = '';
	$initial_prefix = '';
} else {
	$initial_prefix = $prefix;
	$prefix = $prefix . '_';
}

$options = [
	
	$prefix . 'items_list_background_palette' => [
		'label' => __( 'Background color palette', 'tainacan-blocksy' ),
		'type'  => 'ct-color-palettes-picker',
		'design' => 'block',
		// translators: The interpolations addes a html link around the word.
		'desc' => sprintf(
			__('Learn more about palettes and colors %shere%s.', 'blocksy'),
			'<a href="https://creativethemes.com/blocksy/docs/general-options/colors/" target="_blank">',
			'</a>'
		),
		'predefined' => true,
		'wrapperAttr' => [
			'data-type' => 'color-palette',
			'data-label' => 'heading-label'
		],
		'value' => [
			'color1' => [ 'color' => 'var(--background-color, #f8f9fb)' ],
			'color2' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
			'color3' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
			'color4' => [ 'color' => 'var(--form-field-initial-background, #ffffff)' ],
			'color5' => [ 'color' => 'var(--form-field-border-initial-color, #e0e5eb)' ],
			'color6' => [ 'color' => 'var(--form-field-border-initial-color, #e0e5eb)' ],

			'current_palette' => 'palette-1',

			'palettes' => [
				[
					'id' => 'palette-1',

					'color1' => [ 'color' => 'var(--background-color, #f8f9fb)' ],
					'color2' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
					'color3' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
					'color4' => [ 'color' => 'var(--form-field-initial-background, #ffffff)' ],
					'color5' => [ 'color' => 'var(--form-field-border-initial-color, #e0e5eb)' ],
					'color6' => [ 'color' => 'var(--form-field-border-initial-color, #e0e5eb)' ],

				],

				[
					'id' => 'palette-2',

					'color1' => [ 'color' => '#dfd9cd' ],
					'color2' => [ 'color' => '#ece6db' ],
					'color3' => [ 'color' => '#f4eee2' ],
					'color4' => [ 'color' => '#f4eee2' ],
					'color5' => [ 'color' => '#dfd9cd' ],
					'color6' => [ 'color' => '#d0bf9f' ],

				],

				[
					'id' => 'palette-3',

					'color1' => [ 'color' => '#1e1e1e' ],
					'color2' => [ 'color' => '#282828' ],
					'color3' => [ 'color' => '#333333' ],
					'color4' => [ 'color' => '#333333' ],
					'color5' => [ 'color' => '#3eaf7c' ],
					'color6' => [ 'color' => '#1a1a1a' ]
					
				]
			]
		],
		'sync' => '',
    ],
    
    $prefix . 'items_list_text_palette' => [
		'label' => __( 'Text color palette', 'tainacan-blocksy' ),
		'type'  => 'ct-color-palettes-picker',
		'design' => 'block',
		// translators: The interpolations addes a html link around the word.
		'desc' => sprintf(
			__('Learn more about palettes and colors %shere%s.', 'blocksy'),
			'<a href="https://creativethemes.com/blocksy/docs/general-options/colors/" target="_blank">',
			'</a>'
		),
		'predefined' => true,
		'wrapperAttr' => [
			'data-type' => 'color-palette',
			'data-label' => 'heading-label'
		],
		'value' => [
			'color1' => [ 'color' => 'var(--paletteColor1,#3eaf7c)' ],
			'color2' => [ 'color' => 'var(--headingColor, rgba(44, 62, 80, 1))' ],
			'color3' => [ 'color' => 'var(--color, #454647)' ],
			'color4' => [ 'color' => '#555758' ],
			'color5' => [ 'color' => 'var(--formTextInitialColor, #454647)' ],
			'current_palette' => 'palette-1',
			'palettes' => [
				[
					'id' => 'palette-1',
					'color1' => [ 'color' => 'var(--paletteColor1,#3eaf7c)' ],
					'color2' => [ 'color' => 'var(--headingColor, rgba(44, 62, 80, 1))' ],
					'color3' => [ 'color' => 'var(--color, #454647)' ],
					'color4' => [ 'color' => '#555758' ],
					'color5' => [ 'color' => 'var(--formTextInitialColor, #454647)' ]

				],

				[
					'id' => 'palette-2',

					'color1' => [ 'color' => '#795040' ],
					'color2' => [ 'color' => 'rgb(80, 54, 44)' ],
					'color3' => [ 'color' => '#474545' ],
					'color4' => [ 'color' => '#585655' ],
					'color5' => [ 'color' => '#474545' ]

				],

				[
					'id' => 'palette-3',

					'color1' => [ 'color' => '#3eaf7c' ],
					'color2' => [ 'color' => 'rgb(207, 216, 225)' ],
					'color3' => [ 'color' => '#f0f0f0' ],
					'color4' => [ 'color' => '#c8c8c8' ],
					'color5' => [ 'color' => '#f0f0f0' ]
					
				]
			]
		],
		'sync' => '',
	]
];

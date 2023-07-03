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
			'color4' => [ 'color' => 'var(--theme-form-field-background-initial-color, var(--form-field-background-initial-color, #ffffff))' ],
			'color5' => [ 'color' => 'var(--theme-form-field-border-initial-color, var(--form-field-border-initial-color, #e0e5eb))' ],
			'color6' => [ 'color' => 'var(--theme-form-field-border-initial-color, var(--form-field-border-initial-color, #e0e5eb))' ],

			'current_palette' => 'palette-1',
		],
		'palettes' => [
			[
				'id' => 'palette-1',

				'color1' => [ 'color' => 'var(--background-color, #f8f9fb)' ],
				'color2' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
				'color3' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
				'color4' => [ 'color' => 'var(--theme-form-field-background-initial-color, var(--form-field-background-initial-color, #ffffff))' ],
				'color5' => [ 'color' => 'var(--theme-form-field-border-initial-color, var(--form-field-border-initial-color, #e0e5eb))' ],
				'color6' => [ 'color' => 'var(--theme-form-field-border-initial-color, var(--form-field-border-initial-color, #e0e5eb))' ],

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
			'color1' => [ 'color' => 'var(--theme-palette-color-1, var(--paletteColor1, #3eaf7c))' ],
			'color2' => [ 'color' => 'var(--theme-heading-color, var(--headingColor, rgba(44, 62, 80, 1)))' ],
			'color3' => [ 'color' => 'var(--theme-text-color, var(--color, #373839))' ],
			'color4' => [ 'color' => '#505253' ],
			'color5' => [ 'color' => 'var(--theme-form-text-initial-color, var(--formTextInitialColor, #373839))' ],
			'current_palette' => 'palette-1'
		],
		'palettes' => [
			[
				'id' => 'palette-1',
				'color1' => [ 'color' => 'var(--theme-palette-color-1, var(--paletteColor1, #3eaf7c))' ],
				'color2' => [ 'color' => 'var(--theme-heading-color, var(--headingColor, rgba(44, 62, 80, 1)))' ],
				'color3' => [ 'color' => 'var(--theme-text-color, var(--color, #373839))' ],
				'color4' => [ 'color' => '#505253' ],
				'color5' => [ 'color' => 'var(--theme-form-text-initial-color, var(--formTextInitialColor, #373839))' ]

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
		],
		'sync' => '',
	]
];

/* Backwards compatibility with previous palette settings */
$blocksy_theme_version = is_child_theme() ? wp_get_theme()->parent()->get( 'Version' ) : wp_get_theme()->get( 'Version' );
if ( $blocksy_theme_version <= '1.9' ) {
	
	$options[$prefix . 'items_list_background_palette']['value']['palettes'] = $options[$prefix . 'items_list_background_palette']['palettes'];
	unset($options[$prefix . 'items_list_background_palette']['palettes']);

	$options[$prefix . 'items_list_text_palette']['value']['palettes'] = $options[$prefix . 'items_list_text_palette']['palettes'];
	unset($options[$prefix . 'items_list_text_palette']['palettes']);
}
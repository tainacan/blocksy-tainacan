<?php

if (! isset($prefix)) {
	$prefix = '';
}

$inner_options = [
	$prefix . 'document_attachments_colors' => [
		'label' => __( 'Color palette for the media above title', 'tainacan-blocksy' ),
		'type'  => 'ct-color-palettes-picker',
		'design' => 'block',
		'predefined' => true,
		'wrapperAttr' => [
			'data-type' => 'color-palette',
			'data-label' => 'media-component-colors'
		],
		'value' => [
			'color1' => [ 'color' => 'var(--theme-palette-color-6, var(--paletteColor6, #edeff2))' ],
			'color2' => [ 'color' => 'var(--theme-palette-color-4, var(--paletteColor4, 2c3e50))' ],
			'color3' => [ 'color' => 'var(--theme-palette-color-1, var(--paletteColor1, #3eaf7c))' ],

			'current_palette' => 'palette-1',
		],
		'palettes' => [
			[
				'id' => 'palette-1',

				'color1' => [ 'color' => 'var(--theme-palette-color-6, var(--paletteColor6, #edeff2))' ],
				'color2' => [ 'color' => 'var(--theme-palette-color-4, var(--paletteColor4, 2c3e50))' ],
				'color3' => [ 'color' => 'var(--theme-palette-color-1, var(--paletteColor1, #3eaf7c))' ]

			],

			[
				'id' => 'palette-2',

				'color1' => [ 'color' => 'var(--theme-palette-color-3, var(--paletteColor3, #415161))' ],
				'color2' => [ 'color' => 'var(--theme-palette-color-4, var(--paletteColor4, 2c3e50))' ],
				'color3' => [ 'color' => 'var(--theme-palette-color-6, var(--paletteColor6, #edeff2))' ]

			]
		],
		'sync' => '',
	]
];

/* Backwards compatibility with previous palette settings */
if ( wp_get_theme()->get('Version') <= '1.9' ) {
	
	$inner_options[$prefix . 'document_attachments_colors']['value']['palettes'] = $inner_options[$prefix . 'document_attachments_colors']['palettes'];
	unset($inner_options[$prefix . 'document_attachments_colors']['palettes']);
}

$options = [
	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'page_structure_type' => 'type-gtm'
		],
		'options' => $inner_options
    ]
];

<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$options = [	
	$prefix . 'structure' => [
		'label' => false,
		'type' => 'ct-image-picker',
		'value' => 'simple',
		'divider' => 'bottom',
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
			'loader_selector' => '.entries > article'
		]),
		'choices' => [
			'simple' => [
				'src' => blocksy_image_picker_url('simple.svg'),
				'title' => __('Simple', 'blocksy'),
			],

			// 'classic' => [
			// 	'src' => blocksy_image_picker_url('classic.svg'),
			// 	'title' => __('Classic', 'blocksy'),
			// ],

			'grid' => [
				'src' => blocksy_image_picker_url('grid.svg'),
				'title' => __('Grid', 'blocksy'),
			],
		]
	],

	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [ $prefix . 'structure' => '!grid' ],
		'options' => [

			$prefix . 'archive_per_page' => [
				'label' => __( 'Number of terms', 'tainacan-blocksy' ),
				'type' => 'ct-number',
				'value' => get_option('posts_per_page', 12),
				'min' => 1,
				'max' => 500,
				'design' => 'inline',
				'sync' => blocksy_sync_whole_page([
					'prefix' => $prefix,
					'loader_selector' => '.entries > article'
				]),
			],

		],
	],

	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [ $prefix . 'structure' => 'grid' ],
		'options' => [

			blocksy_rand_md5() => [
				'type' => 'ct-group',
				'label' => __( 'Columns & Terms', 'tainacan-blocksy' ),
				'attr' => [ 'data-columns' => '2:medium' ],
				'responsive' => true,
				'options' => [

					$prefix . 'columns' => [
						'label' => false,
						'desc' => __( 'Number of columns', 'blocksy' ),
						'type' => 'ct-number',
						'value' => [
							'desktop' => 3,
							'tablet' => 2,
							'mobile' => 1
						],
						'min' => 1,
						'max' => 6,
						'design' => 'block',
						'disableRevertButton' => true,
						'attr' => [ 'data-width' => 'full' ],
						'sync' => 'live',
						'responsive' => true,
						'skipResponsiveControls' => true
					],

					$prefix . 'archive_per_page' => [
						'label' => false,
						'desc' => __( 'Number of terms', 'tainacan-blocksy' ),
						'type' => 'ct-number',
						'value' => get_option('posts_per_page', 12),
						'min' => 1,
						'max' => 200,
						'markAsAutoFor' => ['tablet', 'mobile'],
						'design' => 'block',
						'disableRevertButton' => true,
						'attr' => [ 'data-width' => 'full' ],
						'sync' => blocksy_sync_whole_page([
							'prefix' => $prefix,
							'loader_selector' => '.entries > article'
						]),
					],

				],
			],

		],
	],

	blocksy_rand_md5() => [
		'type' => 'ct-divider',
		'attr' => ['data-type' => 'small']
	],

	$prefix . 'archive_listing_panel' => [
		'label' => __('Cards Options', 'blocksy'),
		'type' => 'ct-panel',
		'value' => 'yes',
		'wrapperAttr' => ['data-panel' => 'only-arrow'],
		'inner-options' => blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/term-card-options.php', [
			'prefix' => $prefix
		], false),
	],
];
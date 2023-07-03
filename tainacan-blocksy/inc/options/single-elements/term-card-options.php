<?php

if (! isset($is_cpt)) {
	$is_cpt = true;
}

if (! isset($prefix)) {
	$prefix = '';
}

if (! isset($title)) {
	$title = __('Taxonomy', 'tainacan');
}

$has_card_matching_template = (
	function_exists('blc_get_content_block_that_matches')
	&&
	blc_get_content_block_that_matches([
		'template_type' => 'archive',
		'template_subtype' => 'card',
		'match_conditions_strategy' => rtrim($prefix, '_')
	])
);

$options = [	
	blocksy_rand_md5() => [
		'title' => __('General', 'blocksy'),
		'type' => 'tab',
		'options' => [
			[
				blocksy_rand_md5() => [
					'type' => 'ct-condition',
					'condition' => [
						$prefix . 'structure' => '!gutenberg'
					],
					'perform_replace' => $has_card_matching_template ? [
						[
							'condition' => [
								$prefix . 'structure' => '!__never__'
							],
							'key' => $prefix . 'structure',
							'from' => 'simple',
							'to' => 'grid'
						],

						[
							'condition' => [
								$prefix . 'structure' => '!__never__'
							],
							'key' => $prefix . 'structure',
							'from' => 'gutenberg',
							'to' => 'grid'
						]
					] : [],

					'options' => [
						$prefix . 'card_type' => [
							'label' => __('Card Type', 'blocksy'),
							'type' => 'ct-radio',
							'value' => 'boxed',
							'view' => 'text',
							'divider' => 'bottom:full',
							'choices' => [
								'simple' => __('Simple', 'blocksy'),
								'boxed' => __('Boxed', 'blocksy'),
								'cover' => __('Cover', 'blocksy'),
							],
							'conditions' => [
								'cover' => $has_card_matching_template ? [
									$prefix . 'structure' => '__never__'
								] : [
									$prefix . 'structure' => '!simple'
								]
							],
							'sync' => blocksy_sync_whole_page([
								'prefix' => $prefix,
								'loader_selector' => '.entries > article[id]'
							])
						],
					],
				],
			],

			[
				$prefix . 'archive_order' => apply_filters('blocksy:options:posts-listing-archive-order', [
					'label' => __('Card Elements', 'blocksy'),
					'type' => $has_card_matching_template ? 'hidden' : 'ct-layers',
					'disableDrag' => true,
					'sync' => '',

					'value' => [
						[
							'id' => 'featured_image',
							'is_boundless' => 'yes',
							'image_size' => 'medium_large',
							'enabled' => true,
						],

						[
							'id' => 'hierarchy_path',
							'enabled' => false
						],

						[
							'id' => 'title',
							'heading_tag' => 'h2',
							'enabled' => true,
						],


						[
							'id' => 'excerpt',
							'excerpt_length' => 20,
							'enabled' => true,
						],

						[
							'id' => 'children_link',
							'enabled' => true
						],

						[
							'id' => 'items_link',
							'enabled' => true
						]
					],

					'settings' => [
						
						'hierarchy_path' => [
							'label' => __('Hierarchy path', 'blocksy'),
							'sync' => blocksy_sync_whole_page([
								'prefix' => $prefix,
								'loader_selector' => '.entries > article[id]'
							])
						],

						'title' => [
							'label' => __('Title', 'blocksy'),
							'options' => [

								'heading_tag' => [
									'label' => __('Heading tag', 'blocksy'),
									'type' => 'ct-select',
									'value' => 'h2',
									'view' => 'text',
									'design' => 'inline',
									'sync' => [
										'id' => $prefix . 'archive_order_heading_tag',
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
									),
								],

							],
						],

						'featured_image' => [
							'label' => __('Featured Image', 'blocksy'),
							'options' => [

								'image_hover_effect' => [
									'label' => __( 'Hover Effect', 'blocksy' ),
									'type' => 'ct-select',
									'value' => 'none',
									'view' => 'text',
									'design' => 'inline',
									'setting' => [ 'transport' => 'postMessage' ],
									'choices' => blocksy_ordered_keys(
										[
											'none' => __( 'None', 'blocksy' ),
											'zoom-in' => __( 'Zoom In', 'blocksy' ),
											'zoom-out' => __( 'Zoom Out', 'blocksy' ),
										]
									)
								],

								'image_size' => [
									'label' => __('Size', 'blocksy'),
									'type' => 'ct-select',
									'value' => 'tainacan-large-full',
									'view' => 'text',
									'design' => 'inline',
									'sync' => [
										'id' => $prefix . 'archive_order_image',
									],
									'choices' => blocksy_ordered_keys(
										blocksy_get_all_image_sizes()
									),
								],

								blocksy_rand_md5() => [
									'type' => 'ct-condition',
									'condition' => [
										$prefix . 'card_type' => 'boxed',
										$prefix . 'structure' => '!gutenberg'
									],
									'values_source' => 'global',
									'perform_replace' => $has_card_matching_template ? [
										[
											'condition' => [
												$prefix . 'structure' => '!__never__'
											],
											'key' => $prefix . 'structure',
											'from' => 'simple',
											'to' => 'grid'
										],

										[
											'condition' => [
												$prefix . 'structure' => '!__never__'
											],
											'key' => $prefix . 'structure',
											'from' => 'gutenberg',
											'to' => 'grid'
										]
									] : [],
									'options' => [
										'is_boundless' => [
											'label' => __('Boundless Image', 'blocksy'),
											'type' => 'ct-switch',
											'sync' => [
												'id' => $prefix . 'archive_order_skip',
											],
											'value' => 'yes',
										],
									],
								],

							],
						],

						'excerpt' => [
							'label' => __('Description', 'tainacan-blocksy'),
							'options' => [
								'excerpt_length' => [
									'label' => __('Length', 'blocksy'),
									'type' => 'ct-number',
									'design' => 'inline',
									'value' => 40,
									'min' => 1,
									'max' => 300,
								],
							],
						],

						'children_link' => [
							'label' => __('Children link', 'blocksy'),
							'options' => [
								'show_term_children_count' => [
									'label' => __('Display children count', 'tainacan-blocksy'),
									'type' => 'ct-switch',
									'value' => 'no',
								],
							],
						],

						'items_link' => [
							'label' => __('Items link', 'blocksy'),
							'options' => [
								'show_term_items_count' => [
									'label' => __('Display items count', 'tainacan-blocksy'),
									'type' => 'ct-switch',
									'value' => 'no',
								],
							],
						]
					],
				], trim($prefix, '_')),

			],

			$has_card_matching_template ? [] : [
				blocksy_rand_md5() => [
					'type' => 'ct-divider',
				],
			],

			[
				blocksy_rand_md5() => [
					'type' => 'ct-condition',
					'condition' => [
						$prefix . 'card_type' => 'cover',
						$prefix . 'structure' => '!gutenberg'
					],
					'perform_replace' => array_merge([
						'condition' => $has_card_matching_template ? [
							$prefix . 'structure' => '!__never__'
						] : [
							$prefix . 'structure' => 'simple'
						],
						'key' => $prefix . 'card_type',
						'from' => 'cover',
						'to' => 'boxed'
					], $has_card_matching_template ? [
						[
							'condition' => [
								$prefix . 'structure' => '!__never__'
							],
							'key' => $prefix . 'structure',
							'from' => 'simple',
							'to' => 'grid'
						],

						[
							'condition' => [
								$prefix . 'structure' => '!__never__'
							],
							'key' => $prefix . 'structure',
							'from' => 'gutenberg',
							'to' => 'grid'
						]
					] : []),
					'options' => [
						$prefix . 'card_min_height' => [
							'label' => __( 'Card Min Height', 'blocksy' ),
							'type' => 'ct-slider',
							'min' => 0,
							'max' => 1000,
							'responsive' => true,
							'sync' => 'live',
							'value' => 400,
							'divider' => 'bottom',
						],
					],
				],

				$prefix . 'cardsGap' => [
					'label' => __( 'Cards Gap', 'blocksy' ),
					'type' => 'ct-slider',
					'min' => 0,
					'max' => 100,
					'responsive' => true,
					'sync' => 'live',
					'value' => 30,
				],

				$prefix . 'card_spacing' => [
					'label' => __( 'Card Inner Spacing', 'blocksy' ),
					'type' => 'ct-slider',
					'min' => 0,
					'max' => 100,
					'responsive' => true,
					'value' => 30,
					'divider' => 'top',
					'sync' => 'live',
				],
			],

			$has_card_matching_template ? [] : [
				$prefix . 'content_horizontal_alignment' => [
					'type' => $has_card_matching_template ? 'hidden' : 'ct-radio',
					'label' => __( 'Content Alignment', 'blocksy' ),
					'view' => 'text',
					'design' => 'block',
					'divider' => 'top',
					'responsive' => true,
					'attr' => [ 'data-type' => 'alignment' ],
					'setting' => [ 'transport' => 'postMessage' ],
					'value' => 'CT_CSS_SKIP_RULE',
					'choices' => [
						'left' => '',
						'center' => '',
						'right' => '',
					],
				],
			],

			blocksy_rand_md5() => [
				'type' => 'ct-condition',
				'condition' => [
					$prefix . 'structure' => '!gutenberg'
				],
				'perform_replace' => $has_card_matching_template ? [
					[
						'condition' => [
							$prefix . 'structure' => '!__never__'
						],
						'key' => $prefix . 'structure',
						'from' => 'simple',
						'to' => 'grid'
					],

					[
						'condition' => [
							$prefix . 'structure' => '!__never__'
						],
						'key' => $prefix . 'structure',
						'from' => 'gutenberg',
						'to' => 'grid'
					]
				] : [],
				'options' => $has_card_matching_template ? [] : [
					$prefix . 'content_vertical_alignment' => [
						'type' => 'ct-radio',
						'label' => __( 'Vertical Alignment', 'blocksy' ),
						'view' => 'text',
						'design' => 'block',
						'divider' => 'top',
						'responsive' => true,
						'attr' => [ 'data-type' => 'vertical-alignment' ],
						'setting' => [ 'transport' => 'postMessage' ],
						'value' => 'CT_CSS_SKIP_RULE',
						'choices' => [
							'flex-start' => '',
							'center' => '',
							'flex-end' => '',
						],
					],
				],
			],

		],
	],

	blocksy_rand_md5() => [
		'title' => __( 'Design', 'blocksy' ),
		'type' => 'tab',
		'options' => apply_filters('blocksy:options:posts-listing:design', [
			[
				blocksy_rand_md5() => [
					'type' => 'ct-condition',
					'condition' => [
						$prefix . 'archive_order:array-ids:title:enabled' => '!no'
					],
					'options' => [
						$prefix . 'cardTitleFont' => [
							'type' => 'ct-typography',
							'label' => __( 'Title Font', 'blocksy' ),
							'sync' => 'live',
							'value' => blocksy_typography_default_values([
								'size' => [
									'desktop' => '20px',
									'tablet'  => '20px',
									'mobile'  => '18px'
								],
								'line-height' => '1.3'
							]),
						],

						$prefix . 'cardTitleColor' => [
							'label' => __( 'Title Font Color', 'blocksy' ),
							'type'  => 'ct-color-picker',
							'sync' => 'live',
							'design' => 'inline',

							'value' => [
								'default' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],

								'hover' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],
							],

							'pickers' => [
								[
									'title' => __( 'Initial', 'blocksy' ),
									'id' => 'default',
									'inherit' => [
										'var(--theme-heading-1-color, var(--theme-headings-color, var(--headings-color)))' => [
											$prefix . 'archive_order:array-ids:title:heading_tag' => 'h1'
										],

										'var(--theme-heading-2-color, var(--theme-headings-color, var(--headings-color)))' => [
											$prefix . 'archive_order:array-ids:title:heading_tag' => 'h2'
										],

										'var(--theme-heading-3-color, var(--theme-headings-color, var(--headings-color)))' => [
											$prefix . 'archive_order:array-ids:title:heading_tag' => 'h3'
										],

										'var(--theme-heading-4-color, var(--theme-headings-color, var(--headings-color)))' => [
											$prefix . 'archive_order:array-ids:title:heading_tag' => 'h4'
										],

										'var(--theme-heading-5-color, var(--theme-headings-color, var(--headings-color)))' => [
											$prefix . 'archive_order:array-ids:title:heading_tag' => 'h5'
										],

										'var(--theme-heading-6-color, var(--theme-headings-color, var(--headings-color)))' => [
											$prefix . 'archive_order:array-ids:title:heading_tag' => 'h6'
										]
									]
								],

								[
									'title' => __( 'Hover', 'blocksy' ),
									'id' => 'hover',
									'inherit' => 'var(--theme-link-hover-color, var(--link-hover-color))'
								],
							],
						],

						blocksy_rand_md5() => [
							'type' => 'ct-divider',
						],

					],
				],

				blocksy_rand_md5() => [
					'type' => 'ct-condition',
					'condition' => [
						$prefix . 'archive_order:array-ids:excerpt:enabled' => '!no'
					],
					'options' => [

						$prefix . 'cardExcerptFont' => [
							'type' => 'ct-typography',
							'label' => __( 'Excerpt Font', 'blocksy' ),
							'sync' => 'live',
							'value' => blocksy_typography_default_values([]),
						],

						$prefix . 'cardExcerptColor' => [
							'label' => __( 'Excerpt Color', 'blocksy' ),
							'type'  => 'ct-color-picker',
							'design' => 'inline',
							'noColor' => [ 'background' => 'var(--theme-text-color, var(--color))'],
							'sync' => 'live',
							'value' => [
								'default' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],
							],

							'pickers' => [
								[
									'title' => __( 'Initial', 'blocksy' ),
									'id' => 'default',
									'inherit' => 'var(--theme-text-color, var(--color))'
								],
							],
						],

						blocksy_rand_md5() => [
							'type' => 'ct-divider',
						],

					],
				],

				$prefix . 'cardMetaFont' => [
					'type' => 'ct-typography',
					'label' => __( 'Meta Font', 'blocksy' ),
					'sync' => 'live',
					'value' => blocksy_typography_default_values([
						'size' => [
							'desktop' => '12px',
							'tablet'  => '12px',
							'mobile'  => '12px'
						],
						'variation' => 'n6',
						'text-transform' => 'uppercase',
					]),
				],

				$prefix . 'cardMetaColor' => [
					'label' => __( 'Meta Font Color', 'blocksy' ),
					'type'  => 'ct-color-picker',
					'design' => 'inline',
					'noColor' => [ 'background' => 'var(--theme-text-color, var(--color))'],
					'sync' => 'live',
					'value' => [
						'default' => [
							'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
						],

						'hover' => [
							'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
						],
					],

					'pickers' => [
						[
							'title' => __( 'Initial', 'blocksy' ),
							'id' => 'default',
							'inherit' => 'var(--theme-text-color, var(--color))'
						],

						[
							'title' => __( 'Hover', 'blocksy' ),
							'id' => 'hover',
							'inherit' => 'var(--theme-link-hover-color, var(--link-hover-color))'
						],
					],
				],

				blocksy_rand_md5() => [
					'type' => 'ct-has-meta-category-button',
					'optionId' => $prefix . 'archive_order',
					'options' => [
						$prefix . 'card_meta_button_type_font_colors' => [
							'label' => __( 'Meta Button Font', 'blocksy' ),
							'type'  => 'ct-color-picker',
							'design' => 'inline',
							'divider' => 'top',
							'noColor' => [ 'background' => 'var(--theme-text-color, var(--color))'],
							'sync' => 'live',
							'value' => [
								'default' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],

								'hover' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],
							],

							'pickers' => [
								[
									'title' => __( 'Initial', 'blocksy' ),
									'id' => 'default',
									'inherit' => 'var(--theme-button-text-initial-color, var(--buttonInitialColor))'
								],

								[
									'title' => __( 'Hover', 'blocksy' ),
									'id' => 'hover',
									'inherit' => 'var(--theme-button-text-hover-color, var(--buttonHoverColor))'
								],
							],
						],

						$prefix . 'card_meta_button_type_background_colors' => [
							'label' => __( 'Meta Button Background', 'blocksy' ),
							'type'  => 'ct-color-picker',
							'design' => 'inline',
							'noColor' => [ 'background' => 'var(--theme-text-color, var(--color))'],
							'sync' => 'live',
							'value' => [
								'default' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],

								'hover' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],
							],

							'pickers' => [
								[
									'title' => __( 'Initial', 'blocksy' ),
									'id' => 'default',
									'inherit' => 'var(--theme-button-background-initial-color, var(--buttonInitialColor))'
								],

								[
									'title' => __( 'Hover', 'blocksy' ),
									'id' => 'hover',
									'inherit' => 'var(--theme-button-background-hover-color, var(--buttonHoverColor))'
								],
							],
						],
					]
				],

				blocksy_rand_md5() => [
					'type' => 'ct-condition',
					'condition' => [
						$prefix . 'archive_order:array-ids:read_more:button_type' => 'simple',
						$prefix . 'archive_order:array-ids:read_more:enabled' => '!no'
					],
					'options' => [

						blocksy_rand_md5() => [
							'type' => 'ct-divider',
						],

						$prefix . 'cardButtonSimpleTextColor' => [
							'label' => __( 'Button Font Color', 'blocksy' ),
							'sync' => 'live',
							'type'  => 'ct-color-picker',
							'design' => 'inline',

							'value' => [
								'default' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],

								'hover' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],
							],

							'pickers' => [
								[
									'title' => __( 'Initial', 'blocksy' ),
									'id' => 'default',
									'inherit' => 'var(--theme-link-initial-color, var(--linkInitialColor))'
								],

								[
									'title' => __( 'Hover', 'blocksy' ),
									'id' => 'hover',
									'inherit' => 'var(--theme-link-hover-color, var(--linkHoverColor))'
								],
							],
						],

					],
				],

				blocksy_rand_md5() => [
					'type' => 'ct-condition',
					'condition' => [
						$prefix . 'archive_order:array-ids:read_more:button_type' => 'background',
						$prefix . 'archive_order:array-ids:read_more:enabled' => '!no'
					],
					'options' => [

						blocksy_rand_md5() => [
							'type' => 'ct-divider',
						],

						$prefix . 'cardButtonBackgroundTextColor' => [
							'label' => __( 'Button Font Color', 'blocksy' ),
							'sync' => 'live',
							'type'  => 'ct-color-picker',
							'design' => 'inline',

							'value' => [
								'default' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],

								'hover' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],
							],

							'pickers' => [
								[
									'title' => __( 'Initial', 'blocksy' ),
									'id' => 'default',
									'inherit' => 'var(--theme-button-text-initial-color, var(--buttonInitialColor))'
								],

								[
									'title' => __( 'Hover', 'blocksy' ),
									'id' => 'hover',
									'inherit' => 'var(--theme-button-text-hover-color, var(--buttonHoverColor))'
								],
							],
						],

					],
				],

				blocksy_rand_md5() => [
					'type' => 'ct-condition',
					'condition' => [
						$prefix . 'archive_order:array-ids:read_more:button_type' => 'outline',
						$prefix . 'archive_order:array-ids:read_more:enabled' => '!no'
					],
					'options' => [

						blocksy_rand_md5() => [
							'type' => 'ct-divider',
						],

						$prefix . 'cardButtonOutlineTextColor' => [
							'label' => __( 'Button Font Color', 'blocksy' ),
							'type'  => 'ct-color-picker',
							'sync' => 'live',
							'design' => 'inline',

							'value' => [
								'default' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],

								'hover' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],
							],

							'pickers' => [
								[
									'title' => __( 'Initial', 'blocksy' ),
									'id' => 'default',
									'inherit' => 'var(--theme-link-initial-color, var(--linkInitialColor))'
								],
								[
									'title' => __( 'Hover', 'blocksy' ),
									'id' => 'hover',
									'inherit' => 'var(--theme-link-hover-color, var(--linkHoverColor))'
								],
							],
						],

					],
				],

				blocksy_rand_md5() => [
					'type' => 'ct-condition',
					'condition' => [
						$prefix . 'archive_order:array-ids:read_more:button_type' => '!simple',
						$prefix . 'archive_order:array-ids:read_more:enabled' => '!no'
					],
					'options' => [

						$prefix . 'cardButtonColor' => [
							'label' => __( 'Button Color', 'blocksy' ),
							'sync' => 'live',
							'type'  => 'ct-color-picker',
							'design' => 'inline',

							'value' => [
								'default' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],

								'hover' => [
									'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT'),
								],
							],

							'pickers' => [
								[
									'title' => __( 'Initial', 'blocksy' ),
									'id' => 'default',
									'inherit' => 'var(--theme-button-background-initial-color, var(--buttonInitialColor))'
								],

								[
									'title' => __( 'Hover', 'blocksy' ),
									'id' => 'hover',
									'inherit' => 'var(--theme-button-background-hover-color, var(--buttonHoverColor))'
								],
							],
						],

					],
				],

				blocksy_rand_md5() =>  [
					'type' => 'ct-condition',
					'condition' => [
						$prefix . 'card_type' => 'simple',
						$prefix . 'archive_order:array-ids:featured_image:enabled' => '!no'
					],
					'options' => [

						blocksy_rand_md5() => [
							'type' => 'ct-divider',
						],

						$prefix . 'cardThumbRadius' => [
							'label' => __( 'Featured Image Radius', 'blocksy' ),
							'type' => 'ct-spacing',
							'sync' => 'live',
							'value' => blocksy_spacing_value([
								'linked' => true,
							]),
							'responsive' => true
						],

						$prefix . 'cardDivider' => [
							'label' => __( 'Card bottom divider', 'blocksy' ),
							'type' => 'ct-border',
							'sync' => 'live',
							'design' => 'inline',
							'divider' => 'top',
							'value' => [
								'width' => 1,
								'style' => 'dashed',
								'color' => [
									'color' => 'rgba(224, 229, 235, 0.8)',
								],
							]
						],
					],
				],

				blocksy_rand_md5() => [
					'type' => 'ct-condition',
					'condition' => [
						$prefix . 'archive_order:array-ids:divider:enabled' => '!no'

					],
					'options' => [
						blocksy_rand_md5() => [
							'type' => 'ct-divider',
						],

						$prefix . 'entryDivider' => [
							'label' => __( 'Card Divider', 'blocksy' ),
							'type' => 'ct-border',
							'sync' => 'live',
							'design' => 'inline',
							'value' => [
								'width' => 1,
								'style' => 'solid',
								'color' => [
									'color' => 'rgba(224, 229, 235, 0.8)',
								],
							]
						],
					],
				],
			],

			apply_filters(
				'blocksy:options:posts-listing:design:before_card_background',
				[],
				trim($prefix, '_')
			),

			blocksy_rand_md5() => [
				'type' => 'ct-condition',
				'condition' => [
					$prefix . 'card_type' => 'boxed|cover',
					$prefix . 'structure' => '!gutenberg'
				],
				'perform_replace' => array_merge([
					'condition' => $has_card_matching_template ? [
						$prefix . 'structure' => '!__never__'
					] : [
						$prefix . 'structure' => 'simple'
					],
					'key' => $prefix . 'card_type',
					'from' => 'cover',
					'to' => 'boxed'
				], $has_card_matching_template ? [
					[
						'condition' => [
							$prefix . 'structure' => '!__never__'
						],
						'key' => $prefix . 'structure',
						'from' => 'simple',
						'to' => 'grid'
					],

					[
						'condition' => [
							$prefix . 'structure' => '!__never__'
						],
						'key' => $prefix . 'structure',
						'from' => 'gutenberg',
						'to' => 'grid'
					]
				] : []),
				'options' => [

					blocksy_rand_md5() => [
						'type' => 'ct-divider',
					],

					blocksy_rand_md5() => [
						'type' => 'ct-condition',
						'condition' => [
							$prefix . 'card_type' => 'cover',
						],
						'perform_replace' => [
							'condition' => $has_card_matching_template ? [
								$prefix . 'structure' => '!__never__'
							] : [
								$prefix . 'structure' => 'simple'
							],
							'key' => $prefix . 'card_type',
							'from' => 'cover',
							'to' => 'boxed'
						],
						'options' => [

							$prefix . 'card_overlay_background' => [
								'label' => __( 'Card Overlay Color', 'blocksy' ),
								'type'  => 'ct-background',
								'design' => 'block:right',
								'responsive' => true,
								'divider' => 'bottom',
								'activeTabs' => ['color', 'gradient'],
								'sync' => 'live',
								'value' => blocksy_background_default_value([
									'backgroundColor' => [
										'default' => [
											'color' => 'rgba(0,0,0,0.5)',
										],
									],
								]),
							],
						],
					],

					$prefix . 'cardBackground' => [
						'label' => __( 'Card Background Color', 'blocksy' ),
						'type'  => 'ct-background',
						'design' => 'block:right',
						'responsive' => true,
						'activeTabs' => ['color', 'gradient'],
						'sync' => 'live',
						'value' => blocksy_background_default_value([
							'backgroundColor' => [
								'default' => [
									'color' => 'var(--theme-palette-color-8, var(--paletteColor8))',
								],
							],
						]),
					],

					$prefix . 'cardBorder' => [
						'label' => __( 'Card Border', 'blocksy' ),
						'type' => 'ct-border',
						'design' => 'block',
						'sync' => 'live',
						'divider' => 'top',
						'responsive' => true,
						'value' => [
							'width' => 1,
							'style' => 'none',
							'color' => [
								'color' => 'rgba(44,62,80,0.2)',
							],
						]
					],

					$prefix . 'cardShadow' => [
						'label' => __( 'Card Shadow', 'blocksy' ),
						'type' => 'ct-box-shadow',
						'sync' => 'live',
						'responsive' => true,
						'divider' => 'top',
						'value' => blocksy_box_shadow_value([
							'enable' => true,
							'h_offset' => 0,
							'v_offset' => 12,
							'blur' => 18,
							'spread' => -6,
							'inset' => false,
							'color' => [
								'color' => 'rgba(34, 56, 101, 0.04)',
							],
						])
					],

					$prefix . 'cardRadius' => [
						'label' => __( 'Border Radius', 'blocksy' ),
						'sync' => 'live',
						'type' => 'ct-spacing',
						'divider' => 'top',
						'value' => blocksy_spacing_value([
							'linked' => true,
						]),
						'responsive' => true
					],

				],
			],
		], trim($prefix, '_'))
	]
];

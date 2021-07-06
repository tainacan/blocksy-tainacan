<?php

$prefix = blocksy_manager()->screen->get_prefix();

blc_call_fnc(['fnc' => 'blocksy_output_responsive'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-item-section__metadata', $prefix),
	'variableName' => 'metadata-column-width',
	'value' => get_theme_mod( $prefix . '_tainacan_metadata_columns', [
		'mobile' => '200px',
		'tablet' => '300px',
		'desktop' => '400px',
	]),
	'unit' => ''
]);

blc_call_fnc(['fnc' => 'blocksy_output_font_css'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-single-item-section', $prefix),
	'font_value' => get_theme_mod($prefix . '_tainacan_single_item_section_font',
		blocksy_typography_default_values([
			'size' => '26px',
			'variation' => 'n6',
			'line-height' => '1.3'
		])
	)
]);


blc_call_fnc(['fnc' => 'blocksy_output_responsive'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'responsive' => true,
	'variableName' => 'section-alignment',
	'unit' => '',
	'selector' => blocksy_prefix_selector('.tainacan-single-item-section', $prefix),
	'value' => get_theme_mod($prefix . '_tainacan_single_item_section_alignment', 'left')
]);

blc_call_fnc(['fnc' => 'blocksy_output_responsive'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-media-component', $prefix),
	'variableName' => 'attachments-size',
	'value' => get_theme_mod( $prefix . '_attachments_size', [
		'mobile' => '120px',
		'tablet' => '130px',
		'desktop' => '140px',
	]),
	'unit' => ''
]);

blc_call_fnc(['fnc' => 'blocksy_output_responsive'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-media-component', $prefix),
	'variableName' => 'document-height',
	'value' => get_theme_mod( $prefix . '_document_height', [
		'mobile' => '40vh',
		'tablet' => '50vh',
		'desktop' => '60vh',
	]),
	'unit' => 'vh',
	'defaultUnit' => 'vh',
]);

blc_call_fnc(['fnc' => 'blocksy_output_responsive'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-media-component', $prefix),
	'variableName' => 'document-width',
	'value' => get_theme_mod( $prefix . '_document_width', [
		'mobile' => '100%',
		'tablet' => '100%',
		'desktop' => '100%',
	]),
	'unit' => '%',
	'defaultUnit' => '%',
]);

blc_call_fnc(['fnc' => 'blocksy_output_responsive'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-media-component', $prefix),
	'variableName' => 'attachments-carousel-width',
	'value' => get_theme_mod( $prefix . '_attachments_carousel_width', [
		'mobile' => '100%',
		'tablet' => '100%',
		'desktop' => '100%',
	]),
	'unit' => '%',
	'defaultUnit' => '%',
]);

blc_call_fnc(['fnc' => 'blocksy_output_responsive'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.collection-thumbnail', $prefix),
	'variableName' => 'thumbnail-size',
	'value' => get_theme_mod( $prefix . '_hero_thumbnail_size', [
		'mobile' => '120px',
		'tablet' => '300px',
		'desktop' => '140px',
	]),
	'unit' => ''
]);

blc_call_fnc(['fnc' => 'blocksy_output_font_css'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.swiper-slide-metadata__name', $prefix),
	'font_value' => get_theme_mod($prefix . '_document_name_font',
		blocksy_typography_default_values([
			'size' => '0.875rem',
			'variation' => 'n6',
		])
	)
]);

blc_call_fnc(['fnc' => 'blocksy_output_font_css'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.swiper-slide-metadata__caption', $prefix),
	'font_value' => get_theme_mod($prefix . '_document_caption_font',
		blocksy_typography_default_values([
			'size' => '1rem'
		])
	)
]);

blc_call_fnc(['fnc' => 'blocksy_output_font_css'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.swiper-slide-metadata__description', $prefix),
	'font_value' => get_theme_mod($prefix . '_document_description_font',
		blocksy_typography_default_values([
			'size' => '1rem'
		])
	)
]);

blc_call_fnc(['fnc' => 'blocksy_output_font_css'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-item-section__attachments-file .swiper-slide-metadata', $prefix),
	'font_value' => get_theme_mod($prefix . '_attachment_label_font',
		blocksy_typography_default_values([
			'size' => '0.875rem',
			'line-height' => '1.5'
		])
	)
]);

blc_call_fnc(['fnc' => 'blocksy_output_border'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-item-section__metadata', $prefix),
	'variableName' => 'metadata-label-border',
	'value' => get_theme_mod( $prefix . '_metadata_label_border', [
		'width' => 0,
		'style' => 'solid',
		'color' => [
			'color' => 'rgba(125, 125, 125, 0.5)',
		],
	]),
	'responsive' => true
]);


blc_call_fnc(['fnc' => 'blocksy_output_border'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-item-section__metadata', $prefix),
	'variableName' => 'metadata-value-border',
	'value' => get_theme_mod( $prefix . '_metadata_value_border', [
		'width' => 0,
		'style' => 'solid',
		'color' => [
			'color' => 'rgba(125, 125, 125, 0.5)',
		],
	]),
	'responsive' => true
]);


blc_call_fnc(['fnc' => 'blocksy_output_font_css'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-metadata-label', $prefix),
	'font_value' => get_theme_mod($prefix . '_tainacan_metadata_label_font',
		blocksy_typography_default_values([
			'size' => '20px',
			'variation' => 'n6',
			'line-height' => '1.2'
		])
	)
]);

blc_call_fnc(['fnc' => 'blocksy_output_font_css'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-metadata-value', $prefix),
	'font_value' => get_theme_mod($prefix . '_tainacan_metadata_value_font',
		blocksy_typography_default_values([
			'size' => '17px'
		])
	)
]);

blc_call_fnc(['fnc' => 'blocksy_output_responsive'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'responsive' => true,
	'variableName' => 'metadata-label-alignment',
	'unit' => '',
	'selector' => blocksy_prefix_selector('.tainacan-metadata-label', $prefix),
	'value' => get_theme_mod($prefix . '_tainacan_metadata_label_alignment', 'left')
]);

blc_call_fnc(['fnc' => 'blocksy_output_responsive'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'responsive' => true,
	'variableName' => 'metadata-value-alignment',
	'unit' => '',
	'selector' => blocksy_prefix_selector('.tainacan-metadata-value', $prefix),
	'value' => get_theme_mod($prefix . '_tainacan_metadata_value_alignment', 'left')
]);

?>
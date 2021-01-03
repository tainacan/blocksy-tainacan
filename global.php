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


blc_call_fnc(['fnc' => 'blocksy_output_border'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => blocksy_prefix_selector('.tainacan-item-section__metadata', $prefix),
	'variableName' => 'metadata-border',
	'value' => get_theme_mod( $prefix . '_metadata_border', [
		'width' => 1,
		'style' => 'solid',
		'color' => [
			'color' => '#e0e5eb',
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
			'size' => '22px',
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

?>
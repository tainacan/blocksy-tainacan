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
	'selector' => blocksy_prefix_selector('.tainacan-item-section__attachments-file', $prefix),
	'variableName' => 'attachments-size',
	'value' => get_theme_mod( $prefix . '_attachments_size', [
		'mobile' => '120px',
		'tablet' => '300px',
		'desktop' => '140px',
	]),
	'unit' => ''
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

?>
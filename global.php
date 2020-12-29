<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

blc_call_fnc(['fnc' => 'blocksy_output_responsive'], [
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => ".tainacan-item-section__metadata",
	'variableName' => 'column-width',
	'value' => get_theme_mod($prefix . '_metadata_columns', [
		'mobile' => '200px',
		'tablet' => '300px',
		'desktop' => '400px',
	]),
	'unit' => ''
]);

?>
<?php

if (! isset($prefix)) {
	$prefix = '';
}
if (! isset($enabled)) {
	$enabled = 'no';
}

$options = [
	$prefix . 'tainacan_metadata_label_font' => [
		'type' => 'ct-typography',
		'label' => __( 'Metadata label', 'blocksy' ),
		'value' => blocksy_typography_default_values([
			'size' => '22px',
			'variation' => 'n6',
			'line-height' => '1.2'
		]),
		'divider' => 'top',
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
	$prefix . 'tainacan_metadata_value_font' => [
		'type' => 'ct-typography',
		'label' => __( 'Metadata value', 'blocksy' ),
		'value' => blocksy_typography_default_values([
			'size' => '17px'
		]),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
];
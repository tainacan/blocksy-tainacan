<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [
	$prefix . 'document_caption_font' => [
		'type' => 'ct-typography',
		'label' => __( 'Document caption on main slider', 'tainacan-blocksy' ),
		'value' => blocksy_typography_default_values([
			'size' => '0.875rem'
		]),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
	$prefix . 'document_name_font' => [
		'type' => 'ct-typography',
		'label' => __( 'Document name on main slider', 'tainacan-blocksy' ),
		'value' => blocksy_typography_default_values([
			'size' => '1rem',
			'variation' => 'n6',
		]),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	],
	$prefix . 'document_description_font' => [
		'type' => 'ct-typography',
		'label' => __( 'Document description on main slider', 'tainacan-blocksy' ),
		'value' => blocksy_typography_default_values([
			'size' => '1rem'
		]),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	]
];
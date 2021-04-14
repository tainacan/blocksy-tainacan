<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [
	$prefix . 'attachments_label_font' => [
		'type' => 'ct-typography',
		'label' => __( 'Attachments label on carousel', 'blocksy-tainacan' ),
		'value' => blocksy_typography_default_values([
			'size' => '0.875rem',
			'line-height' => '1.5'
		]),
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	]
];
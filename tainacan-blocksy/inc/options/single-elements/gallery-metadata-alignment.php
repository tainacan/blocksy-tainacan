<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [
	$prefix . 'gallery_metadata_alignment' => [
		'type' => 'ct-radio',
		'label' => __( 'Metadata alignment', 'tainacan-blocksy' ),
		'desc' => __( 'Alignment of the file name, caption and description under the main slider.', 'tainacan-blocksy' ),
		'value' => 'center',
		'view' => 'text',
		'attr' => [ 'data-type' => 'alignment' ],
		'design' => 'block',
		'choices' => [
			'left' => '',
			'center' => '',
			'right' => '',
		],
		'sync' => blocksy_sync_single_post_container([
			'prefix' => $prefix
		])
	]
];

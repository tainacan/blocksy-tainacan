<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [	
	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'page_structure_type' => 'type-gm|type-mg'
		],
		'options' => [
			$prefix . 'document_attachments_columns' => [
				'label' => __( 'Document and Attachments columns width', 'blocksy-tainacan' ),
				'desc' => __( 'This option is only available when using two columns layout', 'blocksy-tainacan'),
				'type' => 'ct-slider',
				'value' => '60%',
				'units' => blocksy_units_config([
					[
						'unit' => '%',
						'min' => 20,
						'max' => 80,
					]
				]),
				'responsive' => false,
				'divider' => 'top',
				'sync' => blocksy_sync_single_post_container([
					'prefix' => $prefix
				])
			],
		],
	]
];
<?php

if (! isset($prefix)) {
	$prefix = '';
}
if (! isset($enabled)) {
	$enabled = 'no';
}

$options = [	
	blocksy_rand_md5() => [
		'type' => 'ct-condition',
		'condition' => [
			$prefix . 'page_structure_type' => 'type-gm|type-mg',
			$prefix . 'document_attachments_structure' => 'gallery-type-2'
		],
		'options' => [
			$prefix . 'document_attachments_affix' => [
				'label' => __( 'Document and Attachments column fixed on scroll', 'tainacan-blocksy' ),
				'desc' => __( 'Toggle to set the column fixed on top, even after page scroll. This option is only available if using two columns layout and Document and Attachments are merged', 'tainacan-blocksy'),
				'type' => 'ct-switch',
				'value' => $enabled,
				'setting' => [ 'transport' => 'postMessage' ],
				'sync' => blocksy_sync_single_post_container([
					'prefix' => $prefix,
				])
			]
		]
	]
];
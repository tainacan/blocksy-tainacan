<?php

$options = [
	'title' => __('Tainacan Terms Items', 'tainacan-blocksy'),
	'container' => [ 'priority' => 8 ],
	'options' => [

		'tainacan_terms_items_list_section_options' => [
			'type' => 'ct-options',
			'setting' => [ 'transport' => 'postMessage' ],
			'inner-options' => blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/posts/tainacan-item-archive.php', [
				'prefix' => 'tainacan-terms-items',
				'is_general_cpt' => true
			], false),
		],
	],
];

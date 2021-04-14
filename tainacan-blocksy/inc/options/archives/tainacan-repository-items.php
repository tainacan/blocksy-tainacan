<?php

$options = [
	'title' => __('Tainacan Repository Items', 'tainacan-blocksy'),
	'container' => [ 'priority' => 8 ],
	'options' => [
		'tainacan_repository_items_list_section_options' => [
			'type' => 'ct-options',
			'setting' => [ 'transport' => 'postMessage' ],
			'inner-options' => blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/posts/tainacan-item-archive.php', [
				'prefix' => 'tainacan-repository-items',
				'is_general_cpt' => true
			], false),
		],
	],
];

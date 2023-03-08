<?php

if (! isset($is_general_cpt)) {
	$is_general_cpt = false;
}

if (! isset($is_bbpress)) {
	$is_bbpress = false;
}

$options = [
	[
		blocksy_rand_md5() => [
			'type' => 'ct-title',
			'label' => __( 'Taxonomy terms list', 'tainacan-blocksy' )
		]
	],
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/tainacan-terms-list-structure.php', [
		'prefix' => $post_type->name . '_single'
	], false),
];

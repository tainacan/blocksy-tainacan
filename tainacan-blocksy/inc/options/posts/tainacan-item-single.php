<?php

if (! isset($is_general_cpt)) {
	$is_general_cpt = false;
}

if (! isset($is_bbpress)) {
	$is_bbpress = false;
}

$options = [
	// [
	// 	blocksy_rand_md5() => [
	// 		'type' => 'ct-title',
	// 		'label' => __( 'Tainacan Item Elements', 'tainacan-blocksy' ),
	// 		'desc' => __( 'These options are used to customize the Tainacan Item single page elements.', 'tainacan-blocksy' ),
	// 	]
	// ],
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/tainacan-single-structure.php', [
		'prefix' => $post_type->name . '_single',
	], false),
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/section-labels.php', [
		'prefix' => $post_type->name . '_single',
		'enabled' => 'yes'
	], false),
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/document-attachments.php', [
		'prefix' => $post_type->name . '_single',
	], false),
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/metadata-list.php', [
		'prefix' => $post_type->name . '_single',
	], false)
];

if ( function_exists('tainacan_the_related_items_carousel') ) {
	$options[] = blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/items-related-to-this.php', [
		'prefix' => $post_type->name . '_single',
		'enabled' => 'no'
	], false);
}

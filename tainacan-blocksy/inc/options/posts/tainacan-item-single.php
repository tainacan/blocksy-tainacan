<?php

if (! isset($is_general_cpt)) {
	$is_general_cpt = false;
}

if (! isset($is_bbpress)) {
	$is_bbpress = false;
}

$options = $post_type->name === 'tnc_blocksy_item' ? [ [
	blocksy_rand_md5() => [
		'type' => 'ct-notification',
		'attr' => [ 'data-type' => 'background:white' ],
		'text' => '<strong>' . __('This customizations are usually overridden by the collection item single page options.', 'tainacan-blocksy') . '</strong> ' . __('If you wish this options to have impact on a collection, go to it\'s settings page in the Tainacan Admin and change the value for hte "Source of the appearence options" to allow usage of general options inherited from here.', 'tainacan-blocksy')
	],
] ] : [];

$options = array_merge( $options, [
	[
		blocksy_rand_md5() => [
			'type' => 'ct-title',
			'label' => __( 'Tainacan Item Elements', 'tainacan-blocksy' ),
			'desc' => __( 'These options are used to customize the Tainacan Item single page elements.', 'tainacan-blocksy' ),
		]
	],
	blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/tainacan-single-structure.php', [
		'prefix' => $post_type->name . '_single',
		'location' => 'teste'
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
]);

if ( function_exists('tainacan_the_related_items_carousel') ) {
	$options[] = blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/single-elements/items-related-to-this.php', [
		'prefix' => $post_type->name . '_single',
		'enabled' => 'no'
	], false);
}

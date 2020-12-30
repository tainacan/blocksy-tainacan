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
			'label' => __( 'Tainacan Item Elements', 'blocksy-tainacan' ),
		],
	],
	blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/tainacan-single-structure.php', [
		'prefix' => $post_type->name . '_single'
	], false),
	blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/section-labels.php', [
		'prefix' => $post_type->name . '_single',
		'enabled' => 'yes'
	], false),
	blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/document-attachments.php', [
		'prefix' => $post_type->name . '_single',
	], false),
	blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/metadata-list.php', [
		'prefix' => $post_type->name . '_single',
	], false)
];
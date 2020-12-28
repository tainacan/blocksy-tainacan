<?php

if (! isset($is_general_cpt)) {
	$is_general_cpt = false;
}

if (! isset($is_bbpress)) {
	$is_bbpress = false;
}

$options = [
	blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/gallery-mode.php', [
		'prefix' => $post_type->name . '_single',
		'enabled' => 'no'
	], false),
	blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/section-labels.php', [
		'prefix' => $post_type->name . '_single',
		'enabled' => 'yes'
	], false),
	blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/hide-download-button.php', [
		'prefix' => $post_type->name . '_single',
		'enabled' => 'no'
	], false),
	blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/show-title-metadata.php', [
		'prefix' => $post_type->name . '_single',
		'enabled' => 'yes'
	], false),
	blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/show-thumbnail.php', [
		'prefix' => $post_type->name . '_single',
		'enabled' => 'no'
	], false),
	blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/metadata-columns.php', [
		'prefix' => $post_type->name . '_single'
	], false),
];
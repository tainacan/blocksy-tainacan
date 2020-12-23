<?php

$options = [
	blocksy_get_options('general/page-title', [
		'prefix' => $post_type->name . '_archive',
		'is_cpt' => true,
		'is_archive' => true,
		'enabled_label' => sprintf(
			__('%s Title', 'blocksy'),
			$post_type->labels->name
		),
	]),

	[
		blocksy_rand_md5() => [
			'type' => 'ct-title',
			'label' => __( 'Page Elements', 'blocksy' ),
		],
	],

	blocksy_get_options(get_stylesheet_directory() . '/inc/options/archive-elements/search-control.php', [
		'prefix' => $post_type->name . '_archive',
	], false),

	blocksy_get_options(get_stylesheet_directory() . '/inc/options/archive-elements/filters-panel.php', [
		'prefix' => $post_type->name . '_archive',
		'enabled' => 'yes'
	], false),

	blocksy_get_options(get_stylesheet_directory() . '/inc/options/archive-elements/pagination.php', [
		'prefix' => $post_type->name . '_archive',
		'enabled' => 'yes'
	], false),

];

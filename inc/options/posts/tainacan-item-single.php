<?php

if (! isset($is_general_cpt)) {
	$is_general_cpt = false;
}

if (! isset($is_bbpress)) {
	$is_bbpress = false;
}

$options = [
	blocksy_get_options(get_stylesheet_directory() . '/inc/options/single-elements/title-metadata.php', [
		'prefix' => $post_type->name . '_single',
		'enabled' => 'yes'
	], false)
];
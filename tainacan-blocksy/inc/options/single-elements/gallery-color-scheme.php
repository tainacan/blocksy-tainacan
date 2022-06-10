<?php

if (! isset($prefix)) {
	$prefix = '';
}

$options = [
	$prefix . 'gallery_color_scheme' => [
		'label' => __('Media gallery color scheme', 'tainacan-blocksy'),
		'type' => 'ct-radio',
		'value' => 'dark',
		'view' => 'text',
		'divider' => 'top',
		'choices' => [
			'dark' => __('Dark', 'blocksy'),
			'light' => __('Light', 'blocksy')
		]
	]
];
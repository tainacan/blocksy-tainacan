<?php

// phpcs:disable WordPress.WP.I18n.TextDomainMismatch -- All translatable strings in this file reuse translations from the Tainacan plugin.

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- Blocksy option include contract ($prefix, $options, $enabled).

$view_modes = tainacan_get_default_view_mode_choices();

$options = [
    $prefix . 'default_view_mode' => [
        'label' => __('Default view mode', 'tainacan'),
        'type' => 'ct-select',
        'value' => $view_modes['default_view_mode'],
        'view' => 'text',
        'design' => 'inline',
        'sync' => '',
        'choices' => blocksy_ordered_keys(
            $view_modes['enabled_view_modes']
        )
    ]
];
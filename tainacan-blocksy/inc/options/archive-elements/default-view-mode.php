<?php

$view_modes = tainacan_get_default_view_mode_choices();

$options = [
    $prefix . 'default_view_mode' => [
        'label' => __('Default view mode', 'blocksy'),
        'type' => 'ct-select',
        'value' => $view_modes['default_view_mode'],
        'view' => 'text',
        'design' => 'inline',
        'sync' => '',
        'choices' => blocksy_ordered_keys(
            $view_modes['enabled_view_modes']
        ),
    ]
];
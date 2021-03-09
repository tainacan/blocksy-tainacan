<?php

/**
 * Checks is the current activate theme is blocksy
 */
if ( !function_exists('blocksy_tainacan_is_blocksy_activated') ) {
    function blocksy_tainacan_is_blocksy_activated() {
        $theme = wp_get_theme();
        $is_correct_theme = strpos( $theme->get_stylesheet(), 'blocksy' ) !== false;

        $is_child_theme_of_blocksy = FALSE;
        if ($theme->parent() !== false)
            $is_child_theme_of_blocksy = strpos( $theme->get_template(), 'blocksy' ) !== false;

        $another_theme_in_preview = false;
        if ( (isset( $_REQUEST['theme'] ) && strpos( strtolower( $_REQUEST['theme'] ), 'blocksy' ) === false || isset( $_REQUEST['customize_theme'] ) && strpos( strtolower( $_REQUEST['customize_theme'] ), 'blocksy' ) === false) && strpos( $_SERVER['REQUEST_URI'], 'customize' ) !== false ) {
            $another_theme_in_preview = true;
        }
        return ($is_correct_theme || $is_child_theme_of_blocksy) && !$another_theme_in_preview;
    }
}

/**
 * Gets plugin or theme directory URL
 */
if ( !function_exists('blocksy_tainacan_get_plugin_dir_url') ) {
    function blocksy_tainacan_get_plugin_dir_url() {
        return BLOCKSY_TAINACAN_IS_PLUGIN ? plugin_dir_url(__FILE__) : get_stylesheet_directory_uri();
    }
}

/**
 * Gets plugin or theme directory path
 */
if ( !function_exists('blocksy_tainacan_get_plugin_dir_path') ) {
    function blocksy_tainacan_get_plugin_dir_path() {
        return BLOCKSY_TAINACAN_IS_PLUGIN ? plugin_dir_path(__FILE__) : get_stylesheet_directory();
    }
}

/**
 * Manages correct template location in plugin
 */
if ( !function_exists('blocksy_tainacan_get_template_part') ) {
    function blocksy_tainacan_get_template_part($path) {
        return BLOCKSY_TAINACAN_IS_PLUGIN ? include(BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/' . $path . '.php') : get_template_part($path);
    }
}

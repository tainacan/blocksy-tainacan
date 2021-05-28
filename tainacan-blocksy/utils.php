<?php

/**
 * Checks if the current activate theme is either blocksy, a child theme of blocksy or one of them in a customizer preview
 */
if ( !function_exists('tainacan_blocksy_is_blocksy_activated') ) {
    function tainacan_blocksy_is_blocksy_activated() {
        $theme = wp_get_theme();
        $is_correct_theme = strpos( $theme->get_stylesheet(), 'blocksy' ) !== false;

        $is_child_theme_of_blocksy = false;
        if ($theme->parent() !== false)
            $is_child_theme_of_blocksy = strpos( $theme->get_template(), 'blocksy' ) !== false;

        if ( isset($_SERVER['REQUEST_URI']) && strpos( $_SERVER['REQUEST_URI'], 'customize' ) !== false ) {
            $preview_theme_slug = isset( $_REQUEST['theme'] ) ? strtolower($_REQUEST['theme']) : ( isset( $_REQUEST['customize_theme'] ) ? strtolower($_REQUEST['customize_theme']) : '');
            
            $preview_theme = wp_get_theme($preview_theme_slug);
            $is_correct_theme = strpos( $preview_theme->get_stylesheet(), 'blocksy' ) !== false;

            $is_child_theme_of_blocksy = false;
            if ($preview_theme->parent() !== false)
                $is_child_theme_of_blocksy = strpos( $preview_theme->get_template(), 'blocksy' ) !== false;
        }
        
        return $is_correct_theme || $is_child_theme_of_blocksy;
    }
}


/**
 * Gets version of current theme
 */
if ( !function_exists('tainacan_blocksy_get_theme_version') ) {
    function tainacan_blocksy_get_theme_version() {

        if ( tainacan_blocksy_is_blocksy_activated() ) {
            $theme = wp_get_theme();
    
            $is_child_theme_of_blocksy = FALSE;

            if ($theme->parent() !== false)
                $is_child_theme_of_blocksy = strpos( $theme->get_template(), 'blocksy' ) !== false;
                
            return $is_child_theme_of_blocksy ? $theme->parent()->get('Version') : $theme->get('Version');
        } else {
            return NULL;
        }
    }
}


/**
 * Gets plugin or theme directory URL
 */
if ( !function_exists('tainacan_blocksy_get_plugin_dir_url') ) {
    function tainacan_blocksy_get_plugin_dir_url() {
        return !TAINACAN_BLOCKSY_IS_CHILD_THEME ? plugin_dir_url(__FILE__) : get_stylesheet_directory_uri();
    }
}

/**
 * Gets plugin or theme directory path
 */
if ( !function_exists('tainacan_blocksy_get_plugin_dir_path') ) {
    function tainacan_blocksy_get_plugin_dir_path() {
        return !TAINACAN_BLOCKSY_IS_CHILD_THEME ? plugin_dir_path(__FILE__) : get_stylesheet_directory();
    }
}

/**
 * Manages correct template location in plugin
 */
if ( !function_exists('tainacan_blocksy_get_template_part') ) {
    function tainacan_blocksy_get_template_part($path) {
        if (!TAINACAN_BLOCKSY_IS_CHILD_THEME) {
            include(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/' . $path . '.php');
            return; // Should not return this, as include contains boolean
        } else
            return get_template_part($path);
    }
}

<?php

/**
 * Uses Template redirect for setting the proper template to items
 * archives on Tainacan pages
 */
if ( !function_exists('blocksy_tainacan_archive_templates_redirects') ) {
    function blocksy_tainacan_archive_templates_redirects() {
        global $wp_query;
        if (is_post_type_archive()) {
            
            $collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
            $current_post_type = get_post_type();
            
            if (in_array($current_post_type, $collections_post_types)) {
                
                if (is_post_type_archive()) { 			
                    include( BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/tainacan/archive-items.php' );
                    exit;
                } 
            }
        } else if ( is_tax() ) {
            $term = get_queried_object();
                
            if ( isset($term->taxonomy) && \Tainacan\Theme_Helper::get_instance()->is_taxonomy_a_tainacan_tax($term->taxonomy)) {
                $tax_id = \Tainacan\Repositories\Taxonomies::get_instance()->get_id_by_db_identifier($term->taxonomy);
                $tax = \Tainacan\Repositories\Taxonomies::get_instance()->fetch($tax_id);
                
                include( BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/tainacan/archive-taxonomy.php' );
                exit;
            }
        } else if ( $wp_query->get( 'tainacan_repository_archive' ) == 1 ) {
            
            include( BLOCKSY_TAINACAN_PLUGIN_DIR_PATH . '/tainacan/archive-items.php' );
            exit;
        }
        
    }
}
add_action('template_redirect', 'blocksy_tainacan_archive_templates_redirects');

/**
 * Uses Template redirect for setting the proper template to items
 * archives on Tainacan pages
 */
if ( !function_exists('blocksy_tainacan_update_extensions_paths') ) {
    function blocksy_tainacan_update_extensions_paths($paths) {
        var_dump($paths);
        return $paths;
    }
}
add_filter( 'blocksy_extensions_paths', 'blocksy_tainacan_update_extensions_paths');

?>
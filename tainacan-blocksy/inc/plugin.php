<?php

/**
 * Uses Template redirect for setting the proper template to items
 * archives on Tainacan pages
 */
if ( !function_exists('tainacan_blocksy_archive_templates_redirects') ) {
    function tainacan_blocksy_archive_templates_redirects() {
        global $wp_query;
        if (is_post_type_archive()) {
            
            $collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
            $current_post_type = get_post_type();
            
            if (in_array($current_post_type, $collections_post_types)) {

                if (is_post_type_archive()) {
                    include( TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/tainacan/archive-items.php' );
                    exit;
                } 
            }
        } else if ( is_tax() ) {
            $term = get_queried_object();
                
            if ( isset($term->taxonomy) && \Tainacan\Theme_Helper::get_instance()->is_taxonomy_a_tainacan_tax($term->taxonomy)) {
                $tax_id = \Tainacan\Repositories\Taxonomies::get_instance()->get_id_by_db_identifier($term->taxonomy);
                $tax = \Tainacan\Repositories\Taxonomies::get_instance()->fetch($tax_id);
                
                include( TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/tainacan/archive-taxonomy.php' );
                exit;
            }
        } else if ( $wp_query->get( 'tainacan_repository_archive' ) == 1 ) {
            
            include( TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/tainacan/archive-repository.php' );
            exit;
        }
        
    }
}
add_action('template_redirect', 'tainacan_blocksy_archive_templates_redirects', 2, 0);

/**
 * Uses Template redirect for setting the proper template to items
 * archives on Tainacan pages
 */
if ( !function_exists('tainacan_blocksy_update_extensions_paths') ) {
    function tainacan_blocksy_update_extensions_paths($paths) {
        return $paths;
    }
}
add_filter( 'blocksy_extensions_paths', 'tainacan_blocksy_update_extensions_paths');

?>
<?php
/**
 * add support for elasticpress in searches used by blocksy
 */
add_filter('pre_get_posts', function ($query) {
    if (class_exists('\Tainacan\Elastic_Press')) {
        $tainacan_Elastic_press = \Tainacan\Elastic_Press::get_instance();
        if (
            isset($tainacan_Elastic_press) &&
            $tainacan_Elastic_press->is_active() &&
            $query->is_search &&
            (is_search() || wp_doing_ajax())
        ) {
            $query->set('ep_integrate', true);
        }
    }
    return $query;
});

/**
 * Uses Template redirect for setting the proper template to items
 * archives on Tainacan pages
 */
if ( !function_exists('tainacan_blocksy_archive_templates_redirects') ) {
    function tainacan_blocksy_archive_templates_redirects() {
        global $wp_query;

        if (
                isset( $_GET['s'] ) &&
                $wp_query->is_main_query() &&
                $wp_query->is_search() &&
                !is_admin()
        ) {
            if ( !method_exists( \Tainacan\Theme_Helper::get_instance(), 'is_post_type_a_collection' ) )
                $collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
            
            $searching_post_types = $wp_query->get( 'post_type' );

            if ( !is_array($searching_post_types) )
                $searching_post_types = [ $searching_post_types ];

            // If the search is going on post types other than Tainacan items...
            foreach($searching_post_types as $searching_post_type) {

				if ( method_exists( \Tainacan\Theme_Helper::get_instance(), 'is_post_type_a_collection' ) ) {
					$is_collection = \Tainacan\Theme_Helper::get_instance()->is_post_type_a_collection($searching_post_type);
				} else {
					$is_collection = in_array($searching_post_type, $collections_post_types);
				}

                if ( !$is_collection )
                    return;
            }
            
            // If the search is in a single collection, go there
            if ( count($searching_post_types) === 1 )
                wp_redirect( get_post_type_archive_link( $searching_post_types[0] ) . '?search=' . $_GET['s'] );

            // Otherwise, the Items Repository list should do the job
            else
                wp_redirect( \Tainacan\Theme_Helper::get_instance()->get_items_list_slug() . '?search=' . $_GET['s'] );
        }

        if (is_post_type_archive()) {
            
            $post_type = get_post_type();

            if ( method_exists( \Tainacan\Theme_Helper::get_instance(), 'is_post_type_a_collection' ) ) {
                $is_collection = \Tainacan\Theme_Helper::get_instance()->is_post_type_a_collection($post_type);
            } else {
                $collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
                $is_collection = in_array($post_type, $collections_post_types);
            }
            
            if ( $is_collection) {
                include( TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/tainacan/archive-items.php' );
                exit;
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

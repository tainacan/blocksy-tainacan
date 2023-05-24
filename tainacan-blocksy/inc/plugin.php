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
            $collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
            $searching_post_types = $wp_query->get( 'post_type' );

            if ( !is_array($searching_post_types) )
                $searching_post_types = [ $searching_post_types ];

            // If the search is going on post types other than Tainacan items...
            foreach($searching_post_types as $searching_post_type) {
                if ( !in_array($searching_post_type, $collections_post_types) )
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
            
            $collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
            $current_post_type = get_post_type();
            
            if (in_array($current_post_type, $collections_post_types)) {
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

/**
 * Adds extra class to help styling tainacan single items templates.
 */
if ( !function_exists('tainacan_blocksy_post_class') ) {
    function tainacan_blocksy_post_class($classes) {
        
        $collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
        $current_post_type = get_post_type();
            
        if (in_array($current_post_type, $collections_post_types)) {
            $classes[] = 'tainacan-item-single-page';
        }

        return $classes;
    }
}
add_filter('post_class', 'tainacan_blocksy_post_class');


/**
 * Retrieves the current registered view modes on Tainacan plugin and filter some options to offer as default
 * 
 * @return array An associative array with view mode options and the default one
 */
if ( !function_exists('tainacan_get_default_view_mode_choices') ) {
    function tainacan_get_default_view_mode_choices() {
        $default_view_mode = '';
        $enabled_view_modes = [];

        if (function_exists('tainacan_get_the_view_modes')) {
            $view_modes = tainacan_get_the_view_modes();
            $default_view_mode = $view_modes['default_view_mode'];
            $enabled_view_modes = [];
            
            foreach ($view_modes['registered_view_modes'] as $key => $view_mode) {
                if (!$view_mode['full_screen'])
                    $enabled_view_modes[$key] = $view_mode['label'];
            }
        } else {
            $default_view_mode = 'masonry';
            $enabled_view_modes = [
                'masonry' => __('Masonry', 'tainacan-blocksy'),
                'cards' => __('Cards', 'tainacan-blocksy'),
                'table' => __('Table', 'tainacan-blocksy'),
                'grid' => __('Grid', 'tainacan-blocksy')
            ];
        }
        return [
            'default_view_mode' => $default_view_mode,
            'enabled_view_modes' => $enabled_view_modes
        ];
    }
}


/**
 * Retrieves possible orderby and order options to offer as default
 * 
 * @return array An associative array with orderby and order options
 */
if ( !function_exists('tainacan_get_default_order_choices') ) {
    function tainacan_get_default_order_choices() {
        return [
            'title_asc' => __( 'Title A-Z', 'tainacan-blocksy'),
            'title_desc' => __( 'Title Z-A', 'tainacan-blocksy'),
            'date_asc' => __( 'Latest created last', 'tainacan-blocksy'),
            'date_desc' => __( 'Latest created first', 'tainacan-blocksy'),
            'modified_asc' => __( 'Latest modified last', 'tainacan-blocksy'),
            'modified_desc' => __( 'Latest modified first', 'tainacan-blocksy'),
        ];
    }
}

/**
 * Filters the item single content page structure to add the media gallery above the title
 *
 */
function tainacan_blocksy_render_media_gallery_above_title() {

    $prefix = blocksy_manager()->screen->get_prefix();
    $page_structure_type = get_theme_mod( $prefix . '_page_structure_type', 'type-dam');

    if ($page_structure_type === 'type-gtm') {
        
        $content_style = get_theme_mod($prefix . '_content_style', 'wide');
        $extra_classes = '';

        if ( is_array($content_style) ) {

            if ( isset($content_style['desktop']) )
                $extra_classes .= ' has-content-style-' . $content_style['desktop'] . '--desktop';
            if ( isset($content_style['tablet']) )
                $extra_classes .= ' has-content-style-' . $content_style['tablet'] . '--tablet';
            if ( isset($content_style['mobile']) )
                $extra_classes .= ' has-content-style-' . $content_style['mobile'] . '--mobile';

        } elseif ( is_string($content_style) ) {
            $extra_classes = 'has-content-style-' . $content_style;
        }

        $media_component_style = '';
        $media_component_color_palette = get_theme_mod($prefix . '_document_attachments_colors',
        [
            'color1' => [ 'color' => 'var(--paletteColor6, #edeff2)' ],
			'color2' => [ 'color' => 'var(--paletteColor4, #2c3e50)' ],
			'color3' => [ 'color' => 'var(--paletteColor1, #3eaf7c)' ]
        ]);
        
        $media_component_style .= '--tainacan-media-background-color:' . $media_component_color_palette['color1']['color'] . ';';
        $media_component_style .= '--tainacan-media-color:' . $media_component_color_palette['color2']['color'] . ';';
        $media_component_style .= '--tainacan-media-accent-color:' . $media_component_color_palette['color3']['color'] . ';';
        
        echo '<div class="tainacan-gallery-above-title ' . $extra_classes . '" style="' . $media_component_style . '">';
            tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-document' );
            do_action( 'tainacan-blocksy-single-item-after-document' );  

            tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-attachments' );
            do_action( 'tainacan-blocksy-single-item-after-attachments' );
        echo '</div>';
    }
}
add_action( 'blocksy:hero:before', 'tainacan_blocksy_render_media_gallery_above_title');

?>
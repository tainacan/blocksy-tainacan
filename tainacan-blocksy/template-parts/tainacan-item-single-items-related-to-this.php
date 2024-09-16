<?php 
    $prefix = blocksy_manager()->screen->get_prefix();
    
    $section_label                = get_theme_mod( $prefix . '_section_items_related_to_this_label', __( 'Items related to this', 'tainacan-blocksy' ) );
    $items_related_to_this_layout = get_theme_mod( $prefix . '_items_related_to_this_layout', 'carousel' );
    $max_columns_count            = get_theme_mod( $prefix . '_items_related_to_this_max_columns_count', 4 );
    $max_items_per_screen         = get_theme_mod( $prefix . '_items_related_to_this_max_items_per_screen', 6 );
    $variable_items_width         = get_theme_mod( $prefix . '_items_related_to_this_variable_items_width', 'no') === 'yes';
    $max_items_number             = get_theme_mod( $prefix . '_items_related_to_this_max_items_number', 12 );
    $order_option                 = get_theme_mod( $prefix . '_items_related_to_this_order', 'title_asc' );
    $hide_collection_heading      = get_theme_mod( $prefix . '_items_related_to_this_hide_collection_heading', 'no' ) === 'yes';
    $hide_metadata_label          = get_theme_mod( $prefix . '_items_related_to_this_hide_metadata_label', 'no' ) === 'yes';
    $tainacan_view_mode           = get_theme_mod( $prefix . '_items_related_to_this_tainacan_view_mode', 'records' );

    $image_size = get_theme_mod($prefix . '_items_related_to_this_image_size', 'tainacan-medium');

    $order_option_split = explode( '_', $order_option ); 
    $order_by = $order_option_split[0] ? $order_option_split[0] : 'title';
    $order = $order_option_split[1] ? $order_option_split[1] : 'asc';

    if ( !in_array($order_by, [ 'title', 'date', 'modified' ]) )
        $order_by = 'title';

    if ( !in_array($order, [ 'asc', 'desc' ]) )
        $order = 'asc';

    if ( function_exists('tainacan_the_related_items_carousel') && (get_theme_mod( $prefix . '_display_items_related_to_this', 'no' ) === 'yes') && tainacan_has_related_items() ) : ?>
    
    <section class="tainacan-item-section tainacan-item-section--items-related-to-this">
        
        <?php if ( get_theme_mod($prefix . '_display_section_labels', 'yes') == 'yes' && $section_label != '') : ?>
            <h2 class="tainacan-single-item-section" id="tainacan-item-items-related-to-this-label">
                <?php echo esc_html( $section_label ); ?>
            </h2>
        <?php endif; ?>
        <div class="tainacan-item-section__items-related-to-this">
            <?php 
                tainacan_the_related_items_carousel([
                    'items_list_layout' => $items_related_to_this_layout,
                    'collection_heading_tag' => 'h3',
                    'order' => $order,
                    'orderby' => $order_by,
                    'max_items_number' => $max_items_number,
                    'hide_collection_heading' => $hide_collection_heading,
                    'hide_metadata_label' => $hide_metadata_label,
                    'dynamic_items_args' => [
                        'max_columns_count' => $max_columns_count,
                        'image_size' => $image_size,
                        'tainacan_view_mode' => $tainacan_view_mode,
                    ],
                    'carousel_args' => [
                        'max_items_per_screen' => $max_items_per_screen,
                        'image_size' => $image_size,
                        'variable_items_width' => $variable_items_width,
                    ]
                ]);
            ?>
        <div>

    </section>
<?php endif; ?>
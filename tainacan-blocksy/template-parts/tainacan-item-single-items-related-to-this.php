<?php 
    $prefix = blocksy_manager()->screen->get_prefix();
    
    $section_label                = get_theme_mod( $prefix . '_section_items_related_to_this_label', __( 'Items related to this', 'tainacan-blocksy' ) );
    $items_related_to_this_layout = get_theme_mod( $prefix . '_items_related_to_this_layout', 'carousel' );
    $max_columns_count            = get_theme_mod( $prefix . '_items_related_to_this_max_columns_count', 4 );
    $max_items_per_screen         = get_theme_mod( $prefix . '_items_related_to_this_max_items_per_screen', 6 );

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
                    'dynamic_items_args' => [
                        'max_columns_count' => $max_columns_count
                    ],
                    'carousel_args' => [
                        'max_items_per_screen' => $max_items_per_screen
                    ]
                ]);
            ?>
        <div>

    </section>
<?php endif; ?>
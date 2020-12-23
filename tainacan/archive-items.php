<?php 

$prefix = blocksy_manager()->screen->get_prefix();

?>

<?php get_header(); ?>

    <article class="page type-page hentry singular">
        <header class="tainacan-collection-header" style="background-image: <?php if ( get_header_image() ) { echo('linear-gradient(to bottom, rgba(255, 255, 255, 0.3), var(--backgroundColor, #f8f9fb)), url(' . get_header_image() . ')'); } else { echo ''; } ?>">
            <div class="tainacan-collection-header__box">  
                <?php if ( has_post_thumbnail( tainacan_get_collection_id() ) ) : 
                    $thumbnail_id = get_post_thumbnail_id( $post->ID );
                    $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); ?>
                    <div class="collection-thumbnail">
                        <img src="<?php echo get_the_post_thumbnail_url( tainacan_get_collection_id() ); ?>" alt="<?php echo esc_attr($alt); ?>">
                    </div>
                <?php endif; ?>
                <?php 
                    echo blocksy_output_hero_section( 'type-1' );
                ?>
            </div>
        </header>

        <div class="entry-content">
            <?php 
                tainacan_the_faceted_search([
                    'hide_filters' => get_theme_mod($prefix . '_display_filters_panel', 'yes') == 'no',
                    'start_with_filters_hidden' => get_theme_mod($prefix . '_start_with_filters_hidden', 'no') == 'yes',
                    'hide_hide_filters_button' => get_theme_mod($prefix . '_show_hide_filters_button', 'yes') == 'no',
                    'show_filters_button_inside_search_control' => get_theme_mod($prefix . '_show_filters_button_inside_search_control', 'yes') == 'yes',
                    'filters_as_modal' => get_theme_mod($prefix . '_filters_as_modal', 'no') == 'yes',
                    'hide_search' => get_theme_mod($prefix . '_show_search', 'yes') == 'no',
                    'hide_advanced_search' => get_theme_mod($prefix . '_show_advanced_search', 'yes') == 'no',
                    'hide_sorting_area' => get_theme_mod($prefix . '_show_sorting_area', 'yes') == 'no',
                    'hide_sort_by_button' => get_theme_mod($prefix . '_show_sort_by_button', 'yes') == 'no',
                    'hide_displayed_metadata_dropdown' => get_theme_mod($prefix . '_show_displayed_metadata_dropdown', 'yes') == 'no',
                    'show_inline_view_mode_options' => get_theme_mod($prefix . '_show_inline_view_mode_options', 'no') == 'yes',
                    'show_fullscreen_with_view_modes' => get_theme_mod($prefix . '_show_fullscreen_with_view_modes', 'no') == 'yes',
                    'hide_exposers_button' => get_theme_mod($prefix . '_show_exposers_button', 'yes') == 'no',
                    'hide_pagination_area' => get_theme_mod($prefix . '_has_pagination', 'yes') == 'no',
                ]); 
            ?>
        </div>
    </article>
<?php get_footer(); ?>
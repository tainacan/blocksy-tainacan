<?php 

$prefix = blocksy_manager()->screen->get_prefix();

$page_container_classes = 'page type-page hentry singular';
$page_container_classes = $page_container_classes . ( get_theme_mod($prefix . '_filters_panel_background_style', 'boxed') == 'boxed' ? ' has-filters-panel-style-boxed' : '' );
$page_container_classes = $page_container_classes . ( get_theme_mod($prefix . '_page_header_background_style', 'boxed') == 'boxed' ? ' has-page-header-style-boxed' : '' );

$filters_panel_size = get_theme_mod($prefix . '_filters_panel_size', '20%');
$page_container_style = '--tainacan-filter-menu-width-theme:' . $filters_panel_size . ';';

$background_color_palette = get_theme_mod($prefix . '_items_list_background_palette',
[
    'color1' => [ 'color' => 'var(--background-color, #f8f9fb)' ],
    'color2' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
    'color3' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
    'color4' => [ 'color' => 'var(--formBackgroundInitialColor, #ffffff)' ],
    'color5' => [ 'color' => 'var(--background-color, #f8f9fb)' ],
]);
$page_container_style .= '--tainacan-background-color:' . $background_color_palette['color1']['color'] . ';';
$page_container_style .= '--tainacan-item-background-color:' . $background_color_palette['color2']['color'] . ';';
$page_container_style .= '--tainacan-item-background-hover-color:' . $background_color_palette['color3']['color'] . ';';
$page_container_style .= '--tainacan-input-background-color:' . $background_color_palette['color4']['color'] . ';';
$page_container_style .= '--tainacan-primary-color:' . $background_color_palette['color5']['color'] . ';';

$text_color_palette = get_theme_mod($prefix . '_items_list_text_palette',
[
    'color1' => [ 'color' => 'var(--paletteColor1,#3eaf7c)' ],
    'color2' => [ 'color' => 'var(--headingColor, rgba(44, 62, 80, 1))' ],
    'color3' => [ 'color' => 'var(--color, #454647)' ],
    'color4' => [ 'color' => '#555758' ],
    'color5' => [ 'color' => 'var(--formTextInitialColor, #454647)' ],
]);
$page_container_style .= '--tainacan-secondary:' . $text_color_palette['color1']['color'] . ';';
$page_container_style .= '--tainacan-heading-color:' . $text_color_palette['color2']['color'] . ';';
$page_container_style .= '--tainacan-label-color:' . $text_color_palette['color3']['color'] . ';';
$page_container_style .= '--tainacan-info-color:' . $text_color_palette['color4']['color'] . ';';
$page_container_style .= '--tainacan-input-color:' . $text_color_palette['color5']['color'] . ';';

$page_container_style .= 'background-color: var(--tainacan-background-color, #f8f9fb);';

global $post;
?>

<?php get_header(); ?>
    <article class="<?php echo $page_container_classes ?>" style="<?php echo $page_container_style ?>">
        <header 
            class="tainacan-collection-header" 
            style="background-image: 
                <?php if ( get_header_image() ) { 
                    echo('linear-gradient(to bottom, rgba(255, 255, 255, ' . (get_theme_mod($prefix . '_page_header_background_style', 'boxed') == 'boxed' ? '0.3' : '0.8') . '), var(--tainacan-background-color, var(--background-color, #f8f9fb))), url(' . get_header_image() . ')'); 
                } else { 
                    echo ''; 
                } ?>"
        >
            <div class="tainacan-collection-header__box">  
                <?php 

                    $thumbnail_element = '';
                    $description_element = '';

                    $is_thumbnail_enabled = false;
                    $is_description_enabled = false;

                    $hero_elements = blocksy_akg_or_customizer(
                        'hero_elements',
                        [ 'prefix' => $prefix ],
                        []
                    );
                    foreach ($hero_elements as $index => $single_hero_element) {
                        if ($single_hero_element['id'] == 'custom_thumbnail' && $single_hero_element['enabled'] && has_post_thumbnail( tainacan_get_collection_id() )) {
                            $thumbnail_id = get_post_thumbnail_id( $post->ID );
                            $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

                            $thumbnail_element = '
                            <div class="collection-thumbnail">
                                <img src="' . get_the_post_thumbnail_url( tainacan_get_collection_id() ) . '" alt="' . esc_attr($alt) . '">
                            </div>
                            ';
                        } else if ($single_hero_element['id'] == 'custom_description' && $single_hero_element['enabled'] && get_the_archive_description()) {
                            $description_class = 'page-description';
                            $description_class .= ' ' . blocksy_visibility_classes(
                                blocksy_akg(
                                    'description_visibility',
                                    $single_hero_element,
                                    [
                                        'desktop' => true,
                                        'tablet' => true,
                                        'mobile' => false,
                                    ]
                                )
                            );
                            $description_element = '<div class="' . $description_class . '">' . get_the_archive_description() . '</div>';
                        }
                    }

                    $elements = 
                        $thumbnail_element . 
                        blocksy_render_view(
                            get_template_directory() . '/inc/components/hero/elements.php', [ 'type' => 'type-1' ]
                        ) . 
                        $description_element;
                        
                    echo blocksy_output_hero_section([
                        'type' => 'type-1',
                        'source' => false,
                        'elements' => $elements
                    ]);
                    
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
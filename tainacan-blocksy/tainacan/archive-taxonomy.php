<?php 

$terms_items_prefix = 'tainacan-terms-items_archive';
$_GET['blocksy_prefix'] = $terms_items_prefix;

$page_container_classes = 'page type-page hentry singular';
$page_container_classes = $page_container_classes . ( get_theme_mod($terms_items_prefix . '_filters_panel_background_style', 'boxed') == 'boxed' ? ' has-filters-panel-style-boxed' : '' );
$page_container_classes = $page_container_classes . ( get_theme_mod($terms_items_prefix . '_page_header_background_style', 'boxed') == 'boxed' ? ' has-page-header-style-boxed' : '' );

$filters_panel_size = get_theme_mod($terms_items_prefix . '_filters_panel_size', '20%');
$page_container_style = '--tainacan-filter-menu-width-theme:' . $filters_panel_size . ';';

$background_color_palette = get_theme_mod($terms_items_prefix . '_items_list_background_palette',
[
    'color1' => [ 'color' => 'var(--background-color, #f8f9fb)' ],
    'color2' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
    'color3' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
    'color4' => [ 'color' => 'var(--theme-form-field-background-initial-color, var(--theme-form-field-background-initial-color, #ffffff))' ],
    'color5' => [ 'color' => 'var(--background-color, #f8f9fb)' ],
    'color6' => [ 'color' => 'var(--theme-form-field-border-initial-color, var(--form-field-border-initial-color, #e0e5eb))' ]
]);
$page_container_style .= '--tainacan-background-color:' . $background_color_palette['color1']['color'] . ';';
$page_container_style .= '--tainacan-item-background-color:' . $background_color_palette['color2']['color'] . ';';
$page_container_style .= '--tainacan-item-hover-background-color:' . $background_color_palette['color3']['color'] . ';';
$page_container_style .= '--tainacan-input-background-color:' . $background_color_palette['color4']['color'] . ';';
$page_container_style .= '--tainacan-primary:' . $background_color_palette['color5']['color'] . ';';
$page_container_style .= '--tainacan-input-border-color:' . $background_color_palette['color6']['color'] . ';';

$text_color_palette = get_theme_mod($terms_items_prefix . '_items_list_text_palette',
[
    'color1' => [ 'color' => 'var(--theme-palette-color-1, var(--paletterColor1, #3eaf7c))' ],
    'color2' => [ 'color' => 'var(--theme-heading-color, var(--headingColor, rgba(44, 62, 80, 1)))' ],
    'color3' => [ 'color' => 'var(--theme-text-color, var(--color, #373839))' ],
    'color4' => [ 'color' => '#505253' ],
    'color5' => [ 'color' => 'var(--theme-form-text-initial-color, var(--formTextInitialColor, #373839))' ]
]);
$page_container_style .= '--tainacan-secondary:' . $text_color_palette['color1']['color'] . ';';
$page_container_style .= '--tainacan-heading-color:' . $text_color_palette['color2']['color'] . ';';
$page_container_style .= '--tainacan-label-color:' . $text_color_palette['color3']['color'] . ';';
$page_container_style .= '--tainacan-info-color:' . $text_color_palette['color4']['color'] . ';';
$page_container_style .= '--tainacan-input-color:' . $text_color_palette['color5']['color'] . ';';

$page_container_style .= 'background-color: var(--tainacan-background-color, #f8f9fb);';

// Fetches current term to obtain proper image
$current_term = tainacan_get_term();
$current_taxonomy = get_taxonomy( $current_term->taxonomy );
$current_term = \Tainacan\Repositories\Terms::get_instance()->fetch($current_term->term_id, $current_term->taxonomy);
$image = $current_term->get_header_image_id();
$thumbnail_src = wp_get_attachment_image_src($image, 'full');

?>

<?php get_header(); ?>
    <article class="<?php echo esc_attr($page_container_classes) ?>" style="<?php echo esc_attr($page_container_style) ?>">

        <header class="tainacan-collection-header tainacan-collection-header--term-page">
            <div class="tainacan-collection-header__box">  
                <?php 

                    $hero_elements = get_theme_mod(
                        $terms_items_prefix . '_hero_elements',
                        [
                            [
                                'id' => 'custom_thumbnail',
                                'enabled' => true,
                            ],
                            [
                                'id' => 'custom_title',
                                'enabled' => true,
                                'heading_tag' => 'h1'
                            ],
                            [
                                'id' => 'breadcrumbs',
                                'enabled' => true
                            ],
                            [
                                'id' => 'custom_description',
                                'enabled' => true,
                                'description_visibility' => [
                                    'desktop' => true,
                                    'tablet' => true,
                                    'mobile' => false,
                                ]
                            ]
                        ]
                    );
                    
                    $elements = [];
                    foreach ($hero_elements as $index => $single_hero_element) {
                        if ($single_hero_element['id'] == 'custom_thumbnail' && $single_hero_element['enabled'] && $thumbnail_src && $thumbnail_src[0]) {

                            $elements[] = '
                            <div class="collection-thumbnail">
                                <img src="' . $thumbnail_src[0] . '" alt="' . __('Term thumbnail', 'tainacan-blocksy') . '">
                            </div>
                            ';
                        } else if ($single_hero_element['id'] == 'custom_title' && $single_hero_element['enabled']) {
                            $title = '';

                            $has_category_label = blocksy_akg(
                                'has_category_label',
                                $single_hero_element,
                                'yes'
                            );

                            if (! empty(get_the_archive_title())) {
                                $title = wp_strip_all_tags(get_the_archive_title());
            
                                $divider_symbol = ':';
            
                                if (strpos($title, '：') !== false) {
                                    $divider_symbol = '：';
                                }
            
                                if (strpos($title, $divider_symbol) !== false) {
                                    $title_pieces = explode($divider_symbol, $title, 2);
            
                                    $title = '<span class="ct-title-label">' . $title_pieces[0] . '</span>' . $title_pieces[1];
            
                                    if ($has_category_label !== 'yes') {
                                        $title = $title_pieces[1];
                                    }
                                }
                            }

                            if (! empty($title)) {
                                $title = blocksy_html_tag(
                                    blocksy_akg('heading_tag', $single_hero_element, 'h1'),
                                    array_merge([
                                        'class' => 'page-title',
                                    ], blocksy_schema_org_definitions('headline', [
                                        'array' => true
                                    ])),
                                    $title
                                );
                            }

                            do_action('blocksy:hero:title:before');
                            $elements[] = $title;
                            do_action('blocksy:hero:title:after');
                            
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
                            $elements[] = '<div class="' . $description_class . '">' . get_the_archive_description() . '</div>';
                        } else if ($single_hero_element['id'] == 'breadcrumbs' && $single_hero_element['enabled']) {
                            $breadcrumbs_builder = new Blocksy_Breadcrumbs_Builder();
                            $elements[] = $breadcrumbs_builder->render();
                        }
                    }
                    
                    $html_elements = '';
                    foreach ($elements as $element) {
                        $html_elements .= $element;
                    }
                        
                    echo blocksy_output_hero_section([
                        'type' => 'type-1',
                        'source' => false,
                        'elements' => $html_elements
                    ]);
                ?>
            </div>
        </header>

        <div class="entry-content">										
            <?php 
                tainacan_the_faceted_search([
                    'hide_filters' => get_theme_mod($terms_items_prefix . '_display_filters_panel', 'yes') == 'no',
                    'start_with_filters_hidden' => get_theme_mod($terms_items_prefix . '_start_with_filters_hidden', 'no') == 'yes',
                    'hide_hide_filters_button' => get_theme_mod($terms_items_prefix . '_show_hide_filters_button', 'yes') == 'no',
                    'show_filters_button_inside_search_control' => get_theme_mod($terms_items_prefix . '_show_filters_button_inside_search_control', 'yes') == 'yes',
                    'filters_as_modal' => get_theme_mod($terms_items_prefix . '_filters_as_modal', 'no') == 'yes',
                    'hide_search' => get_theme_mod($terms_items_prefix . '_show_search', 'yes') == 'no',
                    'hide_advanced_search' => get_theme_mod($terms_items_prefix . '_show_advanced_search', 'yes') == 'no',
                    'hide_sorting_area' => get_theme_mod($terms_items_prefix . '_show_sorting_area', 'yes') == 'no',
                    'hide_sort_by_button' => get_theme_mod($terms_items_prefix . '_show_sort_by_button', 'yes') == 'no',
                    'hide_displayed_metadata_dropdown' => get_theme_mod($terms_items_prefix . '_show_displayed_metadata_dropdown', 'yes') == 'no',
                    'show_inline_view_mode_options' => get_theme_mod($terms_items_prefix . '_show_inline_view_mode_options', 'no') == 'yes',
                    'show_fullscreen_with_view_modes' => get_theme_mod($terms_items_prefix . '_show_fullscreen_with_view_modes', 'no') == 'yes',
                    'hide_exposers_button' => get_theme_mod($terms_items_prefix . '_show_exposers_button', 'yes') == 'no',
                    'hide_pagination_area' => get_theme_mod($terms_items_prefix . '_has_pagination', 'yes') == 'no',
                    'default_view_mode' => get_theme_mod($terms_items_prefix . '_default_view_mode', 'masonry')
                ]); 
            ?>
        </div>
    </article>

<?php get_footer(); ?>
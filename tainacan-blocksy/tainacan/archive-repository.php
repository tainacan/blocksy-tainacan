<?php 

$repository_items_prefix = 'tainacan-repository-items_archive';
$_GET['blocksy_prefix'] = $repository_items_prefix;

$page_hero_section_style = get_theme_mod($repository_items_prefix . '_hero_section' , get_theme_mod($repository_items_prefix . '_page_header_background_style', 'boxed'));

$page_container_classes = 'page type-page hentry singular';
$page_container_classes = $page_container_classes . ' has-filters-panel-style-' . get_theme_mod($repository_items_prefix . '_filters_panel_background_style', 'boxed');
$page_container_classes = $page_container_classes . ' has-page-header-style-' . $page_hero_section_style;

if ( get_theme_mod( $repository_items_prefix . '_hide_filters_area_header', 'no' ) === 'yes' )
    $page_container_classes .= ' has-filters-area-header-hidden';

$filters_panel_size = get_theme_mod($repository_items_prefix . '_filters_panel_size', '20%');
$page_container_style = '--tainacan-filter-menu-width-theme:' . $filters_panel_size . ';';

$filters_inline_size = get_theme_mod($repository_items_prefix . '_filters_inline_size', '272px');
$page_container_style .= '--tainacan-filters-inline-width:' . $filters_inline_size . ';';

$background_color_palette = get_theme_mod($repository_items_prefix . '_items_list_background_palette',
[
    'color1' => [ 'color' => 'var(--background-color, #f8f9fb)' ],
    'color2' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
    'color3' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
    'color4' => [ 'color' => 'var(--theme-form-field-background-initial-color, var(--form-field-background-initial-color, #ffffff))' ],
    'color5' => [ 'color' => 'var(--background-color, #f8f9fb)' ],
    'color6' => [ 'color' => 'var(--theme-form-field-border-initial-color, var(--form-field-border-initial-color, #e0e5eb))' ]
]);
$page_container_style .= '--tainacan-background-color:' . $background_color_palette['color1']['color'] . ';';
$page_container_style .= '--tainacan-item-background-color:' . $background_color_palette['color2']['color'] . ';';
$page_container_style .= '--tainacan-item-hover-background-color:' . $background_color_palette['color3']['color'] . ';';
$page_container_style .= '--tainacan-input-background-color:' . $background_color_palette['color4']['color'] . ';';
$page_container_style .= '--tainacan-primary:' . $background_color_palette['color5']['color'] . ';';
$page_container_style .= '--tainacan-input-border-color:' . $background_color_palette['color6']['color'] . ';';
$page_container_style .= '--theme-form-field-border-initial-color:' . $background_color_palette['color6']['color'] . ';';

$text_color_palette = get_theme_mod($repository_items_prefix . '_items_list_text_palette',
[
    'color1' => [ 'color' => 'var(--theme-palette-color-1, var(--paletteColor, #3eaf7c))' ],
    'color2' => [ 'color' => 'var(--theme-heading-color, var(--headingColor, rgba(44, 62, 80, 1)))' ],
    'color3' => [ 'color' => 'var(--theme-text-color, var(--color, #373839))' ],
    'color4' => [ 'color' => '#505253' ],
    'color5' => [ 'color' => 'var(--theme-form-text-initial-color, var(--form-text-initial-color, #373839))' ]
]);
$page_container_style .= '--tainacan-secondary:' . $text_color_palette['color1']['color'] . ';';
$page_container_style .= '--tainacan-heading-color:' . $text_color_palette['color2']['color'] . ';';
$page_container_style .= '--tainacan-label-color:' . $text_color_palette['color3']['color'] . ';';
$page_container_style .= '--tainacan-info-color:' . $text_color_palette['color4']['color'] . ';';
$page_container_style .= '--tainacan-input-color:' . $text_color_palette['color5']['color'] . ';';

$page_container_style .= 'background-color: var(--tainacan-background-color, #f8f9fb);';

$hero_elements = get_theme_mod(
    $repository_items_prefix . '_hero_elements',
    [
        [
            'id' => 'custom_title',
            'enabled' => true,
            'heading_tag' => 'h1'
        ],
        [
            'id' => 'breadcrumbs',
            'enabled' => false
        ],
    ]
);

$elements = [];
foreach ($hero_elements as $index => $single_hero_element) {
    if ( isset($single_hero_element['id']) && $single_hero_element['id'] == 'custom_title' && $single_hero_element['enabled']) {
        $title = wp_strip_all_tags(blocksy_akg('repository_items_title', $single_hero_element, __( 'All items in repository', 'tainacan' )));

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

        ob_start();
        do_action('blocksy:hero:title:before');
        $before_hero_title = ob_get_clean();

        ob_start();
        do_action('blocksy:hero:title:after');
        $after_hero_title = ob_get_clean();
        
        $elements[] = $before_hero_title . $title . $after_hero_title;
        
    } else if ( isset($single_hero_element['id']) && $single_hero_element['id'] == 'breadcrumbs' && $single_hero_element['enabled']) {
        if ( class_exists('Blocksy_Breadcrumbs_Builder') )
            $breadcrumbs_builder = new Blocksy_Breadcrumbs_Builder();
        else
            $breadcrumbs_builder = new \Blocksy\BreadcrumbsBuilder();

        $elements[] = $breadcrumbs_builder->render();
    }
}

$html_elements = '';
foreach ($elements as $element) {
    $html_elements .= $element;
}

add_filter('blocksy:general:body-attr', function($attrs) {
    $attrs['data-prefix'] = 'tainacan-repository-items_archive';
    return $attrs;
}, 10, 1);

add_filter('blocksy:hero:custom-source', function() {
    return [
        'strategy' => 'customizer',
        'prefix' => 'tainacan-repository-items_archive'
    ];
});

get_header(); 

if ( $page_hero_section_style === 'type-2' ) {
    echo blocksy_output_hero_section([
        'type' => $page_hero_section_style,
        'source' => false,
        'elements' => $html_elements
    ]);
}
?>
    <article class="<?php echo esc_attr($page_container_classes) ?>" style="<?php echo esc_attr($page_container_style) ?>">
    <?php
        if ( $page_hero_section_style === 'type-1' ) {
            echo blocksy_output_hero_section([
                'type' => $page_hero_section_style,
                'source' => false,
                'elements' => $html_elements
            ]);
        }
        
        if ( get_theme_mod($repository_items_prefix . '_hero_enabled', 'yes') === 'yes' && $page_hero_section_style !== 'type-1' && $page_hero_section_style !== 'type-2' ): ?>    
            <header class="tainacan-collection-header tainacan-collection-header--repository-page entry-header">
                <div class="tainacan-collection-header__box">  
                    <?php echo $html_elements; ?>
                </div>
            </header>
        <?php endif; ?>

        <div class="entry-content <?php echo get_theme_mod($repository_items_prefix . '_container-width', 'fluid') !== 'fluid' ? 'ct-container' : ''; ?>">
            <?php 
                tainacan_the_faceted_search([
                    'hide_filters' => get_theme_mod($repository_items_prefix . '_display_filters_panel', 'yes') == 'no',
                    'start_with_filters_hidden' => get_theme_mod($repository_items_prefix . '_start_with_filters_hidden', 'no') == 'yes',
                    'hide_hide_filters_button' => get_theme_mod($repository_items_prefix . '_show_hide_filters_button', 'yes') == 'no',
                    'show_filters_button_inside_search_control' => get_theme_mod($repository_items_prefix . '_show_filters_button_inside_search_control', 'yes') == 'yes',
                    'filters_as_modal' => get_theme_mod($repository_items_prefix . '_filters_as_modal', 'no') == 'yes',
                    'hide_search' => get_theme_mod($repository_items_prefix . '_show_search', 'yes') == 'no',
                    'hide_advanced_search' => get_theme_mod($repository_items_prefix . '_show_advanced_search', 'yes') == 'no',
                    'hide_sorting_area' => get_theme_mod($repository_items_prefix . '_show_sorting_area', 'yes') == 'no',
                    'hide_sort_by_button' => get_theme_mod($repository_items_prefix . '_show_sort_by_button', 'yes') == 'no',
                    'hide_displayed_metadata_dropdown' => get_theme_mod($repository_items_prefix . '_show_displayed_metadata_dropdown', 'yes') == 'no',
                    'show_inline_view_mode_options' => get_theme_mod($repository_items_prefix . '_show_inline_view_mode_options', 'no') == 'yes',
                    'show_fullscreen_with_view_modes' => get_theme_mod($repository_items_prefix . '_show_fullscreen_with_view_modes', 'no') == 'yes',
                    'hide_exposers_button' => get_theme_mod($repository_items_prefix . '_show_exposers_button', 'yes') == 'no',
                    'hide_pagination_area' => get_theme_mod($repository_items_prefix . '_has_pagination', 'yes') == 'no',
                    'default_view_mode' => get_theme_mod($repository_items_prefix . '_default_view_mode', 'masonry'),
                    'should_not_hide_filters_on_mobile' => get_theme_mod($repository_items_prefix . '_should_not_hide_filters_on_mobile', 'no') == 'yes',
                    'display_filters_horizontally' => get_theme_mod($repository_items_prefix . '_display_filters_horizontally', 'no') == 'yes',
                    'hide_filter_collapses' => get_theme_mod($repository_items_prefix . '_hide_filter_collapses', 'no') == 'yes',
                ]); 
            ?>
        </div>

    </article>
    
<?php get_footer(); ?>
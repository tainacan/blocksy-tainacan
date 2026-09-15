<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Invokes Blocksy theme hooks.

$tainacan_blocksy_prefix = blocksy_manager()->screen->get_prefix();

$tainacan_blocksy_page_hero_section_style = get_theme_mod($tainacan_blocksy_prefix . '_hero_section' , get_theme_mod($tainacan_blocksy_prefix . '_page_header_background_style', 'boxed'));

$tainacan_blocksy_page_container_classes = 'page type-page hentry singular';
$tainacan_blocksy_page_container_classes = $tainacan_blocksy_page_container_classes . ' has-filters-panel-style-' . get_theme_mod($tainacan_blocksy_prefix . '_filters_panel_background_style', 'boxed');
$tainacan_blocksy_page_container_classes = $tainacan_blocksy_page_container_classes . ' has-page-header-style-' . $tainacan_blocksy_page_hero_section_style;

if ( get_theme_mod( $tainacan_blocksy_prefix . '_hide_filters_area_header', 'no' ) === 'yes' )
    $tainacan_blocksy_page_container_classes .= ' has-filters-area-header-hidden';    

$tainacan_blocksy_filters_panel_size = get_theme_mod($tainacan_blocksy_prefix . '_filters_panel_size', '20%');
$tainacan_blocksy_page_container_style = '--tainacan-filter-menu-width-theme:' . $tainacan_blocksy_filters_panel_size . ';';

$tainacan_blocksy_filters_inline_size = get_theme_mod($tainacan_blocksy_prefix . '_filters_inline_size', '272px');
$tainacan_blocksy_page_container_style .= '--tainacan-filters-inline-width:' . $tainacan_blocksy_filters_inline_size . ';';

$tainacan_blocksy_background_color_palette = get_theme_mod($tainacan_blocksy_prefix . '_items_list_background_palette',
[
    'color1' => [ 'color' => 'var(--background-color, #f8f9fb)' ],
    'color2' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
    'color3' => [ 'color' => 'var(--cardBackground, #ffffff)' ],
    'color4' => [ 'color' => 'var(--theme-form-field-background-initial-color, var(--form-field-initial-background, #ffffff))' ],
    'color5' => [ 'color' => 'var(--theme-form-field-border-initial-color, var(--form-field-border-initial-color, #e0e5eb))' ],
    'color6' => [ 'color' => 'var(--theme-form-field-border-initial-color, var(--form-field-border-initial-color, #e0e5eb))' ]
]);
$tainacan_blocksy_page_container_style .= '--tainacan-background-color:' . $tainacan_blocksy_background_color_palette['color1']['color'] . ';';
$tainacan_blocksy_page_container_style .= '--tainacan-item-background-color:' . $tainacan_blocksy_background_color_palette['color2']['color'] . ';';
$tainacan_blocksy_page_container_style .= '--tainacan-item-hover-background-color:' . $tainacan_blocksy_background_color_palette['color3']['color'] . ';';
$tainacan_blocksy_page_container_style .= '--tainacan-input-background-color:' . $tainacan_blocksy_background_color_palette['color4']['color'] . ';';
$tainacan_blocksy_page_container_style .= '--tainacan-primary:' . $tainacan_blocksy_background_color_palette['color5']['color'] . ';';

if ( isset( $tainacan_blocksy_background_color_palette['color6'] ) ) {
    $tainacan_blocksy_page_container_style .= '--tainacan-input-border-color:' . $tainacan_blocksy_background_color_palette['color6']['color'] . ';';
    $tainacan_blocksy_page_container_style .= '--theme-form-field-border-initial-color:' . $tainacan_blocksy_background_color_palette['color6']['color'] . ';';
}

$tainacan_blocksy_text_color_palette = get_theme_mod($tainacan_blocksy_prefix . '_items_list_text_palette',
[
    'color1' => [ 'color' => 'var(--theme-palette-color-1, var(--paletteColor1, #3eaf7c))' ],
    'color2' => [ 'color' => 'var(--theme-heading-color, var(--headingColor, rgba(44, 62, 80, 1)))' ],
    'color3' => [ 'color' => 'var(--theme-text-color, var(--color, #373839))' ],
    'color4' => [ 'color' => '#505253' ],
    'color5' => [ 'color' => 'var(--theme-form-text-initial-color, var(--formTextInitialColor, #373839))' ]
]);
$tainacan_blocksy_page_container_style .= '--tainacan-secondary:' . $tainacan_blocksy_text_color_palette['color1']['color'] . ';';
$tainacan_blocksy_page_container_style .= '--tainacan-heading-color:' . $tainacan_blocksy_text_color_palette['color2']['color'] . ';';
$tainacan_blocksy_page_container_style .= '--tainacan-label-color:' . $tainacan_blocksy_text_color_palette['color3']['color'] . ';';
$tainacan_blocksy_page_container_style .= '--tainacan-info-color:' . $tainacan_blocksy_text_color_palette['color4']['color'] . ';';
$tainacan_blocksy_page_container_style .= '--tainacan-input-color:' . $tainacan_blocksy_text_color_palette['color5']['color'] . ';';

$tainacan_blocksy_page_container_style .= 'background-color: var(--tainacan-background-color, #f8f9fb);';

global $post;

$tainacan_blocksy_hero_elements = blocksy_akg_or_customizer(
    'hero_elements',
    [ 'prefix' => $tainacan_blocksy_prefix ],
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

$tainacan_blocksy_elements = [];

foreach ($tainacan_blocksy_hero_elements as $tainacan_blocksy_index => $tainacan_blocksy_single_hero_element) {
    
    if ($tainacan_blocksy_single_hero_element['id'] == 'custom_thumbnail' && $tainacan_blocksy_single_hero_element['enabled'] && has_post_thumbnail( tainacan_get_collection_id() )) {
        $tainacan_blocksy_thumbnail_id = get_post_thumbnail_id( $post->ID );
        $tainacan_blocksy_alt = get_post_meta($tainacan_blocksy_thumbnail_id, '_wp_attachment_image_alt', true);

        $tainacan_blocksy_elements[] = '
        <div class="collection-thumbnail">
            <img src="' . get_the_post_thumbnail_url( tainacan_get_collection_id() ) . '" alt="' . esc_attr($tainacan_blocksy_alt) . '">
        </div>
        ';

        add_filter( 'blocksy:hero:wrapper-attr', function($tainacan_blocksy_attrs) {
            $tainacan_blocksy_attrs['class'] .= ' has-thumbnail-enabled';
            return $tainacan_blocksy_attrs;
        });

    } else if ($tainacan_blocksy_single_hero_element['id'] == 'custom_title' && $tainacan_blocksy_single_hero_element['enabled']) {
        $tainacan_blocksy_title = '';

        $tainacan_blocksy_has_category_label = blocksy_akg(
            'has_category_label',
            $tainacan_blocksy_single_hero_element,
            'no'
        );

        if ( !empty(get_the_archive_title()) ) {
            $tainacan_blocksy_title = wp_strip_all_tags(get_the_archive_title());

            $tainacan_blocksy_divider_symbol = ':';

            if (strpos($tainacan_blocksy_title, '：') !== false) {
                $tainacan_blocksy_divider_symbol = '：';
            }

            if (strpos($tainacan_blocksy_title, $tainacan_blocksy_divider_symbol) !== false) {
                $tainacan_blocksy_title_pieces = explode($tainacan_blocksy_divider_symbol, $tainacan_blocksy_title, 2);

                $tainacan_blocksy_title = '<span class="ct-title-label">' . $tainacan_blocksy_title_pieces[0] . '</span>' . $tainacan_blocksy_title_pieces[1];

                if ($tainacan_blocksy_has_category_label !== 'yes') {
                    $tainacan_blocksy_title = $tainacan_blocksy_title_pieces[1];
                }
            }
        }

        if ( !empty($tainacan_blocksy_title) ) {
            $tainacan_blocksy_title = blocksy_html_tag(
                blocksy_akg('heading_tag', $tainacan_blocksy_single_hero_element, 'h1'),
                array_merge([
                    'class' => 'page-title',
                ], blocksy_schema_org_definitions('headline', [
                    'array' => true
                ])),
                $tainacan_blocksy_title
            );
        }

        ob_start();
        do_action('blocksy:hero:title:before');
        $tainacan_blocksy_before_hero_title = ob_get_clean();

        ob_start();
        do_action('blocksy:hero:title:after');
        $tainacan_blocksy_after_hero_title = ob_get_clean();
        
        $tainacan_blocksy_elements[] = $tainacan_blocksy_before_hero_title . $tainacan_blocksy_title . $tainacan_blocksy_after_hero_title;
        
    } else if ($tainacan_blocksy_single_hero_element['id'] == 'custom_description' && $tainacan_blocksy_single_hero_element['enabled'] && tainacan_get_the_collection_description()) {
        $tainacan_blocksy_description_class = 'page-description';
        $tainacan_blocksy_description_class .= ' ' . blocksy_visibility_classes(
            blocksy_akg(
                'description_visibility',
                $tainacan_blocksy_single_hero_element,
                [
                    'desktop' => true,
                    'tablet' => true,
                    'mobile' => false,
                ]
            )
        );
        $tainacan_blocksy_elements[] = '<div class="' . $tainacan_blocksy_description_class . '">' . tainacan_get_the_collection_description() . '</div>';
    } else if ($tainacan_blocksy_single_hero_element['id'] == 'breadcrumbs' && $tainacan_blocksy_single_hero_element['enabled']) {
        if ( class_exists('Blocksy_Breadcrumbs_Builder') )
            $tainacan_blocksy_breadcrumbs_builder = new Blocksy_Breadcrumbs_Builder();
        else
            $tainacan_blocksy_breadcrumbs_builder = new \Blocksy\BreadcrumbsBuilder();

        $tainacan_blocksy_elements[] = $tainacan_blocksy_breadcrumbs_builder->render();
    }
}

$tainacan_blocksy_html_elements = '';
foreach ($tainacan_blocksy_elements as $tainacan_blocksy_element) {

    $tainacan_blocksy_html_elements .= $tainacan_blocksy_element;
}

get_header();

add_filter('blocksy:hero:custom-source', function() use($tainacan_blocksy_prefix) {
    return [
        'strategy' => 'customizer',
        'prefix' => $tainacan_blocksy_prefix
    ];
});

if ( $tainacan_blocksy_page_hero_section_style === 'type-2' ) {
    if ( blocksy_akg_or_customizer('page_title_bg_type', blocksy_get_page_title_source(), 'featured_image') === 'featured_image' ) {
        add_filter( 'blocksy:hero:type-2:image:attachment_id', function() {
            $tainacan_blocksy_collection = tainacan_get_collection();
            return $tainacan_blocksy_collection->get_header_image_id();
        }, 10 );
    }

    /**
     * Note to code reviewers: This line doesn't need to be escaped.
     * Function blocksy_output_hero_section() used here escapes the value properly.
     */
    echo blocksy_output_hero_section([ // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        'type' => $tainacan_blocksy_page_hero_section_style,
        'source' => false,
        'elements' => $tainacan_blocksy_html_elements
    ]);
}
?>                    
    <article class="<?php echo esc_attr($tainacan_blocksy_page_container_classes) ?>" style="<?php echo esc_attr($tainacan_blocksy_page_container_style) ?>">

    <?php
        if ( $tainacan_blocksy_page_hero_section_style === 'type-1' ) {
            /**
             * Note to code reviewers: This line doesn't need to be escaped.
             * Function blocksy_output_hero_section() used here escapes the value properly.
             */
            echo blocksy_output_hero_section([ // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                'type' => $tainacan_blocksy_page_hero_section_style,
                'source' => false,
                'elements' => $tainacan_blocksy_html_elements
            ]);
        }
        
        if ( get_theme_mod($tainacan_blocksy_prefix . '_hero_enabled', 'yes') === 'yes' && $tainacan_blocksy_page_hero_section_style !== 'type-1' && $tainacan_blocksy_page_hero_section_style !== 'type-2' ): ?>
            <header 
                class="tainacan-collection-header entry-header" 
                style="background-image: 
                    <?php if ( get_header_image() ) 
                        echo('linear-gradient(to bottom, rgba(255, 255, 255, ' . ($tainacan_blocksy_page_hero_section_style == 'boxed' ? '0.3' : '0.8') . '), var(--tainacan-background-color, var(--background-color, #f8f9fb))), url(' . esc_url(get_header_image()) . ')'); 
                    else
                        echo 'none'; 
                    ?>"
            >
                <div class="tainacan-collection-header__box">  
                    <?php
                    /**
                     * Note to code reviewers: This line doesn't need to be escaped.
                     * Hero elements are assembled from Blocksy helpers (blocksy_html_tag, BreadcrumbsBuilder) that escape properly.
                     * wp_kses_post() would strip SVG breadcrumb separators.
                     */
                    echo $tainacan_blocksy_html_elements; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?>
                </div>
            </header>
        <?php endif; ?>

        <div class="entry-content <?php echo get_theme_mod($tainacan_blocksy_prefix . '_container-width', 'fluid') !== 'fluid' ? 'ct-container' : ''; ?>">
            <?php 
                tainacan_the_faceted_search([
                    'hide_filters' => get_theme_mod($tainacan_blocksy_prefix . '_display_filters_panel', 'yes') == 'no',
                    'start_with_filters_hidden' => get_theme_mod($tainacan_blocksy_prefix . '_start_with_filters_hidden', 'no') == 'yes',
                    'hide_hide_filters_button' => get_theme_mod($tainacan_blocksy_prefix . '_show_hide_filters_button', 'yes') == 'no',
                    'show_filters_button_inside_search_control' => get_theme_mod($tainacan_blocksy_prefix . '_show_filters_button_inside_search_control', 'yes') == 'yes',
                    'filters_as_modal' => get_theme_mod($tainacan_blocksy_prefix . '_filters_as_modal', 'no') == 'yes',
                    'hide_search' => get_theme_mod($tainacan_blocksy_prefix . '_show_search', 'yes') == 'no',
                    'hide_advanced_search' => get_theme_mod($tainacan_blocksy_prefix . '_show_advanced_search', 'yes') == 'no',
                    'hide_sorting_area' => get_theme_mod($tainacan_blocksy_prefix . '_show_sorting_area', 'yes') == 'no',
                    'hide_sort_by_button' => get_theme_mod($tainacan_blocksy_prefix . '_show_sort_by_button', 'yes') == 'no',
                    'hide_displayed_metadata_button' => get_theme_mod($tainacan_blocksy_prefix . '_show_displayed_metadata_dropdown', 'yes') == 'no',
                    'show_inline_view_mode_options' => get_theme_mod($tainacan_blocksy_prefix . '_show_inline_view_mode_options', 'no') == 'yes',
                    'show_fullscreen_with_view_modes' => get_theme_mod($tainacan_blocksy_prefix . '_show_fullscreen_with_view_modes', 'no') == 'yes',
                    'hide_exposers_button' => get_theme_mod($tainacan_blocksy_prefix . '_show_exposers_button', 'yes') == 'no',
                    'hide_pagination_area' => get_theme_mod($tainacan_blocksy_prefix . '_has_pagination', 'yes') == 'no',
                    'hide_items_per_page_button' => get_theme_mod($tainacan_blocksy_prefix . '_show_items_per_page_button', 'yes') == 'no',
                    'hide_go_to_page_button' => get_theme_mod($tainacan_blocksy_prefix . '_show_go_to_page_button', 'yes') == 'no',
                    'should_not_hide_filters_on_mobile' => get_theme_mod($tainacan_blocksy_prefix . '_should_not_hide_filters_on_mobile', 'no') == 'yes',
                    'display_filters_horizontally' => get_theme_mod($tainacan_blocksy_prefix . '_display_filters_horizontally', 'no') == 'yes',
                    'hide_filter_collapses' => get_theme_mod($tainacan_blocksy_prefix . '_hide_filter_collapses', 'no') == 'yes',
                ]); 
            ?>
        </div>

    </article>
    
<?php get_footer(); ?>
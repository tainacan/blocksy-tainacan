<?php 

$page_container_classes = 'page type-page hentry singular';
$page_container_classes = $page_container_classes . ( get_theme_mod('tainacan-terms-items_filters_panel_background_style', 'boxed') == 'boxed' ? ' has-filters-panel-style-boxed' : '' );

$filters_panel_size = get_theme_mod('tainacan-terms-items_filters_panel_size', '20%');
$page_container_style = '--tainacan-filter-menu-width-theme:' . $filters_panel_size . ';';

$background_color_palette = get_theme_mod('tainacan-terms-items_items_list_background_palette',
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

$text_color_palette = get_theme_mod('tainacan-terms-items_items_list_text_palette',
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

$current_term = tainacan_get_term();
$current_taxonomy = get_taxonomy( $current_term->taxonomy );
$current_term = \Tainacan\Repositories\Terms::get_instance()->fetch($current_term->term_id, $current_term->taxonomy);
$image = $current_term->get_header_image_id();
$src = wp_get_attachment_image_src($image, 'full');
?>

<?php get_header(); ?>
    <article class="<?php echo $page_container_classes ?>" style="<?php echo $page_container_style ?>">

        <header class="tainacan-collection-header">
            <div class="tainacan-collection-header__box">  
                <?php if ($src && $src[0]) : ?>
                    <div class="collection-thumbnail">
                        <img src="<?php echo($src[0]) ?>">
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
                    'show-filters-button-inside-search-control' => true
                ]); 
            ?>
        </div>
    </article>

<?php get_footer(); ?>
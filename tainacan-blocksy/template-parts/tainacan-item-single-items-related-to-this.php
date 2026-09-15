<?php

// phpcs:disable WordPress.WP.I18n.TextDomainMismatch -- All translatable strings in this file reuse translations from the Tainacan plugin.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    $prefix = blocksy_manager()->screen->get_prefix();
    
    $section_label                = get_theme_mod( $prefix . '_section_items_related_to_this_label', __( 'Items related to this', 'tainacan' ) );
    $items_related_to_this_layout = get_theme_mod( $prefix . '_items_related_to_this_layout', 'carousel' );
    $max_columns_count            = get_theme_mod( $prefix . '_items_related_to_this_max_columns_count', 4 );
    $max_items_per_screen         = get_theme_mod( $prefix . '_items_related_to_this_max_items_per_screen', 6 );
    $variable_items_width         = get_theme_mod( $prefix . '_items_related_to_this_variable_items_width', 'no') === 'yes';
    $max_items_number             = get_theme_mod( $prefix . '_items_related_to_this_max_items_number', 12 );
    $order_option                 = get_theme_mod( $prefix . '_items_related_to_this_order', 'title_asc' );
    $hide_collection_heading      = get_theme_mod( $prefix . '_items_related_to_this_hide_collection_heading', 'no' ) === 'yes';
    $hide_metadata_label          = get_theme_mod( $prefix . '_items_related_to_this_hide_metadata_label', 'no' ) === 'yes';
    $view_modes = tainacan_get_default_view_mode_choices();
    $default_fallback_view_mode = isset($view_modes['default_view_mode']) ? $view_modes['default_view_mode'] : 'masonry';
    $tainacan_view_mode           = get_theme_mod( $prefix . '_items_related_to_this_tainacan_view_mode', $default_fallback_view_mode );
    $image_size                   = get_theme_mod( $prefix . '_items_related_to_this_image_size', 'tainacan-medium');
    $view_more_links_position     = get_theme_mod( $prefix . '_items_related_to_this_view_more_links_position', 'bottom-left' );
    $view_more_links_style        = get_theme_mod( $prefix . '_items_related_to_this_view_more_links_style', 'button' );
    $open_lightbox_on_click       = get_theme_mod( $prefix . '_items_related_to_this_enable_lightbox', 'yes' ) === 'yes';
    $gallery_spacing              = get_theme_mod( $prefix . '_items_related_to_this_gallery_spacing', 'default' );
    $thumbs_layout                = 'carousel';
    $hide_image_thumbnails        = false;

    if ( function_exists( 'tainacan_blocksy_has_media_thumbs_layout' ) && tainacan_blocksy_has_media_thumbs_layout() ) {
        $thumbs_layout = tainacan_sanitize_media_thumbs_layout(
            get_theme_mod( $prefix . '_items_related_to_this_thumbs_layout', 'carousel' )
        );
        $hide_image_thumbnails = get_theme_mod( $prefix . '_items_related_to_this_hide_image_thumbnails', 'no' ) === 'yes';
    }

    $is_list_thumbs = $thumbs_layout === 'list';
    $is_gallery_layout = strpos( $items_related_to_this_layout, 'gallery-' ) !== false;
    $gallery_data_attributes = '';

    if ( $is_gallery_layout && function_exists( 'tainacan_blocksy_get_item_gallery_data_attributes' ) ) {
        $gallery_data_attributes = tainacan_blocksy_get_item_gallery_data_attributes( $prefix );
    }

    $order_option_split = explode( '_', $order_option ); 
    $order_by = $order_option_split[0] ? $order_option_split[0] : 'title';
    $order = $order_option_split[1] ? $order_option_split[1] : 'asc';

    if ( !in_array($order_by, [ 'title', 'date', 'modified' ]) )
        $order_by = 'title';

    if ( !in_array($order, [ 'asc', 'desc' ]) )
        $order = 'asc';

    if ( function_exists('tainacan_the_related_items_carousel') && (get_theme_mod( $prefix . '_display_items_related_to_this', 'no' ) === 'yes') && tainacan_has_related_items() ) : ?>
    
    <section class="tainacan-item-section tainacan-item-section--items-related-to-this <?php echo esc_attr(' tainacan-media-component-wrapper-spacing--' . $gallery_spacing ) ?>"<?php echo $gallery_data_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper ?>>
        
        <?php if ( get_theme_mod($prefix . '_display_section_labels', 'yes') == 'yes' && $section_label != '') : ?>
            <h2 class="tainacan-single-item-section" id="tainacan-item-items-related-to-this-label">
                <?php echo esc_html( $section_label ); ?>
            </h2>
        <?php endif; ?>
        <div class="tainacan-item-section__items-related-to-this">
            <?php 
                $items_gallery_options = [];
                if ( $is_gallery_layout ) {

                    $items_gallery_options = $items_related_to_this_layout == 'gallery-slider' ?
                        array(
                            'layoutElements' => array( 'main' => true, 'thumbnails' => true ),
                            'hideItemTitleMain' => false,
                            'thumbsHaveFixedHeight' => ! $is_list_thumbs && $variable_items_width,
                            'thumbnailsSize' => $image_size,
                            'openLightboxOnClick' => $open_lightbox_on_click,
                        ) :
                        array(
                            'layoutElements' => array( 'main' => false, 'thumbnails' => true ),
                            'hideItemTitleMain' => false,
                            'thumbsHaveFixedHeight' => ! $is_list_thumbs && $variable_items_width,
                            'thumbnailsSize' => $image_size,
                            'openLightboxOnClick' => $open_lightbox_on_click,
                        );

                    if ( function_exists( 'tainacan_blocksy_has_media_thumbs_layout' ) && tainacan_blocksy_has_media_thumbs_layout() ) {
                        $items_gallery_options['thumbsLayout'] = $thumbs_layout;
                        $items_gallery_options['hideImageThumbnails'] = $is_list_thumbs && $hide_image_thumbnails;
                    }

                    $items_related_to_this_layout = 'gallery';

                    if ( $gallery_spacing === 'minimum' && $thumbs_layout === 'carousel' ) {
                        add_filter( 'tainacan-swiper-thumbs-options', function($options) {
                            return array_merge(
                                $options,
                                array(
                                    'spaceBetween' => 0
                                )
                            );
                        }, 9 , 1);
                    }
                }

                tainacan_the_related_items_carousel([
                    'items_list_layout' => $items_related_to_this_layout,
                    'collection_heading_tag' => 'h3',
                    'order' => $order,
                    'orderby' => $order_by,
                    'max_items_number' => $max_items_number,
                    'hide_collection_heading' => $hide_collection_heading,
                    'hide_metadata_label' => $hide_metadata_label,
                    'view_more_link_position' => $view_more_links_position,
                    'view_more_link_style' => $view_more_links_style,
                    'dynamic_items_args' => [
                        'max_columns_count' => $max_columns_count,
                        'image_size' => $image_size,
                        'tainacan_view_mode' => $tainacan_view_mode,
                    ],
                    'carousel_args' => [
                        'max_items_per_screen' => $max_items_per_screen,
                        'image_size' => $image_size,
                        'variable_items_width' => $variable_items_width,
                    ],
                    'items_gallery_args' => $items_gallery_options
                ]);
            ?>
        <div>

    </section>
<?php endif; ?>
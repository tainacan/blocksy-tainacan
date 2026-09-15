<?php

// phpcs:disable WordPress.WP.I18n.TextDomainMismatch -- All translatable strings in this file reuse translations from the Tainacan plugin.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Invokes Tainacan core hooks.

    $tainacan_blocksy_prefix = blocksy_manager()->screen->get_prefix();
    
    $tainacan_blocksy_section_label                = get_theme_mod( $tainacan_blocksy_prefix . '_section_items_related_to_this_label', __( 'Items related to this', 'tainacan' ) );
    $tainacan_blocksy_items_related_to_this_layout = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_layout', 'carousel' );
    $tainacan_blocksy_max_columns_count            = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_max_columns_count', 4 );
    $tainacan_blocksy_max_items_per_screen         = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_max_items_per_screen', 6 );
    $tainacan_blocksy_variable_items_width         = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_variable_items_width', 'no') === 'yes';
    $tainacan_blocksy_max_items_number             = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_max_items_number', 12 );
    $tainacan_blocksy_order_option                 = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_order', 'title_asc' );
    $tainacan_blocksy_hide_collection_heading      = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_hide_collection_heading', 'no' ) === 'yes';
    $tainacan_blocksy_hide_metadata_label          = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_hide_metadata_label', 'no' ) === 'yes';
    $tainacan_blocksy_view_modes = tainacan_get_default_view_mode_choices();
    $tainacan_blocksy_default_fallback_view_mode = isset($tainacan_blocksy_view_modes['default_view_mode']) ? $tainacan_blocksy_view_modes['default_view_mode'] : 'masonry';
    $tainacan_blocksy_tainacan_view_mode  = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_tainacan_view_mode', $tainacan_blocksy_default_fallback_view_mode );
    $tainacan_blocksy_image_size                   = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_image_size', 'tainacan-medium');
    $tainacan_blocksy_view_more_links_position     = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_view_more_links_position', 'bottom-left' );
    $tainacan_blocksy_view_more_links_style        = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_view_more_links_style', 'button' );
    $tainacan_blocksy_open_lightbox_on_click       = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_enable_lightbox', 'yes' ) === 'yes';
    $tainacan_blocksy_gallery_spacing              = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_gallery_spacing', 'default' );
    $tainacan_blocksy_thumbs_layout                = 'carousel';
    $tainacan_blocksy_hide_image_thumbnails        = false;

    if ( function_exists( 'tainacan_blocksy_has_media_thumbs_layout' ) && tainacan_blocksy_has_media_thumbs_layout() ) {
        $tainacan_blocksy_thumbs_layout = tainacan_sanitize_media_thumbs_layout(
            get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_thumbs_layout', 'carousel' )
        );
        $tainacan_blocksy_hide_image_thumbnails = get_theme_mod( $tainacan_blocksy_prefix . '_items_related_to_this_hide_image_thumbnails', 'no' ) === 'yes';
    }

    $tainacan_blocksy_is_list_thumbs = $tainacan_blocksy_thumbs_layout === 'list';
    $tainacan_blocksy_is_gallery_layout = strpos( $tainacan_blocksy_items_related_to_this_layout, 'gallery-' ) !== false;
    $tainacan_blocksy_gallery_data_attributes = '';

    if ( $tainacan_blocksy_is_gallery_layout && function_exists( 'tainacan_blocksy_get_item_gallery_data_attributes' ) ) {
        $tainacan_blocksy_gallery_data_attributes = tainacan_blocksy_get_item_gallery_data_attributes( $tainacan_blocksy_prefix );
    }

    $tainacan_blocksy_order_option_split = explode( '_', $tainacan_blocksy_order_option ); 
    $tainacan_blocksy_order_by = $tainacan_blocksy_order_option_split[0] ? $tainacan_blocksy_order_option_split[0] : 'title';
    $tainacan_blocksy_order = $tainacan_blocksy_order_option_split[1] ? $tainacan_blocksy_order_option_split[1] : 'asc';

    if ( !in_array($tainacan_blocksy_order_by, [ 'title', 'date', 'modified' ]) )
        $tainacan_blocksy_order_by = 'title';

    if ( !in_array($tainacan_blocksy_order, [ 'asc', 'desc' ]) )
        $tainacan_blocksy_order = 'asc';

    if ( function_exists('tainacan_the_related_items_carousel') && (get_theme_mod( $tainacan_blocksy_prefix . '_display_items_related_to_this', 'no' ) === 'yes') && tainacan_has_related_items() ) : ?>
    
    <section class="tainacan-item-section tainacan-item-section--items-related-to-this <?php echo esc_attr(' tainacan-media-component-wrapper-spacing--' . $tainacan_blocksy_gallery_spacing ) ?>"<?php echo $tainacan_blocksy_gallery_data_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper ?>>
        
        <?php if ( get_theme_mod($tainacan_blocksy_prefix . '_display_section_labels', 'yes') == 'yes' && $tainacan_blocksy_section_label != '') : ?>
            <h2 class="tainacan-single-item-section" id="tainacan-item-items-related-to-this-label">
                <?php echo esc_html( $tainacan_blocksy_section_label ); ?>
            </h2>
        <?php endif; ?>
        <div class="tainacan-item-section__items-related-to-this">
            <?php 
                $tainacan_blocksy_items_gallery_options = [];
                if ( $tainacan_blocksy_is_gallery_layout ) {

                    $tainacan_blocksy_items_gallery_options = $tainacan_blocksy_items_related_to_this_layout == 'gallery-slider' ?
                        array(
                            'layoutElements' => array( 'main' => true, 'thumbnails' => true ),
                            'hideItemTitleMain' => false,
                            'thumbsHaveFixedHeight' => ! $tainacan_blocksy_is_list_thumbs && $tainacan_blocksy_variable_items_width,
                            'thumbnailsSize' => $tainacan_blocksy_image_size,
                            'openLightboxOnClick' => $tainacan_blocksy_open_lightbox_on_click,
                        ) :
                        array(
                            'layoutElements' => array( 'main' => false, 'thumbnails' => true ),
                            'hideItemTitleMain' => false,
                            'thumbsHaveFixedHeight' => ! $tainacan_blocksy_is_list_thumbs && $tainacan_blocksy_variable_items_width,
                            'thumbnailsSize' => $tainacan_blocksy_image_size,
                            'openLightboxOnClick' => $tainacan_blocksy_open_lightbox_on_click,
                        );

                    if ( function_exists( 'tainacan_blocksy_has_media_thumbs_layout' ) && tainacan_blocksy_has_media_thumbs_layout() ) {
                        $tainacan_blocksy_items_gallery_options['thumbsLayout'] = $tainacan_blocksy_thumbs_layout;
                        $tainacan_blocksy_items_gallery_options['hideImageThumbnails'] = $tainacan_blocksy_is_list_thumbs && $tainacan_blocksy_hide_image_thumbnails;
                    }

                    $tainacan_blocksy_items_related_to_this_layout = 'gallery';

                    if ( $tainacan_blocksy_gallery_spacing === 'minimum' && $tainacan_blocksy_thumbs_layout === 'carousel' ) {
                        add_filter( 'tainacan-swiper-thumbs-options', function($tainacan_blocksy_options) {
                            return array_merge(
                                $tainacan_blocksy_options,
                                array(
                                    'spaceBetween' => 0
                                )
                            );
                        }, 9 , 1);
                    }
                }

                tainacan_the_related_items_carousel([
                    'items_list_layout' => $tainacan_blocksy_items_related_to_this_layout,
                    'collection_heading_tag' => 'h3',
                    'order' => $tainacan_blocksy_order,
                    'orderby' => $tainacan_blocksy_order_by,
                    'max_items_number' => $tainacan_blocksy_max_items_number,
                    'hide_collection_heading' => $tainacan_blocksy_hide_collection_heading,
                    'hide_metadata_label' => $tainacan_blocksy_hide_metadata_label,
                    'view_more_link_position' => $tainacan_blocksy_view_more_links_position,
                    'view_more_link_style' => $tainacan_blocksy_view_more_links_style,
                    'dynamic_items_args' => [
                        'max_columns_count' => $tainacan_blocksy_max_columns_count,
                        'image_size' => $tainacan_blocksy_image_size,
                        'tainacan_view_mode' => $tainacan_blocksy_tainacan_view_mode,
                    ],
                    'carousel_args' => [
                        'max_items_per_screen' => $tainacan_blocksy_max_items_per_screen,
                        'image_size' => $tainacan_blocksy_image_size,
                        'variable_items_width' => $tainacan_blocksy_variable_items_width,
                    ],
                    'items_gallery_args' => $tainacan_blocksy_items_gallery_options
                ]);
            ?>
        <div>

    </section>
<?php endif; ?>
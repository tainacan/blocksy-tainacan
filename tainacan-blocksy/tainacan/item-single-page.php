<?php
/**
 * The template for displaying all single Tainacan items
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BlocksyTainacan
 */

$prefix = blocksy_manager()->screen->get_prefix();

$page_structure_type = get_theme_mod( $prefix . '_page_structure_type', 'type-dam');
$template_columns_style = '';
$display_items_related_to_this = get_theme_mod( $prefix . '_display_items_related_to_this', 'no' ) === 'yes';

if ($page_structure_type == 'type-gm' || $page_structure_type == 'type-mg') {
    $column_documents_attachments_width = 60;
    $column_metadata_width = 40;

    $column_documents_attachments_width = intval(substr(get_theme_mod( $prefix . '_document_attachments_columns', '60%'), 0, -1));
    $column_metadata_width = 100 - $column_documents_attachments_width;

    if ($page_structure_type == 'type-gm') {
        $template_columns_style = 'grid-template-columns: ' . $column_documents_attachments_width . '% calc(' . $column_metadata_width . '% - 48px)';
    } else {
        $template_columns_style = 'grid-template-columns: ' . $column_metadata_width . '% calc(' . $column_documents_attachments_width . '% - 48px)';
    }
}

do_action( 'tainacan-blocksy-single-item-top' ); 

do_action( 'tainacan-blocksy-single-item-after-title' );

add_action( 'blocksy:hero:before', function() use ( $page_structure_type, $prefix ) {

    if ($page_structure_type === 'type-gtm') {
        
        $content_style = get_theme_mod($prefix . '_content_style', 'wide');
        $extra_classes = '';

        if ( is_array($content_style) ) {

            if ( isset($content_style['desktop']) )
                $extra_classes .= ' has-content-style-' . $content_style['desktop'] . '--desktop';
            if ( isset($content_style['tablet']) )
                $extra_classes .= ' has-content-style-' . $content_style['tablet'] . '--tablet';
            if ( isset($content_style['mobile']) )
                $extra_classes .= ' has-content-style-' . $content_style['mobile'] . '--mobile';

        } elseif ( is_string($content_style) ) {
            $extra_classes = 'has-content-style-' . $content_style;
        }

        $media_component_style = '';
        $media_component_color_palette = get_theme_mod($prefix . '_document_attachments_colors',
        [
            'color1' => [ 'color' => 'var(--paletteColor6, #edeff2)' ],
			'color2' => [ 'color' => 'var(--paletteColor4, #2c3e50)' ],
			'color3' => [ 'color' => 'var(--paletteColor1, #3eaf7c)' ],
        ]);
        
        $media_component_style .= '--tainacan-media-background-color:' . $media_component_color_palette['color1']['color'] . ';';
        $media_component_style .= '--tainacan-media-color:' . $media_component_color_palette['color2']['color'] . ';';
        $media_component_style .= '--tainacan-media-accent-color:' . $media_component_color_palette['color3']['color'] . ';';
        
        echo '<div class="tainacan-gallery-above-title ' . $extra_classes . '" style="' . $media_component_style . '">';
            tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-document' );
            do_action( 'tainacan-blocksy-single-item-after-document' );  

            tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-attachments' );
            do_action( 'tainacan-blocksy-single-item-after-attachments' );
        echo '</div>';
    }
});
?>

<div class="<?php echo esc_attr('tainacan-item-single tainacan-item-single--layout-'. $page_structure_type) ?>" style="<?php echo esc_attr($template_columns_style) ?>">
<?php
    if ($page_structure_type !== 'type-gtm') {
        tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-document' );
        do_action( 'tainacan-blocksy-single-item-after-document' );  

        tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-attachments' );
        do_action( 'tainacan-blocksy-single-item-after-attachments' );
    }
    
    tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-metadata' );
    do_action( 'tainacan-blocksy-single-item-after-metadata' );

    if ($display_items_related_to_this) {
        tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-items-related-to-this' );
        do_action( 'tainacan-blocksy-single-item-after-items-related-to-this' );
    }
?>
</div>


<?php
    // Edit item button
    if ( function_exists('tainacan_the_item_edit_link') ) {
        echo '<div class="tainacan-item-single"><span class="tainacan-edit-item-collection">';
            tainacan_the_item_edit_link();
        echo '</span></div>';
    }
    do_action( 'tainacan-blocksy-single-item-bottom' );
?>

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
$column_documents_attachments_affix = get_theme_mod( $prefix . '_document_attachments_affix', 'no') === 'yes';

if ($page_structure_type == 'type-gm' || $page_structure_type == 'type-mg') {
    $column_documents_attachments_width = 60;
    $column_metadata_width = 40;

    $column_documents_attachments_width = intval(substr(get_theme_mod( $prefix . '_document_attachments_columns', '60%'), 0, -1));
    $column_metadata_width = 100 - $column_documents_attachments_width;

    if ($page_structure_type == 'type-gm') {
        $template_columns_style = 'grid-template-columns: ' . $column_documents_attachments_width . '% calc(' . $column_metadata_width . '% - 48px);';
    } else {
        $template_columns_style = 'grid-template-columns: ' . $column_metadata_width . '% calc(' . $column_documents_attachments_width . '% - 48px);';
    }
}

do_action( 'tainacan-blocksy-single-item-top' ); 

do_action( 'tainacan-blocksy-single-item-after-title' );

?>

<div class="<?php echo esc_attr('tainacan-item-single tainacan-item-single--layout-'. $page_structure_type . ($column_documents_attachments_affix ? ' tainacan-item-single--affix-column' : '')) ?>" style="<?php echo esc_attr($template_columns_style) ?>">
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

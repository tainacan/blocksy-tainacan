<?php
/**
 * The template for displaying all single Tainacan items
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BlocksyTainacan
 */

$prefix = blocksy_manager()->screen->get_prefix();

do_action( 'blocksy-tainacan-single-item-top' ); 

do_action( 'blocksy-tainacan-single-item-after-title' );

$page_structure_type = get_theme_mod( $prefix . '_page_structure_type', 'type-dam');
$template_columns_style = '';

if ($page_structure_type == 'type-gm' || $page_structure_type == 'type-mg') {
    $column_documents_attachments_width = 60;
    $column_metadata_width = 40;

    $column_documents_attachments_width = intval(substr(get_theme_mod( $prefix . '_document_attachments_columns', '60%'), 0, -1));
    $column_metadata_width = 100 - $column_documents_attachments_width;

    if ($page_structure_type == 'type-gm') {
        $template_columns_style = 'grid-template-columns: ' . $column_documents_attachments_width . '% calc(' . $column_metadata_width . '% - 32px)';
    } else {
        $template_columns_style = 'grid-template-columns: ' . $column_metadata_width . '% calc(' . $column_documents_attachments_width . '% - 32px)';
    }
}
?>

<div class="tainacan-item-single tainacan-item-single--layout-'. $page_structure_type . '" style="' . $template_columns_style .'">
<?php
    get_template_part( 'template-parts/tainacan-item-single-document' );
    do_action( 'blocksy-tainacan-single-item-after-document' );  

    get_template_part( 'template-parts/tainacan-item-single-attachments' );
    do_action( 'blocksy-tainacan-single-item-after-attachments' );
    
    get_template_part( 'template-parts/tainacan-item-single-metadata' );
    do_action( 'blocksy-tainacan-single-item-after-metadata' );
?>
</div>

<?php do_action( 'blocksy-tainacan-single-item-bottom' ); ?>

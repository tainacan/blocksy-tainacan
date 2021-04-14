<?php 
    $prefix = blocksy_manager()->screen->get_prefix();
    
    // Galley mode is a shortname for when documents and attachments are displayed merged in the same list
    $is_gallery_mode            = get_theme_mod($prefix . '_document_attachments_structure', 'gallery-type-1') == 'gallery-type-2';
    $hide_file_name_main        = get_theme_mod( $prefix . '_hide_files_name_main', 'yes') == 'yes';
    $hide_file_caption_main     = get_theme_mod( $prefix . '_hide_files_caption_main', 'yes') == 'yes';
    $hide_file_description_main = get_theme_mod( $prefix . '_hide_files_description_main', 'yes') == 'yes';
?>
<?php if ( tainacan_has_document() && !$is_gallery_mode ) : ?>
    <section class="tainacan-item-section tainacan-item-section--document">
        <?php if ( get_theme_mod($prefix . '_display_section_labels', 'yes') == 'yes' && get_theme_mod($prefix . '_section_document_label', __( 'Document', 'tainacan-blocksy' )) != '' ) : ?>
            <h2 class="tainacan-single-item-section" id="tainacan-item-document-label">
                <?php echo esc_html( get_theme_mod($prefix . '_section_document_label', __( 'Document', 'tainacan-blocksy' ) ) ); ?>
            </h2>
        <?php endif; ?>
        <div class="tainacan-item-section__document">
            <?php 
                tainacan_the_document(); 
                if ( get_theme_mod( $prefix . '_hide_download_button', 'no' ) == 'no' && function_exists('tainacan_the_item_document_download_link') && tainacan_the_item_document_download_link() != '' ) {
                    echo '<span class="tainacan-item-file-download">' . tainacan_the_item_document_download_link() . '</span>';
                } 
            ?>
        </div>
    </section>
<?php endif; ?>
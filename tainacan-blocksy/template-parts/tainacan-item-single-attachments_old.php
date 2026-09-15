<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    $tainacan_blocksy_attachments = tainacan_get_the_attachments();
    $tainacan_blocksy_prefix = blocksy_manager()->screen->get_prefix();

    // Galley mode is a shortname for when documents and attachments are displayed merged in the same list
    $tainacan_blocksy_is_gallery_mode            = get_theme_mod( $tainacan_blocksy_prefix . '_document_attachments_structure', 'gallery-type-1' ) == 'gallery-type-2';
    $tainacan_blocksy_hide_file_name             = get_theme_mod( $tainacan_blocksy_prefix . '_hide_files_name', 'no') == 'yes';
    $tainacan_blocksy_hide_file_name_main        = get_theme_mod( $tainacan_blocksy_prefix . '_hide_files_name_main', 'yes') == 'yes';
    $tainacan_blocksy_hide_file_caption_main     = get_theme_mod( $tainacan_blocksy_prefix . '_hide_files_caption_main', 'yes') == 'yes';
    $tainacan_blocksy_hide_file_description_main = get_theme_mod( $tainacan_blocksy_prefix . '_hide_files_description_main', 'yes') == 'yes';
    $tainacan_blocksy_hide_download_button       = get_theme_mod( $tainacan_blocksy_prefix . '_hide_download_button', 'no' ) == 'yes';
    $tainacan_blocksy_disable_gallery_lightbox   = get_theme_mod( $tainacan_blocksy_prefix . '_disable_gallery_lightbox', 'no') == 'yes';
    
    global $post;
    
    if ( function_exists('tainacan_the_media_component') && ( !empty( $tainacan_blocksy_attachments ) || ( $tainacan_blocksy_is_gallery_mode && tainacan_has_document() ) ) ) {
    ?>
        <section class="tainacan-item-section tainacan-item-section--<?php echo ((!$tainacan_blocksy_is_gallery_mode ? 'attachments' : 'gallery')) ?>">
            <?php if ( (get_theme_mod($tainacan_blocksy_prefix . '_display_section_labels', 'yes') == 'yes') && (!$tainacan_blocksy_is_gallery_mode) && get_theme_mod($tainacan_blocksy_prefix . '_section_attachments_label', __( 'Attachments', 'tainacan' )) != '' ) : // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation. ?>
                <h2 class="tainacan-single-item-section" id="tainacan-item-attachments-label">
                    <?php echo esc_html( get_theme_mod($tainacan_blocksy_prefix . '_section_attachments_label', __( 'Attachments', 'tainacan' ) ) ); // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation. ?>
                </h2>
            <?php endif; ?>
            <?php if ( (get_theme_mod($tainacan_blocksy_prefix . '_display_section_labels', 'yes') == 'yes') && ($tainacan_blocksy_is_gallery_mode) && get_theme_mod($tainacan_blocksy_prefix . '_section_documents_label', __( 'Documents', 'tainacan-blocksy' )) != '') : ?>
                <h2 class="tainacan-single-item-section" id="tainacan-item-documents-label">
                    <?php echo esc_html( get_theme_mod($tainacan_blocksy_prefix . '_section_documents_label', __( 'Documents', 'tainacan-blocksy' )) ); ?>
                </h2>
            <?php endif; ?>

            <?php 
            
            $tainacan_blocksy_media_items_thumbs = array();
            $tainacan_blocksy_media_items_main = array();

            if ($tainacan_blocksy_is_gallery_mode) {
            
                $tainacan_blocksy_class_slide_metadata = '';
                if ($tainacan_blocksy_hide_file_name_main)
                    $tainacan_blocksy_class_slide_metadata .= ' hide-name';
                if ($tainacan_blocksy_hide_file_description_main)
                    $tainacan_blocksy_class_slide_metadata .= ' hide-description';
                if ($tainacan_blocksy_hide_file_caption_main)
                    $tainacan_blocksy_class_slide_metadata .= ' hide-caption';
                
                if ( tainacan_has_document() ) {
                    $tainacan_blocksy_is_document_type_attachment = tainacan_get_the_document_type() === 'attachment';
                    
                    $tainacan_blocksy_media_items_main[] =
                        tainacan_get_the_media_component_slide(array(
                            'after_slide_metadata' => (( !$tainacan_blocksy_hide_download_button && tainacan_the_item_document_download_link() != '' ) ?
                                                            ('<span class="tainacan-item-file-download">' . tainacan_the_item_document_download_link() . '</span>')
                                                    : ''),
                            'media_content' => tainacan_get_the_document(),
                            'media_content_full' => $tainacan_blocksy_is_document_type_attachment ? tainacan_get_the_document(0, 'full') : ('<div class="attachment-without-image">' . tainacan_get_the_document(0, 'full') . '</div>'),
                            'media_title' => $tainacan_blocksy_is_document_type_attachment ? get_the_title(tainacan_get_the_document_raw()) : '',
                            'media_description' => $tainacan_blocksy_is_document_type_attachment ? get_the_content(tainacan_get_the_document_raw()) : '',
                            'media_caption' => $tainacan_blocksy_is_document_type_attachment ? wp_get_attachment_caption(tainacan_get_the_document_raw()) : '',
                            'media_type' => tainacan_get_the_document_type(),
                            'class_slide_metadata' => $tainacan_blocksy_class_slide_metadata
                        ));
                }
                
                foreach ( $tainacan_blocksy_attachments as $tainacan_blocksy_attachment ) {
                    $tainacan_blocksy_media_items_main[] =
                        tainacan_get_the_media_component_slide(array(
                            'after_slide_metadata' => (( !$tainacan_blocksy_hide_download_button && tainacan_the_item_attachment_download_link($tainacan_blocksy_attachment->ID) != '' ) ?
                                                            '<span class="tainacan-item-file-download">' . tainacan_the_item_attachment_download_link($tainacan_blocksy_attachment->ID) . '</span>'
                                                    : ''),
                            'media_content' => tainacan_get_attachment_as_html($tainacan_blocksy_attachment->ID, 0),
                            'media_content_full' => wp_attachment_is('image', $tainacan_blocksy_attachment->ID) ? wp_get_attachment_image( $tainacan_blocksy_attachment->ID, 'full', false) : ('<div class="attachment-without-image tainacan-embed-container"><iframe id="tainacan-attachment-iframe" src="' . tainacan_get_attachment_html_url($tainacan_blocksy_attachment->ID) . '"></iframe></div>'),
                            'media_title' => $tainacan_blocksy_attachment->post_title,
                            'media_description' => $tainacan_blocksy_attachment->post_content,
                            'media_caption' => $tainacan_blocksy_attachment->post_excerpt,
                            'media_type' => $tainacan_blocksy_attachment->post_mime_type,
                            'class_slide_metadata' => $tainacan_blocksy_class_slide_metadata
                        ));
                }
            }
            
            if ( 
                (tainacan_has_document() && $tainacan_blocksy_attachments && sizeof($tainacan_blocksy_attachments) > 0 ) ||
                (!tainacan_has_document() && $tainacan_blocksy_attachments && sizeof($tainacan_blocksy_attachments) > 1 ) 
            ) {
                if ( tainacan_has_document() ) {
                    $tainacan_blocksy_is_document_type_attachment = tainacan_get_the_document_type() === 'attachment';
                    $tainacan_blocksy_media_items_thumbs[] =
                        tainacan_get_the_media_component_slide(array(
                            'media_content' => get_the_post_thumbnail(null, 'tainacan-medium'),
                            'media_content_full' => $tainacan_blocksy_is_document_type_attachment ? tainacan_get_the_document(0, 'full') : ('<div class="attachment-without-image">' . tainacan_get_the_document(0, 'full') . '</div>'),
                            'media_title' => $tainacan_blocksy_is_document_type_attachment ? get_the_title(tainacan_get_the_document_raw()) : '',
                            'media_description' => $tainacan_blocksy_is_document_type_attachment ? get_the_content(tainacan_get_the_document_raw()) : '',
                            'media_caption' => $tainacan_blocksy_is_document_type_attachment ? wp_get_attachment_caption(tainacan_get_the_document_raw()) : '',
                            'media_type' => tainacan_get_the_document_type(),
                            'class_slide_metadata' => 'hide-caption hide-description ' . ( $tainacan_blocksy_hide_file_name ? 'hide-name' : '' )
                        ));
                    
                }
                foreach ( $tainacan_blocksy_attachments as $tainacan_blocksy_attachment ) {
                    $tainacan_blocksy_media_items_thumbs[] = 
                        tainacan_get_the_media_component_slide(array(
                            'media_content' => wp_get_attachment_image( $tainacan_blocksy_attachment->ID, 'tainacan-medium', false ),
                            'media_content_full' => wp_attachment_is('image', $tainacan_blocksy_attachment->ID) ? wp_get_attachment_image( $tainacan_blocksy_attachment->ID, 'full', false) : ('<div class="attachment-without-image tainacan-embed-container"><iframe id="tainacan-attachment-iframe" src="' . tainacan_get_attachment_html_url($tainacan_blocksy_attachment->ID) . '"></iframe></div>'),
                            'media_title' => $tainacan_blocksy_attachment->post_title,
                            'media_description' => $tainacan_blocksy_attachment->post_content,
                            'media_caption' => $tainacan_blocksy_attachment->post_excerpt,
                            'media_type' => $tainacan_blocksy_attachment->post_mime_type,
                            'class_slide_metadata' => 'hide-caption hide-description ' . ( $tainacan_blocksy_hide_file_name ? 'hide-name' : '' )
                        ));
                }
            }
            
            tainacan_the_media_component(
                'tainacan-item-attachments_id-' . $post->ID,
                $tainacan_blocksy_media_items_thumbs,
                $tainacan_blocksy_is_gallery_mode ? $tainacan_blocksy_media_items_main : null,
                array(
                    'class_thumbs_li' => 'tainacan-item-section__attachments-file',
                    'swiper_thumbs_options' => $tainacan_blocksy_is_gallery_mode ? '' : array(
                        'navigation' => array(
                            'nextEl' => '.swiper-navigation-next_' . 'tainacan-item-attachments_id-' . $post->ID . '-thumbs',
                            'prevEl' => '.swiper-navigation-prev_' . 'tainacan-item-attachments_id-' . $post->ID . '-thumbs',
                        )
                    ),
                    'swiper_main_options' => $tainacan_blocksy_is_gallery_mode ? array(
                        'navigation' => array(
                            'nextEl' => '.swiper-navigation-next_' . 'tainacan-item-attachments_id-' . $post->ID . '-main',
                            'prevEl' => '.swiper-navigation-prev_' . 'tainacan-item-attachments_id-' . $post->ID . '-main',
                        ) 
                    ) : '',
                    'disable_lightbox' => $tainacan_blocksy_is_gallery_mode ? $tainacan_blocksy_disable_gallery_lightbox : false,
                )
            );
    ?>
        </section>
<?php } ?>
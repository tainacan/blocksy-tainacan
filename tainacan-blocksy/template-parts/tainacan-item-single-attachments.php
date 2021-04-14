<?php
    $attachments = tainacan_get_the_attachments();
    $prefix = blocksy_manager()->screen->get_prefix();

    // Galley mode is a shortname for when documents and attachments are displayed merged in the same list
    $is_gallery_mode            = get_theme_mod( $prefix . '_document_attachments_structure', 'gallery-type-1' ) == 'gallery-type-2';
    $hide_file_name             = get_theme_mod( $prefix . '_hide_files_name', 'no') == 'yes';
    $hide_file_name_main        = get_theme_mod( $prefix . '_hide_files_name_main', 'yes') == 'yes';
    $hide_file_caption_main     = get_theme_mod( $prefix . '_hide_files_caption_main', 'yes') == 'yes';
    $hide_file_description_main = get_theme_mod( $prefix . '_hide_files_description_main', 'yes') == 'yes';
    $hide_download_button       = get_theme_mod( $prefix . '_hide_download_button', 'no' ) == 'yes';

    global $post;
    
    if ( function_exists('tainacan_the_media_component') && ( !empty( $attachments ) || ( $is_gallery_mode && tainacan_has_document() ) ) ) {
    ?>
        <section class="tainacan-item-section tainacan-item-section--<?php echo ((!$is_gallery_mode ? 'attachments' : 'gallery')) ?>">
            <?php if ( (get_theme_mod($prefix . '_display_section_labels', 'yes') == 'yes') && (!$is_gallery_mode) && get_theme_mod($prefix . '_section_attachments_label', __( 'Attachments', 'tainacan-blocksy' )) != '' ) : ?>
                <h2 class="tainacan-single-item-section" id="tainacan-item-attachments-label">
                    <?php echo esc_html( get_theme_mod($prefix . '_section_attachments_label', __( 'Attachments', 'tainacan-blocksy' ) ) ); ?>
                </h2>
            <?php endif; ?>
            <?php if ( (get_theme_mod($prefix . '_display_section_labels', 'yes') == 'yes') && ($is_gallery_mode) && get_theme_mod($prefix . '_section_documents_label', __( 'Documents', 'tainacan-blocksy' )) != '') : ?>
                <h2 class="tainacan-single-item-section" id="tainacan-item-documents-label">
                    <?php echo esc_html( get_theme_mod($prefix . '_section_documents_label', __( 'Documents', 'tainacan-blocksy' )) ); ?>
                </h2>
            <?php endif; ?>

            <?php 
            
            $media_items_thumbs = array();
            $media_items_main = array();

            if ($is_gallery_mode) {
            
                $class_slide_metadata = '';
                if ($hide_file_name_main)
                    $class_slide_metadata .= ' hide-name';
                if ($hide_file_description_main)
                    $class_slide_metadata .= ' hide-description';
                if ($hide_file_caption_main)
                    $class_slide_metadata .= ' hide-caption';
                
                if ( tainacan_has_document() ) {
                    $is_document_type_attachment = tainacan_get_the_document_type() === 'attachment';
                    
                    $media_items_main[] =
                        tainacan_get_the_media_component_slide(array(
                            'after_slide_metadata' => (( !$hide_download_button && tainacan_the_item_document_download_link() != '' ) ?
                                                            ('<span class="tainacan-item-file-download">' . tainacan_the_item_document_download_link() . '</span>')
                                                    : ''),
                            'media_content' => tainacan_get_the_document(),
                            'media_content_full' => $is_document_type_attachment ? tainacan_get_the_document(0, 'full') : ('<div class="attachment-without-image">' . tainacan_get_the_document(0, 'full') . '</div>'),
                            'media_title' => $is_document_type_attachment ? get_the_title(tainacan_get_the_document_raw()) : '',
                            'media_description' => $is_document_type_attachment ? get_the_content(tainacan_get_the_document_raw()) : '',
                            'media_caption' => $is_document_type_attachment ? wp_get_attachment_caption(tainacan_get_the_document_raw()) : '',
                            'media_type' => tainacan_get_the_document_type(),
                            'class_slide_metadata' => $class_slide_metadata
                        ));
                }
                
                foreach ( $attachments as $attachment ) {
                    $media_items_main[] =
                        tainacan_get_the_media_component_slide(array(
                            'after_slide_metadata' => (( !$hide_download_button && tainacan_the_item_attachment_download_link($attachment->ID) != '' ) ?
                                                            '<span class="tainacan-item-file-download">' . tainacan_the_item_attachment_download_link($attachment->ID) . '</span>'
                                                    : ''),
                            'media_content' => tainacan_get_attachment_as_html($attachment->ID, 0),
                            'media_content_full' => wp_attachment_is('image', $attachment->ID) ? wp_get_attachment_image( $attachment->ID, 'full', false) : ('<div class="attachment-without-image tainacan-embed-container"><iframe id="tainacan-attachment-iframe" src="' . tainacan_get_attachment_html_url($attachment->ID) . '"></iframe></div>'),
                            'media_title' => $attachment->post_title,
                            'media_description' => $attachment->post_content,
                            'media_caption' => $attachment->post_excerpt,
                            'media_type' => $attachment->post_mime_type,
                            'class_slide_metadata' => $class_slide_metadata
                        ));
                }
            }
            
            if ( 
                (tainacan_has_document() && $attachments && sizeof($attachments) > 0 ) ||
                (!tainacan_has_document() && $attachments && sizeof($attachments) > 1 ) 
            ) {
                if ( tainacan_has_document() ) {
                    $is_document_type_attachment = tainacan_get_the_document_type() === 'attachment';
                    $media_items_thumbs[] =
                        tainacan_get_the_media_component_slide(array(
                            'media_content' => get_the_post_thumbnail(null, 'tainacan-medium'),
                            'media_content_full' => $is_document_type_attachment ? tainacan_get_the_document(0, 'full') : ('<div class="attachment-without-image">' . tainacan_get_the_document(0, 'full') . '</div>'),
                            'media_title' => $is_document_type_attachment ? get_the_title(tainacan_get_the_document_raw()) : '',
                            'media_description' => $is_document_type_attachment ? get_the_content(tainacan_get_the_document_raw()) : '',
                            'media_caption' => $is_document_type_attachment ? wp_get_attachment_caption(tainacan_get_the_document_raw()) : '',
                            'media_type' => tainacan_get_the_document_type(),
                            'class_slide_metadata' => 'hide-caption hide-description ' . ( $hide_file_name ? 'hide-name' : '' )
                        ));
                    
                }
                foreach ( $attachments as $attachment ) {
                    $media_items_thumbs[] = 
                        tainacan_get_the_media_component_slide(array(
                            'media_content' => wp_get_attachment_image( $attachment->ID, 'tainacan-medium', false ),
                            'media_content_full' => wp_attachment_is('image', $attachment->ID) ? wp_get_attachment_image( $attachment->ID, 'full', false) : ('<div class="attachment-without-image tainacan-embed-container"><iframe id="tainacan-attachment-iframe" src="' . tainacan_get_attachment_html_url($attachment->ID) . '"></iframe></div>'),
                            'media_title' => $attachment->post_title,
                            'media_description' => $attachment->post_content,
                            'media_caption' => $attachment->post_excerpt,
                            'media_type' => $attachment->post_mime_type,
                            'class_slide_metadata' => 'hide-caption hide-description ' . ( $hide_file_name ? 'hide-name' : '' )
                        ));
                }
            }
            
            tainacan_the_media_component(
                'tainacan-item-attachments_id-' . $post->ID,
                $media_items_thumbs,
                $is_gallery_mode ? $media_items_main : null,
                array(
                    'class_thumbs_li' => 'tainacan-item-section__attachments-file',
                    'swiper_thumbs_options' => $is_gallery_mode ? '' : array(
                        'navigation' => array(
                            'nextEl' => '.swiper-navigation-next_' . 'tainacan-item-attachments_id-' . $post->ID . '-thumbs',
                            'prevEl' => '.swiper-navigation-prev_' . 'tainacan-item-attachments_id-' . $post->ID . '-thumbs',
                        )
                    ),
                    'swiper_main_options' => $is_gallery_mode ? array(
                        'navigation' => array(
                            'nextEl' => '.swiper-navigation-next_' . 'tainacan-item-attachments_id-' . $post->ID . '-main',
                            'prevEl' => '.swiper-navigation-prev_' . 'tainacan-item-attachments_id-' . $post->ID . '-main',
                        ) 
                    ) : ''
                )
            );
    ?>
        </section>
<?php } ?>
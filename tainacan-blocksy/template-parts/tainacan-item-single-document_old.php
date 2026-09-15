<?php

// phpcs:disable WordPress.WP.I18n.TextDomainMismatch -- All translatable strings in this file reuse translations from the Tainacan plugin.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    $tainacan_blocksy_prefix = blocksy_manager()->screen->get_prefix();
    
    // Galley mode is a shortname for when documents and attachments are displayed merged in the same list
    $tainacan_blocksy_is_gallery_mode            = get_theme_mod($tainacan_blocksy_prefix . '_document_attachments_structure', 'gallery-type-1') == 'gallery-type-2';
    $tainacan_blocksy_hide_file_name_main        = get_theme_mod( $tainacan_blocksy_prefix . '_hide_files_name_main', 'yes') == 'yes';
    $tainacan_blocksy_hide_file_caption_main     = get_theme_mod( $tainacan_blocksy_prefix . '_hide_files_caption_main', 'yes') == 'yes';
    $tainacan_blocksy_hide_file_description_main = get_theme_mod( $tainacan_blocksy_prefix . '_hide_files_description_main', 'yes') == 'yes';
    $tainacan_blocksy_hide_download_button       = get_theme_mod( $tainacan_blocksy_prefix . '_hide_download_button', 'no' ) == 'yes';
    $tainacan_blocksy_disable_gallery_lightbox   = get_theme_mod( $tainacan_blocksy_prefix . '_disable_gallery_lightbox', 'no') == 'yes';

    global $post;

    if ( tainacan_has_document() && !$tainacan_blocksy_is_gallery_mode ) : ?>
        <section class="tainacan-item-section tainacan-item-section--document">
            <?php if ( get_theme_mod($tainacan_blocksy_prefix . '_display_section_labels', 'yes') == 'yes' && get_theme_mod($tainacan_blocksy_prefix . '_section_document_label', __( 'Document', 'tainacan' )) != '' ) : ?>
                <h2 class="tainacan-single-item-section" id="tainacan-item-document-label">
                    <?php echo esc_html( get_theme_mod($tainacan_blocksy_prefix . '_section_document_label', __( 'Document', 'tainacan' ) ) ); ?>
                </h2>
            <?php endif; ?>
            <div class="tainacan-item-section__document">
                <?php if ( function_exists('tainacan_the_media_component') ) {
                    $tainacan_blocksy_media_items_main = array();

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
                                                                ('<span class="tainacan-item-file-download">' . wp_kses_post( tainacan_the_item_document_download_link() ) . '</span>')
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

                    tainacan_the_media_component(
                        'tainacan-item-document_id-' . $post->ID,
                        [],
                        $tainacan_blocksy_media_items_main,
                        array(
                            'swiper_main_options' => array(
                                'navigation' => array(
                                    'nextEl' => '.swiper-navigation-next_' . 'tainacan-item-document_id-' . $post->ID . '-main',
                                    'prevEl' => '.swiper-navigation-prev_' . 'tainacan-item-document_id-' . $post->ID . '-main',
                                ) 
                            ),
                            'disable_lightbox' => $tainacan_blocksy_disable_gallery_lightbox,
                        )
                    );

                } else {
                    tainacan_the_document(); 
                    if ( !$tainacan_blocksy_hide_download_button && function_exists('tainacan_the_item_document_download_link') && tainacan_the_item_document_download_link() != '' ) {
                        echo '<span class="tainacan-item-file-download">' . wp_kses_post( tainacan_the_item_document_download_link() ) . '</span>';
                    }
                } ?>
            </div>
        </section>
<?php endif; ?>
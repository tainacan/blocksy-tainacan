<?php 
    $prefix = blocksy_manager()->screen->get_prefix();
    $page_structure_type = get_theme_mod( $prefix . '_page_structure_type', 'type-dam');
    
    // Galley mode is a shortname for when documents and attachments are displayed merged in the same list
    $is_gallery_mode                = get_theme_mod( $prefix . '_document_attachments_structure', 'gallery-type-1' ) == 'gallery-type-2';
    $gallery_spacing                = get_theme_mod( $prefix . '_document_attachments_spacing', 'default');
    $hide_file_name                 = get_theme_mod( $prefix . '_hide_files_name', 'no') == 'yes';
    $hide_file_name_main            = get_theme_mod( $prefix . '_hide_files_name_main', 'yes') == 'yes';
    $hide_file_caption_main         = get_theme_mod( $prefix . '_hide_files_caption_main', 'yes') == 'yes';
    $hide_file_description_main     = get_theme_mod( $prefix . '_hide_files_description_main', 'yes') == 'yes';
    $hide_download_button           = get_theme_mod( $prefix . '_hide_download_button', 'no' ) == 'yes';
    $disable_gallery_lightbox       = get_theme_mod( $prefix . '_disable_gallery_lightbox', 'no') == 'yes';
    $hide_file_name_lightbox        = get_theme_mod( $prefix . '_hide_files_name_lightbox', 'no') == 'yes';
    $hide_file_caption_lightbox     = get_theme_mod( $prefix . '_hide_files_caption_lightbox', 'no') == 'yes';
    $hide_file_description_lightbox = get_theme_mod( $prefix . '_hide_files_description_lightbox', 'no') == 'yes';
    $has_light_dark_color_scheme    = get_theme_mod( $prefix . '_gallery_color_scheme', 'dark' ) == 'light';

    if ( $gallery_spacing === 'minimum' ) {
        add_filter( 'tainacan-swiper-thumbs-options', function($options) {
            return array_merge(
                $options,
                array(
                    'spaceBetween' => 0
                )
            );
        }, 9 , 1);
    }

    global $post;

    if ( tainacan_has_document() && !$is_gallery_mode ) : ?>
        <section class="tainacan-item-section tainacan-item-section--document <?php echo ' tainacan-media-component-wrapper-spacing--' . $gallery_spacing ?>">
            <?php if ( $page_structure_type !== 'type-gtm' && get_theme_mod($prefix . '_display_section_labels', 'yes') == 'yes' && get_theme_mod($prefix . '_section_document_label', __( 'Document', 'tainacan-blocksy' )) != '' ) : ?>
                <h2 class="tainacan-single-item-section" id="tainacan-item-document-label">
                    <?php echo esc_html( get_theme_mod($prefix . '_section_document_label', __( 'Document', 'tainacan-blocksy' ) ) ); ?>
                </h2>
            <?php endif; ?>

            <?php
                tainacan_the_item_gallery([
                    'blockId'                       => 'tainacan-item-document_id-' . $post->ID,
                    'layoutElements'                => array( 'main' => true, 'thumbnails' => false ),
			        'mediaSources'                  => array( 'document' => true, 'attachments' => false, 'metadata' => false),
                    'hideFileNameMain'              => $hide_file_name_main,
                    'hideFileCaptionMain'           => $hide_file_caption_main, 
                    'hideFileDescriptionMain'       => $hide_file_description_main,
                    'hideFileNameThumbnails'        => $hide_file_name, 
                    'hideFileCaptionThumbnails'     => true, 
                    'hideFileDescriptionThumbnails' => true, 
                    'showDownloadButtonMain'        => !$hide_download_button,
                    'showArrowsAsSVG'               => false,
                    'hideFileNameLightbox'          => $hide_file_name_lightbox,
                    'hideFileCaptionLightbox'       => $hide_file_caption_lightbox, 
                    'hideFileDescriptionLightbox'   => $hide_file_description_lightbox,
                    'openLightboxOnClick'           => $is_gallery_mode ? !$disable_gallery_lightbox : true,
                    'lightboxHasLightBackground'    => $has_light_dark_color_scheme 
                ]);
            ?>
        </section>
<?php endif; ?>
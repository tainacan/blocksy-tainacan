<?php
	$attachments = tainacan_get_the_attachments();
	$prefix = blocksy_manager()->screen->get_prefix();
	$settings = tainacan_blocksy_get_item_gallery_settings( $prefix );

	tainacan_blocksy_prepare_item_gallery_swiper( $settings );

	global $post;

	if ( function_exists( 'tainacan_the_media_component' ) && ( ! empty( $attachments ) || ( $settings['is_gallery_mode'] && tainacan_has_document() ) ) ) {
		$section_modifier = ! $settings['is_gallery_mode']
			? 'attachments'
			: ( 'gallery tainacan-media-component-wrapper-thumbnails-at--' . $settings['gallery_position'] . ' tainacan-media-component-wrapper-spacing--' . $settings['gallery_spacing'] );
		?>
		<section class="tainacan-item-section tainacan-item-section--<?php echo esc_attr( $section_modifier ); ?>"<?php echo tainacan_blocksy_get_item_gallery_data_attributes( $settings ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper ?>>

			<?php if ( $settings['page_structure_type'] !== 'type-gtm' && ( get_theme_mod( $prefix . '_display_section_labels', 'yes' ) == 'yes' ) && ( ! $settings['is_gallery_mode'] ) && get_theme_mod( $prefix . '_section_attachments_label', __( 'Attachments', 'tainacan' ) ) != '' ) : // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation. ?>
				<h2 class="tainacan-single-item-section" id="tainacan-item-attachments-label">
					<?php echo esc_html( get_theme_mod( $prefix . '_section_attachments_label', __( 'Attachments', 'tainacan' ) ) ); // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation. ?>
				</h2>
			<?php endif; ?>
			<?php if ( $settings['page_structure_type'] !== 'type-gtm' && ( get_theme_mod( $prefix . '_display_section_labels', 'yes' ) == 'yes' ) && ( $settings['is_gallery_mode'] ) && get_theme_mod( $prefix . '_section_documents_label', __( 'Documents', 'tainacan-blocksy' ) ) != '' ) : ?>
				<h2 class="tainacan-single-item-section" id="tainacan-item-documents-label">
					<?php echo esc_html( get_theme_mod( $prefix . '_section_documents_label', __( 'Documents', 'tainacan-blocksy' ) ) ); ?>
				</h2>
			<?php endif; ?>

			<?php tainacan_the_item_gallery( tainacan_blocksy_get_item_gallery_args( 'attachments', $settings, $post->ID ) ); ?>
		</section>
		<?php
	}

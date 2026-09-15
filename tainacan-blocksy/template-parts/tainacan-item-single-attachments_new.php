<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	$tainacan_blocksy_attachments = tainacan_get_the_attachments();
	$tainacan_blocksy_prefix = blocksy_manager()->screen->get_prefix();
	$tainacan_blocksy_settings = tainacan_blocksy_get_item_gallery_settings( $tainacan_blocksy_prefix );

	tainacan_blocksy_prepare_item_gallery_swiper( $tainacan_blocksy_settings );

	global $post;

	if ( function_exists( 'tainacan_the_media_component' ) && ( ! empty( $tainacan_blocksy_attachments ) || ( $tainacan_blocksy_settings['is_gallery_mode'] && tainacan_has_document() ) ) ) {
		$tainacan_blocksy_section_modifier = ! $tainacan_blocksy_settings['is_gallery_mode']
			? 'attachments'
			: ( 'gallery tainacan-media-component-wrapper-thumbnails-at--' . $tainacan_blocksy_settings['gallery_position'] . ' tainacan-media-component-wrapper-spacing--' . $tainacan_blocksy_settings['gallery_spacing'] );
		?>
		<section class="tainacan-item-section tainacan-item-section--<?php echo esc_attr( $tainacan_blocksy_section_modifier ); ?>"<?php echo tainacan_blocksy_get_item_gallery_data_attributes( $tainacan_blocksy_settings ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper ?>>

			<?php if ( $tainacan_blocksy_settings['page_structure_type'] !== 'type-gtm' && ( get_theme_mod( $tainacan_blocksy_prefix . '_display_section_labels', 'yes' ) == 'yes' ) && ( ! $tainacan_blocksy_settings['is_gallery_mode'] ) && get_theme_mod( $tainacan_blocksy_prefix . '_section_attachments_label', __( 'Attachments', 'tainacan' ) ) != '' ) : // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation. ?>
				<h2 class="tainacan-single-item-section" id="tainacan-item-attachments-label">
					<?php echo esc_html( get_theme_mod( $tainacan_blocksy_prefix . '_section_attachments_label', __( 'Attachments', 'tainacan' ) ) ); // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation. ?>
				</h2>
			<?php endif; ?>
			<?php if ( $tainacan_blocksy_settings['page_structure_type'] !== 'type-gtm' && ( get_theme_mod( $tainacan_blocksy_prefix . '_display_section_labels', 'yes' ) == 'yes' ) && ( $tainacan_blocksy_settings['is_gallery_mode'] ) && get_theme_mod( $tainacan_blocksy_prefix . '_section_documents_label', __( 'Documents', 'tainacan-blocksy' ) ) != '' ) : ?>
				<h2 class="tainacan-single-item-section" id="tainacan-item-documents-label">
					<?php echo esc_html( get_theme_mod( $tainacan_blocksy_prefix . '_section_documents_label', __( 'Documents', 'tainacan-blocksy' ) ) ); ?>
				</h2>
			<?php endif; ?>

			<?php tainacan_the_item_gallery( tainacan_blocksy_get_item_gallery_args( 'attachments', $tainacan_blocksy_settings, $post->ID ) ); ?>
		</section>
		<?php
	}

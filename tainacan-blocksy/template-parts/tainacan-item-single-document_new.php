<?php

// phpcs:disable WordPress.WP.I18n.TextDomainMismatch -- All translatable strings in this file reuse translations from the Tainacan plugin.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

	$tainacan_blocksy_prefix = blocksy_manager()->screen->get_prefix();
	$tainacan_blocksy_settings = tainacan_blocksy_get_item_gallery_settings( $tainacan_blocksy_prefix );

	tainacan_blocksy_prepare_item_gallery_swiper( $tainacan_blocksy_settings );

	global $post;

	if ( tainacan_has_document() && ! $tainacan_blocksy_settings['is_gallery_mode'] ) : ?>
		<section class="tainacan-item-section tainacan-item-section--document <?php echo esc_attr( ' tainacan-media-component-wrapper-spacing--' . $tainacan_blocksy_settings['gallery_spacing'] ); ?>"<?php echo tainacan_blocksy_get_item_gallery_data_attributes( $tainacan_blocksy_settings ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper ?>>
			<?php if ( $tainacan_blocksy_settings['page_structure_type'] !== 'type-gtm' && get_theme_mod( $tainacan_blocksy_prefix . '_display_section_labels', 'yes' ) == 'yes' && get_theme_mod( $tainacan_blocksy_prefix . '_section_document_label', __( 'Document', 'tainacan' ) ) != '' ) : ?>
				<h2 class="tainacan-single-item-section" id="tainacan-item-document-label">
					<?php echo esc_html( get_theme_mod( $tainacan_blocksy_prefix . '_section_document_label', __( 'Document', 'tainacan' ) ) ); ?>
				</h2>
			<?php endif; ?>

			<?php tainacan_the_item_gallery( tainacan_blocksy_get_item_gallery_args( 'document', $tainacan_blocksy_settings, $post->ID ) ); ?>
		</section>
<?php endif; ?>

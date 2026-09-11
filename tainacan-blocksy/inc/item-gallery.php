<?php
/**
 * Item single gallery helpers (theme mods, section attrs, Swiper tweaks, media actions).
 */

if ( ! function_exists( 'tainacan_blocksy_has_media_item_actions' ) ) {
	/**
	 * Whether the current Tainacan ships the media item actions wrapper.
	 *
	 * @return bool
	 */
	function tainacan_blocksy_has_media_item_actions() {
		return function_exists( 'tainacan_get_the_media_item_expand_control' );
	}
}

if ( ! function_exists( 'tainacan_blocksy_get_item_gallery_settings' ) ) {
	/**
	 * Theme mods used by the item document / attachments gallery templates.
	 *
	 * @param string $prefix Blocksy screen prefix (already includes trailing underscore when from get_prefix).
	 * @return array
	 */
	function tainacan_blocksy_get_item_gallery_settings( $prefix = '' ) {
		if ( $prefix === '' && function_exists( 'blocksy_manager' ) ) {
			$prefix = blocksy_manager()->screen->get_prefix();
		}

		return array(
			'page_structure_type'           => get_theme_mod( $prefix . '_page_structure_type', 'type-dam' ),
			'is_gallery_mode'               => get_theme_mod( $prefix . '_document_attachments_structure', 'gallery-type-1' ) === 'gallery-type-2',
			'gallery_position'              => get_theme_mod( $prefix . '_document_attachments_position', 'below' ),
			'gallery_spacing'               => get_theme_mod( $prefix . '_document_attachments_spacing', 'default' ),
			'hide_file_name'                => get_theme_mod( $prefix . '_hide_files_name', 'no' ) === 'yes',
			'hide_file_name_main'           => get_theme_mod( $prefix . '_hide_files_name_main', 'yes' ) === 'yes',
			'hide_file_caption_main'        => get_theme_mod( $prefix . '_hide_files_caption_main', 'yes' ) === 'yes',
			'hide_file_description_main'    => get_theme_mod( $prefix . '_hide_files_description_main', 'yes' ) === 'yes',
			'hide_download_button'          => get_theme_mod( $prefix . '_hide_download_button', 'no' ) === 'yes',
			'disable_gallery_lightbox'      => get_theme_mod( $prefix . '_disable_gallery_lightbox', 'no' ) === 'yes',
			'hide_file_name_lightbox'       => get_theme_mod( $prefix . '_hide_files_name_lightbox', 'no' ) === 'yes',
			'hide_file_caption_lightbox'    => get_theme_mod( $prefix . '_hide_files_caption_lightbox', 'no' ) === 'yes',
			'hide_file_description_lightbox'=> get_theme_mod( $prefix . '_hide_files_description_lightbox', 'no' ) === 'yes',
			'has_light_dark_color_scheme'   => get_theme_mod( $prefix . '_gallery_color_scheme', 'dark' ) === 'light',
			'thumbnails_image_size'         => get_theme_mod( $prefix . '_thumbnails_image_size', 'tainacan-medium' ),
			'thumbs_have_fixed_height'      => get_theme_mod( $prefix . '_thumbs_have_fixed_height', 'no' ) === 'yes',
			'metadata_alignment'            => get_theme_mod( $prefix . '_gallery_metadata_alignment', 'center' ),
			'actions_appearance'            => get_theme_mod( $prefix . '_gallery_media_actions_appearance', 'icon' ),
			'actions_behavior'              => get_theme_mod( $prefix . '_gallery_media_actions_behavior', 'hover' ),
			'download_alignment'            => get_theme_mod( $prefix . '_gallery_download_alignment', 'center' ),
			'expand_alignment'              => get_theme_mod( $prefix . '_gallery_expand_alignment', 'center' ),
			'hide_expand'                   => get_theme_mod( $prefix . '_hide_expand_button', 'no' ) === 'yes',
		);
	}
}

if ( ! function_exists( 'tainacan_blocksy_get_item_gallery_data_attributes' ) ) {
	/**
	 * HTML attribute string for the gallery section (data-gallery-*).
	 *
	 * @param string|array $prefix_or_settings Blocksy prefix, or settings from tainacan_blocksy_get_item_gallery_settings().
	 * @return string Space-prefixed attribute string, or empty when unsupported.
	 */
	function tainacan_blocksy_get_item_gallery_data_attributes( $prefix_or_settings = '' ) {
		if ( ! tainacan_blocksy_has_media_item_actions() ) {
			return '';
		}

		$settings = is_array( $prefix_or_settings )
			? $prefix_or_settings
			: tainacan_blocksy_get_item_gallery_settings( $prefix_or_settings );

		$allowed_align = array( 'left', 'center', 'right' );
		$allowed_appearance = array( 'icon', 'button', 'link' );
		$allowed_behavior = array( 'hover', 'always' );

		$metadata_alignment = in_array( $settings['metadata_alignment'], $allowed_align, true ) ? $settings['metadata_alignment'] : 'center';
		$appearance = in_array( $settings['actions_appearance'], $allowed_appearance, true ) ? $settings['actions_appearance'] : 'icon';
		$behavior = in_array( $settings['actions_behavior'], $allowed_behavior, true ) ? $settings['actions_behavior'] : 'hover';
		$download_alignment = in_array( $settings['download_alignment'], $allowed_align, true ) ? $settings['download_alignment'] : 'center';
		$expand_alignment = in_array( $settings['expand_alignment'], $allowed_align, true ) ? $settings['expand_alignment'] : 'center';

		return sprintf(
			' data-gallery-metadata-align="%1$s" data-gallery-actions-appearance="%2$s" data-gallery-actions-behavior="%3$s" data-gallery-download-align="%4$s" data-gallery-expand-align="%5$s"',
			esc_attr( $metadata_alignment ),
			esc_attr( $appearance ),
			esc_attr( $behavior ),
			esc_attr( $download_alignment ),
			esc_attr( $expand_alignment )
		);
	}
}

if ( ! function_exists( 'tainacan_blocksy_prepare_item_gallery_swiper' ) ) {
	/**
	 * Register Swiper thumbs option filters for the current gallery layout.
	 *
	 * @param array $settings Settings from tainacan_blocksy_get_item_gallery_settings().
	 */
	function tainacan_blocksy_prepare_item_gallery_swiper( $settings ) {
		static $prepared = false;

		if ( $prepared ) {
			return;
		}
		$prepared = true;

		if ( ! empty( $settings['is_gallery_mode'] ) && ( $settings['gallery_position'] ?? 'below' ) !== 'below' ) {
			add_filter(
				'tainacan-swiper-thumbs-options',
				function( $options ) {
					return array_merge(
						$options,
						array(
							'breakpoints' => array(
								'960' => array(
									'direction' => 'vertical',
								),
							),
						)
					);
				},
				10,
				1
			);
		}

		if ( ( $settings['gallery_spacing'] ?? 'default' ) === 'minimum' ) {
			add_filter(
				'tainacan-swiper-thumbs-options',
				function( $options ) {
					return array_merge(
						$options,
						array(
							'spaceBetween' => 0,
						)
					);
				},
				9,
				1
			);
		}
	}
}

if ( ! function_exists( 'tainacan_blocksy_get_item_gallery_args' ) ) {
	/**
	 * Args for tainacan_the_item_gallery() from theme mods.
	 *
	 * @param string     $context  'document' or 'attachments'.
	 * @param array|null $settings Optional settings bag.
	 * @param int        $post_id  Item post ID.
	 * @return array
	 */
	function tainacan_blocksy_get_item_gallery_args( $context, $settings = null, $post_id = 0 ) {
		if ( $settings === null ) {
			$settings = tainacan_blocksy_get_item_gallery_settings();
		}

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$shared = array(
			'hideFileNameMain'              => $settings['hide_file_name_main'],
			'hideFileCaptionMain'           => $settings['hide_file_caption_main'],
			'hideFileDescriptionMain'       => $settings['hide_file_description_main'],
			'hideFileNameThumbnails'        => $settings['hide_file_name'],
			'hideFileCaptionThumbnails'     => true,
			'hideFileDescriptionThumbnails' => true,
			'showDownloadButtonMain'        => ! $settings['hide_download_button'],
			'showArrowsAsSVG'               => false,
			'hideFileNameLightbox'          => $settings['hide_file_name_lightbox'],
			'hideFileCaptionLightbox'       => $settings['hide_file_caption_lightbox'],
			'hideFileDescriptionLightbox'   => $settings['hide_file_description_lightbox'],
			'lightboxHasLightBackground'    => $settings['has_light_dark_color_scheme'],
			'thumbnailsSize'                => $settings['thumbnails_image_size'],
			'thumbsHaveFixedHeight'         => $settings['thumbs_have_fixed_height'],
		);

		if ( $context === 'document' ) {
			return array_merge(
				$shared,
				array(
					'blockId'             => 'tainacan-item-document_id-' . $post_id,
					'layoutElements'      => array( 'main' => true, 'thumbnails' => false ),
					'mediaSources'        => array( 'document' => true, 'attachments' => false, 'metadata' => false ),
					'openLightboxOnClick' => $settings['is_gallery_mode'] ? ! $settings['disable_gallery_lightbox'] : true,
				)
			);
		}

		return array_merge(
			$shared,
			array(
				'blockId'             => 'tainacan-item-attachments_id-' . $post_id,
				'layoutElements'      => array( 'main' => $settings['is_gallery_mode'], 'thumbnails' => true ),
				'mediaSources'        => array( 'document' => $settings['is_gallery_mode'], 'attachments' => true, 'metadata' => false ),
				'openLightboxOnClick' => $settings['is_gallery_mode'] ? ! $settings['disable_gallery_lightbox'] : true,
			)
		);
	}
}

if ( ! function_exists( 'tainacan_blocksy_add_media_action_button_classes' ) ) {
	/**
	 * Add Blocksy / core button classes to an action control <a>.
	 *
	 * Uses WP_HTML_Tag_Processor so existing class attributes from Tainacan are merged,
	 * not duplicated.
	 *
	 * @param string $html Action control HTML.
	 * @return string
	 */
	function tainacan_blocksy_add_media_action_button_classes( $html ) {
		if ( $html === '' || strpos( $html, '<a' ) === false ) {
			return $html;
		}

		if ( ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $html;
		}

		$processor = new WP_HTML_Tag_Processor( $html );

		if ( ! $processor->next_tag( 'a' ) ) {
			return $html;
		}

		$processor->add_class( 'ct-button' );
		$processor->add_class( 'wp-element-button' );

		return $processor->get_updated_html();
	}
}

/**
 * Hide Expand and optionally style action links as theme buttons.
 */
function tainacan_blocksy_register_item_gallery_filters() {
	if ( ! tainacan_blocksy_has_media_item_actions() ) {
		return;
	}

	add_filter( 'tainacan_get_the_media_item_expand_control', function( $html ) {
		if ( ! function_exists( 'blocksy_manager' ) ) {
			return $html;
		}

		$settings = tainacan_blocksy_get_item_gallery_settings();

		if ( $settings['hide_expand'] ) {
			return '';
		}

		if ( $settings['actions_appearance'] === 'button' ) {
			$html = tainacan_blocksy_add_media_action_button_classes( $html );
		}

		return $html;
	} );

	$add_download_button_classes = function( $html ) {
		if ( $html === '' || ! function_exists( 'blocksy_manager' ) ) {
			return $html;
		}

		$settings = tainacan_blocksy_get_item_gallery_settings();

		if ( $settings['actions_appearance'] !== 'button' ) {
			return $html;
		}

		return tainacan_blocksy_add_media_action_button_classes( $html );
	};

	add_filter( 'tainacan_get_the_item_document_download_link', $add_download_button_classes, 10, 1 );
	add_filter( 'tainacan_get_the_item_attachment_download_link', $add_download_button_classes, 10, 1 );
}
add_action( 'init', 'tainacan_blocksy_register_item_gallery_filters' );

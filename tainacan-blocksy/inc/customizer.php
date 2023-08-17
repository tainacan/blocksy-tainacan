<?php

/**
 * Adds Tainacan repository and term items list to settings on customizer.
 */

if ( !function_exists('tainacan_blocksy_add_repository_and_terms_items_options_panel') ) {
	function tainacan_blocksy_add_repository_and_terms_items_options_panel($options) {

		$options['tainacan_repository_items_list'] = blc_call_fnc(
			[
				'fnc' => 'blocksy_get_options',
				'default' => 'array'
			],
			TAINACAN_BLOCKSY_PLUGIN_DIR_PATH  . '/inc/options/archives/tainacan-repository-items.php',
			[], false
		);

		$options['tainacan_terms_items_list'] = blc_call_fnc(
			[
				'fnc' => 'blocksy_get_options',
				'default' => 'array'
			],
			TAINACAN_BLOCKSY_PLUGIN_DIR_PATH  . '/inc/options/archives/tainacan-terms-items.php',
			[], false
		);
		return $options;
	}
}
add_filter( 'blocksy_extensions_customizer_options', 'tainacan_blocksy_add_repository_and_terms_items_options_panel' );


/**
 * Adds extra customizer options to items single page template
 */
if ( !function_exists('tainacan_blocksy_custom_post_types_single_options') ) {
	function tainacan_blocksy_custom_post_types_single_options( $options, $post_type, $post_type_object ) {

		// This should only happen if we have Tainacan plugin installed
		if ( defined ('TAINACAN_VERSION') ) {
			$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();

			if ( in_array($post_type, $collections_post_types) ) {
				
				// Change the section title in the customizer
				$options['title'] = sprintf(
					__('Item from %s', 'tainacan-blocksy'),
					$post_type_object->labels->name
				);

				// Extra options to the single item template
				$item_extra_options = blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/posts/tainacan-item-single.php', [
					'post_type' => $post_type_object,
					'is_general_cpt' => true
				], false);

				if ( is_array($item_extra_options) ) {
					array_splice(
						$options['options'][$post_type . '_single_section_options']['inner-options'][0],
						1,
						0,
						$item_extra_options
					);
				}
			} else if ( $post_type == 'tainacan-taxonomy' ) {

				// Change the section title in the customizer
				$options['title'] = sprintf(
					$options['title'] . ' ' . __('(terms list)', 'tainacan-blocksy'),
					$post_type_object->labels->name
				);

				// Extra options to the single taxonomy (terms list) template
				$item_extra_options = blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/posts/tainacan-taxonomy-single.php', [
					'post_type' => $post_type_object,
					'is_general_cpt' => true
				], false);
				
				if ( is_array($item_extra_options) ) {
					array_splice(
						$options['options'][$post_type . '_single_section_options']['inner-options'][0],
						1,
						0,
						$item_extra_options
					);
				}
			}
				
		}

		return $options;
	}
}
add_filter( 'blocksy:custom_post_types:single-options', 'tainacan_blocksy_custom_post_types_single_options', 10, 3 );


/**
 * Adds extra customizer options to items single page template
 */
if ( !function_exists('tainacan_blocksy_custom_post_types_archive_options') ) {
	function tainacan_blocksy_custom_post_types_archive_options( $options, $post_type, $post_type_object ) {

		// This should only happen if we have Tainacan plugin installed
		if ( defined ('TAINACAN_VERSION') ) {
			$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();

			if ( in_array($post_type, $collections_post_types) ) {
				
				// Change the section title in the customizer
				$options['title'] = sprintf(
					__('Items list from %s', 'tainacan-blocksy'),
					$post_type_object->labels->name
				);
				
				// Extra options to the archive items list
				$items_extra_options = blocksy_get_options(TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/options/posts/tainacan-item-archive.php', [
					'prefix' => $post_type_object->name,
					'is_general_cpt' => true
				], false);
				
				if ( is_array($items_extra_options) ) {
					$options['options'][$post_type . '_section_options']['inner-options'] = $items_extra_options;
				}

			// We also do some changes on the Collections
			} else if ( $post_type == 'tainacan-collection' ) {

				// Change the section title in the customizer
				$options['title'] = __('Tainacan collections list', 'tainacan-blocksy');

				return $options;

			// And taxonomies
			}  else if ( $post_type == 'tainacan-taxonomy' ) {

				// Change the section title in the customizer
				$options['title'] = __('Tainacan taxonomies list', 'tainacan-blocksy');

				return $options;
			}
		}
		
		return $options;
	}
}
add_filter( 'blocksy:custom_post_types:archive-options', 'tainacan_blocksy_custom_post_types_archive_options', 10, 3 );


/**
 * Removes tainacan metadatum and filters from the custom metadata options in the customizer controller.
 */
if ( !function_exists('tainacan_blocksy_custom_post_types_supported_list') ) {
	function tainacan_blocksy_custom_post_types_supported_list( $potential_post_types ) {
		
		// This should only happen if we have Tainacan plugin installed
		if ( defined ('TAINACAN_VERSION') ) {
			return array_filter( $potential_post_types, function($post_type) {
				return !in_array($post_type, [ 'tainacan-metadatum', 'tainacan-filter', 'tainacan-metasection' ]);
			});
		}
		return $potential_post_types;
	}
}
add_filter( 'blocksy:custom_post_types:supported_list', 'tainacan_blocksy_custom_post_types_supported_list', 10 );

/**
 * Renders the single item page with a custom template that will use most of Blocksy features
 */
if ( !function_exists('tainacan_blocksy_the_content_for_items') ) {
	function tainacan_blocksy_the_content_for_items( $content ) {
	
		// This should only happen if we have Tainacan plugin installed
		if ( defined ('TAINACAN_VERSION') ) {
			
			if ( !is_single() || !is_singular() || !in_the_loop() || !is_main_query() )
				return $content;

			$post_type = get_post_type();
			
			// Checks if we're in the taxonomy single (aka, terms archive)
			if ( $post_type == 'tainacan-taxonomy' ) {
				ob_start();
				tainacan_blocksy_get_template_part( 'tainacan/archive-terms' );
				$new_content = ob_get_contents();
				ob_end_clean();
				return $new_content;
			}
			
			// Checks if we're in the collection item single
			$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
			if ( in_array($post_type, $collections_post_types) ) { 
				ob_start();
				tainacan_blocksy_get_template_part( 'tainacan/item-single-page' );
				$new_content = ob_get_contents();
				ob_end_clean();
				return $new_content;
			}

		}	
	
		return $content;
	}
}
add_filter( 'the_content', 'tainacan_blocksy_the_content_for_items', 11);

?>
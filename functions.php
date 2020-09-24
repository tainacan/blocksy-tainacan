<?php
if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'blocksy-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'tainacan-blocksy-style',
		get_stylesheet_directory_uri() . '/style.min.css',
		array( 'blocksy-parent-style' )
	);
});

/**
 * Adds extra customizer options to items single page template
 */
function blocksy_tainacan_custom_post_types_single_options( $options, $post_type, $post_type_object ) {

	if ( defined ('TAINACAN_VERSION') ) {
		$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();

		if ( in_array($post_type, $collections_post_types) ) {
			
			$options['title'] = sprintf(
				__('Item from %s', 'blocksy-tainacan'),
				$post_type_object->labels->name
			);

			$item_extra_options = blocksy_get_options(get_stylesheet_directory() . '/inc/options/posts/tainacan-item-single.php', [
				'post_type' => $post_type_object,
				'is_general_cpt' => true
			], false);

			if ( is_array($item_extra_options) ) {
				$options['options'][$post_type . '_single_section_options']['inner-options'] = array_merge(
					$options['options'][$post_type . '_single_section_options']['inner-options'],
					$item_extra_options
				);
			}
		}
			
	}

    return $options;
}
add_filter( 'blocksy:custom_post_types:single-options', 'blocksy_tainacan_custom_post_types_single_options', 10, 3 );

/**
 * Removes tainacan metadatum and filters from the custom metadata options in the customizer controller.
 */
function blocksy_tainacan_custom_post_types_supported_list( $potential_post_types ) {
	
	if ( defined ('TAINACAN_VERSION') ) {
		return array_filter( $potential_post_types, function($post_type) {
			return !in_array($post_type, [ 'tainacan-metadatum', 'tainacan-filter' ]);
		});
	}
	return $potential_post_types;
}
add_filter( 'blocksy:custom_post_types:supported_list', 'blocksy_tainacan_custom_post_types_supported_list', 10 );

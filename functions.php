<?php
if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}

/** Theme version */
const BLOCKSY_TAINACAN_VERSION = '0.0.1';

/**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', function () {
	
	// First, we enqueue parent theme styles
	wp_enqueue_style( 'blocksy-parent-style', get_template_directory_uri() . '/style.css' );

	// Then, this child theme styles
	wp_enqueue_style( 'tainacan-blocksy-style',
		get_stylesheet_directory_uri() . '/style.min.css',
		array( 'blocksy-parent-style' )
	);

	// Now, some dynamic css that is generated using blocksy dynamic css logic
	add_action('blocksy:global-dynamic-css:enqueue', function ($args) {
		blocksy_theme_get_dynamic_styles(array_merge([
			'path' => get_stylesheet_directory() . '/global.php',
			'chunk' => 'global'
		], $args));
	}, 10, 3);
});

/**
 * Retrieves an item adjacent link, either using WP strategy or Tainacan plugin tainacan_get_adjacent_items()
 */
function blocksy_tainacan_get_adjacent_item_links() {

	$prefix = blocksy_manager()->screen->get_prefix();
    $has_thumb = get_theme_mod($prefix . '_has_post_nav_thumb', 'yes') === 'yes';
	
	if (function_exists('tainacan_get_adjacent_items') && isset($_GET['pos'])) {
		$adjacent_items = tainacan_get_adjacent_items();

		if (isset($adjacent_items['next'])) {
			$next_link_url = $adjacent_items['next']['url'];
			$next_title = $adjacent_items['next']['title'];
		} else {
			$next_link_url = false;
		}
		if (isset($adjacent_items['previous'])) {
			$previous_link_url = $adjacent_items['previous']['url'];
			$previous_title = $adjacent_items['previous']['title'];
		} else {
			$previous_link_url = false;
		}

	} else {
		//Get the links to the Previous and Next Post
		$previous_link_url = get_permalink( get_previous_post() );
		$next_link_url = get_permalink( get_next_post() );

		//Get the title of the previous post and next post
		$previous_title = get_the_title( get_previous_post() );
		$next_title = get_the_title( get_next_post() );
	}

	$previous = '';
	$next = '';

	if ($has_thumb) {

		if (function_exists('tainacan_get_adjacent_items') && isset($_GET['pos'])) {
			if ($adjacent_items['next']) {
				$next_thumb = $adjacent_items['next']['thumbnail']['tainacan-medium'][0];
			}
			if ($adjacent_items['previous']) {
				$previous_thumb = $adjacent_items['previous']['thumbnail']['tainacan-medium'][0];
			}
		} else {
			//Get the thumnail url of the previous and next post
			$previous_thumb = get_the_post_thumbnail_url( get_previous_post(), 'tainacan-medium' );
			$next_thumb = get_the_post_thumbnail_url( get_next_post(), 'tainacan-medium' );
		}

		$previous_post_image_output = blocksy_simple_image(
			$previous_thumb,
			[
				'inner_content' => '<svg width="20px" height="15px" viewBox="0 0 20 15"><polygon points="0,7.5 5.5,13 6.4,12.1 2.4,8.1 20,8.1 20,6.9 2.4,6.9 6.4,2.9 5.5,2 "/></svg>',
				'ratio' => '1/1',
				'tag_name' => 'figure'
			]
		);

		$next_post_image_output = blocksy_simple_image(
			$next_thumb,
			[
				'inner_content' => '<svg width="20px" height="15px" viewBox="0 0 20 15"><polygon points="14.5,2 13.6,2.9 17.6,6.9 0,6.9 0,8.1 17.6,8.1 13.6,12.1 14.5,13 20,7.5 "/></svg>',
				'ratio' => '1/1',
				'tag_name' => 'figure'
			]
		);
			
	} else {
		$previous = $previous_link_url === false ? '' : '<a rel="prev" href="' . $previous_link_url . '"><i class="tainacan-icon tainacan-icon-arrowleft tainacan-icon-30px"></i>&nbsp; <span>' . $previous_title . '</span></a>';
		$next = $next_link_url === false ? '' :'<a rel="next" href="' . $next_link_url . '"><span>' . $next_title . '</span> &nbsp;<i class="tainacan-icon tainacan-icon-arrowright tainacan-icon-30px"></i></a>';
	}

	// Creates the links
	$previous = $previous_link_url === false ? '' : (
		'<a href="' . $previous_link_url .'" rel="prev" class="nav-item-prev"> ' .
			($has_thumb ? $previous_post_image_output : '') .
			'<div class="item-content">' .
				'<span class="item-label">' . __( 'Previous item', 'blocksy-tainacan' )	. '</span>' .
				(!empty( $previous_title ) ? ('<span class="item-title">' . $previous_title . '</span>') : '') .
			'</div>'.
		'</a>');

	$next = $next_link_url === false ? '' : (
		'<a href="' . $next_link_url .'" rel="prev" class="nav-item-next"> ' .
			'<div class="item-content">' .
				'<span class="item-label">' . __( 'Next item', 'blocksy-tainacan') . '</span>' .
				(!empty( $next_title ) ? ('<span class="item-title">' . $next_title . '</span>') : '') .
			'</div>' .
			($has_thumb ? $next_post_image_output : '') .
		'</a>');

	return ['next' => $next, 'previous' => $previous];
}


/**
 * Copy of blocksy original post navigation function.
 */
function blocksy_default_post_navigation() {
	$next_post = apply_filters(
		'blocksy:post-navigation:next-post',
		get_adjacent_post(false, '', true)
	);

	$previous_post = apply_filters(
		'blocksy:post-navigation:previous-post',
		get_adjacent_post(false, '', false)
	);

	if (! $next_post && ! $previous_post) {
		return '';
	}

    $prefix = blocksy_manager()->screen->get_prefix();

	$container_class = 'post-navigation';

	$container_class .= ' ' . blocksy_visibility_classes(get_theme_mod(
		$prefix . '_post_nav_visibility',
		[
			'desktop' => true,
			'tablet' => true,
			'mobile' => true,
		]
	));

	$home_page_url = get_home_url();

	$post_slug = get_post_type() === 'post' ? __( 'Post', 'blocksy' ) : get_post_type_object( get_post_type() )->labels->singular_name;
	$post_slug = '<span>' . $post_slug . '</span>';

	$has_thumb = get_theme_mod($prefix . '_has_post_nav_thumb', 'yes') === 'yes';

	$has_title = get_theme_mod($prefix . '_has_post_nav_title', 'yes') === 'yes';

	$next_post_image_output = '';
	$previous_post_image_output = '';

	if ($next_post) {
		$next_title = '';

		if ($has_title) {
			$next_title = $next_post->post_title;
		}

		if ($has_thumb && get_post_thumbnail_id($next_post)) {
			$next_post_image_output = blocksy_image(
				[
					'attachment_id' => get_post_thumbnail_id( $next_post ),
					'ratio' => '1/1',
					'inner_content' => '<svg width="20px" height="15px" viewBox="0 0 20 15"><polygon points="0,7.5 5.5,13 6.4,12.1 2.4,8.1 20,8.1 20,6.9 2.4,6.9 6.4,2.9 5.5,2 "/></svg>',
					'tag_name' => 'figure'
				]
			);
		}
	}

	if ($previous_post) {
		$previous_title = '';
		if ( $has_title ) {
			$previous_title = $previous_post->post_title;
		}

		if ($has_thumb && get_post_thumbnail_id($previous_post)) {
			$previous_post_image_output = blocksy_image(
				[
					'attachment_id' => get_post_thumbnail_id( $previous_post ),
					'ratio' => '1/1',
					'inner_content' => '<svg width="20px" height="15px" viewBox="0 0 20 15"><polygon points="14.5,2 13.6,2.9 17.6,6.9 0,6.9 0,8.1 17.6,8.1 13.6,12.1 14.5,13 20,7.5 "/></svg>',
					'tag_name' => 'figure'
				]
			);
		}
	}

	ob_start();

	?>

		<nav class="<?php echo esc_attr( $container_class ); ?>">
			<?php if ($next_post) { ?>
				<a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="nav-item-prev">
					<?php if ($has_thumb) { ?>
						<?php
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo $next_post_image_output;
						?>
					<?php } ?>

					<div class="item-content">
						<span class="item-label">
							<?php
								echo wp_kses_post(sprintf(
									// translators: post title
									__( 'Previous %s', 'blocksy' ),
									$post_slug
								));
							?>
						</span>

						<?php if ( ! empty( $next_title ) ) { ?>
							<span class="item-title">
								<?php echo wp_kses_post($next_title); ?>
							</span>
						<?php } ?>
					</div>

				</a>
			<?php } else { ?>
				<div class="nav-item-prev"></div>
			<?php } ?>

			<?php if ( $previous_post ) { ?>
				<a href="<?php echo esc_url( get_permalink( $previous_post ) ); ?>" class="nav-item-next">
					<div class="item-content">
						<span class="item-label">
							<?php
								echo wp_kses_post(sprintf(
									// translators: post title
									__( 'Next %s', 'blocksy' ),
									$post_slug
								));
							?>
						</span>

						<?php if ( ! empty( $previous_title ) ) { ?>
							<span class="item-title">
								<?php echo wp_kses_post($previous_title); ?>
							</span>
						<?php } ?>
					</div>

					<?php if ($has_thumb) { ?>
						<?php
							echo $previous_post_image_output;
						?>
					<?php } ?>
				</a>
			<?php } else { ?>
				<div class="nav-item-next"></div>
			<?php } ?>

		</nav>

	<?php

	return ob_get_clean();
}

/**
 * Outputs Tainacan custom logic for items navigation with blocksy features
 */
function blocksy_tainacan_item_navigation() {
	$next = '';
	$previous = '';
	$prefix = blocksy_manager()->screen->get_prefix();
   
   	if (get_theme_mod( $prefix . '_has_post_nav', $prefix === 'single_blog_post' ? 'yes' : 'no' ) === 'yes') {
	  
	   $container_class = 'post-navigation';
   
	   $container_class .= ' ' . blocksy_visibility_classes(get_theme_mod(
		   $prefix . '_post_nav_visibility',
		   [
			   'desktop' => true,
			   'tablet' => true,
			   'mobile' => true,
		   ]
	   ));
   
	   $has_thumb = get_theme_mod($prefix . '_has_post_nav_thumb', 'yes') === 'yes';
	   
	   if ($has_thumb)
		   $container_class .= ' has-thumbnails';
		   
	   $adjacent_links = [
		   'next' => '',
		   'previous' => ''
	   ];
	   
	   $adjacent_links = blocksy_tainacan_get_adjacent_item_links();
   
	   $previous = $adjacent_links['previous'];
	   $next = $adjacent_links['next'];
	}
	
	?>
		<?php if ($previous !== '' || $next !== '') : ?>
			<nav class="<?php echo esc_attr( $container_class ); ?>">
			<?php if ( $previous !== '' ) {
				echo $previous;
			} else { ?>
				<div class="nav-item-prev"></div>
			<?php } ?>

			<?php if ( $next !== '' ) {
				echo $next;
			} else { ?>
				<div class="nav-item-next"></div>
			<?php } ?>
		</nav>
		<?php endif; ?>
	<?
}

/**
 * Overrides parent theme blocksy post navigation logic to handle items navigation
 */
function blocksy_post_navigation() {

	// This should only happen if we have Tainacan plugin installed
	if ( defined ('TAINACAN_VERSION') ) {
		$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
		$post_type = get_post_type();

		// Check if we're inside the main loop in a single Post.
		if (in_array($post_type, $collections_post_types) && is_singular() && in_the_loop() && is_main_query() ) {
			return blocksy_tainacan_item_navigation();
		}
	}
	return blocksy_default_post_navigation();
}

/**
 * Uses Blocksy filter to customize the related posts logic on Tainacan Items page.
 */
function blocksy_tainacan_custom_related_posts_query( $related_posts_query ) {

	// This should only happen if we have Tainacan plugin installed
	if ( defined ('TAINACAN_VERSION') ) {
		$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
		$post_type = get_post_type();

		// Check if we're inside the main loop in a single Post.
		if (in_array($post_type, $collections_post_types) && is_singular() && in_the_loop() && is_main_query() ) {
			// In the future, we might update the related_postd_query here for Tainacan items.
		}
	}
	return $related_posts_query;
}
add_filter( 'blocksy:related-posts:query-args', 'blocksy_tainacan_custom_related_posts_query', 10 );

/**
 * Retrieves the current items list source link
 */
function blocksy_tainacan_get_source_item_list_url() {
	$args = $_GET;
	if (isset($args['ref'])) {
		$ref = $_GET['ref'];
		unset($args['pos']);
		unset($args['ref']);
		unset($args['source_list']);
		return $ref . '?' . http_build_query(array_merge($args));
	} else {
		unset($args['pos']);
		unset($args['ref']);
		unset($args['source_list']);
		return tainacan_the_collection_url() . '?' . http_build_query(array_merge($args));
	}
}

/**
 * Adds extra customizer options to items single page template
 */
function blocksy_tainacan_custom_post_types_single_options( $options, $post_type, $post_type_object ) {

	// This should only happen if we have Tainacan plugin installed
	if ( defined ('TAINACAN_VERSION') ) {
		$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();

		if ( in_array($post_type, $collections_post_types) ) {
			
			// Change the section title in the customizer
			$options['title'] = sprintf(
				__('Item from %s', 'blocksy-tainacan'),
				$post_type_object->labels->name
			);

			// Extra options to the archive items list
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
 * Adds extra customizer options to items single page template
 */
function blocksy_tainacan_custom_post_types_archive_options( $options, $post_type, $post_type_object ) {

	// This should only happen if we have Tainacan plugin installed
	if ( defined ('TAINACAN_VERSION') ) {
		$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();

		if ( in_array($post_type, $collections_post_types) ) {
			
			// Change the section title in the customizer
			$options['title'] = sprintf(
				__('Items list from %s', 'blocksy-tainacan'),
				$post_type_object->labels->name
			);

			// Extra options to the archive items list
			$items_extra_options = blocksy_get_options(get_stylesheet_directory() . '/inc/options/posts/tainacan-item-archive.php', [
				'post_type' => $post_type_object,
				'is_general_cpt' => true
			], false);
			
			if ( is_array($items_extra_options) ) {
				$options['options'][$post_type . '_section_options']['inner-options'] = $items_extra_options;
			}
		}
	}

    return $options;
}
add_filter( 'blocksy:custom_post_types:archive-options', 'blocksy_tainacan_custom_post_types_archive_options', 10, 3 );


/**
 * Removes tainacan metadatum and filters from the custom metadata options in the customizer controller.
 */
function blocksy_tainacan_custom_post_types_supported_list( $potential_post_types ) {
	
	// This should only happen if we have Tainacan plugin installed
	if ( defined ('TAINACAN_VERSION') ) {
		return array_filter( $potential_post_types, function($post_type) {
			return !in_array($post_type, [ 'tainacan-metadatum', 'tainacan-filter' ]);
		});
	}
	return $potential_post_types;
}
add_filter( 'blocksy:custom_post_types:supported_list', 'blocksy_tainacan_custom_post_types_supported_list', 10 );

/**
 * Renders the item single page with a custom template that will use most of Blocksy features
 */
function filter_the_content_in_the_main_loop( $content ) {
 
	// This should only happen if we have Tainacan plugin installed
	if ( defined ('TAINACAN_VERSION') ) {
		$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
		$post_type = get_post_type();

		// Check if we're inside the main loop in a single Post.
		if (in_array($post_type, $collections_post_types) && is_singular() && in_the_loop() && is_main_query() ) {
			return get_template_part( 'tainacan/item-single-page' );
		}
	}
 
    return $content;
}
add_filter( 'the_content', 'filter_the_content_in_the_main_loop');

/**
 * Enqueues js scripts related to swiper, only if in TainacanSingleItem pages
 */
function blocksy_tainacan_swiper_scripts() {
	
	// This should only happen if we have Tainacan plugin installed
	if ( defined ('TAINACAN_VERSION') ) {
		$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
		$post_type = get_post_type();

		if ( in_array($post_type, $collections_post_types) ) {
			wp_enqueue_style( 'swiper', 'https://unpkg.com/swiper/swiper-bundle.min.css', array(), BLOCKSY_TAINACAN_VERSION );
			wp_enqueue_script( 'swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), BLOCKSY_TAINACAN_VERSION, true );	
			wp_enqueue_script( 'blocksy-tainacan-scripts__swiper', get_stylesheet_directory_uri() . '/js/attachments-carousel.js', ['swiper'], BLOCKSY_TAINACAN_VERSION, true );
		}

		wp_enqueue_script( 'blocksy-tainacan-scripts', get_stylesheet_directory_uri() . '/js/scripts.js', [], BLOCKSY_TAINACAN_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'blocksy_tainacan_swiper_scripts' );

/* Requires helpers */
require get_stylesheet_directory() . '/helpers/blocksy-integration.php';

/**
 * Enqueues front-end CSS for the items page fixed filters logic.
 *
 * @see wp_add_inline_style()
 */
function blocksy_tainacan_items_page_filters_fixed_on_scroll_output() {
	$prefix = blocksy_manager()->screen->get_prefix();

	$should_use_fixed_filters_logic = (version_compare(TAINACAN_VERSION, '0.17') >= 0) && get_theme_mod( $prefix . '_filters_fixed_on_scroll', 'no' ) == 'yes';
	
	if (!$should_use_fixed_filters_logic)
		return;
		
	$css = '
	/* Items list fixed filter logic (Introduced in Tainacan 0.17) */
	:not(.wp-block-tainacan-faceted-search)>.theme-items-list:not(.is-fullscreen).is-filters-menu-open.is-filters-menu-fixed-at-top .items-list-area {
		margin-left: var(--tainacan-filter-menu-width-theme) !important;
	}
	:not(.wp-block-tainacan-faceted-search)>.theme-items-list:not(.is-fullscreen).is-filters-menu-open.is-filters-menu-fixed-at-top .filters-menu:not(.filters-menu-modal) {
		position: fixed;
		top: 0px !important;
		z-index: 9;
	}
	:not(.wp-block-tainacan-faceted-search)>.theme-items-list:not(.is-fullscreen).is-filters-menu-open.is-filters-menu-fixed-at-top .filters-menu:not(.filters-menu-modal) .modal-content {
		position: absolute;
		top: 0px;
		height: auto !important;
		background: var(--tainacan-background-color, inherit);
	}
	:not(.wp-block-tainacan-faceted-search)>.theme-items-list:not(.is-fullscreen).is-filters-menu-open.is-filters-menu-fixed-at-top.is-filters-menu-fixed-at-bottom .filters-menu:not(.filters-menu-modal) {
		position: absolute;
	}
	:not(.wp-block-tainacan-faceted-search)>.theme-items-list:not(.is-fullscreen).is-filters-menu-open.is-filters-menu-fixed-at-top.is-filters-menu-fixed-at-bottom .filters-menu:not(.filters-menu-modal) .modal-content {
		top: auto;
		bottom: 0;
	}
	';
	echo '<style type="text/css" id="tainacan-fixed-filters-style">' . sprintf( $css ) . '</style>';

}
add_action( 'wp_head', 'blocksy_tainacan_items_page_filters_fixed_on_scroll_output');


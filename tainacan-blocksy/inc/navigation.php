<?php 

/**
 * Retrieves an item adjacent link, either using WP strategy or Tainacan plugin tainacan_get_adjacent_items()
 */
if ( !function_exists('tainacan_blocksy_get_adjacent_item_links') ) {
	function tainacan_blocksy_get_adjacent_item_links() {

		$prefix = blocksy_manager()->screen->get_prefix();
		
		// We use Tainacan own method for obtaining previous and next item objects
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

		// Then we obtain blocksy settings
		$has_thumb = get_theme_mod($prefix . '_has_post_nav_thumb', 'yes') === 'yes';

		$has_title = get_theme_mod($prefix . '_has_post_nav_title', 'yes') === 'yes';

		$previous = '';
		$next = '';

		if ($has_thumb) {

			$previous_thumb = '';
			$next_thumb = '';

			if (function_exists('tainacan_get_adjacent_items') && isset($_GET['pos'])) {
				if ($adjacent_items['next'] && $adjacent_items['next']['thumbnail'] && $adjacent_items['next']['thumbnail']['tainacan-medium']) {
					$next_thumb = $adjacent_items['next']['thumbnail']['tainacan-medium'][0];
				}
				if ($adjacent_items['previous'] && $adjacent_items['previous']['thumbnail'] && $adjacent_items['previous']['thumbnail']['tainacan-medium']) {
					$previous_thumb = $adjacent_items['previous']['thumbnail']['tainacan-medium'][0];
				}
			} else {
				//Get the thumnail url of the previous and next post
				$previous_thumb = get_the_post_thumbnail_url( get_previous_post(), 'tainacan-medium' );
				$next_thumb = get_the_post_thumbnail_url( get_next_post(), 'tainacan-medium' );
			}

			$previous_post_image_output = $previous_thumb ? blocksy_simple_image(
				$previous_thumb,
				[
					'inner_content' => '<svg width="20px" height="15px" viewBox="0 0 20 15"><polygon points="0,7.5 5.5,13 6.4,12.1 2.4,8.1 20,8.1 20,6.9 2.4,6.9 6.4,2.9 5.5,2 "/></svg>',
					'ratio' => '1/1',
					'tag_name' => 'figure'
				]
			) : '';

			$next_post_image_output = $next_thumb ? blocksy_simple_image(
				$next_thumb,
				[
					'inner_content' => '<svg width="20px" height="15px" viewBox="0 0 20 15"><polygon points="14.5,2 13.6,2.9 17.6,6.9 0,6.9 0,8.1 17.6,8.1 13.6,12.1 14.5,13 20,7.5 "/></svg>',
					'ratio' => '1/1',
					'tag_name' => 'figure'
				]
			) : '';
				
		}

		// Creates the links
		$previous = $previous_link_url === false ? '' : (
			'<a href="' . $previous_link_url .'" rel="prev" class="nav-item-prev"> ' .
				($has_thumb ? $previous_post_image_output : '') .
				'<div class="item-content">' .
					'<span class="item-label">' . __( 'Previous item', 'tainacan-blocksy' )	. '</span>' .
					(( !empty( $previous_title ) && $has_title ) ? ('<span class="item-title">' . $previous_title . '</span>') : '') .
				'</div>'.
			'</a>');

		$next = $next_link_url === false ? '' : (
			'<a href="' . $next_link_url .'" rel="prev" class="nav-item-next"> ' .
				'<div class="item-content">' .
					'<span class="item-label">' . __( 'Next item', 'tainacan-blocksy') . '</span>' .
					(( !empty( $next_title ) && $has_title) ? ('<span class="item-title">' . $next_title . '</span>') : '') .
				'</div>' .
				($has_thumb ? $next_post_image_output : '') .
			'</a>');
		
		return ['next' => $next, 'previous' => $previous];
	}
}

/**
 * Copy of blocksy original post navigation function.
 * Check inc/template-tags.php post navigation file on the parent theme
 */
if ( !function_exists('blocksy_default_post_navigation') ) {
	function blocksy_default_post_navigation() {
		$prefix = blocksy_manager()->screen->get_prefix();

		$next_post = apply_filters(
			'blocksy:post-navigation:next-post',
			get_adjacent_post(false, '', true)
		);

		$previous_post = apply_filters(
			'blocksy:post-navigation:previous-post',
			get_adjacent_post(false, '', false)
		);

		$post_nav_criteria = blocksy_get_theme_mod($prefix . '_post_nav_criteria', 'default');

		if ($post_nav_criteria !== 'default') {
			$post_type = get_post_type();
			$post_nav_taxonomy_default = array_keys(blocksy_get_taxonomies_for_cpt(
				$post_type
			))[0];
	
			$post_nav_taxonomy = blocksy_get_theme_mod(
				$prefix . '_post_nav_taxonomy',
				$post_nav_taxonomy_default
			);
	
			$next_post = apply_filters(
				'blocksy:post-navigation:next-post',
				get_adjacent_post(true, '', true, $post_nav_taxonomy)
			);
	
			$previous_post = apply_filters(
				'blocksy:post-navigation:previous-post',
				get_adjacent_post(true, '', false, $post_nav_taxonomy)
			);
		}

		if (! $next_post && ! $previous_post) {
			return '';
		}

		$title_class = 'item-title';

		$title_class .= ' ' . blocksy_visibility_classes(blocksy_get_theme_mod(
			$prefix . '_post_nav_title_visibility',
			[
				'desktop' => true,
				'tablet' => true,
				'mobile' => false,
			]
		));

		$thumb_size = blocksy_get_theme_mod($prefix . '_post_nav_thumb_size', 'medium');

		$thumb_class = '';

		$thumb_class .= ' ' . blocksy_visibility_classes(blocksy_get_theme_mod(
			$prefix . '_post_nav_thumb_visibility',
			[
				'desktop' => true,
				'tablet' => true,
				'mobile' => true,
			]
		));

		$container_class = 'post-navigation';

		$container_class .= ' ' . blocksy_visibility_classes(get_theme_mod(
			$prefix . '_post_nav_visibility',
			[
				'desktop' => true,
				'tablet' => true,
				'mobile' => true,
			]
		));

		$post_slug = get_post_type_object(get_post_type())->labels->singular_name;
		$post_slug = '<span>' . $post_slug . '</span>';

		$has_thumb = get_theme_mod($prefix . '_has_post_nav_thumb', 'yes') === 'yes';

		$has_title = get_theme_mod($prefix . '_has_post_nav_title', 'yes') === 'yes';

		$next_post_image_output = '';
		$previous_post_image_output = '';

		if ($next_post) {
			$next_title = '';

			$next_title = get_the_title($next_post);

			if ($has_thumb && get_post_thumbnail_id($next_post)) {

				if ( function_exists('blocksy_image') ) {
					$next_post_image_output = blocksy_image(
						[
							'attachment_id' => get_post_thumbnail_id( $next_post ),
							'ratio' => '1/1',
							'inner_content' => '<svg width="20px" height="15px" viewBox="0 0 20 15"><polygon points="0,7.5 5.5,13 6.4,12.1 2.4,8.1 20,8.1 20,6.9 2.4,6.9 6.4,2.9 5.5,2 "/></svg>',
							'tag_name' => 'figure'
						]
					);
				} else if ( function_exists('blocksy_media') ) {
					$next_post_image_output = blocksy_media(
						[
							'attachment_id' => get_post_thumbnail_id($next_post),
							'post_id' => $next_post->ID,
							'ratio' => '1/1',
							'size' => $thumb_size,
							'class' => $thumb_class,
							'inner_content' => '<svg width="20px" height="15px" viewBox="0 0 20 15" fill="#ffffff"><polygon points="0,7.5 5.5,13 6.4,12.1 2.4,8.1 20,8.1 20,6.9 2.4,6.9 6.4,2.9 5.5,2 "/></svg>',
							'tag_name' => 'figure'
						]
					);
				}
			}
		}

		if ($previous_post) {
			$previous_title = '';

			$previous_title = get_the_title($previous_post);

			if ($has_thumb && get_post_thumbnail_id($previous_post)) {
				if ( function_exists('blocksy_image') ) {
					$previous_post_image_output = blocksy_image(
						[
							'attachment_id' => get_post_thumbnail_id( $previous_post ),
							'ratio' => '1/1',
							'inner_content' => '<svg width="20px" height="15px" viewBox="0 0 20 15"><polygon points="14.5,2 13.6,2.9 17.6,6.9 0,6.9 0,8.1 17.6,8.1 13.6,12.1 14.5,13 20,7.5 "/></svg>',
							'tag_name' => 'figure'
						]
					);
				} else if ( function_exists('blocksy_media') ) {
					$previous_post_image_output = blocksy_media(
						[
							'attachment_id' => get_post_thumbnail_id($previous_post),
							'post_id' => $previous_post->ID,
							'ratio' => '1/1',
							'size' => $thumb_size,
							'class' => $thumb_class,
							'inner_content' => '<svg width="20px" height="15px" viewBox="0 0 20 15" fill="#ffffff"><polygon points="14.5,2 13.6,2.9 17.6,6.9 0,6.9 0,8.1 17.6,8.1 13.6,12.1 14.5,13 20,7.5 "/></svg>',
							'tag_name' => 'figure'
						]
					);
				}
			}
		}

		$deep_link_args = [
			'prefix' => $prefix,
			'suffix' => $prefix . '_has_post_nav'
		];

		ob_start();

		?>
			<nav class="<?php echo esc_attr( $container_class ); ?>" <?php if (function_exists('blocksy_generic_get_deep_link') ) echo esc_attr(blocksy_generic_get_deep_link($deep_link_args)); ?>>
				<?php if ($next_post): ?>
					<a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="nav-item-prev">
						<?php if ($has_thumb): ?>
							<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo $next_post_image_output;
							?>
						<?php endif; ?>

						<div class="item-content">
							<span class="item-label">
								<?php
									echo wp_kses_post(sprintf(
										apply_filters(
											'blocksy:post-navigation:previous-post:label',
											// translators: post title
											__('Previous %s', 'blocksy')
										),
										$post_slug
									));
								?>
							</span>

							<?php if ( ! empty( $next_title ) ): ?>
								<span class="<?php echo esc_attr( $title_class ); ?>">
									<?php echo wp_kses_post($next_title); ?>
								</span>
							<?php endif; ?>
						</div>

					</a>
				<?php else: ?>
					<div class="nav-item-prev"></div>
				<?php endif; ?>

				<?php if ( $previous_post ) : ?>
					<a href="<?php echo esc_url( get_permalink( $previous_post ) ); ?>" class="nav-item-next">
						<div class="item-content">
							<span class="item-label">
								<?php
									echo wp_kses_post(sprintf(
										apply_filters(
											'blocksy:post-navigation:next-post:label',
											// translators: post title
											__('Next %s', 'blocksy')
										),
										$post_slug
									));
								?>
							</span>

							<?php if ( ! empty( $previous_title ) ) : ?>
								<span class="<?php echo esc_attr( $title_class ); ?>">
									<?php echo wp_kses_post($previous_title); ?>
								</span>
							<?php endif; ?>
						</div>

						<?php if ($has_thumb) : ?>
							<?php echo $previous_post_image_output; ?>
						<?php endif; ?>
					</a>
				<?php else : ?>
					<div class="nav-item-next"></div>
				<?php endif; ?>

			</nav>

		<?php

		return ob_get_clean();
	}
}

/**
 * Outputs Tainacan custom logic for items navigation with blocksy features
 */
if ( !function_exists('tainacan_blocksy_item_navigation') ) {
	function tainacan_blocksy_item_navigation() {
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
			
			$adjacent_links = tainacan_blocksy_get_adjacent_item_links();
			$previous = $adjacent_links['previous'];
			$next = $adjacent_links['next'];
		}
		

		if ($previous !== '' || $next !== '') {
			echo '<nav class="' . esc_attr( $container_class ) . '">';
			if ( $previous !== '' ) {
				echo wp_kses_post($previous);
			} else {
				echo '<div class="nav-item-prev"></div>';
			}
			if ( $next !== '' ) {
				echo wp_kses_post($next);
			} else { 
				echo '<div class="nav-item-next"></div>';
			}
			echo '</nav>';
		};
	}
}

/**
 * The following has to happen on hook plugins_loaded because the parent theme
 * has already declared the function in the plugin lifecycle, somehting that
 * is not necessary if on a child theme.
 */
if (!TAINACAN_BLOCKSY_IS_CHILD_THEME) {
	function tainacan_blocksy_after_theme_setup() {

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
					return tainacan_blocksy_item_navigation();
				}
			}
			return blocksy_default_post_navigation();
		}
	}
	add_action( 'plugins_loaded', 'tainacan_blocksy_after_theme_setup' );
} else {
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
				return tainacan_blocksy_item_navigation();
			}
		}
		return blocksy_default_post_navigation();
	}
}

/**
 * Uses Blocksy filter to customize the related posts logic on Tainacan Items page. (NOT IN USE YET)
 */
if ( !function_exists('tainacan_blocksy_custom_related_posts_query') ) {
	function tainacan_blocksy_custom_related_posts_query( $related_posts_query ) {

		// This should only happen if we have Tainacan plugin installed
		if ( defined ('TAINACAN_VERSION') ) {
			$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
			$post_type = get_post_type();

			// Check if we're inside the main loop in a single Post.
			if (in_array($post_type, $collections_post_types) && is_singular() && in_the_loop() && is_main_query() ) {
				// In the future, we might update the related_post_query here for Tainacan items.
			}
		}
		return $related_posts_query;
	}
}
//add_filter( 'blocksy:related-posts:query-args', 'tainacan_blocksy_custom_related_posts_query', 10 );


/**
 * Uses Blocksy filter to add custom link on the item breadcrumb
 */
if ( !function_exists('tainacan_blocksy_custom_breadcrumbs') ) {
	function tainacan_blocksy_custom_breadcrumbs( $array ) {

		// This should only happen if we have Tainacan plugin installed
		if ( defined ('TAINACAN_VERSION') ) {
			$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
			$post_type = get_post_type();

			// Check if we're inside a taxonomy archive
			if ( in_array($post_type, $collections_post_types) && is_tax() ) {
				
				$collection_archive_link_index = -1;
				for ($i = 0; $i < count($array); $i++) {
					if ( isset($array[$i]['url']) && $array[$i]['url'] == get_post_type_archive_link($post_type) ) {
						$collection_archive_link_index = $i;
						break;
					}
				}
				
				if ( $collection_archive_link_index ) {
					$term = get_queried_object();
					if ( $term ) {
						$taxonomy = get_taxonomy( $term->taxonomy );
						if ( $taxonomy && $taxonomy->labels )
							$array[$collection_archive_link_index] = [ "name" => $taxonomy->labels->singular_name ];
							$array[] = [ "name" => __('Items', 'tainacan-blocksy') ];
					}
				}
			}
			// Check if we're inside a collection archive.
			else if ( in_array($post_type, $collections_post_types) && is_archive() ) {
				$array[] = [ "name" => __('Items', 'tainacan-blocksy') ];
			}
			// Check if we're inside the main loop in a single Post.
			else if ( in_array($post_type, $collections_post_types) && is_singular() && in_the_loop() && is_main_query() ) {
				$args = $_GET;

				for ($i = 0; $i < count($array); $i++) {

					if ( isset( $array[$i]['url'] ) && $array[$i]['url'] == get_post_type_archive_link($post_type) ) {
						$collection = tainacan_get_collection();

						if ( $collection->is_cover_page_enabled() ) {
							$cover_page_id = $collection->get_cover_page_id();
							$cover_page_url = get_permalink($cover_page_id);

							$array[$i]['url'] = $cover_page_url;
						}
						continue;
					}
					
					// Check if the current thumbnail links to the collection, then enriches its URL  
					if (
						isset($array[$i]['url']) &&
						isset($args['ref']) &&
						substr($array[$i]['url'], -strlen($args['ref']))===$args['ref']
					) {
						$ref = esc_js($args['ref']);
						unset($args['pos']);
						unset($args['ref']);
						unset($args['source_list']);
						$array[$i]['url'] = $ref . '?' . http_build_query(array_merge($args));

						break;
					}
				}
				return $array;
			}
		}

		return $array;
	}
}
add_filter( 'blocksy:breadcrumbs:items-array', 'tainacan_blocksy_custom_breadcrumbs', 10, 3 );


/**
 * Retrieves an item adjacent link, either using WP strategy or Tainacan plugin tainacan_get_adjacent_items()
 */
if ( !function_exists('blocksy_tainacan_the_taxonomies_pagination') ) {
	function blocksy_tainacan_the_taxonomies_pagination($total_terms, $args = []) {

		global $wp_query;

		$allowed_prefixes_args = [
			'allowed_prefixes' => [
				'blog',
				'woo_categories'
			],
			'default_prefix' => 'blog'
		];

		$args = wp_parse_args(
			$args,
			[
				'query' => $wp_query,
				'prefix' => blocksy_manager()->screen->get_prefix(
					$allowed_prefixes_args
				),

				'has_pagination' => '__DEFAULT__',
				'pagination_type' => '__DEFAULT__',

				'last_page_text' => __('No more posts to load', 'blocksy'),
				'total_pages' => null,
				'current_page' => null,
				'format' => null,
				'base' => null
			]
		);

		$args['prefix'] = blocksy_manager()->screen->process_allowed_prefixes(
			$args['prefix'],
			$allowed_prefixes_args
		);

		if ($args['has_pagination'] === '__DEFAULT__') {
			$args['has_pagination'] = get_theme_mod(
				$args['prefix'] . '_has_pagination',
				'yes'
			) === 'yes';
		}

		if ($args['pagination_type'] === '__DEFAULT__') {
			$args['pagination_type'] = get_theme_mod(
				$args['prefix'] . '_pagination_global_type',
				'simple'
			);
		}

		$button_output = '';

		if (
			$args['pagination_type'] === 'load_more'
			&&
			intval($args['current_page']) !== intval($args['total_pages'])
		) {
			$label_button = get_theme_mod(
				$args['prefix'] . '_load_more_label',
				__('Load More', 'blocksy')
			);

			$button_output = '<button class="ct-button ct-load-more">' . $label_button . '</button>';
		}

		if (
			$args['pagination_type'] !== 'simple'
			&&
			$args['pagination_type'] !== 'next_prev'
		) {
			if (intval($args['current_page']) === intval($args['total_pages'])) {
				return '';
			}

			$button_output = '<div class="ct-load-more-helper">' . $button_output;
			$button_output .= '<span data-loader="circles"><span></span><span></span><span></span></span>';
			$button_output .= '<div class="ct-last-page-text">' . $args['last_page_text'] . '</div>';
			$button_output .= '</div>';
		}

		$pagination_class = 'ct-pagination';
		$divider_output = '';

		$divider = get_theme_mod(
			$args['prefix'] . '_paginationDivider',
			[
				'width' => 1,
				'style' => 'none',
				'color' => [
					'color' => 'rgba(224, 229, 235, 0.5)',
				]
			]
		);

		$numbers_visibility = get_theme_mod(
			$args['prefix'] . '_numbers_visibility',
			[
				'desktop' => true,
				'tablet' => true,
				'mobile' => false
			]
		);

		$arrows_visibility = get_theme_mod(
			$args['prefix'] . '_arrows_visibility',
			[
				'desktop' => true,
				'tablet' => true,
				'mobile' => true
			]
		);

		if (
			$divider['style'] !== 'none'
			&&
			$args['pagination_type'] !== 'infinite_scroll'
		) {
			$divider_output = 'data-divider';
		}

		$template = '
		<nav class="' . $pagination_class . '" data-pagination="' . $args['pagination_type'] . '" ' . $divider_output . '>
			%1$s
			%2$s
		</nav>';

		$current_args = \Tainacan\Theme_Helper::get_instance()->get_taxonomies_query_args();

		$paginate_links_args = [
			'format' => '?termspaged=%#%',
			'total' => ceil( $total_terms / $current_args['perpage'] ),
			'current' => max( 1, get_query_var('termspaged') ),
			'add_args' => array(
				'order' => $current_args['order'],
				'orderby' => $current_args['orderby'],
				'perpage' => $current_args['perpage'],
				'search' => $current_args['search'],
				'termsparent' => $current_args['termsparent'],
			),
			'mid_size' => 3,
			'end_size' => 0,
			'type' => 'array',
			'prev_text' => '<svg width="9px" height="9px" viewBox="0 0 15 15"><path class="st0" d="M10.9,15c-0.2,0-0.4-0.1-0.6-0.2L3.6,8c-0.3-0.3-0.3-0.8,0-1.1l6.6-6.6c0.3-0.3,0.8-0.3,1.1,0c0.3,0.3,0.3,0.8,0,1.1L5.2,7.4l6.2,6.2c0.3,0.3,0.3,0.8,0,1.1C11.3,14.9,11.1,15,10.9,15z"/></svg>' . __('Prev', 'blocksy'),

			'next_text' => __('Next', 'blocksy') . ' <svg width="9px" height="9px" viewBox="0 0 15 15"><path class="st0" d="M4.1,15c0.2,0,0.4-0.1,0.6-0.2L11.4,8c0.3-0.3,0.3-0.8,0-1.1L4.8,0.2C4.5-0.1,4-0.1,3.7,0.2C3.4,0.5,3.4,1,3.7,1.3l6.1,6.1l-6.2,6.2c-0.3,0.3-0.3,0.8,0,1.1C3.7,14.9,3.9,15,4.1,15z"/></svg>',
		];

		if ($args['base']) {
			$paginate_links_args['base'] = $args['base'];
		}

		if ( $total_terms <= $current_args['perpage'] )
			return '';
		
		$links = paginate_links($paginate_links_args);

		$arrow_links = ['', ''];
		$proper_links = [];

		foreach ($links as $link) {
			preg_match('/class="[^"]+"/', $link, $matches);

			if (count($matches) === 0) {
				continue;
			}

			if (
				$args['pagination_type'] === 'next_prev'
				&&
				strpos($matches[0], 'next') === false
				&&
				strpos($matches[0], 'prev') === false
			) {
				continue;
			}

			if (
				$args['pagination_type'] === 'simple'
				&&
				(
					strpos($matches[0], 'next') !== false
					||
					strpos($matches[0], 'prev') !== false
				)
			) {
				$link = str_replace(
					'page-numbers',
					trim('page-numbers ' . blocksy_visibility_classes(
						$arrows_visibility
					)),
					$link
				);
			}

			if (
				strpos($matches[0], 'next') !== false
				||
				strpos($matches[0], 'prev') !== false
			) {
				$arrow_links[strpos($matches[0], 'next') !== false ? 1 : 0] = $link;
			} else {
				$proper_links[] = $link;
			}
		}

		$proper_links = join("\n", $proper_links);

		if ($args['pagination_type'] === 'simple') {
			$proper_links = '<div class="' . blocksy_visibility_classes(
				$numbers_visibility
			) . '">' . $proper_links . '</div>';
		}

		echo sprintf(
			$template,
			$arrow_links[0] . $proper_links . $arrow_links[1],
			$button_output
		);
	}
}
?>
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
										// translators: post title
										__( 'Previous %s', 'blocksy' ),
										$post_slug
									));
								?>
							</span>

							<?php if ( ! empty( $next_title ) ): ?>
								<span class="item-title">
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
										// translators: post title
										__( 'Next %s', 'blocksy' ),
										$post_slug
									));
								?>
							</span>

							<?php if ( ! empty( $previous_title ) ) : ?>
								<span class="item-title">
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

			// Check if we're inside the main loop in a single Post.
			if (in_array($post_type, $collections_post_types) && is_singular() && in_the_loop() && is_main_query() ) {
				$args = $_GET;

				for ($i = 0; $i < count($array); $i++) {
					
					// Check if the current thumbnail links to the collection, then enriches its URL  
					if (
						isset($array[$i]['url']) &&
						isset($args['ref']) &&
						substr($array[$i]['url'], -strlen($args['ref']))===$args['ref']
					) {
						$ref = $args['ref'];
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

?>
<?php

/**
 * Enqueues styles and scripts
 * Some JS files here are only necessary for Tainacan Item pages
 */ 
function tainacan_blocksy_enqueue_scripts() {

	// First, we enqueue parent theme styles
	if ( TAINACAN_BLOCKSY_IS_CHILD_THEME )
		wp_enqueue_style( 'blocksy-parent-style', get_template_directory_uri() . '/style.css' );

	// Then, this child theme styles
	wp_enqueue_style( 'tainacan-blocksy-style',
		TAINACAN_BLOCKSY_PLUGIN_URL_PATH . '/style.min.css',
		!TAINACAN_BLOCKSY_IS_CHILD_THEME ? array() : array( 'blocksy-parent-style' ),
		TAINACAN_BLOCKSY_VERSION
	);

	// Now, some dynamic css that is generated using blocksy dynamic css logic
	add_action('blocksy:global-dynamic-css:enqueue', function ($args) {
		blocksy_theme_get_dynamic_styles(array_merge([
			'path' => TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/global.php',
			'chunk' => 'global',
			'forced_call' => true
		], $args));
	}, 10, 3);

	// This should only happen if we have Tainacan plugin installed
	if ( defined ('TAINACAN_VERSION') ) {
		// $collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
		// $post_type = get_post_type();
		wp_enqueue_script( 'tainacan-blocksy-scripts', TAINACAN_BLOCKSY_PLUGIN_URL_PATH . '/js/scripts.js', array(), TAINACAN_BLOCKSY_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'tainacan_blocksy_enqueue_scripts' );

/**
 * Enqueues front-end CSS for the items page fixed filters logic.
 */
if ( !function_exists('tainacan_blocksy_items_page_filters_fixed_on_scroll_output') ) {
	function tainacan_blocksy_items_page_filters_fixed_on_scroll_output() {
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
}
add_action( 'wp_head', 'tainacan_blocksy_items_page_filters_fixed_on_scroll_output');

?>
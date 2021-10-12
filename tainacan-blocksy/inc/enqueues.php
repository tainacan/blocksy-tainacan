<?php

/**
 * Enqueues styles and scripts
 * Some JS files here are only necessary for Tainacan Item pages
 */ 
function tainacan_blocksy_enqueue_scripts() {

	// First, we enqueue parent theme styles
	if ( TAINACAN_BLOCKSY_IS_CHILD_THEME )
		wp_enqueue_style( 'blocksy-parent-style', get_template_directory_uri() . '/style.css' );

	// Then, this child plugin/theme styles
	wp_enqueue_style( 'tainacan-blocksy-style',
		TAINACAN_BLOCKSY_PLUGIN_URL_PATH . '/style.min.css',
		!TAINACAN_BLOCKSY_IS_CHILD_THEME ? array() : array( 'blocksy-parent-style' ),
		TAINACAN_BLOCKSY_VERSION
	);

	// This should only happen if we have Tainacan plugin installed
	if ( defined ('TAINACAN_VERSION') ) {
		// $collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
		// $post_type = get_post_type();
		wp_enqueue_script( 'tainacan-blocksy-scripts', TAINACAN_BLOCKSY_PLUGIN_URL_PATH . '/js/scripts.js', array(), TAINACAN_BLOCKSY_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'tainacan_blocksy_enqueue_scripts' );

/**
 * Now, some dynamic css that is generated using blocksy dynamic css logic
 */

if ( TAINACAN_BLOCKSY_BLOCKSY_THEME_VERSION !== NULL && ( version_compare(TAINACAN_BLOCKSY_BLOCKSY_THEME_VERSION, '1.7.9') <= 0 ) ) {
	add_action('blocksy:global-dynamic-css:enqueue', function ($args) {
		blocksy_theme_get_dynamic_styles(array_merge([
			'path' => TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/global.php',
			'chunk' => 'global',
			'forced_call' => true
		], $args));
	}, 10, 3);
} else {
	add_action('blocksy:global-dynamic-css:enqueue:inline', function ($args) {
		if ( defined ('TAINACAN_VERSION') ) {	

			$collections_post_types = \Tainacan\Repositories\Repository::get_collections_db_identifiers();
			$post_type = get_post_type();

			// Check if we're inside the main loop in a single Post.
			if ( in_array($post_type, $collections_post_types) ) {
				blocksy_theme_get_dynamic_styles(array_merge([
					'path' => TAINACAN_BLOCKSY_PLUGIN_DIR_PATH . '/inc/global.php',
					'chunk' => 'global',
					'forced_call' => true
				], $args));
			}
		}
	}, 10, 3);
}

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

/**
 * Enqueues front-end CSS for the light scheme of the photoswipe layer
 */
if ( !function_exists('tainacan_blocksy_gallery_light_color_scheme') ) {
	function tainacan_blocksy_gallery_light_color_scheme() {
		$prefix = blocksy_manager()->screen->get_prefix();

		$has_light_dark_color_scheme = get_theme_mod( $prefix . '_gallery_color_scheme', 'dark' ) == 'light';

		if (!$has_light_dark_color_scheme)
			return;
			
		$css = '
		/* Photoswipe layer for the gallery dark */
		.tainacan-photoswipe-layer .pswp__bg {
			background-color: rgba(255, 255, 255, 0.85) !important;
		}
		.tainacan-photoswipe-layer .pswp__ui--fit .pswp__top-bar,
		.tainacan-photoswipe-layer .pswp__ui--fit .pswp__caption {
			background-color: rgba(255, 255, 255, 0.7) !important;
		}
		.tainacan-photoswipe-layer .pswp__top-bar .pswp__name,
		.tainacan-photoswipe-layer .pswp__caption__center {
			color: black !important;
		}
		.tainacan-photoswipe-layer .pswp__button,
		.tainacan-photoswipe-layer .pswp__button--arrow--left::before,
		.tainacan-photoswipe-layer .pswp__button--arrow--right::before {
			filter: invert(100) !important;
		}
		.tainacan-photoswipe-layer .pswp--css_animation .pswp__preloader__donut {
			border: 2px solid #000000 !important;
		}
		';
		echo '<style type="text/css" id="tainacan-gallery-color-scheme">' . sprintf( $css ) . '</style>';

	}
}
add_action( 'wp_head', 'tainacan_blocksy_gallery_light_color_scheme');

/**
 * Adds --background-color css variable, based on current background color
 */
function tainacan_blocksy_add_background_color_variable($args) {
	
	$site_background_fallback = array(
		'desktop' => 'var(--paletteColor7, #ffffff)',
		'tablet'  => 'var(--paletteColor7, #ffffff)',
		'mobile'  => 'var(--paletteColor7, #ffffff)'
	);
	$site_background = get_theme_mod( 'site_background', $site_background_fallback );
	
	$site_desktop_background = (
		isset($site_background['desktop']) &&
		isset($site_background['desktop']['backgroundColor']) &&
		isset($site_background['desktop']['backgroundColor']['default']) &&
		isset($site_background['desktop']['backgroundColor']['default']['color'])
	) ? $site_background['desktop']['backgroundColor']['default']['color'] : false;

	$site_tablet_background = (
		isset($site_background['tablet']) &&
		isset($site_background['tablet']['backgroundColor']) &&
		isset($site_background['tablet']['backgroundColor']['default']) &&
		isset($site_background['tablet']['backgroundColor']['default']['color'])
	) ? $site_background['tablet']['backgroundColor']['default']['color'] : false;

	$site_mobile_background = (
		isset($site_background['mobile']) &&
		isset($site_background['mobile']['backgroundColor']) &&
		isset($site_background['mobile']['backgroundColor']['default']) &&
		isset($site_background['mobile']['backgroundColor']['default']['color'])
	) ? $site_background['mobile']['backgroundColor']['default']['color'] : false;
	
	blocksy_output_css_vars([
		'css' => $args['css'],
		'tablet_css' => $args['tablet_css'],
		'mobile_css' => $args['mobile_css'],
		'selector' => 'body',
		'responsive' => true,
		'variableName' => 'background-color',
		'value' => array(
			'desktop' => $site_desktop_background ? $site_desktop_background : $site_background_fallback['desktop'],
			'tablet'  => $site_tablet_background ? $site_tablet_background : $site_background_fallback['tablet'],
			'mobile'  => $site_mobile_background ? $site_mobile_background : $site_background_fallback['mobile']
		)
	]);
	
}
add_action( 'blocksy:global-dynamic-css:enqueue', 'tainacan_blocksy_add_background_color_variable' );
?>
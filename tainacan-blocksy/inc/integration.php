<?php

/**
 * This is a dummy copy of the blc_call_fn function used in the blocksy-companion plugin
 * Check their /framework/helpers/blocksy-integration.php file for more details
 * I renamed the usage from 'fn' to 'fnc' to avoid future conflicts
 */
if (! function_exists('blc_call_fnc')) {
	function blc_call_fnc($args = [], ...$params) {
		$args = wp_parse_args(
			$args,
			[
				'fnc' => null,
				// string | null | array
				'default' => ''
			]
		);

		if (! $args['fnc']) {
			throw new Error('$fnc must be specified!');
		}

		if (! function_exists($args['fnc'])) {
			return $args['default'];
		}

		return call_user_func($args['fnc'], ...$params);
	}
}

/**
 * Return the url to be used in image picker from the child theme. 
 * The original function is on the /admin/helpers/options.php folder in the Blocksy parent theme.
 *
 * @param string $path image name.
 */
if (! function_exists('tainacan_blocksy_image_picker_url')) {
	function tainacan_blocksy_image_picker_url($path) {
		return TAINACAN_BLOCKSY_PLUGIN_URL_PATH . '/static/images/' . $path;
	}
}

/**
 * Retrieves the current registered view modes on Tainacan plugin and filter some options to offer as default
 * 
 * @return array An associative array with view mode options and the default one
 */
if ( !function_exists('tainacan_get_default_view_mode_choices') ) {
    function tainacan_get_default_view_mode_choices() {
        $default_view_mode = '';
        $enabled_view_modes = [];

        if (function_exists('tainacan_get_the_view_modes')) {
            $view_modes = tainacan_get_the_view_modes();
            $default_view_mode = $view_modes['default_view_mode'];
            $enabled_view_modes = [];
            
            foreach ($view_modes['registered_view_modes'] as $key => $view_mode) {
                if (!$view_mode['full_screen'])
                    $enabled_view_modes[$key] = $view_mode['label'];
            }
        } else {
            $default_view_mode = 'masonry';
            $enabled_view_modes = [
                'masonry' => __('Masonry', 'tainacan-blocksy'),
                'cards' => __('Cards', 'tainacan-blocksy'),
                'table' => __('Table', 'tainacan-blocksy'),
                'grid' => __('Grid', 'tainacan-blocksy')
            ];
        }
        return [
            'default_view_mode' => $default_view_mode,
            'enabled_view_modes' => $enabled_view_modes
        ];
    }
}


/**
 * Retrieves possible orderby and order options to offer as default
 * 
 * @return array An associative array with orderby and order options
 */
if ( !function_exists('tainacan_get_default_order_choices') ) {
    function tainacan_get_default_order_choices() {
        return [
            'title_asc' => __( 'Title A-Z', 'tainacan-blocksy'),
            'title_desc' => __( 'Title Z-A', 'tainacan-blocksy'),
            'date_asc' => __( 'Latest created last', 'tainacan-blocksy'),
            'date_desc' => __( 'Latest created first', 'tainacan-blocksy'),
            'modified_asc' => __( 'Latest modified last', 'tainacan-blocksy'),
            'modified_desc' => __( 'Latest modified first', 'tainacan-blocksy'),
        ];
    }
}

/**
 * Filters the item single content page structure to add the media gallery above the title
 *
 */
function tainacan_blocksy_render_media_gallery_above_title() {

    $prefix = blocksy_manager()->screen->get_prefix();
    $page_structure_type = get_theme_mod( $prefix . '_page_structure_type', 'type-dam');

    if ($page_structure_type === 'type-gtm') {
        
        $content_style = get_theme_mod($prefix . '_content_style', 'wide');
        $extra_classes = '';

        if ( is_array($content_style) ) {

            if ( isset($content_style['desktop']) )
                $extra_classes .= ' has-content-style-' . $content_style['desktop'] . '--desktop';
            if ( isset($content_style['tablet']) )
                $extra_classes .= ' has-content-style-' . $content_style['tablet'] . '--tablet';
            if ( isset($content_style['mobile']) )
                $extra_classes .= ' has-content-style-' . $content_style['mobile'] . '--mobile';

        } elseif ( is_string($content_style) ) {
            $extra_classes = 'has-content-style-' . $content_style;
        }

        $media_component_style = '';
        $media_component_color_palette = get_theme_mod($prefix . '_document_attachments_colors',
        [
            'color1' => [ 'color' => 'var(--theme-palette-color-6, var(--paletteColor6, #edeff2))' ],
			'color2' => [ 'color' => 'var(--theme-palette-color-4, var(--paletteColor4, #2c3e50))' ],
			'color3' => [ 'color' => 'var(--theme-palette-color-1, var(--paletteColor1, #3eaf7c))' ]
        ]);
        
        $media_component_style .= '--tainacan-media-background-color:' . $media_component_color_palette['color1']['color'] . ';';
        $media_component_style .= '--tainacan-media-color:' . $media_component_color_palette['color2']['color'] . ';';
        $media_component_style .= '--tainacan-media-accent-color:' . $media_component_color_palette['color3']['color'] . ';';
        
        echo '<div class="tainacan-gallery-above-title ' . $extra_classes . '" style="' . $media_component_style . '">';
            tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-document' );
            do_action( 'tainacan-blocksy-single-item-after-document' );  

            tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-attachments' );
            do_action( 'tainacan-blocksy-single-item-after-attachments' );
        echo '</div>';
    }
}
add_action( 'blocksy:hero:before', 'tainacan_blocksy_render_media_gallery_above_title');


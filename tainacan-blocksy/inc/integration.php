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

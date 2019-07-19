<?php

if(!function_exists('fleur_mikado_load_shortcode_interface')) {

	function fleur_mikado_load_shortcode_interface() {

		include_once MIKADO_CORE_ABS_PATH.'/shortcodes/lib/shortcode-interface.php';

	}

	add_action('fleur_mikado_before_options_map', 'fleur_mikado_load_shortcode_interface');

}

if(!function_exists('fleur_mikado_load_shortcodes')) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 * and loads load.php file in each. Hooks to fleur_mikado_after_options_map action
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */
	function fleur_mikado_load_shortcodes() {
		foreach(glob(MIKADO_CORE_ABS_PATH.'/shortcodes/*/load.php') as $shortcode_load) {
			include_once $shortcode_load;
		}

		do_action('fleur_mikado_shortcode_loader');
	}

	add_action('fleur_mikado_before_options_map', 'fleur_mikado_load_shortcodes');
}
<?php

if(!function_exists('fleur_mikado_load_widget_class')) {
	/**
	 * Loades widget class file.
	 *
	 */
	function fleur_mikado_load_widget_class() {
		include_once 'widget-class.php';
	}

	add_action('fleur_mikado_before_options_map', 'fleur_mikado_load_widget_class',9); //9 is because of the cf7 widget that is loaded from module
}

if(!function_exists('fleur_mikado_load_widgets')) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to fleur_mikado_after_options_map action
	 */
	function fleur_mikado_load_widgets() {

		foreach(glob(MIKADO_CORE_ABS_PATH.'/widgets/*/load.php') as $widget_load) {
			include_once $widget_load;
		}

		include_once 'widget-loader.php';
	}

	add_action('fleur_mikado_before_options_map', 'fleur_mikado_load_widgets');
}
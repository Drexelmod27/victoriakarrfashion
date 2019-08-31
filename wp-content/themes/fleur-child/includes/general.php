<?php


function md_load_styles() {
	$parent_style = 'fleur-mikado-default-style';
	//loading parent styles
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
	//loading current child theme styles
	wp_enqueue_style('childstyle',
		get_stylesheet_directory_uri() . '/style.css',
		array($parent_style),
		wp_get_theme()->get('Version')
	);
	//loading custom css file
	wp_enqueue_style('md-styles', get_stylesheet_directory_uri() . '/dist/css/main.css');
}

add_action('wp_enqueue_scripts', 'md_load_styles');

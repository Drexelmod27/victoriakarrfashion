<?php

if(!function_exists('fleur_mikado_button_map')) {
	function fleur_mikado_button_map() {
		$panel = fleur_mikado_add_admin_panel(array(
			'title' => esc_html__('Button', 'mkd_core'),
			'name'  => 'panel_button',
			'page'  => '_elements_page'
		));

		fleur_mikado_add_admin_field(array(
			'name'        => 'button_hover_animation',
			'type'        => 'select',
			'label'       => esc_html__('Hover Animation', 'mkd_core'),
			'description' => esc_html__('Choose default hover animation type', 'mkd_core'),
			'parent'      => $panel,
			'options'     => fleur_mikado_get_btn_hover_animation_types()
		));

		//Typography options
		fleur_mikado_add_admin_section_title(array(
			'name'   => 'typography_section_title',
			'title'  => esc_html__('Typography', 'mkd_core'),
			'parent' => $panel
		));

		$typography_group = fleur_mikado_add_admin_group(array(
			'name'        => 'typography_group',
			'title'       => esc_html__('Typography', 'mkd_core'),
			'description' => esc_html__('Setup typography for all button types', 'mkd_core'),
			'parent'      => $panel
		));

		$typography_row = fleur_mikado_add_admin_row(array(
			'name'   => 'typography_row',
			'next'   => true,
			'parent' => $typography_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'fontsimple',
			'name'          => 'button_font_family',
			'default_value' => '',
			'label'         => esc_html__('Font Family', 'mkd_core'),
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'selectsimple',
			'name'          => 'button_text_transform',
			'default_value' => '',
			'label'         => esc_html__('Text Transform', 'mkd_core'),
			'options'       => fleur_mikado_get_text_transform_array()
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'selectsimple',
			'name'          => 'button_font_style',
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'mkd_core'),
			'options'       => fleur_mikado_get_font_style_array()
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $typography_row,
			'type'          => 'textsimple',
			'name'          => 'button_letter_spacing',
			'default_value' => '',
			'label'         => esc_html__('Letter Spacing', 'mkd_core'),
			'args'          => array(
				'suffix' => 'px'
			)
		));

		$typography_row2 = fleur_mikado_add_admin_row(array(
			'name'   => 'typography_row2',
			'next'   => true,
			'parent' => $typography_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $typography_row2,
			'type'          => 'selectsimple',
			'name'          => 'button_font_weight',
			'default_value' => '',
			'label'         => esc_html__('Font Weight', 'mkd_core'),
			'options'       => fleur_mikado_get_font_weight_array()
		));

		//Outline type options
		fleur_mikado_add_admin_section_title(array(
			'name'   => 'type_section_title',
			'title'  => esc_html__('Types', 'mkd_core'),
			'parent' => $panel
		));

		$outline_group = fleur_mikado_add_admin_group(array(
			'name'        => 'outline_group',
			'title'       => esc_html__('Outline Type', 'mkd_core'),
			'description' => esc_html__('Setup outline button type', 'mkd_core'),
			'parent'      => $panel
		));

		$outline_row = fleur_mikado_add_admin_row(array(
			'name'   => 'outline_row',
			'next'   => true,
			'parent' => $outline_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Color', 'mkd_core'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_hover_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Hover Color', 'mkd_core'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_hover_bg_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Background Color', 'mkd_core'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $outline_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_border_color',
			'default_value' => '',
			'label'         => esc_html__('Border Color', 'mkd_core'),
			'description'   => ''
		));

		$outline_row2 = fleur_mikado_add_admin_row(array(
			'name'   => 'outline_row2',
			'next'   => true,
			'parent' => $outline_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $outline_row2,
			'type'          => 'colorsimple',
			'name'          => 'btn_outline_hover_border_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Border Color', 'mkd_core'),
			'description'   => ''
		));

		//Solid type options
		$solid_group = fleur_mikado_add_admin_group(array(
			'name'        => 'solid_group',
			'title'       => esc_html__('Solid Type', 'mkd_core'),
			'description' => esc_html__('Setup solid button type', 'mkd_core'),
			'parent'      => $panel
		));

		$solid_row = fleur_mikado_add_admin_row(array(
			'name'   => 'solid_row',
			'next'   => true,
			'parent' => $solid_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Color', 'mkd_core'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_text_color',
			'default_value' => '',
			'label'         => esc_html__('Text Hover Color', 'mkd_core'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_bg_color',
			'default_value' => '',
			'label'         => esc_html__('Background Color', 'mkd_core'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_bg_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Background Color', 'mkd_core'),
			'description'   => ''
		));

		$solid_row2 = fleur_mikado_add_admin_row(array(
			'name'   => 'solid_row2',
			'next'   => true,
			'parent' => $solid_group
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row2,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_border_color',
			'default_value' => '',
			'label'         => esc_html__('Border Color', 'mkd_core'),
			'description'   => ''
		));

		fleur_mikado_add_admin_field(array(
			'parent'        => $solid_row2,
			'type'          => 'colorsimple',
			'name'          => 'btn_solid_hover_border_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Border Color', 'mkd_core'),
			'description'   => ''
		));
	}

	add_action('fleur_mikado_options_elements_map', 'fleur_mikado_button_map');
}
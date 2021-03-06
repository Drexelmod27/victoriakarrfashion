<?php
namespace Fleur\Modules\Shortcodes\IntroSection;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class IntroSection implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkd_intro_section';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Intro Section', 'mkd_core'),
			'base'                      => $this->base,
			'category' => esc_html__( 'by MIKADO', 'mkd_core' ),
			'icon'                      => 'icon-wpb-intro-section extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params'                    => array(
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__('Logo', 'mkd_core'),
					'param_name'  => 'logo',
					'value'       => '',
					'save_always' => true,
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Title', 'mkd_core'),
					'param_name'  => 'title',
					'value'       => '',
					'save_always' => true,
					'admin_label' => true
				),
				array(
					'type'        => 'textarea',
					'heading'     => esc_html__('Description', 'mkd_core'),
					'param_name'  => 'description',
					'value'       => '',
					'save_always' => true,
					'admin_label' => true,
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Button Text', 'mkd_core'),
					'param_name'  => 'button_text',
					'value'       => '',
					'save_always' => true,
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Button Link', 'mkd_core'),
					'param_name'  => 'button_link',
					'value'       => '',
					'save_always' => true,
					'dependency'  => array('element' => 'button_text', 'not_empty' => true)
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Button Target', 'mkd_core'),
					'param_name'  => 'button_target',
					'value'       => array(
						esc_html__('Same Window', 'mkd_core') => '_self',
						esc_html__('New Window', 'mkd_core')  => '_blank'
					),
					'save_always' => true,
					'dependency'  => array('element' => 'button_link', 'not_empty' => true)
				),
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__('Hero Image', 'mkd_core'),
					'param_name'  => 'hero_image',
					'value'       => '',
					'save_always' => true,
					'group'       => esc_html__('Cascading Images', 'mkd_core')
				),
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__('Additional Image 1', 'mkd_core'),
					'param_name'  => 'additional_image_1',
					'value'       => '',
					'save_always' => true,
					'description' => esc_html__('Image to the left of the hero image.', 'mkd_core'),
					'group'       => esc_html__('Cascading Images', 'mkd_core')

				),
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__('Additional Image 2', 'mkd_core'),
					'param_name'  => 'additional_image_2',
					'value'       => '',
					'save_always' => true,
					'description' => esc_html__('Image to the right of the hero image.', 'mkd_core'),
					'group'       => esc_html__('Cascading Images', 'mkd_core')
				),
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__('Additional Image 3', 'mkd_core'),
					'param_name'  => 'additional_image_3',
					'value'       => '',
					'save_always' => true,
					'description' => esc_html__('Image to the far left.', 'mkd_core'),
					'group'       => esc_html__('Cascading Images', 'mkd_core')
				),
				array(
					'type'        => 'attach_image',
					'heading'     => esc_html__('Additional Image 4', 'mkd_core'),
					'param_name'  => 'additional_image_4',
					'value'       => '',
					'save_always' => true,
					'description' => esc_html__('Image to the far right.', 'mkd_core'),
					'group'       => esc_html__('Cascading Images', 'mkd_core')
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__('Title Color', 'mkd_core'),
					'param_name'  => 'title_color',
					'value'       => '',
					'save_always' => true,
					'group'       => esc_html__('Design Options', 'mkd_core')
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__('Description Color', 'mkd_core'),
					'param_name'  => 'description_color',
					'value'       => '',
					'save_always' => true,
					'group'       => esc_html__('Design Options', 'mkd_core')
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__('Background Color', 'mkd_core'),
					'param_name'  => 'background_color',
					'value'       => '',
					'save_always' => true,
					'group'       => esc_html__('Design Options', 'mkd_core')
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('Animate Images', 'mkd_core'),
					'param_name'  => 'animate_images',
					'value'       => array(
						esc_html__('Yes', 'mkd_core') => 'yes',
						esc_html__('No', 'mkd_core')  => 'no'
					),
					'save_always' => true,
					'admin_label' => true,
					'description' => '',
					'group'       => esc_html__('Advanced Options', 'mkd_core'),
					'dependency'  => array('element' => 'hero_image', 'not_empty' => true),
				),
				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__('One Scroll Hide', 'mkd_core'),
					'param_name'  => 'one_scroll_hide',
					'value'       => array(
						esc_html__('Yes', 'mkd_core') => 'yes',
						esc_html__('No', 'mkd_core')  => 'no'
					),
					'save_always' => true,
					'admin_label' => true,
					'description' => esc_html__('This feature requires that Intro Section shortcode is placed as your first element on the page.', 'mkd_core'),
					'group'       => esc_html__('Advanced Options', 'mkd_core'),
					'dependency'  => array('element' => 'hero_image', 'not_empty' => true),
				),
			)
		));
	}

	public function render($atts, $content = null) {
		$defaultAtts = array(
			'logo'               => '',
			'title'              => '',
			'title_color'        => '',
			'description'        => '',
			'button_text'        => '',
			'button_link'        => '',
			'button_target'      => '_self',
			'description_color'  => '',
			'background_color'   => '',
			'hero_image'         => '',
			'additional_image_1' => '',
			'additional_image_2' => '',
			'additional_image_3' => '',
			'additional_image_4' => '',
			'animate_images'     => 'yes',
			'one_scroll_hide'    => 'yes'
		);

		$params = shortcode_atts($defaultAtts, $atts);

		$params['holder_classes'] = $this->getHolderClasses($params);
		$params['holder_styles'] = $this->getHolderStyles($params);
		$params['title_styles'] = $this->getTitleStyles($params);
		$params['description_styles'] = $this->getDescriptionStyles($params);
		$params['button_params'] = $this->getButtonParams($params);

		return mikado_core_get_core_shortcode_template_part('templates/intro-section-template', 'intro-section', '', $params);
	}

	/**
	 * Return button data params
	 *
	 */
	private function getButtonParams($params) {
		$btnParams = array(
			'size' => 'large',
			'type' => 'outline'
		);

		if (!empty($params['button_link'])) {
			$btnParams['link'] = $params['button_link'];
		}

		if (!empty($params['button_text'])) {
			$btnParams['text'] = $params['button_text'];
		}

		if (!empty($params['button_target'])) {
			$btnParams['target'] = $params['button_target'];
		}

		return $btnParams;
	}


	/**
	 * Return holder classes
	 *
	 */
	private function getHolderClasses($params) {
		$classes = array();

		$classes[] = 'mkd-intro-section';

		if ($params['animate_images'] == 'yes') {
			$classes[] = 'mkd-is-animate-images';
		}

		if ($params['one_scroll_hide'] == 'yes') {
			$classes[] = 'mkd-is-one-scroll-hide';
		}

		return $classes;
	}


	/**
	 * Return holder styles
	 *
	 */
	private function getHolderStyles($params) {
		$styles = array();

		if ($params['background_color'] !== '') {
			$styles[] = 'background-color: ' . $params['background_color'];
		}

		return $styles;
	}

	/**
	 * Return title styles
	 *
	 */
	private function getTitleStyles($params) {
		$styles = array();

		if ($params['title_color'] !== '') {
			$styles[] = 'color: ' . $params['title_color'];
		}

		return $styles;
	}

	/**
	 * Return title styles
	 *
	 */
	private function getDescriptionStyles($params) {
		$styles = array();

		if ($params['description_color'] !== '') {
			$styles[] = 'color: ' . $params['description_color'];
		}

		return $styles;
	}
}
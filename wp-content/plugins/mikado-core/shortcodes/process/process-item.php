<?php
namespace Fleur\Modules\Shortcodes\Process;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessItem implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'mkd_process_item';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                    => esc_html__('Process Item', 'mkd_core'),
			'base'                    => $this->getBase(),
			'as_child'                => array('only' => 'mkd_process_holder'),
			'category' => esc_html__( 'by MIKADO', 'mkd_core' ),
			'icon'                    => 'icon-wpb-process-item extended-custom-icon',
			'show_settings_on_create' => true,
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Number', 'mkd_core'),
					'param_name'  => 'number',
					'save_always' => true,
					'admin_label' => true
				),
				array(
					"type"        => "dropdown",
					"class"       => "",
					"heading"     => esc_html__('Skin', 'mkd_core'),
					"param_name"  => "skin",
					"value"       => array(
						esc_html__('Default', 'mkd_core') => '',
						esc_html__('Light', 'mkd_core')   => 'light',
					),
					"save_always" => true,
					"description" => '',
					'admin_label' => true
				),
				array(
					'type'       => 'attach_image',
					'class'      => '',
					'heading'    => esc_html__('Background Image', 'mkd_core'),
					'param_name' => 'background_image',
					'value'      => '',
				),
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Title', 'mkd_core'),
					'param_name'  => 'title',
					'save_always' => true,
					'admin_label' => true
				),
				array(
					'type'        => 'textarea',
					'heading'     => esc_html__('Text', 'mkd_core'),
					'param_name'  => 'text',
					'save_always' => true,
					'admin_label' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'number' => '',
			'skin'   => '',
			'background_image' => '',
			'title'  => '',
			'text'   => '',
		);

		$params = shortcode_atts($default_atts, $atts);

		$params['item_classes'] = $this->getItemClasses($params);
		$params['item_styles'] = $this->getItemStyles($params);

		return mikado_core_get_core_shortcode_template_part('templates/process-item-template', 'process', '', $params);
	}

	private function getItemClasses($params) {
		$classes = array('mkd-process-item-holder');

		$classes[] = $params['skin'];

		return $classes;
	}

	private function getItemStyles($params) {
		$styles = array();

		if (($params['background_image']) !== '') {
			$styles[] = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';;
			$styles[] = 'background-color: transparent';
		}


		return $styles;
	}
}
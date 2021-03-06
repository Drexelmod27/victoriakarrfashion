<?php
namespace Fleur\Modules\PricingTable;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTable implements ShortcodeInterface {
	private $base;

	function __construct() {
		$this->base = 'mkd_pricing_table';
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Pricing Table', 'mkd_core'),
			'base'                      => $this->base,
			'icon'                      => 'icon-wpb-pricing-table extended-custom-icon',
			'category' => esc_html__( 'by MIKADO', 'mkd_core' ),
			'allowed_container_element' => 'vc_row',
			'as_child'                  => array('only' => 'mkd_pricing_tables'),
			'params'                    => array(
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__('Title', 'mkd_core'),
					'param_name'  => 'title',
					'value'       => 'Basic Plan',
					'description' => ''
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__('Title Size (px)', 'mkd_core'),
					'param_name'  => 'title_size',
					'value'       => '',
					'description' => '',
					'dependency'  => array('element' => 'title', 'not_empty' => true)
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__('Price', 'mkd_core'),
					'param_name'  => 'price'
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__('Currency', 'mkd_core'),
					'param_name'  => 'currency'
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__('Price Period', 'mkd_core'),
					'param_name'  => 'price_period'
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__('Label', 'mkd_core'),
					'param_name'  => 'label',
					'save_always' => ''
				),
				array(
					'type'        => 'dropdown',
					'admin_label' => true,
					'heading'     => esc_html__('Show Button', 'mkd_core'),
					'param_name'  => 'show_button',
					'value'       => array(
						esc_html__('Default', 'mkd_core') => '',
						esc_html__('Yes', 'mkd_core')     => 'yes',
						esc_html__('No', 'mkd_core')      => 'no'
					),
					'description' => ''
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__('Button Text', 'mkd_core'),
					'param_name'  => 'button_text',
					'dependency'  => array('element' => 'show_button', 'value' => 'yes')
				),
				array(
					'type'        => 'textfield',
					'admin_label' => true,
					'heading'     => esc_html__('Button Link', 'mkd_core'),
					'param_name'  => 'link',
					'dependency'  => array('element' => 'show_button', 'value' => 'yes')
				),
				array(
					'type'        => 'dropdown',
					'admin_label' => true,
					'heading'     => esc_html__('Active', 'mkd_core'),
					'param_name'  => 'active',
					'value'       => array(
						esc_html__('No', 'mkd_core')  => 'no',
						esc_html__('Yes', 'mkd_core') => 'yes'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type'       => 'attach_image',
					'class'      => '',
					'heading'    => esc_html__('Background Image', 'mkd_core'),
					'param_name' => 'background_image',
					'value'      => '',
				),
				array(
					'type'        => 'textarea_html',
					'holder'      => 'div',
					'class'       => '',
					'heading'     => esc_html__('Content', 'mkd_core'),
					'param_name'  => 'content',
					'value'       => '<li>content content content</li><li>content content content</li><li>content content content</li>',
					'description' => ''
				)
			)
		));
	}

	public function render($atts, $content = null) {

		$args = array(
			'title'                        => esc_html__('Basic Plan', 'mkd_core'),
			'title_size'                   => '',
			'price'                        => '100',
			'currency'                     => '',
			'price_period'                 => '',
			'label'                        => '',
			'active'                       => 'no',
			'show_button'                  => 'yes',
			'link'                         => '',
			'button_text'                  => 'button',
			'active_pricing_table_classes' => '',
			'background_image'             => ''
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$html = '';
		$pricing_table_clasess = 'mkd-price-table';

		if ($active == 'yes') {
			$pricing_table_clasess .= ' mkd-pt-active';
		}

		$params['pricing_table_classes'] = $pricing_table_clasess;
		$params['content'] = $content;
		$params['button_params'] = $this->getButtonParams($params);
		$params['item_styles'] = $this->getItemStyles($params);

		$params['title_styles'] = array();

		if (!empty($params['title_size'])) {
			$params['title_styles'][] = 'font-size: ' . fleur_mikado_filter_px($params['title_size']) . 'px';
		}

		$html .= mikado_core_get_core_shortcode_template_part('templates/pricing-table-template', 'pricing-table', '', $params);

		return $html;

	}

	private function getButtonParams($params) {
		$buttonParams = array();

		if ($params['show_button'] === 'yes' && $params['button_text'] !== '') {
			$buttonParams = array(
				'link' => $params['link'],
				'text' => $params['button_text'],
				'size' => 'medium',
				'type' => $params['active'] === 'yes' ? 'white-outline' : 'outline',
			);

			if ($params['active'] === 'yes') {
				$buttonParams['hover_type'] = 'white';
			}
		}

		return $buttonParams;
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

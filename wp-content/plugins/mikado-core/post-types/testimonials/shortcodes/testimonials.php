<?php

namespace MikadoCore\CPT\Testimonials\Shortcodes;


use MikadoCore\Lib;

/**
 * Class Testimonials
 * @package MikadoCore\CPT\Testimonials\Shortcodes
 */
class Testimonials implements Lib\ShortcodeInterface
{
	/**
	 * @var string
	 */
	private $base;

	public function __construct()
	{
		$this->base = 'mkd_testimonials';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase()
	{
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer
	 *
	 * @see vc_map()
	 */
	public function vcMap()
	{
		if (function_exists('vc_map')) {
			vc_map(array(
				'name' => esc_html__( 'Testimonials', 'mkd_core' ),
				'base'                      => $this->base,
				'category' => esc_html__( 'by MIKADO', 'mkd_core' ),
				'icon'                      => 'icon-wpb-testimonials extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params'                    => array(
					array(
						'type'        => 'dropdown',
						'admin_label' => true,
						'heading' => esc_html__( 'Choose Testimonial Type', 'mkd_core' ),
						'param_name'  => 'testimonial_type',
						'value'       => array(
							'Testimonials Grid'   => 'testimonials-grid',
							'Testimonials Slider' => 'testimonials-slider'
						),
						'save_always' => true
					),
					array(
						'type'        => 'dropdown',
						'heading' => esc_html__( 'Set Dark/Light type', 'mkd_core' ),
						'param_name'  => 'dark_light_type',
						'value'       => array(
							'Dark'   => 'dark',
							'Light'  => 'light',
							'Custom' => 'custom'
						),
						'save_always' => true
					),
					array(
						'type'        => 'colorpicker',
						'heading' => esc_html__( 'Navigation Color', 'mkd_core' ),
						'param_name'  => 'navigation_color',
						'value'       => '',
						'save_always' => true,
						'admin_label' => true,
						'dependency'  => Array('element' => 'testimonial_type', 'value' => 'testimonials-slider'),
						'description' => esc_html__( 'Choose dots color', 'mkd_core' )
					),
					array(
						'type'        => 'colorpicker',
						'heading' => esc_html__( 'Navigation Active Color', 'mkd_core' ),
						'param_name'  => 'navigation_active_color',
						'value'       => '',
						'save_always' => true,
						'admin_label' => true,
						'dependency'  => Array('element' => 'testimonial_type', 'value' => 'testimonials-slider'),
						'description' => esc_html__( 'Choose dots color', 'mkd_core' )
					),
					array(
						'type'        => 'dropdown',
						'holder'      => 'div',
						'class'       => '',
						'heading' => esc_html__( 'Number of Columns', 'mkd_core' ),
						'param_name'  => 'number_of_columns',
						'value'       => array(
							'Two'   => '2',
							'Three' => '3',
							'Four'  => '4'
						),
						'description' => '',
						'dependency'  => Array('element' => 'testimonial_type', 'value' => 'testimonials-grid'),
						'save_always' => true
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading' => esc_html__( 'Category', 'mkd_core' ),
						'param_name'  => 'category',
						'value'       => '',
						'description' => esc_html__( 'Category Slug (leave empty for all)', 'mkd_core' )
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading' => esc_html__( 'Number', 'mkd_core' ),
						'param_name'  => 'number',
						'value'       => '',
						'description' => esc_html__( 'Number of Testimonials', 'mkd_core' )
					),
					array(
						'type'        => 'dropdown',
						'admin_label' => true,
						'heading' => esc_html__( 'Show Title', 'mkd_core' ),
						'param_name'  => 'show_title',
						'value'       => array(
							'Yes' => 'yes',
							'No'  => 'no'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type'        => 'dropdown',
						'admin_label' => true,
						'heading' => esc_html__( 'Show Author', 'mkd_core' ),
						'param_name'  => 'show_author',
						'value'       => array(
							'Yes' => 'yes',
							'No'  => 'no'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type'        => 'dropdown',
						'admin_label' => true,
						'heading' => esc_html__( 'Show Author Job Position', 'mkd_core' ),
						'param_name'  => 'show_position',
						'value'       => array(
							'Yes' => 'yes',
							'No'  => 'no',
						),
						'save_always' => true,
						'dependency'  => array('element' => 'show_author', 'value' => array('yes')),
						'description' => ''
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading' => esc_html__( 'Animation speed', 'mkd_core' ),
						'param_name'  => 'animation_speed',
						'value'       => '',
						'description' => esc_html__('Speed of slide animation in miliseconds')
					)
				)
			));
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 *
	 * @return string
	 */
	public function render($atts, $content = null)
	{

		$args = array(
			'testimonial_type'        => 'testimonials-grid',
			'number'                  => '-1',
			'category'                => '',
			'show_title'              => 'yes',
			'show_author'             => 'yes',
			'show_position'           => 'yes',
			'animation_speed'         => '',
			'dark_light_type'         => '',
			'navigation_color'        => '',
			'navigation_active_color' => '',
			'number_of_columns'       => ''
		);

		$params = shortcode_atts($args, $atts);

		//Extract params for use in method
		extract($params);

		$data_attr = $this->getDataParams($params);
		$query_args = $this->getQueryParams($params);

		$html = '';
		$html .= '<div class="mkd-testimonials-holder clearfix ' . $dark_light_type . '">';
		$html .= '<div class="mkd-testimonials ' . $testimonial_type. '" '.$data_attr.'>';

		query_posts($query_args);
		if (have_posts()) :
			while (have_posts()) : the_post();
				$author = get_post_meta(get_the_ID(), 'mkd_testimonial_author', true);
				$text = get_post_meta(get_the_ID(), 'mkd_testimonial_text', true);
				$title = get_post_meta(get_the_ID(), 'mkd_testimonial_title', true);
				$job = get_post_meta(get_the_ID(), 'mkd_testimonial_author_position', true);

				$counter_classes = '';

				if ($params['dark_light_type'] == 'light') {
					$counter_classes .= 'light';
				}

				$params['light_class'] = $counter_classes;


				$params['columns_number'] = $this->getColumnNumberClass($params);

				$params['author'] = $author;
				$params['text'] = $text;
				$params['title'] = $title;
				$params['job'] = $job;
				$params['current_id'] = get_the_ID();

				$html .= mkd_core_get_shortcode_module_template_part('templates/' . $params['testimonial_type'], 'testimonials', '', $params);

			endwhile;
		else:
			$html .= esc_html__('Sorry, no posts matched your criteria.', 'mkd_core');
		endif;

		wp_reset_query();
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	/**
	 * Generates testimonial data attribute array
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getDataParams($params)
	{
		$data_attr = '';

		if (!empty($params['animation_speed'])) {
			$data_attr .= ' data-animation-speed ="' . $params['animation_speed'] . '"';
		}

		$data_attr .= ' data-navigation_color="' . $params['navigation_color'].'"';
		$data_attr .= ' data-navigation_active_color="' . $params['navigation_active_color'].'"';

		return $data_attr;
	}

	/**
	 * Generates testimonials query attribute array
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getQueryParams($params)
	{

		$args = array(
			'post_type'      => 'testimonials',
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => $params['number']
		);

		if ($params['category'] != '') {
			$args['testimonials_category'] = $params['category'];
		}

		return $args;
	}

	private function getColumnNumberClass($params)
	{

		$columnsNumber = '';
		$columns = $params['number_of_columns'];

		switch ($columns) {
			case 2:
				$columnsNumber = ' mkd-two-columns';
				break;
			case 3:
				$columnsNumber = ' mkd-three-columns';
				break;
			case 4:
				$columnsNumber = ' mkd-four-columns';
				break;
			default:
				$columnsNumber = ' mkd-three-column';
				break;
		}

		return $columnsNumber;
	}

}
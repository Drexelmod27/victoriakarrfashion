<?php

/**
 * Widget that adds separator boxes type
 *
 * Class Separator_Widget
 */
class FleurMikadoSeparatorWidget extends FleurMikadoWidget {
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_separator_widget', // Base ID
            esc_html__('Mikado Separator Widget', 'mkd_core') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type'    => 'dropdown',
                'title'   => esc_html__('Type', 'mkd_core'),
                'name'    => 'type',
                'options' => array(
                    'normal'     => esc_html__('Normal', 'mkd_core'),
                    'full-width' => esc_html__('Full Width', 'mkd_core')
                )
            ),
            array(
                'type'    => 'dropdown',
                'title'   => esc_html__('Position', 'mkd_core'),
                'name'    => 'position',
                'options' => array(
                    'center' => esc_html__('Center', 'mkd_core'),
                    'left'   => esc_html__('Left', 'mkd_core'),
                    'right'  => esc_html__('Right', 'mkd_core')
                )
            ),
            array(
                'type'    => 'dropdown',
                'title'   => esc_html__('Style', 'mkd_core'),
                'name'    => 'border_style',
                'options' => array(
                    'solid'  => esc_html__('Solid', 'mkd_core'),
                    'dashed' => esc_html__('Dashed', 'mkd_core'),
                    'dotted' => esc_html__('Dotted', 'mkd_core')
                )
            ),
            array(
                'type'  => 'textfield',
                'title' => esc_html__('Color', 'mkd_core'),
                'name'  => 'color'
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Width', 'mkd_core'),
                'name'        => 'width',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Thickness (px)', 'mkd_core'),
                'name'        => 'thickness',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Top Margin', 'mkd_core'),
                'name'        => 'top_margin',
                'description' => ''
            ),
            array(
                'type'        => 'textfield',
                'title'       => esc_html__('Bottom Margin', 'mkd_core'),
                'name'        => 'bottom_margin',
                'description' => ''
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        extract($args);

        //prepare variables
        $params = '';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params .= " $key='$value' ";
            }
        }

        echo '<div class="widget mkd-separator-widget">';

        //finally call the shortcode
        echo do_shortcode("[mkd_separator $params]"); // XSS OK

        echo '</div>'; //close div.mkd-separator-widget
    }
}
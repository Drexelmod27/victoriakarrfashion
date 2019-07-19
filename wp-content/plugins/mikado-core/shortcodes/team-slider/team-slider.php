<?php

namespace Fleur\Modules\Shortcodes\TeamSlider;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class TeamSlider implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_team_slider';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'         => esc_html__('Team Slider', 'mkd_core'),
            'base'         => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mkd_core' ),
            'icon'         => 'icon-wpb-team-slider extended-custom-icon',
            'is_container' => true,
            'js_view'      => 'VcColumnView',
            'as_parent'    => array('only' => 'mkd_team_slider_item'),
            'params'       => array(
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Navigation Skin', 'mkd_core'),
                    'param_name'  => 'skin',
                    'description' => '',
                    'value'       => array(
                        esc_html__('Dark', 'mkd_core')  => 'dark',
                        esc_html__('Light', 'mkd_core') => 'light'
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Number of Items in Row', 'mkd_core'),
                    'param_name'  => 'number_of_items',
                    'description' => '',
                    'value'       => array(
                        '3' => '3',
                        '4' => '4',
                        '5' => '5'
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Enable AutoPlay?', 'mkd_core'),
                    'param_name'  => 'auto_play',
                    'description' => '',
                    'value'       => array(
                        esc_html__('Yes', 'mkd_core') => 'true',
                        esc_html__('No', 'mkd_core')  => 'false'
                    ),
                ),
                array(
                    'type'        => 'dropdown',
                    'admin_label' => true,
                    'heading'     => esc_html__('Enable Pagination?', 'mkd_core'),
                    'param_name'  => 'show_dots',
                    'description' => '',
                    'value'       => array(
                        esc_html__('Yes', 'mkd_core') => 'true',
                        esc_html__('No', 'mkd_core')  => 'false'
                    ),
                ),
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'skin'            => '',
            'number_of_items' => '3',
            'auto_play'       => 'true',
            'show_dots'       => 'true'
        );
        $params       = shortcode_atts($default_atts, $atts);

        $nav = '';
        if($params['skin'] == 'light') {
            $nav = ' mkd-nav-light';
        }

        $params['light_nav'] = $nav;

        $dots = '';
        if($params['show_dots'] === 'false') {
            $dots = ' mkd-without-bullets';
        }

        $params['show_bullets'] = $dots;

        $params['content'] = $content;

        $params['data_attribute'] = $this->getDataAttribute($params);

        return mikado_core_get_core_shortcode_template_part('templates/team-slider-template', 'team-slider', '', $params);
    }

    private function getDataAttribute($params) {
        $slider_data = '';

        if($params['number_of_items'] !== '') {
            $slider_data['data-items'] = $params['number_of_items'];
        }

        if($params['auto_play'] !== '') {
            $slider_data['data-play'] = $params['auto_play'];
        }

        if($params['show_dots'] !== '') {
            $slider_data['data-dots'] = $params['show_dots'];
        }

        return $slider_data;
    }
}
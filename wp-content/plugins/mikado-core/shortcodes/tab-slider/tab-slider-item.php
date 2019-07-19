<?php
namespace Fleur\Modules\Shortcodes\TabSlider;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class TabSliderItem implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_tab_slider_item';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Tab Slider Item', 'mkd_core'),
            'base'                    => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mkd_core' ),
            'icon'                    => 'icon-wpb-tab-slider-item extended-custom-icon',
            'as_parent'               => array('except' => 'vc_row'),
            'as_child'                => array('only' => 'mkd_tab_slider'),
            'is_container'            => true,
            'show_settings_on_create' => true,
            'params'                  => array_merge(
                array(
                    array(
                        'type'        => 'attach_image',
                        'admin_label' => true,
                        'heading'     => esc_html__('Slide Image', 'mkd_core'),
                        'param_name'  => 'slide_image',
                        'value'       => '',
                        'description' => esc_html__('Select image from media library.', 'mkd_core'),
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Slide Title', 'mkd_core'),
                        'param_name'  => 'slide_title',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textarea_html',
                        'holder'      => 'div',
                        'class'       => '',
                        'heading'     => esc_html__('Content', 'mkd_core'),
                        'param_name'  => 'content',
                        'value'       => '',
                        'description' => '',
                    )
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'image_position' => '',
            'slide_image'    => '',
            'slide_title'    => ''
        );

        $params = shortcode_atts($default_atts, $atts);

        $params['content'] = $content;

        return mikado_core_get_core_shortcode_template_part('templates/tab-slider-item', 'tab-slider', '', $params);
    }
}
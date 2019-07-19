<?php
namespace Fleur\Modules\BoxHolder;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class BoxHolder implements ShortcodeInterface {
    private $base;

    function __construct() {
        $this->base = 'mkd_box_holder';
        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'            => esc_html__('Box Holder', 'mkd_core'),
            'base'            => $this->base,
            'as_parent'       => array('except' => 'vc_row, vc_accordion, no_cover_boxes, no_portfolio_list, no_portfolio_slider'),
            'content_element' => true,
            'icon'            => 'icon-wpb-box-holder extended-custom-icon',
            'category' => esc_html__( 'by MIKADO', 'mkd_core' ),
            'js_view'         => 'VcColumnView',
            'params'          => array(
                array(
                    'type'        => 'colorpicker',
                    'class'       => '',
                    'heading'     => esc_html__('Background Color', 'mkd_core'),
                    'param_name'  => 'background_color',
                    'value'       => '',
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__('Shadow', 'mkd_core'),
                    'admin_label' => true,
                    'param_name'  => 'shadow',
                    'value'       => array(
                        esc_html__('With Shadow', 'mkd_core')    => 'yes',
                        esc_html__('Without Shadow', 'mkd_core') => 'no',
                    ),
                    'description' => ''
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__('Flip On Hover', 'mkd_core'),
                    'admin_label' => true,
                    'param_name'  => 'flip_on_hover',
                    'value'       => array(
                        esc_html__('No', 'mkd_core')  => 'no',
                        esc_html__('Yes', 'mkd_core') => 'yes',
                    ),
                    'description' => '',
                    'group'       => esc_html__('Advanced Options', 'mkd_core')
                ),
                array(
                    'type'        => 'attach_image',
                    'class'       => '',
                    'heading'     => esc_html__('Background Image', 'mkd_core'),
                    'param_name'  => 'background_image',
                    'value'       => '',
                    'description' => esc_html__('Background image for the back side of Box Item.', 'mkd_core'),
                    'group'       => esc_html__('Advanced Options', 'mkd_core'),
                    'dependency'  => array('element' => 'flip_on_hover', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__('Add Image Overlay', 'mkd_core'),
                    'admin_label' => true,
                    'param_name'  => 'image_overlay',
                    'value'       => array(
                        esc_html__('None', 'mkd_core')  => 'none',
                        esc_html__('Light', 'mkd_core') => 'light',
                        esc_html__('Dark', 'mkd_core')  => 'dark',
                    ),
                    'description' => '',
                    'group'       => esc_html__('Advanced Options', 'mkd_core'),
                    'dependency'  => array('element' => 'background_image', 'not_empty' => true)
                ),
                array(
                    'type'        => 'dropdown',
                    'class'       => '',
                    'heading'     => esc_html__('Make Whole Item Clickable', 'mkd_core'),
                    'admin_label' => true,
                    'param_name'  => 'make_whole_item_clickable',
                    'value'       => array(
                        esc_html__('No', 'mkd_core')  => 'no',
                        esc_html__('Yes', 'mkd_core') => 'yes',
                    ),
                    'description' => '',
                    'group'       => esc_html__('Advanced Options', 'mkd_core'),
                    'dependency'  => array('element' => 'flip_on_hover', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Link', 'mkd_core'),
                    'param_name'  => 'link',
                    'description' => esc_html__('Enter the URL of an external link and make this item fully clickable.', 'mkd_core'),
                    'group'       => esc_html__('Advanced Options', 'mkd_core'),
                    'admin_label' => true,
                    'dependency'  => array('element' => 'make_whole_item_clickable', 'value' => array('yes'))
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Link Target', 'mkd_core'),
                    'param_name'  => 'target',
                    'value'       => array(
                        esc_html__('Blank', 'mkd_core') => '_blank',
                        esc_html__('Self', 'mkd_core')  => '_self'
                    ),
                    'admin_label' => true,
                    'group'       => esc_html__('Advanced Options', 'mkd_core'),
                    'save_always' => true,
                    'dependency'  => array('element' => 'link', 'not_empty' => true)
                ),
            )
        ));
    }

    public function render($atts, $content = null) {

        $args = array(
            'background_color'          => '',
            'shadow'                    => 'yes',
            'flip_on_hover'             => '',
            'background_image'          => '',
            'image_overlay'             => '',
            'make_whole_item_clickable' => '',
            'link'                      => '',
            'target'                    => '_blank'
        );

        $params = shortcode_atts($args, $atts);

        extract($params);

        $params['bckg_styles']           = $this->getBckStyles($params);
        $params['item_back_side_styles'] = $this->getItemBackSideStyles($params);
        $params['item_classes']          = $this->getItemClasses($params);

        $params['content'] = $content;

        return mikado_core_get_core_shortcode_template_part('templates/box-item-holder', 'box-holder', '', $params);

    }

    private function getBckStyles($params) {
        $styles = array();

        if($params['background_color'] !== '') {
            $styles[] = 'background-color: '.$params['background_color'];
        }

        return $styles;
    }

    private function getItemBackSideStyles($params) {
        $styles = array();

        if(($params['background_image']) !== '') {
            $styles[] = 'background-image: url('.wp_get_attachment_url($params['background_image']).')';;
        }

        return $styles;
    }

    private function getItemClasses($params) {
        $classes = array();

        $classes[] = 'mkd-box-item-holder';

        if(!empty($params['flip_on_hover']) && ($params['flip_on_hover'] == 'yes')) {
            $classes[] = 'mkd-box-flip';
        }

        if(!empty($params['shadow']) && ($params['shadow'] == 'yes')) {
            $classes[] = 'mkd-box-shadow';
        }

        if(!empty($params['image_overlay']) && ($params['image_overlay'] !== 'none')) {
            $classes[] = 'mkd-box-'.$params['image_overlay'].'-overlay';
        }

        return $classes;
    }

}
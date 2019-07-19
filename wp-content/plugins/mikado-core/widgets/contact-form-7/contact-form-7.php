<?php

class FleurMikadoContactForm7 extends FleurMikadoWidget {
    protected $params;

    public function __construct() {
        parent::__construct(
            'mkd_contact_form7_widget', // Base ID
			esc_html__('Mikado Contact Form 7', 'mkd_core'), // Name
            array('description' => esc_html__('Display Contact Form 7', 'mkd_core'),) // Args
        );

        $this->setParams();
    }

    protected function setParams() {

        $contact_forms = array();

        $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');

        if($cf7) {
            foreach($cf7 as $cform) {
                $contact_forms[$cform->ID] = $cform->post_title;
            }

        } else {
            $contact_forms[esc_html__('No contact forms found', 'mkd_core')] = 0;
        }

        $this->params = array(
            array(
                'name'  => 'title',
                'type'  => 'textfield',
                'title' => esc_html__('Title', 'mkd_core')
            ),
            array(
                'name'  => 'text',
                'type'  => 'textfield',
                'title' => esc_html__('Text', 'mkd_core')
            ),
            array(
                'name'  => 'background_color',
                'type'  => 'textfield',
                'title' => esc_html__('Background Color', 'mkd_core')
            ),
            array(
                'name'  => 'background_image',
                'type'  => 'textfield',
                'title' => esc_html__('Background Image Url', 'mkd_core')
            ),
            array(
                'name'    => 'id',
                'type'    => 'dropdown',
                'title'   => esc_html__('Contact Form', 'mkd_core'),
                'options' => $contact_forms
            ),
            array(
                'name'        => 'html_class',
                'type'        => 'dropdown',
                'title'       => esc_html__('Style', 'mkd_core'),
                'options'     => array(
                    'default'            => esc_html__('Default', 'mkd_core'),
                    'cf7_custom_style_1' => esc_html__('Custom Style 1', 'mkd_core'),
                    'cf7_custom_style_2' => esc_html__('Custom Style 2', 'mkd_core'),
                    'cf7_custom_style_3' => esc_html__('Custom Style 3', 'mkd_core')
                ),
                'description' => esc_html__('You can style each form element individually in Mikado Options > Contact Form 7', 'mkd_core')
            ),
            array(
                'name'    => 'cf_type',
                'type'    => 'dropdown',
                'title'   => esc_html__('Choose Layout', 'mkd_core'),
                'options' => array(
                    'boxed'  => 'Boxed',
                    'normal' => 'Normal'
                ),
            ),
            array(
                'name'    => 'color_type',
                'type'    => 'dropdown',
                'title'   => esc_html__('Choose Skin', 'mkd_core'),
                'options' => array(
                    'light' => 'Light',
                    'dark'  => 'Dark'
                ),
            ),
        );
    }


    public function widget($args, $instance) {
        extract($args);

//      //prepare variables
        $params = array();
//
        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params[$key] = $value;
            }
        }

        $layout_type = '';
        if(($instance['cf_type']) == 'boxed') {
            $layout_type = ' mkd-widget-cf-boxed';
        }

        $cfStyles = array();

        if(($instance['background_color']) !== '') {
            $cfStyles[] = 'background-color: '.$instance['background_color'].'';
        }

        if(($instance['background_image']) !== '' && ($instance['background_color']) == '') {
            $cfStyles[] = 'background-image: url('.$instance['background_image'].')';
        }

        $layout_color = '';
        if(($instance['color_type']) == 'light') {
            $layout_color = ' mkd-widget-cf-light';
        }

        $cf_custom_style = '';
        if(($instance['html_class']) === 'cf7_custom_style_1') {
            $cf_custom_style = ' cf7_custom_style_1';
        } elseif(($instance['html_class']) === 'cf7_custom_style_2') {
            $cf_custom_style = ' cf7_custom_style_2';
        }

        echo '<div class="widget mkd-contact-form-7-widget'.$layout_type.$layout_color.$cf_custom_style.'" '.fleur_mikado_get_inline_style($cfStyles).'>';

        echo '<div class="mkd-contact-form-title">';
        if(!empty($instance['title'])) {
			echo fleur_mikado_get_module_part($args['before_title'].$instance['title'].$args['after_title']);
        }
        echo '</div>';

        echo '<div class="mkd-contact-form-text">';
        if(!empty($instance['text'])) {
			echo fleur_mikado_get_module_part($args['before_title'].$instance['text'].$args['after_title']);
        }
        echo '</div>';

        echo fleur_mikado_execute_shortcode('contact-form-7', $params);

        echo '</div>'; //close mkd-contact-form-7-widget
    }
}

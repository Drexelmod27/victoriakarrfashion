<?php
namespace Fleur\Modules\Shortcodes\WorkingHours;

use Fleur\Modules\Shortcodes\Lib\ShortcodeInterface;

class WorkingHours implements ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_working_hours';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Mikado Working Hours', 'mkd_core'),
            'base'                      => $this->base,
            'category' => esc_html__( 'by MIKADO', 'mkd_core' ),
            'icon'                      => 'icon-wpb-working-hours extended-custom-icon',
            'allowed_container_element' => 'vc_row',
            'params'                    => array(
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Title', 'mkd_core'),
                    'param_name'  => 'title',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Text', 'mkd_core'),
                    'param_name'  => 'text',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Working Hours Style', 'mkd_core'),
                    'param_name'  => 'style',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__('Dark', 'mkd_core')  => 'dark',
                        esc_html__('Light', 'mkd_core') => 'light'
                    ),
                    'save_always' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Use Shortened Version?', 'mkd_core'),
                    'param_name'  => 'use_shortened_version',
                    'admin_label' => true,
                    'value'       => array(
                        esc_html__('Yes', 'mkd_core') => 'yes',
                        esc_html__('No', 'mkd_core')  => 'no'
                    ),
                    'save_always' => true
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Monday To Friday', 'mkd_core'),
                    'param_name'  => 'monday_to_friday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'mkd_core'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'yes')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Saturday', 'mkd_core'),
                    'param_name'  => 'saturday_short',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'mkd_core'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'yes')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Sunday', 'mkd_core'),
                    'param_name'  => 'sunday_short',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'mkd_core'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'yes')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Monday', 'mkd_core'),
                    'param_name'  => 'monday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'mkd_core'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Tuesday', 'mkd_core'),
                    'param_name'  => 'tuesday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'mkd_core'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Wednesday', 'mkd_core'),
                    'param_name'  => 'wednesday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'mkd_core'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Thursday', 'mkd_core'),
                    'param_name'  => 'thursday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'mkd_core'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Friday', 'mkd_core'),
                    'param_name'  => 'friday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'mkd_core'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Saturday', 'mkd_core'),
                    'param_name'  => 'saturday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'mkd_core'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => esc_html__('Sunday', 'mkd_core'),
                    'param_name'  => 'sunday',
                    'admin_label' => true,
                    'value'       => '',
                    'save_always' => true,
                    'group'       => esc_html__('Settings', 'mkd_core'),
                    'dependency'  => array('element' => 'use_shortened_version', 'value' => 'no')
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'title'                 => '',
            'text'                  => '',
            'style'                 => '',
            'use_shortened_version' => '',
            'monday_to_friday'      => '',
            'saturday_short'        => '',
            'sunday_short'          => '',
            'monday'                => '',
            'tuesday'               => '',
            'wednesday'             => '',
            'thursday'              => '',
            'friday'                => '',
            'saturday'              => '',
            'sunday'                => ''
        );

        $params = shortcode_atts($default_atts, $atts);

        $params['working_hours']  = $this->getWorkingHours($params);
        $params['holder_classes'] = $this->getHolderClasses($params);

        return mikado_core_get_core_shortcode_template_part('templates/working-hours-template', 'working-hours', '', $params);
    }

    private function getWorkingHours($params) {
        $workingHours = array();

        if(!empty($params['use_shortened_version']) && $params['use_shortened_version'] === 'yes') {
            if(!empty($params['monday_to_friday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Monday > Friday:', 'mkd_core'),
                    'time'  => $params['monday_to_friday']
                );
            }

            if(!empty($params['saturday_short'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Saturday:', 'mkd_core'),
                    'time'  => $params['saturday_short']
                );
            }
            if(!empty($params['sunday_short'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Sunday:', 'mkd_core'),
                    'time'  => $params['sunday_short']
                );
            }
        } else {
            if(!empty($params['monday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Monday:', 'mkd_core'),
                    'time'  => $params['monday']
                );
            }

            if(!empty($params['tuesday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Tuesday:', 'mkd_core'),
                    'time'  => $params['tuesday']
                );
            }

            if(!empty($params['wednesday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Wednesday:', 'mkd_core'),
                    'time'  => $params['wednesday']
                );
            }

            if(!empty($params['thursday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Thursday:', 'mkd_core'),
                    'time'  => $params['thursday']
                );
            }

            if(!empty($params['friday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Friday:', 'mkd_core'),
                    'time'  => $params['friday']
                );
            }

            if(!empty($params['saturday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Saturday:', 'mkd_core'),
                    'time'  => $params['saturday']
                );
            }

            if(!empty($params['sunday'])) {
                $workingHours[] = array(
                    'label' => esc_html__('Sunday:', 'mkd_core'),
                    'time'  => $params['sunday']
                );
            }
        }

        return $workingHours;
    }

    private function getHolderClasses($params) {
        $classes = array(
            'mkd-working-hours-holder',
            'mkd-working-hours-'.$params['style']
        );

        return $classes;
    }

}

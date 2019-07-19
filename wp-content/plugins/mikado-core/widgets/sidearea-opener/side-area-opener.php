<?php

class FleurMikadoSideAreaOpener extends FleurMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkd_side_area_opener', // Base ID
            esc_html__('Mikado Side Area Opener', 'mkd_core') // Name
        );

        $this->setParams();
    }

    protected function setParams() {

        $this->params = array(
            array(
                'name'        => 'side_area_opener_icon_color',
                'type'        => 'textfield',
                'title'       => esc_html__('Icon Color', 'mkd_core'),
                'description' => esc_html__('Define color for Side Area opener icon', 'mkd_core')
            )
        );

    }


    public function widget($args, $instance) {

        $sidearea_icon_styles = array();

        if(!empty($instance['side_area_opener_icon_color'])) {
            $sidearea_icon_styles[] = 'color: '.$instance['side_area_opener_icon_color'];
        }

		echo fleur_mikado_get_module_part($args['before_widget']);

        $icon_size = '';
        if(fleur_mikado_options()->getOptionValue('side_area_predefined_icon_size')) {
            $icon_size = fleur_mikado_options()->getOptionValue('side_area_predefined_icon_size');
        }

        $default_sidearea_opener = fleur_mikado_options()->getOptionValue('side_area_enable_default_opener') === 'yes';

        $default_sidearea_opener_class = $default_sidearea_opener ? 'mkd-side-menu-button-opener-default' : '';

        ?>
        <a class="mkd-side-menu-button-opener <?php echo esc_attr($icon_size.' '.$default_sidearea_opener_class); ?>" <?php fleur_mikado_inline_style($sidearea_icon_styles) ?> href="javascript:void(0)">
            <?php echo fleur_mikado_get_side_menu_icon_html(); ?>
        </a>

        <?php echo fleur_mikado_get_module_part($args['after_widget']); ?>

    <?php }

}
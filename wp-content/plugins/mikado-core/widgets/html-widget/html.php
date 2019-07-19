<?php

class FleurMikadoHtmlWidget extends FleurMikadoWidget {
    public function __construct() {
        parent::__construct(
            'mkd_html_widget', // Base ID
            esc_html__('Mikado Raw HTML', 'mkd_core') // Name
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array(
            array(
                'name'  => 'html',
                'type'  => 'textarea',
                'title' => esc_html__('Raw HTML', 'mkd_core')
            )
        );
    }

    public function widget($args, $instance) {
		echo fleur_mikado_get_module_part($args['before_widget']); ?>
        <div class="mkd-html-widget">
            <?php echo fleur_mikado_get_module_part($instance['html']); ?>
        </div>
        <?php echo fleur_mikado_get_module_part($args['after_widget']);
    }

}
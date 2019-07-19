<?php

class FleurMikadoLatestPosts extends FleurMikadoWidget {
    protected $params;

    public function __construct() {
        parent::__construct(
            'mkd_latest_posts_widget', // Base ID
            esc_html__('Mikado Latest Post', 'mkd_core'), // Name
            array('description' => esc_html__('Display posts from your blog', 'mkd_core'),) // Args
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array(
            array(
                'name'  => 'title',
                'type'  => 'textfield',
                'title' => esc_html__('Title', 'mkd_core')
            ),
            array(
                'name'    => 'type',
                'type'    => 'dropdown',
                'title'   => esc_html__('Type', 'mkd_core'),
                'options' => array(
                    'minimal'      => esc_html__('Minimal', 'mkd_core'),
                    'image-in-box' => esc_html__('Image in box', 'mkd_core')
                )
            ),
            array(
                'name'  => 'number_of_posts',
                'type'  => 'textfield',
                'title' => esc_html__('Number of posts', 'mkd_core')
            ),
            array(
                'name'    => 'order_by',
                'type'    => 'dropdown',
                'title'   => esc_html__('Order By', 'mkd_core'),
                'options' => array(
                    'title' => esc_html__('Title', 'mkd_core'),
                    'date'  => esc_html__('Date', 'mkd_core')
                )
            ),
            array(
                'name'    => 'order',
                'type'    => 'dropdown',
                'title'   => esc_html__('Order', 'mkd_core'),
                'options' => array(
                    'ASC'  => esc_html__('ASC', 'mkd_core'),
                    'DESC' => esc_html__('DESC', 'mkd_core')
                )
            ),
            array(
                'name'    => 'image_size',
                'type'    => 'dropdown',
                'title'   => esc_html__('Image Size', 'mkd_core'),
                'options' => array(
                    'original'  => esc_html__('Original', 'mkd_core'),
                    'landscape' => esc_html__('Landscape', 'mkd_core'),
                    'square'    => esc_html__('Square', 'mkd_core'),
                    'custom'    => esc_html__('Custom', 'mkd_core')
                )
            ),
            array(
                'name'  => 'custom_image_size',
                'type'  => 'textfield',
                'title' => esc_html__('Custom Image Size', 'mkd_core')
            ),
            array(
                'name'  => 'category',
                'type'  => 'textfield',
                'title' => esc_html__('Category Slug', 'mkd_core')
            ),
            array(
                'name'  => 'text_length',
                'type'  => 'textfield',
                'title' => esc_html__('Number of characters', 'mkd_core')
            ),
            array(
                'name'    => 'title_tag',
                'type'    => 'dropdown',
                'title'   => esc_html__('Title Tag', 'mkd_core'),
                'options' => array(
                    ""   => "",
                    "h2" => "h2",
                    "h3" => "h3",
                    "h4" => "h4",
                    "h5" => "h5",
                    "h6" => "h6"
                )
            )
        );
    }

    public function widget($args, $instance) {
        extract($args);

        //prepare variables
        $content        = '';
        $params         = array();
        $params['type'] = 'image_in_box';

        //is instance empty?
        if(is_array($instance) && count($instance)) {
            //generate shortcode params
            foreach($instance as $key => $value) {
                $params[$key] = $value;
            }
        }
        if(empty($params['title_tag'])) {
            $params['title_tag'] = 'h6';
        }
        echo '<div class="widget mkd-latest-posts-widget">';

        if(!empty($instance['title'])) {
			echo fleur_mikado_get_module_part($args['before_title'].$instance['title'].$args['after_title']);
        }

        echo fleur_mikado_execute_shortcode('mkd_blog_list', $params);

        echo '</div>'; //close mkd-latest-posts-widget
    }
}

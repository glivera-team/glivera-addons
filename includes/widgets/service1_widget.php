<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Service1_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_service1_widget';
    }

    public function get_title()
    {
        return esc_html__('Service Widget', 'glivera-addons');
    }


    public function get_icon()
    {
        return 'eicon-align-end-v';
    }

    public function get_categories()
    {
        return ['glivera-addons'];
    }

    public function get_keywords()
    {
        return ['service', 'url', 'link'];
    }

    public function get_style_depends()
    {
        return ['gtea_service1-widget'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'service1_content',
            [
                'label' => __('Service Content', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'service1_list',
            [
                'label' => esc_html__( 'Service List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'service1_image',
                        'label' => esc_html__( 'Image', 'glivera-addons' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'service1_title',
                        'label' => esc_html__( 'Title', 'glivera-addons' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'Service Name',
                    ],
                    [
                        'name' => 'service1_description',
                        'label' => esc_html__( 'Description', 'glivera-addons' ),
                        'type' => \Elementor\Controls_Manager::WYSIWYG,
                    ],
                ],
            ]
        );
        $this->add_control(
            'service1_link',
            [
                'label' => esc_html__( 'Link URL', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );



        $this->end_controls_section();


    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $service = $this->get_settings_for_display();
        $list = $service['service1_list'];
        if ( ! empty( $service['service1_link']['url'] ) ) {
            $this->add_link_attributes( 'service1_link', $service['service1_link'] );
        }
        ?>
        <section class="gtea_services1">
            <div class="gtea_services1__container">
                <div class="gtea_services1__list_w">
                    <ul class="gtea_services1__list">
                        <?php
                            if (!empty($list)) {
                                foreach ($list as $item) { ?>
                                    <li class="gtea_services1__list_item">
                                        <div class="gtea_services1">
                                            <a class="gtea_services1__in" href="#">
                                                <div class="gtea_services1__media">
                                                    <picture class="gtea_services1__pic">
                                                        <?php echo wp_get_attachment_image($item['service1_image']['id'], 'full', false, array('class' => 'gtea_services1__img', 'loading' => 'lazy')) ?>
                                                    </picture>
                                                </div>
                                                <h3 class="gtea_services1__title"><?php echo esc_html($item['service1_title']) ?></h3>
                                                <div class="gtea_services1__text">
                                                    <?php echo wp_kses_post($item['service1_description']) ?>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                <?php }
                            }
                        ?>

                    </ul>
                </div>
                <div class="gtea_services1__link_w">
                    <a class="gtea_services1__link" <?php echo wp_kses_post($this->get_render_attribute_string( 'service1_link' )) ?>> all services</a>
                </div>
            </div>
        </section>

        <?php

    }

}

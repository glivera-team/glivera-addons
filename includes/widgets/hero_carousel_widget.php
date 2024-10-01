<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Hero_Carousel_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_hero_carousel_widget';
    }

    public function get_title()
    {
        return esc_html__('Hero Carousel Widget', 'glivera-addons');
    }


    public function get_icon()
    {
        return 'eicon-slider-full-screen';
    }

    public function get_categories()
    {
        return ['glivera-addons'];
    }

    public function get_keywords()
    {
        return ['hero', 'carousel', 'link'];
    }

    public function get_style_depends()
    {
        return ['gtea_hero-widget-carousel', 'elementor-frontend'];
    }
    public function get_script_depends() {
        return [ 'swiper', 'gtea_hero-widget-carousel' ];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'glivera_animated_carousel_main',
            [
                'label' => __('Carousel Settings', 'glivera-carousel'),
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Slider Autoplay', 'glivera-carousel'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'glivera-carousel'),
                'label_off' => esc_html__('Off', 'glivera-carousel'),
                'return_value' => 'true',
                'default' => 'true',
            ]
        );
        $this->add_control(
            'icon_left',
            [
                'label' => esc_html__( 'Navigation Icon Left', 'glivera-carousel' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-angle-left',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'icon_right',
            [
                'label' => esc_html__( 'Navigation Icon Right', 'glivera-carousel' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-angle-right',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'glivera-carousel' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gtea_animated_carousel_nav i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'glivera-carousel' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gtea_animated_carousel_nav i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'glivera_animated_carousel_content',
            [
                'label' => __('Carousel Content', 'glivera-carousel'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_image', [
                'label' => esc_html__('Image', 'glivera-carousel'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__('Slide Title', 'glivera-carousel'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Title',
                'placeholder' => esc_html__('Type your title here', 'glivera-carousel'),
            ]
        );
        $repeater->add_control(
            'list_text', [
                'label' => esc_html__('Slide Description', 'glivera-carousel'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Description',
                'placeholder' => esc_html__('Type your description here', 'glivera-carousel'),
            ]
        );
        $repeater->add_control(
            'list_link', [
                'label' => esc_html__( 'Slide Button URL', 'glivera-carousel' ),
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
        $repeater->add_control(
            'button_title', [
                'label' => esc_html__('Slide Button Title', 'glivera-carousel'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Title',
                'placeholder' => esc_html__('Type your title here', 'glivera-carousel'),
            ]
        );


        $this->add_control(
            'glivera_animated_carousel_list',
            [
                'label' => __( 'Slides List', 'glivera-carousel' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Carousel Style', 'glivera-carousel'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Slide Title Color', 'glivera-carousel' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gtea_animated_carousel__mask_title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Slide Title Font', 'glivera-carousel'),
                'selector' => '{{WRAPPER}} .gtea_animated_carousel__mask_title',
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Slide Description Color', 'glivera-carousel' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gtea_animated_carousel__mask_text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Slide Description Font', 'glivera-carousel'),
                'selector' => '{{WRAPPER}} .gtea_animated_carousel__mask_text',
            ]
        );


        $this->end_controls_section();

    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $glivera_animated_carousel = $this->get_settings_for_display();
        $list = $glivera_animated_carousel['glivera_animated_carousel_list'];
        $autoplay_on = $glivera_animated_carousel['autoplay'];
        $elementClass = 'gtea_animated_carousel__mask_link';
        $instance = $this;
        $this->add_render_attribute( 'wrapper', 'class', $elementClass );
        ?>

        <section class="gtea_animated_carousel">
            <div class="gtea_animated_carousel__wrap js-gtea_animated_carousel">
                <div
                        class="gtea_animated_carousel__inner swiper js-gtea_animated_carousel-slider"
                        data-slides="3"
                        data-mobile-slides="1.4"
                        data-autoplay-on="<?php echo esc_attr($autoplay_on) ?>"
                >
                    <div class="swiper-wrapper">
                        <?php
                        if (!empty($list)) {
                            foreach ($list as $item) {
                                if ( ! empty( $item['list_link']['url'] ) ) {
                                    $this->add_link_attributes( 'list_link', $item['list_link'] );
                                }
                                ?>
                                <div class="swiper-slide gtea_animated_carousel__card">
                                    <picture class="gtea_animated_carousel__picture">
                                        <img src="<?php echo esc_url($item['list_image']['url']) ?>"
                                             alt="<?php echo wp_kses_post(\Elementor\Control_Media::get_image_alt($item['list_image'])) ?>"
                                             class="gtea_animated_carousel__img"
                                        />
                                    </picture>
                                    <?php if ( !empty($item['list_title'])) { ?>
                                        <div class="gtea_animated_carousel__mask">
                                            <div class="gtea_animated_carousel__mask_content">
                                                <h3 class="gtea_animated_carousel__mask_title"><?php echo esc_html($item['list_title']) ?></h3>
                                                <?php if (!empty($item['list_text'])) { ?>
                                                    <p class="gtea_animated_carousel__mask_text"><?php echo esc_html($item['list_text']) ?></p>
                                                <?php } ?>
                                                <?php if ( ! empty( $item['list_link']['url'] ) ) { ?>
                                                    <a <?php echo $instance->get_render_attribute_string( 'wrapper' ); echo $this->get_render_attribute_string( 'list_link' ) ?>>
                                                        <?php echo esc_html($item['button_title']) ?>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                    <button
                            type="button"
                            aria-label="Next slide"
                            class="gtea_animated_carousel__btn_next js-gtea_animated_carousel-next-btn gtea_animated_carousel_nav"
                    >
                        <?php \Elementor\Icons_Manager::render_icon( $glivera_animated_carousel['icon_right'], [ 'aria-hidden' => 'true' ] ); ?>
                    </button>
                    <button
                            type="button"
                            aria-label="Prev slide"
                            class="gtea_animated_carousel__btn_prev js-gtea_animated_carousel-prev-btn gtea_animated_carousel_nav"
                    >
                        <?php \Elementor\Icons_Manager::render_icon( $glivera_animated_carousel['icon_left'], [ 'aria-hidden' => 'true' ] ); ?>
                    </button>
                </div>
            </div>
        </section>


        <?php

    }

    protected function content_template()
    {
        ?>

        <section class="section gtea_animated_carousel">
            <div class="gtea_animated_carousel__wrap js-gtea_animated_carousel">
                <div class="gtea_animated_carousel__inner swiper js-gtea_animated_carousel-slider">
                    <div class="swiper-wrapper">
                        <# if ( settings.glivera_animated_carousel_list.length ) { #>
                        <#
                        var iconHTMLLeft = elementor.helpers.renderIcon( view, settings.icon_left, { 'aria-hidden': true }, 'i' , 'object' );
                        var iconHTMLRight = elementor.helpers.renderIcon( view, settings.icon_right, { 'aria-hidden': true }, 'i' , 'object' );
                        var elementClass = 'gtea_animated_carousel__mask_link';
                        if ( '' !== settings.hover_animation ) {
                        elementClass += ' elementor-animation-' + settings.hover_animation;
                        }
                        view.addRenderAttribute( 'wrapper', { 'class': elementClass } );
                        #>
                        <# _.each( settings.glivera_animated_carousel_list, function( item ) {
                        #>
                        <div class="swiper-slide gtea_animated_carousel__card">
                            <picture class="gtea_animated_carousel__picture">
                                <img src="{{item.list_image.url}}" alt="" class="gtea_animated_carousel__img"
                                />
                            </picture>
                            <div class="gtea_animated_carousel__mask">
                                <div class="gtea_animated_carousel__mask_content">
                                    <h3 class="gtea_animated_carousel__mask_title">{{item.list_title}}</h3>
                                    <p class="gtea_animated_carousel__mask_text">{{item.list_text}}</p>
                                    <a {{{ view.getRenderAttributeString( 'wrapper' ) }}} {{{ view.getRenderAttributeString( 'item.list_link' ) }}} >
                                    {{ item.button_title }}
                                    </a>

                                </div>

                            </div>
                        </div>
                        <# }); #>
                        <# } #>

                    </div>

                </div>
            </div>
        </section>
        <?php
    }



}

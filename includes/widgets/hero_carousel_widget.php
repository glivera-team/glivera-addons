<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Hero_Carousel_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'hero_carousel_widget';
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
        return ['hero-widget-carousel'];
    }
    public function get_script_depends() {
        return [ 'hero-widget-carousel-swiper', 'hero-widget-carousel' ];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'hero_carousel_content',
            [
                'label' => __('Carousel Content', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'hero_carousel_list',
            [
                'label' => esc_html__( 'Carousel Slides', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'list_image',
                        'label' => esc_html__( 'Image', 'glivera-addons' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'list_image_webp',
                        'label' => esc_html__( 'Image WEBP', 'glivera-addons' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                ],
            ]
        );



        $this->end_controls_section();

    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $hero_carousel = $this->get_settings_for_display();
        $list = $hero_carousel['hero_carousel_list'];
        ?>
        <section class="section glivera_carousel">
            <div class="glivera_carousel__wrap js-carousel">
                <div class="glivera_carousel__inner swiper js-carousel-slider">
                    <div class="swiper-wrapper">
                        <?php
                            if (!empty($list)) {
                                foreach ($list as $item) { ?>
                                    <div class="swiper-slide glivera_carousel__card">
                                        <picture class="glivera_carousel__picture">
                                            <source srcset="<?php echo esc_url($item['list_image_webp']['url']) ?>" type="image/webp" />
                                            <source srcset="<?php echo esc_url($item['list_image']['url']) ?>" />
                                            <img src="<?php echo esc_url($item['list_image']['url']) ?>" alt="<?php echo wp_kses_post(\Elementor\Control_Media::get_image_alt( $item['list_image'] )) ?>" class="glivera_carousel__img"
                                            /></picture>
                                    </div>
                                <?php }
                            }
                        ?>

                    </div>
                    <button
                            type="button"
                            aria-label="Prev slide"
                            class="swiper-button-prev"
                    ></button>
                    <button
                            type="button"
                            aria-label="Next slide"
                            class="swiper-button-next"
                    ></button>
                </div>
            </div>
        </section>


        <?php

    }

    protected function content_template()
    {
        ?>

        <section class="section glivera_carousel">
            <div class="glivera_carousel__wrap js-carousel">
                <div class="glivera_carousel__inner swiper js-carousel-slider">
                    <div class="swiper-wrapper">
                        <# if ( settings.hero_carousel_list.length ) { #>
                            <# _.each( settings.hero_carousel_list, function( item ) { #>
                            <div class="swiper-slide glivera_carousel__card">
                                <picture class="glivera_carousel__picture">
                                    <source srcset="{{item.list_image_webp.url}}" type="image/webp" />
                                    <source srcset="{{item.list_image.url}}" />
                                    <img src="{{item.list_image.url}}" alt="" class="glivera_carousel__img"
                                    /></picture>
                            </div>
                            <# }); #>
                        <# } #>

                    </div>
                    <button
                            type="button"
                            aria-label="Prev slide"
                            class="swiper-button-prev"
                    ></button>
                    <button
                            type="button"
                            aria-label="Next slide"
                            class="swiper-button-next"
                    ></button>
                </div>
            </div>
        </section>
        <?php
    }


}

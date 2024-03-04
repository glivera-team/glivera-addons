<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Collection_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'collection_widget';
    }

    public function get_title()
    {
        return esc_html__('Collection Widget', 'glivera-addons');
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
        return ['collection', 'url', 'link'];
    }

    public function get_style_depends()
    {
        return ['collection-widget'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'collection_content',
            [
                'label' => __('Steps Content', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'collection_title',
            [
                'label' => __('Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );



        $this->end_controls_section();


    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $collection = $this->get_settings_for_display();

        ?>
        <section class="section collections_section">
            <div class="section_in">
                <div class="section_head">
                    <h3 class="section_head__title">Collezioni</h3><a class="section_head__link" href="#">Tutte le collezioni</a>
                </div>
                <div class="mobile_slider js-mobile-slider-wrap">
                    <div class="mobile_slider__controls">
                        <div class="mobile_slider__controls_item mobile_slider__controls_item--prev_mod js-mobile-slider-prev">
                            <svg class="icon icon_arrow_prev icon--size_mod">
                                <use xlink:href="images/sprite/sprite.svg#arrow_prev"></use>
                            </svg>
                        </div>
                        <div class="mobile_slider__controls_item mobile_slider__controls_item--next_mod js-mobile-slider-next">
                            <svg class="icon icon_arrow_next icon--size_mod">
                                <use xlink:href="images/sprite/sprite.svg#arrow_next"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="collections_section__list js-collections-slider">
                        <div class="collections js-fade-el">
                            <a class="collections_main" href="#" data-speed="1" data-lag="0.45">
                                <div class="collections__pic_wrap">
                                    <picture class="collections__pic js-scale-el">
                                        <source media="(max-width: 479px)" srcset="images/collections_1.jpg" type="image/jpeg"><img class="collections__img" src="images/collections_1.jpg" alt="Collezione 01" loading="lazy">
                                    </picture>
                                </div>
                                <div class="collections__title">Collezione 01</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php

    }

    protected function content_template()
    {
        ?>

        <section class="section collections_section">
            <div class="section_in">
                <div class="section_head">
                    <h3 class="section_head__title">Collezioni</h3><a class="section_head__link" href="#">Tutte le collezioni</a>
                </div>
                <div class="mobile_slider js-mobile-slider-wrap">
                    <div class="mobile_slider__controls">
                        <div class="mobile_slider__controls_item mobile_slider__controls_item--prev_mod js-mobile-slider-prev">
                            <svg class="icon icon_arrow_prev icon--size_mod">
                                <use xlink:href="images/sprite/sprite.svg#arrow_prev"></use>
                            </svg>
                        </div>
                        <div class="mobile_slider__controls_item mobile_slider__controls_item--next_mod js-mobile-slider-next">
                            <svg class="icon icon_arrow_next icon--size_mod">
                                <use xlink:href="images/sprite/sprite.svg#arrow_next"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="collections_section__list js-collections-slider">
                        <div class="collections js-fade-el"><a class="collections_main" href="#" data-speed="1" data-lag="0.45">
                                <div class="collections__pic_wrap">
                                    <picture class="collections__pic js-scale-el">
                                        <source media="(max-width: 479px)" srcset="images/collections_1.jpg" type="image/jpeg"><img class="collections__img" src="images/collections_1.jpg" alt="Collezione 01" loading="lazy">
                                    </picture>
                                </div>
                                <div class="collections__title">Collezione 01</div></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }


}

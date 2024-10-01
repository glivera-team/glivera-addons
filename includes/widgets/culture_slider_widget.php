<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Culture_Slider_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_culture_slider_widget';
    }

    public function get_title()
    {
        return esc_html__('Call to Action Slider Widget', 'glivera-addons');
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
        return ['slider', 'url', 'animation', 'glivera'];
    }

    public function get_style_depends()
    {
        return ['gtea_culture-slider-widget'];
    }

    public function get_script_depends() {
        return [ 'swiper', 'gtea_culture-slider', 'gtea_gsap', 'gtea_scrolltrigger', 'gtea_splittext' ];
    }


    protected function register_controls()
    {

        $this->start_controls_section(
            'slider_content',
            [
                'label' => __('Slider Content', 'glivera-addons'),
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'slide_image', [
                'label' => esc_html__( 'Image', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'slide_title', [
                'label' => esc_html__( 'Title', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Slider Title',
            ]
        );
        $repeater->add_control(
            'slide_description', [
                'label' => esc_html__( 'Description', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );
        $repeater->add_control(
            'slide_link', [
                'label' => esc_html__( 'Button', 'glivera-addons' ),
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
            'slide_link_title', [
                'label' => esc_html__( 'Button Title', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Title',
            ]
        );
        $repeater->add_control(
            'slide_icon', [
                'label' => esc_html__( 'Slide Icon', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
            ]
        );
        $repeater->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Background Color', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .gtea_culture__wrap' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $repeater->add_control(
            'button_base_color',
            [
                'label' => esc_html__( 'Button Base Color', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .gtea_btn_base:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $repeater->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Button Text Color', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .gtea_btn_base' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .gtea_culture_slider__icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $repeater->add_control(
            'button_hover_color',
            [
                'label' => esc_html__( 'Button Hover Color', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .gtea_btn_base:before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'slider_list',
            [
                'label' => esc_html__( 'Slider List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Slider Style', 'glivera-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'glivera-addons' ),
                'name' => 'slider_title_typography',
                'selector' => '{{WRAPPER}} .gtea_culture_slider__title h2',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'glivera-addons' ),
                'name' => 'slider_description_typography',
                'selector' => '{{WRAPPER}} .gtea_culture_slider__text',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Button Typography', 'glivera-addons' ),
                'name' => 'slider_button_typography',
                'selector' => '{{WRAPPER}} .gtea_btn_base',
            ]
        );

    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $slider = $this->get_settings_for_display();
        $list = $slider['slider_list'];

        ?>
        <section class="section gtea_culture_slider js-gtea_culture">
            <div class="section_in">
                <div class="gtea_culture_slider__row">
                    <div class="gtea_culture_slider__column">
                        <div class="gtea_culture_slider__media">
                            <?php
                            if (!empty($list)) {
                            foreach ($list as $item) { ?>
                                <picture class="gtea_culture_slider__picture js-gtea_culture-image">
                                    <?php echo wp_get_attachment_image($item['slide_image']['id'], 'full', false, array('class' => 'gtea_culture_slider__img js-gtea_parallax')) ?>
                                </picture>
                            <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="gtea_culture_slider__column">
                        <div data-swipe-duration="0.5" data-autoplay-duration="5" class="gtea_culture_slider__swiper swiper js-gtea_culture-slider">
                            <ul class="gtea_culture_slider__wrapper swiper-wrapper">
                                <?php
                                if (!empty($list)) {
                                    foreach ($list as $item) {
                                        if ( ! empty( $item['slide_link']['url'] ) ) {
                                            $this->add_link_attributes( 'slide_link_url', $item['slide_link'] );
                                        }
                                        ?>
                                        <li class="gtea_culture_slider__slide swiper-slide elementor-repeater-item-<?php echo $item['_id'] ?>">
                                            <div class="gtea_culture_slider__content js-gtea_culture-content">
                                                <div class="gtea_culture__wrap js-gtea_culture-icon">
                                                    <?php \Elementor\Icons_Manager::render_icon( $item['slide_icon'], [ 'aria-hidden' => 'true', 'class' => 'gtea_culture_slider__icon' ] ); ?>
                                                </div>
                                                <?php if (!empty($item['slide_title'])) { ?>
                                                    <div class="gtea_culture_slider__title js-gtea_culture-title">
                                                        <?php echo wp_kses_post($item['slide_title']) ?>
                                                    </div>
                                                <?php } ?>
                                                <?php if (!empty($item['slide_description'])) { ?>
                                                    <div class="gtea_culture_slider__text js-gtea_culture-text">
                                                        <?php echo wp_kses_post($item['slide_description']) ?>
                                                    </div>
                                                <?php } ?>
                                                <div class="gtea_culture_slider__button js-gtea_culture-button">
                                                    <a <?php echo wp_kses_post($this->get_render_attribute_string( 'slide_link_url' )) ?> class="gtea_btn_base js-gtea_btn-hover">
                                                        <span><?php echo esc_html($item['slide_link_title']) ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="gtea_culture_slider__pagination js-gtea_culture-pagination"></div>
                    </div>
                </div>
            </div>
        </section>

        <?php

    }

    protected function content_template() {
        ?>
        <#
        var list = settings.slider_list;
        var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );

        #>
        <section class="section gtea_culture_slider js-gtea_culture editor_mode">
            <div class="section_in">
                <div class="gtea_culture_slider__row">
                    <div class="gtea_culture_slider__column">

                        <div class="gtea_culture_slider__media">
                            <#
                            _.each( list, function( item ) {
                            #>
                                <picture class="gtea_culture_slider__picture no-opacity js-gtea_culture-image">
                                    <img class="gtea_culture_slider__img js-gtea_parallax" src="{{item.slide_image.url}}" alt="">
                                </picture>
                            <# } ); #>
                        </div>

                    </div>
                    <div class="gtea_culture_slider__column">
                        <div data-swipe-duration="0.5" data-autoplay-duration="5" class="gtea_culture_slider__swiper swiper js-gtea_culture-slider">
                            <ul class="gtea_culture_slider__wrapper swiper-wrapper">
                                <#
                                _.each( list, function( item ) {
                                #>
                                <li class="gtea_culture_slider__slide swiper-slide">
                                    <div class="gtea_culture_slider__content no-opacity js-gtea_culture-content">
                                        <div class="gtea_culture__wrap js-gtea_culture-icon">
                                            {{{ iconHTML.value }}}
                                        </div>
                                        <div class="gtea_culture_slider__title js-gtea_culture-title">
                                            {{{item.slide_title}}}
                                        </div>
                                        <div class="gtea_culture_slider__text js-gtea_culture-text">
                                            {{{item.slide_description}}}
                                        </div>
                                        <div class="gtea_culture_slider__button js-gtea_culture-button">
                                            <a href="#" class="gtea_btn_base js-gtea_btn-hover">
                                                <span>{{ item.slide_link_title }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <# } ); #>
                            </ul>
                        </div>
                        <div class="gtea_culture_slider__pagination js-gtea_culture-pagination"></div>
                    </div>
                </div>
        </section>
        <?php
    }



}

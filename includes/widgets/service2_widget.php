<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Service2_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_service2_widget';
    }

    public function get_title()
    {
        return esc_html__('Service Widget (Variant 2)', 'glivera-addons');
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
        return ['gtea_service2-widget'];
    }

    public function get_script_depends() {
        return [ 'gtea_gsap', 'gtea_scrolltrigger', 'gtea_service2'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'service2_content',
            [
                'label' => __('Service Content', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'section_title',
            [
                'label' => __('Section Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'section_description',
            [
                'label' => __('Section Description', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Description', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'service2_link',
            [
                'label' => esc_html__( 'Button URL', 'glivera-addons' ),
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
        $this->add_control(
            'service2_link_text',
            [
                'label' => __('Button Text', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Description', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'reverse_mod',
            [
                'label' => esc_html__( 'Reverse Mod', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'ON', 'glivera-addons' ),
                'label_off' => esc_html__( 'OFF', 'glivera-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'glivera-addons' ),
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
            'service2_title', [
                'label' => esc_html__( 'Title', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Service Name',
            ]
        );
        $repeater->add_control(
            'service2_description', [
                'label' => esc_html__( 'Description', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );
        $repeater->add_control(
            'border_color',
            [
                'label' => esc_html__( 'Border Color', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .gtea_service2::after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $repeater->add_control(
            'item_mod',
            [
                'label' => esc_html__( 'Item Style', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    'gtea_service--mod_1' => esc_html__( 'Style 1', 'glivera-addons' ),
                    'gtea_service--mod_2' => esc_html__( 'Style 2', 'glivera-addons' ),
                    'gtea_service--mod_3'  => esc_html__( 'Style 3', 'glivera-addons' ),
                    'gtea_service--mod_4' => esc_html__( 'Style 4', 'glivera-addons' ),
                    'gtea_service--mod_5' => esc_html__( 'Style 5', 'glivera-addons' ),
                ],
            ]
        );
        $this->add_control(
            'service2_list',
            [
                'label' => esc_html__( 'Service List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Services Style', 'glivera-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'glivera-addons' ),
                'name' => 'service2_title_typography',
                'selector' => '{{WRAPPER}} .gtea_services2__title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'glivera-addons' ),
                'name' => 'service2_description_typography',
                'selector' => '{{WRAPPER}} .gtea_services2__text',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Item Title Typography', 'glivera-addons' ),
                'name' => 'service2_item_title_typography',
                'selector' => '{{WRAPPER}} .gtea_service2__title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Item Description Typography', 'glivera-addons' ),
                'name' => 'service2_item_description_typography',
                'selector' => '{{WRAPPER}} .gtea_service2__text',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'btn_style_section',
            [
                'label' => esc_html__( 'Button Style', 'glivera-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background',
                'label' => esc_html__( 'Button Background', 'glivera-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .gtea_services2__btn',
            ]
        );
        $this->end_controls_section();

    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $service = $this->get_settings_for_display();
        $list = $service['service2_list'];
        if ( ! empty( $service['service2_link']['url'] ) ) {
            $this->add_link_attributes( 'service2_link', $service['service2_link'] );
        }
        ?>
        <div class="gtea_services2__group <?php if ( 'yes' === $service['reverse_mod'] ) { echo 'gtea_services2__group--right_mod';} else { echo 'gtea_services2__group--left_mod';} ?>">
            <div class="gtea_services2__info">
                <h2 class="gtea_services2__title"><?php echo wp_kses_post($service['section_title']) ?></h2>
                <div class="gtea_services2__text"><?php echo wp_kses_post($service['section_description']) ?></div>
                <div class="gtea_services2__btn_w">
                    <a class="gtea_services2__btn" href="<?php echo esc_url($service['service2_link']['url']) ?>">
                        <?php echo wp_kses_post($service['service2_link_text']) ?>
                    </a>
                </div>
            </div>
            <ul class="gtea_services2__list js-translate-el" data-direction="<?php if ( 'yes' === $service['reverse_mod'] ) { echo 'right';} else { echo 'left';} ?>">
            <?php
            if (!empty($list)) {
                foreach ($list as $item) { ?>
                <li class="gtea_services2__item elementor-repeater-item-<?php echo $item['_id'] ?>">
                    <div class="gtea_service2 <?php echo esc_html($item['item_mod']) ?>">
                        <div class="gtea_service2__icon">
                            <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true', 'class' => 'gtea_service2__img' ] ); ?>
                        </div>
                        <h5 class="gtea_service2__title">
                            <?php echo wp_kses_post($item['service2_title']) ?>
                        </h5>
                        <div class="gtea_service2__text">
                            <?php echo wp_kses_post($item['service2_description']) ?>
                        </div>
                    </div>
                </li>
                        <?php }
                    }
                ?>
            </ul>
        </div>

        <?php

    }

    protected function content_template() {
        ?>
        <#
        var list = settings.service2_list;
        #>
        <div class="gtea_services2__group <# if ( 'yes' === settings.reverse_mod ) { #> gtea_services2__group--right_mod <# } else { #> gtea_services2__group--left_mod <# } #>">
            <div class="gtea_services2__info">
                <h2 class="gtea_services2__title">{{{settings.section_title}}}</h2>
                <div class="gtea_services2__text">{{{settings.section_description}}}</div>
                <div class="gtea_services2__btn_w">
                    <a class="gtea_services2__btn" href="#">
                        {{{settings.service2_link_text}}}
                    </a>
                </div>
            </div>
            <ul class="gtea_services2__list">
                <#
                _.each( list, function( item ) {
                const iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );
                #>
                <li class="gtea_services2__item">
                    <div class="gtea_service2 {{item.item_mod}}">
                        <div class="gtea_service2__icon">
                            {{{ iconHTML.value }}}
                        </div>
                        <h5 class="gtea_service2__title">
                            {{{item.service2_title}}}
                        </h5>
                        <div class="gtea_service2__text">
                            {{{item.service2_description}}}
                        </div>
                    </div>
                </li>
                <# } ); #>
            </ul>
        </div>
        <?php
    }

}

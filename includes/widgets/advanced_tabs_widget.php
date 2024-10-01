<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Advanced_Tabs_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_advanced_tabs_widget';
    }

    public function get_title()
    {
        return esc_html__('Advanced Tabs Widget', 'glivera-addons');
    }


    public function get_icon()
    {
        return 'eicon-tabs';
    }

    public function get_categories()
    {
        return ['glivera-addons'];
    }

    public function get_keywords()
    {
        return ['tab', 'svg'];
    }

    public function get_style_depends()
    {
        return ['gtea_advanced-tabs-widget'];
    }

    public function get_script_depends()
    {
        return ['gtea_advanced-tabs'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'aprio_addons_content',
            [
                'label' => __('Tabs', 'glivera-addons'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tab_title', [
                'label' => esc_html__('Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Title',
                'placeholder' => esc_html__('Type your title here', 'glivera-addons'),
            ]
        );

        $repeater->add_control(
            'tab_text', [
                'label' => esc_html__('Tab Description', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__('Type your description here', 'glivera-addons'),
            ]
        );
        $repeater->add_control(
            'tab_svg', [
                'label' => esc_html__('SVG Code', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::CODE,
                'language' => 'html',
                'rows' => 50,
            ]
        );


        $this->add_control(
            'aprio_addons_list',
            [
                'label' => __( 'Tabs Items', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Tabs Style', 'glivera-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Tab Title Color', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gtea_advanced_tabs__button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Tab Title Typography', 'glivera-addons'),
                'selector' => '{{WRAPPER}} .gtea_advanced_tabs__button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_background',
                'label' => esc_html__('Tab Title Background', 'glivera-addons'),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .gtea_advanced_tabs__button',
            ]
        );


        $this->add_control(
            'active_options',
            [
                'label' => esc_html__( 'Active Tab Styles', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color_active',
            [
                'label' => esc_html__( 'Active Tab Title Color', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gtea_advanced_tabs__button.active' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography_active',
                'label' => esc_html__('Active Tab Title Typography', 'glivera-addons'),
                'selector' => '{{WRAPPER}} .gtea_advanced_tabs__button.active',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_background_active',
                'label' => esc_html__('Active Tab Title Background', 'glivera-addons'),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .gtea_advanced_tabs__button.active',
            ]
        );

        $this->add_control(
            'hover_options',
            [
                'label' => esc_html__( 'Hover Tab Styles', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_background_hover',
                'label' => esc_html__('Hover Tab Title Background', 'glivera-addons'),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .gtea_advanced_tabs__button:hover',
            ]
        );

        $this->add_control(
            'content_size_options',
            [
                'label' => esc_html__( 'Content Columns Styles', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'content_width',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__( 'Content Column Width', 'glivera-addons' ),
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .gtea_advanced_tabs__panel_content' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'svg_width',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__( 'HTML Column Width', 'glivera-addons' ),
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .gtea_advanced_tabs__panel_svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Content Column Padding', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .gtea_advanced_tabs__panel_content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'svg_padding',
            [
                'label' => esc_html__( 'HTML Column Padding', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .gtea_advanced_tabs__panel_svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $aprio_addons = $this->get_settings_for_display();
        $list = $aprio_addons['aprio_addons_list'];

        ?>

        <section class="aprio_tabs">
            <!-- Tab Buttons -->
            <div class="gtea_advanced_tabs__buttons">
                <?php
                if ( $list ) {
                    foreach (  $list as $index => $item ) { ?>
                        <button class="gtea_advanced_tabs__button <?php echo $index == 0 ? 'active' : '' ?>" data-tab="gtea_tab<?php echo $index ?>"><?php echo esc_html($item['tab_title'] ) ?></button>
                    <?php }
                }
                ?>
            </div>

            <!-- Tab Content -->
            <div class="gtea_advanced_tabs__content">
                <?php
                if ( $list ) {
                    foreach (  $list as $index => $item ) { ?>
                        <button class="gtea_advanced_tabs__button gtea_advanced_tabs__button--mobile_mod <?php echo $index == 0 ? 'active' : '' ?>" data-tab="gtea_tab<?php echo $index ?>"><?php echo esc_html($item['tab_title'] ) ?></button>
                        <div id="gtea_tab<?php echo $index ?>" class="gtea_advanced_tabs__panel <?php echo $index == 0 ? 'active' : '' ?>">
                            <div class="gtea_advanced_tabs__panel_wrapper">
                                <div class="gtea_advanced_tabs__panel_content">
                                    <?php echo wp_kses_post($item['tab_text']) ?>
                                </div>
                                <div class="gtea_advanced_tabs__panel_svg">
                                    <?php echo $item['tab_svg'] ?>
                                </div>
                            </div>

                        </div>
                    <?php }
                }
                ?>
            </div>
        </section>


        <?php

    }

    protected function content_template()
    {
        ?>

        <section class="aprio_tabs">
            <!-- Tab Buttons -->
            <div class="gtea_advanced_tabs__buttons">
                <# if ( settings.aprio_addons_list.length ) { #>
                <# _.each( settings.aprio_addons_list, function( item, index ) { #>
                <button class="gtea_advanced_tabs__button <# if ( index === 0 ) { #>active<# } #>" data-tab="gtea_{{ index }}">{{{item.tab_title}}}</button>
                <# }); #>
                <# } #>
            </div>

            <!-- Tab Content -->
            <div class="gtea_advanced_tabs__content">
                <# if ( settings.aprio_addons_list.length ) { #>
                <# _.each( settings.aprio_addons_list, function( item, index ) { #>
                <div id="gtea_{{ index }}" class="elementor-repeater-item-{{ item._id }} gtea_advanced_tabs__panel <# if ( index === 0 ) { #>active<# } #>">
                    <div class="gtea_advanced_tabs__panel_wrapper">
                        <div class="gtea_advanced_tabs__panel_content">
                            {{{item.tab_text}}}
                        </div>
                        <div class="gtea_advanced_tabs__panel_svg">
                            {{{item.tab_svg}}}
                        </div>
                    </div>

                </div>
                <# }); #>
                <# } #>
            </div>
        </section>
        <?php
    }


}

<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Steps_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_steps_widget';
    }

    public function get_title()
    {
        return esc_html__('Steps Widget', 'glivera-addons');
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
        return ['steps', 'url', 'link'];
    }

    public function get_style_depends()
    {
        return ['gtea_steps-widget'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'steps_content',
            [
                'label' => __('Steps Content', 'glivera-addons'),
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'step_title',
            [
                'label' => __('Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $repeater->add_control(
            'step_number',
            [
                'label' => __('Number', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $repeater->add_control(
            'step_description',
            [
                'label' => esc_html__( 'Description', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Default description', 'glivera-addons' ),
                'placeholder' => esc_html__( 'Type your description here', 'glivera-addons' ),
            ]
        );
        $repeater->add_control(
            'step_link',
            [
                'label' => esc_html__( 'Step Button URL', 'glivera-addons' ),
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
            'step_link_text',
            [
                'label' => __('Step Button Text', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Learn More', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'steps_list',
            [
                'label' => esc_html__( 'Steps List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );


        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Step Style', 'glivera-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'glivera-addons' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .head_item__title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Number Typography', 'glivera-addons' ),
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .head_item__number',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'glivera-addons' ),
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .item_about__text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Link Typography', 'glivera-addons' ),
                'name' => 'link_typography',
                'selector' => '{{WRAPPER}} .item_about__link',
            ]
        );
        $this->add_control(
            'link_hover_color',
            [
                'label' => esc_html__( 'Link Hover', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gtea_item_about__link:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $step = $this->get_settings_for_display();
        $list = $step['steps_list'];

        ?>
            <section class="gtea_section gtea_about_section">
                <div class="gtea_section__in gtea_about_section__in">
                    <ol class="gtea_about_section__body">
                    <?php
                    if (!empty($list)) {
                        foreach ($list as $item) {
                            ?>
                            <li class="gtea_about_section__item gtea_item_about">
                                <div class="gtea_item_about__wrapper">
                                    <div class="gtea_item_about__head gtea_head_item">
                                        <h3 class="gtea_head_item__title"><?php echo esc_html($item['step_title']) ?></h3>
                                        <div class="gtea_head_item__number"><?php echo esc_html($item['step_number']) ?></div>
                                    </div>
                                    <div class="gtea_item_about__text"><?php echo wp_kses_post($item['step_description']) ?></div>
                                    <?php if ( ! empty( $item['step_link']['url'] ) ) { ?>
                                        <div class="gtea_item_about__footer">
                                            <a class="gtea_item_about__link gtea_item_about__link--active" href="<?php echo esc_attr($item['step_link']['url']) ?>">
                                                <?php echo esc_html($item['step_link_text']) ?>
                                            </a>
                                        </div>
                                    <?php } ?>

                                </div>
                            </li>
                        <?php }
                    }
                    ?>
                    </ol>
                </div>
            </section>

        <?php

    }

    protected function content_template()
    {
        ?>

        <section class="gtea_section gtea_about_section">
            <div class="gtea_section__in gtea_about_section__in">
                <ol class="gtea_about_section__body">
                    <#
                    _.each(  settings.steps_list, function( item ) {
                    #>
                        <li class="gtea_about_section__item gtea_item_about">
                            <div class="gtea_item_about__wrapper">
                                <div class="gtea_item_about__head gtea_head_item">
                                    <h3 class="gtea_head_item__title">{{item.step_title}}</h3>
                                    <div class="gtea_head_item__number">{{item.step_number}}</div>
                                </div>
                                <div class="gtea_item_about__text">{{{item.step_description}}}</div>

                                <div class="gtea_item_about__footer">
                                    <a class="gtea_item_about__link gtea_item_about__link--active"
                                       href="#">
                                        {{item.step_link_text}} </a>
                                </div>

                            </div>
                        </li>
                    <# } ); #>
                </ol>
            </div>
        </section>
        <?php
    }


}

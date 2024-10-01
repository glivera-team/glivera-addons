<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Our_Journey_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_our_journey_widget';
    }

    public function get_title()
    {
        return esc_html__('Our Journey Widget', 'glivera-addons');
    }


    public function get_icon()
    {
        return 'eicon-columns';
    }

    public function get_categories()
    {
        return ['glivera-addons'];
    }

    public function get_keywords()
    {
        return ['timeline', 'url', 'link'];
    }

    public function get_style_depends()
    {
        return ['gtea_our-journey-widget'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'journey_content',
            [
                'label' => __('Journey Content', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'section_title',
            [
                'label' => __('Section Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
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

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title', [
                'label' => __('Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $repeater->add_control(
            'description', [
                'label' => __('Description', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Description', 'glivera-addons'),
            ]
        );
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

        $this->add_control(
            'journey_list',
            [
                'label' => esc_html__( 'Journey List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );


        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Journey Style', 'glivera-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Section Title Typography', 'glivera-addons' ),
                'name' => 'section_title_typography',
                'selector' => '{{WRAPPER}} .gtea_chronology__title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Section Description Typography', 'glivera-addons' ),
                'name' => 'section_description_typography',
                'selector' => '{{WRAPPER}} .gtea_chronology__subtitle',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Item Title Typography', 'glivera-addons' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .gtea_chronology__card_title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Item Description Typography', 'glivera-addons' ),
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .item_about__link',
            ]
        );
        $this->add_control(
            'accent_color',
            [
                'label' => esc_html__( 'Item Accent Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gtea_chronology__card_icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .gtea_chronology__card.gtea_chronology__card--accent_mod' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .gtea_chronology__card:not(.gtea_chronology__card--accent_mod)' => 'box-shadow: 0 0 0 1px {{VALUE}} inset'
                ],
            ]
        );



        $this->end_controls_section();

    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $journey = $this->get_settings_for_display();
        $list = $journey['journey_list'];

        ?>
        <section class="gtea_chronology section">
            <div class="gtea_chronology__container">
                <div class="gtea_chronology__header">
                    <h3 class="gtea_chronology__title"><?php echo esc_html($journey['section_title'] ) ?></h3>
                    <div class="gtea_chronology__subtitle"><?php echo wp_kses_post($journey['section_description'] ) ?></div>
                </div>
                <ul class="gtea_chronology__list">
                <?php
                if (!empty($list)) {
                    $numItems = count($list);
                    foreach ($list as $index=>$item) { ?>
                    <li class="gtea_chronology__item elementor-repeater-item-<?php echo $item['_id'] ?>">
                        <div class="gtea_chronology__card <?php echo $index+1 == $numItems ? 'gtea_chronology__card--accent_mod' : '' ?>">
                            <h4 class="gtea_chronology__card_title"><?php echo esc_html($item['title'] ) ?></h4>
                            <div class="gtea_chronology__card_text"><?php echo wp_kses_post($item['description'] ) ?></div>
                            <div class="gtea_chronology__card_icon">
                                <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </div>
                        </div>
                    </li>
                    <?php }
                }
                ?>
                </ul>
            </div>
        </section>

        <?php

    }

    protected function content_template()
    {
        ?>
        <#
        var list = settings.journey_list;

        #>
        <section class="gtea_chronology section">
            <div class="gtea_chronology__container">
                <div class="gtea_chronology__header">
                    <h3 class="gtea_chronology__title">{{{ settings.section_title }}}</h3>
                    <div class="gtea_chronology__subtitle">{{{ settings.section_description }}}</div>
                </div>
                <ul class="gtea_chronology__list">
                    <#
                    _.each( settings.journey_list, function( item ) {
                        const iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );
                    #>
                        <li class="gtea_chronology__item">
                            <div class="gtea_chronology__card">
                                <h4 class="gtea_chronology__card_title">{{{ item.title }}}</h4>
                                <div class="gtea_chronology__card_text">{{{ item.description }}}</div>
                                <div class="gtea_chronology__card_icon">
                                    {{{ iconHTML.value }}}
                                </div>
                            </div>
                        </li>
                    <# } ); #>
                </ul>
            </div>
        </section>
        <?php
    }


}

<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_History_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_history_widget';
    }

    public function get_title()
    {
        return esc_html__('History Widget', 'glivera-addons');
    }


    public function get_icon()
    {
        return 'eicon-time-line';
    }

    public function get_categories()
    {
        return ['glivera-addons'];
    }

    public function get_keywords()
    {
        return ['timeline', 'history'];
    }

    public function get_style_depends()
    {
        return ['gtea_history-widget'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'history_head_content',
            [
                'label' => __('Title', 'glivera-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'section_title',
            [
                'label' => __('Section Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Timeline Widget', 'glivera-addons'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'history_first_content',
            [
                'label' => __('First Column', 'glivera-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'first_title',
            [
                'label' => __('Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'icon_first_main',
            [
                'label' => esc_html__( 'Icon', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeaterFirst = new \Elementor\Repeater();
        $repeaterFirst->add_control(
            'first_text',
            [
                'label' => __('Description', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Description', 'glivera-addons'),
            ]
        );

        $this->add_control(
            'history_first_list',
            [
                'label' => esc_html__( 'First List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeaterFirst->get_controls(),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'history_second_content',
            [
                'label' => __('Second Column', 'glivera-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'second_title',
            [
                'label' => __('Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'icon_second_main',
            [
                'label' => esc_html__( 'Icon', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeaterSecond = new \Elementor\Repeater();
        $repeaterSecond->add_control(
            'second_text',
            [
                'label' => __('Description', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Description', 'glivera-addons'),
            ]
        );

        $this->add_control(
            'history_second_list',
            [
                'label' => esc_html__( 'First List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeaterSecond->get_controls(),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'history_third_content',
            [
                'label' => __('Third Column', 'glivera-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'third_title',
            [
                'label' => __('Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'icon_third_main',
            [
                'label' => esc_html__( 'Icon', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeaterThird = new \Elementor\Repeater();
        $repeaterThird->add_control(
            'third_text',
            [
                'label' => __('Description', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Description', 'glivera-addons'),
            ]
        );

        $this->add_control(
            'history_third_list',
            [
                'label' => esc_html__( 'Third List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeaterThird->get_controls(),
            ]
        );
        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Widget Style', 'glivera-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Section Title Typography', 'glivera-addons' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .gtea_history__title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'glivera-addons' ),
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .gtea_history__col_title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'List Typography', 'glivera-addons' ),
                'name' => 'list_typography',
                'selector' => '{{WRAPPER}} .gtea_history__col_item_in',
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Circle Color', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gtea_history__col_icon:after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .gtea_history__col_item_circle' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .gtea_history__col_list_decor' => 'background-image: linear-gradient(0deg, {{VALUE}}, {{VALUE}} 50%, transparent 50%, transparent 100%);',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'svg_background',
                'label' => esc_html__( 'Timeline Background', 'glivera-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .gtea_pricing_card__button_in',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Timeline Background', 'glivera-addons'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->end_controls_section();

    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $history = $this->get_settings_for_display();
        $first_list = $history['history_first_list'];
        $second_list = $history['history_second_list'];
        $third_list = $history['history_third_list'];

        ?>
        <section class="gtea_history">
            <div class="gtea_history__container">
                <h2 class="gtea_history__title"><?php echo esc_html($history['section_title']) ?></h2>
                <div class="gtea_history__main">
                    <div class="gtea_history__chart_wrap">
                        <div class="gtea_history__chart">
                            <div class="gtea_history__chart_in">
                                <svg class="gtea_history__chart_img" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 796"><defs><linearGradient id="a" x1="938.82" y1="533.6" x2="965.15" y2="0" gradientTransform="matrix(1 0 0 -1 0 798)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="<?php echo $history['svg_background_color'] ?>"/><stop offset="1" stop-color="<?php echo $history['svg_background_color_b'] ?>" stop-opacity="0"/></linearGradient></defs><path d="M157.5 351.1H0L-1 796h1920l1-774-152 74.98-152 25.81-112 27.96-113 9.53-76 11.98-148 10.76-206.5 14.75L830 217.44l-113 33.49-112.5 13.21-75.5 17.51-149 5.22-76 45.48-146.5 18.74Z" style="fill:url(#a)"/><path d="M0 330.1h157.5L304 311.36l76-45.48 149-5.22 75.5-17.51L717 229.94l113-33.49 130.5-19.67 206.5-14.75 148-10.76 76-11.98 113-9.53 112-27.96 152-25.81L1920 1" style="fill:none;stroke:#d1d1d2;stroke-width:2px"/></svg>
                            </div>
                        </div>
                    </div>
                    <ul class="gtea_history__cols">
                        <li class="gtea_history__col">
                            <div class="gtea_history__col_title"><?php echo esc_html($history['first_title']) ?></div>
                            <div class="gtea_history__col_icon">
                                <?php \Elementor\Icons_Manager::render_icon( $history['icon_first_main'], [ 'aria-hidden' => 'true'] ); ?>
                            </div>
                            <div class="gtea_history__col_list">
                                <div class="gtea_history__col_list_decor"></div>
                                <ul class="gtea_history__col_list_in">
                                <?php
                                if (!empty($first_list)) {
                                    foreach ($first_list as $item) { ?>
                                        <li class="gtea_history__col_item">
                                            <div class="gtea_history__col_item_circle"></div>
                                            <div class="gtea_history__col_item_in">
                                                <?php echo esc_html($item['first_text']) ?>
                                            </div>
                                        </li>
                                    <?php }
                                    }
                                ?>
                                </ul>
                            </div>
                        </li>
                        <li class="gtea_history__col">
                            <div class="gtea_history__col_title"><?php echo esc_html($history['second_title']) ?></div>
                            <div class="gtea_history__col_icon">
                                <?php \Elementor\Icons_Manager::render_icon( $history['icon_second_main'], [ 'aria-hidden' => 'true'] ); ?>
                            </div>
                            <div class="gtea_history__col_list">
                                <div class="gtea_history__col_list_decor"></div>
                                <ul class="gtea_history__col_list_in">
                                    <?php
                                    if (!empty($second_list)) {
                                        foreach ($second_list as $item) { ?>
                                            <li class="gtea_history__col_item">
                                                <div class="gtea_history__col_item_circle"></div>
                                                <div class="gtea_history__col_item_in">
                                                    <?php echo esc_html($item['second_text']) ?>
                                                </div>
                                            </li>
                                        <?php }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
                        <li class="gtea_history__col">
                            <div class="gtea_history__col_title"><?php echo esc_html($history['third_title']) ?></div>
                            <div class="gtea_history__col_icon">
                                <?php \Elementor\Icons_Manager::render_icon( $history['icon_third_main'], [ 'aria-hidden' => 'true'] ); ?>
                            </div>
                            <div class="gtea_history__col_list">
                                <div class="gtea_history__col_list_decor"></div>
                                <ul class="gtea_history__col_list_in">
                                    <?php
                                    if (!empty($third_list)) {
                                        foreach ($third_list as $item) { ?>
                                            <li class="gtea_history__col_item">
                                                <div class="gtea_history__col_item_circle"></div>
                                                <div class="gtea_history__col_item_in">
                                                    <?php echo esc_html($item['third_text']) ?>
                                                </div>
                                            </li>
                                        <?php }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <?php

    }

    protected function content_template() {
        ?>
        <#
        var history = settings;
        var first_list = settings.history_first_list;
        var second_list = settings.history_second_list;
        var third_list = settings.history_third_list;

        #>
        <section class="gtea_history">
            <div class="gtea_history__container">
                <h2 class="gtea_history__title">{{{history.section_title}}}</h2>
                <div class="gtea_history__main">
                    <div class="gtea_history__chart_wrap">
                        <div class="gtea_history__chart">
                            <div class="gtea_history__chart_in">
                                <svg class="gtea_history__chart_img" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 796"><defs><linearGradient id="a" x1="938.82" y1="533.6" x2="965.15" y2="349.49" gradientTransform="matrix(1 0 0 -1 0 798)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#f9f9fa"/><stop offset="1" stop-color="#fff" stop-opacity="0"/></linearGradient></defs><path d="M157.5 351.1H0L-1 796h1920l1-774-152 74.98-152 25.81-112 27.96-113 9.53-76 11.98-148 10.76-206.5 14.75L830 217.44l-113 33.49-112.5 13.21-75.5 17.51-149 5.22-76 45.48-146.5 18.74Z" style="fill:url(#a)"/><path d="M0 330.1h157.5L304 311.36l76-45.48 149-5.22 75.5-17.51L717 229.94l113-33.49 130.5-19.67 206.5-14.75 148-10.76 76-11.98 113-9.53 112-27.96 152-25.81L1920 1" style="fill:none;stroke:#d1d1d2;stroke-width:2px"/></svg>
                            </div>
                        </div>
                    </div>
                    <ul class="gtea_history__cols">
                        <li class="gtea_history__col">
                            <div class="gtea_history__col_title">{{{history.first_title}}}</div>
                            <div class="gtea_history__col_icon">
                                <# const firstIconHTML = elementor.helpers.renderIcon( view, history.icon_first_main, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                {{{ firstIconHTML.value }}}
                            </div>
                            <div class="gtea_history__col_list">
                                <div class="gtea_history__col_list_decor"></div>
                                <ul class="gtea_history__col_list_in">
                                    <#
                                        _.each( first_list, function( item ) {
                                    #>
                                        <li class="gtea_history__col_item">
                                            <div class="gtea_history__col_item_circle"></div>
                                            <div class="gtea_history__col_item_in">
                                                {{{item.first_text}}}
                                            </div>
                                        </li>
                                    <# } ); #>
                                </ul>
                            </div>
                        </li>
                        <li class="gtea_history__col">
                            <div class="gtea_history__col_title">{{{history.second_title}}}</div>
                            <div class="gtea_history__col_icon">
                                <# const secondIconHTML = elementor.helpers.renderIcon( view, history.icon_second_main, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                {{{ secondIconHTML.value }}}
                            </div>
                            <div class="gtea_history__col_list">
                                <div class="gtea_history__col_list_decor"></div>
                                <ul class="gtea_history__col_list_in">
                                    <#
                                    _.each( second_list, function( item ) {
                                    #>
                                        <li class="gtea_history__col_item">
                                            <div class="gtea_history__col_item_circle"></div>
                                            <div class="gtea_history__col_item_in">
                                                {{{item.second_text}}}
                                            </div>
                                        </li>
                                    <# } ); #>
                                </ul>
                            </div>
                        </li>
                        <li class="gtea_history__col">
                            <div class="gtea_history__col_title">{{{history.third_title}}}</div>
                            <div class="gtea_history__col_icon">
                                <# const thirdIconHTML = elementor.helpers.renderIcon( view, history.icon_third_main, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                {{{ thirdIconHTML.value }}}
                            </div>
                            <div class="gtea_history__col_list">
                                <div class="gtea_history__col_list_decor"></div>
                                <ul class="gtea_history__col_list_in">
                                    <#
                                    _.each( third_list, function( item ) {
                                    #>
                                        <li class="gtea_history__col_item">
                                            <div class="gtea_history__col_item_circle"></div>
                                            <div class="gtea_history__col_item_in">
                                                {{{item.third_text}}}
                                            </div>
                                        </li>
                                    <# } ); #>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <?php
    }


}

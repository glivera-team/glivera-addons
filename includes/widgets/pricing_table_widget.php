<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Pricing_Table_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_pricing_table_widget';
    }

    public function get_title()
    {
        return esc_html__('Pricing Table Widget', 'glivera-addons');
    }


    public function get_icon()
    {
        return 'eicon-table-of-contents';
    }

    public function get_categories()
    {
        return ['glivera-addons'];
    }

    public function get_keywords()
    {
        return ['pricing', 'table', 'price'];
    }

    public function get_style_depends()
    {
        return ['gtea_pricing-table-widget'];
    }

    public function get_script_depends() {
        return ['gtea_pricing-table'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'pricing_head_content',
            [
                'label' => __('Tabs Name', 'glivera-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'first_tab',
            [
                'label' => __('First Tab Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Month', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'second_tab',
            [
                'label' => __('Second Tab Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Year', 'glivera-addons'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'pricing_first_content',
            [
                'label' => __('First Item', 'glivera-addons'),
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
        $this->add_control(
            'first_month_price',
            [
                'label' => __('Month Price', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Month Price', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'first_year_price',
            [
                'label' => __('Year Price', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Year Price', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'button_first_link',
            [
                'label' => esc_html__( 'Button Link', 'textdomain' ),
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
            'button_first_text',
            [
                'label' => __('Button Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $repeaterFirst = new \Elementor\Repeater();
        $repeaterFirst->add_control(
            'feature_first_text',
            [
                'label' => __('Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $repeaterFirst->add_control(
            'icon_first',
            [
                'label' => esc_html__( 'Icon', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'features_first_list',
            [
                'label' => esc_html__( 'Features List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeaterFirst->get_controls(),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'pricing_second_content',
            [
                'label' => __('Second Item', 'glivera-addons'),
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
        $this->add_control(
            'second_month_price',
            [
                'label' => __('Month Price', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Month Price', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'second_year_price',
            [
                'label' => __('Year Price', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Year Price', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'button_second_link',
            [
                'label' => esc_html__( 'Button Link', 'textdomain' ),
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
            'button_second_text',
            [
                'label' => __('Button Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $repeaterSecond = new \Elementor\Repeater();
        $repeaterSecond->add_control(
            'feature_second_text',
            [
                'label' => __('Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );

        $repeaterSecond->add_control(
            'icon_second',
            [
                'label' => esc_html__( 'Icon', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'features_second_list',
            [
                'label' => esc_html__( 'Features List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeaterSecond->get_controls(),
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'pricing_third_content',
            [
                'label' => __('Third Item', 'glivera-addons'),
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
        $this->add_control(
            'third_month_price',
            [
                'label' => __('Month Price', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Month Price', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'third_year_price',
            [
                'label' => __('Year Price', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Year Price', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'button_third_link',
            [
                'label' => esc_html__( 'Button Link', 'textdomain' ),
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
            'button_third_text',
            [
                'label' => __('Button Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $repeaterThird = new \Elementor\Repeater();
        $repeaterThird->add_control(
            'feature_third_text',
            [
                'label' => __('Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );

        $repeaterThird->add_control(
            'icon_third',
            [
                'label' => esc_html__( 'Icon', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'features_third_list',
            [
                'label' => esc_html__( 'Features List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeaterThird->get_controls(),
            ]
        );
        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Table Style', 'glivera-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'glivera-addons' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .gtea_pricing_card__title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'glivera-addons' ),
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .gtea_pricing_card__price',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'List Typography', 'glivera-addons' ),
                'name' => 'list_typography',
                'selector' => '{{WRAPPER}} .gtea_pricing_card__text',
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gtea_pricing_card__icon' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background',
                'label' => esc_html__( 'Button Background', 'glivera-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .gtea_pricing_card__button_in',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Button Background', 'glivera-addons'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_hover',
                'label' => esc_html__( 'Button Background Hover', 'glivera-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .gtea_pricing_card__button_in:hover',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Button Background Hover', 'glivera-addons'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function get_upsale_data() {
        return [
            'condition' => ! \Elementor\Utils::has_pro() || \Elementor\Utils::has_pro(),
            'image' => plugins_url('images/logo.svg', __FILE__),
            'image_alt' => esc_attr__( 'Glivera Team', 'glivera-addons' ),
            'title' => esc_html__( 'Promotion heading', 'glivera-addons' ),
            'description' => wp_kses_post( 'Get the premium version of the widget and grow your website capabilities. Get the premium version of the widget and grow your website capabilities.', 'glivera-addons' ),
            'upgrade_url' => esc_url( 'https://glivera-team.com/' ),
            'upgrade_text' => esc_html__( 'Learn More', 'glivera-addons' ),
        ];
    }
    // Render the widget content on the frontend.
    protected function render()
    {
        $table = $this->get_settings_for_display();
        $first_list = $table['features_first_list'];
        $second_list = $table['features_second_list'];
        $third_list = $table['features_third_list'];

        ?>
        <div class="js-gtea-pricing">
            <div class="gtea_pricing__period">
                <div class="gtea_pricing__period_in">
                    <label class="gtea_pricing__label">
                        <input class="gtea_pricing__input js-gtea-pricing-input" type="checkbox" role="switch"/>
                        <span class="gtea_pricing__switcher"></span>
                        <span class="gtea_pricing__plan gtea_pricing__plan--month_mod"><?php echo esc_html($table['first_tab']) ?></span>
                        <span class="gtea_pricing__plan gtea_pricing__plan--year_mod"><?php echo esc_html($table['second_tab']) ?></span>
                    </label>
                </div>
            </div>
            <div class="gtea_pricing__body">
                <ul class="gtea_pricing__list js-center-scroll">
                    <li class="gtea_pricing__item">
                        <div class="gtea_pricing_card">
                            <div class="gtea_pricing_card__body">
                                <div class="gtea_pricing_card__wrap">
                                    <?php \Elementor\Icons_Manager::render_icon( $table['icon_first_main'], [ 'aria-hidden' => 'true', 'class' => 'gtea_pricing_card__img'] ); ?>
                                </div>
                                <h3 class="gtea_pricing_card__title"><?php echo $table['first_title'] ?></h3>
                                <div class="gtea_pricing_card__price_wrap">
                                    <div
                                            class="gtea_pricing_card__price js-gtea-pricing-container"
                                            data-monthly="<?php echo wp_kses_post($table['first_month_price']) ?>"
                                            data-yearly="<?php echo wp_kses_post($table['first_year_price']) ?>"
                                    >
                                        <?php echo wp_kses_post($table['first_month_price']) ?>
                                    </div>
                                </div>
                                <ul class="gtea_pricing_card__list">
                                    <?php
                                        if (!empty($first_list)) {
                                            foreach ($first_list as $item) {
                                    ?>
                                        <li class="gtea_pricing_card__item">
                                            <div class="gtea_pricing_card__icon">
                                                <?php \Elementor\Icons_Manager::render_icon( $item['icon_first'], [ 'aria-hidden' => 'true'] ); ?>
                                            </div>
                                            <div class="gtea_pricing_card__text">
                                                <?php echo esc_html($item['feature_first_text']) ?>
                                            </div>
                                        </li>
                                            <?php }
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="gtea_pricing_card__button">
                                <a class="gtea_pricing_card__button_in" href="<?php echo esc_url($table['button_first_link']['url']) ?>"><?php echo esc_html($table['button_first_text']) ?></a>
                            </div>
                        </div>
                    </li>
                    <li class="gtea_pricing__item">
                        <div class="gtea_pricing_card">
                            <div class="gtea_pricing_card__body">
                                <div class="gtea_pricing_card__wrap">
                                    <?php \Elementor\Icons_Manager::render_icon( $table['icon_second_main'], [ 'aria-hidden' => 'true', 'class' => 'gtea_pricing_card__img'] ); ?>
                                </div>
                                <h3 class="gtea_pricing_card__title"><?php echo $table['second_title'] ?></h3>
                                <div class="gtea_pricing_card__price_wrap">
                                    <div
                                            class="gtea_pricing_card__price js-gtea-pricing-container"
                                            data-monthly="<?php echo wp_kses_post($table['second_month_price']) ?>"
                                            data-yearly="<?php echo wp_kses_post($table['second_year_price']) ?>"
                                    >
                                        <?php echo wp_kses_post($table['second_month_price']) ?>
                                    </div>
                                </div>
                                <ul class="gtea_pricing_card__list">
                                    <?php
                                    if (!empty($second_list)) {
                                        foreach ($second_list as $item) {
                                            ?>
                                            <li class="gtea_pricing_card__item">
                                                <div class="gtea_pricing_card__icon">
                                                    <?php \Elementor\Icons_Manager::render_icon( $item['icon_second'], [ 'aria-hidden' => 'true'] ); ?>
                                                </div>
                                                <div class="gtea_pricing_card__text">
                                                    <?php echo esc_html($item['feature_second_text']) ?>
                                                </div>
                                            </li>
                                        <?php }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="gtea_pricing_card__button">
                                <a class="gtea_pricing_card__button_in" href="<?php echo esc_url($table['button_second_link']['url']) ?>"><?php echo esc_html($table['button_second_text']) ?></a>
                            </div>
                        </div>
                    </li>
                    <li class="gtea_pricing__item">
                        <div class="gtea_pricing_card">
                            <div class="gtea_pricing_card__body">
                                <div class="gtea_pricing_card__wrap">
                                    <?php \Elementor\Icons_Manager::render_icon( $table['icon_third_main'], [ 'aria-hidden' => 'true', 'class' => 'gtea_pricing_card__img'] ); ?>
                                </div>
                                <h3 class="gtea_pricing_card__title"><?php echo $table['third_title'] ?></h3>
                                <div class="gtea_pricing_card__price_wrap">
                                    <div
                                            class="gtea_pricing_card__price js-gtea-pricing-container"
                                            data-monthly="<?php echo wp_kses_post($table['third_month_price']) ?>"
                                            data-yearly="<?php echo wp_kses_post($table['third_year_price']) ?>"
                                    >
                                        <?php echo wp_kses_post($table['third_month_price']) ?>
                                    </div>
                                </div>
                                <ul class="gtea_pricing_card__list">
                                    <?php
                                    if (!empty($third_list)) {
                                        foreach ($third_list as $item) {
                                            ?>
                                            <li class="gtea_pricing_card__item">
                                                <div class="gtea_pricing_card__icon">
                                                    <?php \Elementor\Icons_Manager::render_icon( $item['icon_third'], [ 'aria-hidden' => 'true'] ); ?>
                                                </div>
                                                <div class="gtea_pricing_card__text">
                                                    <?php echo esc_html($item['feature_third_text']) ?>
                                                </div>
                                            </li>
                                        <?php }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="gtea_pricing_card__button">
                                <a class="gtea_pricing_card__button_in" href="<?php echo esc_url($table['button_third_link']['url']) ?>"><?php echo esc_html($table['button_third_text']) ?></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <?php

    }

    protected function content_template() {
        ?>
        <#
        var table = settings;
        var first_list = settings.features_first_list;
        var second_list = settings.features_second_list;
        var third_list = settings.features_third_list;

        #>
        <div class="js-gtea-pricing">
            <div class="gtea_pricing__period">
                <div class="gtea_pricing__period_in">
                    <label class="gtea_pricing__label">
                        <input class="gtea_pricing__input js-gtea-pricing-input" type="checkbox" role="switch"/>
                        <span class="gtea_pricing__switcher"></span>
                        <span class="gtea_pricing__plan gtea_pricing__plan--month_mod">{{{table.first_tab}}}</span>
                        <span class="gtea_pricing__plan gtea_pricing__plan--year_mod">{{{table.second_tab}}}</span>
                    </label>
                </div>
            </div>
            <div class="gtea_pricing__body">
                <ul class="gtea_pricing__list js-center-scroll">
                    <li class="gtea_pricing__item">
                        <div class="gtea_pricing_card">
                            <div class="gtea_pricing_card__body">
                                <div class="gtea_pricing_card__wrap">
                                    <# const mainIconFirstHTML = elementor.helpers.renderIcon( view, settings.icon_first_main, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                    {{{ mainIconFirstHTML.value }}}
                                </div>
                                <h3 class="gtea_pricing_card__title">{{{ table.first_title }}}</h3>
                                <div class="gtea_pricing_card__price_wrap">
                                    <div
                                            class="gtea_pricing_card__price js-gtea-pricing-container"
                                            data-monthly="{{table.first_month_price}}"
                                            data-yearly="{{table.first_year_price}}"
                                    >
                                        {{{ table.first_month_price }}}
                                    </div>
                                </div>
                                <ul class="gtea_pricing_card__list">
                                    <#
                                    _.each( first_list, function( item ) {
                                    #>
                                        <li class="gtea_pricing_card__item">
                                            <div class="gtea_pricing_card__icon">
                                                <# const firstIconHTML = elementor.helpers.renderIcon( view, item.icon_first, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                                {{{ firstIconHTML.value }}}
                                            </div>
                                            <div class="gtea_pricing_card__text">
                                                {{{ item.feature_first_text }}}
                                            </div>
                                        </li>
                                    <# } ); #>
                                </ul>
                            </div>
                            <div class="gtea_pricing_card__button">
                                <a class="gtea_pricing_card__button_in" href="#">{{{ table.button_first_text}}}</a>
                            </div>
                        </div>
                    </li>
                    <li class="gtea_pricing__item">
                        <div class="gtea_pricing_card">
                            <div class="gtea_pricing_card__body">
                                <div class="gtea_pricing_card__wrap">
                                    <# const mainIconSecondHTML = elementor.helpers.renderIcon( view, settings.icon_second_main, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                    {{{ mainIconSecondHTML.value }}}
                                </div>
                                <h3 class="gtea_pricing_card__title">{{{ table.second_title }}}</h3>
                                <div class="gtea_pricing_card__price_wrap">
                                    <div
                                            class="gtea_pricing_card__price js-gtea-pricing-container"
                                            data-monthly="{{table.second_month_price}}"
                                            data-yearly="{{table.second_year_price}}"
                                    >
                                        {{{ table.second_month_price }}}
                                    </div>
                                </div>
                                <ul class="gtea_pricing_card__list">
                                    <#
                                    _.each( second_list, function( item ) {
                                    #>
                                    <li class="gtea_pricing_card__item">
                                        <div class="gtea_pricing_card__icon">
                                            <# const secondIconHTML = elementor.helpers.renderIcon( view, item.icon_second, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                            {{{ secondIconHTML.value }}}
                                        </div>
                                        <div class="gtea_pricing_card__text">
                                            {{{ item.feature_second_text }}}
                                        </div>
                                    </li>
                                    <# } ); #>
                                </ul>
                            </div>
                            <div class="gtea_pricing_card__button">
                                <a class="gtea_pricing_card__button_in" href="#">{{{ table.button_second_text}}}</a>
                            </div>
                        </div>
                    </li>
                    <li class="gtea_pricing__item">
                        <div class="gtea_pricing_card">
                            <div class="gtea_pricing_card__body">
                                <div class="gtea_pricing_card__wrap">
                                    <# const mainIconThirdHTML = elementor.helpers.renderIcon( view, settings.icon_third_main, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                    {{{ mainIconThirdHTML.value }}}
                                </div>
                                <h3 class="gtea_pricing_card__title">{{{ table.third_title }}}</h3>
                                <div class="gtea_pricing_card__price_wrap">
                                    <div
                                            class="gtea_pricing_card__price js-gtea-pricing-container"
                                            data-monthly="{{table.third_month_price}}"
                                            data-yearly="{{table.third_year_price}}"
                                    >
                                        {{{ table.third_month_price }}}
                                    </div>
                                </div>
                                <ul class="gtea_pricing_card__list">
                                    <#
                                    _.each( third_list, function( item ) {
                                    #>
                                    <li class="gtea_pricing_card__item">
                                        <div class="gtea_pricing_card__icon">
                                            <# const thirdIconHTML = elementor.helpers.renderIcon( view, item.icon_third, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                            {{{ thirdIconHTML.value }}}
                                        </div>
                                        <div class="gtea_pricing_card__text">
                                            {{{ item.feature_third_text }}}
                                        </div>
                                    </li>
                                    <# } ); #>
                                </ul>
                            </div>
                            <div class="gtea_pricing_card__button">
                                <a class="gtea_pricing_card__button_in" href="#">{{{ table.button_third_text}}}</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <?php
    }


}

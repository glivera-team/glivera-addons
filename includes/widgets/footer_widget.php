<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Footer_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_footer_widget';
    }

    public function get_title()
    {
        return esc_html__('Footer Widget', 'glivera-addons');
    }


    public function get_icon()
    {
        return 'eicon-footer';
    }

    public function get_categories()
    {
        return ['glivera-addons'];
    }

    public function get_keywords()
    {
        return ['footer', 'menu'];
    }

    public function get_style_depends()
    {
        return ['gtea_footer-widget'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'footer_content',
            [
                'label' => __('Footer Content', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'logo',
            [
                'label' => esc_html__( 'Logo (svg or icon)', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
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
            'description',
            [
                'label' => esc_html__( 'Description', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Default description', 'glivera-addons' ),
                'placeholder' => esc_html__( 'Type your description here', 'glivera-addons' ),
            ]
        );
        $this->add_control(
            'online_text',
            [
                'label' => esc_html__( 'Online Text', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'We are online', 'glivera-addons' ),
            ]
        );
        $this->add_control(
            'copyright_text',
            [
                'label' => esc_html__( 'Copyright Text', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '© All rights reserved', 'glivera-addons' ),
            ]
        );
        $this->add_control(
            'made_with_text',
            [
                'label' => esc_html__( 'Made with Text', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Made with love', 'glivera-addons' ),
            ]
        );
        $this->add_control(
            'online_link', [
                'label' => esc_html__( 'Online Link', 'glivera-addons' ),
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

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'menu_title', [
                'label' => esc_html__( 'Menu Title', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Title',
            ]
        );

        $repeater->add_control(
            'menu',
            [
                'label' => __( 'Menu', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_available_menus(),
            ]
        );

        $repeaterSocial = new \Elementor\Repeater();
        $repeaterSocial->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'recommended' => [
                    'fa-brands' => [
                        'facebook-f',
                    ],
                ],
            ]
        );
        $repeaterSocial->add_control(
            'social_link',
            [
                'label' => esc_html__( 'Link', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'menu_list',
            [
                'label' => esc_html__( 'Menu List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        $this->add_control(
            'social_list',
            [
                'label' => esc_html__( 'Social List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeaterSocial->get_controls(),
            ]
        );
        $this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Gallery Style', 'glivera-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'footer_bg',
                'label' => esc_html__( 'Footer Background', 'glivera-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .gtea_footer',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html__('Button Background Hover', 'glivera-addons'),
                        'default' => 'classic',
                    ],
                ],
            ]
        );

    }


    private function get_available_menus() {
        $menus = wp_get_nav_menus();
        $options = [];
        foreach ( $menus as $menu ) {
            $options[ $menu->term_id ] = $menu->name;
        }
        return $options;
    }

    // Render the widget content on the frontend.
    protected function render()
    {
        $footer = $this->get_settings_for_display();
        $menu_list = $footer['menu_list'];
        $social_list = $footer['social_list'];
        if ( ! empty( $footer['online_link']['url'] ) ) {
            $this->add_link_attributes( 'online_link', $footer['online_link'] );
        }
        ?>
        <footer class="gtea_footer">
            <div class="gtea_footer__container">
                <div class="gtea_footer__body">
                    <div class="gtea_footer__logo gtea_footer__logo--mobile_mod">
                        <a class="gtea_footer__link_logo" href="<?php bloginfo('url') ?>">
                            <div class="gtea_footer__logo_img_w">
                                <?php \Elementor\Icons_Manager::render_icon( $footer['logo'], [ 'aria-hidden' => 'true', 'class' => 'gtea_footer__logo_img_in' ] ); ?>
                            </div>
                        </a>
                    </div>
                    <div class="gtea_footer__row">
                        <div class="gtea_footer__col gtea_footer__col--info_mod">
                            <div class="gtea_footer__info_content">
                                <div class="gtea_footer__info_top">
                                    <div class="gtea_footer__logo gtea_footer__logo--desktop_mod">
                                        <a class="gtea_footer__link_logo" href="<?php bloginfo('url') ?>">
                                            <div class="gtea_footer__logo_img_w">
                                                <?php \Elementor\Icons_Manager::render_icon( $footer['logo'], [ 'aria-hidden' => 'true', 'class' => 'gtea_footer__logo_img_in' ] ); ?>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="gtea_footer__text">
                                        <?php echo wp_kses_post($footer['description']) ?>
                                    </div>
                                </div>
                                <div class="gtea_footer__info_bottom">
                                    <div class="gtea_footer__social">
                                        <ul class="gtea_footer__social_list">
                                            <?php
                                            if (!empty($social_list)) {
                                                foreach ($social_list as $item) {
                                                    if ( ! empty( $item['social_link']['url'] ) ) {
                                                        $this->add_link_attributes( 'social_link', $item['social_link'] );
                                                    }
                                                    ?>
                                                <li class="gtea_footer__social_item">
                                                    <a class="gtea_footer__social_link" <?php $this->print_render_attribute_string( 'social_link' ); ?>>
                                                        <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                    </a>
                                                </li>
                                                <?php }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <a class="gtea_footer__status" <?php $this->print_render_attribute_string( 'online_link' ); ?>>
                                        <div class="gtea_footer__text_status"><?php echo esc_html($footer['online_text']) ?></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="gtea_footer__col gtea_footer__col--nav_mod">
                            <nav class="gtea_footer__nav">
                                <?php
                                    if (!empty($menu_list)) {
                                        foreach ($menu_list as $item) { ?>
                                        <div class="gtea_footer__col_nav">
                                            <h3 class="gtea_footer__title"><?php echo $item['menu_title'] ?></h3>
                                            <?php
                                                wp_nav_menu( array(
                                                    'menu'   => $item['menu'],
                                                    'menu_class' => "gtea_footer__nav_list",
                                                ) );
                                            ?>
                                        </div>
                                        <?php }
                                    }
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="gtea_footer__bottom">
                    <div class="gtea_footer__copy"><?php echo $footer['copyright_text'] ?></div>
                    <div class="gtea_footer__label">
                        <?php echo $footer['made_with_text'] ?>
                    </div>
                </div>
            </div>
        </footer>
        <?php

    }

    protected function content_template() {
        ?>
        <#

        #>
        <footer class="gtea_footer">
            <div class="gtea_footer__container">
                <div class="gtea_footer__body">
                    <div class="gtea_footer__logo gtea_footer__logo--mobile_mod">
                        <a class="gtea_footer__link_logo" href="#">
                            <div class="gtea_footer__logo_img_w">
                                <# const logo = elementor.helpers.renderIcon( view, settings.logo, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                {{{ logo.value }}}
                            </div>
                        </a>
                    </div>
                    <div class="gtea_footer__row">
                        <div class="gtea_footer__col gtea_footer__col--info_mod">
                            <div class="gtea_footer__info_content">
                                <div class="gtea_footer__info_top">
                                    <div class="gtea_footer__logo gtea_footer__logo--desktop_mod">
                                        <a class="gtea_footer__link_logo" href="#">
                                            <div class="gtea_footer__logo_img_w">
                                                {{{ logo.value }}}
                                            </div>
                                        </a>
                                    </div>
                                    <div class="gtea_footer__text">
                                        {{{settings.description}}}
                                    </div>
                                </div>
                                <div class="gtea_footer__info_bottom">
                                    <div class="gtea_footer__social">
                                        <ul class="gtea_footer__social_list">
                                            <#
                                                _.each( settings.social_list, function( item ) {
                                            #>
                                                <li class="gtea_footer__social_item">
                                                    <a class="gtea_footer__social_link">
                                                        <# const socialIcon = elementor.helpers.renderIcon( view, item.icon, { 'aria-hidden': true }, 'i' , 'object' ); #>
                                                        {{{ socialIcon.value }}}
                                                    </a>
                                                </li>
                                            <# } ); #>
                                        </ul>
                                    </div>
                                    <a class="gtea_footer__status" href="#">
                                        <div class="gtea_footer__text_status">{{{settings.online_text}}}</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="gtea_footer__col gtea_footer__col--nav_mod">
                            <nav class="gtea_footer__nav">
                                <#
                                _.each( settings.menu_list, function( item ) {
                                #>
                                    <div class="gtea_footer__col_nav">
                                        <h3 class="gtea_footer__title">{{{item.menu_title}}}</h3>
                                        <ul id="menu-footer-menu-1" class="gtea_footer__nav_list">
                                            <li id="menu-item-478" class="menu-item"><a href="#">Link 1</a></li>
                                            <li id="menu-item-479" class="menu-item"><a href="#">Link 2</a></li>
                                            <li id="menu-item-498" class="menu-item"><a href="#">Link 3</a></li>
                                            <li id="menu-item-499" class="menu-item"><a href="#">Link 4</a></li>
                                        </ul>
                                    </div>
                                <# } ); #>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="gtea_footer__bottom">
                    <div class="gtea_footer__copy">{{{settings.copyright_text}}}</div>
                    <div class="gtea_footer__label">
                        {{{settings.made_with_text}}}
                    </div>
                </div>
            </div>
        </footer>
        <?php
    }



}

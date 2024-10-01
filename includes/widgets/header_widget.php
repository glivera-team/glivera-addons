<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Header_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_header_widget';
    }

    public function get_title()
    {
        return esc_html__('Header Widget', 'glivera-addons');
    }


    public function get_icon()
    {
        return 'eicon-header';
    }

    public function get_categories()
    {
        return ['glivera-addons'];
    }

    public function get_keywords()
    {
        return ['header', 'menu'];
    }

    public function get_style_depends()
    {
        return ['gtea_header-widget'];
    }

    public function get_script_depends() {
        return [ 'gtea_header' ];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'footer_content',
            [
                'label' => __('Header Content', 'glivera-addons'),
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
            'menu',
            [
                'label' => __( 'Menu', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_available_menus(),
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

    public static function get_menu_location_by_name($menu_name) {
        // Get all locations in the theme
        $locations = get_nav_menu_locations();

        // Get all registered menus
        $menus = wp_get_nav_menus();


        // Find the menu object by its name
        foreach ($menus as $menu) {
            if ($menu->term_id == $menu_name) {
                // Search for the menu's location
                foreach ($locations as $location => $menu_id) {
                    if ($menu_id == $menu->term_id) {
                        return $location;
                    }
                }
            }
        }

        return null; // No location found for the given menu name
    }

    public static function get_menu( $menu_location ) {
        $menus_locs = get_nav_menu_locations();
        $array_menus = wp_get_nav_menu_items( $menus_locs[$menu_location] );
        $menu = array();

        if ( $menus_locs && $array_menus ) {
            foreach ( $array_menus as $key => $array_menu ) {
                if ( empty( $array_menu->menu_item_parent ) ) {
                    $current_id = $array_menu->ID;
                    // image for submenu (optional)

                    $menu[$current_id] = array(
                        'id'         => $current_id,
                        'obj_id'     => get_post_meta( $array_menu->ID, '_menu_item_object_id', true ),
                        'menu_order' => $array_menu->menu_order,
                        'item_title' => $array_menu->title,
                        'item_url'   => $array_menu->url,
                        'icon_name'  => '',
                        'sub_menu'   => array(),
                    );
                }

                if ( isset( $current_id ) && $current_id == $array_menu->menu_item_parent ) {
                    $submenu_id = $array_menu->ID;
                    $picture = '';
                    // $description = get_field( 'menu_subtitle', $submenu_id );
                    $menu[$current_id]['sub_menu'][$array_menu->ID] = array(
                        'id'         => $submenu_id,
                        'obj_id'     => get_post_meta( $array_menu->ID, '_menu_item_object_id', true ),
                        'menu_order' => $array_menu->menu_order,
                        'item_title' => $array_menu->title,
                        'item_url'   => $array_menu->url,
                        'icon'    => '',
                        // 'description' => $description,
                        'sub_menu'   => array()
                    );
                }

                if ( isset( $submenu_id ) && $submenu_id == $array_menu->menu_item_parent ) {
                    $menu[ $current_id ]['sub_menu'][ $submenu_id ]['sub_menu'][ $array_menu->ID ] = array(
                        'id'         => $array_menu->ID,
                        'menu_order' => $array_menu->menu_order,
                        'item_title' => $array_menu->title,
                        'item_url'   => $array_menu->url,
                    );
                }
            }
        }


        return $menu;
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
        $header = $this->get_settings_for_display();
        $header_menu = $this->get_menu($this->get_menu_location_by_name($header['menu']));

        ?>

        <div class="gtea_header__container">
            <div class="gtea_header__row">
                <div class="gtea_header__logo">
                    <a class="gtea_header__logo_link" href="#"
                    ><img class="gtea_header__img" src="./logo.svg" alt="Site logo"
                        /></a>
                </div>
                <div class="gtea_header__content">
                    <nav class="gtea_header__body">
                        <ul class="gtea_header_list">
                            <?php foreach ($header_menu as $menu_item) { ?>
                                <li class="gtea_header__item <?php if (!empty($menu_item['sub_menu'])) { echo 'gtea_header__item--submenu_mod js-header-submenu';} ?>">
                                    <?php if (!empty($menu_item['sub_menu'])) { ?>
                                        <button class="gtea_header__link js-header-submenu-trigger" type="button">
											<span class="gtea_header__icon">
												<?php # echo MTDUtils::the_icon('chevron', 'icon--size_mod') ?>
											</span>
                                            <?php echo esc_html($menu_item['item_title']) ?>
                                        </button>
                                        <div class="gtea_header__submenu js-header-submenu-content">
                                            <ul class="gtea_header_sublist">
                                                <?php foreach ($menu_item['sub_menu'] as $menu_sub_item) { ?>
                                                    <li class="gtea_header_sublist__item">
                                                        <a class="gtea_header_sublist__link" href="<?php echo esc_url($menu_sub_item['item_url']) ?>">
															<span class="gtea_header_sublist__icon">
																<?php # echo MTDUtils::the_icon($menu_sub_item['icon'], 'icon--size_mod') ?>
															</span>
                                                            <span class="gtea_header_sublist__wrap">
																<span
                                                                        class="gtea_header_sublist__title"><?php echo esc_html($menu_sub_item['item_title']) ?></span>
																<span
                                                                        class="gtea_header_sublist__text"><?php # echo esc_html($menu_sub_item['description']) ?></span>
															</span>
                                                        </a>
                                                    </li>
                                                <?php } ?>

                                            </ul>
                                        </div>
                                    <?php } else { ?>
                                        <a class="gtea_header__link"
                                           href="<?php echo esc_url($menu_item['item_url']) ?>"><?php echo esc_html($menu_item['item_title']) ?>
                                        </a>
                                    <?php } ?>
                                </li>

                            <?php } ?>
                        </ul>
                        <a class="gtea_header__btn gtea_header__btn--mobile_mod" href="#"
                        >Get Started for Free</a
                        >
                    </nav>
                    <div class="gtea_header__buttons">
                        <a class="gtea_header__btn_v2" href="#">Sign in</a
                        ><a class="gtea_header__btn_v1" href="#">Log in </a
                        ><a
                                class="gtea_header__btn gtea_header__btn--desktop_mod"
                                href="#"
                        >Get Started for Free</a
                        >
                    </div>
                    <button
                            class="gtea_header__menu_trigger js-gtea-header-menu-trigger"
                            type="button"
                            aria-label="Toggle menu"
                    >
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
        <?php

    }

    protected function content_template() {
        ?>
        <#

        #>
        <div class="gtea_header__container">
            <div class="gtea_header__row">
                <div class="gtea_header__logo">
                    <a class="gtea_header__logo_link" href="#">
                        <img class="gtea_header__img" src="./logo.svg" alt="Site logo"/>
                    </a>
                </div>
                <div class="gtea_header__content">
                    <nav class="gtea_header__body">
                        <ul class="gtea_header_list">
                            <li
                                    class="gtea_header__item gtea_header__item--submenu_mod js-gtea-header-submenu"
                            >
                                <button
                                        class="gtea_header__link js-gtea-header-submenu-trigger"
                                        type="button"
                                >
                    <span class="gtea_header__icon">
                      <svg>
                        <use
                                xlink:href="./sprite.svg#chevron"
                        ></use></svg></span
                    >Why Us?
                                </button>
                                <div
                                        class="gtea_header__submenu js-gtea-header-submenu-content"
                                >
                                    <ul class="gtea_header_sublist">
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#fund-view"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title"
                                                    >Hand-picked products</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >Choose a profitable product</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#select"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title"
                                                    >Product importer</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >Import products in 1 click</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#sync"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title"
                                                    >Automatic orders</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >Automatically fulfill your orders</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#scan"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title"
                                                    >Tracking number updates</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >View order updates</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#cart"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title"
                                                    >Fulfillment by Company</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >Learn more about fulfillment</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#inbox"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title"
                                                    >Product sourcing</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >Details about product sourcing</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li
                                    class="gtea_header__item gtea_header__item--submenu_mod js-gtea-header-submenu"
                            >
                                <button
                                        class="gtea_header__link js-gtea-header-submenu-trigger"
                                        type="button"
                                >
                    <span class="gtea_header__icon">
                      <svg>
                        <use
                                xlink:href="./sprite.svg#chevron"
                        ></use></svg></span
                    >Resources
                                </button>
                                <div
                                        class="gtea_header__submenu js-gtea-header-submenu-content"
                                >
                                    <ul class="gtea_header_sublist">
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#read"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title">Blog</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >Latest Insights &amp; Tips</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#user"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title"
                                                    >About us</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >Who We Are &amp; Mission</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#appstore"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title"
                                                    >Templates</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >Vast Library of Templates</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#question"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title"
                                                    >Support</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >Help &amp; Troubleshooting</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#discord"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title"
                                                    >Discord Community</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >Join Our Discord Family</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                        <li class="gtea_header_sublist__item">
                                            <a class="gtea_header_sublist__link" href="#"
                                            ><span class="gtea_header_sublist__icon">
                            <svg>
                              <use
                                      xlink:href="./sprite.svg#dollar"
                              ></use></svg></span
                                                ><span class="gtea_header_sublist__wrap"
                                                ><span class="gtea_header_sublist__title"
                                                    >Affiliate program</span
                                                    ><span class="gtea_header_sublist__text"
                                                    >Earn With Us</span
                                                    ></span
                                                ></a
                                            >
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="gtea_header__item">
                                <a class="gtea_header__link" href="#">Pricing</a>
                            </li>
                            <li class="gtea_header__item">
                                <a class="gtea_header__link" href="#">About</a>
                            </li>
                            <li class="gtea_header__item">
                                <a class="gtea_header__link" href="#">Blog</a>
                            </li>
                        </ul>
                        <a class="gtea_header__btn gtea_header__btn--mobile_mod" href="#"
                        >Get Started for Free</a
                        >
                    </nav>
                    <div class="gtea_header__buttons">
                        <a class="gtea_header__btn_v2" href="#">Sign in</a
                        ><a class="gtea_header__btn_v1" href="#">Log in </a
                        ><a
                                class="gtea_header__btn gtea_header__btn--desktop_mod"
                                href="#"
                        >Get Started for Free</a
                        >
                    </div>
                    <button
                            class="gtea_header__menu_trigger js-gtea-header-menu-trigger"
                            type="button"
                            aria-label="Toggle menu"
                    >
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
        <?php
    }



}

<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Gallery_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_galley_widget';
    }

    public function get_title()
    {
        return esc_html__('Gallery Widget', 'glivera-addons');
    }


    public function get_icon()
    {
        return 'eicon-post-slider';
    }

    public function get_categories()
    {
        return ['glivera-addons'];
    }

    public function get_keywords()
    {
        return ['gallery', 'image', 'animation', 'glivera'];
    }

    public function get_style_depends()
    {
        return ['gtea_gallery-widget'];
    }

    public function get_script_depends() {
        return [ 'gtea_gallery' ];
    }


    protected function register_controls()
    {

        $this->start_controls_section(
            'gallery_content',
            [
                'label' => __('Gallery Content', 'glivera-addons'),
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
            'image', [
                'label' => esc_html__( 'Image', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'title', [
                'label' => esc_html__( 'Title', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Title',
            ]
        );
        $repeater->add_control(
            'link', [
                'label' => esc_html__( 'Link', 'glivera-addons' ),
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
            'link_title', [
                'label' => esc_html__( 'Button Title', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Link Title',
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
            'gallery_list',
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
                'label' => esc_html__( 'Gallery Style', 'glivera-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'glivera-addons' ),
                'name' => 'gallery_title_typography',
                'selector' => '{{WRAPPER}} .gtea_gallery__title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'glivera-addons' ),
                'name' => 'slider_description_typography',
                'selector' => '{{WRAPPER}} .gtea_gallery__description',
            ]
        );

    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $gallery = $this->get_settings_for_display();
        $list = $gallery['gallery_list'];

        ?>
        <section class="gtea_gallery">
            <div class="gtea_gallery__container">
                <h2 class="gtea_gallery__title"><?php echo esc_html($gallery['section_title']) ?></h2>
                <div class="gtea_gallery__description">
                    <?php echo wp_kses_post($gallery['section_description']) ?>
                </div>
                <ul class="gtea_gallery__list">
                    <?php
                    if (!empty($list)) {
                        foreach ($list as $item) { ?>
                        <li class="gtea_gallery__item elementor-repeater-item-<?php echo $item['_id'] ?>">
                            <a href="<?php echo esc_url($item['link']['url']) ?>" class="gtea_gallery__link">
                                <picture class="gtea_gallery__img">
                                    <?php echo wp_get_attachment_image($item['image']['id'], 'full', false, array('class' => 'gtea_gallery__img_in', 'loading' => 'lazy')) ?>
                                </picture>
                                <div class="gtea_gallery__data">
                                    <div class="gtea_gallery__name"><?php echo esc_html($item['title']) ?></div>
                                    <div class="gtea_gallery__hover">
                                        <?php echo esc_html($item['link_title']) ?>
                                        <div class="gtea_gallery__icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } } ?>
                </ul>
            </div>
        </section>
        <?php

    }

    protected function content_template() {
        ?>
        <#
        var list = settings.gallery_list;
        var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );

        #>
        <section class="gtea_gallery">
            <div class="gtea_gallery__container">
                <h2 class="gtea_gallery__title"><?php echo esc_html($gallery['section_title']) ?></h2>
                <div class="gtea_gallery__description">
                    <?php echo wp_kses_post($gallery['section_description']) ?>
                </div>
                <ul class="gtea_gallery__list">
                    <#
                    _.each( list, function( item ) {
                    #>
                    <li class="gtea_gallery__item">
                        <a href="#" class="gtea_gallery__link">
                            <picture class="gtea_gallery__img">
                                <img src="{{item.image.url}}" alt="" class="gtea_gallery__img_in">
                            </picture>
                            <div class="gtea_gallery__data">
                                <div class="gtea_gallery__name">{{{item.title}}}</div>
                                <div class="gtea_gallery__hover">
                                    {{{item.link_title}}}
                                    <div class="gtea_gallery__icon">
                                        {{{ iconHTML.value }}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <# } ); #>
                </ul>
            </div>
        </section>
        <?php
    }



}

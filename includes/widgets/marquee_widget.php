<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class GTEA_Marquee_Widget extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'gtea_marquee_widget';
    }

    public function get_title()
    {
        return esc_html__('Marquee Gallery Widget', 'glivera-addons');
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
        return ['gallery', 'url', 'link'];
    }

    public function get_style_depends()
    {
        return ['gtea_marquee-widget'];
    }

    public function get_script_depends()
    {
        return ['gtea_marquee', 'gtea_gsap'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'maqruee_content1',
            [
                'label' => __('Left Column Content', 'glivera-addons'),
            ]
        );

        $repeaterFirst = new \Elementor\Repeater();
        $repeaterFirst->add_control(
            'image',
            [
                'label' => esc_html__( 'First Image', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeaterFirst->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'textdomain' ),
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
            'maqruee_list1',
            [
                'label' => esc_html__( 'First List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeaterFirst->get_controls(),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'maqruee_content2',
            [
                'label' => __('Right Column Content', 'glivera-addons'),
            ]
        );
        $repeaterSecond = new \Elementor\Repeater();
        $repeaterSecond->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeaterSecond->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'textdomain' ),
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
            'maqruee_list2',
            [
                'label' => esc_html__( 'List', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeaterSecond->get_controls(),
            ]
        );

        $this->end_controls_section();
        // Styles
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Hero Style', 'glivera-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );




        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'glivera-addons' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .gtea_hero__info h1',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Content Typography', 'glivera-addons' ),
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .gtea_hero__info p',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Link Typography', 'glivera-addons' ),
                'name' => 'link_typography',
                'selector' => '{{WRAPPER}} .gtea_btn_primary',
            ]
        );

        $this->add_control(
            'link-padding',
            [
                'label' => esc_html__( 'Link Padding', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 0,
                    'right' => 3.2,
                    'bottom' => 0,
                    'left' => 4,
                    'unit' => 'rem',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gtea_btn_primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }


    // Render the widget content on the frontend.
    protected function render()
    {
        $marquee = $this->get_settings_for_display();
        ?>
        <section class="gtea_marquee_gallery">
            <div class="gtea_marquee_gallery__wrap">
                <div class="gtea_marquee_gallery__cols">
                    <div class="gtea_marquee_gallery__col v1_mod">
                        <div class="gtea_marquee_gallery__col_in v1_mod">
                            <?php foreach ($marquee['maqruee_list1'] as $item) {
                                if ( ! empty( $item['link']['url'] ) ) {
                                    $this->add_link_attributes( 'link', $item['link'] );
                                }
                                ?>
                                <div class="gtea_marquee_gallery__item elementor-repeater-item-<?php echo $item['_id'] ?>">
                                    <a class="gtea_marquee_gallery__img_wrap" <?php $this->print_render_attribute_string( 'link' ); ?>>
                                        <?php echo wp_get_attachment_image( $item['image']['id'], 'full', false, array('class' => 'gtea_marquee_gallery__img') ); ?>
                                    </a>
                                </div>
                            <?php } ?>


                        </div>
                        <div class="gtea_marquee_gallery__col_in v2_mod">
                            <?php foreach ($marquee['maqruee_list1'] as $item) {
                                if ( ! empty( $item['link']['url'] ) ) {
                                    $this->add_link_attributes( 'link', $item['link'] );
                                }
                                ?>
                                <div class="gtea_marquee_gallery__item">
                                    <a class="gtea_marquee_gallery__img_wrap" <?php $this->print_render_attribute_string( 'link' ); ?>>
                                        <?php echo wp_get_attachment_image( $item['image']['id'], 'full', false, array('class' => 'gtea_marquee_gallery__img') ); ?>
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <div class="gtea_marquee_gallery__col v2_mod">
                        <div class="gtea_marquee_gallery__col_in v3_mod">
                            <?php foreach ($marquee['maqruee_list2'] as $item) {
                                if ( ! empty( $item['link']['url'] ) ) {
                                    $this->add_link_attributes( 'link', $item['link'] );
                                }
                                ?>
                                <div class="gtea_marquee_gallery__item">
                                    <a class="gtea_marquee_gallery__img_wrap" <?php $this->print_render_attribute_string( 'link' ); ?>>
                                        <?php echo wp_get_attachment_image( $item['image']['id'], 'full', false, array('class' => 'gtea_marquee_gallery__img') ); ?>
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="gtea_marquee_gallery__col_in v4_mod">
                            <?php foreach ($marquee['maqruee_list2'] as $item) {
                                if ( ! empty( $item['link']['url'] ) ) {
                                    $this->add_link_attributes( 'link', $item['link'] );
                                }
                                ?>
                                <div class="gtea_marquee_gallery__item">
                                    <a class="gtea_marquee_gallery__img_wrap" <?php $this->print_render_attribute_string( 'link' ); ?>>
                                        <?php echo wp_get_attachment_image( $item['image']['id'], 'full', false, array('class' => 'gtea_marquee_gallery__img') ); ?>
                                    </a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php

    }

    protected function content_template() {
        ?>
        <#
        var list1 = settings.maqruee_list1;
        var list2 = settings.maqruee_list2;
        #>
        <section class="gtea_marquee_gallery">
            <div class="gtea_marquee_gallery__wrap">
                <div class="gtea_marquee_gallery__cols">
                    <div class="gtea_marquee_gallery__col v1_mod">
                        <div class="gtea_marquee_gallery__col_in v1_mod">
                            <#
                                _.each( list1, function( item ) {

                                if ( '' === item.first_image.url ) {
                                return;
                                }

                                const image = {
                                id: item.first_image.id,
                                url: item.first_image.url,
                                size: item.image_size,
                                dimension: item.image_custom_dimension,
                                model: view.getEditModel()
                                };

                                const image_url = elementor.imagesManager.getImageUrl( image );

                                if ( '' === image_url ) {
                                return;
                                }

                            #>
                                <div class="gtea_marquee_gallery__item">
                                    <a class="gtea_marquee_gallery__img_wrap" href="#">
                                        <img class="gtea_marquee_gallery__img" src="{{ image_url }}" alt="some image"/></a>
                                </div>
                            <# } ); #>
                        </div>
                        <div class="gtea_marquee_gallery__col_in v2_mod">
                            <#
                            _.each( list1, function( item ) {

                            if ( '' === item.first_image.url ) {
                            return;
                            }

                            const image = {
                            id: item.first_image.id,
                            url: item.first_image.url,
                            size: item.image_size,
                            dimension: item.image_custom_dimension,
                            model: view.getEditModel()
                            };

                            const image_url = elementor.imagesManager.getImageUrl( image );

                            if ( '' === image_url ) {
                            return;
                            }

                            #>
                                <div class="gtea_marquee_gallery__item">
                                    <a class="gtea_marquee_gallery__img_wrap" href="#">
                                        <img class="gtea_marquee_gallery__img" src="{{ image_url }}" alt="some image"/></a>
                                </div>
                            <# } ); #>

                        </div>
                    </div>
                    <div class="gtea_marquee_gallery__col v2_mod">
                        <div class="gtea_marquee_gallery__col_in v3_mod">
                            <#
                            _.each( list2, function( item ) {

                            if ( '' === item.image.url ) {
                            return;
                            }

                            const image = {
                            id: item.image.id,
                            url: item.image.url,
                            size: item.image_size,
                            dimension: item.image_custom_dimension,
                            model: view.getEditModel()
                            };

                            const image_url = elementor.imagesManager.getImageUrl( image );

                            if ( '' === image_url ) {
                            return;
                            }

                            #>
                            <div class="gtea_marquee_gallery__item">
                                <a class="gtea_marquee_gallery__img_wrap" href="#">
                                    <img class="gtea_marquee_gallery__img" src="{{ image_url }}" alt="some image"/></a>
                            </div>
                            <# } ); #>

                        </div>
                        <div class="gtea_marquee_gallery__col_in v4_mod">
                            <#
                            _.each( list2, function( item ) {

                            if ( '' === item.image.url ) {
                            return;
                            }

                            const image2 = {
                            id: item.image.id,
                            url: item.image.url,
                            size: item.image_size,
                            dimension: item.image_custom_dimension,
                            model: view.getEditModel()
                            };

                            const image2_url = elementor.imagesManager.getImageUrl( image2 );

                            if ( '' === image2_url ) {
                            return;
                            }

                            #>
                            <div class="gtea_marquee_gallery__item">
                                <a class="gtea_marquee_gallery__img_wrap" href="#">
                                    <img class="gtea_marquee_gallery__img" src="{{ image2_url }}" alt="some image"/></a>
                            </div>
                            <# } ); #>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }


}

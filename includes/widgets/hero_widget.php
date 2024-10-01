<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class GTEA_Hero_Widget extends \Elementor\Widget_Base
{


	public function get_name()
	{
		return 'gtea_hero_widget';
	}

	public function get_title()
	{
		return esc_html__('Hero Widget', 'glivera-addons');
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
		return ['hero', 'url', 'link'];
	}

	public function get_style_depends()
	{
		return ['gtea_hero-widget'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'hero_content',
			[
				'label' => __('Hero Content', 'glivera-addons'),
			]
		);

        $this->add_control(
			'picture',
			[
				'label' => __('Picture', 'glivera-addons'),
				'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
			]
		);

        $this->add_control(
			'title',
			[
				'label' => __('Title', 'glivera-addons'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Title', 'glivera-addons'),
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
            'hero_link_title',
            [
                'label' => __('Link Title', 'glivera-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'glivera-addons'),
            ]
        );
        $this->add_control(
            'hero_link',
            [
                'label' => esc_html__( 'Link URL', 'glivera-addons' ),
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
            'hero_icon',
            [
                'label' => esc_html__( 'Link Icon', 'glivera-addons' ),
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

		$this->end_controls_section();

        // Styles
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Hero Style', 'glivera-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'hero_alignment',
            [
                'label' => esc_html__( 'Hero Alignment', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'solid',
                'options' => [
                    '' => esc_html__( 'Default', 'glivera-addons' ),
                    'center' => esc_html__( 'Center', 'glivera-addons' ),
                    'flex-start'  => esc_html__( 'Top', 'glivera-addons' ),
                    'flex-end' => esc_html__( 'Bottom', 'glivera-addons' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .gtea_hero ' => 'display: flex; flex-direction: column; justify-content: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hero-height',
            [
                'label' => esc_html__( 'Hero Height', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vh',  'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 5,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gtea_hero' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'hero-padding',
            [
                'label' => esc_html__( 'Hero Padding', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .gtea_hero' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hero_width',
            [
                'label' => esc_html__( 'Hero Content Width', 'glivera-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 190,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                    'size' => 114,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gtea_hero__content' => 'width: {{SIZE}}{{UNIT}};',
                ],
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
		$hero = $this->get_settings_for_display();
        if ( ! empty( $hero['hero_link']['url'] ) ) {
            $this->add_link_attributes( 'hero_link', $hero['hero_link'] );
        }
		?>
        <section class='section gtea_hero gtea_hero--color_white_mod hero--1_mod'>
            <picture class="gtea_hero__img_w">
                <?php echo wp_get_attachment_image( $hero['picture']['id'], 'full', false, array('class' => 'gtea_hero__img') ); ?>
            </picture>
            <div class='section_in gtea_hero__in'>
                <div class='gtea_hero__content'>
                    <div class='gtea_hero__info'>
                        <h1><?php echo wp_kses_post($hero['title']) ?></h1>
                       <?php echo wp_kses_post($hero['description']) ?>
                    </div>
                    <a class="gtea_btn_primary gtea_btn_primary--icon_mod" <?php echo wp_kses_post($this->get_render_attribute_string( 'hero_link' )) ?>>
						<span><?php echo wp_kses_post($hero['hero_link_title'])?></span>
                        <span class="gtea_btn_primary__arrow_r">
                            <span class="icon icon--size_mod">
                                <?php \Elementor\Icons_Manager::render_icon( $hero['hero_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                        </span>
                    </a>
                </div>
            </div>
        </section>


		<?php

	}

    protected function content_template() {
        ?>
        <#
        var description = settings.description;
        var title = settings.title;
        var link_title = settings.hero_link_title
        var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );
        if ( settings.picture.url ) {
        var image = {
        id: settings.picture.id,
        url: settings.picture.url,
        size: settings.image_size,
        dimension: settings.image_custom_dimension,
        model: view.getEditModel()
        };

        var image_url = elementor.imagesManager.getImageUrl( image );

        if ( ! image_url ) {
        return;
        }
        }
        #>
        <section class='section gtea_hero gtea_hero--color_white_mod hero--1_mod'>
            <picture class="gtea_hero__img_w">
                <img class="gtea_hero__img" src="{{ image_url }}" alt="">
            </picture>
            <div class='section_in hero__in'>
                <div class='gtea_hero__content'>
                    <div class='gtea_hero__info'>
                        <h1>{{{title}}}</h1>
                        {{{description}}}
                    </div>

                    <a class="gtea_btn_primary gtea_btn_primary--icon_mod" href="{{ settings.hero_link.url }}">
						<span>{{link_title}}</span>
                        <span class="gtea_btn_primary__arrow_r">
                            <span class="icon icon--size_mod">
                                {{{ iconHTML.value }}}
                            </span>

                        </span>
                    </a>
                </div>
            </div>
        </section>
        <?php
    }


}

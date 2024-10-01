<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://glivera-team.com/
 * @since      1.0.0
 *
 * @package    Glivera_Addons
 * @subpackage Glivera_Addons/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Glivera_Addons
 * @subpackage Glivera_Addons/includes
 * @author     Glivera Team <info@glivera-team.com>
 */
class Glivera_Addons {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Glivera_Addons_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     * @var string Minimum Elementor version required to run the addon.
     */
<<<<<<< HEAD
    const MINIMUM_ELEMENTOR_VERSION = '3.16.0';
=======
    const GTEA_MINIMUM_ELEMENTOR_VERSION = '3.16.0';
>>>>>>> ddbb79d (added new files)

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     * @var string Minimum PHP version required to run the addon.
     */
<<<<<<< HEAD
    const MINIMUM_PHP_VERSION = '7.4';
=======
    const GTEA_MINIMUM_PHP_VERSION = '7.4';
>>>>>>> ddbb79d (added new files)


	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'GLIVERA_ADDONS_VERSION' ) ) {
			$this->version = GLIVERA_ADDONS_VERSION;
		} else {
<<<<<<< HEAD
			$this->version = '1.0.0';
=======
			$this->version = '1.0.1';
>>>>>>> ddbb79d (added new files)
		}
		$this->plugin_name = 'glivera-addons';

        if ( $this->is_compatible() ) {

            $this->load_dependencies();
            $this->set_locale();
            $this->define_admin_hooks();
            $this->define_public_hooks();
            $this->define_elementor_hooks();
<<<<<<< HEAD
            // $this->init_options_menu_page();
=======
            $this->init_options_menu_page();
>>>>>>> ddbb79d (added new files)

        }



	}


    public function is_compatible() {

        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return false;
        }

        // Check for required Elementor version
<<<<<<< HEAD
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
=======
        if ( ! version_compare( ELEMENTOR_VERSION, self::GTEA_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
>>>>>>> ddbb79d (added new files)
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return false;
        }

        // Check for required PHP version
<<<<<<< HEAD
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
=======
        if ( version_compare( PHP_VERSION, self::GTEA_MINIMUM_PHP_VERSION, '<' ) ) {
>>>>>>> ddbb79d (added new files)
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return false;
        }

        return true;

    }

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Glivera_Addons_Loader. Orchestrates the hooks of the plugin.
	 * - Glivera_Addons_i18n. Defines internationalization functionality.
	 * - Glivera_Addons_Admin. Defines all hooks for the admin area.
	 * - Glivera_Addons_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-glivera-addons-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-glivera-addons-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-glivera-addons-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-glivera-addons-public.php';

		$this->loader = new Glivera_Addons_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Glivera_Addons_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Glivera_Addons_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Glivera_Addons_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Glivera_Addons_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
<<<<<<< HEAD

=======
        $this->loader->add_action( 'elementor/frontend/after_register_scripts', $plugin_public, 'enqueue_scripts' );
>>>>>>> ddbb79d (added new files)
	}

    /**
     * Define Elementor hooks for initializing widgets.
     */
    private function define_elementor_hooks() {
        // Register Elementor widget initialization hook
<<<<<<< HEAD
        add_action( 'wp_enqueue_scripts', array($this, 'elementor_widgets_dependencies') );
        add_action('elementor/widgets/widgets_registered', array($this, 'register_elementor_widgets'));
        add_action( 'elementor/elements/categories_registered', array($this, 'add_elementor_widget_categories') );

=======
        //add_action( 'wp_enqueue_scripts', array($this, 'elementor_widgets_dependencies') );
        add_action('elementor/widgets/widgets_registered', array($this, 'register_elementor_widgets'));
        add_action( 'elementor/elements/categories_registered', array($this, 'add_elementor_widget_categories') );

        add_action( 'elementor/editor/after_enqueue_styles',  array($this, 'gtea_plugin_styles')  );
        add_action( 'elementor/frontend/after_enqueue_styles', array($this, 'gtea_plugin_styles')  );
        add_action( 'elementor/frontend/after_register_scripts', array($this, 'gtea_plugin_scripts')  );
        add_action( 'elementor/editor/after_enqueue_scripts', array($this, 'gtea_plugin_scripts')  );


>>>>>>> ddbb79d (added new files)
    }

    /**
     * Register Elementor widgets.
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register_elementor_widgets($widgets_manager) {
        require_once( __DIR__ . '/widgets/hero_widget.php' );
        require_once( __DIR__ . '/widgets/steps_widget.php' );
<<<<<<< HEAD
        // require_once( __DIR__ . '/widgets/collection_widget.php' );
        require_once( __DIR__ . '/widgets/hero_carousel_widget.php' );


        $widgets_manager->register( new \Hero_Widget() );
        $widgets_manager->register( new \Steps_Widget() );
        // $widgets_manager->register( new \Collection_Widget() );
        $widgets_manager->register( new \Hero_Carousel_Widget() );
=======
        require_once( __DIR__ . '/widgets/service1_widget.php' );
        require_once( __DIR__ . '/widgets/service2_widget.php' );
        require_once( __DIR__ . '/widgets/hero_carousel_widget.php' );
        require_once( __DIR__ . '/widgets/culture_slider_widget.php' );
        require_once( __DIR__ . '/widgets/our_journey_widget.php' );
        require_once( __DIR__ . '/widgets/gallery_widget.php' );
        require_once( __DIR__ . '/widgets/pricing_table_widget.php' );
        require_once( __DIR__ . '/widgets/footer_widget.php' );
        require_once( __DIR__ . '/widgets/history_widget.php' );
        require_once( __DIR__ . '/widgets/header_widget.php' );
        require_once( __DIR__ . '/widgets/marquee_widget.php' );
        require_once( __DIR__ . '/widgets/advanced_tabs_widget.php' );


        $widgets_manager->register( new \GTEA_Hero_Widget() );
        $widgets_manager->register( new \GTEA_Steps_Widget() );
        $widgets_manager->register( new \GTEA_Service1_Widget() );
        $widgets_manager->register( new \GTEA_Service2_Widget() );
        $widgets_manager->register( new \GTEA_Hero_Carousel_Widget() );
        $widgets_manager->register( new \GTEA_Culture_Slider_Widget() );
        $widgets_manager->register( new \GTEA_Our_Journey_Widget() );
        $widgets_manager->register( new \GTEA_Gallery_Widget() );
        $widgets_manager->register( new \GTEA_Pricing_Table_Widget() );
        $widgets_manager->register( new \GTEA_Footer_Widget() );
        $widgets_manager->register( new \GTEA_History_Widget() );
        $widgets_manager->register( new \GTEA_Header_Widget() );
        $widgets_manager->register( new \GTEA_Marquee_Widget() );
        $widgets_manager->register( new \GTEA_Advanced_Tabs_Widget() );
>>>>>>> ddbb79d (added new files)

    }

    public function add_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'glivera-addons',
            [
                'title' => esc_html__( 'Glivera-Team Addons', 'glivera-addons' ),
            ]
        );

    }

    /**
     * Register scripts and styles for Elementor widgets.
     */
<<<<<<< HEAD
    public function elementor_widgets_dependencies() {
        wp_register_style( 'hero-widget-carousel', plugins_url( 'css/glivera-hero-carousel.css', __FILE__ ) );
        wp_register_style( 'hero-widget', plugins_url( 'css/glivera-hero-widget.css', __FILE__ ) );
        // wp_register_style( 'collection-widget', plugins_url( 'css/glivera-collection-widget.css', __FILE__ ) );
        wp_register_style( 'steps-widget', plugins_url( 'css/glivera-steps-widget.css', __FILE__ ) );

        wp_register_script( 'hero-widget-carousel-swiper', plugins_url( 'libs/swiper-bundle.min.js', __FILE__ ) );
        wp_register_script( 'hero-widget-carousel', plugins_url( 'js/glivera-hero-carousel.js', __FILE__ ) );

    }

=======
    public function gtea_plugin_styles() {
        wp_register_style( 'gtea_admin', plugins_url( 'css/glivera-addons-admin.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_hero-widget-carousel', plugins_url( 'css/glivera-hero-carousel.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_hero-widget', plugins_url( 'css/glivera-hero-widget.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_service1-widget', plugins_url( 'css/glivera-service1-widget.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_service2-widget', plugins_url( 'css/glivera-service2-widget.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_steps-widget', plugins_url( 'css/glivera-steps-widget.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_culture-slider-widget', plugins_url( 'css/glivera-culture-slider.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_our-journey-widget', plugins_url( 'css/glivera-our-journey.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_gallery-widget', plugins_url( 'css/glivera-gallery.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_pricing-table-widget', plugins_url( 'css/glivera-pricing-table.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_footer-widget', plugins_url( 'css/glivera-footer.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_history-widget', plugins_url( 'css/glivera-history.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_header-widget', plugins_url( 'css/glivera-header.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_marquee-widget', plugins_url( 'css/glivera-marquee.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );
        wp_register_style( 'gtea_advanced-tabs-widget', plugins_url( 'css/glivera-advanced-tabs.css', __FILE__ ), array(), GLIVERA_ADDONS_VERSION );


        wp_enqueue_style( 'gtea_admin' );

    }

    public function gtea_plugin_scripts() {

        wp_register_script('swiper', ELEMENTOR_ASSETS_URL . 'lib/swiper/v8/swiper.min.js', ['jquery'], GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true'));
        wp_register_script( 'gtea_hero-widget-carousel', plugins_url( 'js/glivera-hero-carousel.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_culture-slider', plugins_url( 'js/glivera-culture-slider.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_gsap', plugins_url( 'js/glivera-gsap.min.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_scrolltrigger', plugins_url( 'js/glivera-scrolltrigger.min.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_splittext', plugins_url( 'js/glivera-splittext.min.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_swiper', plugins_url( 'js/glivera-swiper11.min.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_service1', plugins_url( 'js/glivera-service1.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_gallery', plugins_url( 'js/glivera-gallery.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_service2', plugins_url( 'js/glivera-service2.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_pricing-table', plugins_url( 'js/glivera-pricing-table.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_header', plugins_url( 'js/glivera-header.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_marquee', plugins_url( 'js/glivera-marquee.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
        wp_register_script( 'gtea_advanced-tabs', plugins_url( 'js/glivera-advanced-tabs.js', __FILE__ ), array(), GLIVERA_ADDONS_VERSION, array('in_footer'  => 'true') );
    }


>>>>>>> ddbb79d (added new files)

    /**
     * Add Plugin Menu Page
     *
     * Add a new menu page under the "Plugins" menu for the plugin homepage.
     *
     * @since 1.0.0
     * @access public
     */
    public function add_options_menu_page() {
        $icon_url = 'dashicons-star-empty';

        add_menu_page(
            esc_html__( 'Glivera-Team Addons', 'glivera-addons' ),
            esc_html__( 'Glivera-Team Addons', 'glivera-addons' ),
            'manage_options',
            'true_slider',
            [ $this, 'render_plugin_homepage' ],
            'dashicons-images-alt2',
            25
        );


    }

    public function init_options_menu_page() {
        add_action( 'admin_menu', [ $this, 'add_options_menu_page' ] );
    }

    /**
     * Render Plugin Homepage
     *
     * Render the content for the plugin homepage.
     *
     * @since 1.0.0
     * @access public
     */
    public function render_plugin_homepage() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/glivera-addons-admin-display.php';
    }

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Glivera_Addons_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

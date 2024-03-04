<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://glivera-team.com/
 * @since             1.0.0
 * @package           Glivera_Addons
 *
 * @wordpress-plugin
 * Plugin Name:       Glivera Team Elementor Addons
 * Plugin URI:        https://glivera-team.com/
 * Description:       Custom widgets for Elementor Page Builder from Glivera Team
 * Version:           1.0.0
 * Author:            Glivera Team
 * Author URI:        https://glivera-team.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       glivera-addons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GLIVERA_ADDONS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-glivera-addons-activator.php
 */
function activate_glivera_addons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-glivera-addons-activator.php';
	Glivera_Addons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-glivera-addons-deactivator.php
 */
function deactivate_glivera_addons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-glivera-addons-deactivator.php';
	Glivera_Addons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_glivera_addons' );
register_deactivation_hook( __FILE__, 'deactivate_glivera_addons' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-glivera-addons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_glivera_addons() {

	$plugin = new Glivera_Addons();
	$plugin->run();

}
run_glivera_addons();

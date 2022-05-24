<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://oxosolutions.com
 * @since             1.0.0
 * @package           Aione_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       Aione Slider
 * Plugin URI:        https://oxosolutions.com/products/wordpress-plugins/aione-slider/
 * Description:       Advanced customizable slider to slide images, text and wordpress posts and custom posts.
 * Version:           1.3.0.0
 * Author:            OXO Solutions®
 * Author URI:        https://oxosolutions.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       aione-slider
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/oxosolutions/aione-slider
 * GitHub Branch: master
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-aione-slider-activator.php
 */
function activate_aione_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aione-slider-activator.php';
	Aione_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-aione-slider-deactivator.php
 */
function deactivate_aione_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aione-slider-deactivator.php';
	Aione_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_aione_slider' );
register_deactivation_hook( __FILE__, 'deactivate_aione_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-aione-slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_aione_slider() {

	$plugin = new Aione_Slider();
	$plugin->run();

}
run_aione_slider();

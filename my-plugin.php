<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/YOUR_USERNAME/my-plugin
 * @since             1.0.0
 * @package           My_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       My Plugin
 * Plugin URI:        https://github.com/YOUR_USERNAME/my-plugin
 * Description:       A production-ready WordPress Plugin Starter Kit with full OOP architecture.
 * Version:           1.0.0
 * Author:            Your Name
 * Author URI:        https://yourwebsite.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Minimum requirements check.
 */
function my_plugin_check_requirements() {
	// Check PHP Version
	if ( version_compare( PHP_VERSION, '7.4', '<' ) ) {
		add_action( 'admin_notices', function() {
			printf( '<div class="notice notice-error"><p>%s</p></div>', esc_html__( 'My Plugin requires PHP version 7.4 or higher. Please upgrade your PHP version.', 'my-plugin' ) );
		} );
		return false;
	}

	// Check WP Version
	if ( version_compare( $GLOBALS['wp_version'], '5.8', '<' ) ) {
		add_action( 'admin_notices', function() {
			printf( '<div class="notice notice-error"><p>%s</p></div>', esc_html__( 'My Plugin requires WordPress version 5.8 or higher. Please upgrade your WordPress installation.', 'my-plugin' ) );
		} );
		return false;
	}

	return true;
}

if ( ! my_plugin_check_requirements() ) {
	return;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'MY_PLUGIN_VERSION', '1.0.0' );

/**
 * The full path to the main plugin file.
 */
define( 'MY_PLUGIN_FILE', __FILE__ );

/**
 * The absolute path to the plugin directory.
 */
define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The URL to the plugin directory.
 */
define( 'MY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The plugin basename.
 */
define( 'MY_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-my-plugin-activator.php
 */
function activate_my_plugin() {
	require_once MY_PLUGIN_PATH . 'includes/class-my-plugin-activator.php';
	My_Plugin_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-my-plugin-deactivator.php
 */
function deactivate_my_plugin() {
	require_once MY_PLUGIN_PATH . 'includes/class-my-plugin-deactivator.php';
	My_Plugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_my_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_my_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require MY_PLUGIN_PATH . 'includes/class-my-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks, then kicking off
 * the initialization from this point will lower the entire plugin to register
 * its sections with WordPress.
 *
 * @since    1.0.0
 */
function run_my_plugin() {
	$plugin = My_Plugin::get_instance();
	$plugin->run();
}

run_my_plugin();

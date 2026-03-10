<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link       https://github.com/YOUR_USERNAME/my-plugin
 * @since      1.0.0
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/includes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/includes
 * @author     Your Name <your@email.com>
 */
class My_Plugin_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// Create Custom Tables
		self::create_tables();

		// Set Default Options
		self::set_default_options();

		// Clear scheduled cron events or other startup tasks
		
		// Flush rewrite rules
		flush_rewrite_rules();

	}

	/**
	 * Create initial database tables.
	 * 
	 * @since    1.0.0
	 */
	private static function create_tables() {
		require_once MY_PLUGIN_PATH . 'includes/class-my-plugin-db.php';
		$db = new My_Plugin_Db();
		$db->create_tables();
	}

	/**
	 * Set default plugin options.
	 * 
	 * @since    1.0.0
	 */
	private static function set_default_options() {
		$defaults = array(
			'setting_text'     => '',
			'setting_textarea' => '',
			'setting_checkbox' => '0',
			'setting_select'   => 'default',
		);

		if ( ! get_option( 'my_plugin_settings' ) ) {
			add_option( 'my_plugin_settings', $defaults );
		}
		
		if ( ! get_option( 'my_plugin_version' ) ) {
			add_option( 'my_plugin_version', MY_PLUGIN_VERSION );
		}
	}

}

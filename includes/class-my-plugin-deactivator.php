<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
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
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/includes
 * @author     Your Name <your@email.com>
 */
class My_Plugin_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// Flush rewrite rules
		flush_rewrite_rules();

		// Cleanup any transients or scheduled tasks
		// wp_clear_scheduled_hook( 'my_plugin_cron_hook' );
	}

}

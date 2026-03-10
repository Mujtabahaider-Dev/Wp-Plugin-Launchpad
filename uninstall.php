<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following:
 *
 * - This file should be as self-contained as possible.
 * - This file should not use any functions or classes from the plugin.
 * - This file should only perform cleanup tasks like deleting options or tables.
 *
 * @link       https://github.com/YOUR_USERNAME/my-plugin
 * @since      1.0.0
 *
 * @package    My_Plugin
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Global $wpdb instance
global $wpdb;

/**
 * Delete plugin options.
 */
delete_option( 'my_plugin_settings' );
delete_option( 'my_plugin_version' );

/**
 * Drop custom database table.
 */
$table_name = $wpdb->prefix . 'my_plugin_items';
$wpdb->query( "DROP TABLE IF EXISTS {$table_name}" );

/**
 * Cleanup any other artifacts here (e.g., custom post types, transients, etc.)
 */
$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'my_plugin_%'" );

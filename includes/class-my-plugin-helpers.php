<?php
/**
 * Shared utility/helper methods.
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
 * Shared utility/helper methods.
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/includes
 * @author     Your Name <your@email.com>
 */
class My_Plugin_Helpers {

	/**
	 * Wrapper for get_option for easier access to plugin settings.
	 *
	 * @since    1.0.0
	 * @param    string    $key        The setting key to retrieve.
	 * @param    mixed     $default    The default value if not found.
	 * @return   mixed                 The setting value.
	 */
	public static function get_option( $key, $default = '' ) {
		$options = get_option( 'my_plugin_settings' );

		if ( isset( $options[ $key ] ) ) {
			return $options[ $key ];
		}

		return $default;
	}

	/**
	 * Log messages to the error log if WP_DEBUG is enabled.
	 *
	 * @since    1.0.0
	 * @param    mixed     $message    The message or data to log.
	 */
	public static function log( $message ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG === true ) {
			if ( is_array( $message ) || is_object( $message ) ) {
				error_log( 'My Plugin Debug: ' . print_r( $message, true ) );
			} else {
				error_log( 'My Plugin Debug: ' . $message );
			}
		}
	}

	/**
	 * Format a date string using the WordPress date format.
	 *
	 * @since    1.0.0
	 * @param    string    $date_string    The date string to format.
	 * @return   string                    The formatted date.
	 */
	public static function format_date( $date_string ) {
		if ( empty( $date_string ) ) {
			return '';
		}

		return date_i18n( get_option( 'date_format' ), strtotime( $date_string ) );
	}

	/**
	 * Truncate text to a specific length.
	 *
	 * @since    1.0.0
	 * @param    string    $text      The text to truncate.
	 * @param    int       $length    The maximum length.
	 * @param    string    $suffix    The suffix to append if truncated.
	 * @return   string               The truncated text.
	 */
	public static function truncate_text( $text, $length = 100, $suffix = '...' ) {
		if ( strlen( $text ) <= $length ) {
			return $text;
		}

		return substr( $text, 0, $length ) . $suffix;
	}

	/**
	 * Generate a unique key for transients or other purposes.
	 *
	 * @since    1.0.0
	 * @param    string    $prefix    The prefix for the key.
	 * @return   string               The unique key.
	 */
	public static function generate_unique_key( $prefix = '' ) {
		return $prefix . md5( uniqid( microtime(), true ) );
	}

	/**
	 * Get the full URL to an asset file.
	 *
	 * @since    1.0.0
	 * @param    string    $path    The relative path to the asset.
	 * @return   string             The full URL to the asset.
	 */
	public static function asset_url( $path ) {
		return trailingslashit( MY_PLUGIN_URL ) . ltrim( $path, '/' );
	}

}

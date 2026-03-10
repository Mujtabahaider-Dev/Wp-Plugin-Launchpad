<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/YOUR_USERNAME/my-plugin
 * @since      1.0.0
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/public/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="my-plugin-public-display">
	<h3 class="my-plugin-title"><?php echo esc_html( $title ); ?></h3>
	<div class="my-plugin-content">
		<p><?php esc_html_e( 'This is an example output from [my_plugin_display] shortcode.', 'my-plugin' ); ?></p>
		
		<div class="my-plugin-dynamic-section">
			<button id="my-plugin-public-action" class="my-plugin-button">
				<?php esc_html_e( 'Click for Public Action', 'my-plugin' ); ?>
			</button>
			<div id="my-plugin-public-response"></div>
		</div>
	</div>
</div>

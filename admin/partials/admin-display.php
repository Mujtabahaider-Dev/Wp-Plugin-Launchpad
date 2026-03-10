<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/YOUR_USERNAME/my-plugin
 * @since      1.0.0
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	
	<div class="my-plugin-admin-content">
		<h2><?php esc_html_e( 'Welcome to My Plugin Dashboard', 'my-plugin' ); ?></h2>
		<p><?php esc_html_e( 'This is the main dashboard for your plugin. You can add more functionality here.', 'my-plugin' ); ?></p>
		
		<div class="my-plugin-card">
			<h3><?php esc_html_e( 'Quick Actions', 'my-plugin' ); ?></h3>
			<button id="my-plugin-ajax-test" class="button button-primary">
				<?php esc_html_e( 'Test AJAX Action', 'my-plugin' ); ?>
			</button>
			<span class="spinner" id="my-plugin-spinner"></span>
			<div id="my-plugin-ajax-response" style="margin-top: 10px;"></div>
		</div>
	</div>
</div>

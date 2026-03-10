<?php
/**
 * Provide a settings view for the plugin
 *
 * This file is used to markup the settings-facing aspects of the plugin.
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
	
	<?php settings_errors(); ?>

	<div class="my-plugin-tabs-wrapper">
		<h2 class="nav-tab-wrapper">
			<a href="#tab-general" class="nav-tab nav-tab-active"><?php esc_html_e( 'General', 'my-plugin' ); ?></a>
			<a href="#tab-advanced" class="nav-tab"><?php esc_html_e( 'Advanced', 'my-plugin' ); ?></a>
		</h2>

		<form method="post" action="options.php" class="my-plugin-settings-form">
			<div id="tab-general" class="my-plugin-tab-content">
				<?php
				settings_fields( 'my_plugin_settings_group' );
				do_settings_sections( 'my-plugin-settings' );
				?>
			</div>

			<div id="tab-advanced" class="my-plugin-tab-content" style="display:none;">
				<h2><?php esc_html_e( 'Advanced Settings', 'my-plugin' ); ?></h2>
				<p><?php esc_html_e( 'Advanced configuration options can be placed here.', 'my-plugin' ); ?></p>
			</div>

			<?php submit_button(); ?>
		</form>
	</div>
</div>

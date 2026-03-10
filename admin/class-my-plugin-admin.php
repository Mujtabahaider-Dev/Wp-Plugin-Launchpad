<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/YOUR_USERNAME/my-plugin
 * @since      1.0.0
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/admin
 * @author     Your Name <your@email.com>
 */
class My_Plugin_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version           The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, MY_PLUGIN_URL . 'admin/css/my-plugin-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, MY_PLUGIN_URL . 'admin/js/my-plugin-admin.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'myPluginAdmin', array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'my_plugin_ajax_nonce' ),
		) );
	}

	/**
	 * Add menu pages to the admin dashboard.
	 *
	 * @since    1.0.0
	 */
	public function add_menu_pages() {
		add_menu_page(
			__( 'My Plugin', 'my-plugin' ),
			__( 'My Plugin', 'my-plugin' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_plugin_admin_page' ),
			'dashicons-admin-plugins',
			100
		);

		add_submenu_page(
			$this->plugin_name,
			__( 'Settings', 'my-plugin' ),
			__( 'Settings', 'my-plugin' ),
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'display_plugin_settings_page' )
		);
	}

	/**
	 * Render the main admin page.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		require_once MY_PLUGIN_PATH . 'admin/partials/admin-display.php';
	}

	/**
	 * Render the settings page.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_settings_page() {
		require_once MY_PLUGIN_PATH . 'admin/partials/admin-settings.php';
	}

	/**
	 * Add settings link to the plugin list page.
	 *
	 * @since    1.0.0
	 * @param    array    $links    The existing action links.
	 * @return   array              The modified action links.
	 */
	public function add_plugin_action_links( $links ) {
		$settings_link = '<a href="admin.php?page=' . $this->plugin_name . '-settings">' . __( 'Settings', 'my-plugin' ) . '</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}

	/**
	 * Show admin notices.
	 *
	 * @since    1.0.0
	 */
	public function admin_notices() {
		$message = get_transient( 'my_plugin_notice' );
		if ( $message ) {
			?>
			<div class="notice notice-success is-dismissible">
				<p><?php echo esc_html( $message ); ?></p>
			</div>
			<?php
			delete_transient( 'my_plugin_notice' );
		}
	}

}

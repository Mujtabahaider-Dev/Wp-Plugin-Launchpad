<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/YOUR_USERNAME/my-plugin
 * @since      1.0.0
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/public
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The public-facing functionality of the plugin.
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/public
 * @author     Your Name <your@email.com>
 */
class My_Plugin_Public {

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
	 * @param    string    $plugin_name    The name of the plugin.
	 * @param    string    $version        The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		// Only enqueue if needed (e.g., check for shortcode in content)
		// For this starter kit, we'll enqueue it by default for demonstration
		wp_enqueue_style( $this->plugin_name, MY_PLUGIN_URL . 'public/css/my-plugin-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, MY_PLUGIN_URL . 'public/js/my-plugin-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'myPluginPublic', array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'my_plugin_ajax_nonce' ),
		) );
	}

	/**
	 * Register all shortcodes for the plugin.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {
		add_shortcode( 'my_plugin_display', array( $this, 'render_display_shortcode' ) );
	}

	/**
	 * Render the display shortcode [my_plugin_display]
	 *
	 * @since    1.0.0
	 * @param    array    $atts    Shortcode attributes.
	 * @return   string            Shortcode output.
	 */
	public function render_display_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'title' => __( 'Plugin Data', 'my-plugin' ),
			),
			$atts,
			'my_plugin_display'
		);

		$title = sanitize_text_field( $atts['title'] );

		ob_start();
		require MY_PLUGIN_PATH . 'public/partials/public-display.php';
		return ob_get_clean();
	}

}

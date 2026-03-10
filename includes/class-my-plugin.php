<?php
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
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
 * The core plugin class.
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/includes
 * @author     Your Name <your@email.com>
 */
class My_Plugin {

	/**
	 * The current instance of the class.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      My_Plugin    $instance    The instance of the class.
	 */
	private static $instance = null;

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      My_Plugin_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	private function __construct() {

		if ( defined( 'MY_PLUGIN_VERSION' ) ) {
			$this->version = MY_PLUGIN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'my-plugin';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_ajax_hooks();
		$this->define_rest_api_hooks();

	}

	/**
	 * Provides a singleton instance of the class.
	 *
	 * @since    1.0.0
	 * @return   My_Plugin    The instance of the class.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - My_Plugin_Loader. Orchestrates the hooks of the plugin.
	 * - My_Plugin_Admin. Defines all hooks for the admin area.
	 * - My_Plugin_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once MY_PLUGIN_PATH . 'includes/class-my-plugin-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once MY_PLUGIN_PATH . 'admin/class-my-plugin-admin.php';
		require_once MY_PLUGIN_PATH . 'admin/class-my-plugin-settings.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once MY_PLUGIN_PATH . 'public/class-my-plugin-public.php';

		/**
		 * The classes responsible for other core functionality.
		 */
		require_once MY_PLUGIN_PATH . 'includes/class-my-plugin-helpers.php';
		require_once MY_PLUGIN_PATH . 'includes/class-my-plugin-db.php';
		require_once MY_PLUGIN_PATH . 'includes/class-my-plugin-ajax.php';
		require_once MY_PLUGIN_PATH . 'includes/class-my-plugin-rest-api.php';

		$this->loader = new My_Plugin_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the My_Plugin_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'my-plugin',
			false,
			dirname( MY_PLUGIN_BASENAME ) . '/languages/'
		);
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new My_Plugin_Admin( $this->get_plugin_name(), $this->get_version() );
		$plugin_settings = new My_Plugin_Settings( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		// Menu and Settings
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_menu_pages' );
		$this->loader->add_action( 'admin_init', $plugin_settings, 'register_settings' );
		
		// Plugin Action Links
		$this->loader->add_filter( 'plugin_action_links_' . MY_PLUGIN_BASENAME, $plugin_admin, 'add_plugin_action_links' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new My_Plugin_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		// Shortcodes
		$this->loader->add_action( 'init', $plugin_public, 'register_shortcodes' );

	}

	/**
	 * Register all of the AJAX hooks.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_ajax_hooks() {
		$plugin_ajax = new My_Plugin_Ajax();
		// Hooks are registered inside the class constructor normally, 
		// but we can also manage them via the loader if preferred.
		// For this starter kit, we'll let the AJAX class handle its own hook registration for simplicity
		// or pass it to the loader for strictness. Let's use the loader.
		$this->loader->add_action( 'wp_ajax_my_plugin_example_action', $plugin_ajax, 'handle_example_action' );
		$this->loader->add_action( 'wp_ajax_nopriv_my_plugin_example_action', $plugin_ajax, 'handle_example_action' );
	}

	/**
	 * Register all of the REST API hooks.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_rest_api_hooks() {
		$plugin_rest = new My_Plugin_Rest_Api();
		$this->loader->add_action( 'rest_api_init', $plugin_rest, 'register_routes' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    My_Plugin_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

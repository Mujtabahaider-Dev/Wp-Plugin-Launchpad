<?php
/**
 * REST API endpoints for the plugin.
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
 * REST API endpoints for the plugin.
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/includes
 * @author     Your Name <your@email.com>
 */
class My_Plugin_Rest_Api {

	/**
	 * Register the routes for the objects of the controller.
	 *
	 * @since    1.0.0
	 */
	public function register_routes() {
		$namespace = 'my-plugin/v1';

		register_rest_route( $namespace, '/items', array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_items' ),
				'permission_callback' => array( $this, 'get_items_permissions_check' ),
			),
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'create_item' ),
				'permission_callback' => array( $this, 'create_item_permissions_check' ),
				'args'                => array(
					'title' => array(
						'required'          => true,
						'sanitize_callback' => 'sanitize_text_field',
					),
				),
			),
		) );
	}

	/**
	 * Check if a given request has access to get items.
	 *
	 * @since    1.0.0
	 * @param    WP_REST_Request    $request    Full data about the request.
	 * @return   bool|WP_Error                  Whether the request has read access.
	 */
	public function get_items_permissions_check( $request ) {
		return is_user_logged_in();
	}

	/**
	 * Get a collection of items.
	 *
	 * @since    1.0.0
	 * @param    WP_REST_Request    $request    Full data about the request.
	 * @return   WP_REST_Response|WP_Error      Response object on success, or WP_Error object on failure.
	 */
	public function get_items( $request ) {
		$db = new My_Plugin_Db();
		$items = $db->get_all();

		return new WP_REST_Response( $items, 200 );
	}

	/**
	 * Check if a given request has access to create items.
	 *
	 * @since    1.0.0
	 * @param    WP_REST_Request    $request    Full data about the request.
	 * @return   bool|WP_Error                  Whether the request has create access.
	 */
	public function create_item_permissions_check( $request ) {
		return current_user_can( 'manage_options' );
	}

	/**
	 * Create one item from the collection.
	 *
	 * @since    1.0.0
	 * @param    WP_REST_Request    $request    Full data about the request.
	 * @return   WP_REST_Response|WP_Error      Response object on success, or WP_Error object on failure.
	 */
	public function create_item( $request ) {
		$title = $request->get_param( 'title' );
		
		$db = new My_Plugin_Db();
		$id = $db->insert( array( 'title' => $title ) );

		if ( $id ) {
			return new WP_REST_Response( array( 'id' => $id, 'message' => 'Created' ), 201 );
		}

		return new WP_Error( 'db_error', 'Failed to create item', array( 'status' => 500 ) );
	}

}

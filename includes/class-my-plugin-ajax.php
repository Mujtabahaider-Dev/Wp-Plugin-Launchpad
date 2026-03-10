<?php
/**
 * AJAX handlers for the plugin.
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
 * AJAX handlers for the plugin.
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/includes
 * @author     Your Name <your@email.com>
 */
class My_Plugin_Ajax {

	/**
	 * Handle an example AJAX action.
	 *
	 * @since    1.0.0
	 */
	public function handle_example_action() {

		// Verify Nonce
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'my_plugin_ajax_nonce' ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Invalid nonce verification.', 'my-plugin' ) ) );
		}

		// Check Capability
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'You do not have permission to perform this action.', 'my-plugin' ) ) );
		}

		// Sanitize Input
		$item_id = isset( $_POST['id'] ) ? absint( $_POST['id'] ) : 0;
		$content = isset( $_POST['content'] ) ? sanitize_textarea_field( wp_unslash( $_POST['content'] ) ) : '';

		if ( ! $item_id ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Invalid ID provided.', 'my-plugin' ) ) );
		}

		// Perform Logic (Example: Update DB)
		$db = new My_Plugin_Db();
		$updated = $db->update( $item_id, array( 'content' => $content ) );

		if ( $updated ) {
			wp_send_json_success( array( 
				'message' => esc_html__( 'Item updated successfully!', 'my-plugin' ),
				'id'      => $item_id 
			) );
		} else {
			wp_send_json_error( array( 'message' => esc_html__( 'Failed to update item.', 'my-plugin' ) ) );
		}
	}

}

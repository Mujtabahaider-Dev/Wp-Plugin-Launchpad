<?php
/**
 * Custom DB table CRUD operations.
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
 * Custom DB table CRUD operations.
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/includes
 * @author     Your Name <your@email.com>
 */
class My_Plugin_Db {

	/**
	 * The name of the table.
	 *
	 * @since    1.0.0
	 * @var      string
	 */
	private $table_name;

	/**
	 * Initialize the class and set the table name.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'my_plugin_items';
	}

	/**
	 * Create the custom table using dbDelta.
	 *
	 * @since    1.0.0
	 */
	public function create_tables() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE {$this->table_name} (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			title varchar(255) NOT NULL,
			content text DEFAULT '',
			status varchar(50) DEFAULT 'active',
			created_at datetime DEFAULT CURRENT_TIMESTAMP,
			updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
		) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * Insert a new row into the table.
	 *
	 * @since    1.0.0
	 * @param    array    $data    Data to insert.
	 * @return   int|bool          The ID of the inserted row or false on failure.
	 */
	public function insert( $data ) {
		global $wpdb;

		$result = $wpdb->insert( $this->table_name, $data );

		if ( false === $result ) {
			My_Plugin_Helpers::log( 'Failed to insert row into ' . $this->table_name );
			return false;
		}

		return $wpdb->insert_id;
	}

	/**
	 * Update a row in the table.
	 *
	 * @since    1.0.0
	 * @param    int      $id      The ID of the row to update.
	 * @param    array    $data    Data to update.
	 * @return   int|bool          The number of rows updated or false on failure.
	 */
	public function update( $id, $data ) {
		global $wpdb;

		$result = $wpdb->update(
			$this->table_name,
			$data,
			array( 'id' => $id ),
			null,
			array( '%d' )
		);

		if ( false === $result ) {
			My_Plugin_Helpers::log( 'Failed to update row ID ' . $id . ' in ' . $this->table_name );
			return false;
		}

		return $result;
	}

	/**
	 * Delete a row from the table.
	 *
	 * @since    1.0.0
	 * @param    int    $id    The ID of the row to delete.
	 * @return   int|bool      The number of rows deleted or false on failure.
	 */
	public function delete( $id ) {
		global $wpdb;

		$result = $wpdb->delete(
			$this->table_name,
			array( 'id' => $id ),
			array( '%d' )
		);

		if ( false === $result ) {
			My_Plugin_Helpers::log( 'Failed to delete row ID ' . $id . ' from ' . $this->table_name );
			return false;
		}

		return $result;
	}

	/**
	 * Get a single row by ID.
	 *
	 * @since    1.0.0
	 * @param    int    $id    The ID of the row.
	 * @return   object|bool   The row object or false if not found.
	 */
	public function get_row( $id ) {
		global $wpdb;

		$row = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$this->table_name} WHERE id = %d",
				$id
			)
		);

		return $row ? $row : false;
	}

	/**
	 * Get all rows from the table.
	 *
	 * @since    1.0.0
	 * @return   array    The list of rows.
	 */
	public function get_all() {
		global $wpdb;

		return $wpdb->get_results( "SELECT * FROM {$this->table_name} ORDER BY created_at DESC" );
	}

}

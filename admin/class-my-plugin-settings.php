<?php
/**
 * Settings API registration and callbacks.
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
 * Settings API registration and callbacks.
 *
 * @package    My_Plugin
 * @subpackage My_Plugin/admin
 * @author     Your Name <your@email.com>
 */
class My_Plugin_Settings {

	/**
	 * The name of the option group.
	 *
	 * @since    1.0.0
	 * @var      string
	 */
	private $option_group = 'my_plugin_settings_group';

	/**
	 * Register settings, sections, and fields.
	 *
	 * @since    1.0.0
	 */
	public function register_settings() {
		register_setting(
			$this->option_group,
			'my_plugin_settings',
			array(
				'sanitize_callback' => array( $this, 'sanitize_settings' ),
				'default'           => array(),
			)
		);

		add_settings_section(
			'my_plugin_general_section',
			__( 'General Settings', 'my-plugin' ),
			array( $this, 'render_section_info' ),
			'my-plugin-settings'
		);

		add_settings_field(
			'setting_text',
			__( 'Text Input', 'my-plugin' ),
			array( $this, 'render_text_field' ),
			'my-plugin-settings',
			'my_plugin_general_section',
			array( 'label_for' => 'setting_text' )
		);

		add_settings_field(
			'setting_textarea',
			__( 'Textarea', 'my-plugin' ),
			array( $this, 'render_textarea_field' ),
			'my-plugin-settings',
			'my_plugin_general_section',
			array( 'label_for' => 'setting_textarea' )
		);

		add_settings_field(
			'setting_checkbox',
			__( 'Checkbox', 'my-plugin' ),
			array( $this, 'render_checkbox_field' ),
			'my-plugin-settings',
			'my_plugin_general_section',
			array( 'label_for' => 'setting_checkbox' )
		);

		add_settings_field(
			'setting_select',
			__( 'Select Dropdown', 'my-plugin' ),
			array( $this, 'render_select_field' ),
			'my-plugin-settings',
			'my_plugin_general_section',
			array( 'label_for' => 'setting_select' )
		);
	}

	/**
	 * Sanitize settings input.
	 *
	 * @since    1.0.0
	 * @param    array    $input    Input data to sanitize.
	 * @return   array              Sanitized data.
	 */
	public function sanitize_settings( $input ) {
		$new_input = array();

		if ( isset( $input['setting_text'] ) ) {
			$new_input['setting_text'] = sanitize_text_field( $input['setting_text'] );
		}

		if ( isset( $input['setting_textarea'] ) ) {
			$new_input['setting_textarea'] = sanitize_textarea_field( $input['setting_textarea'] );
		}

		$new_input['setting_checkbox'] = isset( $input['setting_checkbox'] ) ? '1' : '0';

		if ( isset( $input['setting_select'] ) ) {
			$allowed = array( 'default', 'option1', 'option2' );
			$new_input['setting_select'] = in_array( $input['setting_select'], $allowed ) ? $input['setting_select'] : 'default';
		}

		return $new_input;
	}

	/**
	 * Callback for section info.
	 *
	 * @since    1.0.0
	 */
	public function render_section_info() {
		echo '<p>' . esc_html__( 'Configure your plugin settings below.', 'my-plugin' ) . '</p>';
	}

	/**
	 * Callback for text field.
	 *
	 * @since    1.0.0
	 */
	public function render_text_field() {
		$value = My_Plugin_Helpers::get_option( 'setting_text' );
		echo '<input type="text" id="setting_text" name="my_plugin_settings[setting_text]" value="' . esc_attr( $value ) . '" class="regular-text">';
	}

	/**
	 * Callback for textarea field.
	 *
	 * @since    1.0.0
	 */
	public function render_textarea_field() {
		$value = My_Plugin_Helpers::get_option( 'setting_textarea' );
		echo '<textarea id="setting_textarea" name="my_plugin_settings[setting_textarea]" rows="5" cols="50" class="large-text">' . esc_textarea( $value ) . '</textarea>';
	}

	/**
	 * Callback for checkbox field.
	 *
	 * @since    1.0.0
	 */
	public function render_checkbox_field() {
		$value = My_Plugin_Helpers::get_option( 'setting_checkbox' );
		echo '<input type="checkbox" id="setting_checkbox" name="my_plugin_settings[setting_checkbox]" value="1" ' . checked( '1', $value, false ) . '>';
	}

	/**
	 * Callback for select field.
	 *
	 * @since    1.0.0
	 */
	public function render_select_field() {
		$value = My_Plugin_Helpers::get_option( 'setting_select', 'default' );
		?>
		<select id="setting_select" name="my_plugin_settings[setting_select]">
			<option value="default" <?php selected( $value, 'default' ); ?>><?php esc_html_e( 'Default', 'my-plugin' ); ?></option>
			<option value="option1" <?php selected( $value, 'option1' ); ?>><?php esc_html_e( 'Option 1', 'my-plugin' ); ?></option>
			<option value="option2" <?php selected( $value, 'option2' ); ?>><?php esc_html_e( 'Option 2', 'my-plugin' ); ?></option>
		</select>
		<?php
	}

}

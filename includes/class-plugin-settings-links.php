<?php
/**
 * Register the plugin settings plugin links.
 *
 * @package Launch With Words
 */

namespace LWW\Includes;

/**
 * Add settings links to the plugin menu.
 */
class Plugin_Settings_Links {
	/**
	 * Class runner.
	 */
	public function run() {
		// Plugin settings.
		add_filter(
			'plugin_action_links_' . plugin_basename( LWW_FILE ),
			array( $this, 'add_settings_link' )
		);

		// Activation hook to redirect to import screen.
		add_action( 'activated_plugin', array( $this, 'redirect_to_import_screen' ) );
	}

	/**
	 * Add a settings link to the plugin's options.
	 *
	 * Add a settings link on the WordPress plugin's page.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @see run
	 *
	 * @param array $links Array of plugin options.
	 * @return array $links Array of plugin options
	 */
	public function add_settings_link( $links ) {
		$settings_url = admin_url( 'edit.php?page=launch-with-words' );
		if ( current_user_can( 'manage_options' ) ) {
			$options_link = sprintf( '<a href="%s">%s</a>', esc_url( $settings_url ), _x( 'Import', 'Launch With Words Import Plugins Settings Link', 'launch-with-words' ) );
			array_unshift( $links, $options_link );
		}

		return $links;
	}

	/**
	 * Redirects user to import screen after Launch with Words is activated.
	 *
	 * Redirect user to import screen.
	 *
	 * @since 1.0.7
	 * @access public
	 */
	public static function redirect_to_import_screen() {
		if ( is_admin() && plugin_basename( LWW_FILE ) === get_option( 'launch-with-words-activate' ) ) {
			$settings_url = admin_url( 'edit.php?page=launch-with-words' );
			delete_option( 'launch-with-words-activate' );
			wp_safe_redirect( $settings_url );
			exit;
		}
	}

	/**
	 * Set an option upon activation so we can retrieve it later.
	 */
	public static function plugin_activate() {
		add_option( 'launch-with-words-activate', plugin_basename( LWW_FILE ) );
	}
}

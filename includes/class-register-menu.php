<?php
/**
 * Register the sub-menus needed for this plugin.
 *
 * @package Launch With Words
 */

namespace LWW\Includes;

use LWW\Includes\Settings_Page as Settings_Page;
use LWW\Includes\Functions as Functions;

/**
 * Plugin sub-menus and helper methods.
 */
class Register_Menu {

	/**
	 * Class runner.
	 */
	public function run() {
		add_action( 'admin_menu', array( $this, 'register_import_menu' ) );
		add_action( 'admin_init', array( $this, 'maybe_redirect_posts_page' ) );
	}

	/**
	 * Redirects settings page to the post settings page.
	 */
	public function maybe_redirect_posts_page() {
		if ( isset( $_GET['page'] ) && 'launch-with-words-options' === $_GET['page'] ) {
			wp_safe_redirect( esc_url( Functions::get_settings_url() ) );
			exit;
		}
	}

	/**
	 * Register the import menu.
	 */
	public function register_import_menu() {

		add_posts_page(
			__( 'Launch With Words', 'launch-with-words' ),
			__( 'Launch With Words', 'launch-with-words' ),
			'manage_options',
			'launch-with-words',
			array( '\LWW\Includes\Settings_Page', 'settings_page' ),
			100
		);

		add_options_page(
			__( 'Launch With Words', 'launch-with-words' ),
			__( 'Launch With Words', 'launch-with-words' ),
			'manage_options',
			'launch-with-words-options',
			array( $this, 'output' ),
			100
		);
	}

	/**
	 * Create empty output page for Launch With Words Settings page.
	 */
	public function output() {
		// Empty.
	}
}

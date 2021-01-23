<?php
/**
 * Register the sub-menus needed for this plugin.
 *
 * @package Launch With Words
 */

namespace LWW\Includes;

use LWW\Includes\Settings_Page as Settings_Page;

/**
 * Plugin sub-menus and helper methods.
 */
class Register_Menu {

	/**
	 * Class runner.
	 */
	public function run() {
		add_action( 'admin_menu', array( $this, 'register_import_menu' ) );
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
	}
}

<?php
/**
 * Register the sub-menus needed for this plugin.
 *
 * @package Launch With Words
 */

namespace LWW\Includes;

/**
 * Plugin sub-menus and helper methods.
 */
class Register_Sub_Menus {

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
			__( 'Import', 'launch-with-words' ),
			__( 'Import', 'launch-with-words' ),
			'manage_options',
			'launch-with-words',
			array( $this, 'import_settings' ),
			100
		);
	}

	/**
	 * Import Settings.
	 */
	public function import_settings() {
		?>
		<div class="wrap">
			Hello World
		</div>
		<?php
	}
}

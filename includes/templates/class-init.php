<?php
/**
 * Initialize all the classes for tabs and sub-tabs.
 *
 * @package Launch With Words
 */

namespace LWW\Includes\Templates;

use LWW\Includes\Functions as Functions;

/**
 * Init all the classes and sub-tabs.
 */
class Init {
	/**
	 * Class runner.
	 */
	public function run() {
		new \LWW\Includes\Templates\Home();
		new \LWW\Includes\Templates\Import();

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Register scripts and styles for the admin panel.
	 */
	public function enqueue() {
		// Make sure we enqueue on the right admin screen.
		$screen = get_current_screen();
		if ( ! isset( $screen->id ) ) {
			return;
		}
		if ( 'posts_page_launch-with-words' !== $screen->id ) {
			return;
		}

		wp_enqueue_style(
			'lww-admin',
			Functions::get_plugin_url( '/dist/admin-panel.css' ),
			array(),
			Functions::get_plugin_version(),
			'all'
		);
	}
}

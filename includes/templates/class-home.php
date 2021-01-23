<?php
/**
 * Register the Home tab and any sub-tabs.
 *
 * @package Launch With Words
 */

namespace LWW\Includes\Templates;

use LWW\Includes\Functions as Functions;

/**
 * Output the dashboard tab and content.
 */
class Home {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'lww_admin_tabs', array( $this, 'add_home_tab' ), 1, 1 );
		add_filter( 'lww_admin_sub_tabs', array( $this, 'add_home_main_sub_tab' ), 1, 3 );
		add_filter( 'lww_output_dashboard', array( $this, 'output_home_content' ), 1, 3 );
	}

	/**
	 * Add the home tab and callback actions.
	 *
	 * @param array $tabs Array of tabs.
	 *
	 * @return array of tabs.
	 */
	public function add_home_tab( $tabs ) {
		$tabs[] = array(
			'get'    => 'home',
			'action' => 'lww_output_home',
			'url'    => Functions::get_settings_url( 'home' ),
			'label'  => _x( 'Home', 'Tab label as Home', 'launch-with-words' ),
			'icon'   => 'home-heart',
		);
		return $tabs;
	}

	/**
	 * Add the home main tab and callback actions.
	 *
	 * @param array  $tabs        Array of tabs.
	 * @param string $current_tab The current tab selected.
	 * @param string $sub_tab     The current sub-tab selected.
	 *
	 * @return array of tabs.
	 */
	public function add_home_main_sub_tab( $tabs, $current_tab, $sub_tab ) {
		return $tabs;
	}

	/**
	 * Begin Home routing for the various outputs.
	 */
	public function output_home_content( $tab, $sub_tab = '' ) {
		if ( 'home' === $tab ) {
			if ( empty( $sub_tab ) || 'home' === $sub_tab ) {
				?>
				<div id="lww-dashboard-options"></div>
				<?php
				wp_enqueue_script(
					'lww-admin-dashboard',
					Functions::get_plugin_url( '/dist/admin-dashboard.js' ),
					array( 'wp-i18n' ),
					Functions::get_plugin_version(),
					true
				);
				?>
				<div id="lww-dashboard-update-options"></div>
				<?php
			}
		}
	}
}
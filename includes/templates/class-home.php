<?php
/**
 * Register the Home tab and any sub-tabs.
 *
 * @package Launch With Words
 */

namespace LWW\Includes\Templates;

use LWW\Includes\Functions as Functions;

/**
 * Output the home tab and content.
 */
class Home {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'lww_admin_tabs', array( $this, 'add_home_tab' ), 1, 1 );
		add_filter( 'lww_admin_sub_tabs', array( $this, 'add_home_main_sub_tab' ), 1, 3 );
		add_filter( 'lww_output_home', array( $this, 'output_home_content' ), 1, 3 );
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
				<div id="lww-home-options">
					<h3 class="lww-desc"><?php esc_html_e( 'Welcome to Launch With Words', 'launch-with-words' ); ?></h3>
					<h4><strong><?php esc_html_e( 'Your clients want to blog.', 'launch-with-words' ); ?> <em><?php esc_html_e( 'But they need ideas to write about.', 'launch-with-words' ); ?> <?php esc_html_e( 'Let us show you how.', 'launch-with-words' ); ?></h4>
					<iframe width="560" height="315" src="https://www.youtube.com/embed/Kusey3jDD1o" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<blockquote>
						Launch With Words is a product that combines the features of a business coach with blogging prompts to encourage you to publish once a month. Follow the prompts. Publish. Easy!
						<span>Bridget Willard</span>
					</blockquote>
				</div>
				<?php
			}
		}
	}
}

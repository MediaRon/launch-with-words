<?php
/**
 * Register the import tab and any sub-tabs.
 *
 * @package Launch With Words
 */

namespace LWW\Includes\Templates;

use LWW\Includes\Functions as Functions;

/**
 * Output the import tab and content.
 */
class Import {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'lww_admin_tabs', array( $this, 'add_import_tab' ), 1, 1 );
		add_filter( 'lww_admin_sub_tabs', array( $this, 'add_import_main_sub_tab' ), 1, 3 );
		add_filter( 'lww_output_import', array( $this, 'output_import_content' ), 1, 3 );
	}

	/**
	 * Add the imoort tab and callback actions.
	 *
	 * @param array $tabs Array of tabs.
	 *
	 * @return array of tabs.
	 */
	public function add_import_tab( $tabs ) {
		$tabs[] = array(
			'get'    => 'import',
			'action' => 'lww_output_import',
			'url'    => Functions::get_settings_url( 'import' ),
			'label'  => _x( 'Import Content Pack', 'Tab label as Import Content Pack', 'launch-with-words' ),
			'icon'   => 'file-import',
		);
		return $tabs;
	}

	/**
	 * Add the import main tab and callback actions.
	 *
	 * @param array  $tabs        Array of tabs.
	 * @param string $current_tab The current tab selected.
	 * @param string $sub_tab     The current sub-tab selected.
	 *
	 * @return array of tabs.
	 */
	public function add_import_main_sub_tab( $tabs, $current_tab, $sub_tab ) {
		return $tabs;
	}

	/**
	 * Begin Home routing for the various outputs.
	 */
	public function output_import_content( $tab, $sub_tab = '' ) {
		if ( 'import' === $tab ) {
			if ( empty( $sub_tab ) || 'import' === $sub_tab ) {
				?>
				<div id="lww-import-options">
					import
				</div>
				<?php
			}
		}
	}
}

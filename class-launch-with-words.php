<?php
/**
 * Launch with Words Importer
 *
 * @package Launch with Words
 */

namespace LWW;

/**
 * Plugin Name:       Launch With Words
 * Plugin URI:        https://bridgetwillard.com/launch-with-words/
 * Description:       Launch With Words installs a year's worth of blog post prompts to encourage and guide your client in blogging best practices -- not lorem ipsum or bacon ipsum or other placeholder text.
 * Version:           1.0.2
 * Requires at least: 5.6
 * Requires PHP:      7.0
 * Author:            MediaRon LLC
 * Author URI:        https://mediaron.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       launch-with-words
 * Domain Path:       /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Setup the plugin auto loader.
require_once 'autoloader.php';

define( 'LWW_FILE', __FILE__ );
define( 'LWW_VERSION', '1.0.2' );

/**
 * The plugin base class.
 */
class Launch_With_Words {

	/**
	 * Launch With Words instance.
	 *
	 * @var Launch_With_Words $instance
	 */
	private static $instance = null;

	/**
	 * Return a class instance.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Class Constructor
	 */
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ), 20 );
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Fired when the init action for WordPress is triggered.
	 */
	public function init() {
		load_plugin_textdomain(
			'launch-with-words',
			false,
			dirname( plugin_basename( LWW_FILE ) ) . '/languages/'
		);
	}

	/**
	 * Fired when the plugins for WordPress have finished loading.
	 */
	public function plugins_loaded() {

		// Register import menu.
		$this->import_menu = new \LWW\Includes\Register_Menu();
		$this->import_menu->run();

		// Register plugin settings.
		$this->plugin_settings = new \LWW\Includes\Plugin_Settings_Links();
		$this->plugin_settings->run();

		// Tabs initializer.
		$this->tabs = new \LWW\Includes\Templates\Init();
		$this->tabs->run();
	}
}

Launch_With_Words::get_instance();

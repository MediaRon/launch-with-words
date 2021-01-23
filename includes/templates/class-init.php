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
	}
}

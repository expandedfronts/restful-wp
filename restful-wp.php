<?php
/**
 * A REST API for WordPress.
 *
 * A plugin developed as an alternative to the official WordPress API.
 *
 * Plugin Name:       RESTful WP
 * Plugin URI:        https://expandedfronts.com
 * Description:       A REST API for WordPress.
 * Version:           0.1
 * Author:            Expanded Fronts, LLC
 * Author URI:        http://expandedfronts.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       restful-wp
 * Domain Path:       /languages
 * Network: 		  true
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * The main RESTful WP class. Initializes the plugin and loads any
 * required hooks and dependencies.
 *
 * @since 1.0
 */
final class RESTful_WP {

	/**
	 * Stores the current instance of RESTful WP.
	 * @var RESTful_WP
	 */
	private static $instance;

	public static $zend_instance;

	/**
	 * Stores an array of user options and preferences.
	 * @var array
	 */
	public $options;

	/**
	 * Empty construct, use revisr() instead.
	 * @access private
	 */
	private function __construct() {
		// Do nothing here.
	}

	/**
	 * Prevent direct __clones by making the method private.
	 * @access private
	 */
	private function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'revisr'), '1.8' );
	}

	/**
	 * Prevent direct unserialization by making the method private.
	 * @access private
	 */
	private function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'revisr'), '1.8' );
	}

	/**
	 * Returns an instance of RESTful WP,
	 * creating one if it doesn't already exist.
	 *
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {

			// Create a new instance.
			self::$instance = new self;
			//self::$instance->options = self::$instance->get_options();

			// Define any constants.
			self::$instance->define_constants();

			// Load the rest of the instance.
			add_action( 'plugins_loaded', array( __CLASS__, 'load_instance' ) );

		}

		return self::$instance;
	}

	/**
	 * Defines the constants used by RESTful WP.
	 * @access private
	 */
	private function define_constants() {

		// The base plugin file.
		define( 'RESTFULWP_FILE', __FILE__ );

		// The full path used for includes.
		define( 'RESTFULWP_PATH', plugin_dir_path( RESTFULWP_FILE ) );

		// The URL of the plugin base directory.
		define( 'RESTFULWP_URL', plugin_dir_url( RESTFULWP_FILE ) );

		// The current version of the plugin.
		define( 'RESTFULWP_VERSION', '1.0' );

	}

	/**
	 * Loads dependencies and initiates any action hooks.
	 * @access public
	 */
	public static function load_instance() {

		// Load up Zend/Apigility
		include RESTFULWP_PATH . 'vendor/autoload.php';
		$config = include RESTFULWP_PATH . 'config/application.config.php';

		// Allows for customizing the API url.
		add_filter( 'restful_wp_api_url', array( __CLASS__, 'get_api_url' ) );


		// Only run on api pages.
		if ( strpos( $_SERVER['REQUEST_URI'], RESTful_WP::get_api_url() ) !== false ) {

			// Run the application!
			self::$zend_instance = Zend\Mvc\Application::init( $config )->run();

			// Tell WordPress to beat it, maybe.
			if ( defined( 'WP_SHOULD_EXIT') && WP_SHOULD_EXIT ) {
				exit;
			}

		}

		// Load any admin-side hooks.
		if ( current_user_can( 'install_plugins' ) && is_admin() ) {
			// None yet!
		}
	}

	public static function get_api_url() {
		return 'restful-wp';
	}


}

/**
 * Returns an instance of the RESTful WP instance.
 * @access public
 * @return object
 */
function restful_wp() {
	return RESTful_WP::get_instance();
}

// Let's go!
restful_wp();

<?php
/**
 * Plugin Name:       WP-Admin Theme Customisations
 * Description:       Clean plugin for WordPress theme customisations storage
 * Plugin URI:        https://github.com/wpadmin/wp-admin-theme-customisations
 * Version:           1.1.0
 * Author:            Zhenya Sh.
 * Author URI:        https://github.com/wpadmin
 * Requires at least: 6.0.0
 * Tested up to:      6.7
 * Requires PHP:      7.4
 * Text Domain:       zhsh-theme-customisations
 *
 * @package ZHSH\ThemeCustomisations
 */

namespace ZHSH\ThemeCustomisations;

// Direct access protection.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plugin constants.
if ( ! defined( 'ZHSH_TC_FILE' ) ) {
	define( 'ZHSH_TC_FILE', __FILE__ );
}

if ( ! defined( 'ZHSH_TC_PATH' ) ) {
	define( 'ZHSH_TC_PATH', plugin_dir_path( ZHSH_TC_FILE ) );
}

if ( ! defined( 'ZHSH_TC_URL' ) ) {
	define( 'ZHSH_TC_URL', plugin_dir_url( ZHSH_TC_FILE ) );
}

if ( ! defined( 'ZHSH_TC_VERSION' ) ) {
	define( 'ZHSH_TC_VERSION', '1.1.0' );
}

/**
 * Main plugin class
 *
 * @since 1.0.0
 * @package ZHSH\ThemeCustomisations
 */
final class Plugin
{

	/**
	 * Single instance
	 *
	 * @var Plugin|null
	 */
	protected static $instance = null;

	/**
	 * Get single instance
	 *
	 * @return Plugin
	 */
	public static function instance()
	{
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct()
	{
		add_action( 'plugins_loaded', array( $this, 'init' ), 0 );
	}

	/**
	 * Initialize plugin
	 */
	public function init()
	{
		load_plugin_textdomain(
			'zhsh-theme-customisations',
			false,
			dirname( plugin_basename( ZHSH_TC_FILE ) ) . '/languages'
		);

		$this->_setup_hooks();
		$this->_include_files();
	}

	/**
	 * Include required files
	 */
	private function _include_files()
	{
		$functions_file = ZHSH_TC_PATH . 'custom/functions.php';
		if ( file_exists( $functions_file ) ) {
			require_once $functions_file;
		}
	}

	/**
	 * Setup WordPress hooks
	 */
	private function _setup_hooks()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 999 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_jquery_scripts' ) );

		add_filter( 'template_include', array( $this, 'override_template' ), 11 );
		add_filter( 'wc_get_template', array( $this, 'override_wc_template' ), 11, 5 );
	}

	/**
	 * Enqueue custom CSS styles
	 */
	public function enqueue_styles()
	{
		$style_path = ZHSH_TC_PATH . 'assets/css/style.css';
		$style_url  = ZHSH_TC_URL . 'assets/css/style.css';

		if ( file_exists( $style_path ) ) {
			wp_enqueue_style(
				'zhsh-theme-customisations-css',
				$style_url,
				array(),
				filemtime( $style_path )
			);
		}
	}

	/**
	 * Enqueue custom JavaScript
	 */
	public function enqueue_scripts()
	{
		$script_path = ZHSH_TC_PATH . 'assets/js/custom.js';
		$script_url  = ZHSH_TC_URL . 'assets/js/custom.js';

		if ( file_exists( $script_path ) ) {
			wp_enqueue_script(
				'zhsh-theme-customisations-js',
				$script_url,
				array(),
				filemtime( $script_path ),
				array( 'strategy' => 'defer' )
			);
		}
	}

	/**
	 * Enqueue jQuery-dependent scripts
	 */
	public function enqueue_jquery_scripts()
	{
		$jquery_script_path = ZHSH_TC_PATH . 'assets/js/jquery-custom.js';
		$jquery_script_url  = ZHSH_TC_URL . 'assets/js/jquery-custom.js';

		if ( file_exists( $jquery_script_path ) ) {
			wp_enqueue_script(
				'zhsh-theme-customisations-jquery-js',
				$jquery_script_url,
				array( 'jquery' ),
				filemtime( $jquery_script_path ),
				array( 'strategy' => 'defer' )
			);
		}
	}

	/**
	 * Override WordPress templates
	 *
	 * @param string $template Template path.
	 * @return string Modified template path.
	 */
	public function override_template( $template )
	{
		$custom_template = ZHSH_TC_PATH . 'custom/templates/' . basename( $template );

		if ( file_exists( $custom_template ) ) {
			return $custom_template;
		}

		return $template;
	}

	/**
	 * Override WooCommerce templates
	 *
	 * @param string $located       Current template path.
	 * @param string $template_name Template name.
	 * @param array  $args          Template arguments.
	 * @param string $template_path Template path.
	 * @param string $default_path  Default template path.
	 * @return string Modified template path.
	 */
	public function override_wc_template(
		$located,
		$template_name,
		$args,
		$template_path,
		$default_path
	) {
		$plugin_template_path = ZHSH_TC_PATH . 'custom/templates/woocommerce/' . $template_name;

		if ( file_exists( $plugin_template_path ) ) {
			return $plugin_template_path;
		}

		return $located;
	}
}

/**
 * Get plugin instance
 *
 * @return Plugin
 */
function ZHSH_Theme_Customisations()
{
	return Plugin::instance();
}

// Initialize plugin.
ZHSH_Theme_Customisations();

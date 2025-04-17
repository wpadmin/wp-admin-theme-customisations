<?php
/**
 * Plugin Name:       WP-Admin Theme Customisations
 * Description:       Удобный плагин для хранения кастомизаций темы WordPress
 * Plugin URI:        https://github.com/wpadmin/wp-admin-theme-customisations
 * Version:           1.1.0
 * Author:            WPAdmin
 * Author URI:        https://github.com/wpadmin
 * Requires at least: 4.0.0
 * Tested up to:      6.4.3
 * Text Domain:       wp-admin-theme-customisations
 * Domain Path:       /languages
 * 
 * @package WP_Admin_Theme_Customisations
 */

// Запрет прямого доступа к файлу для повышения безопасности
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Выход, если к файлу обращаются напрямую
}

// Определение констант плагина для удобного использования путей
if ( ! defined( 'WP_ADMIN_TC_FILE' ) ) {
	define( 'WP_ADMIN_TC_FILE', __FILE__ );
}

if ( ! defined( 'WP_ADMIN_TC_PATH' ) ) {
	define( 'WP_ADMIN_TC_PATH', plugin_dir_path( WP_ADMIN_TC_FILE ) );
}

if ( ! defined( 'WP_ADMIN_TC_URL' ) ) {
	define( 'WP_ADMIN_TC_URL', plugin_dir_url( WP_ADMIN_TC_FILE ) );
}

if ( ! defined( 'WP_ADMIN_TC_VERSION' ) ) {
	define( 'WP_ADMIN_TC_VERSION', '1.1.0' );
}

/**
 * Основной класс плагина WP_Admin_Theme_Customisations
 *
 * @class WP_Admin_Theme_Customisations
 * @version 1.1.0
 * @since 1.0.0
 * @package WP_Admin_Theme_Customisations
 */
final class WP_Admin_Theme_Customisations {
	
	/**
	 * Единственный экземпляр класса (паттерн Одиночка/Singleton)
	 *
	 * @var WP_Admin_Theme_Customisations
	 * @since 1.1.0
	 */
	protected static $_instance = null;

	/**
	 * Возвращает единственный экземпляр класса
	 *
	 * @since 1.1.0
	 * @return WP_Admin_Theme_Customisations Экземпляр класса
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Конструктор класса
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Инициализация плагина на ранней стадии загрузки WordPress
		add_action( 'plugins_loaded', array( $this, 'init' ), 0 );
	}

	/**
	 * Инициализация плагина
	 *
	 * @since 1.1.0
	 */
	public function init() {
		// Загрузка текстового домена для переводов
		load_plugin_textdomain( 'wp-admin-theme-customisations', false, dirname( plugin_basename( WP_ADMIN_TC_FILE ) ) . '/languages' );
		
		// Настройка хуков и подключение файлов
		$this->setup_hooks();
		$this->include_files();
	}
	
	/**
	 * Подключение необходимых файлов
	 *
	 * @since 1.1.0
	 */
	private function include_files() {
		// Подключение пользовательских функций из отдельного файла
		$functions_file = WP_ADMIN_TC_PATH . 'custom/functions.php';
		if ( file_exists( $functions_file ) ) {
			require_once( $functions_file );
		}
	}

	/**
	 * Настройка хуков WordPress
	 *
	 * @since 1.1.0
	 */
	private function setup_hooks() {
		// Подключение CSS стилей и JS скриптов
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 999 );  // Высокий приоритет для перезаписи стилей темы
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_jquery_scripts' ) );
		
		// Фильтры для перезаписи шаблонов
		add_filter( 'template_include', array( $this, 'override_template' ), 11 );
		add_filter( 'wc_get_template', array( $this, 'override_wc_template' ), 11, 5 );
	}

	/**
	 * Подключение кастомных CSS стилей
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		$style_path = WP_ADMIN_TC_PATH . 'assets/css/style.css';
		$style_url = WP_ADMIN_TC_URL . 'assets/css/style.css';
		
		// Проверка существования файла стилей перед подключением
		if ( file_exists( $style_path ) ) {
			wp_enqueue_style( 
				'wp-admin-theme-customisations-css', 
				$style_url, 
				array(), 
				filemtime( $style_path ) // Версия файла на основе времени модификации для кэширования
			);
		}
	}

	/**
	 * Подключение обычных JavaScript файлов
	 *
	 * @since 1.1.0
	 */
	public function enqueue_scripts() {
		$script_path = WP_ADMIN_TC_PATH . 'assets/js/custom.js';
		$script_url = WP_ADMIN_TC_URL . 'assets/js/custom.js';
		
		// Проверка существования скрипта перед подключением
		if ( file_exists( $script_path ) ) {
			wp_enqueue_script( 
				'wp-admin-theme-customisations-js', 
				$script_url, 
				array(), // Этот скрипт не зависит от jQuery
				filemtime( $script_path ), // Версия файла на основе времени модификации
				true // Подключение в футере для лучшей производительности
			);
		}
	}

	/**
	 * Подключение jQuery-зависимых скриптов
	 *
	 * @since 1.1.0
	 */
	public function enqueue_jquery_scripts() {
		$jquery_script_path = WP_ADMIN_TC_PATH . 'assets/js/jquery-custom.js';
		$jquery_script_url = WP_ADMIN_TC_URL . 'assets/js/jquery-custom.js';
		
		// Проверка существования jQuery скрипта перед подключением
		if ( file_exists( $jquery_script_path ) ) {
			wp_enqueue_script( 
				'wp-admin-theme-customisations-jquery-js', 
				$jquery_script_url, 
				array( 'jquery' ), // Этот скрипт зависит от jQuery
				filemtime( $jquery_script_path ), // Версия файла на основе времени модификации
				true // Подключение в футере для лучшей производительности
			);
		}
	}

	/**
	 * Переопределение шаблонов WordPress
	 *
	 * Используется для подключения пользовательских шаблонов верхнего уровня
	 * (например, single.php, page.php и т.д.)
	 *
	 * @param string $template Путь к шаблону WordPress
	 * @return string Измененный путь к шаблону
	 * @since 1.0.0
	 */
	public function override_template( $template ) {
		$custom_template = WP_ADMIN_TC_PATH . 'custom/templates/' . basename( $template );
		
		// Если существует пользовательский шаблон, используем его
		if ( file_exists( $custom_template ) ) {
			return $custom_template;
		}
		
		return $template;
	}

	/**
	 * Переопределение шаблонов WooCommerce
	 *
	 * Позволяет переопределять шаблоны WooCommerce через плагин
	 * Путь к шаблону: custom/templates/woocommerce/[шаблон]
	 *
	 * @param string $located Текущий путь к файлу шаблона
	 * @param string $template_name Имя шаблона (например, cart/cart.php)
	 * @param array $args Аргументы, переданные в шаблон
	 * @param string $template_path Путь к шаблону
	 * @param string $default_path Путь к шаблону по умолчанию
	 * @return string Новый путь к файлу шаблона
	 * @since 1.0.0
	 */
	public function override_wc_template( $located, $template_name, $args, $template_path, $default_path ) {
		$plugin_template_path = WP_ADMIN_TC_PATH . 'custom/templates/woocommerce/' . $template_name;
		
		// Если пользовательский шаблон существует, используем его
		if ( file_exists( $plugin_template_path ) ) {
			return $plugin_template_path;
		}
		
		return $located;
	}
} // Конец класса

// Функция для глобального доступа к экземпляру плагина
function WP_Admin_Theme_Customisations() {
	return WP_Admin_Theme_Customisations::instance();
}

// Инициализация плагина
WP_Admin_Theme_Customisations();

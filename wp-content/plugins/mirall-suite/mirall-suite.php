<?php
/**
 * Plugin Name: Mirall Suite
 * Plugin URI: https://mirall-beauty-preview.raze-bitcoin.chatgpt.site
 * Description: رزرو آنلاین، ورود پیامکی، پنل کاربری، فاکتور، پیامک، پشتیبانی و ویجت‌های Elementor برای Mirall Beauty.
 * Version: 1.2.0
 * Requires at least: 6.4
 * Requires PHP: 8.0
 * Author: Hassan Mojtahedi - حسن مجتهدی
 * Text Domain: mirall-suite
 * License: GPL-2.0-or-later
 */

defined( 'ABSPATH' ) || exit;

define( 'MIRALL_SUITE_VERSION', '1.2.0' );
define( 'MIRALL_SUITE_FILE', __FILE__ );
define( 'MIRALL_SUITE_DIR', plugin_dir_path( __FILE__ ) );
define( 'MIRALL_SUITE_URL', plugin_dir_url( __FILE__ ) );

require_once MIRALL_SUITE_DIR . 'includes/class-database.php';
require_once MIRALL_SUITE_DIR . 'includes/class-post-types.php';
require_once MIRALL_SUITE_DIR . 'includes/class-sms.php';
require_once MIRALL_SUITE_DIR . 'includes/class-auth.php';
require_once MIRALL_SUITE_DIR . 'includes/class-booking.php';
require_once MIRALL_SUITE_DIR . 'includes/class-admin.php';
require_once MIRALL_SUITE_DIR . 'includes/class-shortcodes.php';
require_once MIRALL_SUITE_DIR . 'includes/class-demo-installer.php';

final class Mirall_Suite {
	private static ?Mirall_Suite $instance = null;
	public static function instance(): Mirall_Suite {
		return self::$instance ??= new self();
	}
	private function __construct() {
		add_action( 'plugins_loaded', array( $this, 'load' ) );
	}
	public function load(): void {
		load_plugin_textdomain( 'mirall-suite', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		Mirall_Post_Types::init();
		Mirall_SMS::init();
		Mirall_Auth::init();
		Mirall_Booking::init();
		Mirall_Admin::init();
		Mirall_Shortcodes::init();
		Mirall_Demo_Installer::init();
		if ( class_exists( '\\Elementor\\Widget_Base' ) ) {
			require_once MIRALL_SUITE_DIR . 'includes/class-elementor.php';
			Mirall_Elementor::init();
		}
		add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
	}
	public function assets(): void {
		wp_enqueue_style( 'mirall-suite', MIRALL_SUITE_URL . 'assets/css/front.css', array(), MIRALL_SUITE_VERSION );
		wp_enqueue_script( 'mirall-suite', MIRALL_SUITE_URL . 'assets/js/front.js', array(), MIRALL_SUITE_VERSION, true );
		wp_localize_script( 'mirall-suite', 'MirallSuite', array( 'ajaxUrl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'mirall_public' ), 'loggedIn' => is_user_logged_in() ) );
	}
}

register_activation_hook( __FILE__, array( 'Mirall_Database', 'activate' ) );
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
Mirall_Suite::instance();

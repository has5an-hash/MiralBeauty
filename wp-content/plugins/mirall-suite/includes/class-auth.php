<?php
defined( 'ABSPATH' ) || exit;

final class Mirall_Auth {
	public static function init(): void {
		foreach ( array( 'send_otp', 'verify_otp' ) as $action ) {
			add_action( 'wp_ajax_nopriv_mirall_' . $action, array( __CLASS__, $action ) );
			add_action( 'wp_ajax_mirall_' . $action, array( __CLASS__, $action ) );
		}
	}
	private static function mobile(): string {
		$mobile = isset( $_POST['mobile'] ) ? preg_replace( '/[^0-9]/', '', wp_unslash( $_POST['mobile'] ) ) : '';
		if ( str_starts_with( $mobile, '98' ) ) $mobile = '0' . substr( $mobile, 2 );
		return preg_match( '/^09\d{9}$/', $mobile ) ? $mobile : '';
	}
	private static function nonce(): void { check_ajax_referer( 'mirall_public', 'nonce' ); }
	public static function send_otp(): void {
		self::nonce(); $mobile = self::mobile();
		if ( ! $mobile ) wp_send_json_error( array( 'message' => 'شماره موبایل معتبر نیست.' ), 422 );
		$rate_key = 'mirall_otp_rate_' . md5( $mobile . ( $_SERVER['REMOTE_ADDR'] ?? '' ) );
		if ( get_transient( $rate_key ) ) wp_send_json_error( array( 'message' => 'لطفاً یک دقیقه صبر کنید.' ), 429 );
		$code = (string) random_int( 10000, 99999 );
		global $wpdb;
		$wpdb->insert( Mirall_Database::table( 'otp' ), array( 'mobile' => $mobile, 'code_hash' => wp_hash_password( $code ), 'expires_at' => gmdate( 'Y-m-d H:i:s', time() + 120 ), 'attempts' => 0, 'verified' => 0, 'created_at' => current_time( 'mysql', true ) ) );
		set_transient( $rate_key, 1, MINUTE_IN_SECONDS );
		$sent = Mirall_SMS::send( $mobile, 'کد ورود میرال: ' . $code, 'otp', array( 'token' => $code ) );
		if ( ! $sent ) wp_send_json_error( array( 'message' => 'ارسال پیامک انجام نشد؛ تنظیمات درگاه را بررسی کنید.' ), 503 );
		wp_send_json_success( array( 'message' => 'کد تأیید ارسال شد.' ) );
	}
	public static function verify_otp(): void {
		self::nonce(); $mobile = self::mobile(); $code = isset( $_POST['code'] ) ? preg_replace( '/[^0-9]/', '', wp_unslash( $_POST['code'] ) ) : '';
		if ( ! $mobile || strlen( $code ) !== 5 ) wp_send_json_error( array( 'message' => 'اطلاعات ورود معتبر نیست.' ), 422 );
		global $wpdb; $table = Mirall_Database::table( 'otp' );
		$row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE mobile=%s AND verified=0 AND expires_at >= UTC_TIMESTAMP() ORDER BY id DESC LIMIT 1", $mobile ) ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( ! $row || (int) $row->attempts >= 5 || ! wp_check_password( $code, $row->code_hash ) ) {
			if ( $row ) $wpdb->update( $table, array( 'attempts' => (int) $row->attempts + 1 ), array( 'id' => $row->id ) );
			wp_send_json_error( array( 'message' => 'کد اشتباه یا منقضی است.' ), 401 );
		}
		$wpdb->update( $table, array( 'verified' => 1 ), array( 'id' => $row->id ) );
		$user = get_users( array( 'meta_key' => 'mirall_mobile', 'meta_value' => $mobile, 'number' => 1 ) );
		if ( $user ) $user_id = $user[0]->ID; else {
			$user_id = wp_insert_user( array( 'user_login' => 'mirall_' . $mobile, 'user_pass' => wp_generate_password( 24, true ), 'user_email' => $mobile . '@mobile.local', 'display_name' => $mobile, 'role' => 'subscriber' ) );
			if ( is_wp_error( $user_id ) ) wp_send_json_error( array( 'message' => 'ایجاد حساب انجام نشد.' ), 500 );
			update_user_meta( $user_id, 'mirall_mobile', $mobile );
		}
		wp_set_current_user( $user_id ); wp_set_auth_cookie( $user_id, true, is_ssl() );
		wp_send_json_success( array( 'message' => 'ورود موفق بود.', 'redirect' => get_permalink( (int) get_option( 'mirall_account_page' ) ) ?: home_url( '/account/' ) ) );
	}
}

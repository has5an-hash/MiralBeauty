<?php
defined( 'ABSPATH' ) || exit;

final class Mirall_SMS {
	public static function init(): void { add_action( 'mirall_booking_status_changed', array( __CLASS__, 'booking_status' ), 10, 2 ); }
	public static function send( string $mobile, string $message, string $event = 'general', array $tokens = array() ): bool {
		$settings = get_option( 'mirall_settings', array() );
		$provider = sanitize_key( $settings['sms_provider'] ?? 'none' );
		$mobile = preg_replace( '/[^0-9]/', '', $mobile );
		if ( str_starts_with( $mobile, '98' ) ) $mobile = '0' . substr( $mobile, 2 );
		$success = false; $response_body = '';
		if ( 'none' !== $provider ) {
			$response = self::request( $provider, $mobile, $message, $tokens, $settings );
			if ( ! is_wp_error( $response ) ) { $code = wp_remote_retrieve_response_code( $response ); $response_body = wp_remote_retrieve_body( $response ); $success = $code >= 200 && $code < 300; } else { $response_body = $response->get_error_message(); }
		}
		global $wpdb;
		$wpdb->insert( Mirall_Database::table( 'sms_logs' ), array( 'mobile' => $mobile, 'event' => $event, 'provider' => $provider, 'status' => $success ? 'sent' : ( 'none' === $provider ? 'disabled' : 'failed' ), 'response' => wp_json_encode( array( 'body' => mb_substr( $response_body, 0, 1000 ) ) ), 'created_at' => current_time( 'mysql' ) ), array( '%s', '%s', '%s', '%s', '%s', '%s' ) );
		return $success;
	}
	private static function request( string $provider, string $mobile, string $message, array $tokens, array $s ) {
		$key = trim( (string) ( $s['sms_api_key'] ?? '' ) );
		$sender = trim( (string) ( $s['sms_sender'] ?? '' ) );
		if ( 'webhook' === $provider ) return wp_remote_post( esc_url_raw( $s['sms_webhook'] ?? '' ), array( 'timeout' => 15, 'headers' => array( 'Content-Type' => 'application/json', 'Authorization' => $key ? 'Bearer ' . $key : '' ), 'body' => wp_json_encode( array( 'mobile' => $mobile, 'message' => $message, 'tokens' => $tokens ) ) ) );
		if ( 'kavenegar' === $provider && ! empty( $tokens['token'] ) && ! empty( $s['sms_pattern'] ) ) return wp_remote_get( add_query_arg( array( 'receptor' => $mobile, 'token' => rawurlencode( $tokens['token'] ), 'template' => $s['sms_pattern'] ), 'https://api.kavenegar.com/v1/' . rawurlencode( $key ) . '/verify/lookup.json' ), array( 'timeout' => 15 ) );
		if ( 'kavenegar' === $provider ) return wp_remote_post( 'https://api.kavenegar.com/v1/' . rawurlencode( $key ) . '/sms/send.json', array( 'timeout' => 15, 'body' => array( 'receptor' => $mobile, 'sender' => $sender, 'message' => $message ) ) );
		if ( 'smsir' === $provider ) return wp_remote_post( 'https://api.sms.ir/v1/send/bulk', array( 'timeout' => 15, 'headers' => array( 'Content-Type' => 'application/json', 'X-API-KEY' => $key ), 'body' => wp_json_encode( array( 'lineNumber' => (int) $sender, 'messageText' => $message, 'mobiles' => array( $mobile ) ) ) ) );
		if ( 'melipayamak' === $provider ) return wp_remote_post( 'https://rest.payamak-panel.com/api/SendSMS/SendSMS', array( 'timeout' => 15, 'headers' => array( 'Content-Type' => 'application/json' ), 'body' => wp_json_encode( array( 'username' => $s['sms_username'] ?? '', 'password' => $key, 'to' => $mobile, 'from' => $sender, 'text' => $message, 'isFlash' => false ) ) ) );
		return new WP_Error( 'unsupported_provider', 'درگاه پیامکی پشتیبانی نمی‌شود.' );
	}
	public static function booking_status( array $booking, string $status ): void {
		$labels = array( 'pending' => 'در انتظار بررسی', 'confirmed' => 'تأیید شد', 'completed' => 'انجام شد', 'cancelled' => 'لغو شد' );
		$message = sprintf( 'میرال: وضعیت نوبت %s شما: %s', $booking['tracking_code'] ?? '', $labels[ $status ] ?? $status );
		self::send( $booking['mobile'] ?? '', $message, 'booking_' . $status, array( 'token' => $booking['tracking_code'] ?? '' ) );
	}
}


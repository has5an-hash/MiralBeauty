<?php
defined( 'ABSPATH' ) || exit;

final class Mirall_Database {
	public static function table( string $name ): string {
		global $wpdb;
		return $wpdb->prefix . 'mirall_' . $name;
	}
	public static function activate(): void {
		global $wpdb;
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$charset = $wpdb->get_charset_collate();
		$queries = array(
			"CREATE TABLE " . self::table( 'bookings' ) . " (
				id bigint unsigned NOT NULL AUTO_INCREMENT,
				tracking_code varchar(32) NOT NULL,
				user_id bigint unsigned NOT NULL DEFAULT 0,
				customer_name varchar(190) NOT NULL,
				mobile varchar(20) NOT NULL,
				service_id bigint unsigned NOT NULL DEFAULT 0,
				model_id bigint unsigned NOT NULL DEFAULT 0,
				staff_id bigint unsigned NOT NULL DEFAULT 0,
				appointment_date date NOT NULL,
				appointment_time varchar(20) NOT NULL,
				status varchar(30) NOT NULL DEFAULT 'pending',
				amount decimal(18,0) NOT NULL DEFAULT 0,
				payment_status varchar(30) NOT NULL DEFAULT 'unpaid',
				payment_ref varchar(100) NOT NULL DEFAULT '',
				note text NULL,
				created_at datetime NOT NULL,
				updated_at datetime NOT NULL,
				PRIMARY KEY (id), UNIQUE KEY tracking_code (tracking_code), KEY mobile (mobile), KEY appointment (appointment_date,appointment_time), KEY user_id (user_id)
			) $charset;",
			"CREATE TABLE " . self::table( 'otp' ) . " (
				id bigint unsigned NOT NULL AUTO_INCREMENT,
				mobile varchar(20) NOT NULL,
				code_hash varchar(255) NOT NULL,
				expires_at datetime NOT NULL,
				attempts tinyint unsigned NOT NULL DEFAULT 0,
				verified tinyint(1) NOT NULL DEFAULT 0,
				created_at datetime NOT NULL,
				PRIMARY KEY (id), KEY mobile (mobile), KEY expires_at (expires_at)
			) $charset;",
			"CREATE TABLE " . self::table( 'sms_logs' ) . " (
				id bigint unsigned NOT NULL AUTO_INCREMENT,
				mobile varchar(20) NOT NULL,
				event varchar(50) NOT NULL,
				provider varchar(50) NOT NULL,
				status varchar(30) NOT NULL,
				response longtext NULL,
				created_at datetime NOT NULL,
				PRIMARY KEY (id), KEY mobile (mobile), KEY event (event)
			) $charset;",
			"CREATE TABLE " . self::table( 'tickets' ) . " (
				id bigint unsigned NOT NULL AUTO_INCREMENT,
				thread_token varchar(64) NOT NULL,
				user_id bigint unsigned NOT NULL DEFAULT 0,
				name varchar(190) NOT NULL,
				mobile varchar(20) NOT NULL,
				message text NOT NULL,
				reply text NULL,
				status varchar(30) NOT NULL DEFAULT 'new',
				created_at datetime NOT NULL,
				replied_at datetime NULL,
				PRIMARY KEY (id), UNIQUE KEY thread_token (thread_token), KEY status (status), KEY mobile (mobile)
			) $charset;",
		);
		foreach ( $queries as $query ) {
			dbDelta( $query );
		}
		update_option( 'mirall_suite_version', MIRALL_SUITE_VERSION );
		self::seed_content();
		flush_rewrite_rules();
	}
	private static function seed_content(): void {
		if ( get_option( 'mirall_seeded' ) ) return;
		Mirall_Post_Types::register();
		$services = array(
			array( 'رنگ و لایت', 'بالیاژ، آمبره، هایلایت، اصلاح رنگ و انتخاب تناژ متناسب با پوست و سلامت مو.', 180, 0 ),
			array( 'میکاپ و عروس', 'طراحی چهره، میکاپ لایت و مراسم و مشاوره تخصصی عروس.', 120, 0 ),
			array( 'خدمات ناخن', 'کاشت، ژل، لمینت، ترمیم و طراحی ظریف ناخن.', 90, 0 ),
			array( 'مو و ابرو', 'هیرکات، براشینگ، لیفت و اصلاح ابرو و میکروبلیدینگ.', 75, 0 ),
		);
		foreach ( $services as $index => $service ) {
			$id = wp_insert_post( array( 'post_type' => 'mirall_service', 'post_status' => 'publish', 'post_title' => $service[0], 'post_content' => $service[1], 'menu_order' => $index ) );
			if ( ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_mirall_duration', $service[2] );
				update_post_meta( $id, '_mirall_price', $service[3] );
				update_post_meta( $id, '_mirall_capacity', 1 );
			}
		}
		if ( ! get_option( 'mirall_settings' ) ) update_option( 'mirall_settings', array( 'sms_provider' => 'none', 'booking_start' => '10:00', 'booking_end' => '20:00', 'slot_minutes' => '120', 'whatsapp' => '989125707416', 'telegram' => '', 'support_online' => '0' ) );
		update_option( 'mirall_seeded', 1 );
	}
}

<?php
defined( 'ABSPATH' ) || exit;

final class Mirall_Admin {
	public static function init(): void {
		add_action( 'admin_menu', array( __CLASS__, 'menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'settings' ) );
		add_action( 'admin_post_mirall_booking_status', array( __CLASS__, 'booking_status' ) );
		add_action( 'admin_post_mirall_ticket_reply', array( __CLASS__, 'ticket_reply' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'assets' ) );
	}
	public static function assets( string $hook ): void { if ( str_contains( $hook, 'mirall' ) ) wp_enqueue_style( 'mirall-admin', MIRALL_SUITE_URL . 'assets/css/admin.css', array(), MIRALL_SUITE_VERSION ); }
	public static function menu(): void {
		add_menu_page( 'مرکز میرال', 'مرکز میرال', 'manage_options', 'mirall-dashboard', array( __CLASS__, 'dashboard' ), 'dashicons-heart', 3 );
		add_submenu_page( 'mirall-dashboard', 'نوبت‌ها', 'نوبت‌ها', 'manage_options', 'mirall-bookings', array( __CLASS__, 'bookings' ) );
		add_submenu_page( 'mirall-dashboard', 'پیام‌های پشتیبانی', 'پیام‌های پشتیبانی', 'manage_options', 'mirall-tickets', array( __CLASS__, 'tickets' ) );
		add_submenu_page( 'mirall-dashboard', 'تنظیمات میرال', 'تنظیمات', 'manage_options', 'mirall-settings', array( __CLASS__, 'settings_page' ) );
	}
	public static function settings(): void {
		register_setting( 'mirall_settings', 'mirall_settings', array( 'sanitize_callback' => array( __CLASS__, 'sanitize' ) ) );
	}
	public static function sanitize( array $input ): array {
		$out = array();
		foreach ( array( 'sms_provider', 'sms_api_key', 'sms_sender', 'sms_username', 'sms_pattern', 'sms_webhook', 'booking_start', 'booking_end', 'slot_minutes', 'whatsapp', 'telegram', 'support_online' ) as $key ) $out[ $key ] = sanitize_text_field( $input[ $key ] ?? '' );
		return $out;
	}
	private static function count( string $table, string $where = '1=1' ): int { global $wpdb; return (int) $wpdb->get_var( "SELECT COUNT(*) FROM " . Mirall_Database::table( $table ) . " WHERE {$where}" ); } // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
	public static function dashboard(): void {
		global $wpdb; $bookings = Mirall_Database::table( 'bookings' );
		$revenue = (float) $wpdb->get_var( "SELECT SUM(amount) FROM {$bookings} WHERE payment_status='paid'" ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		echo '<div class="wrap mirall-admin"><h1>مرکز مدیریت میرال</h1><p>رزرو، مشتری، پیامک و محتوای سایت در یک نگاه.</p><div class="mirall-stats">';
		foreach ( array( 'نوبت‌های امروز' => self::count( 'bookings', "appointment_date=CURDATE()" ), 'در انتظار تأیید' => self::count( 'bookings', "status='pending'" ), 'پیام‌های جدید' => self::count( 'tickets', "status='new'" ), 'درآمد ثبت‌شده' => number_format_i18n( $revenue ) . ' تومان' ) as $label => $value ) printf( '<div><small>%1$s</small><strong>%2$s</strong></div>', esc_html( $label ), esc_html( (string) $value ) );
		echo '</div><div class="mirall-admin-grid"><section><h2>راه‌اندازی سریع</h2><ol><li>اطلاعات تماس و رنگ‌ها را در «نمایش ← سفارشی‌سازی» تنظیم کنید.</li><li>خدمات، مدل‌ها و متخصصان را اضافه کنید.</li><li>درگاه پیامکی را در تنظیمات میرال فعال کنید.</li><li>صفحه حساب کاربری را با شورتکد <code>[mirall_account]</code> بسازید.</li></ol></section><section><h2>وضعیت سیستم</h2><p>نسخه افزونه: ' . esc_html( MIRALL_SUITE_VERSION ) . '</p><p>پیامک: ' . esc_html( get_option( 'mirall_settings', array() )['sms_provider'] ?? 'غیرفعال' ) . '</p><p>ورود موبایلی: فعال</p></section></div></div>';
	}
	public static function bookings(): void {
		global $wpdb; $rows = $wpdb->get_results( 'SELECT * FROM ' . Mirall_Database::table( 'bookings' ) . ' ORDER BY created_at DESC LIMIT 200', ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		echo '<div class="wrap mirall-admin"><h1>نوبت‌ها</h1><table class="widefat striped"><thead><tr><th>پیگیری</th><th>مشتری</th><th>تاریخ و زمان</th><th>وضعیت</th><th>مبلغ</th><th>عملیات</th></tr></thead><tbody>';
		foreach ( $rows as $row ) { $url = wp_nonce_url( admin_url( 'admin-post.php?action=mirall_booking_status&id=' . $row['id'] ), 'mirall_booking_status_' . $row['id'] ); printf( '<tr><td><strong>%1$s</strong></td><td>%2$s<br><a href="tel:%3$s">%3$s</a></td><td>%4$s<br>%5$s</td><td><span class="mirall-status status-%6$s">%6$s</span></td><td>%7$s</td><td><a href="%8$s&status=confirmed">تأیید</a> | <a href="%8$s&status=completed">انجام شد</a> | <a href="%8$s&status=cancelled">لغو</a></td></tr>', esc_html( $row['tracking_code'] ), esc_html( $row['customer_name'] ), esc_html( $row['mobile'] ), esc_html( $row['appointment_date'] ), esc_html( $row['appointment_time'] ), esc_attr( $row['status'] ), esc_html( number_format_i18n( $row['amount'] ) ), esc_url( $url ) ); }
		echo '</tbody></table></div>';
	}
	public static function booking_status(): void {
		if ( ! current_user_can( 'manage_options' ) ) wp_die( 'دسترسی غیرمجاز' ); $id = absint( $_GET['id'] ?? 0 ); check_admin_referer( 'mirall_booking_status_' . $id ); $status = sanitize_key( $_GET['status'] ?? '' );
		if ( ! in_array( $status, array( 'confirmed', 'completed', 'cancelled' ), true ) ) wp_die( 'وضعیت نامعتبر' ); global $wpdb; $table = Mirall_Database::table( 'bookings' ); $booking = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE id=%d", $id ), ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( $booking ) { $wpdb->update( $table, array( 'status' => $status, 'updated_at' => current_time( 'mysql' ) ), array( 'id' => $id ) ); do_action( 'mirall_booking_status_changed', $booking, $status ); }
		wp_safe_redirect( admin_url( 'admin.php?page=mirall-bookings' ) ); exit;
	}
	public static function tickets(): void {
		global $wpdb; $rows = $wpdb->get_results( 'SELECT * FROM ' . Mirall_Database::table( 'tickets' ) . ' ORDER BY created_at DESC LIMIT 200', ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		echo '<div class="wrap mirall-admin"><h1>پیام‌های پشتیبانی</h1><table class="widefat striped"><thead><tr><th>نام</th><th>موبایل</th><th>پیام</th><th>پاسخ کارشناس</th><th>زمان</th></tr></thead><tbody>';
		foreach ( $rows as $row ) {
			$action = esc_url( admin_url( 'admin-post.php' ) );
			echo '<tr><td>' . esc_html( $row['name'] ) . '</td><td><a href="tel:' . esc_attr( $row['mobile'] ) . '">' . esc_html( $row['mobile'] ) . '</a></td><td>' . nl2br( esc_html( $row['message'] ) ) . '</td><td><form method="post" action="' . $action . '"><input type="hidden" name="action" value="mirall_ticket_reply"><input type="hidden" name="id" value="' . esc_attr( $row['id'] ) . '">';
			wp_nonce_field( 'mirall_ticket_reply_' . $row['id'] );
			echo '<textarea name="reply" rows="3" required>' . esc_textarea( $row['reply'] ?? '' ) . '</textarea><button class="button button-primary">ارسال پاسخ</button></form></td><td>' . esc_html( $row['created_at'] ) . '</td></tr>';
		}
		echo '</tbody></table></div>';
	}
	public static function ticket_reply(): void {
		if ( ! current_user_can( 'manage_options' ) ) wp_die( 'دسترسی غیرمجاز' );
		$id = absint( $_POST['id'] ?? 0 );
		check_admin_referer( 'mirall_ticket_reply_' . $id );
		$reply = sanitize_textarea_field( wp_unslash( $_POST['reply'] ?? '' ) );
		if ( $id && $reply ) {
			global $wpdb; $table = Mirall_Database::table( 'tickets' );
			$ticket = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE id=%d", $id ), ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			$wpdb->update( $table, array( 'reply' => $reply, 'replied_at' => current_time( 'mysql' ), 'status' => 'answered' ), array( 'id' => $id ) );
			if ( $ticket ) Mirall_SMS::send( $ticket['mobile'], 'پشتیبانی میرال به پیام شما پاسخ داد. پاسخ را در پنجره پشتیبانی سایت ببینید.', 'support_replied' );
		}
		wp_safe_redirect( admin_url( 'admin.php?page=mirall-tickets' ) ); exit;
	}
	public static function settings_page(): void {
		$s = get_option( 'mirall_settings', array() ); echo '<div class="wrap mirall-admin"><h1>تنظیمات میرال</h1><form method="post" action="options.php">'; settings_fields( 'mirall_settings' );
		echo '<div class="mirall-settings"><section><h2>درگاه پیامکی</h2><label>ارائه‌دهنده<select name="mirall_settings[sms_provider]"><option value="none">غیرفعال</option>'; foreach ( array( 'kavenegar' => 'کاوه‌نگار', 'smsir' => 'SMS.ir', 'melipayamak' => 'ملی‌پیامک', 'webhook' => 'وب‌هوک اختصاصی' ) as $key => $name ) printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $key ), selected( $s['sms_provider'] ?? '', $key, false ), esc_html( $name ) ); echo '</select></label>';
		foreach ( array( 'sms_api_key' => 'API Key / رمز', 'sms_username' => 'نام کاربری', 'sms_sender' => 'خط ارسال', 'sms_pattern' => 'نام الگوی OTP', 'sms_webhook' => 'نشانی Webhook' ) as $key => $label ) printf( '<label>%1$s<input type="%2$s" name="mirall_settings[%3$s]" value="%4$s"></label>', esc_html( $label ), str_contains( $key, 'key' ) ? 'password' : 'text', esc_attr( $key ), esc_attr( $s[ $key ] ?? '' ) ); echo '</section><section><h2>زمان‌بندی</h2>'; foreach ( array( 'booking_start' => 'شروع کار', 'booking_end' => 'پایان کار', 'slot_minutes' => 'فاصله هر نوبت (دقیقه)' ) as $key => $label ) printf( '<label>%1$s<input name="mirall_settings[%2$s]" value="%3$s"></label>', esc_html( $label ), esc_attr( $key ), esc_attr( $s[ $key ] ?? '' ) ); echo '</section><section><h2>پشتیبانی</h2>'; foreach ( array( 'whatsapp' => 'واتس‌اپ', 'telegram' => 'تلگرام' ) as $key => $label ) printf( '<label>%1$s<input name="mirall_settings[%2$s]" value="%3$s"></label>', esc_html( $label ), esc_attr( $key ), esc_attr( $s[ $key ] ?? '' ) ); echo '<label>وضعیت کارشناس<select name="mirall_settings[support_online]"><option value="0" ' . selected( $s['support_online'] ?? '0', '0', false ) . '>آفلاین</option><option value="1" ' . selected( $s['support_online'] ?? '0', '1', false ) . '>آنلاین</option></select></label></section></div>'; submit_button(); echo '</form></div>';
	}
}

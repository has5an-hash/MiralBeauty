<?php
defined( 'ABSPATH' ) || exit;

final class Mirall_Booking {
	public static function init(): void {
		add_action( 'wp_ajax_nopriv_mirall_create_booking', array( __CLASS__, 'create' ) );
		add_action( 'wp_ajax_mirall_create_booking', array( __CLASS__, 'create' ) );
		add_action( 'wp_ajax_mirall_cancel_booking', array( __CLASS__, 'cancel' ) );
		add_action( 'wp_ajax_nopriv_mirall_support_ticket', array( __CLASS__, 'support_ticket' ) );
		add_action( 'wp_ajax_mirall_support_ticket', array( __CLASS__, 'support_ticket' ) );
		add_action( 'wp_ajax_nopriv_mirall_support_poll', array( __CLASS__, 'support_poll' ) );
		add_action( 'wp_ajax_mirall_support_poll', array( __CLASS__, 'support_poll' ) );
		add_action( 'template_redirect', array( __CLASS__, 'invoice' ) );
	}
	private static function nonce(): void { check_ajax_referer( 'mirall_public', 'nonce' ); }
	public static function create(): void {
		self::nonce();
		$data = array(
			'customer_name' => sanitize_text_field( wp_unslash( $_POST['fullname'] ?? '' ) ),
			'mobile' => preg_replace( '/[^0-9]/', '', wp_unslash( $_POST['mobile'] ?? '' ) ),
			'service_id' => absint( $_POST['service_id'] ?? 0 ), 'model_id' => absint( $_POST['model_id'] ?? 0 ), 'staff_id' => absint( $_POST['staff_id'] ?? 0 ),
			'appointment_date' => sanitize_text_field( wp_unslash( $_POST['date'] ?? '' ) ), 'appointment_time' => sanitize_text_field( wp_unslash( $_POST['time'] ?? '' ) ),
			'note' => sanitize_textarea_field( wp_unslash( $_POST['note'] ?? '' ) ),
		);
		if ( ! preg_match( '/^09\d{9}$/', $data['mobile'] ) || ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $data['appointment_date'] ) || strtotime( $data['appointment_date'] ) < strtotime( gmdate( 'Y-m-d' ) ) || ! $data['customer_name'] || ! $data['service_id'] ) wp_send_json_error( array( 'message' => 'اطلاعات رزرو کامل یا معتبر نیست.' ), 422 );
		global $wpdb; $table = Mirall_Database::table( 'bookings' );
		$exists = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$table} WHERE appointment_date=%s AND appointment_time=%s AND staff_id=%d AND status IN ('pending','confirmed')", $data['appointment_date'], $data['appointment_time'], $data['staff_id'] ) ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( $exists ) wp_send_json_error( array( 'message' => 'این بازه زمانی رزرو شده است.' ), 409 );
		$tracking = 'MR' . wp_date( 'ymd' ) . strtoupper( wp_generate_password( 5, false, false ) );
		$now = current_time( 'mysql' );
		$insert = array_merge( $data, array( 'tracking_code' => $tracking, 'user_id' => get_current_user_id(), 'status' => 'pending', 'amount' => (float) get_post_meta( $data['service_id'], '_mirall_price', true ), 'payment_status' => 'unpaid', 'payment_ref' => '', 'created_at' => $now, 'updated_at' => $now ) );
		if ( false === $wpdb->insert( $table, $insert ) ) wp_send_json_error( array( 'message' => 'ثبت نوبت انجام نشد.' ), 500 );
		Mirall_SMS::send( $data['mobile'], 'درخواست نوبت میرال ثبت شد. کد پیگیری: ' . $tracking, 'booking_created', array( 'token' => $tracking ) );
		wp_send_json_success( array( 'message' => 'درخواست نوبت ثبت شد.', 'tracking' => $tracking ) );
	}
	public static function cancel(): void {
		self::nonce(); if ( ! is_user_logged_in() ) wp_send_json_error( array( 'message' => 'ابتدا وارد شوید.' ), 401 );
		$id = absint( $_POST['booking_id'] ?? 0 ); global $wpdb; $table = Mirall_Database::table( 'bookings' );
		$booking = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE id=%d AND user_id=%d", $id, get_current_user_id() ), ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( ! $booking || ! in_array( $booking['status'], array( 'pending', 'confirmed' ), true ) ) wp_send_json_error( array( 'message' => 'این نوبت قابل لغو نیست.' ), 403 );
		$wpdb->update( $table, array( 'status' => 'cancelled', 'updated_at' => current_time( 'mysql' ) ), array( 'id' => $id ) ); do_action( 'mirall_booking_status_changed', $booking, 'cancelled' );
		wp_send_json_success( array( 'message' => 'نوبت لغو شد.' ) );
	}
	public static function support_ticket(): void {
		self::nonce(); $name = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) ); $mobile = preg_replace( '/[^0-9]/', '', wp_unslash( $_POST['phone'] ?? '' ) ); $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );
		if ( ! $name || ! preg_match( '/^09\d{9}$/', $mobile ) || strlen( $message ) < 3 ) wp_send_json_error( array( 'message' => 'اطلاعات پیام معتبر نیست.' ), 422 );
		$token = bin2hex( random_bytes( 24 ) );
		global $wpdb; $wpdb->insert( Mirall_Database::table( 'tickets' ), array( 'thread_token' => $token, 'user_id' => get_current_user_id(), 'name' => $name, 'mobile' => $mobile, 'message' => $message, 'reply' => '', 'status' => 'new', 'created_at' => current_time( 'mysql' ) ) );
		wp_send_json_success( array( 'message' => 'پیام شما ثبت شد؛ پاسخ کارشناس در همین پنجره نمایش داده می‌شود.', 'ticket' => (int) $wpdb->insert_id, 'token' => $token ) );
	}
	public static function support_poll(): void {
		self::nonce();
		$id = absint( $_POST['ticket'] ?? 0 );
		$token = sanitize_text_field( wp_unslash( $_POST['token'] ?? '' ) );
		if ( ! $id || ! preg_match( '/^[a-f0-9]{48}$/', $token ) ) wp_send_json_error( array( 'message' => 'گفت‌وگو معتبر نیست.' ), 422 );
		global $wpdb; $table = Mirall_Database::table( 'tickets' );
		$row = $wpdb->get_row( $wpdb->prepare( "SELECT reply,replied_at,status FROM {$table} WHERE id=%d AND thread_token=%s", $id, $token ), ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( ! $row ) wp_send_json_error( array( 'message' => 'گفت‌وگو پیدا نشد.' ), 404 );
		wp_send_json_success( array( 'reply' => (string) $row['reply'], 'replied_at' => (string) $row['replied_at'], 'status' => (string) $row['status'] ) );
	}
	public static function invoice(): void {
		if ( ! isset( $_GET['mirall_invoice'] ) ) return;
		if ( ! is_user_logged_in() ) auth_redirect();
		$id = absint( $_GET['mirall_invoice'] ); global $wpdb; $table = Mirall_Database::table( 'bookings' );
		$row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE id=%d AND user_id=%d", $id, get_current_user_id() ), ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		if ( ! $row ) wp_die( 'رسید پیدا نشد.', 'میرال', array( 'response' => 404 ) );
		$service = get_the_title( (int) $row['service_id'] );
		$status_labels = array( 'pending' => 'در انتظار تأیید', 'confirmed' => 'تأییدشده', 'cancelled' => 'لغوشده', 'completed' => 'انجام‌شده' );
		$payment_labels = array( 'unpaid' => 'پرداخت در محل / اعلام نشده', 'paid' => 'پرداخت‌شده', 'refunded' => 'بازگشت داده‌شده' );
		nocache_headers(); ?>
		<!doctype html><html lang="fa" dir="rtl"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width"><title>رسید <?php echo esc_html( $row['tracking_code'] ); ?></title><style>body{font-family:Tahoma;background:#f7eeee;color:#39232a;padding:30px}.invoice{max-width:720px;margin:auto;background:#fff;padding:40px;border-radius:20px}.head{display:flex;justify-content:space-between;border-bottom:2px solid #9d4259;padding-bottom:20px}.grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin:30px 0}.grid div{padding:15px;background:#fff7f4;border-radius:12px}small,strong{display:block}button{background:#9d4259;color:#fff;border:0;border-radius:20px;padding:10px 22px}@media print{body{background:#fff;padding:0}button{display:none}.invoice{box-shadow:none}}</style></head><body><main class="invoice"><div class="head"><div><h1>Mirall Beauty</h1><p>رسید نوبت سالن زیبایی میرال</p></div><div><small>کد پیگیری</small><strong><?php echo esc_html( $row['tracking_code'] ); ?></strong></div></div><div class="grid"><div><small>نام مشتری</small><strong><?php echo esc_html( $row['customer_name'] ); ?></strong></div><div><small>خدمت</small><strong><?php echo esc_html( $service ); ?></strong></div><div><small>تاریخ و ساعت</small><strong><?php echo esc_html( $row['appointment_date'] . ' - ' . $row['appointment_time'] ); ?></strong></div><div><small>وضعیت</small><strong><?php echo esc_html( $status_labels[ $row['status'] ] ?? 'در حال بررسی' ); ?></strong></div><div><small>مبلغ</small><strong><?php echo esc_html( number_format_i18n( $row['amount'] ) ); ?> تومان</strong></div><div><small>وضعیت پرداخت</small><strong><?php echo esc_html( $payment_labels[ $row['payment_status'] ] ?? 'در حال بررسی' ); ?></strong></div></div><p>تهران، فرشته، مجتمع تجاری داریوش، بلوک B، طبقه ۳، واحد ۲۳۸</p><button onclick="window.print()">چاپ / ذخیره PDF</button></main></body></html>
		<?php exit;
	}
}

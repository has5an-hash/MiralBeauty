<?php
defined( 'ABSPATH' ) || exit;

final class Mirall_Shortcodes {
	public static function init(): void {
		add_shortcode( 'mirall_booking', array( __CLASS__, 'booking' ) );
		add_shortcode( 'mirall_login', array( __CLASS__, 'login' ) );
		add_shortcode( 'mirall_account', array( __CLASS__, 'account' ) );
		add_shortcode( 'mirall_support', array( __CLASS__, 'support' ) );
		add_shortcode( 'mirall_models', array( __CLASS__, 'models' ) );
		add_shortcode( 'mirall_services', array( __CLASS__, 'services' ) );
	}
	public static function booking(): string {
		$services = get_posts( array( 'post_type' => 'mirall_service', 'numberposts' => -1, 'post_status' => 'publish' ) );
		$models = get_posts( array( 'post_type' => 'mirall_model', 'numberposts' => -1, 'post_status' => 'publish' ) );
		$selected_service = absint( $_GET['service'] ?? 0 );
		if ( ! $selected_service && isset( $_GET['service'] ) ) { $service_page = get_page_by_path( sanitize_title( wp_unslash( $_GET['service'] ) ), OBJECT, 'mirall_service' ); $selected_service = $service_page ? (int) $service_page->ID : 0; }
		ob_start(); ?>
		<dialog class="booking-dialog" id="booking-dialog" <?php echo is_page( (int) get_option( 'mirall_booking_page' ) ) ? 'open' : ''; ?>><button class="dialog-close" aria-label="بستن">×</button><div class="dialog-head"><span class="booking-mascot-host" aria-hidden="true"></span><div><span class="eyebrow">رزرو آنلاین نوبت</span><h2>نوبت زیبایی تو</h2><p>خدمت، مدل و زمان دلخواهت را انتخاب کن.</p></div></div><div class="booking-progress"><span class="active">۱</span><i></i><span>۲</span><i></i><span>۳</span><i></i><span>۴</span></div><form id="booking-form" class="mirall-live-form">
		<section class="booking-step active" data-step="1"><h3>چه خدمتی می‌خواهی؟</h3><div class="choice-grid"><?php foreach ( $services as $service ) : ?><label><input type="radio" name="service_id" value="<?php echo esc_attr( $service->ID ); ?>" data-label="<?php echo esc_attr( $service->post_title ); ?>" required <?php checked( $selected_service, $service->ID ); ?>><span>✦<b><?php echo esc_html( $service->post_title ); ?></b><small><?php echo esc_html( wp_trim_words( $service->post_content, 8 ) ); ?></small></span></label><?php endforeach; ?></div></section>
		<section class="booking-step" data-step="2"><h3>مدل دلخواهت را انتخاب کن</h3><div class="model-grid"><?php if ( $models ) : foreach ( $models as $model ) : ?><label data-service="<?php echo esc_attr( get_post_meta( $model->ID, '_mirall_service_id', true ) ); ?>"><input type="radio" name="model_id" value="<?php echo esc_attr( $model->ID ); ?>"><?php echo get_the_post_thumbnail( $model, 'medium', array( 'alt' => $model->post_title ) ); ?><b><?php echo esc_html( $model->post_title ); ?></b></label><?php endforeach; else : ?><p>برای انتخاب مدل، پس از مشاوره پیشنهاد مناسب دریافت می‌کنی.</p><input type="hidden" name="model_id" value="0"><?php endif; ?></div></section>
		<section class="booking-step" data-step="3"><h3>روز و زمان پیشنهادی</h3><div class="field-row"><label>تاریخ<input type="date" name="date" required min="<?php echo esc_attr( gmdate( 'Y-m-d' ) ); ?>"></label><label>زمان<select name="time" required><option value="">انتخاب کنید</option><?php foreach ( array( '10:00', '12:00', '14:00', '16:00', '18:00' ) as $time ) printf( '<option>%s</option>', esc_html( $time ) ); ?></select></label></div><input type="hidden" name="staff_id" value="0"><label class="full-field">توضیح<textarea name="note" rows="3"></textarea></label></section>
		<section class="booking-step" data-step="4"><h3>اطلاعات تماس</h3><div class="field-row"><label>نام و نام خانوادگی<input name="fullname" required autocomplete="name"></label><label>شماره موبایل<input name="mobile" required inputmode="tel" pattern="09[0-9]{9}" autocomplete="tel"></label></div><label class="consent"><input type="checkbox" required> شرایط رزرو را می‌پذیرم.</label><div class="mirall-form-response" role="status"></div></section>
		<div class="booking-actions"><button type="button" class="button button-ghost dark prev-step" disabled>مرحله قبل</button><button type="button" class="button next-step">ادامه</button><button type="submit" class="button submit-booking" hidden>ثبت درخواست</button></div></form><div class="booking-success" hidden><div>✓</div><h3>درخواست ثبت شد</h3><p class="tracking-output"></p><button class="button close-success">بستن</button></div></dialog>
		<?php return (string) ob_get_clean();
	}
	public static function login(): string {
		if ( is_user_logged_in() ) return '<p>شما وارد شده‌اید.</p>';
		return '<form class="mirall-otp-form"><div class="otp-mobile"><label>شماره موبایل<input name="mobile" inputmode="tel" pattern="09[0-9]{9}" required></label><button class="button" type="button" data-action="send-otp">ارسال کد</button></div><div class="otp-code" hidden><label>کد پنج‌رقمی<input name="code" inputmode="numeric" maxlength="5" required></label><button class="button" type="submit">ورود</button></div><div class="mirall-form-response" role="status"></div></form>';
	}
	public static function account(): string {
		if ( ! is_user_logged_in() ) return '<section class="mirall-account-login"><h2>ورود به پنل میرال</h2>' . self::login() . '</section>';
		global $wpdb; $rows = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . Mirall_Database::table( 'bookings' ) . ' WHERE user_id=%d ORDER BY appointment_date DESC', get_current_user_id() ), ARRAY_A ); // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		ob_start(); ?><section class="mirall-account"><header><h2>پنل کاربری میرال</h2><p><?php echo esc_html( wp_get_current_user()->display_name ); ?></p></header><nav><button class="active">نوبت‌های من</button><button>رسیدها و فاکتورها</button><a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>">خروج</a></nav><div class="mirall-booking-list"><?php if ( $rows ) : foreach ( $rows as $row ) : $statuses = array( 'pending' => 'در انتظار تأیید', 'confirmed' => 'تأییدشده', 'cancelled' => 'لغوشده', 'completed' => 'انجام‌شده' ); ?><article><div><small>کد پیگیری</small><strong><?php echo esc_html( $row['tracking_code'] ); ?></strong></div><div><small>تاریخ</small><strong><?php echo esc_html( $row['appointment_date'] . ' ' . $row['appointment_time'] ); ?></strong></div><span class="status-<?php echo esc_attr( $row['status'] ); ?>"><?php echo esc_html( $statuses[ $row['status'] ] ?? 'در حال بررسی' ); ?></span><a href="<?php echo esc_url( add_query_arg( 'mirall_invoice', $row['id'], home_url( '/' ) ) ); ?>" target="_blank">مشاهده رسید</a><?php if ( in_array( $row['status'], array( 'pending', 'confirmed' ), true ) ) : ?><button class="cancel-booking" data-id="<?php echo esc_attr( $row['id'] ); ?>">لغو نوبت</button><?php endif; ?></article><?php endforeach; else : ?><p>هنوز نوبتی ثبت نکرده‌اید.</p><?php endif; ?></div></section><?php return (string) ob_get_clean();
	}
	public static function support(): string {
		$s = get_option( 'mirall_settings', array() ); $wa = preg_replace( '/[^0-9]/', '', $s['whatsapp'] ?? '989125707416' );
		$telegram = trim( (string) ( $s['telegram'] ?? '' ) );
		$telegram_url = $telegram ? ( str_starts_with( $telegram, 'http' ) ? $telegram : 'https://t.me/' . ltrim( $telegram, '@' ) ) : '';
		$online = ! empty( $s['support_online'] );
		return '<button class="support-launch" aria-expanded="false" aria-controls="support-panel"><span class="online-dot"></span><b>ارتباط با پشتیبانی</b><em>◇</em></button><aside class="support-panel" id="support-panel" aria-hidden="true"><header><span class="chat-mascot-host" aria-hidden="true"></span><div><span class="online-dot"></span><strong>پشتیبانی میرال</strong><small>' . ( $online ? 'کارشناس آنلاین است' : 'پیامتان را ثبت کنید' ) . '</small></div><button class="close-support" aria-label="بستن">×</button></header><div class="support-body"><p class="agent-message">سلام! برای رزرو یا پیگیری نوبت چطور کمک کنیم؟</p><div class="quick-links"><a href="tel:02122003932">تماس</a><a href="https://wa.me/' . esc_attr( $wa ) . '" target="_blank" rel="noopener">واتس‌اپ</a>' . ( $telegram_url ? '<a href="' . esc_url( $telegram_url ) . '" target="_blank" rel="noopener">تلگرام</a>' : '' ) . '<a href="https://www.instagram.com/mirall_beauty_center/" target="_blank" rel="noopener">اینستاگرام</a></div><div class="support-reply" hidden></div><form id="support-form" class="mirall-support-form"><label>نام<input required name="name"></label><label>شماره تماس<input required name="phone" pattern="09[0-9]{9}"></label><label>پیام<textarea required name="message" rows="3"></textarea></label><button class="button" type="submit">ثبت پیام</button><small class="form-note"></small></form></div></aside>';
	}
	public static function models( array $atts ): string {
		$atts = shortcode_atts( array( 'service' => 0, 'limit' => 12 ), $atts ); $args = array( 'post_type' => 'mirall_model', 'numberposts' => absint( $atts['limit'] ), 'post_status' => 'publish' ); if ( $atts['service'] ) $args['meta_query'] = array( array( 'key' => '_mirall_service_id', 'value' => absint( $atts['service'] ) ) ); $models = get_posts( $args );
		if ( ! $models ) return '<p class="editorial-note">برای این خدمت، مدل مناسب پس از مشاوره پیشنهاد می‌شود.</p>';
		$out = '<div class="mirall-models portfolio-grid">'; foreach ( $models as $model ) $out .= '<article class="portfolio-item">' . get_the_post_thumbnail( $model, 'large' ) . '<span><strong>' . esc_html( $model->post_title ) . '</strong></span></article>'; return $out . '</div>';
	}
	public static function services(): string {
		$services = get_posts( array( 'post_type' => 'mirall_service', 'numberposts' => -1, 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
		$images = array( 'balayage-warm.jpg', 'makeup.jpg', 'caramel-highlight.jpg', 'balayage-girly.jpg' );
		$out = '<div class="mirall-services service-grid">';
		foreach ( $services as $index => $service ) {
			$duration = (int) get_post_meta( $service->ID, '_mirall_duration', true );
			$price = (float) get_post_meta( $service->ID, '_mirall_price', true );
			$image = get_the_post_thumbnail_url( $service, 'large' );
			if ( ! $image && function_exists( 'mirall_asset' ) ) $image = mirall_asset( $images[ $index % count( $images ) ] );
		$out .= '<article class="service-card">' . ( $image ? '<img class="service-photo" src="' . esc_url( $image ) . '" alt="' . esc_attr( $service->post_title ) . '">' : '' ) . '<div class="service-card-body"><span class="service-icon">✦</span><h3>' . esc_html( $service->post_title ) . '</h3><p>' . esc_html( wp_trim_words( $service->post_content, 24 ) ) . '</p><small>' . esc_html( $duration ? $duration . ' دقیقه' : 'زمان پس از مشاوره' ) . ( $price ? ' · از ' . esc_html( number_format_i18n( $price ) ) . ' تومان' : '' ) . '</small><div class="service-card-actions"><a class="text-button" href="' . esc_url( get_permalink( $service ) ) . '">جزئیات خدمت ←</a><a class="button open-booking" data-service="' . esc_attr( $service->ID ) . '" href="' . esc_url( add_query_arg( 'service', $service->ID, get_permalink( (int) get_option( 'mirall_booking_page' ) ) ?: home_url( '/booking/' ) ) ) . '">رزرو این خدمت</a></div></div></article>';
		}
		return $out . '</div>';
	}
}

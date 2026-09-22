<?php
/**
 * Mirall Luxe theme bootstrap.
 *
 * @package MirallLuxe
 * @author Hassan Mojtahedi - حسن مجتهدی
 */

defined( 'ABSPATH' ) || exit;

define( 'MIRALL_LUXE_VERSION', '2.1.0' );

require_once get_template_directory() . '/inc/customizer.php';

function mirall_luxe_setup(): void {
	load_theme_textdomain( 'mirall-luxe', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'height' => 120, 'width' => 300, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'woocommerce' );
	add_image_size( 'mirall-card', 720, 900, false );
	add_image_size( 'mirall-wide', 1440, 900, false );
	register_nav_menus(
		array(
			'primary' => __( 'منوی اصلی', 'mirall-luxe' ),
			'footer'  => __( 'منوی فوتر', 'mirall-luxe' ),
		)
	);
}
add_action( 'after_setup_theme', 'mirall_luxe_setup' );

function mirall_luxe_assets(): void {
	$uri = get_template_directory_uri();
	wp_enqueue_style( 'mirall-luxe-main', $uri . '/assets/css/site.css', array(), MIRALL_LUXE_VERSION );
	wp_enqueue_style( 'mirall-luxe-refinement', $uri . '/assets/css/refinement.css', array( 'mirall-luxe-main' ), MIRALL_LUXE_VERSION );
	wp_enqueue_script( 'mirall-luxe-main', $uri . '/assets/js/site.js', array(), MIRALL_LUXE_VERSION, true );
	wp_localize_script(
		'mirall-luxe-main',
		'MirallTheme',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'mirall_public' ),
			'isDemo'  => false,
			'bookingUrl' => get_permalink( (int) get_option( 'mirall_booking_page' ) ) ?: home_url( '/booking/' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'mirall_luxe_assets' );

function mirall_luxe_script_attributes( string $tag, string $handle ): string {
	if ( 'mirall-luxe-main' !== $handle ) {
		return $tag;
	}
	return str_replace( ' src=', ' defer src=', $tag );
}
add_filter( 'script_loader_tag', 'mirall_luxe_script_attributes', 10, 2 );

function mirall_luxe_body_classes( array $classes ): array {
	$classes[] = 'mirall-luxe';
	return $classes;
}
add_filter( 'body_class', 'mirall_luxe_body_classes' );

function mirall_asset( string $name ): string {
	return esc_url( get_theme_file_uri( '/assets/images/' . ltrim( $name, '/' ) ) );
}

function mirall_image_option( string $key, string $fallback ): string {
	$value = get_theme_mod( 'mirall_' . $key, $fallback );
	if ( 'hero_image_1' === $key && 'light-ombre.jpg' === wp_basename( (string) $value ) ) {
		$value = $fallback;
	}
	return esc_url( is_string( $value ) && $value ? $value : $fallback );
}

function mirall_option( string $key, string $fallback = '' ): string {
	$value = get_theme_mod( 'mirall_' . $key, $fallback );
	return is_string( $value ) ? $value : $fallback;
}

function mirall_journal_image( $post, int $index = 0 ): string {
	$thumbnail = get_the_post_thumbnail_url( $post, 'large' );
	if ( $thumbnail ) {
		return esc_url( $thumbnail );
	}
	$title = (string) get_the_title( $post );
	$images = array(
		'color'  => 'journal-color.svg',
		'care'   => 'journal-care.svg',
		'makeup' => 'journal-makeup.svg',
	);
	if ( false !== strpos( $title, 'میکاپ' ) || false !== strpos( $title, 'مراسم' ) ) {
		return mirall_asset( $images['makeup'] );
	}
	if ( false !== strpos( $title, 'مراقبت' ) || false !== strpos( $title, 'مو' ) ) {
		return mirall_asset( $images['care'] );
	}
	if ( false !== strpos( $title, 'رنگ' ) || false !== strpos( $title, 'بالیاژ' ) || false !== strpos( $title, 'تناژ' ) ) {
		return mirall_asset( $images['color'] );
	}
	return mirall_asset( array_values( $images )[ $index % count( $images ) ] );
}

function mirall_map_embed_url(): string {
	return 'https://www.google.com/maps?q=' . rawurlencode( 'مجتمع تجاری داریوش، فرشته، تهران' ) . '&output=embed&z=16';
}

function mirall_instagram_works(): array {
	static $works = null;
	if ( null !== $works ) {
		return $works;
	}
	$video_images = array(
		'DIKB7SWNoj1' => 'https://scontent-lax7-1.cdninstagram.com/v/t51.75761-15/488953006_18488380324025337_259236919570576570_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=105&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=2Rq7-4rFA-sQ7kNvwFcdpAk&_nc_oc=Adr8vO7rJKbxegymTxfk7retG4M7p7Ct8zX4r6KQmD9b7bsR8_iS-annu2B6so6YpDH8nRnpzbxRSbyfcV2IcJRp&_nc_zt=23&_nc_ht=scontent-lax7-1.cdninstagram.com&_nc_gid=hw0OhHWhgkJu2CSOeCYeHQ&_nc_ss=7b689&oh=00_AQKBD74wbpw4Uxfcf_jkBZP1p6CEe50WTrb_WGiWMmxBig&oe=6AB75FD6',
		'DdcAPxMJKZl' => 'https://scontent-lax3-2.cdninstagram.com/v/t51.82787-15/815098117_18617702314025337_3701829375573886360_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=111&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0FST1VTRUxfSVRFTS5iZXN0X2ltYWdlX3VybGdlbi5DMyJ9&_nc_ohc=XkbhB2bOMVkQ7kNvwEbvvFE&_nc_oc=Adra5d-b87vJT1It4VbGAt5o1Dmxxt3N1vEhgn_3GxJeQuWl4Gy-Cft9ijKzN4Kok-EYaAlB0erO0gwvZvy-sEQ0&_nc_zt=23&_nc_ht=scontent-lax3-2.cdninstagram.com&_nc_gid=GTkF9gX6w0ngSqJTtupivQ&_nc_ss=7b689&oh=00_AQI57JDNg9FjHMVi-b8wb0jhy_5yZzHz7MWF20VZWoCcGw&oe=6AB77F52',
		'DdT-TuiJJHP' => 'https://scontent-lax3-1.cdninstagram.com/v/t51.82787-15/811028370_18616670563025337_3395017109547908172_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=108&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=SY5Gt29_w00Q7kNvwE5fzb8&_nc_oc=AdrtKlzzxHDQ7a1GQW7JaK4JCoDxjprE3IJVvbPCNTDVio8uJZj_MviYpEtkkm5YpTgV7IkGxY8iY000EgsjLrkt&_nc_zt=23&_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_gid=tCPn0lZ7wBTHpdMp6VQNGg&_nc_ss=7b689&oh=00_AQKoydzCXXrHOhqwUoh6zoDUSYVkyJJ3LWJyQwa77ffe4A&oe=6AB76D48',
		'Dc_FJwnJzso' => 'https://scontent-lax3-2.cdninstagram.com/v/t51.82787-15/799543801_18613387771025337_1706618611726700806_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=106&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=OX5XThu-cZwQ7kNvwGqXvfM&_nc_oc=AdqqGqEb1GbPdjPQXJWPEwwb-jIvQoQaujx7g2x5xNNXY-fkd-hmMUbXE-fpqstP3dcxghuPxrtrGvBdZ6tTuZu_&_nc_zt=23&_nc_ht=scontent-lax3-2.cdninstagram.com&_nc_gid=eTJ6j8ngHSVEge5qNLWHJw&_nc_ss=7b689&oh=00_AQICg3YkvZp-dRpUVOG8yoX18Y04W7QXshFY8LGGVz4Ijw&oe=6AB76E74',
		'Dc6ksjZJDQd' => 'https://scontent-lax7-1.cdninstagram.com/v/t51.82787-15/796194959_18612811300025337_641917460964598610_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=101&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=H0cC0Jv7Qr0Q7kNvwEd8tJ4&_nc_oc=AdqlB3NAicW2RhP-L-fUS2ZB_24iLfF_dFfdr7bifAmCDCrDkXbrhf35980ibfdapuEyGqs649GGZX1t9SXTMpH6&_nc_zt=23&_nc_ht=scontent-lax7-1.cdninstagram.com&_nc_gid=jrIPCKxIv51kXPfN_ZxCUQ&_nc_ss=7b689&oh=00_AQIMtKKp_v8mc5k4NvuNxBtE3w0XbzI-sOvmQR5EnJLnrA&oe=6AB759E0',
		'Dc3D45tJMxA' => 'https://scontent-lax7-1.cdninstagram.com/v/t51.82787-15/792910947_18612342220025337_4113213407855538353_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=105&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=1kaPRrC_Ye4Q7kNvwGWbDbk&_nc_oc=AdoPWyoTK9L-2b8eJNGec62yeuUIX4cQM7QpIEHjJ8yG0Fc2H4JxCLbXDCfnNaWHap8y5dkxr2bBdJCuXyM6vSaC&_nc_zt=23&_nc_ht=scontent-lax7-1.cdninstagram.com&_nc_gid=P3iM_ggdQsKBt7urp68dug&_nc_ss=7b689&oh=00_AQK5fqrkI1-TSdugN9c8n5tq569RDrOBvlwzEQ0Sv3EgRg&oe=6AB76252',
		'DclhLZoJhyL' => 'https://scontent-lax3-1.cdninstagram.com/v/t51.82787-15/789399012_18610109914025337_5429542499962832741_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=109&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=my-JnMXH9icQ7kNvwEtkqiW&_nc_oc=Adow5m2Ei4wz09YFATISC2tBfCB1AvqsFF8jCsw_MTHwwAXPVJ04x5A8IGtFciB2zAdvIC7ps1ghbRh2qOiI5YX4&_nc_zt=23&_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_gid=FD9oRcsadGATpvAT7rSw3Q&_nc_ss=7b689&oh=00_AQJPxgJukN12QgDIBupjCB2ZE-Q9_PVpGjlPMWjHUk5qlA&oe=6AB764F3',
		'Dca_13LpEq5' => 'https://scontent-lax3-1.cdninstagram.com/v/t51.82787-15/784981242_18608757937025337_9121069445482817788_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=108&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=rIJDgsUsPAkQ7kNvwG0aQv3&_nc_oc=Adrj4Y-PL1Q7EqK-blayEWekWVzb6i0Pb3ORVHMXo1GzV6h4i9P3EPETnZSC8rB-Tu7bS8WGD5OyhWuMxY6or8lf&_nc_zt=23&_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_gid=LSoeEtkABLt18tEq6jeBoA&_nc_ss=7b689&oh=00_AQLy7kkrh76Qh32tMUoVbTuwKl7GsqnzW3nQfB8w6ZX9fA&oe=6AB77C8F',
		'DcG_Q7PJa4-' => 'https://scontent-lax3-1.cdninstagram.com/v/t51.82787-15/775245329_18606019972025337_5049068818921527019_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=102&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=u5t1IiZt0DcQ7kNvwEUDBlt&_nc_oc=Adq6XT3x9zfpHvo6OBKGTgZA9X2cnH9Tg9dYpR5OpuB5yQdiG3Xg2rk09FcFrhZXUZTD7oXNzjprFYHFElmRlRkS&_nc_zt=23&_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_gid=iCc6gUHEaJqhngWZZrXYng&_nc_ss=7b689&oh=00_AQICRbcoS2vkYPDt6IN6yOdU5tFOjxG5SQW7kwm_t7eO-g&oe=6AB76779',
		'Db8ZbC9JrAG' => 'https://scontent-lax7-1.cdninstagram.com/v/t51.82787-15/770751246_18604370185025337_7045188166521155697_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=105&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=CPCQtFwokAcQ7kNvwFOWZ_d&_nc_oc=AdpalCUEZWzZWjnXWPz-uGyk7HGqMGvyMC9hXH1dfUd5x6fPD8-GQ4vz7pKQst76X2Fr74IWQ4eOS1sLT-pFQV7U&_nc_zt=23&_nc_ht=scontent-lax7-1.cdninstagram.com&_nc_gid=9p9QBbGHKu2B2xUnN3EnJQ&_nc_ss=7b689&oh=00_AQLDoHtqn4bUPIxPU_Bum9jaJiEyYa0_Cjr98mgD44nsEQ&oe=6AB77531',
		'Db3hE7Qp6Ps' => 'https://scontent-lax3-2.cdninstagram.com/v/t51.82787-15/772686113_18603790615025337_1024183408476283065_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=103&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=p8aLigSUhBwQ7kNvwG2FQkL&_nc_oc=Adp2RmedJNR5UAngfXflQxwy_tmOZ-pwAPgLbFuTvu4TiZPtOPrEjITK2K6-yC5bdtDvtvuA2fqB0e7OtAOUuKDb&_nc_zt=23&_nc_ht=scontent-lax3-2.cdninstagram.com&_nc_gid=oYSnanF-v0yRACHqwUju7g&_nc_ss=7b689&oh=00_AQKpTUi2GStTRIcNb9-zj8kIRhHRsnWyiO_r1-SWlvHMtA&oe=6AB76BC0',
		'DbsoPFipTVL' => 'https://scontent-lax3-1.cdninstagram.com/v/t51.71878-15/760724861_1031985456240383_1088074726549040279_n.jpg?stp=cmp1_dst-jpg_e35_s640x640_tt6&_nc_cat=109&ccb=7-5&_nc_sid=18de74&efg=eyJlZmdfdGFnIjoiQ0xJUFMuYmVzdF9pbWFnZV91cmxnZW4uQzMifQ%3D%3D&_nc_ohc=Wo5YBttRcBAQ7kNvwH0cPta&_nc_oc=AdoUnJhmPF5MOKf6KrAHLX54CHb9r5S2HB2JQbXZCZw8Om08T_mMDn8wyc7fUcaBB0SiOC4FMVhmuPbRP-iQaR-9&_nc_zt=23&_nc_ht=scontent-lax3-1.cdninstagram.com&_nc_gid=e7AtU4Z7Iekwh47Fp_OIxA&_nc_ss=7b689&oh=00_AQLuG5l8CA_0BFGuxHYacsAkltgiGScTvrlC5ASI8N9hkw&oe=6AB785AD',
	);
	$raw = array(
		array( 'id' => 'Dbgf7kRJjbR', 'type' => 'image', 'category' => 'hair', 'label' => 'رنگ و مو', 'title' => 'ترمیم دکلره عروسکی' ),
		array( 'id' => 'DIKB7SWNoj1', 'type' => 'video', 'category' => 'makeup', 'label' => 'میکاپ', 'title' => 'اسموکی لایت' ),
		array( 'id' => 'CrvBLJzNH24', 'type' => 'image', 'category' => 'hair', 'label' => 'رنگ و مو', 'title' => 'هایلایت کرم طلایی' ),
		array( 'id' => 'Ddei4BFl84u', 'type' => 'image', 'category' => 'hair', 'label' => 'بالیاژ', 'title' => 'بالیاژ تیره و سرد' ),
		array( 'id' => 'DdcAPxMJKZl', 'type' => 'video', 'category' => 'hair', 'label' => 'ویدیو رنگ مو', 'title' => 'امبره خوش‌رنگ' ),
		array( 'id' => 'DdT-TuiJJHP', 'type' => 'video', 'category' => 'makeup', 'label' => 'ویدیو میکاپ', 'title' => 'میکاپ شیک میرال' ),
		array( 'id' => 'DdRnEXwFz0N', 'type' => 'image', 'category' => 'hair', 'label' => 'بالیاژ', 'title' => 'ظرافت و تمیزی بالیاژ' ),
		array( 'id' => 'DdPECA9J0Di', 'type' => 'image', 'category' => 'hair', 'label' => 'امبره', 'title' => 'امبره بلوند باربی' ),
		array( 'id' => 'Dc_FJwnJzso', 'type' => 'video', 'category' => 'hair', 'label' => 'ویدیو رنگ مو', 'title' => 'هایلایت محبوب میرال' ),
		array( 'id' => 'Dc6ksjZJDQd', 'type' => 'video', 'category' => 'hair', 'label' => 'ویدیو لایت', 'title' => 'لایت امبره' ),
		array( 'id' => 'Dc3D45tJMxA', 'type' => 'video', 'category' => 'hair', 'label' => 'ویدیو بالیاژ', 'title' => 'بالیاژ بلوند صدفی' ),
		array( 'id' => 'Dcto96-JvpI', 'type' => 'image', 'category' => 'hair', 'label' => 'امبره', 'title' => 'ظرافت خط‌های امبره' ),
		array( 'id' => 'DclhLZoJhyL', 'type' => 'video', 'category' => 'hair', 'label' => 'ویدیو بالیاژ', 'title' => 'بالیاژ و هایلایت' ),
		array( 'id' => 'Dcgz5gAJOUD', 'type' => 'image', 'category' => 'hair', 'label' => 'رنگ و لایت', 'title' => 'بلوند روشن برای میرال' ),
		array( 'id' => 'Dca_13LpEq5', 'type' => 'video', 'category' => 'hair', 'label' => 'ویدیو رنگ مو', 'title' => 'بلوند باربی و پروتئین‌تراپی' ),
		array( 'id' => 'DcYAkwdlxLb', 'type' => 'image', 'category' => 'hair', 'label' => 'بلوند', 'title' => 'بلوند؛ انتخاب ۱، ۲ یا ۳؟' ),
		array( 'id' => 'DcQklN_JBNQ', 'type' => 'image', 'category' => 'hair', 'label' => 'لایت', 'title' => 'فید و زیبایی لایت' ),
		array( 'id' => 'DcG_Q7PJa4-', 'type' => 'video', 'category' => 'hair', 'label' => 'ویدیو اصلاح رنگ', 'title' => 'ترمیم هایلایت کاراملی' ),
		array( 'id' => 'DcEjfGkJDPs', 'type' => 'image', 'category' => 'hair', 'label' => 'بلوند', 'title' => 'بلوند عروسکی یا صدفی' ),
		array( 'id' => 'DcBzPx8pFJv', 'type' => 'image', 'category' => 'hair', 'label' => 'بالیاژ', 'title' => 'لایت بلوند دودی بژ' ),
		array( 'id' => 'Db8ZbC9JrAG', 'type' => 'video', 'category' => 'hair', 'label' => 'ویدیو بلوند', 'title' => 'بلوند شامپاینی' ),
		array( 'id' => 'Db3hE7Qp6Ps', 'type' => 'video', 'category' => 'hair', 'label' => 'ویدیو بالیاژ', 'title' => 'بالیاژ نرم و روشن' ),
		array( 'id' => 'Db08RPwJ5kT', 'type' => 'image', 'category' => 'hair', 'label' => 'دکلره', 'title' => 'دکلره باربی' ),
		array( 'id' => 'DbsoPFipTVL', 'type' => 'video', 'category' => 'makeup', 'label' => 'ویدیو عروس', 'title' => 'بازدید و میکاپ عروس' ),
	);
	$local_reels = array(
		'DIKB7SWNoj1' => '01-smokey-light',
		'DdcAPxMJKZl' => '02-ombre',
		'DdT-TuiJJHP' => '03-makeup-chic',
		'Dc_FJwnJzso' => '04-highlight',
		'Dc6ksjZJDQd' => '05-light-ombre',
		'Dc3D45tJMxA' => '06-pearl-balayage',
		'DclhLZoJhyL' => '07-balayage-hi',
		'Dca_13LpEq5' => '08-barbie-blonde',
		'DcG_Q7PJa4-' => '09-caramel-fix',
		'Db8ZbC9JrAG' => '10-champagne',
		'Db3hE7Qp6Ps' => '11-soft-balayage',
		'DbsoPFipTVL' => '12-bride',
	);
	foreach ( $raw as &$work ) {
		$kind = 'video' === $work['type'] ? 'reel' : 'p';
		$work['url'] = 'https://www.instagram.com/mirall_beauty_center/' . $kind . '/' . $work['id'] . '/';
		$asset_index = array_search( $work['id'], array_column( $raw, 'id' ), true ) + 1;
		$work['image'] = mirall_asset( 'instagram/' . strtolower( sprintf( '%02d-%s.jpg', $asset_index, $work['id'] ) ) );
		$work['video_file'] = '';
		$work['poster']    = '';
		if ( 'video' === $work['type'] && isset( $local_reels[ $work['id'] ] ) ) {
			$slug = $local_reels[ $work['id'] ];
			$work['video_file'] = esc_url( get_theme_file_uri( '/assets/videos/' . $slug . '.mp4' ) );
			$work['poster']     = esc_url( get_theme_file_uri( '/assets/videos/' . $slug . '.jpg' ) );
		}
	}
	unset( $work );
	return $works = $raw;
}

function mirall_primary_menu_fallback(): void {
	$items = array(
		home_url( '/' )                => 'صفحه اصلی',
		home_url( '/services/' )       => 'خدمات',
		home_url( '/beauty-brochure/' ) => 'بروشور زیبایی',
		home_url( '/portfolio/' )      => 'نمونه‌کارها',
		home_url( '/videos/' )         => 'ویدیوها',
		home_url( '/before-after/' )   => 'قبل و بعد',
		home_url( '/beauty-journal/' ) => 'زیبایی‌نامه',
		home_url( '/about/' )          => 'درباره ما',
		home_url( '/contact/' )        => 'تماس با ما',
		home_url( '/booking/' )        => 'رزرو نوبت',
	);
	foreach ( $items as $url => $label ) {
		printf( '<a href="%1$s">%2$s</a>', esc_attr( $url ), esc_html( $label ) );
	}
}

function mirall_luxe_widgets(): void {
	register_sidebar(
		array(
			'name'          => __( 'فوتر میرال', 'mirall-luxe' ),
			'id'            => 'mirall-footer',
			'before_widget' => '<section class="footer-widget">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'mirall_luxe_widgets' );

function mirall_luxe_admin_notice(): void {
	if ( ! current_user_can( 'activate_plugins' ) || class_exists( 'Mirall_Suite' ) ) {
		return;
	}
	echo '<div class="notice notice-info"><p><strong>Mirall Luxe:</strong> برای فعال‌شدن رزرو، ورود پیامکی، پنل کاربری و ویجت‌های المنتور، افزونه Mirall Suite را فعال کنید.</p></div>';
}
add_action( 'admin_notices', 'mirall_luxe_admin_notice' );

function mirall_luxe_document_description(): string {
	$description = get_bloginfo( 'description' );
	if ( is_front_page() ) {
		return 'مرکز زیبایی میرال در فرشته؛ رنگ و لایت، میکاپ، ناخن، مو، ابرو، مژه و مراقبت زیبایی با مشاوره اختصاصی.';
	}
	if ( is_singular() ) {
		$description = get_the_excerpt();
	}
	return wp_strip_all_tags( wp_trim_words( (string) $description, 28, '…' ) );
}

function mirall_luxe_document_head(): void {
	$request_path = isset( $GLOBALS['wp'] ) ? (string) $GLOBALS['wp']->request : '';
	$url = is_singular() ? get_permalink() : home_url( add_query_arg( array(), $request_path ) );
	$url = $url ?: home_url( '/' );
	$title = wp_get_document_title();
	$description = mirall_luxe_document_description();
	$image = mirall_asset( 'balayage-warm.jpg' );
	printf( '<meta name="description" content="%s">\n', esc_attr( $description ) );
	printf( '<link rel="canonical" href="%s">\n', esc_url( $url ) );
	printf( '<meta property="og:type" content="%s">\n', esc_attr( is_singular( 'post' ) ? 'article' : 'website' ) );
	printf( '<meta property="og:title" content="%s">\n', esc_attr( $title ) );
	printf( '<meta property="og:description" content="%s">\n', esc_attr( $description ) );
	printf( '<meta property="og:url" content="%s">\n', esc_url( $url ) );
	printf( '<meta property="og:image" content="%s">\n', esc_url( $image ) );
	printf( '<meta name="twitter:card" content="summary_large_image">\n' );
	printf( '<meta name="twitter:title" content="%s">\n', esc_attr( $title ) );
}
add_action( 'wp_head', 'mirall_luxe_document_head', 2 );

function mirall_luxe_schema(): void {
	$schema = array(
		'@context' => 'https://schema.org',
		'@type' => 'BeautySalon',
		'name' => 'Mirall Beauty Center',
		'url' => home_url( '/' ),
		'image' => mirall_asset( 'balayage-warm.jpg' ),
		'telephone' => '+982122003932',
		'address' => array(
			'@type' => 'PostalAddress',
			'addressLocality' => 'تهران',
			'addressRegion' => 'فرشته',
			'streetAddress' => 'مجتمع تجاری داریوش، بلوک B، طبقه ۳، واحد ۲۳۸',
			'addressCountry' => 'IR',
		),
		'sameAs' => array( 'https://www.instagram.com/mirall_beauty_center/' ),
	);
	$graph = array( $schema );
	if ( is_singular( 'post' ) ) {
		$graph[] = array(
			'@context' => 'https://schema.org',
			'@type' => 'Article',
			'headline' => get_the_title(),
			'description' => mirall_luxe_document_description(),
			'url' => get_permalink(),
			'datePublished' => get_the_date( DATE_W3C ),
			'dateModified' => get_the_modified_date( DATE_W3C ),
			'author' => array( '@type' => 'Organization', 'name' => 'Mirall Beauty Center' ),
		);
	}
	printf( '<script type="application/ld+json">%s</script>\n', wp_json_encode( $graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) );
}
add_action( 'wp_head', 'mirall_luxe_schema', 3 );

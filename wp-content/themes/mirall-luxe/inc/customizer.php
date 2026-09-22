<?php
defined( 'ABSPATH' ) || exit;

function mirall_luxe_customize_register( WP_Customize_Manager $wp_customize ): void {
	$wp_customize->add_panel( 'mirall_luxe', array( 'title' => 'تنظیمات میرال', 'priority' => 30 ) );
	$sections = array(
		'identity' => 'هویت و متن‌ها',
		'visuals'  => 'تصاویر و لوگوی متحرک',
		'contact'  => 'تماس و شبکه‌های اجتماعی',
		'colors'   => 'رنگ‌های برند',
	);
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section( 'mirall_' . $id, array( 'title' => $title, 'panel' => 'mirall_luxe' ) );
	}
	$fields = array(
		'tagline'   => array( 'هویت و متن‌ها', 'خانهٔ زیبایی شما', 'text' ),
		'hero_title'=> array( 'هویت و متن‌ها', 'زیبایی تو، امضای توست', 'text' ),
		'phone'     => array( 'تماس و شبکه‌های اجتماعی', '02122003932', 'text' ),
		'mobile'    => array( 'تماس و شبکه‌های اجتماعی', '09125707416', 'text' ),
		'address'   => array( 'تماس و شبکه‌های اجتماعی', 'تهران، فرشته، مجتمع تجاری داریوش، بلوک B، طبقه ۳، واحد ۲۳۸', 'textarea' ),
		'instagram' => array( 'تماس و شبکه‌های اجتماعی', 'https://www.instagram.com/mirall_beauty_center/', 'url' ),
		'whatsapp'  => array( 'تماس و شبکه‌های اجتماعی', '989125707416', 'text' ),
	);
	foreach ( $fields as $key => $data ) {
		$section_id = str_contains( $data[0], 'تماس' ) ? 'mirall_contact' : 'mirall_identity';
		$wp_customize->add_setting( 'mirall_' . $key, array( 'default' => $data[1], 'sanitize_callback' => 'url' === $data[2] ? 'esc_url_raw' : 'sanitize_text_field' ) );
		$wp_customize->add_control( 'mirall_' . $key, array( 'label' => $key, 'section' => $section_id, 'type' => $data[2] ) );
	}
	$images = array(
		'mascot'       => 'لوگوی آینه‌ای متحرک',
		'hero_image_1' => 'تصویر اسلاید اول',
		'hero_image_2' => 'تصویر اسلاید دوم',
		'hero_image_3' => 'تصویر اسلاید سوم',
		'before_image' => 'تصویر قبل',
		'after_image'  => 'تصویر بعد',
	);
	foreach ( $images as $key => $label ) {
		$wp_customize->add_setting( 'mirall_' . $key, array( 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mirall_' . $key, array( 'label' => $label, 'section' => 'mirall_visuals' ) ) );
	}
	foreach ( array( 'wine' => array( 'رنگ اصلی', '#a24f61' ), 'wine_dark' => array( 'رنگ تیره', '#642536' ), 'paper' => array( 'پس‌زمینه', '#f9f1eb' ), 'rose' => array( 'صورتی پودری', '#d7ac9e' ), 'gold' => array( 'طلایی شامپاینی', '#ca9477' ), 'ink' => array( 'رنگ متن', '#523a2f' ) ) as $key => $data ) {
		$wp_customize->add_setting( 'mirall_' . $key, array( 'default' => $data[1], 'sanitize_callback' => 'sanitize_hex_color' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'mirall_' . $key, array( 'label' => $data[0], 'section' => 'mirall_colors' ) ) );
	}
}
add_action( 'customize_register', 'mirall_luxe_customize_register' );

function mirall_luxe_custom_colors(): void {
	printf(
		'<style>:root{--wine:%1$s;--wine-dark:%2$s;--paper:%3$s;--rose:%4$s;--gold:%5$s;--ink:%6$s}</style>',
		esc_attr( mirall_option( 'wine', '#a24f61' ) ),
		esc_attr( mirall_option( 'wine_dark', '#642536' ) ),
		esc_attr( mirall_option( 'paper', '#f9f1eb' ) ),
		esc_attr( mirall_option( 'rose', '#d7ac9e' ) ),
		esc_attr( mirall_option( 'gold', '#ca9477' ) ),
		esc_attr( mirall_option( 'ink', '#523a2f' ) )
	);
}
add_action( 'wp_head', 'mirall_luxe_custom_colors', 30 );

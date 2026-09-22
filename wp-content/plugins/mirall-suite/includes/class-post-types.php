<?php
defined( 'ABSPATH' ) || exit;

final class Mirall_Post_Types {
	public static function init(): void { add_action( 'init', array( __CLASS__, 'register' ) ); add_action( 'add_meta_boxes', array( __CLASS__, 'boxes' ) ); add_action( 'save_post', array( __CLASS__, 'save' ) ); }
	public static function register(): void {
		$types = array(
			'mirall_service'   => array( 'خدمات', 'خدمت', 'dashicons-star-filled' ),
			'mirall_model'     => array( 'مدل‌ها', 'مدل', 'dashicons-format-gallery' ),
			'mirall_portfolio' => array( 'نمونه‌کارها', 'نمونه‌کار', 'dashicons-images-alt2' ),
			'mirall_staff'     => array( 'متخصصان', 'متخصص', 'dashicons-groups' ),
			'mirall_video'     => array( 'ویدیوها', 'ویدیو', 'dashicons-video-alt3' ),
			'mirall_before_after' => array( 'قبل و بعد', 'نمونه قبل و بعد', 'dashicons-image-flip-horizontal' ),
			'mirall_review'    => array( 'بازخوردها', 'بازخورد', 'dashicons-format-quote' ),
		);
		foreach ( $types as $type => $labels ) {
			register_post_type( $type, array( 'labels' => array( 'name' => $labels[0], 'singular_name' => $labels[1], 'add_new_item' => 'افزودن ' . $labels[1], 'edit_item' => 'ویرایش ' . $labels[1] ), 'public' => ! in_array( $type, array( 'mirall_review', 'mirall_before_after' ), true ), 'show_ui' => true, 'show_in_rest' => true, 'menu_icon' => $labels[2], 'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ), 'has_archive' => true, 'rewrite' => array( 'slug' => str_replace( 'mirall_', 'mirall-', $type ) ) ) );
		}
		register_taxonomy( 'mirall_service_category', 'mirall_service', array( 'label' => 'دسته‌های خدمات', 'public' => true, 'show_in_rest' => true, 'hierarchical' => true, 'rewrite' => array( 'slug' => 'service-category' ) ) );
		register_taxonomy( 'mirall_portfolio_category', array( 'mirall_portfolio', 'mirall_video' ), array( 'label' => 'دسته‌های نمونه‌کار', 'public' => true, 'show_in_rest' => true, 'hierarchical' => true, 'rewrite' => array( 'slug' => 'portfolio-category' ) ) );
	}
	public static function boxes(): void {
		add_meta_box( 'mirall_service_info', 'جزئیات خدمت', array( __CLASS__, 'service_box' ), 'mirall_service', 'side' );
		add_meta_box( 'mirall_model_info', 'اتصال مدل', array( __CLASS__, 'model_box' ), 'mirall_model', 'side' );
		add_meta_box( 'mirall_video_info', 'منبع ویدیو', array( __CLASS__, 'video_box' ), 'mirall_video', 'side' );
		add_meta_box( 'mirall_portfolio_info', 'منبع نمونه‌کار', array( __CLASS__, 'video_box' ), 'mirall_portfolio', 'side' );
		add_meta_box( 'mirall_before_after_info', 'جفت تصویر تأییدشده', array( __CLASS__, 'before_after_box' ), 'mirall_before_after', 'normal' );
		add_meta_box( 'mirall_review_info', 'منبع بازخورد', array( __CLASS__, 'review_box' ), 'mirall_review', 'side' );
	}
	public static function service_box( WP_Post $post ): void {
		wp_nonce_field( 'mirall_meta', 'mirall_meta_nonce' );
		foreach ( array( '_mirall_duration' => 'مدت (دقیقه)', '_mirall_price' => 'قیمت پایه (تومان)', '_mirall_capacity' => 'ظرفیت همزمان' ) as $key => $label ) printf( '<p><label>%1$s<input style="width:100%%" type="number" name="%2$s" value="%3$s"></label></p>', esc_html( $label ), esc_attr( $key ), esc_attr( get_post_meta( $post->ID, $key, true ) ) );
	}
	public static function model_box( WP_Post $post ): void {
		wp_nonce_field( 'mirall_meta', 'mirall_meta_nonce' );
		$selected = (int) get_post_meta( $post->ID, '_mirall_service_id', true );
		$services = get_posts( array( 'post_type' => 'mirall_service', 'numberposts' => -1 ) );
		echo '<select name="_mirall_service_id" style="width:100%"><option value="0">بدون اتصال</option>';
		foreach ( $services as $service ) printf( '<option value="%1$d" %2$s>%3$s</option>', $service->ID, selected( $selected, $service->ID, false ), esc_html( $service->post_title ) );
		echo '</select>';
	}
	public static function video_box( WP_Post $post ): void {
		wp_nonce_field( 'mirall_meta', 'mirall_meta_nonce' );
		foreach ( array( '_mirall_source_url' => 'لینک ریل یا ویدیو', '_mirall_category' => 'دسته خدمت' ) as $key => $label ) printf( '<p><label>%1$s<input style="width:100%%" type="text" name="%2$s" value="%3$s"></label></p>', esc_html( $label ), esc_attr( $key ), esc_attr( get_post_meta( $post->ID, $key, true ) ) );
	}
	public static function before_after_box( WP_Post $post ): void {
		wp_nonce_field( 'mirall_meta', 'mirall_meta_nonce' );
		foreach ( array( '_mirall_before_image' => 'آدرس تصویر قبل', '_mirall_after_image' => 'آدرس تصویر بعد', '_mirall_source_url' => 'منبع اصلی نمونه' ) as $key => $label ) printf( '<p><label>%1$s<input style="width:100%%" type="url" name="%2$s" value="%3$s"></label></p>', esc_html( $label ), esc_attr( $key ), esc_attr( get_post_meta( $post->ID, $key, true ) ) );
	}
	public static function review_box( WP_Post $post ): void {
		wp_nonce_field( 'mirall_meta', 'mirall_meta_nonce' );
		foreach ( array( '_mirall_reviewer' => 'نام نمایشی', '_mirall_review_source' => 'منبع' ) as $key => $label ) printf( '<p><label>%1$s<input style="width:100%%" type="text" name="%2$s" value="%3$s"></label></p>', esc_html( $label ), esc_attr( $key ), esc_attr( get_post_meta( $post->ID, $key, true ) ) );
	}
	public static function save( int $post_id ): void {
		if ( ! isset( $_POST['mirall_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mirall_meta_nonce'] ) ), 'mirall_meta' ) || ! current_user_can( 'edit_post', $post_id ) || wp_is_post_autosave( $post_id ) ) return;
		$numeric = array( '_mirall_duration', '_mirall_price', '_mirall_capacity', '_mirall_service_id' );
		$text = array( '_mirall_source_url', '_mirall_category', '_mirall_reviewer', '_mirall_review_source' );
		$url = array( '_mirall_before_image', '_mirall_after_image' );
		foreach ( $numeric as $key ) if ( isset( $_POST[ $key ] ) ) update_post_meta( $post_id, $key, absint( $_POST[ $key ] ) );
		foreach ( $text as $key ) if ( isset( $_POST[ $key ] ) ) update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		foreach ( $url as $key ) if ( isset( $_POST[ $key ] ) ) update_post_meta( $post_id, $key, esc_url_raw( wp_unslash( $_POST[ $key ] ) ) );
	}
}

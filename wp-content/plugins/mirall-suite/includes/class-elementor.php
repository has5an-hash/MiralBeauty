<?php
defined( 'ABSPATH' ) || exit;

final class Mirall_Elementor {
	public static function init(): void {
		add_action( 'elementor/elements/categories_registered', array( __CLASS__, 'category' ) );
		add_action( 'elementor/widgets/register', array( __CLASS__, 'widgets' ) );
	}
	public static function category( $manager ): void { $manager->add_category( 'mirall', array( 'title' => 'Mirall Beauty', 'icon' => 'eicon-favorite' ) ); }
	public static function widgets( $manager ): void {
		if ( ! class_exists( '\Elementor\Widget_Base' ) ) return;
		$manager->register( new Mirall_Elementor_Booking() );
		$manager->register( new Mirall_Elementor_Services() );
		$manager->register( new Mirall_Elementor_Models() );
		$manager->register( new Mirall_Elementor_Before_After() );
		$manager->register( new Mirall_Elementor_Mascot() );
	}
}

abstract class Mirall_Elementor_Base extends \Elementor\Widget_Base {
	public function get_categories(): array { return array( 'mirall' ); }
	public function get_icon(): string { return 'eicon-favorite'; }
	protected function content_control( string $id, string $label, string $default = '' ): void { $this->add_control( $id, array( 'label' => $label, 'type' => \Elementor\Controls_Manager::TEXT, 'default' => $default, 'label_block' => true ) ); }
}

final class Mirall_Elementor_Booking extends Mirall_Elementor_Base {
	public function get_name(): string { return 'mirall_booking'; } public function get_title(): string { return 'رزرو آنلاین میرال'; }
	protected function register_controls(): void { $this->start_controls_section( 'content', array( 'label' => 'محتوا' ) ); $this->content_control( 'button', 'متن دکمه', 'رزرو آنلاین نوبت' ); $this->end_controls_section(); }
	protected function render(): void { $s = $this->get_settings_for_display(); echo '<button class="button open-booking">' . esc_html( $s['button'] ) . '</button>' . do_shortcode( '[mirall_booking]' ); }
}
final class Mirall_Elementor_Services extends Mirall_Elementor_Base {
	public function get_name(): string { return 'mirall_services'; } public function get_title(): string { return 'خدمات میرال'; }
	protected function register_controls(): void { $this->start_controls_section( 'content', array( 'label' => 'محتوا' ) ); $this->content_control( 'title', 'عنوان', 'خدمات تخصصی میرال' ); $this->add_control( 'count', array( 'label' => 'تعداد', 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 4, 'min' => 1, 'max' => 12 ) ); $this->end_controls_section(); }
	protected function render(): void { $s = $this->get_settings_for_display(); $posts = get_posts( array( 'post_type' => 'mirall_service', 'numberposts' => absint( $s['count'] ) ) ); echo '<section class="services"><h2>' . esc_html( $s['title'] ) . '</h2><div class="service-grid">'; foreach ( $posts as $i => $post ) echo '<article class="service-card"><span class="service-no">0' . esc_html( (string) ( $i + 1 ) ) . '</span><h3>' . esc_html( $post->post_title ) . '</h3><p>' . esc_html( wp_trim_words( $post->post_content, 20 ) ) . '</p><button class="text-button open-booking" data-service="' . esc_attr( $post->post_title ) . '">رزرو این خدمت ←</button></article>'; echo '</div></section>'; }
}
final class Mirall_Elementor_Models extends Mirall_Elementor_Base {
	public function get_name(): string { return 'mirall_models'; } public function get_title(): string { return 'بروشور مدل‌ها'; }
	protected function register_controls(): void { $this->start_controls_section( 'content', array( 'label' => 'تنظیمات' ) ); $this->add_control( 'limit', array( 'label' => 'تعداد', 'type' => \Elementor\Controls_Manager::NUMBER, 'default' => 8 ) ); $this->end_controls_section(); }
	protected function render(): void { $s = $this->get_settings_for_display(); echo do_shortcode( '[mirall_models limit="' . absint( $s['limit'] ) . '"]' ); }
}
final class Mirall_Elementor_Before_After extends Mirall_Elementor_Base {
	public function get_name(): string { return 'mirall_before_after'; } public function get_title(): string { return 'قبل و بعد میرال'; }
	protected function register_controls(): void { $this->start_controls_section( 'images', array( 'label' => 'تصاویر' ) ); $this->add_control( 'before', array( 'label' => 'قبل', 'type' => \Elementor\Controls_Manager::MEDIA ) ); $this->add_control( 'after', array( 'label' => 'بعد', 'type' => \Elementor\Controls_Manager::MEDIA ) ); $this->end_controls_section(); }
	protected function render(): void { $s = $this->get_settings_for_display(); if ( empty( $s['before']['url'] ) || empty( $s['after']['url'] ) ) return; echo '<div class="comparison" style="--position:50%"><img class="comparison-before" src="' . esc_url( $s['before']['url'] ) . '" alt="قبل"><div class="comparison-after"><img src="' . esc_url( $s['after']['url'] ) . '" alt="بعد"></div><input type="range" min="0" max="100" value="50" aria-label="مقایسه قبل و بعد"><div class="comparison-line"><span>↔</span></div></div>'; }
}
final class Mirall_Elementor_Mascot extends Mirall_Elementor_Base {
	public function get_name(): string { return 'mirall_mascot'; } public function get_title(): string { return 'کاراکتر آینه میرال'; }
	protected function register_controls(): void { $this->start_controls_section( 'content', array( 'label' => 'محتوا' ) ); $this->content_control( 'text', 'پیام', 'برای رزرو آماده‌ای؟' ); $this->end_controls_section(); }
	protected function render(): void { $s = $this->get_settings_for_display(); echo '<div class="mascot" id="mascot-elementor"><img src="' . esc_url( get_theme_file_uri( '/assets/images/mirall-mirror-mascot.png' ) ) . '" alt="کاراکتر آینه‌ای میرال"><span>' . esc_html( $s['text'] ) . '</span></div>'; }
}


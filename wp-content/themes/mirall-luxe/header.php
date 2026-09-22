<?php
defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">رفتن به محتوای اصلی</a>
<div class="announcement">
	<span>رزرو و مشاوره: <?php echo esc_html( mirall_option( 'mobile', '09125707416' ) ); ?></span>
	<span>فرشته، مجتمع تجاری داریوش</span>
</div>
<header class="site-header" id="top">
	<div class="nav-wrap">
		<div class="brand-cluster">
			<div class="mascot-dock" aria-label="جایگاه لوگوی آینه‌ای میرال">
				<button class="mascot" id="mascot" type="button" aria-label="لوگوی آینه‌ای میرال؛ باز کردن رزرو">
					<span class="mascot-frame">
						<img src="<?php echo mirall_image_option( 'mascot', mirall_asset( 'mirall-mirror-logo-v3.png' ) ); ?>" alt="لوگوی آینه‌ای میرال با نوشته Mirall Beauty">
						<i class="glass-glint" aria-hidden="true"></i>
					</span>
					<span>برای رزرو آماده‌ای؟</span>
				</button>
			</div>
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="میرال بیوتی، صفحه اصلی">
				<span><strong>Mirall Beauty</strong><small><?php echo esc_html( mirall_option( 'tagline', 'خانهٔ زیبایی شما' ) ); ?></small></span>
			</a>
		</div>
		<button class="menu-toggle" aria-expanded="false" aria-controls="main-nav"><span></span><span></span><span></span><b>منو</b></button>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => 'nav',
				'container_id'   => 'main-nav',
				'container_class'=> 'main-nav',
				'items_wrap'     => '%3$s',
				'fallback_cb'    => 'mirall_primary_menu_fallback',
			)
		);
		?>
		<button class="button button-small open-booking">رزرو نوبت</button>
	</div>
</header>

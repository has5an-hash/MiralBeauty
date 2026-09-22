<?php
defined( 'ABSPATH' ) || exit;

/** One-click starter content installer for a clean WordPress installation. */
final class Mirall_Demo_Installer {
	public static function init(): void {
		add_action( 'admin_menu', array( __CLASS__, 'menu' ) );
		add_action( 'admin_post_mirall_install_demo', array( __CLASS__, 'install' ) );
	}

	public static function menu(): void {
		add_submenu_page( 'mirall-dashboard', 'نصب محتوای آماده', 'نصب دمو', 'manage_options', 'mirall-demo', array( __CLASS__, 'page' ) );
	}

	public static function page(): void {
		$done = get_option( 'mirall_demo_installed' );
		echo '<div class="wrap mirall-admin"><h1>نصب محتوای آمادهٔ میرال</h1>';
		if ( isset( $_GET['installed'] ) ) echo '<div class="notice notice-success"><p>محتوای آماده، برگهٔ خانه و منوی اصلی با موفقیت ساخته شدند.</p></div>';
		echo '<section class="mirall-demo-card"><p>این ابزار برگه‌های اصلی، مجله، مدل‌های نمونه و منوی سایت را ایجاد می‌کند. اطلاعات موجود حذف یا بازنویسی نمی‌شوند.</p>';
		if ( $done ) echo '<p><strong>دمو قبلاً نصب شده است.</strong> اجرای دوباره فقط موارد گم‌شده را می‌سازد.</p>';
		echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '"><input type="hidden" name="action" value="mirall_install_demo">';
		wp_nonce_field( 'mirall_install_demo' );
		submit_button( $done ? 'بررسی و تکمیل دوباره' : 'نصب محتوای آماده' );
		echo '</form></section></div>';
	}

	public static function install(): void {
		if ( ! current_user_can( 'manage_options' ) ) wp_die( 'دسترسی غیرمجاز' );
		check_admin_referer( 'mirall_install_demo' );
		Mirall_Post_Types::register();

		$pages = array(
			'خانه'             => array( 'home', '', 'default' ),
			'درباره ما'        => array( 'about', '', 'page-about.php' ),
			'خدمات'            => array( 'services', '', 'page-services.php' ),
			'بروشور زیبایی میرال' => array( 'beauty-brochure', '', 'page-beauty-brochure.php' ),
			'نمونه کارها'      => array( 'portfolio', '', 'page-portfolio.php' ),
			'ویدیوهای میرال'   => array( 'videos', '', 'page-videos.php' ),
			'قبل و بعد'        => array( 'before-after', '', 'page-before-after.php' ),
			'زیبایی‌نامه'      => array( 'beauty-journal', '', 'default' ),
			'تماس با ما'       => array( 'contact', '', 'page-contact.php' ),
			'حساب کاربری'      => array( 'account', '[mirall_login][mirall_account]', 'default' ),
			'رزرو نوبت'        => array( 'booking', '[mirall_booking]', 'default' ),
		);
		$page_ids = array();
		foreach ( $pages as $title => $data ) {
			$existing = get_page_by_path( $data[0], OBJECT, 'page' );
			if ( ! $existing ) $existing = get_page_by_title( $title, OBJECT, 'page' );
			$page_id = $existing ? $existing->ID : wp_insert_post( array( 'post_type' => 'page', 'post_status' => 'publish', 'post_title' => $title, 'post_name' => $data[0], 'post_content' => $data[1] ) );
			$page_ids[ $title ] = $page_id;
			if ( ! is_wp_error( $page_id ) ) {
				wp_update_post( array( 'ID' => $page_id, 'post_name' => $data[0] ) );
				update_post_meta( $page_id, '_wp_page_template', $data[2] );
			}
		}
		if ( ! is_wp_error( $page_ids['خانه'] ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', (int) $page_ids['خانه'] );
			update_option( 'page_for_posts', (int) $page_ids['زیبایی‌نامه'] );
		}
		if ( ! is_wp_error( $page_ids['حساب کاربری'] ) ) update_option( 'mirall_account_page', (int) $page_ids['حساب کاربری'] );
		if ( ! is_wp_error( $page_ids['رزرو نوبت'] ) ) update_option( 'mirall_booking_page', (int) $page_ids['رزرو نوبت'] );

		$menu_name = 'منوی اصلی میرال';
		$menu = wp_get_nav_menu_object( $menu_name );
		$menu_id = $menu ? (int) $menu->term_id : wp_create_nav_menu( $menu_name );
		if ( ! is_wp_error( $menu_id ) && ! wp_get_nav_menu_items( $menu_id ) ) {
			foreach ( array( 'خانه', 'خدمات', 'بروشور زیبایی میرال', 'نمونه کارها', 'ویدیوهای میرال', 'زیبایی‌نامه', 'درباره ما', 'تماس با ما', 'رزرو نوبت' ) as $title ) {
				wp_update_nav_menu_item( $menu_id, 0, array( 'menu-item-title' => $title, 'menu-item-object' => 'page', 'menu-item-object-id' => (int) $page_ids[ $title ], 'menu-item-type' => 'post_type', 'menu-item-status' => 'publish' ) );
			}
			$locations = get_theme_mod( 'nav_menu_locations', array() );
			$locations['primary'] = $menu_id;
			$locations['footer'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}

		$services = array(
			'رنگ و لایت' => 'بالیاژ، آمبره، هایلایت و اصلاح رنگ با بررسی سلامت مو و انتخاب تناژ هماهنگ.',
			'بالیاژ' => 'اجرای بالیاژ با تمرکز بر مرزهای نرم، درخشش طبیعی و تناژ متناسب با چهره.',
			'آمبره' => 'تغییر تدریجی رنگ از ریشه تا ساقه با انتخاب طیف روشن یا تیره متناسب با استایل شما.',
			'هایلایت' => 'هایلایت‌های ظریف یا پررنگ برای ساختن عمق، روشنایی و حرکت در مو.',
			'اصلاح رنگ' => 'بررسی رنگ فعلی و طراحی مسیر اصلاحی با اولویت سلامت و یکدستی مو.',
			'کراتین و احیای مو' => 'مراقبت و احیای مو با مشاوره پیش از اجرا و توضیح مراقبت‌های بعد از خدمت.',
			'هیرکات و براشینگ' => 'هیرکات و براشینگ متناسب با فرم صورت، جنس مو و سبک روزمره شما.',
			'میکاپ عروس' => 'طراحی چهره و میکاپ عروس با گفت‌وگو درباره سبک، لباس و حال‌وهوای مراسم.',
			'میکاپ مراسم' => 'میکاپ حرفه‌ای برای مراسم با تمرکز بر ماندگاری، تناسب رنگ و حفظ شخصیت چهره.',
			'خدمات ناخن' => 'کاشت، ژل، لمینت، ترمیم و طراحی ظریف ناخن با انتخاب مدل پیش از رزرو.',
			'اصلاح و لیفت ابرو' => 'اصلاح فرم و لیفت ابرو برای نظم بیشتر و هماهنگی با چهره.',
			'میکروبلیدینگ' => 'طراحی ابرو با بررسی فرم طبیعی و گفت‌وگوی دقیق درباره نتیجه مورد انتظار.',
			'کاشت و لیفت مژه' => 'کاشت یا لیفت مژه برای تأکید طبیعی‌تر بر فرم چشم و زیبایی نگاه.',
		);
		foreach ( $services as $title => $content ) {
			$existing = get_page_by_title( $title, OBJECT, 'mirall_service' );
			if ( ! $existing ) wp_insert_post( array( 'post_type' => 'mirall_service', 'post_status' => 'publish', 'post_title' => $title, 'post_content' => $content, 'post_excerpt' => $content ) );
		}
		$models = array( 'بالیاژ تیره و سرد', 'امبره بلوند باربی', 'بالیاژ بلوند صدفی', 'لایت روشن', 'میکاپ شیک میرال', 'هایلایت گرم و طبیعی' );
		foreach ( $models as $title ) if ( ! get_page_by_title( $title, OBJECT, 'mirall_model' ) ) wp_insert_post( array( 'post_type' => 'mirall_model', 'post_status' => 'publish', 'post_title' => $title, 'post_content' => 'انتخاب این مدل پیش از ثبت نوبت امکان‌پذیر است.' ) );
		$articles = array(
			'چطور تناژ مناسب پوستمان را انتخاب کنیم؟' => '<p>انتخاب رنگ مو فقط به روشن یا تیره بودن آن محدود نیست. تناژ پوست، رنگ چشم، سبک پوشش و میزان زمانی که برای مراقبت در خانه دارید، همگی در انتخاب نهایی اثر دارند.</p><h2>از عکس شروع کن، از مشاوره تصمیم بگیر</h2><p>چند تصویر از رنگ‌هایی که دوست دارید همراه خود داشته باشید، اما نتیجه را عیناً با یک عکس مقایسه نکنید. نور، جنس مو و پایه رنگ هر فرد متفاوت است.</p><h2>سه پرسش قبل از انتخاب</h2><p>آیا تغییر ملایم می‌خواهید یا روشنایی محسوس؟ چقدر برای ترمیم زمان دارید؟ و آیا سلامت مو اجازه روشن‌کردن بیشتر را می‌دهد؟ پاسخ همین پرسش‌ها مسیر مشاوره را روشن می‌کند.</p><p><a href="/booking/?service=color">برای مشاوره رنگ نوبت بگیر</a></p>',
			'مراقبت از مو بعد از رنگ و لایت' => '<p>رنگ و لایت زیبا با مراقبت درست ماندگارتر می‌شود. شست‌وشوی ملایم، آب ولرم و استفاده منظم از محصولات مناسب موهای رنگ‌شده، پایه این مراقبت است.</p><h2>شست‌وشوی آرام</h2><p>مو را با فاصله منطقی بشویید و هنگام خشک‌کردن حوله را روی ساقه نکشید. فشار ملایم، اصطکاک و وز را کمتر می‌کند.</p><h2>گرما را مدیریت کن</h2><p>پیش از سشوار یا ابزار حرارتی از محافظ حرارت استفاده کنید و دمای ابزار را تا حد لازم پایین نگه دارید.</p><p><a href="/booking/?service=highlight">برای انتخاب مدل لایت به بروشور برو</a></p>',
			'نکات مراقبت از موهای دکلره‌شده' => '<p>موهای دکلره‌شده به توجه بیشتری نیاز دارند. هدف مراقبت، حفظ رطوبت، کاهش کشیدگی و جلوگیری از آسیب تجمعی است.</p><h2>نرم‌کننده را جدی بگیر</h2><p>بعد از هر شست‌وشو از نرم‌کننده مناسب ساقه استفاده کنید و هفته‌ای یک‌بار ماسک مو را در برنامه بگذارید.</p><h2>مو را خیس رها نکن</h2><p>موهای خیس حساس‌ترند؛ آن‌ها را به‌آرامی آب‌گیری کنید و پیش از شانه‌کردن از محصول مناسب گره‌گشا کمک بگیرید.</p>',
			'چطور ماندگاری رنگ مو را بیشتر کنیم؟' => '<p>ماندگاری رنگ فقط به روز اجرای آن وابسته نیست. انتخاب محصول مناسب، شست‌وشوی کنترل‌شده و محافظت در برابر گرما و نور به حفظ تناژ کمک می‌کند.</p><h2>تناژ را بشناس</h2><p>اگر رنگ به‌مرور گرم‌تر می‌شود، در مراجعه بعدی این موضوع را با متخصص در میان بگذارید تا مسیر مراقبت و ترمیم دقیق‌تر انتخاب شود.</p><h2>ترمیم را عقب نینداز</h2><p>فاصله ترمیم برای هر رنگ و هر رشد مو متفاوت است؛ زمان مناسب را پس از مشاهده شرایط مو تعیین کنید.</p>',
			'راهنمای آماده‌شدن برای میکاپ مراسم' => '<p>برای میکاپ تمیز و ماندگار، آماده‌سازی پوست را از روز مراسم شروع نکنید. خواب کافی، آب‌رسانی و پرهیز از امتحان‌کردن محصول تازه، انتخاب‌های امن‌تری هستند.</p><h2>روز مراجعه</h2><p>با پوست تمیز و بدون لایه سنگین کرم یا ضدآفتاب وارد شوید و اگر به محصولی حساسیت دارید، حتماً پیش از شروع اطلاع دهید.</p><h2>سبک دلخواهت را نشان بده</h2><p>تصاویر مرجع کمک می‌کنند درباره میزان پوشش، درخشش و فرم چشم گفت‌وگوی دقیق‌تری داشته باشید.</p>',
			'انتخاب سبک مناسب میکاپ برای فرم چهره' => '<p>میکاپ خوب قرار نیست چهره را پشت یک سبک ثابت پنهان کند. فرم صورت، حالت چشم و شخصیت شما باید در طراحی دیده شوند.</p><h2>تعادل مهم‌تر از تقلید است</h2><p>یک تصویر مرجع را با ویژگی‌های چهره خود مقایسه کنید و به‌جای تقلید کامل، از آن برای توضیح حس و سبک استفاده کنید.</p>',
			'مراقبت بعد از خدمات ناخن' => '<p>بعد از خدمات ناخن، چند عادت ساده به دوام و ظاهر مرتب آن کمک می‌کند: از ناخن به‌عنوان ابزار استفاده نکنید، کوتیکول را نکنید و هنگام کار با مواد شوینده از دستکش استفاده کنید.</p><h2>ترمیم به‌موقع</h2><p>اگر ترک، جداشدگی یا حساسیت دیدید، ترمیم را به تأخیر نیندازید و برای بررسی با مجموعه تماس بگیرید.</p>',
			'نکات مراقبت از مژه و ابرو' => '<p>مژه و ابرو با مراقبت سبک و مداوم مرتب‌تر می‌مانند. در روزهای اول، تماس شدید، بخار زیاد و محصولات چرب را تا حد امکان محدود کنید.</p><h2>آرام و تمیز</h2><p>پاک‌کردن آرایش را با حرکت‌های نرم انجام دهید و در صورت قرمزی یا حساسیت، استفاده از محصول را متوقف و با متخصص مشورت کنید.</p>',
		);
		foreach ( $articles as $title => $content ) if ( ! get_page_by_title( $title, OBJECT, 'post' ) ) wp_insert_post( array( 'post_type' => 'post', 'post_status' => 'publish', 'post_title' => $title, 'post_content' => $content, 'post_excerpt' => wp_trim_words( wp_strip_all_tags( $content ), 28, '…' ) ) );
		$videos = array(
			'امبره فوق‌العاده خوش‌رنگ' => array( 'https://www.instagram.com/mirall_beauty_center/reel/DdcAPxMJKZl/', 'آمبره' ),
			'بالیاژ تیره و سرد' => array( 'https://www.instagram.com/mirall_beauty_center/p/Ddei4BFl84u/', 'بالیاژ' ),
			'میکاپ شیک میرال' => array( 'https://www.instagram.com/mirall_beauty_center/reel/DdT-TuiJJHP/', 'میکاپ' ),
			'لایت ظریف و روشن' => array( 'https://www.instagram.com/mirall_beauty_center/reel/Dc6ksjZJDQd/', 'لایت' ),
			'بالیاژ بلوند صدفی' => array( 'https://www.instagram.com/mirall_beauty_center/reel/Dc3D45tJMxA/', 'بالیاژ' ),
			'امبره و ظرافت خط‌ها' => array( 'https://www.instagram.com/mirall_beauty_center/p/Dcto96-JvpI/', 'امبره' ),
		);
		foreach ( $videos as $title => $video ) {
			if ( get_page_by_title( $title, OBJECT, 'mirall_video' ) ) continue;
			$id = wp_insert_post( array( 'post_type' => 'mirall_video', 'post_status' => 'publish', 'post_title' => $title, 'post_content' => 'این ویدیو از ریل عمومی صفحه رسمی میرال انتخاب شده است.' ) );
			if ( $id && ! is_wp_error( $id ) ) { update_post_meta( $id, '_mirall_source_url', $video[0] ); update_post_meta( $id, '_mirall_category', $video[1] ); }
		}
		$portfolio = array(
			'ترمیم دکلره' => array( 'https://www.instagram.com/mirall_beauty_center/p/Dbgf7kRJjbR/', 'رنگ مو' ),
			'موی کوتاه و سبک تازه' => array( 'https://www.instagram.com/mirall_beauty_center/p/CrvBLJzNH24/', 'هیرکات' ),
			'بالیاژ تیره و سرد' => array( 'https://www.instagram.com/mirall_beauty_center/p/Ddei4BFl84u/', 'بالیاژ' ),
			'امبره خوش‌رنگ' => array( 'https://www.instagram.com/mirall_beauty_center/reel/DdcAPxMJKZl/', 'امبره' ),
			'میکاپ شیک میرال' => array( 'https://www.instagram.com/mirall_beauty_center/reel/DdT-TuiJJHP/', 'میکاپ' ),
			'ظرافت بالیاژ' => array( 'https://www.instagram.com/mirall_beauty_center/p/DdRnEXwFz0N/', 'بالیاژ' ),
			'امبره بلوند باربی' => array( 'https://www.instagram.com/mirall_beauty_center/p/DdPECA9J0Di/', 'رنگ مو' ),
			'لایت محبوب میرال' => array( 'https://www.instagram.com/mirall_beauty_center/reel/Dc_FJwnJzso/', 'لایت' ),
			'لایت روشن و ظریف' => array( 'https://www.instagram.com/mirall_beauty_center/reel/Dc6ksjZJDQd/', 'لایت' ),
			'بالیاژ بلوند صدفی' => array( 'https://www.instagram.com/mirall_beauty_center/reel/Dc3D45tJMxA/', 'بالیاژ' ),
			'امبره و ظرافت خط‌ها' => array( 'https://www.instagram.com/mirall_beauty_center/p/Dcto96-JvpI/', 'امبره' ),
			'مراقبت و استایل مو' => array( 'https://www.instagram.com/mirall_beauty_center/reel/DIKB7SWNoj1/', 'مو' ),
		);
		foreach ( $portfolio as $title => $work ) {
			if ( get_page_by_title( $title, OBJECT, 'mirall_portfolio' ) ) continue;
			$id = wp_insert_post( array( 'post_type' => 'mirall_portfolio', 'post_status' => 'publish', 'post_title' => $title, 'post_content' => 'نمونه‌کار منتخب از صفحه عمومی میرال.' ) );
			if ( $id && ! is_wp_error( $id ) ) { update_post_meta( $id, '_mirall_source_url', $work[0] ); update_post_meta( $id, '_mirall_category', $work[1] ); }
		}
		$reviews = array(
			'شیک و زیبا' => 'maryamgolestani_haircolor',
			'حرف نداره واقعا' => 'maryamhaircolourr',
			'فوق‌العاده' => 'keratin.mahshadmokhtari',
			'کارتون عالیه احسنت' => 'haircolorfarzanearabi',
			'عالی' => 'minloohair',
		);
		foreach ( $reviews as $content => $reviewer ) {
			if ( get_page_by_title( $content, OBJECT, 'mirall_review' ) ) continue;
			$id = wp_insert_post( array( 'post_type' => 'mirall_review', 'post_status' => 'publish', 'post_title' => $content, 'post_content' => $content ) );
			if ( $id && ! is_wp_error( $id ) ) { update_post_meta( $id, '_mirall_reviewer', '@' . $reviewer ); update_post_meta( $id, '_mirall_review_source', 'کامنت عمومی ریل Dc6ksjZJDQd' ); }
		}
		update_option( 'mirall_demo_installed', current_time( 'mysql' ) );
		flush_rewrite_rules();
		wp_safe_redirect( admin_url( 'admin.php?page=mirall-demo&installed=1' ) );
		exit;
	}
}

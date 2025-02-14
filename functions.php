<?php
/**
 * Classic Landing Page functions and definitions
 *
 * @package Classic Landing Page
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'classic_landing_page_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function classic_landing_page_setup() {
	global $content_width;   
	if ( ! isset( $content_width ) )
		$content_width = 680; 

	load_theme_textdomain( 'classic-landing-page', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );	
	add_theme_support( 'custom-header', array( 
		'default-text-color' => false,
		'header-text' => false,
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
	) );	
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'classic-landing-page' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	add_editor_style( 'editor-style.css' );
} 
endif; // classic_landing_page_setup
add_action( 'after_setup_theme', 'classic_landing_page_setup' );

function classic_landing_page_the_breadcrumb() {
    echo '<div class="breadcrumb my-3">';

    if (!is_home()) {
        echo '<a class="home-main align-self-center" href="' . esc_url(home_url()) . '">';
        bloginfo('name');
        echo "</a>";

        if (is_category() || is_single()) {
            the_category(' , ');
            if (is_single()) {
                echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (is_page()) {
            echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
        }
    }

    echo '</div>';
}

function classic_landing_page_widgets_init() {
	register_sidebar( array( 
		'name'          => __( 'Blog Sidebar', 'classic-landing-page' ),
		'description'   => __( 'Appears on blog page sidebar', 'classic-landing-page' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'classic-landing-page' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'classic-landing-page' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'classic-landing-page' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'classic-landing-page' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'classic-landing-page' ),
		'description'   => __( 'Appears on shop page', 'classic-landing-page' ),
		'id'            => 'woocommerce_sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar(array(
        'name'          => __('Single Product Sidebar', 'classic-landing-page'),
        'description'   => __('Sidebar for single product pages', 'classic-landing-page'),
		'id'            => 'woocommerce-single-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));	

	$classic_landing_page_widget_areas = get_theme_mod('classic_landing_page_footer_widget_areas', '4');
	for ($classic_landing_page_i=1; $classic_landing_page_i<=$classic_landing_page_widget_areas; $classic_landing_page_i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Widget ', 'classic-landing-page' ) . $classic_landing_page_i,
			'id'            => 'footer-' . $classic_landing_page_i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

}
add_action( 'widgets_init', 'classic_landing_page_widgets_init' );

// Change number of products per row to 3
add_filter('loop_shop_columns', 'classic_landing_page_loop_columns');
if (!function_exists('classic_landing_page_loop_columns')) {
    function classic_landing_page_loop_columns() {
        $colm = get_theme_mod('classic_landing_page_products_per_row', 3); // Default to 3 if not set
        return $colm;
    }
}

// Use the customizer setting to set the number of products per page
function classic_landing_page_products_per_page($cols) {
    $cols = get_theme_mod('classic_landing_page_products_per_page', 9); // Default to 9 if not set
    return $cols;
}
add_filter('loop_shop_per_page', 'classic_landing_page_products_per_page', 9);

function classic_landing_page_add_google_fonts() {
	wp_enqueue_style( 'classic-landing-page-google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', false ); 
}
add_action( 'wp_enqueue_scripts', 'classic_landing_page_add_google_fonts' );

function classic_landing_page_scripts() {
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri())."/css/bootstrap.css" );
	wp_enqueue_style( 'classic-landing-page-style', get_stylesheet_uri() );
	wp_style_add_data('classic-landing-page-style', 'rtl', 'replace');
	wp_enqueue_style( 'classic-landing-page-responsive', esc_url(get_template_directory_uri())."/css/responsive.css" );
	wp_enqueue_style( 'classic-landing-page-default', esc_url(get_template_directory_uri())."/css/default.css" );

	require get_parent_theme_file_path( '/inc/color-scheme/custom-color-control.php' );
	wp_add_inline_style( 'classic-landing-page-style',$classic_landing_page_color_scheme_css );

	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()). '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'classic-landing-page-theme', esc_url(get_template_directory_uri()) . '/js/theme.js' );
	
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri())."/css/fontawesome-all.css" );	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// font-family
	$classic_landing_page_headings_font = esc_html(get_theme_mod('classic_landing_page_headings_fonts'));
	$classic_landing_page_body_font = esc_html(get_theme_mod('classic_landing_page_body_fonts'));

	if ($classic_landing_page_headings_font) {
	    wp_enqueue_style('classic-landing-page-headings-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($classic_landing_page_headings_font));
	} else {
	    wp_enqueue_style('poppins-headings', 'https://fonts.googleapis.com/css?family=Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
	}

	if ($classic_landing_page_body_font) {
	    wp_enqueue_style('classic-landing-page-body-fonts', 'https://fonts.googleapis.com/css?family=' . urlencode($classic_landing_page_body_font));
	} else {
	    wp_enqueue_style('poppins-body', 'https://fonts.googleapis.com/css?family=Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
	}
}

add_action( 'wp_enqueue_scripts', 'classic_landing_page_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Theme Info Page.
 */
require get_template_directory() . '/inc/addon.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/upgrade-to-pro.php';

/**
 * Load TGM.
 */
require get_template_directory() . '/inc/tgm/tgm.php';

if ( ! function_exists( 'classic_landing_page_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */

// Footer Link
define('CLASSIC_LANDING_PAGE_FOOTER_LINK',__('https://www.theclassictemplates.com/products/free-landing-page-wordpress-theme','classic-landing-page'));

if ( ! defined( 'CLASSIC_LANDING_PAGE_THEME_PAGE' ) ) {
define('CLASSIC_LANDING_PAGE_THEME_PAGE',__('https://www.theclassictemplates.com/collections/best-wordpress-templates','classic-landing-page'));
}
if ( ! defined( 'CLASSIC_LANDING_PAGE_SUPPORT' ) ) {
define('CLASSIC_LANDING_PAGE_SUPPORT',__('https://wordpress.org/support/theme/classic-landing-page/','classic-landing-page'));
}
if ( ! defined( 'CLASSIC_LANDING_PAGE_REVIEW' ) ) {
define('CLASSIC_LANDING_PAGE_REVIEW',__('https://wordpress.org/support/theme/classic-landing-page/reviews/','classic-landing-page'));
}
if ( ! defined( 'CLASSIC_LANDING_PAGE_PRO_DEMO' ) ) {
define('CLASSIC_LANDING_PAGE_PRO_DEMO',__('https://live.theclassictemplates.com/advertisement-landing-page/','classic-landing-page'));
}
if ( ! defined( 'CLASSIC_LANDING_PAGE_PREMIUM_PAGE' ) ) {
define('CLASSIC_LANDING_PAGE_PREMIUM_PAGE',__('https://www.theclassictemplates.com/products/advertisement-wordpress-theme','classic-landing-page'));
}
if ( ! defined( 'CLASSIC_LANDING_PAGE_THEME_DOCUMENTATION' ) ) {
define('CLASSIC_LANDING_PAGE_THEME_DOCUMENTATION',__('https://live.theclassictemplates.com/demo/docs/classic-landing-page-free/','classic-landing-page'));
}

/* Starter Content */
add_theme_support( 'starter-content', array(
	'widgets' => array(
		'footer-1' => array(
			'categories',
		),
		'footer-2' => array(
			'archives',
		),
		'footer-3' => array(
			'meta',
		),
		'footer-4' => array(
			'search',
		),
	),
));

// logo
function classic_landing_page_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;


$woocommerce_sidebar = get_theme_mod( 'classic_landing_page_woocommerce_sidebar_product' );
	if ( 'false' == $woocommerce_sidebar ) {
$woo_product_column = 'col-lg-12 col-md-12';
	} else { 
$woo_product_column = 'col-lg-9 col-md-9';
}

$woocommerce_shop_sidebar = get_theme_mod( 'classic_landing_page_woocommerce_sidebar_shop' );
	if ( 'false' == $woocommerce_shop_sidebar ) {
$woo_shop_column = 'col-lg-12 col-md-12';
	} else { 
$woo_shop_column = 'col-lg-9 col-md-9';
}

//sanitize number field
function classic_landing_page_sanitize_number_absint( $number, $setting ) {
  // Ensure $number is an absolute integer (whole number, zero or greater).
  $number = absint( $number );

  // If the input is an absolute integer, return it; otherwise, return the default
  return ( $number ? $number : $setting->default );
}

/*radio button sanitization*/
function classic_landing_page_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

if ( ! function_exists( 'classic_landing_page_sanitize_integer' ) ) {
	function classic_landing_page_sanitize_integer( $input ) {
		return (int) $input;
	}
}

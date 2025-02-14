<?php
/**
 * @package Classic Landing Page
 * Setup the WordPress core custom header feature.
 *
 * @uses classic_landing_page_header_style()
 */
function classic_landing_page_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'classic_landing_page_custom_header_args', array(		
		'default-text-color'     => 'fff',
		'width'                  => 1400,
		'height'                 => 280,
		'wp-head-callback'       => 'classic_landing_page_header_style',		
	) ) );
}
add_action( 'after_setup_theme', 'classic_landing_page_custom_header_setup' );

if ( ! function_exists( 'classic_landing_page_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see classic_landing_page_custom_header_setup().
 */
function classic_landing_page_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.header {
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat;
			background-position: center top;
			background-size:cover;
		}
	<?php endif; ?>	
	

	h1.site-title a {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_sitetitle_color')); ?>;
	}

	span.site-description {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_sitetagline_color')); ?>;
	}

	.header-top {
	    background: rgba(0, 0, 0, 0) linear-gradient(90deg, <?php echo esc_attr(get_theme_mod('classic_landing_page_bg1_color')); ?> 20%, <?php echo esc_attr(get_theme_mod('classic_landing_page_bg2_color')); ?> 15%) repeat scroll 0 0;
	}

	.logo {
		background: <?php echo esc_attr(get_theme_mod('classic_landing_page_logobg_color')); ?>;
	}

	a.mailaddress {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_email_color')); ?>;
	}

	.social-icons i {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_socialicons_color')); ?>;
	}

	.social-icons i:hover {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_socialiconshover_color')); ?>;
	}

	.contact-us a {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_buttontext_color')); ?>;
		background: <?php echo esc_attr(get_theme_mod('classic_landing_page_buttonbg1_color')); ?>;
	}

	.contact-us a:hover {
	    background: <?php echo esc_attr(get_theme_mod('classic_landing_page_buttonhover_color')); ?>;
	}

	.main-nav a, .page-template-template-home-page .main-nav a {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_meuns_color')); ?>;
	}

	.main-nav a:hover {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_meunshover_color')); ?>;
	}

	.main-nav ul ul.sub-menu a {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_submeuns_color')); ?> !important;
	} 

	.main-nav ul ul.sub-menu a:hover {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_submeunshover_color')); ?> !important;
	}

	.main-nav ul ul {
		background: <?php echo esc_attr(get_theme_mod('classic_landing_page_submeunsbg_color')); ?>;
	}

	.main-nav ul ul li {
		border-color: <?php echo esc_attr(get_theme_mod('classic_landing_page_submeunsborder_color')); ?>;
	}

	.content-inner-box h1 {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_bannertitle_color')); ?>;
	}

	.content-inner-box h2 a {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_bannersubtitle_color')); ?> !important;
	}

	.content-inner-box p {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_bannerdescription_color')); ?>;
	}

	.content-inner-box .pagemore a {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_bannerbtntext_color')); ?>;
		background: <?php echo esc_attr(get_theme_mod('classic_landing_page_bannerbtnbg1_color')); ?>;
	}

	.content-inner-box .pagemore a:hover {
		background: <?php echo esc_attr(get_theme_mod('classic_landing_page_bannerbtnhover_color')); ?>;
	}

	.text-inner-box {
		background: <?php echo esc_attr(get_theme_mod('classic_landing_page_projectbg_color')); ?>;
	}

	.text-inner-box h4 a {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_projecttext_color')); ?>;
	}

	#services_section h3 {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_projecttitle_color')); ?>;
	}

	.copywrap, .copywrap p, .copywrap p a{
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_footercoypright_color')); ?> !important;
	}
	#footer h3 {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_footertitle_color')); ?> !important;

	}
	#footer .textwidget p {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_footerdescription_color')); ?>;
	}
	#footer a {
		color: <?php echo esc_attr(get_theme_mod('classic_landing_page_footerlist_color')); ?>;
	}
	#footer {
		background-color: <?php echo esc_attr(get_theme_mod('classic_landing_page_footerbg_color')); ?>;
	}

	</style>
	<?php 
}
endif;
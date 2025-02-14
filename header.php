<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Classic Landing Page
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
  wp_body_open();
} else {
  do_action( 'wp_body_open' );
} ?>

<?php if ( get_theme_mod('classic_landing_page_preloader', false) != "") { ?>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
<?php }?>

<a class="screen-reader-text skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'classic-landing-page' ); ?></a>

<div id="pageholder" <?php if( get_theme_mod( 'classic_landing_page_box_layout', false) != "" ) { echo 'class="boxlayout"'; } ?>>

<div class="header-top">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-4">
        <div class="logo text-center">
          <?php classic_landing_page_the_custom_logo(); ?>
          <?php $classic_landing_page_blog_info = get_bloginfo( 'name' ); ?>
          <?php if ( ! empty( $classic_landing_page_blog_info ) ) : ?>
            <div class="site-branding-text">
              <?php if ( get_theme_mod('classic_landing_page_title_enable',true) != "") { ?>
                <?php if ( is_front_page() && is_home() ) : ?>
                  <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                <?php else : ?>
                  <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
                <?php endif; ?>
              <?php } ?>
              <?php endif; ?>
              <?php $classic_landing_page_description = get_bloginfo( 'description', 'display' );
              if ( $classic_landing_page_description || is_customize_preview() ) : ?>
                <?php if ( get_theme_mod('classic_landing_page_tagline_enable',true) != "") { ?>
                <span class="site-description"><?php echo esc_html( $classic_landing_page_description ); ?></span>
                <?php } ?>
              <?php endif; ?> 
            </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 text-lg-start text-md-end text-center">
        <a class="mailaddress" href="mailto:<?php echo esc_attr(get_theme_mod ('classic_landing_page_email_address','')); ?>"><?php echo esc_html(get_theme_mod ('classic_landing_page_email_address','')); ?></a>
      </div>
      <div class="col-lg-5 col-md-4">
        <div class="social-icons">
          <?php if ( get_theme_mod('classic_landing_page_fb_link') != "") { ?>
            <a title="<?php echo esc_attr('facebook', 'classic-landing-page'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_landing_page_fb_link')); ?>"><i class="fab fa-facebook-f"></i></a> 
          <?php } ?>
          <?php if ( get_theme_mod('classic_landing_page_twitt_link') != "") { ?>
            <a title="<?php echo esc_attr('twitter', 'classic-landing-page'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_landing_page_twitt_link')); ?>"><i class="fab fa-twitter"></i></a>
          <?php } ?>
          <?php if ( get_theme_mod('classic_landing_page_linked_link') != "") { ?> 
            <a title="<?php echo esc_attr('linkedin', 'classic-landing-page'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_landing_page_linked_link')); ?>"><i class="fab fa-linkedin-in"></i></a>
          <?php } ?>
          <?php if ( get_theme_mod('classic_landing_page_insta_link') != "") { ?> 
            <a title="<?php echo esc_attr('instagram', 'classic-landing-page'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_landing_page_insta_link')); ?>"><i class="fab fa-instagram"></i></a>
          <?php } ?>
          <?php if ( get_theme_mod('classic_landing_page_youtube_link') != "") { ?> 
            <a title="<?php echo esc_attr('youtube', 'classic-landing-page'); ?>" target="_blank" href="<?php echo esc_url(get_theme_mod('classic_landing_page_youtube_link')); ?>"><i class="fab fa-youtube"></i></a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="header <?php echo esc_attr(classic_landing_page_sticky_menu()); ?>">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-9">
      </div>
      <div class="col-lg-6 col-md-9 col-6 align-self-center">
        <div class="toggle-nav text-md-end">
          <button role="tab"><?php esc_html_e('MENU','classic-landing-page'); ?></button>
        </div>
        <div id="mySidenav" class="nav sidenav text-start text-lg-end">
          <nav id="site-navigation" class="main-nav" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu','classic-landing-page' ); ?>">
            <ul class="mobile_nav">
              <?php 
                wp_nav_menu( array( 
                  'theme_location' => 'primary',
                  'container_class' => 'main-menu' ,
                  'items_wrap' => '%3$s',
                  'fallback_cb' => 'wp_page_menu',
                ) ); 
               ?>
            </ul>
            <a href="javascript:void(0)" class="close-button"><?php esc_html_e('CLOSE','classic-landing-page'); ?></a>
          </nav>
        </div>
      </div>
      <div class="col-lg-2 col-md-3 col-6 align-self-center">
        <?php if ( get_theme_mod('classic_landing_page_contact_us_text') != "" || get_theme_mod('classic_landing_page_contact_us_url') != "") { ?> 
          <div class="contact-us text-end">
            <a href="<?php echo esc_url(get_theme_mod ('classic_landing_page_contact_us_url','')); ?>"><?php echo esc_html(get_theme_mod ('classic_landing_page_contact_us_text','CONTACT US','classic-landing-page')); ?></a>
          </div>
        <?php }?>
      </div>
    </div>
  </div>
</div>
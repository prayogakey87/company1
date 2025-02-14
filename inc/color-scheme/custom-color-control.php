<?php

$classic_landing_page_first_color = get_theme_mod('classic_landing_page_first_color');
$classic_landing_page_color_scheme_css = '';

/*------------------ Global Color -----------*/
$classic_landing_page_color_scheme_css .='.woocommerce span.onsale, .site-main .wp-block-button__link, .postsec-list .wp-block-button__link, .slider-img-color, .nav-links .page-numbers, .page-links a, .page-links span, input.search-submit, .tagcloud a:hover, .copywrap, .breadcrumb a, .wpcf7 input[type="submit"],  button.wc-block-components-checkout-place-order-button, .wc-block-components-totals-coupon__button.contained{';
  $classic_landing_page_color_scheme_css .='background-color: '.esc_attr($classic_landing_page_first_color).'!important;';
$classic_landing_page_color_scheme_css .='}';

$classic_landing_page_color_scheme_css .='.contact-us a,.pagemore a,.woocommerce ul.products li.product .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button, .woocommerce button.button, .woocommerce #respond input#submit, #commentform input#submit, .text-inner-box, #button, #sidebar input.search-submit, #footer input.search-submit, form.woocommerce-product-search button, .widget_calendar caption, .widget_calendar #today, nav.woocommerce-MyAccount-navigation ul li{';
  $classic_landing_page_color_scheme_css .='background: '.esc_attr($classic_landing_page_first_color).'!important;';
$classic_landing_page_color_scheme_css .='}';

$classic_landing_page_color_scheme_css .= '.header-top {';
$classic_landing_page_color_scheme_css .= 'background: rgba(0, 0, 0, 0) linear-gradient(90deg, '.esc_attr($classic_landing_page_first_color).' 20%, #131313 15%) repeat scroll 0 0 !important;';
$classic_landing_page_color_scheme_css .= '}';
 
$classic_landing_page_color_scheme_css .='.postsec-list .wp-block-button.is-style-outline a, .listarticle h2 a:hover, #sidebar ul li a:hover, .ftr-4-box ul li a:hover, .ftr-4-box ul li.current_page_item a, .social-icons i:hover, .main-nav ul ul a:hover, .main-nav ul ul.sub-menu a, #sidebar ul li::before, #sidebar li a:hover, #sidebar .widget a:active, .ftr-4-box h5 span, .postmeta a:hover, #comments a, .added_to_cart, .posted_in a, .onsale, article .entry-content a,  #sidebar li a:hover, .nav-links a, .edit-link a, .site-title a, .content-inner-box h2 a:hover {';
  $classic_landing_page_color_scheme_css .='color: '.esc_attr($classic_landing_page_first_color).'!important;';
$classic_landing_page_color_scheme_css .='}';

$classic_landing_page_color_scheme_css .='.site-main .wp-block-button.is-style-outline a, .postsec-list .wp-block-button.is-style-outline a, .widget .tagcloud a:hover{';
  $classic_landing_page_color_scheme_css .='border: 1px solid '.esc_attr($classic_landing_page_first_color).'!important;';
$classic_landing_page_color_scheme_css .='}';

$classic_landing_page_color_scheme_css .='#sidebar input[type="text"], #sidebar input[type="search"], #footer input[type="search"]{';
  $classic_landing_page_color_scheme_css .='border: 2px solid '.esc_attr($classic_landing_page_first_color).'!important;';
$classic_landing_page_color_scheme_css .='}';

$classic_landing_page_color_scheme_css .='.main-nav li ul{';
  $classic_landing_page_color_scheme_css .='border-top: 3px solid '.esc_attr($classic_landing_page_first_color).'!important;';
$classic_landing_page_color_scheme_css .='}';

$classic_landing_page_color_scheme_css .='#sidebar .widget{';
  $classic_landing_page_color_scheme_css .='border-bottom: 3px solid '.esc_attr($classic_landing_page_first_color).'!important;';
$classic_landing_page_color_scheme_css .='}';

$classic_landing_page_color_scheme_css .='.tagcloud a:hover{';
  $classic_landing_page_color_scheme_css .='border-color: '.esc_attr($classic_landing_page_first_color).'!important;';
$classic_landing_page_color_scheme_css .='}';

$classic_landing_page_color_scheme_css .='blockquote{';
  $classic_landing_page_color_scheme_css .='border-left: 5px solid'.esc_attr($classic_landing_page_first_color).'!important;';
$classic_landing_page_color_scheme_css .='}';

$classic_landing_page_color_scheme_css .='
@media screen and (max-width: 1000px) {
  .sidenav {';
    $classic_landing_page_color_scheme_css .=' '.esc_attr($classic_landing_page_first_color).' !important;';
$classic_landing_page_color_scheme_css .='} }';  

$classic_landing_page_color_scheme_css .='
@media screen and (max-width: 767px) {
  .page-template-template-home-page .header {';
    $classic_landing_page_color_scheme_css .='background: '.esc_attr($classic_landing_page_first_color).' !important;';
$classic_landing_page_color_scheme_css .='} }';  

//---------------------------------Logo-Max-height--------- 
$classic_landing_page_logo_width = get_theme_mod('classic_landing_page_logo_width');

if($classic_landing_page_logo_width != false){

  $classic_landing_page_color_scheme_css .='.logo .custom-logo-link img{';

    $classic_landing_page_color_scheme_css .='width: '.esc_html($classic_landing_page_logo_width).'px;';

  $classic_landing_page_color_scheme_css .='}';
}

// slider hide css
$classic_landing_page_disabled_pgboxes_1 = get_theme_mod( 'classic_landing_page_disabled_pgboxes_1', false);
  $classic_landing_page_pageboxes = get_theme_mod('classic_landing_page_pageboxes');
if($classic_landing_page_disabled_pgboxes_1 != true || $classic_landing_page_pageboxes != true){
  $classic_landing_page_color_scheme_css .='.page-template-template-home-page .header {';
    $classic_landing_page_color_scheme_css .='position:static; background-color:#f3f3f3;';
  $classic_landing_page_color_scheme_css .='}';
  $classic_landing_page_color_scheme_css .='.page-template-template-home-page p.site-title a, .page-template-template-home-page span.site-description, .page-template-template-home-page .main-nav a{';
    $classic_landing_page_color_scheme_css .='color:#3c3c3c;';
  $classic_landing_page_color_scheme_css .='}';
}

/*---------------------------Slider Height ------------*/

  $classic_landing_page_slider_img_height = get_theme_mod('classic_landing_page_slider_img_height');
  if($classic_landing_page_slider_img_height != false){
      $classic_landing_page_color_scheme_css .='.img-inner-box img{';
          $classic_landing_page_color_scheme_css .='height: '.esc_attr($classic_landing_page_slider_img_height).' !important;';
      $classic_landing_page_color_scheme_css .='}';
  }

/*--------------------------- Footer background image -------------------*/

  $classic_landing_page_footer_bg_image = get_theme_mod('classic_landing_page_footer_bg_image');
  if($classic_landing_page_footer_bg_image != false){
      $classic_landing_page_color_scheme_css .='.footer-widget{';
          $classic_landing_page_color_scheme_css .='background: url('.esc_attr($classic_landing_page_footer_bg_image).')!important;';
      $classic_landing_page_color_scheme_css .='}';
  }

  /*--------------------------- Footer Background Color -------------------*/

  $classic_landing_page_footer_bg_color = get_theme_mod('classic_landing_page_footer_bg_color');
  if($classic_landing_page_footer_bg_color != false){
      $classic_landing_page_color_scheme_css .='.footer-widget{';
          $classic_landing_page_color_scheme_css .='background-color: '.esc_attr($classic_landing_page_footer_bg_color).' !important;';
      $classic_landing_page_color_scheme_css .='}';
  }

  /*--------------------------- Blog Post Page Image Box Shadow -------------------*/

  $classic_landing_page_blog_post_page_image_box_shadow = get_theme_mod('classic_landing_page_blog_post_page_image_box_shadow',0);
  if($classic_landing_page_blog_post_page_image_box_shadow != false){
      $classic_landing_page_color_scheme_css .='.post-thumb img{';
          $classic_landing_page_color_scheme_css .='box-shadow: '.esc_attr($classic_landing_page_blog_post_page_image_box_shadow).'px '.esc_attr($classic_landing_page_blog_post_page_image_box_shadow).'px '.esc_attr($classic_landing_page_blog_post_page_image_box_shadow).'px #cccccc;';
      $classic_landing_page_color_scheme_css .='}';
  }


/*--------------------------- Scroll to top positions -------------------*/

  $classic_landing_page_scroll_position = get_theme_mod( 'classic_landing_page_scroll_position','Right');
  if($classic_landing_page_scroll_position == 'Right'){
      $classic_landing_page_color_scheme_css .='#button{';
          $classic_landing_page_color_scheme_css .='right: 20px;';
      $classic_landing_page_color_scheme_css .='}';
  }else if($classic_landing_page_scroll_position == 'Left'){
      $classic_landing_page_color_scheme_css .='#button{';
          $classic_landing_page_color_scheme_css .='left: 20px;';
      $classic_landing_page_color_scheme_css .='}';
  }else if($classic_landing_page_scroll_position == 'Center'){
      $classic_landing_page_color_scheme_css .='#button{';
          $classic_landing_page_color_scheme_css .='right: 50%;left: 50%;';
      $classic_landing_page_color_scheme_css .='}';
  }    

  /*--------------------------- Woocommerce Product Image Border Radius -------------------*/

  $classic_landing_page_woo_product_img_border_radius = get_theme_mod('classic_landing_page_woo_product_img_border_radius');
  if($classic_landing_page_woo_product_img_border_radius != false){
      $classic_landing_page_color_scheme_css .='.woocommerce ul.products li.product a img{';
          $classic_landing_page_color_scheme_css .='border-radius: '.esc_attr($classic_landing_page_woo_product_img_border_radius).'px;';
      $classic_landing_page_color_scheme_css .='}';
  }

/*--------------------------- Woocommerce Product Sale Position -------------------*/    

$classic_landing_page_product_sale_position = get_theme_mod( 'classic_landing_page_product_sale_position','Left');
if($classic_landing_page_product_sale_position == 'Right'){
  $classic_landing_page_color_scheme_css .='.woocommerce ul.products li.product .onsale{';
      $classic_landing_page_color_scheme_css .='left:auto !important; right:.5em !important;';
  $classic_landing_page_color_scheme_css .='}';
}else if($classic_landing_page_product_sale_position == 'Left'){
  $classic_landing_page_color_scheme_css .='.woocommerce ul.products li.product .onsale {';
      $classic_landing_page_color_scheme_css .='right:auto !important; left:.5em !important;';
  $classic_landing_page_color_scheme_css .='}';
}   

/*--------------------------- Shop page pagination -------------------*/

$classic_landing_page_wooproducts_nav = get_theme_mod('classic_landing_page_wooproducts_nav', 'Yes');
if($classic_landing_page_wooproducts_nav == 'No'){
$classic_landing_page_color_scheme_css .='.woocommerce nav.woocommerce-pagination{';
  $classic_landing_page_color_scheme_css .='display: none;';
$classic_landing_page_color_scheme_css .='}';
}

/*--------------------------- Related Product -------------------*/

$classic_landing_page_related_product_enable = get_theme_mod('classic_landing_page_related_product_enable',true);
if($classic_landing_page_related_product_enable == false){
$classic_landing_page_color_scheme_css .='.related.products{';
  $classic_landing_page_color_scheme_css .='display: none;';
$classic_landing_page_color_scheme_css .='}';
}    

/*--------------------------- Preloader Background Image ------------*/

$classic_landing_page_preloader_bg_image = get_theme_mod('classic_landing_page_preloader_bg_image');
if($classic_landing_page_preloader_bg_image != false){
  $classic_landing_page_color_scheme_css .='#preloader{';
    $classic_landing_page_color_scheme_css .='background: url('.esc_attr($classic_landing_page_preloader_bg_image).'); background-size: cover;';
  $classic_landing_page_color_scheme_css .='}';
}
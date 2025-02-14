<?php
/**
 * Classic Landing Page Theme Customizer
 *
 * @package Classic Landing Page
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function classic_landing_page_customize_register( $wp_customize ) {

	function classic_landing_page_sanitize_dropdown_pages( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function classic_landing_page_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

	wp_enqueue_style('classic-landing-page-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	//Logo
    $wp_customize->add_setting('classic_landing_page_logo_width',array(
		'default'=> '',
		'transport' => 'refresh',
		'sanitize_callback' => 'classic_landing_page_sanitize_integer'
	));
	$wp_customize->add_control(new Classic_Landing_Page_Slider_Custom_Control( $wp_customize, 'classic_landing_page_logo_width',array(
		'label'	=> esc_html__('Logo Width','classic-landing-page'),
		'section'=> 'title_tagline',
		'settings'=>'classic_landing_page_logo_width',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting('classic_landing_page_title_enable',array(
		'default' => true,
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_landing_page_title_enable', array(
	   'settings' => 'classic_landing_page_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','classic-landing-page'),
	   'type'      => 'checkbox'
	)); 

	// site title color
	$wp_customize->add_setting('classic_landing_page_sitetitle_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_sitetitle_color', array(
	   'settings' => 'classic_landing_page_sitetitle_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('classic_landing_page_tagline_enable',array(
		'default' => true,
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_landing_page_tagline_enable', array(
	   'settings' => 'classic_landing_page_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','classic-landing-page'),
	   'type'      => 'checkbox'
	));

	// site tagline color
	$wp_customize->add_setting('classic_landing_page_sitetagline_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_sitetagline_color', array(
	   'settings' => 'classic_landing_page_sitetagline_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// woocommerce section
	$wp_customize->add_section('classic_landing_page_woocommerce_page_settings', array(
		'title'    => __('WooCommerce Page Settings', 'classic-landing-page'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	$wp_customize->add_setting('classic_landing_page_shop_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'classic_landing_page_sanitize_checkbox'
	));
	$wp_customize->add_control('classic_landing_page_shop_page_sidebar',array(
		'type' => 'checkbox',
		'label' => __(' Check To Enable Shop page sidebar','classic-landing-page'),
		'section' => 'classic_landing_page_woocommerce_page_settings',
	));

    // shop page sidebar alignment
    $wp_customize->add_setting('classic_landing_page_shop_page_sidebar_position', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'classic_landing_page_sanitize_choices',
	));
	$wp_customize->add_control('classic_landing_page_shop_page_sidebar_position',array(
		'type'           => 'radio',
		'label'          => __('Shop Page Sidebar', 'classic-landing-page'),
		'section'        => 'classic_landing_page_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'classic-landing-page'),
			'Right Sidebar' => __('Right Sidebar', 'classic-landing-page'),
		),
	));	 

	$wp_customize->add_setting('classic_landing_page_wooproducts_nav',array(
		'default' => 'Yes',
		'sanitize_callback'	=> 'classic_landing_page_sanitize_choices'
	));
	$wp_customize->add_control('classic_landing_page_wooproducts_nav',array(
		'type' => 'select',
		'label' => __('Shop Page Products Navigation','classic-landing-page'),
		'choices' => array(
			 'Yes' => __('Yes','classic-landing-page'),
			 'No' => __('No','classic-landing-page'),
		 ),
		'section' => 'classic_landing_page_woocommerce_page_settings',
	));

	 $wp_customize->add_setting( 'classic_landing_page_single_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'classic_landing_page_sanitize_checkbox'
    ) );
    $wp_customize->add_control('classic_landing_page_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Check To Enable Single Product Page Sidebar','classic-landing-page'),
		'section' => 'classic_landing_page_woocommerce_page_settings'
    ));

	// single product page sidebar alignment
    $wp_customize->add_setting('classic_landing_page_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'classic_landing_page_sanitize_choices',
	));
	$wp_customize->add_control('classic_landing_page_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page Sidebar', 'classic-landing-page'),
		'section'        => 'classic_landing_page_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'classic-landing-page'),
			'Right Sidebar' => __('Right Sidebar', 'classic-landing-page'),
		),
	));	

	$wp_customize->add_setting('classic_landing_page_related_product_enable',array(
		'default' => true,
		'sanitize_callback'	=> 'classic_landing_page_sanitize_checkbox'
	));
	$wp_customize->add_control('classic_landing_page_related_product_enable',array(
		'type' => 'checkbox',
		'label' => __('Check To Enable Related product','classic-landing-page'),
		'section' => 'classic_landing_page_woocommerce_page_settings',
	));

	$wp_customize->add_setting( 'classic_landing_page_woo_product_img_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'classic_landing_page_sanitize_integer'
    ) );
    $wp_customize->add_control(new Classic_Landing_Page_Slider_Custom_Control( $wp_customize, 'classic_landing_page_woo_product_img_border_radius',array(
		'label'	=> esc_html__('Product Img Border Radius','classic-landing-page'),
		'section'=> 'classic_landing_page_woocommerce_page_settings',
		'settings'=>'classic_landing_page_woo_product_img_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

    // Add a setting for number of products per row
    $wp_customize->add_setting('classic_landing_page_products_per_row', array(
	   'default'   => '3',
	   'transport' => 'refresh',
	   'sanitize_callback' => 'classic_landing_page_sanitize_integer'
    ));
    $wp_customize->add_control('classic_landing_page_products_per_row', array(
	   'label'    => __('Products Per Row', 'classic-landing-page'),
	   'section'  => 'classic_landing_page_woocommerce_page_settings',
	   'settings' => 'classic_landing_page_products_per_row',
	   'type'     => 'select',
	   'choices'  => array(
		  '2' => '2',
		  '3' => '3',
		  '4' => '4',
	   ),
   ));

   // Add a setting for the number of products per page
   $wp_customize->add_setting('classic_landing_page_products_per_page', array(
	  'default'   => '9',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'classic_landing_page_sanitize_integer'
   ));
   $wp_customize->add_control('classic_landing_page_products_per_page', array(
	  'label'    => __('Products Per Page', 'classic-landing-page'),
	  'section'  => 'classic_landing_page_woocommerce_page_settings',
	  'settings' => 'classic_landing_page_products_per_page',
	  'type'     => 'number',
	  'input_attrs' => array(
		 'min'  => 1,
		 'step' => 1,
	 ),
   ));

   $wp_customize->add_setting('classic_landing_page_product_sale_position',array(
	'default' => 'Left',
	'sanitize_callback' => 'classic_landing_page_sanitize_choices'
	));
	$wp_customize->add_control('classic_landing_page_product_sale_position',array(
		'type' => 'radio',
		'label' => __('Product Sale Position','classic-landing-page'),
		'section' => 'classic_landing_page_woocommerce_page_settings',
		'choices' => array(
			'Left' => __('Left','classic-landing-page'),
			'Right' => __('Right','classic-landing-page'),
		),
	) );    

	//Theme Options
	$wp_customize->add_panel( 'classic_landing_page_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'classic-landing-page' ),
	) );
	
	//Site Layout Section
	$wp_customize->add_section('classic_landing_page_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section ','classic-landing-page'),
		'description' => __('<p class="sec-title">Manage Site Layout Section</p>','classic-landing-page'),
		'priority'	=> 1,
		'panel' => 'classic_landing_page_panel_area',
	));		

	$wp_customize->add_setting('classic_landing_page_preloader',array(
		'default' => false,
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_landing_page_preloader', array(
	   'section'   => 'classic_landing_page_site_layoutsec',
	   'label'	=> __('Check to Show preloader','classic-landing-page'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('classic_landing_page_preloader_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'classic_landing_page_preloader_bg_image',array(
        'section' => 'classic_landing_page_site_layoutsec',
		'label' => __('Preloader Background Image','classic-landing-page'),
	)));

	$wp_customize->add_setting('classic_landing_page_box_layout',array(
		'default' => false,
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_landing_page_box_layout', array(
	   'section'   => 'classic_landing_page_site_layoutsec',
	   'label'	=> __('Check to Show Box Layout','classic-landing-page'),
	   'type'      => 'checkbox'
 	));	

	$wp_customize->add_setting( 'classic_landing_page_theme_page_breadcrumb',array(
		'default' => false,
        'sanitize_callback'	=> 'classic_landing_page_sanitize_checkbox',
	));
	 $wp_customize->add_control('classic_landing_page_theme_page_breadcrumb',array(
       'section' => 'classic_landing_page_site_layoutsec',
	   'label' => __( 'Check To Enable Theme Page Breadcrumb','classic-landing-page' ),
	   'type' => 'checkbox'
    ));	

    // Add Settings and Controls for Page Layout
    $wp_customize->add_setting('classic_landing_page_sidebar_page_layout',array(
	  'default' => 'right',
	  'sanitize_callback' => 'classic_landing_page_sanitize_choices'
	));
	$wp_customize->add_control('classic_landing_page_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'classic-landing-page'),
		'section' => 'classic_landing_page_site_layoutsec',
		'choices' => array(
			'full' => __('Full','classic-landing-page'),
			'left' => __('Left','classic-landing-page'),
			'right' => __('Right','classic-landing-page'),
	),
	));		
	
	$wp_customize->add_setting( 'classic_landing_page_layout_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_landing_page_layout_settings_upgraded_features', array(
		'type'=> 'hidden',
		 'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/advertisement-wordpress-theme') ." '>Upgrade to Pro</a></span>",
		 'section' => 'classic_landing_page_site_layoutsec'
	));

	//Global Color
	$wp_customize->add_section('classic_landing_page_global_color', array(
		'title'    => __('Manage Global Color Section', 'classic-landing-page'),
		'panel'    => 'classic_landing_page_panel_area',
	));

	$wp_customize->add_setting('classic_landing_page_first_color', array(
		'default'           => '#ecc200',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'classic_landing_page_first_color', array(
		'label'    => __('Theme Color', 'classic-landing-page'),
		'section'  => 'classic_landing_page_global_color',
		'settings' => 'classic_landing_page_first_color',
	)));	

	$wp_customize->add_setting( 'classic_landing_page_global_color_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_landing_page_global_color_settings_upgraded_features', array(
		'type'=> 'hidden',
		 'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/advertisement-wordpress-theme') ." '>Upgrade to Pro</a></span>",
		 'section' => 'classic_landing_page_global_color'
	));

 	// Header Section
	$wp_customize->add_section('classic_landing_page_header_section', array(
        'title' => __('Manage Header Section', 'classic-landing-page'),
		'description' => __('<p class="sec-title">Manage Header Section</p>','classic-landing-page'),
        'priority' => null,
		'panel' => 'classic_landing_page_panel_area',
 	));

 	$wp_customize->add_setting('classic_landing_page_stickyheader',array(
		'default' => false,
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_landing_page_stickyheader', array(
	   'section'   => 'classic_landing_page_header_section',
	   'label'	=> __('Check To Show Sticky Header','classic-landing-page'),
	   'type'      => 'checkbox'
 	));

	// logobg color
	$wp_customize->add_setting('classic_landing_page_logobg_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_logobg_color', array(
	   'settings' => 'classic_landing_page_logobg_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' Logo BG Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// bg1 color
	$wp_customize->add_setting('classic_landing_page_bg1_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_bg1_color', array(
	   'settings' => 'classic_landing_page_bg1_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' BG Color 1', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// bg2 color
	$wp_customize->add_setting('classic_landing_page_bg2_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_bg2_color', array(
	   'settings' => 'classic_landing_page_bg2_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' BG Color 2', 'classic-landing-page'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('classic_landing_page_email_address',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_email',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_email_address', array(
	   'settings' => 'classic_landing_page_email_address',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __('Add Email Address', 'classic-landing-page'),
	   'type'      => 'text'
	));

	// email color
	$wp_customize->add_setting('classic_landing_page_email_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_email_color', array(
	   'settings' => 'classic_landing_page_email_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' Email Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// socialicons color
	$wp_customize->add_setting('classic_landing_page_socialicons_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_socialicons_color', array(
	   'settings' => 'classic_landing_page_socialicons_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' Social Icons Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// socialiconshover color
	$wp_customize->add_setting('classic_landing_page_socialiconshover_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_socialiconshover_color', array(
	   'settings' => 'classic_landing_page_socialiconshover_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' Social Icons Hover Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('classic_landing_page_contact_us_text',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_contact_us_text', array(
	   'settings' => 'classic_landing_page_contact_us_text',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __('Add Button Text', 'classic-landing-page'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('classic_landing_page_contact_us_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_contact_us_url', array(
	   'settings' => 'classic_landing_page_contact_us_url',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __('Add Button URL', 'classic-landing-page'),
	   'type'      => 'url'
	));

	// buttontext color
	$wp_customize->add_setting('classic_landing_page_buttontext_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_buttontext_color', array(
	   'settings' => 'classic_landing_page_buttontext_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' Button Text Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// buttonbg1 color
	$wp_customize->add_setting('classic_landing_page_buttonbg1_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_buttonbg1_color', array(
	   'settings' => 'classic_landing_page_buttonbg1_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' Button BG Color 1', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// buttonhover color
	$wp_customize->add_setting('classic_landing_page_buttonhover_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_buttonhover_color', array(
	   'settings' => 'classic_landing_page_buttonhover_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' Button Hover Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// meuns color
	$wp_customize->add_setting('classic_landing_page_meuns_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_meuns_color', array(
	   'settings' => 'classic_landing_page_meuns_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' Menus Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// meunshover color
	$wp_customize->add_setting('classic_landing_page_meunshover_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_meunshover_color', array(
	   'settings' => 'classic_landing_page_meunshover_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' Menus Hover Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// submeuns color
	$wp_customize->add_setting('classic_landing_page_submeuns_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_submeuns_color', array(
	   'settings' => 'classic_landing_page_submeuns_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' SubMenus Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// submeunshover color
	$wp_customize->add_setting('classic_landing_page_submeunshover_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_submeunshover_color', array(
	   'settings' => 'classic_landing_page_submeunshover_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' SubMenus Hover Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// submeunsbg color
	$wp_customize->add_setting('classic_landing_page_submeunsbg_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_submeunsbg_color', array(
	   'settings' => 'classic_landing_page_submeunsbg_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' SubMenus BG Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// submeunsborder color
	$wp_customize->add_setting('classic_landing_page_submeunsborder_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_submeunsborder_color', array(
	   'settings' => 'classic_landing_page_submeunsborder_color',
	   'section'   => 'classic_landing_page_header_section',
	   'label' => __(' SubMenus Border Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'classic_landing_page_header_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_landing_page_header_settings_upgraded_features', array(
		'type'=> 'hidden',
		 'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/advertisement-wordpress-theme') ." '>Upgrade to Pro</a></span>",
		 'section' => 'classic_landing_page_header_section'
	));

	// Social media Section
	$wp_customize->add_section('classic_landing_page_social_media_section', array(
        'title' => __('Manage Social Media Section', 'classic-landing-page'),
		'description' => __('<p class="sec-title">Manage Social Media Section</p>','classic-landing-page'),
        'priority' => null,
		'panel' => 'classic_landing_page_panel_area',
 	));

	$wp_customize->add_setting('classic_landing_page_fb_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_fb_link', array(
	   'settings' => 'classic_landing_page_fb_link',
	   'section'   => 'classic_landing_page_social_media_section',
	   'label' => __('Facebook Link', 'classic-landing-page'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_landing_page_twitt_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_twitt_link', array(
	   'settings' => 'classic_landing_page_twitt_link',
	   'section'   => 'classic_landing_page_social_media_section',
	   'label' => __('Twitter Link', 'classic-landing-page'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_landing_page_linked_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_linked_link', array(
	   'settings' => 'classic_landing_page_linked_link',
	   'section'   => 'classic_landing_page_social_media_section',
	   'label' => __('Linkdin Link', 'classic-landing-page'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_landing_page_insta_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_insta_link', array(
	   'settings' => 'classic_landing_page_insta_link',
	   'section'   => 'classic_landing_page_social_media_section',
	   'label' => __('Instagram Link', 'classic-landing-page'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting('classic_landing_page_youtube_link',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_youtube_link', array(
	   'settings' => 'classic_landing_page_youtube_link',
	   'section'   => 'classic_landing_page_social_media_section',
	   'label' => __('Youtube Link', 'classic-landing-page'),
	   'type'      => 'url'
	));

	$wp_customize->add_setting( 'classic_landing_page_media_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_landing_page_media_settings_upgraded_features', array(
		'type'=> 'hidden',
		 'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/advertisement-wordpress-theme') ." '>Upgrade to Pro</a></span>",
		 'section' => 'classic_landing_page_social_media_section'
	));

	// Home Category Dropdown Section
	$wp_customize->add_section('classic_landing_page_one_cols_section',array(
		'title'	=> __('Manage Banner Section','classic-landing-page'),
		'description'	=> __('<p class="sec-title">Manage Banner Section</p> Select Page from the Dropdown for banner, Also use the given image dimension (1400 x 600).','classic-landing-page'),
		'priority'	=> null,
		'panel' => 'classic_landing_page_panel_area'
	));

	//Hide Section
	$wp_customize->add_setting('classic_landing_page_disabled_pgboxes_1',array(
		'default' => false,
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	$wp_customize->add_control( 'classic_landing_page_disabled_pgboxes_1', array(
	   'settings' => 'classic_landing_page_disabled_pgboxes_1',
	   'section'   => 'classic_landing_page_one_cols_section',
	   'label'     => __('Check To Enable This Section','classic-landing-page'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('classic_landing_page_pgboxes_title',array(
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'classic_landing_page_pgboxes_title', array(
	   'section'   => 'classic_landing_page_one_cols_section',
	   'label'	=> __('Section Title','classic-landing-page'),
	   'type'      => 'text',
	   'priority' => null,
    ));
	
	$wp_customize->add_setting('classic_landing_page_pageboxes',array(
		'default'	=> '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'classic_landing_page_sanitize_dropdown_pages'
	));
	$wp_customize->add_control(	'classic_landing_page_pageboxes',array(
		'type' => 'dropdown-pages',
	  'label' => __( 'Select Page to display Banner','classic-landing-page'),
		'section' => 'classic_landing_page_one_cols_section',
	));

	$wp_customize->add_setting( 'classic_landing_page_banner_excerpt_number', array(
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'classic_landing_page_sanitize_number_absint',
	  'default' => 40,
	) );
	$wp_customize->add_control( 'classic_landing_page_banner_excerpt_number', array(
	  'settings' => 'classic_landing_page_banner_excerpt_number',
	  'type' => 'number',
	  'section' => 'classic_landing_page_one_cols_section',
	  'label' => __( 'Number Of Words To Show','classic-landing-page'),
	) );
	
	$wp_customize->add_setting('classic_landing_page_button_text',array(
		'default' => 'Go Now',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_button_text', array(
	   'settings' => 'classic_landing_page_button_text',
	   'section'   => 'classic_landing_page_one_cols_section',
	   'label' => __('Add Button Text', 'classic-landing-page'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('classic_landing_page_button_link_slider',array(
        'default'=> '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('classic_landing_page_button_link_slider',array(
        'label' => esc_html__('Add Button Link','classic-landing-page'),
        'section'=> 'classic_landing_page_one_cols_section',
        'type'=> 'url'
    ));

    //Slider height
    $wp_customize->add_setting('classic_landing_page_slider_img_height',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('classic_landing_page_slider_img_height',array(
        'label' => __('Banner Image Height','classic-landing-page'),
        'description'   => __('Add the banner image height here (eg. 600px)','classic-landing-page'),
        'input_attrs' => array(
            'placeholder' => __( '500px', 'classic-landing-page' ),
        ),
        'section'=> 'classic_landing_page_one_cols_section',
        'type'=> 'text'
    ));
 
	// banner title color
	$wp_customize->add_setting('classic_landing_page_bannertitle_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_bannertitle_color', array(
	   'settings' => 'classic_landing_page_bannertitle_color',
	   'section'   => 'classic_landing_page_one_cols_section',
	   'label' => __(' SubTitle Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// banner subtitle color
	$wp_customize->add_setting('classic_landing_page_bannersubtitle_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_bannersubtitle_color', array(
	   'settings' => 'classic_landing_page_bannersubtitle_color',
	   'section'   => 'classic_landing_page_one_cols_section',
	   'label' => __('Section Title Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// banner description color
	$wp_customize->add_setting('classic_landing_page_bannerdescription_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_bannerdescription_color', array(
	   'settings' => 'classic_landing_page_bannerdescription_color',
	   'section'   => 'classic_landing_page_one_cols_section',
	   'label' => __(' Description Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// banner btnbg1 color
	$wp_customize->add_setting('classic_landing_page_bannerbtnbg1_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_bannerbtnbg1_color', array(
	   'settings' => 'classic_landing_page_bannerbtnbg1_color',
	   'section'   => 'classic_landing_page_one_cols_section',
	   'label' => __(' Button BG Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// banner btntext color
	$wp_customize->add_setting('classic_landing_page_bannerbtntext_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_bannerbtntext_color', array(
	   'settings' => 'classic_landing_page_bannerbtntext_color',
	   'section'   => 'classic_landing_page_one_cols_section',
	   'label' => __(' Button Text Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// banner btnhover color
	$wp_customize->add_setting('classic_landing_page_bannerbtnhover_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_bannerbtnhover_color', array(
	   'settings' => 'classic_landing_page_bannerbtnhover_color',
	   'section'   => 'classic_landing_page_one_cols_section',
	   'label' => __(' Button BG Hover Color', 'classic-landing-page'),
	   'type'      => 'color'
	));	

	$wp_customize->add_setting( 'classic_landing_page_slider_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_landing_page_slider_settings_upgraded_features', array(
	    'type'=> 'hidden',
	    'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	        <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/advertisement-wordpress-theme') ." '>Upgrade to Pro</a></span>",
	    'section' => 'classic_landing_page_one_cols_section'
	));

	// Home Three Boxes Section 
	$wp_customize->add_section('classic_landing_page_below_banner_section', array(
		'title'	=> __('Manage Latest Projects Section','classic-landing-page'),
		'description'	=> __('<p class="sec-title">Manage Latest Projects Section</p> Select Pages from the dropdown for projects, Also use the given image dimension (250 x 250).','classic-landing-page'),
		'priority'	=> null,
		'panel' => 'classic_landing_page_panel_area',
	));

	$wp_customize->add_setting('classic_landing_page_disabled_pgboxes',array(
		'default' => false,
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	
	$wp_customize->add_control( 'classic_landing_page_disabled_pgboxes', array(
	   'settings' => 'classic_landing_page_disabled_pgboxes',
	   'section'   => 'classic_landing_page_below_banner_section',
	   'label'     => __('Check To Enable This Section','classic-landing-page'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('classic_landing_page_title',array(
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'classic_landing_page_title', array(
	   'section'   => 'classic_landing_page_below_banner_section',
	   'label'	=> __('Section Title','classic-landing-page'),
	   'type'      => 'text',
	   'priority' => null,
    ));

    for($p=0; $p<8; $p++) {	
	$wp_customize->add_setting('classic_landing_page_pageboxes'.$p,array(
		'default'	=> '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'classic_landing_page_sanitize_dropdown_pages'
	));
	$wp_customize->add_control(	'classic_landing_page_pageboxes'.$p,array(
		'type' => 'dropdown-pages',
		'label'     => __('Select Page to display Latest Projects','classic-landing-page'),
		'section' => 'classic_landing_page_below_banner_section',
	));
	}

	// Title color
	$wp_customize->add_setting('classic_landing_page_projecttitle_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_projecttitle_color', array(
	   'settings' => 'classic_landing_page_projecttitle_color',
	   'section'   => 'classic_landing_page_below_banner_section',
	   'label' => __('Title Color', 'classic-landing-page'),
	   'type'      => 'color'
	));	

	// Text BG color
	$wp_customize->add_setting('classic_landing_page_projectbg_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_projectbg_color', array(
	   'settings' => 'classic_landing_page_projectbg_color',
	   'section'   => 'classic_landing_page_below_banner_section',
	   'label' => __('Text BG Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	// Text color
	$wp_customize->add_setting('classic_landing_page_projecttext_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_projecttext_color', array(
	   'settings' => 'classic_landing_page_projecttext_color',
	   'section'   => 'classic_landing_page_below_banner_section',
	   'label' => __('Text Color', 'classic-landing-page'),
	   'type'      => 'color'
	));	

	$wp_customize->add_setting( 'classic_landing_page_secondsec_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_landing_page_secondsec_settings_upgraded_features', array(
	  'type'=> 'hidden',
	  'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	      <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/advertisement-wordpress-theme') ." '>Upgrade to Pro</a></span>",
	  'section' => 'classic_landing_page_below_banner_section'
	));

	//Blog post
	$wp_customize->add_section('classic_landing_page_blog_post_settings',array(
        'title' => __('Manage Post Section', 'classic-landing-page'),
        'priority' => null,
        'panel' => 'classic_landing_page_panel_area'
    ) );

	$wp_customize->add_setting('classic_landing_page_metafields_date', array(
	    'default' => true,
	    'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_landing_page_metafields_date', array(
	    'settings' => 'classic_landing_page_metafields_date', 
	    'section'   => 'classic_landing_page_blog_post_settings',
	    'label'     => __('Check to Enable Date', 'classic-landing-page'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('classic_landing_page_metafields_comments', array(
		'default' => true,
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));	
	$wp_customize->add_control('classic_landing_page_metafields_comments', array(
		'settings' => 'classic_landing_page_metafields_comments',
		'section'  => 'classic_landing_page_blog_post_settings',
		'label'    => __('Check to Enable Comments', 'classic-landing-page'),
		'type'     => 'checkbox',
	));

	$wp_customize->add_setting('classic_landing_page_metafields_author', array(
		'default' => true,
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_landing_page_metafields_author', array(
		'settings' => 'classic_landing_page_metafields_author',
		'section'  => 'classic_landing_page_blog_post_settings',
		'label'    => __('Check to Enable Author', 'classic-landing-page'),
		'type'     => 'checkbox',
	));		

	$wp_customize->add_setting('classic_landing_page_metafields_time', array(
		'default' => true,
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_landing_page_metafields_time', array(
		'settings' => 'classic_landing_page_metafields_time',
		'section'  => 'classic_landing_page_blog_post_settings',
		'label'    => __('Check to Enable Time', 'classic-landing-page'),
		'type'     => 'checkbox',
	));	

    // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('classic_landing_page_sidebar_post_layout',array(
		'default' => 'right',
		'sanitize_callback' => 'classic_landing_page_sanitize_choices'
	));
	$wp_customize->add_control('classic_landing_page_sidebar_post_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Post Sidebar Position', 'classic-landing-page'),
		'description'   => __('This option work for blog page, archive page and search page.', 'classic-landing-page'),
		'section' => 'classic_landing_page_blog_post_settings',
		'choices' => array(
			'full' => __('Full','classic-landing-page'),
			'left' => __('Left','classic-landing-page'),
			'right' => __('Right','classic-landing-page'),
			'three-column' => __('Three Columns','classic-landing-page'),
			'four-column' => __('Four Columns','classic-landing-page'),
			'grid' => __('Grid Layout','classic-landing-page')
     ),
	));

	$wp_customize->add_setting('classic_landing_page_blog_post_description_option',array(
    	'default'   => 'Full Content', 
        'sanitize_callback' => 'classic_landing_page_sanitize_choices'
	));
	$wp_customize->add_control('classic_landing_page_blog_post_description_option',array(
        'type' => 'radio',
        'label' => __('Post Description Length','classic-landing-page'),
        'section' => 'classic_landing_page_blog_post_settings',
        'choices' => array(
            'No Content' => __('No Content','classic-landing-page'),
            'Excerpt Content' => __('Excerpt Content','classic-landing-page'),
            'Full Content' => __('Full Content','classic-landing-page'),
        ),
	) );

	$wp_customize->add_setting('classic_landing_page_blog_post_thumb',array(
        'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('classic_landing_page_blog_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Show / Hide Blog Post Thumbnail', 'classic-landing-page'),
        'section'     => 'classic_landing_page_blog_post_settings',
    ));

    $wp_customize->add_setting( 'classic_landing_page_blog_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'classic_landing_page_sanitize_integer'
    ) );
    $wp_customize->add_control(new Classic_Landing_Page_Slider_Custom_Control( $wp_customize, 'classic_landing_page_blog_post_page_image_box_shadow',array(
		'label'	=> esc_html__('Blog Page Image Box Shadow','classic-landing-page'),
		'section'=> 'classic_landing_page_blog_post_settings',
		'settings'=>'classic_landing_page_blog_post_page_image_box_shadow',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting( 'classic_landing_page_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_landing_page_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		 'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/advertisement-wordpress-theme') ." '>Upgrade to Pro</a></span>",
		 'section' => 'classic_landing_page_blog_post_settings'
	));

	//Single Post Settings
	$wp_customize->add_section('classic_landing_page_single_post_settings',array(
		'title' => __('Manage Single Post Section', 'classic-landing-page'),
		'priority' => null,
		'panel' => 'classic_landing_page_panel_area'
	));

	$wp_customize->add_setting( 'classic_landing_page_single_page_breadcrumb',array(
		'default' => true,
        'sanitize_callback'	=> 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_landing_page_single_page_breadcrumb',array(
       'section' => 'classic_landing_page_single_post_settings',
	   'label' => __( 'Check To Enable Breadcrumb','classic-landing-page' ),
	   'type' => 'checkbox'
    ));	

	$wp_customize->add_setting('classic_landing_page_sidebar_single_post_layout',array(
    	'default' => 'right',
    	 'sanitize_callback' => 'classic_landing_page_sanitize_choices'
	));
	$wp_customize->add_control('classic_landing_page_sidebar_single_post_layout',array(
   		'type' => 'radio',
    	'label'     => __('Single post sidebar layout', 'classic-landing-page'),
     	'section' => 'classic_landing_page_single_post_settings',
     	'choices' => array(
			'full' => __('Full','classic-landing-page'),
			'left' => __('Left','classic-landing-page'),
			'right' => __('Right','classic-landing-page'),
     ),
	));

	$wp_customize->add_setting( 'classic_landing_page_single_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_landing_page_single_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/advertisement-wordpress-theme') ." '>Upgrade to Pro</a></span>",
		'section' => 'classic_landing_page_single_post_settings'
	));

	// Footer Section 
	$wp_customize->add_section('classic_landing_page_footer', array(
		'title'	=> __('Manage Footer Section','classic-landing-page'),
		'description'	=> __('<p class="sec-title">Manage Footer Section</p>','classic-landing-page'),
		'priority'	=> null,
		'panel' => 'classic_landing_page_panel_area',
	));

	$wp_customize->add_setting('classic_landing_page_footer_widget', array(
	    'default' => true,
	    'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control('classic_landing_page_footer_widget', array(
	    'settings' => 'classic_landing_page_footer_widget', // Corrected setting name
	    'section'   => 'classic_landing_page_footer',
	    'label'     => __('Check to Enable Footer Widget', 'classic-landing-page'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('classic_landing_page_footer_bg_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'classic_landing_page_footer_bg_color', array(
        'label'    => __('Footer Background Color', 'classic-landing-page'),
        'section'  => 'classic_landing_page_footer',
    )));

	$wp_customize->add_setting('classic_landing_page_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'classic_landing_page_footer_bg_image',array(
        'label' => __('Footer Background Image','classic-landing-page'),
        'section' => 'classic_landing_page_footer',
    )));

	$wp_customize->add_setting('classic_landing_page_copyright_line',array(
		'sanitize_callback' => 'sanitize_text_field',
	));	
	$wp_customize->add_control( 'classic_landing_page_copyright_line', array(
	   'section' 	=> 'classic_landing_page_footer',
	   'label'	 	=> __('Copyright Line','classic-landing-page'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	$wp_customize->add_setting('classic_landing_page_copyright_link',array(
    	'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'classic_landing_page_copyright_link', array(
	   'section' 	=> 'classic_landing_page_footer',
	   'label'	 	=> __('Copyright Link','classic-landing-page'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	//  footer bg color
	$wp_customize->add_setting('classic_landing_page_footer_bg_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_landing_page_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_footer_bg_color', array(
		'settings' => 'classic_landing_page_footer_bg_color',
		'section'   => 'classic_landing_page_footer',
		'label' => __('BG Color', 'classic-landing-page'),
		'type'      => 'color'
	));

	//  footer coypright color
	$wp_customize->add_setting('classic_landing_page_footercoypright_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_landing_page_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_footercoypright_color', array(
	   'settings' => 'classic_landing_page_footercoypright_color',
	   'section'   => 'classic_landing_page_footer',
	   'label' => __('Coypright Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	//  footer title color
	$wp_customize->add_setting('classic_landing_page_footertitle_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_landing_page_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_footertitle_color', array(
	   'settings' => 'classic_landing_page_footertitle_color',
	   'section'   => 'classic_landing_page_footer',
	   'label' => __('Title Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	//  footer description color
	$wp_customize->add_setting('classic_landing_page_footerdescription_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_landing_page_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_footerdescription_color', array(
	   'settings' => 'classic_landing_page_footerdescription_color',
	   'section'   => 'classic_landing_page_footer',
	   'label' => __('Description Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

	//  footer list color
	$wp_customize->add_setting('classic_landing_page_footerlist_color',array(
		'default' => '',
		'sanitize_callback' => 'classic_landing_page_sanitize_hex_color',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'classic_landing_page_footerlist_color', array(
	   'settings' => 'classic_landing_page_footerlist_color',
	   'section'   => 'classic_landing_page_footer',
	   'label' => __('List Color', 'classic-landing-page'),
	   'type'      => 'color'
	));

    $wp_customize->add_setting('classic_landing_page_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'classic_landing_page_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'classic_landing_page_scroll_hide',array(
        'label'          => __( 'Check To Show Scroll To Top', 'classic-landing-page' ),
        'section'        => 'classic_landing_page_footer',
        'settings'       => 'classic_landing_page_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('classic_landing_page_scroll_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'classic_landing_page_sanitize_choices'
    ));
    $wp_customize->add_control('classic_landing_page_scroll_position',array(
        'type' => 'radio',
        'section' => 'classic_landing_page_footer',
        'label'	 	=> __('Scroll To Top Positions','classic-landing-page'),
        'choices' => array(
            'Right' => __('Right','classic-landing-page'),
            'Left' => __('Left','classic-landing-page'),
            'Center' => __('Center','classic-landing-page')
        ),
    ) );

	$wp_customize->add_setting('classic_landing_page_footer_widget_areas',array(
		'default'           => 4,
		'sanitize_callback' => 'classic_landing_page_sanitize_choices',
	));
	$wp_customize->add_control('classic_landing_page_footer_widget_areas',array(
		'type'        => 'radio',
		'section' => 'classic_landing_page_footer',
		'label'       => __('Footer widget area', 'classic-landing-page'),
		'choices' => array(
		   '1'     => __('One', 'classic-landing-page'),
		   '2'     => __('Two', 'classic-landing-page'),
		   '3'     => __('Three', 'classic-landing-page'),
		   '4'     => __('Four', 'classic-landing-page')
		),
	));

    $wp_customize->add_setting( 'classic_landing_page_footer_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('classic_landing_page_footer_settings_upgraded_features', array(
	    'type'=> 'hidden',
	    'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	        <a target='_blank' href='". esc_url('https://www.theclassictemplates.com/products/advertisement-wordpress-theme') ." '>Upgrade to Pro</a></span>",
	    'section' => 'classic_landing_page_footer'
	));

	$wp_customize->add_setting('classic_landing_page_woocommerce_sidebar_shop',array(
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_landing_page_woocommerce_sidebar_shop', array(
	   'section'   => 'woocommerce_product_catalog',
	   'description'  => __('Click on the check box to remove sidebar from shop page.','classic-landing-page'),
	   'label'	=> __('Shop Page Sidebar layout','classic-landing-page'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('classic_landing_page_woocommerce_sidebar_product',array(
		'sanitize_callback' => 'classic_landing_page_sanitize_checkbox',
	));
	$wp_customize->add_control( 'classic_landing_page_woocommerce_sidebar_product', array(
	   'section'   => 'woocommerce_product_catalog',
	   'description'  => __('Click on the check box to remove sidebar from product page.','classic-landing-page'),
	   'label'	=> __('Product Page Sidebar layout','classic-landing-page'),
	   'type'      => 'checkbox'
 	));

	// Google Fonts
	$wp_customize->add_section( 'classic_landing_page_google_fonts_section', array(
	'title'       => __( 'Google Fonts', 'classic-landing-page' ),
	'priority'    => 24,
	) );

	$font_choices = array(
		'Kaushan Script:' => 'Kaushan Script',
		'Emilys Candy:' => 'Emilys Candy',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Montserrat:400,700' => 'Montserrat',
		'Raleway:400,700' => 'Raleway',
		'Droid Sans:400,700' => 'Droid Sans',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Oxygen:400,300,700' => 'Oxygen',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Cabin:400,700,400italic' => 'Cabin',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Bitter:400,700,400italic' => 'Bitter',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
		'Rokkitt:400' => 'Rokkitt',
	);

	$wp_customize->add_setting( 'classic_landing_page_headings_fonts', array(
		'sanitize_callback' => 'classic_landing_page_sanitize_fonts',
	));
	$wp_customize->add_control( 'classic_landing_page_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'classic-landing-page'),
		'section' => 'classic_landing_page_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'classic_landing_page_body_fonts', array(
		'sanitize_callback' => 'classic_landing_page_sanitize_fonts'
	));
	$wp_customize->add_control( 'classic_landing_page_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'classic-landing-page' ),
		'section' => 'classic_landing_page_google_fonts_section',
		'choices' => $font_choices
	));

}
add_action( 'customize_register', 'classic_landing_page_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function classic_landing_page_customize_preview_js() {
	wp_enqueue_script( 'classic_landing_page_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'classic_landing_page_customize_preview_js' );
<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Classic Landing Page
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function classic_landing_page_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'classic_landing_page_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function classic_landing_page_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	return $classes;
}
add_filter( 'body_class', 'classic_landing_page_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function classic_landing_page_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';
	return $url;
}
add_filter( 'attachment_link', 'classic_landing_page_enhanced_image_navigation', 10, 2 );


// slider range
if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;

// Customizer slider control
class Classic_Landing_Page_Slider_Custom_Control extends WP_Customize_Control {
  public $type = 'slider_control';
  public function enqueue() {
    wp_enqueue_script( 'classic-landing-page-controls-js', trailingslashit( esc_url(get_template_directory_uri()) ) . 'js/custom-controls.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
    wp_enqueue_style( 'classic-landing-page-controls-css', trailingslashit( esc_url(get_template_directory_uri()) ) . 'css/custom-controls.css', array(), '1.0', 'all' );
  }
  public function render_content() {
  ?>
    <div class="slider-custom-control">
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value"  <?php $this->link(); ?> />
      <div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
    </div>
  <?php
  }
}

function classic_landing_page_sanitize_hex_color( $hex_color, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$hex_color = sanitize_hex_color( $hex_color );
	
	// If $input is a valid hex value, return it; otherwise, return the default.
	return ( ! is_null( $hex_color ) ? $hex_color : $setting->default );
}
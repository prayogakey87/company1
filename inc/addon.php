<?php
/*
 * @package Classic Landing Page
 */

function classic_landing_page_admin_enqueue_scripts() {
    wp_enqueue_style( 'classic-landing-page-admin-style', esc_url( get_template_directory_uri() ).'/css/addon.css' );
}
add_action( 'admin_enqueue_scripts', 'classic_landing_page_admin_enqueue_scripts' );

add_action('after_switch_theme', 'classic_landing_page_options');

function classic_landing_page_options() {
    global $pagenow;
    if( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) && current_user_can( 'manage_options' ) ) {
        wp_redirect( admin_url( 'themes.php?page=classic-landing-page' ) );
        exit;
    }
}

function classic_landing_page_theme_info_menu_link() {

    $classic_landing_page_theme = wp_get_theme();
    add_theme_page(
        sprintf( esc_html__( 'Welcome to %1$s %2$s', 'classic-landing-page' ), $classic_landing_page_theme->get( 'Name' ), $classic_landing_page_theme->get( 'Version' ) ),
        esc_html__( 'Theme Info', 'classic-landing-page' ),'edit_theme_options','classic-landing-page','classic_landing_page_theme_info_page'
    );
}
add_action( 'admin_menu', 'classic_landing_page_theme_info_menu_link' );

function classic_landing_page_theme_info_page() {

    $classic_landing_page_theme = wp_get_theme();
    ?>
<div class="wrap theme-info-wrap">
    <h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'classic-landing-page' ), esc_html($classic_landing_page_theme->get( 'Name' )), esc_html($classic_landing_page_theme->get( 'Version' ))); ?>
    </h1>
    <p class="theme-description">
    <?php esc_html_e( 'Do you want to configure this theme? Look no further, our easy-to-follow theme documentation will walk you through it.', 'classic-landing-page' ); ?>
    </p>
    <div class="important-link">
        <p class="main-box columns-wrapper clearfix">
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Pro version of our theme', 'classic-landing-page' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you exited for our theme? Then we will proceed for pro version of theme.', 'classic-landing-page' ); ?></p>
                <a class="get-premium" href="<?php echo esc_url( CLASSIC_LANDING_PAGE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Go To Premium', 'classic-landing-page' ); ?></a>
                <p><strong><?php esc_html_e( 'Check all classic features', 'classic-landing-page' ); ?></strong></p>
                <p><?php esc_html_e( 'Explore all the premium features.', 'classic-landing-page' ); ?></p>
                <a href="<?php echo esc_url( CLASSIC_LANDING_PAGE_THEME_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'classic-landing-page' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Need Help?', 'classic-landing-page' ); ?></strong></p>
                <p><?php esc_html_e( 'Go to our support forum to help you out in case of queries and doubts regarding our theme.', 'classic-landing-page' ); ?></p>
                <a href="<?php echo esc_url( CLASSIC_LANDING_PAGE_SUPPORT ); ?>" target="_blank"><?php esc_html_e( 'Contact Us', 'classic-landing-page' ); ?></a>
                <p><strong><?php esc_html_e( 'Leave us a review', 'classic-landing-page' ); ?></strong></p>
                <p><?php esc_html_e( 'Are you enjoying our theme? We would love to hear your feedback.', 'classic-landing-page' ); ?></p>
                <a href="<?php echo esc_url( CLASSIC_LANDING_PAGE_REVIEW ); ?>" target="_blank"><?php esc_html_e( 'Rate This Theme', 'classic-landing-page' ); ?></a>
            </div>
            <div class="themelink column column-half clearfix">
                <p><strong><?php esc_html_e( 'Check Our Demo', 'classic-landing-page' ); ?></strong></p>
                <p><?php esc_html_e( 'Here, you can view a live demonstration of our premium them.', 'classic-landing-page' ); ?></p>
                <a href="<?php echo esc_url( CLASSIC_LANDING_PAGE_PRO_DEMO ); ?>" target="_blank"><?php esc_html_e( 'Premium Demo', 'classic-landing-page' ); ?></a>
                <p><strong><?php esc_html_e( 'Theme Documentation', 'classic-landing-page' ); ?></strong></p>
                <p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed theme setup.', 'classic-landing-page' ); ?></p>
                <a href="<?php echo esc_url( CLASSIC_LANDING_PAGE_THEME_DOCUMENTATION ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'classic-landing-page' ); ?></a>
            </div>
        </p>
    </div>
    <div id="getting-started">
        <h3><?php printf( esc_html__( 'Getting started with %s', 'classic-landing-page' ),
        esc_html($classic_landing_page_theme->get( 'Name' ))); ?></h3>
        <div class="columns-wrapper clearfix">
            <div class="column column-half clearfix">
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Description', 'classic-landing-page' ); ?></h4>
                    <div class="theme-description-1"><?php echo esc_html($classic_landing_page_theme->get( 'Description' )); ?></div>
                </div>
            </div>
            <div class="column column-half clearfix">
                <img src="<?php echo esc_url( $classic_landing_page_theme->get_screenshot() ); ?>" alt=""/>
                <div class="section">
                    <h4><?php esc_html_e( 'Theme Options', 'classic-landing-page' ); ?></h4>
                    <p class="about">
                    <?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'classic-landing-page' ),esc_html($classic_landing_page_theme->get( 'Name' ))); ?></p>
                    <p>
                    <div class="themelink-1">
                        <a target="_blank" href="<?php echo esc_url( wp_customize_url() ); ?>"><?php esc_html_e( 'Customize Theme', 'classic-landing-page' ); ?></a>
                        <a href="<?php echo esc_url( CLASSIC_LANDING_PAGE_PREMIUM_PAGE ); ?>" target="_blank"><?php esc_html_e( 'Checkout Premium', 'classic-landing-page' ); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="theme-author">
      <p><?php
        printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'classic-landing-page' ),
            esc_html($classic_landing_page_theme->get( 'Name' )),
            '<a target="_blank" href="' . esc_url( 'https://www.theclassictemplates.com/', 'classic-landing-page' ) . '">classictemplate</a>',
            '<a target="_blank" href="' . esc_url( CLASSIC_LANDING_PAGE_REVIEW ) . '" title="' . esc_attr__( 'Rate it', 'classic-landing-page' ) . '">' . esc_html_x( 'rate it', 'If you like this theme, rate it', 'classic-landing-page' ) . '</a>'
        );
        ?></p>
    </div>
</div>
<?php
}
?>

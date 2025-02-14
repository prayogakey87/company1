<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Classic Landing Page
 */
?>
<div id="footer">
  <?php 
    $classic_landing_page_footer_widget_enabled = get_theme_mod('classic_landing_page_footer_widget', true);
    
    if ($classic_landing_page_footer_widget_enabled !== false && $classic_landing_page_footer_widget_enabled !== '') { ?>

    <?php 
        $classic_landing_page_widget_areas = get_theme_mod('classic_landing_page_footer_widget_areas', '4');
        if ($classic_landing_page_widget_areas == '3') {
            $classic_landing_page_cols = 'col-lg-4 col-md-6';
        } elseif ($classic_landing_page_widget_areas == '4') {
            $classic_landing_page_cols = 'col-lg-3 col-md-6';
        } elseif ($classic_landing_page_widget_areas == '2') {
            $classic_landing_page_cols = 'col-lg-6 col-md-6';
        } else {
            $classic_landing_page_cols = 'col-lg-12 col-md-12';
        }
    ?>

    <div class="footer-widget">
        <div class="container">
          <div class="row">
            <!-- Footer 1 -->
            <div class="<?php echo esc_attr($classic_landing_page_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php else : ?>
                    <aside id="categories" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer1', 'classic-landing-page'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Categories', 'classic-landing-page'); ?></h3>
                        <ul>
                            <?php wp_list_categories('title_li='); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 2 -->
            <div class="<?php echo esc_attr($classic_landing_page_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php else : ?>
                    <aside id="archives" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer2', 'classic-landing-page'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Archives', 'classic-landing-page'); ?></h3>
                        <ul>
                            <?php wp_get_archives(array('type' => 'monthly')); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 3 -->
            <div class="<?php echo esc_attr($classic_landing_page_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php else : ?>
                    <aside id="meta" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer3', 'classic-landing-page'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Meta', 'classic-landing-page'); ?></h3>
                        <ul>
                            <?php wp_register(); ?>
                            <li><?php wp_loginout(); ?></li>
                            <?php wp_meta(); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            </div>

            <!-- Footer 4 -->
            <div class="<?php echo esc_attr($classic_landing_page_cols); ?> footer-block">
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <?php dynamic_sidebar('footer-4'); ?>
                <?php else : ?>
                    <aside id="search-widget" class="widget py-3" role="complementary" aria-label="<?php esc_attr_e('footer4', 'classic-landing-page'); ?>">
                        <h3 class="widget-title"><?php esc_html_e('Search', 'classic-landing-page'); ?></h3>
                        <?php the_widget('WP_Widget_Search'); ?>
                    </aside>
                <?php endif; ?>
            </div>
          </div>
        </div>
    </div>

    <?php } ?>
  <div class="clear"></div>

  <div class="copywrap text-center">
  	<div class="container">
      <p>
        <a href="<?php 
          $classic_landing_page_copyright_link = get_theme_mod('classic_landing_page_copyright_link', '');
          if (empty($classic_landing_page_copyright_link)) {
              echo esc_url('https://www.theclassictemplates.com/products/free-landing-page-wordpress-theme');
          } else {
              echo esc_url($classic_landing_page_copyright_link);
          } ?>" target="_blank">
          <?php echo esc_html(get_theme_mod('classic_landing_page_copyright_line', __('Landing Page WordPress Theme', 'classic-landing-page'))); ?>
        </a> 
        <?php echo esc_html('By Classic Templates', 'classic-landing-page'); ?>
      </p>
    </div>
  </div>
</div>

<?php if(get_theme_mod('classic_landing_page_scroll_hide',false)){ ?>
 <a id="button"><?php esc_html_e('TOP', 'classic-landing-page'); ?></a>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>
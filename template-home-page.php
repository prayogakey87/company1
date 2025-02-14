<?php
/**
 * The Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Classic Landing Page
 */

get_header(); ?>

<div id="content">
<?php
    $classic_landing_page_hidepageboxes_1 = get_theme_mod('classic_landing_page_disabled_pgboxes_1', false);
    $classic_landing_page_pageboxes = get_theme_mod('classic_landing_page_pageboxes');

    if ($classic_landing_page_hidepageboxes_1 && $classic_landing_page_pageboxes) { ?>
  <div id="head-banner">
    <?php $classic_landing_page_querymed = new WP_query('page_id='.esc_attr(get_theme_mod('classic_landing_page_pageboxes',false)) ); ?>
      <?php while( $classic_landing_page_querymed->have_posts() ) : $classic_landing_page_querymed->the_post(); ?>
        <div class="img-inner-box">
          <?php if(has_post_thumbnail()){
                  the_post_thumbnail('full');
                  } else{?>
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/banner.png" alt=""/>
                <?php } ?>
        </div>
        <div class="content-inner-box">
          <?php if ( get_theme_mod('classic_landing_page_pgboxes_title') != "") { ?>
            <h1><?php echo esc_html(get_theme_mod('classic_landing_page_pgboxes_title','')); ?></h1>
          <?php } ?>
          <h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2> 
          <p><?php echo wp_trim_words( get_the_content(), get_theme_mod('classic_landing_page_banner_excerpt_number',40) ); ?></p>
          <div class="pagemore">
            <?php 
            $classic_landing_page_button_text = get_theme_mod('classic_landing_page_button_text', 'Go Now');
            $classic_landing_page_button_link_slider = get_theme_mod('classic_landing_page_button_link_slider', ''); 
            if (empty($classic_landing_page_button_link_slider)) {
                $classic_landing_page_button_link_slider = get_permalink();
            }
            if ($classic_landing_page_button_text || !empty($classic_landing_page_button_link_slider)) { ?>
              <a href="<?php echo esc_url($classic_landing_page_button_link_slider); ?>" class="button redmor">
                <?php echo esc_html($classic_landing_page_button_text); ?>
                  <span class="screen-reader-text"><?php echo esc_html($classic_landing_page_button_text); ?></span>
              </a>
            <?php } ?>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    <div class="clear"></div>
  </div>
  <?php }?>
  <?php
    $classic_landing_page_hidepageboxes = get_theme_mod('classic_landing_page_disabled_pgboxes', false);
    $classic_landing_page_pageboxes = get_theme_mod('classic_landing_page_pageboxes');
    if( $classic_landing_page_hidepageboxes && $classic_landing_page_pageboxes){
  ?>
    <div id="services_section" class="text-center py-4">
      <div class="container">
        <?php if ( get_theme_mod('classic_landing_page_title') != "") { ?>
          <h3><?php echo esc_html(get_theme_mod('classic_landing_page_title','')); ?></h3>
        <?php } ?>
        <div class="row">
          <?php for($p=0; $p<8; $p++) { ?>
          <?php if( get_theme_mod('classic_landing_page_pageboxes'.$p,false)) { ?>
            <?php $classic_landing_page_querymed = new WP_query('page_id='.esc_attr(get_theme_mod('classic_landing_page_pageboxes'.$p,false) ) ); ?>
              <?php while( $classic_landing_page_querymed->have_posts() ) : $classic_landing_page_querymed->the_post(); ?>
              <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="pagecontent mb-4">
                  <?php if(has_post_thumbnail()){?>
                    <div class="thumbbx"><?php the_post_thumbnail();?></div>
                    <?php } else{?>
                    <div class="thumbbx"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/project-1.png" alt=""/></div>
                  <?php } ?>
                  <div class="text-inner-box">
                    <h4 class="mb-0"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h4> 
                  </div>
                </div>
              </div>
            <?php endwhile; wp_reset_postdata(); ?>
          <?php } } ?>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  <?php }?>

</div>

<?php get_footer(); ?>
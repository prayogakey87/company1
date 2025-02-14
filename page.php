<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Classic Landing Page
 */

get_header(); ?>

<div class="container">
    <div id="content" class="contentsecwrap">
    <?php
         $classic_landing_page_layout_option = get_theme_mod( 'classic_landing_page_sidebar_page_layout','right');
         if($classic_landing_page_layout_option == 'right'){ ?>  
        <div class="row">
            <div class="col-lg-9 col-md-8">
            	<section class="site-main">
            		<?php while( have_posts() ) : the_post(); ?>
                        <header class="page-header">
                            <?php if(get_theme_mod('classic_landing_page_theme_page_breadcrumb',false) == 1){ ?> 
                                <span class="gap-3 align-items-center"><?php classic_landing_page_the_breadcrumb(); ?></span>
                            <?php }?>     
                        </header>
            			<?php get_template_part( 'content', 'page' ); ?>
                        <?php
                            //If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                            ?>
                    <?php endwhile; ?>
                </section>
            </div>
            <div class="col-lg-3 col-md-4" id="sidebar">
               <?php dynamic_sidebar('sidebar-2');?>
            </div>
        </div>
        <div class="clear"></div>
        <?php }else if($classic_landing_page_layout_option == 'left'){ ?>
        <div class="row">
            <div class="col-lg-3 col-md-4" id="sidebar">
               <?php dynamic_sidebar('sidebar-2');?>
            </div>
            <div class="col-lg-9 col-md-8">
            	<section class="site-main">
            		<?php while( have_posts() ) : the_post(); ?>
                        <header class="page-header">
                            <?php if(get_theme_mod('classic_landing_page_theme_page_breadcrumb',false) == 1){ ?> 
                                <span class="gap-3 align-items-center"><?php classic_landing_page_the_breadcrumb(); ?></span>
                            <?php }?>     
                        </header>
            			<?php get_template_part( 'content', 'page' ); ?>
                        <?php
                            //If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                            ?>
                    <?php endwhile; ?>
                </section>
            </div>
        </div>
        <?php }else if($classic_landing_page_layout_option == 'full'){ ?>
            <section class="site-main">
                <?php while( have_posts() ) : the_post(); ?>
                    <header class="page-header">
                        <?php if(get_theme_mod('classic_landing_page_theme_page_breadcrumb',false) == 1){ ?> 
                            <span class="gap-3 align-items-center"><?php classic_landing_page_the_breadcrumb(); ?></span>
                        <?php }?>     
                    </header>
                    <?php get_template_part( 'content', 'page' ); ?>
                    <?php
                        //If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() )
                            comments_template();
                        ?>
                <?php endwhile; ?>
            </section>
        <?php }else {?>
        <div class="row">
            <div class="col-lg-9 col-md-8">
            	<section class="site-main">
            		<?php while( have_posts() ) : the_post(); ?>
                        <header class="page-header">
                            <?php if(get_theme_mod('classic_landing_page_theme_page_breadcrumb',false) == 1){ ?> 
                                <span class="gap-3 align-items-center"><?php classic_landing_page_the_breadcrumb(); ?></span>
                            <?php }?>     
                        </header>
            			<?php get_template_part( 'content', 'page' ); ?>
                        <?php
                            //If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                            ?>
                    <?php endwhile; ?>
                </section>
            </div>
            <div class="col-lg-3 col-md-4" id="sidebar">
               <?php dynamic_sidebar('sidebar-2');?>
            </div>
        </div>
        <?php } ?>       
    </div>
 </div>

<?php get_footer(); ?>
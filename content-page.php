<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Classic Landing Page
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<?php the_post_thumbnail(); ?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<div class="clearfix"></div>
	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'classic-landing-page' ),
			'after'  => '</div>',
		) );
	?>
	<?php edit_post_link( __( 'Edit', 'classic-landing-page' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article>
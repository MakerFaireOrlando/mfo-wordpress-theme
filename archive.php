<?php
/**
 * @package Coraline
 * @since Coraline 1.0
 */

get_header(); ?>

<div id="content-container">
	<div id="content" role="main" style="width:100%">	
	<?php if ( have_posts() ) the_post(); ?>

	<?php if ( is_day() ) : ?>
		<?php printf( __( 'Daily Archives: <span>%s</span>', 'coraline' ), get_the_date() ); ?>
	<?php elseif ( is_month() ) : ?>
		<?php printf( __( 'Monthly Archives: <span>%s</span>', 'coraline' ), get_the_date( 'F Y' ) ); ?>
	<?php elseif ( is_year() ) : ?>
		<?php printf( __( 'Yearly Archives: <span>%s</span>', 'coraline' ), get_the_date( 'Y' ) ); ?>
	<?php elseif ( is_tax('exhibit-category') ) : ?>
		<?php 
			$cat = $wp_query->queried_object->slug;
			$url = "/makers/?category=".$cat;
			printf("<script>window.location.replace('".$url."');</script>");
			//early exit to prevent the content below from being returns
			//which causes the author urls to be used
			printf("</html>");
			return; 
		?>
	<?php elseif ( get_post_type() =='exhibit' or get_post_type() =='maker' ) : ?>
		<?php printf("<script>window.location.replace('/makers');</script>");
			 printf("</html>");
                        return; 
		 ?>
	<?php else : ?>
		<?php _e( 'Blog Archives', 'coraline' ); ?>
	<?php endif; ?>

	<?php
		rewind_posts();
		get_template_part( 'loop', 'archive' );
	?>

	</div><!-- #content -->
</div><!-- #content-container -->

<?php /*get_sidebar();*/ ?>
<?php get_footer(); ?>

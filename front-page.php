<?php
/**
 * Template Name: Front Page
 *
 */

get_header(); ?>

  <div id="page-content">
  	<div id="page-body">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; ?>
			</section>
	</div><!-- #page-body -->

<?php get_footer(); ?>

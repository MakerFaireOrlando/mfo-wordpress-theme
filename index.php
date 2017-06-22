<?php
/**
 * @package WordPress
 * @subpackage Coraline
 * @since Coraline 1.0
 */

get_header(); ?>

  <div id="page-content">
  	<div id="page-body">
			<?php echo do_shortcode('[rev_slider mainfw1]'); ?><br>
		 	<?php echo do_shortcode("[wpv-post-body view_template='what-is-maker-faire']") ?>
	</div><!-- #page-body -->

<?php get_footer(); ?>

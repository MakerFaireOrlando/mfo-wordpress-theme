<?php
/**
 * @package Coraline
 * @since Coraline 1.0
 */

get_header(); ?>
  
  <div id="page-content">
                        <div class="container">
			<div class="row">
			<div class="col-xs-12">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post();

			$format = get_post_format();

			if ( false == $format)
				$format = 'standard'; ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( 'standard' != $format ) : ?>
				<a class="entry-format" href="<?php echo esc_url( get_post_format_link( get_post_format() ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'All %s posts', 'coraline' ), get_post_format_string( get_post_format() ) ) ); ?>"><?php echo esc_html( get_post_format_string( get_post_format() ) ); ?></a>
			<?php endif; ?>

				<div class="all-posts-btn">
				 <a href="/news"><i class="fa fa-chevron-left" aria-hidden="true"></i> All News</a>
				</div>


			<?php 
			  the_title( '<h2 class="page-header">', '</h2>' ); 
			?>


			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'coraline' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
<div class="entry-info">
			<?php if ( 'standard' != $format ) : ?>
				<p class="format-entry-meta">
					<?php coraline_posted_on(); coraline_posted_by(); ?>
					<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'coraline' ), __( '1 Comment', 'coraline' ), __( '% Comments', 'coraline' ) ); ?></span>
				</p>
			<?php endif; ?>
			</div><!-- .entry-info -->
		</div><!-- #post-## -->



	<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->


   </div><!-- col-xs-12 -->
  </div><!-- row -->
</div><!-- container -->

<?php /*get_sidebar();*/ ?>

<?php get_footer(); ?>

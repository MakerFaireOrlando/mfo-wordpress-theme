<?php
/**
 * @package WordPress
 * @subpackage Coraline
 * @since Coraline 1.0
 */

get_header(); ?>

		<div id="page-content">
			<div id="page-body">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					

					<div class="container">
						<?php the_content(); ?>
						<div class="linked-pages"><?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'coraline' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'maker-faire-online' ),
							 '<span class="edit-link">', '</span>' ); ?>
					</div><!-- #container -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

			<?php endwhile; ?>

			</div><!-- #page-body -->
		</div><!-- #page-content -->


<?php get_footer(); ?>

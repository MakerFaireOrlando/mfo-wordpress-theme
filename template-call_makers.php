<?php
/**
 * @package WordPress
 * @subpackage Coraline
 * @since Coraline 1.0
 * Template Name: Call For Makers
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

				<!--  -->
				<section class="what-is-maker-faire">
					<div class="container">
						<div class="row text-center">
							<div class="title-w-border-y">
								<h2>What is Maker Faire?</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<p class="text-center">Maker Faire is a gathering of fascinating, curious people who enjoy learning and who love sharing what they can do. From engineers to artists to scientists to crafters, Maker Faire is a venue for these “makers” to show hobbies, experiments, projects.</p>
								<p class="text-center">We call it the Greatest Show (&amp; Tell) on Earth – a family-friendly showcase of invention, creativity, and resourcefulness.</p>
								<p class="text-center">Glimpse the future and get inspired!</p>
							</div>
						</div>
					</div>
					<?php mfo_makey_border(); ?>
				</section>

				<?php comments_template( '', true ); ?>

			<?php endwhile; ?>

			</div><!-- #page-body -->

		</div><!-- #page-content -->


<?php get_footer(); ?>

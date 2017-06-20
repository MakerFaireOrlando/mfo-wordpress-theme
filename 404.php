<?php
/**
 * @package Coraline
 * @since Coraline 1.0
 */

get_header(); ?>

  <div id="page-content">
                        <div id="page-body">

		<div id="post-0" class="post error404 not-found">
			<h1 class="entry-title"><?php _e( 'Page Not Found', 'coraline' ); ?></h1>
			<div class="entry-content">
				<p>Apologies, but the page you requested could not be found. It might not exist, or may require <a href="http://www.makerfaireorlando.com/makerlogin">login</a>.</p>

				<p>If you are a Maker attempting to view your Maker Profile, or exhibits, etc. - please <a href="http://www.makerfaireorlando.com/makerlogin">login</a> first. </p>

				<p>Can't find something? Try searching...</p>

				<?php get_search_form(); ?>

			</div><!-- .entry-content -->
		</div><!-- #post-0 -->

	</div><!-- #content -->
</div><!-- #content-container -->

<?php get_footer(); ?>

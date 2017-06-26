<?php
/**
 * Template Name: Front Page
 *
 */

get_header(); ?>

  <div id="page-content">
  	<div id="page-body">
			<?php echo do_shortcode('[rev_slider mainfw1]'); ?><br>
		 	<?php echo do_shortcode("[wpv-post-body view_template='what-is-maker-faire']") ?>
			<section class="recent-post-panel">
 		          <div class="container">
				<div class="row padbottom text-center">
            			   <img class="robot-head" src="<?php echo get_template_directory_uri(); ?>/images/news-icon.png" alt="News icon" data-pin-nopin="true"
>
            			   <div class="title-w-border-r">
              			      <h2>Latest News</h2>
            			   </div>
          			</div>
				<div class="row">
				<?php
				$args = array( 'numberposts' => '4' );
				$recent_posts = wp_get_recent_posts( $args );
				foreach( $recent_posts as $recent ){
				   $post_id = $recent["ID"];
				   echo '<div class="recent-post-post col-xs-12 col-sm-3">
					   <article class="recent-post-inner" id='. $post_id. '>
					      <a href="'. get_permalink($post_id) .'">
					      <div class="recent-post-img" style="background-image: 
							url('. get_the_post_thumbnail_url($post_id) 
								.'?resize=300%2C300&amp;quality=80&amp;strip=all);">
						</div>
					     <div class="recent-post-text">
                  				<h4>' . $recent["post_title"] . '</h4>
                  				<p class="recent-post-date">' . get_the_date( 'l F j, Y' , $post_id) . '</p>
                  				<p class="recent-post-description">' . wp_strip_all_tags(get_the_excerpt($post_id), true) . '</p>
               				     </div>
              				     </a></article></div>';

						//note: excerpts still not working right - look at interactions with yoast.
				}
				wp_reset_query();
				?>
				<div class="col-xs-12 padtop padbottom text-center">
			          <a class="btn btn-b-ghost" href="/news">More News</a>
				</div><!-- #button div -->
				</div><!-- #row -->
				</div><!-- #container -->
				<div class="flag-banner"></div>

			</section>
	</div><!-- #page-body -->

<?php get_footer(); ?>

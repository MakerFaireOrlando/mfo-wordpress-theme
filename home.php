<?php
/**
 * Template Name: News Page
 * Note that wordpress considers the page of recent posts the "home" page,
 * even if it is not 
  
 */

get_header(); ?>

  <div id="page-content">
  	<div class="container">
		<div id="post-" class="post-366 page type-page status-publish hentry">
 		          <div class="container">
				<div class="row">
				<?php

				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$query_args = array(
    				'post_type' => 'post',
			    	'posts_per_page' => 9,
    				'paged' => $paged
 				 );
  				// create a new instance of WP_Query
  				$the_query = new WP_Query( $query_args );

				$first = true;

				if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop 

				   if ($first) {
                                        echo '<div class="recent-post-post first-post col-xs-12">';
                                        $first=false;
                                        }
                                   else {
                                         echo '<div class="recent-post-post col-xs-12 col-sm-3">';
                                        }
                                   echo '<article class="recent-post-inner">
                                         <a href="' .  get_the_permalink() . '">
                                         <div class="recent-post-img" style="background-image: 
                                                        url('. get_the_post_thumbnail_url() 
                                                                .'?resize=300%2C300&amp;quality=80&amp;strip=all);">
                                        </div>
                                        <div class="recent-post-text">
                                          <h4>' . get_the_title() . '</h4>
                                           <p class="recent-post-date">' . get_the_date( 'l F j, Y') . '</p>
                                           <p class="recent-post-description">' . wp_strip_all_tags(get_the_excerpt()) . '</p>
                                        </div>
                                        </a></article></div>';
				endwhile;
				endif;
				?>

				<div class="navigation bottom15">
        			<span class="newer">
                  		</span>
        			<span class="older pull-right">
				<?php echo get_next_posts_link( 'Older Entries', $the_query->max_num_pages ); // display older posts link ?>
        			</span>
				<div class="clearfix"></div>
      				</div>

				</div><!-- #row -->
				</div><!-- #container -->

		</div>
	</div>

<?php get_footer(); ?>

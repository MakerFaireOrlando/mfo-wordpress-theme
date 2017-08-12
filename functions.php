<?php

// Load our main stylesheet.
//	wp_enqueue_style( 'mfo-wordpress-theme-style', get_stylesheet_uri() );


/**
 *Declare menu locations
 *
 */
function register_mfo_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-local-menu' => __( 'Footer - MF Local Menu' ),
    )
  );
}
add_action( 'init', 'register_mfo_menus' );


/**
 * Allow the user to specify the header image in customizer
 */
add_theme_support( 'custom-logo', array(
    'height'      => 50,
    'width'       => 192,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
) );

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



// Register Custom Navigation Walker; used to output proper bootstrap menus
require_once('wp-bootstrap-navwalker.php');



// Add Shortcode to return the featured url as a background style attribute
// todo: move to plugin if still required
function get_featured_url($atts) {
// Attributes
  $vals=shortcode_atts(
    array(
      'post_id' => '',
    ), $atts );
  
$feat_image = wp_get_attachment_url( get_post_thumbnail_id($vals["post_id"]) );
return "style = 'background-image: url(". esc_url($feat_image).");height: 120px; width: 120px;'";
}

add_shortcode( 'get_featured_url', 'get_featured_url' );


function theme_styles() {

	wp_enqueue_style( 'google-fonts-body', 'https://fonts.googleapis.com/css?family=Roboto:400,300,700,500', false );
	wp_enqueue_style( 'google-fonts-heading', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700', false);
	wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css', array('bootstrap_css'));
	wp_enqueue_style( 'minimakerfaire-theme-style', get_template_directory_uri() . '/css/minimakerfaire/style.css',array('bootstrap_css','google-fonts-body', 'google-fonts-heading'));
	wp_enqueue_style( 'mfo-wordpress-theme-style', get_template_directory_uri().'/style.css' ,array('minimakerfaire-theme-style','bootstrap_css','google-fonts-body', 'google-fonts-heading'));


}

add_action( 'wp_enqueue_scripts', 'theme_styles');


//Loads bootstrap and slidemenu js
function theme_js() {
	global $wp_scripts;
	wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
	wp_enqueue_script( 'slidemenu_js' , get_template_directory_uri() . '/js/slidemenu.js');
	//note slidemenu is not a library; it is online code found and used by MM and replicated here for compato
	//todo: origin url

}

add_action( 'wp_enqueue_scripts', 'theme_js');



//TODO: test and if still needed move to plugin;
//kill some image sizes
function remove_image_sizes() {
	remove_image_size("coraline-image-template");
	remove_image_size("post-thumbnail");

	//sensei
	remove_image_size("course_single_thumbnail");
	remove_image_size("course_archive_thumbnail");
	remove_image_size("lesson_single_thumbnail");
	remove_image_size("lesson_archive_thumbnail");
	//woocommerce
	remove_image_size("shop_thumbnail");
	remove_image_size("shop_single");
	remove_image_size("shop_catalog");

	//note medium-large is a new wordpress standard size for responsive themes
}

add_action('init', 'remove_image_sizes');

/*
//useful when determining the images sizes being created
function display_image_sizes($atts) {
	return print_r(get_intermediate_image_sizes());
}

add_shortcode ('image_sizes', 'display_image_sizes');
*/

/*
 * Change the order of the endpoints that appear in My Account Page - WooCommerce 2.6
 * The first item in the array is the custom endpoint URL - ie http://mydomain.com/my-account/my-custom-endpoint
 * Alongside it are the names of the list item Menu name that corresponds to the URL, change these to suit
 *
 * TODO: MOVE THIS TO PLUGIN if woocommerce module enabled
 *
 */

function wpb_woo_my_account_order() {
	$myorder = array(
		'edit-account'       => __( 'Change My Details', 'woocommerce' ),
		'dashboard'          => __( 'Account Overview', 'woocommerce' ),
		'orders'             => __( 'Orders', 'woocommerce' ),
		'downloads'          => __( 'Download', 'woocommerce' ),
		'edit-address'       => __( 'Addresses', 'woocommerce' ),
		'payment-methods'    => __( 'Payment Methods', 'woocommerce' ),
		'customer-logout'    => __( 'Logout', 'woocommerce' ),
	);

	return $myorder;
}
add_filter ( 'woocommerce_account_menu_items', 'wpb_woo_my_account_order' );


//make Yoast output the correct size featured image
add_filter('wpseo_opengraph_image_size', 'mysite_opengraph_image_size');
function mysite_opengraph_image_size($val) {
return 'large';
}

//this is a wp function for image viewer box
add_action( 'wp_enqueue_scripts', 'add_thickbox' );

/*
*
*Removes items from the user profile page for subscribers
*by using js to remove the items
*
*url: https://isabelcastillo.com/hide-personal-options-wordpress-admin-profile
*TODO: hide messages from plugins, etc.
*
*/
function remove_personal_options(){
	if (!current_user_can('administrator')) {
	    echo '<script type="text/javascript">jQuery(document).ready(function($) {
		$(\'form#your-profile > h2:first\').remove(); // remove the "Personal Options" title
		$(\'form#your-profile tr.user-rich-editing-wrap\').remove(); // remove the "Visual Editor" field
		$(\'form#your-profile tr.user-admin-color-wrap\').remove(); // remove the "Admin Color Scheme" field
		$(\'form#your-profile tr.user-comment-shortcuts-wrap\').remove(); // remove the "Keyboard Shortcuts" field
		$(\'form#your-profile tr.user-admin-bar-front-wrap\').remove(); // remove the "Toolbar" field
		$(\'form#your-profile tr.user-language-wrap\').remove(); // remove the "Language" field
		$(\'form#your-profile tr.user-first-name-wrap\').remove(); // remove the "First Name" field
		$(\'form#your-profile tr.user-last-name-wrap\').remove(); // remove the "Last Name" field
		$(\'form#your-profile tr.user-nickname-wrap\').hide(); // Hide the "nickname" field
		$(\'table.form-table tr.user-display-name-wrap\').remove(); // remove the âDisplay name publicly asâ field
		$(\'table.form-table tr.user-url-wrap\').remove();// remove the "Website" field in the "Contact Info" section
		$(\'h2:contains("About Yourself"), h2:contains("About the user")\').remove(); // remove the "About Yourself" and "About the user" titles
		$(\'form#your-profile tr.user-description-wrap\').remove(); // remove the "Biographical Info" field
		$(\'form#your-profile tr.user-profile-picture\').remove(); // remove the "Profile Picture" field
		$(\'table.form-table tr.user-aim-wrap\').remove(); // remove the AOL instant messenger field
		$(\'table.form-table tr.user-yim-wrap\').remove(); // remove the Yahoo instant messenger field
		$(\'table.form-table tr.user-jabber-wrap\').remove(); // remove the Jabber field
		});</script>';
	}

}

add_action('admin_head','remove_personal_options');


/*
 * [mfo-recent-posts] shortcode
 *
 *
 */
function mfo_recent_posts () {
     $ret =  '<section class="recent-post-panel">
                  <div class="container">
                                <div class="row padbottom text-center">
                                   <img class="robot-head" src="'. get_template_directory_uri() . '/images/news-icon.png" alt="News icon" data-pin-nopin="true">
                                   <div class="title-w-border-r">
                                      <h2>Latest News</h2>
                                   </div>
                                </div>
                                <div class="row">';

                                $args = array( 'numberposts' => '4' , 'post_status' => 'publish' );
                                $recent_posts = wp_get_recent_posts( $args );
                                foreach( $recent_posts as $recent ){
                                   $post_id = $recent["ID"];
                                   $ret.= '<div class="recent-post-post col-xs-12 col-sm-3">
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

                        $ret.= '<div class="col-xs-12 padtop padbottom text-center">
                                  <a class="btn btn-b-ghost" href="/news">More News</a>
                                </div><!-- #button div -->
                                </div><!-- #row -->
                                </div><!-- #container -->';

	return $ret;
}

add_shortcode ('mfo-recent-posts', 'mfo_recent_posts');

/*
 * [mfo-sponsors-carousel] shortcode
 *
 *
 */
function mfo_sponsor_carousel () {
     $attr_year = 2017;

     $ret =  '<section class="sponsor-slide">
                  <div class="container">
                                <div class="row sponsor_panel_title">
                                   <div class="col-xs-12 text-center">
                                    <div class="title-w-border-r">
                                      <h2 class="sponsor-slide-title">Sponsors</h2>
                                    </div>
                                   </div>
                                </div>
                                <div class="row">
      	                          <div class="col-xs-12">
				    <div id="carousel-sponsors-slider" class="carousel slide" data-ride="carousel">
				    <!-- Wrapper for slides -->
				   <div class="carousel-inner" role="listbox">';

				$args = array(
  				'post_type'   => 'sponsor',
  				'post_status' => 'publish',
				'posts_per_page' => -1
				 );

				$sponsors = new WP_Query( $args );
				if( $sponsors->have_posts() ) :
				   //$ret .= 'Got Sponsors!';
				else: $ret .= 'Error, no sponsors CPT found!';
				endif;
				//at this point we have a bunch of sponsor posts, but don't 
				//know which ones are sponsors for this year

				$sponsors_out = [];

				while( $sponsors->have_posts() ) :
        			  $sponsors->the_post();
				  $years = get_post_meta(get_the_ID(), 'wpcf-sponsor-event-years');

				  //this returns a lovely array of checkboxes, we have to find the one
				  //that matches this year.

				  foreach (array_filter($years) as $year) {
				   foreach (array_filter($year) as $year_sub) {
				    if ($year_sub[0] == $attr_year) {
					$level = intval(get_post_meta(get_the_ID(), 'wpcf-sponsor-level', true));
					$website = get_post_meta(get_the_ID(), 'wpcf-sponsor-website', true);
					$logo= get_the_post_thumbnail_url($post_id, true);
					$arr = array('name'=> get_the_title(), 'id'=>get_the_ID(), 'website'=>$website, 'logo' =>$logo );
					if ($level)  {
						//build array of sponsors by level
						if (!is_array($sponsors_out[$level])){
							 $sponsors_out[$level] = array();
						}
						array_push($sponsors_out[$level], $arr );
					}
				    }
				   }
				  }
				endwhile;


				ksort($sponsors_out); //sort levels
				$active=" active"; //setup the first item in the carousel

				foreach ($sponsors_out as $lvl => $sponsor_lvl) {
					//sort sponsors within level by alpha using comparison function
					uasort($sponsor_lvl,"cmp_sponsor_name");
					//$ret .= 'sponsor_lvl:'.$lvl. ":" . json_encode($sponsor_lvl) ."<br>";

				 	$ret .= '<div class="item'. $active.'" id="'. $lvl .'">
						  <div class="row spnosors-row">
					    	    <div class="col-xs-12">
						      <h5 class="text-center sponsors-type">Sponsor Level</h5>
							<div class="faire-sponsors-box">';


					//output each sponsor level here
					foreach ($sponsor_lvl as $sponsor) {
					  $ret .='<div class="sponsors-box-lg" id="' . $sponsor["name"]. '"><a href=' . $sponsor["website"] .' target="_blank">';
					  $ret .= '<img src="'.$sponsor["logo"] .'" class="img-responsive" style="max-height:150px; width:auto;" alt="' .
							$sponsor["name"] .'"></a></div>';

					}
					$ret .='</div></div></div></div>';
					$active="";
				}


      				wp_reset_postdata();


                        $ret .= '</div><!-- #carousel-inner -->
				</div><!-- #row -->
                                </div><!-- #container -->
                                </section>';

			//final array output debugging if needed
			//$ret .= json_encode($sponsors_out);

	return $ret;
}

add_shortcode ('mfo-sponsor-carousel', 'mfo_sponsor_carousel');



function cmp_sponsor_name($a, $b)
{
 return strcmp($a["name"], $b["name"]);
}


?>

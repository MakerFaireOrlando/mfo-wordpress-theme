<?php

// Register Custom Navigation Walker
require_once('wp-bootstrap-navwalker.php');


// Add Shortcode to return the featured url as a background style attribute
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

	wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
//	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );

}

add_action( 'wp_enqueue_scripts', 'theme_styles');

function theme_js() {

	global $wp_scripts;

	wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
	//wp_enqueue_script( 'my_custom_js', get_template_directory_uri() . '/js/scripts.js');
	wp_enqueue_script( 'slidemenu_js' , get_stylesheet_directory_uri() . '/js/slidemenu.js');
}

add_action( 'wp_enqueue_scripts', 'theme_js');


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


//useful when determining the images sizes being created
function display_image_sizes($atts) {
	return print_r(get_intermediate_image_sizes());
}

add_shortcode ('image_sizes', 'display_image_sizes');


/*
 * Change the order of the endpoints that appear in My Account Page - WooCommerce 2.6
 * The first item in the array is the custom endpoint URL - ie http://mydomain.com/my-account/my-custom-endpoint
 * Alongside it are the names of the list item Menu name that corresponds to the URL, change these to suit
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

//temp fix for CRED featured image problem
/**
 * Custom code to force add thumbnail meta
 * to add announcement CRED form post
 */
/*
function force_thumbnail( $post_id, $form_data ) {

	$forms = array(2634, 2725,2660, 2653); 
    if ( in_array($form_data['id'], $forms) && !empty( $_POST['_featured_image'] ) ) {
 
        $args = array(
            'numberposts'   => 1,
            'post_type'     => 'attachment',
            'post_parent'   => $post_id
        );
        $thumb = get_posts( $args );
 
        $meta_update = add_post_meta( $post_id, "_thumbnail_id", $thumb[0]->ID, true );
 
    }
}
add_action( 'cred_submit_complete', 'force_thumbnail', 10, 2 );
*/

//temp hack for wp4.6
/*
add_filter( 'wp_mail_from', function() {
    global $current_blog; 
    $sitename = $current_blog->domain;
    return 'wordpress@'.$current_blog->domain;
} );
*/

if ( function_exists( 'mfo_sensei_compatibility' ) ) {
        mfo_sensei_compatibility();
}

//make Yoast output the correct size featured image
add_filter('wpseo_opengraph_image_size', 'mysite_opengraph_image_size');
function mysite_opengraph_image_size($val) {
return 'large';
}

//this is a wp function for image viewer box
add_action( 'wp_enqueue_scripts', 'add_thickbox' );

//Modify coraline theme option sizing so that
//the upload section for the header image has the right values
if ( !function_exists( 'child_theme_setup' ) ):
function child_theme_setup() {
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'coraline_header_image_height', 140 ) );
define( 'HEADER_IMAGE_WIDTH', apply_filters( 'coraline_header_image_width', 1000 ) );
}
endif;

add_action( 'after_setup_theme', 'child_theme_setup' );


?>

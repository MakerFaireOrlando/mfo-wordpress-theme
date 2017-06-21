<?php

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
	wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
}

add_action( 'wp_enqueue_scripts', 'theme_styles');


//Loads bootstrap and slidemenu js
function theme_js() {
	global $wp_scripts;
	wp_enqueue_script( 'bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
	wp_enqueue_script( 'slidemenu_js' , get_stylesheet_directory_uri() . '/js/slidemenu.js');
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


?>

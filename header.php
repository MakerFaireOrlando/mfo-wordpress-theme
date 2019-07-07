<?php
/**
 * @package WordPress
 * @subpackage Coraline
 * @since Coraline 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if (gt IE 6) | (!IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	//bloginfo( 'name' );
	//was double outputting 

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	//ic - was never outputting description
	//if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'coraline' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	


	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>


</head>

<body <?php body_class(); ?>>

<div class="flag-banner header-flag"></div>

<nav class="navbar navbar-default nav-not-home" role="navigation" id="slide-nav">
    <div class="container text-center nav-flex">
      <div class="navbar-header">
        <a class="navbar-toggle"> 
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        <?php 
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	?>
	</a>
        <a href="/">
        <img class="header-logo" src="<?php echo $image[0]; ?>" alt="<?php echo get_bloginfo() ?>">
        </a>
      </div>

      <div id="nav-not-home-logo">
        <a href="/">
         <img src="<?php echo $image[0]; ?>" alt="<?php echo get_bloginfo() ?>">
        </a>
      </div>


		<?php 	wp_nav_menu( array( 'container_id' 		=> 'slidemenu', 
						'container_class' 	=> 'menu-header-menu-container', 
						'menu_class' 		=>'nav navbar-nav',
						'theme_location' 	=> 'header-menu',
						'fallback_cb'       	=> 'WP_Bootstrap_Navwalker::fallback',
                				'walker'            	=> new WP_Bootstrap_Navwalker ) ); ?>

 <div id="header-cta-button">
	<a class="btn btn-primary" href="<?php echo mfo_header_button_url();?>"><?php echo mfo_header_button_text()?></a></div>
    </div>
  </nav>


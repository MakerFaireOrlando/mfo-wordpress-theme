<?php
/**
 * @package WordPress
 * @subpackage Coraline
 * @since Coraline 1.0
 * 
 * CHANGE FOR MINIMAKERFAIRE THEME: Added MiniMakerFaire theme name, left the Coraline acknowledgement
 */
?>

<?php //echo do_shortcode("[wpv-post-body view_template='Footer2']") ?> 

    <section class="cta-panel" style="margin-top:40px"><div class="container">
          <div class="row text-center">
            <div class="col-xs-12">
              <h3><a href="<?php echo mfo_footer_cta_url();?>"><?php echo mfo_footer_cta_text()?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></h3>
            </div>
          </div>
        </div>
      </section>


<footer class="gmf-footer">


    <div class="container">
      <div class="row padbottom">
        <div class="col-sm-6 footer-right-border">
          <div class="footer-logo-div">

	  <?php 
        	$custom_logo_id = get_theme_mod( 'custom_logo' );
        	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        ?>
	
            <a href="/">
	      <img class="img-responsive footer-logos footer-local-logo" src="<?php echo $image[0]; ?>" alt="<?php echo get_bloginfo() ?>">
            </a>
          </div>
	<?php wp_nav_menu ( array('theme_location' => 'footer-local-menu' ,
				  'menu_id'	   => 'menu-footer-menu', 
				  'menu_class'     => 'list-unstyled')); ?>

          <div class="social-network-container">
            <ul class="social-network social-circle">

              <li>
                        <a href="https://www.facebook.com/makerfaireorlando/" class="icoFacebook" title="Facebook" target="_blank">
                          <i class="fa fa-facebook"></i>
                        </a>
                      </li><li>
                        <a href="https://twitter.com/orlmakerfaire" class="icoTwitter" title="Twitter" target="_blank">
                          <i class="fa fa-twitter"></i>
                        </a>
                      </li><li>
                        <a href="https://www.instagram.com/makerfaireorlando/" class="icoInstagram" title="Instagram" target="_blank">
                          <i class="fa fa-instagram"></i>
                        </a>
                      </li>            </ul>
          </div>
        </div>

        <div class="col-sm-6 footer-right hidden-xs">
          <div class="footer-logo-div">
    <a href="http://makerfaire.com/" target="_blank">
        <img class="img-responsive footer-logos" src="//global.makerfaire.com/wp-content/themes/MiniMakerFaire/img/Maker-Faire-Logo.png" alt="Maker Faire logo">
            </a>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <ul class="list-unstyled">
                <li>
                  <a href="http://makerfaire.com/makerfairehistory" target="_blank">About Maker Faire</a>
                </li>
                <li>
                  <a href="http://makerfaire.com/map" target="_blank">Find a Faire Near You</a>
                </li>
                <li>
                  <a href="http://makerfaire.com/be-a-maker" target="_blank">Be a Maker</a>
                </li>
                <li>
                  <a href="//help.makermedia.com/hc/en-us/categories/200333245-Maker-Faire" target="_blank">Maker Faire FAQs</a>
                </li>
              </ul>
            </div>
            <div class="col-xs-6 footer-no-rt-pad">
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="social-network-container">
                <ul class="social-network social-circle">
                  <li>
                    <a href="//www.facebook.com/makerfaire" class="icoFacebook" title="Facebook" target="_blank">
                      <i class="fa fa-facebook"></i>
                    </a>
                  </li>
                  <li>
                    <a href="//twitter.com/makerfaire" class="icoTwitter" title="Twitter" target="_blank">
                      <i class="fa fa-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a href="//www.instagram.com/makerfaire" class="icoInstagram" title="Instagram" target="_blank">
                      <i class="fa fa-instagram"></i>
                    </a>
                  </li>
                  <li>
                    <a href="//www.pinterest.com/makemagazine/maker-faire/" class="icoPinterest" title="Pinterest" target="_blank">
                      <i class="fa fa-pinterest-p"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>        </div>
      </div>
      <div class="row padtop">
        <div class="col-xs-12">
          <p class="copyright-footer text-center"><?php echo mfo_event_name()?> is independently organized and operated under license from Maker Media, Inc.</p>
	  <?php do_action("mfo_inside_footer"); ?>
        </div>
      </div>
      
    </div>
  </footer>


</div><!--page-content -->

<?php wp_footer(); ?>

<?php do_action("mfo_after_footer"); ?>

</body>
</html>

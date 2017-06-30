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

<footer class="gmf-footer">
    <div class="container">
      <div class="row padbottom">
        <div class="col-sm-6 footer-right-border">
          <div class="footer-logo-div">

	  <?php 
        	$custom_logo_id = get_theme_mod( 'custom_logo' );
        	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
        ?>
	
            <a href="http://www.makerfaireorlando.com/">
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
              <ul class="list-unstyled footer-right-col">
                <li>
                  <p>Explore Making</p>
                </li>
                <li>
                  <a href="http://makezine.com/" target="_blank">Make: News & Projects</a>
                </li>
                <li>
                  <a href="http://www.makershed.com/" target="_blank">Maker Shed</a>
                </li>
                <li>
                  <a href="http://makercamp.com/" target="_blank">Maker Camp</a>
                </li>
                <li>
                  <a href="https://readerservices.makezine.com/mk/default.aspx" target="_blank">Subscribe to Make:</a>
                </li>
              </ul>
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
                  <li>
                    <a href="//plus.google.com/104410464300110463062/posts" class="icoGoogle-plus" title="Google+" target="_blank">
                      <i class="fa fa-google-plus"></i>
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
	  <?php do_action("mfo_after_footer"); ?>
        </div>
      </div>
      
    </div>
  </footer>


</div><!--page-content -->

<?php wp_footer(); ?>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55d78c9c51400055" async="async"></script>

<!-- Google Code for Remarketing Tag -->

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 857223656;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/857223656/?guid=ON&amp;script=0"/>
</div>
</noscript>



</body>
</html>

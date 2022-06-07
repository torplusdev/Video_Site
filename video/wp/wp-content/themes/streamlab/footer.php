<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage streamlab
 * @since 1.0
 * @version 1.2
 */
$theme_options = get_option('theme_options');
?>
  </div><!-- #content -->
	<!-- Footer start -->
  
      
 
<footer id="gen-footer">
  <?php
  if(class_exists('ReduxFramework'))
  {  
  ?>
     <div class="gen-footer-style-1">
        <?php
          get_template_part( 'template-parts/footer/footer', 'widgets' );
        
          get_template_part( 'template-parts/footer/site', 'info' );
        ?>
    </div>
   <?php } 
  else
  {
     get_template_part( 'template-parts/footer/footer', 'widgets' );
        
     get_template_part( 'template-parts/footer/site', 'info' );
             
  } 
  ?>
     
</footer>
  <!-- Footer stop-->

    </div><!-- .site-content-contain -->
  </div> <!-- Peaceful themes -->
</div><!-- #page -->


	<!-- === back-to-top === -->
	<div id="back-to-top">
		<a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
	</div>
	<!-- === back-to-top End === -->

<?php wp_footer(); ?>
</body>
</html>

<?php
/**
 * The Template for displaying all single movies
 *
 * This template can be overridden by copying it to yourtheme/masvideos/single-movie.php.
 *
 * HOWEVER, on occasion MasVideos will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package MasVideos/Templates
 * @version 1.0.0
 */
defined( 'ABSPATH' ) || exit;
get_header( 'movie' );
/**
 * masvideos_before_main_content hook.
 *
 * @hooked masvideos_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked masvideos_breadcrumb - 20
 */
?>
<div class="gentechtreethemes-contain-area">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">	
					<?php
					
						while ( have_posts() ) : the_post();
    						
    						 get_template_part( 'template-parts/movie/single/single', 'block' );
						endwhile; // end of the loop. 
					
					?>
				</div>
				</div>
			</div>
		</main>
	</div>
</div>
<?php 
/**
 * masvideos_after_main_content hook.
 *
 * @hooked masvideos_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
/**
 * masvideos_sidebar hook.
 *
 * @hooked masvideos_get_sidebar - 10
 */
do_action( 'masvideos_sidebar' );
get_footer( 'movie' );

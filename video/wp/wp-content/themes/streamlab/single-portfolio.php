<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage streamlab
 * @since 1.0
 * @version 1.0
 */
get_header(); 
?>
<div class="gentechtreethemes-contain-area">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">					
					<?php
					while ( have_posts() ) : the_post(); 
						get_template_part( 'template-parts/page/content', 'portfolio' );
					endwhile; // End of the loop. ?>
					</div>
				</div>
			</div><!-- #primary -->
		</main><!-- #main -->
	</div><!-- .container -->
</div>
<?php get_footer(); ?>
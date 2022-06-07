<?php
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options;
$current_post = get_post_type();
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage streamlab
 * @since streamlab 1.0
 */
get_header(); 
?>
<div class="gentechtreethemes-contain-area">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="<?php Options::get_main_row_class($current_post); ?>">
					<div class="<?php Options::get_main_column_class($current_post); ?>">
						<div class="<?php echo esc_attr( Options::get_inner_row_class( $current_post ) ) ?>">
							<?php
							if ( have_posts() ) :
								while ( have_posts() ):
									the_post();
							?>
									<div class="<?php echo esc_attr( Options::get_main_column_number_class( $current_post) ); ?>">
										<?php 
										get_template_part( 'template-parts/post/content', get_post_format() );
										?>
									</div>
							<?php endwhile; endif; ?>
						</div>
						<div class="row">
						
						<?php
						Gentech_Load_More::instance()->init( Options::get_load_type($current_post) ); 
						?>
						</div>
					</div>
					<?php
               		if(is_active_sidebar( 'sidebar-1' ) && Options::check_sidebar_active(get_post_type())):
               		?>
					<div class="col-lg-4 col-xl-3">
						<?php get_sidebar(); ?>
					</div>
					<?php endif; ?>
				</div><!-- .Row -->
			</div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
</div>
<?php get_footer(); ?>

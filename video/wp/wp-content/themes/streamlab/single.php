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
$theme_options = get_option('theme_options'); 
$flag = 1;	
$sidebar = '';			
$row = 'row';
$blogcol = 'col-xl-12 col-lg-12 col-md-12';
$sidecol = 'col-xl-3 col-lg-3 col-md-12';
if(is_active_sidebar('sidebar-1'))
{
	$sidebar = true;
	$blogcol = 'col-lg-9 col-xl-9 col-md-12';
}
else
{
	$sidebar = false;
	$blogcol = 'col-lg-12';
}
if(isset($theme_options['single_blog_sidebar']))
{
	if($theme_options['single_blog_sidebar']  === 'no_sidebar')
	{
	$sidebar = false;
	$blogcol = 'col-xl-12 col-lg-12 col-md-12';
	}
	else if($theme_options['single_blog_sidebar']  === 'right_sidebar'){
		$sidebar = true;
		$row = 'row';
	}
	else if($theme_options['single_blog_sidebar']  === 'left_sidebar'){
		$sidebar = true;
		$blogcol = 'col-xl-9 col-lg-9 col-md-12';
		$row = 'row flex-row-reverse';
	}	
}
?>
<div class="gentechtreethemes-contain-area">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="<?php echo esc_attr($row); ?>">
					<div class="<?php echo esc_attr($blogcol); ?>">					
					<?php
					while ( have_posts() ) : the_post(); 
						get_template_part( 'template-parts/post/content', get_post_format() );
					endwhile; // End of the loop. ?>
					</div>
					<?php if ( $sidebar ) { ?>		
					<div class="<?php echo esc_attr($sidecol); ?>">
						<?php get_sidebar(); ?>
					</div>
					<?php } ?>
				</div>
			</div><!-- #primary -->
		</main><!-- #main -->
	</div><!-- .container -->
</div>
<?php get_footer(); ?>
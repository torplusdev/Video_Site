<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage streamlab
 * @since 1.0
 * @version 1.0
 */
get_header();?>
<div class="gentechtreethemes-contain-area">
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="container">
			<?php
    while (have_posts()): the_post();

        get_template_part('template-parts/page/content', 'page');

        //wp_link_pages();

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()):
            comments_template();
        endif;

    endwhile; // End of the loop.
?>
		</div><!-- .container -->
	</main><!-- #main -->
</div><!-- #primary -->
</div>
<?php get_footer();
?>
<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage streamlab
 * @since 1.0
 * @version 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="entry-content">
		<?php
			the_content();
			
	?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

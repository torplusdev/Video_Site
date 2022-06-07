<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage streamlab
 * @since 1.0
 * @version 1.0
 */
get_header(); 
$theme_options = get_option('theme_options');  
$title_text = '';
$desc_text = '';
if(isset($theme_options['title_404']) && !empty($theme_options['title_404']))
{
	$title_text = $theme_options['title_404'];
}
if(isset($theme_options['description_404']) && !empty($theme_options['description_404']))
{
	$desc_text = $theme_options['description_404'];
}
?>
<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="gen-not-found">
				<div class="page-content">
					<div class="row">
						<div class="col-sm-12">
							<div class="gen-error-block">
							
							<div class="gen-errot-text"><?php esc_html_e( '404', 'streamlab' ); ?></div>
							<?php 
							if(!empty($title_text))
							{
							?>
							<h2><?php echo esc_html($title_text); ?></h2>
							<?php } 
							else
							{
							?>
							<h2><?php echo esc_html__('Oops! This Page is Not Found.' , 'streamlab'); ?></h2>
							<?php } 
							if(!empty($desc_text))
							{
							?>


							<p><?php echo esc_html( $desc_text ); ?></p> 

							<?php } 
							else
							{
							?>
							<p><?php echo esc_html__('Please go back to home and try to find out once again.' , 'streamlab'); ?></p> 
							<?php } ?>
							<div class="gen-btn-block">
								
							 	<div class="gen-btn-container">
					              <a href="<?php echo esc_url(home_url()); ?>" class="gen-button">
					                <div class="gen-button-block">
					                  <span class="gen-button-line-left"></span>
					                  <span  class="gen-button-text"><?php esc_html_e('Back to Home', 'streamlab'); ?></span>
					                  <span class="gen-button-line-right"></span>
					                </div>  
					              </a>
            					</div>	              
								</div>    
							
							</div>
						</div>
					</div>
				</div><!-- .page-content -->
			</div><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .container -->
<?php get_footer();
<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage streamlab
 * @since 1.0
 * @version 1.0
 */
$theme_options = get_option('theme_options'); 
?>

<div class="gen-copyright-footer">
	<div class="container">
		<div class="row">	
			<div class="col-md-12 align-self-center">		
				<?php
				if(isset($theme_options['streamlab_copyright_text']) && !empty($theme_options['streamlab_copyright_text']))
				{ 
				?>
				<span class="gen-copyright"><a target="_blank" href="<?php echo esc_url( $theme_options['streamlab_copyright_link'] ); ?>"> <?php echo esc_html( $theme_options['streamlab_copyright_text'] ); ?></a></span>				
				<?php }
				else
				{
				 ?>				
				
				<span class="gen-copyright"><a target="_blank" href="<?php echo esc_url( __( 'https://themeforest.net/user/gentechtree/portfolio', 'streamlab' ) ); ?>"> <?php printf( esc_html__( 'Proudly powered by %s', 'streamlab' ), 'streamlab.' ); ?></a></span>				

			<?php } ?>
				
			</div>
			
				
			
		</div>
	</div>
	
</div>
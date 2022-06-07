<?php
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options;
/**
* Displays header widgets if assigned
*
* @package WordPress
* @subpackage hostingo
* @since 1.0
* @version 1.0
*/
$sticky = 'gen-has-sticky';
$theme_options = get_option('theme_options');
if(isset($theme_options['sticky_header_enable']) && $theme_options['sticky_header_enable'])
{
	$sticky = '';
}
?>
<header id="gen-header" class="gen-header-style-1 <?php echo esc_attr($sticky); ?>">	
	<?php 
	  if(function_exists('get_field') && get_field('field_QnF1Ebs') != 'inherit')
	  {	
	  	$header_option = get_field('field_QnF1Ebs');
	  	if($header_option == 'yes')
	  	{
	  		get_template_part( 'template-parts/header/header', 'top' );
	  	}
	  	
	  }
	elseif(class_exists('ReduxFramework'))
	{
		{
			if($theme_options['top_header_enable'] == 'yes')
			{
			 	get_template_part( 'template-parts/header/header', 'top' );
			}
		}
	}
	?>
	<div class="gen-bottom-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				<nav class="navbar navbar-expand-lg navbar-light">
	              <a class="navbar-brand" href="<?php  echo esc_url( home_url( '/' ) ); ?>">
	             	<?php streamlab_display_logo(); ?>	                
	              </a>
	              
	              <div class="collapse navbar-collapse" id="navbarSupportedContent">
	                <?php if ( has_nav_menu( 'primary' ) ) : ?>
					<?php wp_nav_menu( array(
						'theme_location' => 'primary',
	        			'menu_class'  => 'navbar-nav ml-auto',
	        			'menu_id'     => 'gen-main-menu',
						'container_id' => 'gen-menu-contain',
	        			'container_class' => 'gen-menu-contain',
								) ); ?>
					<?php endif; ?>
	              </div>
	             
	         	 
	             <div class="gen-header-info-box">
	              	<div class="gen-menu-search-block">
	         	 	<a href="javascript:void(0)" id="gen-seacrh-btn"><i class="fa fa-search"></i></a>
	         	 	<div class="gen-search-form">
	         	 		<?php get_search_form(); ?>
	         	 	</div>
	         	 </div>
	         	 <?php
	         	  if(isset($theme_options['pms_enable']) && $theme_options['pms_enable'] == 'yes')
	         	  {
	         	  	

	         	  	Options::get_header_user_menus();
	         	 ?>
	         	 	
					<?php } 
					if(isset($theme_options['action_btn_url']) && !empty($theme_options['action_btn_url']))
	              		{
	              			$url = $theme_options['action_btn_url'];
	              		?>
	              	<div class="gen-btn-container">
	              		
	              		<a href="<?php echo esc_url($url); ?>" class="gen-button">
	              			<div class="gen-button-block">
	              				<span class="gen-button-line-left"></span>
	              				<?php
	              				if(isset($theme_options['action_btn_text']) && !empty($theme_options['action_btn_text']))
	              				{
	              					$text = $theme_options['action_btn_text'];
	              				} 
	              				else
	              				{
	              					$text = 'Subscribe';
	              				}
	              				?>
	              				<span  class="gen-button-text"><?php echo esc_html($text); ?></span>
	              			</div>  
	              		</a>
	              	</div>	
	              	<?php } ?>              	
	              </div>								
	             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	              <i class="fas fa-bars"></i>
	              </button>
	            </nav>
				</div>
			</div>
		</div>
	</div>
	
</header>
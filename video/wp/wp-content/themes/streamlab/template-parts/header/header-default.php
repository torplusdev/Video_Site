<?php
/**
* Displays header widgets if assigned
*
* @package WordPress
* @subpackage streamlab
* @since 1.0
* @version 1.0
*/
$sticky = 'gen-has-sticky';
$sidebar_logo = '';
$theme_options = get_option('theme_options'); 
if(isset($theme_options['sticky_header_enable']) && $theme_options['sticky_header_enable'])
{
	$sticky = '';
}

?>
<div class="gen-background-overlay"></div>
<div class="gen-sidebar">
	<div class="gen-close-btn">
		<a class="gen-close" href="javascript:void(0)">
			<i class="ion-close-round"></i>
		</a>
	</div>
	<div class="gen-sidebar-block mCustomScrollbar">
		
	</div>
</div>
<header id="gen-header" class="gen-header-default">	
	
	<div class="gen-bottom-header <?php echo esc_attr($sticky); ?>">
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
						
						<?php 
						if(class_exists('ReduxFramework'))
						{
							?>
							<div class="gen-menu-search-block">
								<a href="javascript:void(0)" id="gen-seacrh-btn"><i class="fa fa-search"></i></a>
								<div class="gen-search-form">
									<?php get_search_form(); ?>
								</div>	              	
							</div>
							<?php
							if ($theme_options['header_action_enable'] == 'yes') {
								
								
								?>
								<div class="gen-btn-container">
									<?php
									if(isset($theme_options['action_btn_url']) && !empty($theme_options['action_btn_url']))
									{
										$url = $theme_options['action_btn_url'];
									} 
									else
									{
										$url = "#";
									}
									?>
									<a href="<?php echo esc_url($url); ?>" class="gen-button">
										<div class="gen-button-block">
											
											<?php
											if(isset($theme_options['action_btn_text']) && !empty($theme_options['action_btn_text']))
											{
												$text = $theme_options['action_btn_text'];
											} 
											else
											{
												$text = 'Get Quote';
											}
											?>
											<span  class="gen-button-text"><?php echo esc_html($text); ?></span>
										</div>  
									</a>
								</div>
							<?php } } ?>
							<?php
							if(class_exists('ReduxFramework'))
							{ 
								?>
								<div class="gen-toggle-btn">
									<a href="javascript:void(0)" class='menu-toggle'><i class="ion-navicon"></i></a>
								</div>
							<?php } ?>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<i class="fas fa-bars"></i>
							</button>					
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
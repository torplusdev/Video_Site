<?php
/**
 * Template Welcome
 *
 * @link       https://themeforest.net/user/gentechtreedesign
 * @since      1.0.0
 *
 * 
 * 
 */
/**
 * @since      1.0.0
 * 
 * 
 * @author     PeaceFulThemes
 */
?>
<div class="gentech-welcome_page">
	
	
	<div class="gentech-welcome-step_wrap">
		<div class="gentech-welcome_sidebar left_sidebar">
			<div class="theme-screenshot">
				<img src="<?php echo esc_url(get_template_directory_uri() . "/screenshot.png"); ?>">
			</div>
		</div>
		<div class="gentech-welcome_content">
			<div class="gentech-welcome_title">
				<h1><?php esc_html_e('Welcome to the setup for', 'streamlab');?>
					<?php echo esc_html(wp_get_theme()->get('Name')); ?> 
				</h1>		
			</div>
		
			<div class="gentech-welcome_subtitle">
					<?php
						echo sprintf(esc_html__('It looks like you may have recently upgraded to this theme. Great! This setup  will help ensure all the default settings are correct. It will also show some information about your new website and support options' , 'streamlab'));
					?>
			</div>
			<ul>
			  <li>
			  	<span class="step">
			  		<?php esc_html_e('Step 1', 'streamlab');?>		
			  	</span>
			  	<?php esc_html_e('Activate your license.', 'streamlab');?>
			  	<span class="attention-title">
			  		<strong>
			  			<?php esc_html_e('Important:', 'streamlab');?>
			  		</strong>
			  		<?php esc_html_e('one license  only for one website', 'streamlab');?>
			  	</span>
			  </li>			  
			  <li>
			  	<span class="step">
			  		<?php esc_html_e('Step 2', 'streamlab');?>		
			  	</span>
			  	<?php 
				
				echo sprintf('Check requirements to avoid errors with your WordPress.');
			  	?>
			  </li>
			  <li>
			  	<span class="step">
			  		<?php esc_html_e('Step 3', 'streamlab');?>
			  	</span>
			  	<?php esc_html_e('Install Required and recommended plugins.', 'streamlab');?>
			  </li>
			  
			</ul>
			<div class="gentech-btn-holder">
				<a  class="button button-primary button-next" href="<?php echo esc_url(admin_url('admin.php?page=gentech-activate-theme-panel')); ?>">
				<span class="text-btn"><?php esc_html_e( 'Next Step', 'streamlab' ); ?></span>
				</a>
			</div>	
			
	
		</div>
	</div>
</div>

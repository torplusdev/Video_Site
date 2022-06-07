<?php
/**
 * Template Activate Theme
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
<div class="gen-video-import-section wrap">
	<div class="gentech-activation-theme_form">
	<div class="container-form">

			<div class="gen-notices">
				
			</div>
			
			<form class="form gentech-import" action="<?php echo esc_url( admin_url( 'admin.php?page=gentech-activate-theme-panel' ) ); ?>" method="post">
				<div class="help-description">
					<a href="https://developer.vimeo.com/api/guides/start" target="_blank"><?php esc_html_e('How to get API Key?', 'streamlab');?></a>
				</div>
				<div class="form-row">
					
					<div class="form-group">
						<label class="form-label" for="purchase_item"><?php esc_html_e( 'Enter Youtube Developer Api Key', 'streamlab' ); ?></label>
						<input class="form-control" placeholder="<?php esc_attr_e( 'Enter Youtube Developer Api Key', 'streamlab' ); ?>" type="text" name="api_key" data-type="vimoe" value="<?php echo get_option( 'gen_vimoe_api_key' ); ?>">
					</div>	

				<div class="form-group">
					<a type="submit" class="button button-primary gen-save-api-key" value="submit">
						<span class="gen-loading-icon dashicons dashicons-update"></span>
						<span class="text-btn"><?php esc_html_e( 'Save', 'streamlab' ); ?></span>
					</a>
				</div>


				</div>
				<?php wp_nonce_field( 'purchase-activation', 'security' ); ?>
				
				
			</form>	

			<form method="post" action="<?php the_permalink(); ?>">
			<div class="gen-data-wraper">
				<div class="form-row">
					<div class="form-group">
						<input class="form-control" placeholder="<?php esc_attr_e( 'Enter Video Name', 'streamlab' ); ?>" type="text" name="video_name">

					</div>	

					<div class="form-group">
						<a  class="button button-primary search-vimoe" value="submit">
							<span class="gen-loading-icon dashicons dashicons-update"></span>
							<span class="text-btn"><?php esc_html_e( 'Search', 'streamlab' ); ?></span>
							
						</a>

						<a  class="button button-primary vimoe-import" value="submit">
							<span class="gen-loading-icon dashicons dashicons-update"></span>
							<span class="text-btn"><?php esc_html_e( 'Import', 'streamlab' ); ?></span>
							
						</a>

						<div class="gen-import-notice">
						</div>
					</div>
				</div>

			
			</div>
		</form>
	
		
		
	</div>

	<div class="gen-search-container">
		<table class="vimoe-videos">
					
					<tbody>
						
					</tbody>
				</table>
	</div>
</div>
</div>


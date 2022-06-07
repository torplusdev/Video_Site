<?php 
if(class_exists('ReduxFramework'))
{
	$theme_options = get_option('theme_options'); 
	if(isset($theme_options['subscribe_img']) && !empty($theme_options['subscribe_img']['url']))
	{
		$img = $theme_options['subscribe_img']['url'];
	}
	else
	{
		$img = '';
	}

?>
<div class="gen-subscribe align-items-center">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="gen-subscribe-block">
					<img src="<?php echo esc_url($img); ?>" class="gen-subscribe-img" alt="<?php esc_attr_e( 'streamlab-subscribe-image', 'streamlab' ); ?>">
					<div class="gen-subscribe-details">
						<h6>
							<?php 
							if(isset($theme_options['streamlab_subscribe_title'])) 
							{
								echo esc_html($theme_options['streamlab_subscribe_title']); 
							}
							?>
								
							</h6>
						<span>
							<?php
							if(isset($theme_options['streamlab_copyright_description'])) 
							{

								echo esc_html($theme_options['streamlab_copyright_description']);
							}
							?>
								
							</span>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="gen-subscribe-from">
					<?php echo do_shortcode(esc_attr($theme_options['streamlab_subscribe_shortcode'])); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
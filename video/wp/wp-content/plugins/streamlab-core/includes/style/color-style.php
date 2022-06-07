<?php 
/**
	Custom Color
**/
add_action( 'wp_head', 'architeck_color_style'); 
function architeck_color_style()
{
	$theme_options = get_option('theme_options'); 
	$style = '';
	if(isset($theme_options['pt_custom_color']) && $theme_options['pt_custom_color'] == 'yes')
	{
		$style .= ':root {';
		if(!empty($theme_options['pt_primary_color']))
		{
			$style .= '--primary-color: '.$theme_options['pt_primary_color'].' !important;';
		}
		if(!empty($theme_options['pt_secondary_color']))
		{
			$style .= '--secondary-color: '.$theme_options['pt_secondary_color'].' !important;';
		}
		if(!empty($theme_options['pt_dark_color']))
		{
			$style .= '--dark-color: '.$theme_options['pt_dark_color'].' !important;';
		}
		if(!empty($theme_options['pt_grey_color']))
		{
			$style .= '--grey-color: '.$theme_options['pt_grey_color'].' !important;';
		}
		if(!empty($theme_options['pt_white_color']))
		{
			$style .= '--white-color: '.$theme_options['pt_white_color'].' !important;';
		}
		$style .= '}';

		wp_register_style( 'pt-color-style', false );
		wp_enqueue_style( 'pt-color-style' );

		wp_add_inline_style( 'pt-color-style', $style );
	}
}
?>
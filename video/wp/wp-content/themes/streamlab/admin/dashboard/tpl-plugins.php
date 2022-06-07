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

if(!class_exists('TGMPA_List_Table')){
	return;
}

$plugin_table = new TGMPA_List_Table;

wp_clean_plugins_cache( false );

if(!Gtech_Theme_Helper::gtech_purchase_verify())
{
	wp_die('<div class="error notice">
    			<h1>The Licence is not active</h1>
    			<p>Sorry, you are not allowed to view the plugins.</p>
			</div>');
}



?>

<div class="gentech-tgmpa_dashboard tgmpa wrap">

	<?php $plugin_table->prepare_items(); ?>

	<?php $plugin_table->views(); ?>

	<form id="tgmpa-plugins" action="" method="post">
		<input type="hidden" name="tgmpa-page" value="tgmpa-install-plugins" />
		<input type="hidden" name="plugin_status" value="<?php echo esc_attr( $plugin_table->view_context ); ?>" />
		<?php $plugin_table->display(); ?>
	</form>
</div>

<div class="gentech-btn-holder">
    				<a  class="button button-primary button-prev" href="<?php echo esc_url(admin_url('admin.php?page=gentech-status-panel')); ?>">
				<span class="text-btn"><?php esc_html_e( 'Prev Step', 'streamlab' ); ?></span>
				</a>
				<a  class="button button-primary button-next" href="<?php echo esc_url(admin_url('admin.php?page=gentech-theme-helper-panel')); ?>">
				<span class="text-btn"><?php esc_html_e( 'Next Step', 'streamlab' ); ?></span>
				</a>

</div>	
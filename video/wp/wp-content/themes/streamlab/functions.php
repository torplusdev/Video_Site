<?php
/**
 * streamlab functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://developer.wordpress.org/themes/advanced-topics/child-themes/
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage streamlab
 * @since streamlab 1.0
 */
namespace gentechtree\streamlab;
remove_action( 'masvideos_after_movies_loop', 'masvideos_movies_page_control_bar', 10 );
class Streamlab_Init
{
	public function __construct (){
		$this->constants();
		$this->version_compare();
		$this->load_dependencies();
	}
	 public function load_dependencies()
	 {
	 	
	 	require_once STREAMLAB_DIR . '/inc/theme-setup.php';
        require_once STREAMLAB_DIR . '/inc/theme-helper.php';
        require_once STREAMLAB_ADMIN_DIR . '/classes/autoload.php';
	 	require_once STREAMLAB_DIR . '/inc/customizer/init.php';
	 }
	 private function constants()
	 {
	 	define('STREAMLAB_DIR', get_template_directory());
		define('STREAMLAB_URI', get_template_directory_uri());  
		define('STREAMLAB_ADMIN', admin_url());   
		define('STREAMLAB_ADMIN_DIR', get_template_directory() .  '/admin/');  
		define('STREAMLAB_ASSETS_URI', STREAMLAB_URI . '/assets/'); 
	 }
	 private function version_compare()
	 {
	 	if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
			require STREAMLAB_DIR . '/inc/back-compat.php';
		}
	 }




}
new Streamlab_Init;

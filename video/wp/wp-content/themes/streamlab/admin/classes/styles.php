<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Pcfq Dynamic Styles
*
*
* @class        Gtech_dynamic_styles
* @version      1.0
* @category     Class
* @author       PeaceFulThemes
*/
class Gtech_dynamic_styles{
	protected static $instance = null;
	private $getduri;
	private $use_minify;
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	public function register_script(){
		$this->getduri = get_template_directory_uri();
		// Register action for Admin
		add_action('admin_enqueue_scripts', array($this,'admin_css') );
		add_action('admin_enqueue_scripts', array($this, 'admin_js') );
		
		add_action( 'wp_enqueue_scripts', array($this,'enqueue_scripts') , 99);	
		
	}
	/* Register css for admin panel */
	public function admin_css(){
		// Main admin styles
		wp_enqueue_style('gentech-admin', $this->getduri . '/admin/assest/css/admin.css');
		// Add standard wp color picker
	}
	/* Register css and js for admin panel */
	public function admin_js(){
		$currentTheme = wp_get_theme();
        $theme_name = $currentTheme->parent() == false ? wp_get_theme()->get( 'Name' ) : wp_get_theme()->parent()->get( 'Name' );
        $theme_name = trim($theme_name);
        $email = '';
        $purchaseCode = '';
        $domain_id = '';
        $purchase_opt = get_option('envato_licence_data');
        if(!empty($purchase_opt))
        {
        	$purchaseCode = $purchase_opt['data']['purchase_key'];
        	$domain_id = $purchase_opt['data']['domain_id'];
        }
	    wp_enqueue_script('gentech-admin', $this->getduri . '/admin/assest/js/admin.js');
	    wp_localize_script('gentech-admin', 'Gtech_verify', [
            'ajaxurl' => esc_js(admin_url('admin-ajax.php')),
            'PcfqUrlActivate' => esc_js(Gtech_Theme_Verify::get_instance()->api),
            'PcfqUrlDeactivate' => esc_js(Gtech_Theme_Verify::get_instance()->api . 'deactivate'),
            'domainUrl' => esc_js(site_url( '/' )),
            'themeName' => esc_js($theme_name),
            'purchaseCode' => esc_js($purchaseCode),
            'domain_id' => esc_js($domain_id),
            'email' => esc_js($email),
            'message' => esc_js(esc_html__( 'Thank you, your license has been validated', 'streamlab' )),
            'ajax_nonce' => esc_js( wp_create_nonce('_notice_nonce') )
		]);
	}
	public function minify_css($css = null){
		if (!$css) { return; }
		$css = str_replace( ',{', '{', $css );
		$css = str_replace( ', ', ',', $css );
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		$css = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css );
		$css = trim( $css );
		return $css;
	}
	public function enqueue_scripts()
	{
		$theme_options = get_option('theme_options'); 
		 wp_enqueue_style( 'streamlab-fonts', $this->streamlab_fonts_url(), array(), null );
    // Load Bootstrap Javascript.
	  wp_enqueue_script('bootstrap', STREAMLAB_URI .'/assets/js/bootstrap.min.js', array(), '4.1.3' , true);
	// Load Counter Js.
	wp_enqueue_script('jquery-count', STREAMLAB_URI .'/assets/js/jquery.countTo.js', array( 'jquery' ),'1.0', true);
	wp_enqueue_script('isotope', STREAMLAB_URI .'/assets/js/isotope.pkgd.min.js', array( 'jquery' ),'1.0', true);
	//load Owl carousl
	wp_enqueue_script('owl-carousel', STREAMLAB_URI .'/assets/js/owl.carousel.min.js', array(),'2.3.4', true);
	wp_enqueue_script('jquery-magnific-popup', STREAMLAB_URI .'/assets/js/jquery.magnific-popup.min.js', array('jquery'),'1.1.0', true);
	wp_enqueue_script('streamlab-script', STREAMLAB_URI .'/assets/js/script.js', array(),'1.0', true);
	wp_enqueue_script('streamlab-load-more', STREAMLAB_URI .'/assets/js/loadmore.js', array(),'1.0', true);
	 wp_localize_script('streamlab-script', 'woo_obj', [
            'ajaxurl' => esc_js(admin_url('admin-ajax.php')),
           
            'ajax_nonce' => esc_js( wp_create_nonce('_notice_nonce') )
		]);
    // Theme stylesheet.
	wp_enqueue_style('fontawesome', STREAMLAB_URI .'/assets/css/font-awesome/css/all.css', array(), '5.13.0', 'all');
	wp_enqueue_style('ionicons', STREAMLAB_URI .'/assets/css/ionicons.min.css', array(), '2.0.0', 'all');
	wp_enqueue_style('line-awesome', STREAMLAB_URI .'/assets/css/line-awesome.min.css', array(), '1.3.0', 'all');
    //Load Bootstrap stylesheet.
	wp_enqueue_style('bootstrap', STREAMLAB_URI .'/assets/css/bootstrap.min.css',array(), '4.1.3', 'all');
	//load Owl carousl
	wp_enqueue_style('owl-carousel', STREAMLAB_URI .'/assets/css/owl.carousel.min.css',array(), '1.1.0', 'all');
	wp_enqueue_style('magnific-popup', STREAMLAB_URI .'/assets/css/magnific-popup.min.css',array(), '2.3.4', 'all');
	wp_enqueue_style('animate', STREAMLAB_URI .'/assets/css/animate.min.css',array(), '4.0.0', 'all');

	if(isset($theme_options['color_demo']))
	{
		if($theme_options['color_demo'] == 'red')
		{
			  wp_enqueue_style('streamlab-style', STREAMLAB_URI .'/assets/css/color/style-red.css',array(), '1.0', 'all');
		}
		else
		{
			 wp_enqueue_style('streamlab-style', STREAMLAB_URI .'/assets/css/style.css',array(), '1.0', 'all');
		}
	}
	else
	{
		 wp_enqueue_style('streamlab-style', STREAMLAB_URI .'/assets/css/style.css',array(), '1.0', 'all');
	}
  
  wp_enqueue_style('streamlab-main', STREAMLAB_URI .'/assets/css/main.css',array(), '1.0', 'all');

	wp_enqueue_style('streamlab-responsive', STREAMLAB_URI .'/assets/css/responsive.css',array(), '1.0', 'all');
		if (is_singular() && comments_open() && (get_option('thread_comments') == 1))
	    {
        // Load comment-reply.js (into footer)
        	wp_enqueue_script('comment-reply', '/wp-includes/js/comment-reply.min.js', array() , false, true);
   		 }
	}
	public function streamlab_fonts_url() {
	$fonts_url = '';
	/*
	 * translators: If there are characters in your language that are not supported
	 * by Libre Franklin, translate this to 'off'. Do not translate into your own language.
	 */
	$font_families = array();
	$Jost = _x( 'on', 'Jost font: on or off', 'streamlab' );
	$Roboto = _x( 'on', 'Roboto font: on or off', 'streamlab' );
	
	if ( 'off' !== $Jost) 
	{
		$font_families[] = 'Jost:wght@100;200;300;400;500;600;700;800;900';
	}
	if ( 'off' !== $Roboto) 
	{
		$font_families[] = 'Roboto:wght@100;300;400;500;700;900';
	}
	
		$query_args = array(
			'family'  =>   implode( '&family=', $font_families ) ,
			'subset'  =>  urlencode('latin,latin-ext' ),
			'display' =>  urlencode('swap' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );
	return  esc_url_raw( $fonts_url  );
}
}
if(!function_exists('Gtech_dynamic_styles')){
    function Gtech_dynamic_styles() {
        return Gtech_dynamic_styles::get_instance();
    }
}
Gtech_dynamic_styles()->register_script();
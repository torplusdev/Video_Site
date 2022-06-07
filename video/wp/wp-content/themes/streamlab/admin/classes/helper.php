<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Pcfq Theme Helper
*
*
* @class        Gtech_Theme_Helper
* @version      1.0
* @category     Class
* @author       PeaceFulThemes
*/
if (!class_exists('Gtech_Theme_Helper')) {
    class Gtech_Theme_Helper{
        private static $instance = null;
        public function __construct () {  
           
        }
        public static function get_instance( ) {
            if ( null == self::$instance ) {
                self::$instance = new self( );
            }
            return self::$instance;
        }
        /**
         * Check licence activation
         */
        public static function gtech_purchase_verify(){
            $licence_key = get_option( 'envato_licence_data' );
            $licence_key = empty( $licence_key ) ? get_option( Gtech_Theme_Verify::get_instance()->item_id ) : $licence_key;
            
            if( !empty($licence_key) ){
                if(self::gtech_if_domain_change())
                {
                    return $licence_key;
                }
                else
                {
                    update_option( 'envato_licence_data', '' );
                    update_option( Gtech_Theme_Verify::get_instance()->item_id, '' );
                    
                }
                
            }
            
            return true;
        }
        public static function gtech_external_plugin_url($filename = '')
        {
              
            $base_path = 'http://gentechtree.com/addon/'; 
            if(self::gtech_purchase_verify())
            {
                return $base_path.$filename.'.zip';
            }    
            else
            {
                return '';
            }   
        }
        public static function gtech_demo_file_path($filename = '' , $extension = '' , $type = '')
        {
            if(self::gtech_purchase_verify())
            {
                if($type == 'slider')
                {
                  return STREAMLAB_ADMIN_DIR . '/classes/import/slider/'.$filename.'.'.$extension;  
                }
                return STREAMLAB_ADMIN_DIR . '/classes/import/demos/demo-1/'.$filename.'.'.$extension;
                
            }
        }
        public static function gtech_demo_prev_img_url($filename = '' , $extension = '')
        {
            return  STREAMLAB_URI. '/admin/classes/import/demos/demo-1/'.$filename.'.'.$extension;
        }
        public static function gtech_if_domain_change()
        {
           
            $purchase_opt = get_option( 'envato_licence_data' );
            if(isset($purchase_opt['activation_code']))
            {
                if(self::gtech_get_activation_code($purchase_opt['purchase']) == $purchase_opt['activation_code'])
                {
                  return true;
                }
                else
                {
                    return false;
                }
            }
            return false;
            
        }
        
        public static function gtech_get_activation_code($purchae_code)
        {
            $url = esc_url(site_url( '/' ));
            $url = trim($url, '/');
            if (!preg_match('#^http(s)?://#', $url)) {
                $url = 'http://' . $url;
            }
            $urlParts = parse_url($url);
            // remove www
            $domain = preg_replace('/^www\./', '', $urlParts['host']);
            return wp_hash( $purchae_code . $domain  );
        }
        public function gtech_get_assets_path($filename = '' , $extension = '')
        {
            if(self::gtech_purchase_verify())
            {
                return STREAMLAB_ASSETS_URI . $filename .'.'.$extension;
            }
        }
        public  function gtech_domain_change_admin_notice() 
        {
            $class = 'notice notice-error';
            
            
            if(!self::gtech_if_domain_change())
            {
             printf( '<div class="%1$s"><p><b>%2$s</b></p><a href="%3$s">'.esc_html__('Click Here' , 'streamlab').'</a></div>', esc_attr( $class ), esc_html__( 'The Liecence is not active', 'streamlab' ) , esc_url(admin_url('admin.php?page=gentech-activate-theme-panel')) ); 
            }
        }
        public static function gtech_restric_page($slug = '')
        {
            $respage = array('tgmpa-install-plugins' , 'gen-one-click-demo-import' , '_theme_options');
            if(isset($_REQUEST['page']) && in_array($_REQUEST['page'] , $respage) )
            {
                if(!self::gtech_purchase_verify())
                {
                    wp_die('<div class="error notice">
                                <h1>The Licence is not active</h1>
                                <p>Sorry, you are not allowed to view the page.</p>
                                <p>Please activate the licence code.</p>
                                <a href="'.esc_url(admin_url('admin.php?page=gentech-activate-theme-panel')).'">'.esc_html('Click Here' , 'streamlab').'</a>
                            </div>');
                }
            }
        }
       
        
    }
    new Gtech_Theme_Helper();
    
}
 
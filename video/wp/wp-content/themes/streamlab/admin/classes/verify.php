<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Verify Theme
*
*
* @class        Gtech_Theme_Verify
* @version      1.0
* @category Class
* @author       PeaceFulThemes
*/
if (!class_exists('Gtech_Theme_Verify')) {
    class Gtech_Theme_Verify{
        public $item_id = 'envato_purchase_code';
        public  $enavto_item_id = '';
        public $api = 'http://gentechtreeqode.com/wp-hash-verify/wp-json/pfq-lc-vrfy/purchase/';
        public $activation_code = '';
        /**
        * @access      private
        * @var         \Gtech_Theme_Verify $instance
        * @since       3.0.0
        */
        private static $instance;
        /**
        * Get active instance
        *
        * @access      public
        * @since       3.1.3
        * @return      self::$instance
        */
        // Shim since we changed the function name. Deprecated.
        public static function get_instance() {
            
            if ( ! self::$instance ) {
                self::$instance = new self;
                self::$instance->hooks();
            }
            return self::$instance;
        }
        private function hooks(){
            add_action( 'wp_ajax_theme_activation', array( $this, 'theme_activation' ) );
            add_action( 'wp_ajax_nopriv_theme_activation', array( $this, 'theme_activation' ));              
            add_action('admin_init',array($this,'deactivate_theme'));
        }
        public function theme_activation(){
            $data = array( 'code'   => 0, 'message'   => '', 'data'     => '');  
            if (! isset( $_POST['email'] ) ||  ! isset( $_POST['purchase_code'] ) || ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'purchase-activation' ) ) {
                $data['data'] = 1; 
                $data['message'] = esc_html__( 'Please enter a valid field', 'streamlab' );
                echo json_encode( $data );     
                wp_die();
            }else{
                $email      = $_POST['email'];
                $purchase   = $_POST['purchase_code'];
                if(! is_email( $email ) ){
                    $data['data'] = array(); 
                    $data['message'] = esc_html__( 'Please enter a valid email address.', 'streamlab' );
                    echo json_encode( $data );     
                    wp_die();
                }
                if(empty($purchase)){
                    $data['data'] = array(); 
                    $data['message'] = esc_html__( 'Purchase code is empty ', 'streamlab' );
                    echo json_encode( $data );     
                    wp_die();                    
                }
                if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $purchase))
                {
                       $data['data'] = array(); 
                        $data['message'] = esc_html__( 'Purchase code is Not Valid', 'streamlab' );
                        echo json_encode( $data );     
                         wp_die();                    
              }
                $this->activation_code =  Gtech_Theme_Helper::gtech_get_activation_code($purchase);
                $return = self::check_theme_activation($email, $purchase);
                if( $return !== false ){ 
                    $result = json_decode( $return['body'], true );
                    if(isset($result['code']) && !empty($result['code']) && $result['code'] == 200){
                        $data['purchase'] = $purchase;                      
                        $data['code'] = $result['code'];                      
                        $data['email'] = $email; 
                        $data['data'] = $result['data'];
                        $data['activation_code'] = $this->activation_code;
                        $data['message'] =  esc_html__( 'Thank you, your license has been validated', 'streamlab' ); 
                        update_option( 'envato_licence_data', $data );
                        update_option( Gtech_Theme_Verify::get_instance()->item_id, $purchase );
                        update_option( 'gtech_js_activation_data', '' );
                        echo json_encode( $data ); 
                    }else{
                        $data['code'] = $result['code']; 
                        $data['message'] = $result['message']; 
                        $data['data'] = array(); 
                        update_option( 'envato_licence_data', '' );
                        update_option( Gtech_Theme_Verify::get_instance()->item_id, '' );
                        update_option( 'gtech_js_activation_data', '' );
                        echo json_encode( $data );     
                    }   
                }
            }
            wp_die(); 
        }
        public static function check_theme_activation($email, $purchase){
            $url = Gtech_Theme_Verify::get_instance()->api . 'verification';
            $item_id = Gtech_Theme_Verify::get_instance()->enavto_item_id;
            $activation_code = Gtech_Theme_Verify::get_instance()->activation_code;
            global $wp_version;
            $args = array(
                'user-agent' => 'WordPress/' . $wp_version . '; ' . esc_url( home_url() ),
                'body'       => 
                    array(
                            'purchase_code'   => $purchase,
                            'email'     => $email,
                            'domain_url' => esc_url(site_url( '/' )),
                            'theme_name' => trim(str_replace('Child', '', wp_get_theme()->get('Name'))),
                            'enavto_item_id' => $item_id,
                            'activation_code' => $activation_code,
                        )
            );
            $request = wp_remote_post( $url, $args );
            if ( is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) !== 200 ) {
                return false;
            }
            return $request;
        }
        public function deactivate_theme(){
            if( !Gtech_Theme_Helper::gtech_purchase_verify() ){
                return;
            }    
            $deactivate_theme = isset($_POST['deactivate_theme']) && !empty($_POST['deactivate_theme']) && !isset($_POST['js_theme_deactivate_theme']) ? TRUE : FALSE;
            if((bool) $deactivate_theme){
                $url = Gtech_Theme_Verify::get_instance()->api . 'deactivate';
                global $wp_version;
                $theme_details = get_option('envato_licence_data');
                $purchase_code = $theme_details['purchase'];
                $email = $theme_details['email'];
                $args = array(
                    'user-agent' => 'WordPress/' . $wp_version . '; ' . esc_url( home_url() ),
                    'body'       => json_encode(
                        array(
                                'purchase_code'   => $purchase_code,
                                'email'     => $email,
                                'domain_url' => esc_url(site_url( '/' )),
                                'theme_name' => trim(str_replace('Child', '', wp_get_theme()->get('Name')))
                            )
                        )
                );
                $request = wp_remote_post( $url, $args );
                if ( is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) !== 200 ) {
                    return false;
                }
                update_option( 'envato_licence_data', '' );
                update_option( Gtech_Theme_Verify::get_instance()->item_id, '' );
                return $request;
            }
        }
    }
}
Gtech_Theme_Verify::get_instance();
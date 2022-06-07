<?php
add_action( 'tgmpa_register', 'streamlab_register_required_plugins' );
function streamlab_register_required_plugins() {
        $plugins = array(
         array(
            'name'      => esc_html__( 'Advanced Custom Fields','streamlab' ),
            'slug'      => 'advanced-custom-fields',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Elementor','streamlab' ),
            'slug'      => 'elementor',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Redux Framework','streamlab' ),
            'slug'      => 'redux-framework',
            'required'  => true,
        ),
        
        array(
            'name'      => esc_html__( 'MAS Videos','streamlab' ),
            'slug'      => 'masvideos',
            'required'  => true,
        ),

           array(
            'name'      => esc_html__( 'Paid Member Subscriptions','streamlab' ),
            'slug'      => 'paid-member-subscriptions',
            'required'  => true,
        ),
         
          array(
            'name'      => esc_html__( 'One Click Demo Import','streamlab' ),
            'slug'      => 'one-click-demo-import',
            'required'  => true,
        ),
       
        array(
            'name'      => esc_html__( 'Contact Form 7','streamlab' ),
            'slug'      => 'contact-form-7',
            'required'  => true,
        ),
        array(
            'name'      => esc_html__( 'Streamlab Core','streamlab' ),
            'slug'      => 'streamlab-core',
            'source'    => Gtech_Theme_Helper::gtech_external_plugin_url('streamlab/streamlab-core'),           
            'required'  => true,
        ),
       
    );
    $config = array(
        'id'           => 'streamlab',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );
    tgmpa( $plugins, $config );
}
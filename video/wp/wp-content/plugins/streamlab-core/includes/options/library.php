<?php
/*
 * Sidebar Options
*/


// sidebar Page Settings
Redux::setSection( $options, array(
    'title' => esc_html__('User Library','stremlab-core'),
    'id'    => 'user-section',
    'icon' => 'fa fa-indent',
        
    'subsection' => false,
         
    'fields'=> array(

        array(
            'id' => 'info_general'.rand(10,1000),
            'type' => 'info',
            'style' => 'custom',
            'color' => sanitize_hex_color($color),
            'title' => __('User Library', 'stremlab-core') ,
            
        ) ,

        array(
            'id' => 'section-general'.rand(10,1000),
            'type' => 'section',
            'indent' => true
        ) ,  

         array(
            'id' => 'enable_user_menu',
            'type' => 'button_set',
            'title' => esc_html__('Enable User Menu In Header', 'stremlab-core') ,

            'options' => array(
                'yes' => esc_html__('Yes', 'stremlab-core') ,
                'no' => esc_html__('No', 'stremlab-core')

            ) ,
            'default' => 'yes',
        ) ,  

         array(
            'id' => 'enable_user_library',
            'type' => 'button_set',
            'title' => esc_html__('Enable Libray Menu For User In Header', 'stremlab-core') ,

            'options' => array(
                'yes' => esc_html__('Yes', 'stremlab-core') ,
                'no' => esc_html__('No', 'stremlab-core')

            ) ,
            'default' => 'yes',
        ) ,  

        array(
            'id' => 'enable_upload_video',
            'type' => 'button_set',
            'title' => esc_html__('Enable Upload Video', 'stremlab-core') ,

            'options' => array(
                'yes' => esc_html__('Yes', 'stremlab-core') ,
                'no' => esc_html__('No', 'stremlab-core')

            ) ,
            'default' => 'yes',
        ) ,

        array(
            'id' => 'info_general'.rand(10,1000),
            'type' => 'info',
            'style' => 'custom',
            'color' => sanitize_hex_color($color),
            'title' => __('User Actions', 'stremlab-core') ,
            
        ) ,

        array(
            'id' => 'section-general'.rand(10,1000),
            'type' => 'section',
            'indent' => true
        ) ,    

        array(
            'id' => 'enable_playlist_button',
            'type' => 'button_set',
            'title' => esc_html__('Enable Playlist Button', 'stremlab-core') ,

            'options' => array(
                'yes' => esc_html__('Yes', 'stremlab-core') ,
                'no' => esc_html__('No', 'stremlab-core')

            ) ,

            'default' => 'yes',
        ) ,

         array(
            'id' => 'enable_share_button',
            'type' => 'button_set',
            'title' => esc_html__('Enable Share Button', 'stremlab-core') ,

            'options' => array(
                'yes' => esc_html__('Yes', 'stremlab-core') ,
                'no' => esc_html__('No', 'stremlab-core')

            ) ,

            'default' => 'yes',
        ) ,

        array(
            'id' => 'enable_like_button',
            'type' => 'button_set',
            'title' => esc_html__('Enable Like Button', 'stremlab-core') ,

            'options' => array(
                'yes' => esc_html__('Yes', 'stremlab-core') ,
                'no' => esc_html__('No', 'stremlab-core')

            ) ,
            'default' => 'yes',
        ) ,

           
    )
));
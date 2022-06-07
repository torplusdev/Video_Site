<?php
/*
 * 404 Options
 */
$options;
Redux::setSection( $options, array(
    'title' => esc_html__('404','architeck'),
    'id'    => 'fourzerofour-section',
    'icon'  => 'el-icon-error',
    'desc'  => esc_html__('This section contains options for 404.','architeck'),
    'fields'=> array(

        array(
            'id'       => 'architeck_404_banner_image',         
            'type'     => 'media',
            'url'      => true,
            'title'    => esc_html__( '404 Page Default Banner Image','architeck'),
            'read-only'=> false,
            'subtitle' => esc_html__( 'Upload banner image for your Website. Otherwise blank field will be displayed in place of this section.','architeck'),
        ),

        array(
            'id'        => 'architeck_fourzerofour_title',
            'type'      => 'text',
            'title'     => esc_html__( '404 Page Title','architeck'),
            'default'   => esc_html__( '404 Error','architeck' )
        ),
        array(
            'id'        => 'architeck_four_description',
            'type'      => 'textarea',
            'title'     => esc_html__( '404 Page Description','architeck'),
            'default'   => esc_html__( 'Oops! This Page is Not Found.','architeck' )
        ),
    )) 
);
?>
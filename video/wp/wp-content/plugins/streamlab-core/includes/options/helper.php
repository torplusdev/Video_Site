<?php 
function streamlab_core_get_layout_options($name = '' , $type ='' , $title ='' , $subtitle = '')
{
	if($type == 'column')
	{
	 return array(
            'id'        => $name.'_layout',
            'type'      => 'image_select',
            'title'     => esc_html__( $title ,'stremlab-core' ),
            'subtitle' => wp_kses( __( $subtitle ,'stremlab-core' ), array( 'br' => array() ) ),
            'options'   => array(
                                
                                '1' => array( 'title' => esc_html__( 'One Columns','stremlab-core' ), 'img' => STREAMLAB_CORE_URL. 'public/img/options/one-column.png' ), 
                                '2' => array( 'title' => esc_html__( 'Two Columns','stremlab-core' ), 'img' => STREAMLAB_CORE_URL. 'public/img/options/two-column.png' ), 
                                '3' => array( 'title' => esc_html__( 'Three Columns','stremlab-core' ), 'img' => STREAMLAB_CORE_URL. 'public/img/options/three-column.png' ),
                                 '4' => array( 'title' => esc_html__( 'Four Columns','stremlab-core' ), 'img' => STREAMLAB_CORE_URL. 'public/img/options/four-column.png' ),
                                  '5' => array( 'title' => esc_html__( 'Five Columns','stremlab-core' ), 'img' => STREAMLAB_CORE_URL. 'public/img/options/five-column.png' ),                                
                            ),
            'default'   => '1',
        );
 	}
 	if($type == 'sidebar')
 	{
 		  return array(
            'id'        => $name.'_sidebar',
            'type'      => 'image_select',
            'title'     => esc_html__( $title ,'stremlab-core' ),
            'subtitle'     => esc_html__( $subtitle,'stremlab-core' ),
            'options'   => array(
                                'no_sidebar' => array( 'title' => esc_html__( 'No Sidebar','stremlab-core' ), 'img' => STREAMLAB_CORE_URL. 'public/img/options/nosidebar.png' ), 
                                'left_sidebar' => array( 'title' => esc_html__( 'Left Sidebar','stremlab-core' ), 'img' => STREAMLAB_CORE_URL. 'public/img/options/left-sidebar.png' ), 
                                'right_sidebar' => array( 'title' => esc_html__( 'Right Sidebar','stremlab-core' ), 'img' => STREAMLAB_CORE_URL. 'public/img/options/right-sidebar.png' ), 
                                
                                
                            ),
            'default'   => 'right_sidebar',
        );
 	}
}
function streamlab_core_get_post_load_type($name = ''  , $title ='' , $subtitle = '')
{
	 $options = array(
            'pagination' => 'pagination',
            'loadmore' => 'loadmore',
            'infscroll' => 'Infinity Scroll'
        );   
    
    if($name == 'movie_playlist' || $name =='tv_show_playlist' || $name == 'video_playlist')
    {
        $options = array(
            'loadmore' => 'loadmore',
            'infscroll' => 'Infinity Scroll'
        );   
    }
    

    return  array(
        'id'       => $name.'_load_type',
        'type'     => 'select',
        'title'    => __( $title, 'stremlab-core'), 
        'subtitle' => __( $subtitle, 'stremlab-core'),
        'options'  => $options,
        'default'  => 'loadmore',
    );
}
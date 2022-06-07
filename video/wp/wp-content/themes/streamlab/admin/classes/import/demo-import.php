<?php
function streamlab_ocdi_import_files() {
	return array(
		array(
			'import_file_name'           => 'Main Home',
			
			'local_import_file'            => Gtech_Theme_Helper::gtech_demo_file_path('xml','xml'),
			'local_import_widget_file'     => Gtech_Theme_Helper::gtech_demo_file_path('wie','wie'),
			'local_import_customizer_file' => Gtech_Theme_Helper::gtech_demo_file_path('dat','dat'),
			'local_import_redux'               => array(
				array(
					'file_path'    => Gtech_Theme_Helper::gtech_demo_file_path('json','json'),
					'option_name' => 'theme_options',
				),
			),
			'import_preview_image_url'   => Gtech_Theme_Helper::gtech_demo_prev_img_url('prv1','jpg'),
			'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'streamlab' ),
			'preview_url'                => 'streamlab.gentechtree.com/',
		),

		array(
			'import_file_name'           => 'Red Home',
			
			'local_import_file'            => Gtech_Theme_Helper::gtech_demo_file_path('red/xml','xml'),
			'local_import_widget_file'     => Gtech_Theme_Helper::gtech_demo_file_path('red/wie','wie'),
			'local_import_customizer_file' => Gtech_Theme_Helper::gtech_demo_file_path('red/dat','dat'),
			'local_import_redux'               => array(
				array(
					'file_path'    => Gtech_Theme_Helper::gtech_demo_file_path('red/json','json'),
					'option_name' => 'theme_options',
				),
			),
			'import_preview_image_url'   => Gtech_Theme_Helper::gtech_demo_prev_img_url('red/prv1','jpg'),
			'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'streamlab' ),
			'preview_url'                => 'streamlab.gentechtree.com/red-demo/',
		),
		
		
	);
}
add_filter( 'pt-ocdi/import_files', 'streamlab_ocdi_import_files' );

function streamlab_ocdi_after_import( $selected_import ) {
	// Assign menus to their locations.
     $locations = get_theme_mod( 'nav_menu_locations' ); // registered menu locations in theme
    $menus = wp_get_nav_menus(); // registered menus
	$arr = json_decode(json_encode($menus), true);

				
	        foreach($arr as $a) { // assign menus to theme locations
	        	if( $a['name'] == 'Primary Menu' ) {
	        		$locations['primary'] = $a['term_id'];
	        		
	        	}
	            
	        }
	  set_theme_mod( 'nav_menu_locations', $locations );
	    

	if ( 'Main Home' === $selected_import['import_file_name'] ) {

		
	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );
		
	}
	
	
	



    // remove default post
    wp_delete_post(1);
}
add_action( 'pt-ocdi/after_import', 'streamlab_ocdi_after_import' );

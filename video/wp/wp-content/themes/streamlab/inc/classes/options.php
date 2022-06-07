<?php 
namespace gentechtree\streamlab;
class Options {
	protected static $instance = null;
	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	private static $theme_options = array();
	public function __construct (){ 
		$this->set_options();
	}
	public function set_options()
	{
		self::$theme_options = get_option('theme_options'); 
	}
	public static function get_main_row_class($name)
	{
		
		if(class_exists('ReduxFramework'))
		{
			if(isset(self::$theme_options[$name.'_sidebar']))
			{
				if(self::$theme_options[$name.'_sidebar'] == 'right_sidebar')
			{
				echo esc_attr('row');
			}
			else if(self::$theme_options[$name.'_sidebar'] == 'left_sidebar')
			{
				echo esc_attr('row flex-row-reverse');
			}
			else
			{
				echo esc_attr('row');	
			}
			}
			else
			{
				echo esc_attr('row');	
			}
			
		}
		else
		{
			echo esc_attr('row');	
		}
		
	}
	public static function get_main_column_class($name)
	{	
		if(class_exists('ReduxFramework'))
		{
			if(isset(self::$theme_options[$name.'_sidebar']))
			{
				if(self::$theme_options[$name.'_sidebar'] == 'no_sidebar')
			{
			 	echo esc_attr('col-lg-12');
			}
			else if(self::$theme_options[$name.'_sidebar'] == 'right_sidebar' || self::$theme_options[$name.'_sidebar'] == 'left_sidebar')
			{
				echo esc_attr('col-lg-8 col-xl-9');
			}
			}
			else
			{
				echo esc_attr('col-lg-12');
			}
			
		}
		else
		{
			if(is_active_sidebar( 'sidebar-1' ))
			{
				echo esc_attr('col-lg-8 col-xl-9');
			}
			else
			{
				echo esc_attr('col-lg-12');
			}
		}
		
	}
	public static function get_main_column_number_class($name)
	{	
		
		if(class_exists('ReduxFramework'))
		{
			if(!empty(self::$theme_options[$name.'_layout']))
			{
				$layout= self::$theme_options[$name.'_layout'];
				
				if($layout == '5')
				{
					return esc_attr('col-xl-2 col-lg-4 col-md-6');
				}
				else if($layout == '4')
				{
					return esc_attr('col-xl-3 col-lg-4 col-md-6');
				}
				else if($layout == '3')
				{
					return esc_attr('col-xl-4 col-lg-4 col-md-6');
				}
				else if($layout == '2')
				{
					return esc_attr('col-xl-6 col-lg-6 col-md-6');
				}
				else if($layout == '1')
				{
					return esc_attr('col-xl-12 col-lg-12 col-md-12');
				}
				else
				{
					return esc_attr('col-xl-3 col-lg-4 col-md-6');
				}
			 
			}
			else 
			{
				return esc_attr('col-lg-12');
			}
		}
		else
		{
			
			return esc_attr('col-lg-12');
		}
		
	}
	public static function check_sidebar_active($name = '')
	{
		if(class_exists('ReduxFramework'))
		{
			if(self::$theme_options[$name.'_sidebar'] == 'right_sidebar' || self::$theme_options[$name.'_sidebar'] == 'left_sidebar')
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		return true;
	}
	public static function get_load_type($name)
	{
		if(isset($_REQUEST['load_type']))
		{
			return $_REQUEST['load_type'];
		}
		if(isset(self::$theme_options[$name.'_load_type']))
		{
			return self::$theme_options[$name.'_load_type'];
		}
		else
		{
			return 'pagination';
		}
	}
	public static function get_inner_row_class($name = '')
	{
		if(isset($_REQUEST['load_type']))
		{
			if($_REQUEST['load_type']  == 'loadmore')
			{
				return 'row post-loadmore-wrapper';
			}
			else if($_REQUEST['load_type']  == 'infscroll')
			{
				return 'row post-infscroll-wrapper';
			}
			else
			{
				return 'row';
			}
			
		}
		if(isset(self::$theme_options[$name.'_load_type']))
		{
			if(self::$theme_options[$name.'_load_type']  == 'loadmore')
			{
				return 'row post-loadmore-wrapper';
			}
			else if(self::$theme_options[$name.'_load_type']  == 'infscroll')
			{
				return 'row post-infscroll-wrapper';
			}
			else if(self::$theme_options[$name.'_load_type']  == 'pagination')
			{
				return 'row';
			}
			
		}
		else
		{
			return 'row';
		}
		
	}
	public static function get_load_type_value($name)
	{
		if(isset(self::$theme_options[$name.'_load_type']))
		{
			return self::$theme_options[$name.'_load_type'];
		}

	}
	public static function get_post_share($share_link)
	{
		$social = array();
		if(isset(self::$theme_options['social']))
		{
			$social = self::$theme_options['social'];
		}
		
		?>
				<ul class="menu bottomRight">
                    <li class="share top">
                      <i class="fa fa-share-alt"></i>
                      <ul class="submenu">
                      	<?php 
                      	foreach($social as $key=>$val)
                      	{
                      		if(!empty($val))
                      		{
                      	?>
                        <li><a href="<?php echo esc_attr( $val . $share_link );  ?>" class="facebook"><i class="fab <?php echo esc_attr($key); ?>"></i></a></li>
                       <?php } } ?>
                      </ul>
                    </li>
                  </ul>
		<?php 
	   
	}
	public static function get_sinle_post_share($share_link)
	{

		$social = array();
		if(isset(self::$theme_options['social']))
		{
			$social = self::$theme_options['social'];
		}
		?>
		<div class="gen-socail-share">
	   		<h4 class="align-self-center"><?php echo esc_html('Social Share :' , 'streamlab') ?></h4>
	   		<ul class="social-inner">
                <?php 
              	foreach($social as $key=>$val)
              	{

              		if(!empty($val))
              		{
              	?>
                <li><a target="_blank" href="<?php echo ($val.$share_link); ?>" class="facebook"><i class="fab <?php echo esc_attr($key); ?>"></i></a></li>
                <?php } } ?>
             </ul>
		</div>
		<?php 
	}

	public static function get_image_url( $name , $args = array() , $image_id = '')
	{
		$image_url = '';

		if(empty($image_id))
		{
			$image_id = get_the_ID();
		}
		

				
		if(isset($args['size_dimention']) && !empty($args['size_dimention']['width']))
		{
		   $image_size = $args['size_dimention'];
		   $image_url =  streamlab_resize( get_the_post_thumbnail_url(get_the_ID()), $args['size_dimention']['width'], $args['size_dimention']['height'], true );
		}
		else if( isset($args['size']) && !empty($args['size']) )
		{ 
			$image_url = get_the_post_thumbnail_url($image_id , $args['size'] );
		}
		else if(isset(self::$theme_options[$name.'_dimensions']))
		{
			$width = (int) filter_var(self::$theme_options[$name.'_dimensions']['width'], FILTER_SANITIZE_NUMBER_INT);
			$height = (int) filter_var(self::$theme_options[$name.'_dimensions']['height'], FILTER_SANITIZE_NUMBER_INT);
			if(!empty($width) && !empty($height))
			{

			   $image_url =  streamlab_resize( get_the_post_thumbnail_url($image_id), $width,$height, true );
			}
			else
			{
				$image_url = get_the_post_thumbnail_url($image_id);  
			}
		}
		else
		{
		    $image_url = get_the_post_thumbnail_url($image_id);  
		}
		return $image_url;
	}

	public static function get_box_style($name , $args = array() )
	{
		if(isset($_REQUEST['box-style']) && !empty($_REQUEST['box-style']))
		{
			return $_REQUEST['box-style'];
		}
		else if(isset(self::$theme_options[$name.'_box_style']))
		{
			return self::$theme_options[$name.'_box_style'];
		}
	}

	public static function get_single_load_title($name = '')
	{
		if(isset(self::$theme_options[$name.'_load_title']) && !empty(self::$theme_options[$name.'_load_title']))
		{
			echo esc_html(self::$theme_options[$name.'_load_title']);
		}
		else
		{
			echo esc_html__('More Like This' , 'streamlab');
		}
	}

	public static function get_single_load_filter( $name , $args)
	{
		$tax_query = array();
   		$taxargs = array();
   		$op_name = 'single_'.$name;

		if(isset(self::$theme_options[$op_name.'_load_filter']) && !empty(self::$theme_options[$op_name.'_load_filter']))
		{
			if($op_name == 'single_movie' && self::$theme_options[$op_name.'_load_filter'] == 'recommanded')
			{
				$args['post__in'] = get_post_meta(get_the_ID(), '_recommended_movie_ids', true );

				return $args;
			}

			if( self::$theme_options[$op_name.'_load_filter'] == 'related')
			{
				if($name == 'video')
				{
					$genre = 'video_cat';
				}
				else
				{
					$genre = $name.'_genre';
				}
			  $tax_query['taxonomy'] = $genre;

		       $tax_query['field'] = 'term_id';

		       $tax_query['terms'] = wp_get_post_terms(get_the_ID(), $genre , array( 'fields' => 'ids' ));

		       $tax_query['operator'] = 'IN';

		       array_push($taxargs, $tax_query);

		       if(!empty($tax_query))

	   			{

			       $args['tax_query'] = $taxargs;
	   			}
			}


		}

		return $args;
	}

	public static function get_user_actions($post_name = '')
	{


		
		
		if( isset(self::$theme_options['enable_like_button']) && self::$theme_options['enable_like_button'] == 'yes')
		{
			?>

			<div class="wpulike wpulike-heart ">
				<div class="wp_ulike_general_class">
					<?php echo do_shortcode( '[streamlab-core-like-button]' );  ?>
				</div>
			</div>
			<?php
			//echo do_shortcode('[wp_ulike  id="'.esc_attr(get_the_ID()).'" style="wpulike-heart"]');
		}
		if( isset(self::$theme_options['enable_share_button']) && self::$theme_options['enable_share_button'] == 'yes')
		{
			Options::get_post_share(get_the_permalink());
		}
		if( isset(self::$theme_options['enable_playlist_button']) && self::$theme_options['enable_playlist_button'] == 'yes')
		{
			if($post_name == 'movie')
			{
				masvideos_template_button_movie_playlist();
			}

			if($post_name == 'tv_show')
			{
				masvideos_template_button_tv_show_playlist();
			}

			if($post_name == 'video')
			{
				masvideos_template_button_video_playlist();
			}
			
		}
	}

	public static function get_pms_menu()
	{
		if( isset(self::$theme_options['enable_user_menu']) && self::$theme_options['enable_user_menu'] == 'yes')
		{
			$acc_url = '';
     	  	$login_url = '';
     	  	$register_url = '';
     	  	if(!empty(self::$theme_options['my_account_url']))
     	  	{
     	  		$acc_url = self::$theme_options['my_account_url'];
     	  	}
     	  	if(!empty(self::$theme_options['login_url']))
     	  	{
     	  		$login_url = self::$theme_options['login_url'];
     	  	}
     	  	if(!empty(self::$theme_options['register_url']))
     	  	{
     	  		$register_url = self::$theme_options['register_url'];
     	  	}

			if(!is_user_logged_in())
			{ 
			?>
				<li>
					<a href="<?php echo esc_url($login_url); ?>"><i class="fa fa-sign-in"></i>
						<?php echo esc_html__('login' , 'streamlab'); ?>
					</a>
				</li>
				<li>
					<a href="<?php echo esc_url($register_url); ?>"><i class="fa fa-user"></i>
						<?php echo esc_html__('Register' , 'streamlab'); ?>
					</a>
				</li>
			<?php } 
			else
			{
			?>

			<li>
				<a href="<?php echo esc_url($acc_url); ?>"><i class="fas fa-user-cog"></i>
					<?php echo esc_html__('My Account' , 'streamlab'); ?>
				</a>
			</li>
			<?php }
		}
	}

	public static function get_library_menu()
	{
		if( isset(self::$theme_options['enable_user_library']) && self::$theme_options['enable_user_library'] == 'yes')
		{
			?>
			<li>
				<a href="<?php echo esc_url( masvideos_get_page_permalink( 'myaccount' ) ); ?>">
					<i class="fa fa-indent"></i>
					<?php echo esc_html__('Library' , 'streamlab'); ?>
				</a>
			</li>

			<li>
				<a href="<?php echo esc_url( masvideos_get_endpoint_url( 'movie-playlists', '', masvideos_get_page_permalink( 'myaccount' ) )); ?>"><i class="fa fa-list"></i>
					<?php echo esc_html__('Movie Playlist' , 'streamlab'); ?>
				</a>
			</li>

			<li>
				<a href="<?php echo esc_url( masvideos_get_endpoint_url( 'tv-show-playlists', '', masvideos_get_page_permalink( 'myaccount' ) )); ?>"><i class="fa fa-list"></i>
				<?php echo esc_html__('Tv Show Playlist' , 'streamlab'); ?>
				</a>
			</li>

			<li>
				<a href="<?php echo esc_url( masvideos_get_endpoint_url( 'video-playlists', '', masvideos_get_page_permalink( 'myaccount' ) )); ?>"><i class="fa fa-list"></i>
					<?php echo esc_html__('Video Playlist' , 'streamlab'); ?>
				</a>
			</li>

			
		<?php }
		if( isset(self::$theme_options['enable_upload_video']) && self::$theme_options['enable_upload_video'] == 'yes')
		{
			?>
			<li>
				<a href="<?php echo esc_url( masvideos_get_page_permalink( 'upload_video' ) ); ?>">		<i class="fa fa-upload"></i>
					<?php echo esc_html__('Upload Video' , 'streamlab'); ?>
				</a>
			</li>
		<?php }
	}

	public static function get_header_user_menus()
	{
		if( isset(self::$theme_options['enable_user_menu']) && self::$theme_options['enable_user_menu'] == 'yes')
		{
			?>
			<div class="gen-account-holder">
						<a href="javascript:void(0)" id="gen-user-btn"><i class="fa fa-user"></i></a>
						<div class="gen-account-menu">
							<ul class="gen-account-menu">
								<!-- Pms Menu -->
								<?php self::get_pms_menu(); ?>

								<!-- Library Menu -->
								 <?php self::get_library_menu(); ?>
							
							</ul>
							
							
						</div>
					</div>
			<?php 

		}
	}

	public static function get_videos_titles($post)
	{
		if(isset(self::$theme_options[$post.'_title']) && !empty(self::$theme_options[$post.'_title']))
		{
			return self::$theme_options[$post.'_title'];
		}
	}
}
new Options;

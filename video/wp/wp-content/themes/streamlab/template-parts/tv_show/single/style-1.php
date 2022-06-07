<?php
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options;
$current_post = get_post_type();
Helper::update_post_views(get_the_ID());

$seasons = get_post_meta( get_the_ID() , '_seasons' );
$episodes = get_post_meta( get_the_ID() , '_episodes' );
$count_episodes = 0;
$count_seasons = 0;
$sea_string = '';
$epi_string = '';
$year_string = '';
if(is_array($seasons[0]))
{
foreach ($seasons[0] as $key => $season) {
  
  foreach ($season as $k => $sea) {
  
   if($k == 'episodes')
   {
     $count_episodes +=  count($season['episodes']);
   }
   if($k == 'year')
   {
     if(empty($year_string))
     {
      $year_string .= $season['year']; 
     }
     
   }
  }
  $count_seasons++;
}
}
if(isset($count_seasons))
{
  if($count_seasons != 1)
  {
    $sea_string = $count_seasons . esc_html__(' Seasons', 'streamlab');  
  }
  else
  {
    $sea_string = $count_seasons . esc_html__(' Season', 'streamlab');  
  }
}
if(isset($count_episodes))
{
  if($count_episodes != 1)
  {
    $epi_string = $count_episodes . esc_html__(' Episodes', 'streamlab');  
  }
  else
  {
    $epi_string = $count_episodes . esc_html__(' Episode', 'streamlab');  
  }
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="tv-show-back-data" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>"></div>
	<div class="gen-tv-show-wrapper style-1">
		<div class="gen-tv-show-top">
			<div class="row">
				<div class="col-lg-6">
					<div class="gentech-tv-show-img-holder">
						<?php the_post_thumbnail(); ?>
					</div>
				</div>
				<div class="col-lg-6 align-self-center">
					<div class="gen-single-tv-show-info">
						<h2 class="gen-title"><?php the_title(); ?></h2>
						<div class="gen-single-meta-holder">
	                <ul>
	                  <li><?php echo esc_html($sea_string); ?></li>
	                  <li><?php echo esc_html($epi_string); ?></li>
	                  <li><?php echo esc_html($year_string); ?></li>
	                
	                 
	                  
	                  <li>
	                    <?php 
	                    $wp_object = wp_get_post_terms(get_the_ID(), 'tv_show_genre');
	                    if ( ! empty( $wp_object ) ) {
	                      foreach ( $wp_object as $val ) {
	                        ?>
	                        <a href="<?php echo esc_url(get_category_link( $val->term_id )); ?>"><?php ?><span><?php  echo esc_html($val->name);  ?></span></a>
	                        <?php 
	                       
	                        break;
	                      }
	                    }
	                    ?>
	                    
	                  </li>
	                  <li>
							<i class="fas fa-eye">
								
							</i>
							<span><?php  Helper::get_post_view_count(get_the_ID()); ?></span>
						</li>
	                </ul>
	                
	              </div>
					   <div class="gen-excerpt">
							<?php the_excerpt(); ?>
						</div>
				   
					  <?php Options::get_sinle_post_share(get_the_permalink()); ?>
					   
					</div>
				</div>
				
			</div>
		</div>
		
		
		
		<div class="gen-season-holder">
			<ul class="nav">
				<?php
				foreach($seasons[0] as $key => $value)
				{
					
						
					if($key == 0)
					{
						$class = 'show active';
					}
					else
					{
						$class = '';
					}
				?>
				<li class="nav-item">
					<a class="nav-link <?php echo esc_attr($class); ?>" data-toggle="tab" href="#season_<?php echo esc_attr($key); ?>"><?php echo esc_html($value['name']); ?></a>
				</li>
			  <?php }  ?>
			</ul>
			<div class="tab-content">
				<?php 
				foreach($seasons[0] as $key => $value)
				{
					
					if($key == 0)
					{
						$aclass = 'active show';
					}
					else
					{
						$aclass = '';
					}
						$epi_args = array(
					       'post_type'         => 'episode',
					       'post_status'       => 'publish',
					      
					      
   							);
						 $epi_args['post__in'] = $value['episodes'];
						$epi_query = new \WP_Query($epi_args);
						
					?>
				<div id="season_<?php echo esc_attr($key); ?>" class="tab-pane <?php echo esc_attr($aclass); ?>">
					 <div class="owl-carousel" data-dots="false" data-nav="true" data-desk_num="4" data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1" data-autoplay="false" data-loop="false" data-margin="30" data-rewing="false">
					<?php if ($epi_query -> have_posts() ) 
					{
						while ($epi_query -> have_posts() ) 
						{
							$epi_query->the_post();
							
							   ?>
							  
							   	<div class="item">
							   		<div class="gen-episode-contain">
							   			<div class="gen-episode-img">
							   				<img src="<?php echo esc_url(Options::get_image_url('episode', $args , get_the_ID())); ?>">
							   				 <div class="gen-movie-action">
							                  <a href="<?php the_permalink(); ?>" class="gen-button">
							                    <i class="fa fa-play"></i>
							                  </a>
               							 </div>
							   			</div>
							   			<div class="gen-info-contain">
							   			<div class="gen-episode-info">
							   				
						   					
						   					<h3>
						   						<?php 
						   					echo get_post_meta(get_the_ID(),'_episode_number' , true);
						   					?>
						   					<span>-</span>
						   					<a href="<?php the_permalink(); ?>">
							   					
							   					<?php  
							   				the_title();
							   			?>
							   		
							   				</a>
						   					</h3>
							   				
							   			</div>
							   			<div class="gen-single-meta-holder">
							   				<ul>
						
											<li class="run-time"><?php echo get_post_meta(get_the_ID() , '_episode_run_time' , true); ?></li>
												<li class="release-date">
													<?php 
													if(get_post_meta(get_the_ID() , '_episode_release_date' , true))
													{
														echo gmdate("M d Y",get_post_meta(get_the_ID() , '_episode_release_date' , true));    
													}
													?>
												</li>
					
											</ul>
							   			</div>
							   		</div>
							   		</div>
							   
							</div>
							
							   <?php
							}
							wp_reset_query();
						} ?>
					</div>
				</div>
			<?php  } ?>
			</div>
		</div>
	     
	     <div class="row">
	     	<div class="col-lg-12">
	     		<div class="pm-inner">
	     			<div class="gen-more-like">
	     				<h5 class="gen-more-title"><?php Options::get_single_load_title('single_tv_show'); ?></h5>
	     				<div class="<?php echo esc_attr( Options::get_inner_row_class( 'single_tv_show'  ) ); ?>">
					<?php 

					$box_style = Options::get_box_style('tv_show');
					
					if(!empty($args))
					{
						$box_style = $args['box_style'];
					}
				
			      $args = array(
				       'post_type'         => 'tv_show',
				       'post_status'       => 'publish', 
				      
			   		);
			     	$args = Options::get_single_load_filter('tv_show', $args);
        $wp_query = new \WP_Query($args); 
	   $nonce =  wp_create_nonce( 'loadmore_nonce' );
	echo '<div class="post-loadmore-data" data-box_style="'.esc_attr($box_style).'" data-query="'.esc_attr( json_encode( $wp_query->query_vars ) ).'" data-paged="'.esc_attr( $paged ).'" data-max="'.esc_attr( $wp_query->max_num_pages ).'" data-nonce="'.esc_attr( $nonce ).'" data-post_type="tv_show"></div>';
					if ($wp_query -> have_posts() ) 
					{
						while ($wp_query -> have_posts() ) 
						{
							$wp_query->the_post();
							?>
							<div class="<?php echo esc_attr( Options::get_main_column_number_class( 'tv_show' )  ) ?>">
								<?php
								get_template_part( "template-parts/tv_show/content", "style-{$box_style}" ); 
								?>
							</div>
							<?php 
						}
						wp_reset_query();
					}
					?>
					   
				</div>
				<div class="row">
						<?php 
						Gentech_Load_More::instance()->init( Options::get_load_type('single_tv_show') );
						?>
                        
                     </div>
				
	     			</div>
	     			
	     		</div>
	     	</div>
	     </div>
	
	</div>
</article>
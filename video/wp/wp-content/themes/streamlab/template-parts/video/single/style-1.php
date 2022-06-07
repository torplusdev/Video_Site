<?php 
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options;
$current_post = get_post_type();
Helper::update_post_views(get_the_ID());
global $video;
?>
<article <?php post_class(); ?>>
	<div class="row">
		<div class="col-lg-12">
			<div class="gen-video-holder">
				<?php masvideos_the_video(); ?>
			</div>
			
		</div>
		<div class="col-lg-12">
			<div class="gen-single-video-info">
				<h2 class="gen-title"><?php the_title(); ?></h2>
				<div class="gen-single-meta-holder">
                <ul>
                  <li><?php echo human_time_diff( strtotime( get_the_date() ), current_time( 'timestamp', 1 ) ); ?></li>
                  
                  <li>
                    <?php 
                    $wp_object = wp_get_post_terms(get_the_ID(), 'video_cat');
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
		<div class="col-lg-12">
			<div class="pm-inner">
				<div class="gen-more-like">
					<h5 class="gen-more-title"><?php Options::get_single_load_title('single_video'); ?></h5>
					<div class="<?php echo esc_attr( Options::get_inner_row_class( 'single_video'  ) ); ?>">
					<?php 

					$box_style = Options::get_box_style('movie');

					if(!empty($args))
					{
						$box_style = $args['box_style'];
					}
				
		      $args = array(
			       'post_type'         => 'video',
			       'post_status'       => 'publish', 
			      
		   		);

		      $args = Options::get_single_load_filter('video', $args);
        $wp_query = new \WP_Query($args); 
	$nonce =  wp_create_nonce( 'loadmore_nonce' );
	echo '<div class="post-loadmore-data" data-box_style="'.esc_attr($box_style).'" data-query="'.esc_attr( json_encode( $wp_query->query_vars ) ).'" data-paged="'.esc_attr( $paged ).'" data-max="'.esc_attr( $wp_query->max_num_pages ).'" data-nonce="'.esc_attr( $nonce ).'" data-post_type="video"></div>';
					if ($wp_query -> have_posts() ) 
					{
						while ($wp_query -> have_posts() ) 
						{
							$wp_query->the_post();
							?>
							<div class="<?php echo esc_attr( Options::get_main_column_number_class( 'video' )  ) ?>">
								<?php
								get_template_part( "template-parts/video/content", "style-{$box_style}" ); 
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
						Gentech_Load_More::instance()->init( Options::get_load_type('single_video') );
						?>
                        
                     </div>
				</div>
				
			</div>
			
			
		</div>
	 </div>
</article>

<?php 
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options;
$current_post = get_post_type();
Helper::update_post_views(get_the_ID());
global $movie;

$lang = '';
$subtitles = '';
$audio_languages = '';

if(function_exists('get_field'))
{
	if(!empty(get_field('field_5d6d5')))
	{
		$lang = get_field('field_5d6d5');
	}
	if(!empty(get_field('field_5d6d554')))
	{
		$subtitles = get_field('field_5d6d554');
	}
	if(!empty(get_field('field_5d644d554')))
	{
		$audio_languages = get_field('field_5d644d554');
	}
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="gen-single-movie-wrapper style-1">
		<div class="row">
			<div class="col-lg-12">
				<div class="gen-video-holder">
					<?php masvideos_the_movie(); ?>
				</div>
				<div class="gen-single-movie-info">
					<h2 class="gen-title"><?php the_title(); ?></h2>
					<div class="gen-single-meta-holder">
					<ul>
						<li class="gen-sen-rating"><?php echo get_post_meta(get_the_ID() , '_movie_censor_rating' , true); ?></li>
						
						
						
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
				   
				   <div class="gen-after-excerpt">
				   		 <div class="gen-extra-data">
				   		<ul>
				   			<?php 
				   			if(!empty($lang))
				   			{
				   			?>
				   			<li>
				   				<span><?php echo esc_html__('Language :' , 'streamlab') ?></span> 
				   				<span><?php echo esc_html($lang); ?></span>
				   			</li>
				   		   <?php } ?>

				   		   <?php 
				   			if(!empty($subtitles))
				   			{
				   			?>
				   			<li>
				   				<span><?php echo esc_html__('Subtitles :' , 'streamlab') ?></span> 
				   				<span><?php echo esc_html($subtitles); ?></span>
				   			</li>
				   		   <?php } ?>

				   		    <?php 
				   			if(!empty($audio_languages))
				   			{
				   			?>
				   			<li>
				   				<span><?php echo esc_html__('Audio Languages :' , 'streamlab') ?></span> 
				   				<span><?php echo esc_html($audio_languages); ?></span>
				   			</li>
				   		   <?php } ?>
				   			
				   			
				   			<li><span>Genre :</span>
				   				<?php 
							$wp_object = wp_get_post_terms(get_the_ID(), 'movie_genre');
							$numItems = count($wp_object);
							$i = 0;

							if ( ! empty( $wp_object ) ) {
								foreach ( $wp_object as $val ) {
									?>
									<span>
										<a href="<?php echo esc_url(get_category_link( $val->term_id )); ?>">
									<?php 
									if(++$i === $numItems)
									{

									    echo esc_html($val->name); 
									}
									else
									{
										echo esc_html($val->name . ","); 	
									}

									?>
								     </a>
									</span>
									<?php 
								}
							}
							?>
				   			</li>
				   			<li><span>Run Time :</span>
				   				<span><?php echo get_post_meta(get_the_ID() , '_movie_run_time' , true); ?></span>
				   				
				   			</li>

				   			

				   			<li>
				   				<span>Release Date :</span>
				   				<span><?php echo gmdate("d M,Y",get_post_meta(get_the_ID() , '_movie_release_date' , true));  ?></span>
				   			</li>
				   		</ul>
				   </div>
				   <?php Options::get_sinle_post_share(get_the_permalink()); ?>
				   </div>
				  
				   
				</div>
			</div>
			
		
			<div class="col-lg-12">
				<div class="pm-inner">
					<div class="gen-more-like">
					<h5 class="gen-more-title"><?php Options::get_single_load_title('single_movie'); ?></h5>
					<div class="<?php echo esc_attr( Options::get_inner_row_class( 'single_movie'  ) ); ?>">
					<?php 

					$recommended_movie_ids = get_post_meta(get_the_ID(), '_recommended_movie_ids', true );

					$box_style = Options::get_box_style('movie');

					if(!empty($args))
					{
						$box_style = $args['box_style'];
					}

					$args = array(
					       'post_type'         => 'movie',
					       'post_status'       => 'publish', 
					  );
					$args = Options::get_single_load_filter('movie', $args);
					
					$wp_query = new \WP_Query($args);
					if ($wp_query -> have_posts() ) 
					{
						$wp_query = new \WP_Query($args); 
						$nonce =  wp_create_nonce( 'loadmore_nonce' );
						$box_style = Options::get_box_style(get_post_type());
						echo '<div class="post-loadmore-data" data-query="'.esc_attr( json_encode( $wp_query->query_vars ) ).'" data-paged="'.esc_attr( $paged ).'" data-box_style="'.esc_attr($box_style).'" data-max="'.esc_attr( $wp_query->max_num_pages ).'" data-nonce="'.esc_attr( $nonce ).'" data-post_type="movie"></div>';
						while ($wp_query -> have_posts() ) 
						{
							$wp_query->the_post();
							?>
							<div class="<?php echo esc_attr( Options::get_main_column_number_class( $current_post) ) ?>">
								<?php
								   get_template_part( "template-parts/movie/content", "style-{$box_style}" ); 
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
						Gentech_Load_More::instance()->init( Options::get_load_type('single_movie') );
						?>
                        
                     </div>
				</div>
				</div>
				
			</div>
			
				
		</div>
	</div>
</article>
<?php 
?>

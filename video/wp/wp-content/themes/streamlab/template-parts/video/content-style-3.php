<?php
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options;
global $video;

?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="gen-carousel-movies-style-3 movie-grid style-3">
       <div class="gen-movie-contain">
              <div class="gen-movie-img">
                <img src="<?php echo esc_url(Options::get_image_url('video' , $args)); ?>">
                <div class="gen-movie-add">
                  
                  <?php 
                   Options::get_user_actions( 'video' );
                 ?>
                 
                </div>
                <div class="gen-movie-action">
                  <a href="<?php the_permalink(); ?>" class="gen-button">
                    <i class="fa fa-play"></i>
                  </a>
                </div>
                
              </div>
              <div class="gen-info-contain">
              <div class="gen-movie-info">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                
                 
              </div>
              <div class="gen-movie-meta-holder">
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
                </ul>
                
              </div>
            </div>
              
            </div>
    </div>
   
  </article><!-- #post-## -->

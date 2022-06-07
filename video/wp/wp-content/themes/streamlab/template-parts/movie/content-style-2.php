<?php
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options;
global $movie;
?>
  <article  <?php post_class(); ?>>
    <div class="gen-carousel-movies-style-2 movie-grid style-2">
       <div class="gen-movie-contain">
              <div class="gen-movie-img">
               <img src="<?php echo esc_url(Options::get_image_url('movie' , $args)); ?>">
                <div class="gen-movie-add">
                  
                  <?php 
                     Options::get_user_actions( 'movie' );
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
                
                  <li><?php echo get_post_meta(get_the_ID() , '_movie_run_time' , true); ?></li>
                  
                 
                  
                  <li>
                    <?php 
                    $wp_object = wp_get_post_terms(get_the_ID(), 'movie_genre');
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

<?php
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options;
global $tv_shows;
$seasons = get_post_meta( get_the_ID() , '_seasons' );
// print_r($seasons);
// die;
$episodes = get_post_meta( get_the_ID() , '_episodes' );
$count_episodes = 0;
$count_seasons = 0;
$sea_string = '';
$epi_string = '';
$year_string = '';
if(isset($seasons[0]) && is_array($seasons[0]))
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
  <article  <?php post_class(); ?>>
    <div class="gen-carousel-movies-style-3 movie-grid style-3">
       <div class="gen-movie-contain">
              <div class="gen-movie-img">
                <img src="<?php echo esc_url(Options::get_image_url('tv_show' , $args)); ?>">
                <div class="gen-movie-add">
                  
                  <?php 
                    Options::get_user_actions( 'tv_show' );
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
                  <li><?php echo esc_html($sea_string); ?></li>
                  
                  <?php
                  if(!empty($year_string))
                  { 
                  ?>
                 
                <?php } ?>
                  
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
                </ul>
                
              </div>
            </div>
              
            </div>
    </div>
   
  </article><!-- #post-## -->

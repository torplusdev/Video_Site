<?php 
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options; 
global  $movie_playlist;

$playlists = get_post_meta(get_the_ID() , '_movie_ids' , true);
$box_style = Options::get_box_style('movie');

$wp_query = new WP_Query( 
	array( 
		'post_type' => 'movie', 
		'post__in' => $playlists,
		 'posts_per_page' => 10
		 ) 
);

$resereve_query = $wp_query;
$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
$nonce =  wp_create_nonce( 'loadmore_nonce' );
		
echo '<div class="post-loadmore-data" data-query="'.esc_attr( json_encode( $wp_query->query_vars ) ).'" data-box_style="'.esc_attr($box_style).'" data-paged="'.esc_attr( $paged ).'" data-max="'.esc_attr( $wp_query->max_num_pages ).'" data-nonce="'.esc_attr( $nonce ).'" data-post_type="movie"></div>';
echo '<div class="'.esc_attr( Options::get_inner_row_class( 'movie_playlist'  ) ).'">';
if ($wp_query -> have_posts() ) 
{

	while ($wp_query -> have_posts() ) 
	{

		$wp_query->the_post();
		?>
		<div class="<?php echo esc_attr( Options::get_main_column_number_class( 'movie' ) ) ?>">
			<?php
			 get_template_part( 'template-parts/movie/movie', 'block'); 
			?>
		</div>
		<?php


	}
	wp_reset_query();
}
echo '</div>';
?>

<div class="row">
 	<?php Gentech_Load_More::print_playlist_loadmore_type( Options::get_load_type_value('movie_playlist') , $resereve_query  ); ?>      
 </div>

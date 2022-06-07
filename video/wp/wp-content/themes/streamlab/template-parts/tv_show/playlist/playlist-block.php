<?php 
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options; 
global  $tv_show_playlist;

$playlists = get_post_meta(get_the_ID() , '_tv_show_ids' , true);
$box_style = Options::get_box_style('tv_show');

$wp_query = new WP_Query( 
	array( 
		'post_type' => 'tv_show', 
		'post__in' => $playlists,
		 'posts_per_page' => 4
		 ) 
);

$resereve_query = $wp_query;
$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
$nonce =  wp_create_nonce( 'loadmore_nonce' );
		
echo '<div class="post-loadmore-data" data-query="'.esc_attr( json_encode( $wp_query->query_vars ) ).'" data-box_style="'.esc_attr($box_style).'" data-paged="'.esc_attr( $paged ).'" data-max="'.esc_attr( $wp_query->max_num_pages ).'" data-nonce="'.esc_attr( $nonce ).'" data-post_type="tv_show"></div>';
echo '<div class="'.esc_attr( Options::get_inner_row_class( 'tv_show_playlist'  ) ).'">';
if ($wp_query -> have_posts() ) 
{

	while ($wp_query -> have_posts() ) 
	{

		$wp_query->the_post();
		?>
		<div class="<?php echo esc_attr( Options::get_main_column_number_class( 'tv_show' ) ) ?>">
			<?php
			 get_template_part( 'template-parts/tv_show/tv_show', 'block'); 
			?>
		</div>
		<?php


	}
	wp_reset_query();
}
echo '</div>';
?>

<div class="row">
 	<?php Gentech_Load_More::print_playlist_loadmore_type( Options::get_load_type_value('tv_show_playlist') , $resereve_query  ); ?>      
 </div>

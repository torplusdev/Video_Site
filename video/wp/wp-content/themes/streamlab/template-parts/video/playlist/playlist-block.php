<?php 
global  $movie_playlist;
$playlists = get_post_meta(get_the_ID() , '_video_ids' , true);
$wp_query = new WP_Query( 
	array( 
		'post_type' => 'video', 
		'post__in' => $playlists ) 
);
echo '<div class="row">';
if ($wp_query -> have_posts() ) 
{
	while ($wp_query -> have_posts() ) 
	{
		$wp_query->the_post();
		?>
		<div class="col-lg-3">
			<?php
			 get_template_part( 'template-parts/video/video', 'block'); 
			?>
		</div>
		<?php
	}
	wp_reset_query();
}
echo '</div>';
?>

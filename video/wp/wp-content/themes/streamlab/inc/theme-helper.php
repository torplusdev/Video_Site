<?php 
namespace gentechtree\streamlab;
use gentechtree\streamlab\Options;
class Helper
{
	protected static $instance = null;
	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	public function __construct (){ }
	public static function display_header() {
		$streamlab_option = get_option('streamlab_options');
		?>
		<div class="gen-breadcrumb">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-12">
						<nav aria-label="breadcrumb">
							<div class="gen-breadcrumb-title">
								<h1>
									<?php self::page_title(); ?>
								</h1>
							</div>			               
							<div class="gen-breadcrumb-container">				               	
								<ol class="breadcrumb">
									<?php self::breadcrumbs(); ?>
								</ol>				               	
							</div>			               
						</nav>
					</div>
					
				</div>
			</div>
		</div>
		<?php 
	}
	public static function page_title() {
		if (is_home()) {
			if (get_option('page_for_posts', true)) {
				echo get_the_title(get_option('page_for_posts', true));
			} 
			else {
				_e('Home', 'streamlab');
			}
		} 
		elseif (is_archive()) {
			$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			if ($term) {
				echo esc_html($term->name);
			} 
			elseif (is_post_type_archive()) {
				$videos_post_name = Options::get_videos_titles( get_post_type() );
				if(!empty($videos_post_name))
				{
					echo $videos_post_name;
				}
				else
				{
					echo get_queried_object()->labels->name;	
				}
				
			} 
			elseif (is_day()) {
				printf(__('Daily Archives: %s', 'streamlab'), get_the_date());
			} 
			elseif (is_month()) {
				printf(__('Monthly Archives: %s', 'streamlab'), get_the_date('F Y'));
			} 
			elseif (is_year()) {
				printf(__('Yearly Archives: %s', 'streamlab'), get_the_date('Y'));
			} 
			elseif (is_author()) {
				$author = get_queried_object();
				printf(__('Author Archives: %s', 'streamlab'), $author->display_name);
			} 
			else {
				single_cat_title();
			}
		} 
		elseif (is_search()) {
			printf(__('Search Results for %s', 'streamlab'), get_search_query());
		} 
		elseif (is_404()) {
			_e('Page Not Found', 'streamlab');
		} 
		else {
			the_title();
		}
	}
	public static function breadcrumbs() {
		$showOnHome = 0; 
		$home = ''.esc_html__('Home', 'streamlab').''; 
		$showCurrent = 1; 

		global $post;
		$homeLink = esc_html(home_url());

		if (is_front_page()) {

			if ($showOnHome == 1) echo '<li class="breadcrumb-item"><a href="' . $homeLink . '"><i class="fas fa-home mr-2"></i>' . $home . '</a></li>';

		} else {

			echo '<li class="breadcrumb-item"><a href="' . $homeLink . '"><i class="fas fa-home mr-2"></i>' . $home . '</a></li> ';

			if( is_home()){
				echo  '<li class="breadcrumb-item active">'.esc_html__('Blogs', 'streamlab').'</li>';
			}elseif ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) echo '<li class="breadcrumb-item">'.get_category_parents($thisCat->parent, TRUE, '  ').'</li>';
				echo  '<li class="breadcrumb-item active">'.esc_html__('Archive by category : ', 'streamlab').' "' . single_cat_title('', false) . '" </li>';

			} elseif ( is_search() ) {
				echo  '<li class="breadcrumb-item active">'.esc_html__('Search results for : ', 'streamlab').' "' . get_search_query() . '"</li>';

			} elseif ( is_day() ) {
				echo '<li class="breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ';
				echo '<li class="breadcrumb-item"><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li>  ';
				echo  '<li class="breadcrumb-item active">'.get_the_time('d').'</li>';

			} elseif ( is_month() ) {
				echo '<li class="breadcrumb-item"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ';
				echo  '<li class="breadcrumb-item active">'.get_the_time('F').'</li>';

			} elseif ( is_year() ) {
				echo  '<li class="breadcrumb-item active">'.get_the_time('Y').'</li>';

			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo '<li class="breadcrumb-item"><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
					if ($showCurrent == 1) echo '<li class="breadcrumb-item active">'. get_the_title().'</li>';
				} else {
					$cat = get_the_category(); 
					if(isset($cat[0]))
					{
						$cat = $cat[0];	
						if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s\s$#", "$1", $cats);
						echo '<li class="breadcrumb-item">'.get_category_parents($cat, TRUE, '  ').'</li>';
					}
					if ($showCurrent == 1) echo  '<li class="breadcrumb-item active">'.get_the_title().'</li>';
				}

			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());

				$videos_post_name = Options::get_videos_titles( get_post_type() );

				if(!empty($videos_post_name))
				{
					
					echo  '<li class="breadcrumb-item active">'.$videos_post_name.'</li>';	
				}

				else if(!empty($post_type))
				{
					echo  '<li class="breadcrumb-item active">'.$post_type->labels->singular_name.'</li>';	
				}
				

			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				echo '<li class="breadcrumb-item">'.get_category_parents($cat, TRUE, '  ').'</li>';
				echo '<li class="breadcrumb-item"><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
				if ($showCurrent == 1) echo '<li class="breadcrumb-item active"> ' .  get_the_title().'</li>';

			} elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) echo  '<li class="breadcrumb-item active">'.get_the_title().'</li>';

			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);

				if ($showCurrent == 1) echo '<li class="breadcrumb-item active"> ' .  get_the_title().'</li>';

			} elseif ( is_tag() ) {
				echo  '<li class="breadcrumb-item active">'.esc_html__('Posts tagged', 'streamlab').' "' . single_tag_title('', false) . '"</li>';

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo  '<li class="breadcrumb-item active">'.esc_html__('Articles posted by : ', 'streamlab').' ' . $userdata->display_name.'</li>';

			} elseif ( is_404() ) {
				echo  '<li class="breadcrumb-item active">'.esc_html__('Error 404', 'streamlab').'</li>';
			}

			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo '<li class="breadcrumb-item">'. esc_html__('Page','streamlab') . ' ' . get_query_var('paged').'</li>';
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			}    
		}
	}
	public static function get_svg( $args = array() ) {

		if ( empty( $args ) ) {
			return esc_html__( 'Please define default parameters in the form of an array.', 'streamlab' );
		}
		if ( false === array_key_exists( 'icon', $args ) ) {
			return esc_html__( 'Please define an SVG icon filename.', 'streamlab' );
		}
		
		$defaults = array(
			'icon'        => '',
			'title'       => '',
			'desc'        => '',
			'fallback'    => false,
		);
		
		$args = wp_parse_args( $args, $defaults );
		$aria_hidden = ' aria-hidden="true"';
		
		$aria_labelledby = '';
		
		if ( $args['title'] ) {
			$aria_hidden     = '';
			$unique_id       = uniqid();
			$aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';
			if ( $args['desc'] ) {
				$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
			}
		}
	}
	public static function pagination($numpages = '', $pagerange = '', $paged=''){
		global $paged;
		if (empty($pagerange)) {
			$pagerange = 2;
		}

		if (empty($paged)) {
			$paged = 1;
		}
		if ($numpages == '') {
			global $wp_query;
			$numpages = $wp_query->max_num_pages;
			if(!$numpages) {
				$numpages = 1;
			}
		}


		$pagination_args = array(
		//'base'            => get_pagenum_link(1) . '%_%',
			'format'		  => '?paged=%#%',
			'total'           => $numpages,
			'current'         => $paged,
			'show_all'        => False,
			'end_size'        => 1,
			'mid_size'        => $pagerange,
			'prev_next'       => True,
			'prev_text'       =>  esc_html__( 'Previous page', 'streamlab' ),
			'next_text'       => esc_html__( 'Next page', 'streamlab' ),
			'type'            => 'list',
			'add_args'        => false,
			'add_fragment'    => ''
		);
		
		$paginate_links = paginate_links($pagination_args);
		if ($paginate_links) {

			echo '<div class="col-lg-12 col-md-12">
			<div class="gen-pagination">				
				<nav aria-label="Page navigation">';
				printf( esc_html__('%s','streamlab'),$paginate_links);
				echo '</nav>
			</div>
			</div>';


		}
	}
	
	public static function comments( $comment, $args, $depth ){
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			if ( 'div' == $args['style'] ) {
				$tag = 'div';
				$add_below = 'comment';
			} else {
				$tag = 'li';
				$add_below = 'div-comment';
			}
			?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php esc_html__( 'Pingback:', 'streamlab' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( '(Edit)', 'streamlab' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
				default :
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
						<div class="gen-comment-info">
							<div class="gen-comment-wrap">
								<div class="gen-comment-avatar">
									<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
								</div>
								<div class="gen-comment-box">
									<h5 class="title">
										<?php printf( wp_kses( '%s ', 'streamlab' ), sprintf( '%s', get_comment_author_link() ) ); ?>
									</h5>
									<div class="gen-comment-metadata">

										<?php edit_comment_link( esc_html__( 'Edit', 'streamlab' ), '<span class="edit-link">', '</span>' ); ?>
									</div><!-- .comment-metadata -->
									<?php if ( '0' == $comment->comment_approved ) : ?>
										<p class="comment-awaiting-moderation"><?php esc_html__( 'Your comment is awaiting moderation.', 'streamlab' ); ?></p>
									<?php endif; ?>
									<div class="comment-content">
										<?php comment_text(); ?>
									</div><!-- .comment-content -->
								</div><!-- .comment-author -->
								<div class="reply">
									<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
								</div><!-- .reply -->
							</div>
						</div>
					</article><!-- .comment-body -->
					<?php
					break;
				endswitch;
	}

	public static function update_post_views( $post_id ){

	   

	    $views_key = 'post_views_count'; // The views post meta key
	  
	    // The current post views count
	    $count =  get_post_meta( $post_id, $views_key, true ); 
	    if(empty($count))
	    {
	    	$count = 0;
	    }
	    update_post_meta( $post_id, $views_key, ($count+1) ); 
	   

	}

	public static function get_post_view_count($post_id)
	{

		$views =  get_post_meta( $post_id, 'post_views_count', true );
		if(!empty($views))
		{
			if($views == 1)
			{
				$view = ' View';
			}
			else
			{
				$view = ' Views';
			}
			
			echo esc_html( self::number_format_short($views) . $view );	
		}
		else
		{
			echo esc_html__('0 Views','streamlab');	
		}
		
		
	}

	public static function number_format_short( $n, $precision = 1 ){
		if ($n < 900) {
			// 0 - 900
			$n_format = number_format($n, $precision);
			$suffix = '';
		} else if ($n < 900000) {
			// 0.9k-850k
			$n_format = number_format($n / 1000, $precision);
			$suffix = 'K';
		} else if ($n < 900000000) {
			// 0.9m-850m
			$n_format = number_format($n / 1000000, $precision);
			$suffix = 'M';
		} else if ($n < 900000000000) {
			// 0.9b-850b
			$n_format = number_format($n / 1000000000, $precision);
			$suffix = 'B';
		} else {
			// 0.9t+
			$n_format = number_format($n / 1000000000000, $precision);
			$suffix = 'T';
		}

  
		if ( $precision > 0 ) {
			$dotzero = '.' . str_repeat( '0', $precision );
			$n_format = str_replace( $dotzero, '', $n_format );
		}

	  return $n_format . $suffix;
	}
			
}
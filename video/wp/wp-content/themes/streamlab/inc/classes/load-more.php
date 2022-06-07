<?php
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options;
class Gentech_Load_More {
	protected static $instance = null;
	
	private function __construct() {
		add_action('wp_ajax_loadmore_post',          array( $this, 'loadmore' ) );
		add_action('wp_ajax_nopriv_loadmore_post',   array( $this, 'loadmore' ) );
	}
	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	public function init( $type = 'loadmore' ) {
		if($type == 'loadmore')
		{
			$this->print_btn_html();
			$this->print_data_html();
		}
		if($type == 'infscroll')
		{
			$this->print_spinner_html();
			$this->print_data_html();
		}
		if($type == 'pagination')
		{
			Helper::instance()->pagination();
		}
		
	}
	public function loadmore() {
		check_ajax_referer( 'loadmore_nonce', 'nonce' );
		$args = json_decode( stripslashes( $_POST['query'] ), true );
		$args['paged'] = intval( $_POST['paged'] ) + 1;
		
		$view = !empty($_POST['view']) && 'list' === $_POST['view'] ? 'list' : 'grid';
		
		$filter_terms = $_REQUEST['taxonomy'];
		$post_type = $_REQUEST['post_type'];
		$box_style = $_REQUEST['box_style'];
		$taxo_type = $_REQUEST['taxo_type'];
		$dimentions = '';
		$taxo = $_REQUEST['post_type'].'_'.$_REQUEST['taxo_type'];
		$tax_query = array();
   
   		$taxargs = array();
		
		
		if( $post_type == 'video' && $taxo_type== 'genre') 
		{
			$taxo = 'video_cat';
		}
		$query = new \WP_Query($args);
		if( $query->have_posts() ) :
			while( $query->have_posts() ): $query->the_post();
				if($post_type == 'post')
				{
					echo '<div class="'.esc_attr( Options::get_main_column_number_class( $post_type) ).'">';
								get_template_part( 'template-parts/post/content', get_post_format() );
					echo '</div>'; 
				}
				else
				{
					 echo '<div class="'.esc_attr( Options::get_main_column_number_class( $post_type) ).'">';
                         get_template_part( "template-parts/{$post_type}/{$post_type}", "block" , array( 'box_style' => $box_style  ));
                     echo '</div>';
				}
				
			endwhile;
		endif;
		wp_die();
	}
	private function print_data_html() {
		global $wp_query;
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$nonce =  wp_create_nonce( 'loadmore_nonce' );
		$box_style = Options::get_box_style(get_post_type());
		
		echo '<div class="post-loadmore-data" data-query="'.esc_attr( json_encode( $wp_query->query_vars ) ).'" data-box_style="'.esc_attr($box_style).'" data-paged="'.esc_attr( $paged ).'" data-max="'.esc_attr( $wp_query->max_num_pages ).'" data-nonce="'.esc_attr( $nonce ).'" data-post_type="'.get_post_type().'"></div>';
	}
	private function print_btn_html() {
		?>
		<div class="col-lg-12">
			<div class="gen-load-more-button">
			<div class="gen-btn-container">
        		<a class="gen-button gen-button-loadmore gen-button-flat" href="#">
                    <span class="button-text"><?php echo esc_html__('Load More' , 'streamlab') ?></span>
                    <span class="loadmore-icon"><i class="fa fa-spinner fa-spin"></i></span>
                    
        		</a>
  			</div>
		</div>
		</div>
		
			
		
		<?php
	}
	private function print_spinner_html() {
		?>
		<div class="col-lg-12">
			<div class="loadmore-icon"><i class="fa fa-spinner fa-spin"></i></div>
		</div>
		
		<?php
	}
	public static function print_playlist_loadmore_type( $load_type , $wp_query )
	{
		if($load_type == 'loadmore')
		{
			?>
			<div class="col-lg-12">
				<div class="gen-load-more-button">
					<div class="gen-btn-container">
		        		<a class="gen-button gen-button-loadmore gen-button-flat" href="#">
		                    <span class="button-text"><?php echo esc_html__('Load More' , 'streamlab') ?></span>
		                    <span class="loadmore-icon"><i class="fa fa-spinner fa-spin"></i></span>
		                    
		        		</a>
		  			</div>
				</div>
			</div> 
			<?php 
		}
		if($load_type == 'infscroll')
		{
			?>
			<div class="col-lg-12">
				<div class="loadmore-icon"><i class="fa fa-spinner fa-spin"></i></div>
			</div>
			<?php 
		}
		
		
	}
	
}
Gentech_Load_More::instance();
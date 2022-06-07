<?php 
namespace gentechtree\streamlab;

class General_Setup
{
	protected static $instance = null;

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}


	public function __construct (){
		
		add_action( 'after_setup_theme', array($this,'theme_setup') );
		add_action('wp_loaded', array($this,'prefix_output_buffer_start'));
		add_action( 'widgets_init', array($this,'register_sidebar') );

		add_action('after_setup_theme', function() {
        	add_theme_support( 'html5', [ 'script', 'style' ] );
    		}
		);

		add_filter('comment_form_fields', array($this,'customize_comment_field'));

		add_filter( 'wp_nav_menu_objects', array($this,'menu_set_dropdown'), 10, 2 );

		add_filter( 'nav_menu_item_args', array($this,'add_sub_toggles_to_main_menu'), 10, 3 );

		add_filter( 'body_class', array($this, 'body_classes')  );
	}

	
	public function theme_setup(){

		load_theme_textdomain( 'streamlab', STREAMLAB_DIR . '/languages' );

		add_theme_support( 'masvideos');


		$GLOBALS['content_width'] = 525;
	
		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'title-tag' );
		
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		) );

		register_nav_menus( array(
			'primary'    => esc_html__( 'Primary', 'streamlab' ),
			'social' => esc_html__( 'Social Links Menu', 'streamlab' ),
			'side_menu' => esc_html__( 'Sidebar Menu', 'streamlab' ),
		) );




	}

	public function register_sidebar(){

		register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'streamlab' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'streamlab' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		) );

		register_sidebar( array(
		'name'          => esc_html__('Footer  1','streamlab'),
		'class'         => 'nav-list',
		'id'            => 'gen_footer_1',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="footer-title">',
		'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__('Footer  2','streamlab'),
			'class'         => 'nav-list',
			'id'            => 'gen_footer_2',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__('Footer  3','streamlab'),
			'class'         => 'nav-list',
			'id'            => 'gen_footer_3',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => esc_html__('Footer  4','streamlab'),
			'class'         => 'nav-list',
			'id'            => 'gen_footer_4',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-title">',
			'after_title'   => '</h4>',
		) );

		
		register_sidebar( array(
			'name'          => esc_html__('Header sidebar','streamlab'),
			'class'         => 'nav-list',
			'id'            => 'gen_footer_6',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-title">',
			'after_title'   => '</h4>',
		) );

	}

	public function customize_comment_field($fields){

	    $commenter = wp_get_current_commenter();
	    
	    $req      = get_option('require_name_email');
	    $aria_req = ($req ? " aria-required='true'" : '');
	    
	    $comment_field = $fields['comment'];
	    unset($fields['comment']);
	    unset($fields['cookies']);
	    unset($fields['author']);
	    unset($fields['url']);
	    unset($fields['email']);
	    
	    $fields['author'] = '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' placeholder="' . esc_attr(__('* Enter Name', 'streamlab')) . '" required/></p>';
	    
	    $fields['email'] = '<p class="comment-form-email"><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' placeholder="' . esc_attr(__('* Enter Email', 'streamlab')) . '" required/></p>';
	    
	    $fields['url'] = '<p class="comment-form-url"><input id="url" name="url" type="url" value="" size="30" placeholder="' . esc_attr(__('Enter Url', 'streamlab')) . '"></p>';
	    
	    $fields['comment'] = $comment_field;

	    return $fields;
	}

	public function menu_set_dropdown( $sorted_menu_items, $args ) {

		  $last_top = 0;
		  foreach ( $sorted_menu_items as $key => $obj ) {
		      // it is a top lv item?
		      if ( 0 == $obj->menu_item_parent ) {
		          // set the key of the parent
		          $last_top = $key;
		      } else {
		          $sorted_menu_items[$last_top]->classes['dropdown'] = 'dropdown';
		      }
		  }
			return $sorted_menu_items;
	}

	public function add_sub_toggles_to_main_menu( $args, $item, $depth ) {

		
		if ( 'primary' === $args->theme_location ) {
			if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
				$args->after = '<i class="fa fa-chevron-down gen-submenu-icon"></i>';
			} else {
				$args->after = '';
			}
		}

		return $args;

	}
	public function body_classes( $classes ) {
		// Add class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		// Add class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Add class if we're viewing the Customizer for easier styling of theme options.
		if ( is_customize_preview() ) {
			$classes[] = 'streamlab-customizer';
		}

		// Add class on front page.
		if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
			$classes[] = 'streamlab-front-page';
		}

		// Add a class if there is a custom header.
		if ( has_header_image() ) {
			$classes[] = 'has-header-image';
		}

		// Add class if sidebar is used.
		if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
			$classes[] = 'has-sidebar';
		}

		// Add class for one or two column page layouts.
		if ( is_page() || is_archive() ) {
			if ( 'one-column' === get_theme_mod( 'page_layout' ) ) {
				$classes[] = 'page-one-column';
			} else {
				$classes[] = 'page-two-column';
			}
		}

		// Add class if the site title and tagline is hidden.
		if ( 'blank' === get_header_textcolor() ) {
			$classes[] = 'title-tagline-hidden';
		}

		
		
	

		return $classes;
	}

	public function prefix_output_buffer_start() { 

    	ob_start(array($this,"prefix_output_callback")); 

	}

	public function prefix_output_callback($buffer) {

	    return preg_replace( "%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer );
	}

	public function get_the_tag_list()
	{
		$separate_meta = esc_html__( ', ', 'streamlab' );

	
	
	
	    $tags_list = get_the_tag_list( '', $separate_meta );
	    
		if ( $tags_list && ! is_wp_error( $tags_list ) ) 
		{
			echo '<span class="tags-links"><span class="screen-reader-text">' . esc_html__( 'Tags', 'streamlab' ) . '</span>' . $tags_list . '</span>';
		}
	}
}

new General_Setup;
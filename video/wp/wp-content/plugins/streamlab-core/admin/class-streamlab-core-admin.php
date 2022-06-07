<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://peacefulqode.com/
 * @since      1.0.0
 *
 * @package    Streamlab_Core
 * @subpackage Streamlab_Core/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Streamlab_Core
 * @subpackage Streamlab_Core/admin
 * @author     Gentechtree <Gentechtree@gmail.com>
 */
class Streamlab_Core_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_dependencies();

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Streamlab_Core_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Streamlab_Core_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/streamlab-core-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Streamlab_Core_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Streamlab_Core_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'streamlab-core-admin', plugin_dir_url( __FILE__ ) . 'js/streamlab-core-admin.js', array( 'jquery' ), $this->version, false );
		$youtube_api = get_option( 'gen_youtube_api_key' );
		$vimoe_api_key = get_option( 'gen_vimoe_api_key' );
		$omdb_api_key = get_option( 'gen_omdb_api_key' );
		wp_localize_script('streamlab-core-admin', 'streamlab_obj', [
            'ajaxurl' => esc_js(admin_url('admin-ajax.php')),
            'youtube' => esc_js('https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=10&key='.$youtube_api.'&q='),
            'vimeo' => esc_js('https://api.vimeo.com/videos?per_page=10&page=1&query='),
            'omdb' => esc_js('https://www.omdbapi.com/?apikey='.$omdb_api_key.'&'),
            'ajax_nonce' => esc_js( wp_create_nonce('_notice_nonce') ),
            'vimoe_api_key' => esc_js( $vimoe_api_key ),
            'youtube_api_key' => esc_js( $youtube_api ),
            'omdb_api_key' => esc_js( $omdb_api_key ),
		]);

	}

	private function load_dependencies()
	{
		require_once plugin_dir_path( __FILE__  ) . 'classes/helpers.php';
		require_once plugin_dir_path( __FILE__  ) . 'classes/panel.php';
	}

}

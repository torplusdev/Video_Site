<?php 
class Plugin_Helper
{
	protected static $instance = null;

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public static function  get_attachment_data($attachment_id = '' , $size = '' )
	{
	     $attachment = get_post( $attachment_id );
	        $data =  array(
	            'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
	            
	        );
	       
	       		echo wp_get_attachment_image($attachment_id , $size , $data); 	
	        
	        
	       
	}

	public static function  get_attachment_data_html($attachment_id = '' , $classes= array())
	{
	     $attachment = get_post( $attachment_id );
	     $class = '';
	     if(!empty($classes))
	     {
	       $class = 'class='.implode(" " , $classes);
	     }
	     $alt = (!empty(get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ))) ? get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) : 'woo-image';
	        $data =  array(
	            'alt' => $alt,
	            'caption' => $attachment->post_excerpt,
	            'description' => $attachment->post_content,
	            'href' => get_permalink( $attachment->ID ),
	            'src' => $attachment->guid,
	            'title' => $attachment->post_title
	        );
	        ?>
	        <img src="<?php echo esc_url($data['src']) ?>" title="<?php echo esc_attr($data['title']) ?>" alt="<?php echo esc_attr($data['alt']); ?>" <?php echo $class; ?> >
	        <?php 
	}
}

Plugin_Helper::instance();
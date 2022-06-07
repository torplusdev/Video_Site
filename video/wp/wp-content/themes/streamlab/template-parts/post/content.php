<?php
$theme_options = get_option('theme_options');  

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="gen-blog-post">
   
      <?php
        if(has_post_thumbnail())
        {
          ?>
           <div class="gen-post-media">
          <?php
          the_post_thumbnail();
          ?>
      
         </div>
      <?php 
        } 
      ?>
   
    <div class="gen-blog-contain">
      <?php
          $archive_year  = get_the_time( 'Y' ); 
          $archive_month = get_the_time( 'm' ); 
          $archive_day   = get_the_time( 'd' ); 
          ?>
    <div class="gen-post-meta">
       <?php 
      if(is_sticky() && !is_single())
        {
        ?>
        <span class="gen-sticky-post-label"><i class="fa fa-star" aria-hidden="true"></i><?php echo esc_html__('Featured', 'streamlab') ?></span>
        <?php } ?>
      <ul>
               
       <li class="gen-post-author"><i class="fa fa-user"></i><?php the_author(); ?></li>

        <li class="gen-post-meta"><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><i class="fa fa-calendar"></i><?php the_time( get_option( 'date_format' ) ); ?></a>
        </li>

        <li class="gen-post-tag">
           <?php
          $i =0;
          $categories = get_the_category( get_the_ID() );
          foreach( $categories as $category ) {
            if($i==0)
            {
            ?>
           <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><i class="fa fa-tag"></i><?php echo esc_attr( $category->name ) ?></a>
            <?php   
            $i++;     
          }}         
          ?> 
        </li>
       
      </ul>
    </div>

       <?php
       if(!is_single()) 
       {

        ?>
        <h5 class="gen-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p><?php the_excerpt(); ?></p>
        <?php 
           

            $btn_text = 'Read More';
            if(isset($theme_options['blog_btn_text']) && !empty($theme_options['blog_btn_text']))
            {
              $btn_text = $theme_options['blog_btn_text'];
            } 
            ?>            

            <div class="gen-btn-container">
              <a href="<?php the_permalink(); ?>" class="gen-button">
                <div class="gen-button-block">
                  <span  class="gen-button-text"><?php echo esc_html($btn_text); ?></span>
                </div>  
              </a>
            </div>
      <?php } 
        
          if(is_single())
          {
            the_content();
          } 
          else if(!isset($args))
          {
            the_excerpt();
             wp_link_pages( array(
            'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'streamlab' ),
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
          ) );
            ?> 

            
            <?php 
          }
         
          ?>
          
    </div>
</div>
	
	<?php 
	
	if(isset($theme_options['enable_comment']))
	{
		$options = $theme_options['enable_comment'];
		if($options == "yes")
		{
			if(is_single()){
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				
			}
		}
	}
	else {
		if(is_single()){
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			
		}
		
	}

	?>
</article><!-- #post-## -->
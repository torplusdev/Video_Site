<?php
namespace Elementor; 

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class=""> 
  <div class="owl-carousel" <?php echo $this->get_render_attribute_string('slider'); ?>>
    <?php
    if ($wp_query -> have_posts() ) 
    {
      while ($wp_query -> have_posts() ) 
      {
        $wp_query->the_post();

        ?>
        <div class="item">
          <?php
          //masvideos_get_template_part( 'content', 'movie' );
          // get_template_part( 'template-parts/post/content', 'post' , array('editor' => true));
          ?>
          <div class="pt-blog-post">
    <div class="pt-post-media">
      <?php
        if(has_post_thumbnail())
        {
          the_post_thumbnail();
      ?>
        
      <?php 
        } 
      ?>
    </div>
    <div class="pt-blog-contain">
      <?php
          $archive_year  = get_the_time( 'Y' ); 
          $archive_month = get_the_time( 'm' ); 
          $archive_day   = get_the_time( 'd' ); 
          ?>
    <div class="pt-post-meta">
      <ul>        
       <li class="pt-post-author"><i class="fa fa-user"></i><?php the_author(); ?></li>
        <li class="pt-post-meta"><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>"><i class="fa fa-calendar"></i><?php echo esc_html( get_the_date( 'F Y', get_the_ID() ) ); ?></a>
        </li>
        <li class="pt-post-tag">
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
       <?php
      if(!is_single())
      {
      ?>
      <h5 class="pt-blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
      <?php } ?>
      <?php } ?>
     
          <?php
         
            the_excerpt();
            
            ?> 
            <div class="pt-btn-container">
        <a href="<?php echo esc_url(get_the_permalink()); ?>" <?php echo $this->get_render_attribute_string('btn_attr'); ?> >
          <div class="pt-button-block">
            <span class="pt-button-line-left"></span>
            <span  class="pt-button-text"><?php echo esc_html($settings['button_text']); ?></span>
            <span class="pt-button-line-right"></span>
            <?php echo $icon; ?>
          </div>  
      </a>
    </div>
            <?php 
          
          wp_link_pages( array(
            'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'architek' ),
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
          ) );
          ?>
     
          
    </div>
</div>
    </div>
        </div>
        <?php 
      }
      wp_reset_query();
    }
    ?>
  </div>
   
</div>
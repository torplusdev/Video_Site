<?php
   use gentechtree\streamlab\Helper;
   use gentechtree\streamlab\Options;
   $current_post = get_post_type();
   /**
    * The Template for displaying movie archives, including the main movies page which is a post type archive
    *
    * This template can be overridden by copying it to yourtheme/masvideos/archive-movie.php.
    *
    * HOWEVER, on occasion MasVideos will need to update template files and you
    * (the theme developer) will need to copy the new files to your theme to
    * maintain compatibility. We try to do this as little as possible, but it does
    * happen. When this occurs the version of the template file will be bumped and
    * the readme will list any important changes.
    *
    * @package MasVideos/Templates
    * @version 1.0.0
    */
   
   defined( 'ABSPATH' ) || exit;
   
   get_header();
   ?>
<div class="gentechtreethemes-contain-area">
   <div id="primary" class="content-area">
      <main id="main" class="site-main">
         <div class="container">
            <?php 
               /**
                * Hook: masvideos_before_main_content.
                *
                * @hooked masvideos_output_content_wrapper - 10 (outputs opening divs for the content)
                * @hooked masvideos_breadcrumb - 20
                * @hooked WC_Structured_Data::generate_website_data() - 30
                */
               //do_action( 'masvideos_before_main_content' );
               
               /**
                * Hook: masvideos_archive_header.
                *
                * @hooked masvideos_movie_archive_description - 10
                */
               
               
               if ( masvideos_movies_loop() ) {
               
                   /**
                    * Hook: masvideos_before_movies_loop.
                    *
                    * @hooked masvideos_print_notices - 10
                    * @hooked masvideos_result_count - 20
                    * @hooked masvideos_catalog_ordering - 30
                    */
               
                   ?>
            <div class="<?php  Options::get_main_row_class($current_post); ?>">
               <div class="<?php  Options::get_main_column_class($current_post); ?>"> 
                  <?php
                     
                    
                   
                     echo '<div class="'.esc_attr( Options::get_inner_row_class( $current_post ) ).'">';
                     if ( masvideos_get_movies_loop_prop( 'total' ) ) {
                     while ( have_posts() ) {
                     the_post();
                     
                                 /**
                                  * Hook: masvideos_movies_loop.
                                  *
                                  * @hooked WC_Structured_Data::generate_movie_data() - 10
                                  * @hooked masvideos_movies_loop_content() - 20
                                  */
                               
                                 
                                 echo '<div class="'.esc_attr( Options::get_main_column_number_class( $current_post) ).'">';
                                 get_template_part( 'template-parts/movie/movie', 'block');
                                 echo '</div>';
                             }
                         }
                         echo '</div>';

                       // do_action( 'masvideos_after_movies_loop' );
                     
                        echo '<div class="row">';
                        Gentech_Load_More::instance()->init( Options::get_load_type($current_post) );
                        echo '</div>';
                    ?>
               </div>
             
               
            </div>
            
            <?php 
               } else {
               /**
                * Hook: masvideos_no_movies_found.
                *
                * @hooked masvideos_no_movies_found - 10
                */
               do_action( 'masvideos_no_movies_found' );
               }
               ?>
         </div>
      </main>
   </div>
</div>
<?php 
get_footer();
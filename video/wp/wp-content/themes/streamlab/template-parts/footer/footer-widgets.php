<?php
/**
* Displays footer widgets if assigned
*
* @package WordPress
* @subpackage streamlab
* @since 1.0
* @version 1.0
*/
$theme_options = get_option('theme_options'); 
if(class_exists('ReduxFramework'))
{
if(is_active_sidebar( 'gen_footer_1' ) ||
is_active_sidebar( 'gen_footer_2' )  ||
is_active_sidebar( 'gen_footer_3' )  ||
is_active_sidebar( 'gen_footer_4' )  )
{
?>
<div class="gen-footer-top">
    <div class="container">
        <div class="row">
            <?php 
            if(isset($theme_options['footer_layout']))
            {
                $layout = $theme_options['footer_layout'];
                if($layout == "1")
                {
                ?>
                  <div class="col-lg-12">
                        <?php dynamic_sidebar( 'gen_footer_1' ); ?>
                  </div>  
               <?php 
                }
                elseif($layout == "2")
                {
                ?>
                    <div class="col-lg-6 col-md-6">
                        <?php dynamic_sidebar( 'gen_footer_1' ); ?>
                    </div> 
                    <div class="col-lg-6 col-md-6">
                            <?php dynamic_sidebar( 'gen_footer_2' ); ?>
                    </div> 
                <?php 
                }
                elseif($layout == "3")
                {
                ?>
                    <div class="col-lg-4  col-md-6">
                        <?php dynamic_sidebar( 'gen_footer_1' ); ?>
                    </div> 
                    <div class="col-lg-4  col-md-6">
                            <?php dynamic_sidebar( 'gen_footer_2' ); ?>
                    </div> 
                    <div class="col-lg-4 col-md-6">
                            <?php dynamic_sidebar( 'gen_footer_3' ); ?>
                    </div>
                <?php 
                }
                elseif($layout == "4")
                {
                ?>
                    <div class="col-xl-3 col-md-6">
                        <?php dynamic_sidebar( 'gen_footer_1' ); ?>
                    </div> 
                    <div class="col-xl-3  col-md-6">
                            <?php dynamic_sidebar( 'gen_footer_2' ); ?>
                    </div> 
                    <div class="col-xl-3  col-md-6">
                            <?php dynamic_sidebar( 'gen_footer_3' ); ?>
                    </div>
                    <div class="col-xl-3  col-md-6">
                            <?php dynamic_sidebar( 'gen_footer_4' ); ?>
                    </div>
                <?php 
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
}
}
else
{
if(is_active_sidebar( 'gen_footer_1' ) ||
is_active_sidebar( 'gen_footer_2' )  ||
is_active_sidebar( 'gen_footer_3' )  ||
is_active_sidebar( 'gen_footer_4' )  )
{
?>
<div class="gen-footer-top">
    <div class="container">
        <div class="row">
            <?php 
             if( is_active_sidebar( 'gen_footer_1' ) ) { ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 ">
                            <?php dynamic_sidebar( 'gen_footer_1' ); ?>
                        </div>
                    <?php   }
                    if( is_active_sidebar( 'gen_footer_2' ) ) { ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 ">
                            <?php dynamic_sidebar( 'gen_footer_2' ); ?>
                        </div>
                    <?php }
                    if( is_active_sidebar( 'gen_footer_3' ) ) { ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 ">
                            <?php dynamic_sidebar( 'gen_footer_3' ); ?>
                        </div>
                    <?php }
                    if( is_active_sidebar( 'gen_footer_4' ) ) { ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 ">
                            <?php dynamic_sidebar( 'gen_footer_4' ); ?>
                        </div>
                    <?php } ?>
        </div>
    </div>
</div>
<?php
}
}
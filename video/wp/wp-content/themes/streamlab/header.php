<?php
use gentechtree\streamlab\Helper;
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage streamlab
 * @since 1.0
 * @version 1.0
 */
$theme_options = get_option('theme_options'); 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<!-- Required meta tags -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php   
    if ( ! function_exists( 'has_site_icon' ) || ! wp_site_icon() ) {
      if( !empty($theme_options['background_favicon']['url']) ) { ?>
        <link rel="shortcut icon" href="<?php echo esc_url($theme_options['background_favicon']['url']); ?>" />
        <?php 
      }
      else
      {
        ?>
         <link rel="shortcut icon" href="<?php echo esc_url( STREAMLAB_ASSETS_URI . 'img/favicon.ico'); ?>" />
         <?php 
      }
    }
wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <!-- loading -->
  <?php streamlab_display_loader(); ?>
  
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#content"><?php esc_html__( 'Skip to content', 'streamlab' ); ?></a>
<?php
if(class_exists('ReduxFramework'))
{
  get_template_part( 'template-parts/header/header', 'style-one' ); 
}
else
{
   get_template_part( 'template-parts/header/header', 'default' ); 
}
    
?>
<?php Helper::instance()->display_header(); ?>   
<div class="gentechtreethemes-contain"> 
  <div class="site-content-contain">
    <div id="content" class="site-content">
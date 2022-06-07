<?php 
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options; 

global $tv_show;

$box_style = Options::get_box_style('tv_show');

if(!empty($args))
{
	$box_style = $args['box_style'];
}
  get_template_part( "template-parts/tv_show/content", "style-{$box_style}" , $args );

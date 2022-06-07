<?php 
use gentechtree\streamlab\Helper;
use gentechtree\streamlab\Options; 
$box_style = Options::get_box_style('video');

global $video;

if(!empty($args))
{
	$box_style = $args['box_style'];
}
  get_template_part( "template-parts/video/content", "style-{$box_style}" ,$args );

<?php 
function streamlab_display_loader()
{
    $theme_options = get_option('theme_options'); 
    if(isset($theme_options['loader_switch']))
    {
        if($theme_options['loader_switch'] == 'image')
        {
            if(!empty($theme_options['background_loader']['url']))
            {
                ?>
                <div id="gen-loading">
                    <div id="gen-loading-center">
                        <img src="<?php echo esc_url($theme_options['background_loader']['url']) ?>" alt="<?php esc_attr_e('loading','streamlab'); ?>">
                    </div>
                </div>
            <?php }
        }
        else if($theme_options['loader_switch'] == 'text')
        {
            if(!empty($theme_options['loader_text']))
            {
                $tag = $theme_options['loader_tag'];
            ?>
                <div id="gen-loading">
                    <div id="gen-loading-center">
                        <<?php echo esc_html($tag); ?> class="gen-loader-text"><?php echo esc_html($theme_options['loader_text']) ?></<?php echo esc_html($tag); ?>>
                    </div>
                  </div>
            <?php }
        }
    }
    else
    {
        ?>
        <div id="gen-loading">
            <div id="gen-loading-center">
                <img src="<?php echo STREAMLAB_URI.'/assets/img/logo.png' ?>" alt="<?php esc_attr_e('loading','streamlab'); ?>">
            </div>
        </div>
    <?php 
    }
}
function streamlab_display_logo()
{
    $theme_options = get_option('theme_options');
    $logo = STREAMLAB_URI.'/assets/img/logo.png';
   
    if(isset($theme_options['logo_type']))
    {
        if($theme_options['logo_type'] == 'image')
        {
            if(!empty($theme_options['logo_url']['url']))
            {
                $logo = $theme_options['logo_url']['url'];    
            }            
        ?>
        <img class="img-fluid logo" src="<?php echo esc_url($logo,'streamlab') ?>" alt="<?php  esc_attr_e( 'streamlab', 'streamlab' ); ?>"> 
        <?php
        } 
        if($theme_options['logo_type'] == 'text')
        {
            if(!empty($theme_options['header_logo_text']))
            {
                $text = $theme_options['header_logo_text'];
            }
            else
            {
                $text = 'streamlab';
            }
            if(!empty($theme_options['header_logo_tag']))
            {
                $tag = $theme_options['header_logo_tag'];
            }
            else
            {
                $tag = 'h2';
            }
        ?>
            <<?php echo esc_html($tag); ?> class="gen-logo-text"><?php echo esc_html($text); ?></<?php echo esc_html($tag); ?>>
        <?php  
        }
    }
    else
    {
    ?>
        <img class="img-fluid logo" src="<?php echo esc_url($logo,'streamlab') ?>" alt="<?php  esc_attr_e( 'streamlab', 'streamlab' ); ?>"> 
    <?php 
    }
}
function streamlab_get_attachment_data($attachment_id = '')
{
     $attachment = get_post( $attachment_id );
        return array(
            'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink( $attachment->ID ),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
        );
}
function streamlab_get_attachment_data_html($attachment_id = '' , $classes= array())
{
     $attachment = get_post( $attachment_id );
     $class = '';
     if(!empty($classes))
     {
       $class = implode(" " , $classes);
     }
        $data =  array(
            'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink( $attachment->ID ),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
        );
        ?>
        <img src="<?php echo esc_url($data['src']) ?>" title="<?php echo esc_attr($data['title']) ?>" alt="<?php echo esc_attr($data['alt']); ?>" class="<?php echo esc_attr($class); ?>" >
        <?php 
}

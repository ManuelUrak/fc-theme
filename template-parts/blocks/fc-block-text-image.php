<?php 

$imgsrc = get_field('block_image_text_image');
$text = get_field('block_image_text_text');
$direction = get_field('block_image_text_direction') ?: 'below';

$class = 'block-image-text--' . $direction;

?>

<div class="block-image-text <?php echo esc_attr($class); ?>">
    <div class="block-image-text--image">   
        <?php echo fc_theme_render_image($imgsrc); ?>
    </div>
    <div class="block-image-text--text">
        <?php 
        
        $allowed = array(
            'a' => array(
                'href' => array()
            ),
            'br' => array(),
            'h2' => array(),
            'h3' => array(),
            'p' => array(),
            'ul' => array(),
            'li' => array()
        );

        echo wp_kses($text, $allowed);
        
        ?>
        
    </div>
</div>
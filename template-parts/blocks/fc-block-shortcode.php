<?php

$class = get_block_wrapper_attributes();
$classes = '';

if(preg_match('/class=["\']([^"\']+)["\']/', $class, $matches)){
    $classes = $matches[1];
}

?>

<div class="block-shortcode <?php echo esc_attr($classes); ?>">
    <?php echo do_shortcode(get_field('block_shortcode_shortcode')); ?>
</div>
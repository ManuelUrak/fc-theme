<div class="block-button-link">
    <?php 
    
    $link = get_field('block_button_link_link');

    $link_title = $link['title'];
    $link_url = $link['url'];
    $link_target = $link['target'] ? $link['target'] : '_self';
    
    ?>
    <a class="button button--primary" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
</div>
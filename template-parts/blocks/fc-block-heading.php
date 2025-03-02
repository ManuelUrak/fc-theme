<div class="block-heading">
    <?php 
    
    $tag = get_field('block_heading_heading_tag');
    $content = get_field('block_heading_heading_content');

    printf(
        '<%1$s class="block-heading--heading">%2$s</%1$s>',
        esc_attr($tag),
        esc_html($content)
    );
    
    ?>
</div>
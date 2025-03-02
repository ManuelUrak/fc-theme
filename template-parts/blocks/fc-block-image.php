<div class="block-image">
    <div class="img-container img-container--contain lazy">
        <div class="img-container__inner">
        <?php 
                    
        $imgsrc = get_field('block_block_image');

        printf(
            '<img loading="lazy" %s title="%s" alt="%s" />',
            fc_theme_responsive_image($imgsrc, 'medium', '400px'),
            esc_attr(get_the_title($imgsrc )),
            esc_attr(get_post_meta($imgsrc, '_wp_attachment_image_alt', true))
        );
                    
        ?>
        </div>
    </div>
</div>
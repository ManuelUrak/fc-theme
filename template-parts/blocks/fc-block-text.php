<div class="block-text">
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
    
    ?>
    <p><?php echo wp_kses(get_field('block_block_text'), $allowed); ?></p>
</div>
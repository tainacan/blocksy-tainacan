<?php 
 
 $next = '';
 $previous = '';
 $prefix = blocksy_manager()->screen->get_prefix();

if (get_theme_mod( $prefix . '_has_post_nav', $prefix === 'single_blog_post' ? 'yes' : 'no' ) === 'yes') {
   

    $container_class = 'post-navigation';

    $container_class .= ' ' . blocksy_visibility_classes(get_theme_mod(
        $prefix . '_post_nav_visibility',
        [
            'desktop' => true,
            'tablet' => true,
            'mobile' => true,
        ]
    ));

    $has_thumb = get_theme_mod($prefix . '_has_post_nav_thumb', 'yes') === 'yes';

    if ($has_thumb)
        $container_class .= ' has-thumbnails';
        
    $adjacent_links = [
        'next' => '',
        'previous' => ''
    ];

    $adjacent_links = blocksy_tainacan_get_adjacent_item_links();

    $previous = $adjacent_links['previous'];
    $next = $adjacent_links['next'];
}
?>
<?php if ($previous !== '' || $next !== '') : ?>
    <nav class="<?php echo esc_attr( $container_class ); ?>">
        <?php if ( $previous !== '' ) {
            echo $previous;
        } else { ?>
            <div class="nav-item-prev"></div>
        <?php } ?>

        <?php if ( $next !== '' ) {
            echo $next;
        } else { ?>
            <div class="nav-item-next"></div>
        <?php } ?>

    </nav>
<?php endif; ?>
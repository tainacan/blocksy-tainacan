<?php 
    $prefix = blocksy_manager()->screen->get_prefix();
?>
<div>
    <?php if ( get_theme_mod($prefix . '_display_section_labels', 'yes') == 'yes' && get_theme_mod($prefix . '_section_metadata_label', __( 'Metadata', 'blocksy-tainacan' )) != '' ) : ?>
        <h2 class="title-content-items" id="single-item-metadata-label">
            <?php echo esc_html( get_theme_mod($prefix . '_section_metadata_label', __( 'Metadata', 'blocksy-tainacan' ) ) ); ?>
        </h2>
    <?php endif; ?>
    <section class="tainacan-content single-item-collection">
        <div class="single-item-collection--information justify-content-center">
            <div class="row">
                <div class="col single-item-collection--metadata" style="column-width: <?php echo get_theme_mod( $prefix . '_metadata_columns', ['mobile' => '200px', 'tablet' => '300px', 'desktop' => '400px' ] )['desktop'] ?>">
                    <?php if (has_post_thumbnail() && (get_theme_mod($prefix . '_show_thumbnail', 'no') === 'yes') ): ?>
                        <div class="tainacan-item-thumbnail-container">
                            <h3><?php _e( 'Thumbnail', 'blocksy-tainacan' ); ?></h3>
                            <p><?php the_post_thumbnail('tainacan-medium-full', array('class' => 'item-card--thumbnail')); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php do_action( 'blocksy-tainacan-single-item-metadata-begin' ); ?>
                    <?php
                        $args = array(
                            'before_title' => '<div><h3>',
                            'after_title' => '</h3>',
                            'before_value' => '<p>',
                            'after_value' => '</p></div>',
                            'exclude_title' => (get_theme_mod($prefix . '_show_title_metadata', 'yes') === 'no')
                        );
                        tainacan_the_metadata( $args );
                    ?>
                    <?php do_action( 'blocksy-tainacan-single-item-metadata-end' ); ?>
                </div>
            </div>
        </div>
    </section>
</div>

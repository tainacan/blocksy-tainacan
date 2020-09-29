<?php 
    $prefix = blocksy_manager()->screen->get_prefix();
?>
<div>
    <?php if ( get_theme_mod('tainacan_single_item_metadata_section_label', '') != '') : ?>
        <h2 class="title-content-items" id="single-item-metadata-label">
            <?php echo esc_html( get_theme_mod('tainacan_single_item_metadata_section_label', '') ); ?>
        </h2>
    <?php endif; ?>
    <section class="tainacan-content single-item-collection margin-two-column">
        <div class="single-item-collection--information justify-content-center">
            <div class="row">
                <div class="col s-item-collection--metadata">
                    <?php if (has_post_thumbnail() && (get_theme_mod($prefix . '_show_thumbnail', 'no') === 'yes') ): ?>
                        <div class="tainacan-item-thumbnail-container card">
                            <div class="card-body">
                                <h3><?php _e( 'Thumbnail', 'blocksy-tainacan' ); ?></h3>
                                <?php the_post_thumbnail('tainacan-medium-full', array('class' => 'item-card--thumbnail')); ?>
                            </div>
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

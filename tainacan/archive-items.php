<?php get_header(); ?>

    <article class="page type-page hentry singular">
        <header class="tainacan-collection-header" style="background-image: <?php if ( get_header_image() ) { echo('linear-gradient(to bottom, rgba(255, 255, 255, 0.3), var(--backgroundColor, #f8f9fb)), url(' . get_header_image() . ')'); } else { echo ''; } ?>">
            <div class="tainacan-collection-header__box">  
                <?php if ( has_post_thumbnail( tainacan_get_collection_id() ) ) : 
                    $thumbnail_id = get_post_thumbnail_id( $post->ID );
                    $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); ?>
                    <div class="collection-thumbnail">
                        <img src="<?php echo get_the_post_thumbnail_url( tainacan_get_collection_id() ); ?>" alt="<?php echo esc_attr($alt); ?>">
                    </div>
                <?php endif; ?>
                <?php 
                    echo blocksy_output_hero_section( 'type-1' );
                ?>
            </div>
        </header>		

        <div class="entry-content">										
            <?php 
                tainacan_the_faceted_search([
                    'show-filters-button-inside-search-control' => true
                ]); 
            ?>
        </div>
    </article>
<?php get_footer(); ?>
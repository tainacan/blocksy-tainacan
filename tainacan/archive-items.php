<?php get_header(); ?>

    <article class="page type-page hentry singular">
        <header class="entry-header has-text-align-center">
            <div class="entry-header-inner section-inner medium">  
                <h1 class="entry-title">
                    <?php tainacan_the_collection_name(); ?>
                </h1>
            </div>
            <?php $tainacan_collection_description = tainacan_get_the_collection_description(); ?>
            <?php if ( ! empty( $tainacan_collection_description )) : ?>
                <?php if (has_post_thumbnail( tainacan_get_collection_id() )): ?>
                    <div class="entry-description">
                <?php else: ?>
                    <div class="entry-description">
                <?php endif; ?>
                    <?php tainacan_the_collection_description(); ?>
                </div>
            <?php endif; ?> 
        </header>
        <div class="tainacan-collection-header">
            <?php if ( has_post_thumbnail( tainacan_get_collection_id() ) ) : 
                $thumbnail_id = get_post_thumbnail_id( $post->ID );
                $alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); ?>
                <div class="single-item-collection--thumbnail">
                    <img src="<?php echo get_the_post_thumbnail_url( tainacan_get_collection_id() ); ?>" alt="<?php echo esc_attr($alt); ?>">
                </div>
            <?php endif; ?>
            <?php if ( get_header_image() ) : ?>
                <div class="hero" style="background-image: url(<?php header_image(); ?>);">
                    <img src="<?php header_image(); ?>" class="attachment-veganos-hero-thumbnail size-veganos-hero-thumbnail wp-post-image" alt="">						
                </div>
            <?php endif; ?>
        </div>
        <div class="entry-content">										
            <?php 
                tainacan_the_faceted_search(); 
            ?>
        </div>
    </article>
<?php get_footer(); ?>
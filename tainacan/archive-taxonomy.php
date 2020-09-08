<?php get_header(); ?>

<?php
	$current_term = tainacan_get_term();
	$current_taxonomy = get_taxonomy( $current_term->taxonomy );
	$current_term = \Tainacan\Repositories\Terms::get_instance()->fetch($current_term->term_id, $current_term->taxonomy);
	$image =  $current_term->get_header_image_id();
	$src = wp_get_attachment_image_src($image, 'full');
?>

    <article class="page type-page hentry singular">
        <header class="entry-header has-text-align-center">
            <div class="entry-header-inner section-inner medium">                     
                <h1 class="entry-title">
                    <span style="font-weight: normal;">
                        <?php echo $current_taxonomy->labels->name . ':'; ?>
                    </span>
                    <?php tainacan_the_term_name(); ?>
                </h1>
                <br> 
                <?php $tainacan_term_description = tainacan_get_the_term_description(); ?>
                <?php if ( ! empty( $tainacan_term_description )) : ?>
                    <?php if ($src): ?>
                        <div class="entry-description">
                    <?php else: ?>
                        <div class="entry-description">
                    <?php endif; ?>
                        <?php echo $tainacan_term_description; ?>
                    </div>
                <?php endif; ?>
            </div> 
        </header>
        <?php if ($src && $src[0]) : ?>
            <div class="tainacan-taxonomy-header">
                <img src="<?php echo($src[0]) ?>" alt="Imagem do termo">
            </div>
        <?php endif; ?>
        <div class="entry-content">										
            <?php 
                tainacan_the_faceted_search(); 
            ?>
        </div>
    </article>

<?php get_footer(); ?>
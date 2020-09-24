<?php get_header(); ?>

<?php
	$current_term = tainacan_get_term();
	$current_taxonomy = get_taxonomy( $current_term->taxonomy );
	$current_term = \Tainacan\Repositories\Terms::get_instance()->fetch($current_term->term_id, $current_term->taxonomy);
	$image = $current_term->get_header_image_id();
	$src = wp_get_attachment_image_src($image, 'full');
?>

    <article class="page type-page hentry singular">

        <header class="tainacan-collection-header">
            <div class="tainacan-collection-header__box">  
                <?php if ($src && $src[0]) : ?>
                    <div class="collection-thumbnail">
                        <img src="<?php echo($src[0]) ?>">
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
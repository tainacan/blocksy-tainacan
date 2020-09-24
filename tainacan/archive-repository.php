<?php get_header(); ?>

    <article class="page type-page hentry singular">

        <header class="tainacan-collection-header">
            <div class="tainacan-collection-header__box">  
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
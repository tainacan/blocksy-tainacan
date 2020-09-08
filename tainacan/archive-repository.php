<?php get_header(); ?>

    <article class="page type-page hentry singular">
        <header class="entry-header has-text-align-center">
            <div class="entry-header-inner section-inner medium">  
                <h1 class="entry-title">
                    <?php the_archive_title(); ?>
                </h1>
            </div>
        </header>
        <div class="entry-content">										
            <?php 
                tainacan_the_faceted_search(); 
            ?>
        </div>
    </article>
    
<?php get_footer(); ?>
<?php get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">   
        <main id="main" class="site-main" role="main">
            <?php if ( have_posts() ) : ?>

                <article role="article" id="post_<?php the_ID()?>" class="page type-page hentry singular">

                    <?php do_action( 'docksy-tainacan-single-item-top' ); ?>

                    <?php while ( have_posts() ) : the_post(); ?>
                        <header class="entry-header has-text-align-center"> 
                            <div class="entry-categories">
                                <div class="entry-categories-inner">
                                    <?php if ( function_exists('tainacan_the_collection_url') ): ?>
                                        <a href="<?php tainacan_the_collection_url(); ?>">
                                            <?php tainacan_the_collection_name(); ?>
                                        </a>
                                    <?php else : ?>
                                        <span><?php tainacan_the_collection_name(); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>  

                            <h1 class="entry-title">
                                <?php the_title(); ?>
                            </h1> 

                        </header>
                        
                        <?php do_action( 'docksy-tainacan-single-item-after-title' ); ?>
                    
                        <section class="tainacan-entry-content entry-content">

                            <h2 class="title-content-items">Informações</h2>
                            <div class="single-item-collection--information justify-content-center">
                                <div class="tainacan-metadata-list">
                               
                                
                                <?php do_action( 'docksy-tainacan-single-item-metadata-begin' ); ?>
                                
                                    <?php
                                        $args = array(
                                            'before_title' => '<div><h3>',
                                            'after_title' => '</h3>',
                                            'before_value' => '<p>',
                                            'after_value' => '</p></div>',
                                        );
                                        //$field = null;
                                        tainacan_the_metadata( $args );
                                    ?>
                                    <?php do_action( 'docksy-tainacan-single-item-metadata-end' ); ?>
                                </div>
                            </div>
                        </section>
                        
                        <?php do_action( 'docksy-tainacan-single-item-after-metadata' ); ?>

                        <?php if ( tainacan_has_document() ) : ?>
                            <hr>
                            <section class="tainacan-entry-content entry-content">
                                <h2 class="title-content-items">Documento</h2>
                                <div class="single-item-collection--document">
                                    <?php tainacan_the_document(); ?>
                                </div>
                            </section>
                        <?php endif; ?>
                    
                        <?php do_action( 'docksy-tainacan-single-item-after-document' ); ?>

                        <?php
                            if (function_exists('tainacan_get_the_attachments')) {
                                $attachments = tainacan_get_the_attachments();
                            } else {
                                // compatibility with pre 0.11 tainacan plugin
                                $attachments = array_values(
                                    get_children(
                                        array(
                                            'post_parent' => $post->ID,
                                            'post_type' => 'attachment',
                                            'post_mime_type' => 'image',
                                            'order' => 'ASC',
                                            'numberposts'  => -1,
                                        )
                                    )
                                );
                            }
                        ?>

                        <?php if ( ! empty( $attachments ) ) : ?>
                            <hr>
                            <section class="tainacan-entry-content entry-content">
                                <h2 class="title-content-items">Anexos</h2>
                                <div class="single-item-collection--attachments">
                                    <?php foreach ( $attachments as $attachment ) { ?>
                                        <?php
                                        if ( function_exists('tainacan_get_attachment_html_url') ) {
                                            $href = tainacan_get_attachment_html_url($attachment->ID);
                                        } else {
                                            $href = wp_get_attachment_url($attachment->ID, 'large');
                                        }
                                        ?>
                                        <div class="single-item-collection--attachments-file">
                                            <a 
                                                class="<?php if (!wp_get_attachment_image( $attachment->ID, 'docksy-tainacan-item-attachments')) echo'attachment-without-image'; ?>"
                                                href="<?php echo $href; ?>" data-toggle="lightbox" data-gallery="example-gallery">
                                                <?php
                                                    echo wp_get_attachment_image( $attachment->ID, 'docksy-tainacan-item-attachments', true );
                                                    echo get_the_title( $attachment->ID );
                                                ?>
                                            </a>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </section>

                            <footer class="entry-footer">
                                <?php
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif; ?>
                            </footer>

                        </article>

                    <?php endif; ?>

                    <?php do_action( 'docksy-tainacan-single-item-after-attachments' ); ?>

                <?php endwhile; ?>
                <?php do_action( 'docksy-tainacan-single-item-bottom' ); ?>
            <?php else : ?>
                Nada encontrado aqui.
            <?php endif; ?>
        
        </main>
    </div>
</div>

<?php get_footer(); ?>
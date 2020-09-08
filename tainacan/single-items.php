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

                            <div class="post-meta-wrapper post-meta-single post-meta-single-top">
                                <ul class="post-meta">
                                    <li class="post-author meta-wrapper">
                                        <span class="meta-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"><path d="M6.70846497,10.3082552 C6.43780491,9.94641406 6.5117218,9.43367048 6.87356298,9.16301045 C7.23540415,8.89235035 7.74814771,8.96626726 8.01880776,9.32810842 C8.5875786,10.0884893 9.45856383,10.5643487 10.4057058,10.6321812 C11.3528479,10.7000136 12.2827563,10.3531306 12.9541853,9.68145807 L15.3987642,7.23705399 C16.6390369,5.9529049 16.6212992,3.91168563 15.3588977,2.6492841 C14.0964962,1.38688258 12.0552769,1.36914494 10.77958,2.60113525 L9.37230725,4.00022615 C9.05185726,4.31881314 8.53381538,4.31730281 8.21522839,3.99685275 C7.89664141,3.67640269 7.89815174,3.15836082 8.21860184,2.83977385 L9.63432671,1.43240056 C11.5605503,-0.42800847 14.6223793,-0.401402004 16.5159816,1.49220028 C18.4095838,3.38580256 18.4361903,6.44763148 16.5658147,8.38399647 L14.1113741,10.838437 C13.1043877,11.8457885 11.7095252,12.366113 10.2888121,12.2643643 C8.86809903,12.1626156 7.56162126,11.4488264 6.70846497,10.3082552 Z M11.291535,7.6917448 C11.5621951,8.05358597 11.4882782,8.56632952 11.126437,8.83698955 C10.7645959,9.10764965 10.2518523,9.03373274 9.98119227,8.67189158 C9.4124214,7.91151075 8.54143617,7.43565129 7.59429414,7.36781884 C6.6471521,7.29998638 5.71724372,7.64686937 5.04581464,8.31854193 L2.60123581,10.762946 C1.36096312,12.0470951 1.37870076,14.0883144 2.64110228,15.3507159 C3.90350381,16.6131174 5.94472309,16.630855 7.21873082,15.400549 L8.61782171,14.0014581 C8.93734159,13.6819382 9.45538568,13.6819382 9.77490556,14.0014581 C10.0944254,14.320978 10.0944254,14.839022 9.77490556,15.1585419 L8.36567329,16.5675994 C6.43944966,18.4280085 3.37762074,18.401402 1.48401846,16.5077998 C-0.409583822,14.6141975 -0.436190288,11.5523685 1.43418536,9.61600353 L3.88862594,7.16156298 C4.89561225,6.15421151 6.29047483,5.63388702 7.71118789,5.7356357 C9.13190097,5.83738438 10.4383788,6.55117356 11.291535,7.6917448 Z"/></svg>
                                        </span>
                                        <span class="meta-text">
                                            <a href="javascript:history.go(-1)">Voltar<object data="" type=""></object></a>					
                                        </span>
                                    </li>
                                    <?php if(function_exists('tainacan_the_item_edit_link')): ?>
                                        <li class="post-comment-link meta-wrapper">
                                            <span class="meta-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"><path fill="#1A1A1B" d="M14.7272727,11.1763636 C14.7272727,10.7244943 15.0935852,10.3581818 15.5454545,10.3581818 C15.9973239,10.3581818 16.3636364,10.7244943 16.3636364,11.1763636 L16.3636364,15.5454545 C16.3636364,16.9010626 15.2646989,18 13.9090909,18 L2.45454545,18 C1.09893743,18 0,16.9010626 0,15.5454545 L0,4.09090909 C0,2.73530107 1.09893743,1.63636364 2.45454545,1.63636364 L6.82363636,1.63636364 C7.2755057,1.63636364 7.64181818,2.00267611 7.64181818,2.45454545 C7.64181818,2.9064148 7.2755057,3.27272727 6.82363636,3.27272727 L2.45454545,3.27272727 C2.00267611,3.27272727 1.63636364,3.63903975 1.63636364,4.09090909 L1.63636364,15.5454545 C1.63636364,15.9973239 2.00267611,16.3636364 2.45454545,16.3636364 L13.9090909,16.3636364 C14.3609602,16.3636364 14.7272727,15.9973239 14.7272727,15.5454545 L14.7272727,11.1763636 Z M6.54545455,9.33890201 L6.54545455,11.4545455 L8.66109799,11.4545455 L16.0247344,4.09090909 L13.9090909,1.97526564 L6.54545455,9.33890201 Z M14.4876328,0.239639906 L17.7603601,3.51236718 C18.07988,3.83188705 18.07988,4.34993113 17.7603601,4.669451 L9.57854191,12.8512692 C9.42510306,13.004708 9.21699531,13.0909091 9,13.0909091 L5.72727273,13.0909091 C5.27540339,13.0909091 4.90909091,12.7245966 4.90909091,12.2727273 L4.90909091,9 C4.90909091,8.78300469 4.99529196,8.57489694 5.14873082,8.42145809 L13.330549,0.239639906 C13.6500689,-0.0798799688 14.1681129,-0.0798799688 14.4876328,0.239639906 Z"/></svg>						
                                            </span>
                                            <span class="meta-text">
                                                <?php tainacan_the_item_edit_link(null, ''); ?>					
                                            </span>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>

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
<?php do_action( 'blocksy-tainacan-single-item-top' ); ?>

<?php
    do_action( 'blocksy-tainacan-single-item-after-title' );

    echo '<div class="single-item-data-section">';

    switch (get_theme_mod( 'tainacan_single_item_layout_sections_order', 'document-attachments-metadata')) {
        case 'document-attachments-metadata':
            get_template_part( 'template-parts/single-items-document' );
            do_action( 'blocksy-tainacan-single-item-after-document' );  

            get_template_part( 'template-parts/single-items-attachments' );
            do_action( 'blocksy-tainacan-single-item-after-attachments' );
            
            get_template_part( 'template-parts/single-items-metadata' );
            do_action( 'blocksy-tainacan-single-item-after-metadata' );
        break;

        case 'metadata-document-attachments':
            get_template_part( 'template-parts/single-items-metadata' );
            do_action( 'blocksy-tainacan-single-item-after-metadata' );

            get_template_part( 'template-parts/single-items-document' );
            do_action( 'blocksy-tainacan-single-item-after-document' );  

            get_template_part( 'template-parts/single-items-attachments' );
            do_action( 'blocksy-tainacan-single-item-after-attachments' );
        break;

        case 'document-metadata-attachments':
            get_template_part( 'template-parts/single-items-document' );
            do_action( 'blocksy-tainacan-single-item-after-document' );

            get_template_part( 'template-parts/single-items-metadata' );
            do_action( 'blocksy-tainacan-single-item-after-metadata' );  

            get_template_part( 'template-parts/single-items-attachments' );
            do_action( 'blocksy-tainacan-single-item-after-attachments' );
        break;
            
    }
    echo '</div>';
?>

<?php get_template_part( 'template-parts/single-items-navigation' ); ?>

<?php do_action( 'blocksy-tainacan-single-item-bottom' ); ?>
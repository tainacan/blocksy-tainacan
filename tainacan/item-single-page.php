<?php
/**
 * The template for displaying all single items
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BlocksyTainacan
 */

$prefix = blocksy_manager()->screen->get_prefix();

do_action( 'blocksy-tainacan-single-item-top' ); 

do_action( 'blocksy-tainacan-single-item-after-title' );

echo '<div class="tainacan-item-single tainacan-item-single--layout-'. get_theme_mod( $prefix . '_page_structure_type', 'type-dam') . '">';

    get_template_part( 'template-parts/tainacan-item-single-document' );
    do_action( 'blocksy-tainacan-single-item-after-document' );  

    get_template_part( 'template-parts/tainacan-item-single-attachments' );
    do_action( 'blocksy-tainacan-single-item-after-attachments' );
    
    get_template_part( 'template-parts/tainacan-item-single-metadata' );
    do_action( 'blocksy-tainacan-single-item-after-metadata' );

echo '</div>';

do_action( 'blocksy-tainacan-single-item-bottom' ); ?>

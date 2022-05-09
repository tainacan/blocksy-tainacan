<?php
    if ( function_exists('tainacan_get_the_metadata_sections') ) { //if (version_compare(TAINACAN_VERSION, '0.19RC') >= 0) {
        tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-metadata_new' );
    } else {
        tainacan_blocksy_get_template_part( 'template-parts/tainacan-item-single-metadata_old' );
    }
?>
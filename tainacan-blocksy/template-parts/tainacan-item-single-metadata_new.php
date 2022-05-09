<?php 
    $prefix = blocksy_manager()->screen->get_prefix(); 

    $metadata_args = array(
        'display_slug_as_class' => true,
        'before_title' => '<h3 class="tainacan-metadata-label">',
        'after_title' => '</h3>',
        'before_value' => '<p class="tainacan-metadata-value">',
        'after_value' => '</p>',
        'exclude_title' => (get_theme_mod($prefix . '_show_title_metadata', 'yes') === 'no')
    );
    $args = array(
        'before' => '<section class="tainacan-item-section tainacan-item-section--metadata">',
        'after' => '</section>',
        'before_name' => '<h2 class="tainacan-single-item-section">',
        'after_name' => '</h2>',
        'hide_name' => !get_theme_mod($prefix . '_display_section_labels', 'yes') == 'yes',
        'before_metadata_list' => do_action( 'tainacan-blocksy-single-item-metadata-begin' ) . '<div class="tainacan-item-section__metadata ' . get_theme_mod($prefix . '_metadata_list_structure_type', 'metadata-type-1') . '">',
        'after_metadata_list' => '</div>' . do_action( 'tainacan-blocksy-single-item-metadata-end' ),
        'metadata_list_args' => $metadata_args
    );
    
    echo '<div class="tainacan-metadata-sections-container">';
    tainacan_the_metadata_sections( $args );
    echo '</div>';
?>

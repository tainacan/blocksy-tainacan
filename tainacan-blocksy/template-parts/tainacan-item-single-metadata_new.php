<?php 
    $prefix = blocksy_manager()->screen->get_prefix(); 

    /** 
     * The new metadata sections function makes it a bit more complicated to add
     * the thumbnail in the middle of the metadata.
     * So we have some logic that is only needed if it is set.
     * The following uses a filter to add it right above the first metadatum in the first section.
     **/

    if ( has_post_thumbnail() && (get_theme_mod($prefix . '_show_thumbnail', 'no') === 'yes') ) {

        // Gets collection so we can obtain firtst metadatum
        $collection = tainacan_get_collection();

        if ( !is_null($collection) ) {

            // Gets array of metadata order
            $metadata_order = $collection->get_metadata_order();

            if ( is_array($metadata_order) ) {

                $first_metadatum_id = -1;

                foreach( $metadata_order as $metadatum ) {

                    // Checks if the metadata is enabled
                    if ( isset($metadatum['enabled']) && $metadatum['enabled'] && isset($metadatum['id']) ) {
                        $first_metadatum_id = $metadatum['id'];

                        // IF we are not displaying the title here, we must look for the second metadata
                        if ( get_theme_mod($prefix . '_show_title_metadata', 'yes') === 'no' ) {

                            $Tainacan_Metadata = \Tainacan\Repositories\Metadata::get_instance();
                            $metadatum_object = $Tainacan_Metadata->fetch($first_metadatum_id);
                            $metadata_type_object = $metadatum_object->get_metadata_type_object();

                            if ( $metadata_type_object->get_related_mapped_prop() == 'title' ) {
                                continue;
                            }
                        }

                        break;
                    }
                }

                if ( is_numeric($first_metadatum_id) && $first_metadatum_id >= 0 ) {

                    add_filter('tainacan-get-item-metadatum-as-html-before--id-' . $first_metadatum_id, function($before, $item_metadatum) {

                        ob_start();
                        ?>
                            <div class="tainacan-item-section__metadata-thumbnail">
                                <h3 class="tainacan-metadata-label"><?php _e( 'Thumbnail', 'tainacan-blocksy' ); ?></h3>
                                <p class="tainacan-metadata-value"><?php the_post_thumbnail('tainacan-medium-full'); ?></p>
                            </div>
                        <?php
                
                        $extra_content = ob_get_contents();
                        ob_end_clean();
                
                        return $extra_content . $before;
                
                    }, 10, 2);
                }
            }
        }
    }

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

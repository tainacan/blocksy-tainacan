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
        'before' 				=> '<div class="tainacan-item-section__metadatum metadata-type-$type" id="$id">',
		'after' 				=> '</div>',
        'before_title' => '<h3 class="tainacan-metadata-label">',
        'after_title' => '</h3>',
        'before_value' => '<p class="tainacan-metadata-value">',
        'after_value' => '</p>',
        'exclude_title' => (get_theme_mod($prefix . '_show_title_metadata', 'yes') === 'no')
    );


    $section_layout = get_theme_mod($prefix . '_metadata_sections_layout_type', 'metadata-section-type-1');
    
    if ( $section_layout == 'metadata-section-type-2') {

        add_filter('tainacan-get-metadata-section-as-html-before-name--index-0', function($before, $item_metadatum) {
            return str_replace('<input', '<input checked="checked"', $before);
        }, 10, 2);

        $args = array(
            'before' => '',
            'after' => '',
            'before_name' => '<input name="tabs" type="radio" id="tab-section-$id" />
                        <label for="tab-section-$id">
                            <h2 class="tainacan-single-item-section" id="metadata-section-$slug">',
            'after_name' => '</h2>
                        </label>',
            'before_metadata_list' => '<section class="tainacan-item-section tainacan-item-section--metadata">' . do_action( 'tainacan-blocksy-single-item-metadata-begin' ) . '
                    <div class="tainacan-item-section__metadata ' . get_theme_mod($prefix . '_metadata_list_structure_type', 'metadata-type-1') . '" aria-labelledby="metadata-section-$slug">',
            'after_metadata_list' => '</div>' . do_action( 'tainacan-blocksy-single-item-metadata-end' ) . '</section>',
            'metadata_list_args' => $metadata_args
        );
        
        echo '<div class="tainacan-metadata-sections-container metadata-section-layout--tabs">';
        tainacan_the_metadata_sections( $args );
        echo '</div>';

    } else  if ( $section_layout == 'metadata-section-type-3') {

        add_filter('tainacan-get-metadata-section-as-html-before-name--index-0', function($before, $item_metadatum) {
            return str_replace('<input', '<input checked="checked"', $before);
        }, 10, 2);

        $args = array(
            'before' => '',
            'after' => '',
            'before_name' => '<input name="collapses" type="checkbox" id="collapse-section-$id"/>
                        <label for="collapse-section-$id">
                            <i class="tainacan-icon tainacan-icon-arrowright"></i>
                            <h2 class="tainacan-single-item-section" id="metadata-section-$slug">',
            'after_name' => '</h2>
                        </label>',
            'before_metadata_list' => '<section class="tainacan-item-section tainacan-item-section--metadata">' . do_action( 'tainacan-blocksy-single-item-metadata-begin' ) . '
                <div class="tainacan-item-section__metadata ' . get_theme_mod($prefix . '_metadata_list_structure_type', 'metadata-type-1') . '" aria-labelledby="metadata-section-$slug">',
            'after_metadata_list' => '</div>' . do_action( 'tainacan-blocksy-single-item-metadata-end' ) . '</section>',
            'metadata_list_args' => $metadata_args
        );

        echo '<div class="tainacan-metadata-sections-container metadata-section-layout--collapses">';
        tainacan_the_metadata_sections( $args );
        echo '</div>';

    } else if ( $section_layout == 'metadata-section-type-4') {

        add_filter('tainacan-get-metadata-section-as-html-before-name--index-0', function($before, $item_metadatum) {
            return str_replace('<input', '<input checked="checked"', $before);
        }, 10, 2);

        $args = array(
            'before' => '',
            'after' => '',
            'before_name' => '<input name="accordion" type="radio" id="accordion-section-$id"/>
                        <label for="accordion-section-$id">
                            <i class="tainacan-icon tainacan-icon-arrowright"></i>
                            <h2 class="tainacan-single-item-section" id="metadata-section-$slug">',
            'after_name' => '</h2>
                        </label>',
            'before_metadata_list' => '<section class="tainacan-item-section tainacan-item-section--metadata">' . do_action( 'tainacan-blocksy-single-item-metadata-begin' ) . '
                <div class="tainacan-item-section__metadata ' . get_theme_mod($prefix . '_metadata_list_structure_type', 'metadata-type-1') . '" aria-labelledby="metadata-section-$slug">',
            'after_metadata_list' => '</div>' . do_action( 'tainacan-blocksy-single-item-metadata-end' ) . '</section>',
            'metadata_list_args' => $metadata_args
        );

        echo '<div class="tainacan-metadata-sections-container metadata-section-layout--accordion">';
        tainacan_the_metadata_sections( $args );
        echo '</div>';

    } else {
        $args = array(
            'before' => '<section class="tainacan-item-section tainacan-item-section--metadata">',
            'after' => '</section>',
            'before_name' => '<h2 class="tainacan-single-item-section" id="metadata-section-$slug">',
            'after_name' => '</h2>',
            'hide_name' => !get_theme_mod($prefix . '_display_section_labels', 'yes') == 'yes',
            'before_metadata_list' => do_action( 'tainacan-blocksy-single-item-metadata-begin' ) . '<div class="tainacan-item-section__metadata ' . get_theme_mod($prefix . '_metadata_list_structure_type', 'metadata-type-1') . '">',
            'after_metadata_list' => '</div>' . do_action( 'tainacan-blocksy-single-item-metadata-end' ),
            'metadata_list_args' => $metadata_args
        );
        
        echo '<div class="tainacan-metadata-sections-container">';
        tainacan_the_metadata_sections( $args );
        echo '</div>';
    }
?>

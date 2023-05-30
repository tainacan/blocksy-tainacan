<?php 
    $prefix = blocksy_manager()->screen->get_prefix();
    
    $section_layout = get_theme_mod($prefix . '_metadata_sections_layout_type', 'metadata-section-type-1');
    $exclude_title_metadata = get_theme_mod($prefix . '_show_title_metadata', 'yes') === 'no';
    $show_thumbnail_with_metadata = get_theme_mod($prefix . '_show_thumbnail', 'no') === 'yes';
    $metadata_list_structure_type = get_theme_mod($prefix . '_metadata_list_structure_type', 'metadata-type-1');
    $display_section_labels = get_theme_mod($prefix . '_display_section_labels', 'yes') == 'yes';
    $show_default_section_separated =
        in_array($section_layout, ['metadata-section-type-2', 'metadata-section-type-3', 'metadata-section-type-4']) &&
        get_theme_mod($prefix . '_metadata_sections_separate_default_section', 'no') === 'yes';


    /** 
     * The new metadata sections function makes it a bit more complicated to add
     * the thumbnail in the middle of the metadata.
     * So we have some logic that is only needed if it is set.
     * The following uses a filter to add it right above the first metadatum in the default section.
     **/
    if ( has_post_thumbnail() && $show_thumbnail_with_metadata ) {

        add_filter('tainacan-get-metadata-section-as-html-before-metadata-list--index-0', function( $before_description, $metadata_section) {
            
            ob_start();
            ?>
                <div class="tainacan-item-section__metadata-thumbnail">
                    <h3 class="tainacan-metadata-label"><?php _e( 'Thumbnail', 'tainacan-blocksy' ); ?></h3>
                    <p class="tainacan-metadata-value"><?php the_post_thumbnail('tainacan-medium-full'); ?></p>
                </div>
            <?php
    
            $extra_content = ob_get_contents();
            ob_end_clean();
    
            return $before_description . $extra_content;

        }, 10, 2);

    }

    $metadata_args = array(
        'display_slug_as_class' => true,
        'before' 				=> '<div class="tainacan-item-section__metadatum metadata-type-$type" id="$id">',
		'after' 				=> '</div>',
        'before_title' => '<h3 class="tainacan-metadata-label">',
        'after_title' => '</h3>',
        'before_value' => '<p class="tainacan-metadata-value">',
        'after_value' => '</p>',
        'exclude_title' => $exclude_title_metadata
    );

    echo '<div class="tainacan-item-section tainacan-item-section--metadata-sections">';

        if ( $show_default_section_separated ) {
            $sections_args = array(
                'metadata_sections__in' => [ \Tainacan\Entities\Metadata_Section::$default_section_slug ],
                'before' => '<section class="tainacan-item-section tainacan-item-section--metadata">',
                'after' => '</section>',
                'before_name' => '<h2 class="tainacan-single-item-section" id="metadata-section-$slug">',
                'after_name' => '</h2>',
                'hide_name' => !$display_section_labels,
                'before_metadata_list' => do_action( 'tainacan-blocksy-single-item-metadata-begin' ) . '<div class="tainacan-item-section__metadata ' . $metadata_list_structure_type . '">',
                'after_metadata_list' => '</div>' . do_action( 'tainacan-blocksy-single-item-metadata-end' ),
                'metadata_list_args' => $metadata_args
            );
            
            tainacan_the_metadata_sections( $sections_args );
        }
        
        if ( $section_layout == 'metadata-section-type-2') {

            add_filter('tainacan-get-metadata-section-as-html-before-name--index-0', function($before, $item_metadatum) {
                return str_replace('<input', '<input checked="checked"', $before);
            }, 10, 2);

            $sections_args = array(
                'metadata_sections__not_in' => $show_default_section_separated ? [ \Tainacan\Entities\Metadata_Section::$default_section_slug ] : [],
                'before' => '',
                'after' => '',
                'before_name' => '<input name="tabs" type="radio" id="tab-section-$id" />
                            <label for="tab-section-$id">
                                <h2 class="tainacan-single-item-section" id="metadata-section-$slug">',
                'after_name' => '</h2>
                            </label>',
                'before_metadata_list' => '<section class="tainacan-item-section tainacan-item-section--metadata">' . do_action( 'tainacan-blocksy-single-item-metadata-begin' ) . '
                        <div class="tainacan-item-section__metadata ' . $metadata_list_structure_type . '" aria-labelledby="metadata-section-$slug">',
                'after_metadata_list' => '</div>' . do_action( 'tainacan-blocksy-single-item-metadata-end' ) . '</section>',
                'metadata_list_args' => $metadata_args
            );
            
            echo '<div class="metadata-section-layout--tabs">';
            tainacan_the_metadata_sections( $sections_args );
            echo '</div>';

        } else  if ( $section_layout == 'metadata-section-type-3') {

            add_filter('tainacan-get-metadata-section-as-html-before-name--index-0', function($before, $item_metadatum) {
                return str_replace('<input', '<input checked="checked"', $before);
            }, 10, 2);

            $sections_args = array(
                'metadata_sections__not_in' => $show_default_section_separated ? [ \Tainacan\Entities\Metadata_Section::$default_section_slug ] : [],
                'before' => '',
                'after' => '',
                'before_name' => '<input name="collapses" type="checkbox" id="collapse-section-$id"/>
                            <label for="collapse-section-$id">
                                <i class="tainacan-icon tainacan-icon-arrowright"></i>
                                <h2 class="tainacan-single-item-section" id="metadata-section-$slug">',
                'after_name' => '</h2>
                            </label>',
                'before_metadata_list' => '<section class="tainacan-item-section tainacan-item-section--metadata">' . do_action( 'tainacan-blocksy-single-item-metadata-begin' ) . '
                    <div class="tainacan-item-section__metadata ' . $metadata_list_structure_type . '" aria-labelledby="metadata-section-$slug">',
                'after_metadata_list' => '</div>' . do_action( 'tainacan-blocksy-single-item-metadata-end' ) . '</section>',
                'metadata_list_args' => $metadata_args
            );

            echo '<div class="metadata-section-layout--collapses">';
            tainacan_the_metadata_sections( $sections_args );
            echo '</div>';

        } else if ( $section_layout == 'metadata-section-type-4') {

            add_filter('tainacan-get-metadata-section-as-html-before-name--index-0', function($before, $item_metadatum) {
                return str_replace('<input', '<input checked="checked"', $before);
            }, 10, 2);

            $sections_args = array(
                'metadata_sections__not_in' => $show_default_section_separated ? [ \Tainacan\Entities\Metadata_Section::$default_section_slug ] : [],
                'before' => '',
                'after' => '',
                'before_name' => '<input name="accordion" type="radio" id="accordion-section-$id"/>
                            <label for="accordion-section-$id">
                                <i class="tainacan-icon tainacan-icon-arrowright"></i>
                                <h2 class="tainacan-single-item-section" id="metadata-section-$slug">',
                'after_name' => '</h2>
                            </label>',
                'before_metadata_list' => '<section class="tainacan-item-section tainacan-item-section--metadata">' . do_action( 'tainacan-blocksy-single-item-metadata-begin' ) . '
                    <div class="tainacan-item-section__metadata ' . $metadata_list_structure_type . '" aria-labelledby="metadata-section-$slug">',
                'after_metadata_list' => '</div>' . do_action( 'tainacan-blocksy-single-item-metadata-end' ) . '</section>',
                'metadata_list_args' => $metadata_args
            );

            echo '<div class="metadata-section-layout--accordion">';
            tainacan_the_metadata_sections( $sections_args );
            echo '</div>';

        } else {
            $sections_args = array(
                'metadata_sections__not_in' => $show_default_section_separated ? [ \Tainacan\Entities\Metadata_Section::$default_section_slug ] : [],
                'before' => '<section class="tainacan-item-section tainacan-item-section--metadata">',
                'after' => '</section>',
                'before_name' => '<h2 class="tainacan-single-item-section" id="metadata-section-$slug">',
                'after_name' => '</h2>',
                'hide_name' => !$display_section_labels,
                'before_metadata_list' => do_action( 'tainacan-blocksy-single-item-metadata-begin' ) . '<div class="tainacan-item-section__metadata ' . $metadata_list_structure_type . '">',
                'after_metadata_list' => '</div>' . do_action( 'tainacan-blocksy-single-item-metadata-end' ),
                'metadata_list_args' => $metadata_args
            );
            
            tainacan_the_metadata_sections( $sections_args );
        }

    echo '</div>';
?>

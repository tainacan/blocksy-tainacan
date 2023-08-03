<?php 

add_filter('tainacan-default-taxonomy-terms-perpage', function() {
    $prefix = blocksy_manager()->screen->get_prefix();
    return get_theme_mod($prefix . '_archive_per_page', 12);
});

$prefix = blocksy_manager()->screen->get_prefix();

$maybe_custom_output = apply_filters(
	'blocksy:posts-listing:canvas:custom-output',
	null
);

if ($maybe_custom_output) {
	echo $maybe_custom_output;
	return;
}

$container_class = 'ct-container';

$section_class = '';

if ( !have_posts() ) {
	$section_class = 'class="ct-no-results"';
}

$card_elements = get_theme_mod($prefix . '_archive_order', []);

$hierarchy_element = [ 'enabled' => false ];
$name_element = [ 'enabled' => true, 'heading_tag' => 'h2' ];
$description_element = [ 'enabled' => true, 'excerpt_length' => 20 ];
$thumbnail_element = [ 'enabled' => true ];
$children_link_element = [ 'enabled' => true ];
$items_link_element = [ 'enabled' => true ];

foreach( $card_elements as $card_element ) {
    if ( $card_element['id'] == 'hierarchy_path' )
        $hierarchy_element = $card_element;
    if ( $card_element['id'] == 'title' )
        $name_element = $card_element;
    if ( $card_element['id'] == 'excerpt' )
        $description_element = $card_element;
    if ( $card_element['id'] == 'featured_image' )
        $thumbnail_element = $card_element;
    if ( $card_element['id'] == 'children_link' )
        $children_link_element = $card_element;
    if ( $card_element['id'] == 'items_link' )
        $items_link_element = $card_element;
}

$is_image_boundless = (isset($thumbnail_element['is_boundless']) ? $thumbnail_element['is_boundless'] == 'yes' : true) && (get_theme_mod($prefix . '_card_type', 'boxed') === 'boxed');
$image_size = isset($thumbnail_element['image_size']) ? $thumbnail_element['image_size'] : 'tainacan-large-full';
$hide_term_children_count = (isset($children_link_element['show_term_children_count']) ? $children_link_element['show_term_children_count'] == 'no' : true);
$hide_term_items_count = (isset($items_link_element['show_term_items_count']) ? $items_link_element['show_term_items_count'] == 'no' : true);

?>

<div class="<?php echo $container_class ?>" <?php echo wp_kses_post(blocksy_sidebar_position_attr()); ?> <?php echo blocksy_get_v_spacing() ?>>
	<section <?php echo $section_class ?>>
		<?php

            global $wp_query;

            echo '<div id="tainacan-taxonomy-terms-list-form" class="wp-block-group is-wrap is-layout-flex" style="">';
            tainacan_the_taxonomies_orderby();
            tainacan_the_taxonomies_search( [ 'hide_label' => true ] );
            echo '</div>';

            $args = [];

            $args = wp_parse_args(
                $args,
                [
                    'query' => $wp_query,
                    'prefix' => $prefix,
                    'has_pagination' => true
                ]
            );

            $blog_post_structure = get_theme_mod( $prefix . '_structure', 'simple');
            if ( $blog_post_structure === 'type-4' )
                $blog_post_structure = 'simple';

            if ($args['query']->have_posts()) {

                $entries_open = '<div class="entries" ';

                $container_output = apply_filters(
                    'blocksy:posts-listing:container:custom-output',
                    null
                );

                $has_cards_type = true;

                if ($container_output) {
                    $hook_id = blc_get_content_block_that_matches([
                        'template_type' => 'archive'
                    ]);

                    $atts = blocksy_get_post_options($hook_id);

                    if (blocksy_akg(
                        'has_template_default_layout',
                        $atts,
                        'yes'
                    ) !== 'yes') {
                        $has_cards_type = false;
                    }

                    $entries_open .= 'data-archive="custom"';
                } else {
                    $entries_open .= 'data-archive="default"';
                }

                $entries_open .= ' data-layout="' . esc_attr($blog_post_structure) . '"';

                if ($has_cards_type) {
                    $card_type = blocksy_get_listing_card_type([
                        'prefix' => $prefix
                    ]);

                    if ($card_type) {
                        $entries_open .= ' ' . 'data-cards="' . $card_type . '"';
                    }
                }
                
                $entries_open .= ' ' . blocksy_schema_org_definitions('blog');

                $archive_order = get_theme_mod(
                    $prefix . '_archive_order',
                    []
                );

                foreach ($archive_order as $archive_layer) {
                    if (! $archive_layer['enabled']) {
                        continue;
                    }
    
                    if ($archive_layer['id'] === 'featured_image') {
                        $hover_effect = blocksy_akg(
                            'image_hover_effect',
                            $archive_layer,
                            'none'
                        );
    
                        if ($hover_effect !== 'none') {
                            $entries_open .= ' data-hover="' . $hover_effect . '"';
                        }
                    }
                }

                $entries_open .= ' ' . blocksy_generic_get_deep_link([
                    'prefix' => $prefix
                ]) . '>';
    
                do_action('blocksy:loop:before');

                $data_reveal_output = '';

                if (get_theme_mod(
                    blocksy_manager()->screen->process_allowed_prefixes(
                        $args['prefix'],
                        [
                            'allowed_prefixes' => ['blog'],
                            'default_prefix' => 'blog'
                        ]
                    ) . '_has_posts_reveal',
                    'no'
                ) === 'yes') {
                    $data_reveal_output = 'data-reveal="bottom:no"';
                }
        
                $entry_open = '<article id="term-id-$id" class="entry-card tainacan-term post type-tainacan-term status-publish format-standard hentry"';
                $entry_open .= ' ' . wp_kses_post($data_reveal_output);
                $entry_open .= '>';

                while (have_posts()) {
                    the_post();
                    global $post;
                    
                    $taxonomy_terms_list = tainacan_get_single_taxonomy_content($post, array(
                        'before_terms_list' => $entries_open,
                        'after_term_list' => '</div>',
                        'before_term' => '<article id="term-id-$id" class="entry-card post type-post status-publish format-standard hentry">',
                        'after_term' => '</article>',
                        'before_term_name' => '<' . $name_element['heading_tag'] . ' class="term-name entry-title">',
		                'after_term_name' => '</' . $name_element['heading_tag'] . '>',
                        'before_term_description' => '<div class="term-description entry-excerpt"><p>',
                        'after_term_description' => '</p></div>',
                        'before_term_information' => '<div class="card-content term-information">',
                        'after_term_information' => '</div>',
                        'before_term_links' => '<ul class="entry-meta term-links">',
                        'after_term_links' => '</ul>',
                        'before_term_children_link' => '<li class="meta-author term-children-link">',
                        'after_term_children_link' => '</li>',
                        'before_term_items_link' => '<li class="meta-date term-items-link">',
                        'after_term_items_link' => '</li>',
                        'before_term_thumbnail' => '<figure class="term-thumbnail ct-image-container ct-media-container' . ( $is_image_boundless ? 'boundless-image' : '' ) .'">',
		                'after_term_thumbnail' => '</figure>',
                        'hide_term_children_count' => $hide_term_children_count,
                        'hide_term_items_count' => $hide_term_items_count,
                        'term_items_count_position' => 'before',
                        'term_children_count_position' => 'before',
                        'hide_term_hierarchy_path' => !$hierarchy_element['enabled'],
                        'hide_term_name' => !$name_element['enabled'],
                        'hide_term_thumbnail' => !$thumbnail_element['enabled'],
                        'hide_term_description' => !$description_element['enabled'],
                        'hide_term_children_link' => !$children_link_element['enabled'],
                        'hide_term_items_link' => !$items_link_element['enabled'],
                        'hide_term_thumbnail_placeholder' => false,
                        'thumbnails_size' => $image_size,
                        'trim_description_words' => isset($description_element['excerpt_length']) ? (int)$description_element['excerpt_length'] : 20
                    ));
                    echo $taxonomy_terms_list['content'];
                }

                do_action('blocksy:loop:after');

                blocksy_tainacan_the_taxonomies_pagination($taxonomy_terms_list['total_terms']);

                /**
                 * Note to code reviewers: This line doesn't need to be escaped.
                 * Function blocksy_display_posts_pagination() used here escapes the value properly.
                 */
                if ($args['has_pagination']) {
                    echo blocksy_display_posts_pagination([
                        'query' => $args['query'],
                        'prefix' => $prefix
                    ]);
                }

            } else {
                get_template_part('template-parts/content', 'none');
            }

		?>
	</section>

	<?php get_sidebar(); ?>
</div>

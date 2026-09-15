<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Invokes Blocksy theme and Tainacan core hooks.

add_filter('tainacan-default-taxonomy-terms-perpage', function() {
    $tainacan_blocksy_prefix = blocksy_manager()->screen->get_prefix();
    return get_theme_mod($tainacan_blocksy_prefix . '_archive_per_page', 12);
});

$tainacan_blocksy_prefix = blocksy_manager()->screen->get_prefix();

$tainacan_blocksy_maybe_custom_output = apply_filters(
	'blocksy:posts-listing:canvas:custom-output',
	null
);

if ($tainacan_blocksy_maybe_custom_output) {
	/**
	 * Note to code reviewers: This line doesn't need to be escaped.
	 * The blocksy:posts-listing:canvas:custom-output filter provides HTML that is escaped by Blocksy.
	 */
	echo $tainacan_blocksy_maybe_custom_output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}

$tainacan_blocksy_container_class = 'ct-container';

$tainacan_blocksy_section_class = '';

if ( ! have_posts() ) {
	$tainacan_blocksy_section_class = 'ct-no-results';
}

$tainacan_blocksy_card_elements = blocksy_get_theme_mod($tainacan_blocksy_prefix . '_archive_order', []);

$tainacan_blocksy_hierarchy_element = [ 'enabled' => false ];
$tainacan_blocksy_name_element = [ 'enabled' => true, 'heading_tag' => 'h2' ];
$tainacan_blocksy_description_element = [ 'enabled' => true, 'excerpt_length' => 20 ];
$tainacan_blocksy_thumbnail_element = [ 'enabled' => true ];
$tainacan_blocksy_children_link_element = [ 'enabled' => true ];
$tainacan_blocksy_items_link_element = [ 'enabled' => true ];

foreach( $tainacan_blocksy_card_elements as $tainacan_blocksy_card_element ) {
    if ( $tainacan_blocksy_card_element['id'] == 'hierarchy_path' )
        $tainacan_blocksy_hierarchy_element = $tainacan_blocksy_card_element;
    if ( $tainacan_blocksy_card_element['id'] == 'title' )
        $tainacan_blocksy_name_element = $tainacan_blocksy_card_element;
    if ( $tainacan_blocksy_card_element['id'] == 'excerpt' )
        $tainacan_blocksy_description_element = $tainacan_blocksy_card_element;
    if ( $tainacan_blocksy_card_element['id'] == 'featured_image' )
        $tainacan_blocksy_thumbnail_element = $tainacan_blocksy_card_element;
    if ( $tainacan_blocksy_card_element['id'] == 'children_link' )
        $tainacan_blocksy_children_link_element = $tainacan_blocksy_card_element;
    if ( $tainacan_blocksy_card_element['id'] == 'items_link' )
        $tainacan_blocksy_items_link_element = $tainacan_blocksy_card_element;
}

$tainacan_blocksy_is_image_boundless = (isset($tainacan_blocksy_thumbnail_element['is_boundless']) ? $tainacan_blocksy_thumbnail_element['is_boundless'] == 'yes' : true) && (get_theme_mod($tainacan_blocksy_prefix . '_card_type', 'boxed') === 'boxed');
$tainacan_blocksy_image_size = isset($tainacan_blocksy_thumbnail_element['image_size']) ? $tainacan_blocksy_thumbnail_element['image_size'] : 'tainacan-large-full';
$tainacan_blocksy_hide_term_children_count = (isset($tainacan_blocksy_children_link_element['show_term_children_count']) ? $tainacan_blocksy_children_link_element['show_term_children_count'] == 'no' : true);
$tainacan_blocksy_hide_term_items_count = (isset($tainacan_blocksy_items_link_element['show_term_items_count']) ? $tainacan_blocksy_items_link_element['show_term_items_count'] == 'no' : true);

?>

<div class="<?php echo esc_attr( $tainacan_blocksy_container_class ); ?>" <?php echo wp_kses( blocksy_sidebar_position_attr(), array() ); ?> <?php echo blocksy_get_v_spacing(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Function blocksy_get_v_spacing() used here escapes the value properly. ?>>
	<section<?php echo $tainacan_blocksy_section_class !== '' ? ' class="' . esc_attr( $tainacan_blocksy_section_class ) . '"' : ''; ?>>
		<?php

            global $wp_query;

            echo '<div id="tainacan-taxonomy-terms-list-form" class="wp-block-group is-wrap is-layout-flex" style="">';
            tainacan_the_taxonomies_orderby();
            tainacan_the_taxonomies_search( [ 'hide_label' => true ] );
            echo '</div>';

            $tainacan_blocksy_args = wp_parse_args(
                [],
                [
                    'query' => $wp_query,
                    'prefix' => $tainacan_blocksy_prefix,
                    'has_pagination' => true,
                    'pagination_args' => [],
                ]
            );

            if ($tainacan_blocksy_args['query']->have_posts()) {

                wp_enqueue_style('ct-entries-styles');

                // Tainacan terms archive: keep prior behaviour (default `simple`, map type-4 → simple).
                // Differs from blocksy_listing_page_structure(), which defaults to `grid`.
                $tainacan_blocksy_blog_post_structure = blocksy_get_theme_mod(
                    $tainacan_blocksy_args['prefix'] . '_structure',
                    'simple'
                );

                if ($tainacan_blocksy_blog_post_structure === 'type-4') {
                    $tainacan_blocksy_blog_post_structure = 'simple';
                }

                $tainacan_blocksy_is_simple_layout = $tainacan_blocksy_blog_post_structure === 'simple';

                $tainacan_blocksy_entries_open = [
                    'class' => 'entries',
                ];

                $tainacan_blocksy_container_output = apply_filters(
                    'blocksy:posts-listing:container:custom-output',
                    null
                );

                $tainacan_blocksy_has_cards_type = true;

                if ($tainacan_blocksy_container_output && function_exists('blocksy_companion_get_content_block_that_matches')) {
                    $tainacan_blocksy_hook_id = blocksy_companion_get_content_block_that_matches([
                        'template_type' => 'archive',
                    ]);

                    $tainacan_blocksy_atts = blocksy_get_post_options($tainacan_blocksy_hook_id);

                    if (blocksy_akg(
                        'has_template_default_layout',
                        $tainacan_blocksy_atts,
                        'yes'
                    ) !== 'yes') {
                        $tainacan_blocksy_has_cards_type = false;
                    }

                    $tainacan_blocksy_entries_open['data-archive'] = 'custom';
                } else {
                    $tainacan_blocksy_entries_open['data-archive'] = 'default';
                }

                $tainacan_blocksy_entries_open['data-layout'] = esc_attr($tainacan_blocksy_blog_post_structure);

                if ($tainacan_blocksy_has_cards_type) {
                    $tainacan_blocksy_card_type = blocksy_get_listing_card_type([
                        'prefix' => $tainacan_blocksy_args['prefix'],
                    ]);

                    if ($tainacan_blocksy_card_type) {
                        $tainacan_blocksy_entries_open['data-cards'] = $tainacan_blocksy_card_type;
                    }
                }

                $tainacan_blocksy_entries_open = array_merge(
                    $tainacan_blocksy_entries_open,
                    blocksy_schema_org_definitions('blog', [
                        'array' => true,
                    ])
                );

                $tainacan_blocksy_archive_order = blocksy_get_theme_mod(
                    $tainacan_blocksy_args['prefix'] . '_archive_order',
                    []
                );

                foreach ($tainacan_blocksy_archive_order as $tainacan_blocksy_archive_layer) {
                    if (! $tainacan_blocksy_archive_layer['enabled']) {
                        continue;
                    }

                    if ($tainacan_blocksy_archive_layer['id'] === 'featured_image') {
                        $tainacan_blocksy_hover_effect = blocksy_akg(
                            'image_hover_effect',
                            $tainacan_blocksy_archive_layer,
                            'none'
                        );

                        if ($tainacan_blocksy_hover_effect !== 'none') {
                            $tainacan_blocksy_entries_open['data-hover'] = $tainacan_blocksy_hover_effect;
                        }
                    }
                }

                $tainacan_blocksy_entries_open = array_merge(
                    $tainacan_blocksy_entries_open,
                    blocksy_generic_get_deep_link([
                        'prefix' => $tainacan_blocksy_args['prefix'],
                        'return' => 'array',
                    ])
                );

                $tainacan_blocksy_entries_open_html = '<div ' . blocksy_attr_to_html($tainacan_blocksy_entries_open) . '>';

                do_action('blocksy:loop:before');

                $tainacan_blocksy_data_reveal_output = '';

                if (blocksy_get_theme_mod(
                    blocksy_manager()->screen->process_allowed_prefixes(
                        $tainacan_blocksy_args['prefix'],
                        [
                            'allowed_prefixes' => ['blog'],
                            'default_prefix' => 'blog',
                        ]
                    ) . '_has_posts_reveal',
                    'no'
                ) === 'yes') {
                    $tainacan_blocksy_data_reveal_output = 'data-reveal="bottom:no"';
                }

                // Match Blocksy's own archive-card structure so its entries stylesheet and
                // Customizer-generated card variables can style taxonomy terms as well.
                $tainacan_blocksy_term_card_classes = get_post_class('entry-card tainacan-term');
                if (!$tainacan_blocksy_is_simple_layout) {
                    $tainacan_blocksy_term_card_classes[] = 'card-content';
                    $tainacan_blocksy_term_card_classes[] = 'term-information';
                }

                $tainacan_blocksy_before_term = '<article id="term-id-$id" class="' . esc_attr(implode(' ', $tainacan_blocksy_term_card_classes)) . '"';
                if ($tainacan_blocksy_data_reveal_output !== '') {
                    $tainacan_blocksy_before_term .= ' ' . $tainacan_blocksy_data_reveal_output;
                }
                $tainacan_blocksy_before_term .= '>';

                $tainacan_blocksy_before_term_information = $tainacan_blocksy_is_simple_layout ? '<div class="card-content term-information">' : '';
                $tainacan_blocksy_after_term_information = $tainacan_blocksy_is_simple_layout ? '</div>' : '';

                $tainacan_blocksy_term_thumbnail_classes = ['term-thumbnail', 'ct-media-container'];
                if ($tainacan_blocksy_is_image_boundless) {
                    $tainacan_blocksy_term_thumbnail_classes[] = 'boundless-image';
                }
                if (isset($tainacan_blocksy_entries_open['data-hover'])) {
                    $tainacan_blocksy_term_thumbnail_classes[] = 'has-hover-effect';
                }

                while ($tainacan_blocksy_args['query']->have_posts()) {
                    $tainacan_blocksy_args['query']->the_post();
                    global $post;

                    $tainacan_blocksy_taxonomy_terms_list = tainacan_get_single_taxonomy_content($post, array(
                        'before_terms_list' => $tainacan_blocksy_entries_open_html,
                        'after_term_list' => '</div>',
                        'before_term' => $tainacan_blocksy_before_term,
                        'after_term' => '</article>',
                        'before_term_name' => '<' . $tainacan_blocksy_name_element['heading_tag'] . ' class="term-name entry-title">',
		                'after_term_name' => '</' . $tainacan_blocksy_name_element['heading_tag'] . '>',
                        'before_term_description' => '<div class="term-description entry-excerpt"><p>',
                        'after_term_description' => '</p></div>',
                        'before_term_information' => $tainacan_blocksy_before_term_information,
                        'after_term_information' => $tainacan_blocksy_after_term_information,
                        'before_term_links' => '<ul class="entry-meta term-links">',
                        'after_term_links' => '</ul>',
                        'before_term_children_link' => '<li class="meta-author term-children-link">',
                        'after_term_children_link' => '</li>',
                        'before_term_items_link' => '<li class="meta-date term-items-link">',
                        'after_term_items_link' => '</li>',
                        'before_term_thumbnail' => '<figure class="' . esc_attr(implode(' ', $tainacan_blocksy_term_thumbnail_classes)) . '">',
		                'after_term_thumbnail' => '</figure>',
                        'hide_term_children_count' => $tainacan_blocksy_hide_term_children_count,
                        'hide_term_items_count' => $tainacan_blocksy_hide_term_items_count,
                        'term_items_count_position' => 'before',
                        'term_children_count_position' => 'before',
                        'hide_term_hierarchy_path' => !$tainacan_blocksy_hierarchy_element['enabled'],
                        'hide_term_name' => !$tainacan_blocksy_name_element['enabled'],
                        'hide_term_thumbnail' => !$tainacan_blocksy_thumbnail_element['enabled'],
                        'hide_term_description' => !$tainacan_blocksy_description_element['enabled'],
                        'hide_term_children_link' => !$tainacan_blocksy_children_link_element['enabled'],
                        'hide_term_items_link' => !$tainacan_blocksy_items_link_element['enabled'],
                        'hide_term_thumbnail_placeholder' => false,
                        'thumbnails_size' => $tainacan_blocksy_image_size,
                        'trim_description_words' => isset($tainacan_blocksy_description_element['excerpt_length']) ? (int)$tainacan_blocksy_description_element['excerpt_length'] : 20
                    ));
                    /**
                     * Note to code reviewers: This line doesn't need to be escaped.
                     * Function tainacan_get_single_taxonomy_content() used here escapes the value properly.
                     */
                    echo $tainacan_blocksy_taxonomy_terms_list['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }

                do_action('blocksy:loop:after');

                blocksy_tainacan_the_taxonomies_pagination($tainacan_blocksy_taxonomy_terms_list['total_terms']);

                /**
                 * Note to code reviewers: This line doesn't need to be escaped.
                 * Function blocksy_display_posts_pagination() used here escapes the value properly.
                 */
                if ($tainacan_blocksy_args['has_pagination']) {
                    $tainacan_blocksy_args['pagination_args']['query'] = $tainacan_blocksy_args['query'];
                    $tainacan_blocksy_args['pagination_args']['prefix'] = $tainacan_blocksy_args['prefix'];

                    echo blocksy_display_posts_pagination($tainacan_blocksy_args['pagination_args']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }

            } else {
                get_template_part('template-parts/content', 'none');
            }

		?>
	</section>

	<?php get_sidebar(); ?>
</div>

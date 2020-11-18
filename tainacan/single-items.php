<?php
/**
 * The template for displaying all single items
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BlocksyTainacan
 */

get_header();

if (
	! function_exists('elementor_theme_do_location')
	||
	! elementor_theme_do_location('single')
) {
        
    if (
        blocksy_default_akg(
            'page_structure_type',
            blocksy_get_post_options(),
            'default'
        ) !== 'default'
        &&
        is_customize_preview()
    ) {
        blocksy_add_customizer_preview_cache(
            function () {
                return blocksy_html_tag(
                    'div',
                    [
                        'data-structure-custom' => blocksy_default_akg(
                            'page_structure_type',
                            blocksy_get_post_options(),
                            'default'
                        )
                    ],
                    ''
                );
            }
        );
    }
    
    if (have_posts()) {
        the_post();
    }
    
    /**
     * Note to code reviewers: This line doesn't need to be escaped.
     * Function blocksy_output_hero_section() used here escapes the value properly.
     */
    echo blocksy_output_hero_section('type-2');
    
    $container_class = 'ct-container';
    
    if (blocksy_get_page_structure() === 'narrow') {
        $container_class = 'ct-container-narrow';
    }
    
    $content_area_class = 'content-area';
    
    $post_content = get_the_content();
    $content_style = blocksy_get_content_style();
    
    if (
        (
            strpos($post_content, 'alignwide') !== false
            ||
            strpos($post_content, 'alignfull') !== false
        )
        &&
        blocksy_sidebar_position() === 'none'
        &&
        blocksy_get_content_style() !== 'boxed'
    ) {
        $content_area_class .= ' content-area-wide';
    }
    
    ?>

        <div id="primary" class="content-area" <?php echo blocksy_get_v_spacing() ?>>
            <div class="<?php echo $container_class ?>" <?php echo wp_kses_post(blocksy_sidebar_position_attr()); ?>>

                <section>
                
                    <?php 
                        $post_options = blocksy_get_post_options();
                           
                        $prefix = blocksy_manager()->screen->get_prefix();
                    
                        $has_share_box = get_theme_mod(
                            $prefix . '_has_share_box',
                            $prefix === 'single_blog_post' ? 'yes' : 'no'
                        ) === 'yes';
                    
                        if (blocksy_is_page()) {
                            $has_share_box = false;
                        }
                    
                        $has_author_box = get_theme_mod(
                            $prefix . '_has_author_box',
                            'no'
                        ) === 'yes';
                    
                        $has_post_tags = get_theme_mod('has_post_tags', 'yes') === 'yes';
                        $has_post_nav = get_theme_mod(
                            $prefix . '_has_post_nav',
                            $prefix === 'single_blog_post' ? 'yes' : 'no'
                        ) === 'yes';
                    
                        if (blocksy_is_page()) {
                            $has_author_box = false;
                            $has_post_nav = false;
                        }
                    
                        if (
                            blocksy_default_akg(
                                'disable_posts_navigation', $post_options, 'no'
                            ) === 'yes'
                        ) {
                            $has_post_nav = false;
                        }
                    
                        if (
                            blocksy_default_akg(
                                'disable_author_box', $post_options, 'no'
                            ) === 'yes'
                        ) {
                            $has_author_box = false;
                        }
                    
                        if (
                            blocksy_default_akg(
                                'disable_post_tags', $post_options, 'no'
                            ) === 'yes'
                        ) {
                            $has_post_tags = false;
                        }
                    
                        if (
                            blocksy_default_akg(
                                'disable_share_box', $post_options, 'no'
                            ) === 'yes'
                        ) {
                            $has_share_box = false;
                        }

                        $featured_image_location = 'none';
                    
                        $page_title_source = blocksy_get_page_title_source();
                        $featured_image_source = blocksy_get_featured_image_source();
                    
                        if ($page_title_source) {
                            $actual_type = blocksy_akg_or_customizer(
                                'hero_section',
                                blocksy_get_page_title_source(),
                                'type-1'
                            );
                    
                            if ($actual_type !== 'type-2') {
                                $featured_image_location = get_theme_mod(
                                    $prefix . '_featured_image_location',
                                    'above'
                                );
                            } else {
                                $featured_image_location = 'below';
                            }
                        } else {
                            $featured_image_location = 'above';
                        }
                    
                        $share_box_type = get_theme_mod($prefix . '_share_box_type', 'type-1');
                    
                        $share_box1_location = get_theme_mod($prefix . '_share_box1_location', [
                            'top' => false,
                            'bottom' => true,
                        ]);
                    
                        $share_box2_location = get_theme_mod($prefix . '_share_box2_location', 'right');

                        $content_editor = blocksy_get_entry_content_editor();
                    
                        $content_class = 'entry-content';
                    
                        if (
                            strpos($content_editor, 'classic') === false
                            &&
                            strpos($content_editor, 'default') === false
                        ) {
                            $content_class = 'ct-builder-content';
                        }
                    
                        ob_start();
                    
                        ?>
                    
                        <article
                            id="post-<?php the_ID(); ?>"
                            <?php post_class(); ?>
                            <?php echo blocksy_get_entry_content_editor() ?>>
                    
                            <?php
                                if ($featured_image_location === 'above') {
                                    echo blocksy_get_featured_image_output();
                                }
                    
                                if (! is_singular([ 'product' ])) {
                                    /**
                                    * Note to code reviewers: This line doesn't need to be escaped.
                                    * Function blocksy_output_hero_section() used here escapes the value properly.
                                    */
                                    echo blocksy_output_hero_section( 'type-1' );
                                }
                    
                                if ($featured_image_location === 'below') {
                                    echo blocksy_get_featured_image_output();
                                }
                            ?>
                    
                            <?php if (
                                (
                                    (
                                        $share_box_type === 'type-1'
                                        &&
                                        $share_box1_location['top']
                                    ) || $share_box_type === 'type-2'
                                )
                                &&
                                $has_share_box
                            ) { ?>
                                <?php
                                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    /**
                                    * Note to code reviewers: This line doesn't need to be escaped.
                                    * Function blocksy_get_social_share_box() used here escapes the value properly.
                                    */
                                    echo blocksy_get_social_share_box([
                                        'html_atts' => $share_box_type === 'type-1' ? [
                                            'data-location' => 'top'
                                        ] : [
                                            'data-location' => $share_box2_location,
                                        ],
                                        'type' => $share_box_type
                                    ]);
                                ?>
                            <?php } ?>
                    
                            <div class="<?php echo $content_class ?>">
                                <?php
                        
                                    do_action( 'blocksy-tainacan-single-item-top' ); 
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

                                <?php do_action( 'blocksy-tainacan-single-item-bottom' ); ?>

                            </div>

                            <?php
                                if (get_post_type() === 'post') {
                                    edit_post_link(
                                        sprintf(
                                            /* translators: %s: Post title. */
                                            __( 'Edit<span class="screen-reader-text"> "%s"</span>', 'blocksy' ),
                                            get_the_title()
                                        )
                                    );
                                }

                                wp_link_pages(
                                    [
                                        'before' => '<div class="page-links"><span class="post-pages-label">' . esc_html__( 'Pages', 'blocksy' ) . '</span>',
                                        'after'  => '</div>',
                                    ]
                                );
                            ?>

                            <?php if (
                                $has_post_tags
                                ||
                                blocksy_is_page()
                            ) { ?>
                                <?php
                                    /**
                                     * Note to code reviewers: This line doesn't need to be escaped.
                                     * Function blocksy_post_meta() used here escapes the value properly.
                                     */
                                    if (blocksy_get_categories_list('', false)) {
                                        echo blocksy_html_tag(
                                            'div',
                                            ['class' => 'entry-tags'],
                                            blocksy_get_categories_list('', false)
                                        );
                                    }
                                ?>
                            <?php } ?>

                            <?php if (
                                $share_box_type === 'type-1'
                                &&
                                $share_box1_location['bottom']
                                &&
                                $has_share_box
                            ) { ?>
                                <?php
                                    /**
                                     * Note to code reviewers: This line doesn't need to be escaped.
                                     * Function blocksy_get_social_share_box() used here escapes the value properly.
                                     */
                                    echo blocksy_get_social_share_box([
                                        'html_atts' => ['data-location' => 'bottom'],
                                        'type' => 'type-1'
                                    ]);
                                ?>
                            <?php } ?>

                            <?php

                            if ($has_author_box) {
                                blocksy_author_box();
                            }

                            if ($has_post_nav) {
                                get_template_part( 'template-parts/single-items-navigation' );
                            }

                            if (function_exists('blc_ext_mailchimp_subscribe_form')) {
                                if (get_post_type() === 'post') {
                                    /**
                                     * Note to code reviewers: This line doesn't need to be escaped.
                                     * Function blc_ext_mailchimp_subscribe_form() used here escapes the value properly.
                                     */
                                    echo blc_ext_mailchimp_subscribe_form();
                                }
                            }

                            blocksy_display_page_elements('contained');

                            ?>

                        </article>

                </section>

                <?php get_sidebar(); ?>

            </div>

        </div>

    <?php

    blocksy_display_page_elements('separated');

    have_posts();
    wp_reset_query();
}

get_footer();
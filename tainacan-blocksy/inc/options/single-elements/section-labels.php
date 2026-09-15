<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals -- Blocksy option include contract ($prefix, $options, $enabled).

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

if (! isset($enabled)) {
	$enabled = 'yes';
}

$options = [
	$prefix . 'display_section_labels' => [
		'label' => __( 'Display section labels', 'tainacan-blocksy' ),
		'type' => 'ct-panel',
		'switch' => true,
		'value' => $enabled,
		'sync' => blocksy_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [
			$prefix . 'tainacan_single_item_section_font' => [
				'type' => 'ct-typography',
				'label' => __( 'Section labels font', 'blocksy' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Blocksy theme translation.
				'value' => blocksy_typography_default_values([
					'size' => '22px',
					'variation' => 'n6',
					'line-height' => '1.3'
				]),
				'sync' => blocksy_sync_single_post_container([
					'prefix' => $prefix
				])
			],
			$prefix . 'tainacan_single_item_section_alignment' => [
				'type' => 'ct-radio',
				'label' => __( 'Section labels text alignment', 'blocksy' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Blocksy theme translation.
				'value' => 'left',
				'view' => 'text',
				'attr' => [ 'data-type' => 'alignment' ],
				'responsive' => true,
				'design' => 'block',
				'choices' => [
					'left' => '',
					'center' => '',
					'right' => '',
				],
				'sync' => blocksy_sync_single_post_container([
					'prefix' => $prefix
				]),
				'divider' => 'bottom',
			],
			blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'document_attachments_structure' => 'gallery-type-1',
                    $prefix . 'page_structure_type' => 'type-dam | type-dma | type-mda | type-gm | type-mg',
				],
				'options' => [
					$prefix . 'section_document_label' => [
						'label' => __( 'Label for the "Document" section', 'tainacan-blocksy' ),
						'desc' => __( 'Leave it blank for not displaying any label.', 'tainacan-blocksy' ),
						'type' => 'text',
						'design' => 'block',
						'value' => __( 'Document', 'tainacan' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
						'sync' => blocksy_sync_single_post_container([
							'prefix' => $prefix
						])
					]
				]
			],
			blocksy_rand_md5() => [
				'type' => 'ct-condition',
				'condition' => [
					$prefix . 'document_attachments_structure' => 'gallery-type-1'
				],
				'options' => [
					$prefix . 'section_attachments_label' => [
						'label' => __( 'Label for the "Attachments" section', 'tainacan-blocksy' ),
						'desc' => __( 'Leave it blank for not displaying any label.', 'tainacan-blocksy' ),
						'type' => 'text',
						'design' => 'block',
						'value' => __( 'Attachments', 'tainacan' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
						'sync' => blocksy_sync_single_post_container([
							'prefix' => $prefix
						])
					]
				]
			],
			blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'document_attachments_structure' => 'gallery-type-2',
					$prefix . 'page_structure_type' => 'type-dam | type-dma | type-mda | type-gm | type-mg'
				],
				'options' => [
					$prefix . 'section_documents_label' => [
						'label' => __( 'Label for the "Documents" section', 'tainacan-blocksy' ),
						'desc' => __( 'Leave it blank for not displaying any label. This section is displayed only if Documents and Attachments are displayed merged.', 'tainacan-blocksy' ),
						'type' => 'text',
						'design' => 'block',
						'value' => __( 'Documents', 'tainacan-blocksy' ),
						'sync' => blocksy_sync_single_post_container([
							'prefix' => $prefix
						])
					]
				]
			],
			$prefix . 'section_metadata_label' => [
				'label' => __( 'Label for the "Metadata" section', 'tainacan-blocksy' ),
				'desc' => __( 'Leave it blank for not displaying any label.', 'tainacan-blocksy' ),
				'type' => 'text',
				'design' => 'block',
				'value' => __( 'Metadata', 'tainacan' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
				'sync' => blocksy_sync_single_post_container([
                    'prefix' => $prefix
                ])
			],
			blocksy_rand_md5() => [
                'type' => 'ct-condition',
                'condition' => [
                    $prefix . 'display_items_related_to_this' => 'yes',
				],
				'options' => [
					$prefix . 'section_items_related_to_this_label' => [
						'label' => __( 'Label for the "Items related to this" section', 'tainacan-blocksy' ),
						'desc' => __( 'Leave it blank for not displaying any label.', 'tainacan-blocksy' ),
						'type' => 'text',
						'design' => 'block',
						'value' => __( 'Items related to this', 'tainacan' ), // phpcs:ignore WordPress.WP.I18n.TextDomainMismatch -- Reuses Tainacan plugin translation.
						'sync' => blocksy_sync_single_post_container([
							'prefix' => $prefix
						])
					]
				]
			]
		]
	]
];

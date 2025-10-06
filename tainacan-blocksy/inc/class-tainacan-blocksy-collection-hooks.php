<?php

/**
 * This class uses Tainacan Form Hooks to add new fields to the collection form
 */
class Tainacan_Blocksy_Collection_Hooks {

	public $use_default_item_customizations = 'tainacan_blocksy_use_default_item_customizations';

	/**
	 * Initializes the class and registers the necessary hooks
	 */
	function __construct() {
		add_action( 'tainacan-register-admin-hooks', array( $this, 'register_hook' ) );
		add_action( 'tainacan-insert-tainacan-collection', array( $this, 'save_data' ) );
		add_filter( 'tainacan-api-response-collection-meta', array( $this, 'add_meta_to_response' ), 10, 2 );
	}

	/**
	 * The function that registers the hooks for the Tainacan admin interface.
	 */
	function register_hook() {
		if ( function_exists( 'tainacan_register_admin_hook' ) )
			tainacan_register_admin_hook( 'collection', array( $this, 'form'), 'end-right' );
	}

	/**
	 * Save the fields data when a collection is created or updated.
	 */
	function save_data( $object ) {
		if ( !function_exists( 'tainacan_get_api_postdata' ) )
			return;
		
		$post = tainacan_get_api_postdata();

		if ( $object->can_edit() && isset( $post->{$this->use_default_item_customizations} ))
			update_post_meta( $object->get_id(), $this->use_default_item_customizations, $post->{$this->use_default_item_customizations} );
	}

	/**
	 * Adds new fields to the collection API meta response.
	 */
	function add_meta_to_response( $extra_meta, $request ) {
		$extra_meta = array(
			$this->use_default_item_customizations,
		);
		return $extra_meta;
	}

	/**
	 * The extra fields form that will be displayed in the Tainacan admin interface
	 */
	function form() {
		if ( !function_exists( 'tainacan_get_api_postdata' ) )
			return '';

		ob_start();
		?>
		<div class="tainacan-blocksy-extra-fields"> 
			<div class="field tainacan-collection--section-header">
            <h4><?php _e( 'Integration of Tainacan into the Blocksy theme', 'tainacan-blocksy'); ?></h4>
            <hr>
            <p>
                <?php _e( 'To customize the public appearence of your collection items list and single item you can visit the WordPress Customizer.', 'tainacan-blocksy'); ?>
            </p>
            <br>
			<div class="columns">
				<div class="field column is-8">
					<label class="label"><?php _e( 'Source of the appearence options', 'tainacan-blocksy' ); ?></label>
					<div class="control">
						<span class="select is-fullwidth">
							<select name="<?php echo $this->use_default_item_customizations; ?>">
								<option value="no"><?php _e('Custom appearence for this collection items', 'tainacan-blocksy'); ?></option>
								<option value="yes"><?php _e('General options inherited from the "Tainacan Item" section.', 'tainacan-blocksy'); ?></option>
							</select>
						</span>
					</div>
                    <p class="help">
                        <?php _e( 'If you wish to customize most of your collection templates with the same appearence, set the source of above to the general "Tainacan item" section.', 'tainacan-blocksy'); ?>
                    </p>
				</div>
                <div class="column is-4">
                    <label class="label"><?php _e( 'Customizer shortcuts', 'tainacan-blocksy' ); ?></label>
                    <ul style="font-size: 0.875em; padding: 0.125em;">
                        <li>
                            <a href="<?php echo admin_url('/customize.php?autofocus[section]=post_type_archive_tnc_blocksy_item&ct_autofocus=post_types:post_type_archive_tnc_blocksy_item');?>" target="_blank">
                                <?php _e('Collection items list', 'tainacan-blocksy'); ?> ↗
                            </a>
                        </li>
                        <li>
							<a href="<?php echo admin_url('/customize.php?autofocus[section]=post_type_single_tnc_blocksy_item&ct_autofocus=post_type_single_tnc_blocksy_item');?>" target="_blank">
								<?php _e('Single item page', 'tainacan-blocksy'); ?> ↗
							</a>
						</li>
                    </ul>
                </div>
			</div>
		</div>
		<?php
        
		return ob_get_clean();
	}
}
new Tainacan_Blocksy_Collection_Hooks();

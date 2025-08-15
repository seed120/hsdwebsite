<?php 
/**
 * Zozo Header Footer Admin Class
 *
 * @since 1.0.0
 */
final class ZOZO_Header_Footer_Admin {

	private static $_instance = null;
		 
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {
		
		//create post type
		add_action( 'init', [ $this, 'header_footer_post_type' ], 10 );
		
		//admin menu
		add_action( 'admin_menu', [ $this, 'register_admin_menu' ], 50 );
		
		//add metabox
		add_action( 'add_meta_boxes', [ $this, 'zhf_register_metabox' ] );
		
		//save meta
		add_action( 'save_post', [ $this, 'zhf_save_meta' ] );

	}

	public function zhf_register_metabox() {
		add_meta_box(
			'zhf-meta-box',
			__( 'ZOZO Header & Footer Builder Options', 'zozo-header-footer' ),
			[
				$this,
				'efh_metabox_render',
			],
			'zozo-hf',
			'normal',
			'high'
		);
	}
	
	/**
	 * Render Meta field.
	 *
	 * @param  POST $post Currennt post object which is being displayed.
	 */
	function efh_metabox_render( $post ) {
		$values            = get_post_custom( $post->ID );
		$template_type     = isset( $values['zhf_template_type'] ) ? esc_attr( $values['zhf_template_type'][0] ) : '';

		// We'll use this nonce field later on when saving.
		wp_nonce_field( 'zhf_meta_nounce', 'zhf_meta_nounce' );
		?>
		<table class="zhf-options-table widefat">
			<tbody>
				<tr class="zhf-options-row type-of-template">
					<td class="zhf-options-row-heading">
						<label for="zhf_template_type"><?php _e( 'Type of Template', 'zozo-header-footer' ); ?></label>
					</td>
					<td class="zhf-options-row-content">
						<select name="zhf_template_type" id="zhf_template_type">
							<option value="" <?php selected( $template_type, '' ); ?>><?php _e( 'Select Option', 'zozo-header-footer' ); ?></option>
							<option value="type_header" <?php selected( $template_type, 'type_header' ); ?>><?php _e( 'Header', 'zozo-header-footer' ); ?></option>
							<option value="type_footer" <?php selected( $template_type, 'type_footer' ); ?>><?php _e( 'Footer', 'zozo-header-footer' ); ?></option>
							<option value="custom" <?php selected( $template_type, 'custom' ); ?>><?php _e( 'Custom Block', 'zozo-header-footer' ); ?></option>
						</select>
					</td>
				</tr>

				<?php $this->display_rules_tab(); ?>
				<tr class="zhf-options-row zhf-shortcode">
					<td class="zhf-options-row-heading">
						<label for="zhf_template_type"><?php _e( 'Shortcode', 'zozo-header-footer' ); ?></label>
						<i class="zhf-options-row-heading-help dashicons dashicons-editor-help" title="<?php _e( 'Copy this shortcode and paste it into your post, page, or text widget content.', 'zozo-header-footer' ); ?>">
						</i>
					</td>
					<td class="zhf-options-row-content">
						<span class="zhf-shortcode-col-wrap">
							<input type="text" onfocus="this.select();" readonly="readonly" value="[zhf_template id='<?php echo esc_attr( $post->ID ); ?>']" class="zhf-large-text code">
						</span>
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}
	
	/**
	 * Markup for Display Rules Tabs.
	 *
	 * @since  1.0.0
	 */
	public function display_rules_tab() {
		
		require_once( ZOZO_HF_CORE_DIR . 'admin/target-rule/class-zozo-target-rules-fields.php' );

		$include_locations = get_post_meta( get_the_id(), 'zhf_target_include_locations', true );
		$exclude_locations = get_post_meta( get_the_id(), 'zhf_target_exclude_locations', true );
		$users             = get_post_meta( get_the_id(), 'zhf_target_user_roles', true );
		?>
		<tr class="bsf-target-rules-row zhf-options-row">
			<td class="bsf-target-rules-row-heading zhf-options-row-heading">
				<label><?php esc_html_e( 'Display On', 'zozo-header-footer' ); ?></label>
				<i class="bsf-target-rules-heading-help dashicons dashicons-editor-help"
					title="<?php echo esc_attr__( 'Add locations for where this template should appear.', 'zozo-header-footer' ); ?>"></i>
			</td>
			<td class="bsf-target-rules-row-content zhf-options-row-content">
				<?php
				Zozo_Target_Rules_Fields::target_rule_settings_field(
					'bsf-target-rules-location',
					[
						'title'          => __( 'Display Rules', 'zozo-header-footer' ),
						'value'          => '[{"type":"basic-global","specific":null}]',
						'tags'           => 'site,enable,target,pages',
						'rule_type'      => 'display',
						'add_rule_label' => __( 'Add Display Rule', 'zozo-header-footer' ),
					],
					$include_locations
				);
				?>
			</td>
		</tr>
		<tr class="bsf-target-rules-row zhf-options-row">
			<td class="bsf-target-rules-row-heading zhf-options-row-heading">
				<label><?php esc_html_e( 'Do Not Display On', 'zozo-header-footer' ); ?></label>
				<i class="bsf-target-rules-heading-help dashicons dashicons-editor-help"
					title="<?php echo esc_attr__( 'Add locations for where this template should not appear.', 'zozo-header-footer' ); ?>"></i>
			</td>
			<td class="bsf-target-rules-row-content zhf-options-row-content">
				<?php
				Zozo_Target_Rules_Fields::target_rule_settings_field(
					'bsf-target-rules-exclusion',
					[
						'title'          => __( 'Exclude On', 'zozo-header-footer' ),
						'value'          => '[]',
						'tags'           => 'site,enable,target,pages',
						'add_rule_label' => __( 'Add Exclusion Rule', 'zozo-header-footer' ),
						'rule_type'      => 'exclude',
					],
					$exclude_locations
				);
				?>
			</td>
		</tr>
		<tr class="bsf-target-rules-row zhf-options-row">
			<td class="bsf-target-rules-row-heading zhf-options-row-heading">
				<label><?php esc_html_e( 'User Roles', 'zozo-header-footer' ); ?></label>
				<i class="bsf-target-rules-heading-help dashicons dashicons-editor-help" title="<?php echo esc_attr__( 'Display custom template based on user role.', 'zozo-header-footer' ); ?>"></i>
			</td>
			<td class="bsf-target-rules-row-content zhf-options-row-content">
				<?php
				Zozo_Target_Rules_Fields::target_user_role_settings_field(
					'bsf-target-rules-users',
					[
						'title'          => __( 'Users', 'zozo-header-footer' ),
						'value'          => '[]',
						'tags'           => 'site,enable,target,pages',
						'add_rule_label' => __( 'Add User Rule', 'zozo-header-footer' ),
					],
					$users
				);
				?>
			</td>
		</tr>
		<?php
	}
	
	/**
	 * Register Post type for Elementor Header & Footer Builder templates
	 */
	public function header_footer_post_type() {
		
		$labels = [
			'name'               => __( 'Elementor Header & Footer Builder', 'zozo-header-footer' ),
			'singular_name'      => __( 'Elementor Header & Footer Builder', 'zozo-header-footer' ),
			'menu_name'          => __( 'Elementor Header & Footer Builder', 'zozo-header-footer' ),
			'name_admin_bar'     => __( 'Elementor Header & Footer Builder', 'zozo-header-footer' ),
			'add_new'            => __( 'Add New', 'zozo-header-footer' ),
			'add_new_item'       => __( 'Add New Header or Footer', 'zozo-header-footer' ),
			'new_item'           => __( 'New Template', 'zozo-header-footer' ),
			'edit_item'          => __( 'Edit Template', 'zozo-header-footer' ),
			'view_item'          => __( 'View Template', 'zozo-header-footer' ),
			'all_items'          => __( 'All Templates', 'zozo-header-footer' ),
			'search_items'       => __( 'Search Templates', 'zozo-header-footer' ),
			'parent_item_colon'  => __( 'Parent Templates:', 'zozo-header-footer' ),
			'not_found'          => __( 'No Templates found.', 'zozo-header-footer' ),
			'not_found_in_trash' => __( 'No Templates found in Trash.', 'zozo-header-footer' ),
		];

		$args = [
			'labels'              => $labels,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'menu_icon'           => 'dashicons-editor-kitchensink',
			'supports'            => [ 'title', 'thumbnail', 'elementor' ],
		];

		register_post_type( 'zozo-hf', $args );
		
		flush_rewrite_rules();
	}
	
	public function register_admin_menu() {
		add_submenu_page(
			'themes.php',
			__( 'Elementor Header & Footer Builder', 'zozo-header-footer' ),
			__( 'Elementor Header & Footer Builder', 'zozo-header-footer' ),
			'edit_pages',
			'edit.php?post_type=zozo-hf'
		);
	}
	
	/**
	 * Save meta field.
	 *
	 * @param  POST $post_id Currennt post object which is being displayed.
	 *
	 * @return Void
	 */
	public function zhf_save_meta( $post_id ) {

		// Bail if we're doing an auto save.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// if our nonce isn't there, or we can't verify it, bail.
		if ( ! isset( $_POST['zhf_meta_nounce'] ) || ! wp_verify_nonce( $_POST['zhf_meta_nounce'], 'zhf_meta_nounce' ) ) {
			return;
		}

		// if our current user can't edit this post, bail.
		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}
		
		require_once( ZOZO_HF_CORE_DIR . 'admin/target-rule/class-zozo-target-rules-fields.php' );
		
		$target_locations = Zozo_Target_Rules_Fields::get_format_rule_value( $_POST, 'bsf-target-rules-location' );
		$target_exclusion = Zozo_Target_Rules_Fields::get_format_rule_value( $_POST, 'bsf-target-rules-exclusion' );
		$target_users     = [];

		if ( isset( $_POST['bsf-target-rules-users'] ) ) {
			$target_users = array_map( 'sanitize_text_field', $_POST['bsf-target-rules-users'] );
		}

		update_post_meta( $post_id, 'zhf_target_include_locations', $target_locations );
		update_post_meta( $post_id, 'zhf_target_exclude_locations', $target_exclusion );
		update_post_meta( $post_id, 'zhf_target_user_roles', $target_users );

		if ( isset( $_POST['zhf_template_type'] ) ) {
			update_post_meta( $post_id, 'zhf_template_type', esc_attr( $_POST['zhf_template_type'] ) );
		}
	}

}
ZOZO_Header_Footer_Admin::instance();
<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class DragDrop_Control extends Base_Data_Control {

	public function get_type() {
		return 'dragdrop';
	}
	
	public function enqueue() {

		// Scripts
		wp_register_script( 'jqueryui', CEA_CORE_URL . 'assets/js/jqueryui.js', [], null, true );
		wp_register_script( 'cea-control-helper', CEA_CORE_URL . 'assets/js/front-end/control-helper.js', [ 'jquery', 'jqueryui' ], '1.0.0' );
		wp_enqueue_script( 'cea-control-helper' );
		
		// Styles
		wp_register_style( 'cea-control-helper', CEA_CORE_URL . 'assets/css/front-end/control-helper.css', [], '3.4.1' );
		wp_enqueue_style( 'cea-control-helper' );
	}
	
	/**
	 * Get textarea control default settings.
	 *
	 * Retrieve the default settings of the textarea control. Used to return the
	 * default settings while initializing the textarea control.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'label_block' => true,
			'rows' => 5,
			'placeholder' => ''
		];
	}
	
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				
				<textarea id="<?php echo $control_uid; ?>" class="elementor-control-tag-area" rows="{{ data.rows }}" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}"></textarea>
				
				<div class="meta-drag-drop-multi-field">
				<# _.each( data.ddvalues, function( option_title, option_value ) { #>
					<h4>{{{ option_value }}}</h4>
					<?php echo '<ul class="meta-items ui-sortable" data-part="';?>{{{ option_value }}}<?php echo '">'; ?>
					<# _.each( option_title, function( inner_title, inner_value ) { #>
						<?php echo '<li data-id="'; ?>{{{ inner_value }}}<?php echo '" data-val="';?>{{{ inner_title }}}<?php echo '">'; ?>{{{ inner_title }}}</li>
					<# } ); #>
					</ul>
				<# } ); #>
				</div>

			</div>
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}

}
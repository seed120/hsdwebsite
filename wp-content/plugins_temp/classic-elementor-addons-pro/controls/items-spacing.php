<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class ItemSpacing_Control extends Base_Data_Control {

	public function get_type() {
		return 'itemspacing';
	}
	
	public function enqueue() {

		// Scripts
		wp_register_script( 'jqueryui', CEA_CORE_URL . 'assets/js/jqueryui.js', [], null, true );
		wp_register_script( 'cea-control-helper', CEA_CORE_URL . 'assets/js/front-end/control-helper.js', [ 'jquery', 'jqueryui' ], '1.0.0' );
		wp_enqueue_script( 'cea-control-helper' );
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
			</div>
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}

}
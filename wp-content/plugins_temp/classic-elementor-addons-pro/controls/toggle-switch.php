<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class ToggleSwitch_Control extends Base_Data_Control {

	public function get_type() {
		return 'toggleswitch';
	}
	
	public function enqueue() {}
	
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
			'checked' => ''
		];
	}
	
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		
		<div class="elementor-control-field">
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<label class="switch">
				<input class="switch-checkbox" type="checkbox">
				<span class="slider round"></span>
			</label>
			<input class="main-checkbox tooltip-target elementor-control-tag-area" type="text" id="<?php echo $control_uid; ?>" data-setting="{{ data.name }}" >
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}

}
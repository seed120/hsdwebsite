<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor bootstrap icon control.
 *
 */
class Control_Bootstrap_Icon extends Base_Data_Control {

	/**
	 * Get icon control type.
	 *
	 * Retrieve the control type, in this case `icon`.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'bootstrapicon';
	}
	
	public function enqueue() {
		wp_register_style( 'bootstrap-icons', CEA_CORE_URL . 'assets/css/bootstrap-icons.css', false, '1.0' );
		wp_enqueue_style( 'bootstrap-icons' );
	}

	/**
	 * Get icons.
	 *
	 * Retrieve all the available icons.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return array Available icons.
	 */
	public static function get_icons() {
		
		$menu_ico = cea_menu_bi_icons();
		$bi_array = array();
		if (is_array($menu_ico)) {
			foreach( $menu_ico as $icons ){
				$cont = str_replace("\\","&#x",$icons[2]).';';
				$ico_class = str_replace("bi-","",$icons[1]); 
				$bi_array[$icons[1]] = $ico_class .' '. $cont;
			}
		}
	
		return $bi_array;
	}

	/**
	 * Get icons control default settings.
	 *
	 * Retrieve the default settings of the icons control. Used to return the default
	 * settings while initializing the icons control.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'options' => self::get_icons(),
			'include' => '',
			'exclude' => '',
		];
	}

	/**
	 * Render icons control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();

		?>
		<div class="elementor-control-field">
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<select id="<?php echo $control_uid; ?>" class="elementor-control-ti-icon" data-setting="{{ data.name }}" data-placeholder="<?php echo __( 'Select Icon', 'elementor' ); ?>" style="font-family: bootstrap-icons !important;">
					<option value=""><?php echo __( 'Select Icon', 'elementor' ); ?></option>
					<# _.each( data.options, function( option_title, option_value ) { #>
					<option value="{{ option_value }}">{{{ option_title }}}</option>
					<# } ); #>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{ data.description }}</div>
		<# } #>
		<?php
	}
}

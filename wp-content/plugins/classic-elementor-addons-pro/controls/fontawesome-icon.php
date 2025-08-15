<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor font awesome icon control.
 *
 */
class Control_FontAwesome_Icon extends Base_Data_Control {

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
		return 'fontawesomeicon';
	}

	public function enqueue() {
		wp_register_style( 'fontawesome', CEA_CORE_URL . 'assets/css/font-awesome.css', false, '4.7.0' );
		wp_enqueue_style( 'fontawesome' );
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
		
		$menu_ico = cea_menuFaIcons();
		$fa_array = array();
		foreach( $menu_ico as $icons ){
			$cont = str_replace("\\","&#x",$icons[2]).';'; // &#x\f000
			$ico_class = str_replace("fa-","",$icons[1]); 
			$fa_array[$icons[1]] = $ico_class .' '. $cont;
		}
	
		return $fa_array;
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
				<select id="<?php echo $control_uid; ?>" class="elementor-control-fa-icon" data-setting="{{ data.name }}" data-placeholder="<?php echo __( 'Select Icon', 'elementor' ); ?>" style="font-family: 'FontAwesome';">
					<?php

						$menu_ico = cea_menuFaIcons();
						foreach($menu_ico as $icons){
							$cont = str_replace("\\","&#x",$icons[2]).';'; // &#x\f000
							$ico_class = str_replace("fa-","",$icons[1]); 
							?>
							<option value="fa <?php echo esc_attr( $icons[1] ); ?>"><?php echo esc_attr( $ico_class. ' - '.$cont ); ?></option>
					<?php
						}
					?>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{ data.description }}</div>
		<# } #>
		<?php
	}
}

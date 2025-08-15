<?php 

namespace Elementor;

class CEA_Pro_Module {
	
	private static $_instance = null;
	
	public function __construct() {
		
		// Add Custom CSS and Sticky functionality
		if (!class_exists('\ElementorPro\Plugin')) {
			add_action('elementor/element/after_section_end', [$this, 'add_controls_section'], 10, 3);
			add_action('elementor/element/after_container_end', [$this, 'add_controls_section'], 10, 3);
			add_action('elementor/element/parse_css', [$this, 'add_post_css'], 10, 2);
			add_action('elementor/css-file/post/parse', [$this, 'add_page_settings_css']);
		}
	}

	public static function add_controls_section($element, $section_id, $args) {
		if ($section_id == 'section_custom_css_pro') {
			// Custom CSS controls
			$element->remove_control('section_custom_css_pro');
			$element->start_controls_section(
				'section_custom_css',
				[
					'label' => esc_html__( 'CEA Custom CSS', 'classic-elementor-addons-pro' ),
					'tab' => Controls_Manager::TAB_ADVANCED,
				]
			);
			$element->add_control(
				'custom_css_title',
				[
					'raw' => esc_html__( 'Add your own custom CSS here', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::RAW_HTML,
				]
			);
			$element->add_control(
				'custom_css',
				[
					'type' => Controls_Manager::CODE,
					'label' => esc_html__( 'Custom CSS', 'classic-elementor-addons-pro' ),
					'language' => 'css',
					'render_type' => 'ui',
					'show_label' => false,
					'separator' => 'none',
				]
			);
			$element->add_control(
				'custom_css_description',
				[
					'raw' => 'Use "selector" to target wrapper element. Examples:<br>selector {color: red;} // For main element<br>selector .child-element {margin: 10px;} // For child element<br>.my-class {text-align: center;} // Or use any custom selector',
					'type' => Controls_Manager::RAW_HTML,
					'content_classes' => 'zhf-elementor-descriptor',
				]
			);
			$element->end_controls_section();
		}
	}

	public function add_post_css($post_css, $element) {
		if ($post_css instanceof Dynamic_CSS) {
			return;
		}

		$element_settings = $element->get_settings();
		if (empty($element_settings['custom_css'])) {
			return;
		}
		$css = trim($element_settings['custom_css']);

		if (empty($css)) {
			return;	
		}
		$css = str_replace('selector', $post_css->get_element_unique_selector($element), $css);

		// Add a css comment
		$css = sprintf('/* Start custom CSS for %s, class: %s */', $element->get_name(), $element->get_unique_selector()) . $css . '/* End custom CSS */';

		$post_css->get_stylesheet()->add_raw_css($css);
	}
	
	public function add_page_settings_css($post_css) {
		$document = \Elementor\Plugin::$instance->documents->get($post_css->get_post_id());
		$custom_css = $document->get_settings('custom_css');
		if (is_null($custom_css)) {
			$custom_css = '';
		}
	
		$custom_css = trim($custom_css);
	
		if (empty($custom_css)) {
			return;
		}
	
		$custom_css = str_replace('selector', $document->get_css_wrapper_selector(), $custom_css);
		$custom_css = '/* Start custom CSS for page-settings */' . $custom_css . '/* End custom CSS */';
	
		$post_css->get_stylesheet()->add_raw_css($custom_css);
	}
	
	

	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}

CEA_Pro_Module::instance();
?>

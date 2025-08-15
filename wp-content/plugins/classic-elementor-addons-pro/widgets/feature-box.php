<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Feature Box
 *
 * @since 1.0.0
 */
 
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
 
class CEA_Elementor_Feature_Box_Widget extends Widget_Base {
	
	private $_settings;
	private $excerpt_len;
	private $title_array;
	private $fbox_content;
	private $fbox_icon_array;
	private $fbox_img_array;
	private $fbox_video_array;
	private $fbox_btn_array;
	public $image_class;
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Blog widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceafeaturebox";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Blog widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Feature Box", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Blog widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layout-cta-btn-left";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Feature Box widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'feature', 'box', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Feature Box widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ "classic-elements" ];
	}
	
	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'tilt', 'cea-custom-front' ];
	}
	
	/**
	 * Get button sizes.
	 *
	 * Retrieve an array of button sizes for the button widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return array An array containing button sizes.
	 */
	public static function get_button_sizes() {
		return [
			'xs' => __( 'Extra Small', 'elementor' ),
			'sm' => __( 'Small', 'elementor' ),
			'md' => __( 'Medium', 'elementor' ),
			'lg' => __( 'Large', 'elementor' ),
			'xl' => __( 'Extra Large', 'elementor' ),
		];
	}

	/**
	 * Register Feature Box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//General Section
		$this->start_controls_section(
			"general_section",
			[
				"label"	=> esc_html__( "General", 'classic-elementor-addons-pro' ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default counter options.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"redirect",
			[
				"label" 		=> esc_html__( "Feature Box Redirect", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for when click the feature box redirect to some link.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'condition' 	=> [
					'redirect' 		=> 'yes'
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'classic-elementor-addons-pro' )
			]
		);
		$this->end_controls_section();		
		
		//Layouts Section
		$this->start_controls_section(
			"feature_layouts_section",
			[
				"label"			=> esc_html__( "Layouts", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Layouts options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"feature_layout",
			[
				"label"			=> esc_html__( "Feature Box Layout", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "default",
				"options"		=> [
					"default"		=> esc_html__( "Default", 'classic-elementor-addons-pro' ),
					"classic"		=> esc_html__( "Classic", 'classic-elementor-addons-pro' ),
					"modern"		=> esc_html__( "Modern", 'classic-elementor-addons-pro' ),
					"classic-pro"	=> esc_html__( "Classic Pro", 'classic-elementor-addons-pro' ),
				]
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'normal',
				'options' => [
					'normal' => [
						'title' => __( 'Normal', 'elementor' ),
						'icon' => 'ti-layout-media-center-alt',
					],
					'list' => [
						'title' => __( 'List', 'elementor' ),
						'icon' => 'ti-layout-media-left',
					]
				],
				'toggle' => false,
			]
		);		
		$this->add_control(
			'list_position',
			[
				'label' => __( 'List Head Position', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
				"condition" 	=> [
					"layout" 		=> "list"
				]
			]
		);

		$this->add_control(
			"content_full",
			[
				"label" 		=> esc_html__( "Full Width Content", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable or disable feature content full width for list style.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"layout" 		=> "list"
				]
			]
		);
		$this->add_control(
			"content_self_center",
			[
				"label" 		=> esc_html__( "Content Self Center", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for feature box list style right side content set vertically middle.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"layout" 		=> "list"
				],
			]
		);
		$this->add_control(
			"icon_self_center",
			[
				"label" 		=> esc_html__( "Icon Self Center", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for feature box list style icon/image set vertically middle.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"layout" 		=> "list"
				],
			]
		);
		$this->add_control(
			"fbox_items",
			[
				"label"				=> "Feature Box Items",
				"description"		=> esc_html__( "This is settings for feature box custom layout. here you can set your own layout. Drag and drop needed feature items to Enabled part.", 'classic-elementor-addons-pro' ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					'Enabled' => array( 
						'icon'	=> esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
						'title'	=> esc_html__( 'Title', 'classic-elementor-addons-pro' ),
						'content'	=> esc_html__( 'Content', 'classic-elementor-addons-pro' )					
					),
					'disabled' => array(
						'image'	=> esc_html__( 'Image', 'classic-elementor-addons-pro' ),
						'btn'	=> esc_html__( 'Button', 'classic-elementor-addons-pro' ),
						'video'	=> esc_html__( 'Video', 'classic-elementor-addons-pro' ),
						'number'=> esc_html__( 'Text or Number', 'classic-elementor-addons-pro' )
					)
				],
				"condition" 	=> [
					"layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"fbox_list_items",
			[
				"label"				=> "Feature Box List Items",
				"description"		=> esc_html__( "This is settings for feature box custom list layout. here you can set your own layout. Drag and drop needed feature items to Left and Right part.", 'classic-elementor-addons-pro' ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					esc_html__( "Left", 'classic-elementor-addons-pro' ) => array( 
						"icon"	=> esc_html__( "Icon", 'classic-elementor-addons-pro' )				
					),
					esc_html__( "Right", 'classic-elementor-addons-pro' ) => array( 
						"title"	=> esc_html__( "Title", 'classic-elementor-addons-pro' ),
						"content"	=> esc_html__( "Content", 'classic-elementor-addons-pro' )					
					),
					esc_html__( "disabled", 'classic-elementor-addons-pro' ) => array(
						"image"	=> esc_html__( "Image", 'classic-elementor-addons-pro' ),
						"btn"	=> esc_html__( "Button", 'classic-elementor-addons-pro' ),
						"video"	=> esc_html__( "Video", 'classic-elementor-addons-pro' ),
						"number"	=> esc_html__( "Text or Number", 'classic-elementor-addons-pro' )
					)
				],
				"condition" 	=> [
					"layout" 		=> "list"
				]
			]
		);
		$this->add_control(
			"ribbon_value",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Ribbon Values", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for corner rounded number like ribbon. This option working only when active feature box layout 'Classic Pro'.", 'classic-elementor-addons-pro' ),
				"default"		=> "",
				"condition" 	=> [
					"feature_layout" 	=> "classic-pro"
				]
			]
		);
		$this->end_controls_section();
		
		//Title Section
		$this->start_controls_section(
			"title_section",
			[
				"label"			=> esc_html__( "Title", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Title options available here.", 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			"title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Feature Box Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Input feature box title here.", 'classic-elementor-addons-pro' ),
				"default" 		=>  esc_html__( "Feature Title", 'classic-elementor-addons-pro' )
			]
		);		
		$this->add_control(
			"title_head",
			[
				"label"			=> esc_html__( "Title Heading Tag", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h3",
				"options"		=> [
					"h1"		=> esc_html__( "h1", 'classic-elementor-addons-pro' ),
					"h2"		=> esc_html__( "h2", 'classic-elementor-addons-pro' ),
					"h3"		=> esc_html__( "h3", 'classic-elementor-addons-pro' ),
					"h4"		=> esc_html__( "h4", 'classic-elementor-addons-pro' ),
					"h5"		=> esc_html__( "h5", 'classic-elementor-addons-pro' ),
					"h6"		=> esc_html__( "h6", 'classic-elementor-addons-pro' ),
					"p"			=> esc_html__( "p", 'classic-elementor-addons-pro' ),
					"span"		=> esc_html__( "span", 'classic-elementor-addons-pro' ),
					"div"		=> esc_html__( "div", 'classic-elementor-addons-pro' ),
					"i"			=> esc_html__( "i", 'classic-elementor-addons-pro' )
				]
			]
		);
		
		$this->add_control(
			"title_text_trans",
			[
				"label"			=> esc_html__( "Title Transform", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Set title text-transform property.", 'classic-elementor-addons-pro' ),
				"default"		=> "none",
				"options"		=> [
					"none"			=> esc_html__( "Default", 'classic-elementor-addons-pro' ),
					"capitalize"	=> esc_html__( "Capitalized", 'classic-elementor-addons-pro' ),
					"uppercase"		=> esc_html__( "Upper Case", 'classic-elementor-addons-pro' ),
					"lowercase"		=> esc_html__( "Lower Case", 'classic-elementor-addons-pro' )
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper .feature-box-title' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();		
		
		//Icon Section
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
			]
		);
		
		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'ti-heart',
					'library' => 'themify',
				],
			]
		);

		$this->add_control(
			'icon_view',
			[
				'label' => esc_html__( 'View', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
					'stacked' => esc_html__( 'Stacked', 'classic-elementor-addons-pro' ),
					'framed' => esc_html__( 'Framed', 'classic-elementor-addons-pro' ),
				],
				'default' => 'default',
				'prefix_class' => 'cea-view-',
			]
		);

		$this->add_control(
			'icon_shape',
			[
				'label' => esc_html__( 'Shape', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'classic-elementor-addons-pro' ),
					'square' => esc_html__( 'Square', 'classic-elementor-addons-pro' ),
				],
				'default' => 'circle',
				'condition' => [
					'icon_view!' => 'default',
				],
				'prefix_class' => 'cea-shape-',
			]
		);

		$this->end_controls_section();				
		
		// Image Section
		$this->start_controls_section(
			"image_section",
			[
				"label"			=> esc_html__( "Image", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Image options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"image",
			[
				"type" => Controls_Manager::MEDIA,
				"label" => esc_html__( "Feature Box Image", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose feature box image.", 'classic-elementor-addons-pro' ),
				"dynamic" => [
					"active" => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);				
		$this->end_controls_section();			
		
		//Number Section
		$this->start_controls_section(
			"number_section",
			[
				"label"			=> esc_html__( "Number", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Number options available here.", 'classic-elementor-addons-pro' ),
			]
		);	
		$this->add_control(
			"fbox_number",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Feature Box Number", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter feature box number. Example 01", 'classic-elementor-addons-pro' ),
				"default"		=> "01"
			]
		);				
		$this->end_controls_section();		
		
		// Button
		$this->start_controls_section(
			"button_section",
			[
				"label"			=> esc_html__( "Button", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Button options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'button_type',
			[
				'label' => esc_html__( 'Type', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
					'info' => esc_html__( 'Info', 'classic-elementor-addons-pro' ),
					'success' => esc_html__( 'Success', 'classic-elementor-addons-pro' ),
					'warning' => esc_html__( 'Warning', 'classic-elementor-addons-pro' ),
					'danger' => esc_html__( 'Danger', 'classic-elementor-addons-pro' ),
				],
				'default' => 'none',
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Text', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Click here', 'classic-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Click here', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'classic-elementor-addons-pro' ),
				'default' => [
					'url' => '#',
				],
			]
		);
		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__( 'Alignment', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'prefix_class' => 'cea-btn%s-align-',
				'default' => '',
			]
		);
		$this->add_control(
			'button_size',
			[
				'label' => esc_html__( 'Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => [
			'xs' => __( 'Extra Small', 'elementor' ),
			'sm' => __( 'Small', 'elementor' ),
			'md' => __( 'Medium', 'elementor' ),
			'lg' => __( 'Large', 'elementor' ),
			'xl' => __( 'Extra Large', 'elementor' ),
		],//self::get_button_sizes(),
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
			]
		);
		$this->add_control(
			'button_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'classic-elementor-addons-pro' ),
					'right' => esc_html__( 'After', 'classic-elementor-addons-pro' ),
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);
		$this->add_control(
			'button_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-button .cea-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cea-button .cea-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_view',
			[
				'label' => esc_html__( 'View', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);
		$this->add_control(
			'button_css_id',
			[
				'label' => esc_html__( 'Button ID', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'title' => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'classic-elementor-addons-pro' ),
				'description' => esc_html__( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'classic-elementor-addons-pro' ),
				'separator' => 'before',
			]
		);
		$this->end_controls_section();			
		
		// Video
		$this->start_controls_section(
			"video_section",
			[
				"label"			=> esc_html__( "Video", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Video options available here.", 'classic-elementor-addons-pro' ),
			]
		);	
		$this->add_control(
			"fbox_video",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Feature Box Video", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose feature box video. This url maybe youtube or vimeo video. Example https://www.youtube.com/embed/qAHRvrrfGC4", 'classic-elementor-addons-pro' ),
				"default"		=> ""
			]
		);
		$this->end_controls_section();	
		
		// Content
		$this->start_controls_section(
			"content_section",
			[
				"label"			=> esc_html__( "Content", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_control(
			"content",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Content", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "You can give the feature box content here. HTML allowed here.", 'classic-elementor-addons-pro' ),
				"default" 		=> esc_html__( "Feature box content.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->end_controls_section();	
		
		// Style Content Section
		$this->start_controls_section(
			'section_style_fbox',
			[
				'label' => __( 'Feature Box', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'fbox_content_styles' );
		$this->start_controls_tab(
			'fbox_content_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"font_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Font Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper, {{WRAPPER}} a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"shadow_opt",
			[
				"label" 		=> esc_html__( "Box Shadow Enable", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for show box shadow on feature box hover.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"fbox_box_shadow",
			[
				"label" 		=> esc_html__( "Box Shadow", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for show box shadow on feature box hover.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::BOX_SHADOW,
				'condition' => [
					'shadow_opt' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{fbox_box_shadow_pos.VALUE}};',
				]
			]
		);
		$this->add_control(
			"fbox_box_shadow_pos",
			[
				'label' =>  esc_html__( "Box Shadow Position", 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					' ' => esc_html__( "Outline", 'classic-elementor-addons-pro' ),
					'inset' => esc_html__( "Inset", 'classic-elementor-addons-pro' ),
				],
				'condition' => [
					'shadow_opt' => 'yes',
				],
				'default' => ' ',
				'render_type' => 'ui',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'fbox_content_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'bg_hcolor',
			[
				'label' => esc_html__( 'Hover Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper:hover' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			"font_hcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Hover Font Color", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"shadow_hopt",
			[
				"label" 		=> esc_html__( "Box Shadow Enable", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for show box shadow on feature box hover.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"fbox_hbox_shadow",
			[
				"label" 		=> esc_html__( "Hover Box Shadow", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for show box shadow on feature box hover.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::BOX_SHADOW,
				'condition' => [
					'shadow_hopt' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{fbox_hbox_shadow_pos.VALUE}};',
				]
			]
		);
		$this->add_control(
			"fbox_hbox_shadow_pos",
			[
				'label' =>  esc_html__( "Box Shadow Position", 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					' ' => esc_html__( "Outline", 'classic-elementor-addons-pro' ),
					'inset' => esc_html__( "Inset", 'classic-elementor-addons-pro' ),
				],
				'condition' => [
					'shadow_hopt' => 'yes',
				],
				'default' => ' ',
				'render_type' => 'ui',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'fbox_content_typography',
				'selector' 		=> '{{WRAPPER}} .feature-box-wrapper'
			]
		);	
		
		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		
		// Style Title Section
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'title_colors' );
		$this->start_controls_tab(
			'title_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"title_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper .feature-box-title, {{WRAPPER}} .feature-box-wrapper .feature-box-title > a' => 'color: {{VALUE}};'
				],
			]
		);	
		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"title_hcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Hover Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper:hover .feature-box-title, {{WRAPPER}} .feature-box-wrapper:hover .feature-box-title > a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .feature-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => esc_html__( 'Title Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .feature-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'fbox_title_typography',
				'selector' 		=> '{{WRAPPER}} .feature-box-wrapper .feature-box-title'
			]
		);	
		$this->end_controls_section();
		
		// Style Icon Section
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);

		$this->add_control(
			'icon_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .cea-featured-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-featured-icon svg' => 'fill: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'condition' => [
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed .cea-featured-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.cea-view-stacked .cea-featured-icon' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( 'Border Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'icon_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed .cea-featured-icon' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);

		$this->add_control(
			'icon_primary_hcolor',
			[
				'label' => esc_html__( 'Primary Hover Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}}:hover .cea-featured-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .cea-featured-icon svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'icon_secondary_hcolor',
			[
				'label' => esc_html__( 'Secondary Hover Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed:hover .cea-featured-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.cea-view-stacked:hover .cea-featured-icon' => 'background-color: {{VALUE}};'
				],
			]
		);	
		$this->add_control(
			'icon_border_hcolor',
			[
				'label' => esc_html__( 'Border Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'condition' => [
					'icon_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed:hover .cea-featured-icon' => 'border-color: {{VALUE}};'
				],
			]
		);		

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-featured-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cea-featured-icon svg' => 'width: {{SIZE}}{{UNIT}};' //->modified
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}.cea-view-stacked .cea-featured-icon' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.cea-view-framed .cea-featured-icon' => 'padding: {{SIZE}}{{UNIT}};'
				],
				'defailt' => [
					'unit' => 'px',
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'icon_rotate',
			[
				'label' => esc_html__( 'Rotate', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'tablet_default' => [
					'unit' => 'deg',
				],
				'mobile_default' => [
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .cea-featured-icon i, {{WRAPPER}} .cea-featured-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__( 'Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-featured-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-featured-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_width',
			[
				'label' => esc_html__( 'Border Width', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-featured-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_view' => 'framed',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-featured-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-featured-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_view!' => 'default',
				],
			]
		);
		$this->add_control(
			'icon_animation',
			[
				'label' => esc_html__( 'Icon Animation', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ANIMATION,
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper:hover .cea-featured-icon.cea-elementor-animation' => 'animation-name: {{VALUE}};'
				]
			]
		);
		
		$this->end_controls_section();
		
		// Style Image Section		
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'fbox_image_styles' );
		$this->start_controls_tab(
			'fbox_img_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'fbox_img_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper .cea-feature-box-img > img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'fbox_img_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'fbox_img_bg_hcolor',
			[
				'label' => esc_html__( 'Hover Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper:hover .cea-feature-box-img > img' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();			
			
		$this->add_control(
			"img_style",
			[
				"label"			=> esc_html__( "Image Style", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Choose image style.", 'classic-elementor-addons-pro' ),
				"default"		=> "squared",
				"options"		=> [
					"squared"			=> esc_html__( "Squared", 'classic-elementor-addons-pro' ),
					"rounded"			=> esc_html__( "Rounded", 'classic-elementor-addons-pro' ),
					"rounded-circle"	=> esc_html__( "Circled", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->add_control(
			"resize_opt",
			[
				"label" 		=> esc_html__( "Resize Option", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enable resize option.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__( 'Image Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'condition' => [
					'resize_opt' => 'yes',	
				],
				'selectors' => [
					'{{WRAPPER}} .cea-feature-box-img > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;',
					'{{WRAPPER}} .cea-feature-box-img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
				],
			]
		);
		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => esc_html__( 'Image Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-feature-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;'
				],
			]
		);		
		$this->add_responsive_control(
			'fbox_img_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-feature-box-img > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'fbox_img_border',
					'label' => esc_html__( 'Border', 'classic-elementor-addons-pro' ),
					'selector' => '{{WRAPPER}} .cea-feature-box-img > img'
				]
		);
		$this->end_controls_section();
		
		// Style Number Section
		$this->start_controls_section(
			'section_style_number',
			[
				'label' => __( 'Number', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'fbox_number_styles' );
		$this->start_controls_tab(
			'fbox_number_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"fbox_number_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Number Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose feature box number color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper .fbox-number' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'fbox_number_opacity',
			[
				'label' => esc_html__( 'Opacity', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper .fbox-number' => 'opacity: calc( {{SIZE}} / 10 );'
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'fbox_number_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"fbox_number_hcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Hover Number Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose feature box hover number color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper:hover .fbox-number' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'fbox_number_hopacity',
			[
				'label' => esc_html__( 'Hover Opacity', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper:hover .fbox-number' => 'opacity: calc( {{SIZE}} / 10 );'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'fbox_number_typography',
				'selector' 		=> '{{WRAPPER}} .feature-box-wrapper .fbox-number'
			]
		);	
		$this->add_control(
			"number_position_opt",
			[
				"label" 		=> esc_html__( "Floating Number Enable", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable number floating.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			'number_position_top',
			[
				'label' => esc_html__( 'Position Top', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper .fbox-number' => 'position: absolute; top: {{SIZE}}%;',
				],
				"condition" 	=> [
					"number_position_opt" 	=> "yes"
				],
			]
		);
		$this->add_responsive_control(
			'number_position_left',
			[
				'label' => esc_html__( 'Position Left', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .feature-box-wrapper .fbox-number' => 'left: {{SIZE}}%;',
				],
				"condition" 	=> [
					"number_position_opt" 	=> "yes"
				],
			]
		);
		$this->add_responsive_control(
			'number_spacing',
			[
				'label' => esc_html__( 'Number Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fbox-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .fbox-number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				"condition" 	=> [
					"number_position_opt!" 	=> "yes"
				]
			]
		);		
		$this->end_controls_section();	
		
		// Style Button Section
		$this->start_controls_section(
			'button_section_style',
			[
				'label' => esc_html__( 'Button', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .cea-button',
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .cea-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-button:hover, {{WRAPPER}} .cea-button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-button:hover svg, {{WRAPPER}} .cea-button:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-button:hover, {{WRAPPER}} .cea-button:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cea-button:hover, {{WRAPPER}} .cea-button:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .cea-button',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .cea-button',
			]
		);
		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'selector' 		=> '{{WRAPPER}} .cea-button'
			]
		);
		$this->end_controls_section();		
		
		// Style Content Section
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'desc_spacing',
			[
				'label' => esc_html__( 'Description Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fbox-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .fbox-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);		
		$this->end_controls_section();	
		
		// Style Tilt Section
		$this->start_controls_section(
			'section_style_tilt',
			[
				'label' => __( 'Tilt', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"tilt_opt",
			[
				"label" 		=> esc_html__( "Tilt Option", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable tilt animation option.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'max_tilt',
			[
				'label' => esc_html__( 'maxTilt', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 20
			]
		);
		$this->add_control(
			'perspective',
			[
				'label' => esc_html__( 'Perspective', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 500
			]
		);
		$this->add_control(
			'tilt_scale',
			[
				'label' => esc_html__( 'Scale', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 1.1
			]
		);
		$this->add_control(
			'tilt_speed',
			[
				'label' => esc_html__( 'Speed', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 400
			]
		);
		$this->add_control(
			"tilt_transition",
			[
				"label" 		=> esc_html__( "Tilt Transition", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for tilt transition.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render Feature Box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	 
	public function render_content() {
		/**
		 * Before widget render content.
		 *
		 * Fires before Elementor widget is being rendered.
		 *
		 * @since 1.0.0
		 *
		 * @param Widget_Base $this The current widget.
		 */
		do_action( 'elementor/widget/before_render_content', $this );

		ob_start();

		$skin = $this->get_current_skin();
		if ( $skin ) {
			$skin->set_parent( $this );
			$skin->render();
		} else {
			$this->render();
		}

		$widget_content = ob_get_clean();
		
		$settings = $this->get_settings_for_display();
		$feature_layout = isset( $settings['feature_layout'] ) && !empty( $settings['feature_layout'] ) ? 'feature-box-'. $settings['feature_layout'] : 'feature-box-default';
		$tilt_opt = isset( $settings['tilt_opt'] ) && $settings['tilt_opt'] == 'yes' ? true : false;
		$tilt_transition = isset( $settings['tilt_transition'] ) && $settings['tilt_transition'] == 'yes' ? true : false;
		$max_tilt = isset( $settings['max_tilt'] ) ? $settings['max_tilt'] : '';
		$perspective = isset( $settings['perspective'] ) ? $settings['perspective'] : '';
		$tilt_scale = isset( $settings['tilt_scale'] ) ? $settings['tilt_scale'] : '';
		$tilt_speed = isset( $settings['tilt_speed'] ) ? $settings['tilt_speed'] : '';
		
		$this->add_render_attribute( 'feature-box-container', 'class', 'elementor-widget-container feature-box-wrapper' );
		$this->add_render_attribute( 'feature-box-container', 'class', $feature_layout );
		if( $tilt_opt ){
			$this->add_render_attribute( 'feature-box-container', 'class', 'cea-tilt' );
			$this->add_render_attribute( 'feature-box-container', 'data-tilt_trans', $tilt_transition );
			$this->add_render_attribute( 'feature-box-container', 'data-max_tilt', $max_tilt );
			$this->add_render_attribute( 'feature-box-container', 'data-tilt_perspective', $perspective );
			$this->add_render_attribute( 'feature-box-container', 'data-tilt_scale', $tilt_scale );
			$this->add_render_attribute( 'feature-box-container', 'data-tilt_speed', $tilt_speed );
		}		
		
		?>
		<div <?php echo ''. $this->get_render_attribute_string( 'feature-box-container' ); ?>>
			<?php

			/**
			 * Render widget content.
			 *
			 * Filters the widget content before it's rendered.
			 *
			 * @since 1.0.0
			 *
			 * @param string      $widget_content The content of the widget.
			 * @param Widget_Base $this           The widget.
			 */
			$widget_content = apply_filters( 'elementor/widget/render_content', $widget_content, $this );

			echo $widget_content; // XSS ok.
			?>
		</div>
		<?php
	}
	 
	protected function render() {

		$settings = $this->get_settings_for_display();
		$this->_settings = $settings;
		extract( $settings );

		$redirect = isset( $redirect ) && $redirect == 'yes' ? true : false;

		//Title section
		$title = isset( $title ) && $title != '' ? $title : '';
		$title_head = isset( $title_head ) && $title_head != '' ? $title_head : 'h3';
		
		$this->title_array = array(
			'title' => $title,
			'title_url_opt' => false,
			'title_url' => '',
			'title_head' => $title_head,
			'title_redirect' => ''
		);
		
		//Number Section
		$fbox_number = isset( $fbox_number ) && $fbox_number != '' ? $fbox_number : ''; 
		$fbox_arr = array(
			'number_txt' => $fbox_number
		);
		
		//Icon Section
		$this->add_render_attribute( 'icon-wrapper', 'class', 'cea-featured-icon' );
		if ( ! empty( $settings['icon_animation'] ) ) {
			$this->add_render_attribute( 'icon-wrapper', 'class', 'cea-elementor-animation' );
		}
		if ( empty( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['icon'] = 'ti-heart';
		}
		if ( ! empty( $settings['icon'] ) ) {
			$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
		}		
		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$this->fbox_icon_array = array(
			'icon' => $settings['selected_icon'],
			'is_new' => $is_new,
			'migrated'	=> $migrated
		);
		
		//Image Section
		$img_class = $image_html = '';
		if ( ! empty( $settings['image']['url'] ) ) {
			$this->image_class = 'image_class';
			$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
			$this->add_render_attribute( 'image_class', 'class', 'img-fluid' );
			$this->add_render_attribute( 'image_class', 'class', $settings['img_style'] );

			if ( $settings['hover_animation'] ) {
				$this->add_render_attribute( 'image_class', 'class', 'elementor-animation-' . $settings['hover_animation'] );
				
			}
			$fbox_image = Classic_Elementor_Extension::cea_get_attachment_image_html( $settings, 'thumbnail', 'image', $this );
			$image_html = '<figure class="cea-feature-box-img">' . $fbox_image . '</figure>';
		}
		$this->fbox_img_array = array(
			'img_html' => $image_html
		);
		
		//Button Setion
		
		/*$this->fbox_btn_array = array(
			'btn_tag' => $btn_tag,
			'btn_txt' => $btn_text
		);*/
		
		//Video Section
		$fbox_video = isset( $fbox_video ) && !empty( $fbox_video ) ? $fbox_video : '';
		$this->fbox_video_array = array(
			'video' => $fbox_video,
		);
		
		//Layout Section
		$list_layout = isset( $layout ) && $layout == 'list' ? true : false;
		$elemetns = '';
		if( !$list_layout ){
			$default_items = array( 
				"icon"	=> esc_html__( "Icon", 'classic-elementor-addons-pro' ),
				"title"	=> esc_html__( "Title", 'classic-elementor-addons-pro' ),
				"content"	=> esc_html__( "Content", 'classic-elementor-addons-pro' )
			);
			$elemetns = isset( $fbox_items ) && !empty( $fbox_items ) ? json_decode( $fbox_items, true ) : array( 'Enabled' => $default_items );
		}else{
			$default_left_items = array( 
				"icon"	=> esc_html__( "Icon", 'classic-elementor-addons-pro' )
			);
			$default_right_items = array( 
				"title"	=> esc_html__( "Title", 'classic-elementor-addons-pro' ),
				"content"	=> esc_html__( "Content", 'classic-elementor-addons-pro' )
			);
			$elemetns = isset( $fbox_list_items ) && !empty( $fbox_list_items ) ? json_decode( $fbox_list_items, true ) : array( 'Left' => $default_left_items, 'Right' => $default_right_items );
		}
		
		//Content Section
		$this->fbox_content = isset( $content ) && $content != '' ? $content : ''; 

		if ( $redirect && !empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'fbox-link-wrapper', $settings['link'] );
			echo '<a '. $this->get_render_attribute_string( 'fbox-link-wrapper' ) .'>';
		}

		if( $list_layout ){	

			$content_full = isset( $content_full ) && $content_full == 'yes' ? true : false;
			$list_opps = isset( $list_position ) && $list_position == 'right' ? true : false;
			
			echo '<div class="media">';
			
				$this->add_render_attribute( 'media-icon-part', 'class', 'media-icon-part' );
				if ( $settings['icon_self_center'] == 'yes' ) {
					$this->add_render_attribute( 'media-icon-part', 'class', 'align-self-center' );
				}		
				
				if( !$list_opps ){
					echo '<div '. $this->get_render_attribute_string( 'media-icon-part' ) .'>';
						if( isset( $elemetns['Left'] ) && !empty( $elemetns['Left'] ) ) :
							foreach( $elemetns['Left'] as $element => $value ){
								$this->cea_fbox_shortcode_elements( $element, $fbox_arr );
							}
						endif;
					echo '</div>';
				}
				
				$this->add_render_attribute( 'media-body', 'class', 'media-body' );
				if ( $settings['content_self_center'] == 'yes' ) {
					$this->add_render_attribute( 'media-body', 'class', 'align-self-center' );
				}
				
				echo '<div '. $this->get_render_attribute_string( 'media-body' ) .'>';
					if( !$content_full && isset( $elemetns['Right'] ) && !empty( $elemetns['Right'] ) ) :
						foreach( $elemetns['Right'] as $element => $value ){
							$this->cea_fbox_shortcode_elements( $element, $fbox_arr );
						}
					elseif( isset( $elemetns['Right']['title'] ) ):
						$this->cea_fbox_shortcode_elements( 'title', $fbox_arr );
						unset( $elemetns['Right']['title'] );
					endif;					
				echo '</div><!-- .media-body -->';
			
				if( $list_opps ){
					echo '<div '. $this->get_render_attribute_string( 'media-icon-part' ) .'>';
						if( isset( $elemetns['Left'] ) && !empty( $elemetns['Left'] ) ) :
							foreach( $elemetns['Left'] as $element => $value ){
								$this->cea_fbox_shortcode_elements( $element, $fbox_arr );
							}
						endif;
					echo '</div>';
				}
				
			echo '</div><!-- .media -->';
			
			if( $content_full ) {
				echo '<div class="feature-box-fullwidth-info">';
					foreach( $elemetns['Right'] as $element => $value ){
						$this->cea_fbox_shortcode_elements( $element, $fbox_arr );
					}
				echo '</div>';
			}
		}else{
			echo '<div class="feature-box-inner">';
				if( isset( $elemetns['Enabled'] ) && !empty( $elemetns['Enabled'] ) ) :
					foreach( $elemetns['Enabled'] as $element => $value ){
						$this->cea_fbox_shortcode_elements( $element, $fbox_arr );
					}
				endif;
			echo '</div>';
		}
		
		if ( $redirect && !empty( $settings['link']['url'] ) ) {
			echo '</a><!-- .fbox link close -->';
		}

	}
	
	function cea_fbox_shortcode_elements( $element, $fbox_arr = array() ){
		
		$settings = $this->_settings;
		
		switch( $element ){
		
			case "title":
				$title_array = $this->title_array;
				if( $title_array['title'] ){
					if( $title_array['title_url_opt'] && $title_array['title_url'] != '' )
						echo '<'. esc_attr( $title_array['title_head'] ) .' class="feature-box-title"><a href="'. esc_url( $title_array['title_url'] ) .'" title="'. esc_attr( $title_array['title'] ) .'" target="'. esc_attr( $title_array['title_redirect'] ) .'">'. esc_html( $title_array['title'] ) .'</a></'. esc_attr( $title_array['title_head'] ) .'>';
					else
						echo '<'. esc_attr( $title_array['title_head'] ) .' class="feature-box-title">'. esc_html( $title_array['title'] ) .'</'. esc_attr( $title_array['title_head'] ) .'>';
				}
			break;
			
			case "icon":
				if( $this->fbox_icon_array['icon'] ){
					echo '<div '. $this->get_render_attribute_string( 'icon-wrapper' ) .'>';
						if ( $this->fbox_icon_array['is_new'] || $this->fbox_icon_array['migrated'] ) :
							Icons_Manager::render_icon( $this->fbox_icon_array['icon'], [ 'aria-hidden' => 'true' ] );
						else : ?>
							<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
						<?php endif; 
					echo '</div>';
				}
			break;
			
			case "image":
				echo ''. $this->fbox_img_array['img_html'];
			break;
			
			case "content":
				if( $this->fbox_content ) echo '<div class="fbox-content">'. $this->fbox_content .'</div>';
			break;
			
			case "btn":
				$this->add_render_attribute( 'button-wrapper', 'class', 'cea-button-wrapper' );
				if ( ! empty( $settings['button_link']['url'] ) ) {
					$this->add_link_attributes( 'button', $settings['button_link'] );
					$this->add_render_attribute( 'button', 'class', 'cea-button-link' );
				}
				if ( $settings['button_type'] != 'none' ) {
					$this->add_render_attribute( 'button', 'class', 'cea-button-' . $settings['button_type'] );
				}
				$this->add_render_attribute( 'button', 'class', 'elementor-button cea-button' );
				if ( ! empty( $settings['button_css_id'] ) ) {
					$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
				}
				if ( ! empty( $settings['button_size'] ) ) {
					$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['button_size'] );
				}
				if ( $settings['button_hover_animation'] ) {
					$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
				}
				?>
				<div <?php echo $this->get_render_attribute_string( 'button-wrapper' ); ?>>
					<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
						<?php $this->button_render_text(); ?>
					</a>
				</div>
				<?php
			break;
			
			case "video":
				if( $this->fbox_video_array ){
					echo'<div class="feature-box-video">';
						echo do_shortcode( '[videoframe url="'. esc_url( $this->fbox_video_array['video'] ) .'" width="100%" height="100%" params="byline=0&portrait=0&badge=0" /]' );
					echo'</div><!-- .feature-box-video -->';
				}
			break;
			
			case "number":
				$number_txt = isset( $fbox_arr['number_txt'] ) ? $fbox_arr['number_txt'] : '';
				if( $number_txt ) echo '<div class="fbox-number">'. esc_html( $number_txt ) .'</div>';
			break;			
		
		}
	}
	
	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function button_render_text() {
		$settings = $this->get_settings_for_display();

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		if ( ! $is_new && empty( $settings['icon_align'] ) ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			//old default
			$settings['icon_align'] = $this->get_settings( 'icon_align' );
		}

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'cea-button-content-wrapper',
			],
			'icon-align' => [
				'class' => [
					'cea-button-icon',
					'cea-align-icon-' . $settings['button_icon_align'],
				],
			],
			'text' => [
				'class' => 'cea-button-text',
			],
		] );

		$this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['button_icon'] ) || ! empty( $settings['button_icon']['value'] ) ) : ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<?php if ( $is_new || $migrated ) :
					Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
				else : ?>
					<i class="<?php echo esc_attr( $settings['button_icon'] ); ?>" aria-hidden="true"></i>
				<?php endif; ?>
			</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['button_text']; ?></span>
		</span>
		<?php
	}
	
}
<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Classic_Elementor_Addons\Helper\Post_Helper as Cea_Post_Helper;

/**
 * Classic Elementor Addon Service Widget
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Service_Widget extends Widget_Base {
	use Cea_Post_Helper;
	private $excerpt_len;
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Service widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
                          return "ceaservice";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Service widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Service", "cea-post-types" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Service widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layout-cta-center";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Animated Text widget belongs to.
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
		return [ 'tilt', 'magnific-popup', 'owl-carousel', 'imagesloaded', 'infinite-scroll', 'isotope', 'cea-custom-front' ];
	}
	
	public function get_style_depends() {
		return [ 'magnific-popup','owl-carousel' ];
	}

	/**
	 * Register Animated Text widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$helper_instance = new CEA_Elementor_Service_Widget(); 

		//get authors
		$authors = $helper_instance->cea_get_authors();

		//get categories
		$categories = $helper_instance->cea_post_type_taxonomies( 'term_id', 'service-categories' );
	
		//get post titles
		$post_titles = $helper_instance->cea_get_post_titles( 'cea-service' );
		
		//orderby options
		$order_by = $helper_instance->cea_get_post_orderby_options();
		
		
		//General Section
		$this->start_controls_section(
			"general_section",
			[
				"label"	=> esc_html__( "General", "cea-post-types" ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default service options.", "cea-post-types" ),
			]
		);
		$this->add_control(
			"extra_class",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Extra Class", "cea-post-types" ),
				"description"	=> esc_html__( "Put extra class for some additional styles.", "cea-post-types" ),
			]
		);
		$this->end_controls_section();
		
		//Query Section
		$this->start_controls_section(
			"query_section",
			[
				"label"	=> esc_html__( "Query", "cea-post-types" ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Service query options.", "cea-post-types" ),
			]
		);
		$this->add_control(
			"post_per_page",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Post Per Page", "cea-post-types" ),
				"description"	=> esc_html__( "Here you can define post limits per page. Example 10", "cea-post-types" ),
				"default" 		=> "10",
				"placeholder"	=> "10"
			]
		);
		$this->add_control(
			'include_author',
			[
				'label' 		=> __( 'Author', 'cea-post-types' ),
				"description"	=> esc_html__( "This is filter author posts.", "cea-post-types" ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $authors,
				'default' 		=> '',
			]
		);
		$this->add_control(
			'include_cats',
			[
				'label' 		=> __( 'Categories', 'cea-post-types' ),
				"description"	=> esc_html__( "This is filter categories. Enter and select which categories you want. If you don't want top filter, then leave this empty.", "cea-post-types" ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $categories,
				'default' 		=> '',
			]
		);
		$this->add_control(
			'exclude_cats',
			[
				'label' 		=> __( 'Exclude Categories', 'cea-post-types' ),
				"description"	=> esc_html__( "Here you can mention unwanted categories", "cea-post-types" ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $categories,
				'default' 		=> '',
			]
		);
		$this->add_control(
			'include_posts',
			[
				'label' 		=> __( 'Include Posts', 'cea-post-types' ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $post_titles,
				'default' 		=> '',
			]
		);
		$this->add_control(
			'exclude_posts',
			[
				'label' 		=> __( 'Exclude Posts', 'cea-post-types' ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $post_titles,
				'default' 		=> '',
			]
		);
		$this->add_control(
			'orderby',
			[
				'label' 		=> __( 'Order By', 'cea-post-types' ),
				'type' 			=> Controls_Manager::SELECT,
				'label_block'	=> true,
				'options' 		=> $order_by,
				'default' 		=> 'none',
			]
		);
		$this->add_control(
			'order',
			[
				'label' 		=> __( 'Order', 'cea-post-types' ),
				'type' 			=> Controls_Manager::SELECT,
				'label_block'	=> true,
				'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending',
                ],
				'default' 		=> 'desc',
			]
		);
		$this->end_controls_section();
		
		//Layouts Section
		$this->start_controls_section(
			"layouts_section",
			[
				"label"			=> esc_html__( "Layouts", "cea-post-types" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Post layout options here available.", "cea-post-types" ),
			]
		);
		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'cea-post-types' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'cea-post-types' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'cea-post-types' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'cea-post-types' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'cea-post-types' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .service-wrapper .service-inner' => 'text-align: {{VALUE}};',
				],
			]
		);		
		$this->add_control(
			"excerpt_length",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Excerpt Length", "cea-post-types" ),
				"description"	=> esc_html__( "Here you can define post excerpt length. Example 10", "cea-post-types" ),
				"default" 		=> "15",
			]
		);
		$this->add_control(
			"service_layout",
			[
				"label"			=> esc_html__( "Post Layout", "cea-post-types" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "default",
				"options"		=> [
					"default"		=> esc_html__( "Default", "cea-post-types" ),
					"classic"		=> esc_html__( "Classic", "cea-post-types" ),
					"modern"		=> esc_html__( "Modern", "cea-post-types" ),
					"classic-pro"		=> esc_html__( "Classic Pro", "cea-post-types" ),
					"list"	=> esc_html__( "List", "cea-post-types" ),
				]
			]
		);
		$this->add_control(
			"service_cols",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Columns on Desktop", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service columns.", "cea-post-types" ),
				"default"		=> "6",
				"options"		=> [
					"3"			=> esc_html__( "4 Columns", "cea-post-types" ),
					"4"			=> esc_html__( "3 Columns", "cea-post-types" ),
					"6"			=> esc_html__( "2 Columns", "cea-post-types" ),
					"12"		=> esc_html__( "1 Column", "cea-post-types" )
				]
			]
		);
		$this->add_control(
			"service_cols_tab",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Columns on Tab", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service columns on Tablets.", "cea-post-types" ),
				"default"		=> "6",
				"options"		=> [
					"3"			=> esc_html__( "4 Columns", "cea-post-types" ),
					"4"			=> esc_html__( "3 Columns", "cea-post-types" ),
					"6"			=> esc_html__( "2 Columns", "cea-post-types" ),
					"12"		=> esc_html__( "1 Column", "cea-post-types" )
				]
			]
		);
		$this->add_control(
			"service_cols_mbl",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Columns on Mobile", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service columns on Mobile.", "cea-post-types" ),
				"default"		=> "12",
				"options"		=> [
					"3"			=> esc_html__( "4 Columns", "cea-post-types" ),
					"4"			=> esc_html__( "3 Columns", "cea-post-types" ),
					"6"			=> esc_html__( "2 Columns", "cea-post-types" ),
					"12"		=> esc_html__( "1 Column", "cea-post-types" )
				]
			]
		);
		$this->add_control(
			'service_load_more',
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Load More", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service load more.", "cea-post-types" ),
				"default"		=> "none",
				"options"		=> [
					"none"		=> esc_html__( "None", "cea-post-types" ),
					"button"	=> esc_html__( "Load More Button", "cea-post-types" ),
					"scroll"	=> esc_html__( "Load More Scroll", "cea-post-types" ),
				]
			]
		);
		$this->add_control(
			"more_text",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Read More Text", "cea-post-types" ),
				"description"	=> esc_html__( "Here you can enter read more text instead of default text.", "cea-post-types" ),
				"default" 		=> esc_html__( "Read More", "cea-post-types" )
			]
		);	
		$this->add_control(
			"service_masonry",
			[
				"label"         => esc_html__( "Service Masonry", "cea-post-types" ),
				"description"   => esc_html__( "Option for service masonry layout.", "cea-post-types" ),
				"type"          => Controls_Manager::SWITCHER,
				"default"       => "no",
				"condition"     => [
					"service_layout!" => "list",
				]
			]
		);
		$this->add_control(
			"service_gutter",
			[
				"type"          => Controls_Manager::TEXT,
				"label"         => esc_html__( "Service Masonry Gutter", "cea-post-types" ),
				"description"   => esc_html__( "Specify the gutter size for the service masonry layout. Example: 30", "cea-post-types" ),
				"default"       => "10",
				"condition"     => [
					"service_masonry" => "yes",
					"service_layout!" => "list"
				]
			]
		);
		$this->add_control(
			"lazy_load",
			[
				"label"			=> esc_html__( "Lazy Load", "cea-post-types" ),
				"description"	=> esc_html__( "Enabel lazy load option for load isotope grids lazy with animation.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"service_masonry" => "yes",
					"service_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"isotope_filter",
			[
				"label"			=> esc_html__( "Isotope Filter", "cea-post-types" ),
				"description"	=> esc_html__( "Enabel to show service filter by category.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"service_masonry" => "yes",
					"service_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"filter_all",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Filter All Text", "cea-post-types" ),
				"description"	=> esc_html__( "Here you can mention service's first filter text.", "cea-post-types" ),
				"default" 		=> esc_html__( "All", "cea-post-types" ),
				"condition" 	=> [
					"isotope_filter" 		=> "yes",
					"service_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"masonry_layout",
			[
				"label"			=> esc_html__( "Masonry Layout", "cea-post-types" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "masonry",
				"options"		=> [
					"masonry"		=> esc_html__( "Masonry", "cea-post-types" ),
					"fitRows"		=> esc_html__( "Fit Rows", "cea-post-types" )
				],
				"condition" 	=> [
					"service_masonry" => "yes",
					"service_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"service_infinite",
			[
				"label"			=> esc_html__( "Post Masonry Infinite", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service masonry infinite scroll.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"service_masonry" => "yes",
					"service_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"loading_msg",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Infinite Loading Message", "cea-post-types" ),
				"description"	=> esc_html__( "Here you can mention infinite loading post message.", "cea-post-types" ),
				"default" 		=> esc_html__( "Loading posts..", "cea-post-types" ),
				"condition" 	=> [
					"service_infinite" 		=> "yes",
					"service_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"loading_end",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Infinite Ending Message", "cea-post-types" ),
				"description"	=> esc_html__( "Here you can mention infinite loading ending message.", "cea-post-types" ),
				"default" 		=> esc_html__( "No more post.", "cea-post-types" ),
				"condition" 	=> [
					"service_infinite" 		=> "yes",
					"service_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			'loading_img',
			[
				'label' => __( 'Infinite Loader Image URL', 'cea-post-types' ),
				"description"	=> esc_html__( "Here you can choose infinite loader image.", "cea-post-types" ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '',
				],
				"condition" 	=> [
					"service_infinite" 		=> "yes",
					"service_layout!" 		=> "list"
				]
			]
		);
		$this->add_control(
			"service_pagination",
			[
				"label" 		=> esc_html__( "Post Pagination", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"service_masonry!" 		=> "yes"
				]
			]
		);
		$this->add_control(
			"variation",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Post Variation", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service variatoin either dark or light.", "cea-post-types" ),
				"default"		=> "light",
				"options"		=> [
					"light"			=> esc_html__( "Light", "cea-post-types" ),
					"dark"			=> esc_html__( "Dark", "cea-post-types" )
				]
			]
		);
		$this->add_control(
			"post_items",
			[
				"label"				=> "Post Items",
				"description"		=> esc_html__( "This is settings for service custom layout. here you can set your own layout. Drag and drop needed service items to Enabled part.", "cea-post-types" ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					"Enabled" 		=> [ 
						"thumb"			=> esc_html__( "Feature Image", "cea-post-types" ),
						"title"			=> esc_html__( "Title", "cea-post-types" ),
						"excerpt"		=> esc_html__( "Excerpt", "cea-post-types" )
					],
					"disabled"		=> [
						"top-meta"		=> esc_html__( "Top Meta", "cea-post-types" ),
						"bottom-meta"	=> esc_html__( "Bottom Meta", "cea-post-types" ),
						"author"		=> esc_html__( "Author", "cea-post-types" ),
						"icon"			=> esc_html__( "Icon Image", "cea-post-types" ),
						"category"      => esc_html__( "Category", "cea-post-types" )
					]
				]
			]
		);
		$this->add_control(
			"post_overlay_items_opt",
			[
				"label" 		=> esc_html__( "Post Overlay Items Options", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"post_overlay_items",
			[
				"label"			=> "Post Overlay Items",
				"description"	=> esc_html__( "This is settings for service shortcode post overlay items.", "cea-post-types" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Enabled", "cea-post-types" ) => [],
					esc_html__( "disabled", "cea-post-types" ) => [
						'author'	=> esc_html__( 'Author', 'cea-post-types' ),
						'more'	=> esc_html__( 'Read More', 'cea-post-types' ),
						'date'	=> esc_html__( 'Date', 'cea-post-types' ),
						'title'	=> esc_html__( 'Title', 'cea-post-types' ),
						"top-meta"		=> esc_html__( "Top Meta", "cea-post-types" ),
						"bottom-meta"	=> esc_html__( "Bottom Meta", "cea-post-types" )
					]
				],
				"condition" 	=> [
					"post_overlay_items_opt" 		=> "yes"
				]
			]
		);
		$this->add_control(
			"top_meta",
			[
				"label"			=> "Post Top Meta",
				"description"	=> esc_html__( "This is settings for service shortcode post top meta.", "cea-post-types" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Left", "cea-post-types" ) => [],
					esc_html__( "Right", "cea-post-types" ) => [],
					esc_html__( "disabled", "cea-post-types" ) => [
						'author'	=> esc_html__( 'Author', 'cea-post-types' ),
						'more'	=> esc_html__( 'Read More', 'cea-post-types' ),
						'date'	=> esc_html__( 'Date', 'cea-post-types' ),
						'category' => esc_html__( 'Category', 'cea-post-types' ),
					]
				]
			]
		);
		$this->add_control(
			"bottom_meta",
			[
				"label"			=> "Post Bottom Meta",
				"description"	=> esc_html__( "This is settings for service shortcode post bottom meta.", "cea-post-types" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Left", "cea-post-types" ) => [],
					esc_html__( "Right", "cea-post-types" ) => [],
					esc_html__( "disabled", "cea-post-types" ) => [
						'author'	=> esc_html__( 'Author', 'cea-post-types' ),
						'more'	=> esc_html__( 'Read More', 'cea-post-types' ),
						'date'	=> esc_html__( 'Date', 'cea-post-types' ),
						'category' => esc_html__( 'Category', 'cea-post-types' ),
					]
				]
			]
		);
		$this->end_controls_section();
		
		//Title Section
		$this->start_controls_section(
			"title_section",
			[
				"label"			=> esc_html__( "Title", "cea-post-types" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Title options here available.", "cea-post-types" ),
			]
		);
		$this->add_control(
			"post_heading",
			[
				"label"			=> esc_html__( "Post Heading Tag", "cea-post-types" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h3",
				"options"		=> [
					"h1"		=> esc_html__( "h1", "cea-post-types" ),
					"h2"		=> esc_html__( "h2", "cea-post-types" ),
					"h3"		=> esc_html__( "h3", "cea-post-types" ),
					"h4"		=> esc_html__( "h4", "cea-post-types" ),
					"h5"		=> esc_html__( "h5", "cea-post-types" ),
					"h6"		=> esc_html__( "h6", "cea-post-types" )
				]
			]
		);		
		$this->end_controls_section();
		
		//Image Section
		$this->start_controls_section(
			"image_section",
			[
				"label"			=> esc_html__( "Image", "cea-post-types" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Image options here available.", "cea-post-types" ),
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
		
		//Slide Section
		$this->start_controls_section(
			"slide_section",
			[
				"label"			=> esc_html__( "Slide", "cea-post-types" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Service slide options here available.", "cea-post-types" ),
				"condition" 	=> [
					"extent_opt!" => "yes"
				]
			]
		);
		$this->add_control(
			"slide_opt",
			[
				"label" 		=> esc_html__( "Slide Option", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slider option.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_item",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Slide Items", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slide items shown on large devices.", "cea-post-types" ),
				"default" 		=> "2",
			]
		);
		$this->add_control(
			"slide_item_tab",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items on Tab", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slide items shown on tab.", "cea-post-types" ),
				"default" 		=> "2",
			]
		);
		$this->add_control(
			"slide_item_mobile",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items on Mobile", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slide items shown on mobile.", "cea-post-types" ),
				"default" 		=> "1",
			]
		);
		$this->add_control(
			"slide_item_autoplay",
			[
				"label" 		=> esc_html__( "Auto Play", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slider auto play.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_item_loop",
			[
				"label" 		=> esc_html__( "Loop", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slider loop.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_center",
			[
				"label" 		=> esc_html__( "Items Center", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slider center, for this option must active loop and minimum items 2.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_nav",
			[
				"label" 		=> esc_html__( "Navigation", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slider navigation.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_dots",
			[
				"label" 		=> esc_html__( "Pagination", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slider pagination.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_margin",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Margin", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slider margin space.", "cea-post-types" ),
				"default" 		=> "",
			]
		);
		$this->add_control(
			"slide_duration",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Duration", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slider duration.", "cea-post-types" ),
				"default" 		=> "5000",
			]
		);
		$this->add_control(
			"slide_smart_speed",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Smart Speed", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slider smart speed.", "cea-post-types" ),
				"default" 		=> "250",
			]
		);
		$this->add_control(
			"slide_slideby",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Slideby", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service slider scroll by.", "cea-post-types" ),
				"default" 		=> "1",
			]
		);
		$this->end_controls_section();

        // Image Accordion Section
		$this->start_controls_section(
			"img_zoom_section",
			[
				"label"			=> esc_html__( "Image Accordion", "cea-post-types" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"condition"		=> [
					"slide_opt!"	=> "yes"
				]
			]
		);
		$this->add_control(
			"extent_opt",
			[
				"label" 		=> esc_html__( "Image Accordion Option", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for service image accordion option.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"extent_ppp",
			[
				"label"			=> esc_html__( "Enter the Number of Images", "cea-post-types" ),
				"description"   => esc_html__( "This options determines how many image should be displayed", "cea-post-types" ),
				"type"			=> Controls_Manager::TEXT,
				"default"		=> "4",
				"condition"     => [
					"extent_opt"	=> "yes"
				],
			]
		);
		$this->add_control(
            'accordion_style',
            [
                'label'         => esc_html__('Layout Style', 'cea-post-types'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'horizontal'    => esc_html__('Horizontal', 'cea-post-types'),
                    'vertical'      => esc_html__('Vertical', 'cea-post-types'),
                ],
                'default'       => 'horizontal',
				"condition"     => [
					"extent_opt"	=> "yes"
				],
				"separator"	=> "after",
            ]
        );
        $this->add_control(
			'accordion_break_pts', 
			[
				'label'         => esc_html__('Breakpoint', 'cea-post-types'),
				'description'   => esc_html__( 'At which point the Horizontal Accordion should change into vertical for responsive', 'cea-post-types' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'none'    => esc_html__('None', 'cea-post-types'),
                    'mobile'      => esc_html__('Mobile Portrait (> 768px)', 'cea-post-types'),
                    'tablet'      => esc_html__('Tablet Portrait (> 1024px)', 'cea-post-types'),
                ],
				'default' => 'none'
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_hr_effect',
			[
				'label' => __( 'Effects', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB,
			]
		);
		$this->add_control(
            'enable_mouse_hover',
            [
                'label'   => __('Enable Mouse Hover?', 'cea-post-types'),
                'type'    => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
		$this->add_control(
            'mouse_hover_animation',
            [
                'label'       => __('Choose Text to Show on Hover', 'cea-post-types'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'multiple'    => true,
                'label_block' => true,
                'default'     => ['title'],
                'options'     => [
                    'title'    => __('Title', 'cea-post-types'),
                    'category' => __('Category', 'cea-post-types'),
                ],
                'condition'   => [
                    'enable_mouse_hover' => 'yes',
                ],
            ]
        );
        $this->add_control(
			'mouse_hvr_hide',
			[
				'label' 	=> __( 'Cursor Visibility', 'cea-post-types' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'options'	=> [
					'auto'	=> 	__( 'Visible', 'cea-post-types' ),
					'none'	=>  __( 'Hide', 'cea-post-types' ),
				],
				'condition'   => [
                    'enable_mouse_hover' => 'yes',
                ],
				'selectors'	=> [
					'{{WRAPPER}} .cursor-hover-content'	=> 'cursor: {{VALUE}};',
					'{{WRAPPER}} .cursor-hover-content > *'	=> 'cursor: {{VALUE}};',
					'{{WRAPPER}} .cursor-hover-content a'	=> 'cursor: {{VALUE}};'
				],
				'default'	=> 'auto',
				'separator'	=> 'before',
			]
		);
		$this->end_controls_section();
		
		// Link Section
		$this->start_controls_section(
			'section_link',
			[
				'label' => __( 'Links', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB,
			]
		);
		$this->add_control(
			'image_link',
			[
				'label' => __( 'Image', 'cea-post-types' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"image_target",
			[
				"label" 		=> esc_html__( "Target Blank", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"image_nofollow",
			[
				"label" 		=> esc_html__( "No Follow", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'title_link',
			[
				'label' => __( 'Title', 'cea-post-types' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"title_target",
			[
				"label" 		=> esc_html__( "Target Blank", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"title_nofollow",
			[
				"label" 		=> esc_html__( "No Follow", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'more_link',
			[
				'label' => __( 'Read More', 'cea-post-types' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"more_target",
			[
				"label" 		=> esc_html__( "Target Blank", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"more_nofollow",
			[
				"label" 		=> esc_html__( "No Follow", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->end_controls_section();
		
		// Style Post Section
		$this->start_controls_section(
			'section_style_post',
			[
				'label' => __( 'Post Grid', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->start_controls_tabs( 'tabs_post_style' );
		$this->start_controls_tab(
			'tab_post_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'post_color',
			[
				'label' => esc_html__( 'Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-inner' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_bg_color',
			[
				'label' => esc_html__( 'Background', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-inner' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_shadow',
				'selector' => '{{WRAPPER}} .service-inner',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_post_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'post_hcolor',
			[
				'label' => esc_html__( 'Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-inner:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_bg_hcolor',
			[
				'label' => esc_html__( 'Background', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-inner:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_hshadow',
				'selector' => '{{WRAPPER}} .service-inner:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'post_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-post-types' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .service-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		
		// Style Title Section
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"title_text_trans",
			[
				"label"			=> esc_html__( "Title Transform", "cea-post-types" ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Set title text-transform property.", "cea-post-types" ),
				"default"		=> "none",
				"options"		=> [
					"none"			=> esc_html__( "Default", "cea-post-types" ),
					"capitalize"	=> esc_html__( "Capitalized", "cea-post-types" ),
					"uppercase"		=> esc_html__( "Upper Case", "cea-post-types" ),
					"lowercase"		=> esc_html__( "Lower Case", "cea-post-types" )
				],
				'selectors' => [
					'{{WRAPPER}} .post-title-head .post-title' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-title-head .post-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_scale',
			[
				'label' => esc_html__( 'Scale', 'cea-post-types' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .post-title-head' => 'transform: scale({{SIZE}});'
				],
			]
		);	
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-post-types' ),
			]
		);		
		$this->add_control(
			'title_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-inner:hover .post-title-head .post-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_hscale',
			[
				'label' => esc_html__( 'Scale', 'cea-post-types' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .service-inner:hover .post-title-head' => 'transform: scale({{SIZE}});'
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'margin', 'cea-post-types' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .post-title-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-post-types' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .post-title-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-post-types' ),
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
					'{{WRAPPER}} .post-title-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .post-title-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'selector' 		=> '{{WRAPPER}} .post-title-head'
			]
		);		
		$this->end_controls_section();
		

		// Style Category Section
		$this->start_controls_section(
			'section_style_service_category',
			[
				'label' => __( 'Category', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
				"category_text_service_trans",
				[
					"label"			=> esc_html__( "Category Transform", "cea-post-types" ),
					"type"			=> Controls_Manager::SELECT,
					"description"	=> esc_html__( "Set title text-transform property.", "cea-post-types" ),
					"default"		=> "none",
					"options"		=> [
						"none"			=> esc_html__( "Default", "cea-post-types" ),
						"capitalize"	=> esc_html__( "Capitalized", "cea-post-types" ),
						"uppercase"		=> esc_html__( "Upper Case", "cea-post-types" ),
						"lowercase"		=> esc_html__( "Lower Case", "cea-post-types" )
					],
					'selectors' => [
						'{{WRAPPER}} .post-category' => 'text-transform: {{VALUE}};'
					],
				]
			);
			$this->start_controls_tabs( 'tabs_service_category_style' );
			$this->start_controls_tab(
				'tab_service_category_normal',
				[
					'label' => esc_html__( 'Normal', 'cea-post-types' ),
				]
			);
			$this->add_control(
				'service_category_color',
				[
					'label' => esc_html__( 'Color', 'cea-post-types' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .post-category a' => 'color: {{VALUE}};', // Adjusted selector
					],
				]
			);
			$this->add_responsive_control(
				'service_category_scale',
				[
					'label' => esc_html__( 'Scale', 'cea-post-types' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 1,
					],
					'range' => [
						'px' => [ 	
							'min' => 0.1,
							'max' => 5,
							'step' => 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .post-category' => 'transform: scale({{SIZE}});'
					],
				]
			);	
			$this->end_controls_tab();
			$this->start_controls_tab(
				'service_tab_category_hover',
				[
					'label' => esc_html__( 'Hover', 'cea-post-types' ),
				]
			);		
			$this->add_control(
				'category_hcolor',
				[
					'label' => esc_html__( 'Hover Color', 'cea-post-types' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .post-category:hover a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'category_hscale',
				[
					'label' => esc_html__( 'Scale', 'cea-post-types' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 1,
					],
					'range' => [
						'px' => [
							'min' => 0.1,
							'max' => 5,
							'step' => 0.1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .post-category:hover' => 'transform: scale({{SIZE}});'
					],
				]
			);	
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_responsive_control(
				'category_margin',
				[
					'label' => esc_html__( 'margin', 'cea-post-types' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .post-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'category_padding',
				[
					'label' => esc_html__( 'Padding', 'cea-post-types' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .post-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'category_spacing',
				[
					'label' => esc_html__( 'Spacing', 'cea-post-types' ),
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
						'{{WRAPPER}} .post-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
						'(mobile){{WRAPPER}} .post-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 			=> 'category_typography',
					'selector' 		=> '{{WRAPPER}} .post-category'
				]
			);
			$this->end_controls_section();

		// Style Link Section
		$this->start_controls_section(
			'section_style_link',
			[
				'label' => __( 'Links', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'post_links',
			[
				'label' => __( 'Default Post Links', 'cea-post-types' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_link_style' );
		$this->start_controls_tab(
			'tab_link_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_link_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-post-types' ),
			]
		);		
		$this->add_control(
			'link_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a:hover' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'post_tmetalinks',
			[
				'label' => __( 'Top Meta Links', 'cea-post-types' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_tmetalink_style' );
		$this->start_controls_tab(
			'tab_tmetalink_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'tmetalink_color',
			[
				'label' => esc_html__( 'Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .top-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_tmetalink_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-post-types' ),
			]
		);		
		$this->add_control(
			'tmetalink_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .top-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'post_bmetalinks',
			[
				'label' => __( 'Bottom Meta Links', 'cea-post-types' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_bmetalink_style' );
		$this->start_controls_tab(
			'tab_bmetalink_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'bmetalink_color',
			[
				'label' => esc_html__( 'Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bottom-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_bmetalink_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-post-types' ),
			]
		);		
		$this->add_control(
			'bmetalink_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bottom-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'post_ometalinks',
			[
				'label' => __( 'Overlay Links', 'cea-post-types' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_ometalink_style' );
		$this->start_controls_tab(
			'tab_ometalink_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'ometalink_color',
			[
				'label' => esc_html__( 'Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-overlay-items a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_ometalink_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-post-types' ),
			]
		);		
		$this->add_control(
			'ometalink_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-overlay-items a:hover' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		// Style Image Section
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"img_style",
			[
				"label"			=> esc_html__( "Image Style", "cea-post-types" ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Choose image style.", "cea-post-types" ),
				"default"		=> "squared",
				"options"		=> [
					"squared"			=> esc_html__( "Squared", "cea-post-types" ),
					"rounded"			=> esc_html__( "Rounded", "cea-post-types" ),
					"rounded-circle"	=> esc_html__( "Circled", "cea-post-types" )
				]
			]
		);
		$this->add_control(
			"resize_opt",
			[
				"label" 		=> esc_html__( "Resize Option", "cea-post-types" ),
				"description"	=> esc_html__( "Enable resize option.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__( 'Image Size', 'cea-post-types' ),
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
					'{{WRAPPER}} .post-thumb > a > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
				],
			]
		);
		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => esc_html__( 'Image Spacing', 'cea-post-types' ),
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
					'{{WRAPPER}} .post-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);	
		$this->add_control(
			'img_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-thumb > a > img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'img_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-post-types' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .post-thumb > a > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'img_border',
					'label' => esc_html__( 'Border', 'cea-post-types' ),
					'selector' => '{{WRAPPER}} .post-thumb > a > img'
				]
		);
		$this->end_controls_section();
		
		// Style Button Section
		$this->start_controls_section(
			'button_section_style',
			[
				'label' => esc_html__( 'Read More Button', 'cea-post-types' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .read-more',
			]
		);
		$this->add_control(
			"btn_text_trans",
			[
				"label"			=> esc_html__( "Transform", "cea-post-types" ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Set read more button text-transform property.", "cea-post-types" ),
				"default"		=> "none",
				"options"		=> [
					"none"			=> esc_html__( "Default", "cea-post-types" ),
					"capitalize"	=> esc_html__( "Capitalized", "cea-post-types" ),
					"uppercase"		=> esc_html__( "Upper Case", "cea-post-types" ),
					"lowercase"		=> esc_html__( "Lower Case", "cea-post-types" )
				],
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );		
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read-more:hover, {{WRAPPER}} .read-more:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .read-more:hover svg, {{WRAPPER}} .read-more:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read-more:hover, {{WRAPPER}} .read-more:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read-more:hover, {{WRAPPER}} .read-more:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .read-more',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea-post-types' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .read-more',
			]
		);
		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-post-types' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'selector' 		=> '{{WRAPPER}} .read-more'
			]
		);
		$this->end_controls_section();	
		
		// Style Image Section
		$this->start_controls_section(
			'section_style_icon_image',
			[
				'label' => __( 'Icon Image', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"icon_img_resize_opt",
			[
				"label" 		=> esc_html__( "Resize Option", "cea-post-types" ),
				"description"	=> esc_html__( "Enable resize option.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			'icon_image_size',
			[
				'label' => esc_html__( 'Image Size', 'cea-post-types' ),
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
					'icon_img_resize_opt' => 'yes',	
				],
				'selectors' => [
					'{{WRAPPER}} .service-icon-img-wrap > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
				],
			]
		);
		$this->add_responsive_control(
			'icon_image_spacing',
			[
				'label' => esc_html__( 'Image Spacing', 'cea-post-types' ),
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
					'{{WRAPPER}} .service-icon-img-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);	
		$this->add_control(
			'icon_img_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-icon-img-wrap > img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_img_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-post-types' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .service-icon-img-wrap > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		
		// Style Meta Section
		$this->start_controls_section(
			'section_style_meta',
			[
				'label' => __( 'Meta', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->add_control(
			'top_meta_style',
			[
				'label' => __( 'Top Meta', 'cea-post-types' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'topmeta_typography',
				'selector' 		=> '{{WRAPPER}} .top-meta'
			]
		);	
		$this->add_responsive_control(
			'topmeta_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-post-types' ),
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
					'{{WRAPPER}} .top-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .top-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'bottom_meta_style',
			[
				'label' => __( 'Bottom Meta', 'cea-post-types' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'bottommeta_typography',
				'selector' 		=> '{{WRAPPER}} .bottom-meta'
			]
		);	
		$this->add_responsive_control(
			'bottommeta_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-post-types' ),
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
					'{{WRAPPER}} .bottom-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .bottom-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		// Style Content Section
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->start_controls_tabs( 'tabs_content_style' );
		$this->start_controls_tab(
			'tab_content_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-inner .post-excerpt' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'content_hcolor',
			[
				'label' => esc_html__( 'Color', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .service-inner:hover .post-excerpt' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .post-excerpt'
			]
		);	
		$this->add_responsive_control(
			'content_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-post-types' ),
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
					'{{WRAPPER}} .post-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .post-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		// Style Overlay Section
		$this->start_controls_section(
			'section_style_overlay',
			[
				'label' => __( 'Overlay', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'ovelay_typography',
				'selector' 		=> '{{WRAPPER}} .post-overlay-items'
			]
		);	
		$this->add_responsive_control(
			'overlay_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-post-types' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .post-overlay-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'overlay_position_top',
			[
				'label' => esc_html__( 'Position Top', 'cea-post-types' ),
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
					'{{WRAPPER}} .post-overlay-items' => 'position: absolute; top: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'overlay_position_left',
			[
				'label' => esc_html__( 'Position Left', 'cea-post-types' ),
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
					'{{WRAPPER}} .post-overlay-items' => 'left: {{SIZE}}%;',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_overlay_style' );
		$this->start_controls_tab(
			'tab_overlay_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'overlay_bg_color',
			[
				'label' => esc_html__( 'Background', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-thumb.post-overlay-active:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_overlay_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-post-types' ),
			]
		);
		$this->add_control(
			'overlay_bg_hcolor',
			[
				'label' => esc_html__( 'Background', 'cea-post-types' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-thumb.post-overlay-active:hover:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();	

		// Image Accordion Style
		$this->start_controls_section(
			"img_accordion_style",
			[
				"label"			=> esc_html__( "Image Accordion Styles", "cea-post-types" ),
				"tab"			=> Controls_Manager::TAB_STYLE,
				"condition"		=> [
					"extent_opt"	=> "yes"
				]
			]
		);
		$this->add_responsive_control(
			'img_acc_gap',
			[
				"label" 		=> esc_html__( "Accordion Gap", "cea-post-types" ),
				"type"			=> Controls_Manager::SLIDER,
				"size_units"	=> [ 'px', '%', 'rem', 'em' ],
				"default"       => [
					"size" => 2,
					"unit" => '%',
				],
				"range"         => [
					"px" => [
						"min" => 0,
						"max" => 1200,
					],
					"%" => [
						"min" => 0,
						"max" => 100,
					],
					"rem" =>  [
						"min" => 0,
						"max" => 100,
					],
					"em" => [
						"min" => 0,
						"max" => 100,
					]
				],
				"selectors" => [
					"{{WRAPPER}} .cea-image-accordion-horizontal" => "gap: {{SIZE}}{{UNIT}};",
					"{{WRAPPER}} .cea-image-accordion-vertical .image-accordion-item" => "margin-bottom: {{SIZE}}{{UNIT}};"
				]
			]
		);
		$this->add_responsive_control(
			'img_acc_justify',
			[
				'label'		=> esc_html__( 'Justify Content', 'cea-post-types' ),
				'description'	=> esc_html__( 'Works when the Image Accordion is Horizontal', 'cea-post-types' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Start', 'cea-post-types' ),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'cea-post-types' ),
						'icon' => 'eicon-justify-center-h',
					],
					'right' => [
						'title' => esc_html__( 'End', 'cea-post-types' ),
						'icon' => 'eicon-justify-end-h',
					],
					'space-around' => [
						'title' => esc_html__( 'Space Around', 'cea-post-types' ),
						'icon' => 'eicon-justify-space-around-h',
					],
					'space-between' => [
						'title' => esc_html__( 'Space Between', 'cea-post-types' ),
						'icon' => 'eicon-justify-space-between-h',
                    ],
					'space-evenly' => [
						'title' => esc_html__( 'Space Evenly', 'cea-post-types' ),
						'icon' => 'eicon-justify-space-evenly-h',
                    ],
				],				
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .cea-image-accordion-horizontal' => 'justify-content: {{VALUE}};',
				],
				
			]
		);
		$this->add_responsive_control(
			"img_accordion_height",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Image Accordion Size", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for portfolio image accordion size.", "cea-post-types" ),
				"default" 		=> "670",
				"selectors"	    => [ 
					'{{WRAPPER}} .cea-image-accordion-horizontal .image-accordion-item > .post-thumb img' => 'height: {{VALUE}}px;',
					'{{WRAPPER}} .cea-image-accordion-vertical .image-accordion-item > .post-thumb > a > img' => 'width: {{VALUE}}px;',
				],
				"condition"		=> [
					"extent_opt"	=> "yes",
					"accordion_style" 	=> "horizontal"
				],
				"separator"		=> "after"
			]
		);
		$this->add_responsive_control(
			"img_accordion_width",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Image Accordion Size", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for portfolio image accordion size.", "cea-post-types" ),
				"default" 		=> "670",
				"selectors"	    => [
					'{{WRAPPER}} .cea-image-accordion-vertical .image-accordion-item > .post-thumb > a > img' => 'width: {{VALUE}}px;',
					'{{WRAPPER}} .cea-image-accordion-horizontal .image-accordion-item > .post-thumb img' => 'height: {{VALUE}}px;',
				],
				"condition"		=> [
					"extent_opt"	=> "yes",
					"accordion_style" 	=> "vertical"
				],
				"separator"		=> "after"
			]
		);
		$this->start_controls_tabs(
			"img_acc_hr"
		);
		$this->start_controls_tab(
			"image_accordion_nrml",
			[
				"label" => esc_html__( "Normal", "cea-post-types" ),
			]
		);
		$this->add_responsive_control(
			"img_width_nrml",
			[
				"type"          => Controls_Manager::SLIDER,
				"label"         => esc_html__( "Image Width", "cea-post-types" ),
				"description"   => esc_html__( "Adjust the portfolio image width in normal state (in percentage).", "cea-post-types" ),
				"size_units"	=> [ 'px', '%', 'rem', 'em' ],
				"default"       => [
					"size" => 300,
					"unit" => 'px',
				],
				"range"         => [
					"px" => [
						"min" => 0,
						"max" => 1200,
					],
					"%" => [
						"min" => 10,
						"max" => 100,
					],
					"rem" =>  [
						"min" => 0,
						"max" => 100,
					],
					"em" => [
						"min" => 0,
						"max" => 100,
					]
				],
				"condition"		=> [
					"accordion_style" 	=> "horizontal"
				],
				"selectors"     => [
					"{{WRAPPER}} .cea-image-accordion-horizontal .image-accordion-item" => "width: {{SIZE}}{{UNIT}};",
				],
			]
		);
		$this->add_responsive_control(
			"img_height_nrml",
			[
				"type"          => Controls_Manager::SLIDER,
				"label"         => esc_html__( "Image Height", "cea-post-types" ),
				"description"   => esc_html__( "Adjust the portfolio image height in normal state (in percentage).", "cea-post-types" ),
				"size_units"	=> [ 'px', '%', 'rem', 'em' ],
				"default"       => [
					"size" => 200,
					"unit" => 'px',
				],
				"range"         => [
					"px" => [
						"min" => 0,
						"max" => 1200,
					],
					"%" => [	
						"min" => 10,
						"max" => 100,
					],
					"rem" =>  [
						"min" => 0,
						"max" => 100,
					],
					"em" => [
						"min" => 0,
						"max" => 100,
					]
				],
				"condition"		=> [
					"accordion_style" 	=> "vertical"
				],
				"selectors"     => [
					// "{{WRAPPER}} .cea-image-accordion-vertical .image-accordion-item" => "height: {{SIZE}}{{UNIT}};",
					"{{WRAPPER}} .cea-image-accordion-vertical .image-accordion-item > .post-thumb > a > img" => "height: {{SIZE}}{{UNIT}};",
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} div.image-accordion-item > .post-thumb img',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			"image_accordion_hvr",
			[
				"label" => esc_html__( "Hover", "cea-post-types" ),
			]
		);
		$this->add_responsive_control(
			"img_width_hvr",
			[
				"type"          => Controls_Manager::SLIDER,
				"label"         => esc_html__( "Image Width ", "cea-post-types" ),
				"description"   => esc_html__( "Adjust the portfolio image width in hover state (in percentage).", "cea-post-types" ),
				"size_units"	=> [ 'px', '%', 'rem', 'em' ],
				"default"       => [
					"size" => 600,
					"unit" => 'px',
				],
				"range"         => [
					"px" => [
						"min" => 0,
						"max" => 1200,
					],
					"%" => [	
						"min" => 10,
						"max" => 100,
					],
					"rem" =>  [
						"min" => 0,
						"max" => 100,
					],
					"em" => [
						"min" => 0,
						"max" => 100,
					]
				],
				"condition"		=> [
					"accordion_style" 	=> "horizontal"
				],
				"selectors"     => [
					"{{WRAPPER}} .cea-image-accordion-horizontal .image-accordion-item:hover" => "width: {{SIZE}}{{UNIT}};",
				],
			]
		);
		$this->add_responsive_control(
			"img_height_hvr",
			[
				"type"          => Controls_Manager::SLIDER,
				"label"         => esc_html__( "Image Height ", "cea-post-types" ),
				"description"   => esc_html__( "Adjust the portfolio image height in hover state (in percentage).", "cea-post-types" ),
				"size_units"	=> [ 'px', '%', 'rem', 'em' ],
				"default"       => [
					"size" => 400,
					"unit" => 'px',
				],
				"range"         => [
					"px" => [
						"min" => 0,
						"max" => 1200,
					],
					"%" => [	
						"min" => 10,
						"max" => 100,
					],
					"rem" =>  [
						"min" => 0,
						"max" => 100,
					],
					"em" => [
						"min" => 0,
						"max" => 100,
					]
				],
				"condition"		=> [
					"accordion_style" 	=> "vertical"
				],
				"selectors"     => [
					// "{{WRAPPER}} .cea-image-accordion-vertical .image-accordion-item:hover" => "height: {{SIZE}}{{UNIT}};",
					"{{WRAPPER}} .cea-image-accordion-vertical .image-accordion-item:hover > .post-thumb > a > img" => "height: {{SIZE}}{{UNIT}}",
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hr',
				'selector' => '{{WRAPPER}} div.image-accordion-item > .post-thumb img:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		// Style Tilt Section
		$this->start_controls_section(
			'section_style_tilt',
			[
				'label' => __( 'Tilt', 'cea-post-types' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"tilt_opt",
			[
				"label" 		=> esc_html__( "Tilt Option", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for enable tilt animation option.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'max_tilt',
			[
				'label' => esc_html__( 'maxTilt', 'cea-post-types' ),
				'type' => Controls_Manager::TEXT,
				'default' => 20
			]
		);
		$this->add_control(
			'perspective',
			[
				'label' => esc_html__( 'Perspective', 'cea-post-types' ),
				'type' => Controls_Manager::TEXT,
				'default' => 500
			]
		);
		$this->add_control(
			'tilt_scale',
			[
				'label' => esc_html__( 'Scale', 'cea-post-types' ),
				'type' => Controls_Manager::TEXT,
				'default' => 1.1
			]
		);
		$this->add_control(
			'tilt_speed',
			[
				'label' => esc_html__( 'Speed', 'cea-post-types' ),
				'type' => Controls_Manager::TEXT,
				'default' => 400
			]
		);
		$this->add_control(
			"tilt_transition",
			[
				"label" 		=> esc_html__( "Tilt Transition", "cea-post-types" ),
				"description"	=> esc_html__( "This is option for tilt transition.", "cea-post-types" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->end_controls_section();	

	}

	/**
	 * Render Animated Text widget output on the frontend.
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
		extract( $settings );
		
		$service_layout = isset( $service_layout ) && $service_layout != '' ? $service_layout : 'default';
		$slide_opt = isset( $slide_opt ) && $slide_opt == 'yes' ? true : false;
		$extent_opt = isset( $extent_opt ) && $extent_opt == 'yes' ? true : false;
		$accordion_style = isset( $accordion_style ) && !empty( $accordion_style ) ? $accordion_style : 'horizontal';
		$accordion_break_pts = isset( $accordion_break_pts ) && !empty( $accordion_break_pts ) ? $accordion_break_pts : 'none';
		$service_masonry = isset( $service_masonry ) && $service_masonry == 'yes' ? true : false;
		
		$class_names = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';
		$class_names .= isset( $service_layout ) ? ' service-style-' . $service_layout : ' service-style-1';
		$class_names .= isset( $variation ) ? ' service-' . $variation : '';

		if( !$service_masonry && !$slide_opt && !$extent_opt ){
			$class_names .= ' service-normal-model';
		}elseif( $slide_opt ) {
			$class_names .= ' service-slide-model';
		}elseif( $extent_opt ){
			$class_names .= ' cea-image-accordion-'.$accordion_style;
		}elseif( $service_masonry ){
			$class_names .= ' service-isotope-model';
		}
		
		?>
		
		<div class="elementor-widget-container service-wrapper<?php echo esc_attr( $class_names ); ?>" <?php echo ( $extent_opt ) ? 'data-wrap="'. $accordion_break_pts .'"' : ''; ?>>
		
			<?php

			if( !$service_masonry && !$slide_opt && !$extent_opt ){
				echo '<div class="row">';
			}

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

			if( !$service_masonry && !$slide_opt && !$extent_opt ){
				echo '</div><!-- .row -->';
			}

			?>
			
		</div>
		<?php
	}

	/**
	 * Render Animated Text widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		
		extract( $settings );
		$output = '';

		//Defined Variable
		$post_per_page = isset( $post_per_page ) && $post_per_page != '' ? $post_per_page : '';
		$excerpt_length = isset( $excerpt_length ) && $excerpt_length != '' ? $excerpt_length : 10;
		$this->excerpt_len = $excerpt_length;
		$include_cats = isset( $include_cats ) ? $include_cats : '';
		$exclude_cats = isset( $exclude_cats ) ? $exclude_cats : '';
		$include_author = isset( $include_author ) ? $include_author : '';
		$include_posts = isset( $include_posts ) ? $include_posts : '';
		$exclude_posts = isset( $exclude_posts ) ? $exclude_posts : '';
		$orderby = isset( $orderby ) ? $orderby : '';
		$order = isset( $order ) ? $order : '';
		$enable_mouse_hover = isset( $enable_mouse_hover ) && $enable_mouse_hover === 'yes';
		$mouse_hover_animation = isset( $mouse_hover_animation ) ? $mouse_hover_animation : [];
		
		$more_text = isset( $more_text ) && $more_text != '' ? $more_text : '';
		$service_pagination = isset( $service_pagination ) && $service_pagination == 'yes' ? true : false;
		$service_masonry = isset( $service_masonry ) && $service_masonry == 'yes' ? true : false;
		$masonry_layout = isset( $masonry_layout ) && $masonry_layout != '' ? $masonry_layout : 'masonry';
		$service_infinite = isset( $service_infinite ) && $service_infinite == 'yes' ? true : false;
		$service_gutter = isset( $service_gutter ) && $service_gutter != '' ? $service_gutter : 20;
		$slide_opt = isset( $slide_opt ) && $slide_opt == 'yes' ? true : false;
		$extent_opt = isset( $extent_opt ) && $extent_opt == 'yes' ? true : false;
		$lazy_load = isset( $lazy_load ) && $lazy_load == 'yes' ? true : false;
		$isotope_filter = isset( $isotope_filter ) && $isotope_filter == 'yes' ? true : false;
		$filter_all = isset( $filter_all ) && $filter_all != '' ? $filter_all : esc_html__( "All", "cea-post-types" );
		$post_heading = isset( $post_heading ) && $post_heading != '' ? $post_heading : 'h3';
		
		//Tilt options
		$tilt_opt = isset( $settings['tilt_opt'] ) && $settings['tilt_opt'] == 'yes' ? true : false;
		$tilt_transition = isset( $settings['tilt_transition'] ) && $settings['tilt_transition'] == 'yes' ? true : false;
		$max_tilt = isset( $settings['max_tilt'] ) ? $settings['max_tilt'] : '';
		$perspective = isset( $settings['perspective'] ) ? $settings['perspective'] : '';
		$tilt_scale = isset( $settings['tilt_scale'] ) ? $settings['tilt_scale'] : '';
		$tilt_speed = isset( $settings['tilt_speed'] ) ? $settings['tilt_speed'] : '';
		
		if( $tilt_opt ){
			$this->add_render_attribute( 'cea-service-tilt', 'data-tilt_trans', $tilt_transition );
			$this->add_render_attribute( 'cea-service-tilt', 'data-max_tilt', $max_tilt );
			$this->add_render_attribute( 'cea-service-tilt', 'data-tilt_perspective', $perspective );
			$this->add_render_attribute( 'cea-service-tilt', 'data-tilt_scale', $tilt_scale );
			$this->add_render_attribute( 'cea-service-tilt', 'data-tilt_speed', $tilt_speed );
		}
		
		if( $slide_opt ){
			$gal_atts = array(
				'data-loop="'. ( isset( $slide_item_loop ) && $slide_item_loop == 'yes' ? 1 : 0 ) .'"',
				'data-margin="'. ( isset( $slide_margin ) && $slide_margin != '' ? absint( $slide_margin ) : 0 ) .'"',
				'data-center="'. ( isset( $slide_center ) && $slide_center == 'yes' ? 1 : 0 ) .'"',
				'data-nav="'. ( isset( $slide_nav ) && $slide_nav == 'yes' ? 1 : 0 ) .'"',
				'data-dots="'. ( isset( $slide_dots ) && $slide_dots == 'yes' ? 1 : 0 ) .'"',
				'data-autoplay="'. ( isset( $slide_item_autoplay ) && $slide_item_autoplay == 'yes' ? 1 : 0 ) .'"',
				'data-items="'. ( isset( $slide_item ) && $slide_item != '' ? absint( $slide_item ) : 1 ) .'"',
				'data-items-tab="'. ( isset( $slide_item_tab ) && $slide_item_tab != '' ? absint( $slide_item_tab ) : 1 ) .'"',
				'data-items-mob="'. ( isset( $slide_item_mobile ) && $slide_item_mobile != '' ? absint( $slide_item_mobile ) : 1 ) .'"',
				'data-duration="'. ( isset( $slide_duration ) && $slide_duration != '' ? absint( $slide_duration ) : 5000 ) .'"',
				'data-smartspeed="'. ( isset( $slide_smart_speed ) && $slide_smart_speed != '' ? absint( $slide_smart_speed ) : 250 ) .'"',
				'data-scrollby="'. ( isset( $slide_slideby ) && $slide_slideby != '' ? absint( $slide_slideby ) : 1 ) .'"',
				'data-autoheight="0"',
			);
			$data_atts = implode( " ", $gal_atts );
		}

		$thumb_size = $settings[ 'thumbnail_size' ];
		$image_sizes = get_intermediate_image_sizes();
		
		$this->add_render_attribute( 'image-link', 'class', 'post-image-link' );
		if( isset( $image_target ) && $image_target == 'yes' ) $this->add_render_attribute( 'image-link', 'target', '_blank' );
		if( isset( $image_nofollow ) && $image_nofollow == 'yes' ) $this->add_render_attribute( 'image-link', 'rel', 'nofollow' );
		
		$this->add_render_attribute( 'title-link', 'class', 'post-title' );
		if( isset( $title_target ) && $title_target == 'yes' ) $this->add_render_attribute( 'title-link', 'target', '_blank' );
		if( isset( $title_nofollow ) && $title_nofollow == 'yes' ) $this->add_render_attribute( 'title-link', 'rel', 'nofollow' );
		
		$this->add_render_attribute( 'more-link', 'class', 'read-more elementor-button' );
		if( isset( $more_target ) && $more_target == 'yes' ) $this->add_render_attribute( 'more-link', 'target', '_blank' );
		if( isset( $more_nofollow ) && $more_nofollow == 'yes' ) $this->add_render_attribute( 'more-link', 'rel', 'nofollow' );

		$default_items = array( 
			"thumb"			=> esc_html__( "Feature Image", "cea-post-types" ),
			"title"			=> esc_html__( "Title", "cea-post-types" ),
			"excerpt"		=> esc_html__( "Excerpt", "cea-post-types" )
		);
		$elemetns = isset( $post_items ) && !empty( $post_items ) ? json_decode( $post_items, true ) : array( 'Enabled' => $default_items );
		$overlay_opt = isset( $post_overlay_items_opt ) && $post_overlay_items_opt == 'yes' ? true : false;
		$overlay_items = isset( $post_overlay_items ) && !empty( $post_overlay_items ) ? json_decode( $post_overlay_items, true ) : array( 'Enabled' => '' );
		$top_meta = isset( $top_meta ) && $top_meta != '' ? $top_meta : array( 'Enabled' => '' );
		$bottom_meta = isset( $bottom_meta ) && $bottom_meta != '' ? $bottom_meta : array( 'Enabled' => '' );

		$cols = isset( $service_cols ) ? $service_cols : 12;
		$cols_tab = isset( $service_cols_tab ) ? $service_cols_tab : 12;
		$col_mbl = isset( $service_cols_mbl ) ? $service_cols_mbl : 12;
		$col_class = "col-lg-". absint( $cols );
		$col_class .= " col-md-". absint( $cols_tab );
		$col_class .= " col-sm-". absint( $col_mbl );
		
		$list_layout = isset( $service_layout ) && $service_layout == 'list' ? 1 : 0;
				
		$filter_catoutput = '';
		if( $isotope_filter && !empty( $include_cats ) ){
			foreach( $include_cats as $index => $cat ){
				if( term_exists( absint( $cat ), 'service-categories' ) ){
					$cat_term = get_term_by( 'id', absint( $cat ), 'service-categories' );	
					if( isset( $cat_term->term_id ) ){
						$filter_catoutput .=  '<li><a href="#" class="isotope-filter-item" data-filter=".service-filter-'. esc_attr( $cat ) .'">'. esc_html( $cat_term->name ) .'</a></li>';	
					}
				}
			}
		}
		
		//Query Start
		global $wp_query;
		$paged = 1;
		if( get_query_var('paged') ){
			$paged = get_query_var('paged');
		}elseif( get_query_var('page') ){
			$paged = get_query_var('page');
		}
		
		$tax_query = array();
		if( !empty( $include_cats ) ){
			$tax_query[] = array(
				'taxonomy' => 'service-categories',
				'field'    => 'term_id',
				'terms'    => $include_cats,
				'operator' => 'IN'
			);
		}
		if( !empty( $exclude_cats ) ){
			$tax_query[] = array(
				'taxonomy' => 'service-categories',
				'field'    => 'term_id',
				'terms'    => $exclude_cats,
				'operator' => 'NOT IN'
			);
		}
		$tax_query = !empty( $tax_query ) ? $tax_query : '';
		
		$ppp = $post_per_page != '' ? $post_per_page : 2;
		if( $extent_opt ) {
			$ppp = $extent_ppp != '' ? $extent_ppp : 4;
		}
		$args = array(
			'post_type' => 'cea-service',
			'posts_per_page' => absint( $ppp ),
			'paged' => $paged,
			'ignore_sticky_posts' => 1,
			'tax_query'	=> $tax_query
			
		);
		
		//Include Author
		if( !empty( $include_author ) ){
			$args['author__in'] = $include_author;
		}
		
		//Include Posts
		if( !empty( $include_posts ) ){
			$args['post__in'] = $include_posts;
		}
		
		//Exclude Posts
		if( !empty( $exclude_posts ) ){
			$args['post__not_in'] = $exclude_posts;
		}
		
		//Order by
		if( !empty( $orderby ) ){
			$args['orderby'] = $orderby;
		}
		
		//Order
		if( !empty( $order ) ){
			$args['order'] = $order;
		}
		
		$query = new \WP_Query( $args );
			
		if ( $query->have_posts() ) {

			add_filter( 'excerpt_more', 'cea_excerpt_more', 99 );
			add_filter( 'excerpt_length', array( $this, 'cea_excerpt_length' ), 99 );
			
			if( $isotope_filter && $filter_catoutput != '' ){
				echo '<div class="isotope-filter">';
					echo '<ul class="nav m-auto d-block">' .
						( $filter_all != '' ? '<li class="active"><a href="#" class="isotope-filter-item" data-filter="">'. esc_html( $filter_all ) .'</a></li>' : '' ) .
						$filter_catoutput;
					echo '</ul>';
				echo '</div>';
			}

			if( $slide_opt ) {
				echo '<div class="cea-carousel owl-carousel" '. ( $data_atts ) .'>';	
				$col_class = 'owl-carousel-item';
			}elseif( $service_masonry ){
			
				$loading_msg = isset( $loading_msg ) && $loading_msg != '' ? $loading_msg : esc_html__( 'Loading..', 'cea-post-types' );
				$loading_end = isset( $loading_end ) && $loading_end != '' ? $loading_end : esc_html__( 'No more posts..', 'cea-post-types' );
				$loading_img = isset( $loading_img ) && $loading_img != '' ? $loading_img['url'] : CEA_CORE_URL . 'assets/images/infinite-loader.gif';
			
				$isotope_class = ' isotope-col-'. esc_attr( 12 / absint( $cols ) );
				echo '<div class="isotope'. esc_attr( $isotope_class ) .'" data-cols="'. esc_attr( 12 / absint( $cols ) ) .'" data-gutter="'. esc_attr( $service_gutter ) .'" data-layout="'. esc_attr( $masonry_layout ) .'" data-infinite="'. esc_attr( $service_infinite ) .'" data-lazyload="'. esc_attr( $lazy_load ) .'" data-loadmsg="'. esc_attr( $loading_msg ) .'" data-loadend="'. esc_attr( $loading_end ) .'" data-loadimg="'. esc_attr( $loading_img ) .'">';
				$col_class = 'isotope-item';
				$col_class .= $lazy_load ? ' cea-animate' : '';
			}
			// service items array
			$service_array = array(
				'cols' => $cols,
				'post_heading' => $post_heading,
				'overlay_opt' => $overlay_opt,
				'overlay_items' => $overlay_items,
				'more_text' => $more_text,
				'top_meta' => $top_meta,
				'bottom_meta' => $bottom_meta,				
				'thumb_size' => $thumb_size,
				'image_sizes' => $image_sizes
			);
			
			if( $list_layout || $service_layout == 'classic-pro' ){
				if(	isset( $elemetns['Enabled']['thumb'] ) ) unset( $elemetns['Enabled']['thumb'] );
			}
			
			if( $tilt_opt ){
				$col_class .= ' cea-tilt';
			}
		
			// Start the Loop
			while ( $query->have_posts() ) : $query->the_post();

				$cursor_text_parts = [];

				if (in_array('title', $mouse_hover_animation)) {
					$cursor_text_parts[] = get_the_title();
				}

				if (in_array('category', $mouse_hover_animation)) {
					$categories = get_the_terms(get_the_ID(), 'service-categories');
					if (!is_wp_error($categories) && !empty($categories)) {
						$cursor_text_parts[] = implode(', ', wp_list_pluck($categories, 'name'));
					}
				}

				$cursor_text = esc_attr(implode(' ', $cursor_text_parts));
				
				$post_id = get_the_ID();
				$service_array['post_id'] = $post_id;
				
				$cat_class = '';
				if( $service_masonry && $isotope_filter && $filter_catoutput != '' ){
					$terms = get_the_terms( $post_id, 'service-categories' );
					if ( $terms && ! is_wp_error( $terms ) ) :
						foreach ( $terms as $term ) {
							$cat_class .= ' service-filter-' . $term->term_id;
						}
					endif;
				}

				if( $extent_opt ) {
					// Add data-cursor if mouse hover is enabled
    				$cursor_attr = '';
    				if ( $enable_mouse_hover && !empty($cursor_text) ) {
    				    $cursor_attr = ' data-cursor="' . esc_attr($cursor_text) . '"';
    				}
					echo '<div class="image-accordion-item '. ($enable_mouse_hover ? ' cursor-hover-content' : '') .'" ' . $cursor_attr . '>';
					if( $elemetns ) {
						foreach( $elemetns['Enabled'] as $key => $content ) {
							echo $this->cea_service_shortcode_elements( $key, $service_array, $settings);
						}
					}
					echo '</div><!-- .image-accordion-item -->';

				}
				
				if( !$extent_opt ) :
					// Add data-cursor if mouse hover is enabled
    				$cursor_attr = '';
    				if ( $enable_mouse_hover && !empty($cursor_text) ) {
    				    $cursor_attr = ' data-cursor="' . esc_attr($cursor_text) . '"';
    				}
					echo '<div class="'. esc_attr( $col_class . $cat_class ) . ($enable_mouse_hover ? ' cursor-hover-content' : '') .'" '. $this->get_render_attribute_string( 'cea-service-tilt' ) .  $cursor_attr .'>';
						echo '<div class="service-inner">';

							if( $list_layout ){
								echo '<div class="media">';
									echo $this->cea_service_shortcode_elements('thumb', $service_array, $settings);
									echo '<div class="media-body">';
							}elseif( $service_layout == 'classic-pro' ){
								echo $this->cea_service_shortcode_elements('thumb', $service_array, $settings);
								echo '<div class="post-details-outer">';
							}

							if( isset( $elemetns['Enabled'] ) ) :
								foreach( $elemetns['Enabled'] as $element => $value ){
									echo $this->cea_service_shortcode_elements( $element, $service_array, $settings);
								}
							endif;

							if( $list_layout ){
									echo '</div><!-- .media -->';
								echo '</div><!-- .media-body -->';
							}elseif( $service_layout == 'classic-pro' ){
								echo '</div><!-- .post-details-outer -->';
							}
						echo '</div><!-- .service-inner -->';
					echo '</div><!-- .col / .owl-carousel-item / .isotope -->';
				endif;
				
			endwhile;
			
			if( !$service_masonry && !$slide_opt && !$extent_opt ){
				if ( $service_load_more !== 'none' ) {
					$element_set = htmlspecialchars(json_encode( $this->get_settings_for_display() ), ENT_QUOTES, 'UTF-8');
					echo '<div id="service-load-more-container"></div>'; // Container for new items
					echo '<div class="d-flex justify-content-center mt-5"><button id="service-load-more" class="load-more-btn btn cpt-load-more '. ($service_load_more == "scroll" ? "load-btn-scroll" : "") .'" data-cpt="cea-service" data-elementor="'. $element_set .'" >' . esc_html__('Load More', 'zozo-portfolio') . '</button></div>';
				}
			}elseif( $slide_opt ) {
				echo '</div><!-- .owl-carousel -->';
			}elseif( $service_masonry ){
				echo '</div><!-- .isotope -->';
			}

			if( ( !$slide_opt ) && $service_infinite ) {
				echo $service_infinite ? '<div class="infinite-load">' : '';
					require_once CEA_PT_CORE_DIR . '/inc/cpt.basic-functions.php';
					echo CPT_Other::CeaBootstrapPagination( $args, $query->max_num_pages, false );
				echo $service_infinite ? '</div><!-- infinite-load -->' : '';
				echo '<div class="page-load-status">';
					if( $loading_img ) echo '<img src="'. esc_url( $loading_img ) .'" alt="'. esc_attr( 'Loading...', 'cea-post-types' ) .'" />';
					if( $loading_msg ) echo '<p class="infinite-scroll-request">'. esc_html( $loading_msg ) .'</p>';
					if( $loading_end ) echo '<p class="infinite-scroll-last">'. esc_html( $loading_end ) .'</p>';
				echo '</div>';
			}elseif( ( !$slide_opt ) && $service_pagination ){
				require_once CEA_PT_CORE_DIR . '/inc/cpt.basic-functions.php';
				echo CPT_Other::CeaBootstrapPagination( $args, $query->max_num_pages, false );
			}			
			
		}// query exists
		
		// use reset postdata to restore orginal query
		wp_reset_postdata();
		

	}
	
	function cea_service_shortcode_elements( $element, $opts = array(), $settings = null ){
		$output = '';
		switch( $element ){
		
			case "title":
				$head = isset( $opts['post_heading'] ) ? $opts['post_heading'] : 'h3';
				$output .= '<div class="entry-title">';
					$output .= '<'. esc_attr( $head ) .' class="post-title-head"><a href="'. esc_url( get_the_permalink() ) .'" '. $this->get_render_attribute_string( 'title-link' ) .'>'. esc_html( get_the_title() ) .'</a></'. esc_attr( $head ) .'>';
				$output .= '</div><!-- .entry-title -->';		
			break;
			
			case "thumb":
				if ( has_post_thumbnail() ) {
					
					$overlay_opt = isset( $opts['overlay_opt'] ) && $opts['overlay_opt'] == 'yes' ? true : false;
					$thumb_wrap_class = $overlay_opt ? ' post-overlay-active' : '';
					
					$output .= '<div class="post-thumb'. esc_attr( $thumb_wrap_class ) .'">';
						$img_id = get_post_thumbnail_id( get_the_ID() );
						$size = $opts['thumb_size'];
						$image_sizes = $opts['image_sizes'];
						$this->add_render_attribute( 'image_class', 'class', 'img-fluid' );		
						$this->add_render_attribute( 'image_class', 'class', $settings['img_style'] );
						
						if( in_array( $size, $image_sizes ) ){
							$this->add_render_attribute( 'image_class', 'class', "attachment-$size size-$size" );
							$img_attr = $this->get_render_attributes( 'image_class' );
							$img_attr['class'] = implode( " ", $img_attr['class'] );
							$output .= '<a href="'. esc_url( get_the_permalink() ) .'" '. $this->get_render_attribute_string( 'image-link' ) .'>';
								$output .= wp_get_attachment_image( $img_id, $size, false, $img_attr );
							$output .= '</a>';
						}else{
							$image_src = Group_Control_Image_Size::get_attachment_image_src( $img_id, 'thumbnail', $settings );
							if ( ! empty( $image_src ) ) {
								$img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
								$output .= '<a href="'. esc_url( get_the_permalink() ) .'" '. $this->get_render_attribute_string( 'image-link' ) .'>';
								$output .= sprintf( '<img src="%s" title="%s" alt="%s" %s />', esc_attr( $image_src ), esc_attr( get_the_title( $img_id ) ), esc_attr( $img_alt ), $this->get_render_attribute_string( 'image_class' ) );
								$output .= '</a>';
							}
						}						
						
						if( $overlay_opt ){
							$post_overlay_items = isset( $opts['overlay_items'] ) ? $opts['overlay_items'] : array( 'Enabled' => '' );
							$output .= '<div class="post-overlay-items">';
								foreach( $post_overlay_items['Enabled'] as $element => $value ){
									$output .= $this->cea_service_shortcode_elements( $element, $opts );
								}
							$output .= '</div>';

						}													
					$output .= '</div><!-- .post-thumb -->';
				}
			break;
			
			case "category":
				$taxonomy = 'service-categories';
				$terms = get_the_terms( get_the_ID(), $taxonomy );
				if ( $terms && !is_wp_error( $terms ) ) :
					$coutput = '<div class="post-category">';
						foreach ( $terms as $term ) {
							$coutput .= '<a href="'. esc_url( get_term_link( $term->slug, $taxonomy ) ) .'">'. esc_html( $term->name ) .'</a>,';
						}
						$output .= rtrim( $coutput, ',' );
					$output .= '</div>';
				endif;
			break;
			case "author":
				$output .= '<div class="post-author">';
					$output .= '<a href="'. get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) .'">';
						$output .= '<span class="author-img">'. get_avatar( get_the_author_meta('email'), '30', null, null, array( 'class' => 'rounded-circle' ) ) .'</span>';
						$output .= '<span class="author-name">'. get_the_author() .'</span>';
					$output .= '</a>';
				$output .= '</div>';
			break;
			
			case "date":
				$archive_year  = get_the_time('Y');
				$archive_month = get_the_time('m');
				$archive_day   = get_the_time('d');
				$output = '<div class="post-date"><a href="'. esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ) .'" ><i class="icon icon-calendar"></i> '. get_the_time( get_option( 'date_format' ) ) .'</a></div>';
			break;
			
			case "more":
				$read_more_text = isset( $opts['more_text'] ) ? $opts['more_text'] : esc_html__( 'Read more', 'cea-post-types' );
				$output = '<div class="post-more"><a href="'. esc_url( get_permalink( get_the_ID() ) ) . '" '. $this->get_render_attribute_string( 'more-link' ) .'>'. esc_html( $read_more_text ) .'</a></div>';
			break;
			
			case "comment":
				$comments_count = wp_count_comments(get_the_ID());
				$output = '<div class="post-comment"><a href="'. esc_url( get_comments_link( get_the_ID() ) ) .'" rel="bookmark" class="comments-count"><i class="fa fa-comment-o"></i> '. esc_html( $comments_count->total_comments ) .'</a></div>';
			break;
			
			case "excerpt":
				$output = '';
				$excerpt_length = $this->excerpt_len;
				$output .= '<div class="post-excerpt">';
				ob_start();
				$excerpt_cont = ob_get_clean();
				$output .= wp_trim_words(get_the_excerpt(), $excerpt_length); 
				$output .= $excerpt_cont;
				$output .= '</div><!-- .post-excerpt -->';
			break;
			
			case "top-meta":
				$output = '';
				$top_meta = $opts['top_meta'];
				$elemetns = isset( $top_meta ) ? json_decode( $top_meta, true ) : array( 'Left' => '' );
				$output .= '<div class="top-meta clearfix">';
				foreach( $elemetns as $ele_key => $ele_part ){
					if( isset( $ele_part ) && !empty( $ele_part ) && $ele_key != 'disabled' ) :
						$part_class = $ele_key == 'Left' || $ele_key == 'Right' ? ' meta-' . strtolower( $ele_key ) : '';
						$output .= '<ul class="nav top-meta-list'. esc_attr( $part_class ) .'">';
							foreach($ele_part as $element => $value ){
								$service_array = array( 'more_text' => $opts['more_text'] );
								$output .= '<li>'. $this->cea_service_shortcode_elements( $element, $service_array ) .'</li>';
							}
						$output .= '</ul>';
					endif;
				}
				$output .= '</div>';
			break;
			
			case "bottom-meta":
				$output = '';
				$bottom_meta = $opts['bottom_meta'];
				$elemetns = isset( $bottom_meta ) ? json_decode( $bottom_meta, true ) : array( 'Left' => '' );
				$output .= '<div class="bottom-meta clearfix">';
				foreach( $elemetns as $ele_key => $ele_part ){
					if( isset( $ele_part ) && !empty( $ele_part ) && $ele_key != 'disabled' ) :
						$part_class = $ele_key == 'Left' || $ele_key == 'Right' ? ' meta-' . strtolower( $ele_key ) : '';
						$output .= '<ul class="nav bottom-meta-list'. esc_attr( $part_class ) .'">';
							foreach($ele_part as $element => $value ){
								$service_array = array( 'more_text' => $opts['more_text'] );
								$output .= '<li>'. $this->cea_service_shortcode_elements( $element, $service_array ) .'</li>';
							}
						$output .= '</ul>';
					endif;
				}
				$output .= '</div>';
			break;
			
			case "icon":
				$icon_img_id = get_post_meta( get_the_ID(), 'cea_service_title_img', true );
				if( $icon_img_id ){
					$icon_img_url = wp_get_attachment_url( $icon_img_id );
					$output = '<div class="service-icon-img-wrap"><img src="'. esc_url( $icon_img_url ) .'" class="img-fluid service-icon-img" alt="'. esc_attr( get_the_title() ) .'" /></div>';
				}
			break;
		}
		return $output; 
	}
	
	function cea_excerpt_length( $length ) {
		return $this->excerpt_len;
	}
}
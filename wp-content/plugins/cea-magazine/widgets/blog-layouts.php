<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Classic_Elementor_Addons\Helper\Post_Helper as Cea_Post_Helper;

/**
 * Classic Elementor Addon Blog Layouts Widget
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Blog_Layouts_Widget extends Widget_Base {	
	use Cea_Post_Helper;
	private $excerpt_len;

	private $post_args;
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Blog Layouts widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceabloglayouts";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Blog Layouts widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Blog Layouts", "cea-magazine" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Blog Layouts widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layout-grid2-thumb";
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
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'blog', 'magazine', 'cea posts', 'posts layout' ];
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
		$helper_instance = new CEA_Elementor_Blog_Layouts_Widget(); 
		//get authors
		$authors = $helper_instance->cea_get_authors();
		
		//get categories
		$categories = $helper_instance->cea_get_categories();
		
		//get tags
		$tags = $helper_instance->cea_get_tags();
		
		//get post titles
		$post_titles = $helper_instance->cea_get_post_titles();
		
		//orderby options
		$order_by = $helper_instance->cea_get_post_orderby_options();
		
		//General Section
		$this->start_controls_section(
			"general_section",
			[
				"label"	=> esc_html__( "General", "cea-magazine" ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default blog options.", "cea-magazine" ),
			]
		);
		$this->add_control(
			"extra_class",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Extra Class", "cea-magazine" ),
				"description"	=> esc_html__( "Put extra class for some additional styles.", "cea-magazine" ),
			]
		);
		$this->end_controls_section();
		
		//Query Section
		$this->start_controls_section(
			"query_section",
			[
				"label"	=> esc_html__( "Query", "cea-magazine" ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Blog query options.", "cea-magazine" ),
			]
		);
		$this->add_control(
			"post_per_page",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Post Per Page", "cea-magazine" ),
				"description"	=> esc_html__( "Here you can define post limits per page. Example 10", "cea-magazine" ),
				"default" 		=> "10",
				"placeholder"	=> "10"
			]
		);
		$this->add_control(
			'include_author',
			[
				'label' 		=> esc_html__( 'Author', 'cea-magazine' ),
				"description"	=> esc_html__( "This is filter author posts.", "cea-magazine" ),
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
				'label' 		=> esc_html__( 'Categories', 'cea-magazine' ),
				"description"	=> esc_html__( "This is filter categories. Enter and select which categories you want. If you don't want top filter, then leave this empty.", "cea-magazine" ),
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
				'label' 		=> esc_html__( 'Exclude Categories', 'cea-magazine' ),
				"description"	=> esc_html__( "Here you can mention unwanted categories", "cea-magazine" ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $categories,
				'default' 		=> '',
			]
		);
		$this->add_control(
			'include_tags',
			[
				'label' 		=> esc_html__( 'Tags', 'cea-magazine' ),
				"description"	=> esc_html__( "This is filter tags. Enter and select which tags you want.", "cea-magazine" ),
				'type' 			=> Controls_Manager::SELECT2,
				'multiple'	 	=> true,
				'label_block'	=> true,
				'options' 		=> $tags,
				'default' 		=> '',
			]
		);
		$this->add_control(
			'include_posts',
			[
				'label' 		=> esc_html__( 'Include Posts', 'cea-magazine' ),
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
				'label' 		=> esc_html__( 'Exclude Posts', 'cea-magazine' ),
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
				'label' 		=> esc_html__( 'Order By', 'cea-magazine' ),
				'type' 			=> Controls_Manager::SELECT,
				'label_block'	=> true,
				'options' 		=> $order_by,
				'default' 		=> 'none',
			]
		);
		$this->add_control(
			'order',
			[
				'label' 		=> esc_html__( 'Order', 'cea-magazine' ),
				'type' 			=> Controls_Manager::SELECT,
				'label_block'	=> true,
				'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending',
                ],
				'default' 		=> 'desc',
			]
		);
		$this->add_control(
			"more_text",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Read More Text", "cea-magazine" ),
				"description"	=> esc_html__( "Here you can enter read more text instead of default text.", "cea-magazine" ),
				"default" 		=> esc_html__( "Read More", "cea-magazine" )
			]
		);	
		$this->add_control(
			"blog_pagination",
			[
				"label" 		=> esc_html__( "Post Pagination", "cea-magazine" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition" 	=> [
					"blog_masonry" 		=> "no"
				]
			]
		);
		$this->end_controls_section();
		
		//Layouts Section
		$this->start_controls_section(
			"layouts_section",
			[
				"label"			=> esc_html__( "Layouts", "cea-magazine" ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Blog layout options here available.", "cea-magazine" ),
			]
		);
		$this->add_control(
			"blog_layout",
			[
				"label"			=> esc_html__( "Layout", "cea-magazine" ),
				"description"	=> esc_html__( "This is an option for display varity of layouts.", "cea-magazine" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "1",
				"options"		=> [
					"list"	=> esc_html__( "List Layout", "cea-magazine" ),
					"1"		=> esc_html__( "Layout 1", "cea-magazine" ),
					"2"		=> esc_html__( "Layout 2", "cea-magazine" ),
					"3"		=> esc_html__( "Layout 3", "cea-magazine" ),
					"4"		=> esc_html__( "Layout 4", "cea-magazine" ),
					"5"		=> esc_html__( "Layout 5", "cea-magazine" ),
					"6"		=> esc_html__( "Layout 6", "cea-magazine" ),
					"7"		=> esc_html__( "Layout 7", "cea-magazine" ),
					"8"		=> esc_html__( "Layout 8", "cea-magazine" ),
				]
			]
		);		
		$this->add_control(
			'primary_things',
			[
				'label' => esc_html__( 'Primary', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"primary_excerpt_length",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Primary Post Excerpt Length", "cea-magazine" ),
				"description"	=> esc_html__( "Here you can define primary post excerpt length. Example 10", "cea-magazine" ),
				"default" 		=> "10"
			]
		);
		$this->add_control(
			"primary_title_head",
			[
				"label"			=> esc_html__( "Primary Title Heading Tag", "cea-magazine" ),
				"description"	=> esc_html__( "This is an option for primary layout title heading tag", "cea-magazine" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h3",
				"options"		=> [
					"h1"		=> esc_html__( "h1", "cea-magazine" ),
					"h2"		=> esc_html__( "h2", "cea-magazine" ),
					"h3"		=> esc_html__( "h3", "cea-magazine" ),
					"h4"		=> esc_html__( "h4", "cea-magazine" ),
					"h5"		=> esc_html__( "h5", "cea-magazine" ),
					"h6"		=> esc_html__( "h6", "cea-magazine" ),
				]
			]
		);
		$this->add_control(
			"primary_post_items",
			[
				"label"				=> "Primary Post Items",
				"description"		=> esc_html__( "This is settings for primary layout post items. here you can set your own layout. Drag and drop needed post items to Enabled part.", "cea-magazine" ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					"Enabled" 		=> [ 
						"thumb"			=> esc_html__( "Feature Image", "cea-magazine" ),
						"title"			=> esc_html__( "Title", "cea-magazine" ),
						"excerpt"		=> esc_html__( "Excerpt", "cea-magazine" )
					],
					"disabled"		=> [
						"top-meta"		=> esc_html__( "Top Meta", "cea-magazine" ),
						"bottom-meta"	=> esc_html__( "Bottom Meta", "cea-magazine" ),
						"category"		=> esc_html__( "Category", "cea-magazine" ),
						"author"		=> esc_html__( "Author", "cea-magazine" )
					]
				]
			]
		);	
		$this->add_control(
			'primary_image_label',
			[
				'label' => esc_html__( 'Primary Image Size', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'primary_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `primary_thumbnail_size` and `primary_thumbnail_custom_dimension`.
				'default' => 'medium',
				'separator' => 'none',
			]
		);
		$this->add_control(
			"primary_top_meta",
			[
				"label"			=> "Post Top Meta",
				"description"	=> esc_html__( "This is settings for blog shortcode post top meta.", "cea-magazine" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Left", "cea-magazine" ) => [
						"category"	=> esc_html__( "Category", "cea-magazine" ),
					],
					esc_html__( "Right", "cea-magazine" ) => [],
					esc_html__( "disabled", "cea-magazine" ) => [
						"author"	=> esc_html__( "Author", "cea-magazine" ),
						"more"	=> esc_html__( "Read More", "cea-magazine" ),
						"date"	=> esc_html__( "Date", "cea-magazine" ),
						"comment"	=> esc_html__( "Comment", "cea-magazine" )
					]
				]
			]
		);
		$this->add_control(
			"primary_bottom_meta",
			[
				"label"			=> "Post Bottom Meta",
				"description"	=> esc_html__( "This is settings for blog shortcode post bottom meta.", "cea-magazine" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Left", "cea-magazine" ) => [
						'author'	=> esc_html__( 'Author', 'cea-magazine' ),
					],
					esc_html__( "Right", "cea-magazine" ) => [],
					esc_html__( "disabled", "cea-magazine" ) => [
						'category'	=> esc_html__( 'Category', 'cea-magazine' ),
						'more'	=> esc_html__( 'Read More', 'cea-magazine' ),
						'date'	=> esc_html__( 'Date', 'cea-magazine' ),
						'comment'	=> esc_html__( 'Comment', 'cea-magazine' )
					]
				]
			]
		);		
		$this->add_control(
			"primary_overlay_items_opt",
			[
				"label" 		=> esc_html__( "Primary Overlay Items Options", "cea-magazine" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"primary_overlay_items",
			[
				"label"			=> "Primary Overlay Items",
				"description"	=> esc_html__( "This is settings for primary post overlay items.", "cea-magazine" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Enabled", "cea-magazine" ) => [],
					esc_html__( "disabled", "cea-magazine" ) => [
						"category"	=> esc_html__( "Category", "cea-magazine" ),
						"author"	=> esc_html__( "Author", "cea-magazine" ),
						"more"		=> esc_html__( "Read More", "cea-magazine" ),
						"date"		=> esc_html__( "Date", "cea-magazine" ),
						"comment"	=> esc_html__( "Comment", "cea-magazine" ),
						"title"		=> esc_html__( "Title", "cea-magazine" ),
						"top-meta"		=> esc_html__( "Top Meta", "cea-magazine" ),
						"bottom-meta"	=> esc_html__( "Bottom Meta", "cea-magazine" )
					]
				],
				"condition" 	=> [
					"primary_overlay_items_opt" => "yes"
				]
			]
		);
		$this->add_control(
			'secondary_things',
			[
				'label' => esc_html__( 'Secondary', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);		
		$this->add_control(
			"secondary_excerpt_length",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Secondary Post Excerpt Length", "cea-magazine" ),
				"description"	=> esc_html__( "Here you can define secondary post excerpt length. Example 5", "cea-magazine" ),
				"default" 		=> "5"
			]
		);
		$this->add_control(
			"secondary_title_head",
			[
				"label"			=> esc_html__( "Secondary Title Heading Tag", "cea-magazine" ),
				"description"	=> esc_html__( "This is an option for secondary layout title heading tag", "cea-magazine" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h6",
				"options"		=> [
					"h1"		=> esc_html__( "h1", "cea-magazine" ),
					"h2"		=> esc_html__( "h2", "cea-magazine" ),
					"h3"		=> esc_html__( "h3", "cea-magazine" ),
					"h4"		=> esc_html__( "h4", "cea-magazine" ),
					"h5"		=> esc_html__( "h5", "cea-magazine" ),
					"h6"		=> esc_html__( "h6", "cea-magazine" ),
				]
			]
		);		
		$this->add_control(
			"secondary_post_items",
			[
				"label"				=> "Secondary Post Items",
				"description"		=> esc_html__( "This is settings for secondary layout post items. here you can set your own layout. Drag and drop needed post items to Enabled part.", "cea-magazine" ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					"Enabled" 		=> [ 
						"thumb"			=> esc_html__( "Feature Image", "cea-magazine" ),
						"title"			=> esc_html__( "Title", "cea-magazine" )
					],
					"disabled"		=> [
						"excerpt"		=> esc_html__( "Excerpt", "cea-magazine" ),
						"top-meta"		=> esc_html__( "Top Meta", "cea-magazine" ),
						"bottom-meta"	=> esc_html__( "Bottom Meta", "cea-magazine" ),
						"category"		=> esc_html__( "Category", "cea-magazine" ),
						"author"		=> esc_html__( "Author", "cea-magazine" )
					]
				]
			]
		);
		$this->add_control(
			'secondary_image_label',
			[
				'label' => esc_html__( 'Secondary Image Size', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'secondary_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `secondary_thumbnail_size` and `secondary_thumbnail_custom_dimension`.
				'default' => 'thumbnail',
				'separator' => 'none',
			]
		);
		$this->add_control(
			"secondary_top_meta",
			[
				"label"			=> "Post Top Meta",
				"description"	=> esc_html__( "This is settings for blog shortcode post top meta.", "cea-magazine" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Left", "cea-magazine" ) => [
						"author"	=> esc_html__( "Author", "cea-magazine" ),
					],
					esc_html__( "Right", "cea-magazine" ) => [],
					esc_html__( "disabled", "cea-magazine" ) => [
						"category"	=> esc_html__( "Category", "cea-magazine" ),						
						"more"	=> esc_html__( "Read More", "cea-magazine" ),
						"date"	=> esc_html__( "Date", "cea-magazine" ),
						"comment"	=> esc_html__( "Comment", "cea-magazine" )
					]
				]
			]
		);
		$this->add_control(
			"secondary_bottom_meta",
			[
				"label"			=> "Post Bottom Meta",
				"description"	=> esc_html__( "This is settings for blog shortcode post bottom meta.", "cea-magazine" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Left", "cea-magazine" ) => [
						'category'	=> esc_html__( 'Category', 'cea-magazine' ),
					],
					esc_html__( "Right", "cea-magazine" ) => [],
					esc_html__( "disabled", "cea-magazine" ) => [						
						'author'	=> esc_html__( 'Author', 'cea-magazine' ),
						'more'	=> esc_html__( 'Read More', 'cea-magazine' ),
						'date'	=> esc_html__( 'Date', 'cea-magazine' ),
						'comment'	=> esc_html__( 'Comment', 'cea-magazine' )
					]
				]
			]
		);
		$this->add_control(
			"secondary_overlay_items_opt",
			[
				"label" 		=> esc_html__( "Secondary Overlay Items Options", "cea-magazine" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"secondary_overlay_items",
			[
				"label"			=> "Secondary Overlay Items",
				"description"	=> esc_html__( "This is settings for secondary post overlay items.", "cea-magazine" ),
				"type"			=> "dragdrop",
				"ddvalues"		=> [ 
					esc_html__( "Enabled", "cea-magazine" ) => [],
					esc_html__( "disabled", "cea-magazine" ) => [
						"category"	=> esc_html__( "Category", "cea-magazine" ),
						"author"	=> esc_html__( "Author", "cea-magazine" ),
						"more"		=> esc_html__( "Read More", "cea-magazine" ),
						"date"		=> esc_html__( "Date", "cea-magazine" ),
						"comment"	=> esc_html__( "Comment", "cea-magazine" ),
						"title"		=> esc_html__( "Title", "cea-magazine" ),
						"top-meta"		=> esc_html__( "Top Meta", "cea-magazine" ),
						"bottom-meta"	=> esc_html__( "Bottom Meta", "cea-magazine" )
					]
				],
				"condition" 	=> [
					"secondary_overlay_items_opt" => "yes"
				]
			]
		);		
		$this->end_controls_section();	

		// Link Section
		$this->start_controls_section(
			'section_link',
			[
				'label' => esc_html__( 'Links', 'cea-magazine' ),
				'tab'   => Controls_Manager::TAB,
			]
		);
		$this->add_control(
			'image_link',
			[
				'label' => esc_html__( 'Image', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"image_target",
			[
				"label" 		=> esc_html__( "Target Blank", "cea-magazine" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"image_nofollow",
			[
				"label" 		=> esc_html__( "No Follow", "cea-magazine" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'title_link',
			[
				'label' => esc_html__( 'Title', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"title_target",
			[
				"label" 		=> esc_html__( "Target Blank", "cea-magazine" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"title_nofollow",
			[
				"label" 		=> esc_html__( "No Follow", "cea-magazine" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'more_link',
			[
				'label' => esc_html__( 'Read More', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"more_target",
			[
				"label" 		=> esc_html__( "Target Blank", "cea-magazine" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"more_nofollow",
			[
				"label" 		=> esc_html__( "No Follow", "cea-magazine" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->end_controls_section();
		
		// Style General Section
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => esc_html__( 'General', 'cea-magazine' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->start_controls_tabs( 'tabs_general_style' );
		$this->start_controls_tab(
			'tab_general_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'post_color',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-layouts-wrapper' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_bg_color',
			[
				'label' => esc_html__( 'Background', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-layouts-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_shadow',
				'selector' => '{{WRAPPER}} .blog-layouts-wrapper',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_general_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'post_hcolor',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-layouts-wrapper:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_bg_hcolor',
			[
				'label' => esc_html__( 'Background', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-layouts-wrapper:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'post_hshadow',
				'selector' => '{{WRAPPER}} .blog-layouts-wrapper:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'post_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .blog-layouts-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		
		// Style Title Section
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'cea-magazine' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'primary_title',
			[
				'label' => esc_html__( 'Primary Title', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"title_text_trans",
			[
				"label"			=> esc_html__( "Title Transform", "cea-magazine" ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Set title text-transform property.", "cea-magazine" ),
				"default"		=> "none",
				"options"		=> [
					"none"			=> esc_html__( "Default", "cea-magazine" ),
					"capitalize"	=> esc_html__( "Capitalized", "cea-magazine" ),
					"uppercase"		=> esc_html__( "Upper Case", "cea-magazine" ),
					"lowercase"		=> esc_html__( "Lower Case", "cea-magazine" )
				],
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-title' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);		
		$this->add_control(
			'title_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-title:hover' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'margin', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-title-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-title-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-primary .post-title-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-block-primary .post-title-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-primary .post-title'
			]
		);
		$this->add_control(
			'secondary_title',
			[
				'label' => esc_html__( 'Secondary Title', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"stitle_text_trans",
			[
				"label"			=> esc_html__( "Title Transform", "cea-magazine" ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Set title text-transform property.", "cea-magazine" ),
				"default"		=> "none",
				"options"		=> [
					"none"			=> esc_html__( "Default", "cea-magazine" ),
					"capitalize"	=> esc_html__( "Capitalized", "cea-magazine" ),
					"uppercase"		=> esc_html__( "Upper Case", "cea-magazine" ),
					"lowercase"		=> esc_html__( "Lower Case", "cea-magazine" )
				],
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-title' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->start_controls_tabs( 'tabs_stitle_style' );
		$this->start_controls_tab(
			'tab_stitle_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'stitle_color',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_stitle_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);		
		$this->add_control(
			'stitle_hcolor',
			[
				'label' => esc_html__( 'Hover Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-title:hover' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'stitle_margin',
			[
				'label' => esc_html__( 'margin', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-title-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'stitle_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-title-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'stitle_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-secondary .post-title-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-block-secondary .post-title-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'stitle_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-secondary .post-title'
			]
		);
		$this->end_controls_section();
		
		// Style Image Section
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'cea-magazine' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'primary_image',
			[
				'label' => esc_html__( 'Primary Image', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"resize_opt",
			[
				"label" 		=> esc_html__( "Resize Option", "cea-magazine" ),
				"description"	=> esc_html__( "Enable resize option.", "cea-magazine" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__( 'Image Size', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-primary .post-thumb > a > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
				],
			]
		);
		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => esc_html__( 'Image Spacing', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-primary .post-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);	
		$this->add_control(
			'img_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-thumb > a > img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'img_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-thumb > a > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'img_border',
					'label' => esc_html__( 'Border', 'cea-magazine' ),
					'selector' => '{{WRAPPER}} .cea-block-primary .post-thumb > a > img'
				]
		);
		$this->add_control(
			'img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-thumb > a > img, {{WRAPPER}} .cea-block-primary .post-thumb.post-overlay-active:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'secondary_image',
			[
				'label' => esc_html__( 'Secondary Image', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"sresize_opt",
			[
				"label" 		=> esc_html__( "Resize Option", "cea-magazine" ),
				"description"	=> esc_html__( "Enable resize option.", "cea-magazine" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			'simage_size',
			[
				'label' => esc_html__( 'Image Size', 'cea-magazine' ),
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
					'sresize_opt' => 'yes',	
				],
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-thumb > a > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
				],
			]
		);
		$this->add_responsive_control(
			'simage_spacing',
			[
				'label' => esc_html__( 'Image Spacing', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-secondary .post-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);	
		$this->add_control(
			'simg_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-thumb > a > img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'simg_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-thumb > a > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'simg_border',
					'label' => esc_html__( 'Border', 'cea-magazine' ),
					'selector' => '{{WRAPPER}} .cea-block-secondary .post-thumb > a > img'
				]
		);
		$this->add_control(
			'simg_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-thumb > a > img, {{WRAPPER}} .cea-block-secondary .post-thumb.post-overlay-active:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		// Style Button Section
		$this->start_controls_section(
			'button_section_style',
			[
				'label' => esc_html__( 'Read More Button', 'cea-magazine' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'primary_btn',
			[
				'label' => esc_html__( 'Primary Button', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .cea-block-primary .read-more',
			]
		);
		$this->add_control(
			"btn_text_trans",
			[
				"label"			=> esc_html__( "Transform", "cea-magazine" ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Set read more button text-transform property.", "cea-magazine" ),
				"default"		=> "none",
				"options"		=> [
					"none"			=> esc_html__( "Default", "cea-magazine" ),
					"capitalize"	=> esc_html__( "Capitalized", "cea-magazine" ),
					"uppercase"		=> esc_html__( "Upper Case", "cea-magazine" ),
					"lowercase"		=> esc_html__( "Lower Case", "cea-magazine" )
				],
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .read-more' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );		
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .read-more' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .read-more' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .read-more:hover, {{WRAPPER}} .cea-block-primary .read-more:focus' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .read-more:hover, {{WRAPPER}} .cea-block-primary .read-more:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .read-more:hover, {{WRAPPER}} .cea-block-primary .read-more:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .cea-block-primary .read-more',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .cea-block-primary .read-more',
			]
		);
		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-primary .read-more'
			]
		);
		$this->add_control(
			'secondary_btn',
			[
				'label' => esc_html__( 'Secondary Button', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'stext_shadow',
				'selector' => '{{WRAPPER}} .cea-block-secondary .read-more',
			]
		);
		$this->add_control(
			"sbtn_text_trans",
			[
				"label"			=> esc_html__( "Transform", "cea-magazine" ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Set read more button text-transform property.", "cea-magazine" ),
				"default"		=> "none",
				"options"		=> [
					"none"			=> esc_html__( "Default", "cea-magazine" ),
					"capitalize"	=> esc_html__( "Capitalized", "cea-magazine" ),
					"uppercase"		=> esc_html__( "Upper Case", "cea-magazine" ),
					"lowercase"		=> esc_html__( "Lower Case", "cea-magazine" )
				],
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .read-more' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->start_controls_tabs( 'tabs_sbutton_style' );		
		$this->start_controls_tab(
			'tab_sbutton_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'sbutton_text_color',
			[
				'label' => esc_html__( 'Text Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .read-more' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sbutton_background_color',
			[
				'label' => esc_html__( 'Background Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .read-more' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sbutton_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'sbutton_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .read-more:hover, {{WRAPPER}} .cea-block-secondary .read-more:focus' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'sbutton_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .read-more:hover, {{WRAPPER}} .cea-block-secondary .read-more:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sbutton_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .read-more:hover, {{WRAPPER}} .cea-block-secondary .read-more:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'sbutton_border',
				'selector' => '{{WRAPPER}} .cea-block-secondary .read-more',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'sbutton_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'sbutton_box_shadow',
				'selector' => '{{WRAPPER}} .cea-block-secondary .read-more',
			]
		);
		$this->add_responsive_control(
			'sbutton_text_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'sbutton_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-secondary .read-more'
			]
		);
		$this->end_controls_section();	
		
		// Style Meta Section
		$this->start_controls_section(
			'section_style_meta',
			[
				'label' => esc_html__( 'Meta', 'cea-magazine' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->add_control(
			'top_meta_style',
			[
				'label' => esc_html__( 'Primary Top Meta', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'topmeta_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-primary .top-meta'
			]
		);	
		$this->add_responsive_control(
			'topmeta_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-primary .top-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-block-primary .top-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_tmeta_style' );		
		$this->start_controls_tab(
			'tab_tmeta_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'tmeta_color',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .top-meta' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'tmeta_link_color',
			[
				'label' => esc_html__( 'Link', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .top-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_tmeta_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'tmeta_link_hcolor',
			[
				'label' => esc_html__( 'Link Hover', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .top-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'bottom_meta_style',
			[
				'label' => esc_html__( 'Primary Bottom Meta', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'bottommeta_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-primary .bottom-meta'
			]
		);	
		$this->add_responsive_control(
			'bottommeta_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-primary .bottom-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-block-primary .bottom-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_bmeta_style' );		
		$this->start_controls_tab(
			'tab_bmeta_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'bmeta_color',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .bottom-meta' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'bmeta_link_color',
			[
				'label' => esc_html__( 'Link', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .bottom-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_bmeta_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'bmeta_link_hcolor',
			[
				'label' => esc_html__( 'Link Hover', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .bottom-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_control(
			'stop_meta_style',
			[
				'label' => esc_html__( 'Secondary Top Meta', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'stopmeta_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-secondary .top-meta'
			]
		);	
		$this->add_responsive_control(
			'stopmeta_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-secondary .top-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-block-secondary .top-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_stmeta_style' );		
		$this->start_controls_tab(
			'tab_stmeta_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'stmeta_color',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .top-meta' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'stmeta_link_color',
			[
				'label' => esc_html__( 'Link', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .top-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_stmeta_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'stmeta_link_hcolor',
			[
				'label' => esc_html__( 'Link Hover', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .top-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'sbottom_meta_style',
			[
				'label' => esc_html__( 'Secondary Bottom Meta', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'sbottommeta_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-secondary .bottom-meta'
			]
		);	
		$this->add_responsive_control(
			'sbottommeta_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-secondary .bottom-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-block-secondary .bottom-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_sbmeta_style' );		
		$this->start_controls_tab(
			'tab_sbmeta_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'sbmeta_color',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .bottom-meta' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sbmeta_link_color',
			[
				'label' => esc_html__( 'Link', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .bottom-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_sbmeta_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'sbmeta_link_hcolor',
			[
				'label' => esc_html__( 'Link Hover', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .bottom-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		// Style Content Section
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'cea-magazine' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->add_control(
			'primary_content',
			[
				'label' => esc_html__( 'Primary Content', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_content_style' );
		$this->start_controls_tab(
			'tab_content_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-excerpt' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'content_hcolor',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary:hover .post-excerpt' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-primary .post-excerpt'
			]
		);	
		$this->add_responsive_control(
			'content_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-primary .post-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-block-primary .post-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'secondary_content',
			[
				'label' => esc_html__( 'Secondary Content', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_scontent_style' );
		$this->start_controls_tab(
			'tab_scontent_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'scontent_color',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-excerpt' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scontent_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'scontent_hcolor',
			[
				'label' => esc_html__( 'Color', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary > div:hover .post-excerpt' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'scontent_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-secondary .post-excerpt'
			]
		);	
		$this->add_responsive_control(
			'scontent_spacing',
			[
				'label' => esc_html__( 'Spacing', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-secondary .post-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-block-secondary .post-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'scontent_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'scontent_margin',
			[
				'label' => esc_html__( 'Margin', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		
		// Style Overlay Section
		$this->start_controls_section(
			'section_style_overlay',
			[
				'label' => esc_html__( 'Overlay', 'cea-magazine' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->add_control(
			'primary_overlay',
			[
				'label' => esc_html__( 'Primary', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'ovelay_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-primary .post-overlay-items'
			]
		);	
		$this->add_responsive_control(
			'overlay_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-overlay-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'overlay_position_top',
			[
				'label' => esc_html__( 'Position Top', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-primary .post-overlay-items' => 'position: absolute; top: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'overlay_position_left',
			[
				'label' => esc_html__( 'Position Left', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-primary .post-overlay-items' => 'left: {{SIZE}}%;',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_overlay_style' );
		$this->start_controls_tab(
			'tab_overlay_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'overlay_bg_color',
			[
				'label' => esc_html__( 'Background', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-thumb.post-overlay-active:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_overlay_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'overlay_bg_hcolor',
			[
				'label' => esc_html__( 'Background', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-primary .post-thumb.post-overlay-active:hover:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_control(
			'secondary_overlay',
			[
				'label' => esc_html__( 'Secondary', 'cea-magazine' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'sovelay_typography',
				'selector' 		=> '{{WRAPPER}} .cea-block-secondary .post-overlay-items'
			]
		);	
		$this->add_responsive_control(
			'soverlay_padding',
			[
				'label' => esc_html__( 'Padding', 'cea-magazine' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-overlay-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'soverlay_position_top',
			[
				'label' => esc_html__( 'Position Top', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-secondary .post-overlay-items' => 'position: absolute; top: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'soverlay_position_left',
			[
				'label' => esc_html__( 'Position Left', 'cea-magazine' ),
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
					'{{WRAPPER}} .cea-block-secondary .post-overlay-items' => 'left: {{SIZE}}%;',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_soverlay_style' );
		$this->start_controls_tab(
			'tab_soverlay_normal',
			[
				'label' => esc_html__( 'Normal', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'soverlay_bg_color',
			[
				'label' => esc_html__( 'Background', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-thumb.post-overlay-active:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_soverlay_hover',
			[
				'label' => esc_html__( 'Hover', 'cea-magazine' ),
			]
		);
		$this->add_control(
			'soverlay_bg_hcolor',
			[
				'label' => esc_html__( 'Background', 'cea-magazine' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-block-secondary .post-thumb.post-overlay-active:hover:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
	protected function render() {

		$settings = $this->get_settings_for_display();
		
		extract( $settings );
		$output = '';
		
		//Defined Variable
		$class_names = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';

		$post_per_page = isset( $post_per_page ) && $post_per_page != '' ? $post_per_page : '';
		$primary_excerpt_length = isset( $primary_excerpt_length ) && $primary_excerpt_length != '' ? $primary_excerpt_length : 5;
		$secondary_excerpt_length = isset( $secondary_excerpt_length ) && $secondary_excerpt_length != '' ? $secondary_excerpt_length : 5;
		$include_cats = isset( $include_cats ) ? $include_cats : '';
		$exclude_cats = isset( $exclude_cats ) ? $exclude_cats : '';
		$include_tags = isset( $include_tags ) ? $include_tags : '';
		$include_author = isset( $include_author ) ? $include_author : '';
		$include_posts = isset( $include_posts ) ? $include_posts : '';
		$exclude_posts = isset( $exclude_posts ) ? $exclude_posts : '';
		$orderby = isset( $orderby ) ? $orderby : '';
		$order = isset( $order ) ? $order : '';
		$more_text = isset( $more_text ) ? $more_text : esc_html__( 'Read more', 'cea-magazine' );
		$pagination = isset( $blog_pagination ) && blog_pagination == 'yes' ? true : false;
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

		$blog_layout = isset( $blog_layout ) && $blog_layout != '' ? 'cea_blog_multi_layout_'. esc_attr( $blog_layout ) .'_generate' : 'cea_blog_multi_layout_1_generate';	
		
		//Primary Things
		$primary_default_items = array( 
			"thumb"			=> esc_html__( "Feature Image", "cea-magazine" ),
			"title"			=> esc_html__( "Title", "cea-magazine" ),
			"excerpt"		=> esc_html__( "Excerpt", "cea-magazine" )
		);
		$primary_title_head = isset( $primary_title_head ) && $primary_title_head != '' ? $primary_title_head : 'h3';
		$primary_elemetns = isset( $primary_post_items ) && !empty( $primary_post_items ) ? json_decode( $primary_post_items, true ) : array( 'Enabled' => $primary_default_items );
		$primary_overlay_opt = isset( $primary_overlay_items_opt ) && $primary_overlay_items_opt == 'yes' ? true : false;
		$primary_overlay_items = isset( $primary_overlay_items ) && !empty( $primary_overlay_items ) ? json_decode( $primary_overlay_items, true ) : array( 'Enabled' => '' );
		$primary_top_meta = isset( $primary_top_meta ) && $primary_top_meta != '' ? $primary_top_meta : array( 'Enabled' => '' );
		$primary_bottom_meta = isset( $primary_bottom_meta ) && $primary_bottom_meta != '' ? $primary_bottom_meta : array( 'Enabled' => '' );
		$primary_thumb_size = isset( $primary_thumbnail_size ) ? $primary_thumbnail_size : 'medium';
		
		//Secondary Things
		$secondary_default_items = array( 
			"thumb"			=> esc_html__( "Feature Image", "cea-magazine" ),
			"title"			=> esc_html__( "Title", "cea-magazine" )
		);
		$secondary_title_head = isset( $secondary_title_head ) && $secondary_title_head != '' ? $secondary_title_head : 'h6';
		$secondary_elemetns = isset( $secondary_post_items ) && !empty( $secondary_post_items ) ? json_decode( $secondary_post_items, true ) : array( 'Enabled' => $secondary_default_items );
		$secondary_overlay_opt = isset( $secondary_overlay_items_opt ) && $secondary_overlay_items_opt == 'yes' ? true : false;
		$secondary_overlay_items = isset( $secondary_overlay_items ) && !empty( $secondary_overlay_items ) ? json_decode( $secondary_overlay_items, true ) : array( 'Enabled' => '' );
		$secondary_top_meta = isset( $secondary_top_meta ) && $secondary_top_meta != '' ? $secondary_top_meta : array( 'Enabled' => '' );
		$secondary_bottom_meta = isset( $secondary_bottom_meta ) && $secondary_bottom_meta != '' ? $secondary_bottom_meta : array( 'Enabled' => '' );
		$secondary_thumb_size = isset( $secondary_thumbnail_size ) ? $secondary_thumbnail_size : 'medium';
						
		//Query Start
		global $wp_query;
		$paged = 1;
		if( get_query_var('paged') ){
			$paged = get_query_var('paged');
		}elseif( get_query_var('page') ){
			$paged = get_query_var('page');
		}

		$ppp = $post_per_page != '' ? $post_per_page : 2;
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => absint( $ppp ),
			'paged' => $paged,
			'ignore_sticky_posts' => 1
			
		);
		
		//Include Author
		if( !empty( $include_author ) ){
			$args['author__in'] = $include_author;
		}
		
		//Include Category
		if( !empty( $include_cats ) ){
			$args['category__in'] = $include_cats;
		}
		
		//Exclude Category
		if( !empty( $exclude_cats ) ){
			$args['category__not_in'] = $exclude_cats;
		}
		
		//Include Tags
		if( !empty( $include_tags ) ){
			$args['tag__in'] = $include_tags;
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
		
		$this->post_args = $args;
		$query = new \WP_Query( $args );
			
		if ( $query->have_posts() ) {

			add_filter( 'excerpt_more', 'cea_excerpt_more', 99 );
			
			echo '<div class="blog-layouts-wrapper'. esc_attr( $class_names ) .'">';
				
				// Blog Layouts items array
				$blog_array = array(
					'primary' => array( 
						'title_head' => $primary_title_head,
						'elemetns' => $primary_elemetns,
						'top_meta' => $primary_top_meta,
						'bottom_meta' => $primary_bottom_meta,
						'overlay_opt' => $primary_overlay_opt,
						'overlay_items' => $primary_overlay_items,
						'thumb_size' => $primary_thumb_size,
						'excerpt_len' => $primary_excerpt_length
					),
					'secondary' => array( 
						'title_head' => $secondary_title_head,
						'elemetns' => $secondary_elemetns,
						'top_meta' => $secondary_top_meta,
						'bottom_meta' => $secondary_bottom_meta,
						'overlay_opt' => $secondary_overlay_opt,
						'overlay_items' => $secondary_overlay_items,
						'thumb_size' => $secondary_thumb_size,
						'excerpt_len' => $secondary_excerpt_length
					),
					'image_sizes' => $image_sizes,
					'more_text' => $more_text,
					'pagination' => $pagination
				);

				echo method_exists( $this, $blog_layout ) ? $this->$blog_layout( $query, $blog_array, $settings ) : '';
								
			echo '</div><!-- .blog-layouts-wrapper -->';
			
		}// query exists
		
		// use reset postdata to restore orginal query
		wp_reset_postdata();

	}
	
	function cea_blog_shortcode_elements( $element, $opts = array() ){
		
		$settings = $this->get_settings_for_display();
		
		$output = '';
		$post_id = get_the_ID();
		$stat = isset( $opts['status'] ) ? $opts['status'] : 'primary';
	
		switch( $element ){		
			
			case "title":				
				$head = isset( $opts[$stat]['title_head'] ) ? $opts[$stat]['title_head'] : 'h3';
				$output .= '<div class="entry-title">';
					$output .= '<'. esc_attr( $head ) .' class="post-title-head"><a href="'. esc_url( get_the_permalink() ) .'" class="post-title">'. esc_html( get_the_title() ) .'</a></'. esc_attr( $head ) .'>';
				$output .= '</div><!-- .entry-title -->';		
			break;
			
			case "thumb":
				if ( has_post_thumbnail() ) {
					$overlay_opt = isset( $opts[$stat]['overlay_opt'] ) ? $opts[$stat]['overlay_opt'] : false;
					$thumb_wrap_class = $overlay_opt ? ' post-overlay-active' : '';
					
					$output .= '<div class="post-thumb'. esc_attr( $thumb_wrap_class ) .'">';
						$img_id = get_post_thumbnail_id( get_the_ID() );
						$size = $opts[$stat]['thumb_size'];
						$image_sizes = $opts['image_sizes'];
						$this->add_render_attribute( 'image_class', 'class', 'img-fluid' );
						
						if( in_array( $size, $image_sizes ) ){
							$this->add_render_attribute( 'image_class', 'class', "attachment-$size size-$size" );
							$img_attr = $this->get_render_attributes( 'image_class' );
							$img_attr['class'] = implode( " ", $img_attr['class'] );
							$output .= '<a href="'. esc_url( get_the_permalink() ) .'" '. $this->get_render_attribute_string( 'image-link' ) .'>';
								$output .= wp_get_attachment_image( $img_id, $size, false, $img_attr );
							$output .= '</a>';
						}else{
							$image_src = Group_Control_Image_Size::get_attachment_image_src( $img_id, $stat.'_thumbnail', $settings );
							if ( ! empty( $image_src ) ) {
								$img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
								$output .= '<a href="'. esc_url( get_the_permalink() ) .'" '. $this->get_render_attribute_string( 'image-link' ) .'>';
								$output .= sprintf( '<img src="%s" title="%s" alt="%s" %s />', esc_attr( $image_src ), esc_attr( get_the_title( $img_id ) ), esc_attr( $img_alt ), $this->get_render_attribute_string( 'image_class' ) );
								$output .= '</a>';
							}
						}						
						
						if( $overlay_opt ){
							$post_overlay_items = isset( $opts[$stat]['overlay_items'] ) ? $opts[$stat]['overlay_items'] : array( 'Enabled' => '' );
							$output .= '<div class="post-overlay-items">';
								foreach( $post_overlay_items['Enabled'] as $element => $value ){
									$output .= $this->cea_blog_shortcode_elements( $element, $opts );
								}
							$output .= '</div>';

						}													
					$output .= '</div><!-- .post-thumb -->';
				}
			break;
			
			case "category":
				$categories = get_the_category(); 
				if ( ! empty( $categories ) ){
					$coutput = '<div class="post-category">';
						$coutput .= '<span class="before-icon ti-folder"></span>';
						foreach ( $categories as $category ) {
							$coutput .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>,';
						}
						$output .= rtrim( $coutput, ',' );
					$output .= '</div>';
				}
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
				$read_more_text = isset( $opts['more_text'] ) ? $opts['more_text'] : esc_html__( 'Read more', 'cea-magazine' );
				$output = '<div class="post-more"><a class="read-more elementor-button" href="'. esc_url( get_permalink( $post_id ) ) . '">'. esc_html( $read_more_text ) .'</a></div>';
			break;
			
			case "comment":
				$comments_count = wp_count_comments(get_the_ID());
				$output = '<div class="post-comment"><a href="'. esc_url( get_comments_link( get_the_ID() ) ) .'" rel="bookmark" class="comments-count"><i class="fa fa-comment-o"></i> '. esc_html( $comments_count->total_comments ) .'</a></div>';
			break;
			
			case "excerpt":
				$this->excerpt_len = isset( $opts[$stat]['excerpt_len'] ) ? $opts[$stat]['excerpt_len'] : 10;
				add_filter( 'excerpt_length', array( $this, 'cea_excerpt_length' ), 99 );
				$output = '';
				$excerpt_length = $this->excerpt_len;
				$output .= '<div class="post-excerpt">';
					ob_start();
					$excerpt_cont = ob_get_clean();
					$output .= wp_trim_words( get_the_excerpt(), $excerpt_length );
					$output .= $excerpt_cont;
				$output .= '</div><!-- .post-excerpt -->';	
			break;		
			
			case "top-meta":
				$output = '';
				$top_meta = $opts[$stat]['top_meta'];
				$elemetns = isset( $top_meta ) ? json_decode( $top_meta, true ) : array( 'Left' => '' );
				$output .= '<div class="top-meta clearfix">';
				foreach( $elemetns as $ele_key => $ele_part ){
					if( isset( $ele_part ) && !empty( $ele_part ) && $ele_key != 'disabled' ) :
						$part_class = $ele_key == 'Left' || $ele_key == 'Right' ? ' meta-' . strtolower( $ele_key ) : '';
						$output .= '<ul class="nav top-meta-list'. esc_attr( $part_class ) .'">';
							foreach($ele_part as $element => $value ){
								$blog_array = array( 'more_text' => $opts['more_text'] );
								$output .= '<li>'. $this->cea_blog_shortcode_elements( $element, $blog_array ) .'</li>';
							}
						$output .= '</ul>';
					endif;
				}
				$output .= '</div>';
			break;
			
			case "bottom-meta":
				$output = '';
				$bottom_meta = $opts[$stat]['bottom_meta'];
				$elemetns = isset( $bottom_meta ) ? json_decode( $bottom_meta, true ) : array( 'Left' => '' );
				$output .= '<div class="bottom-meta clearfix">';
				foreach( $elemetns as $ele_key => $ele_part ){
					if( isset( $ele_part ) && !empty( $ele_part ) && $ele_key != 'disabled' ) :
						$part_class = $ele_key == 'Left' || $ele_key == 'Right' ? ' meta-' . strtolower( $ele_key ) : '';
						$output .= '<ul class="nav bottom-meta-list'. esc_attr( $part_class ) .'">';
							foreach($ele_part as $element => $value ){
								$blog_array = array( 'more_text' => $opts['more_text'] );
								$output .= '<li>'. $this->cea_blog_shortcode_elements( $element, $blog_array ) .'</li>';
							}
						$output .= '</ul>';
					endif;
				}
				$output .= '</div>';
			break;
		}
		return $output; 
	}
	
	function cea_excerpt_length( $length ) {
		return $this->excerpt_len;
	}

	function cea_blog_multi_layout_1_generate( $query, $blog_array ){
			
		$single = 0; $first_out = ''; $sec_out = '';
		
		while ($query->have_posts()){
			$query->the_post();
			if($single == 0){
				$blog_array['status'] = 'primary'; $single = 1;					
				$first_out .= $this->cea_blog_multi_layout_generate( $blog_array );						
			}else{						
				$blog_array['status'] = 'secondary';
				if( isset( $blog_array['secondary']['elemetns']['Enabled']['thumb'] ) ){
					$sec_out .= '<div class="media mb-3">';
						$sec_out .= $this->cea_blog_shortcode_elements( 'thumb', $blog_array );
						$t_blog_array = $blog_array;
						unset( $t_blog_array['secondary']['elemetns']['Enabled']['thumb'] );
						$sec_out .= '<div class="media-body ml-3">';
							$sec_out .= $this->cea_blog_multi_layout_generate( $t_blog_array );
						$sec_out .= '</div><!-- .media-body -->';
					$sec_out .= '</div><!-- .media -->';
				}else{
					$sec_out .= $this->cea_blog_multi_layout_generate( $blog_array );
				}					
			}
		}

		$output = '<div class="blog-multi-layout-1">';
			$output .= '<div class="row">';
				$output .= '<div class="col-md-6"><!--top col start-->';
					$output .= '<div class="cea-block-primary">';
						$output .= $first_out;
					$output .= '</div><!--cea-block-primary-->';		
				$output .= '</div><!--top col end-->';
				$output .= '<div class="col-md-6">';
					$output .= '<div class="cea-block-secondary">';
						$output .= $sec_out;
					$output .= '</div><!-- .cea-block-secondary -->';
				$output .= '</div><!-- .col-sm-6 -->';
			$output .= '</div><!-- .row -->';

		$output .= '</div><!-- .blog-multi-layout-1 -->';
		return $output;
	}

	function cea_blog_multi_layout_2_generate( $query, $blog_array ){

		$single = 0; $first_out = ''; $sec_out = '';											
		while ($query->have_posts()){
			$query->the_post();
			if($single <= 1){
				$blog_array['status'] = 'primary';
				if( isset( $blog_array['primary']['elemetns']['Enabled']['thumb'] ) ){
					$first_out .= '<div class="media mb-3">';
						$first_out .= $this->cea_blog_shortcode_elements( 'thumb', $blog_array );
						$t_blog_array = $blog_array;
						unset( $t_blog_array['primary']['elemetns']['Enabled']['thumb'] );
						$first_out .= '<div class="media-body ml-3">';
							$first_out .= $this->cea_blog_multi_layout_generate($t_blog_array);
						$first_out .= '</div><!-- .media-body -->';
					$first_out .= '</div><!-- .media -->';
				}else{
					$first_out .= $this->cea_blog_multi_layout_generate($blog_array);
				}								
			}else{	
				$blog_array['status'] = 'secondary';
				if( isset( $blog_array['secondary']['elemetns']['Enabled']['thumb'] ) ){
					$sec_out .= '<div class="media mb-3">';
						$sec_out .= $this->cea_blog_shortcode_elements( 'thumb', $blog_array );
						$t_blog_array = $blog_array;
						unset( $t_blog_array['secondary']['elemetns']['Enabled']['thumb'] );
						$sec_out .= '<div class="media-body ml-3">';
							$sec_out .= $this->cea_blog_multi_layout_generate($t_blog_array);
						$sec_out .= '</div><!-- .media-body -->';
					$sec_out .= '</div><!-- .media -->';
				}else{
					$sec_out .= $this->cea_blog_multi_layout_generate($blog_array);
				}
			}
			$single++;
		}					
		
		$output = '<div class="blog-multi-layout-2">';
			$output .= '<div class="row">';
				$output .= '<div class="col-md-6">';
					$output .= '<div class="cea-block-primary">';
						$output .= $first_out;
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!-- .col-md-6 -->';
				$output .= '<div class="col-md-6">';
					$output .= '<div class="cea-block-secondary">';
						$output .= $sec_out;
					$output .= '</div><!-- .cea-block-secondary -->';
				$output .= '</div><!-- .col-md-6 -->';
			$output .= '</div><!-- .row -->';
		$output .= '</div><!-- .blog-multi-layout-2 -->';
		return $output;
	}

	function cea_blog_multi_layout_3_generate( $query, $blog_array ){
		$output = '<div class="blog-multi-layout-3">';
			$single = 1;
			
			$copy_blog_array = $blog_array;
		
			$first_out = $sec_out = $last_out = '';
			$blog_array['status'] = 'primary';

			while ($query->have_posts()){
				$query->the_post();
				if($single == 1){
					$first_out = $this->cea_blog_multi_layout_generate( $blog_array );
				}elseif($single == 2){
					$sec_out = $this->cea_blog_multi_layout_generate( $blog_array );
				}else{	
					$copy_blog_array['status'] = 'secondary';
					if( isset( $copy_blog_array['secondary']['elemetns']['Enabled']['thumb'] ) ){
						$last_out .= '<div class="media mb-3">';
							$last_out .= $this->cea_blog_shortcode_elements( 'thumb', $copy_blog_array );
							$t_blog_array = $copy_blog_array;
							unset( $t_blog_array['secondary']['elemetns']['Enabled']['thumb'] );
							$last_out .= '<div class="media-body ml-3">';
								$last_out .= $this->cea_blog_multi_layout_generate( $t_blog_array );
							$last_out .= '</div><!-- .media-body -->';
						$last_out .= '</div><!-- .media -->';
					}else{
						$last_out .= $this->cea_blog_multi_layout_generate( $copy_blog_array );
					}
				}
				$single++;
			}
			
			$output .= '<div class="row">';	
				$output .= '<div class="col-md-4">';
					$output .= '<div class="cea-block-primary">';
						$output .= $first_out;
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!-- .col-md-4 -->';
				$output .= '<div class="col-md-4">';
					$output .= '<div class="cea-block-primary">';
						$output .= $sec_out;
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!-- .col-md-4 -->';
				$output .= '<div class="col-md-4">';
					$output .= '<div class="cea-block-secondary">';
						$output .= $last_out;
					$output .= '</div><!-- .cea-block-secondary -->';
				$output .= '</div><!-- .col-md-4 -->';
			$output .= '</div><!-- .row -->';
		$output .= '</div><!-- .blog-multi-layout-3 -->';
		return $output;
	}

	function cea_blog_multi_layout_4_generate( $query, $blog_array ){
		$output = '<div class="blog-multi-layout-4">';
			$single = 1;
			$copy_blog_array = $blog_array;
			$first_out = $sec_out = $last_out = '';
			$total = $query->post_count;

			while ($query->have_posts()){
				$query->the_post();
				if($single == 1){
					$blog_array['status'] = 'primary';
					$first_out = $this->cea_blog_multi_layout_generate($blog_array);
				}elseif($single == $total){
					$copy_blog_array['status'] = 'primary';
					$last_out .= $this->cea_blog_multi_layout_generate($copy_blog_array);
				}else{
					$blog_array['status'] = 'secondary';
					if( isset( $blog_array['secondary']['elemetns']['Enabled']['thumb'] ) ){
						$sec_out .= '<div class="media mb-3">';
							$sec_out .= $this->cea_blog_shortcode_elements( 'thumb', $blog_array );
							$t_blog_array = $blog_array;
							unset( $t_blog_array['secondary']['elemetns']['Enabled']['thumb'] );
							$sec_out .= '<div class="media-body ml-3">';
								$sec_out .= $this->cea_blog_multi_layout_generate($t_blog_array);
							$sec_out .= '</div><!-- .media-body -->';
						$sec_out .= '</div><!-- .media -->';
					}else{
						$sec_out .= $this->cea_blog_multi_layout_generate($blog_array);
					}
				}
				$single++;
			}
					
			$output .= '<div class="row">';
				$output .= '<div class="col-md-4">';
					$output .= '<div class="cea-block-primary">';
						$output .= $first_out;
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!-- .col-md-4 -->';
				$output .= '<div class="col-md-4">';
					$output .= '<div class="cea-block-secondary">';
						$output .= $sec_out;
					$output .= '</div><!-- .cea-block-secondary -->';
				$output .= '</div><!-- .col-sm-4 -->';
				$output .= '<div class="col-md-4">';
					$output .= '<div class="cea-block-primary">';
						$output .= $last_out;
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!-- .col-md-4 -->';
			$output .= '</div><!-- .row -->';
			
		$output .= '</div><!-- .blog-multi-layout-4 -->';
		return $output;
	}

	function cea_blog_multi_layout_5_generate( $query, $blog_array ){
		$output = '<div class="blog-multi-layout-5">';
			$single = 1;
			$copy_blog_array = $blog_array;
			$total = $query->post_count;
			
			$first_out = $sec_out = $third_out = '';
			
			while ($query->have_posts()){
				$query->the_post();
				if($single == 1){
					$blog_array['status'] = 'primary';
					$first_out .= $this->cea_blog_multi_layout_generate($blog_array);
				}elseif($single >= 5){
					$blog_array['status'] = 'secondary';
					if( isset( $blog_array['secondary']['elemetns']['Enabled']['thumb'] ) ){
						$third_out .= '<div class="media mb-3">';
							$third_out .= $this->cea_blog_shortcode_elements( 'thumb', $blog_array );
							$t_blog_array = $blog_array;
							unset( $t_blog_array['secondary']['elemetns']['Enabled']['thumb'] );
							$third_out .= '<div class="media-body ml-3">';
								$third_out .= $this->cea_blog_multi_layout_generate($t_blog_array);
							$third_out .= '</div><!-- .media-body -->';
						$third_out .= '</div><!-- .media -->';
					}else{
						$third_out .= $this->cea_blog_multi_layout_generate($blog_array);
					}
				}else{
					$blog_array['status'] = 'secondary';
					if( isset( $blog_array['secondary']['elemetns']['Enabled']['thumb'] ) ){
						$sec_out .= '<div class="media mb-3">';
							$sec_out .= $this->cea_blog_shortcode_elements( 'thumb', $blog_array );
							$t_blog_array = $blog_array;
							unset( $t_blog_array['secondary']['elemetns']['Enabled']['thumb'] );
							$sec_out .= '<div class="media-body ml-3">';
								$sec_out .= $this->cea_blog_multi_layout_generate($t_blog_array);
							$sec_out .= '</div><!-- .media-body -->';
						$sec_out .= '</div><!-- .media -->';
					}else{
						$sec_out .= $this->cea_blog_multi_layout_generate($blog_array);
					}
				}
				$single++;
			}
			$output .= '<div class="row">';
				$output .= '<div class="col-md-4">';
					$output .= '<div class="cea-block-primary">';
						$output .= $first_out;
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!-- .col -->';
				$output .= '<div class="col-md-4">';
					$output .= '<div class="cea-block-secondary">';
						$output .= $sec_out;
					$output .= '</div><!-- .cea-block-secondary -->';	
				$output .= '</div><!-- .col -->';
				$output .= '<div class="col-md-4">';
					$output .= '<div class="cea-block-secondary">';
						$output .= $third_out;
					$output .= '</div><!-- .cea-block-secondary -->';
				$output .= '</div><!-- .col -->';
			$output .= '</div><!-- .row -->';
		$output .= '</div><!-- .blog-multi-layout-5 -->';
		return $output;
	}

	function cea_blog_multi_layout_6_generate( $query, $blog_array ){
		$output = '<div class="blog-multi-layout-6">';
			$single = 0;
			
			$first_out = $sec_out = '';
			
			while ($query->have_posts()){
				$query->the_post();
				if($single == 0){
					$blog_array['status'] = 'primary';
					$first_out = $this->cea_blog_multi_layout_generate($blog_array);					
					$single = 1;
				}else{	
					$blog_array['status'] = 'secondary';
					if( isset( $blog_array['secondary']['elemetns']['Enabled']['thumb'] ) ){
						$sec_out .= '<div class="media mb-3">';
							$sec_out .= $this->cea_blog_shortcode_elements( 'thumb', $blog_array );
							$t_blog_array = $blog_array;
							unset( $t_blog_array['secondary']['elemetns']['Enabled']['thumb'] );
							$sec_out .= '<div class="media-body ml-3">';
								$sec_out .= $this->cea_blog_multi_layout_generate($t_blog_array);
							$sec_out .= '</div><!-- .media-body -->';
						$sec_out .= '</div><!-- .media -->';
					}else{
						$sec_out .= $this->cea_blog_multi_layout_generate($blog_array);
					}
				}
			}
			$output .= '<div class="row">';
				$output .= '<div class="col-md-12"><!--top col start-->';
					$output .= '<div class="cea-block-primary">';
						$output .= $first_out;
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!--col end-->';
				$output .= '<div class="col-md-12">';
					$output .= '<div class="cea-block-secondary">';
						$output .= $sec_out;
					$output .= '</div><!-- .cea-block-secondary -->';
				$output .= '</div><!-- .col-md-12 -->';
			$output .= '</div><!-- .row -->';
		$output .= '</div><!-- .blog-multi-layout-6 -->';
		return $output;
	}

	function cea_blog_multi_layout_7_generate( $query, $blog_array ){
		$output = '<div class="blog-multi-layout-7">';
			$single = 1;
			$total = $query->post_count;
			
			$first_out = $sec_out = $third_out = $last_out = '';
			
			while ($query->have_posts()){
				$query->the_post();
				if($single == 1){
					$blog_array['status'] = 'primary';
					$first_out = $this->cea_blog_multi_layout_generate($blog_array);
				}elseif($single == 2){
					$blog_array['status'] = 'primary';
					$sec_out = $this->cea_blog_multi_layout_generate($blog_array);
				}elseif( $single > 2 && ( $single % 2 == 1 ) ){
					$blog_array['status'] = 'secondary';
					if( isset( $blog_array['secondary']['elemetns']['Enabled']['thumb'] ) ){
						$third_out .= '<div class="media mb-3">';
							$third_out .= $this->cea_blog_shortcode_elements( 'thumb', $blog_array );
							$t_blog_array = $blog_array;
							unset( $t_blog_array['secondary']['elemetns']['Enabled']['thumb'] );
							$third_out .= '<div class="media-body ml-3">';
								$third_out .= $this->cea_blog_multi_layout_generate($t_blog_array);
							$third_out .= '</div><!-- .media-body -->';
						$third_out .= '</div><!-- .media -->';
					}else{
						$third_out .= $this->cea_blog_multi_layout_generate($blog_array);
					}
				}else{	
					$blog_array['status'] = 'secondary';
					if( isset( $blog_array['secondary']['elemetns']['Enabled']['thumb'] ) ){
						$last_out .= '<div class="media mb-3">';
							$last_out .= $this->cea_blog_shortcode_elements( 'thumb', $blog_array );
							$t_blog_array = $blog_array;
							unset( $t_blog_array['secondary']['elemetns']['Enabled']['thumb'] );
							$last_out .= '<div class="media-body ml-3">';
								$last_out .= $this->cea_blog_multi_layout_generate($t_blog_array);
							$last_out .= '</div><!-- .media-body -->';
						$last_out .= '</div><!-- .media -->';
					}else{
						$last_out .= $this->cea_blog_multi_layout_generate($blog_array);
					}
				}
				$single++;
			}
					
			$output .= '<div class="row">';
				$output .= '<div class="col-md-6">';
					$output .= '<div class="cea-block-primary">';
						$output .= $first_out;
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!-- .col-md-6 -->';
				$output .= '<div class="col-md-6">';
					$output .= '<div class="cea-block-primary">';
						$output .= $sec_out;
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!-- .col-md-6 -->';
			$output .= '</div><!-- .row -->';
			$output .= '<div class="row">';
				$output .= '<div class="col-md-6">';
					$output .= '<div class="cea-block-secondary">';
						$output .= $third_out;
					$output .= '</div><!-- .cea-block-secondary -->';
				$output .= '</div><!-- .col-md-6 -->';
				$output .= '<div class="col-md-6">';
					$output .= '<div class="cea-block-secondary">';
						$output .= $last_out;
					$output .= '</div><!-- .cea-block-secondary -->';
				$output .= '</div><!-- .col-md-6 -->';
			$output .= '</div><!-- .row -->';
		$output .= '</div><!-- .blog-multi-layout-7 -->';
		return $output;
	}

	function cea_blog_multi_layout_8_generate( $query, $blog_array ){
		$output = '<div class="blog-multi-layout-8">';
			$single = 1;
			$total = $query->post_count;
			$copy_blog_array = $blog_array;
			$first_out = $sec_out = $third_out = $last_out = '';
			
			while ($query->have_posts()){
				$query->the_post();
				if($single == 1){
					$blog_array['status'] = 'primary';
					$first_out = $this->cea_blog_multi_layout_generate($blog_array);
				}elseif( $single > 1 && $single < 5 ){
					$blog_array['status'] = 'secondary';
					$copy_blog_array['status'] = 'secondary';
					if( isset( $copy_blog_array['secondary']['elemetns']['Enabled']['thumb'] ) ){
						$sec_out .= '<div class="media mb-3">';
							$sec_out .= $this->cea_blog_shortcode_elements( 'thumb', $copy_blog_array );
							$t_blog_array = $copy_blog_array;
							unset( $t_blog_array['secondary']['elemetns']['Enabled']['thumb'] );
							$sec_out .= '<div class="media-body ml-3">';
								$sec_out .= $this->cea_blog_multi_layout_generate($t_blog_array);
							$sec_out .= '</div><!-- .media-body -->';
						$sec_out .= '</div><!-- .media -->';
					}else{
						$sec_out .= $this->cea_blog_multi_layout_generate($blog_array);
					}
				}elseif($single == $total){
					$blog_array['status'] = 'primary';
					$last_out = $this->cea_blog_multi_layout_generate($blog_array);
				}else{	
					$blog_array['status'] = 'secondary';
					$copy_blog_array['status'] = 'secondary';
					if( isset( $copy_blog_array['secondary']['elemetns']['Enabled']['thumb'] ) ){
						$third_out .= '<div class="media mb-3">';
							$t_blog_array = $copy_blog_array;
							unset( $t_blog_array['secondary']['elemetns']['Enabled']['thumb'] );
							$third_out .= '<div class="media-body mr-3">';
								$third_out .= $this->cea_blog_multi_layout_generate($t_blog_array);
							$third_out .= '</div><!-- .media-body -->';
							$third_out .= $this->cea_blog_shortcode_elements( 'thumb', $copy_blog_array );
						$third_out .= '</div><!-- .media -->';
					}else{
						$third_out .= $this->cea_blog_multi_layout_generate($blog_array);
					}
				}
				$single++;
			}
					
			$output .= '<div class="row">';
				$output .= '<div class="col-md-6">';
					$output .= '<div class="cea-block-primary">';
						$output .= $first_out;
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!-- .col-md-6 -->';
				$output .= '<div class="col-md-6">';
					$output .= '<div class="cea-block-secondary">';
						$output .= $sec_out;
					$output .= '</div><!-- .cea-block-secondary -->';
				$output .= '</div><!-- .col-md-6 -->';
			$output .= '</div><!-- .row -->';
			$output .= '<div class="row">';
				$output .= '<div class="col-md-6">';
					$output .= '<div class="cea-block-secondary">';
						$output .= $third_out;
					$output .= '</div><!-- .cea-block-secondary -->';
				$output .= '</div><!-- .col-md-6 -->';
				$output .= '<div class="col-md-6">';
					$output .= '<div class="cea-block-primary">';
						$output .= $last_out;
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!-- .col-md-6 -->';
			$output .= '</div><!-- .row -->';
		$output .= '</div><!-- .blog-multi-layout-8 -->';
		return $output;
	}

	function cea_blog_multi_layout_list_generate( $query, $blog_array ){
		$output = '<div class="blog-multi-layout-list">';
			$output .= '<div class="row">';

			$blog_array['grid_stat'] = 1;
			
			while ($query->have_posts()){
				$query->the_post();			
				$output .= '<div class="col-md-12">';
					$output .= '<div class="cea-block-primary">';
						if( isset( $blog_array['elemetns']['Enabled']['thumb'] ) ){
							$output .= '<div class="media mb-3">';
								$output .= $this->cea_blog_shortcode_elements( 'thumb', $blog_array );
								$t_blog_array = $blog_array;
								unset( $t_blog_array['elemetns']['Enabled']['thumb'] );
								$output .= '<div class="media-body ml-3">';
									$output .= $this->cea_blog_multi_layout_generate($t_blog_array);
								$output .= '</div><!-- .media-body -->';
							$output .= '</div><!-- .media -->';
						}else{
							$output .= $this->cea_blog_multi_layout_generate($blog_array);
						}
					$output .= '</div><!--cea-block-primary-->';
				$output .= '</div><!-- .col-md-12 -->';

			}

			$output .= '</div><!-- .row -->';
			$output .= isset( $blog_array['pagination'] ) && $blog_array['pagination'] ? $this->cea_blog_shortcode_pagination( $this->post_args, $query ) : '';
		$output .= '</div><!-- .blog-multi-layout-list -->';
		return $output;
	}

	function cea_blog_multi_layout_generate( $blog_array ){
		$output = '';
		$stat = isset( $blog_array['status'] ) ? $blog_array['status'] : 'primary';
		$elemetns = $blog_array[$stat]['elemetns'];
		if( isset( $elemetns['Enabled'] ) ) :
			foreach( $elemetns['Enabled'] as $element => $value ){
				$output .= $this->cea_blog_shortcode_elements( $element, $blog_array );
			}
		endif;
		return $output;
	}

	function cea_blog_shortcode_pagination( $args = array(), $query = null ){
		$output = '';
		if( $query ){
			require_once CEA_CORE_DIR . '/inc/cea-class.php';
			$cea_ele = new CEAPostElements;		
			$output = $cea_ele->ceaWpBootstrapPagination( $args, $query->max_num_pages, false );		
		}
		return $output;
	}

}
<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * ZOZO Header Footer Elements PageTitle
 * @since 1.0.0
 */
 
class ZOZO_HF_PageTitle_Widget extends Widget_Base {
	
	
	/**
	 * Get widget name.
	 *
	 * Retrieve pagetitle widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "zozo_hf_pagetitle";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve pagetitle widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Page Title", "zozo-header-footer" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve pagetitle widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "zhf-icon eicon-t-letter-bold";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the pagetitle widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ "zozo-hf-elements" ];
	}
	
	public function get_style_depends() {
		return [ 'zozo-header-footer' ];
	}

	/**
	 * Register pagetitle widget controls. 
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		
		//Page Title Section
		$this->start_controls_section(
			'pagetitle_section',
			[
				'label'	=> esc_html__( 'Page Title', 'zozo-header-footer' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'archive_title_note',
			[
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => sprintf( __( '<b>Note:</b> Archive page title will be visible on frontend.', 'zozo-header-footer' ) ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
		$this->add_control(
			"title_prefix",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Prefix Title", "zozo-header-footer" )
			]
		);
		$this->add_control(
			"title_suffix",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Suffix Title", "zozo-header-footer" )
			]
		);
		$this->add_control(
			"title_head",
			[
				"label"			=> esc_html__( "Heading Tag", "zozo-header-footer" ),
				"description"	=> esc_html__( "Here you can choose the section title box title heading tag.", "zozo-header-footer" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h2",
				"options"		=> [
					"h1"		=> esc_html__( "h1", "zozo-header-footer" ),
					"h2"		=> esc_html__( "h2", "zozo-header-footer" ),
					"h3"		=> esc_html__( "h3", "zozo-header-footer" ),
					"h4"		=> esc_html__( "h4", "zozo-header-footer" ),
					"h5"		=> esc_html__( "h5", "zozo-header-footer" ),
					"h6"		=> esc_html__( "h6", "zozo-header-footer" ),
					"p"			=> esc_html__( "p", "zozo-header-footer" ),
					"span"		=> esc_html__( "span", "zozo-header-footer" ),
					"div"		=> esc_html__( "div", "zozo-header-footer" ),
				]
			]
		);
		$this->add_responsive_control(
			'title_align',
			[
				'label'              => esc_html__( 'Alignment', 'zozo-header-footer' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'    => [
						'title' => esc_html__( 'Left', 'zozo-header-footer' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'zozo-header-footer' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'zozo-header-footer' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'zozo-header-footer' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'            => '',
				'selectors'          => [
					'{{WRAPPER}} .zhf-page-title-inner .zhf-title-part' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'breadcrumb',
			[
				'label' 		=> esc_html__( 'Breadcrumb', 'zozo-header-footer' ),
				'description'	=> esc_html__( 'This is option for custom logo. Enable this too choose custom logo, or else leave disable stat to set default one.', 'zozo-header-footer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no'
			]
		);
		$this->add_responsive_control(
			"display_style",
			[
				"label"			=> esc_html__( "Display Style", "zozo-header-footer" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "block",
				"options"		=> [
					"block"		=> esc_html__( "Block", "zozo-header-footer" ),
					"inline-block"	=> esc_html__( "Inline", "zozo-header-footer" )
				],
				"condition" 	=> [
					"breadcrumb" 	=> "yes"
				],
				'prefix_class' => 'zhf-align-',
			]
		);
		$this->end_controls_section();
		
		//Breadcrumb Section
		$this->start_controls_section(
			'breadcrumb_section',
			[
				'label'	=> esc_html__( 'Breadcrumb', 'zozo-header-footer' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
				"condition" 	=> [
					"breadcrumb" 	=> "yes"
				]
			]
		);
		$this->add_responsive_control(
			"breadcrumb_position",
			[
				"label"			=> esc_html__( "Display Position", "zozo-header-footer" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "after",
				"options"		=> [
					"before"		=> esc_html__( "Before Title", "zozo-header-footer" ),
					"after"	=> esc_html__( "After Title", "zozo-header-footer" )
				]
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label'              => esc_html__( 'Alignment', 'zozo-header-footer' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'    => [
						'title' => esc_html__( 'Left', 'zozo-header-footer' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'zozo-header-footer' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'zozo-header-footer' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'zozo-header-footer' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'            => '',
				'selectors'          => [
					'{{WRAPPER}} .zhf-page-title-inner .zhf-breadcrumb-part' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'separator_icon',
			[
				'label'       => esc_html__( 'Separator Icon', 'zozo-header-footer' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => 'true',
				'default'     => [
					'value'   => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				]
			]
		);
		$this->end_controls_section();
		
		// General Style
		$this->start_controls_section(
			'section_style_general',
			[
				'label'     => esc_html__( 'General', 'zozo-header-footer' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'padding_pt',
			[
				'label'              => esc_html__( 'Padding', 'zozo-header-footer' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 15,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .zhf-page-title-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
			'margin_pt',
			[
				'label'              => esc_html__( 'Margin', 'zozo-header-footer' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 15,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .zhf-page-title-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'frontend_available' => true,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'zozo-header-footer' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .zhf-page-title-inner',
			]
		);
		$this->add_control(
			'background_overlay_options',
			[
				'label' => esc_html__( 'Background Overlay', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_overlay',
				'selector' => '{{WRAPPER}} .zhf-page-title-inner .zhf-bg-overlay',
			]
		);

		$this->add_control(
			'background_overlay_opacity',
			[
				'label' => esc_html__( 'Opacity', 'zozo-header-footer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zhf-page-title-inner .zhf-bg-overlay' => 'content: ""; position: absolute; top: 0; left: 0; height: 100%;	width: 100%; z-index: -1;opacity: {{SIZE}};',
				],
				'condition' => [
					'background_overlay_background' => [ 'classic', 'gradient' ],
				],
			]
		);
		$this->end_controls_section();
		
		// Page Title Style
		$this->start_controls_section(
			'section_style_page_title',
			[
				'label'     => esc_html__( 'Page Title', 'zozo-header-footer' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'pt_color',
			[
				'label' => esc_html__( 'Page Title Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-title-part > *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pt_typography',
				'selector' => '{{WRAPPER}} .zhf-title-part > *',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);
		$this->end_controls_section();
		
		// Breadcrumb Style
		$this->start_controls_section(
			'section_style_breadcrumb',
			[
				'label'     => esc_html__( 'Breadcrumb', 'zozo-header-footer' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'breadcrumb_text_color',
			[
				'label' => esc_html__( 'Breadcrumb Text Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-breadcrumb-part' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'background_link_color',
			[
				'label' => esc_html__( 'Link Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_breadcrumb' );
		$this->start_controls_tab(
			'tab_breadcrumb_normal',
			[
				'label' => esc_html__( 'Normal', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'breadcrumb_color',
			[
				'label' => esc_html__( 'Breadcrumb Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-breadcrumb-part a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_overlay_hover',
			[
				'label' => esc_html__( 'Hover', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'breadcrumb_hcolor',
			[
				'label' => esc_html__( 'Breadcrumb Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-breadcrumb-part a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_control(
			'breadcrumb_typography_head',
			[
				'label' => esc_html__( 'Breadcrumb Typography', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'breadcrumb_typography',
				'selector' => '{{WRAPPER}} .zhf-breadcrumb-part',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);
		
		$this->add_control(
			'breadcrumb_separator',
			[
				'label' => esc_html__( 'Breadcrumb Separator', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'separator_icon_size',
			[
				'label' => esc_html__( 'Size', 'zozo-header-footer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 12,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} ul.zhf-breadcrumb > li > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} ul.zhf-breadcrumb > li svg' => 'width: {{SIZE}}{{UNIT}};'  //->modified
				],
			]
		);
		$this->add_responsive_control(
			'separator_icon_hgt',
			[
				'label' => esc_html__( 'Height', 'zozo-header-footer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} ul.zhf-breadcrumb > li > i' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} ul.zhf-breadcrumb > li svg' => 'height: {{SIZE}}{{UNIT}};'  //->modified
				],
			]
		);
		$this->add_responsive_control(
			'separator_icon_wdth',
			[
				'label' => esc_html__( 'Width', 'zozo-header-footer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} ul.zhf-breadcrumb > li > i' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} ul.zhf-breadcrumb > li svg' => 'width: {{SIZE}}{{UNIT}};'  //->modified
				],
			]
		);
		$this->add_responsive_control(
			'separator_icon_lh',
			[
				'label' => esc_html__( 'Line height', 'zozo-header-footer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} ul.zhf-breadcrumb > li > i:before' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} ul.zhf-breadcrumb > li svg' => 'margin: {{SIZE}}{{UNIT}} 0{{UNIT}};'  //->modified
				],
			]
		);
		$this->add_control(
			'separator_color',
			[
				'label'     => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} ul.zhf-breadcrumb > li > i' => 'color: {{VALUE}};',
					'{{WRAPPER}} ul.zhf-breadcrumb > li svg' => 'fill: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'separator_bg',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} ul.zhf-breadcrumb > li > i' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} ul.zhf-breadcrumb > li svg' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'separator_icon_border',
				'selectors' => [
					'{{WRAPPER}} ul.zhf-breadcrumb > li > i',
					'{{WRAPPER}} ul.zhf-breadcrumb > li svg'
				]
			]
		);
		$this->add_control(
			'separator_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} ul.zhf-breadcrumb > li > i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} ul.zhf-breadcrumb > li svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'separator_padding_pt',
			[
				'label'              => esc_html__( 'Padding', 'zozo-header-footer' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 15,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} ul.zhf-breadcrumb > li > i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} ul.zhf-breadcrumb > li svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
			'separator_margin_pt',
			[
				'label'              => esc_html__( 'Margin', 'zozo-header-footer' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 15,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} ul.zhf-breadcrumb > li > i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} ul.zhf-breadcrumb > li svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render pagetitle widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();		
		$title_prefix = isset( $settings['title_prefix'] ) ? $settings['title_prefix'] : '';
		$title_suffix = isset( $settings['title_suffix'] ) ? $settings['title_suffix'] : '';
		$title_head = isset( $settings['title_head'] ) ? $settings['title_head'] : 'h2';
		$breadcrumb = isset( $settings['breadcrumb'] ) ? $settings['breadcrumb'] : false;
		$breadcrumb_position = isset( $settings['breadcrumb_position'] ) ? $settings['breadcrumb_position'] : false;
		?>
		<div class="zhf-page-title-wrapper">
			<div class="zhf-page-title-inner">
				<span class="zhf-bg-overlay"></span>
				
				<?php if( $breadcrumb == 'yes' && $breadcrumb_position == 'before' ) self::breadcrumb_position( $settings ); ?>
				<div class="zhf-title-part">
					<<?php echo esc_attr( $title_head ); ?>>
					<?php
						if( $title_prefix ) echo '<span class="page-title-prefix">'. wp_kses_post( $title_prefix ) .'</span>'; 
						if ( is_archive() || is_home() ) {
							echo wp_kses_post( get_the_archive_title() );
						} else {
							echo wp_kses_post( get_the_title() );
						}
						if( $title_suffix ) echo '<span class="page-title-suffix">'. wp_kses_post( $title_suffix ) .'</span>'; 
					?>
					</<?php echo esc_attr( $title_head ); ?>>
				</div><!-- .zhf-title-part -->
				<?php if( $breadcrumb == 'yes' && $breadcrumb_position == 'after' ) self::breadcrumb_position( $settings ); ?>				
			</div>
		</div>
		<?php
	}
	
	public static function breadcrumb_position($settings){ ?>
		<div class="zhf-breadcrumb-part">
			<?php echo self::breadcrumb_render( $settings['separator_icon'] ); ?>
		</div><!-- .zhf-breadcrumb-part -->
	<?php
	}
	
	public static function breadcrumb_render($icon) { 
		
		ob_start();
		Icons_Manager::render_icon(
			$icon,
			[
				'aria-hidden' => 'true',
				'tabindex'    => '0',
			]
		);
		$separator_icon = ob_get_clean();
	
		$showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter = $separator_icon;//'&raquo;'; // delimiter between crumbs
		$home = esc_html__( 'Home', 'zozo-header-footer' ); // text for the 'Home' link
		$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$before = '<li><span class="current">'; // tag before the current crumb
		$after = '</span></li>'; // tag after the current crumb
		
		$allowed_html = array(
			'li' => array(
				'itemprop' => array(),
				'itemscope' => array(),
				'itemtype' => array()
			),
			'a' => array(
				'href' => array(),
				'title' => array(),
				'itemprop' => array()
			)
		);

		global $post;
		$homeLink = home_url( '/' );
		$bread_out = '';
		$bread_out .= '<ul class="zhf-breadcrumb">';

		if (is_home() || is_front_page()) {
			if ($showOnHome == 1) $bread_out .= wp_kses( $before . $home . $after, $allowed_html );
		} else {
			$bread_out .= '<li><a href="' . $homeLink . '"><span>' . $home . '</span></a>' . $delimiter . '</li> ';
			if ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				if( $post_type ){
					$bread_out .= wp_kses( $before . $post_type->labels->singular_name . $after, $allowed_html );
				}else{
					$queried_object = get_queried_object();
					if( $queried_object )
					$bread_out .= wp_kses( $before . $queried_object->name . $after, $allowed_html );
				}
			} elseif ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0){
					$bread_out .= self::zhf_get_term_parents_list( $cat, 'category', array( 'separator' => ' ' . $delimiter . ' ' ) );
				}
				$bread_out .= wp_kses( $before . single_cat_title('', false) . $after, $allowed_html );
			} elseif ( is_search() ) {
				$bread_out .= wp_kses( $before . get_search_query() . $after, $allowed_html );
			} elseif ( is_day() ) {
				$bread_out .= '<li><a href="' . get_year_link(get_the_time('Y')) . '"><span>' . get_the_time('Y') . '</span></a> ' . $delimiter . '</li> ';
				$bread_out .= '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '"><span>' . get_the_time('F') . '</span></a> ' . $delimiter . '</li> ';
				$bread_out .= wp_kses( $before . get_the_time('d') . $after, $allowed_html );
			} elseif ( is_month() ) {
				$bread_out .= '<li><a href="' . get_year_link(get_the_time('Y')) . '"><span>' . get_the_time('Y') . '</span></a> ' . $delimiter . '</li> ';
				$bread_out .= wp_kses( $before . get_the_time('F') . $after, $allowed_html );
			} elseif ( is_year() ) {
				$bread_out .= wp_kses( $before . get_the_time('Y') . $after, $allowed_html );
			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					$bread_out .= '<li><a href="' . $homeLink . $slug['slug'] . '/"><span>' . $post_type->labels->singular_name . '</span></a>';
					if ($showCurrent == 1) $bread_out .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
					$bread_out .= '</li>';					
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					//$cats = get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
					$cats = self::zhf_get_term_parents_list( $cat, 'category', array( 'separator' => ' ' . $delimiter . ' ' ) );
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
					$bread_out .= $cats;
					if ($showCurrent == 1) $bread_out .= $before . get_the_title() . $after;
				}
			} elseif ( is_attachment() ) {
				if ($showCurrent == 1) $bread_out .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;	 
			} elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) $bread_out .= wp_kses( $before . get_the_title() . $after, $allowed_html );
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '"><span>' . get_the_title($page->ID) . '</span></a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					$bread_out .= wp_kses( $breadcrumbs[$i], $allowed_html );
					if ($i != count($breadcrumbs)-1) $bread_out .= ' ' . $delimiter . ' ';
				}
				if ($showCurrent == 1) $bread_out .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			} elseif ( is_tag() ) {
				$bread_out .= wp_kses( $before . single_tag_title('', false) . $after, $allowed_html );
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				$bread_out .= wp_kses( $before . esc_html__( 'Posts by ', 'zozo-header-footer' ) . $userdata->display_name . $after, $allowed_html );
			} elseif ( is_404() ) {
				$bread_out .= wp_kses( $before . esc_html__( 'Error 404', 'zozo-header-footer' ) . $after, $allowed_html );
			}
			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $bread_out .= ' (';
				$bread_out .= esc_html__( 'Page', 'zozo-header-footer' ) . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $bread_out .= ')';
			}
		}
		$bread_out .= '</ul>';
		return $bread_out;
	}
	
	public static function zhf_get_term_parents_list( $term_id, $taxonomy, $args = array() ) {
		$list = '';
		$term = get_term( $term_id, $taxonomy );
	 
		if ( is_wp_error( $term ) ) {
			return $term;
		}
	 
		if ( ! $term ) {
			return $list;
		}
	 
		$term_id = $term->term_id;
	 
		$defaults = array(
			'format'    => 'name',
			'separator' => '/',
			'link'      => true,
			'inclusive' => true,
		);
	 
		$args = wp_parse_args( $args, $defaults );
	 
		foreach ( array( 'link', 'inclusive' ) as $bool ) {
			$args[ $bool ] = wp_validate_boolean( $args[ $bool ] );
		}
	 
		$parents = get_ancestors( $term_id, $taxonomy, 'taxonomy' );
	 
		if ( $args['inclusive'] ) {
			array_unshift( $parents, $term_id );
		}
	 
		foreach ( array_reverse( $parents ) as $term_id ) {
			$parent = get_term( $term_id, $taxonomy );
			$name   = ( 'slug' === $args['format'] ) ? $parent->slug : $parent->name;
			if ( $args['link'] ) {
				$list .= '<li><a href="' . esc_url( get_term_link( $parent->term_id, $taxonomy ) ) . '"><span>' . $name . '</span></a>' . $args['separator'] .'</li>';
			} else {
				$list .= '<li><span>'. $name .'</span>'. $args['separator'] .'</li>';
			}
		}
	 
		return $list;
	}
	
}
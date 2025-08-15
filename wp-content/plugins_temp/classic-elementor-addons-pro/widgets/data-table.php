<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Elementor Data Table Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_DataTable_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Data Table widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ceadatatable';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Data Table widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Data Table', 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Data Table widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'cea-default-icon ti-view-list';
	}
	
	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Data Table widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'data', 'table', 'classic' ];
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
		return [ 'cea-data-table-frontend', 'cea-data-table', 'cea-custom-front' ];
	}
	
	public function get_style_depends() {
		return [ 'cea-table' ];
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Data Table widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'classic-elements' ];
	}

	/**
	 * Register Data Table widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'general_section',
			[
				'label' => __( 'General', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);		
		$this->add_control(
            'cea_data_table_static_html',
            [
                'type' => Controls_Manager::HIDDEN,
                'default' => '<thead><tr><th></th><th></th><th></th><th></th></tr></thead><tbody><tr><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td></tr></tbody>',
            ]
        );
		$this->add_control(
			"table_sort",
			[
				"label" 		=> esc_html__( "Table Sorting", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable or disable table column sorting.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"table_search",
			[
				"label" 		=> esc_html__( "Table Search", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable or disable table search by column data.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"table_search_placeholder",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Search Placeholder", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can enter table search box placeholder here.", 'classic-elementor-addons-pro' ),
				"default" 		=> esc_html__( "Search..", 'classic-elementor-addons-pro' ),
				"condition" 	=> [
					"table_search" 		=> "yes"
				]
			]
		);
		$this->add_control(
			"table_pagination",
			[
				"label" 		=> esc_html__( "Table Pagination", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable or disable table pagination.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"table_pagination_max",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Rows Per Page", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can set the number of rows show in table pagination", 'classic-elementor-addons-pro' ),
				"default" 		=> "10",
				"condition" 	=> [
					"table_pagination" 		=> "yes"
				]
			]
		);
		$this->end_controls_section();
		
		// Style General Section
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => __( 'General', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .cea-data-table-inner' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'outer_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'outer_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		
		// Style Table Section
		$this->start_controls_section(
			'section_style_table',
			[
				'label' => __( 'Table', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'row_padding',
			[
				'label' => esc_html__( 'Row Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner table.cea-data-table td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'accordion_border',
				'selector' => '{{WRAPPER}} .cea-data-table-inner table.cea-data-table td'
			]
		);
		$this->add_responsive_control(
			'table_cells_alignment',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner table.cea-data-table td' => 'text-align: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			"table_row_style",
			[
				"label" 		=> esc_html__( "Row Odd Even Style", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable or disable table column sorting.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"odd_bg_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Odd Row Bg Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the odd row background color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner table.cea-data-table tbody tr:nth-child(odd)' => 'background-color: {{VALUE}};'
				],
				"condition" 	=> [
					"table_row_style" 		=> "yes"
				]
			]
		);
		$this->add_control(
			"odd_font_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Odd Row Font Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the odd row font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner table.cea-data-table tbody tr:nth-child(odd)' => 'color: {{VALUE}};'
				],
				"condition" 	=> [
					"table_row_style" 		=> "yes"
				]
			]
		);
		$this->add_control(
			"even_bg_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Even Row Bg Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the odd row background color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner table.cea-data-table tbody tr:nth-child(even)' => 'background-color: {{VALUE}};'
				],
				"condition" 	=> [
					"table_row_style" 		=> "yes"
				]
			]
		);
		$this->add_control(
			"even_font_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Even Row Font Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the odd row font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner table.cea-data-table tbody tr:nth-child(even)' => 'color: {{VALUE}};'
				],
				"condition" 	=> [
					"table_row_style" 		=> "yes"
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'table_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' 		=> '{{WRAPPER}} .cea-data-table-inner table.cea-data-table td'
			]
		);	
		$this->add_responsive_control(
			'outer_br_rad',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'outer_border_gap',
			[
				'label' => esc_html__( 'Border Spacing', 'classic-elementor-addons-pro' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100
					],
					'rem' => [
						'min' => 0,
						'max' => 25
					],
					'em' => [
						'min' => 0,
						'max' => 25
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner table' => 'border-spacing: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		
		// Style Table Row Head
		$this->start_controls_section(
			'section_table_row_head',
			[
				'label' => __( 'Table Row Heading', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		/*$this->add_control(
			'table_row_heading',
			[
				'label' => __( 'Table Row Heading', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);*/
		$this->add_control(
			'head_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner .cea-data-table thead > tr > th' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"head_font_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Font Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the table head font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner .cea-data-table thead > tr > th' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'head_row_padding',
			[
				'label' => esc_html__( 'Row Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner .cea-data-table thead > tr > th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'row_head_alignment',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner .cea-data-table thead > tr > th' => 'text-align: {{VALUE}};',
				],
			]
		);	
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_head_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' 		=> '{{WRAPPER}} .cea-data-table-inner .cea-data-table thead > tr > th'
			]
		);	
		$this->add_responsive_control(
			'row_head_rad',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner .cea-data-table > thead th' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		
		// Style Table Column Head
		$this->start_controls_section(
			'section_table_column_head',
			[
				'label' => __( 'Table Column Heading', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'column_head_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner .cea-data-table > tbody > tr > td:first-child' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"column_head_font_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Font Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the table column head font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner .cea-data-table > tbody > tr > td:first-child' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'column_head_row_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner .cea-data-table > tbody > tr > td:first-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'column_head_alignment',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner .cea-data-table > tbody > tr > td:first-child' => 'text-align: {{VALUE}};',
				],
			]
		);			
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'column_title_head_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' 		=> '{{WRAPPER}} .cea-data-table-inner .cea-data-table > tbody > tr > td:first-child'
			]
		);	
		$this->add_responsive_control(
			'col_head_rad',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-data-table-inner .cea-data-table > tbody > tr > td:first-child' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render Data Table widget output on the frontend.
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
		?>
		
		<div class="elementor-widget-container cea-data-table-elementor-widget">
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

		$table_sort = isset( $settings['table_sort'] ) && $settings['table_sort'] == 'yes' ? true : false;
		$table_search = isset( $settings['table_search'] ) && $settings['table_search'] == 'yes' ? true : false;
		$search_placeholder = isset( $settings['table_search_placeholder'] ) && !empty( $settings['table_search_placeholder'] ) ? $settings['table_search_placeholder'] : '';
		$table_pagination = isset( $settings['table_pagination'] ) && $settings['table_pagination'] == 'yes' ? true : false;
		$pagination_max = isset( $settings['table_pagination_max'] ) && !empty( $settings['table_pagination_max'] ) ? $settings['table_pagination_max'] : '';
		
		$shortcode_rand_id = cea_shortcode_rand_id();
		$table_class = $table_sort ? ' cea-table-sort-active' : '';

		echo '<div class="cea-data-table-inner" data-shortcode-id="'. esc_attr( $shortcode_rand_id ) .'">';
			echo $table_search ? '<div class="cea-data-table-search-wrap"><input type="text" value="" placeholder="'. esc_attr( $search_placeholder ) .'" id="cea-data-table-input-'. esc_attr( $shortcode_rand_id ) .'" /></div>' : '';
			echo '<table id="cea-data-table-'. esc_attr( $shortcode_rand_id ) .'" class="table cea-data-table'. esc_attr( $table_class ) .'" data-sort="'. esc_attr( $table_sort ) .'" data-search="'. esc_attr( $table_search ) .'" data-page="'. esc_attr( $table_pagination ) .'" data-page-max="'. esc_attr( $pagination_max ) .'">'. $this->cea_table_html() .'</table>';
			echo $table_pagination ? '<div id="cea-table-pagination-'. esc_attr( $shortcode_rand_id ) .'" class="cea-data-table-pagination-wrap"></div>' : '';
		echo '</div>';

	}
	
	protected function cea_table_html(){
        $settings = $this->get_parsed_dynamic_settings();
        return $settings['cea_data_table_static_html'];
    }

}
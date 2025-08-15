<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Icon list
 *
 * @since 1.0.0
 */
 
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
 
class CEA_Elementor_Icon_List_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Icon list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceaiconlist";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Icon list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Icon List", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Icon list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-list";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Icon List widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'icon', 'list', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Icon list widget belongs to.
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
	 * Register Icon list widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		
		//Icon List Section
		$this->start_controls_section(
			"icon_list_section",
			[
				"label"			=> esc_html__( "Icon List", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Icon list options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		
		$this->add_control(
			'icon_list_view',
			[
				'label'			=> esc_html__( 'Layout', 'classic-elementor-addons-pro' ),
				'type'			=> Controls_Manager::CHOOSE,
				'default'		=> 'list',
				'options' 		=> [
					'list' 	=> [
						'title' 	=> esc_html__( 'Default', 'classic-elementor-addons-pro' ),
						'icon' 		=> 'eicon-editor-list-ul',
					],
					'inline' 	=> [
						'title' => esc_html__( 'Inline', 'classic-elementor-addons-pro' ),
						'icon' 	=> 'eicon-ellipsis-h',
					],
				]
			]
		);		
		
		$repeater = new Repeater();	
		
		$repeater->add_control(
			'list_text',
			[
				'label'			=> esc_html__( 'Text', 'classic-elementor-addons-pro' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'default'		=> esc_html__( 'List Item', 'classic-elementor-addons-pro' ),
				'dynamic'		=> [
					'active'	=> true,
				],
			]
		);
		
		$repeater->add_control(
			'list_icon',
			[
				'label'			=> esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type'			=> Controls_Manager::ICONS,
				'default'		=> [
					'value'		=> 'ti-heart',
					'library'	=> 'themify',
				],
				'fa4compatibility' => 'icon',
			]
		);
		
		$repeater->add_control(
			'icon_list_link',
			[
				'label' 		=> esc_html__( 'Link', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'classic-elementor-addons-pro' ),
			]
		);
		
		$this->add_control(
			"icon_list",
			[
				"type"			=> Controls_Manager::REPEATER,
				"label"			=> esc_html__( "Icon List", 'classic-elementor-addons-pro' ),
				"fields"		=> $repeater->get_controls(),
				"default" 		=> [
					[
						'list_text'	=> esc_html__( 'List Item 1', 'classic-elementor-addons-pro' ),
						'list_icon' => [
							'value' => 'ti-heart',
							'library' => 'themify',
						],
					],
					[
						'list_text'	=> esc_html__( 'List Item 2', 'classic-elementor-addons-pro' ),
						'list_icon' => [
							'value' => 'ti-target',
							'library' => 'themify',
						],
					],
				],
				"title_field"	=> "{{{ list_text }}}"
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_icon_list',
			[
				'label' 		=> esc_html__( 'List', 'classic-elementor-addons-pro' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'space_between',
			[
				'label' 		=> esc_html__( 'Space Between', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' 	=> [
						'max' 	=> 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-icon-list:not(.icon-list-inline) .cea-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .cea-icon-list:not(.icon-list-inline) .cea-icon-list-item:not(:first-child)' => 'padding-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .cea-icon-list.icon-list-inline .cea-icon-list-item:not(:last-child)' => 'padding-right: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .cea-icon-list.icon-list-inline .cea-icon-list-item:not(:first-child)' => 'padding-left: calc({{SIZE}}{{UNIT}}/2)'
				]
			]
		);
		
		$this->add_responsive_control(
			'icon_list_align',
			[
				'label' 		=> esc_html__( 'Alignment', 'classic-elementor-addons-pro' ),
				'type'			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' 		=> [
						'title' => esc_html__( 'Left', 'classic-elementor-addons-pro' ),
						'icon' 	=> 'eicon-h-align-left',
					],
					'center' 	=> [
						'title' => esc_html__( 'Center', 'classic-elementor-addons-pro' ),
						'icon' 	=> 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'classic-elementor-addons-pro' ),
						'icon' 	=> 'eicon-h-align-right',
					],
				],
				'prefix_class' 	=> 'elementor%s-align-',
			]
		);
		
		$this->add_control(
			'divider',
			[
				'label' 	=> esc_html__( 'Divider', 'classic-elementor-addons-pro' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'classic-elementor-addons-pro' ),
				'label_on' 	=> esc_html__( 'On', 'classic-elementor-addons-pro' ),
				'selectors' => [
					'{{WRAPPER}} .cea-icon-list-item:not(:last-child):after' => 'content: ""',
				],
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'divider_style',
			[
				'label' 	=> esc_html__( 'Style', 'classic-elementor-addons-pro' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'solid' => esc_html__( 'Solid', 'classic-elementor-addons-pro' ),
					'double' => esc_html__( 'Double', 'classic-elementor-addons-pro' ),
					'dotted' => esc_html__( 'Dotted', 'classic-elementor-addons-pro' ),
					'dashed' => esc_html__( 'Dashed', 'classic-elementor-addons-pro' ),
				],
				'default' 		=> 'solid',
				'condition' 	=> [
					'divider' 	=> 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .cea-icon-list:not(.icon-list-inline) .cea-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
					'{{WRAPPER}} .cea-icon-list.icon-list-inline .cea-icon-list-item:not(:last-child):after' => 'border-right-style: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'divider_weight',
			[
				'label' 		=> esc_html__( 'Weight', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' 		=> 1,
				],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 1,
						'max' 	=> 20,
					],
				],
				'condition' 	=> [
					'divider' 	=> 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .cea-icon-list:not(.icon-list-inline) .cea-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}; bottom: calc(({{SIZE}}{{UNIT}}/2) * -1);',
					'{{WRAPPER}} .cea-icon-list.icon-list-inline .cea-icon-list-item:not(:last-child):after' => 'border-right-width: {{SIZE}}{{UNIT}}; right: calc(({{SIZE}}{{UNIT}}/2) * -1);',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' 		=> esc_html__( 'Width', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'unit' 		=> '%',
				],
				'condition' 	=> [
					'divider' 			=> 'yes',
					'icon_list_view!' 	=> 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .cea-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' 		=> esc_html__( 'Height', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%', 'px' ],
				'default' 	=> [
					'unit' 	=> '%',
				],
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 1,
						'max' 	=> 100,
					],
					'%' => [
						'min' 	=> 1,
						'max' 	=> 100,
					],
				],
				'condition' 	=> [
					'divider' 			=> 'yes',
					'icon_list_view!' 	=> 'list',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .cea-icon-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' 		=> esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' 	=> [
					'divider' 	=> 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .cea-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
				]
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' 		=> esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'icon_position',
			[
				'label' 		=> esc_html__( 'Icon Position', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'default'		=> 'left',
				'options' 		=> [
					'left' 		=> [
						'title' => esc_html__( 'Left', 'classic-elementor-addons-pro' ),
						'icon' 	=> 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'classic-elementor-addons-pro' ),
						'icon' 	=> 'eicon-h-align-right',
					],
				]
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' 		=> esc_html__( 'Icon Color', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .cea-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-icon-list-icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		
		$this->add_control(
			'icon_color_hover',
			[
				'label' 		=> esc_html__( 'Hover Color', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .cea-icon-list-item:hover .cea-icon-list-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-icon-list-item:hover .cea-icon-list-icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_text_style',
			[
				'label' 		=> esc_html__( 'Text', 'classic-elementor-addons-pro' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'text_color',
			[
				'label' 		=> esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .cea-icon-list-item .icon-list-text' => 'color: {{VALUE}}'
				]
			]
		);
		
		$this->add_control(
			'text_color_hover',
			[
				'label' 		=> esc_html__( 'Hover Color', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .cea-icon-list-item:hover .icon-list-text' => 'color: {{VALUE}};'
				]
			]
		);
		
		$this->add_control(
			'text_indent',
			[
				'label' 		=> esc_html__( 'Text Indent', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' 		=> [
						'min' 	=> 0,
						'max' 	=> 50,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .cea-icon-list-item .icon-list-text.icon-list-text-left' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cea-icon-list-item .icon-list-text:not(.icon-list-text-left)' => 'padding-left: {{SIZE}}{{UNIT}};'
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'icon_typography',
				'selector' 		=> '{{WRAPPER}} .cea-icon-list-item .icon-list-text',
				//'scheme' 		=> Schemes\Typography::TYPOGRAPHY_3,
			]
		);
		
		$this->end_controls_section();
	
	}
	
	/**
	 * Render Icon List widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		$icon_pos = !empty( $settings['icon_position'] ) ? $settings['icon_position'] : 'left';
		
		$this->add_render_attribute( 'ul_attr', 'class', 'nav flex-column cea-icon-list' );
		if ( 'inline' === $settings['icon_list_view'] ) {
			$this->add_render_attribute( 'ul_attr', 'class', 'icon-list-inline' );
		}
		//icon_list_link
		?>
		
		<ul <?php echo $this->get_render_attribute_string( 'ul_attr' ); ?>>
		<?php
			foreach( $settings['icon_list'] as $index => $item ){
				
				echo '<li class="cea-icon-list-item">';
				
				if ( ! empty( $item['icon_list_link']['url'] ) ) {
					$link_key = 'link_' . $index;
					$this->add_link_attributes( $link_key, $item['icon_list_link'] );
					echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
				}				
				
				$icon_list_text = $item['list_text'];
				if( $icon_pos == 'right' && $icon_list_text ) echo '<span class="icon-list-text icon-list-text-left">'. $item['list_text'] .'</span>';
				
				// add old default
				$migration_allowed = Icons_Manager::is_migration_allowed();
				if ( ! isset( $item['list_icon'] ) && ! $migration_allowed ) {
					$item['icon'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-check';
				}

				$migrated = isset( $item['__fa4_migrated']['list_icon'] );
				$is_new = ! isset( $item['icon'] ) && $migration_allowed;
				if ( ! empty( $item['icon'] ) || ( ! empty( $item['list_icon']['value'] ) && $is_new ) ) :
					?>
					<span class="cea-icon-list-icon">
						<?php
						if ( $is_new || $migrated ) {
							Icons_Manager::render_icon( $item['list_icon'], [ 'aria-hidden' => 'true' ] );
						} else { ?>
								<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
						<?php } ?>
					</span>
				<?php endif;

				 if( $icon_pos == 'left' && $icon_list_text ) echo '<span class="icon-list-text">'. $item['list_text'] .'</span>';
				 if ( ! empty( $item['icon_list_link']['url'] ) ) {
					 echo '</a>';
				 }
				 echo '</li>';
			}
		?>
		</ul>
		
		<?php
	}
		
}
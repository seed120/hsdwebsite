<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon List Step
 *
 * @since 1.0.0
 */
class CEA_Elementor_Marquee_Widget extends Widget_Base {

    /**
	 * Get widget name.
	 *
	 * Retrieve Cea Marquee widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 *
	 */
	public function get_name() {
		return "ceamarquee";
	}

    /**
	 * Get widget title.
	 *
	 * Retrieve Cea Marquee widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Marquee", 'classic-elementor-addons-pro' );
	}

    /**
	 * Get widget icon.
	 *
	 * Retrieve Cea Marquee widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon eicon-form-vertical";
	}

    /**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Cea Marquee widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories(): array {
        return [ "classic-elements" ];
    }

    /**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Cea Marquee widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'marquee', 'classic' ];
    }

    /**
     * Retrieve the list of styles the Cea List Step widget depends on.
     *
     * Used to set styles dependencies required to run the widget.
     * 
     * @since 1.3.0
     * @access public
     * 
     * @return array Widget styles dependencies
     */
    public function get_style_depends(): array {
        return [ 'cea-editor' ];
    }

    /**
	 * Register Cea Marquee widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function register_controls(): void {

        $this->start_controls_section(
			'general_content_section',
			[
				'label' => esc_html__( 'Marquee List', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
        $repeater = new Repeater();
        $repeater->add_control(
			'item_title',
			[
				'label'       => esc_html__( 'Title', 'classic-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Marquee Item', 'classic-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Type box title', 'classic-elementor-addons-pro' ),
			]
		);
        $repeater->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Icon Type', 'classic-elementor-addons-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'default' => 'image',
				'options' => [
					'icon'  => [
						'title' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-favorite',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-image',
					],
				],
			]
		);
        $repeater->add_control(
			'selected_icon',
			[
				'label'            => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-code',
					'library' => 'fa-solid',
				],
				'condition'        => [
					'icon_type' => 'icon',
				],
				'label_block'      => true,
			]
		);
		$repeater->add_control(
			'icon_align',
			[
				'label'            => esc_html__( 'Icon Align', 'classic-elementor-addons-pro' ),
				'type'			   => Controls_Manager::SELECT,
				'options'		   => [
					'before'	   => esc_html__( 'Before', 'classic-elementor-addons-pro' ),
					'after'	   	   => esc_html__( 'After', 'classic-elementor-addons-pro' ),
				],
				'default'	=> 'before',
				'condition'		   => [
					'icon_type' => 'icon',
					'selected_icon[value]!'	=> '',
				] 
			]
		);
        $repeater->add_control(
			'selected_img',
			[
				'label'       => esc_html__( 'Image Icon', 'classic-elementor-addons-pro' ),
				'type'        => Controls_Manager::MEDIA,
				'render_type' => 'template',
				'default'     => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'   => [
					'icon_type' => 'image',
				],
			]
		);
		$repeater->add_control(
			'image_align',
			[
				'label'            => esc_html__( 'Image Align', 'classic-elementor-addons-pro' ),
				'type'			   => Controls_Manager::SELECT,
				'options'		   => [
					'before'	   => esc_html__( 'Before', 'classic-elementor-addons-pro' ),
					'after'	   	   => esc_html__( 'After', 'classic-elementor-addons-pro' ),
				],
				'default'	=> 'before',
				'condition'		   => [
					'icon_type' => 'image',
					'selected_img[url]!'	=> '',
				] 
			]
		);
        $this->add_control(
			'icon_boxes',
			[
				'label'       => esc_html__( 'Items', 'classic-elementor-addons-pro' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ item_title }}}',
                'default'     => [
                    [
                        'item_title'    =>  esc_html__( 'Marquee Item - 1', 'classic-elementor-addons-pro' ),
                    ],
                    [
                        'item_title'    =>  esc_html__( 'Marquee Item - 2', 'classic-elementor-addons-pro' ),
                    ],
                    [
                        'item_title'    =>  esc_html__( 'Marquee Item - 3', 'classic-elementor-addons-pro' ),
                    ]
                ]
			]
		);
        $this->end_controls_section();

		$this->start_controls_section(
			'widget_general_styles',
			[
				'label' => esc_html__( 'Marquee Settings', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'icon_space_between',
			[
				'label'      => esc_html__( 'Space Between', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'rem' => [
						'min' => 0,
						'max' => 25,
					],
					'em' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'default'	=> [
					'unit'	=> 'px',
					'size'	=> 100
				],
				'selectors'  => [
					'{{WRAPPER}} .cea-divider' => 'margin: 0 {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'marquee_direction',
			[
				'label'		=> 	esc_html__( 'Marquee Direction', 'classic-elementor-addons-pro' ),
				'type'		=>  Controls_Manager::SELECT,
				'options'     => [
					'scroll-left'  => esc_html__( 'Right to Left', 'classic-elementor-addons-pro' ),
					'scroll-right' => esc_html__( 'Left to Right', 'classic-elementor-addons-pro' ),
				],
				'default'     => 'scroll-left',
			]
		);
		$this->add_control(
			'animation_speed',
			[
				'label'     => esc_html__( 'Animation Duration (Second)', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'selectors' => [
					'{{WRAPPER}} .cea-marquee-inner' => 'animation-duration: {{VALUE}}s',
				],
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label'        => esc_html__( 'Pause On Hover', 'classic-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'classic-elementor-addons-pro' ),
				'label_off'    => esc_html__( 'No', 'classic-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'marquee_style_section',
			[
				'label' => esc_html__( 'Marquee Items', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'marquee_margin',
			[
				'label'      => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .cea-marquee-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'marquee_padding',
			[
				'label'      => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .cea-marquee-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'	=> 'after'
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'marquee_border',
				'label'    => esc_html__( 'Border', 'classic-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .cea-marquee-item',
			]
		);
		$this->add_responsive_control(
			'marquee_br_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .cea-marquee-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'	=> 'after'
			]
		);
		$this->add_control(
			'marquee_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-marquee-item' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'marquee_box_shadow',
				'selector' => '{{WRAPPER}} .cea-marquee-item',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'icon_style_section',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'icon_space',
			[
				'label'      => esc_html__( 'Icon Space', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'rem' => [
						'min' => 0,
						'max' => 25,
					],
					'em' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'default'	=> [
					'unit'	=> 'px',
					'size'	=> 15
				],
				'selectors'  => [
					'{{WRAPPER}} .marquee-icon.marquee-icon-before' => 'margin-right: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .marquee-img.marquee-img-before' => 'margin-right: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .marquee-icon.marquee-icon-after' => 'margin-left: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .marquee-img.marquee-img-after' => 'margin-left: {{SIZE}}{{UNIT}}'
				],
			]
		);
		$this->add_responsive_control(
			'icon_font_size',
			[
				'label'      => esc_html__( 'Icon Size', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'rem' => [
						'min' => 0,
						'max' => 25,
					],
					'em' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .marquee-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'image_icon_size',
			[
				'label'        => esc_html__( 'Image Icon Size', 'classic-elementor-addons-pro' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => esc_html__( 'None', 'classic-elementor-addons-pro' ),
				'label_on'     => esc_html__( 'Custom', 'classic-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->start_popover();

		$this->add_responsive_control(
			'icon_img_width',
			[
				'label'      => esc_html__( 'Width', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'rem' => [
						'min' => 0,
						'max' => 25,
					],
					'em' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .marquee-img' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .marquee-img img' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'image_icon_size' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
			'icon_img_height',
			[
				'label'      => esc_html__( 'Height', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'rem' => [
						'min' => 0,
						'max' => 25,
					],
					'em' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .marquee-img' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .marquee-img img' => 'height: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'image_icon_size' => 'yes',
				],
				'separator'	=> 'after'
			]
		);
		$this->add_control(
			'img_icon_fit',
			[
				'label'     => esc_html__( 'Object Fit', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''           => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
					'cover'      => esc_html__( 'Cover', 'classic-elementor-addons-pro' ),
					'fill'       => esc_html__( 'Fill', 'classic-elementor-addons-pro' ),
					'contain'    => esc_html__( 'Contain', 'classic-elementor-addons-pro' ),
					'none'       => esc_html__( 'None', 'classic-elementor-addons-pro' ),
					'scale-down' => esc_html__( 'Scale Down', 'classic-elementor-addons-pro' ),
				],
				'selectors' => [
					'{{WRAPPER}} .marquee-img img' => 'object-fit: {{VALUE}};',
				],
				'condition' => [
					'image_icon_size' => 'yes',
				]
			]
		);
		$this->add_control(
			'img_icon_position',
			[
				'label'     => esc_html__( 'Object Position', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''       => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
					'top'    => esc_html__( 'Top', 'classic-elementor-addons-pro' ),
					'bottom' => esc_html__( 'Bottom', 'classic-elementor-addons-pro' ),
					'left'   => esc_html__( 'left', 'classic-elementor-addons-pro' ),
					'right'  => esc_html__( 'Right', 'classic-elementor-addons-pro' ),
					'center' => esc_html__( 'Center', 'classic-elementor-addons-pro' ),
				],
				'selectors' => [
					'{{WRAPPER}} .marquee-img img' => 'object-position: {{VALUE}};',
				],
				'condition' => [
					'image_icon_size' => 'yes',
				]
			]
		);
		$this->end_popover();
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border',
				'label'    => esc_html__( 'Border', 'classic-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .marquee-img img, {{WRAPPER}} .marquee-icon',
			]
		);
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .marquee-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .marquee-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .marquee-img' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .marquee-img img, {{WRAPPER}} .marquee-icon',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'content_style_section',
			[
				'label' => esc_html__( 'Title', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'marquee_title_styles',
		);
		$this->start_controls_tab(
			'marquee_color',
			[
				'label'		=>  __( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'marquee_color_hover',
			[
				'label'		=>  __( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label'     => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .marquee-title:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'hrhr',
			[
				'type'	=> Controls_Manager::DIVIDER,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'classic-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .marquee-title',
			]
		);
		$this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

		if ( empty( $settings[ 'icon_boxes' ] ) ) {
			return;
		}
        $wrapper_class= '';
        $wrapper_class = 'cea-marquee-list ' . $settings[ 'marquee_direction' ];

        if ( 'yes' === $settings[ 'pause_on_hover' ] ) {
			$wrapper_class .= ' pause-on-hover';
		}
        ?>
        <div class="<?php echo esc_attr( $wrapper_class ) ?>">
			<?php for ( $x = 0; $x <= 2; $x ++ ) : ?>
            	<div class="cea-marquee-inner">
                	<?php foreach ( $settings[ 'icon_boxes' ] as $index => $item ) : ?>
                    	<div class="cea-marquee-item elementor-repeater-item-<?php echo $item[ '_id' ] ?>">
                        	<?php 
								if ( 'before' === $item['image_align'] && 'image' === $item[ 'icon_type' ] ) {
									echo '<div class="marquee-img marquee-img-'. $item['image_align'] .'">';
										echo Group_Control_Image_Size::get_attachment_image_html( $item, 'full', 'selected_img' );
									echo '</div>';
								}
								if ( 'before' === $item['icon_align'] && 'icon' === $item[ 'icon_type' ] ) {
									echo '<div class="marquee-icon marquee-icon-'. $item['icon_align'] .'">';
										Icons_Manager::render_icon( $item[ 'selected_icon' ] );
									echo '</div>';
								}
                        	?>
                        	<?php 
                        	    if ( ! empty( $item[ 'item_title' ] ) ) {
			    	    		    printf( '<h5 class="marquee-title">%1$s</h5>',
			    	    			    esc_html( $item[ 'item_title' ] )
			    	    			);
			    	    		}
                        	?>
							<?php 
								if ( 'after' === $item['image_align'] && 'image' === $item[ 'icon_type' ] ) {
									echo '<div class="marquee-img marquee-img-'. $item['image_align'] .'">';
										echo Group_Control_Image_Size::get_attachment_image_html( $item, 'full', 'selected_img' );
									echo '</div>';
								}
								if ( 'after' === $item['icon_align'] && 'icon' === $item[ 'icon_type' ] ) {
									echo '<div class="marquee-icon marquee-icon-'. $item['icon_align'] .'">';
										Icons_Manager::render_icon( $item[ 'selected_icon' ] );
									echo '</div>';
								}
                        	?>
                    </div>
                    <span class="cea-divider"></span>
                <?php endforeach; ?>
            </div>
		<?php endfor; ?>
        </div>
        <?php
    }

}
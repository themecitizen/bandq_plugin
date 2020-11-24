<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class TZ_Icon_Box extends Widget_Base {

	public function get_name()
	{
		return 'wpf_icon_box';
	}

	public function get_title()
	{
		return __('Icon Box', 'wpf_domain');
	}

	public function get_icon()
	{
		return 'eicon-icon-box';
	}

	public function get_categories() {
		return ['wpf-category'];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon_box',
			[
				'label' => __('Icon Box', 'wpf_domain'),
			]
		);
		$this->add_control(

			'layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __('Choose Layout', 'wpf_domain'),
				'default' => 'layout-1',
				'label_block' => true,
				'options' => [
					'layout-1' => __('Layout 1', 'wpf_domain'),
					'layout-2' => __('Layout 2', 'wpf_domain'),
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'wpf_domain' ),
				'type'  => Controls_Manager::ICON,
				'default' => 'fa fa-star',
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' =>  esc_html__( 'Title & Description', 'wpf_domain' ),
				'type'  => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'This is the heading', 'elementor' ),
				'placeholder' => __( 'Enter your title', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' =>  esc_html__( 'Description', 'wpf_domain' ),
				'type'  => Controls_Manager::TEXTAREA,
				'default' => __( 'This is the heading', 'elementor' ),
				'placeholder' => __( 'Enter your title', 'elementor' ),
				'label_block' => true,
				'rows' => 10,
				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
			]
		);

		$this->end_controls_section();

		// Tab Panel
		// Icon section
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' =>  esc_html__( 'Icon', 'wpf_domain' ),
				'tab'   =>  Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'icon_style_tab' );

		$this->start_controls_tab(
			'icon_normal',
			[
				'label' => esc_html__( 'NORMAL', 'wpf_domain' ),
			]
		);
		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .wpf-icon_box_wrapper .icon' => 'color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .wpf-icon_box_wrapper .icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpf-icon_box_wrapper .icon' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			[
				'label' => esc_html__( 'Hover', 'wpf_domain' ),
			]
		);

		$this->add_control(
			'primary_color_hover',
			[
				'label' => esc_html__( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .wpf-icon_box_wrapper:hover .icon' => 'color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .wpf-icon_box_wrapper:hover .icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpf-icon_box_wrapper:hover .icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab(); // End hover tab

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => esc_html__( 'Spacing', 'wpf_domain' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpf-icon_box_wrapper.layout-1 .icon ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpf-icon_box_wrapper.layout-2 .icon ' => 'right: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .wpf-icon_box_wrapper.layout-1 .icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .wpf-icon_box_wrapper.layout-2 .icon' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'wpf_domain' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpf-icon_box_wrapper .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();		// End Icon section

		// Content Section Style
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'wpf_domain' ),
				'tab'   =>  Controls_Manager::TAB_STYLE
			]
		);

		$this->start_controls_tabs( 'content_style_tab' );

		$this->start_controls_tab(
			'content_style_normal',
			[
				'label' => esc_html__( 'Normal', 'wpf_domain' )
			]
		);

		$this->add_control(
			'title_primary_color',
			[
				'label' => esc_html__( 'Title Color', 'wpf_domain' ),
				'type'  => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}}.wpf-view-stacked .wpf-icon_box_wrapper h3' => 'color: {{VALUE}};',
					'{{WRAPPER}}.wpf-view-framed .wpf-icon_box_wrapper h3' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpf-icon_box_wrapper h3' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label' => esc_html__( 'Title Spacing', 'wpf_domain' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpf-icon_box_wrapper.layout-1 h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpf-icon_box_wrapper.layout-2 h3' => 'margin-right: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .wpf-icon_box_wrapper.layout-1 h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .wpf-icon_box_wrapper.layout-2 h3' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .wpf-icon_box_wrapper h3',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'description_primary_color',
			[
				'label' => esc_html__( 'Description Color', 'wpf_domain' ),
				'type'  => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}}.wpf-view-stacked .wpf-icon_box_wrapper.layout-1 .desciption' => 'color: {{VALUE}};',
					'{{WRAPPER}}.wpf-view-stacked .wpf-icon_box_wrapper.layout-2 .desciption .content' => 'color: {{VALUE}};',
					'{{WRAPPER}}.wpf-view-framed .wpf-icon_box_wrapper.layout-1 .desciption' => 'color: {{VALUE}};',
					'{{WRAPPER}}.wpf-view-framed .wpf-icon_box_wrapper.layout-2 .desciption .content' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpf-icon_box_wrapper.layout-1 .desciption' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpf-icon_box_wrapper.layout-2 .desciption .content' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'descrioption_typography',
				'selectors' => [
					'{{WRAPPER}} .wpf-icon_box_wrapper.layout-1 .desciption',
					'{{WRAPPER}} .wpf-icon_box_wrapper.layout-2 .desciption .content',
				],
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_tab(); // End tab normal

		$this->start_controls_tab(
			'content_style_hover',
			[
				'label' => esc_html__( 'Hover', 'wpf_domain' )
			]
		);

		$this->add_control(
			'title_primary_color_hover',
			[
				'label' => esc_html__( 'Title Color', 'wpf_domain' ),
				'type'  => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}}.wpf-view-stacked  .wpf-icon_box_wrapper:hover h3' => 'color: {{VALUE}};',
					'{{WRAPPER}}.wpf-view-framed .wpf-icon_box_wrapper:hover h3' => 'color: {{VALUE}};',
					'{{WRAPPER}} .wpf-icon_box_wrapper:hover h3' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_primary_color_hover',
			[
				'label' => esc_html__( 'Description Color', 'wpf_domain' ),
				'type'  => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}}.wpf-view-stacked .wpf-icon_box_wrapper.layout-1:hover .desciption' => 'color: {{VALUE}};',
					'{{WRAPPER}}.wpf-view-stacked .wpf-icon_box_wrapper.layout-2:hover .desciption .content' => 'color: {{VALUE}};',
					'{{WRAPPER}}.wpf-view-framed .wpf-icon_box_wrapper.layout-1:hover .desciption' => 'color: {{VALUE}}',
					'{{WRAPPER}}.wpf-view-framed .wpf-icon_box_wrapper.layout-2:hover .desciption .conent' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpf-icon_box_wrapper.layout-1:hover .desciption' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpf-icon_box_wrapper.layout-2:hover .desciption .content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab(); // End tab hover

		$this->end_controls_tabs();

		$this->end_controls_section(); // End Content Section Style
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		require dirname(__FILE__) .'/' . $settings['layout'] . '.php';
	}

}
$widgets_manager->register_widget_type(new \Elementor_Icon_Box());
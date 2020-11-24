<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class TZ_Accordion_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve accordion widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'wpf_accordion';
	}

	public function get_title()
	{
		return __('Accordions', 'wpf_domain');
	}

	public function get_icon()
	{
		return 'eicon-accordion';
	}

	public function get_categories() {
		return ['wpf-category'];
	}

	/**
	 * Register accordion widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls()
	{
		$this->tab_content();
		$this->tab_style();
	}

	private function tab_content ()
	{
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Accordion', 'wpf_domain' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title & Description', 'wpf_domain' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Accordion Title', 'wpf_domain' ),
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Content', 'wpf_domain' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Accordion Content', 'wpf_domain' ),
				'show_label' => false,
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' => __( 'Accordion Items', 'wpf_domain' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( 'Accordion #1', 'wpf_domain' ),
						'tab_content' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'wpf_domain' ),
					],
					[
						'tab_title' => __( 'Accordion #2', 'wpf_domain' ),
						'tab_content' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'wpf_domain' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);
		$this->end_controls_section();
	}

	private function tab_style ()
	{

		$this->start_controls_section(
			'section_accordion_style',
			[
				'label' => __( 'Accordion', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#c8c8c8',
				'selectors' => [
					'{{WRAPPER}} .wpf_domain-accordion-manager' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .wpf_domain-accordion-manager .card + .card' => 'border-top-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_title',
			[
				'label' => __( 'Title', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default'   =>  '#777',
				'selectors' => [
					'{{WRAPPER}} .wpf_domain-accordion-manager .card .card-header .card-link' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .wpf_domain-accordion-manager .card .card-header .card-link',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_content',
			[
				'label' => __( 'Content', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpf_domain-accordion-manager .card .card-body' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .wpf_domain-accordion-manager .card .card-body',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}
	/**
	 * Render accordion widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		require dirname(__FILE__) . '/layout-1.php';
	}
}

$widgets_manager->register_widget_type(new \TZ_Accordion_Widget());
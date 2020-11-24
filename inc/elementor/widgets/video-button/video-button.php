<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class Elementor_Video_Button extends Widget_Base {

	private $i10n;

	public function get_name()
	{
		return 'butler_video_button';
	}

	public function get_title()
	{
		return __('Video Button', 'butler');
	}

	public function get_icon()
	{
		return 'eicon-play';
	}

	public function get_categories() {
		return ['wpf-category'];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_video_button',
			[
				'label' => __('Button', 'butler'),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' =>  esc_html__( 'Icon', 'butler' ),
				'type'  =>  Controls_Manager::ICON,
				'default'   =>  'fa fa-play'
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'URL', 'butler' ),
				'type' => Controls_Manager::TEXT,
				'autocomplete' => false,
				'label_block' => true,
				'placeholder' => __( 'Enter your URL', 'butler' ),
			]
		);

		$this->end_controls_section(); // End section content

		$this->start_controls_section(
			'section_video_button_style',
			[
				'label' => esc_html__( 'Style', 'butler' ),
				'tab'   =>  Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' =>  esc_html__( 'Icon color', 'butler' ),
				'type'  =>  Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default'   =>  '#7eb729',
				'selectors'  =>  [
					'{{WRAPPER}} .video-button-container .play-link i'  => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'butler' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-button-container .play-link i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'position',
			[
				'label' => __( 'Icon Position', 'butler' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'butler' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Top', 'butler' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'butler' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-button-container' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'butler' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#fff',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} .video-button-container .play-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'butler' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .video-button-container .play-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .video-button-container .play-link',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'butler' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					 '{{WRAPPER}} .video-button-container .play-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section(); // End section style
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		require dirname( __FILE__ ) . '/layout-1.php';
	}

}
$widgets_manager->register_widget_type(new \Elementor_Video_Button());
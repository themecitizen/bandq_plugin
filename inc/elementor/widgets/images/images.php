<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Color;

class Butler_Image_Widget extends Widget_Base {

	public function get_name()
	{
		return 'butler_images';
	}

	public function get_title()
	{
		return esc_html__('Images', 'butler');
	}

	public function get_icon()
	{
		return 'eicon-image';
	}

	public function get_categories() {
		return ['wpf-category'];
	}

	protected function _register_controls() {
		// Content Tab
		$this->tab_content();
		// Tab Style
		$this->tab_style();
	}

	// section and element on tab content
	private function tab_content ()
	{
		$this->start_controls_section(
			'case_study_step_info',
			[
				'label' => __('Images', 'butler'),
			]
		);
		$this->add_control(
			'layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __('Choose Layout', 'butler'),
				'label_block' => true,
				'default'   =>  'layout-1',
				'options' => [
					'layout-1' => __('Carousel', 'butler'),
					'layout-2' => __('Image Box', 'butler'),
				],
			]
		);

		$this->add_control(
			'images',
			[
				'label' => __( 'Add Images', 'butler' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
				'show_label' => false,
				'dynamic' => [
					'active' => true,
				],
				'condition' =>  [
					'layout'    =>  'layout-1'
				]
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'butler' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' =>  [
					'layout'    =>  'layout-2'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'thumbnail',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'butler' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'butler' ),
				'show_label' => false,
				'condition' =>  [
					'layout'    =>  'layout-2'
				]
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'butler' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'butler' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'butler' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'butler' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .butler-images.layout-2 .image' => 'text-align: {{VALUE}};',
				],
				'condition' =>  [
					'layout'    =>  'layout-2'
				]
			]
		);

		$this->add_control(
			'carousel_autoplay',
			[
				'label'	=> esc_html__( 'Autoplay','butler' ),
				'type'	=>	Controls_Manager::SWITCHER,
				'default'	=>	'',
				'condition' =>  [
					'layout'    =>  'layout-1'
				]
			]
		);
		$this->add_control(
			'hide_pagination',
			[
				'label'	=> esc_html__( 'Hide Pagination', 'butler' ),
				'type'	=>	Controls_Manager::SWITCHER,
				'default'	=>	'',
				'condition' =>  [
					'layout'    =>  'layout-1'
				]
			]
		);

		$this->end_controls_section();
	}

	// section and element on tab style
	private function tab_style()
	{
		$this->start_controls_section(
			'section_style',
			[
				'label' =>  esc_html__( 'Images', 'butler' ),
				'tab'   =>  Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'image_effects',
			[
				'condition' =>  [
					'layout'    =>  'layout-2'
				]
			]
		);

		$this->start_controls_tab( 'normal',
			[
				'label' => __( 'Normal', 'butler' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label' => __( 'Opacity', 'butler' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .butler-images.layout-2 .image' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .butler-images.layout-2 .image',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_2_border',
				'selector' => '{{WRAPPER}} .butler-images.layout-2 .image',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .butler-images.layout-2 .image',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'butler' ),
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label' => __( 'Opacity', 'butler' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .butler-images.layout-2:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .butler-images.layout-2:hover .image',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow_hover',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .butler-images.layout-2:hover .image',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_2_hover_border',
				'selector' => '{{WRAPPER}} .butler-images.layout-2:hover .image',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selectors' => [
					'{{WRAPPER}} .butler-images.layout-1 .images',
				],
				'condition' =>  [
					'layout'    =>  'layout-1'
				]
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'butler' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .butler-images.layout-1 .images img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' =>  [
					'layout'    =>  'layout-1'
				]
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Padding', 'butler' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .butler-images.layout-2 .image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' =>  [
					'layout'    =>  'layout-2'
				]
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		require dirname(__FILE__) . '/' . $settings['layout'] .'.php';
	}

}
$widgets_manager->register_widget_type(new \Butler_Image_Widget());
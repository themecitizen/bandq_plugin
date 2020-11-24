<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class Butler_Map_Widget extends Widget_Base {

	public function get_name()
	{
		return 'butler_map';
	}

	public function get_title()
	{
		return esc_html__('Map', 'butler');
	}

	public function get_icon()
	{
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return ['wpf-category'];
	}

	protected function _register_controls() {
		// Content Tab
		$this->tab_content();
	}

	// section and element on tab content
	private function tab_content ()
	{
		$this->start_controls_section(
			'section_map',
			[
				'label' => __( 'Map', 'butler' ),
			]
		);

		$default_address = __( 'London Eye, London, United Kingdom', 'butler' );

		$this->add_control(
			'api',
			[
				'label' => __( 'API key', 'butler' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Input your google map api key here' ),
				'description' => esc_html__( 'Input here the API key to display google map, you can register it at: ', 'butler' ) . '<a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">Here</a>',
				'label_block' => true,
			]
		);

		$this->add_control(
			'lat',
			[
				'label' => __( 'Lat', 'butler' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => '51.5033273',
				'default' => '51.5033273',
				'label_block' => true,
			]
		);

		$this->add_control(
			'lng',
			[
				'label' => __( 'Lng', 'butler' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => '-0.1217317',
				'default' => '-0.1217317',
				'label_block' => true,
			]
		);
		$this->add_control(
			'detail',
			[
				'label' => __( 'Detail', 'butler' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => $default_address,
				'default' => $default_address,
				'label_block' => true,
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Thumbnail', 'butler' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'marker',
			[
				'label' => __( 'Choose Marker', 'butler' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => BUTLER_TF_ELEMENTOR_URL . 'assets/img/marker.png',
				],
			]
		);
		$this->add_control(
			'zoom',
			[
				'label' => __( 'Zoom', 'butler' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'butler' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 40,
						'max' => 1440,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .butler-google-map-container .butler-map' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'prevent_scroll',
			[
				'label' => __( 'Enable Scroll', 'butler' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		require dirname(__FILE__) . '/layout-1.php';
	}

}

$widgets_manager->register_widget_type(new \Butler_Map_Widget());
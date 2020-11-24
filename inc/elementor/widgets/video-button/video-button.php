<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class Band_Video_Button extends Widget_Base {

	private $i10n;

	public function get_name()
	{
		return 'band_video_button';
	}

	public function get_title()
	{
		return __('Video Button', 'band');
	}

	public function get_icon()
	{
		return 'eicon-play';
	}

	public function get_categories() {
		return ['bandq'];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_video_button',
			[
				'label' => __('Button', 'band'),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'URL', 'band' ),
				'type' => Controls_Manager::TEXT,
				'autocomplete' => false,
				'label_block' => true,
				'placeholder' => __( 'Enter your URL', 'band' ),
			]
		);

		$this->end_controls_section(); // End section content

		$this->start_controls_section(
			'section_video_button_style',
			[
				'label' => esc_html__( 'Style', 'band' ),
				'tab'   =>  Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'position',
			[
				'label' => __( 'Icon Position', 'band' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'band' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Top', 'band' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'band' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-button-container' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // End section style
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		require dirname( __FILE__ ) . '/layout-1.php';
	}

}
$widgets_manager->register_widget_type(new \Band_Video_Button());
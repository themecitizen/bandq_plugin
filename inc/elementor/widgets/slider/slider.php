<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Band_Slider_Widget extends Widget_Base {

	public function get_name()
	{
		return 'band_slider';
	}

	public function get_title()
	{
		return esc_html__('Slider', 'Band');
	}

	public function get_icon()
	{
		return 'eicon-slides';
	}

	public function get_categories() {
		return ['bandq'];
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
			'band_slider',
			[
				'label' => __('Slider', 'Band'),
			]
		);

        $this->add_control(
            'images',
            [
                'label' => __( 'Add Images', 'Band' ),
                'type' => Controls_Manager::GALLERY,
                'show_label' => false,
                'dynamic' => [
                    'active' => true,
                ],
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
				'label' =>  esc_html__( 'Band content', 'Band' ),
				'tab'   =>  Controls_Manager::TAB_STYLE,
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
        require dirname(__FILE__) .'/layout-1.php';
	}

}
$widgets_manager->register_widget_type(new \Band_Slider_Widget());
<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;

class Band_Blog_Widget extends Widget_Base {

	public function get_name()
	{
		return 'bandq_blog';
	}

	public function get_title()
	{
		return esc_html__('Blog', 'bandq');
	}

	public function get_icon()
	{
		return 'eicon-posts-grid';
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
			'case_study_step_info',
			[
				'label' => __('Blog', 'bandq'),
			]
		);
		$this->add_control(
			'layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __('Choose Layout', 'bandq'),
				'label_block' => true,
				'default'   =>  'layout-grid',
				'options' => [
					'layout-grid' => __('Layout Grid', 'bandq'),
				],
			]
		);

		$this->end_controls_section(); // End section Info

		$this->start_controls_section(
			'blog_query',
			[
				'label' =>  esc_html__( 'Query', 'bandq' ),
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'bandq' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date' => __( 'Date', 'bandq' ),
					'post_title' => __( 'Title', 'bandq' ),
					'menu_order' => __( 'Menu Order', 'bandq' ),
					'rand' => __( 'Random', 'bandq' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'bandq' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'ASC', 'bandq' ),
					'desc' => __( 'DESC', 'bandq' ),
				],
			]
		);

		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'bandq' ),
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => [],
				'options' => bandq_get_post_categories(),
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
				'label' =>  esc_html__( 'Blog Content', 'bandq' ),
				'tab'   =>  Controls_Manager::TAB_STYLE,
				'condition' =>    [
                    'layout' => ['layout-grid']
                ]
			]
		);

		$this->add_control(
			'title_primary_color',
			[
				'label' => __( 'Title Color', 'bandq' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '#081734',
				'selectors' => [
					'{{WRAPPER}} .band-blog-list .list-posts .post-info h2 a' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'excerpt_primary_color',
			[
				'label' => esc_html__( 'Excerpt Color' ),
				'type'  => Controls_Manager::COLOR,
				'scheme'    =>  [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1
				],
				'default'   =>  '#081734',
				'selectors' =>  [
					'{{WRAPPER}} .band-blog-list .list-posts .post-info .excerpt' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color' ),
				'type'  => Controls_Manager::COLOR,
				'scheme'    =>  [
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1
				],
				'default'   =>  '#93c96f',
				'separator' => 'before',
				'selectors' =>  [
					'{{WRAPPER}} .band-blog-list .list-posts .post-info .image' => 'border-bottom-color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		require dirname(__FILE__) . '/' . $settings['layout'] .'.php';
	}

}
$widgets_manager->register_widget_type(new \Band_Blog_Widget());
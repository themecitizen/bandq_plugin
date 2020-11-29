<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Repeater;

class Band_Testimonial_Widget extends Widget_Base
{

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
        return 'bandq_testimonial';
    }

    public function get_title()
    {
        return __('Bandq Testimonial', 'bandq');
    }

    public function get_icon()
    {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories()
    {
        return ['bandq'];
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

    private function tab_content()
    {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Testimonial', 'bandq'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' =>  esc_html__('Layout', 'bandq'),
                'type'  =>  Controls_Manager::SELECT,
                'default'   =>  'layout-1',
                'options'   =>  [
                    'layout-1'  =>  esc_html__('Layout 1', 'bandq'),
                ]
            ]
        );

        $this->tab_content_layout1();
        $this->end_controls_section();
    }

    private function tab_content_layout1()
    {
        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial',
            [
                'label' => __('Testimonial', 'bandq'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Tab Title', 'bandq'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => __('Name', 'bandq'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list_testimonials',
            [
                'label' => __('Testimonials', 'bandq'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => __('#1', 'bandq'),
                        'testimonial' => __('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bandq'),
                    ],
                ],
                'title_field' => '{{{ name }}}',
                'condition' =>    [
                    'layout'    =>  ['layout-1']
                ]
            ]
        );

    }

    private function tab_style()
    {
        $this->tab_style_layout_1();
    }

    private function tab_style_layout_1()
    {
        $this->start_controls_section(
            'section_accordion_style',
            [
                'label' => __('Tab', 'bandq'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' =>  [
                    'layout'    =>  'layout-1'
                ]
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'bandq'),
                'type' => Controls_Manager::COLOR,
                'default'   =>  '#fff',
                'selectors' => [
                    '{{WRAPPER}} .bandp-testimonial-container .bandp-testimonial .inner-box' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bandp-testimonial-container .bandp-testimonial .inner-box h3' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
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
        require dirname(__FILE__) . '/' . $settings['layout'] . '.php';
    }
}

$widgets_manager->register_widget_type(new \Band_Testimonial_Widget());

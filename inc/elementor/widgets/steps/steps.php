<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;

class Band_Step_Widget extends Widget_Base
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
        return 'bandq_step';
    }

    public function get_title()
    {
        return __('Bandq Step', 'bandq');
    }

    public function get_icon()
    {
        return 'eicon-icon-box';
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
                'label' => __('Member', 'bandq'),
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

        $this->add_control(
            'image1',
            [
                'label' => __('Step 1 Image', 'bandq'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'info1',
            [
                'label' => __('Step 1 Information', 'bandq'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'image2',
            [
                'label' => __('Step 2 Image', 'bandq'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'info2',
            [
                'label' => __('Step 2 Information', 'bandq'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'image3',
            [
                'label' => __('Step 3 Image', 'bandq'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'info3',
            [
                'label' => __('Step 3 Information', 'bandq'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'image4',
            [
                'label' => __('Step 4 Image', 'bandq'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'info4',
            [
                'label' => __('Step 4 Information', 'bandq'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'image5',
            [
                'label' => __('Step 5 Image', 'bandq'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'info5',
            [
                'label' => __('Step 5 Information', 'bandq'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
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
                'default'   =>  '#081734',
                'selectors' => [
                    '{{WRAPPER}} .bandp-step-container .box' => 'color: {{VALUE}};',
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

$widgets_manager->register_widget_type(new \Band_Step_Widget());

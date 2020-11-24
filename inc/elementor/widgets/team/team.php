<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;

class Band_Team_Widget extends Widget_Base
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
        return 'bandq_team';
    }

    public function get_title()
    {
        return __('Bandq Team', 'bandq');
    }

    public function get_icon()
    {
        return 'eicon-person';
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
        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Choose Image', 'bandq'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'member_name',
            [
                'label' => __('Name', 'bandq'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Tab Title', 'bandq'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'member_info',
            [
                'label' => __('Information', 'bandq'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Tab Title', 'bandq'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list_members',
            [
                'label' => __('Members', 'bandq'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'member_name' => __('Member #1', 'bandq'),
                        'member_info' => __('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bandq'),
                    ],
                ],
                'title_field' => '{{{ member_name }}}',
                'condition' =>    [
                    'layout'    =>  ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'carousel_autoplay',
            [
                'label'    => esc_html__('Autoplay', 'bandq'),
                'type'    =>    Controls_Manager::SWITCHER,
                'default'    =>    '',
                'condition' =>  [
                    'layout'    =>  ['layout-1']
                ]
            ]
        );

        $this->add_control(
            'hide_pagination',
            [
                'label'    => esc_html__('Hide Pagination', 'bandq'),
                'type'    =>    Controls_Manager::SWITCHER,
                'default'    =>    '',
                'condition' =>  [
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
            'member_job_color',
            [
                'label' => __('Job Color', 'bandq'),
                'type' => Controls_Manager::COLOR,
                'default'   =>  '#32c788',
                'selectors' => [
                    '{{WRAPPER}} .bandq-team-container.layout-1 .bandq-team .inner-box .job-info' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );

        $this->add_control(
            'member_name_color',
            [
                'label' => __('Name Color', 'bandq'),
                'type' => Controls_Manager::COLOR,
                'default'   =>  '#19274d',
                'selectors' => [
                    '{{WRAPPER}} .bandq-team-container.layout-1 .bandq-team .inner-box .member-info h3' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );

        $this->add_control(
            'member_circle_1_color',
            [
                'label' => __('Circle 1 Background Color', 'bandq'),
                'type' => Controls_Manager::COLOR,
                'default'   =>  '#e2fff3',
                'selectors' => [
                    '{{WRAPPER}} .bandq-team-container.layout-1 .bandq-team .inner-box .cirlces .circle-one' => 'background-color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );

        $this->add_control(
            'member_circle_2_color',
            [
                'label' => __('Circle 2 Background Color', 'bandq'),
                'type' => Controls_Manager::COLOR,
                'default'   =>  '#32c788',
                'selectors' => [
                    '{{WRAPPER}} .bandq-team-container.layout-1 .bandq-team .inner-box .cirlces .circle-two' => 'background-color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );

        $this->add_control(
            'member_social_btn_color',
            [
                'label' => __('Button Social Color', 'bandq'),
                'type' => Controls_Manager::COLOR,
                'default'   =>  '#fff',
                'selectors' => [
                    '{{WRAPPER}} .bandq-team-container.layout-1 .bandq-team .inner-box .member-info .social-outer-box .plus' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
            ]
        );

        $this->add_control(
            'member_social_btn_bg_color',
            [
                'label' => __('Button Social Color', 'bandq'),
                'type' => Controls_Manager::COLOR,
                'default'   =>  '#32c788',
                'selectors' => [
                    '{{WRAPPER}} .bandq-team-container.layout-1 .bandq-team .inner-box .member-info .social-outer-box .plus' => 'background-color: {{VALUE}};',
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

$widgets_manager->register_widget_type(new \Band_Team_Widget());

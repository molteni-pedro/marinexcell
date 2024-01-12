<?php

namespace WWPElementorBreadcrumbs\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use WWPElementorBreadcrumbs\WWP_ELEMENTOR_BREADCRUMBS;

// If this file is called directly, abort.
if(! defined('ABSPATH')) exit;

class StaticBreadcrumbs extends Widget_Base
{
    public function get_name()
    {
        return 'wwp-elementor-static-breadcrumbs';
    }

    public function get_icon()
    {
        return 'eicon-navigation-horizontal';
    }

    public function get_title()
    {
        return 'Static Breadcrumbs';
    }

    public function get_categories()
    {
        return ['wwp-elements'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section('wwp_elementor_static_breadcrumbs_settings',
            [
                'label' => __('Content', 'wwp-elementor-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title_field',
            [
                'label' => __('Title', 'wwp-elementor-addons'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'link_field',
            [
                'label' => __('Link', 'wwp-elementor-addons'),
                'type' => Controls_Manager::URL,
                'show_external' => true,
                'placeholder' => 'https://workingwithpixels.com',
            ]
        );

        $repeater->add_control('active_state',
            [
                'label' => __('Active State', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options'  => [
                    'no'  => _x('No', 'Active State', 'wwp-elementor-addons'),
                    'yes' => _x('Yes', 'Active State', 'wwp-elementor-addons'),
                ],
                'default' => __('no', 'wwp-elementor-addons'),
            ]
        );

        $repeater->add_control('is_home',
            [
                'label' => __('Is Homepage', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options'  => [
                    'no'  => _x('No', 'Active State', 'wwp-elementor-addons'),
                    'yes' => _x('Yes', 'Active State', 'wwp-elementor-addons'),
                ],
                'default' => __('no', 'wwp-elementor-addons'),
            ]
        );

        $repeater->add_control('next_page',
            [
                'label' => __('Next Page', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options'  => [
                    'no'  => _x('No', 'Active State', 'wwp-elementor-addons'),
                    'yes' => _x('Yes', 'Active State', 'wwp-elementor-addons'),
                ],
                'default' => __('no', 'wwp-elementor-addons'),
            ]
        );

        $this->add_control(
            'breadcrumb_items',
            [
                'label' => __('Breadcrumb items', 'wwp-elementor-addons'),
                'type' => Controls_Manager::REPEATER,
                'show_label' => true,
                'prevent_empty' => true,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title_field' => _x('Home', 'Default item values', 'wwp-elementor-addons'),
                        'active_state' => _x('no', 'Default item values', 'wwp-elementor-addons'),
                        'next_page' => _x('no', 'Default item values', 'wwp-elementor-addons'),
                        'is_home' => _x('yes', 'Default item values', 'wwp-elementor-addons'),
                    ],
                    [
                        'title_field' => _x('Main Page', 'Default item values', 'wwp-elementor-addons'),
                        'active_state' => _x('no', 'Default item values', 'wwp-elementor-addons'),
                        'next_page' => _x('no', 'Default item values', 'wwp-elementor-addons'),
                        'is_home' => _x('no', 'Default item values', 'wwp-elementor-addons'),
                    ],
                    [
                        'title_field' => _x('This Page', 'Default item values', 'wwp-elementor-addons'),
                        'active_state' => _x('yes', 'Default item values', 'wwp-elementor-addons'),
                        'next_page' => _x('no', 'Default item values', 'wwp-elementor-addons'),
                        'is_home' => _x('no', 'Default item values', 'wwp-elementor-addons'),
                    ],
                    [
                        'title_field' => _x('Next Page', 'Default item values', 'wwp-elementor-addons'),
                        'active_state' => _x('no', 'Default item values', 'wwp-elementor-addons'),
                        'next_page' => _x('yes', 'Default item values', 'wwp-elementor-addons'),
                        'is_home' => _x('no', 'Default item values', 'wwp-elementor-addons'),
                    ],
                ],
                'title_field' => '{{{ title_field }}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('wwp_elementor_static_breadcrumbs_structured_data',
            [
                'label' => __('Google Structured Data Schema', 'wwp-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('enable_google_schema',
            [
                'label' => __('Enable?', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options'  => [
                    'no'  => _x('No', 'Enable google schema', 'wwp-elementor-addons'),
                    'yes' => _x('Yes', 'Enable google schema', 'wwp-elementor-addons'),
                ],
                'default' => __('yes', 'wwp-elementor-addons'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('wwp_elementor_static_breadcrumbs_style_tab',
            [
                'label' => __('Breadcrumb Style', 'wwp-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_style',
            [
                'label' => __('Theme', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'description' => __('Breadcrumb Theme', 'wwp-elementor-addons'),
                'options'  => [
                    '0' => _x('Default', 'Theme selection', 'wwp-elementor-addons'),
                    '1' => _x('Custom Separator', 'Theme selection', 'wwp-elementor-addons'),
                    '2' => _x('Triangle', 'Theme selection', 'wwp-elementor-addons'),
                    '3' => _x('Multi-Steps', 'Theme selection', 'wwp-elementor-addons'),
                    '4' => _x('Dots', 'Theme selection', 'wwp-elementor-addons'),
                    '5' => _x('Dots with step counter', 'Theme selection', 'wwp-elementor-addons'),
                ],
                'default' => '0'
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumb_font_size',
            [
                'label' => __('Font Size', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 14,
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} li' => 'font-size: {{size}}{{unit}};',
                ],
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_custom_separator_type',
            [
                'label' => __('Separator Type', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'description' => 'Breadcrumb theme',
                'options'  => [
                    '0' => _x('Text', 'Breadcrumb separator type', 'wwp-elementor-addons'),
                    '1' => _x('Font awesome icon', 'Breadcrumb separator type', 'wwp-elementor-addons'),
                    '2' => _x('Image Upload', 'Breadcrumb separator type', 'wwp-elementor-addons'),
                ],
                'default' => '0',
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_style' => '1'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_custom_text_separator',
            [
                'label' => __('Text Separator', 'wwp-elementor-addons'),
                'description' => __('Add your custom text separator', 'wwp-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => false],
                'default' => ">",
                'label_block' => true,
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_custom_separator_type' => '0',
                    'wwp_elementor_static_breadcrumbs_style' => '1'
                ],
                'selectors' => [
                    '{{WRAPPER}} li::after' => 'content: "{{VALUE}}"',
                ],
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_font_awesome_separator',
            [
                'label' => __('Font Awesome Icon Separator', 'wwp-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => false],
                'description' => __('<span style="font-size: 14px;">Copy the icon code from <a href="https://fontawesome.com/cheatsheet" target="_blank">Font Aweosme cheatsheet</a> and add it like: "\f105"</span>', 'wwp-elementor-addons'),
                'label_block' => true,
                'default' => '\f105',
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_custom_separator_type' => '1',
                    'wwp_elementor_static_breadcrumbs_style' => '1'
                ],
                'selectors' => [
                    '{{WRAPPER}} li::after' => 'font-family: "FontAwesome"; content: "{{VALUE}}";',
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_image_separator',
            [
                'label' => __('Image Separator', 'wwp-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [ 'active' => false ],
                'default' => [
                    'url'   => Utils::get_placeholder_image_src()
                ],
                'show_label' => true,
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_custom_separator_type' => '2',
                    'wwp_elementor_static_breadcrumbs_style' => '1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'		=> 'image',
                'default'	=> 'thumbnail',
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_image_separator[url]!' => '',
                    'wwp_elementor_static_breadcrumbs_custom_separator_type' => '2',
                    'wwp_elementor_static_breadcrumbs_style' => '1'
                ],
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_triangle_switch',
            [
                'label' => __('Enable custom styling?', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_style' => '2'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_triangle_default_color',
            [
                'label' => __('Default Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#007C46', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_triangle_switch' => 'yes',
                    'wwp_elementor_static_breadcrumbs_style' => '2'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_triangle_active_color',
            [
                'label' => __('Active Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#AFD236', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_triangle_switch' => 'yes',
                    'wwp_elementor_static_breadcrumbs_style' => '2'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_ms_switch',
            [
                'label' => __('Enable custom styling?', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_style' => '3'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_ms_default_color',
            [
                'label' => __('Default Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#007C46', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_ms_switch' => 'yes',
                    'wwp_elementor_static_breadcrumbs_style' => '3'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_ms_active_color',
            [
                'label' => __('Active Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#AFD236', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_ms_switch' => 'yes',
                    'wwp_elementor_static_breadcrumbs_style' => '3'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_dots_position',
            [
                'label' => __('Position', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options'  => [
                    'top'  => _x('Top', 'Dots position', 'wwp-elementor-addons'),
                    'bottom' => _x('Bottom', 'Dots position', 'wwp-elementor-addons'),
                ],
                'default' => __('bottom', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_dots_switch',
            [
                'label' => __('Enable custom styling?', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_dots_default_color',
            [
                'label' => __('Default Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#007C46', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_dots_switch' => 'yes',
                    'wwp_elementor_static_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_dots_active_color',
            [
                'label' => __('Active Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#AFD236', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_dots_switch' => 'yes',
                    'wwp_elementor_static_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_dots_sc_position',
            [
                'label' => __('Position', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options'  => [
                    'top'  => _x('Top', 'Dots position', 'wwp-elementor-addons'),
                    'bottom' => _x('Bottom', 'Dots position', 'wwp-elementor-addons'),
                ],
                'default' => __('bottom', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_dots_sc_switch',
            [
                'label' => __('Enable custom styling?', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_dots_sc_default_color',
            [
                'label' => __('Default Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#007C46', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_dots_sc_switch' => 'yes',
                    'wwp_elementor_static_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->add_control('wwp_elementor_static_breadcrumbs_dots_sc_active_color',
            [
                'label' => __('Active Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#AFD236', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_static_breadcrumbs_dots_sc_switch' => 'yes',
                    'wwp_elementor_static_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        global $wp;

        $default_color = __('#007C46', 'wwp-elementor-addons');
        $active_color = __('#AFD236', 'wwp-elementor-addons');

        $settings = $this->get_settings_for_display();

        $output = $add_theme_class = '';

        $id = "breadcrumb-".uniqid();

        if(intval($settings['wwp_elementor_static_breadcrumbs_style']) === 0)
        {
            $output .= '<style>#'.$id.' li::after { content: "»" }</style>';
        }

        if(intval($settings['wwp_elementor_static_breadcrumbs_style']) === 1)
        {
            if(intval($settings['wwp_elementor_static_breadcrumbs_custom_separator_type']) === 2)
            {
                $icon_path = Group_Control_Image_Size::get_attachment_image_src($settings['wwp_elementor_static_breadcrumbs_image_separator']['id'], 'image', $settings);

                if($settings['image_size'] == 'custom')
                {
                    $icon_width = $settings['image_custom_dimension']['width'];
                    $icon_height = $settings['image_custom_dimension']['height'];

                    if($icon_width !== '' && $icon_height == '')
                    {
                        $icon_height = $icon_width;
                    }

                    if($icon_width == '' && $icon_height != '')
                    {
                        $icon_width = $icon_height;
                    }
                }
                else
                {
                    list($icon_width, $icon_height) = getimagesize($icon_path);
                }

                $output .= '<style>#'.$id.' li::after { content: ""; background: url("'.$icon_path.'"); width: '.$icon_width.'px; height: '.$icon_height.'px;) }</style>';
            }
        }

        if(intval($settings['wwp_elementor_static_breadcrumbs_style']) === 2)
        {
            if($settings['wwp_elementor_static_breadcrumbs_triangle_switch'] == 'yes')
            {
                $default_color = $settings['wwp_elementor_static_breadcrumbs_triangle_default_color'];
                $active_color = $settings['wwp_elementor_static_breadcrumbs_triangle_active_color'];
            }

            $output .= '
                <style>
                    #'.$id.'.triangle li a {
                        background: '.$default_color.';
                    }
                    #'.$id.'.triangle li a:after {
                        border-left: 30px solid '.$default_color.';
                    }
                    #'.$id.'.triangle li:last-child {
                        background: '.$active_color.';
                    }
                </style>
            ';

            $add_theme_class = 'triangle';
        }

        if(intval($settings['wwp_elementor_static_breadcrumbs_style']) === 3)
        {
            if($settings['wwp_elementor_static_breadcrumbs_ms_switch'] == 'yes')
            {
                $default_color = $settings['wwp_elementor_static_breadcrumbs_ms_default_color'];
                $active_color = $settings['wwp_elementor_static_breadcrumbs_ms_active_color'];
            }

            $output .= '
                <style>
                    #'.$id.'.text-top a, #'.$id.'.text-bottom a {
                        text-decoration: none;
                    }
                    #'.$id.'.multi-steps li.visited::after {
                        background-color: '.$default_color.';
                    }
                    #'.$id.'.multi-steps li::after {
                        background: '.$active_color.';
                    }
                    #'.$id.'.multi-steps.text-center li > * {
                        background: '.$active_color.';
                    }
                    #'.$id.'.multi-steps.text-center li.visited > *, #'.$id.'.multi-steps.text-center li.current > * {
                        background-color: '.$default_color.';
                    }
                </style>
            ';

            $add_theme_class = 'multi-steps text-center';
        }

        if(intval($settings['wwp_elementor_static_breadcrumbs_style']) === 4)
        {
            if($settings['wwp_elementor_static_breadcrumbs_dots_switch'] == 'yes')
            {
                $default_color = $settings['wwp_elementor_static_breadcrumbs_dots_default_color'];
                $active_color = $settings['wwp_elementor_static_breadcrumbs_dots_active_color'];
            }

            $output .= '
                <style>
                    #'.$id.'.text-top a, #'.$id.'.text-bottom a {
                        text-decoration: none;
                    }
                    #'.$id.'.text-top li.visited > *::before, #'.$id.'.text-top li.current > *::before, #'.$id.'.text-bottom li.visited > *::before, #'.$id.'.text-bottom li.current > *::before {
                        background-color: '.$default_color.';
                    }
                    #'.$id.'.text-top a:hover, .wwp-elementor-breadcrumbs.text-bottom a:hover {
                        color: '.$default_color.';
                    }
                    #'.$id.'.text-top li > *::before, #'.$id.'.text-bottom li > *::before {
                        background-color: ' . $active_color . ';
                    }
                    #'.$id.'.text-top li.visited > a:hover::before, #'.$id.'.text-bottom li.visited > a:hover::before {
                        box-shadow: 0 0 0 3px '.WWP_ELEMENTOR_BREADCRUMBS::wwp_elementor_hex_to_rgba($default_color, '0.3').';
                    }
                    #'.$id.'.text-top li > a:hover::before, #'.$id.'.text-bottom li > a:hover::before {
                        box-shadow: 0 0 0 3px '.WWP_ELEMENTOR_BREADCRUMBS::wwp_elementor_hex_to_rgba($active_color, '0.3').';
                    }
                    #'.$id.'.multi-steps li.visited::after {
                        background-color: '.$default_color.';
                    }
                    #'.$id.'.multi-steps li::after {
                        background: '.$active_color.';
                    }
                </style>
            ';

            $add_theme_class = 'multi-steps text-'.$settings["wwp_elementor_static_breadcrumbs_dots_position"].'';
        }

        if(intval($settings['wwp_elementor_static_breadcrumbs_style']) === 5)
        {
            if($settings['wwp_elementor_static_breadcrumbs_dots_sc_switch'] == 'yes')
            {
                $default_color = $settings['wwp_elementor_static_breadcrumbs_dots_sc_default_color'];
                $active_color = $settings['wwp_elementor_static_breadcrumbs_dots_sc_active_color'];
            }

            $output .= '
                <style>
                    #'.$id.'.text-top a, #'.$id.'.text-bottom a {
                        text-decoration: none;
                    }
                    #'.$id.'.text-top li.visited > *::before, #'.$id.'.text-top li.current > *::before, #'.$id.'.text-bottom li.visited > *::before, #'.$id.'.text-bottom li.current > *::before {
                        background-color: '.$default_color.';
                    }
                    #'.$id.'.text-top a:hover, .wwp-elementor-breadcrumbs.text-bottom a:hover {
                        color: '.$default_color.';
                    }
                    #'.$id.'.text-top li > *::before, #'.$id.'.text-bottom li > *::before {
                        background-color: ' . $active_color . ';
                    }
                    #'.$id.'.text-top li.visited > a:hover::before, #'.$id.'.text-bottom li.visited > a:hover::before {
                        box-shadow: 0 0 0 3px '.WWP_ELEMENTOR_BREADCRUMBS::wwp_elementor_hex_to_rgba($default_color, '0.3').';
                    }
                    #'.$id.'.text-top li > a:hover::before, #'.$id.'.text-bottom li > a:hover::before {
                        box-shadow: 0 0 0 3px '.WWP_ELEMENTOR_BREADCRUMBS::wwp_elementor_hex_to_rgba($active_color, '0.3').';
                    }
                    #'.$id.'.multi-steps li.visited::after {
                        background-color: '.$default_color.';
                    }
                    #'.$id.'.multi-steps li::after {
                        background: '.$active_color.';
                    }
                </style>
            ';

            $add_theme_class = 'multi-steps text-'.$settings['wwp_elementor_static_breadcrumbs_dots_sc_position'].' count';
        }

        $structured_data = [];
        $structured_data['@context'] = 'https://schema.org/';
        $structured_data['@type'] = 'BreadcrumbList';
        $structured_data['itemListElement'] = [];

        $output .= '<ol class="wwp-elementor-breadcrumbs '.$add_theme_class.'" id="'.$id.'">';

        $structured_count = 0;
        foreach($settings['breadcrumb_items'] as $breadcrumb_item)
        {
            $temp_data_item = [];

            if($breadcrumb_item['is_home'] == 'no' && (esc_attr($breadcrumb_item['link_field']['url']) !== '' || $breadcrumb_item['active_state'] == 'yes'))
            {
                $temp_data_item['@type'] = 'ListItem';
                $temp_data_item['position'] = intval($structured_count);
                $temp_data_item['name'] = esc_attr($breadcrumb_item['title_field']);

                $temp_data_item['item'] = esc_attr($breadcrumb_item['link_field']['url']);

                if($breadcrumb_item['active_state'] == 'yes')
                {
                    $temp_data_item['item'] = home_url(add_query_arg(array(), $wp->request));
                }
            }

            $li_class = 'visited';

            if($breadcrumb_item['active_state'] == 'yes') 
            {
                $li_class = 'current';
            }

            if( ($breadcrumb_item['next_page'] == 'yes' && intval($settings['wwp_elementor_static_breadcrumbs_style']) === 3) || ($breadcrumb_item['next_page'] == 'yes' && intval($settings['wwp_elementor_static_breadcrumbs_style']) === 4) || ($breadcrumb_item['next_page'] == 'yes' && intval($settings['wwp_elementor_static_breadcrumbs_style']) === 5))
            {
                $li_class = '';
            }

            $output .= '<li class="'.$li_class.'">';

            if(esc_attr($breadcrumb_item['link_field']['url']) !== '')
            {
                $output .= '<a href="'. esc_attr($breadcrumb_item['link_field']['url']).'">';
            }

            $output .= '<span>'.esc_attr($breadcrumb_item['title_field']).'</span>';

            if(esc_attr($breadcrumb_item['link_field']['url']) !== '')
            {
                $output .= '</a>';
            }

            $output .= '</li>';

            $structured_count++;

            $structured_data['itemListElement'][] = $temp_data_item;
        }

        $output .= '</ol>';

        if($settings['enable_google_schema'] === 'yes')
        {
            $output .= '<script type="application/ld+json">' . wp_json_encode($structured_data) . '</script>';
        }

        echo balanceTags($output, true);
    }
}
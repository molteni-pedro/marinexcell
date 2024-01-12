<?php

namespace WWPElementorBreadcrumbs\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use WWPElementorBreadcrumbs\WWP_ELEMENTOR_BREADCRUMBS;

// If this file is called directly, abort.
if(! defined('ABSPATH')) exit;

class DynamicBreadcrumbs extends Widget_Base
{
    public function get_name()
    {
        return 'wwp-elementor-dynamic-breadcrumbs';
    }

    public function get_icon()
    {
        return 'eicon-product-breadcrumbs';
    }
    public function get_title()
    {
        return 'Dynamic Breadcrumbs';
    }

    public function get_categories()
    {
        return ['wwp-elements'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section('wwp_elementor_breadcrumbs_settings',
            [
                'label' => __('Settings', 'wwp-elementor-addons'),
            ]
        );

        $this->add_control('wwp_elementor_breadcrumbs_show_homepage',
            [
                'label' => __('Show Homepage', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'description' => __('Show homepage in breadcrumb', 'wwp-elementor-addons'),
                'options'  => [
                    'yes'  => _x('Yes', 'Show Homepage', 'wwp-elementor-addons'),
                    'no' => _x('No', 'Show Homepage', 'wwp-elementor-addons'),
                ],
                'default' => __('yes', 'wwp-elementor-addons'),
            ]
        );

        $this->add_control('wwp_elementor_breadcrumbs_show_cpt_archive',
            [
                'label' => __('Show Custom Post Type Archive', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'description' => __('Show custom post type main archive in breadcrumb', 'wwp-elementor-addons'),
                'options'  => [
                    'yes'  => _x('Yes', 'Show Custom Post Type Archive', 'wwp-elementor-addons'),
                    'no' => _x('No', 'Show Custom Post Type Archive', 'wwp-elementor-addons'),
                ],
                'default' => __('yes', 'wwp-elementor-addons'),
            ]
        );

        $this->add_control('wwp_elementor_breadcrumbs_show_parent_page',
            [
                'label' => __('Show Parent Page', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'description' => __('Show parent page in breadcrumb', 'wwp-elementor-addons'),
                'options'  => [
                    'yes'  => _x('Yes', 'Show Parent Page', 'wwp-elementor-addons'),
                    'no' => _x('No', 'Show Parent Page', 'wwp-elementor-addons'),
                ],
                'default' => __('yes', 'wwp-elementor-addons'),
            ]
        );

        $this->add_control('wwp_elementor_breadcrumbs_show_child_pages',
            [
                'label' => __('Show Child Pages', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'description' => __('Show child pages in breadcrumb', 'wwp-elementor-addons'),
                'options'  => [
                    'yes'  => _x('Yes', 'Show Child Pages', 'wwp-elementor-addons'),
                    'no' => _x('No', 'Show Child Pages', 'wwp-elementor-addons'),
                ],
                'default' => __('no', 'wwp-elementor-addons'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('wwp_elementor_dynamic_breadcrumbs_structured_data',
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
                    'yes'  => _x('Yes', 'Show Child Pages', 'wwp-elementor-addons'),
                    'no' => _x('No', 'Show Child Pages', 'wwp-elementor-addons'),
                ],
                'default' => __('yes', 'wwp-elementor-addons'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('wwp_elementor_breadcrumbs_style_tab',
            [
                'label' => __('Breadcrumb Style', 'wwp-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control('wwp_elementor_breadcrumbs_style',
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

        $this->add_control('wwp_elementor_breadcrumb_font_size',
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

        $this->add_control('wwp_elementor_custom_separator_type',
            [
                'label' => __('Separator Type', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'description' => __('Breadcrumb Theme', 'wwp-elementor-addons'),
                'options'  => [
                    '0' => _x('Text', 'Breadcrumb separator type', 'wwp-elementor-addons'),
                    '1' => _x('Font awesome icon', 'Breadcrumb separator type', 'wwp-elementor-addons'),
                    '2' => _x('Image Upload', 'Breadcrumb separator type', 'wwp-elementor-addons'),
                ],
                'default' => '0',
                'condition' => [
                    'wwp_elementor_breadcrumbs_style' => '1'
                ]
            ]
        );

        $this->add_control('wwp_elementor_custom_text_separator',
            [
                'label' => __('Text Separator', 'wwp-elementor-addons'),
                'description' => __('Add your custom text separator', 'wwp-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => false],
                'default' => ">",
                'label_block' => true,
                'condition' => [
                    'wwp_elementor_custom_separator_type' => '0',
                    'wwp_elementor_breadcrumbs_style' => '1'
                ],
                'selectors' => [
                    '{{WRAPPER}} li::after' => 'content: "{{VALUE}}"',
                ],
            ]
        );

        $this->add_control('wwp_elementor_font_awesome_separator',
            [
                'label' => __('Font Awesome Icon Separator', 'wwp-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => false],
                'description' => __('<span style="font-size: 14px;">Copy the icon code from <a href="https://fontawesome.com/cheatsheet" target="_blank">Font Aweosme cheatsheet</a> and add it like: "\f105"</span>', 'wwp-elementor-addons'),
                'label_block' => true,
                'default' => '\f105',
                'condition' => [
                    'wwp_elementor_custom_separator_type' => '1',
                    'wwp_elementor_breadcrumbs_style' => '1'
                ],
                'selectors' => [
                    '{{WRAPPER}} li::after' => 'font-family: "FontAwesome"; content: "{{VALUE}}";',
                ]
            ]
        );

        $this->add_control('wwp_elementor_image_separator',
            [
                'label' => __('Image Separator', 'wwp-elementor-addons'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [ 'active' => false ],
                'default' => [
                    'url'   => Utils::get_placeholder_image_src()
                ],
                'show_label' => true,
                'condition' => [
                    'wwp_elementor_custom_separator_type' => '2',
                    'wwp_elementor_breadcrumbs_style' => '1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'		=> 'image',
                'default'	=> 'thumbnail',
                'condition' => [
                    'wwp_elementor_image_separator[url]!' => '',
                    'wwp_elementor_custom_separator_type' => '2',
                    'wwp_elementor_breadcrumbs_style' => '1'
                ],
            ]
        );

        $this->add_control('wwp_elementor_triangle_switch',
            [
                'label' => __('Enable custom styling?', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_breadcrumbs_style' => '2'
                ]
            ]
        );

        $this->add_control('wwp_elementor_triangle_default_color',
            [
                'label' => __('Default Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#007C46', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_triangle_switch' => 'yes',
                    'wwp_elementor_breadcrumbs_style' => '2'
                ],
                'selectors' => [
                    '{{WRAPPER}} .triangle li a' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .triangle li a::after' => 'border-left: 30px solid {{VALUE}};',
                ]
            ]
        );

        $this->add_control('wwp_elementor_triangle_active_color',
            [
                'label' => __('Active Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#AFD236', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_triangle_switch' => 'yes',
                    'wwp_elementor_breadcrumbs_style' => '2'
                ],
                'selectors' => [
                    '{{WRAPPER}} .triangle li:last-child' => 'background: {{VALUE}};',
                ]
            ]
        );

        $this->add_control('wwp_elementor_ms_switch',
            [
                'label' => __('Enable custom styling?', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_breadcrumbs_style' => '3'
                ]
            ]
        );

        $this->add_control('wwp_elementor_ms_default_color',
            [
                'label' => __('Default Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#007C46', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_ms_switch' => 'yes',
                    'wwp_elementor_breadcrumbs_style' => '3'
                ]
            ]
        );

        $this->add_control('wwp_elementor_ms_active_color',
            [
                'label' => __('Active Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#AFD236', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_ms_switch' => 'yes',
                    'wwp_elementor_breadcrumbs_style' => '3'
                ]
            ]
        );

        $this->add_control('wwp_elementor_dots_position',
            [
                'label' => __('Position', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options'  => [
                    'top'  => _x('Top', 'Dots position', 'wwp-elementor-addons'),
                    'bottom' => _x('Bottom', 'Dots position', 'wwp-elementor-addons'),
                ],
                'default' => __('bottom', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('wwp_elementor_dots_switch',
            [
                'label' => __('Enable custom styling?', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('wwp_elementor_dots_default_color',
            [
                'label' => __('Default Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#007C46', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_dots_switch' => 'yes',
                    'wwp_elementor_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('wwp_elementor_dots_active_color',
            [
                'label' => __('Active Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#AFD236', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_dots_switch' => 'yes',
                    'wwp_elementor_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('wwp_elementor_dots_sc_position',
            [
                'label' => __('Position', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SELECT,
                'options'  => [
                    'top'  => _x('Top', 'Dots position', 'wwp-elementor-addons'),
                    'bottom' => _x('Bottom', 'Dots position', 'wwp-elementor-addons'),
                ],
                'default' => __('bottom', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->add_control('wwp_elementor_dots_sc_switch',
            [
                'label' => __('Enable custom styling?', 'wwp-elementor-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->add_control('wwp_elementor_dots_sc_default_color',
            [
                'label' => __('Default Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#007C46', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_dots_sc_switch' => 'yes',
                    'wwp_elementor_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->add_control('wwp_elementor_dots_sc_active_color',
            [
                'label' => __('Active Color', 'wwp-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#AFD236', 'wwp-elementor-addons'),
                'condition' => [
                    'wwp_elementor_dots_sc_switch' => 'yes',
                    'wwp_elementor_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        global $post;
        global $wp;

        $default_color = __('#007C46', 'wwp-elementor-addons');
        $active_color = __('#AFD236', 'wwp-elementor-addons');

        $settings = $this->get_settings_for_display();

        $output = $add_theme_class = '';

        $id = "breadcrumb-".uniqid();

        if(intval($settings['wwp_elementor_breadcrumbs_style']) === 0)
        {
            $output .= '<style>#'.$id.' li::after { content: "»" }</style>';
        }

        if(intval($settings['wwp_elementor_breadcrumbs_style']) === 1)
        {
            if(intval($settings['wwp_elementor_custom_separator_type']) === 2)
            {
                $icon_path = Group_Control_Image_Size::get_attachment_image_src($settings['wwp_elementor_image_separator']['id'], 'image', $settings);

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

                $output .= '#'.$id.' li::after { content: ""; background: url("'.$icon_path.'"); width: '.$icon_width.'px; height: '.$icon_height.'px;) }';
            }
        }

        if(intval($settings['wwp_elementor_breadcrumbs_style']) === 2)
        {
            if($settings['wwp_elementor_triangle_switch'] === '')
            {
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
            }

            $add_theme_class = 'triangle';
        }

        if(intval($settings['wwp_elementor_breadcrumbs_style']) === 3)
        {
            if($settings['wwp_elementor_ms_switch'] == 'yes')
            {
                $default_color = $settings['wwp_elementor_ms_default_color'];
                $active_color = $settings['wwp_elementor_ms_active_color'];
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

        if(intval($settings['wwp_elementor_breadcrumbs_style']) === 4)
        {
            if($settings['wwp_elementor_dots_switch'] == 'yes')
            {
                $default_color = $settings['wwp_elementor_dots_default_color'];
                $active_color = $settings['wwp_elementor_dots_active_color'];
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

            $add_theme_class = 'multi-steps text-'.$settings["wwp_elementor_dots_position"].'';
        }

        if(intval($settings['wwp_elementor_breadcrumbs_style']) === 5)
        {
            if($settings['wwp_elementor_dots_sc_switch'] == 'yes')
            {
                $default_color = $settings['wwp_elementor_dots_sc_default_color'];
                $active_color = $settings['wwp_elementor_dots_sc_active_color'];
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

            $add_theme_class = 'multi-steps text-'.$settings['wwp_elementor_dots_sc_position'].' count';
        }

        $structured_data = [];
        $structured_data['@context'] = 'https://schema.org/';
        $structured_data['@type'] = 'BreadcrumbList';
        $structured_data['itemListElement'] = [];

        $output .= '<ol class="wwp-elementor-breadcrumbs '.$add_theme_class.'" id="'.$id.'">';

        if($settings['wwp_elementor_breadcrumbs_show_homepage'] === "yes")
        {
            $output .= '<li class="visited"><a href="/">Home</a></li>';
        }

        if($settings['wwp_elementor_breadcrumbs_show_cpt_archive'] === "yes")
        {
            global $wp_rewrite;

            $post_type_obj = get_post_type_object(get_post_type());

            $output .= '<li class="visited"><a href="'.get_post_type_archive_link($post_type_obj->name).'">'.$post_type_obj->label.'</a></li>';
        }

        if($settings['wwp_elementor_breadcrumbs_show_parent_page'] === "yes")
        {
            $parents = get_post_ancestors($post->ID);

            krsort($parents);

            $parents_count = 1;

            foreach($parents as $a_parent_ID)
            {
                $parent = get_post($a_parent_ID);

                $temp_data_item = [];
                $temp_data_item['@type'] = 'ListItem';
                $temp_data_item['position'] = $parents_count;
                $temp_data_item['name'] = $parent->post_title;
                $temp_data_item['item'] = get_the_permalink($parent->ID);

                $output .= '<li class="visited"><a href="'.get_permalink($parent->ID).'">'.$parent->post_title.'</a></li>';

                $structured_data['itemListElement'][] = $temp_data_item;

                $parents_count++;
            }
        }

        $current_page_data['@type'] = 'ListItem';
        $current_page_data['position'] = intval($parents_count);
        $current_page_data['name'] = esc_attr(get_the_title());
        $current_page_data['item'] = home_url(add_query_arg(array(), $wp->request));
        $structured_data['itemListElement'][] = $current_page_data;

        $output .= '<li class="current"><span>'.esc_attr(get_the_title()).'</span></li>';

        if($settings['wwp_elementor_breadcrumbs_show_child_pages'] === "yes")
        {
            wp_reset_postdata();

            $page_child_args = array(
                "post_type"=> "page",
                "post_parent" => $post->ID,
                "orderby" => "menu_order",
                "order" => "ASC"
            );
            $get_page_child = get_posts($page_child_args);

            foreach($get_page_child as $child_post)
            {
                setup_postdata($child_post);

                $output .= '<li><span>'.esc_attr(get_the_title($child_post->ID)).'</span></li>';
            }

            wp_reset_postdata();
        }

        $output .= '</ol>';

        if($settings['enable_google_schema'] === 'yes')
        {
            $output .= '<script type="application/ld+json">' . wp_json_encode($structured_data) . '</script>';
        }

        echo balanceTags($output, true);
    }
}
<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class IE_Testimonial_Slider_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'testimonial_slider';
    }

    public function get_title()
    {
        return __('Testimonial Slider', IE_TEXT_DOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-post-slider';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_script_depends()
    {
        return ['swiper-js']; // Add Swiper.js dependency
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Testimonial Content', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater for testimonials
        $repeater = new Repeater();

        // Profile Image
        $repeater->add_control(
            'profile_image',
            [
                'label' => __('Profile Image', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Name
        $repeater->add_control(
            'name',
            [
                'label' => __('Name', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => __('John Doe', IE_TEXT_DOMAIN),
                'label_block' => true,
            ]
        );

        // Designation
        $repeater->add_control(
            'designation',
            [
                'label' => __('Designation', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => __('CEO, Company', IE_TEXT_DOMAIN),
                'label_block' => true,
            ]
        );

        // Testimonial Title
        $repeater->add_control(
            'testimonial_title',
            [
                'label' => __('Title', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => __('Enter Title', IE_TEXT_DOMAIN),
                'label_block' => true,
            ]
        );
        // Testimonial Text
        $repeater->add_control(
            'testimonial_text',
            [
                'label' => __('Testimonial', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('This is a great service!', IE_TEXT_DOMAIN),
                'show_label' => true,
            ]
        );
        $repeater->add_control(
            'rating',
            [
                'label' => __('Rating', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::NUMBER, // Changed to NUMBER control
                'min' => 1,
                'max' => 5,
                'step' => 0.1, // Allows increments of 0.1
                'default' => 5, // Default rating value
                'label_block' => true,
            ]
        );

        // Add repeater control to the widget
        $this->add_control(
            'testimonials_list',
            [
                'label' => __('Testimonials', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => __('John Doe', IE_TEXT_DOMAIN),
                        'designation' => __('CEO, Company', IE_TEXT_DOMAIN),
                        'testimonial_title' => __('This is a great service!', IE_TEXT_DOMAIN),
                        'testimonial_text' => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', IE_TEXT_DOMAIN),
                        'profile_image' => ['url' => Utils::get_placeholder_image_src()],
                        'rating' => 3, // Adding rating
                    ],
                    [
                        'name' => __('Jane Doe', IE_TEXT_DOMAIN),
                        'designation' => __('CTO, Company', IE_TEXT_DOMAIN),
                        'testimonial_title' => __('This is a great service!', IE_TEXT_DOMAIN),
                        'testimonial_text' => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', IE_TEXT_DOMAIN),
                        'profile_image' => ['url' => Utils::get_placeholder_image_src()],
                        'rating' => 4.5, // Adding rating
                    ],
                ],
                'title_field' => '{{{ name }}} - {{{ designation }}}',
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label' => __('Icon Type', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => __('Icon', IE_TEXT_DOMAIN),
                    'image' => __('Image', IE_TEXT_DOMAIN),
                ],
            ]
        );

        $this->add_control(
            'quote_icon',
            [
                'label' => __('Quote Icon', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-quote-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'icon_type' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'quote_image',
            [
                'label' => __('Quote Image', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_type' => 'image',
                ],
            ]
        );


        $this->end_controls_section();
        // Navigation Section
        $this->start_controls_section(
            'navigation_section',
            [
                'label' => __('Navigation', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label' => __('Show Navigation', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', IE_TEXT_DOMAIN),
                'label_off' => __('No', IE_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'prev_icon',
            [
                'label' => __('Previous Button Icon', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'next_icon',
            [
                'label' => __('Next Button Icon', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Loop', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', IE_TEXT_DOMAIN),
                'label_off' => __('No', IE_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', IE_TEXT_DOMAIN),
                'label_off' => __('No', IE_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay Speed (ms)', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'ms' => [
                        'min' => 1000,
                        'max' => 10000,
                    ],
                ],
                'default' => [
                    'size' => 3000,
                ],
            ]
        );


        $this->end_controls_section();

        // Style Tab for Name Styling
        $this->start_controls_section(
            'iet_style_section',
            [
                'label' => __('Name', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Tabs for Normal and Hover states
        $this->start_controls_tabs('tabs_iet_name_style');

        // Normal Tab
        $this->start_controls_tab(
            'tab_iet_name_normal',
            [
                'label' => __('Normal', IE_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'iet_name_color',
            [
                'label' => __('Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'tab_iet_name_hover',
            [
                'label' => __('Hover', IE_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'iet_name_hover_color',
            [
                'label' => __('Color (Hover)', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#ccc',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-content:hover .testimonial-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Name Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'iet_name_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-testimonial-slider .testimonial-name',
            ]
        );

        // Margin Control (responsive)
        $this->add_responsive_control(
            'iet_name_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding Control (responsive)
        $this->add_responsive_control(
            'iet_name_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab for Designation Styling
        $this->start_controls_section(
            'iet_desig_style_section',
            [
                'label' => __('Designation', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Tabs for Normal and Hover states
        $this->start_controls_tabs('tabs_iet_desig_style');

        // Normal Tab
        $this->start_controls_tab(
            'tab_iet_desig_normal',
            [
                'label' => __('Normal', IE_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'iet_desig_color',
            [
                'label' => __('Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'tab_iet_desig_hover',
            [
                'label' => __('Hover', IE_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'iet_desig_hover_color',
            [
                'label' => __('Color (Hover)', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#ccc',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-content:hover .testimonial-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Designation Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'iet_desig_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-testimonial-slider .testimonial-designation',
            ]
        );

        // Margin Control (responsive)
        $this->add_responsive_control(
            'iet_desig_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding Control (responsive)
        $this->add_responsive_control(
            'iet_desig_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab for Title Styling
        $this->start_controls_section(
            'iet_title_style_section',
            [
                'label' => __('Testimonial Title', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'iet_title_color',
            [
                'label' => __('Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Title Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'iet_title_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-title',
            ]
        );

        // Margin Control (responsive)
        $this->add_responsive_control(
            'iet_title_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding Control (responsive)
        $this->add_responsive_control(
            'iet_title_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab for Testimonial Description Styling
        $this->start_controls_section(
            'iet_desc_style_section',
            [
                'label' => __('Description', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'iet_desc_color',
            [
                'label' => __('Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Testimonial Description Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'iet_desc_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-desc',
            ]
        );

        // Margin Control (responsive)
        $this->add_responsive_control(
            'iet_desc_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding Control (responsive)
        $this->add_responsive_control(
            'iet_desc_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab for Profile Image
        $this->start_controls_section(
            'iet_profile_image_style_section',
            [
                'label' => __('Profile Image', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Width
        $this->add_responsive_control(
            'iet_profile_image_width',
            [
                'label' => __('Width', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'size' => 50,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => ['min' => 0, 'max' => 150],
                    '%' => ['min' => 0, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Height
        $this->add_responsive_control(
            'iet_profile_image_height',
            [
                'label' => __('Height', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'size' => 50,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => ['min' => 0, 'max' => 150],
                    '%' => ['min' => 0, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-image img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'iet_profile_image_border',
                'label' => __('Border', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-testimonial-slider .testimonial-image img',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'iet_profile_image_border_radius',
            [
                'label' => __('Border Radius', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin
        $this->add_responsive_control(
            'iet_profile_image_margin',
            [
                'label' => __('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            'iet_profile_image_padding',
            [
                'label' => __('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Rating
        $this->start_controls_section(
            'iet_rating_style_section',
            [
                'label' => __('Rating', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Rating Color
        $this->add_control(
            'iet_rating_color',
            [
                'label' => __('Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFD700', // Gold
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-rating i' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Rating Size (Font-size for star icons)
        $this->add_responsive_control(
            'iet_rating_size',
            [
                'label' => __('Size', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => ['min' => 5, 'max' => 50],
                    'em' => ['min' => 0.1, 'max' => 5],
                    'rem' => ['min' => 0.1, 'max' => 5],
                ],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Margin
        $this->add_responsive_control(
            'iet_rating_margin',
            [
                'label' => __('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-rating i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            'iet_rating_padding',
            [
                'label' => __('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-rating i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Quote Icon
        $this->start_controls_section(
            'iet_icon_style_section',
            [
                'label' => __('Icon', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Icon Color
        $this->add_control(
            'iet_icon_color',
            [
                'label' => __('Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .quote-wrapper svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Icon Size (svg width)
        $this->add_responsive_control(
            'iet_icon_size',
            [
                'label' => __('Size', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => ['min' => 30, 'max' => 200],
                    'em' => ['min' => 0.1, 'max' => 5],
                    'rem' => ['min' => 0.1, 'max' => 5],
                ],
                'default' => [
                    'size' => 90,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .quote-wrapper svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Margin
        $this->add_responsive_control(
            'iet_icon_image_margin',
            [
                'label' => __('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .quote-wrapper svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            'iet_icon_image_padding',
            [
                'label' => __('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => 10,
                    'right' => 10,
                    'bottom' => 10,
                    'left' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .quote-wrapper svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab for Testimonial User Tabs Styling
        $this->start_controls_section(
            'iet_user_style_section',
            [
                'label' => __('User Tabs', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Tabs for Normal and Hover states
        $this->start_controls_tabs('tabs_iet_user_style');

        // Normal Tab
        $this->start_controls_tab(
            'tab_iet_user_normal',
            [
                'label' => __('Normal', IE_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'iet_user_tab_color',
            [
                'label' => __('Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .swiper-slide .testimonial-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'tab_iet_user_hover',
            [
                'label' => __('Hover', IE_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'iet_user_tab_hover_color',
            [
                'label' => __('Color (Hover)', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#ccc',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .swiper-slide .testimonial-content:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ie-testimonial-wrapper .swiper-slide.swiper-slide-active .testimonial-content:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        // Active Tab
        $this->start_controls_tab(
            'tab_iet_user_active',
            [
                'label' => __('Active', IE_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'iet_user_tab_active_color',
            [
                'label' => __('Color (Active)', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#252525',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .swiper-slide.swiper-slide-active .testimonial-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Border Control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'iet_user_tab_border',
                'label' => __('Border', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-testimonial-wrapper .swiper-slide .testimonial-content',
            ]
        );

        // Border Radius Control (responsive)
        $this->add_responsive_control(
            'iet_user_tab_border_radius',
            [
                'label' => __('Border Radius', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 10,
                    'right' => 10,
                    'bottom' => 10,
                    'left' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .swiper-slide .testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        // Margin Control (responsive)
        $this->add_responsive_control(
            'iet_user_tab_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding Control (responsive)
        $this->add_responsive_control(
            'iet_user_tab_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-slider .testimonial-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab for Testimonial Description Container Styling
        $this->start_controls_section(
            'iet_desc_cont_style_section',
            [
                'label' => __('Content Container', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'iet_desc_cont_color',
            [
                'label' => __('Background Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#252525',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-details' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Border Control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'iet_desc_cont_border',
                'label' => __('Border', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-details',
            ]
        );

        // Border Radius Control (responsive)
        $this->add_responsive_control(
            'iet_desc_cont_border_radius',
            [
                'label' => __('Border Radius', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => 10,
                    'right' => 10,
                    'bottom' => 10,
                    'left' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        // Margin Control (responsive)
        $this->add_responsive_control(
            'iet_desc_cont_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding Control (responsive)
        $this->add_responsive_control(
            'iet_desc_cont_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper .testimonial-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Navigation
        $this->start_controls_section(
            'iet_nav_arrow_style_section',
            [
                'label' => __('Navigation', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'iet_nav_position_bottom',
            [
                'label' => __('Show Arrows at Bottom', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', IE_TEXT_DOMAIN),
                'label_off' => __('No', IE_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => '',
                'prefix_class' => 'iet-nav-bottom-',
            ]
        );



        // Horizontal Position (for prev and next)
        $this->add_responsive_control(
            'iet_nav_X_position',
            [
                'label' => __('Horizontal Offset', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ // Still needs a key here, but we'll force the unit in the selector
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-nav' => 'left: {{SIZE}}%;',
                ],
            ]
        );
        // Vertical Position (for prev and next)
        $this->add_responsive_control(
            'iet_nav_Y_position',
            [
                'label' => __('Vertical Offset', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [ // Still needs a key here, but we'll force the unit in the selector
                        'min' => -150,
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-nav' => 'margin-top: {{SIZE}}px;',
                ],
            ]
        );
        // Start Tabs: Normal / Hover
        $this->start_controls_tabs('tabs_iet_nav_arrow_style');

        // Normal
        $this->start_controls_tab(
            'tab_iet_nav_arrow_normal',
            [
                'label' => __('Normal', IE_TEXT_DOMAIN),
            ]
        );

        // Icon Color
        $this->add_control(
            'iet_nav_arrow_color',
            [
                'label' => __('Icon Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-nav .ie-prev-btn svg, {{WRAPPER}} .ie-testimonial-nav .ie-next-btn svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Background Color
        $this->add_control(
            'iet_nav_arrow_bg_color',
            [
                'label' => __('Background Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-nav .ie-prev-btn svg, {{WRAPPER}} .ie-testimonial-nav .ie-next-btn svg' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'tab_iet_nav_arrow_hover',
            [
                'label' => __('Hover', IE_TEXT_DOMAIN),
            ]
        );

        // Hover Icon Color
        $this->add_control(
            'iet_nav_arrow_hover_color',
            [
                'label' => __('Icon Color (Hover)', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#ccc',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-nav .ie-prev-btn svg:hover, {{WRAPPER}} .ie-testimonial-nav .ie-next-btn svg:hover' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Hover Background Color
        $this->add_control(
            'iet_nav_arrow_hover_bg_color',
            [
                'label' => __('Background Color (Hover)', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-nav .ie-prev-btn svg:hover, {{WRAPPER}} .ie-testimonial-nav .ie-next-btn svg:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        // Icon Size (Font-size)
        $this->add_responsive_control(
            'iet_nav_arrow_icon_size',
            [
                'label' => __('Icon Size', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => ['min' => 8, 'max' => 80],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-nav .ie-prev-btn svg, {{WRAPPER}} .ie-testimonial-nav .ie-next-btn svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'iet_nav_arrow_border',
                'label' => __('Border', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-testimonial-nav .ie-prev-btn svg, {{WRAPPER}} .ie-testimonial-nav .ie-next-btn svg',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'iet_nav_arrow_border_radius',
            [
                'label' => __('Border Radius', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-nav .ie-prev-btn svg, {{WRAPPER}} .ie-testimonial-nav .ie-next-btn svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        

        // Padding
        $this->add_responsive_control(
            'iet_nav_arrow_padding',
            [
                'label' => __('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => 5,
                    'right' => 5,
                    'bottom' => 5,
                    'left' => 5,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-nav .ie-prev-btn svg, {{WRAPPER}} .ie-testimonial-nav .ie-next-btn svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'iet_wrapper_style_section',
            [
                'label' => __('Wrapper Container', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        // Background Color
        $this->add_control(
            'iet_wrapper_background_color',
            [
                'label' => __('Background Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        // Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'iet_wrapper_border',
                'label' => __('Border', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-testimonial-wrapper',
            ]
        );
        
        // Border Radius
        $this->add_responsive_control(
            'iet_wrapper_border_radius',
            [
                'label' => __('Border Radius', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Margin
        $this->add_responsive_control(
            'iet_wrapper_margin',
            [
                'label' => __('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Padding
        $this->add_responsive_control(
            'iet_wrapper_padding',
            [
                'label' => __('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ie-testimonial-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        


    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="ie-testimonial-wrapper">
            <div class="ie-testimonial-nav">
                <?php if ($settings['show_nav'] === 'yes'): ?>
                    <div class="ie-prev-btn">
                        <?php \Elementor\Icons_Manager::render_icon($settings['prev_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                    <div class="ie-next-btn">
                        <?php \Elementor\Icons_Manager::render_icon($settings['next_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                <?php endif; ?>
                <!-- <div class="ie-next-btn"></div>
                <div class="ie-prev-btn"></div> -->
            </div>
            <div class="swiper ie-testimonial-slider">

                <div class="swiper-wrapper">
                    <?php foreach ($settings['testimonials_list'] as $testimonial): ?>
                        <div class="swiper-slide">
                            <div class="testimonial-content">
                                <div class="testimonial-image">
                                    <img src="<?php echo esc_url($testimonial['profile_image']['url']); ?>"
                                        alt="<?php echo esc_attr($testimonial['name']); ?>" />
                                </div>
                                <div class="info">
                                    <h3 class="testimonial-name"><?php echo $testimonial['name']; ?></h3>
                                    <h5 class="testimonial-designation"><?php echo $testimonial['designation']; ?></h5>
                                </div>

                                <!-- <p class="testimonial-text"><?php echo $testimonial['testimonial_text']; ?></p> -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> -->
                <!-- <div class="swiper-pagination"></div> -->
            </div>
            <div class="data-wrapper">
                <div class="quote-wrapper">
                    <?php
                    if ($settings['icon_type'] === 'icon' && !empty($settings['quote_icon']['value'])) {
                        // Display icon
                        \Elementor\Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true']);
                    } elseif ($settings['icon_type'] === 'image' && !empty($settings['quote_image']['url'])) {
                        // Display image
                        echo '<img src="' . esc_url($settings['quote_image']['url']) . '" alt="Quote Icon">';
                    }
                    ?>
                </div>
                <div class="testimonial-details">
                    <div class="testimonial-rating">
                        <!-- The rating is coming from javascript -->
                        <!-- <?php echo $this->render_rating_stars($testimonial['rating']); ?> -->
                    </div>
                    <div class="testimonial-data">

                    </div>
                </div>
            </div>
        </div>

        <style>
            .ie-testimonial-wrapper {
                position: relative;
                height: 100%;
                display: flex;
                align-items: stretch;
            }

            .ie-testimonial-wrapper .swiper-wrapper {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .swiper-slide {
                text-align: center;
                font-size: 18px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .swiper {
                width: 50%;
                height: 100%;
                box-sizing: border-box;
                float: left;
                max-height: 400px;
            }

            .data-wrapper {
                width: 50%;
                height: 40vh;
                box-sizing: border-box;
                float: left;
                padding-top: 40px;

            }

            .data-wrapper .testimonial-details {
                background-color: #252525;
                padding: 25px;
                /* color: #fff; */
                border-radius: 10px;
            }

            .data-wrapper .testimonial-data {
                color: #fff;
            }

            .data-wrapper .quote-wrapper {
                position: absolute;
                z-index: 9;
                right: 0;
            }

            .quote-wrapper img {
                max-width: 90px;
                padding: 10px;
            }

            .quote-wrapper svg {
                width: 72px;
                padding: 10px;
                fill: #fff;
            }

            .data-wrapper .testimonial-title {
                font-size: 21px;
                font-weight: 500;
                margin-bottom: 10px;
                color: #fff;
                margin: 15px 0;
                text-transform: capitalize;
            }

            .data-wrapper .testimonial-desc {
                font-size: 16px;
                margin-bottom: 0;
                color: #fff;
                font-weight: 300;
                padding-bottom: 30px;
            }

            .testimonial-content {
                text-align: center;
                width: 80%;
                padding: 10px 20px;
                display: flex;
                border-radius: 10px;
                cursor: pointer;
            }

            .swiper-slide.swiper-slide-active .testimonial-content {
                background-color: #252525;
                /* border: 1px solid #fff; */
            }

            .testimonial-content .testimonial-image img {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                float: left;
                margin-top: 6px;
            }

            .testimonial-content .info .testimonial-name {
                font-size: 18px;
                font-weight: bold;
                padding: 5px 15px;
                color: #fff;
                margin-bottom: 0;
                text-align: left;
            }

            .testimonial-content .info .testimonial-designation {
                font-size: 14px;
                color: #fff;
                margin-bottom: 0;
                padding: 5px 15px;
                text-align: left;
            }

            .testimonial-text {
                font-size: 14px;
                color: #333;
            }

            .ie-prev-btn svg,
            .ie-next-btn svg {
                width: 12px;
                right: 0;
                top: 5px;
                position: absolute;
                z-index: 99;
                cursor: pointer;
                fill: #fff;
            }

            .ie-prev-btn svg {
                margin-right: 50px;
            }

            .ie-testimonial-nav {
                margin-top: 0px;
                position: absolute;
                left: 100%;
            }

            .iet-nav-bottom-yes .ie-testimonial-nav {
                top: 90%;
            }
        </style>

        <script>
            var testimonialsData = <?php echo json_encode($settings['testimonials_list']); ?>;
            function ieTestimonialSlider() {
                var testimonialSwiper = new Swiper(".ie-testimonial-slider", {
                    spaceBetween: 20,
                    centeredSlides: true,
                    loop: <?php echo $settings['loop'] === 'yes' ? 'true' : 'false'; ?>,
                    autoplay: <?php echo $settings['autoplay'] === 'yes' ? '{ delay: ' . $settings['autoplay_speed']['size'] . ', disableOnInteraction: false }' : 'false'; ?>,
                    speed: 800,
                    slidesPerView: 3,
                    slidesPerGroup: 1,
                    direction: "vertical",
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".ie-next-btn",
                        prevEl: ".ie-prev-btn",
                    },
                    on: {
                        init: function () {
                            // On initialization, set the first testimonial content
                            updateTestimonialContent(0);
                        },
                        slideChangeTransitionEnd: function () {
                            // Update testimonial content when the slide changes
                            var activeIndex = this.realIndex; // Get the current active index
                            updateTestimonialContent(activeIndex);
                        }
                    }
                });
                // Handle click event for .swiper-slide
                document.querySelectorAll('.swiper-slide').forEach(function (slide) {
                    slide.addEventListener('click', function () {
                        // Get the aria-label of the clicked slide and calculate the index
                        var ariaLabel = slide.getAttribute('aria-label');
                        var index = ariaLabel ? parseInt(ariaLabel.substr(0, 1)) - 1 : null;

                        // If index is valid, move to that slide using Swiper's `slideTo` method
                        if (index !== null) {
                            testimonialSwiper.slideToLoop(index); // Swiper will handle the active class and transition

                            // Update the content and rating
                            updateTestimonialContent(index);
                        }
                    });
                });
            }

            document.addEventListener("DOMContentLoaded", function () {
                ieTestimonialSlider();
            });
            ieTestimonialSlider();

            // Function to update testimonial content based on index
            function updateTestimonialContent(index = 0) {
                if (testimonialsData[index]) {
                    // Update testimonial title and text
                    document.querySelector('.data-wrapper .testimonial-data').innerHTML =
                        '<h2 class="testimonial-title">' + testimonialsData[index].testimonial_title + '</h2>' +
                        '<p class="testimonial-desc">' + testimonialsData[index].testimonial_text + '</p>';

                    // Update testimonial rating stars
                    var ratingStarsHtml = renderStars(testimonialsData[index].rating);
                    document.querySelector('.data-wrapper .testimonial-rating').innerHTML = ratingStarsHtml;
                }
            }

            // Function to render stars in JavaScript
            function renderStars(rating) {
                var fullStars = Math.floor(rating);
                var halfStar = (rating - fullStars) >= 0.5 ? true : false;
                var html = '';

                // Add full stars
                for (var i = 0; i < fullStars; i++) {
                    html += '<i class="fas fa-star" ></i>';
                }

                // Add half star if necessary
                if (halfStar) {
                    html += '<i class="fas fa-star-half-alt" ></i>';
                }

                // Add empty stars to make it a total of 5 stars
                for (var i = fullStars + halfStar; i < 5; i++) {
                    html += '<i class="far fa-star" ></i>';
                }

                return html;
            }
        </script>
        <?php
    }

    // Function to render stars
    protected function render_rating_stars($rating)
    {
        $full_stars = floor($rating);
        $half_star = ($rating - $full_stars) >= 0.5 ? true : false;
        $html = '';

        for ($i = 0; $i < $full_stars; $i++) {
            $html .= '<i class="fas fa-star" style="color: #FFD700;"></i>'; // Full star
        }

        if ($half_star) {
            $html .= '<i class="fas fa-star-half-alt" style="color: #FFD700;"></i>'; // Half star
        }

        for ($i = $full_stars + $half_star; $i < 5; $i++) {
            $html .= '<i class="far fa-star" style="color: #FFD700;"></i>'; // Empty star
        }

        return $html;
    }



}

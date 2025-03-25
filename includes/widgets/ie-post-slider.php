<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class IE_Post_Slider extends Widget_Base
{

    public function get_name()
    {
        return 'ie_post_slider';
    }

    public function get_title()
    {
        return __('IE Post Slider', IE_TEXT_DOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-post-slider';
    }

    public function get_categories()
    {
        return ['basic']; // Define the category
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'ie_ps_content_section',
            [
                'label' => __('Content', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        // Post Category Select Control
        $this->add_control(
            'ie_ps_categories',
            [
                'label' => __('Select Categories', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,  // Allow selecting multiple categories
                'options' => $this->get_categories_options(),
                'default' => [],
                'description' => __('Select post categories to display.', IE_TEXT_DOMAIN),
            ]
        );
        $this->add_control(
            'ie_ps_exclude_post_categories',
            [
                'label' => __('Exclude Categories', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,  // Allow selecting multiple categories to exclude
                'options' => $this->get_categories_options(),
                'default' => [],
                'description' => __('Select post categories to exclude.', IE_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'ie_ps_posts_per_page',
            [
                'label' => __('Number of Items', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 9,
                'description' => __('Set the number of portfolio items to display.', IE_TEXT_DOMAIN),
            ]
        );

        // Include Posts Select Control
        $this->add_control(
            'ie_ps_include_posts',
            [
                'label' => __('Include Specific Posts', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_posts_options(),
                'default' => [],
                'description' => __('Manually include specific posts by selecting them.', IE_TEXT_DOMAIN),
            ]
        );

        // Exclude Posts Select Control
        $this->add_control(
            'ie_ps_exclude_posts',
            [
                'label' => __('Exclude Specific Posts', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_posts_options(),
                'default' => [],
                'description' => __('Manually exclude specific posts by selecting them.', IE_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'ie_ps_order',
            [
                'label' => __('Order', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => __('Ascending', IE_TEXT_DOMAIN),
                    'DESC' => __('Descending', IE_TEXT_DOMAIN),
                ],
            ]
        );

        $this->end_controls_section();

        // Section: Navigation Settings
        $this->start_controls_section(
            'ie_ps_navigation_section',
            [
                'label' => __('Navigation', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ie_ps_show_nav',
            [
                'label' => esc_html__('Show Navigation', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('No', IE_TEXT_DOMAIN),
                'label_off' => esc_html__('Yes', IE_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        // Previous Button Icon Control
        $this->add_control(
            'ie_ps_prev_icon',
            [
                'label' => __('Previous Button Icon', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
            ]
        );

        // Next Button Icon Control
        $this->add_control(
            'ie_ps_next_icon',
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
            'ie_ps_loop',
            [
                'label' => __('Loop', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('On', IE_TEXT_DOMAIN),
                'label_off' => __('Off', IE_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'ie_ps_autoplay',
            [
                'label' => __('Autoplay', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('On', IE_TEXT_DOMAIN),
                'label_off' => __('Off', IE_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        // Autoplay Speed Control
        $this->add_control(
            'ie_ps_autoplay_speed',
            [
                'label' => __('Autoplay Speed (ms)', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['ms'],
                'range' => [
                    'ms' => [
                        'min' => 1000,
                        'max' => 10000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'ms',
                    'size' => 5000,
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab for Title Styling
        $this->start_controls_section(
            'ie_ps_style_section',
            [
                'label' => __('Title', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Color Control
        $this->add_control(
            'ie_ps_title_color',
            [
                'label' => __('Title Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#183B56',
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Title Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ie_ps_title_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-title a',
            ]
        );
        // Margin Control (responsive)
        $this->add_responsive_control(
            'ie_ps_title_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Padding Control (responsive)
        $this->add_responsive_control(
            'ie_ps_title_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        // Excerpt Style Tab
        $this->start_controls_section(
            'ie_ps_excerpt_style_section',
            [
                'label' => __('Excerpt', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Excerpt Color Control
        $this->add_control(
            'ie_ps_excerpt_color',
            [
                'label' => __('Excerpt Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#183B56',
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-excerpt a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Excerpt Typography Control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ie_ps_excerpt_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-excerpt a',
            ]
        );
        // Margin Control (responsive)
        $this->add_responsive_control(
            'ie_ps_excerpt_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Padding Control (responsive)
        $this->add_responsive_control(
            'ie_ps_excerpt_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        // Author Info Style Tab
        $this->start_controls_section(
            'ie_ps_author_style_section',
            [
                'label' => __('Author', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ie_ps_author_name_color',
            [
                'label' => __('Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-meta .post-author a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ie_ps_author_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-meta .post-author a',
            ]
        );
        $this->add_responsive_control(
            'ie_ps_author_name_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-meta .post-author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ie_ps_author_name_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-meta .post-author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ie_ps_verified_text_color',
            [
                'label' => __('Verified Text Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .post-meta .post-author .verified-txt' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ie_ps_author_verified_bg_color',
            [
                'label' => __('Verified Icon Background Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#36B37E',
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .post-meta .post-author .verified-txt .verified-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ie_ps_author_verified_typography',
                'label' => __('Verified Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .post-meta .post-author .verified-txt',
            ]
        );


        $this->add_responsive_control(
            'ie_ps_verified_margin',
            [
                'label' => esc_html__('Verified Margin', 'textdomain'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .post-meta .post-author .verified-txt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ie_ps_verified_padding',
            [
                'label' => esc_html__('Verified Padding', 'textdomain'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .post-meta .post-author .verified-txt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Date Style Tab
        $this->start_controls_section(
            'ie_ps_date_style_section',
            [
                'label' => __('Date', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ie_ps_date_color',
            [
                'label' => __('Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-meta .post-date a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ie_ps_date_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-meta .post-date a',
            ]
        );
        $this->add_responsive_control(
            'ie_ps_date_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-meta .post-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ie_ps_date_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-meta .post-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Category Typography Control
        $this->start_controls_section(
            'ie_ps_cat_style_section',
            [
                'label' => __('Category', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ie_ps_cat_color',
            [
                'label' => __('Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-category .post-categories li a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ie_ps_cat_bg_color',
            [
                'label' => __('Background Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#efefef',
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-category .post-categories li a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ie_ps_cat_border_radius',
            [
                'label' => __('Border Radius', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-category .post-categories li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ie_ps_cat_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-category .post-categories li a',
            ]
        );
        $this->add_responsive_control(
            'ie_ps_cat_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-category .post-categories li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ie_ps_cat_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .swiper-slide .post-slide-content .post-info .post-category .post-categories li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Wrapper Control
        $this->start_controls_section(
            'ie_ps_wrapper_style_section',
            [
                'label' => __('Wrapper', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Border Control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_gallery_border',
                'label' => __('Border', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} ',
            ]
        );
        // Border Radius Control
        $this->add_responsive_control(
            'ie_ps_wrapper_border_radius',
            [
                'label' => __('Border Radius', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'default' => [
                    'top' => 15,
                    'right' => 15,
                    'bottom' => 15,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Shadow Control
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_shadow',
                'label' => __('Container Shadow', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} ',
            ]
        );

        $this->end_controls_section();




        // Navigation Typography Control
        $this->start_controls_section(
            'ie_ps_nav_style_section',
            [
                'label' => __('Navigation', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ie_ps_icon_color',
            [
                'label' => __('Icon Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-prev i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-next i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-prev svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-next svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ie_ps_icon_bg_color',
            [
                'label' => __('Icon Background Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '#efefef',
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-prev i' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-next i' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-prev svg' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-next svg' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ie_ps_icon_size',
            [
                'label' => __('Icon Size (px)', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-prev svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-next svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-prev i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-next i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ie_ps_icon_border_radius',
            [
                'label' => __('Border Radius', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [

                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-prev svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-next svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-prev i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-next i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'left_arrow_x_position',
            [
                'label' => __('Left Arrow X Position', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-prev' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        $this->add_control(
            'right_arrow_x_position',
            [
                'label' => __('Right Arrow X Position', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-next' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );
        // Icon Padding 
        $this->add_responsive_control(
            'ie_ps_icon_padding',
            [
                'label' => __('Arrow Padding (px)', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-prev svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .ie-case-studies-slider-wrapper{{ID}} .ie-ps-next svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function get_categories_options()
    {
        $categories = get_categories(); // Get WordPress categories
        $options = [];

        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }

        return $options;
    }
    private function get_posts_options()
    {
        $posts = get_posts([
            'post_type' => 'post',
            'posts_per_page' => -1,
        ]);

        $options = [];
        foreach ($posts as $post) {
            $options[$post->ID] = $post->post_title;
        }

        return $options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget = $this->get_data();
        $unique_id = $widget['id'];
        $include_posts = $settings['ie_ps_include_posts'] ? $settings['ie_ps_include_posts'] : [];
        $exclude_posts = $settings['ie_ps_exclude_posts'] ? $settings['ie_ps_exclude_posts'] : [];
        $show_nav = $settings['ie_ps_show_nav'];



        $query_args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['ie_ps_posts_per_page'],
            'orderby' => 'date',
            'order' => $settings['ie_ps_order'],
            'category__in' => !empty($settings['ie_ps_categories']) ? $settings['ie_ps_categories'] : '',
            'category__not_in' => !empty($settings['ie_ps_exclude_post_categories']) ? $settings['ie_ps_exclude_post_categories'] : '',
            'post__in' => !empty($include_posts) ? $include_posts : '',
            'post__not_in' => !empty($exclude_posts) ? $exclude_posts : '',
        ];

        // WP Query to fetch posts
        $query = new WP_Query($query_args);

        if ($query->have_posts()) {
            echo '<div class="ie-case-studies-slider-wrapper' . $unique_id . '">';
            echo '<div class="swiper-wrapper">';
            while ($query->have_posts()) {
                $query->the_post();
                ?>
                <div class="swiper-slide">
                    <div class="post-slide-content">
                        <div class="post-image">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                        </div>
                        <div class="post-info">
                            <div class="post-category"><?php the_category(); ?></div>
                            <h2 class="post-title"><a
                                    href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 10, '...'); ?></a></h2>
                            <p class="post-excerpt"><a
                                    href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></a></p>
                            <div class="post-meta">
                                <span class="post-author"><?php echo do_shortcode('[user_profile]'); ?></span>
                                <!-- <span class="post-date"><?php echo get_the_date('j F Y'); ?></span> -->
                                <span class="post-date">
                                    <a
                                        href="<?php echo esc_url(get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'))); ?>">
                                        <?php echo get_the_date('j F Y'); ?>
                                    </a>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }

            echo '</div>'; // end swiper-wrapper
            // Navigation buttons
            if ($show_nav === 'yes') {
                // echo '<div class="swiper-navigation" style="margin-top: 30px">';
                echo '<div class="ie-ps-prev">';
                if (isset($settings['ie_ps_prev_icon']) && !empty($settings['ie_ps_prev_icon']['value'])) {
                    Icons_Manager::render_icon($settings['ie_ps_prev_icon'], ['aria-hidden' => 'true']);
                } else {
                    echo '<i class="fa-solid fa-chevron-left"></i>'; // Fallback icon
                }
                echo '</div>';
                echo '<div class="ie-ps-next">';
                if (isset($settings['ie_ps_next_icon']) && !empty($settings['ie_ps_next_icon']['value'])) {
                    Icons_Manager::render_icon($settings['ie_ps_next_icon'], ['aria-hidden' => 'true']);
                } else {
                    echo '<i class="fa-solid fa-chevron-right"></i>'; // Fallback icon
                }
                echo '</div>';
                // echo '</div>'; // swiper-navigation
            }
            echo '</div>'; // end ie-case-studies-slider-wrapper


        }

        wp_reset_postdata();
        ?>
        <style>
            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> {
                width: 100%;
                height: auto;
                overflow: hidden;
                border-radius: 15px;
                ;
                /* box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); */
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .swiper-slide {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0;
                background-color: #fff;
                /* border-radius: 15px; */
                /* overflow: hidden; */
                height: 400px;
                /* box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); */
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .post-slide-content {
                display: flex;
                flex-direction: row;
                height: 100%;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .post-image {
                width: 50%;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .post-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                /* border-radius: 10px; */
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .post-info {
                width: 50%;
                padding: 30px 30px 20px 30px;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .post-title {
                font-size: 24px;
                font-weight: 700;
                margin-bottom: 10px;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .post-meta {
                font-size: 14px;
                color: #888;
                margin-top: 10px;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .swiper-slide .post-slide-content .post-info .post-meta {
                position: absolute;
                bottom: 20px;
                width: 500px;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .post-meta .post-author img {
                border-radius: 50%;
                margin-right: 10px;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .post-meta .post-date {
                float: right;
                margin-top: -30px;
                margin-right: -20px;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .post-categories {
                list-style: none;
                margin-left: 0;
                display: flex;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .post-categories a {
                margin: 0 5px;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .swiper-button-next::after {
                font-size: 12px;
                background-color: #008089;
                padding: 13px 16px;
                border-radius: 50%;
                color: #fff;
                margin-left: 51px;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .swiper-button-prev::after {
                font-size: 12px;
                background-color: #008089;
                padding: 13px 16px;
                border-radius: 50%;
                color: #fff;
                margin-left: -49px;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .ie-ps-prev,
            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .ie-ps-next {
                position: absolute;
                z-index: 99;
                top: 50%;
                cursor: pointer;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .ie-ps-prev svg,
            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .ie-ps-next svg {
                width: 14px;
            }

            .ie-case-studies-slider-wrapper<?php echo $unique_id; ?> .ie-ps-next {
                right: 0;
            }

            .ie-case-studies-slider-wrapper<?php echo esc_attr($unique_id); ?> .profile-pic {
                width: 40px;
                height: 40px !important;
                border-radius: 50% !important;
                object-fit: cover;
                background-color: #ddd;
                margin-top: 5px;
            }

            .ie-case-studies-slider-wrapper<?php echo esc_attr($unique_id); ?> .post-author {
                display: flex;
                width: fit-content;
            }

            .ie-case-studies-slider-wrapper<?php echo esc_attr($unique_id); ?> .user-name {
                font-size: 16px;
                font-weight: 600;
                margin-bottom: 0;
                margin-left: 10px;
            }

            .ie-case-studies-slider-wrapper<?php echo esc_attr($unique_id); ?> .verified-txt {
                color: #777;
                font-size: 14px;
                font-weight: 400;
                font-style: italic;
                margin-bottom: 0;
                padding-left: 10px;
            }

            .ie-case-studies-slider-wrapper<?php echo esc_attr($unique_id); ?> .verified-icon {
                background-color: #36B37E;
                padding: 0px 4px;
                border-radius: 50%;
            }

            .ie-case-studies-slider-wrapper<?php echo esc_attr($unique_id); ?> .verified-icon svg {
                width: 10px;
                fill: #fff;
            }
        </style>
        <script>
            function iePostSlider() {
                var autoplayConfig = false;

                // Check if autoplay is enabled in the settings
                <?php if ($settings['ie_ps_autoplay'] === 'yes'): ?>
                    autoplayConfig = {
                        delay: <?php echo $settings['ie_ps_autoplay_speed']['size']; ?>, // Delay in ms
                        disableOnInteraction: false // Keeps autoplay running even after user interactions
                    };
                <?php endif; ?>

                var swiper = new Swiper('.ie-case-studies-slider-wrapper<?php echo $unique_id; ?>', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: <?php echo $settings['ie_ps_loop'] === 'yes' ? 'true' : 'false'; ?>,
                    autoplay: autoplayConfig, // Only applies autoplay if enabled
                    navigation: {
                        nextEl: '.ie-ps-next',
                        prevEl: '.ie-ps-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            }

            document.addEventListener("DOMContentLoaded", function () {
                iePostSlider();
            });
            iePostSlider();

        </script>

        <?php
    }

}

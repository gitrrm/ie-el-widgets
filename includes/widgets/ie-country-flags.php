<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class IE_Country_Flags extends Widget_Base
{
    public function get_name()
    {
        return 'ie_country_flags';
    }

    public function get_title()
    {
        return __('IE Country Flags', IE_TEXT_DOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-flag';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Country Flags', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        // Repeater: Country Flag
        $repeater->add_control(
            'country_flag',
            [
                'label' => __('Country Flag', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Repeater: Country Name
        $repeater->add_control(
            'country_name',
            [
                'label' => __('Country Name', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => __('Country Name', IE_TEXT_DOMAIN),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'countries_list',
            [
                'label' => __('Countries', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'country_name' => __('United States', IE_TEXT_DOMAIN),
                        'country_flag' => ['url' => Utils::get_placeholder_image_src()],
                    ],
                    [
                        'country_name' => __('United Kingdom', IE_TEXT_DOMAIN),
                        'country_flag' => ['url' => Utils::get_placeholder_image_src()],
                    ],
                ],
                'title_field' => '{{{ country_name }}}',
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
        $this->add_control(
            'animation_type',
            [
                'label' => __('Animation Type', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __('Slide', IE_TEXT_DOMAIN),
                    'fade' => __('Fade', IE_TEXT_DOMAIN),
                    'flip' => __('Flip', IE_TEXT_DOMAIN),
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Title', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Country Name Color
        $this->add_control(
            'country_name_color',
            [
                'label' => __('Country Name Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #ie-country-flags-{{ID}} .country-name' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Country Name Typography
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'country_name_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} #ie-country-flags-{{ID}} .country-name',
            ]
        );
        $this->add_responsive_control(
            'country_name_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} #ie-country-flags-{{ID}} .country-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'country_name_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} #ie-country-flags-{{ID}} .country-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'flag_style_section',
            [
                'label' => __('Flags', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        // Responsive Control for Flag Width
        $this->add_responsive_control(
            'flag_width',
            [
                'label' => __('Flag Width', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 500,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #ie-country-flags-{{ID}} .flag-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        // Border Control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ie_flags_border',
                'label' => __('Border', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} #ie-country-flags-{{ID}} .flag-image img',
            ]
        );
        // Border radius
        $this->add_responsive_control(
            'ie_flag_border_radius',
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
                    '{{WRAPPER}} #ie-country-flags-{{ID}} .flag-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ie_country_flag_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} #ie-country-flags-{{ID}} .flag-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'ie_country_flag_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} #ie-country-flags-{{ID}} .flag-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ie_country_flag_shadow',
                'label' => __('Shadow', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} #ie-country-flags-{{ID}} .flag-image img',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $unique_id = $this->get_id(); // Unique ID for Swiper instance

        if (!empty($settings['countries_list'])) {
            echo '<div class="swiper-container ie-country-flags" id="ie-country-flags-' . esc_attr($unique_id) . '">';
            echo '<div class="swiper-wrapper">';
            foreach ($settings['countries_list'] as $country) {
                $flag_image = $country['country_flag']['url'];
                $country_name = $country['country_name'];
                ?>
                <div class="swiper-slide country-item">
                    <div class="flag-image">
                        <img src="<?php echo esc_url($flag_image); ?>" alt="<?php echo esc_attr($country_name); ?>">
                    </div>
                    <div class="country-name">
                        <?php echo esc_html($country_name); ?>
                    </div>
                </div>
                <?php
            }
            echo '</div>';
            // Add navigation arrows
            if ($settings['show_nav'] === 'yes'): ?>
                <div class="ie-flag-button-prev">
                    <?php Icons_Manager::render_icon($settings['prev_icon'], ['aria-hidden' => 'true']); ?>
                </div>
                <div class="ie-flag-button-next">
                    <?php Icons_Manager::render_icon($settings['next_icon'], ['aria-hidden' => 'true']); ?>
                </div>
            <?php endif;
            echo '</div>';
        }
        ?>

        <style>
            #ie-country-flags-<?php echo esc_attr($unique_id); ?> {
                width: 100%;
                height: auto;
                overflow: hidden;
            }

            #ie-country-flags-<?php echo esc_attr($unique_id); ?> .swiper-slide {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
            }

            #ie-country-flags-<?php echo esc_attr($unique_id); ?> .flag-image img {
                height: auto;
                max-height:260px;
            }

            #ie-country-flags-<?php echo esc_attr($unique_id); ?> .country-name {
                margin-top: 10px;
                font-size: 16px;
            }

            #ie-country-flags-<?php echo esc_attr($unique_id); ?> .ie-flag-button-next svg {
                width: 12px;
                right: 0;
                top: 15px;
                position: absolute;
                z-index: 99;
                cursor: pointer;
            }

            #ie-country-flags-<?php echo esc_attr($unique_id); ?> .ie-flag-button-prev svg {
                width: 12px;
                top: 15px;
                position: absolute;
                z-index: 99;
                cursor: pointer;
            }
        </style>

        <script>
            const ieCountryFlags = function () {
                var animationEffect = '<?php echo esc_js($settings['animation_type']); ?>';

                var swiperOptions = {
                    loop: true,
                    autoplay: <?php echo $settings['autoplay'] === 'yes' ? '{ delay: ' . $settings['autoplay_speed']['size'] . ' }' : 'false'; ?>,
                    speed: 1000,
                    navigation: {
                        nextEl: '.ie-flag-button-next',
                        prevEl: '.ie-flag-button-prev',
                    }
                };

                // Handle animation type conditionally
                if (animationEffect === 'fade') {
                    swiperOptions.effect = 'fade';
                    swiperOptions.fadeEffect = {
                        crossFade: true
                    };
                } else {
                    swiperOptions.effect = animationEffect; // For slide, cube, coverflow, etc.
                }

                var swiper = new Swiper('#ie-country-flags-<?php echo esc_js($unique_id); ?>', swiperOptions);
            };


            document.addEventListener("DOMContentLoaded", function () {
                ieCountryFlags();
            });
            ieCountryFlags();
        </script>
        <?php
    }
}

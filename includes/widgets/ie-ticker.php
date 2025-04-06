<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class IE_Text_Slider extends Widget_Base
{
    public function get_name()
    {
        return 'ie_text_slider';
    }

    public function get_title()
    {
        return __('IE Text Slider', IE_TEXT_DOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-animation-text';
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
                'label' => __('Content', IE_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        // Repeater: Sentence Text
        $repeater->add_control(
            'sentence_text',
            [
                'label' => __('Sentence', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => __('Default Sentence', IE_TEXT_DOMAIN),
                'label_block' => true,
            ]
        );


        $this->add_control(
            'sentences_list',
            [
                'label' => __('Sentences with Icons', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'sentence_text' => __('Trusted by Global Business', IE_TEXT_DOMAIN),
                    ],
                    [
                        'sentence_text' => __('Transform Your Business with Our Comprehensive Solutions', IE_TEXT_DOMAIN),
                    ],
                ],
                'title_field' => '{{{ sentence_text }}}',
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

        $this->add_control(
            'ie_ts_title_color',
            [
                'label' => __('Title Color', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #ie-ts-slider-{{ID}} .slider-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} #ie-ts-slider-{{ID}} .slider-content .slider-title',
            ]
        );
        // Margin Control (responsive)
        $this->add_responsive_control(
            'ie_ts_title_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} #ie-ts-slider-{{ID}} .slider-content .slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Padding Control (responsive)
        $this->add_responsive_control(
            'ie_ts_title_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} #ie-ts-slider-{{ID}} .slider-content .slider-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $unique_id = $this->get_id();

        ?>
        <div class="ie-ts-slider-wrapper swiper-container" id="ie-ts-slider-<?php echo esc_attr($unique_id); ?>">
            <div class="swiper-wrapper">
                <?php
                $index = 1; // Initialize the counter
                foreach ($settings['sentences_list'] as $item):
                    ?>
                    <div class="swiper-slide">
                        <div class="slider-content">
                            <h3 class="slider-title">
                                <?php echo wp_kses_post($item['sentence_text']); ?>
                            </h3>
                        </div>
                    </div>
                    <?php
                    $index++; // Increment the counter after each loop iteration
                endforeach;
                ?>
            </div>
            <?php if ($settings['show_nav'] === 'yes'): ?>
                <div class="ie-ts-button-prev">
                    <?php \Elementor\Icons_Manager::render_icon($settings['prev_icon'], ['aria-hidden' => 'true']); ?>
                </div>
                <div class="ie-ts-button-next">
                    <?php \Elementor\Icons_Manager::render_icon($settings['next_icon'], ['aria-hidden' => 'true']); ?>
                </div>
            <?php endif; ?>
        </div>

        <style>
            #ie-ts-slider-<?php echo esc_attr($unique_id); ?> {
                width: 100%;
                height: auto;
                overflow: hidden;
                /* border-radius: 15px; */
            }

            #ie-ts-slider-<?php echo esc_attr($unique_id); ?> .swiper-slide {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0;
            }

            #ie-ts-slider-<?php echo esc_attr($unique_id); ?> .slider-index {
                font-size: 18px;
                background-color: #008080;
                color: #fff;
                padding: 4px 14px;
                border-radius: 50%;
                position: absolute;
                top: 0;
                margin-left: -60px;
                /* width: 40px;
                height: 40px; */
            }

            #ie-ts-slider-<?php echo esc_attr($unique_id); ?> .slider-content,
            #ie-ts-slider-<?php echo esc_attr($unique_id); ?> .slider-content .slider-title {
                width: 100%;
                text-align: center;
            }

            #ie-ts-slider-<?php echo esc_attr($unique_id); ?> .slider-content .slider-title svg {
                width: 20px;
                margin-right: 10px;
                ;
            }



            #ie-ts-slider-<?php echo esc_attr($unique_id); ?> .ie-ts-button-next svg {
                width: 12px;
                right: 0;
                top: 5px;
                position: absolute;
                z-index: 99;
                cursor: pointer;
            }

            #ie-ts-slider-<?php echo esc_attr($unique_id); ?> .ie-ts-button-prev svg {
                width: 12px;
                top: 5px;
                position: absolute;
                z-index: 99;
                cursor: pointer;
            }
        </style>

        <script>
            function ieTextSlider() {
                var animationEffect = '<?php echo esc_js($settings['animation_type']); ?>';

                var swiperOptions = {
                    loop: true,
                    autoplay: <?php echo $settings['autoplay'] === 'yes' ? '{ delay: ' . $settings['autoplay_speed']['size'] . ' }' : 'false'; ?>,
                    speed: 1000,
                    navigation: {
                        nextEl: '.ie-ts-button-next',
                        prevEl: '.ie-ts-button-prev',
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

                var swiper = new Swiper('#ie-ts-slider-<?php echo esc_js($unique_id); ?>', swiperOptions);
            };


            document.addEventListener("DOMContentLoaded", function () {
                ieTextSlider();
            });
            ieTextSlider();
        </script>
        <?php
    }
}

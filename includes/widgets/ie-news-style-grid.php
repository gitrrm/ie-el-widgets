<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use Elementor\Group_Control_Dimensions;
class IE_News_Style_Grid extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'ie_news_style_grid';
    }

    public function get_title()
    {
        return __('IE News Style Grid', IE_TEXT_DOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', IE_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Post Category Select Control
        $this->add_control(
            'post_categories',
            [
                'label' => __('Select Categories', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,  // Allow selecting multiple categories
                'options' => $this->get_categories_options(),
                'default' => [],
                'description' => __('Select post categories to display.', IE_TEXT_DOMAIN),
            ]
        );
        $this->add_control(
            'exclude_categories',
            [
                'label' => __('Exclude Categories', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,  // Allow selecting multiple categories to exclude
                'options' => $this->get_categories_options(),
                'default' => [],
                'description' => __('Select post categories to exclude.', IE_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Items', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
                'min' => 2,
                'max' => 5,
                'description' => __('Set the number of portfolio items to display.', IE_TEXT_DOMAIN),
            ]
        );

        // Include Posts Select Control
        $this->add_control(
            'include_posts',
            [
                'label' => __('Include Specific Posts', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_posts_options(),
                'default' => [],
                'description' => __('Manually include specific posts by selecting them.', IE_TEXT_DOMAIN),
            ]
        );

        // Exclude Posts Select Control
        $this->add_control(
            'exclude_posts',
            [
                'label' => __('Exclude Specific Posts', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_posts_options(),
                'default' => [],
                'description' => __('Manually exclude specific posts by selecting them.', IE_TEXT_DOMAIN),
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => __('Ascending', IE_TEXT_DOMAIN),
                    'DESC' => __('Descending', IE_TEXT_DOMAIN),
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab for Title Styling
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => __('Big Image Title', IE_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Color Control
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-one .detail-holder h4 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Title Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-one .detail-holder h4 a',
            ]
        );
        // Margin Control (responsive)
        $this->add_responsive_control(
            'margin',
            [
                'label' => esc_html__('Margin', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-one .detail-holder h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Padding Control (responsive)
        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-one .detail-holder h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'row2_title_style_section',
            [
                'label' => __('Small Image Title', IE_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Color Control
        $this->add_control(
            'title_row2_color',
            [
                'label' => __('2nd Row Title Color', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-two .detail-holder h4 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Title Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'row2_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-two .detail-holder h4 a',
            ]
        );
        $this->add_responsive_control(
            'margin2',
            [
                'label' => esc_html__('Margin', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-two .detail-holder h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'padding2',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-two .detail-holder h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Author Info Style Tab
        $this->start_controls_section(
            'author_style_section',
            [
                'label' => __('Author', IE_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'author_name_color',
            [
                'label' => __('Author Name Color', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .detail-holder .author-info .author-name .user-name a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'label' => __('Author Name Typography', IE_TEXT_DOMAIN),
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .detail-holder .author-info .author-name .user-name a',
                    // '{{WRAPPER}} {{WRAPPER}} .post-grid{{ID}} .work-masonry-layout{{ID}}  .detail-holder .author-info .author-name a',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_name_margin',
            [
                'label' => esc_html__('Author Name Margin', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .detail-holder .author-info .author-name .user-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'author_name_padding',
            [
                'label' => esc_html__('Author Name Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .detail-holder .author-info .author-name .user-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'verified_text_color',
            [
                'label' => __('Verified Text Color', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .detail-holder .author-info .author-name .verified-txt' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'pg_author_verified_bg_color',
            [
                'label' => __('Verified Icon Background Color', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#36B37E',
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}}  .detail-holder .author-info .author-name .verified-txt .verified-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'news_author_verified_typography',
                'label' => __('Verified Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .work-masonry-layout{{ID}}  .detail-holder .author-info .author-name .verified-txt',
            ]
        );


        $this->add_responsive_control(
            'verified_margin',
            [
                'label' => esc_html__('Verified Margin', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}}  .detail-holder .author-info .author-name .verified-txt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'verified_padding',
            [
                'label' => esc_html__('Verified Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}}  .detail-holder .author-info .author-name .verified-txt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Date Style Tab
        $this->start_controls_section(
            'date_style_section',
            [
                'label' => __('Date', IE_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'date_color',
            [
                'label' => __('Date Color', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .detail-holder .author-info .last-updated a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .work-masonry-layout{{ID}} .detail-holder .author-info .last-updated a',
            ]
        );
        $this->add_responsive_control(
            'date_margin',
            [
                'label' => esc_html__('Margin - Row 1', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-one .detail-holder .author-info .last-updated' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'date_padding',
            [
                'label' => esc_html__('Padding - Row 1', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-one .detail-holder .author-info .last-updated' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'date_row2_margin',
            [
                'label' => esc_html__('Margin - Row 2', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-two .detail-holder .author-info .last-updated' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'date_row2_padding',
            [
                'label' => esc_html__('Padding - Row 2', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .img-container-grid-two .detail-holder .author-info .last-updated' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Category Typography Control
        $this->start_controls_section(
            'cat_style_section',
            [
                'label' => __('Category', IE_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'cat_color',
            [
                'label' => __('Category Color', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .category-list .post-category' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'cat_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .work-masonry-layout{{ID}} .category-list .post-category',
            ]
        );
        $this->add_responsive_control(
            'cat_margin',
            [
                'label' => esc_html__('Margin', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .category-list .post-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'cat_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .work-masonry-layout{{ID}} .category-list .post-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $include_posts = $settings['include_posts'] ? $settings['include_posts'] : [];
        $exclude_posts = $settings['exclude_posts'] ? $settings['exclude_posts'] : [];
        $widget = $this->get_data();
        $unique_id = $widget['id'];

        // Setup WP Query
        $query_args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => 'date',
            'order' => $settings['order'],
            'category__in' => !empty($settings['post_categories']) ? $settings['post_categories'] : '',
            'category__not_in' => !empty($settings['exclude_categories']) ? $settings['exclude_categories'] : '',
            'post__in' => !empty($include_posts) ? $include_posts : '',
            'post__not_in' => !empty($exclude_posts) ? $exclude_posts : '',
        ];

        $query = new WP_Query($query_args);
        $count = 0;

        if ($query->have_posts()):
            ?>
            <div class="work-masonry-layout<?php echo esc_attr($unique_id); ?>">
                <div class="container">
                    <?php
                    while ($query->have_posts()):
                        $query->the_post();

                        // Generate excerpt dynamically
                        $excerpt_word_count = !empty($settings['excerpt_word_count']) ? $settings['excerpt_word_count'] : 20;
                        $content = get_the_content(); // Get full post content for current post
                        $excerpt = wp_trim_words(strip_shortcodes($content), $excerpt_word_count); // Trim content and remove shortcodes
        
                        // Display different layout based on $count
                        if ($count === 0 || $count === 1):
                            if ($count === 0) {
                                $img_container_class = 'img-container-grid-one left';
                            }
                            if ($count === 1) {
                                $img_container_class = 'img-container-grid-one right';
                            }
                            ?>

                            <div class="<?php echo esc_attr($img_container_class); ?>">
                                <div class="category-list">
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        foreach ($categories as $category) {
                                            $category_link = get_category_link($category->term_id);
                                            echo '<a href="' . esc_url($category_link) . '" class="post-category">' . esc_html($category->name) . '</a>';
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- <a href="<?php the_permalink(); ?>" class="work-detail"> -->
                                <a href="<?php the_permalink(); ?>"><img class="img-grid-c"
                                        src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>"
                                        alt="<?php the_title_attribute(); ?>" /></a>

                                <div class="overlay-detail">
                                    <div class="detail-holder">
                                        <h4 class="title"><a
                                                href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 9, '...'); ?></a>
                                        </h4>
                                        <div class="author-info">
                                            <span class="author-name"><?php echo do_shortcode('[user_profile]'); ?></span>
                                            <span class="last-updated">
                                                <?php if (get_the_date()): ?>
                                                    <a
                                                        href="<?php echo esc_url(get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'))); ?>">
                                                        <?php echo get_the_modified_date('j F Y'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- </a> -->
                            </div>
                        <?php endif; ?>

                        <?php if ($count === 2 || $count === 3 || $count === 4):
                            if ($count === 2) {
                                $img_container_class = 'img-container-grid-two left';
                            }
                            if ($count === 3) {
                                $img_container_class = 'img-container-grid-two middle';
                            }
                            if ($count === 4) {
                                $img_container_class = 'img-container-grid-two right';
                            }
                            ?>
                            <div class="<?php echo esc_attr($img_container_class); ?>">
                                <div class="category-list">
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        foreach ($categories as $category) {
                                            $category_link = get_category_link($category->term_id);
                                            echo '<a href="' . esc_url($category_link) . '" class="post-category">' . esc_html($category->name) . '</a>';
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- <a href="<?php the_permalink(); ?>" class="work-detail"> -->
                                <img class="img-grid-c" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>"
                                    alt="<?php the_title_attribute(); ?>" />

                                <div class="overlay-detail">
                                    <div class="detail-holder">
                                        <h4 class="title"><a
                                                href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 6, '...'); ?></a>
                                        </h4>
                                        <div class="author-info">
                                            <span class="author-name"><?php echo do_shortcode('[user_profile]'); ?></span>
                                            <span class="last-updated">
                                                <?php if (get_the_date()): ?>
                                                    <a
                                                        href="<?php echo esc_url(get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'))); ?>">
                                                        <?php echo get_the_modified_date('j F Y'); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                                <!-- </a> -->
                            </div>
                        <?php endif;
                        $count++;
                    endwhile;
                    ?>
                </div>
            </div><!-- //.container -->
            <?php
            wp_reset_postdata(); // Reset post data after the loop
        else:
            echo '<p>' . esc_html__('No post items found.', IE_TEXT_DOMAIN) . '</p>';
        endif;
        ?>
        <style>
            .work-masonry-layout<?php echo esc_attr($unique_id); ?> {
                height: 100%;
                display: grid;
                grid-template-columns: 1fr;
                grid-template-rows: 1fr;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-one {
                width: 48.3%;
                display: inline-block;
                height: 560px;
                border-radius: 15px;
                overflow: hidden;
                position: relative;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-one.right {
                margin-left: 20px;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-two {
                display: inline-block;
                height: 420px;
                width: 31.55%;
                margin-top: 15px;
                border-radius: 15px;
                overflow: hidden;
                position: relative;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-two.middle {
                margin: 0 18px
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-grid-c {
                width: 100%;
                height: 100% !important;
                object-fit: cover;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-one a,
            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-two a {
                position: relative;
                /* width: 100%; */
                height: 100%;
                /* display: block; */
            }

            /* .work-masonry-layout<?php echo esc_attr($unique_id); ?> .work-detail {
                                overflow: hidden;
                            } */

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .profile-pic {
                width: 40px;
                height: 40px !important;
                border-radius: 50% !important;
                object-fit: cover;
                background-color: #ddd;
                margin-top: 5px;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .user-name {
                font-size: 16px;
                font-weight: 600;
                margin-bottom: 0;
                margin-left: 10px;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .verified-txt {
                color: #fff;
                font-size: 14px;
                font-weight: 600;
                font-style: italic;
                margin-bottom: 0;
                padding-left: 10px;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .verified-icon {
                background-color: #36B37E;
                padding: 0px 4px;
                border-radius: 50%;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .verified-icon svg {
                width: 10px;
                fill: #fff;
            }



            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .category-list {
                position: absolute;
                top: 10px;
                left: 20px;
                z-index: 9;
                width: fit-content;
                /* display: flex; */
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .post-category {
                display: inline-block;
                background-color: #fff;
                color: #008080;
                padding: 0px 9px 5px 10px;
                border-radius: 20px;
                margin-right: 5px;
                margin-top: 15px;
                font-size: 13px;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .overlay-detail {
                position: absolute;
                width: 100%;
                padding: 20px;
                height: 100%;
                top: 0;
                display: flex;
                justify-content: start;
                /* align-items: end; */
                background: linear-gradient(360deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.036) 100%);
                transition: all 1s ease-in-out;
                opacity: 1;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .detail-holder {
                position: absolute;
                top: 75%;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-two .detail-holder {
                top: 60%;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .detail-holder .author-info {
                display: flex;
                align-items: center;
                margin-top: 10px;
                position: absolute;
                width: 100%;
                top: 70px;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-two .author-info {
                top: 100px;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .detail-holder .author-info img {
                border-radius: 50%;
                margin-right: 10px;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .detail-holder .author-info .author-name {
                color: #ffffff;
                font-size: 14px;
                text-transform: capitalize;
                width: 200px;
                white-space: nowrap;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .detail-holder .author-info .last-updated {
                margin-left: -15%;
                color: #5A7184;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-one .detail-holder .author-info .last-updated {
                margin-left: 25%;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-two .detail-holder .title {
                line-height: normal;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .overlay-detail h4 {
                color: #ffffff;
                line-height: 21px;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .overlay-detail p {
                color: #ffffff;
                line-height: 20px;
            }

            .work-masonry-layout<?php echo esc_attr($unique_id); ?> .overlay-detail:hover {
                background: linear-gradient(360deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0) 100%);
            }

            @media (max-width: 992px) {
                .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-one {
                    height: 300px;
                }

                .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-two {
                    height: 160px;
                }
            }

            @media (max-width: 767px) {
                .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-one {
                    width: 100%;
                    height: 360px;
                }

                .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-one.right {
                    margin-left: 0;
                }

                .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-two {
                    width: 48.1%;
                    height: 210px;
                }

                .work-masonry-layout<?php echo esc_attr($unique_id); ?> .img-container-grid-two.middle {
                    margin: 0 10px;
                }
            }
        </style>
        <?php
    }
}

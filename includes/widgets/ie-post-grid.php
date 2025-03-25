<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


class IE_Post_Grid extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'ie_post_grid';
    }

    public function get_title()
    {
        return __('IE Post Grid', IE_TEXT_DOMAIN);
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
            'post_grid_content_section',
            [
                'label' => __('Content', IE_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'pg_layout_type',
            [
                'label' => __('Layout Type', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '2-column' => __('2 Column', 'plugin-name'),
                    '3-column' => __('3 Column', 'plugin-name'),
                    '4-column' => __('4 Column', 'plugin-name'),
                ],
                'default' => '3-column',
            ]
        );
        // Post Category Select Control
        $this->add_control(
            'post_grid_categories',
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
            'exclude_post_categories',
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
                'default' => 3,
                'min' => 1,
                'max' => 9,
                'description' => __('Set the number of portfolio items to display.', IE_TEXT_DOMAIN),
            ]
        );

        // Include Posts Select Control
        $this->add_control(
            'include_posts_grid',
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
            'exclude_posts_grid',
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
            'post_grid_style_section',
            [
                'label' => __('Title', IE_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Color Control
        $this->add_control(
            'pg_title_color',
            [
                'label' => __('Title Color', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .post-details .post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Title Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .post-grid{{ID}} .post-details .post-title a',
            ]
        );
        // Margin Control (responsive)
        $this->add_responsive_control(
            'pg_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .post-details .post-title a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Padding Control (responsive)
        $this->add_responsive_control(
            'pg_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .post-details .post-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();


        // Author Info Style Tab
        $this->start_controls_section(
            'pg_author_style_section',
            [
                'label' => __('Author', IE_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'pg_author_name_color',
            [
                'label' => __('Name & Verified Text Color', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .post-meta .post-author .user-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .post-grid{{ID}} .post-meta .post-author .verified-txt' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .post-grid{{ID}} .post-meta .post-author .verified-txt .verified-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'pg_author_typography',
                'label' => __('Author Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .post-grid{{ID}} .post-meta .post-author .user-name',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'pg_author_verified_typography',
                'label' => __('Verified Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .post-grid{{ID}} .post-meta .post-author .verified-txt',
            ]
        );
        $this->add_responsive_control(
            'pg_author_name_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .post-meta .post-author .user-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pg_author_name_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .post-meta .post-author .user-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Date Style Tab
        $this->start_controls_section(
            'pg_date_style_section',
            [
                'label' => __('Date', IE_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'pg_date_color',
            [
                'label' => __('Date Color', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .post-meta .post-date a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'pg_date_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .post-grid{{ID}} .post-meta .post-date a',
            ]
        );
        $this->add_responsive_control(
            'pg_date_margin',
            [
                'label' => esc_html__('Margin - Row 1', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .post-meta .post-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pg_date_padding',
            [
                'label' => esc_html__('Padding - Row 1', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .post-meta .post-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Category Typography Control
        $this->start_controls_section(
            'pg_cat_style_section',
            [
                'label' => __('Category', IE_TEXT_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'pg_cat_color',
            [
                'label' => __('Category Color', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .pg-category-list .pg-post-category' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'pg_cat_typography',
                'label' => __('Typography', IE_TEXT_DOMAIN),
                'selector' => '{{WRAPPER}} .post-grid{{ID}} .pg-category-list .pg-post-category',
            ]
        );
        $this->add_responsive_control(
            'pg_cat_margin',
            [
                'label' => esc_html__('Margin', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .pg-category-list .pg-post-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pg_cat_padding',
            [
                'label' => esc_html__('Padding', IE_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .post-grid{{ID}} .pg-category-list .pg-post-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $include_posts = $settings['include_posts_grid'] ? $settings['include_posts_grid'] : [];
        $exclude_posts = $settings['exclude_posts_grid'] ? $settings['exclude_posts_grid'] : [];
        $pg_layout_type = $settings['pg_layout_type'];

        $query_args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'orderby' => 'date',
            'order' => $settings['order'],
            'category__in' => !empty($settings['post_grid_categories']) ? $settings['post_grid_categories'] : '',
            'category__not_in' => !empty($settings['exclude_post_categories']) ? $settings['exclude_post_categories'] : '',
            'post__in' => !empty($include_posts) ? $include_posts : '',
            'post__not_in' => !empty($exclude_posts) ? $exclude_posts : '',
        ];

        $query = new WP_Query($query_args);
        ?>

        <div class="post-grid<?php echo esc_attr($unique_id); ?>">
            <?php if ($query->have_posts()): ?>
                <?php while ($query->have_posts()):
                    $query->the_post(); ?>
                    <div class="pg-post-item"
                        style="background:url('<?php echo get_the_post_thumbnail_url(); ?>') no-repeat center center; background-size: cover;">
                        <div class="pg-category-list">
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) {
                                foreach ($categories as $category) {
                                    $category_link = get_category_link($category->term_id);
                                    echo '<a href="' . esc_url($category_link) . '" class="pg-post-category">' . esc_html($category->name) . '</a>';
                                }
                            }
                            ?>
                        </div>
                        <div class="post-details">
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></a>
                            </h2>
                            <div class="post-meta">
                                <span class="post-author">
                                    <?php echo do_shortcode('[user_profile]'); ?>
                                </span>
                                <span class="post-date">
                                    <?php if (get_the_date()): ?>
                                        <a
                                            href="<?php echo esc_url(get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d'))); ?>">
                                            <?php echo get_the_date('j F Y'); ?>
                                        </a>
                                    <?php  endif; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else: ?>
                <p><?php esc_html_e('No posts found.', IE_TEXT_DOMAIN); ?></p>
            <?php endif; ?>
        </div>

        <style>
            <?php if ($pg_layout_type === '2-column'): ?>
                .post-grid<?php echo esc_attr($unique_id); ?> {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 20px;
                    margin: 20px 0;
                }

                .post-grid<?php echo esc_attr($unique_id); ?> .pg-post-item {
                    border: 1px solid #ddd;
                    border-radius: 12px;
                    overflow: hidden;
                    padding: 0;
                    background-color: #fff;
                    transition: box-shadow 0.3s ease;
                    min-height: 560px;
                }

            <?php elseif ($pg_layout_type === '3-column'): ?>
                .post-grid<?php echo esc_attr($unique_id); ?> {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 20px;
                    margin: 20px 0;
                }

                .post-grid<?php echo esc_attr($unique_id); ?> .pg-post-item {
                    border: 1px solid #ddd;
                    border-radius: 12px;
                    overflow: hidden;
                    padding: 0;
                    background-color: #fff;
                    transition: box-shadow 0.3s ease;
                    min-height: 420px;
                }

            <?php elseif ($pg_layout_type === '4-column'): ?>
                .post-grid<?php echo esc_attr($unique_id); ?> {
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    gap: 20px;
                    margin: 20px 0;
                }

                .post-grid<?php echo esc_attr($unique_id); ?> .pg-post-item {
                    border: 1px solid #ddd;
                    border-radius: 12px;
                    overflow: hidden;
                    padding: 0;
                    background-color: #fff;
                    transition: box-shadow 0.3s ease;
                    min-height: 420px;
                }

            <?php endif; ?>
            .post-grid<?php echo esc_attr($unique_id); ?> .profile-pic {
                width: 40px;
                height: 40px !important;
                border-radius: 50% !important;
                object-fit: cover;
                background-color: #ddd;
                margin-top: 5px;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .user-name {
                font-size: 16px;
                font-weight: 600;
                margin-bottom: 0;
                margin-left: 10px;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .verified-txt {
                color: #fff;
                font-size: 14px;
                font-weight: 600;
                font-style: italic;
                margin-bottom: 0;
                padding-left: 10px;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .verified-icon {
                background-color: #36B37E;
                padding: 0px 4px;
                border-radius: 50%;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .verified-icon svg {
                width: 10px;
                fill: #fff;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .post-meta {
                margin-bottom: 15px;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .pg-category-list {
                position: relative;
                top: 6px;
                left: 20px;
                z-index: 9;
                width: fit-content;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .pg-post-category {
                display: inline-block;
                background-color: #fff;
                color: #008080;
                padding: 0px 10px 3px 10px;
                border-radius: 20px;
                margin-right: 5px;
                margin-top: 15px;
                font-size: 13px;
                text-transform: capitalize;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .post-details {
                margin-top: 70%;
                padding: 0 15px;
                color: #fff;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .post-details .post-title {
                margin-bottom: 25px;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .post-details .post-title a {
                color: #fff;
                font-size: 26px;

                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                max-height: 3em;
                line-height: 1.5em;
                height: 3em;
                white-space: normal;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .post-meta .post-author img {
                border-radius: 50%;
                margin-right: 4px;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .post-meta .post-date {
                float: right;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .pg-post-thumbnail {
                display: block;
                overflow: hidden;
                position: relative;
                width: 100%;
                /* height: 200px; */
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .pg-post-thumbnail img {
                width: 100%;
                margin-top: 0px;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .post-item:hover {
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .post-thumbnail img {
                width: 100%;
                height: auto;
                border-bottom: 1px solid #ddd;
                ;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .post-title {
                font-size: 1.2em;
                margin-bottom: 10px;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .post-excerpt {
                font-size: 0.9em;
                color: #555;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .pg-post-item {
                position: relative;
                overflow: hidden;
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .pg-post-item::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(360deg, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0.036) 100%);
                transition: all 1s ease-in-out;
                z-index: 1;
                /* Ensure it sits on top of the background image */
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .pg-post-item .pg-category-list,
            .post-grid<?php echo esc_attr($unique_id); ?> .pg-post-item .post-details {
                position: absolute;
                z-index: 2;
                /* Ensure the content is above the gradient */
            }

            .post-grid<?php echo esc_attr($unique_id); ?> .pg-post-item:hover::before {
                background: linear-gradient(360deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.036) 100%);
            }

            @media (max-width: 768px) {
                .post-grid<?php echo esc_attr($unique_id); ?> {
                    grid-template-columns: 1fr;
                }
            }

            @media (min-width: 768px) and (max-width: 1024px) {
                .post-grid<?php echo esc_attr($unique_id); ?> {
                    grid-template-columns: 1fr 1fr;
                }
            }
        </style>
        <?php
    }
}

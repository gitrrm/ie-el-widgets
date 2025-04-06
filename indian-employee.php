<?php
/**
 * Plugin Name: Indian Employee Addons
 * Description: A collection of custom Elementor widget for Indian Employee website.
 * Version: 1.0.0
 * Author: Indian Employee
 * Author URI: https://indianemployee.com
 * License: GPL2
 * Text Domain: indian-employee
 * Domain Path: /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants.
define( 'IE_VERSION', '1.0.0' );
define( 'IE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'IE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'IE_TEXT_DOMAIN', "indian-employee" );

// Load plugin text domain for translations.
function ie_load_textdomain() {
    load_plugin_textdomain( 'indian-employee', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'ie_load_textdomain' );

// Check if Elementor is active
function ie_check_elementor() {
    // Check if Elementor is installed and active
    if ( ! did_action( 'elementor/loaded' ) ) {
        // Display admin notice
        add_action( 'admin_notices', 'ie_elementor_not_installed_notice' );

        // Deactivate the plugin if in admin context
        if ( is_admin() ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
            deactivate_plugins( plugin_basename( __FILE__ ) );
        }

        // Prevent further execution
        return false;
    }
    return true;
}

// Display admin notice if Elementor is not installed
function ie_elementor_not_installed_notice() {
    ?>
    <div class="notice notice-error">
        <p><?php esc_html_e( 'Inidan Employee requires Elementor to be installed and activated.', IE_TEXT_DOMAIN ); ?></p>
    </div>
    <?php
}

// Hook into the 'plugins_loaded' action to check for Elementor
add_action( 'plugins_loaded', 'ie_check_elementor' );

// Include necessary files for the plugin only if Elementor is active
function indian_employee_init() {
    if ( ie_check_elementor() ) {
        // Include the widget classes
        function register_ie_widgets( $widgets_manager ) {
            require_once( IE_PLUGIN_DIR . 'includes/widgets/ie-news-style-grid.php' );
            require_once( IE_PLUGIN_DIR . 'includes/widgets/ie-post-grid.php' );
            require_once( IE_PLUGIN_DIR . 'includes/widgets/ie-post-slider.php' );
            require_once( IE_PLUGIN_DIR . 'includes/widgets/ie-ticker.php' );
            require_once( IE_PLUGIN_DIR . 'includes/widgets/ie-country-flags.php' );
            require_once( IE_PLUGIN_DIR . 'includes/widgets/ie-testimonials.php' );

            // register widgets
            $widgets_manager->register( new \IE_News_Style_Grid() ); 
            $widgets_manager->register( new \IE_Post_Grid() ); 
            $widgets_manager->register( new \IE_Post_Slider() ); 
            $widgets_manager->register( new \IE_Text_Slider() ); 
            $widgets_manager->register( new \IE_Country_Flags() ); 
            $widgets_manager->register( new \IE_Testimonial_Slider_Widget() ); 
        }
        add_action( 'elementor/widgets/register', 'register_ie_widgets' );

        // Add Elementor widget categories
        function add_ie_widget_categories( $elements_manager ) {
            $elements_manager->add_category(
                'indian_employee',
                [
                    'title' => __( 'Indian Employee', IE_TEXT_DOMAIN ),
                    'icon' => 'fa fa-plug',
                    'priority' => 10,
                ]
            );
        }
        add_action( 'elementor/elements/categories_registered', 'add_ie_widget_categories' );

        // Include verified user functionality
        require_once( IE_PLUGIN_DIR . 'includes/IndianEmployeeProfile.php' );

        // Include Elementor widget files
        function ie_enqueue_scripts() {
            wp_enqueue_style( 'owl-carousel-theme', plugin_dir_url( __FILE__ ) . 'assets/css/all-widget-styles.css' );
            wp_enqueue_style( 'swiper-style', plugin_dir_url( __FILE__ ) . 'assets/css/swiper-bundle.min.css' );
            
            
            // Add Script files
            wp_enqueue_script( 'swiper-script', plugin_dir_url( __FILE__ ) . 'assets/js/swiper-bundle.min.js', [], null, false );
            
            // Enqueue Font Awesome styles
            if( ! wp_style_is( 'font-awesome-style', 'enqueued' ) ){
                wp_enqueue_style(
                    'addon-font-awesome-style',
                    plugin_dir_url( __FILE__ ) . 'assets/css/fa-all.min.css',
                    array(),
                    '5.1.3'
                );
            }
            
        }
        add_action( 'wp_enqueue_scripts', 'ie_enqueue_scripts' );
    }
}
add_action( 'plugins_loaded', 'indian_employee_init' );
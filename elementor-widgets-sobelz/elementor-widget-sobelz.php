<?php
/**
 * Plugin Name: elementor widgets sobelz
 * Description: widgets sobelz for Elementor
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      sobelz
 * Author URI:  https://sobelz.com/
 * Text Domain: elementor widgets sobelz
 *
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register elementor-timeline-sobelz Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_timeline_sobelz( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/timeline-sobelz/timeline-sobelz.php' );

    $widgets_manager->register( new \Elementor_Timeline_Sobelz() );

}
add_action( 'elementor/widgets/register', 'register_timeline_sobelz' );



/**
 * Register scripts and styles for elementor widget sobelz widgets.
 */
function elementor_timeline_widgets_dependencies() {

    /* Styles */
    wp_register_style( 'styl-timeline-sobelz', plugins_url( '/widgets/timeline-sobelz/styl-timeline-sobelz.css', __FILE__ ) );
    wp_register_script( 'script-timeline-sobelz', plugins_url( '/widgets/timeline-sobelz/script-timeline-sobelz.js', __FILE__ ) );

}
add_action( 'wp_enqueue_scripts', 'elementor_timeline_widgets_dependencies' );



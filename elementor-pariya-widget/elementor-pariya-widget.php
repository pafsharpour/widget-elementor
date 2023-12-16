<?php
/**
 * Plugin Name: Elementor Pariya Widget
 * Description: new widget
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Elementor Developer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: elementor-pariya-widget
 *
 * Elementor tested up to: 3.16.0
 * Elementor Pro tested up to: 3.16.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register oEmbed Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_Pariya_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/pariya-widget.php' );

	$widgets_manager->register( new \Elementor_Pariya_Widget() );

}
add_action( 'elementor/widgets/register', 'register_pariya_widget' );


function register_pariya_widgets_dependencies() {
	/* Styles */
	wp_register_style( 'style-timeline-sobelz.css', plugins_url( '/widets/style-timeline-sobelz.css', __FILE__ ) );

}
add_action(  'wp_enqueue_scripts', 'register_pariya_widgets_dependencies' );
<?php
/**
 * Blocksy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blocksy
 */

if (version_compare(PHP_VERSION, '5.7.0', '<')) {
	require get_template_directory() . '/inc/php-fallback.php';
	return;
}

require get_template_directory() . '/inc/init.php';

add_filter( 'woocommerce_cart_needs_payment', '__return_false' );

function order_scripts() {
	wp_enqueue_style( 'style-order', get_template_directory_uri() . '/static-order/order.css' );
	wp_enqueue_script( 'script-validate', get_template_directory_uri() . '/static-order/validate.js', array(), '1.0.0', true );
	wp_enqueue_script( 'script-validate-additional', get_template_directory_uri() . '/static-order/validate-additional.js', array(), '1.0.0', true );
	wp_enqueue_script( 'script-masked-input', get_template_directory_uri() . '/static-order/maskedinput.js', array(), '1.0.0', true );
	wp_enqueue_script( 'script-order', get_template_directory_uri() . '/static-order/order.js', array(), '1.0.0', true );

}
add_action( 'wp_enqueue_scripts', 'order_scripts' );



add_action( 'after_setup_theme', 'theme_slug_setup' );

function theme_slug_setup() {
	
}
<?php
/**
Plugin Name: Checkout Mestres do WP Addon Pagar.me
Plugin URI: http://www.mestresdowp.com.br/
Description: Personaliza os campos do Pagar.me no Checkout Mestres do WP.
Version: 1.0.2 
Author: Mestres do WP
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: checkout-mwp-addon-pagarme
 */
 /*
	Copyright 2021  Mestres do WP  (email : contato@mestresdowp.com.br)
*/
define( 'CWMP_PAGARME_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CWMP_PAGARME_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

function addon_pagarme_extensions_check_checkout () {
	if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	  	echo "<div class='error'><p>É necessário utilizar o plugin <strong>WooCommerce</strong>.</p></div>";
	}
	if ( ! is_plugin_active( 'checkout-mestres-wp/checkout-woocommerce-mestres-wp.php' ) ) {
	  	echo "<div class='error'><p>É necessário utilizar o plugin <strong>Checkout Mestres WP</strong>, <a href='update.php?action=install-plugin&plugin=checkout-mestres-wp&_wpnonce=c2bbda7f10'>clique aqui para instalar</a>. </p></div>";
	}
}
add_action('admin_notices', 'addon_pagarme_extensions_check_checkout');

add_filter( 'woocommerce_locate_template', 'cwmp_woo_template_pagarme_basic_checkout', 110, 3 );
function cwmp_woo_template_pagarme_basic_checkout( $template, $template_name, $template_path ) {
if('banking-ticket/checkout-instructions.php' == $template_name ){         
$template = CWMP_PAGARME_PLUGIN_PATH . 'templates/banking-ticket/checkout-instructions.php';   
}
return $template;
}

add_filter( 'woocommerce_locate_template', 'cwmp_woo_template_pagarme_custom_checkout', 110, 3 );
function cwmp_woo_template_pagarme_custom_checkout( $template, $template_name, $template_path ) {
if('credit-card/payment-form.php' == $template_name ){         
$template = CWMP_PAGARME_PLUGIN_PATH . 'templates/credit-card/payment-form.php';   
}
return $template;
}
add_filter( 'woocommerce_locate_template', 'cwmp_woo_template_pagarme_pix_checkout', 110, 3 );
function cwmp_woo_template_pagarme_pix_checkout( $template, $template_name, $template_path ) {
if('html-woocommerce-instructions.php' == $template_name ){         
$template = CWMP_PAGARME_PLUGIN_PATH . 'templates/pix/html-woocommerce-instructions.php';   
}
return $template;
}

function add_js_cwpm_addon_pagarme($hook) {
	if(is_checkout()){
	wp_enqueue_style('cwpm_addon_css_card', CWMP_PAGARME_PLUGIN_URL . '/assets/css/card.css');
	wp_enqueue_style('cwpm_addon_appmax_css_style', CWMP_PAGARME_PLUGIN_URL . '/assets/css/style.css');
	}
}
add_action('wp_enqueue_scripts', 'add_js_cwpm_addon_pagarme');
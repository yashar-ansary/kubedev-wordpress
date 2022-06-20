<?php
/**
* Plugin Name: Persian Font buddyboss
* Plugin URI: https://ariawp.com
* Description: Add persian font to buddyboss theme, developed by AriaWordPress
* Version: 1.2
* Author: AriaWP
* Author URI: https://ariawp.com
* Text Domain: ariawp-buddyboss
*/

if ( ! defined( 'ABSPATH' ) ) exit;
add_action( 'wp_enqueue_scripts', 'remove_default_font_style', 20 );
function remove_default_font_style() {
    wp_dequeue_style( 'buddyboss-theme-fonts' );
}

load_plugin_textdomain( 'ariawp-buddyboss', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 

include('inc/panel.php');
$options = get_option('ariafontbuddyboss_font_settings');
$i = 1;
$activate = 0;
while ($i < 5){
	$fontnamecount = 'fontname' . $i;
	if(!empty($options[$fontnamecount])){
		$activate = $i;
	}
	if ($activate == 1) {
	function ariafontbuddyboss_fa_scripts1() {
		global $options;
    	wp_enqueue_style( 'ariawp-font1', plugins_url( 'assets/css/' . esc_html( $options['fontname1'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontbuddyboss_fa_scripts1', 999999);
	add_action( 'login_enqueue_scripts', 'ariafontbuddyboss_fa_scripts1', 999999);
	}
	if ($activate == 2) {
	function ariafontbuddyboss_fa_scripts2() {
		global $options;
    	wp_enqueue_style( 'ariawp-font2', plugins_url( 'assets/css/' . esc_html( $options['fontname2'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontbuddyboss_fa_scripts2', 999998);
	add_action( 'login_enqueue_scripts', 'ariafontbuddyboss_fa_scripts2', 999998);
	}
	if ($activate == 3) {
	function ariafontbuddyboss_fa_scripts3() {
		global $options;
    	wp_enqueue_style( 'ariawp-font3', plugins_url( 'assets/css/' . esc_html( $options['fontname3'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontbuddyboss_fa_scripts3', 999997);
	add_action( 'login_enqueue_scripts', 'ariafontbuddyboss_fa_scripts3', 999997);
	}
	if ($activate == 4) {
	function ariafontbuddyboss_fa_scripts4() {
		global $options;
    	wp_enqueue_style( 'ariawp-font4', plugins_url( 'assets/css/' . esc_html( $options['fontname4'] ) . '.css', __FILE__ ) );
	}
	add_action( 'wp_enqueue_scripts', 'ariafontbuddyboss_fa_scripts4', 999996);
	add_action( 'login_enqueue_scripts', 'ariafontbuddyboss_fa_scripts4', 999996);
	}
	$i++;
	$activate = 0;
}

	
add_action('wp_head', 'buddyboss_add_css');	
function buddyboss_add_css(){
global $options;
?>
    <style type="text/css">
    	<?php if(!empty($options['bodyfontname'])) { ?>
        body, h1, h2, h3, h4, h5, h6{
            font-family: <?php esc_attr_e($options['bodyfontname']); ?>;
        }
        <?php } ?>
        <?php if(!empty($options['hfontname'])) { ?>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6{
            font-family: <?php esc_attr_e($options['hfontname']); ?>;
        }
        <?php } ?>
        <?php if(!empty($options['menufontname'])) { ?>
        body .navbar-default .nav li a, body .modal-menu-item { font-family: <?php esc_attr_e($options['menufontname']); ?> !important; }
        <?php } ?>

    </style>
    <?php
}
add_action('login_head', 'buddyboss_add_login_css');
function buddyboss_add_login_css(){
global $options;
?>
    <style type="text/css">
    	<?php if(!empty($options['bodyfontname'])) { ?>
        .rtl h1, .rtl h2, .rtl h3, .rtl h4, .rtl h5, .rtl h6, body.rtl, body.rtl .press-this a.wp-switch-editor{
            font-family: <?php esc_attr_e($options['bodyfontname']); ?>;
        }
        <?php } ?>
    </style>
    <?php
}
?>
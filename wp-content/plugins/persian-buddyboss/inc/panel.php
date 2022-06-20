<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function ariafontbuddyboss_settings_page() {
include ('font-setting.php');
}

function ariafontbuddyboss_font_settings_page() {
//Aria Font Setting Functions
}
function ariafontbuddyboss_create_menu() {
add_menu_page( __("آریا فونت", 'awp'), __("آریا فونت", 'awp'), 'manage_options',"ariafontbuddyboss-settings", "ariafontbuddyboss_settings_page" ,'dashicons-admin-customizer' );
add_submenu_page("ariafontbuddyboss-settings", __("فونت آنکد", 'awp'), __("فونت آنکد", 'awp'), 'manage_options', "ariafontbuddyboss-settings","ariafontbuddyboss_settings_page");
add_action('admin_init', 'register_ariafontbuddyboss_settings');
}
add_action('admin_menu', 'ariafontbuddyboss_create_menu');
function register_ariafontbuddyboss_settings(){
// Register our settings
register_setting('ariafontbuddyboss_font_settings', 'ariafontbuddyboss_font_settings');
}



        




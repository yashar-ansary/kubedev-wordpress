<?php
/**
 * Deprecated Functions of BuddyBoss Theme.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Remove Header/Footer for AppBoss
 */
if ( ! function_exists( 'bb_theme_remove_header_footer_for_appboss' ) ) {

	function bb_theme_remove_header_footer_for_appboss() {

		_deprecated_function( __FUNCTION__, '1.6.4', 'bb_theme_remove_header_footer_for_buddyboss_app()' );
		bb_theme_remove_header_footer_for_buddyboss_app();
	}

}

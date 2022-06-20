<?php
// Site Logo
$show		  = buddyboss_theme_get_option( 'logo_switch' );
$show_dark    = buddyboss_theme_get_option( 'logo_dark_switch' );
$logo_id	  = buddyboss_theme_get_option( 'logo', 'id' );
$logo_dark_id = buddyboss_theme_get_option( 'logo_dark', 'id' );
$logo		  = ( $show && $logo_id ) ? wp_get_attachment_image( $logo_id, 'full', '', array( 'class' => 'bb-logo' ) ) : get_bloginfo( 'name' );
$logo_dark    = ( $show && $show_dark && $logo_dark_id ) ? wp_get_attachment_image( $logo_dark_id, 'full', '', array( 'class' => 'bb-logo bb-logo-dark' ) ) : '';

// This is for better SEO
$elem = ( is_front_page() && is_home() ) ? 'h1' : 'h2';
?>

<div id="site-logo" class="site-branding">
	<<?php echo $elem; ?> class="site-title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php echo $logo; echo $logo_dark;?>
		</a>
	</<?php echo $elem; ?>>
</div>
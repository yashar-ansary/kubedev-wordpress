<?php
$show_search        = buddyboss_theme_get_option( 'header_search' );
$show_messages      = buddyboss_theme_get_option( 'messages' ) && is_user_logged_in();
$show_notifications = buddyboss_theme_get_option( 'notifications' ) && is_user_logged_in();
$show_shopping_cart = buddyboss_theme_get_option( 'shopping_cart' );
?>

<div id="header-aside" class="header-aside">
	<div class="header-aside-inner">
		<?php if ( is_user_logged_in() ) : ?>
			<div class="user-wrap user-wrap-container menu-item-has-children">
				<?php
				$current_user = wp_get_current_user();
				$user_link    = function_exists( 'bp_core_get_user_domain' ) ? bp_core_get_user_domain( $current_user->ID ) : get_author_posts_url( $current_user->ID );
				$display_name = function_exists( 'bp_core_get_user_displayname' ) ? bp_core_get_user_displayname( $current_user->ID ) : $current_user->display_name;
				?>

				<a class="user-link" href="<?php echo esc_url( $user_link ); ?>">
					<span class="user-name"><?php echo esc_html( $display_name ); ?></span><i class="bb-icon-angle-down"></i>
					<?php echo get_avatar( get_current_user_id(), 100 ); ?>
				</a>

				<div class="sub-menu">
					<div class="wrapper">
						<ul class="sub-menu-inner">
							<li>
								<a class="user-link" href="<?php echo esc_url( $user_link ); ?>">
									<?php echo get_avatar( get_current_user_id(), 100 ); ?>
									<span>
										<span class="user-name"><?php echo esc_html( $display_name ); ?></span>
										<?php if ( function_exists( 'bp_is_active' ) && function_exists( 'bp_activity_get_user_mentionname' ) ) : ?>
											<span class="user-mention"><?php echo '@' . bp_activity_get_user_mentionname( $current_user->ID ); ?></span>
										<?php else : ?>
											<span class="user-mention"><?php echo '@' . $current_user->user_login; ?></span>
										<?php endif; ?>
									</span>
								</a>
							</li>
							<?php
							if ( function_exists( 'bp_is_active' ) ) {
								$menu = wp_nav_menu(
									array(
										'theme_location' => 'header-my-account',
										'echo'           => false,
										'fallback_cb'    => '__return_false',
									)
								);
								if ( ! empty( $menu ) ) {
									wp_nav_menu(
										array(
											'theme_location' => 'header-my-account',
											'menu_id'     => 'header-my-account-menu',
											'container'   => false,
											'fallback_cb' => '',
											'walker'      => new BuddyBoss_SubMenuWrap(),
											'menu_class'  => 'bb-my-account-menu',
										)
									);
								} else {
									do_action( THEME_HOOK_PREFIX . 'header_user_menu_items' );
								}
							} else {
								do_action( THEME_HOOK_PREFIX . 'header_user_menu_items' );
							}
							?>
						</ul>
					</div>
				</div>
			</div>

			<?php
			if ( ( class_exists( 'SFWD_LMS' ) && buddyboss_is_learndash_inner() ) || ( class_exists( 'LifterLMS' ) && buddypanel_is_lifterlms_inner() ) ) :
				?>

				<span class="bb-separator"></span>
				<a href="#" id="bb-toggle-theme">
					<span class="sfwd-dark-mode" data-balloon-pos="down" data-balloon="<?php esc_html_e( 'Dark Mode', 'buddyboss-theme' ); ?>"><i class="bb-icon-moon-circle"></i></span>
					<span class="sfwd-light-mode" data-balloon-pos="down" data-balloon="<?php esc_html_e( 'Light Mode', 'buddyboss-theme' ); ?>"><i class="bb-icon-sun"></i></span>
				</a>
				<a href="#" class="header-maximize-link course-toggle-view" data-balloon-pos="down" data-balloon="<?php esc_html_e( 'Maximize', 'buddyboss-theme' ); ?>"><i class="bb-icon-maximize"></i></a>
				<a href="#" class="header-minimize-link course-toggle-view" data-balloon-pos="down" data-balloon="<?php esc_html_e( 'Minimize', 'buddyboss-theme' ); ?>"><i class="bb-icon-minimize"></i></a>

				<?php
			else :
				if ( $show_search || $show_messages || $show_notifications || $show_shopping_cart ) :
					?>
					<span class="bb-separator"></span>
					<?php
				endif;

				if ( $show_search ) :
					?>
					<a href="#" class="header-search-link" data-balloon-pos="down" data-balloon="<?php esc_html_e( 'Search', 'buddyboss-theme' ); ?>"><i class="bb-icon-search"></i></a>
					<?php
				endif;

				if ( $show_messages && function_exists( 'bp_is_active' ) && bp_is_active( 'messages' ) ) :
					?>
					<?php get_template_part( 'template-parts/messages-dropdown' ); ?>
					<?php
				endif;

				if ( $show_notifications && function_exists( 'bp_is_active' ) && bp_is_active( 'notifications' ) ) :
					?>
					<?php get_template_part( 'template-parts/notification-dropdown' ); ?>
					<?php
				endif;

				if ( $show_shopping_cart && class_exists( 'WooCommerce' ) ) :
					?>
					<?php get_template_part( 'template-parts/cart-dropdown' ); ?>
					<?php
				endif;
			endif;
			?>

		<?php else : ?>

			<?php if ( $show_search ) : ?>
				<a href="#" class="header-search-link" data-balloon-pos="down" data-balloon="<?php esc_attr_e( 'Search', 'buddyboss-theme' ); ?>"><i class="bb-icon-search"></i></a>
			<?php endif; ?>

			<?php if ( $show_shopping_cart && class_exists( 'WooCommerce' ) ) : ?>
				<?php get_template_part( 'template-parts/cart-dropdown' ); ?>
			<?php endif; ?>
			<span class="search-separator bb-separator"></span>
			<div class="bb-header-buttons">
				<a href="<?php echo esc_url( wp_login_url() ); ?>" class="button small outline signin-button link"><?php esc_html_e( 'Sign in', 'buddyboss-theme' ); ?></a>

				<?php if ( get_option( 'users_can_register' ) ) : ?>
					<a href="<?php echo esc_url( wp_registration_url() ); ?>" class="button small singup"><?php esc_html_e( 'Sign up', 'buddyboss-theme' ); ?></a>
				<?php endif; ?>
			</div>

		<?php endif; ?>

		<?php $header = buddyboss_theme_get_option( 'buddyboss_header' ); ?>

		<?php if ( '3' === $header || ( class_exists( 'SFWD_LMS' ) && buddyboss_is_learndash_inner() ) || ( class_exists( 'LifterLMS' ) && buddypanel_is_lifterlms_inner() ) ) : ?>
			<?php echo buddypanel_position_right(); ?>
		<?php endif; ?>
	</div>
</div>

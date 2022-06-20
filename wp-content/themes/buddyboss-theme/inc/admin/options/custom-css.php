<?php
/*
 * Custom CSS 
 */
if ( ! function_exists( 'boss_generate_option_css' ) ) {

	function boss_generate_option_css() {

		$custom_css = array();
		if ( is_customize_preview() ) {
			$custom_css = array();
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "<style id=\"buddyboss_theme-style\">{$custom_css["css"]}</style>";

			return false;
		}

		$primary_color   = buddyboss_theme_get_option( 'accent_color' );
		$secondary_color = buddyboss_theme_get_option( 'accent_hover' );
		$highlight_color = buddyboss_theme_get_option( 'highlight_color' );

		$header_height = buddyboss_theme_get_option( 'header_height' );
		$header_shadow = buddyboss_theme_get_option( 'header_shadow' );
		$header_sticky = buddyboss_theme_get_option( 'header_sticky' );

		$tooltip_background = buddyboss_theme_get_option( 'tooltip_background' );
		$tooltip_color      = buddyboss_theme_get_option( 'tooltip_color' );

		$button_radius = buddyboss_theme_get_option( 'button_default_radius' );

		$danger_color         = buddyboss_theme_get_option( 'error_notice_bg_color' );
		$success_color        = buddyboss_theme_get_option( 'success_notice_bg_color' );
		$warning_color        = buddyboss_theme_get_option( 'warning_notice_bg_color' );
		$default_notice_color = buddyboss_theme_get_option( 'default_notice_bg_color' );

		?>
		<style id="buddyboss_theme-style">

		<?php ob_start(); ?>

			<?php if ( buddyboss_theme_get_option( 'logo_size' ) ) { ?>
				#site-logo .site-title img {
					max-height: inherit;
				}

				.site-header-container .site-branding {
					min-width: <?php echo buddyboss_theme_get_option( 'logo_size' ); ?>px;
				}

				#site-logo .site-title .bb-logo img,
				#site-logo .site-title img.bb-logo,
				.buddypanel .site-title img {
					width: <?php echo buddyboss_theme_get_option( 'logo_size' ); ?>px;
				}
			<?php } ?>

			<?php
			if ( buddyboss_theme_get_option( 'logo_dark', 'id' ) && buddyboss_theme_get_option( 'logo_dark_switch' ) ) {
				?>
				.site-header-container #site-logo .bb-logo.bb-logo-dark,
				.llms-sidebar.bb-dark-theme .site-header-container #site-logo .bb-logo,
				.site-header-container .ld-focus-custom-logo .bb-logo.bb-logo-dark,
				.bb-custom-ld-focus-mode-enabled:not(.bb-custom-ld-logo-enabled) .site-header-container .ld-focus-custom-logo .bb-logo.bb-logo-dark,
				.bb-dark-theme.bb-custom-ld-focus-mode-enabled:not(.bb-custom-ld-logo-enabled) .site-header-container .ld-focus-custom-logo img,
				.bb-sfwd-aside.bb-dark-theme:not(.bb-custom-ld-logo-enabled) .site-header-container #site-logo .bb-logo,
				.buddypanel .site-branding h2 img.bb-logo.bb-logo-dark,
				.bb-sfwd-aside.bb-dark-theme .buddypanel .site-branding h2 img.bb-logo,
				.buddypanel .site-branding h1 img.bb-logo.bb-logo-dark,
				.bb-sfwd-aside.bb-dark-theme .buddypanel .site-branding h1 img.bb-logo{display:none;}

				.llms-sidebar.bb-dark-theme .site-header-container #site-logo .bb-logo.bb-logo-dark,
				.bb-dark-theme.bb-custom-ld-focus-mode-enabled:not(.bb-custom-ld-logo-enabled) .site-header-container .ld-focus-custom-logo .bb-logo.bb-logo-dark,
				.bb-sfwd-aside.bb-dark-theme .site-header-container #site-logo .bb-logo.bb-logo-dark,
				.buddypanel .site-branding h2 img.bb-logo,
				.bb-sfwd-aside.bb-dark-theme .buddypanel .site-branding h2 img.bb-logo.bb-logo-dark,
				.buddypanel .site-branding h1 img.bb-logo,
				.bb-sfwd-aside.bb-dark-theme .buddypanel .site-branding h1 img.bb-logo.bb-logo-dark{display:inline;}

			<?php } ?>

			<?php if ( buddyboss_theme_get_option( 'logo_dark', 'id' ) && buddyboss_theme_get_option( 'logo_dark_switch' ) ) { ?>
				#site-logo .site-title img {
					max-height: inherit;
				}

				.llms-sidebar.bb-dark-theme .site-header-container .site-branding,
				.bb-sfwd-aside.bb-dark-theme .site-header-container .site-branding {
					min-width: <?php echo buddyboss_theme_get_option( 'logo_dark_size' ); ?>px;
				}

				.llms-sidebar.bb-dark-theme #site-logo .site-title .bb-logo.bb-logo-dark img,
				.bb-sfwd-aside.bb-dark-theme #site-logo .site-title .bb-logo.bb-logo-dark img,
				.llms-sidebar.bb-dark-theme #site-logo .site-title img.bb-logo.bb-logo-dark,
				.bb-sfwd-aside.bb-dark-theme #site-logo .site-title img.bb-logo.bb-logo-dark,
				.bb-custom-ld-focus-mode-enabled .site-header-container .ld-focus-custom-logo .bb-logo.bb-logo-dark,
				.bb-sfwd-aside.bb-dark-theme .buddypanel .site-branding h2 img.bb-logo.bb-logo-dark {
					width: <?php echo buddyboss_theme_get_option( 'logo_dark_size' ); ?>px;
				}
			<?php } ?>

			<?php if ( buddyboss_theme_get_option( 'mobile_logo_dark', 'id' ) && buddyboss_theme_get_option( 'mobile_logo_dark_switch' ) ) { ?>
				.llms-sidebar.bb-dark-theme .site-title img.bb-mobile-logo.bb-mobile-logo-dark,
				.bb-sfwd-aside.bb-dark-theme:not(.bb-custom-ld-logo-enabled) .site-title img.bb-mobile-logo.bb-mobile-logo-dark {
					display: inline;
				}
				.site-title img.bb-mobile-logo.bb-mobile-logo-dark,
				.llms-sidebar.bb-dark-theme .site-title img.bb-mobile-logo,
				.bb-sfwd-aside.bb-dark-theme:not(.bb-custom-ld-logo-enabled) .site-title img.bb-mobile-logo {
					display: none;
				}
			<?php } ?>

			<?php if ( buddyboss_theme_get_option( 'mobile_logo_dark_size' ) && buddyboss_theme_get_option( 'mobile_logo_dark_switch' ) ) { ?>
				.llms-sidebar.bb-dark-theme .site-title img.bb-mobile-logo.bb-mobile-logo-dark,
				.bb-sfwd-aside.bb-dark-theme .site-title img.bb-mobile-logo.bb-mobile-logo-dark {
					width: <?php echo buddyboss_theme_get_option( 'mobile_logo_dark_size' ); ?>px;
				}
			<?php } ?>

			<?php if ( buddyboss_theme_get_option( 'mobile_logo_size' ) ) { ?>
				.site-title img.bb-mobile-logo {
					width: <?php echo buddyboss_theme_get_option( 'mobile_logo_size' ); ?>px;
				}
				<?php
			}
			if ( buddyboss_theme_get_option( 'footer_logo_size' ) ) {
				?>
				.footer-loto img {
					max-width: <?php echo buddyboss_theme_get_option( 'footer_logo_size' ); ?>px;
				}
			<?php } ?>

			.site-header-container #site-logo .bb-logo img,
			.site-header-container #site-logo .site-title img.bb-logo,
			.site-title img.bb-mobile-logo {
				<?php
				if ( $header_height ) {
					echo 'max-height:' . $header_height . 'px';
				} else {
					echo 'max-height: 76px;';
				}
				?>
			}

			<?php if ( empty( $header_shadow ) ) { ?>
				.site-header,
				.sticky-header .site-header:not(.has-scrolled) {
					-webkit-box-shadow: none;
					-moz-box-shadow: none;
					box-shadow: none;
				}
			<?php } ?>

			<?php if ( ! empty( $header_sticky ) ) { ?>
				.sticky-header .site-header {
					position: fixed;
					z-index: 610;
					width: 100%;
				}

				.sticky-header .bp-search-ac-header {
					position: fixed;
				}

				.sticky-header .site-content,
				body.buddypress.sticky-header .site-content,
				.bb-buddypanel.sticky-header .site-content,
				.single-sfwd-quiz.bb-buddypanel.sticky-header .site-content,
				.single-sfwd-lessons.bb-buddypanel.sticky-header .site-content,
				.single-sfwd-topic.bb-buddypanel.sticky-header .site-content {
					<?php
					if ( $header_height ) {
						echo 'padding-top:' . $header_height . 'px';
					} else {
						echo 'padding-top: 76px;';
					}
					?>
				}

				.sticky-header .site-content {
					min-height: 85vh;
				}
			<?php } ?>

			.site-header .site-header-container,
			.header-search-wrap,
			.header-search-wrap input.search-field,
			.header-search-wrap input.search-field-top,
			.header-search-wrap form.search-form {
				height: <?php echo $header_height; ?>px;
			}
			
			.sticky-header #comments:before {
				margin-top: -<?php echo $header_height; ?>px;
				height: <?php echo $header_height; ?>px;
			}

			.sticky-header .bp-feedback.bp-sitewide-notice {
				top: <?php echo $header_height; ?>px;
			}

			@media screen and (max-width: 767px) {
				.bb-mobile-header {
					height: <?php echo $header_height; ?>px;
				}
			}

			/* Success color */
			.success {
				color: <?php echo $success_color; ?>;
			}

			.bg-success,
			.message.success,
			ul.bb-choices .bs-styled-radio:checked+label:before,
			ul.bb-choices .bs-styled-radio:checked+.bb-radio-label:before,
			div.bp-avatar-status p.success,
			div.bp-cover-image-status p.success,
			.buddypress-wrap #group-create-body .bp-cover-image-status p.warning,
			.bs-bp-container-reg .buddypress-wrap #pass-strength-result.strong,
			.widget_bp_core_whos_online_widget .item-avatar a .member-status.online,
			.elementor-widget-wp-widget-bp_core_whos_online_widget .item-avatar a .member-status.online,
			.elementor-widget-wp-widget-bp_core_members_widget #members-list .item-avatar a .member-status.online,
			.widget_bp_core_members_widget #members-list .item-avatar a .member-status.online {
				background-color: <?php echo $success_color; ?>;
			}

			ul.bb-choices .bs-styled-radio:checked+label:before,
			ul.bb-choices .bs-styled-radio:checked+.bb-radio-label:before,
			div.bp-avatar-status p.success,
			div.bp-cover-image-status p.success,
			.bs-bp-container-reg .buddypress-wrap #pass-strength-result.strong {
				border-color: <?php echo $success_color; ?>;
			}

			/* Danger color */
			.error,
			.req,
			.bb-input-poll .close-link,
			.tab-container-inner .v-select .dropdown-toggle .clear:hover,
			#buddypress .custom-homepage-info.info button,
			#moderation-list td.moderation-block-member .description {
				color: <?php echo $danger_color; ?>;
			}

			#moderation-list td.moderation-block-member .description {
				border-color: <?php echo $danger_color; ?>;
			}

			.bg-error,
			.message.error,
			.buddypress-wrap .activity-comments .bp-feedback.error,
			#buddypress #bp-delete-avatar,
			#buddypress #bp-delete-cover-image,
			.bs-bp-container-reg #buddypress #signup-form.standard-form div.error,
			.bs-bp-container-reg .buddypress-wrap #pass-strength-result.short,
			div#message.error,
			.login.bb-login #pass-strength-result.short,
			.login.bb-login #pass-strength-result.bad {
				background-color: <?php echo $danger_color; ?>;
			}

			.bs-bp-container-reg .buddypress-wrap #pass-strength-result.short,
			div#message.error,
			input.error:focus,
			textarea.error:focus,
			select.error:focus,
			.login.bb-login #pass-strength-result.short,
			.login.bb-login #pass-strength-result.bad {
				border-color: <?php echo $danger_color; ?>;
			}

			input.error,
			textarea.error,
			select.error,
			.bbp-mfp-zoom-in .bbp-the-content-wrapper div.mce-panel.error,
			#bbpress-forums .bb-modal.bbp-reply-form .wp-editor-container div.mce-panel.error {
				background-color: <?php echo color2rgba( $danger_color, 0.1 ); ?>;
			}

			input.error,
			textarea.error,
			select.error {
				border-color: <?php echo color2rgba( $danger_color, 0.15 ); ?>;
			}

			/* Warning color */
			.warning,
			.item-header-wrap span.group-visibility.hidden:before {
				color: <?php echo $warning_color; ?>;
			}

			.bg-warning,
			.message.warning {
				background-color: <?php echo $warning_color; ?>;
			}

			/* Info Color */
			.focus,
			#sitewide-notice button {
				color: <?php echo $default_notice_color; ?>;
			}

			.bg-focus,
			.message.focus,
			#sitewide-notice #message {
				background-color: <?php echo $default_notice_color; ?>;
			}

			/* Primary color */
			a,
			.notification-header .mark-read-all,
			.notification-footer .delete-all {
				color: <?php echo $primary_color; ?>;
			}

			a:hover,
			.activity-post-avatar:hover,
			.notification-header .mark-read-all:hover,
			.notification-footer .delete-all:hover,
			div.profile_completion_wrap ul.pc_detailed_progress li.incomplete span.section_name a:hover,
			.bb-document-theater .bb-media-section.bb-media-no-preview .img-section a.download-button:hover,
			.bb-document-theater .bb-media-section .img-section img > .download-button:hover,
			.bb-forums .bb-forums__list .bb-forums__item .item-meta .bs-replied > a:hover,
			.bb-forums .bb-forums__list .bb-forums__item .item-title > a:hover,
			#buddypress .users-header .gamipress-buddypress-achievements .gamipress-buddypress-achievement-title:hover,
			#buddypress .users-header .gamipress-buddypress-ranks .gamipress-buddypress-rank-title:hover,
			.notification-header .mark-read-all:hover {
				color: <?php echo $secondary_color; ?>;
			}

			#send-private-message.generic-button a:before,
			a.subscription-toggle,
			.button.outline,
			input[type=button].outline,
			input[type=submit].outline,
			.button.outline:hover,
			.button.outline:focus,
			.toggle-password,
			.toggle-password:hover,
			input[type=button].outline:hover,
			input[type=submit].outline:hover,
			.bs-card-forum-details h3 a:hover,
			#message-threads .bp-message-link:hover .thread-to,
			span.triangle-play-icon,
			div.profile_completion_wrap ul.pc_detailed_progress li.incomplete span.section_name a,
			.bb-document-theater .bb-media-section.bb-media-no-preview .img-section a.download-button,
			.bb-document-theater .bb-media-section .img-section img > .download-button,
			div.profile_completion_wrap ul.pc_detailed_progress li.incomplete span.section_name a {
				color: <?php echo $primary_color; ?>;
			}

			.dropzone .dz-preview .dz-progress-ring-wrap .dz-progress-ring circle {
				stroke: <?php echo $primary_color; ?>;
			}

			.bb-shared-screen svg g {
				stroke: <?php echo $primary_color; ?>;
			}

			.bs-styled-checkbox:checked + label:before,
			.bs-styled-radio:checked + label:after,
			.bs-styled-radio:checked + .bb-radio-label:after,
			.group-messages.private-message #group-messages-container .group-messages-members-listing .all-members .group-message-member-li.selected .invite-button .icons:before {
				background: <?php echo $primary_color; ?>;
			}

			.bs-styled-checkbox:checked + label:before,
			span.triangle-play-icon,
			.bs-styled-checkbox:checked + label:before,
			.video-thumbnail-content .bp-video-thumbnail-auto-generated .video-thumb-list li .bb-custom-check:checked ~ a,
			.video-thumbnail-content .bb-dropzone-wrap .bb-custom-check:checked ~ .bb-field-wrap .dropzone .dz-preview .dz-image,
			.video-thumbnail-content .bb-dropzone-wrap .bb-custom-check[name="bb-video-thumbnail-select"]:checked ~ .video-thumbnail-custom {
				border-color: <?php echo $primary_color; ?>;
			}

			input[type="submit"],
			.button, input[type=button],
			.bb-radio .bb-radio-help:after {
				background-color: <?php echo $primary_color; ?>;
			}

			.toggle-sap-widgets:hover .cls-1 {
				fill: <?php echo $primary_color; ?>;
			}

			.bb-cover-photo,
			.bb-cover-photo .progress {
				background: <?php echo buddyboss_theme_get_option( 'buddyboss_theme_group_cover_bg' ); ?>;
			}

			input[type="submit"],
			a.subscription-toggle,
			.button.outline,
			input[type=button].outline,
			input[type=submit].outline,
			.button.outline:hover,
			.button.outline:focus,
			input[type=button].outline:hover,
			input[type=submit].outline:hover {
				border-color: <?php echo $primary_color; ?>;
			}

			.header-button.underlined {
				box-shadow: 0 -1px 0 <?php echo $primary_color; ?> inset;
			}

			/* Tooltips */
			[data-balloon]:after,
			[data-bp-tooltip]:after {
				color: <?php echo $tooltip_color; ?>;
			}

			[data-balloon]:after,
			[data-bp-tooltip]:after {
				background-color: <?php echo color2rgba( $tooltip_background, 0.95 ); ?>;
			}

			[data-balloon]:before,
			[data-bp-tooltip]:before {
				background:no-repeat url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http://www.w3.org/2000/svg%22%20width%3D%2236px%22%20height%3D%2212px%22%3E%3Cpath%20fill%3D%22<?php echo color2rgba( $tooltip_background, 0.95 ); ?>%22%20transform%3D%22rotate(0)%22%20d%3D%22M2.658,0.000%20C-13.615,0.000%2050.938,0.000%2034.662,0.000%20C28.662,0.000%2023.035,12.002%2018.660,12.002%20C14.285,12.002%208.594,0.000%202.658,0.000%20Z%22/%3E%3C/svg%3E");
				background-size: 100% auto;
			}

			[data-balloon][data-balloon-pos='right']:before {
				background:no-repeat url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http://www.w3.org/2000/svg%22%20width%3D%2212px%22%20height%3D%2236px%22%3E%3Cpath%20fill%3D%22<?php echo color2rgba( $tooltip_background, 0.95 ); ?>%22%20transform%3D%22rotate(90 6 6)%22%20d%3D%22M2.658,0.000%20C-13.615,0.000%2050.938,0.000%2034.662,0.000%20C28.662,0.000%2023.035,12.002%2018.660,12.002%20C14.285,12.002%208.594,0.000%202.658,0.000%20Z%22/%3E%3C/svg%3E");
				background-size: 100% auto;
			}

			[data-balloon][data-balloon-pos='left']:before {
				background:no-repeat url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http://www.w3.org/2000/svg%22%20width%3D%2212px%22%20height%3D%2236px%22%3E%3Cpath%20fill%3D%22<?php echo color2rgba( $tooltip_background, 0.95 ); ?>%22%20transform%3D%22rotate(-90 18 18)%22%20d%3D%22M2.658,0.000%20C-13.615,0.000%2050.938,0.000%2034.662,0.000%20C28.662,0.000%2023.035,12.002%2018.660,12.002%20C14.285,12.002%208.594,0.000%202.658,0.000%20Z%22/%3E%3C/svg%3E");
				background-size: 100% auto;
			}

			[data-balloon][data-balloon-pos='down']:before {
				background:no-repeat url("data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http://www.w3.org/2000/svg%22%20width%3D%2236px%22%20height%3D%2212px%22%3E%3Cpath%20fill%3D%22<?php echo color2rgba( $tooltip_background, 0.95 ); ?>%22%20transform%3D%22rotate(180 18 6)%22%20d%3D%22M2.658,0.000%20C-13.615,0.000%2050.938,0.000%2034.662,0.000%20C28.662,0.000%2023.035,12.002%2018.660,12.002%20C14.285,12.002%208.594,0.000%202.658,0.000%20Z%22/%3E%3C/svg%3E");
				background-size: 100% auto;
			}

			/* Header colors */
			#header-search form,
			.site-header {
				background-color: <?php echo buddyboss_theme_get_option( 'header_background' ); ?>;
			}

			.primary-menu > li > a,
			.primary-menu > li > a > i,
			.site-header #header-aside i,
			.bb-header-buttons a.button.outline,
			.primary-menu > .menu-item-has-children:not(.hideshow):after,
			.site-header .hideshow .more-button > i,
			.site-header i, .site-header .notification-dropdown i, .site-header .header-search-wrap i,
			.user-wrap.menu-item-has-children #header-my-account-menu a {
				color: <?php echo buddyboss_theme_get_option( 'header_links' ); ?>;
			}

			.primary-menu > li > a:hover,
			.primary-menu > li > a:focus,
			.primary-menu > li > a:hover > i,
			.primary-menu a:hover > i,
			.primary-menu a:focus > i,
			a.user-link:hover,
			.site-header #header-aside a.user-link:hover i,
			.bb-header-buttons a.button.outline:hover {
				color: <?php echo buddyboss_theme_get_option( 'header_links_hover' ); ?>;
			}

			.primary-menu > .current-menu-parent > a,
			.primary-menu > .current-menu-ancestor > a,
			.primary-menu > .current-menu-item > a,
			.primary-menu .current_page_item > a,
			.primary-menu > .current-menu-parent > a:hover,
			.primary-menu > .current-menu-ancestor > a:hover,
			.primary-menu > .current-menu-item > a:hover,
			.primary-menu .current_page_item > a:hover,
			.primary-menu .current-menu-item > a > i,
			.primary-menu .current-menu-item > a:hover > i,
			.site-header .sub-menu .current-menu-parent > a,
			.site-header .sub-menu .current-menu-ancestor > a {
				color: <?php echo buddyboss_theme_get_option( 'header_links_active' ); ?>;
			}

			.site-header .sub-menu a:hover,
			.site-header .sub-menu a:hover > i,
			.site-header .sub-menu .current-menu-parent > a,
			.site-header .sub-menu .current-menu-ancestor > a,
			.site-header .sub-menu .current-menu-item > a,
			.site-header .sub-menu .current-menu-item > a > i,
			.bp-messages-content .actions .message_actions .message_action__list li a:hover,
			.user-wrap.menu-item-has-children #header-my-account-menu a:hover,
			.user-wrap.menu-item-has-children #header-my-account-menu a:hover > i {
				color: <?php echo buddyboss_theme_get_option( 'header_submenu_active' ); ?>;
			}

			/* Side navigation colors */
			.buddypanel,
			.panel-head,
			.bb-mobile-panel-inner,
			.buddypanel .site-branding {
				background: <?php echo buddyboss_theme_get_option( 'sidenav_background' ); ?>;
			}

			.side-panel-menu a,
			.side-panel-menu .current-menu-item > i,
			.buddypanel .bb-toggle-panel,
			.site-header .bb-toggle-panel,
			.side-panel-menu i,
			.bb-mobile-panel-header .user-name,
			.side-panel-menu .current-menu-item .sub-menu a,
			.side-panel-menu .current-menu-item .sub-menu i,
			.bb-mobile-panel-inner .bb-primary-menu a,
			.site-header .bb-mobile-panel-inner .sub-menu a {
				color: <?php echo buddyboss_theme_get_option( 'sidenav_links' ); ?>;
			}

			.side-panel-menu a:hover,
			.buddypanel .bb-toggle-panel:hover,
			.side-panel-menu a:hover i,
			.side-panel-menu .current-menu-item .sub-menu a:hover,
			.side-panel-menu .current-menu-item .sub-menu a:hover i,
			.bb-mobile-panel-inner .bb-primary-menu a:hover,
			.site-header .bb-mobile-panel-inner .sub-menu a:hover {
				color: <?php echo buddyboss_theme_get_option( 'sidenav_links_hover' ); ?>;
			}

			.side-panel-menu .current-menu-item > a,
			.side-panel-menu .current-menu-item > a > i,
			.side-panel-menu .current-menu-item > a:hover,
			.side-panel-menu .current-menu-item > a:hover > i,
			.side-panel-menu .current-menu-parent > a,
			.side-panel-menu .current-menu-parent > a > i,
			.side-panel-menu .current-menu-parent > a:hover,
			.side-panel-menu .current-menu-parent > a:hover > i,
			.bb-mobile-panel-inner .bb-primary-menu .current-menu-item > a,
			.bb-mobile-panel-inner .bb-primary-menu .current_page_item > a {
				color: <?php echo buddyboss_theme_get_option( 'sidenav_links_active' ); ?>;
			}

			.widget ul a,
			.post-date a,
			.top-meta a,
			.top-meta .like-count,
			.bs-dropdown-wrap .bs-dropdown a,
			.bb-follow-links a {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_color' ); ?>;
			}

			.widget ul a:hover,
			.post-date a:hover,
			.top-meta a:hover,
			.top-meta .like-count:hover,
			.bs-dropdown-wrap .bs-dropdown a:hover,
			.bb-follow-links a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			/* Footer links colors */
			.bb-footer .widget ul li a,
			.bb-footer li a,
			.bb-footer .widget_nav_menu .sub-menu a {
				color: <?php echo buddyboss_theme_get_option( 'footer_links' ); ?>;
			}

			.bb-footer .widget ul li a:hover,
			.bb-footer li a:hover,
			.bb-footer .widget_nav_menu .sub-menu a:hover,
			.bb-footer .footer-menu li a:hover,
			.bb-footer .footer-socials li a:hover {
				color: <?php echo buddyboss_theme_get_option( 'footer_links_hover' ); ?>;
			}

			.bb-footer .widget ul li.current-menu-item a,
			.bb-footer .widget ul li.current-menu-item a:hover,
			.bb-footer li.current-menu-item a,
			.bb-footer li.current-menu-item a:hover {
				color: <?php echo buddyboss_theme_get_option( 'footer_links_active' ); ?>;
			}

			/* Headings link color */
			.entry-header .entry-title a,
			a.user-link,
            .post-author,
            .comment-respond .vcard a,
            .sub-menu span.user-name,
            .widget.buddypress .bp-login-widget-user-links > div.bp-login-widget-user-link a,
            .list-title a,
            .activity-header a,
            .widget.bp-latest-activities a,
            #whats-new-form .username,
            .bb-recent-posts h4 a.bb-title,
            .widget .item-list .item-title a,
            .comment-respond .comment-author,
            .bb-activity-media-wrap .bb-activity-media-elem.document-activity .document-description-wrap .document-detail-wrap,
            .activity-list li.bbp_topic_create .activity-content .activity-inner .activity-discussion-title-wrap a,
            .activity-list li.bbp_reply_create .activity-content .activity-inner .activity-discussion-title-wrap a,
            .activity-list li.bbp_topic_create .bp-activity-head .bb-post-singular,
            .activity-list li.bbp_reply_create .bp-activity-head .bb-post-singular,
            .activity-list li.blogs .bp-activity-head .bb-post-singular,
            .activity-list li.bbp_topic_create .activity-content .activity-inner .bb-post-title,
            .activity-list li.bbp_topic_create .activity-content .activity-inner .activity-discussion-title-wrap,
            .activity-list li.bbp_reply_create .activity-content .activity-inner .bb-post-title,
            .activity-list li.bbp_reply_create .activity-content .activity-inner .activity-discussion-title-wrap,
            .activity-list li.blogs .activity-content .activity-inner .bb-post-title,
            .activity-list li.blogs .activity-content .activity-inner .activity-discussion-title-wrap {
                color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
            }

            .entry-header .entry-title a:hover,
            .post-author:hover,
            .comment-respond .vcard a:hover,
            .widget.buddypress .bp-login-widget-user-links > div.bp-login-widget-user-link a:hover,
            .list-title a:hover,
            .activity-header a:hover,
            .widget.bp-latest-activities a:hover,
            #whats-new-form .username:hover,
            .bb-recent-posts h4 a.bb-title:hover,
            .widget .item-list .item-title a:hover,
            .comment-respond .comment-author:hover,
            .bb-activity-media-wrap .bb-activity-media-elem.document-activity .document-action-wrap > a:hover,
            .bb-activity-media-wrap .bb-activity-media-elem.document-activity .document-action-wrap > a:hover i,
            .bb-activity-media-wrap .bb-activity-media-elem.document-activity.code-full-view .document-action-wrap .document-action_collapse i,
            .search-document-list .media-folder_items .media-folder_details__bottom .media-folder_author a:hover,
            #media-folder-document-data-table .media-folder_items .media-folder_details__bottom .media-folder_author a:hover,
            .search-document-list .media-folder_items .media-folder_group a:hover,
            .search-media-list .media-album_modified .media-album_details__bottom .media-album_author a:hover,
            .search-media-list .media-album_group_name a:hover,
            .search-document-list .media-folder_items .media-folder_details .media-folder_name:hover,
            #media-folder-document-data-table .media-folder_items .media-folder_details .media-folder_name:hover,
            #media-stream.document-parent.group-column #media-folder-document-data-table .media-folder_items .media-folder_group a:hover,
            .search-media-list .media-album_details .media-album_name:hover,
            .bb-document-theater .bb-media-section.bb-media-no-preview .img-section a.download-button,
            .search-results .bp-list li .item-meta a:hover,
            #bbpress-forums#bbpress-forums .bs-forums-items.list-view .bs-dropdown-wrap .bs-dropdown-wrap-inner > a:hover > i,
            #bbpress-forums#bbpress-forums .bs-forums-items.list-view .bs-dropdown-wrap .bs-dropdown-wrap-inner > a:hover > span {
                color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
            }

			/* Body Text color */
			body,
			input, textarea, select,
			.forgetme:hover,
			.joinbutton:hover,
			.siginbutton:hover,
			.post-grid .entry-content,
			.comment-text,
			.bb-message-box .message-content,
			#bs-message-threads p.thread-subject,
			.bb-document-theater .bb-media-section h3,
			.widget.widget_display_stats dt,
			blockquote,
			.bb-profile-meta span span,
			body.register .registration-popup.bb-modal {
				color: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>;
			}

			.post-grid .entry-content,
			.post-author-details .author-desc,
			.show-support p,
			#bs-message-threads .thread-info p.thread-excerpt,
			#cover-image-container,
			.bs-timestamp,
			#message-threads li .thread-content .excerpt,
			.widget .widget-title .widget-num-count,
			.activity-list .activity-item .activity-content .activity-header,
			.widget.bp-latest-activities .activity-update,
			.activity-list .activity-item .activity-content .comment-header,
			.acomment-meta .activity-time-since,
			.widget_post_author .author-desc-wrap,
			.widget_bp_core_members_widget #members-list .member_last_visit,
			.widget.buddypress span.activity,
			span.bb-pages .bb-total,
			.normal span:not(.bs-output),
			.bb-field-counter span:not(.bs-output),
			.profile-single-meta,
			ul.bb-profile-fields .bb-label,
			.bs-item-list.list-view .item-meta,
			h4.bb-active-order,
			.bb-secondary-list-tabs h4,
			.bs-item-list-inner .item-meta,
			.activity-date,
			.notification-content,
			tfoot th,
			tfoot td,
			.error-404 .desc,
			.sub-menu .user-mention,
			.bb-footer,
			table caption {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			/* Heading Text color */
			h1, h2, h3, h4, h5, h6,
			.entry-title,
			.widget-title,
			.show-support h6,
			label,
			h4 .bp-reported-type {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.site-title, .site-title a {
				color: <?php echo buddyboss_theme_get_option( 'sitetitle_color' ); ?>;
			}

			/* Layout colors */

			<?php $body_bgr_color = buddyboss_theme_get_option( 'body_background' ); ?>

			body,
			body #main-wrap,
			.formatted-content {
				background-color: <?php echo $body_bgr_color; ?>;
			}

			.bb_processing_overlay {
				background-color: <?php echo color2rgba( $body_bgr_color, 0.8 ); ?>;
			}

			.widget,
			.post-inner-wrap,
			.comment-respond {
				background: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			.bs-item-list.list-view .bs-item-wrap {
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			.widget,
			.post-inner-wrap,
			.comment-respond,
			.bs-item-list.list-view .bs-item-wrap,
			.post-author-details,
			.widget.widget_bp_profile_completion_widget .profile_completion_wrap .pc_detailed_progress_wrap .single_section_wrap {
				border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.bs-item-list.list-view .bs-item-wrap:not(.no-hover-effect):hover {
				border-left-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
				border-right-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
				border-bottom-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			@media screen and (max-width: 1024px) and (min-width: 768px) {
				.side-panel {
					background-color: <?php echo $body_bgr_color; ?>;
				}
			}

			.os-loader,
			.medium-editor-insert-plugin .medium-insert-buttons .medium-insert-buttons-addons li,
			.sap-publish-popup,
			.posts-stream,
			.posts-stream .inner,
			.sl-count:after,
			.sl-count:before,
			.sl-icon:after,
			.sl-icon:before,
			.main-navigation li ul ul,
			.main-navigation li ul,
			.header-account-login .pop .bp_components .menupop:not(#wp-admin-bar-my-account) > .ab-sub-wrapper,
			.header-account-login .pop .links li > .sub-menu,
			.header-account-login .pop .bp_components .menupop:not(#wp-admin-bar-my-account) > .ab-sub-wrapper:before,
			.header-account-login .pop .links li > .sub-menu:before,
			.header-notifications .pop,
			.header-account-login .pop,
			#whats-new-header:after,
			a.to-top,
			.bbp-forum-data:before {
				background-color: <?php echo $body_bgr_color; ?>;
			}

			.footer-widget-area {
				background-color: <?php echo buddyboss_theme_get_option( 'footer_widget_background' ); ?>;
			}

			.footer-bottom {
				background-color: <?php echo buddyboss_theme_get_option( 'footer_background' ); ?>;
			}

			/* Notices - Default */

			.login:not(.login-action-lostpassword) .message:not(.reset-pass),
			.login.login-action-lostpassword .message > .message,
			.buddypress-wrap .bp-feedback.help .bp-icon,
			.buddypress-wrap .bp-feedback.info .bp-icon,
			.widget-error .bp-feedback.help .bp-icon,
			.widget-error .bp-feedback.info .bp-icon {
				background-color: <?php echo buddyboss_theme_get_option( 'default_notice_bg_color' ); ?>;
			}
 
			/* Notices - Loading */

			.buddypress-wrap .bp-feedback.loading .bp-icon,
			.widget-error .bp-feedback.loading .bp-icon {
				background-color: <?php echo buddyboss_theme_get_option( 'info_notice_bg_color' ); ?>;
			}

			/* Notices - Success */

			.buddypress-wrap .bp-feedback.success .bp-icon,
			.widget-error .bp-feedback.success .bp-icon,
			.bp-feedback.success .bp-icon,
			.bp-feedback.updated .bp-icon {
				background-color: <?php echo $success_color; ?>;
			}

			#item-header.groups-header .bp-feedback.bp-feedback.success .bp-icon {
				color: <?php echo $success_color; ?>;
			}

			/* Notices - Error */

			.buddypress-wrap .bp-feedback.error .bp-icon,
			.widget-error .bp-feedback.error .bp-icon,
			.bp-feedback.error .bp-icon,
			.bp-feedback.warning .bp-icon,
			.buddypress-wrap .bp-feedback.warning .bp-icon,
			.widget-error .bp-feedback.warning .bp-icon,
			.login #login_error {
				background-color: <?php echo buddyboss_theme_get_option( 'error_notice_bg_color' ); ?>;
			}

			#item-header.groups-header .bp-feedback.bp-feedback.error .bp-icon {
				color: <?php echo buddyboss_theme_get_option( 'error_notice_bg_color' ); ?>;
			}

			.login #login_error {
				border-left-color: <?php echo buddyboss_theme_get_option( 'error_notice_bg_color' ); ?>;
			}

			span.count,
			.notification-wrap span.count {
				background-color: <?php echo $highlight_color; ?>;
			}

			/* Buttons */
			a.bbp-topic-reply-link,
			a.subscription-toggle,
			#buddypress .action .button,
			button,
			.button,
			input[type=button],
			input[type=submit],
			.buddypress .buddypress-wrap .comment-reply-link,
			.buddypress .buddypress-wrap .generic-button a,
			.buddypress .buddypress-wrap a.bp-title-button,
			.buddypress .buddypress-wrap a.button,
			.buddypress .buddypress-wrap button,
			.buddypress .buddypress-wrap input[type=button],
			.buddypress .buddypress-wrap input[type=reset],
			.buddypress .buddypress-wrap input[type=submit],
			.buddypress .buddypress-wrap ul.button-nav:not(.button-tabs) li a,
			button.small,
			.button.small,
			input[type=button].small,
			input[type=submit].small,
			.buddypress .buddypress-wrap .comment-reply-link.small,
			.buddypress .buddypress-wrap .generic-button a.small,
			.buddypress .buddypress-wrap a.bp-title-button.small,
			.buddypress .buddypress-wrap a.button.small,
			.buddypress .buddypress-wrap button.small,
			.buddypress .buddypress-wrap input[type=button].small,
			.buddypress .buddypress-wrap input[type=reset].small,
			.buddypress .buddypress-wrap input[type=submit].small,
			.buddypress .buddypress-wrap ul.button-nav:not(.button-tabs) li a.small,
			#buddypress .comment-reply-link,
			#buddypress .generic-button a,
			#buddypress .standard-form button,
			#buddypress a.button,
			#buddypress input[type=button],
			#buddypress input[type=reset],
			#buddypress input[type=submit],
			#buddypress ul.button-nav li a,
			a.bp-title-button,
			#buddypress .comment-reply-link.small,
			#buddypress .generic-button a.small,
			#buddypress .standard-form button.small,
			#buddypress a.button.small,
			#buddypress input[type=button].small,
			#buddypress input[type=reset].small,
			#buddypress input[type=submit].small,
			#buddypress ul.button-nav li a.small,
			a.bp-title-button.small,
			.ld-course-list-items .ld_course_grid .bb-cover-list-item p.ld_course_grid_button a {
				border-radius: <?php echo $button_radius; ?>px;
			}

			.no-results.not-found .search-form .search-submit {
				border-radius: 0 <?php echo $button_radius; ?>px <?php echo $button_radius; ?>px 0;
			}

		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;

		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_custom_css', $custom_css );

	}

	/* Add Action */
	add_action( 'wp_head', 'boss_generate_option_css', 99 );
}

if ( ! function_exists( 'boss_generate_option_bp_css' ) ) {

	function boss_generate_option_bp_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_bp_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
			<style id=\"buddyboss_theme-bp-style\">
				{$custom_css["css"]}
			</style>
			";

			return false;

		}

		$primary_color   = buddyboss_theme_get_option( 'accent_color' );
		$secondary_color = buddyboss_theme_get_option( 'accent_hover' );

		$admin_login_background_switch = buddyboss_theme_get_option( 'admin_login_background_switch' );
		$admin_login_background_media  = buddyboss_theme_get_option( 'admin_login_background_media' );
		$admin_login_overlay_opacity   = buddyboss_theme_get_option( 'admin_login_overlay_opacity' );
		$admin_login_heading_color     = buddyboss_theme_get_option( 'admin_login_heading_color' );
		$admin_logoimg                 = buddyboss_theme_get_option( 'admin_logo_media' );
		$admin_logowidth               = buddyboss_theme_get_option( 'admin_logo_width' );

		?>
		<style id="buddyboss_theme-bp-style">

		<?php ob_start(); ?>

			/* Primary color */
			#send-private-message.generic-button a:before,
			#buddypress #members-list .members-meta.action > .generic-button:last-child a,
			#buddypress #members-list .members-meta.action > .generic-button:last-child button,
			body #buddypress .bp-list .action .generic-button a,
			body #buddypress .bp-list .action .generic-button button,
			#buddypress .action .button.outline,
			#buddypress a.button.outline,
			#buddypress a.button.outline:hover,
			#buddypress input#bp_invites_reset,
			#buddypress .activity-list .action.activity-meta .button:hover,
			#buddypress .activity-list .action.activity-meta .button:hover span,
			#groups-list.bp-list.grid.bb-cover-enabled .item-avatar .generic-button .group-button,
			#buddypress .only-grid-view .follow-button .follow-button,
			.groups-header #item-header-content .generic-button .group-button,
			.mepr-price-menu.custom .mepr-price-box-benefits-item:before,
			.groups-header #item-header-content .generic-button .group-button:hover,
			.groups.group-admin #buddypress.buddypress-wrap.bp-single-vert-nav #item-body .bp-navs.group-subnav .selected a,
			#message-threads li.unread .thread-to:before,
			.messages-wrapper #compose-personal-li a,
			.media-privacy .selected,
			.activity-privacy .selected,
			.bp-search-results-wrap .view-all-link,
			.bp-search-results-wrap .view-all-link:hover,
			.bp-search-results-wrap .view-all-link:focus,
			.search-results .pagination-links a,
			#buddypress .generic-button a.outline,
			#buddypress .activity-lists .action.bp-generic-meta .button,
			#buddypress .activity-list .action.bp-generic-meta .button,
			#bbpress-forums .activity-list .action.bp-generic-meta .button,
			.recording-preview-img:hover span.triangle-play-icon,
			.activity-list .activity-item .bp-generic-meta.action .unfav:before,
			.activity-list .activity-item .bp-generic-meta.action .open-close-activity:before,
			.activity-list .activity-item .bp-generic-meta.action .buddyboss_edit_activity:before,
			.activity-list .activity-item .bp-generic-meta.action .buddyboss_edit_activity_cancel:before,
			.bb-activity-media-wrap .bb-activity-media-elem.document-activity .document-action-wrap .document-action_list ul li a:hover,
			#media-folder-document-data-table .media-folder_items .media-folder_actions .media-folder_action__list ul li a:hover,
			#bp-media-single-folder .bp-media-header-wrap .media-folder_items .media-folder_action__list ul li a:hover,
			#media-stream.media .bb-photo-thumb .media-action-wrap .media-action_list ul li a:hover,
			.bb-activity-media-wrap .bb-activity-media-elem.media-activity .media-action-wrap .media-action_list ul li a:hover,
			#buddypress .follow-button button.outline,
			#buddypress .follow-button button.outline:hover,
			#buddypress .follow-button button.outline:focus,
			#buddypress .standard-form button.outline,
			#buddypress .standard-form button.outline:hover,
			.video-js .vjs-play-progress:before,
			#video-stream.video .bb-item-thumb .item-action-wrap .item-action_list ul li a:hover,
			#media-stream.media .bb-video-thumb .item-action-wrap .item-action_list ul li a:hover,
			.bb-activity-video-wrap .bb-activity-video-elem .item-action-wrap .item-action_list ul li a:hover,
			.bb-activity-media-wrap .bb-activity-video-elem .video-action-wrap .media-action_list ul li a:hover,
			.bb-activity-media-wrap .bb-activity-video-elem .video-action-wrap .video-action_list ul li a:hover,
			.bb-media-model-container .activity-list .video-action-wrap.item-action-wrap .video-action_list ul li a:hover {
				color: <?php echo $primary_color; ?>;
			}
      
			#buddypress .bb_more_options .bb_more_options_list a:hover,
			#buddypress .bb_more_options .bb_more_options_list .block-member:hover,
			.topic .forum_single_action_wrap .forum_single_action_options .bb-topic-report-link-wrap a:hover,
			#buddypress .forum_single_action_wrap .forum_single_action_options .bb-topic-report-link-wrap a:hover,
			.bb_more_options .bb_more_options_list a:hover,
			#buddypress .bb_more_options .bb_more_options_list button:hover,
			#buddypress .activity-list .bb-activity-more-options-wrap .bb-activity-more-options .generic-button a:hover {
				color: <?php echo $primary_color; ?> !important;
			}

			#bbpress-forums#bbpress-forums .bs-forums-items.list-view .bs-dropdown-wrap .bs-dropdown-wrap-inner .bs-dropdown .bbp-admin-links a:hover {
				color: <?php echo $primary_color; ?>;
			}

			#buddypress .activity-lists .action.bp-generic-meta .button:hover,
			#buddypress .activity-list .action.bp-generic-meta .button:hover,
			#bbpress-forums .activity-list .action.bp-generic-meta .button:hover,
			#buddypress .activity-lists .action.bp-generic-meta .button:hover span,
			#buddypress .activity-list .action.bp-generic-meta .button:hover span,
			#bbpress-forums .activity-list .action.bp-generic-meta .button:hover span,
			.activity-list .activity-item .bp-generic-meta.action .unfav:hover:before,
			#buddypress .only-grid-view .follow-button .follow-button:hover,
			#groups-list.bp-list.grid.bb-cover-enabled .item-avatar .generic-button .group-button:hover,
			#certificate_list .bb-certificate-download a:hover,
			.bp-search-results-wrap .view-all-link:hover,
			.bp-search-results-wrap .view-all-link:hover:after,
			.activity-list .activity-item .bp-generic-meta.action .open-close-activity:hover:before,
			.activity-list .activity-item .bp-generic-meta.action .buddyboss_edit_activity:hover:before,
			.activity-list .activity-item .bp-generic-meta.action .buddyboss_edit_activity_cancel:hover:before,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-arrow-circle .comment-count:hover,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-arrow-circle .text:hover,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-discussion .comment-count:hover,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-discussion .text:hover,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-chat .comment-count:hover,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-chat .text:hover,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-arrow-circle .comment-count:hover:before,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-arrow-circle .text:hover:before,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-discussion .comment-count:hover:before,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-discussion .text:hover:before,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-chat .comment-count:hover:before,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-chat .text:hover:before {
				color: <?php echo $secondary_color; ?>;
			}

			#buddypress #members-list .members-meta.action > .generic-button:last-child a,
			#buddypress #members-list .members-meta.action > .generic-button:last-child button,
			body #buddypress .bp-list .action .generic-button a,
			body #buddypress .bp-list .action .generic-button button,
			.buddypress .buddypress-wrap button,
			.buddypress .buddypress-wrap button:hover,
			.buddypress .buddypress-wrap button:focus,
			#buddypress .follow-button button,
			#buddypress .follow-button button:hover,
			#buddypress .follow-button button:focus,
			#buddypress .follow-button button.outline,
			#buddypress .follow-button button.outline:hover,
			#buddypress .follow-button button.outline:focus,
			#buddypress .action .button,
			#buddypress .action .button.outline,
			#buddypress a.button.outline,
			#buddypress a.button.outline:hover,
			#buddypress input#bp_invites_reset,
			input:checked+.bb-time-meridian,
			.groups .bp-single-vert-nav #item-body #subnav .subnav .current a,
			.groups.group-admin #buddypress.buddypress-wrap.bp-single-vert-nav #item-body .bp-navs.group-subnav .selected a,
			.groups-header #item-header-content .generic-button .group-button:hover,
			.groups.group-admin #buddypress.buddypress-wrap.bp-single-vert-nav #item-body .bp-navs.group-subnav .selected a,
			.group-invites .bp-dir-hori-nav:not(.bp-vertical-navs) #item-body #group-invites-container .subnav li.selected,
			#buddypress .generic-button a.outline,
			#buddypress .standard-form button.outline,
			#buddypress .standard-form button.outline:hover {
				border-color: <?php echo $primary_color; ?>;
			}

			#buddypress .action .button,
			.video-js .vjs-play-progress,
			.dropzone .dz-preview .dz-progress .dz-upload {
				background: <?php echo $primary_color; ?>;
			}


			#buddypress form#whats-new-form #whats-new-submit input[type="submit"],
			#buddypress #group-settings-form input[type="submit"],
			#buddypress .standard-form div.submit input,
			#buddypress input[type=button],
			#buddypress .comment-reply-link,
			#buddypress .generic-button a,
			#buddypress .standard-form button,
			#buddypress a.button,
			#buddypress input[type="button"],
			#buddypress input[type="reset"],
			#buddypress input[type="submit"],
			#buddypress ul.button-nav li a,
			a.bp-title-button,
			.buddypress .buddypress-wrap button,
			.buddypress .buddypress-wrap button:hover,
			.buddypress .buddypress-wrap button:focus,
			#buddypress .follow-button button,
			#buddypress .follow-button button:hover,
			#buddypress .follow-button button:focus,
			.mepr-price-menu.custom .mepr-price-box-button a,
			body #buddypress .bp-list .action .generic-button .leave-group,
			body #buddypress a.export-csv,
			input:checked+.bb-time-meridian,
			input:checked+.bb-toggle-slider,
			.bb-groups-messages-left-inner input:checked + .bp-group-message-slider,
			.widget_bp_core_login_widget.buddypress #bp-login-widget-form #bp-login-widget-submit.bp-login-btn-active,
			#item-body #group-invites-container .bp-invites-content #send-invites-editor #bp-send-invites-form .action button#bp-invites-send,
			#message-threads li.unread .thread-date time:after,
			.buddypress-wrap .bp-subnavs ul #bp-zoom-switch-type .bb-toggle-switch .bb-toggle-slider,			
			#bbpress-forums div.bbp-reply-content a.bp-video-thumbnail-submit {
				background-color: <?php echo $primary_color; ?>;
			}

			#bbpress-forums .bbp-reply-form.bb-modal a#bbp-close-btn:hover,
			.bbp-reply-form-success-modal .bbp-reply-form-success .reply-content .content-title .close .js-modal-close:hover,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-arrow-circle .comment-count:before,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-arrow-circle .text:before,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-discussion .comment-count:before,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-discussion .text:before,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-chat .comment-count:before,
			.activity-list .activity-item .activity-inner .activity-inner-meta .button.bb-icon-chat .text:before,
			.activity-list li.bbp_topic_create .activity-content .activity-inner .activity-discussion-title-wrap a:hover,
			.activity-list li.bbp_reply_create .activity-content .activity-inner .activity-discussion-title-wrap a:hover,
			.activity-list li.blogs .activity-content .activity-inner .activity-discussion-title-wrap a:hover{
				color: <?php echo $primary_color; ?>;
			}

			.bp-navs ul li a,
			nav#object-nav a,
			#buddypress .bp-navs.bb-bp-tab-nav a,
			.widget.buddypress div.item-options a,
			body #buddypress .bp-list.members-list .action .generic-button button,
			body #buddypress .bp-list.members-list .action .generic-button a,
			.groups.group-admin #buddypress #item-body .bp-navs.group-subnav a,
			#item-body #group-invites-container .bp-navs.group-subnav a,
			#buddypress .profile.edit .button-nav a,
			.groups.group-create .buddypress-wrap .group-create-buttons li a,
			#page #buddypress #item-body .bp-profile-wrapper #subnav a,
			#buddypress .bp-settings-container .bp-navs a,
			#message-threads li .thread-content .thread-subject a,
			#message-threads li.unread .thread-subject .subject,
			.avatar-crop-management #avatar-crop-actions a.avatar-crop-cancel,
			.widget.activity_update .activity-update .activity-time-since,
			#media-folder-document-data-table .media-folder_items .media-folder_actions .media-folder_action__anchor {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_color' ); ?>;
			}

			.social-networks-wrap svg path {
				fill: <?php echo buddyboss_theme_get_option( 'alternate_link_color' ); ?>;
			}

			.bb-groups-messages-left-inner .input:focus + .bp-group-message-slider {
				box-shadow: 0 0 1px <?php echo $primary_color; ?>;
			}

			.bp-navs ul li a:hover,
			nav#object-nav a:hover,
			.buddypress-wrap .bp-navs li:not(.current) a:hover,
			.buddypress-wrap .bp-navs li:not(.selected) a:hover,
			#buddypress .bp-navs.bb-bp-tab-nav a:hover,
			.widget.buddypress div.item-options a:hover,
			.elementor-widget-wrap div.item-options a:hover,
			body #buddypress .bp-list.members-list .action .generic-button button:hover,
			body #buddypress .bp-list.members-list .action .generic-button a:hover,
			.groups.group-admin #buddypress #item-body .bp-navs.group-subnav a:hover,
			#item-body #group-invites-container .bp-navs.group-subnav a:hover,
			#buddypress .profile.edit .button-nav a:hover,
			#buddypress .bp-search-results-wrapper .bp-navs a:hover,
			.groups.group-create .buddypress-wrap .group-create-buttons li a:hover,
			#page #buddypress #item-body .bp-profile-wrapper #subnav a:hover,
			#buddypress .bp-settings-container .bp-navs a:hover,
			#message-threads li .thread-content .thread-subject a:hover,
			#message-threads li.unread .thread-subject .subject:hover,
			.avatar-crop-management #avatar-crop-actions a.avatar-crop-cancel:hover,
			.widget.activity_update .activity-update .activity-time-since:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			.bb-single-album-header .document-breadcrumb li a:hover{
				color: <?php echo buddyboss_theme_get_option( 'accent_hover' ); ?>;
			}

			.buddypress-wrap .bp-subnavs li.current a,
			.buddypress-wrap .bp-subnavs li.selected a,
			#buddypress .bp-navs.bb-bp-tab-nav .current a,
			#buddypress .bp-navs.bb-bp-tab-nav .selected a,
			.buddypress-wrap .bp-subnavs li.current a:focus,
			.buddypress-wrap .bp-subnavs li.selected a:focus,
			#buddypress .bp-navs.bb-bp-tab-nav .current a:focus,
			#buddypress .bp-navs.bb-bp-tab-nav .selected a:focus,
			.buddypress-wrap .bp-subnavs li.current a:hover,
			.buddypress-wrap .bp-subnavs li.selected a:hover,
			#buddypress .bp-navs.bb-bp-tab-nav .current a:hover,
			#buddypress .bp-navs.bb-bp-tab-nav .selected a:hover,
			.widget.buddypress div.item-options .selected,
			.widget.buddypress div.item-options .selected:hover,
			.elementor-widget-wrap div.item-options .selected,
			.bp-navs ul li.selected a,
			nav#object-nav .selected > a,
			.bp-navs ul li.selected a:hover,
			nav#object-nav .selected > a:hover,
			#buddypress .bp-search-results-wrapper .bp-navs .current a,
			#buddypress .bp-search-results-wrapper .bp-navs .selected a,
			.groups.group-admin #buddypress #item-body .bp-navs.group-subnav .current a,
			.groups.group-admin #buddypress #item-body .bp-navs.group-subnav .selected a,
			#item-body #group-invites-container .bp-navs.group-subnav .current a,
			#item-body #group-invites-container .bp-navs.group-subnav .selected a,
			#buddypress .profile.edit .button-nav .current a,
			.groups.group-create .buddypress-wrap .group-create-buttons li.current a,
			#page #buddypress #item-body .bp-profile-wrapper #subnav .selected a,
			#buddypress .bp-settings-container .bp-navs .current a,
			#buddypress .bp-settings-container .bp-navs .selected a,
			.buddypress-wrap .bp-subnavs ul #bp-zoom-switch-type > a.zoom_active,
			#group-messages-container .bp-navs.group-subnav li.selected a {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_active' ); ?>;
			}

			.groups.group-create .buddypress-wrap .group-create-buttons li:not(:last-child) a:after {
				background-color: <?php echo buddyboss_theme_get_option( 'alternate_link_color' ); ?>;
			}

			.buddypress-wrap .bp-subnavs li.current a,
			.buddypress-wrap .bp-subnavs li.selected a,
			.widget.buddypress div.item-options .selected,
			.elementor-widget-wrap div.item-options .selected,
			.bp-navs ul li.selected a,
			nav#object-nav .selected > a,
			body.invites.has-sidebar #buddypress .bp-settings-container .bp-navs .selected a,
			#buddypress .profile.edit .button-nav .current a,
			#group-messages-container .bp-navs.group-subnav li.selected {
				border-bottom-color: <?php echo $primary_color; ?>;
			}

			.buddypress-wrap .bp-navs li.current a .count,
			.buddypress-wrap .bp-navs li.dynamic.current a .count,
			.buddypress-wrap .bp-navs li.selected a .count,
			.buddypress_object_nav .bp-navs li.current a .count,
			.buddypress_object_nav .bp-navs li.selected a .count {
				background-color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			/* Headings link color */
			#buddypress .register-section .visibility-toggle-link,
			#buddypress .profile.edit .visibility-toggle-link,
			.widget.widget_bp_groups_widget .item-list .item-title a,
			.notification-content a,
			.groups.group-create .buddypress-wrap legend,
			.groups.group-create .buddypress-wrap label,
			.thread-to a,
			.messages-wrapper #inbox-personal-li a,
			.bp-messages-content #bp-message-thread-list .message-metadata .user-link,
			.widget.activity_update .activity-update p a:not(.activity-time-since),
			.bp-messages-content .thread-participants .participants-name a {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			#buddypress .register-section .visibility-toggle-link:hover,
			#buddypress .profile.edit .visibility-toggle-link:hover,
			.widget.widget_bp_groups_widget .item-list .item-title a:hover,
			.notification-content a:hover,
			.thread-to a:hover,
			.messages-wrapper #inbox-personal-li a:hover,
			.bp-messages-content #bp-message-thread-list .message-metadata .user-link:hover,
			.widget.activity_update .activity-update p a:not(.activity-time-since):hover,
			.bp-messages-content .thread-participants .participants-name a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			#header-cover-image,
			.bs-group-cover a:after {
				background-color: <?php echo buddyboss_theme_get_option( 'buddyboss_theme_group_cover_bg' ); ?>;
			}

			/* Body Text color */
			.buddypress-wrap .bp-feedback,
			.bs-meta-bp_group_description,
			.meeting-item-table .meeting-item .meeting-item-col .meeting-link,
			.bb-profile-meta .bs-meta-bp_group_description span span,
			.profile-single-meta .bs-meta-bp_group_description span span,
			.profile-item-header .bs-meta-bp_group_description span span,
			#buddypress table.profile-fields tr td.data,
			.buddypress-wrap .bp-feedback,
			#buddypress .bb-bp-settings-content label,
			.groups.group-admin #buddypress #item-body #group-settings-form label,
			.group-description,
			#media-folder-document-data-table .media-folder_items .media-folder_details .media-folder_name,
			.bp-zoom-group-show-instructions .bb-group-zoom-settings-container .bb-field-wrap label {
				color: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>;
			}

			.buddypress-wrap .bp-pagination,
			.ld-course-list-content .pagination,
			#buddypress span.activity,
			.activity-comments-items .activity-comment-text,
			#buddypress table.profile-fields tr td.label,
			#buddypress .bb-bp-settings-content .bp-help-text,
			#buddypress .bb-bp-settings-content .notification-settings th,
			#item-body #group-invites-container .bp-invites-content .item-meta .group-inviters li,
			.activity-list .activity-item .activity-content .activity-header,
			.widget.bp-latest-activities .activity-update,
			.activity-list .activity-item .activity-content .comment-header,
			.acomment-meta .activity-time-since,
			.widget_bp_core_members_widget #members-list .member_last_visit,
			.widget.buddypress span.activity,
			.bb-profile-meta,
			.bb-profile-card,
			.bb-profile-card .bb-field-description,
			.profile-single-meta,
			ul.bb-profile-fields .bb-label,
			.activity-item-header .item p,
			.activity-item-footer .like-count,
			.activity-item-footer .comment-count,
			.activity-comments-items .item-meta,
			.activity-date,
			.activity-list .activity-item .activity-header .time-since,
			.activity-list .activity-item .activity-header .activity-time-since:before,
			.bb-bp-messages-single #bp-message-thread-list .message-metadata time,
			.notification-content,
			.buddypress-wrap .current-visibility-level,
			.bb-sort-by-date,
			.bp-list li .item-meta,
			.bp-list li .meta,
			.groups.group-create .buddypress-wrap .group-create-buttons li span,
			.buddypress-wrap .item-list.groups-list .item-meta,
			.group-members-wrap.only-grid-view,
			.buddypress-wrap .bp-list li .last-activity,
			.buddypress-wrap .bp-list li .member-type,
			#message-threads li .thread-date,
			.bp-messages-content #bp-message-thread-list .message-metadata time,
			.bp-single-message-content .bp-message-content-wrap p.joined,
			#buddypress .single-headers .item-meta span,
			.buddypress-wrap .item-header-wrap .bp-title,
			#buddypress .bb-bp-invites-content .invite-info,
			#buddypress .bb-bp-invites-content label,
			.bp_ld_report_table_wrapper .bp_ld_report_table thead th,
			.widget.activity_update .activity-update p {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			.groups.group-create .buddypress-wrap .group-create-buttons li:not(:last-child) span:after {
				background-color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			/* Heading Text color */
			body.buddypress article.page > .entry-header .entry-title,
			body #buddypress div#item-header-cover-image h2,
			.groups.group-create .buddypress-wrap .bp-invites-content #members-list .list-title,
			#item-body #group-invites-container .bp-invites-content .list-title,
			.bp-messages-content .thread-participants,
			#buddypress .profile.edit > #profile-edit-form fieldset .editfield legend {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

            nav#object-nav,
            #buddypress .bp-navs.bb-bp-tab-nav,
            .groups.group-admin #buddypress #item-body .bp-navs.group-subnav,
            #item-body #group-invites-container .bp-navs.group-subnav,
            .bp-nouveau-activity-form-placeholder- #whats-new-avatar,
            .activity-update-form #whats-new-avatar,
            #item-body > div.profile p.bp-feedback,
            .groups.group-create .buddypress-wrap #group-create-tabs,
            .groups.group-create .buddypress-wrap #drag-drop-area,
            #create-group-form div#header-cover-image,
            #page #buddypress #item-body .bp-profile-wrapper #subnav,
            #buddypress .bp-settings-container .bp-navs,
            #buddypress.bp-single-vert-nav.bp-vertical-navs .bp-wrap nav#object-nav.vertical,
            #buddypress .activity-update-form .bpfb_form_container .bpfb_actions_container,
            .activity-list li.blogs .activity-content .activity-inner .bb-content-wrp,
            .activity-list li.bbp_topic_create .bb-content-inr-wrap,
            .activity-list li.bbp_reply_create .bb-content-inr-wrap {
                background-color: <?php echo buddyboss_theme_get_option( 'light_background_blocks' ); ?>;
			}

			#buddypress .activity-list.bp-list .activity-item,
			#cover-image-container,
			#members-list.item-list .list-wrap,
			.item-list.groups-list .list-wrap,
			.item-list.bp-search-results-list .list-wrap,
			#item-body > div.profile,
			.activity-update-form #whats-new-textarea textarea,
			.bb-bp-settings-container,
			.buddypress-wrap .bp-feedback,
			#item-body #group-invites-container,
			#buddypress .custom-homepage-info.info {
				background: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			#whats-new-form-placeholder,
			#whats-new-form,
			.activity-anonymous-options,
			.buddypress-wrap .bp-tables-user,
			.meeting-item-container,
			#buddypress .groups-manage-members-list .item-list > li,
			#item-body #group-invites-container .bp-invites-content .item-list > li,
			.messages-wrapper,
			.bp-messages-content #bp-message-thread-list li,
			.groups.group-create .buddypress-wrap,
			.groups.group-create .buddypress-wrap .bp-invites-content #members-list li,
			.bp-profile-wrapper,
			.bp-settings-container,
			#friend-list.item-list .list-wrap,
			.zoom-meeting-block,
			.media.document-parent,
			.bb-activity-media-wrap .bb-activity-media-elem.document-activity,
			#group-settings-form #request-list li,
			.reply-edit #bbpress-forums .bbp-reply-form .bbp-form .bbp-form .bbp-the-content-wrapper,
			.reply-edit #bbpress-forums .bbp-reply-form .bbp-form .bbp-form #whats-new-attachments,
			.reply-edit #bbpress-forums .bbp-reply-form .bbp-form .bbp-form #whats-new-toolbar,
			.topic-edit #bbpress-forums .bbp-topic-form .bbp-form .bbp-the-content-wrapper,
			.topic-edit #bbpress-forums .bbp-topic-form .bbp-form #whats-new-attachments,
			.topic-edit #bbpress-forums .bbp-topic-form .bbp-form #whats-new-toolbar {
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			@media screen and (max-width: 640px) {
				#buddypress .bp-settings-container .bp-navs a {
					color: <?php echo $primary_color; ?>;
				}
			}

			@media screen and (min-width: 768px) {
				.groups.group-create .buddypress-wrap #group-create-tabs.tabbed-links .group-create-buttons li.current {
					background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
				}
			}

			#buddypress .activity-list.bp-list .activity-item,
			.activity-anonymous-options,
			#cover-image-container,
			.meeting-item-container,
			.meeting-item-table .meeting-item-header,
			.meeting-item-table .meeting-item,
			.single-meeting-item-table .single-meeting-item,
			.meeting-item-container .load-more,
			#members-list.item-list .list-wrap,
			.item-list.groups-list .list-wrap,
			.item-list.bp-search-results-list .list-wrap,
			#item-body > div.profile,
			#whats-new-form-placeholder,
			#whats-new-form,
			.bb-bp-settings-container,
			#buddypress .bp-navs.bb-bp-tab-nav,
			.profile.public .bp-widget:not(:last-child),
			.buddypress-wrap .bp-feedback,
			#item-body #group-invites-container,
			#item-body #group-invites-container .bp-navs.group-subnav,
			nav#object-nav,
			.groups.group-admin #buddypress #item-body .bp-navs.group-subnav,
			.bp-avatar-nav ul,
			.bp-avatar-nav ul.avatar-nav-items li.current,
			#buddypress .groups-manage-members-list .item-list > li,
			#item-body #group-invites-container .bp-invites-content .item-list > li,
			#item-body #group-invites-container .bp-invites-content .item-list > li:last-child,
			#buddypress .custom-homepage-info.info,
			#item-body > div.profile p.bp-feedback,
			.messages-wrapper,
			.bb-bp-messages-single #bp-message-thread-list li,
			#bp-message-thread-list > li:first-child,
			.groups.group-create .buddypress-wrap,
			.groups.group-create .buddypress-wrap #group-create-tabs,
			.groups.group-create .buddypress-wrap #drag-drop-area,
			.groups.group-create .buddypress-wrap .bp-invites-content #members-list li,
			.bp-profile-wrapper,
			.profile-loop-header,
			.buddypress-wrap .profile.public .profile-group-title,
			.buddypress-wrap.bp-dir-hori-nav:not(.bp-vertical-navs) nav:not(.tabbed-links),
			#buddypress .only-grid-view.button-wrap.member-button-wrap.footer-button-wrap,
			#buddypress .only-grid-view.button-wrap.member-button-wrap.footer-button-wrap > .friendship-button,
			#page #buddypress #item-body .bp-profile-wrapper #subnav,
			.bp-settings-container,
			#buddypress .bp-settings-container .bp-navs,
			.bp-messages-head,
			.single.messages.view .bp-messages-nav-panel,
			.messages.compose .bp-messages-nav-panel,
			.bp-messages-content #bp-message-thread-list li:first-child,
			#friend-list.item-list .list-wrap,
			body:not(.group-admin):not(.group-invites) .buddypress-wrap .group-subnav.tabbed-links ul.subnav,
			body:not(.group-admin):not(.group-invites) .buddypress-wrap .user-subnav.tabbed-links ul.subnav,
			body:not(.group-admin):not(.group-invites) .buddypress-wrap .group-subnav.tabbed-links ul.subnav li.selected,
			body:not(.group-admin):not(.group-invites) .buddypress-wrap .user-subnav.tabbed-links ul.subnav li.selected,
			body:not(.group-admin):not(.group-invites) .buddypress-wrap.bp-vertical-navs .group-subnav.tabbed-links ul.subnav li.selected,
			body:not(.group-admin):not(.group-invites) .buddypress-wrap.bp-vertical-navs .user-subnav.tabbed-links ul.subnav li.selected,
			.groups.group-create .buddypress-wrap #group-create-tabs.tabbed-links .group-create-buttons li.current,
			.bp-messages-content #bp-message-thread-list,
			.zoom-meeting-block,
			.bb-media-container,
			.media-folder-document-filters,
			#media-folder-document-data-table .media-folder_items,
			.bb-activity-media-wrap .bb-activity-media-elem.document-activity,
			.media.document-parent,
			#group-settings-form #request-list li,
			.reply-edit #bbpress-forums .bbp-reply-form .bbp-form .bbp-form .bbp-the-content-wrapper,
			.reply-edit #bbpress-forums .bbp-reply-form .bbp-form .bbp-form #whats-new-attachments,
			.reply-edit #bbpress-forums .bbp-reply-form .bbp-form .bbp-form #whats-new-toolbar,
			.topic-edit #bbpress-forums .bbp-topic-form .bbp-form .bbp-the-content-wrapper,
			.topic-edit #bbpress-forums .bbp-topic-form .bbp-form #whats-new-attachments,
			.topic-edit #bbpress-forums .bbp-topic-form .bbp-form #whats-new-toolbar,
			.bp-step-nav-main .bp-step-nav ul,
			.bp-step-nav-main .bp-step-nav li.selected > a,
			.bp-messages-content-wrapper.has_error .bp-messages-feedback {
				border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.buddypress-wrap .bp-tables-report {
				box-shadow: 0 0 0 1px <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.messages-screen,
			.buddypress-wrap nav#object-nav.horizontal.group-nav-tabs ul li.selected a,
			.buddypress-wrap nav#object-nav.horizontal.user-nav-tabs ul li.selected a {
				border-left-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.buddypress-wrap nav#object-nav.horizontal.group-nav-tabs ul li.selected a,
			.buddypress-wrap nav#object-nav.horizontal.user-nav-tabs ul li.selected a {
				border-right-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.bp-avatar-nav ul.avatar-nav-items li.current {
				border-bottom-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			#item-body > div.profile h2.screen-heading,
			#buddypress .profile.edit .button-nav,
			.widget.buddypress div.item-options {
				border-bottom-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			@media screen and (max-width: 768px) {
				.messages-screen > .flex .bp-messages-content {
					border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
				}
			}

			@media screen and (min-width: 46.8em) {
				.bp-single-vert-nav .bp-wrap:not(.bp-fullwidth-wrap) {
					background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
				}

				.bp-single-vert-nav .bp-wrap:not(.bp-fullwidth-wrap) {
					border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
				}

				#buddypress.bp-single-vert-nav.bp-vertical-navs .bp-wrap nav#object-nav.vertical {
					border-right-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
				}
			}

			<?php
			if ( $admin_login_background_switch ) {
				if ( $admin_login_background_media['url'] ) {
					?>
					.login-split {
						background-image: url(<?php echo $admin_login_background_media['url']; ?>);
						background-size: cover;
						background-position: 50% 50%;
					}
					<?php
				}
			}
			if ( $admin_login_overlay_opacity ) {
				?>
				@media( min-width: 992px ) {
					body.buddypress.register.login-split-page .login-split .split-overlay,
					body.buddypress.activation.login-split-page .login-split .split-overlay {
						opacity: <?php echo $admin_login_overlay_opacity / 100; ?>;
					}
				}
				<?php
			}
			if ( $admin_login_heading_color ) {
				?>
				@media( min-width: 992px ) {
					body.buddypress.register.login-split-page .login-split > div {
						color: <?php echo $admin_login_heading_color; ?>;
					}
				}
				<?php
			}

			if ( ! empty( $admin_logoimg['url'] ) ) {
				?>
				body.buddypress.register .register-section-logo img,
				body.buddypress.activation .activate-section-logo img {
					width: <?php echo $admin_logowidth; ?>px;
				}
				<?php
			}

			$rx_admin_screen_background  = buddyboss_theme_get_option( 'admin_screen_bgr_color' );
			$rx_admin_screen_txt         = buddyboss_theme_get_option( 'admin_screen_txt_color' );
			$rx_admin_screen_links       = buddyboss_theme_get_option( 'admin_screen_links_color' );
			$rx_admin_screen_links_hover = buddyboss_theme_get_option( 'admin_screen_links_hover_color' );
			?>

			body.register.buddypress,
			body.register.buddypress .site,
			body.activate.buddypress {
				background-color: <?php echo $rx_admin_screen_background; ?>;
			}

			body.register.buddypress #primary,
			body.register.buddypress #primary label,
			.bs-bp-container-reg #buddypress #signup-form.standard-form label,
			.bs-bp-container-reg #buddypress #signup-form.standard-form legend,
			body.buddypress.register article.page > .entry-header .entry-title,
			body.buddypress.activation article.bp_activate .entry-header h1,
			body.buddypress.activation article.bp_activate label {
				color: <?php echo $rx_admin_screen_txt; ?>;
			}

			body.buddypress.register .register-section-logo a,
			.bs-bp-container-reg a {
				color: <?php echo $rx_admin_screen_links; ?>;
			}

			body.buddypress.register .register-section-logo a:hover,
			.bb-password-wrap a.bb-toggle-password:hover,
			.bs-bp-container-reg a:hover {
				color: <?php echo $rx_admin_screen_links_hover; ?>;
			}

			body.buddypress.register #buddypress input[type="submit"],
			body.buddypress.activation #buddypress input[type="submit"] {
				background-color: <?php echo $rx_admin_screen_links; ?>;
			}

			body.buddypress.register #buddypress input[type="submit"]:hover,
			body.buddypress.activation #buddypress input[type="submit"]:hover {
				background-color: <?php echo $rx_admin_screen_links_hover; ?>;
			}

			<?php $body_bgr_color = buddyboss_theme_get_option( 'body_background' ); ?>

			.buddypress-wrap nav#object-nav.horizontal.group-nav-tabs ul li.selected,
			.buddypress-wrap nav#object-nav.horizontal.user-nav-tabs ul li.selected {
				background-color: <?php echo $body_bgr_color; ?>;
			}

			.buddypress-wrap nav#object-nav.horizontal.group-nav-tabs ul li.selected a,
			.buddypress-wrap nav#object-nav.horizontal.user-nav-tabs ul li.selected a,
			body:not(.group-admin):not(.group-invites) .buddypress-wrap .group-subnav.tabbed-links ul.subnav li.selected,
			body:not(.group-admin):not(.group-invites) .buddypress-wrap .user-subnav.tabbed-links ul.subnav li.selected,
			.buddypress-wrap .user-subnav.tabbed-links ul.subnav li.selected {
				border-bottom-color: <?php echo $body_bgr_color; ?>;
			}

		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;

		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_bp_custom_css', $custom_css );

	}

	/* Add Action */
	if ( function_exists( 'bp_is_active' ) ) {
		add_action( 'wp_head', 'boss_generate_option_bp_css', 99 );
	}
}

if ( ! function_exists( 'boss_generate_option_forums_css' ) ) {
	function boss_generate_option_forums_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_forums_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
			<style id=\"buddyboss_theme-forums-style\">
				{$custom_css["css"]}
			</style>
			";

			return false;

		}

		$primary_color = buddyboss_theme_get_option( 'accent_color' );

		?>
		<style id="buddyboss_theme-forums-style">

		<?php ob_start(); ?>

			a.bbp-topic-reply-link,
			.bs-meta-item,
			.bbpress .scrubber .handle:after,
			.scrubber .handle:after,
			#member-invites-table .field-actions-add i {
				background-color: <?php echo $primary_color; ?>;
			}

			a.subscription-toggle,
			a.subscription-toggle:hover,
			.bbp_widget_login a.button.logout-link {
				color: <?php echo $primary_color; ?>;
			}

			.bbp_widget_login a.button.logout-link:hover {
				color: <?php echo buddyboss_theme_get_option( 'accent_hover' ); ?>;
			}

			.bs-forums-banner.has-banner-img h1,
			.bs-forums-banner.has-banner-img p {
				color: <?php echo buddyboss_theme_get_option( 'bbpress_banner_text' ); ?>;
			}

			a.subscription-toggle,
			a.subscription-toggle:hover {
				border-color: <?php echo $primary_color; ?>;
			}

			.bbpress .widget_display_forums li a,
			.bbpress-sidebar .widget_tag_cloud .tagcloud a,
			.bb-modal.bbp-topic-form .bbp-submit-wrapper a#bbp-close-btn,
			.bbp-mfp-zoom-in fieldset.bbp-form .bbp-submit-wrapper a#bbp-close-btn,
			#bbpress-forums .bbp-reply-form.bb-modal a#bbp-close-btn,
			#bbpress-forums .bbp-reply-form.bb-modal a#bbp-cancel-reply-to-link {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_color' ); ?>;
			}

			.bbpress .widget_display_forums li a:hover,
			.bbpress-sidebar .widget_tag_cloud .tagcloud a:hover,
			.bb-modal.bbp-topic-form .bbp-submit-wrapper a#bbp-close-btn:hover,
			.bbp-mfp-zoom-in fieldset.bbp-form .bbp-submit-wrapper a#bbp-close-btn:hover,			
			#bbpress-forums .bbp-reply-form.bb-modal a#bbp-cancel-reply-to-link:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			/* Headings link color */
			.item-title a,
			.bs-single-forum-list .item-meta a,
			.bbp_widget_login .bbp-logged-in h4 a,
			#bbpress-forums .bbp-reply-form.bb-modal fieldset.bbp-form > legend,
			#bbpress-forums#bbpress-forums .bs-forums-items .item-tags ul li a:hover,
			.bb-quick-reply-form-wrap .bbp-reply-form .bbp-form > legend #bbp-reply-exerpt,
			.bbp-reply-form-success-modal .bbp-reply-form-success .reply-content .content-title .activity-discussion-title-wrap a {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.item-title a:hover,
			.bs-single-forum-list .item-meta a:hover,
			.bbp_widget_login .bbp-logged-in h4 a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			.bb-cover-wrap,
			.activity-list li.blogs .activity-content .activity-inner .bb-post-img-link,
			.activity .activity .activity-list .bbp_reply_create .activity-inner .media-activity .bb-open-media-theatre,
			.activity .activity .activity-list .bbp_topic_create .activity-inner .bb-activity-media-wrap .bb-open-media-theatre {
				background: <?php echo buddyboss_theme_get_option( 'buddyboss_theme_group_cover_bg' ); ?>;
			}

			/* Body Text color */
			.bbpress .bp-feedback {
				color: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>;
			}

			.bbp-pagination-count,
			.bs-single-forum-list span.bs-timestamp,
			.bs-card-forum-details .bb-forum-content,
			.widget_display_replies > ul > li > div,
			span.topics-count,
			.bbpress .scrubber .desc,
			#bbpress-forums#bbpress-forums .bs-forums-items .item-tags ul li a,
			#bbpress-forums#bbpress-forums .bs-forums-items .item-tags .bb-icon-tag {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			#bbpress-forums fieldset.bbp-form legend,
			.bbpress .scrubber .handle {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			#bbpress-forums li.bs-item-wrap,
			.bs-card-list .bb-cover-list-item,
			#bbpress-forums .bs-single-forum-list > li,
			.bbpress .bp-feedback {
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			.bs-card-list .bb-cover-list-item,
			#bbpress-forums .bs-single-forum-list > li,
			.bbpress .bp-feedback,
			#member-invites-table th,
			#member-invites-table tr td,
			#buddypress #send-invite-form>label,
			#buddypress #send-invite-form>label span {
				border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.bbpress .widget_display_forums > ul.bb-sidebar-forums > li a:before {
				border-color: <?php echo textToColor( bbp_get_topic_forum_title() ); ?>;
			}

			.bbpress .widget_display_forums > ul.bb-sidebar-forums > li a:before {
				background-color: <?php echo color2rgba( textToColor( bbp_get_topic_forum_title() ), 0.5 ); ?>;
			}

		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;
		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_forums_custom_css', $custom_css );

	}

	/* Add Action */
	if ( class_exists( 'bbPress' ) ) {
		add_action( 'wp_head', 'boss_generate_option_forums_css', 99 );
	}
}

if ( ! function_exists( 'boss_generate_option_learndash_css' ) ) {
	function boss_generate_option_learndash_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_learndash_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
			<style id=\"buddyboss_theme-learndash-style\">
				{$custom_css["css"]}
			</style>
			";

			return false;

		}

		$primary_color        = buddyboss_theme_get_option( 'accent_color' );
		$success_color        = buddyboss_theme_get_option( 'success_notice_bg_color' );
		$danger_color         = buddyboss_theme_get_option( 'error_notice_bg_color' );
		$warning_color        = buddyboss_theme_get_option( 'warning_notice_bg_color' );
		$default_notice_color = buddyboss_theme_get_option( 'default_notice_bg_color' );
		$header_height        = buddyboss_theme_get_option( 'header_height' );
		$is_admin_bar         = is_admin_bar_showing() ? 32 : 0;

		$button_radius = buddyboss_theme_get_option( 'button_default_radius' );
		?>

		<style id="buddyboss_theme-learndash-style">

		<?php ob_start(); ?>

			/* Success color */
			.learndash-wrapper .ld-status.ld-status-complete,
			.learndash-wrapper .ld-course-status .ld-status.ld-status-complete,
			.bb-cover-list-item .ld-status-complete.ld-secondary-background,
			.learndash-wrapper .bb-ld-status .ld-status.ld-status-complete,
			.learndash-wrapper .bb-ld-info-bar .ld-breadcrumbs .ld-status.ld-status-complete,
			.learndash-wrapper .ld-alert-success .ld-button,
			.learndash-wrapper .ld-alert-success .ld-alert-icon.ld-icon,
			.wpProQuiz_content .wpProQuiz_addToplist .wpProQuiz_addToplistMessage,
			.wpProQuiz_modal_window #wpProQuiz_user_content .wpProQuiz_answerCorrect {
				background-color: <?php echo $success_color; ?>;
			}

			.leardash-course-status-completed {
				color: <?php echo $success_color; ?>;
			}

			.wpProQuiz_modal_window table th[style="color: green;"],
			.wpProQuiz_modal_window table td[style="color: green;"] {
				color: <?php echo $success_color; ?> !important;
			}

			.learndash-wrapper .ld-alert-success {
				border-color: <?php echo $success_color; ?>;
			}

			/* Danger color */
			.bb-assignments-list .bb-icon-close-circle {
				color: <?php echo $danger_color; ?>;
			}

			.wpProQuiz_modal_window table th[style="color: red;"],
			.wpProQuiz_modal_window table td[style="color: red;"] {
				color: <?php echo $danger_color; ?> !important;
			}

			.wpProQuiz_modal_window #wpProQuiz_user_content .wpProQuiz_answerIncorrect,
			#content li.wpProQuiz_questionListItem.wpProQuiz_answerIncorrect {
				border-color: <?php echo $danger_color; ?>;
			}

			/* Warning color */
			.learndash-wrapper .ld-alert-warning .ld-button {
				background-color: <?php echo $warning_color; ?>;
			}

			.learndash-wrapper .ld-alert-warning {
				border-color: <?php echo $warning_color; ?>;
			}

			/* Info Color */
			.learndash-wrapper .wpProQuiz_content .wpProQuiz_addToplist {
				border-color: <?php echo $default_notice_color; ?>;
			}

			.learndash-wrapper .bb-ld-tabs #learndash-course-content {
				top: -<?php echo $header_height + $is_admin_bar + 10; ?>px;
			}

			.wpProQuiz_content .wpProQuiz_results .quiz_continue_link a#quiz_continue_link {
				background:  <?php echo $primary_color; ?>;
			}

			.learndash-wrapper .ld-progress .ld-progress-bar .ld-progress-bar-percentage,
			.wpProQuiz_content .wpProQuiz_reviewDiv .wpProQuiz_reviewQuestion > ol li.wpProQuiz_reviewQuestionTarget,
			.wpProQuiz_content .wpProQuiz_reviewDiv .wpProQuiz_reviewQuestion > ol li.wpProQuiz_reviewQuestionTarget.wpProQuiz_reviewQuestionSolved,
			.wpProQuiz_content .wpProQuiz_reviewDiv .wpProQuiz_reviewQuestion > ol li.wpProQuiz_reviewQuestionTarget.wpProQuiz_reviewQuestionReview,
			.wpProQuiz_content .wpProQuiz_box > ol li.wpProQuiz_reviewQuestionTarget,
			.wpProQuiz_content .wpProQuiz_box > ol li.wpProQuiz_reviewQuestionTarget.wpProQuiz_reviewQuestionSolved,
			.wpProQuiz_content .wpProQuiz_box > ol li.wpProQuiz_reviewQuestionTarget.wpProQuiz_reviewQuestionReview,
			.wpProQuiz_content .wpProQuiz_results > div > .wpProQuiz_button[name="restartQuiz"],
			.wpProQuiz_content .wpProQuiz_resultTable table tr:nth-child(2) td:first-child:before,
			.wpProQuiz_sending dd.course_progress div.course_progress_blue,
			.bb-single-course-sidebar .btn-join,
			.bb-single-course-sidebar #btn-join,
			.bb-single-course-sidebar a.btn-advance,
			.btn-join,
			#btn-join,
			.ld-progress-bar .ld-progress-bar-percentage,
			.wpProQuiz_content .wpProQuiz_results > div > .wpProQuiz_button[name="restartQuiz"],
			.wpProQuiz_content .wpProQuiz_resultTable table tr:nth-child(2) td:first-child:before,
			.wpProQuiz_sending dd.course_progress div.course_progress_blue,
			.lms-topic-sidebar-progress .course-progress-bar,
			.bb-sfwd-aside.bb-dark-theme .lms-lesson-item.current > a .i-progress.i-progress-completed,
			.bb-sfwd-aside.bb-dark-theme .lms-topic-item.current > a .i-progress.i-progress-completed,
			.bb-sfwd-aside.bb-dark-theme .lms-quiz-item.current .i-progress.i-progress-completed,
			.wpProQuiz_content ul.wpProQuiz_questionList[data-type='matrix_sort_answer'] li ul.wpProQuiz_maxtrixSortCriterion li.wpProQuiz_sortStringItem.ui-sortable-helper,
			.wpProQuiz_content .wpProQuiz_matrixSortString .wpProQuiz_sortStringList.ui-sortable li.wpProQuiz_sortStringItem.ui-sortable-helper,
			.i-progress.i-progress-completed,
			.learndash-wrapper .learndash_content_wrap .learndash_mark_complete_button,
			.learndash-wrapper .ld-breadcrumbs .ld-status.ld-status-progress,
			.learndash-wrapper .ld-progress .ld-progress-bar .ld-progress-bar-percentage,
			.learndash-wrapper .ld-tabs .ld-tabs-navigation .ld-tab.ld-active:after,
			.learndash-wrapper .wpProQuiz_content .wpProQuiz_button,
			.learndash-wrapper .wpProQuiz_content .wpProQuiz_button2,
			.learndash-wrapper .wpProQuiz_content .wpProQuiz_button:hover,
			.learndash-wrapper .wpProQuiz_content .wpProQuiz_button2:hover,
			.learndash-wrapper .ld-file-upload .ld-file-upload-form .ld-button,
			.learndash-wrapper .ld-status-icon.ld-quiz-complete,
			.wpProQuiz_content .wpProQuiz_questionList[data-type='essay'] form input[type=file] + label,
			.learndash-wrapper .wpProQuiz_content input[type=radio].wpProQuiz_questionInput.bbstyled:checked + span:after,
			.learndash-wrapper .wpProQuiz_content input[type=checkbox].wpProQuiz_questionInput.bbstyled:checked + span,
			.learndash-wrapper #ld-profile .ld-item-search .ld-item-search-fields .ld-item-search-submit .ld-button,
			.learndash-wrapper .wpProQuiz_content .wpProQuiz_time_limit .wpProQuiz_progress,
			.ld-modal.ld-login-modal .ld-login-modal-form input[type='submit'],
			.learndash-wrapper .ld-button,
			#learndash-page-content .sfwd-course-nav .learndash_next_prev_link a:hover,
			.wpProQuiz_questionList[data-type="assessment_answer"] .wpProQuiz_questionListItem label.is-selected:before,
			.wpProQuiz_questionList[data-type="single"] .wpProQuiz_questionListItem label.is-selected:before,
			.wpProQuiz_questionList[data-type="multiple"] .wpProQuiz_questionListItem label.is-selected:before,
			.learndash-wrapper .bb-ld-status .ld-status.ld-status-progress,
			.ld-course-list-items .ld_course_grid .bb-cover-list-item p.ld_course_grid_button a {
				background-color:  <?php echo $primary_color; ?>;
			}

			.learndash-wrapper .ld-status-icon.ld-status-complete {
				background-color:  <?php echo $primary_color; ?> !important;
			}

			.group_courses ul.courses-group-list .bp-learndash-progress-bar progress::-moz-progress-bar {
				background-color:  <?php echo $primary_color; ?>;
			}

			.learndash-complete .ld-item-list-item-expanded .ld-table-list-items .ld-table-list-item .ld-table-list-item-quiz .ld-quiz-complete,
			.group_courses ul.courses-group-list .bp-learndash-progress-bar progress::-webkit-progress-value {
				background-color:  <?php echo $primary_color; ?>;
			}

			.wpProQuiz_content .wpProQuiz_button2,
			.wpProQuiz_content .wpProQuiz_results > div > .wpProQuiz_button,
			.bb_progressbar_label,
			.wpProQuiz_content .wpProQuiz_questionList[data-type='essay'] form input[type=submit],
			.lms-topic-sidebar-wrapper .lms-links ul li a,
			.lms-topic-sidebar-wrapper .lms-links ul li a:hover,
			.learndash-wrapper a,
			.learndash-wrapper .ld-tabs .ld-tabs-navigation .ld-tab.ld-active,
			#learndash-page-content .ld-focus-comments .ld-expand-button.ld-button-alternate,
			#learndash-page-content .ld-focus-comments .ld-comment-avatar .ld-comment-avatar-author a.ld-comment-permalink,
			#learndash-page-content .ld-focus-comments .form-submit #submit,
			.learndash-wrapper .ld-secondary-in-progress-icon,
			.widget_ldcoursenavigation .learndash-wrapper .ld-course-navigation-actions .ld-expand-button.ld-button-alternate,
			.ld-sidebar-widgets li.widget .widgettitle a {
				color:  <?php echo $primary_color; ?>;
			}

			.wpProQuiz_content .wpProQuiz_button2,
			.wpProQuiz_content .wpProQuiz_results > div > .wpProQuiz_button,
			.wpProQuiz_content .wpProQuiz_results > div > .wpProQuiz_button[name="restartQuiz"]:hover,
			.wpProQuiz_content .wpProQuiz_questionList[data-type='essay'] form input[type=submit],
			.wpProQuiz_content ul.wpProQuiz_questionList[data-type='matrix_sort_answer'] li ul.wpProQuiz_maxtrixSortCriterion li.wpProQuiz_sortStringItem.ui-sortable-helper,
			.wpProQuiz_content .wpProQuiz_matrixSortString .wpProQuiz_sortStringList.ui-sortable li.wpProQuiz_sortStringItem.ui-sortable-helper,
			.bb-progress .bb-progress-circle,
			.bb-sfwd-aside.bb-dark-theme .bb-progress .bb-progress-circle,
			.lms-topic-sidebar-wrapper .lms-links ul li a,
			.learndash-wrapper .wpProQuiz_content input[type=checkbox].wpProQuiz_questionInput.bbstyled:checked + span,
			.learndash-wrapper .wpProQuiz_content .wpProQuiz_questionListItem label.is-selected,
			.learndash-wrapper .wpProQuiz_content .wpProQuiz_questionListItem label:focus-within,
			#learndash-page-content .ld-focus-comments .comment .ld-comment-avatar > img,
			#learndash-page-content .ld-focus-comments .form-submit #submit,
			.wpProQuiz_questionList[data-type="multiple"] .wpProQuiz_questionListItem label.is-selected:before,
			.ld-course-list-items .ld_course_grid .bb-cover-list-item p.ld_course_grid_button a {
				border-color:  <?php echo $primary_color; ?>;
			}

			.bb-course-video-overlay .bb-course-play-btn:hover:after {
				border-color:  <?php echo 'transparent transparent transparent' . $primary_color; ?>;
			}

			.learndash-wrapper #ld-profile .ld-status-icon.ld-status-in-progress {
				border-right-color: <?php echo $primary_color; ?>;
			}

			.learndash-wrapper #ld-profile .ld-status-icon.ld-status-in-progress {
				border-bottom-color: <?php echo $primary_color; ?>;
			}

			.learndash-wrapper a.subscription-toggle {
				border-bottom-color: <?php echo $primary_color; ?> !important;
			}

			.learndash-wrapper .ld-loading::before {
				border-top-color: <?php echo $primary_color; ?>;
			}

			.quiz_progress_container #quiz_shape_progress {
				stroke: <?php echo $primary_color; ?>;
			}

			.lms-topic-sidebar-wrapper,
            .lms-topic-sidebar-data {
				background-color: <?php echo buddyboss_theme_get_option( 'body_background' ); ?>;
			}

			.ld-modal.ld-login-modal.ld-can-register .ld-login-modal-register {
				background-color: <?php echo $primary_color; ?>;
			}

			.bb-quiz-list .bb-quiz-icon g {
				stroke: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>;
			}

			.widget_ldcourseinfo #ld_course_info > h4 {
				stroke: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			.learndash-wrapper .ld-item-list-item-expanded .ld-table-list-items .ld-table-list-item .ld-table-list-item-quiz .ld-item-title,
			.learndash-wrapper .ld-table-list .ld-table-list-items div.ld-table-list-item a.ld-table-list-item-preview .ld-topic-title:before,
			.learndash-wrapper .ld-table-list .ld-table-list-items div.ld-table-list-item a.ld-table-list-item-preview .ld-topic-title,
			.learndash-wrapper .learndash_content_wrap .ld-table-list-item-quiz .ld-item-title,
			.learndash-wrapper .ld-item-list .ld-item-list-item.ld-item-lesson-item .ld-item-list-item-preview .ld-item-details .ld-icon-arrow-down,
			.learndash-wrapper .ld-item-list .ld-item-list-item.ld-item-lesson-item .ld-item-list-item-preview .ld-item-name .ld-item-title .lms-is-locked-ico i,
			.learndash-wrapper .ld-item-list .ld-item-list-item .ld-item-name,
			.learndash-wrapper .ld-item-list .ld-item-list-item.ld-item-lesson-item .ld-item-list-item-preview .ld-item-name .ld-item-title .ld-item-components span,
			.bb-type-list li a,
			.lms-quiz-list li a,
			.learndash_next_prev_link a,
			#buddypress ul.courses-group-list .course-link a.button,
			.learndash-wrapper .ld-pagination .ld-pages a,
			.learndash-wrapper #ld-profile .ld-item-list-item-expanded .ld-table-list .ld-table-list-item-preview .ld-table-list-title a {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_color' ); ?>;
			}

			.bb-type-list li a:hover,
			.lms-quiz-list li a:hover,
			.learndash_next_prev_link a:hover,
			#buddypress ul.courses-group-list .course-link a.button:hover,
			.learndash-wrapper .ld-pagination .ld-pages a:hover,
			.learndash-wrapper #ld-profile .ld-item-list-item-expanded .ld-table-list .ld-table-list-item-preview .ld-table-list-title a:hover,
			.learndash-wrapper .ld-item-list .ld-item-list-item a.ld-item-name:hover,
			#certificate_list .bb-certificate-title a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			.bb-courses-directory .bp-navs .selected .count {
				background-color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			/* Headings link color */

			.bb-lesson-head,
			.bb-about-instructor h5 a,
			.bb_profile_course_wrapper a,
			#quiz_progress_details p a,
			.lms-topic-sidebar-wrapper .lms-lessions-list > ol li a.bb-lesson-head,
			.lms-topic-sidebar-wrapper .lms-course-quizzes-list > ul li a,
			.learndash_course_content .bb-lessons-list li a.bb-lesson-head,
			.learndash_course_content .bb-quiz-list a,
			.bb-type-list.bb-lms-list-inside a,
			.bb-quiz-list a,
			.lms-header-instructor .bb-about-instructor h5 a,
			.lms-topic-sidebar-wrapper .lms-course-members-list .course-members-list a,
			.lms-topic-sidebar-wrapper .group-exec-list a .lms-group-lead span:first-child,
			.lms-topic-sidebar-wrapper .lms-group-flag .lms-group-heading a span,
			.lms-topic-sidebar-wrapper .course-group-list a,
			.learndash-wrapper .bb-ld-info-bar .ld-breadcrumbs .ld-breadcrumbs-segments span a,
			.bb-course-meta strong a,
			.learndash-wrapper .ld-alert .ld-alert-content a,
			#certificate_list .bb-certificate-date {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.learndash-wrapper .ld-table-list .ld-table-list-items div.ld-table-list-item a.ld-table-list-item-preview:hover .ld-topic-title:before,
			.learndash-wrapper .ld-item-list-item-expanded .ld-table-list-items .ld-table-list-item .ld-table-list-item-quiz .ld-table-list-item-preview:hover .ld-item-title,
			.learndash-wrapper .ld-table-list .ld-table-list-items div.ld-table-list-item a.ld-table-list-item-preview:hover .ld-topic-title,
			.learndash-wrapper .learndash_content_wrap .ld-table-list-item-quiz:hover .ld-item-title,
			.learndash-wrapper .ld-item-list .ld-item-list-item .ld-item-list-item-preview:hover .ld-item-details .ld-expand-button .ld-icon,
			.learndash-wrapper .ld-item-list .ld-item-list-item.ld-item-lesson-item .ld-item-list-item-preview:hover .ld-item-name .ld-item-title .ld-item-components span,
			.learndash-wrapper .ld-item-list .ld-item-list-item .ld-item-list-item-preview:hover a.ld-item-name .ld-item-title,
			.bb-course-meta strong a:hover,
			#page .bb-course-title a:hover,
			.bb-lesson-head:hover,
			.bb-about-instructor h5 a:hover,
			.bb_profile_course_wrapper a:hover,
			#quiz_progress_details p a:hover,
			.lms-topic-sidebar-wrapper .lms-lessions-list > ol li a.bb-lesson-head:hover,
			.lms-topic-sidebar-wrapper .lms-course-quizzes-list > ul li a:hover,
			.learndash_course_content .bb-lessons-list li a.bb-lesson-head:hover,
			.learndash_course_content .bb-quiz-list a:hover,
			.bb-type-list.bb-lms-list-inside a:hover,
			.bb-quiz-list a:hover,
			.group_courses ul.courses-group-list .course-name a:hover,
			.lms-header-instructor .bb-about-instructor h5 a:hover,
			.lms-topic-sidebar-wrapper .lms-course-members-list .course-members-list a:hover,
			.lms-topic-sidebar-wrapper .group-exec-list a:hover .lms-group-lead span:first-child,
			.lms-topic-sidebar-wrapper .lms-group-flag .lms-group-heading a:hover span,
			.lms-topic-sidebar-wrapper .course-group-list a:hover,
			.learndash-wrapper .bb-ld-info-bar .ld-breadcrumbs .ld-breadcrumbs-segments span a:hover,
			.bb-course-meta strong a:hover,
			.learndash-wrapper .ld-alert .ld-alert-content a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			/* Body Text color */
			.bb-course-categories,
			.bb-single-course-sidebar h4,
			.lms-topic-sidebar-instructor .bb-about-instructor > h4,
			.lms-topic-sidebar-course-navigation .ld-course-navigation .course-entry-title,
			.lms-topic-sidebar-wrapper .ld-item-list-section-heading .ld-lesson-section-heading,
			.learndash-wrapper .ld-item-list.ld-lesson-list .ld-lesson-section-heading,
			.learndash-wrapper #ld-profile .ld-profile-summary .ld-profile-card .ld-profile-heading,
			.learndash-wrapper #ld-profile .ld-profile-summary .ld-profile-stats .ld-profile-stat strong,
			.learndash-wrapper #ld-profile .ld-progress-label,
			.bb-course-footer,
			.learndash-wrapper .ld-login-modal .ld-login-modal-form label,
			.learndash-wrapper .ld-login-modal .ld-login-modal-login .ld-modal-heading {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.learndash-wrapper .ld-expand-button,
			.learndash-wrapper .ld-course-status .ld-status.ld-status-progress,
			.single-sfwd-courses .learndash-wrapper .ld-progress .ld-progress-stats,
			.wpProQuiz_content .wpProQuiz_catOverview span.wpProQuiz_catName,
			.bp-feedback.ld-feedback {
				color: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>;
			}

			.bb-course-meta,
			.bb-about-instructor .bb-author-meta,
			.wpProQuiz_content .wpProQuiz_listItem > .wpProQuiz_header + span,
			.wpProQuiz_content .wpProQuiz_results .wpProQuiz_quiz_time,
			.bb_progressbar_points,
			.wpProQuiz_content .wpProQuiz_catOverview span.wpProQuiz_catPercent,
			.bb-single-course-sidebar .bb-button-wrap .bb-course-type,
			.widget_ldcourseinfo #ld_course_info > h4,
			.group_courses ul.courses-group-list .bp-learndash-progress-bar-percentage,
			.wpProQuiz_content .wpProQuiz_results .wpProQuiz_graded_points,
			.lms-topic-sidebar-progress .course-completion-rate,
			.lms-topic-sidebar-progress .ld-progress-steps,
			.lms-header-instructor .bb-about-instructor .bb-about-instructor-date,
			.bb-lesson-head .bb-lesson-topics-count,
			#learndash-page-content .sfwd-course-nav .sfwd-course-expire i,
			.bb-type-list.bb-lms-list-inside li > a .bb-lms-title:before,
			.bb-quiz-list-container .bb-quiz-list .bb-quiz-topic-status-wrap span.flex-1:before,
			.lms-topic-sidebar-wrapper .lms-group-flag .lms-group-heading > span,
			.lms-topic-sidebar-wrapper .group-exec-list a .lms-group-lead span:last-child,
			.learndash-wrapper .ld-progress .ld-progress-stats,
			.bb-course-items .ld-progress-stats,
			.ld-course-list-items .ld-progress-stats,
			.bb-learndash-wrapper.bb-course-item-wrap .ld-progress-stats,
			.group_courses .ld-progress-stats,
			.course-lesson-count,
			.bb-course-items .bb-course-excerpt,
			body.buddypress .buddypress-wrap .group_courses .bb-course-excerpt,
			.learndash-wrapper .ld-file-upload .ld-file-upload-form .ld-file-input+label span,
			.learndash-wrapper .ld-pagination,
			.learndash-wrapper .ld-table-list .ld-table-list-header .ld-table-list-lesson-details,
			.learndash-wrapper #ld-profile .ld-item-search .ld-closer,
			.learndash-wrapper #ld-profile .ld-item-search .ld-item-search-name > label,
			.learndash-wrapper #ld-profile .ld-item-search .ld-item-search-fields .ld-reset-button,
			.learndash-wrapper #ld-profile .ld-table-list .ld-table-list-items .ld-table-list-column,
			.learndash-wrapper #ld-profile .ld-profile-summary .ld-profile-stats .ld-profile-stat span,
			.learndash-wrapper #ld-profile .ld-table-list .ld-table-list-header .ld-table-list-columns .ld-table-list-column,
			.learndash-wrapper .ld-table-list .ld-table-list-header,
			.learndash-wrapper #ld-profile .ld-item-list-item-expanded .ld-table-list-header,
			.ld-course-list-content .ld-course-list-items .bb-course-excerpt,
			.learndash-wrapper .ld-login-modal .ld-login-modal-login .ld-modal-text,
			#certificate_list .bb-certificate-title span,
			#certificate_list .bb-certificate-date span {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			.lms-header-instructor .bb-about-instructor .bb-about-instructor-date:before {
				background-color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			.thumbnail-container,
			.bb-learndash-banner {
				background-color: <?php echo buddyboss_theme_get_option( 'buddyboss_theme_group_cover_bg' ); ?>;
			}

			.group_courses ul.courses-group-list li.item-entry .item-avatar > a {
				background: <?php echo buddyboss_theme_get_option( 'buddyboss_theme_group_cover_bg' ); ?>;
			}

			.wpProQuiz_content .wpProQuiz_quiz .wpProQuiz_response {
				background-color: <?php echo buddyboss_theme_get_option( 'light_background_blocks' ); ?>;
			}

			.wpProQuiz_modal_window #wpProQuiz_user_content .wpProQuiz_response,
			.wpProQuiz_modal_window #wpProQuiz_user_content .wpProQuiz_questionList {
				background-color: <?php echo buddyboss_theme_get_option( 'light_background_blocks' ); ?> !important;
			}

			.wpProQuiz_modal_window #wpProQuiz_user_content .wpProQuiz_questionList {
				border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?> !important;
			}

			.bb-course-items .bb-cover-list-item,
			#learndash-page-content,
			.wpProQuiz_content .wpProQuiz_questionList li.wpProQuiz_questionListItem,
			.wpProQuiz_content .wpProQuiz_catOverview span,
			.wpProQuiz_content .wpProQuiz_addToplist,
			.bb-course-preview-content,
			.bp-feedback.ld-feedback,
			.group_courses ul.courses-group-list li.item-entry .list-wrap,
			.bb-about-instructor > .bb-grid,
			#certificate_list .bb-certificate-wrap {
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}


			.wpProQuiz_content .wpProQuiz_questionList[data-type='single'] li.wpProQuiz_questionListItem,
			.wpProQuiz_content .wpProQuiz_questionList[data-type='multiple'] li.wpProQuiz_questionListItem,
			.wpProQuiz_content .wpProQuiz_questionList.ui-sortable li.wpProQuiz_questionListItem,
			.wpProQuiz_content .wpProQuiz_questionList[data-type='essay'] form,
			.wpProQuiz_content .wpProQuiz_quiz .wpProQuiz_response,
			.lms-topic-sidebar-wrapper .lms-links,
			.bb-courses-directory .grid-filters,
			.bb-courses-directory .bp-navs,
			.bb_profile_course_wrapper,
			#quiz_progress_details > p,
			.bp-feedback.ld-feedback,
			.group_courses ul.courses-group-list li.item-entry .list-wrap,
			.wpProQuiz_content ul.wpProQuiz_questionList[data-type='matrix_sort_answer'] li table td,
			.lms-topic-sidebar-wrapper .lms-course-quizzes-list .lms-course-quizzes-heading,
			.lms-topic-sidebar-wrapper .lms-course-members-list .lms-course-sidebar-heading,
			.lms-topic-sidebar-progress .course-progress-wrap,
			.bb-about-instructor > .bb-grid,
			.bb-course-items .bb-cover-list-item,
			.ld-course-list-items .bb-cover-list-item,
			.wpProQuiz_content .wpProQuiz_reviewDiv,
			#certificate_list .bb-certificate-wrap {
				border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.learndash-wrapper .ld-status-unlocked,
			.learndash-wrapper .ld-course-status .ld-status.ld-status-progress,
			.single-sfwd-courses .learndash-wrapper .ld-progress .ld-progress-bar{
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}


			.wpProQuiz_content .wpProQuiz_addToplist {
				border-top-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			#learndash-page-content,
			.wpProQuiz_content .wpProQuiz_catOverview li {
				border-bottom-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}


			#learndash-tooltips .ld-tooltip {
				background-color:<?php echo buddyboss_theme_get_option( 'tooltip_background' ); ?>;
				color:<?php echo buddyboss_theme_get_option( 'tooltip_color' ); ?>;
			}

			#learndash-tooltips .ld-tooltip:after{
				background-color:<?php echo buddyboss_theme_get_option( 'tooltip_background' ); ?>;
			}

			.learndash-wrapper .ld-alert-warning .ld-button {
				background-color:<?php echo $warning_color; ?>;
			}

			.learndash-wrapper .ld-alert-warning {
				border-color:<?php echo $warning_color; ?>;
			}

			.learndash-wrapper .ld-alert-warning {
				background-color:<?php echo color2rgba( $warning_color, 0.1 ); ?>;
			}

			/* Buttons */
			.bb-single-course-sidebar a.btn-advance,
			.learndash-wrapper .bb-single-course-sidebar .ld-status,
			.learndash-wrapper .learndash_content_wrap .learndash_mark_complete_button,
			.learndash-wrapper .ld-button,
			.learndash-wrapper .wpProQuiz_content .wpProQuiz_button,
			.learndash-wrapper .wpProQuiz_content .wpProQuiz_button2,
			.bb-single-course-sidebar .btn-join, .bb-single-course-sidebar #btn-join,
			.lms-topic-sidebar-course-navigation a.course-entry-link {
				border-radius: <?php echo $button_radius; ?>px;
			}

			.learndash_next_prev_link a.next-link,
			.learndash_next_prev_link span.next-link {
				border-radius: 0 <?php echo $button_radius; ?>px <?php echo $button_radius; ?>px 0;
			}

			.learndash_next_prev_link a.prev-link,
			.learndash_next_prev_link span.prev-link {
				border-radius: <?php echo $button_radius; ?>px 0 0 <?php echo $button_radius; ?>px;
			}


		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;

		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_learndash_custom_css', $custom_css );

	}

	/* Add Action */
	if ( class_exists( 'SFWD_LMS' ) ) {
		add_action( 'wp_head', 'boss_generate_option_learndash_css', 99 );
	}
}

if ( ! function_exists( 'boss_generate_option_woocommerce_css' ) ) {
	function boss_generate_option_woocommerce_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_woocommerce_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
			<style id=\"buddyboss_theme-woocommerce-style\">
				{$custom_css["css"]}
			</style>
			";

			return false;

		}

		$primary_color   = buddyboss_theme_get_option( 'accent_color' );
		$highlight_color = buddyboss_theme_get_option( 'highlight_color' );
		$danger_color    = buddyboss_theme_get_option( 'error_notice_bg_color' );
		$success_color   = buddyboss_theme_get_option( 'success_notice_bg_color' );

		$button_radius = buddyboss_theme_get_option( 'button_default_radius' );

		?>
		<style id="buddyboss_theme-woocommerce-style">

		<?php ob_start(); ?>

			/* Success color */
			.woocommerce-checkout .woocommerce-order-over h2.woocommerce-heading--success i,
			.woocommerce-checkout .woocommerce-order-over h2.woocommerce-heading--success span i {
				color: <?php echo $success_color; ?>;
			}

			.woocommerce-checkout .woocommerce-order-over h2.woocommerce-heading--success i,
			.woocommerce-checkout .woocommerce-order-over h2.woocommerce-heading--success span i {
				border-color: <?php echo $success_color; ?>;
			}

			/* Danger color */
			.woocommerce .woocommerce-MyAccount-content form .form-row .required,
			.woocommerce #content div.product div.summary .product_meta .pr-atts-row p.out-of-stock,
			.woocommerce .woocommerce-error:before,
			.woocommerce-checkout form .form-row.woocommerce-invalid label {
				color: <?php echo $danger_color; ?>;
			}

			.woocommerce .woocommerce-error {
				background-color: <?php echo $danger_color; ?>;
			}

			.woocommerce-checkout form .form-row.woocommerce-invalid input.input-text,
			.woocommerce-checkout form .form-row.woocommerce-invalid select,
			.woocommerce-checkout form .form-row.woocommerce-invalid .select2-container {
				border-color: <?php echo $danger_color; ?>;
			}

			/* Primary color */
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.widget_shopping_cart.woocommerce a.button,
			.widget_shopping_cart.woocommerce a.button:hover,
			.woocommerce #respond input#submit.alt,
			.woocommerce #respond input#submit,
			.woocommerce a.button.alt,
			.woocommerce button.button.alt,
			.woocommerce input.button.alt,
			.woocommerce a.button:not(.signin-button):not(.wc-forward):hover,
			.woocommerce button.button,
			.woocommerce input.button,
			.woocommerce .site-content nav.woocommerce-pagination ul li .current,
			.woocommerce #content div.product form.cart .button,
			.woocommerce li.product a.added_to_cart.wc-forward:hover,
			.woocommerce li.product a.button.add_to_cart_button:hover,
			.woocommerce li.product a.button.product_type_external:hover,
			.woocommerce li.product a.button.product_type_grouped:hover,
			.woocommerce li.product a.button.product_type_simple:hover,
			.woocommerce li.product a.button.product_type_variable:hover,
			.woocommerce .woocommerce-message .button,
			.woocommerce .woocommerce-message .button:hover,
			.woocommerce-cart .wc-proceed-to-checkout a.button.checkout-button,
			.woocommerce-cart .wc-proceed-to-checkout a.button.checkout-button:hover,
			.woocommerce form button.button,
			.woocommerce form button.button:hover,
			.woocommerce-checkout #payment #place_order,
			.woocommerce-checkout #payment #place_order:hover,
			.woocommerce .woocommerce-info .button,
			.woocommerce .woocommerce-info .button:hover,
			.woocommerce table.my_account_orders tbody td a.button,
			.woocommerce table.my_account_orders tbody td a.button:hover,
			.woocommerce #content div.product #reviews p.form-submit input#submit,
			.woocommerce-checkout #payment li.wc_payment_method input.input-radio:checked::before,
			.woocommerce-checkout input[type=checkbox]:checked + span:before,
			input[type=checkbox]#wp-comment-cookies-consent:checked + label:before,
			.woocommerce-product-search button {
				background-color: <?php echo $primary_color; ?>;
			}

			.woocommerce-cart.woocommerce-page .bb_cart_totals_ctrls a.button,
			.woocommerce-cart.woocommerce-page .bb_cart_totals_ctrls a.button:hover,
			.woocommerce-cart table.shop_table td.actions > button.button,
			.woocommerce-cart table.shop_table td.actions > button.butto:hover,
			.woocommerce-checkout input[type=checkbox]:checked + span:before,
			input[type=checkbox]#wp-comment-cookies-consent:checked + label:before {
				border-color: <?php echo $primary_color; ?>;
			}

			.woocommerce li.product .price,
			.woocommerce ul.products li.product .price,
			.woocommerce div.product p.price,
			.woocommerce div.product span.price,
			.woocommerce [type='checkbox']:checked + span,
			.widget .woocommerce-product-search button i:before,
			.woocommerce li.product a.added_to_cart.wc-forward,
			.woocommerce li.product a.button.add_to_cart_button,
			.woocommerce li.product a.button.product_type_external,
			.woocommerce li.product a.button.product_type_grouped,
			.woocommerce li.product a.button.product_type_simple,
			.woocommerce li.product a.button.product_type_variable,
			.woocommerce-cart.woocommerce-page .bb_cart_totals_ctrls a.button.outline,
			.woocommerce-cart table.shop_table td.actions > button.button,
			.woocommerce-cart table.shop_table td.actions > button.button:disabled:hover,
			.header-mini-cart p.woocommerce-mini-cart__buttons a.button {
				color: <?php echo $primary_color; ?>;
			}

			.header-mini-cart p.woocommerce-mini-cart__buttons a.button:hover {
				color: <?php echo buddyboss_theme_get_option( 'accent_hover' ); ?>;
			}

			.woocommerce-checkout [type='checkbox']:checked + span:before {
				-webkit-box-shadow: 0px 0px 0px 1px <?php echo $primary_color; ?>;
				-moz-box-shadow: 0px 0px 0px 1px <?php echo $primary_color; ?>;
				box-shadow: 0px 0px 0px 1px <?php echo $primary_color; ?>;
			}

			.woocommerce .woocommerce-MyAccount-navigation ul li a,
			.woocommerce table.my_account_orders tbody td.woocommerce-orders-table__cell-order-number a,
			article.job_listing ul.job-listing-meta li.location a,
			.header-mini-cart ul.cart_list li.mini_cart_item > a.remove,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li a {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_color' ); ?>;
			}

			.woocommerce .woocommerce-MyAccount-navigation ul li a:hover,
			.woocommerce table.my_account_orders tbody td.woocommerce-orders-table__cell-order-number a:hover,
			article.job_listing ul.job-listing-meta li.location a:hover,
			.header-mini-cart ul.cart_list li.mini_cart_item > a.remove:hover,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			.woocommerce .woocommerce-MyAccount-navigation ul li.is-active a,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a,
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_active' ); ?>;
			}

			.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active {
				border-bottom-color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			/* Headings link color */
			.woocommerce table.shop_table td.product-name a,
			.header-mini-cart ul.cart_list li.mini_cart_item > a {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.woocommerce table.shop_table td.product-name a:hover,
			.header-mini-cart ul.cart_list li.mini_cart_item > a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			/* Body Text color */
			.woocommerce .woocommerce-MyAccount-content .woocommerce-account-fields legend,
			.woocommerce #content div.product p.price,
			.woocommerce-cart .cart-collaterals table.shop_table th,
			.woocommerce-cart .cart-collaterals table.shop_table td,
			.cart_totals table.shop_table tr.order-total th,
			.woocommerce table.shop_table td.product-price,
			.woocommerce table.shop_table td.product-subtotal,
			.woocommerce-checkout .bb-wc-co table.shop_table .check-name,
			.woocommerce-checkout .bb-wc-co table.shop_table td.product-total,
			.woocommerce-checkout .bb-wc-co table.shop_table .qty strong,
			.woocommerce-checkout .bb-wc-co table.shop_table tfoot .order-total th,
			.woocommerce-checkout .bb-wc-co table.shop_table tfoot .order-total td {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.woocommerce-checkout ul.woocommerce-order-overview li > span,
			.woocommerce table.order_details_total tfoot td:last-child,
			.woocommerce table.order_details_total tfoot tr:last-child th,
			.woocommerce table.order_details_total tfoot tr:last-child td,
			.woocommerce mark,
			.woocommerce-form-coupon-toggle .woocommerce-info,
			.woocommerce .woocommerce-form-coupon-toggle .woocommerce-info::before {
				color: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>;
			}

			.woocommerce-checkout .order_details_items .bb_sku_wrapper,
			.woocommerce-checkout table.order_details_total tfoot th,
			.woocommerce-checkout .woocommerce-table--order-details thead th,
			.woocommerce-checkout ul.woocommerce-order-overview li,
			.woocommerce-checkout .woocommerce-order-over > p,
			.woocommerce-checkout .woocommerce-order-end p,
			.woocommerce .order_details_items .bb_sku_wrapper,
			.woocommerce table.order_details_total tfoot th,
			.woocommerce .woocommerce-table--order-details thead th,
			.woocommerce .wc-MyAccount-sub-heading p,
			.woocommerce .woocommerce-MyAccount-content form .form-row span > em,
			.woocommerce #content div.product div.summary .product_meta > span,
			.woocommerce .woocommerce-result-count,
			.woocommerce .bb_sku_wrapper,
			.woocommerce table.my_account_orders tbody td,
			.woocommerce table.shop_table th,
			.header-mini-cart ul.cart_list li.mini_cart_item span.quantity,
			.header-mini-cart p.woocommerce-mini-cart__total,
			.woocommerce .woocommerce-product-rating a.woocommerce-review-link,
			.woocommerce .woocommerce-product-rating a.woocommerce-review-link:hover,
			.woocommerce #reviews #comments ol.commentlist li .meta,
			.woocommerce-checkout .bb-wc-co table.shop_table th,
			.woocommerce-checkout .bb-wc-co table.shop_table .qty,
			.woocommerce-checkout .bb-wc-co table.shop_table tfoot th,
			.woocommerce-checkout .bb-wc-co table.shop_table tfoot td,
			.widget_layered_nav ul.woocommerce-widget-layered-nav-list li span.count {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			.woocommerce li.product,
			.woocommerce li.product a.button.add_to_cart_button,
			.woocommerce li.product a.added_to_cart.wc-forward,
			.woocommerce li.product a.button.product_type_simple,
			.woocommerce li.product a.button.product_type_grouped,
			.woocommerce li.product a.button.product_type_external,
			.woocommerce li.product a.button.product_type_variable,
			.woocommerce #content div.product .woocommerce-tabs .panel,
			.woocommerce #content div.product div.summary,
			.woocommerce #content div.product div.woocommerce-product-gallery.images,
			.woocommerce-cart .woocommerce,
			.woocommerce-checkout .bb-wc-co #customer_details,
			.woocommerce-checkout .bb-wc-co .bb-order-review,
			.woocommerce .bsMyAccount--dashboard .woocommerce-MyAccount-navigation,
			.woocommerce .bsMyAccount--dashboard .wc-MyAccount-dashboard-block,
			.woocommerce .bsMyAccount--dashboard .woocommerce-Address,
			.woocommerce .bsMyAccount:not(.bsMyAccount--dashboard),
			.woocommerce .woocommerce-info,
			.woocommerce .woocommerce-message,
			.woocommerce form.checkout_coupon,
			.woocommerce .bsMyAccount {
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			.woocommerce #content div.product .woocommerce-tabs .panel,
			.woocommerce #content div.product div.summary,
			.woocommerce #content div.product div.woocommerce-product-gallery.images,
			.woocommerce-cart .woocommerce,
			.woocommerce-checkout .bb-wc-co #customer_details,
			.woocommerce-checkout .bb-wc-co .bb-order-review,
			.woocommerce .bsMyAccount--dashboard .woocommerce-MyAccount-navigation,
			.woocommerce .bsMyAccount--dashboard .wc-MyAccount-dashboard-block,
			.woocommerce .bsMyAccount--dashboard .woocommerce-Address,
			.woocommerce .bsMyAccount:not(.bsMyAccount--dashboard),
			.woocommerce .woocommerce-info,
			.woocommerce .woocommerce-message,
			.woocommerce form.checkout_coupon,
			.woocommerce .bsMyAccount {
				border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.woocommerce li.product a.button.add_to_cart_button,
			.woocommerce li.product a.button.product_type_simple,
			.woocommerce li.product a.button.product_type_grouped,
			.woocommerce li.product a.button.product_type_external,
			.woocommerce li.product a.button.product_type_variable,
			.woocommerce li.product a.added_to_cart.wc-forward,
			.woocommerce li.product a.button.add_to_cart_button.added {
				border-top-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.woocommerce li.product a.added_to_cart.wc-forward {
				border-right-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.woocommerce .woocommerce-MyAccount-content {
				border-left-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.woocommerce .bsMyAccount--dashboard .wc-MyAccount-dashboard-block .wc-MyAccount-sub-heading,
			.woocommerce .bsMyAccount--dashboard .woocommerce-Address-title,
			.woocommerce .wc-MyAccount-sub-heading {
				border-bottom-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.site-header a.header-cart-link span.count,
			.woocommerce span.onsale {
				background-color: <?php echo $highlight_color; ?>;
			}

			/* Buttons */
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			.woocommerce form button.button {
				border-radius: <?php echo $button_radius; ?>px;
			}

		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;
		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_woocommerce_custom_css', $custom_css );

	}

	/* Add Action */
	if ( function_exists( 'WC' ) ) {
		add_action( 'wp_head', 'boss_generate_option_woocommerce_css', 99 );
	}
}

if ( ! function_exists( 'boss_generate_option_jobsmanager_css' ) ) {
	function boss_generate_option_jobsmanager_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_jobsmanager_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
			<style id=\"buddyboss_theme-jobsmanager-style\">
				{$custom_css["css"]}
			</style>
			";

			return false;

		}

		$primary_color = buddyboss_theme_get_option( 'accent_color' );
		$danger_color  = buddyboss_theme_get_option( 'error_notice_bg_color' );

		?>
		<style id="buddyboss_theme-jobsmanager-style">

		<?php ob_start(); ?>

			/* Danger color */
			#job-manager-job-dashboard table.job-manager-jobs tbody tr td.job_title ul li .job-dashboard-action-delete,
			#job-manager-job-dashboard .bb-ctrls .bs-dropdown a.job-dashboard-action-delete,
			#resume-manager-candidate-dashboard table.resume-manager-resumes tbody tr td ul li .candidate-dashboard-action-delete,
			#resume-manager-candidate-dashboard .bb-ctrls .bs-dropdown a.candidate-dashboard-action-delete,
			#job-manager-alerts table.job-manager-alerts tbody td:first-child ul li .job-alerts-action-delete,
			.wp-job-manager-bookmarks-form a.remove-bookmark,
			#job-manager-bookmarks table ul.job-manager-bookmark-actions li a.job-manager-bookmark-action-delete,
			article.job_listing ul.job-listing-meta li.application-deadline,
			article.job_listing ul.job-listing-meta li.application-deadline label,
			#job_preview ul.job-listing-meta li.application-deadline,
			#resume_preview ul.job-listing-meta li.application-deadline,
			#job_preview ul.job-listing-meta li.application-deadline label,
			#resume_preview ul.job-listing-meta li.application-deadline label,
			#job_preview ul.job-listing-meta li.application-deadline:before,
			#resume_preview ul.job-listing-meta li.application-deadline:before {
				color: <?php echo $danger_color; ?>;
			}

			.job-manager-error {
				background-color: <?php echo $danger_color; ?>;
			}

			/* Primary color */
			.bs-row-wrap > a,
			#job-manager-alerts table.job-manager-alerts tfoot td a,
			.job_listing .job-manager-info,
			.job-manager-info {
				background-color: <?php echo $primary_color; ?>;
			}

			.job-manager-form fieldset a.resume-manager-add-row {
				border-color: <?php echo $primary_color; ?>;
			}

			.job-manager-form fieldset a.resume-manager-add-row,
			.job-manager-form fieldset a.resume-manager-add-row:hover,
			ul.resumes li.resume.listing-bookmarked a div.candidate-column:after,
			ul.job_listings .listing-bookmarked div.position:after {
				color: <?php echo $primary_color; ?>;
			}

			article.job_listing ul.job-listing-meta li.location a,
			body.single-resume ul.meta li.candidate-location a,
			body.single-resume .resume-aside ul.resume-links li a {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_color' ); ?>;
			}

			article.job_listing ul.job-listing-meta li.location a:hover,
			body.single-resume ul.meta li.candidate-location a:hover,
			body.single-resume .resume-aside ul.resume-links li a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			#job-manager-alerts table.job-manager-alerts tbody tr td,
			#job-manager-alerts table.job-manager-alerts thead th,
			.bs-row-wrap > p,
			#job-manager-job-dashboard table.job-manager-jobs thead th,
			#job-manager-job-dashboard table.job-manager-jobs tbody tr td,
			#job-manager-job-dashboard > p,
			ul.job_listings li.job_listing a div.location,
			ul.job_listings li.job_listing a div.position .company,
			ul.job_listings li.job_listing ul.meta li.date,
			article.job_listing ul.job-listing-meta li,
			.single-job_listing article.job_listing .single-job-sidebar .name-meta,
			.single-job_listing article.job_listing .single-job-sidebar p.tagline,
			table.job-manager-bookmarks thead th,
			table.job-manager-bookmarks tbody tr td,
			body.single-resume ul.meta li,
			.job-manager-form fieldset .account-sign-in,
			#job_preview ul.job-listing-meta li.date-posted,
			#resume_preview ul.job-listing-meta li.date-posted,
			ul.resumes li.resume a div.candidate-column .candidate-title,
			ul.resumes li.resume a .candidate-location-column,
			ul.resumes li.resume a .resume-posted-column {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;
		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_jobsmanager_custom_css', $custom_css );

	}

	/* Add Action */
	if ( class_exists( 'WP_Job_Manager' ) ) {
		add_action( 'wp_head', 'boss_generate_option_jobsmanager_css', 99 );
	}
}

if ( ! function_exists( 'boss_generate_option_events_css' ) ) {
	function boss_generate_option_events_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_events_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
			<style id=\"buddyboss_theme-events-style\">
				{$custom_css["css"]}
			</style>
			";

			return false;

		}

		$primary_color   = buddyboss_theme_get_option( 'accent_color' );
		$secondary_color = buddyboss_theme_get_option( 'accent_hover' );
		$danger_color    = buddyboss_theme_get_option( 'error_notice_bg_color' );

		$button_radius = buddyboss_theme_get_option( 'button_default_radius' );

		?>
		<style id="buddyboss_theme-events-style">

		<?php ob_start(); ?>

			/* Buttons */
			#tribe-bar-form .tribe-bar-submit input[type=submit],
			#tribe-events .bs-single-content .tribe-events-cal-links a.tribe-events-button,
			#tribe-events-content.tribe-events-list a.tribe-events-ical,
			.tribe-events-venue .tribe-events-venue-meta a.tribe-events-gmap {
				border-radius: <?php echo $button_radius; ?>px;
			}

			/* Danger color */
			.events-archive.events-gridview #tribe-events-content table.tribe-events-calendar tbody td div.tribe_events.tribe-event-featured,
			.events-archive.events-gridview #tribe-events-content table.tribe-events-calendar tbody td div.type-tribe_events.tribe-event-featured {
				background-color: <?php echo $danger_color; ?>;
			}

			/* Primary color */
			.tribe-grid-allday .tribe-events-week-allday-single h3.entry-title,
			.tribe-grid-body .tribe-events-week-hourly-single h3.entry-title {
				background-color: <?php echo color2rgba( $primary_color, 0.75 ); ?>;
				border-color: <?php echo color2rgba( $primary_color, 0.75 ); ?>;
			}

			.tribe-grid-allday .tribe-events-week-allday-single h3.entry-title:hover,
			.tribe-grid-body .tribe-events-week-hourly-single h3.entry-title:hover {
				background-color: <?php echo color2rgba( $primary_color, 0.95 ); ?>;
				border-color: <?php echo color2rgba( $primary_color, 0.95 ); ?>;
			}

			.tribe-grid-allday .tribe-week-today,
			.tribe-week-grid-wrapper .tribe-grid-content-wrap .tribe-events-mobile-day.tribe-week-today {
				background-color: <?php echo color2rgba( $primary_color, 0.05 ); ?>;
			}

			#tribe-events .tribe-events-button,
			#tribe-events .tribe-events-button:hover,
			#tribe-bar-form .tribe-bar-submit input[type=submit],
			#tribe-bar-form .tribe-bar-submit input[type=submit]:hover,
			.tribe-events-venue .tribe-events-venue-meta a.tribe-events-gmap,
			.tribe-common .tribe-common-c-btn,
			.tribe-common a.tribe-common-c-btn,
			.tribe-common .tribe-common-c-btn:hover,
			.tribe-common a.tribe-common-c-btn:hover,
			.tribe-events-venue .tribe-events-venue-meta a.tribe-events-gmap:hover {
				background: <?php echo $primary_color; ?>;
			}

			.tribe-events-venue .tribe-events-venue-meta a.tribe-events-gmap:before,
			.tribe-events .tribe-events-c-ical__link:hover,
			.events-archive.events-gridview #tribe-events-content table.tribe-events-calendar tbody td div.tribe_events,
			.events-archive.events-gridview #tribe-events-content table.tribe-events-calendar tbody td div.type-tribe_events,
			.tribe-events-grid .tribe-grid-header .tribe-week-today {
				background-color: <?php echo $primary_color; ?>;
			}

			#tribe-events .bs-single-content .tribe-events-cal-links a.tribe-events-button,
			#tribe-events .bs-single-content .tribe-events-cal-links a.tribe-events-button:hover,
			.tribe-events-venue .tribe-events-venue-meta a.tribe-events-gmap,
			.tribe-events .tribe-events-c-ical__link,
			.tribe-events-venue .tribe-events-venue-meta a.tribe-events-gmap:hover {
				border-color: <?php echo $primary_color; ?>;
			}

			#tribe-events .bs-single-content .tribe-events-cal-links a.tribe-events-button,
			#tribe-events .bs-single-content .tribe-events-cal-links a.tribe-events-button:hover,
			.tribe-events .tribe-events-calendar-month__day--current .tribe-events-calendar-month__day-date,
			.tribe-events .tribe-events-calendar-month__day--current .tribe-events-calendar-month__day-date-link,
			.tribe-events .tribe-events-c-ical__link,
			#tribe-geo-results .tribe-event-featured a {
				color: <?php echo $primary_color; ?>;
			}

			#tribe-geo-results .tribe-event-featured a:hover {
				color: <?php echo $secondary_color; ?>;
			}

			/* Headings link color */
			.tribe_ext_sch_day_view .tribe-events-list-event-title a,
			.type-tribe_events .bs-event-heading h2.tribe-events-list-event-title a,
			.type-tribe_events .bs-event-heading h2.tribe-events-map-event-title a,
			#tribe-events-photo-events .type-tribe_events.tribe-events-photo-event h2.tribe-events-list-event-title a,
			.tribe-events-single ul.tribe-related-events h3.tribe-related-events-title a,
			.single-tribe_events #tribe-events-content .tribe-events-event-meta dl a,
			#tribe-geo-results .tribe-event-featured h2.tribe-events-map-event-title a,
			.type-tribe_events .tribe-mini-calendar-event .list-info .tribe-events-title a {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.tribe_ext_sch_day_view .tribe-events-list-event-title a:hover,
			.type-tribe_events .bs-event-heading h2.tribe-events-list-event-title a:hover,
			.type-tribe_events .bs-event-heading h2.tribe-events-map-event-title a:hover,
			#tribe-events-photo-events .type-tribe_events.tribe-events-photo-event h2.tribe-events-list-event-title a:hover,
			.tribe-events-single ul.tribe-related-events h3.tribe-related-events-title a:hover,
			.single-tribe_events #tribe-events-content .tribe-events-event-meta dl a:hover,
			#tribe-geo-results .tribe-event-featured h2.tribe-events-map-event-title a:hover,
			.type-tribe_events .tribe-mini-calendar-event .list-info .tribe-events-title a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			/* Body Text color */
			.tribe-events-calendar .tribe-events-tooltip,
			.tribe-grid-body .tribe-events-tooltip {
				color: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>;
			}

			.type-tribe_events .bs-event-heading .tribe-event-schedule-short .bs-schedule-short-d,
			#tribe_events_filters_wrapper.tribe-events-filters-vertical label.tribe-events-filters-label,
			.tribe-events-day .tribe-events-day-time-slot h5,
			#tribe-events-content .tribe-events-day-time-slot h5,
			#tribe-events-content .tribe-events-tooltip h4,
			.tribe-events-week #tribe-events-content .tribe-events-right .tribe-events-tooltip h4,
			.single-tribe_events .bs-event-heading .tribe-event-schedule-short .bs-schedule-short-d,
			.type-tribe_events .tribe-mini-calendar-event .list-date .list-daynumber {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			@media (max-width: 768px) {
				.tribe-mobile-day-date {
					color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
				}

				.tribe-events-sub-nav li a,
				.tribe-events-sub-nav li a:visited {
					color: <?php echo $primary_color; ?>;
				}

				.tribe-events-sub-nav li a:hover {
					color: <?php echo $secondary_color; ?>;
				}
			}

			.type-tribe_events .bs-event-heading .tribe-event-schedule-details,
			.type-tribe_events .bs-event-heading .tribe-events-venue-details,
			.tribe-events-notices,
			.single-tribe_events .bs-event-heading .tribe-event-schedule-long h2,
			.single-tribe_events #tribe-events-content .tribe-events-event-meta dl dt,
			.single-tribe_organizer h4.tribe-organizer-label,
			.single-tribe_organizer address.organizer-address span.tel,
			.tribe-events-venue .venue-address,
			.type-tribe_events .bs-event-heading .time-details,
			.tribe-grid-header .column span,
			.type-tribe_events .tribe-mini-calendar-event .list-info .tribe-events-duration,
			.type-tribe_events .tribe-mini-calendar-event .list-info .tribe-events-organizer,
			.type-tribe_events .tribe-mini-calendar-event .list-info .tribe-events-location {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}
			.type-tribe_events .tribe-mini-calendar-event{
				border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}


		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;
		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_events_custom_css', $custom_css );

	}

	/* Add Action */
	if ( class_exists( 'Tribe__Events__Main' ) ) {
		add_action( 'wp_head', 'boss_generate_option_events_css', 99 );
	}
}

if ( ! function_exists( 'boss_generate_option_gamipress_css' ) ) {
	function boss_generate_option_gamipress_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_gamipress_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
			<style id=\"buddyboss_theme-gamipress-style\">
				{$custom_css["css"]}
			</style>
			";

			return false;

		}

		$primary_color  = buddyboss_theme_get_option( 'accent_color' );
		$body_bgr_color = buddyboss_theme_get_option( 'body_background' );

		?>
		<style id="buddyboss_theme-gamipress-style">

		<?php ob_start(); ?>

			/* Headings link color */
			.gamipress-achievement-description .gamipress-achievement-title a,
			.gamipress-rank-description .gamipress-rank-title a {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.gamipress-achievement-description .gamipress-achievement-title a:hover,
			.gamipress-rank-description .gamipress-rank-title a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			/* Body Text color */
			.gamipress-achievement-attached .gamipress-open-close-switch > a,
			.gamipress-achievement-attached .gamipress-open-close-switch > a:after,
			.gamipress-achievement-description .gamipress-achievement-points,
			.gamipress-achievement-attached .gamipress-open-close-switch > a,
			.gamipress-rank-requirements .gamipress-open-close-switch > a,
			.gamipress-achievement-description ul.gamipress-required-achievements li,
			.gamipress-achievement-description ol.gamipress-required-achievements li,
			.gamipress-user-points:not(.gamipress-layout-none) .gamipress-points .gamipress-user-points-label,
			.gamipress-achievement-unlock-with-points-response,
			table.gamipress-earnings-table tbody td.gamipress-earnings-col-date,
			table.gamipress-earnings-table tbody td.gamipress-earnings-col-points,
			table.gamipress-earnings-table thead th,
			.gamipress-rank-description ul.gamipress-required-requirements li,
			.widget .gamipress-achievement .gamipress-achievement-description {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			#buddypress .users-header .gamipress-buddypress-achievements .gamipress-buddypress-achievement-type-label,
			.gamipress-user-points .gamipress-user-points-amount,
			#buddypress .users-header .gamipress-buddypress-ranks .gamipress-buddypress-rank-label {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.gamipress-achievement-congratulations,
			.entry-content > .gamipress-achievement,
			.gamipress-user-ranks .gamipress-rank,
			.gamipress-achievements-list #gamipress-achievements-container[class*="gamipress-columns"] > .gamipress-achievement,
			.gamipress-ranks-list .gamipress-ranks-container[class*="gamipress-columns"] .gamipress-rank,
			.gamipress-points-types .gamipress-points-type,
			.gamipress-referrals-referral-url-generator,
			.gamipress-achievement,
			.gamipress-rank,
			.gamipress-transfers-achievement-transfer-form-achievement-input .ui-autocomplete,
			.gamipress-transfers-rank-transfer-form-rank-input .ui-autocomplete {
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			.gamipress-achievement-congratulations,
			.gamipress-achievement-attached,
			.entry-content > .gamipress-achievement,
			.gamipress-user-ranks .gamipress-rank,
			.gamipress-achievements-list #gamipress-achievements-container[class*="gamipress-columns"] > .gamipress-achievement,
			.gamipress-ranks-list .gamipress-ranks-container[class*="gamipress-columns"] .gamipress-rank,
			.gamipress-points-types .gamipress-points-type,
			.gamipress-points-types[class*="gamipress-columns"] > .gamipress-points-type,
			.gamipress-referrals-referral-url-generator,
			.gamipress-achievement,
			.gamipress-rank,
			.gamipress-transfers-achievement-transfer-form-achievement-input .ui-autocomplete,
			.gamipress-transfers-rank-transfer-form-rank-input .ui-autocomplete,
			#buddypress .bbp-after-author-hook .gamipress-bbpress-points > div,
			#buddypress .bbp-after-author-hook .gamipress-bbpress-achievement,
			#buddypress .bbp-after-author-hook .gamipress-bbpress-ranks .gamipress-bbpress-rank {
				border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.gamipress-time-based-reward-claim-button,
			.gamipress-restrict-unlock-access-with-points-button,
			.gamipress-restrict-content-unlock-post-with-points-button,
			.gamipress-load-more-button,
			.gamipress-achievement-unlock-with-points-button,
			.gamipress-load-more-button{
				background-color: <?php echo $primary_color; ?>;
			}

			body .gamipress-restrict-content-limiter{
				background: transparent;
				background: -webkit-linear-gradient(transparent,<?php echo $body_bgr_color; ?>);
				background: -o-linear-gradient(transparent,<?php echo $body_bgr_color; ?>;
				background: -moz-linear-gradient(transparent,<?php echo $body_bgr_color; ?>);
				background: linear-gradient(transparent,<?php echo $body_bgr_color; ?>);
			}


		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;
		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_gamipress_custom_css', $custom_css );

	}

	/* Add Action */
	if ( class_exists( 'GamiPress' ) ) {
		add_action( 'wp_head', 'boss_generate_option_gamipress_css', 99 );
	}
}

if ( ! function_exists( 'boss_generate_option_badgeos_css' ) ) {
	function boss_generate_option_badgeos_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_badgeos_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
			<style id=\"buddyboss_theme-badgeos-style\">
				{$custom_css["css"]}
			</style>
			";

			return false;

		}

		$primary_color = buddyboss_theme_get_option( 'accent_color' );

		?>
		<style id="buddyboss_theme-badgeos-style">

		<?php ob_start(); ?>

			/* Headings link color */
			#badgeos-achievements-container .badgeos-achievements-list-item .badgeos-item-title a {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			#badgeos-achievements-container .badgeos-achievements-list-item .badgeos-item-title a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			/* Body Text color */
			#badgeos-achievements-container .badgeos-open-close-switch a {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			#badgeos-achievements-container .badgeos-achievements-list-item {
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			#badgeos-achievements-container .badgeos-achievements-list-item {
				border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;
		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_badgeos_custom_css', $custom_css );

	}

	/* Add Action */
	if ( class_exists( 'BadgeOS' ) ) {
		add_action( 'wp_head', 'boss_generate_option_badgeos_css', 99 );
	}
}

if ( ! function_exists( 'boss_generate_option_pmpro_css' ) ) {
	function boss_generate_option_pmpro_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_pmpro_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
			<style id=\"buddyboss_theme-pmpro-style\">
				{$custom_css["css"]}
			</style>
			";

			return false;

		}

		$primary_color = buddyboss_theme_get_option( 'accent_color' );

		?>
		<style id="buddyboss_theme-pmpro-style">

		<?php ob_start(); ?>

			.pmpro_a-print,
			.pmpro_btn.pmpro_btn-cancel,
			a.pmpro_btn.pmpro_btn-cancel,
			.entry-content a.pmpro_btn.pmpro_btn-cancel,
			.pmpro_btn:link.pmpro_btn-cancel {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_color' ); ?>;
			}

			.pmpro_a-print:hover,
			.pmpro_btn.pmpro_btn-cancel:hover,
			a.pmpro_btn.pmpro_btn-cancel:hover,
			.entry-content a.pmpro_btn.pmpro_btn-cancel:hover,
			.pmpro_btn:link.pmpro_btn-cancel:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			/* Headings link color */

			/* Body Text color */
			.pmpro_checkout h3 span.pmpro_checkout-h3-msg,
			.pmpro_a-print {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			form.pmpro_form hr,
			body[class^="pmpro"] hr {
				border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;
		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_pmpro_custom_css', $custom_css );

	}

	/* Add Action */
	if ( defined( 'PMPRO_VERSION' ) ) {
		add_action( 'wp_head', 'boss_generate_option_pmpro_css', 99 );
	}
}

if ( ! function_exists( 'boss_generate_option_plugins_css' ) ) {
	function boss_generate_option_plugins_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_plugins_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
			<style id=\"buddyboss_theme-plugins-style\">
				{$custom_css["css"]}
			</style>
			";

			return false;

		}

		$primary_color = buddyboss_theme_get_option( 'accent_color' );
		$danger_color  = buddyboss_theme_get_option( 'error_notice_bg_color' );
		$success_color = buddyboss_theme_get_option( 'success_notice_bg_color' );

		?>
		<style id="buddyboss_theme-plugins-style">

		<?php ob_start(); ?>

			/* Success color */
			#cs-content.cs-content .x-alert.x-alert-success,
			.edd-page .edd-alert-success,
			.entry-content .edd-alert-success,
			.nf-form-wrap .nf-response-msg,
			.entry-content .wpforms-confirmation-container-full,
			.wpforms-confirmation-container-full {
				background-color: <?php echo $success_color; ?>;
			}

			#cs-content.cs-content .x-alert.x-alert-success .close,
			#cs-content .x-pricing-table .x-pricing-column-info ul>li [class*="x-icon-"] {
				color: <?php echo $success_color; ?>;
			}

			#cs-content.cs-content .x-alert.x-alert-success,
			#cs-content .x-pricing-table [class*="x-icon-"]:before,
			.edd-page .edd-alert-success,
			.entry-content .edd-alert-success,
			.nf-form-wrap .nf-response-msg,
			.entry-content .wpforms-confirmation-container-full,
			.wpforms-confirmation-container-full {
				border-color: <?php echo $success_color; ?>;
			}

			/* Danger color */
			div.wpcf7-validation-errors,
			div.wpcf7-mail-sent-ng,
			.use-floating-validation-tip span.wpcf7-not-valid-tip,
			#cs-content.cs-content .x-alert.x-alert-danger,
			.edd-page .edd-alert-error,
			.entry-content .edd-alert-error,
			.gform_wrapper form div.validation_error,
			.nf-form-wrap .nf-after-form-content .nf-error-msg,
			.field-wrap.nf-error .ninja-forms-field,
			div.wpforms-container-full .wpforms-form .wpforms-field input.wpforms-error,
			div.wpforms-container-full .wpforms-form .wpforms-field textarea.wpforms-error,
			div.wpforms-container-full .wpforms-form .wpforms-field select.wpforms-error {
				border-color: <?php echo $danger_color; ?>;
			}

			.use-floating-validation-tip span.wpcf7-not-valid-tip,
			span.wpcf7-not-valid-tip,
			#cs-content.cs-content .x-alert.x-alert-danger .close,
			.nf-field-container .nf-error-msg,
			div.wpforms-container-full .wpforms-form label.wpforms-error,
			div.wpforms-container-full .wpforms-form .wpforms-required-label {
				color: <?php echo $danger_color; ?>;
			}

			div.wpcf7-validation-errors,
			div.wpcf7-mail-sent-ng,
			#cs-content.cs-content .x-alert.x-alert-danger,
			.edd-page .edd-alert-error,
			.entry-content .edd-alert-error,
			.gform_wrapper form div.validation_error,
			.nf-form-wrap .nf-after-form-content .nf-error-msg {
				background-color: <?php echo $danger_color; ?>;
			}

			.edd-submit.button.blue,
			#edd-purchase-button,
			.edd-submit,
			[type=submit].edd-submit,
			.edd-submit.button.blue:hover,
			#edd-purchase-button:hover,
			.edd-submit:hover,
			[type=submit].edd-submit:hover {
				background: <?php echo $primary_color; ?>;
			}
			.edd_download_inner .edd_download_buy_button .edd_purchase_submit_wrapper a.edd-add-to-cart,
			.edd_download_inner .edd_download_buy_button .edd_purchase_submit_wrapper a.edd_go_to_checkout,
			.edd_download_inner .edd_download_buy_button [type=submit].edd-add-to-cart.edd-submit {
				color: <?php echo $primary_color; ?>;
			}

			.edd_download_inner .edd_download_buy_button .edd_purchase_submit_wrapper a.edd-add-to-cart:hover,
			.edd_download_inner .edd_download_buy_button .edd_purchase_submit_wrapper a.edd_go_to_checkout:hover,
			.edd_download_inner .edd_download_buy_button [type=submit].edd-add-to-cart.edd-submit:hover,
			.gfield_radio input[type=radio]:checked + label:after,
			.gfield_radio input[type=radio]:checked + .bb-radio-label:after,
			.gfield_checkbox input[type=checkbox]:checked + label:before {
				background-color: <?php echo $primary_color; ?>;
			}

			.edd_download_inner .edd_download_buy_button .edd_purchase_submit_wrapper a.edd-add-to-cart:hover,
			.edd_download_inner .edd_download_buy_button .edd_purchase_submit_wrapper a.edd_go_to_checkout:hover,
			.edd_download_inner .edd_download_buy_button [type=submit].edd-add-to-cart.edd-submit:hover,
			.gfield_checkbox input[type=checkbox]:checked + label:before {
				border-color: <?php echo $primary_color; ?>;
			}

			/* Headings link color */


			/* Body Text color */


		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;
		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_plugins_custom_css', $custom_css );

	}

	/* Add Action */
	if ( class_exists( 'BuddyForms' ) || class_exists( 'WPCF7' ) || class_exists( 'Easy_Digital_Downloads' ) || class_exists( 'GFForms' ) || class_exists( 'LifterLMS' ) || class_exists( 'IT_Exchange' ) || class_exists( 'Ninja_Forms' ) || class_exists( 'WPForms' ) ) {
		add_action( 'wp_head', 'boss_generate_option_plugins_css', 99 );
	}
}

/**
 * Buddyboss theme custom styling
 */
if ( ! function_exists( 'boss_generate_option_custom_css' ) ) {

	function boss_generate_option_custom_css() {

		global $post;

		$fullscreen_page_padding = false;

		if ( ! empty( $post ) ) {
			$fullscreen_page_padding = get_post_meta( $post->ID, '_wp_page_padding', true );
		}

		$admin_bar_offset = is_admin_bar_showing() ? 67 : 21;
		?>

		<style id="buddyboss_theme-custom-style">

		<?php ob_start(); ?>

		<?php if ( $fullscreen_page_padding ) { ?>
			.page-template-page-fullscreen.page-id-<?php echo $post->ID; ?> .site-content {
				padding: <?php echo $fullscreen_page_padding; ?>px;
			}
		<?php } ?>

		a.bb-close-panel i {
			top: <?php echo $admin_bar_offset; ?>px;
		}


		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;
		?>

		</style>
		<?php

	}

	/* Add Action */
	add_action( 'wp_head', 'boss_generate_option_custom_css', 99 );
}

/**
 * WC Vendor Custom Styling
 */
if ( ! function_exists( 'boss_generate_option_wc_vendors_css' ) ) {
	function boss_generate_option_wc_vendors_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_wc_vendor_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
            <style id=\"buddyboss_theme-wc_vendors-style\">
                {$custom_css["css"]}
            </style>
            ";

			return false;

		}

		$primary_color               = buddyboss_theme_get_option( 'accent_color' );
		$body_blocks_border          = buddyboss_theme_get_option( 'body_blocks_border' );
		$alternate_link_color        = buddyboss_theme_get_option( 'alternate_link_color' );
		$alternate_link_active_color = buddyboss_theme_get_option( 'alternate_link_active' );

		?>
		<style id="buddyboss_theme-wc-vendor-style">

		<?php ob_start(); ?>

			.wc_table-export_orders.table-bordered tbody tr:first-child td,
			table.table-vendor-sales-report tbody tr:first-child td,
			.wc_table-export_orders.table-bordered tbody tr td:last-child,
			table.table-vendor-sales-report tbody tr td:last-child,
			.wc_table-export_orders.table-bordered tbody tr:last-child td,
			table.table-vendor-sales-report tbody tr:last-child td,
			.wc_table-export_orders.table-bordered tbody tr td,
			.wc_table-export_orders.table-bordered thead th,
			.wc_table-export_orders.table-bordered tbody tr td:first-child,
			table.table-vendor-sales-report thead:first-child tr:first-child th,
			.wc_table-export_orders.table-bordered thead:first-child tr:first-child th,
			.wc_table-export_orders.table-bordered thead:first-child tr:first-child th:first-child,
			.wc_table-export_orders.table-bordered thead:first-child tr:first-child th:last-child,
			table.table-vendor-sales-report thead:first-child tr:first-child th:last-child,
			table.table-vendor-sales-report thead:first-child tr:first-child th:first-child {
				border-color: <?php echo $body_blocks_border; ?>;
			}

			.wcv-dashboard-navigation ul li a,
			.wc_table-export_orders.table-bordered thead th,
			table.table-vendor-sales-report thead th,
			.wc_table-export_orders.table-bordered tbody tr td,
			table.table-vendor-sales-report tbody tr td,
			div.wcv-grid .wcv-navigation ul.menu.black li a,
			.form-table tbody tr td label {
				color: <?php echo $alternate_link_color; ?>;
			}

			.wcv-dashboard-navigation ul li a:hover,
			.wcv-dashboard-navigation ul li a:focus,
			div.wcv-grid .wcv-navigation ul.menu.black li a:hover,
			div.wcv-grid .wcv-navigation ul.menu.black li a:focus,
			div.wcv-grid .wcv-navigation ul.menu.black li.active a,
			div.wcv-grid a:hover {
				color: <?php echo $alternate_link_active_color; ?>;
			}

			div.wcv-grid .wcv-search-form .control-group .control.append-button .wcv-button.wcv-search-product,
			.woocommerce .woocommerce-MyAccount-content input[type="submit"][name="apply_for_vendor_submit"] {
				background-color: <?php echo $alternate_link_active_color; ?>;
			}

			 div.wcv-grid .wcv-navigation ul.menu.black li a:hover,
			 div.wcv-grid .wcv-navigation ul.menu.black li a:focus,
			 div.wcv-grid .wcv-navigation ul.menu.black li.active a {
				border-bottom-color: <?php echo $alternate_link_active_color; ?>;
			 }

			 div.wcv-grid h1, div.wcv-grid h2, div.wcv-grid h3, div.wcv-grid h4, div.wcv-grid h5, div.wcv-grid h6{
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			 }

			 div.wcv-grid input:not([type="submit"]):not([type="button"]) {
				color: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>;
			}

			div.wcv-grid input[type="reset"]:not([type="submit"]):not([type="button"]):hover{
				color: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>!important;
			}

		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;
		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_wc_vendor_custom_css', $custom_css );

	}

	/* Add Action */
	if ( class_exists( 'WC_Vendors' ) ) {
		add_action( 'wp_head', 'boss_generate_option_wc_vendors_css', 99 );
	}
}


/**
 * LifterLMS Custom Styling
 */
if ( ! function_exists( 'boss_generate_option_lifterLMS_css' ) ) {
	function boss_generate_option_lifterLMS_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_lifterLMS_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
			<style id=\"buddyboss_theme-lifterLMS-style\">
				{$custom_css["css"]}
			</style>
			";

			return false;

		}

		$primary_color = buddyboss_theme_get_option( 'accent_color' );
		$success_color = buddyboss_theme_get_option( 'success_notice_bg_color' );
		$danger_color  = buddyboss_theme_get_option( 'error_notice_bg_color' );
		$warning_color = buddyboss_theme_get_option( 'warning_notice_bg_color' );

		$button_radius = buddyboss_theme_get_option( 'button_default_radius' );

		?>
		<style id="buddyboss_theme-lifterLMS-style">

		<?php ob_start(); ?>

			/* Success color */
			.llms-access-plan.featured .llms-access-plan-featured,
			.llms-single-course-grades-wrapper table.llms-table.llms-single-course-grades .llms-status.llms-pass,
			.single-llms_quiz .llms-quiz-results-main .llms-quiz-attempt-results .llms-quiz-attempt-question.correct .llms-points,
			.single-lesson.llms-pointer #lifterlms-page-content .lifterlms_content_wrap .wpforms-confirmation-container-full,
			.single-lesson.llms-pointer #lifterlms-page-content .lifterlms_content_wrap div[submit-success] > .wpforms-confirmation-container-full:not(.wpforms-redirection-message),
			body .wpforms-confirmation-container-full,
			body div[submit-success] > .wpforms-confirmation-container-full:not(.wpforms-redirection-message),
			.bb-course-items.grid-view .bb-course-item-wrap .bb-cover-list-item .ld-status.ld-status-complete.ld-primary-background,
			.bb-course-items.list-view .bb-course-item-wrap .bb-cover-list-item .ld-status.ld-status-complete.ld-primary-background,
			.status-complete,
			.bb-cover-wrap--llms .ld-status.ld-status-complete.ld-primary-background,
			.llms-loop-link .bb-cover-wrap .ld-status.ld-status-complete.ld-primary-background,
			.llms-pointer.llms-inner #lifterlms-page-content #lifterlms-lesson-header .bb-position .lifterlms-lesson-nav .bb-ld-status .ld-status.ld-status-complete {
				background-color: <?php echo $success_color; ?>;
			}

			.llms-meta-aplans--hasFree .lifterlms-price,
			.llms-student-dashboard.orders table .llms-status.llms-completed,
			.llms-student-dashboard.orders table .llms-status.llms-refunded,
			.single-llms_quiz .llms-quiz-results-main .llms-quiz-attempt-results .llms-quiz-attempt-question.correct .llms-quiz-attempt-answer,
			.llms-quiz-timer {
				color: <?php echo $success_color; ?>;
			}

			.single-llms_quiz .llms-quiz-results-main .llms-quiz-attempt-answer-section.llms-correct-answer .llms-quiz-attempt-answer {
				color: <?php echo $success_color; ?> !important;
			}

			.llms-student-dashboard.orders table .llms-status.llms-completed,
			.llms-student-dashboard.orders table .llms-status.llms-refunded,
			.llms-notice.llms-success,
			.llms-quiz-timer,
			.single-lesson.llms-pointer #lifterlms-page-content .lifterlms_content_wrap .wpforms-confirmation-container-full,
			.single-lesson.llms-pointer #lifterlms-page-content .lifterlms_content_wrap div[submit-success] > .wpforms-confirmation-container-full:not(.wpforms-redirection-message),
			body .wpforms-confirmation-container-full,
			body div[submit-success] > .wpforms-confirmation-container-full:not(.wpforms-redirection-message) {
				border-color: <?php echo $success_color; ?>;
			}

			.single-llms_assignment .llms-donut svg path {
				stroke: <?php echo $success_color; ?>;
			}

			/* Danger color */
			.llms-access-plan .stamp,
			.lifterlms .llms-checkout-wrapper .llms-notice.llms-error,
			.llms-single-course-grades-wrapper table.llms-table.llms-single-course-grades .llms-status.llms-fail,
			.llms-notice.llms-error,
			.single-llms_quiz .llms-quiz-results-main .llms-quiz-attempt-results .llms-quiz-attempt-question.incorrect .llms-points,
			.llms-quiz-ui .llms-error {
				background-color: <?php echo $danger_color; ?>;
			}

			.llms-student-dashboard.orders table .llms-status.llms-cancelled,
			.llms-student-dashboard.orders table .llms-status.llms-failed,
			.llms-notice---sidebar .bb-single-course-sidebar.llms-notice,
			.single-llms_quiz .llms-quiz-results-main .llms-quiz-attempt-results .llms-quiz-attempt-question.incorrect .llms-quiz-attempt-answer,
			.llms-quiz-timer.color-empty {
				color: <?php echo $danger_color; ?>;
			}

			.llms-student-dashboard.orders table .llms-status.llms-cancelled,
			.llms-student-dashboard.orders table .llms-status.llms-failed,
			.llms-quiz-timer.color-empty {
				border-color: <?php echo $danger_color; ?>;
			}

			/* Warning color */
			.llms-student-dashboard.orders table .llms-status.llms-pending {
				color: <?php echo $warning_color; ?>;
			}

			.llms-single-course-grades-wrapper table.llms-table.llms-single-course-grades .llms-status.llms-pending,
			.llms-single-course-grades-wrapper table.llms-table.llms-single-course-grades .llms-status.llms-incomplete {
				background-color: <?php echo $warning_color; ?>;
			}

			.llms-student-dashboard.orders table .llms-status.llms-pending {
				border-color: <?php echo $warning_color; ?>;
			}

			.single-course.llms-pointer .wp-block-llms-course-progress .llms-progress .progress__indicator .ld-progress-percentage,
			.single-course.llms-pointer .wp-block-llms-course-progress .llms-progress .progress__indicator .ld-progress-steps,
			.llms-achievement .llms-achievement-content,
			.llms-achievement .llms-achievement-date
			{
				color: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>;
			}

			.llms-progress .progress-bar-complete
			{
				background-color:  <?php echo $primary_color; ?>!important;
			}

			.llms-access-plan-trial,
			.llms-access-plan-schedule,
			.llms-access-plan-sale-end span,
			.llms-access-plan-expiration,
			.llms-gateway-description p,
			.llms-author-number-courses,
			.llms-certificate__label,
			.llms-pointer.llms-inner .lifter-topic-sidebar-progress .llms-progress .progress__indicator .ld-progress-steps,
			.llms-pointer.llms-inner .lifter-topic-sidebar-progress .llms-progress .progress__indicator .ld-progress-percentage,
			.bb-card-course-details .course-lesson-count,
			.bb-card-course-details .bb-course-excerpt,
			.llms-student-dashboard.orders .orders-table thead td,
			.llms-notification-list .llms-notification .llms-notification-footer .llms-notification-date,
			.llms-table thead th,
			.llms-pa-posts header.llms-pa-post-header .llms-pa-post-date,
			.llms-pa-posts header.llms-pa-post-header .llms-pa-meta-sep,
			.llms-pa-posts header.llms-pa-post-header .llms-author,
			.llms-pa-posts.llms-pa-posts--single header.llms-pa-post-header .llms-pa-post-date,
			.llms-pa-posts.llms-pa-posts--single header.llms-pa-post-header .llms-pa-meta-sep,
			.llms-pa-posts.llms-pa-posts--single header.llms-pa-post-header .llms-author,
			.llms-access-plan-price .price-regular.price-regular--isSale .lifterlms-price,
			.llms-sd-section__blank p,
			.bb-llms-content-wrap .llms-lesson-preview .llms-lesson-excerpt,
			.single-course.llms-pointer .bb-llms-content-wrap #old_reviews .llms_review .review_date,
			.llms-meta-aplans__smTag,
			.iziModal .iziModal-header .iziModal-header-subtitle,
			.bb-llms-content-wrap .llms-instructor-info .llms-instructors .llms-author .llms-author-info.label,
			.llms-checkout-section-content .llms-order-summary li .llms-label,
			.llms-group-member .llms-group-member--desc h6,
			.llms-form-field .llms-description,
			label[for=llms_group_invitation_link],
			.llms-achievement .llms-achievement-date span {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper .llms-lesson-link .llms-main h5,
			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper-quizzes .llms-quizz-preview .llms-lesson-link h5,
			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview.is-incomplete .llms-lesson-link:before,
			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview.is-complete .llms-lesson-link:before,
			.llms-pointer.llms-inner .llms-lesson-preview.llms-quizz-preview .llms-lesson-link h5,
			.llms-pointer.llms-inner .llms-lesson-main .ld-item-details .ld-expand-button .ld-icon-arrow-down,
			.single-course.llms-pointer .bb-llms-content-wrap .llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview .llms-lesson-link:before,
			.llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview .llms-lesson-link h5,
			.single-course.llms-pointer .bb-llms-content-wrap .llms-syllabus-wrapper .llms-lesson-preview .ld-item-details .ld-expand-button .ld-icon-arrow-down,
			.llms-syllabus-wrapper .llms-lesson-preview .llms-lesson-counter,
			.single-course.llms-pointer .llms-instructor-info .llms-author-holder .meta-saperator,
			.llms-pointer.llms-inner .llms-lesson-preview.llms-quizz-preview .llms-lesson-link:before,
			.llms-pointer.llms-inner .lifter-topic-sidebar-wrapper .lifter-sidebar-widgets ul li.widget table,
			.llms-pointer.llms-inner .lifter-topic-sidebar-wrapper .lifter-sidebar-widgets ul li.widget a:not(.button),
			.llms-pointer.llms-inner .lifter-topic-sidebar-wrapper .lifter-sidebar-widgets ul li.widget .textwidget,
			.llms-pointer.llms-inner .lifter-topic-sidebar-wrapper .lifter-sidebar-widgets ul li.widget .textwidget h2,
			.llms-pointer.llms-inner .lifter-topic-sidebar-wrapper .lifter-sidebar-widgets ul li.widget .post-date,
			.llms-widget-syllabus--collapsible .llms-syllabus-footer a,
			.llms-syllabus-wrapper .llms-lesson-main .llms-lesson-holder .llms-lesson-link .llms-main h5
			{
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_color' ); ?>;
			}

			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper-quizzes .llms-lesson-preview.is-incomplete .llms-lesson-link:after,
			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper-quizzes .llms-lesson-preview.is-complete .llms-lesson-preview.llms-quizz-preview.is-incomplete .llms-lesson-link:after,
			.llms-pointer.llms-inner .llms-lesson-link-locked:after,
			.llms-loop-item.course .llms-pa-permalink
			{
				border-color: <?php echo buddyboss_theme_get_option( 'alternate_link_color' ); ?>;
			  }

			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper .llms-lesson-link:hover .llms-main h5,
			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper-quizzes .llms-quizz-preview .llms-lesson-link:hover h5,
			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview.is-incomplete:hover .llms-lesson-link:before,
			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview.is-complete:hover .llms-lesson-link:before,
			.llms-pointer.llms-inner .llms-lesson-preview.llms-quizz-preview:hover .llms-lesson-link h5,
			.llms-pointer.llms-inner .llms-lesson-preview:hover .llms-lesson-main .ld-item-details .ld-expand-button .ld-icon-arrow-down,
			.llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview:hover .llms-lesson-link:before,
			.llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview:hover .llms-lesson-link h5,
			.llms-syllabus-wrapper .llms-lesson-preview:hover .ld-item-details .ld-expand-button .ld-icon-arrow-down,
			.llms-syllabus-wrapper .llms-lesson-preview .llms-lesson-link:hover .llms-lesson-title,
			.bb-llms-content-wrap .llms-syllabus-wrapper .llms-lesson-preview .llms-lesson-link:hover .llms-extra .llms-lesson-counter,
			.single-course.llms-pointer .llms-instructor-info .llms-author-holder a:hover .llms-author-info.name,
			.single-llms_quiz.llms-pointer #lifterlms-page-content .lifterlms_content_wrap .llms-quiz-attempt-question-header:hover h3.llms-question-title,
			.single-llms_quiz.llms-pointer #lifterlms-page-content .lifterlms_content_wrap .llms-quiz-attempt-question-header:hover .toggle-answer:before,
			.llms-pointer.llms-inner .lifter-topic-sidebar-wrapper .lifter-sidebar-widgets ul li.widget a:not(.button):hover,
			.llms-loop-item.course .llms-pa-permalink:hover,
			.llms-widget-syllabus--collapsible .llms-syllabus-footer a:hover,
			.llms-pointer.llms-inner #lifterlms-page-content #lifterlms-lesson-header .lifterlms-header-instructor .bb-about-instructor > .flex .bb-content-wrap h5 a:hover,
			.llms-pointer.llms-inner #lifterlms-page-content #lifterlms-lesson-header .bb-ld-info-bar .ld-breadcrumbs .ld-breadcrumbs-segments span a:hover,
			.single-llms_quiz .lifterlms-header-instructor .flex h5>a:hover,
			.post-type-archive-course.llms-pointer .bb-course-items .bb-course-item-wrap .bb-cover-list-item .bb-card-course-details .bb-course-meta strong a:hover,
			.post-type-archive-course.llms-pointer .bb-course-items .bb-course-item-wrap .bb-cover-list-item .bb-card-course-details .bb-course-title a:hover,
			.bb-dark-theme.single-llms_quiz #llms-quiz-header:before,
			.llms-loop-item-content .llms-loop-title:hover,
			a.llms-certificate__link .llms-certificate-title:hover,
			.llms-widget-syllabus .lesson-title a:hover,
			.llms-widget-syllabus .lesson-title.done a:hover,
			.llms-syllabus-wrapper .llms-lesson-main .llms-lesson-holder .llms-lesson-link:hover .llms-main h5
			{
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}


			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper-quizzes .llms-lesson-preview.is-complete .llms-lesson-link:before,
			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper .llms-lesson-preview.is-complete .llms-lesson-link::before,
			.llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview.is-complete .llms-lesson-link:after,
			.llms-syllabus-wrapper .llms-lesson-preview.is-complete .llms-lesson-complete,
			.single-llms_assignment .llms-assignment-footer #llms-assignment-submit,
			.single-llms_assignment .llms-assignment-footer .llms-button-primary,
			.llms-pa-posts.llms-pa-posts--archive footer a,
			.llms-pa-posts.llms-pa-posts--single .llms-pa-discussion-list .llms_pa_post_comment.llms-pa-read:after,
			.nf-form-wrap .nf-form-content .nf-field-element input[type=button],
			body div.wpforms-container-full .wpforms-form button[type=submit],
			body div.wpforms-container-full .wpforms-form button[type=submit]:hover,
			.frm_submit button,
			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview.is-complete .llms-lesson-link:after,
			.llms-button-wrapper .llms-button-action,
			.llms-pointer.llms-inner #lifterlms-page-content .lifterlms_content_wrap .llms-button-action,
			.lifterlms_content_wrap .llms-button-primary,
			.single-course.llms-pointer .bb-llms-content-wrap .wp-block-llms-course-continue-button .llms-button-primary,
			.llms-sl .llms-button-primary,
			.frm_forms .frm_form_fields fieldset .frm_submit .frm_button_submit,
			.llms-button-action,
			.llms-button-action:hover,
			.llms-button-action:focus,
			.llms-button-action:active,
			.llms-button-action.clicked,
			.llms-button-primary,
			.llms-button-primary:focus,
			.llms-button-primary:active,
			.llms-button-primary:hover,
			.llms-button-primary.clicked,
			.llms-field-button:not(.llms-button-secondary),
			.llms-person-login-form-wrapper form.llms-login .llms-form-field.type-submit button#llms_login_button,
			.lifterlms .llms-checkout-wrapper .llms-button-action,
			.llms-print-certificate .button:hover,
			.llms-print-certificate .button:active,
			.llms-print-certificate .button:focus,
			.llms-quiz-ui .llms-question-wrapper.type--scale .llms-aq-scale .llms-aq-scale-range .llms-aq-scale-radio input[type="radio"]:checked + .llms-aq-scale-button,
			.llms-quiz-ui .llms-question-wrapper.type--scale .llms-aq-scale .llms-aq-scale-range .llms-aq-scale-radio .llms-aq-scale-button:hover,
			.llms-quiz-ui .llms-quiz-nav .button:not(.llms-button-secondary),
			.llms-student-dashboard.redeem-voucher button,
			.lmslifter .llms-pa-stamp,
			.llms-sd-grades .llms-table-sort form .llms-button-secondary,
			.bb-llms-content-wrap .llms-lesson-preview .llms-lesson-free,
			.llms-widget-syllabus .llms-lesson-complete.done,
			.llms-person-login-form-wrapper input#llms_remember:checked + label:before,
			.woocommerce-MyAccount-content .llms-sd-title + form button,
			.woocommerce-MyAccount-content .llms-notice + form button,
			.llms-pointer.llms-inner .lifterlms-lesson-nav .bb-ld-status .ld-status.ld-status-progress,
			.llms-pointer.llms-inner .lifterlms-lesson-nav .lifterlms_next_prev_link a:hover,
			.llms-pointer.llms-inner #lifterlms-page-content .lifterlms_content_wrap #llms_mark_incomplete,
			.lifter-sidebar-widgets li.widget a.button:not(.logout-link):hover
			{
				background-color: <?php echo $primary_color; ?>;
			}

			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper-quizzes .llms-lesson-preview.is-complete .llms-lesson-link:after,
			.llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview.is-complete .llms-lesson-link:after,
			.llms-syllabus-wrapper .llms-lesson-preview.is-complete .llms-lesson-complete,
			.llms-pa-posts.llms-pa-posts--single .llms-pa-post-discussion-form-wrap #llms-pa-post-discussion-form .llms-form-field.type-submit button,
			.llms-pa-posts.llms-pa-posts--single .llms-pa-discussion-list .llms_pa_post_comment.llms-pa-read:after,
			.llms_pa_post_comment.llms-pa-unread:after,
			.llms-pa-posts.llms-pa-posts--single #llms-pa-post-discussion-form .llms-form-field.type-submit #llms_pa_leave_comment,
			.nf-form-wrap .nf-form-content .nf-field-element input[type=button],
			body div.wpforms-container-full .wpforms-form button[type=submit]:hover,
			body .wpforms-confirmation-container-full,
			body div[submit-success] > .wpforms-confirmation-container-full:not(.wpforms-redirection-message),
			.llms-pointer.llms-inner .lifterlms-lessions-list .llms-syllabus-wrapper .llms-lesson-preview.llms-quizz-preview.is-complete .llms-lesson-link:after,
			.single-llms_quiz.llms-pointer #lifterlms-page-content .lifterlms_content_wrap .llms-button-action,
			.llms-pointer > .llms-notification,
			.llms-quiz-ui .llms-quiz-question-wrapper ol.llms-question-choices li.llms-choice input:checked + .llms-marker,
			.llms-quiz-ui .llms-quiz-nav .button,
			.llms-button-secondary,
			.llms-certificate__download .llms-certificate__downloadBtn,
			.llms-certificate__download button.llms-certificate__downloadBtn.button,
			.buddypress .buddypress-wrap .llms-certificate__download .llms-certificate__downloadBtn,
			.orders-table .llms-button-primary,
			#wp-llms_pa_post_comment-wrap.wp-core-ui .button.button-small,
			.llms-person-login-form-wrapper input#llms_remember:checked + label:before,
			.bb-progress .bb-progress-circle
			{
				border-color: <?php echo $primary_color; ?>;
			}

			.lifterlms .llms-sd-items .llms-sd-item:hover a,
			.lifterlms .llms-sd-items .current a,
			.llms-widget-syllabus .llms-lesson-complete.done, .llms-widget-syllabus .lesson-complete-placeholder.done,
			.llms-quiz-ui .llms-quiz-question-wrapper ol.llms-question-choices li.llms-choice .llms-marker .fa,
			.llms-quiz-ui .llms-question-wrapper.type--upload .llms-aq-uploader .fa.fa-upload,
			.llms-button-secondary,
			.llms-button-secondary:hover,
			.llms-button-secondary:active,
			.llms-button-secondary:focus,
			.frm_forms .frm_form_fields fieldset .frm_dropzone .dz-message .frm_icon_font.frm_upload_icon:before,
			.llms-certificate__download .llms-certificate__downloadBtn,
			.buddypress .buddypress-wrap .llms-certificate__download .llms-certificate__downloadBtn,
			.orders-table .llms-button-primary,
			.llms-pa-posts.llms-pa-posts--single .llms-pa-post-discussion-form-wrap #llms-pa-post-discussion-form .llms-form-field.type-submit button,
			#wp-llms_pa_post_comment-wrap.wp-core-ui .button.button-small,
			.llms-access-plan .llms-access-plan-restrictions ul a,
			.review_box #llms_review_submit_button,
			.llms-sl-uploader .fa-upload:before,
			.llms-pa-posts.llms-pa-posts--single .llms-pa-discussion-list .llms-pa-comment-toggle-read .read,
			#llms-group-upload-modal .llms-group-uploader .fa-upload:before,
			.llms-pa-posts.llms-pa-posts--single .llms-pa-discussion-list .llms-pa-comment-toggle-read .read,
			.llms-pa-posts.llms-pa-posts--single .llms-pa-discussion-list .llms-pa-comment-toggle-read .unread,
			.llms_pa_post_comment.llms-pa-unread:after,
			.llms-group .llms-group-sidebar .card--group-profile-members .fa-pencil:before,
			.llms-group .llms-group-sidebar .fa-plus:before,
			.llms-certificate__download .llms-certificate__downloadBtn,
			.llms-certificate__download button.llms-certificate__downloadBtn.button
			{
				color: <?php echo $primary_color; ?>;
			}

		   .single-course.llms-pointer .bb-single-course-sidebar .widget .bb-course-preview-wrap .bb-preview-course-link-wrap .thumbnail-container .bb-course-video-overlay:hover .bb-course-play-btn:hover:after
		   {
				border-color:  <?php echo 'transparent transparent transparent' . $primary_color; ?>;
		   }

		   .llms-sl-profile .llms-sl-profile-nav ul.llms-sl-menu li.llms-sl-menu-item.current a.llms-sl-menu-link,
		   .llms-group-profile .llms-group-profile-nav ul.llms-group-menu li.llms-group-menu-item.current a.llms-group-menu-link {
				border-bottom-color: <?php echo $primary_color; ?>;
		   }

		   .llms-form-field.type-radio input[type="radio"]:checked + label:before {
				background-image: radial-gradient(ellipse at center,  <?php echo $primary_color; ?> 0%,<?php echo $primary_color; ?> 40%, #fff 45%);
		   }

		   .llms-donut svg path {
				stroke: <?php echo $primary_color; ?>;
			}

		   .lifter-topic-sidebar-wrapper {
				background-color: <?php echo buddyboss_theme_get_option( 'body_background' ); ?>;
			}

			.llms-pointer.llms-inner #lifterlms-page-content
			{
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			.llms-pointer.llms-inner #lifterlms-page-content,
			ul.llms-payment-gateways li:last-child:after,
			.llms-sd-widgets .llms-sd-widget .llms-sd-widget-title {
				border-bottom-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.bp-navs ul li.selected a span {
				background-color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			.lifterlms-price,
			.llms-checkout-section-content .llms-label,
			.llms-access-plan-sale-end,
			.llms-access-plan-title,
			.bb-single-course-sidebar .llms-access-plan .llms-access-plan-title,
			.llms-meta-aplans__inDate,
			.lifterlms .llms-checkout-wrapper .llms-form-heading,
			.llms-pointer.llms-inner .lifter-topic-sidebar-course-navigation .ld-course-navigation h2,
			.iziModal .iziModal-header .iziModal-header-title,
			.llms-pointer.llms-inner #lifterlms-page-content #lifterlms-lesson-header .bb-ld-info-bar .ld-breadcrumbs .ld-breadcrumbs-segments span a,
			.llms-syllabus-wrapper .llms-lesson-preview .llms-lesson-title,
			.llms-widget-syllabus .lesson-title a,
			.llms-widget-syllabus .lesson-title.done a,
			.llms-sd-widgets .llms-sd-widget .llms-sd-widget-title,
			.single-llms_assignment #lifterlms-page-content .lifterlms_content_wrap p a,
			.llms-pointer.llms-inner #lifterlms-page-content #lifterlms-lesson-header .lifterlms-header-instructor .bb-about-instructor > .flex .bb-content-wrap h5 a,
			.single-llms_quiz .lifterlms-header-instructor .flex h5>a,
			.post-type-archive-course.llms-pointer .bb-course-items .bb-course-item-wrap .bb-cover-list-item .bb-card-course-details .bb-course-meta strong a,
			.single-llms_quiz.llms-pointer #lifterlms-page-content .lifterlms_content_wrap p:not(.llms-error) a,
			.llms-instructor-info .llms-instructors .llms-author a .llms-author-info.name,
			.lifter-sidebar-widgets .widget_course_syllabus .section-title
			{
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.llms-instructor-info .llms-instructors .llms-author a:hover .llms-author-info.name {
				color: <?php echo buddyboss_theme_get_option( 'header_links_hover' ); ?>;
			}

			.llms-pointer.llms-inner #lifterlms-page-content #lifterlms-lesson-header .bb-position .lifterlms-lesson-position span.bb-pages .bb-total,
			.single-llms_assignment #lifterlms-page-content .lifterlms_content_wrap .llms-lesson-button-wrapper,
			.single-llms_assignment #lifterlms-page-content .lifterlms_content_wrap h3,
			.llms-pointer.llms-inner #lifterlms-page-content #lifterlms-lesson-header .lifterlms-header-instructor .bb-about-instructor > .flex .bb-content-wrap h5 .bb-about-instructor-date,
			.single-llms_quiz .lifterlms-header-instructor .flex h5 span,
			.llms-progress .progress__indicator,
			.post-type-archive-course.llms-pointer .bb-course-items .bb-course-item-wrap .bb-cover-list-item .bb-card-course-details .bb-course-excerpt,
			.single-lesson.llms-pointer #lifterlms-page-content .lifterlms_content_wrap h3,
			.single-llms_quiz.llms-pointer #lifterlms-page-content .lifterlms_content_wrap .llms-lesson-button-wrapper,
			.single-lesson.llms-pointer #lifterlms-page-content #lifterlms-lesson-header .lifterlms-header-instructor .bb-about-instructor > .flex .bb-content-wrap h5 .meta-saperator,
			.single-llms_quiz #lifterlms-page-content #lifterlms-lesson-header .lifterlms-header-instructor .bb-about-instructor > .flex .bb-content-wrap h5 .meta-saperator,
			.llms-certificate__footer .llms-certificate__date-label
			{
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			.single-lesson.llms-pointer #lifterlms-page-content #lifterlms-lesson-header .lifterlms-header-instructor .bb-about-instructor > .flex .bb-content-wrap h5 .bb-about-instructor-date::before,
			.single-llms_quiz.llms-pointer #lifterlms-page-content #lifterlms-lesson-header .lifterlms-header-instructor .bb-about-instructor > .flex .bb-content-wrap h5 .bb-about-instructor-date::before{
				background-color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			.post-type-archive-course.llms-pointer .bb-cover-list-item,
			.post-type-archive-course.llms-pointer .bp-navs.bp-subnavs,
			.elementor-widget-bb-llms-courses .bp-navs.bp-subnavs,
			#certificate_list .bb-certificate-wrap,
			.bp-feedback.ld-feedback,
			.single-course.llms-pointer .bb-llms-content-wrap #thank_you_box,
			.llms-sd-notification-center .llms-notification,
			.llms-student-dashboard .orders-table th,
			.llms-student-dashboard .orders-table td,
			.llms-student-dashboard.orders table th,
			.llms-student-dashboard.orders table td,
			.llms-notification .llms-notification-footer,
			ul.llms-certificates-loop.listing-certificates li.llms-certificate-loop-item,
			ul.llms-achievements-loop li.llms-achievement-loop-item,
			.llms-loop-list .llms-loop-item-content,
			.lifterlms ul.llms-achievements-loop li.llms-achievement-loop-item,
			.llms-loop-list .llms-loop-item-content,
			.lifterlms .llms-student-dashboard,
			.lifterlms .llms-sd-header,
			.single-course.llms-pointer .bb-llms-content-wrap #old_reviews .llms_review,
			.lifterlms_content_wrap .llms-assignment-content.type--tasklist li.llms-assignment-task,
			.single-llms_assignment .llms-assignment-tasklist .llms-assignment-task .llms-task-marker,
			.llms-pointer.llms-inner .lifter-topic-sidebar-progress,
			.single-llms_quiz .lifterlms-header-instructor,
			.llms-pointer.llms-inner .lifter-topic-sidebar-wrapper .lifter-sidebar-widgets ul li.widget,
			.lmslifter .llms-pa-posts .llms-pa-post,
			.llms-access-plan .llms-access-plan-content,
			.llms-access-plan.featured .llms-access-plan-content,
			.llms-sl-profile-nav,
			.llms-checkout-section-content .llms-coupon-wrapper,
			.single-course.llms-pointer .bb-llms-content-wrap #old_reviews,
			.llms-group-profile .llms-group-profile-nav,
			.llms-group-card,
			.llms-group-card-footer,
			.llms-group-card-header,
			.llms-person-login-form-wrapper,
			body:not(.logged-in) .lifterlms .llms-student-dashboard .llms-lost-password-form,
			.card--group-profile-members__vip-blocks .llms-group-member,
			.card--group-profile-members__leaders,
			.llms-sd-widgets .llms-sd-widget {
				border-color: <?php echo buddyboss_theme_get_option( 'body_blocks_border' ); ?>;
			}

			.status-in-progress,
			#certificate_list .bb-certificate-wrap ,
			.bp-feedback.ld-feedback,
			.single-course.llms-pointer .bb-llms-content-wrap #thank_you_box {
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>;
			}

			.single-course.llms-pointer .bb-llms-content-wrap #old_reviews .llms_review {
				background-color: <?php echo buddyboss_theme_get_option( 'body_blocks' ); ?>!important;
			}

			.status-in-progress,
			.bp-feedback.ld-feedback
			{
				color: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>;
			}

			.llms-notification .llms-notification-body .llms-mini-cert,
			.lifterlms .llms-sd-header {
				background-color: <?php echo buddyboss_theme_get_option( 'light_background_blocks' ); ?>;
			}

			.llms-loop-link .bb-cover-wrap,
			.bb-course-cover .bb-cover-wrap,
			.bb-course-items .bb-course-cover--videoTile {
				background-color: <?php echo buddyboss_theme_get_option( 'buddyboss_theme_group_cover_bg' ); ?>;
			}

			#old_reviews:not(.old_reviews--revoke) .llms_review h5 {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?> !important;
			}

			#old_reviews:not(.old_reviews--revoke) .llms_review h6 {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?> !important;
			}

			/* Buttons */
			.llms-button-secondary,
			.llms-button-primary,
			.llms-field-button {
				border-radius: <?php echo $button_radius; ?>px;
			}

			.single-llms_quiz #llms-quiz-header:before {
				content: "<?php echo __( 'Quiz Progress', 'buddyboss-theme' ); ?>";
			}

		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;
		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}
		$custom_css['css'] = $css;

		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_lifterLMS_custom_css', $custom_css );

	}

	/* Add Action */
	if ( class_exists( 'lifterLMS' ) ) {
		add_action( 'wp_head', 'boss_generate_option_lifterLMS_css', 99 );
	}
}


/**
 * Elementor Custom Styling
 */
if ( ! function_exists( 'boss_generate_option_elementor_css' ) ) {
	function boss_generate_option_elementor_css() {

		if ( is_customize_preview() ) {
			$custom_css = '';
		} else {
			$custom_css = get_transient( 'buddyboss_theme_compressed_elementor_custom_css' );
		}

		if ( ! empty( $custom_css ) && isset( $custom_css['css'] ) ) {

			echo "
            <style id=\"buddyboss_theme-elementor-style\">
                {$custom_css["css"]}
            </style>
            ";

			return false;

		}

		$primary_color               = buddyboss_theme_get_option( 'accent_color' );
		$highlight_color             = buddyboss_theme_get_option( 'highlight_color' );
		$body_blocks_border          = buddyboss_theme_get_option( 'body_blocks_border' );
		$alternate_link_color        = buddyboss_theme_get_option( 'alternate_link_color' );
		$alternate_link_active_color = buddyboss_theme_get_option( 'alternate_link_active' );
		$button_radius               = buddyboss_theme_get_option( 'button_default_radius' );
		$danger_color                = buddyboss_theme_get_option( 'error_notice_bg_color' );
		$success_color               = buddyboss_theme_get_option( 'success_notice_bg_color' );
		$warning_color               = buddyboss_theme_get_option( 'warning_notice_bg_color' );
		?>

		<style id="buddyboss_theme-elementor-style">

		<?php ob_start(); ?>

			.bb-la .slick-arrow i {
				color: <?php echo $primary_color; ?>;
			}

			.bb-tabs__run ul.slick-dots .slick-active button,
			.bb-tabs__run .slick-arrow:hover,
			.tabs-wrapper--style1 a.bb-tabs__link,
			.bb-gallery ul.slick-dots li.slick-active button {
				background-color: <?php echo $primary_color; ?>;
			}

			.tabs-wrapper--style2 a.bb-tabs__link,
			.tabs-wrapper--style2 .slick-current .bb-tabs__nav-index,
			.tabs-wrapper--style1 .bb-tabs__nav.bb-tabs__active-outline .slick-current .bb-tabs__nav-title,
			.tabs-wrapper--style1 .bb-tabs__nav.bb-tabs__active-underline .slick-current .bb-tabs__nav-title {
				border-color: <?php echo $primary_color; ?>;
			}

			.bb-members,
			.bb-activity,
			.bb-forums,
			.bb-members-extra,
			.bb-activity-extra,
			.bb-forums-extra,
			.bb-dash-grid,
			.profile_bit.skin-linear .progress_container,
			.profile_bit.skin-linear .profile_bit__details,
			.bb-activity #buddypress .activity-lists.bp-list .activity-item,
			.bb-forums__list > li,
			.bb-dash-grid__block:after {
				border-color: <?php echo $body_blocks_border; ?>;
			}

			.profile_bit__heading .progress-num,
			.profile_bit__heading .progress-label,
			.progress_bit__data-num {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.progress_bit__data-remark,
			.progress_bit__data-num > span {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			/* Elementor Widgets Styling */
			.elementor-button {
				background-color: <?php echo $primary_color; ?>;
			}

			#content .elementor-widget-container li.product .price,
			#content .wp-block-woocommerce-handpicked-products li.product .price,
			#content .wp-block-woocommerce-product-category li.product .price,
			#content .wp-block-woocommerce-product-new li.product .price,
			#content .wp-block-woocommerce-product-on-sale li.product .price,
			#content .wp-block-woocommerce-product-top-rated li.product .price,
			#content .wp-block-woocommerce-products-by-attribute li.product .price,
			#content .wp-block-woocommerce-product-best-sellers li.product .price,
			.bb-activity #buddypress .activity-lists .action.bp-generic-meta .button,
			.bb-dash-grid__body .bb-dash-grid__ico i {
				color: <?php echo $primary_color; ?>;
			}

			.elementor-headline--style-highlight svg path {
				stroke: <?php echo $highlight_color; ?>;
			}

			.elementor-posts div.elementor-post__excerpt p,
			.elementor-cta--skin-classic .elementor-cta__content-item.elementor-cta__description,
			div.elementor-widget-blockquote blockquote,
			.elementor-counter div.elementor-counter-title,
			.elementor-price-table .elementor-price-table__period,
			.bb-dash-grid__info {
				color: <?php echo buddyboss_theme_get_option( 'body_text_color' ); ?>;
			}

			.elementor-price-list-description,
			.elementor-posts div.elementor-post__meta-data,
			.elementor-testimonial__title,
			.elementor-widget-reviews .elementor-testimonial__title,
			.elementor-testimonial-wrapper div.elementor-testimonial-job,
			.bb-activity .activity-content .activity-state a.activity-state-likes .like-text {
				color: <?php echo buddyboss_theme_get_option( 'alternate_text_color' ); ?>;
			}

			.elementor-post__title a,
			.elementor-price-table .elementor-price-table__currency,
			.elementor-price-table .elementor-price-table__integer-part,
			.elementor-price-table .elementor-price-table__fractional-part,
			.elementor-cta--skin-classic .elementor-cta__content-item.elementor-cta__title,
			.elementor-testimonial__name,
			.elementor-widget-reviews .elementor-testimonial__name,
			.elementor-blockquote__author,
			.elementor-counter div.elementor-counter-number-wrapper,
			.elementor-testimonial-wrapper div.elementor-testimonial-name,
			.elementor-accordion .elementor-tab-title,
			.elementor-toggle .elementor-tab-title,
			.elementor-icon-box-title {
				color: <?php echo buddyboss_theme_get_option( 'heading_text_color' ); ?>;
			}

			.elementor-post__title a:hover {
				color: <?php echo buddyboss_theme_get_option( 'alternate_link_hover' ); ?>;
			}

			#content .elementor-widget-container ul.products li.product .onsale,
			#content .wp-block-woocommerce-handpicked-products ul.products li.product .onsale,
			#content .wp-block-woocommerce-product-category ul.products li.product .onsale,
			#content .wp-block-woocommerce-product-new ul.products li.product .onsale,
			#content .wp-block-woocommerce-product-on-sale ul.products li.product .onsale,
			#content .wp-block-woocommerce-product-top-rated ul.products li.product .onsale,
			#content .wp-block-woocommerce-products-by-attribute ul.products li.product .onsale,
			#content .wp-block-woocommerce-product-best-sellers ul.products li.product .onsale,
			div.elementor-price-table__ribbon-inner {
				background-color: <?php echo $highlight_color; ?>;
			}

			.elementor-widget-progress .elementor-progress-wrapper.progress-info div.elementor-progress-bar,
			.elementor-element.elementor-button-info a.elementor-button {
				background-color: <?php echo buddyboss_theme_get_option( 'default_notice_bg_color' ); ?>;
			}

			div.elementor-alert.elementor-alert-info {
				color: <?php echo buddyboss_theme_get_option( 'default_notice_bg_color' ); ?>;
			}

			div.elementor-alert.elementor-alert-info {
				border-color: <?php echo color2rgba( buddyboss_theme_get_option( 'default_notice_bg_color' ), 0.3 ); ?>;
			}

			div.elementor-alert.elementor-alert-info {
				background-color: <?php echo color2rgba( buddyboss_theme_get_option( 'default_notice_bg_color' ), 0.1 ); ?>;
			}

			.elementor-widget-progress .elementor-progress-wrapper.progress-success div.elementor-progress-bar,
			.elementor-element.elementor-button-success a.elementor-button {
				background-color: <?php echo $success_color; ?>;
			}

			div.elementor-alert.elementor-alert-success {
				color: <?php echo $success_color; ?>;
			}

			div.elementor-alert.elementor-alert-success {
				border-color: <?php echo color2rgba( $success_color, 0.3 ); ?>;
			}

			div.elementor-alert.elementor-alert-success {
				background-color: <?php echo color2rgba( $success_color, 0.1 ); ?>;
			}

			.elementor-widget-progress .elementor-progress-wrapper.progress-warning div.elementor-progress-bar,
			.elementor-element.elementor-button-warning a.elementor-button {
				background-color: <?php echo $warning_color; ?>;
			}

			div.elementor-alert.elementor-alert-warning {
				color: <?php echo $warning_color; ?>;
			}

			div.elementor-alert.elementor-alert-warning {
				border-color: <?php echo color2rgba( $warning_color, 0.3 ); ?>;
			}

			div.elementor-alert.elementor-alert-warning {
				background-color: <?php echo color2rgba( $warning_color, 0.1 ); ?>;
			}

			.elementor-widget-progress .elementor-progress-wrapper.progress-danger div.elementor-progress-bar,
			.elementor-element.elementor-button-danger a.elementor-button {
				background-color: <?php echo $danger_color; ?>;
			}

			div.elementor-alert.elementor-alert-danger {
				color: <?php echo $danger_color; ?>;
			}

			div.elementor-alert.elementor-alert-danger {
				border-color: <?php echo color2rgba( $danger_color, 0.3 ); ?>;
			}

			div.elementor-alert.elementor-alert-danger {
				background-color: <?php echo color2rgba( $danger_color, 0.1 ); ?>;
			}

			.elementor-button,
			.elementor-button.elementor-size-xs,
			.elementor-button.elementor-size-md,
			.elementor-button.elementor-size-lg,
			.elementor-button.elementor-size-xl,
			.bb-la__link a,
			.bb-fa__link a,
			.profile_bit_action a.profile_bit_action__link,
			.bb-la-activity-btn a.bb-la-activity-btn__link,
			.bb-forums-activity-btn a.bb-forums-activity-btn__link {
				border-radius: <?php echo $button_radius; ?>px;
			}

		<?php

		$css = ob_get_contents();
		// Remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		// Remove space after colons
		$css = str_replace( ': ', ':', $css );
		// Remove whitespace
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );

		ob_end_clean();

		echo $css;

		if ( ! is_array( $custom_css ) ) {
			$custom_css = array();
		}

		$custom_css['css'] = $css;
		?>

		</style>
		<?php

		// save processed css.
		set_transient( 'buddyboss_theme_compressed_elementor_custom_css', $custom_css );

	}

	/* Add Action */
	if ( defined( 'ELEMENTOR_VERSION' ) ) {
		add_action( 'wp_head', 'boss_generate_option_elementor_css', 99 );
	}
}

<?php
/**
 * BuddyPress - Users Cover Image Header
 *
 * @since 3.0.0
 * @version 3.0.0
 */

$profile_cover_width = buddyboss_theme_get_option( 'buddyboss_profile_cover_width' );
$profile_cover_height = buddyboss_theme_get_option( 'buddyboss_profile_cover_height' );
remove_filter( 'bp_get_add_follow_button', 'buddyboss_theme_bp_get_add_follow_button' );

$has_cover_image = '';
$has_cover_image_position = '';
$displayed_user = bp_get_displayed_user();
$cover_image_url = bp_attachments_get_attachment(
	'url',
	array(
		'object_dir' => 'members',
		'item_id' => $displayed_user->id,
	)
);
$default_cover_image = buddyboss_theme_get_option( 'buddyboss_profile_cover_default' );
?>

<?php if ( ! bp_is_user_messages() && ! bp_is_user_settings() && ! bp_is_user_notifications()&& ! bp_is_user_profile_edit() && ! bp_is_user_change_avatar() && ! bp_is_user_change_cover_image() ) : ?>

	<div id="cover-image-container">

	<?php
		if ( ! empty( $cover_image_url ) || ! empty( $default_cover_image['url'] )) {
			$cover_image_position = bp_get_user_meta( bp_displayed_user_id(), 'bp_cover_position', true );
			$has_cover_image = ' has-cover-image';
			if ( '' !== $cover_image_position ) {
				$has_cover_image_position = 'has-position';
			}
		}
	?>

		<div id="header-cover-image" class="cover-<?php echo $profile_cover_height; ?> <?php echo 'width-' . $profile_cover_width; ?> <?php echo $has_cover_image_position; echo $has_cover_image; ?>" >
			<?php
			if ( ! empty( $cover_image_url ) ) {
				echo '<img class="header-cover-img" src="' . esc_url( $cover_image_url ) . '"' . ( '' !== $cover_image_position ? ' data-top="' . $cover_image_position . '"' : '' ) . ( '' !== $cover_image_position ? ' style="top: ' . $cover_image_position . 'px"' : '' ) . ' />';
			} elseif ( ! empty( $default_cover_image['url'] )  ) {
				echo '<img class="header-cover-img" src="' . esc_url( $default_cover_image['url'] ) . '"' . ( '' !== $cover_image_position ? ' data-top="' . $cover_image_position . '"' : '' ) . ( '' !== $cover_image_position ? ' style="top: ' . $cover_image_position . 'px"' : '' ) . ' />';
			}
			?>

			<?php if ( bp_is_my_profile() ) { ?>
				<a href="<?php echo bp_get_members_component_link( 'profile', 'change-cover-image' ); ?>" class="link-change-cover-image" data-balloon-pos="right" data-balloon="<?php _e('Change Cover Photo', 'buddyboss-theme'); ?>">
					<i class="bb-icon-edit-thin"></i>
				</a>

				<?php if ( ! empty( $cover_image_url ) || ! empty( $default_cover_image['url'] ) ) { ?>
					<a href="#" class="position-change-cover-image" data-balloon-pos="right" data-balloon="<?php _e('Reposition Cover Photo', 'buddyboss-theme'); ?>">
						<span class="dashicons dashicons-move"></span>
					</a>
					<div class="header-cover-reposition-wrap">
						<a href="#" class="button small cover-image-cancel"><?php _e('Cancel', 'buddyboss-theme'); ?></a>
						<a href="#" class="button small cover-image-save"><?php _e('Save Changes', 'buddyboss-theme'); ?></a>
						<span class="drag-element-helper"><i class="bb-icon-menu"></i><?php _e('Drag to move cover photo', 'buddyboss-theme'); ?></span>
						<?php if ( ! empty( $cover_image_url ) ) { ?>
							<img src="<?php echo esc_url( $cover_image_url );  ?>" alt="<?php _e('Cover photo', 'buddyboss-theme'); ?>" />
						<?php } elseif( ! empty( $default_cover_image['url'] ) ) { ?>
							<img src="<?php echo esc_url( $default_cover_image['url'] );  ?>" alt="<?php _e('Cover photo', 'buddyboss-theme'); ?>" />
						<?php } ?>
						
					</div>
				<?php } ?>

			<?php } ?>
		</div>

		<?php $class = bp_disable_cover_image_uploads() ? 'bb-disable-cover-img' : 'bb-enable-cover-img'; ?>

		<div id="item-header-cover-image" class="item-header-wrap <?php echo $class; ?>">

			<div id="item-header-avatar">
				<?php if ( bp_is_my_profile() && ! bp_disable_avatar_uploads() ) { ?>
					<a href="<?php bp_members_component_link( 'profile', 'change-avatar' ); ?>" class="link-change-profile-image" data-balloon-pos="down" data-balloon="<?php _e('Change Profile Photo', 'buddyboss-theme'); ?>">
						<i class="bb-icon-edit-thin"></i>
					</a>
				<?php } ?>
				<?php bp_displayed_user_avatar( 'type=full' ); ?>
			</div><!-- #item-header-avatar -->

			<div id="item-header-content">

				<div class="flex">
					<div class="bb-user-content-wrap">
						<div class="flex align-items-center member-title-wrap">
							<h2 class="user-nicename"><?php echo bp_core_get_user_displayname( bp_displayed_user_id() ); ?></h2>
							<?php
							if ( function_exists( 'bp_member_type_enable_disable' ) && function_exists( 'bp_member_type_display_on_profile' ) && true === bp_member_type_enable_disable() && true === bp_member_type_display_on_profile() ) {
								echo bp_get_user_member_type( bp_displayed_user_id() );
							}
							?>
						</div>

						<?php bp_nouveau_member_hook( 'before', 'header_meta' ); ?>

						<?php if ( ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) || bp_nouveau_member_has_meta() ) : ?>
							<div class="item-meta">
								<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
									<span class="mention-name">@<?php bp_displayed_user_mentionname(); ?></span>
								<?php endif; ?>

								<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() && bp_nouveau_member_has_meta() ) : ?>
									<span class="separator">&bull;</span>
								<?php endif; ?>

								<?php bp_nouveau_member_hook( 'before', 'in_header_meta' ); ?>

								<?php if ( bp_nouveau_member_has_meta() ) : ?>
									<?php bp_nouveau_member_meta(); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<?php if( function_exists( 'bp_is_activity_follow_active' ) && bp_is_active('activity') && bp_is_activity_follow_active() ) { ?>
							<div class="flex align-items-top member-social">
                                <div class="flex align-items-center">
    								<?php buddyboss_theme_followers_count(); ?>
    								<?php buddyboss_theme_following_count(); ?>
                                </div>
								<?php
								if( function_exists('bp_get_user_social_networks_urls') ){
									echo bp_get_user_social_networks_urls();
								}
								?>
							</div>
						<?php } else { ?>
                            <div class="flex align-items-center">
	                            <?php
	                            if( function_exists('bp_get_user_social_networks_urls') ){
	                            	echo bp_get_user_social_networks_urls();
	                        	}
	                            ?>
                            </div>
						<?php } ?>
					</div>

					<?php remove_filter( 'bp_get_add_friend_button', 'buddyboss_theme_bp_get_add_friend_button' ); ?>
					<?php bp_nouveau_member_header_buttons( array( 'container_classes' => array( 'member-header-actions' ) ) ); ?>
					<?php
					if ( function_exists( 'bp_nouveau_member_header_bubble_buttons' ) ) {
						bp_nouveau_member_header_bubble_buttons( array( 'container_classes' => array( 'bb_more_options' ), ) );
					}
					?>
					<?php add_filter( 'bp_get_add_friend_button', 'buddyboss_theme_bp_get_add_friend_button' ); ?>
				</div>

			</div><!-- #item-header-content -->

		</div><!-- #item-header-cover-image -->
	</div><!-- #cover-image-container -->

<?php
add_filter( 'bp_get_add_follow_button', 'buddyboss_theme_bp_get_add_follow_button' );

endif;

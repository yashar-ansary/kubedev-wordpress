<?php

if ( ! function_exists( 'buddyboss_notification_avatar' ) ) {
	function buddyboss_notification_avatar() {
		$notification = buddypress()->notifications->query_loop->notification;
		$component    = $notification->component_name;

		switch ( $component ) {
			case 'groups':
				if ( ! empty( $notification->item_id ) ) {
					$item_id = $notification->item_id;
					$object  = 'group';
				}
				break;
			case 'follow':
			case 'friends':
				if ( ! empty( $notification->item_id ) ) {
					$item_id = $notification->item_id;
					$object  = 'user';
				}
				break;
			case has_action( 'bb_notification_avatar_' . $component ):
				do_action( 'bb_notification_avatar_' . $component );
				break;
			default:
				if ( ! empty( $notification->secondary_item_id ) ) {
					$item_id = $notification->secondary_item_id;
					$object  = 'user';
				} else {
					$item_id = $notification->item_id;
					$object  = 'user';
				}
				break;
		}

		if ( isset( $item_id, $object ) ) {

			if ( 'group' === $object ) {
				$group = new BP_Groups_Group( $item_id );
				$link  = bp_get_group_permalink( $group );
			} else {
				$user = new WP_User( $item_id );
				$link = bp_core_get_user_domain( $user->ID, $user->user_nicename, $user->user_login );
			}

			?>
			<a href="<?php echo esc_url( $link ); ?>">
				<?php
				echo bp_core_fetch_avatar(
					array(
						'item_id' => $item_id,
						'object'  => $object,
					)
				);
				?>
				<?php ( isset( $user ) ? bb_user_status( $user->ID ) : '' ); ?>
			</a>
			<?php
		}

	}
}

if ( ! function_exists( 'buddyboss_unique_id' ) ) {
	/**
	 * Get unique ID.
	 *
	 * This is a PHP implementation of Underscore's uniqueId method. A static variable
	 * contains an integer that is incremented with each call. This number is returned
	 * with the optional prefix. As such the returned value is not universally unique,
	 * but it is unique across the life of the PHP process.
	 *
	 * @param string $prefix Prefix for the returned ID.
	 *
	 * @return string Unique ID.
	 *
	 * @staticvar int $id_counter
	 */
	function buddyboss_unique_id( $prefix = '' ) {
		static $id_counter = 0;

		return $prefix . (string) ++ $id_counter;
	}
}

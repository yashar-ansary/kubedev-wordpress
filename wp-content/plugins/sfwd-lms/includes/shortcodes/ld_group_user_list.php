<?php
/**
 * LearnDash `[learndash_group_user_list]` shortcode processing.
 *
 * @since 2.1.0
 * @package LearnDash\Shortcodes
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Builds the `[learndash_group_user_list]` shortcode output.
 *
 * @since 2.1.0
 *
 * @global boolean $learndash_shortcode_used
 *
 * @param int $group_id ID of the group to get list for.
 *
 * @return string|void Echos shortcode output or returns string if no users found.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function learndash_group_user_list( $attr = array(), $content = '' ) {
	global $learndash_shortcode_used;
	$learndash_shortcode_used = true;

	if ( ( isset( $attr[0] ) ) && ( ! empty( $attr[0] ) ) ) {
		if ( ! isset( $attr['group_id'] ) ) {
			$attr['group_id'] = absint( $attr[0] );
			unset( $attr[0] );
		}
	}

	$attr = shortcode_atts(
		array(
			'group_id' => 0,
		),
		$attr
	);

	$attr['group_post'] = null;
	if ( ! empty( $attr['group_id'] ) ) {
		$attr['group_post'] = get_post( $attr['group_id'] );
		if ( ( $attr['group_post'] ) && ( is_a( $attr['group_post'], 'WP_Post' ) ) && ( learndash_get_post_type_slug( 'group' ) === $attr['group_post']->post_type ) ) {

			$current_user = wp_get_current_user();

			if ( ( ! learndash_is_admin_user( $current_user ) ) && ( ! learndash_is_group_leader_user( $current_user ) ) ) {
				return sprintf(
					// translators: placeholder: Group.
					esc_html_x( 'Please login as a %s Administrator', 'placeholder: Group', 'learndash' ),
					LearnDash_Custom_Label::get_label( 'group' )
				);
			}

			$users = learndash_get_groups_users( $attr['group_id'] );
			if ( ! empty( $users ) ) {
				?>
				<table cellspacing="0" class="wp-list-table widefat fixed groups_user_table">
				<thead>
					<tr>
						<th class="manage-column column-sno " id="sno" scope="col" ><?php esc_html_e( 'S. No.', 'learndash' ); ?></th>
						<th class="manage-column column-name " id="group" scope="col"><?php esc_html_e( 'Name', 'learndash' ); ?></th>
						<th class="manage-column column-name " id="group" scope="col"><?php esc_html_e( 'Username', 'learndash' ); ?></th>
						<th class="manage-column column-name " id="group" scope="col"><?php esc_html_e( 'Email', 'learndash' ); ?></th>
						<th class="manage-column column-action" id="action" scope="col"><?php esc_html_e( 'Action', 'learndash' ); ?></span></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th class="manage-column column-sno " id="sno" scope="col" ><?php esc_html_e( 'S. No.', 'learndash' ); ?></th>
						<th class="manage-column column-name " id="group" scope="col"><?php esc_html_e( 'Name', 'learndash' ); ?></th>
						<th class="manage-column column-name " id="group" scope="col"><?php esc_html_e( 'Username', 'learndash' ); ?></th>
						<th class="manage-column column-name " id="group" scope="col"><?php esc_html_e( 'Email', 'learndash' ); ?></th>
						<th class="manage-column column-action" id="action" scope="col"><?php esc_html_e( 'Action', 'learndash' ); ?></span></th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					$sn = 1;
					foreach ( $users as $user ) {
						$name = isset( $user->display_name ) ? $user->display_name : $user->user_nicename;
						$report_url = add_query_arg(
							array(
								'page'     => 'group_admin_page',
								'group_id' => $attr['group_id'],
								'user_id'  => $user->ID,
							),
							admin_url( 'admin.php' )
						);
						?>
						<tr>
							<td><?php echo esc_html( $sn++ ); ?></td>
							<td><?php echo esc_html( $name ); ?></td>
							<td><?php echo esc_html( $user->user_login ); ?></td>
							<td><?php echo esc_html( $user->user_email ); ?></td>
							<td><a href="<?php echo esc_url( $report_url ); ?>"><?php esc_html_e( 'Report', 'learndash' ); ?></a></td>
						</tr>
						<?php
					}
					?>
				</tbody>
				</table>
				<?php
			} else {
				return esc_html__( 'No users.', 'learndash' );
			}
		}
	}
}
add_shortcode( 'learndash_group_user_list', 'learndash_group_user_list', 10, 2 );

<?php
/**
 * Menu editor handler
 *
 * @package Buddyboss_Menu_Icons
 * @author  Dzikri Aziz <kvcrvt@gmail.com>
 */


/**
 * Nav menu admin
 */
final class Menu_Icons_Picker {

	/**
	 * Initialize class
	 *
	 * @since 0.1.0
	 */
	public static function init() {
		add_action( 'load-nav-menus.php', array( __CLASS__, '_load_nav_menus' ) );
		global $wp_version;
		if ( version_compare( $wp_version, '5.3.2', '<=' ) ) {
			add_filter( 'wp_edit_nav_menu_walker', array( __CLASS__, '_filter_wp_edit_nav_menu_walker' ), 99 );
		}
		add_filter( 'wp_nav_menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 4 );
		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
		add_filter( 'icon_picker_type_props', array( __CLASS__, '_add_extra_type_props_data' ), 10, 3 );
		add_filter( 'buddyboss_menu_icon_props_data', array( __CLASS__, '_buddyboss_menu_icon_props_data' ), 10, 3 );
	}


	/**
	 * Load Icon Picker
	 *
	 * @since Menu Icons  0.9.0
	 * @wp_hook action load-nav-menus.php
	 */
	public static function _load_nav_menus() {
		Icon_Picker::instance()->load();

		add_action( 'print_media_templates', array( __CLASS__, '_media_templates' ) );
	}


	/**
	 * Custom walker
	 *
	 * @since Menu Icons  0.3.0
	 * @access  protected
	 * @wp_hook filter    wp_edit_nav_menu_walker
	 */
	public static function _filter_wp_edit_nav_menu_walker( $walker ) {
		// Load menu item custom fields plugin
		if ( ! class_exists( 'Menu_Item_Custom_Fields_Walker' ) ) {
			require_once Buddyboss_Menu_Icons::get( 'dir' ) . 'includes/library/menu-item-custom-fields/walker-nav-menu-edit.php';
		}
		$walker = 'Menu_Item_Custom_Fields_Walker';

		return $walker;
	}


	/**
	 * Get menu item setting fields
	 *
	 * @since Menu Icons 0.9.0
	 * @access protected
	 *
	 * @param  array $meta Menu item meta value.
	 *
	 * @return array
	 */
	protected static function _get_menu_item_fields( $meta ) {
		$fields = array_merge(
			array(
				array(
					'id'    => 'type',
					'label' => __( 'Type', 'buddyboss-theme' ),
					'value' => $meta['type'],
				),
				array(
					'id'    => 'icon',
					'label' => __( 'Icon', 'buddyboss-theme' ),
					'value' => $meta['icon'],
				),
			),
			Menu_Icons_Settings::get_settings_fields( $meta )
		);

		return $fields;
	}


	/**
	 * Print fields
	 *
	 * @since Menu Icons  0.1.0
	 * @access  protected
	 * @uses    add_action() Calls 'menu_icons_before_fields' hook
	 * @uses    add_action() Calls 'menu_icons_after_fields' hook
	 * @wp_hook action       menu_item_custom_fields
	 *
	 * @param object $item Menu item data object.
	 * @param int $depth Nav menu depth.
	 * @param array $args Menu item args.
	 * @param int $id Nav menu ID.
	 *
	 * @return string Form fields
	 */
	public static function _fields( $id, $item, $depth, $args ) {
		$input_id      = sprintf( 'menu-icons-%d', $item->ID );
		$input_name    = sprintf( 'menu-icons[%d]', $item->ID );
		$menu_settings = Menu_Icons_Settings::get_menu_settings( Menu_Icons_Settings::get_current_menu_id() );
		$meta          = Menu_Icons_Meta::get( $item->ID, $menu_settings );
		$new = false;
		$icon = '';

		if ( '' === $meta['type'] && isset( $_POST['action'] ) && 'add-menu-item' === $_POST['action'] ) {

			$llms_stack = array(
				'llms-nav-item-view-courses',
				'llms-nav-item-dashboard',
				'llms-nav-item-my-grades',
				'llms-nav-item-view-memberships',
				'llms-nav-item-view-achievements',
				'llms-nav-item-view-certificates',
				'llms-nav-item-notifications',
				'llms-nav-item-edit-account',
				'llms-nav-item-redeem-voucher',
				'llms-nav-item-orders',
				'llms-nav-item-signin',
				'llms-nav-item-signout'
			);

			if( count( array_intersect( $llms_stack, $item->classes ) ) == count( $item->classes ) ){
				if ( 'llms-nav-item-view-courses' === $item->classes[0] ) {
					$icon = 'bb-icon-graduation-cap';
				} elseif ( 'llms-nav-item-dashboard' === $item->classes[0] ) {
					$icon = 'bb-icon-list-doc';
				} elseif ( 'llms-nav-item-my-grades' === $item->classes[0] ) {
					$icon = 'bb-icon-bar-chart';
				} elseif ( 'llms-nav-item-view-memberships' === $item->classes[0] ) {
					$icon = 'bb-icon-membership';
				} elseif ( 'llms-nav-item-view-achievements' === $item->classes[0] ) {
					$icon = 'bb-icon-target';
				} elseif ( 'llms-nav-item-view-certificates' === $item->classes[0] ) {
					$icon = 'bb-icon-badge';
				} elseif ( 'llms-nav-item-notifications' === $item->classes[0] ) {
					$icon = 'bb-icon-bell-plus';
				} elseif ( 'llms-nav-item-edit-account' === $item->classes[0] ) {
					$icon = 'bb-icon-edit-thin';
				} elseif ( 'llms-nav-item-redeem-voucher' === $item->classes[0] ) {
					$icon = 'bb-icon-rocket';
				} elseif ( 'llms-nav-item-orders' === $item->classes[0] ) {
					$icon = 'bb-icon-layers';
				} elseif ( 'llms-nav-item-signin' === $item->classes[0] ) {
					$icon = 'bb-icon-power-small';
				} elseif ( 'llms-nav-item-signout' === $item->classes[0] ) {
					$icon = 'bb-icon-power-small';
				}
			}

		    if ( in_array( 'bp-menu', $item->classes ) ) {
		        if ( 'bp-profile-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-user-alt';
                } elseif ( 'bp-settings-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-settings';
		        } elseif ( 'bp-activity-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-activity';
                } elseif ( 'bp-notifications-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-bell-small';
		        } elseif ( 'bp-messages-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-inbox-small';
		        } elseif ( 'bp-friends-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-users';
		        } elseif ( 'bp-groups-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-groups';
		        } elseif ( 'bp-forums-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-discussion';
		        } elseif ( 'bp-videos-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-video';
		        } elseif ( 'bp-documents-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-folder-stacked';
		        } elseif ( 'bp-photos-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-image-square';
		        } elseif ( 'bp-invites-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-mail';
		        } elseif ( 'bp-logout-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-log-out';
		        } elseif ( 'bp-login-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-log-in';
		        } elseif ( 'bp-register-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-clipboard';
		        } elseif ( 'bp-courses-nav' === $item->classes[1] ) {
			        $icon = 'bb-icon-graduation-cap';
		        }
			}
			$new                    = true;
			$meta['type']           = 'buddyboss';
			$meta['icon']           = $icon;
			$meta['url']            = '';
			$meta['hide_label']     = '';
			$meta["position"]       = 'before';
			$meta["vertical_align"] = 'middle';
			$meta["font_size"]      = '20';
			$meta["svg_width"]      = '1';
			$meta["image_size"]     = 'thumbnail';

        }
		$fields        = self::_get_menu_item_fields( $meta );
		?>
        <div class="field-icon description-wide menu-icons-wrap" data-id="<?php echo json_encode( $item->ID ); ?>">
			<?php
			/**
			 * Allow plugins/themes to inject HTML before menu icons' fields
			 *
			 * @param object $item Menu item data object.
			 * @param int $depth Nav menu depth.
			 * @param array $args Menu item args.
			 * @param int $id Nav menu ID.
			 *
			 */
			do_action( 'menu_icons_before_fields', $item, $depth, $args, $id );
			?>
            <p class="description submitbox">
                <label><?php esc_html_e( 'Icon:', 'buddyboss-theme' ) ?></label>
                <?php if ( true === $new ) {
	                printf( '<a class="_select" title="Change"><i class="_icon buddyboss %s"></i></a>', $icon );
	                printf( '<a class="_remove submitdelete">%s</a>', esc_html__( 'Remove', 'buddyboss-theme' ) );
                } else {
	                printf( '<a class="_select">%s</a>', esc_html__( 'Select', 'buddyboss-theme' ) );
	                printf( '<a class="_remove submitdelete hidden">%s</a>', esc_html__( 'Remove', 'buddyboss-theme' ) );
                } ?>
            </p>
            <div class="_settings hidden">
				<?php
				foreach ( $fields as $field ) {
					printf(
						'<label>%1$s: <input type="text" name="%2$s" class="_mi-%3$s" value="%4$s" /></label><br />',
						esc_html( $field['label'] ),
						esc_attr( "{$input_name}[{$field['id']}]" ),
						esc_attr( $field['id'] ),
						esc_attr( $field['value'] )
					);
				}

				// The fields below will not be saved. They're only used for the preview.
				printf( '<input type="hidden" class="_mi-url" value="%s" />', esc_attr( $meta['url'] ) );
				?>
            </div>
			<?php
			/**
			 * Allow plugins/themes to inject HTML after menu icons' fields
			 *
			 * @param object $item Menu item data object.
			 * @param int $depth Nav menu depth.
			 * @param array $args Menu item args.
			 * @param int $id Nav menu ID.
			 *
			 */
			do_action( 'menu_icons_after_fields', $item, $depth, $args, $id );
			?>
        </div>
		<?php
	}


	/**
	 * Add our field to the screen options toggle
	 *
	 * @since Menu Icons  0.1.0
	 * @access  private
	 * @wp_hook action  manage_nav-menus_columns
	 * @link    http://codex.wordpress.org/Plugin_API/Filter_Reference/manage_posts_columns
	 *
	 * @param array $columns Menu item columns
	 *
	 * @return array
	 */
	public static function _columns( $columns ) {
		$columns['icon'] = __( 'Icon', 'buddyboss-theme' );

		return $columns;
	}


	/**
	 * Save menu item's icons metadata
	 *
	 * @since Menu Icons  0.1.0
	 * @access  protected
	 * @wp_hook action    wp_update_nav_menu_item
	 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/wp_update_nav_menu_item
	 *
	 * @param int $menu_id Nav menu ID.
	 * @param int $menu_item_db_id Menu item ID.
	 * @param array $menu_item_args Menu item data.
	 */
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		$screen = get_current_screen();
		if ( ! $screen instanceof WP_Screen || 'nav-menus' !== $screen->id ) {
			return;
		}

		check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		// Sanitize
		if ( ! empty( $_POST['menu-icons'][ $menu_item_db_id ] ) ) {
			$value = array_map(
				'sanitize_text_field',
				wp_unslash( (array) $_POST['menu-icons'][ $menu_item_db_id ] )
			);
		} else {
			$value = array();
		}

		Menu_Icons_Meta::update( $menu_item_db_id, $value );
	}


	/**
	 * Get and print media templates from all types
	 *
	 * @since Menu Icons  0.2.0
	 * @since Menu Icons  0.9.0  Deprecate menu_icons_media_templates filter.
	 * @wp_hook action print_media_templates
	 */
	public static function _media_templates() {
		$id_prefix = 'tmpl-menu-icons';

		// Deprecated.
		$templates = apply_filters( 'menu_icons_media_templates', array() );

		if ( ! empty( $templates ) ) {
			if ( WP_DEBUG ) {
				_deprecated_function( 'menu_icons_media_templates', '0.9.0', 'menu_icons_js_templates' );
			}

			foreach ( $templates as $key => $template ) {
				$id = sprintf( '%s-%s', $id_prefix, $key );
				self::_print_tempate( $id, $template );
			}
		}

		require_once dirname( __FILE__ ) . '/media-template.php';
	}


	/**
	 * Print media template
	 *
	 * @since 0.2.0
	 *
	 * @param string $id Template ID.
	 * @param string $template Media template HTML.
	 */
	protected static function _print_tempate( $id, $template ) {
		?>
        <script type="text/html" id="<?php echo esc_attr( $id ) ?>">
			<?php echo $template; // xss ok ?>
        </script>
		<?php
	}


	/**
	 * Add extra icon type properties data
	 *
	 * @since Menu Icons  0.9.0
	 * @wp_hook action icon_picker_type_props
	 *
	 * @param   array $props Icon type properties.
	 * @param   string $id Icon type ID.
	 * @param   Icon_Picker_Type $type Icon_Picker_Type object.
	 *
	 * @return  array
	 */
	public static function _add_extra_type_props_data( $props, $id, $type ) {
		$settings_fields = array(
			'hide_label',
			'position',
			'vertical_align',
		);


		if ( 'Font' === $props['controller'] ) {
			$settings_fields[] = 'font_size';
		}

		switch ( $id ) {
			case 'image':
				$settings_fields[] = 'image_size';
				break;
			case 'svg':
				$settings_fields[] = 'svg_width';
				break;
		}

		$settings_fields = (array) apply_filters( 'buddyboss_menu_icon_props_data', $settings_fields, $props, $id, $type );

		$props['data']['settingsFields'] = $settings_fields;

		return $props;
	}

	public static function _buddyboss_menu_icon_props_data( $settings_fields ) {

		global $nav_menu_selected_id;
		if ( $nav_menu_selected_id ) {

			$menu_ids = array( 'buddypanel-loggedin', 'buddypanel-loggedout' );

			global $menu_locations;
			$theme_menu = false;

			foreach ( $menu_ids as $menu_id ) {
				if ( isset( $menu_locations[ $menu_id ] ) && $menu_locations[ $menu_id ] == $nav_menu_selected_id ) {
					$theme_menu = true;
				}
			}

			if ( $theme_menu ) {
				if ( ( $key = array_search( 'hide_label', $settings_fields ) ) !== false ) {
					unset( $settings_fields[ $key ] );
				}
			}

			if ( ( $key = array_search( 'vertical_align', $settings_fields ) ) !== false ) {
				unset( $settings_fields[ $key ] );
			}

			return $settings_fields;
		}
	}
}

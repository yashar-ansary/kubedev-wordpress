<?php
/**
 * Misc functions
 *
 * @since 2.1.0
 *
 * @package LearnDash\Misc
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds the post thumbnail theme support for custom post types.
 *
 * Fires on `after_setup_theme` hook.
 *
 * @since 2.1.0
 */
function learndash_add_theme_support() {
	if ( ! current_theme_supports( 'post-thumbnails' ) ) {
		add_theme_support( 'post-thumbnails', array( 'sfwd-certificates', 'sfwd-courses', 'sfwd-lessons', 'sfwd-topic', 'sfwd-quiz', 'sfwd-assignment', 'sfwd-essays' ) );
	}
}

add_action( 'after_setup_theme', 'learndash_add_theme_support' );

/**
 * Gets the LearnDash setting for a post.
 *
 * @since 2.1.0
 *
 * @param int|WP_Post $post    The `WP_Post` object or Post ID.
 * @param string|null $setting Optional. The slug of the setting to get. Default null.
 *
 * @return string|void The value for requested setting.
 */
function learndash_get_setting( $post, $setting = null ) {

	if ( is_numeric( $post ) ) {
		$post = get_post( $post );
	} else {
		if ( empty( $post ) || ! is_object( $post ) || empty( $post->ID ) ) {
			if ( is_null( $setting ) ) {
				return array();
			}
			return null;
		}
	}

	if ( is_a( $post, 'WP_Post' ) ) {

		if ( 'lesson' === $setting ) {
			return learndash_get_lesson_id( $post->ID );
		}

		if ( 'course' === $setting ) {
			return learndash_get_course_id( $post->ID );
		}

		$meta = get_post_meta( $post->ID, '_' . $post->post_type, true );
		if ( ( ! empty( $meta ) ) && ( is_array( $meta ) ) ) {
			if ( empty( $setting ) ) {
				$settings = array();
				foreach ( $meta as $k => $v ) {
					$settings[ str_replace( $post->post_type . '_', '', $k ) ] = $v;
				}
				return $settings;
			} else {
				if ( isset( $meta[ $post->post_type . '_' . $setting ] ) ) {
					return $meta[ $post->post_type . '_' . $setting ];
				} else {
					return '';
				}
			}
		} else {
			if ( is_null( $setting ) ) {
				return array();
			}
			return '';
		}
	}
	if ( is_null( $setting ) ) {
		return array();
	}
}



/**
 * Gets the options for a particular post type and setting.
 *
 * @since 2.1.0
 *
 * @param string $post_type The Post type slug.
 * @param string $setting   Optional. The slug of the setting to get. Default empty.
 *
 * @return array|string The options value for the given post type and setting.
 */
function learndash_get_option( $post_type, $setting = '' ) {
	$return = array();

	$options = get_option( 'sfwd_cpt_options' );

	// In LD v2.4 we moved all the settings to the new Settings API. Because of this we need to merge the value(s)
	// into the legacy values but keep in mind other add-ons might be extending the $post_args sections
	if ( 'sfwd-lessons' === $post_type ) {
		if ( false === $options ) {
			$options = array();
		}
		if ( ! isset( $options['modules'] ) ) {
			$options['modules'] = array();
		}
		if ( ! isset( $options['modules'][ $post_type . '_options' ] ) ) {
			$options['modules'][ $post_type . '_options' ] = array();
		}

		$settings_fields = LearnDash_Settings_Section::get_section_settings_all( 'LearnDash_Settings_Section_Lessons_Display_Order' );
		if ( ( ! empty( $settings_fields ) ) && ( is_array( $settings_fields ) ) ) {
			foreach ( $settings_fields as $key => $val ) {
				$options['modules'][ $post_type . '_options' ][ $post_type . '_' . $key ] = $val;
			}
		}
	}

	if ( ( empty( $setting ) ) && ( ! empty( $options['modules'][ $post_type . '_options' ] ) ) ) {
		foreach ( $options['modules'][ $post_type . '_options' ] as $key => $val ) {
			$return[ str_replace( $post_type . '_', '', $key ) ] = $val;
		}

		return $return;
	}

	if ( ! empty( $options['modules'][ $post_type . '_options' ][ $post_type . '_' . $setting ] ) ) {
		return $options['modules'][ $post_type . '_options' ][ $post_type . '_' . $setting ];
	} else {
		return '';
	}
}



/**
 * Updates the LearnDash setting for a post.
 *
 * @since 2.1.0
 *
 * @param int|WP_Post $post    The `WP_Post` object or Post ID.
 * @param string      $setting The slug of the setting to update.
 * @param string      $value   The new value of setting to be updated.
 *
 * @return boolean Returns true if the update was successfull otherwise false.
 */
function learndash_update_setting( $post, $setting, $value ) {
	$return = false;

	if ( empty( $setting ) ) {
		return $return;
	}

	// Were we sent a post ID?
	if ( is_numeric( $post ) ) {
		$post = get_post( $post );
	}

	// Ensure we have a post object or type WP_Post!
	if ( is_a( $post, 'WP_Post' ) ) {
		$meta = get_post_meta( $post->ID, '_' . $post->post_type, true );
		if ( ! is_array( $meta ) ) {
			$meta = array( $meta );
		}

		if ( 'course' === $setting ) {
			$value = absint( $value );
			if ( ! empty( $value ) ) {
				update_post_meta( $post->ID, 'course_id', $value );
			} else {
				delete_post_meta( $post->ID, 'course_id' );
			}
		} elseif ( 'course_access_list' === $setting ) {
			$value = learndash_convert_course_access_list( $value );
			update_post_meta( $post->ID, 'course_access_list', $value );

		} elseif ( 'course_points' === $setting ) {
			$course_points = learndash_format_course_points( $value );
			if ( ! empty( $course_points ) ) {
				update_post_meta( $post->ID, 'course_points', $course_points );
			} else {
				delete_post_meta( $post->ID, 'course_points' );
			}
		} elseif ( 'course_price_type' === $setting ) {
			update_post_meta( $post->ID, '_ld_price_type', $value );
		} elseif ( 'group_price_type' === $setting ) {
			update_post_meta( $post->ID, '_ld_price_type', $value );
		} elseif ( 'certificate' === $setting ) {
			update_post_meta( $post->ID, '_ld_certificate', $value );
		} elseif ( 'threshold' === $setting ) {
			update_post_meta( $post->ID, '_ld_certificate_threshold', $value );
		} elseif ( 'lesson' === $setting ) {
			$value = intval( $value );
			if ( ! empty( $value ) ) {
				update_post_meta( $post->ID, 'lesson_id', $value );
			} else {
				delete_post_meta( $post->ID, 'lesson_id' );
			}
		} elseif ( 'quiz' === $setting ) {
			update_post_meta( $post->ID, 'quiz_id', absint( $value ) );
		} elseif ( 'quiz_pro' === $setting ) {
			$value = absint( $value );

			// Moved from includes/class-ld-semper-fi-module.php line1052
			$quiz_pro_id_new = $value;
			$quiz_pro_id_org = absint( get_post_meta( $post->ID, 'quiz_pro_id', true ) );

			if ( ( ! empty( $quiz_pro_id_new ) ) && ( $quiz_pro_id_org !== $quiz_pro_id_new ) ) {
				/**
				 * If this quiz was the primary for all shared settings. We need to
				 * delete the primary marker then move the primary marker to another
				 * quiz using the same shared settngs.
				 */
				$quiz_id_primary_org = absint( learndash_get_quiz_primary_shared( $quiz_pro_id_org, false ) );
				if ( $quiz_id_primary_org === $post->ID ) {
					delete_post_meta( $post->ID, 'quiz_pro_primary_' . $quiz_pro_id_org );
					$quiz_post_ids = learndash_get_quiz_post_ids( $quiz_pro_id_org );
					if ( ! empty( $quiz_post_ids ) ) {
						foreach ( $quiz_post_ids as $quiz_post_id ) {
							if ( $quiz_post_id !== $post->ID ) {
								update_post_meta( $quiz_post_id, 'quiz_pro_primary_' . $quiz_pro_id_org, $quiz_pro_id_org );

								/**
								 * After we move the primary marker we also need to move the questions.
								 */
								$ld_quiz_questions_object = LDLMS_Factory_Post::quiz_questions( intval( $post->ID ) );
								if ( $ld_quiz_questions_object ) {
									$questions = $ld_quiz_questions_object->get_questions( 'post_ids' );

									$questions = get_post_meta( $post->ID, 'ld_quiz_questions', true );
									update_post_meta( $quiz_post_id, 'ld_quiz_questions', $questions );
								}
								break;
							}
						}
					}
				}

				$quiz_id_primary_new = absint( learndash_get_quiz_primary_shared( $quiz_pro_id_new, false ) );
				if ( empty( $quiz_id_primary_new ) ) {
					update_post_meta( $post->ID, 'quiz_pro_primary_' . $quiz_pro_id_new, $quiz_pro_id_new );
					// trigger to cause reloading of the questions.
					delete_post_meta( $post->ID, 'ld_quiz_questions' );
				}

				global $wpdb;
				$quiz_query_results = $wpdb->query(
					$wpdb->prepare(
						"DELETE FROM {$wpdb->postmeta} WHERE post_id = %d AND meta_key LIKE %s",
						absint( $post->ID ),
						'quiz_pro_id_%'
					)
				);

				update_post_meta( $post->ID, 'quiz_pro_id', $quiz_pro_id_new );
				update_post_meta( $post->ID, 'quiz_pro_id_' . $quiz_pro_id_new, $quiz_pro_id_new );
			}
		} elseif ( 'viewProfileStatistics' === $setting ) {
			update_post_meta( $post->ID, '_viewProfileStatistics', $value );
		} elseif ( 'timeLimitCookie' === $setting ) {
			update_post_meta( $post->ID, '_timeLimitCookie', absint( $value ) );
		}

		$meta[ $post->post_type . '_' . $setting ] = $value;

		$return = update_post_meta( $post->ID, '_' . $post->post_type, $meta );
	}

	return $return;
}



if ( ! function_exists( 'sfwd_lms_get_post_options' ) ) {

	/**
	 * Processes the `WP_Query` arguments for the post type that are saved in options.
	 *
	 * @global SFWD_LMS $sfwd_lms Global SFWD_LMS object.
	 *
	 * @param string $post_type The post type slug.
	 *
	 * @return array An array of `WP_Query` arguments.
	 */
	function sfwd_lms_get_post_options( $post_type ) {
		global $sfwd_lms;

		// Set our default options

		$ret = array(
			'order'          => 'ASC',
			'orderby'        => 'date',
			'posts_per_page' => get_option( 'posts_per_page' ),
		);

		if ( ( ! empty( $post_type ) ) && ( isset( $sfwd_lms->post_types[ $post_type ] ) ) ) {
			$cpt = $sfwd_lms->post_types[ $post_type ];
			if ( ( $cpt ) && ( $cpt instanceof SFWD_CPT_Instance ) ) {
				$prefix  = $cpt->get_prefix();
				$options = $cpt->get_current_options();

				if ( ( ! empty( $prefix ) ) && ( ! empty( $options ) ) ) {
					foreach ( $ret as $k => $v ) {
						if ( ! empty( $options[ "{$prefix}{$k}" ] ) ) {
							$ret[ $k ] = $options[ "{$prefix}{$k}" ];
						}
					}
				}

				if ( 'sfwd-lessons' === $post_type ) {
					$settings_fields = LearnDash_Settings_Section::get_section_settings_all( 'LearnDash_Settings_Section_Lessons_Display_Order' );
					if ( ( ! empty( $settings_fields ) ) && ( is_array( $settings_fields ) ) ) {
						$ret = wp_parse_args( $settings_fields, $ret );
					}
				}
			}
		}

		return $ret;
	}
}



/**
 * Generates the LearnDash payment buttons output.
 *
 * @since 2.1.0
 *
 * @uses learndash_get_function()
 * @uses sfwd_lms_has_access()
 *
 * @param int|WP_Post $course course ID or `WP_Post` course object.
 *
 * @return string The payment buttons HTML output.
 */
function learndash_payment_buttons( $post ) {

	if ( is_numeric( $post ) ) {
		$post_id = $post;
		$post    = get_post( $post_id );
	} elseif ( ! empty( $post->ID ) ) {
		$post_id = $post->ID;
	} else {
		return '';
	}

	$user_id = get_current_user_id();

	if ( ( ! $post ) || ( ! is_a( $post, 'WP_Post' ) ) ) {
		return '';
	}

	if ( learndash_get_post_type_slug( 'course' ) === $post->post_type ) {
		if ( sfwd_lms_has_access( $post->ID, $user_id ) ) {
			return '';
		}

		$post_label_prefix = 'course';

		$meta              = learndash_get_setting( $post_id );
		$post_price_type   = ( isset( $meta[ $post_label_prefix . '_price_type' ] ) ) ? $meta[ $post_label_prefix . '_price_type' ] : '';
		$post_price        = ( isset( $meta[ $post_label_prefix . '_price' ] ) ) ? $meta[ $post_label_prefix . '_price' ] : '';
		$post_no_of_cycles = ( isset( $meta['course_no_of_cycles'] ) ) ? $meta['course_no_of_cycles'] : '';
		$post_button_url   = ( isset( $meta['custom_button_url'] ) ) ? $meta['custom_button_url'] : '';
		$post_button_label = ( isset( $meta['custom_button_label'] ) ) ? $meta['custom_button_label'] : '';

		$post_srt = '';
		if ( 'subscribe' === $post_price_type ) {
			$post_price_billing_p3 = get_post_meta( $post_id, $post_label_prefix . '_price_billing_p3', true );
			$post_price_billing_t3 = get_post_meta( $post_id, $post_label_prefix . '_price_billing_t3', true );
			$post_srt              = intval( $post_no_of_cycles );
		}

		if ( empty( $post_button_label ) ) {
			$button_text = LearnDash_Custom_Label::get_label( 'button_take_this_course' );
		} else {
			$button_text = esc_attr( $post_button_label );
		}
	} elseif ( learndash_get_post_type_slug( 'group' ) === $post->post_type ) {
		if ( learndash_is_user_in_group( $user_id, $post_id ) ) {
			return '';
		}

		$post_label_prefix = 'group';

		$meta              = learndash_get_setting( $post_id );
		$post_price_type   = ( isset( $meta[ $post_label_prefix . '_price_type' ] ) ) ? $meta[ $post_label_prefix . '_price_type' ] : '';
		$post_price        = ( isset( $meta[ $post_label_prefix . '_price' ] ) ) ? $meta[ $post_label_prefix . '_price' ] : '';
		$post_no_of_cycles = ( isset( $meta[ $post_label_prefix . '_no_of_cycles' ] ) ) ? $meta[ $post_label_prefix . '_no_of_cycles' ] : '';
		$post_button_url   = ( isset( $meta['custom_button_url'] ) ) ? $meta['custom_button_url'] : '';
		$post_button_label = ( isset( $meta['custom_button_label'] ) ) ? $meta['custom_button_label'] : '';

		$post_srt = '';
		if ( 'subscribe' === $post_price_type ) {
			$post_price_billing_p3 = get_post_meta( $post_id, $post_label_prefix . '_price_billing_p3', true );
			$post_price_billing_t3 = get_post_meta( $post_id, $post_label_prefix . '_price_billing_t3', true );
			$post_srt              = intval( $post_no_of_cycles );
		}

		if ( empty( $post_button_label ) ) {
			$button_text = LearnDash_Custom_Label::get_label( 'button_take_this_group' );
		} else {
			$button_text = esc_attr( $post_button_label );
		}
	} else {
		return '';
	}

	// format the Course price to be proper XXX.YY no leading dollar signs or other values.
	if ( ( 'paynow' === $post_price_type ) || ( 'subscribe' === $post_price_type ) ) {
		if ( '' !== $post_price ) {
			$post_price = preg_replace( '/[^0-9.]/', '', $post_price );
			$post_price = number_format( floatval( $post_price ), 2, '.', '' );
		}
	}

	$paypal_settings = LearnDash_Settings_Section::get_section_settings_all( 'LearnDash_Settings_Section_PayPal' );
	if ( ! empty( $paypal_settings ) ) {
		$paypal_settings['paypal_sandbox'] = ( 'yes' === $paypal_settings['paypal_sandbox'] ) ? 1 : 0;
	}

	if ( ( ! empty( $post_price_type ) ) && ( 'closed' === $post_price_type ) ) {

		if ( empty( $post_button_url ) ) {
			$post_button = '';
		} else {
			$post_button_url = trim( $post_button_url );
			/**
			 * If the value does NOT start with [http://, https://, /] we prepend the home URL.
			 */
			if ( ( stripos( $post_button_url, 'http://', 0 ) !== 0 ) && ( stripos( $post_button_url, 'https://', 0 ) !== 0 ) && ( strpos( $post_button_url, '/', 0 ) !== 0 ) ) {
				$post_button_url = get_home_url( null, $post_button_url );
			}
			$post_button = '<a class="btn-join" href="' . esc_url( $post_button_url ) . '" id="btn-join">' . $button_text . '</a>';
		}

		$payment_params = array(
			'custom_button_url' => $post_button_url,
			'post'              => $post,
		);

		/**
		 * Filters the closed course payment button markup.
		 *
		 * @since 2.1.0
		 *
		 * @param string $custom_button  Payment button markup for closed course.
		 * @param array  $payment_params An array of payment paramter details.
		 */
		return apply_filters( 'learndash_payment_closed_button', $post_button, $payment_params );

	} elseif ( ! empty( $post_price ) ) {
		include_once LEARNDASH_LMS_LIBRARY_DIR . '/paypal/enhanced-paypal-shortcodes.php';

		$paypal_button = '';

		if ( ! empty( $paypal_settings['paypal_email'] ) ) {

			$post_title = str_replace( array( '[', ']' ), array( '', '' ), $post->post_title );

			if ( empty( $post_price_type ) || 'paynow' === $post_price_type ) {
				$shortcode_content = do_shortcode( '[paypal type="paynow" amount="' . $post_price . '" sandbox="' . $paypal_settings['paypal_sandbox'] . '" email="' . $paypal_settings['paypal_email'] . '" itemno="' . $post->ID . '" name="' . $post_title . '" noshipping="1" nonote="1" qty="1" currencycode="' . $paypal_settings['paypal_currency'] . '" rm="2" notifyurl="' . $paypal_settings['paypal_notifyurl'] . '" returnurl="' . $paypal_settings['paypal_returnurl'] . '" cancelurl="' . $paypal_settings['paypal_cancelurl'] . '" imagewidth="100px" pagestyle="paypal" lc="' . $paypal_settings['paypal_country'] . '" cbt="' . esc_html__( 'Complete Your Purchase', 'learndash' ) . '" custom="' . $user_id . '"]' );
				if ( ! empty( $shortcode_content ) ) {
					$paypal_button = wptexturize( '<div class="learndash_checkout_button learndash_paypal_button">' . $shortcode_content . '</div>' );
				}
			} elseif ( 'subscribe' === $post_price_type ) {

				$shortcode_content = do_shortcode( '[paypal type="subscribe" a3="' . $post_price . '" p3="' . $post_price_billing_p3 . '" t3="' . $post_price_billing_t3 . '" sandbox="' . $paypal_settings['paypal_sandbox'] . '" email="' . $paypal_settings['paypal_email'] . '" itemno="' . $post->ID . '" name="' . $post_title . '" noshipping="1" nonote="1" qty="1" currencycode="' . $paypal_settings['paypal_currency'] . '" rm="2" notifyurl="' . $paypal_settings['paypal_notifyurl'] . '" cancelurl="' . $paypal_settings['paypal_cancelurl'] . '" returnurl="' . $paypal_settings['paypal_returnurl'] . '" imagewidth="100px" pagestyle="paypal" lc="' . $paypal_settings['paypal_country'] . '" cbt="' . esc_html__( 'Complete Your Purchase', 'learndash' ) . '" custom="' . $user_id . '" srt="' . $post_srt . '"]' );

				if ( ! empty( $shortcode_content ) ) {
					$paypal_button = wptexturize( '<div class="learndash_checkout_button learndash_paypal_button">' . $shortcode_content . '</div>' );
				}
			}
		}

		$payment_params = array(
			'price' => $post_price,
			'post'  => $post,
		);

		/**
		 * Filters PayPal payment button markup.
		 *
		 * @since 2.1.0
		 *
		 * @param string $payment_button Payment button markup.
		 * @param array  $payment_params An array of payment paramter details.
		 */
		$payment_buttons = apply_filters( 'learndash_payment_button', $paypal_button, $payment_params );

		if ( ! empty( $payment_buttons ) ) {

			if ( ( ! empty( $paypal_button ) ) && ( $payment_buttons != $paypal_button ) ) {

				$button  = '';
				$button .= '<div id="learndash_checkout_buttons_course_' . $post->ID . '" class="learndash_checkout_buttons">';
				$button .= '<input id="btn-join-' . $post->ID . '" class="btn-join btn-join-' . $post->ID . ' button learndash_checkout_button" data-jq-dropdown="#jq-dropdown-' . $post->ID . '" type="button" value="' . $button_text . '" />';
				$button .= '</div>';

				global $dropdown_button;
				// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
				$dropdown_button .= '<div id="jq-dropdown-' . esc_attr( $post->ID ) . '" class="jq-dropdown jq-dropdown-tip checkout-dropdown-button">';
				$dropdown_button .= '<ul class="jq-dropdown-menu">';
				$dropdown_button .= '<li>';
				$dropdown_button .= str_replace( $button_text, esc_html__( 'Use Paypal', 'learndash' ), $payment_buttons );
				$dropdown_button .= '</li>';
				$dropdown_button .= '</ul>';
				$dropdown_button .= '</div>';
				// phpcs:enable

				/**
				 * Filters Dropdown payment button markup.
				 *
				 * @param string $button Dropdown payment button markup.
				 */
				return apply_filters( 'learndash_dropdown_payment_button', $button );

			} else {
				return '<div id="learndash_checkout_buttons_course_' . $post->ID . '" class="learndash_checkout_buttons">' . $payment_buttons . '</div>';
			}
		}
	} else {
		$join_button = '<div class="learndash_join_button"><form method="post">
							<input type="hidden" value="' . $post->ID . '" name="' . $post_label_prefix . '_id" />
							<input type="hidden" name="' . $post_label_prefix . '_join" value="' . wp_create_nonce( $post_label_prefix . '_join_' . get_current_user_id() . '_' . $post->ID ) . '" />
							<input type="submit" value="' . $button_text . '" class="btn-join" id="btn-join" />
						</form></div>';

		$payment_params = array(
			'price'                            => '0',
			'post'                             => $post,
			$post_label_prefix . '_price_type' => $post_price_type,
		);

		/** This filter is documented in includes/ld-misc-functions.php */
		$payment_buttons = apply_filters( 'learndash_payment_button', $join_button, $payment_params );
		return $payment_buttons;
	}
}

// Yes, global var here. This var is set within the payment button processing. The var will contain HTML for a fancy dropdown
$dropdown_button = ''; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

/**
 * Prints the dropdown button to the footer.
 *
 * Fires on `wp_footer` hook.
 *
 * @global string $dropdown_button Dropdown button markup.
 */
function learndash_footer_payment_buttons() {
	global $dropdown_button;

	if ( ! empty( $dropdown_button ) ) {
		echo $dropdown_button; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Need to output HTML.
	}
}
add_action( 'wp_footer', 'learndash_footer_payment_buttons' );

/**
 * Dequeues the jquery dropdown js if dropdown button is empty.
 *
 * @global string $dropdown_button Dropdown button markup.
 */
function learndash_get_footer() {
	if ( is_admin() ) {
		return;
	}

	global $dropdown_button;
	if ( empty( $dropdown_button ) ) {
		wp_dequeue_script( 'jquery-dropdown-js' );
	}
}
add_action( 'get_footer', 'learndash_get_footer' );

/**
 * Checks if a lesson, topic, or quiz is a sample or not.
 *
 * @since 2.1.0
 *
 * @param int|WP_Post $post The `WP_Post` object or Post ID.
 *
 * @return boolean Returns true if the post is sample otherwise false.
 */
function learndash_is_sample( $post ) {
	if ( empty( $post ) ) {
		return false;
	}

	if ( is_numeric( $post ) ) {
		$post = get_post( $post );
	}

	if ( empty( $post->ID ) ) {
		return false;
	}

	if ( learndash_get_post_type_slug( 'lesson' ) === $post->post_type ) {
		$is_sample = false;
		if ( learndash_get_setting( $post->ID, 'sample_lesson' ) ) {
			$is_sample = true;
		}

		/**
		 * Filters whether the lesson is a sample lesson or not.
		 *
		 * @param boolean            $is_sample Whether the lesson is a sample lesson or not.
		 * @param WP_Post|array|null $post      Post Object.
		 */
		return apply_filters( 'learndash_lesson_is_sample', $is_sample, $post );
	}

	if ( learndash_get_post_type_slug( 'topic' ) === $post->post_type ) {
		if ( learndash_is_course_builder_enabled() ) {
			$course_id = learndash_get_course_id( $post );
			$lesson_id = learndash_course_get_single_parent_step( $course_id, $post->ID );
		} else {
			$lesson_id = learndash_get_setting( $post->ID, 'lesson' );
		}
		if ( ( isset( $lesson_id ) ) && ( ! empty( $lesson_id ) ) ) {
			return learndash_is_sample( $lesson_id );
		}
	}

	if ( learndash_get_post_type_slug( 'quiz' ) === $post->post_type ) {
		if ( learndash_is_course_builder_enabled() ) {
			$course_id = learndash_get_course_id( $post );
			$lesson_id = learndash_course_get_single_parent_step( $course_id, $post->ID );
		} else {
			$lesson_id = learndash_get_setting( $post->ID, 'lesson' );
		}
		if ( ( isset( $lesson_id ) ) && ( ! empty( $lesson_id ) ) ) {
			return learndash_is_sample( $lesson_id );
		}
	}

	return false;
}



/**
 * Helper function for PHP output buffering.
 *
 * @todo not sure what this is preventing with a while looping
 *       counting to 10 and checking current buffer level
 *
 * @since 2.1.0
 *
 * @param int $level Optional. The level for output buffering. Default 0.
 *
 * @return string Buffered output.
 */
function learndash_ob_get_clean( $level = 0 ) {
	$content = '';
	$i       = 1;

	while ( $i <= 10 && ob_get_level() > $level ) {
		$i++;
		$content = ob_get_clean();
	}

	return $content;
}



/**
 * Redirects to the home page if the user lands on archive pages for lesson or quiz post types.
 *
 * Fires on `wp` hook.
 *
 * @since 2.1.0
 *
 * @param WP $wp The `WP` object.
 */
function learndash_remove_lessons_and_quizzes_page( $wp ) {

	if ( ( is_archive() ) && ( ! is_admin() ) ) {
		$post_type = get_post_type();
		if ( ( is_post_type_archive( $post_type ) ) && ( in_array( $post_type, learndash_get_post_types(), true ) ) ) {
			$has_archive = learndash_post_type_has_archive( $post_type );
			if ( true !== $has_archive ) {
				learndash_safe_redirect( home_url() );
			}
		}
	}
}

add_action( 'wp', 'learndash_remove_lessons_and_quizzes_page' );

/**
 * Checks if a LearnDash post type has archive support or not.
 *
 * @since 3.0.0
 *
 * @param string $post_type Optional. LearnDash post type slug. Default empty.
 *
 * @return boolean Returns true if the post type has archive support otherwise false.
 */
function learndash_post_type_has_archive( $post_type = '' ) {
	$has_archive = false;

	switch ( $post_type ) {
		case learndash_get_post_type_slug( 'course' ):
			if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Courses_CPT', 'has_archive' ) ) {
				$has_archive = true;
			}
			break;

		case learndash_get_post_type_slug( 'lesson' ):
			if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Lessons_CPT', 'has_archive' ) ) {
				$has_archive = true;
			}
			break;

		case learndash_get_post_type_slug( 'topic' ):
			if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Topics_CPT', 'has_archive' ) ) {
				$has_archive = true;
			}
			break;

		case learndash_get_post_type_slug( 'quiz' ):
			if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Quizzes_CPT', 'has_archive' ) ) {
				$has_archive = true;
			}
			break;

		case learndash_get_post_type_slug( 'group' ):
			if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Groups_CPT', 'has_archive' ) ) {
				$has_archive = true;
			}
			break;

		default:
			break;
	}

	/**
	 * Filters whether a post type has archive or not.
	 *
	 * @since 3.0.0
	 *
	 * @param boolean $has_archive Whether the post type has archive or not.
	 * @param string  $post_type Post type slug.
	 */
	return apply_filters( 'learndash_post_type_has_archive', $has_archive, $post_type );
}

/**
 * Utility function to check if a LearnDash post type supports Search and extra parameter.
 *
 * @since 3.0
 * @param string $post_type LearnDash Post Type.
 * @return boolean true/false.
 */
function learndash_post_type_search_param( $post_type = '', $search_param = '' ) {
	$search_param_value = '';

	if ( ( ! empty( $search_param ) ) && ( defined( 'LEARNDASH_FILTER_SEARCH' ) ) && ( LEARNDASH_FILTER_SEARCH === true ) ) {
		switch ( $post_type ) {
			case learndash_get_post_type_slug( 'course' ):
				if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Courses_CPT', 'include_in_search' ) ) {
					if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Courses_CPT', $search_param ) ) {
						$search_param_value = true;
					}
				}
				break;

			case learndash_get_post_type_slug( 'lesson' ):
				if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Lessons_CPT', 'include_in_search' ) ) {
					if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Lessons_CPT', $search_param ) ) {
						$search_param_value = true;
					}
				}
				break;

			case learndash_get_post_type_slug( 'topic' ):
				if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Topics_CPT', 'include_in_search' ) ) {
					if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Topics_CPT', $search_param ) ) {
						$search_param_value = true;
					}
				}
				break;

			case learndash_get_post_type_slug( 'quiz' ):
				if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Quizzes_CPT', 'include_in_search' ) ) {
					if ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Quizzes_CPT', $search_param ) ) {
						$search_param_value = true;
					}
				}
				break;

			default:
				break;
		}
	}

	/**
	 * Allow filtering override.
	 *
	 * @since 3.0
	 *
	 * @param string $search_param_value Search param string.
	 * @param string $post_type          Post Type.
	 */
	return apply_filters( 'learndash_post_type_search_param', $search_param_value, $post_type );
}


/**
 * Removes all comments for learndash post types.
 *
 * Fires on 'comments_array' hook.
 *
 * @since 2.1.0
 *
 * @param array $comments Optional. An array of comments for a post ID. Default empty array.
 * @param int   $post_id  Optional. Post ID.
 *
 * @return array An empty array.
 */
function learndash_remove_comments( $comments = array(), $post_id = 0 ) {
	if ( ! empty( $post_id ) ) {
		$post_type = get_post_type( $post_id );
		if ( ( ! empty( $post_type ) ) && ( in_array( $post_type, learndash_get_post_types( 'course' ), true ) ) ) {
			$post_type_object = get_post_type_object( $post_type );
			if ( ( $post_type_object ) && ( is_a( $post_type_object, 'WP_Post_Type' ) ) ) {
				if ( true !== learndash_post_type_supports_comments( $post_type ) ) {
					$comments = array();
				} else {
					$_post = get_post( $post_id );
					if ( ( $_post ) && ( is_a( $_post, 'WP_Post' ) ) && ( 'open' === $_post->comment_status ) ) {
						if ( ( in_array( $_post->post_type, learndash_get_post_types( 'course_steps' ), true ) ) && ( 'ld30' === LearnDash_Theme_Register::get_active_theme_key() ) && ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Theme_LD30', 'focus_mode_enabled' ) ) ) {

							/**
							 * Filters the status of comments in the focus mode.
							 *
							 * @param string             $comment_status Status of comments.
							 * @param WP_Post|array|null $post           Post Object.
							 */
							$focus_mode_comments = apply_filters( 'learndash_focus_mode_comments', 'closed', $_post );
							if ( 'closed' === $focus_mode_comments ) {
								$comments = array();
							}
						}
					} else {
						$comments = array();
					}
				}
			}
		}
	}

	return $comments;
}

/**
 * Ensures the comments are open for assignments.
 *
 * Fires on `comments_open` hook.
 *
 * @since 2.1.0
 *
 * @param boolean     $open    Whether the current post is open for comments.
 * @param int|WP_Post $post_id Optional. The post ID or `WP_Post` object. Default 0.
 *
 * @return int|WP_Post $post_id The post ID or WP_Post object.
 */
function learndash_comments_open( $open, $post_id = 0 ) {
	if ( ! empty( $post_id ) ) {
		$post_type = get_post_type( $post_id );
		if ( ( ! empty( $post_type ) ) && ( in_array( $post_type, learndash_get_post_types( 'course' ), true ) ) ) {
			$post_type_object = get_post_type_object( $post_type );
			if ( ( $post_type_object ) && ( is_a( $post_type_object, 'WP_Post_Type' ) ) ) {
				if ( true === learndash_post_type_supports_comments( $post_type ) ) {
					$open = true;

					$_post = get_post( $post_id );
					if ( ( $_post ) && ( is_a( $_post, 'WP_Post' ) ) && ( 'open' === $_post->comment_status ) ) {
						if ( ( in_array( $_post->post_type, learndash_get_post_types( 'course_steps' ), true ) ) && ( 'ld30' === LearnDash_Theme_Register::get_active_theme_key() ) && ( 'yes' === LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Theme_LD30', 'focus_mode_enabled' ) ) ) {
							if ( true === $open ) {
								$focus_mode_comments = 'open';
							} else {
								$focus_mode_comments = 'closed';
							}
							/** This filter is documented in includes/ld-misc-functions.php */
							$focus_mode_comments = apply_filters( 'learndash_focus_mode_comments', $focus_mode_comments, $_post );
							if ( 'closed' === $focus_mode_comments ) {
								$open = false;
							}
						}
					} else {
						$open = false;
					}
				} else {
					$open = false;
				}
			}
		}
	}

	return $open;
}
add_action(
	'wp',
	function() {
		add_filter( 'comments_array', 'learndash_remove_comments', 1, 2 );
		add_filter( 'comments_open', 'learndash_comments_open', 10, 2 );
	}
);

/**
 * Converts the seconds to time output.
 *
 * @since 2.1.0
 *
 * @param int $inputSeconds The seconds value.
 *
 * @return string The time output string.
 */
function learndash_seconds_to_time( $input_seconds = 0 ) {

	$seconds_minute = 60;
	$seconds_hour   = 60 * $seconds_minute;
	$seconds_day    = 24 * $seconds_hour;

	$return = '';

	// extract days
	$days = floor( $input_seconds / $seconds_day );
	if ( ! empty( $days ) ) {
		if ( ! empty( $return ) ) {
			$return .= ' ';
		}
		// translators: placeholder: Number of Days count.
		$return .= sprintf( _n( '%s day', '%s days', $days, 'learndash' ), number_format_i18n( $days ) );
	}

	// extract hours
	$hour_seconds = $input_seconds % $seconds_day;
	$hours        = floor( $hour_seconds / $seconds_hour );
	if ( ! empty( $hours ) ) {
		if ( ! empty( $return ) ) {
			$return .= ' ';
		}
		// translators: placeholder: Number of Hours count.
		$return .= sprintf( _n( '%s hour', '%s hours', $hours, 'learndash' ), number_format_i18n( $hours ) );
	}

	// extract minutes
	$minute_seconds = $input_seconds % $seconds_hour;
	$minutes        = floor( $minute_seconds / $seconds_minute );
	if ( ! empty( $minutes ) ) {
		if ( ! empty( $return ) ) {
			$return .= ' ';
		}
		// translators: placeholder: Number of Minutes count.
		$return .= sprintf( _n( '%s minute', '%s minutes', $minutes, 'learndash' ), number_format_i18n( $minutes ) );

	}

	// extract the remaining seconds
	$remaining_seconds = $input_seconds % $seconds_minute;
	$seconds           = ceil( $remaining_seconds );
	if ( ! empty( $seconds ) ) {
		if ( ! empty( $return ) ) {
			$return .= ' ';
		}
		// translators: placeholder: Number of Seconds count.
		$return .= sprintf( _n( '%s second', '%s seconds', $seconds, 'learndash' ), number_format_i18n( $seconds ) );
	}

	return trim( $return );
}

/**
 * Converts a timestamp to local timezone adjusted display.
 *
 * @since 2.2.0
 *
 * @param int    $timestamp      Optional. The timestamp to display. Default 0.
 * @param string $display_format Optional. The time display format. Default empty.
 *
 * @return string The adjusted date time display.
 */
function learndash_adjust_date_time_display( $timestamp = 0, $display_format = '' ) {
	$date_time_display = '';

	if ( ! empty( $timestamp ) ) {
		if ( empty( $display_format ) ) {
			$date_format = get_option( 'date_format', 'Y-m-d' );
			if ( empty( $date_format ) ) {
				$date_format = 'Y-m-d';
			}

			$time_format = get_option( 'time_format', 'H:i:s' );
			if ( empty( $time_format ) ) {
				$time_format = 'H:i:s';
			}

			/**
			 * Filters LearnDash date and time format.
			 *
			 * @param string  $format Format to display the date.
			 */
			$display_format = apply_filters( 'learndash_date_time_formats', $date_format . ' ' . $time_format );
		}

		// First we convert the timestamp to local Y-m-d H:i:s format
		$date_time_display = get_date_from_gmt( date( 'Y-m-d H:i:s', $timestamp ), 'Y-m-d H:i:s' ); // phpcs:ignore WordPress.DateTime.RestrictedFunctions.date_date

		// Then we take that value and reconvert it to a timestamp and call date_i18n to translate the month, date name etc.
		$date_time_display = date_i18n( $display_format, strtotime( $date_time_display ) );
	}
	return $date_time_display;
}

/**
 * Converts a date string to timestamp.
 *
 * @param string  $date_string   Optional. The date string. Default empty.
 * @param boolean $adjust_to_gmt Optional. Whether to adjust the date to gmt time zone. Default true.
 *
 * @return int The converted timestamp.
 */
function learndash_get_timestamp_from_date_string( $date_string = '', $adjust_to_gmt = true ) {
	$value_timestamp = 0;

	if ( ! empty( $date_string ) ) {
		$value_timestamp = strtotime( $date_string );
		if ( ( ! empty( $value_timestamp ) ) && ( $adjust_to_gmt ) ) {
			$value_ymd = get_gmt_from_date( date( 'Y-m-d H:i:s', $value_timestamp ), 'Y-m-d H:i:s' ); // phpcs:ignore WordPress.DateTime.RestrictedFunctions.date_date
			if ( ! empty( $value_ymd ) ) {
				$value_timestamp = strtotime( $value_ymd );
			} else {
				$value_timestamp = 0;
			}
		}
	}

	return $value_timestamp;
}

/**
 * Checks if the server is on Microsoft IIS.
 *
 * @since 2.1.0
 *
 * @return boolean Returns true if the server is on Microsoft IIS otherwise false.
 */
function learndash_on_iis() {
	$s_software = strtolower( $_SERVER['SERVER_SOFTWARE'] );
	if ( strpos( $s_software, 'microsoft-iis' ) !== false ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Utility function to traverse the multidimensional array and apply user function.
 *
 * @since 2.1.2
 *
 * @param callable $func The Callable user defined or system function. This
 *                       should be 'esc_attr', or some similar function.
 * @param array    $arr  The array to traverse and cleanup.
 *
 * @return array $arr The cleaned array after calling user functions.
 */
function learndash_array_map_r( $func, $arr ) {
	foreach ( $arr as $key => $value ) {
		if ( is_array( $value ) ) {
			$arr[ $key ] = learndash_array_map_r( $func, $value );
		} elseif ( is_array( $func ) ) {
			$arr[ $key ] = call_user_func_array( $func, $value );
		} else {
			$arr[ $key ] = call_user_func( $func, $value );
		}
	}

	return $arr;
}

/**
 * Formats course points.
 *
 * @param string $points   Course points.
 * @param int    $decimals Optional. The decimal values to round the course points. Default 1.
 *
 * @return float Formated course points.
 */
function learndash_format_course_points( $points, $decimals = 1 ) {

	$points = preg_replace( '/[^0-9.]/', '', $points );

	/**
	 * Filters course points format round decimal value.
	 *
	 * @param int $decimals the number of decimal digits to round to.
	 */
	$points = round( floatval( $points ), apply_filters( 'learndash_course_points_format_round', $decimals ) );

	return floatval( $points );
}

/**
 * Utility function to accept a file path and swap it out for a URL.
 *
 * This function is used in combination with get_template() to take
 * a local file system path and filename and replace the beginning part
 * matching ABSPATH with the home URL.
 *
 * @since 2.4.2
 *
 * @param string $filepath Optional. The file path and filename. Default empty.
 *
 * @return string The URL to the template file.
 */
function learndash_template_url_from_path( $filepath = '' ) {
	if ( ! empty( $filepath ) ) {
		// Ensure we are handling Windows separators.
		$wp_content_dir_tmp = str_replace( '\\', '/', WP_CONTENT_DIR );
		$filepath           = str_replace( '\\', '/', $filepath );
		$filepath           = str_replace( $wp_content_dir_tmp, WP_CONTENT_URL, $filepath );
		$filepath           = str_replace( array( 'https://', 'http://' ), array( '//', '//' ), $filepath );
	}

	return $filepath;
}

/**
 * Updates the metadata settings array when updating single setting.
 *
 * Used when saving a single setting. This will then trigger an update to the array setting.
 * Fires on `update_post_meta` hook.
 *
 * @param int        $meta_id    Optional. ID of the metadata entry to update. Default 0.
 * @param int|string $object_id  Optional. Object ID. Default empty.
 * @param string     $meta_key   Optional. Meta key. Default empty.
 * @param mixed      $meta_value Optional. Meta value. Default empty.
 */
function learndash_update_post_meta( $meta_id = 0, $object_id = '', $meta_key = '', $meta_value = '' ) {
	static $in_process = false;

	if ( true === $in_process ) {
		return;
	}

	$object_post_type = get_post_type( $object_id );
	if ( 'sfwd-courses' === $object_post_type ) {
		if ( '_sfwd-courses' === $meta_key ) {
			if ( isset( $meta_value['sfwd-courses_course_access_list'] ) ) {
				$in_process = true;
				update_post_meta( $object_id, 'course_access_list', $meta_value['sfwd-courses_course_access_list'] );
				$in_process = false;
			}
		} elseif ( in_array( $meta_key, array( 'course_access_list' ), true ) ) {
			$settings                                = get_post_meta( $object_id, '_' . $object_post_type, true );
			$settings[ 'sfwd-courses_' . $meta_key ] = $meta_value;

			$in_process = true;
			update_post_meta( $object_id, '_' . $object_post_type, $settings );
			$in_process = false;
		}
	}
}
add_action( 'update_post_meta', 'learndash_update_post_meta', 20, 4 );


/**
 * Gets the MySQL privileges for the DB_USER defined in the wp-config.
 *
 * @global wpdb $wpdb WordPress database abstraction object.
 *
 * @since 2.4.7
 *
 * @returns array An array of MySQL privelage grants.
 */
function learndash_get_db_user_grants() {
	global $wpdb;

	$grants = array();

	if ( ( defined( 'DB_USER' ) ) && ( defined( 'DB_HOST' ) ) && ( DB_HOST === 'localhost' ) ) {
		$level = ob_get_level();
		ob_start();

		$wpdb->suppress_errors( true );
		$grants_results = $wpdb->query( $wpdb->prepare( 'SHOW GRANTS FOR %s@%s;', DB_USER, DB_HOST ) );
		if ( ! empty( $grants_results ) ) {
			foreach ( $wpdb->last_result as $result_object ) {
				foreach ( $result_object as $result_key => $result_string ) {
					preg_match( '/GRANT (.*?) ON /', $result_string, $result_perms );
					if ( ( isset( $result_perms[1] ) ) && ( ! empty( $result_perms[1] ) ) ) {
						$perms  = explode( ',', $result_perms[1] );
						$perms  = array_map( 'trim', $perms );
						$grants = array_merge( $grants, $perms );
					}
				}
			}
		}
		$contents = learndash_ob_get_clean( $level );

		if ( ! empty( $grants ) ) {
			$grants = array_unique( $grants );
		}
	}

	return $grants;
}

/**
 * Removes a directory from the given path recursively.
 *
 * @since 1.0.3
 *
 * @param string $dir Optional. The directory path to remove. Default empty.
 */
function learndash_recursive_rmdir( $dir = '' ) {
	if ( ( ! empty( $dir ) ) && ( is_dir( $dir ) ) ) {
		$objects = scandir( $dir );

		foreach ( $objects as $object ) {
			if ( '.' !== $object && '..' !== $object ) {
				if ( filetype( $dir . '/' . $object ) == 'dir' ) {
					learndash_recursive_rmdir( $dir . '/' . $object );
				} else {
					unlink( $dir . '/' . $object );
				}
			}
		}
		reset( $objects );
		rmdir( $dir );
	}
}

/**
 * Utility function to parse and validate whether the assignment upload extensions are allowed.
 *
 * This utility function will trim, convert to lowercase and removes `.` from the extension.
 *
 * @since 2.5.0
 *
 * @param array|string $exts Optional. An array of file extensions. Default empty array.
 *
 * @return array $exts An array of validated file extensions.
 */
function learndash_validate_extensions( $exts = array() ) {
	if ( ( is_string( $exts ) ) && ( ! empty( $exts ) ) ) {
		$exts = explode( ',', $exts );
		$exts = array_map( 'trim', $exts );
		$exts = array_map( 'strtolower', $exts );
		$exts = array_map(
			function( $ext ) {
				return str_replace( '.', '', $ext );
			},
			$exts
		);
	} elseif ( ! is_array( $exts ) ) {
		$exts = array();
	}

	if ( ! empty( $exts ) ) {
		$ld_ignored_extensions = learndash_get_ignored_upload_file_extensions();
		if ( ! empty( $ld_ignored_extensions ) ) {
			$ld_ignored_extensions = array_map( 'strtolower', $ld_ignored_extensions );
			foreach ( $exts as $ext_idx => $ext ) {
				if ( in_array( $ext, $ld_ignored_extensions, true ) ) {
					unset( $exts[ $ext_idx ] );
				}
			}
		}
	}

	return $exts;
}

/**
 * Utility function to return a list of allowed upload file extensions.
 *
 * @since 3.1.7
 *
 * @param boolean $include_mime If true include array of
 * extension => mime. False return just array extensions.
 * @param array   $include_exts Filters returned array
 * to this subset.
 *
 * @return array Array allowed file extensions with mime.
 */
function learndash_get_allowed_upload_file_extensions( $include_mime = true, $include_exts = array() ) {
	$allowed_extensions = array();

	$wp_allowed_extensions = get_allowed_mime_types();
	$ld_ignored_extensions = learndash_get_ignored_upload_file_extensions();
	if ( ! empty( $ld_ignored_extensions ) ) {
		$ld_ignored_extensions = array_map( 'trim', $ld_ignored_extensions );
	}

	/**
	 * The array keys from WP are multi-part divided
	 * by '|'. We split these up and check that none
	 * match out LD ignored extensions.
	 */
	foreach ( $wp_allowed_extensions as $ext => $mime ) {
		$ext_split = explode( '|', $ext );

		$match_ext = array_intersect( $ext_split, $ld_ignored_extensions );
		if ( empty( $match_ext ) ) {
			foreach ( $ext_split as $e_split ) {
				$allowed_extensions[ $e_split ] = $mime;
			}
		}
	}

	if ( ( is_array( $include_exts ) ) && ( ! empty( $include_exts ) ) ) {
		$include_exts = array_map( 'strtolower', $include_exts );
		foreach ( $allowed_extensions as $ext => $mime ) {
			$ext = strtolower( $ext );
			if ( ! in_array( $ext, $include_exts, true ) ) {
				unset( $allowed_extensions[ $ext ] );
			}
		}
	}

	if ( false === $include_mime ) {
		return array_keys( $allowed_extensions );
	} else {
		return $allowed_extensions;
	}
}

/**
 * Utility function to return a list of ignored/disallowed upload file extensions.
 *
 * @since 3.1.7
 *
 * @return array Array of ignored extensions with mime.
 */
function learndash_get_ignored_upload_file_extensions() {

	/**
	 * Filters assignment ignored file extensions.
	 *
	 * @param array $rejected_file_extensions File extensions the user is not
	 * allowed to upload even if allowed by WordPress.
	 */
	return apply_filters( 'learndash_assignment_ignored_file_extensions', array( 'html', 'htm', 'php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'pht', 'css', 'js' ) );
}

/**
 * Utility function to return a list of allowed upload file extensions.
 *
 * This utility function is used to limit the allowed file extensions for
 * Assignments and Essays.
 *
 * @since 3.1.7
 *
 * @param integer $post_id Post ID for Assignment or Essay
 *
 * @return array allowed file extensions with mime.
 */
function learndash_get_allowed_upload_mime_extensions_for_post( $post_id = 0 ) {
	$allowed_extensions    = array();
	$ld_allowed_extensions = learndash_get_allowed_upload_file_extensions( false );

	if ( ! is_array( $ld_allowed_extensions ) ) {
		$ld_allowed_extensions = array();
	}

	if ( ! empty( $post_id ) ) {
		if ( in_array( get_post_type( $post_id ), array( learndash_get_post_type_slug( 'lesson' ), learndash_get_post_type_slug( 'topic' ), learndash_get_post_type_slug( 'assignment' ) ), true ) ) {
			$assignment_upload_limit_extensions = learndash_get_setting( $post_id, 'assignment_upload_limit_extensions' );
			if ( ! empty( $assignment_upload_limit_extensions ) ) {
				$assignment_upload_limit_extensions = learndash_validate_extensions( $assignment_upload_limit_extensions );
				if ( ! empty( $assignment_upload_limit_extensions ) ) {
					$ld_allowed_extensions = array_intersect( $ld_allowed_extensions, $assignment_upload_limit_extensions );
				}
			}
		}

		/**
		 * Filters allowed upload file extensions.
		 *
		 * @since 3.1.7
		 *
		 * @param array   $ld_allowed_extensions Array of alowed upload file extensions.
		 * @param integer $post_id               $Post ID receiving the upload.
		 */
		$ld_allowed_extensions = apply_filters( 'learndash_allowed_upload_extensions', $ld_allowed_extensions, $post_id );
		if ( ! is_array( $ld_allowed_extensions ) ) {
			$ld_allowed_extensions = array();
		}
	}

	return learndash_get_allowed_upload_file_extensions( true, $ld_allowed_extensions );
}

/**
 * Checks whether a string is a valid JSON or not.
 *
 * @param string $string The string to check.
 *
 * @return boolean Returns true if the string is valid json otherwise false.
 */
function learndash_is_valid_JSON( $string = '' ) { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	if ( ( is_string( $string ) ) && ( ! empty( $string ) ) ) {
		try {
			$json = json_decode( $string );
			if ( ( is_null( $json ) ) || ( json_last_error() !== JSON_ERROR_NONE ) ) {
				return false;
			}

			if ( ( is_object( $json ) ) || ( is_array( $json ) ) ) {
				return true;
			}
		} catch ( Exception $e ) {
			return false;
		}
	}
	return false;
}

/**
 * Disables the RSS feeds if the feed support is disabled for the post type.
 *
 * Fires on `pre_get_posts` hook.
 * Controls the output of the Feeds (RSS2 etc) for the various custom post types
 * used within LearnDash. By default the only feed should be for Courses (sfwd-courses).
 * All other post types are disabled by default.
 *
 * @since 2.6.0
 *
 * @param WP_Query $query `WP_Query` instance.
 */
function learndash_pre_posts_feeds( $query ) {

	if ( ( ! is_admin() ) && ( $query->is_main_query() ) && ( true === $query->is_feed ) ) {
		$feed_post_type = get_query_var( 'post_type' );
		if ( ! empty( $feed_post_type ) ) {
			if ( true !== learndash_post_type_supports_feed( $feed_post_type ) ) {
				$query->set( 'post__in', array( 0 ) );
			}
		}
	}
}
add_action( 'pre_get_posts', 'learndash_pre_posts_feeds' );

/**
 * Checks whether a learndash post type supports feeds or not.
 *
 * @param string $feed_post_type Optional. The post type slug to check. Default empty.
 *
 * @return boolean Returns true if the post type supports feeds otherwise false.
 */
function learndash_post_type_supports_feed( $feed_post_type = '' ) {
	if ( ( ! empty( $feed_post_type ) ) && ( in_array( $feed_post_type, LDLMS_Post_Types::get_post_types(), true ) ) ) {
		$feed_post_type_object = get_post_type_object( $feed_post_type );
		if ( ( $feed_post_type_object ) && ( is_a( $feed_post_type_object, 'WP_Post_Type' ) ) ) {
			// Default for LD Post types is false;
			$cpt_has_feed = false;

			$class_key = array(
				learndash_get_post_type_slug( 'course' ) => 'LearnDash_Settings_Courses_CPT',
				learndash_get_post_type_slug( 'lesson' ) => 'LearnDash_Settings_Lessons_CPT',
				learndash_get_post_type_slug( 'topic' )  => 'LearnDash_Settings_Topics_CPT',
				learndash_get_post_type_slug( 'quiz' )   => 'LearnDash_Settings_Quizzes_CPT',
			);

			$has_archive = false;
			$has_feed    = false;
			if ( isset( $class_key[ $feed_post_type ] ) ) {
				$has_archive = LearnDash_Settings_Section::get_section_setting( $class_key[ $feed_post_type ], 'has_archive' );
				$has_feed    = LearnDash_Settings_Section::get_section_setting( $class_key[ $feed_post_type ], 'has_feed' );
				if ( ( 'yes' === $has_archive ) && ( 'yes' === $has_feed ) ) {
					$cpt_has_feed = true;
				}
			}

			/**
			 * Filters whether to show feeds for the custom post type.
			 *
			 * @since 2.6.0
			 *
			 * @param boolean      $cpt_has_feed Whether to show feeds for the post type. True to show feed otherwise false.
			 * @param string       $feed_post_type Post Type slug.
			 * @param WP_Post_Type $feed_post_type_object WP_Post_Type instance.
			 */
			$cpt_has_feed = apply_filters( 'learndash_post_type_feed', $cpt_has_feed, $feed_post_type, $feed_post_type_object );
		}
	} else {
		// For aNY non-LD post type is return true to let them pass thru.
		$cpt_has_feed = true;
	}

	return $cpt_has_feed;
}

/**
 * Checks whether a learndash post type supports comments or not.
 *
 * @param string $feed_post_type Optional. The post type slug to check. Default empty.
 *
 * @return boolean Returns true if the post type supports comments otherwise false.
 */
function learndash_post_type_supports_comments( $feed_post_type = '' ) {
	if ( ( ! empty( $feed_post_type ) ) && ( in_array( $feed_post_type, learndash_get_post_types( 'course' ), true ) ) ) {
		$feed_post_type_object = get_post_type_object( $feed_post_type );
		if ( ( $feed_post_type_object ) && ( is_a( $feed_post_type_object, 'WP_Post_Type' ) ) ) {
			// Default for LD Post types is false;
			$cpt_has_comments = false;

			$class_key = array(
				learndash_get_post_type_slug( 'course' ) => 'LearnDash_Settings_Courses_CPT',
				learndash_get_post_type_slug( 'lesson' ) => 'LearnDash_Settings_Lessons_CPT',
				learndash_get_post_type_slug( 'topic' )  => 'LearnDash_Settings_Topics_CPT',
				learndash_get_post_type_slug( 'quiz' )   => 'LearnDash_Settings_Quizzes_CPT',
			);

			if ( isset( $class_key[ $feed_post_type ] ) ) {
				$supports = LearnDash_Settings_Section::get_section_setting( $class_key[ $feed_post_type ], 'supports' );
				if ( ( ! empty( $supports ) ) && ( in_array( 'comments', $supports, true ) ) ) {
					$cpt_has_comments = true;
				}
			}

			/**
			 * Filters whether to show comments for a CPT or not.
			 *
			 * @since 2.6.0
			 *
			 * @param boolean $cpt_has_comments      Whether to show comments for the CPT or not.
			 * @param string  $feed_post_type Post   Type slug.
			 * @param WP_Post_Type  $feed_post_type_object WP_Post_Type instance.
			 */
			$cpt_has_comments = apply_filters( 'learndash_post_comments', $cpt_has_comments, $feed_post_type, $feed_post_type_object );

			return $cpt_has_comments;
		}
	}
}

/**
 * Manages the post update message for legacy editor screen.
 *
 * @since 2.6.4
 *
 * @param array $post_messages Optional. An array of post updated messages by post_type. Default empty array.
 *
 * @return array An array of post upadated messages.
 */
function learndash_post_updated_messages( $post_messages = array() ) {
	global $pagenow, $post_ID, $post_type, $post_type_object, $post;

	if ( ( $post_type ) && ( in_array( $post_type, LDLMS_Post_Types::get_post_types(), true ) ) && ( ! isset( $post_messages[ $post_type ] ) ) ) {
		$preview_post_link_html   = '';
		$scheduled_post_link_html = '';
		$view_post_link_html      = '';

		$viewable = is_post_type_viewable( $post_type_object );
		if ( $viewable ) {

			$preview_url = get_preview_post_link( $post );
			$permalink   = learndash_get_step_permalink( $post_ID );

			// Preview post link.
			$preview_post_link_html = sprintf(
				' <a target="_blank" href="%1$s">%2$s</a>',
				esc_url( $preview_url ),
				esc_html__( 'Preview', 'learndash' )
			);

			// Scheduled post preview link.
			$scheduled_post_link_html = sprintf(
				' <a target="_blank" href="%1$s">%2$s</a>',
				esc_url( $permalink ),
				esc_html__( 'Preview', 'learndash' )
			);

			// View post link.
			$view_post_link_html = sprintf(
				' <a href="%1$s">%2$s</a>',
				esc_url( $permalink ),
				esc_html__( 'View', 'learndash' )
			);
		}

		// translators: Publish box date format, see https://secure.php.net/date
		$scheduled_date = date_i18n( __( 'M j, Y @ H:i', 'learndash' ), strtotime( $post->post_date ) );

		$post_messages[ $post_type ] = array(
			0  => '', // Unused. Messages start at index 1.
			// translators: placeholder: Post Type Singlular Label.
			1  => sprintf( _x( '%s updated.', 'placeholder: Post Type Singlular Label', 'learndash' ), $post_type_object->labels->singular_name ) . $view_post_link_html,
			2  => __( 'Custom field updated.', 'learndash' ),
			3  => __( 'Custom field deleted.', 'learndash' ),
			// translators: placeholder: Post Type Singlular Label.
			4  => sprintf( _x( '%s updated.', 'placeholder: Post Type Singlular Label', 'learndash' ), $post_type_object->labels->singular_name ),
			// translators: placeholders: Post Type Singular Label, Revision Title.
			5  => isset( $_GET['revision'] ) ? sprintf( _x( '%1$s restored to revision from %2$s.', 'placeholder: Post Type Singular Label, Revision Title', 'learndash' ), $post_type_object->labels->singular_name, wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			// translators: placeholder: Post Type Singular Label.
			6  => sprintf( _x( '%s published.', 'placeholder: Post Type Singlular Label', 'learndash' ), $post_type_object->labels->singular_name ) . $view_post_link_html,
			// translators: placeholder: Post Type Singular Label.
			7  => sprintf( _x( '%s saved.', 'placeholder: Post Type Singlular Label', 'learndash' ), $post_type_object->labels->singular_name ),
			// translators: placeholder: Post Type Singular Label.
			8  => sprintf( _x( '%s submitted.', 'placeholder: Post Type Singlular Label', 'learndash' ), $post_type_object->labels->singular_name ) . $preview_post_link_html,
			// translators: placeholder: Post Type Singlular Label, scheduled date.
			9  => sprintf( _x( '%1$s scheduled for: %2$s.', 'placeholder: Post Type Singlular Label, scheduled date', 'learndash' ), $post_type_object->labels->singular_name, '<strong>' . $scheduled_date . '</strong>' ) . $scheduled_post_link_html,
			// translators: placeholder: Post Type Singular Label.
			10 => sprintf( _x( '%s draft updated.', 'placeholder: Post Type Singlular Label', 'learndash' ), $post_type_object->labels->singular_name ) . $preview_post_link_html,
		);
	}

	// Always return post_messages.
	return $post_messages;
}
add_filter( 'post_updated_messages', 'learndash_post_updated_messages' );

/**
 * Retrieves the number of posts by post_type.
 *
 * @since 3.0.0
 *
 * @param string $post_type Optional. The post type slug. Default empty.
 *
 * @return int The Number of posts for the given post type.
 */
function learndash_get_total_post_count( $post_type = '' ) {
	$count_total = 0;

	if ( ( $post_type ) && ( in_array( $post_type, LDLMS_Post_Types::get_post_types(), true ) ) ) {
		$post_counts = wp_count_posts( $post_type );

		// Convert to array.
		$post_counts = json_decode( wp_json_encode( $post_counts ), true );

		/**
		 * We only count the post status shown in the admin
		 *
		 * @since 3.0.4
		*/
		$show_in_admin_post_stati = get_post_stati( array( 'show_in_admin_status_list' => true ) );

		/**
		 * Filters list of post status shown in the admin.
		 *
		 * @param array  $admin_post_status List of post status shown in the admin.
		 * @param string $post_type         Post Type slug.
		 * @param array  $post_counts       An array of number of posts for each status.
		 */
		$show_in_admin_post_stati = apply_filters( 'learndash_admin_post_stati', $show_in_admin_post_stati, $post_type, $post_counts );
		if ( ! empty( $show_in_admin_post_stati ) ) {
			foreach ( $show_in_admin_post_stati as $post_status ) {
				if ( isset( $post_counts[ $post_status ] ) ) {
					$count_total += absint( $post_counts[ $post_status ] );
				}
			}
		}
	}

	return $count_total;
}

/**
 * Gets the posts count from the `WP_Query` post_type argument.
 *
 * @param array $query_args Optional. The `WP_Query` query arguments array. Default empty array.
 *
 * @return int Number of posts for a post type.
 */
function learndash_check_query_post_type( $query_args = array() ) {
	$total_post_count = 0;
	if ( ( isset( $query_args['post_type'] ) ) && ( ! empty( $query_args['post_type'] ) ) ) {
		if ( is_string( $query_args['post_type'] ) ) {
			$total_post_count += learndash_get_total_post_count( $query_args['post_type'] );
		} elseif ( is_array( $query_args['post_type'] ) ) {
			foreach ( $query_args['post_type'] as $post_type ) {
				$total_post_count += learndash_get_total_post_count( $query_args['post_type'] );
			}
		}
	}

	return $total_post_count;
}
/**
 * Converts the stored lesson timer value from the postmeta settings into number of total seconds.
 *
 * @param string|int $timer_time Optional. The lesson timer time. Default 0.
 *
 * @return int The converted total number of seconds.
 */
function learndash_convert_lesson_time_time( $timer_time = 0 ) {
	if ( ! empty( $timer_time ) ) {
		$time_sections = explode( ' ', $timer_time );
		$h             = 0;
		$m             = 0;
		$s             = 0;

		foreach ( $time_sections as $k => $v ) {
			$value = trim( $v );

			if ( strpos( $value, 'h' ) ) {
				$h = intVal( $value );
			} elseif ( strpos( $value, 'm' ) ) {
				$m = intVal( $value );
			} elseif ( strpos( $value, 's' ) ) {
				$s = intVal( $value );
			}
		}

		$time = ( $h * 60 * 60 ) + ( $m * 60 ) + $s;

		if ( ! empty( $time ) ) {
			$timer_time = absint( $time );
		}
	}

	return $timer_time;
}

/**
 * Updates the comment_status field for all the post of given post type.
 *
 * @global array $learndash_question_types
 *
 * @since 3.0.0
 *
 * @param string         $post_type      Optional. The post type slug. Default empty.
 * @param string|boolean $comment_status Optional. New comment status. Allowed values 'open' or 'closed'. Default false.
 */
function learndash_update_posts_comment_status( $post_type = '', $comment_status = false ) {
	global $learndash_question_types;

	if ( ! empty( $post_type ) ) {
		$ld_post_types = learndash_get_post_types();
		if ( in_array( $post_type, $ld_post_types, true ) ) {
			if ( in_array( $comment_status, array( 'open', 'closed' ), true ) ) {

				/**
				 * Filters whether to update comment status for any post type or not.
				 *
				 * @param boolean $update_comment_status Whether to Update comment status or not.
				 * @param string  $post_type             Post type slug.
				 * @param string  $comment_status        Status of comments.
				 */
				if ( apply_filters( 'learndash_update_posts_comment_status', true, $post_type, $comment_status ) ) {
					global $wpdb;
					$wpdb->query(
						$wpdb->prepare(
							'UPDATE wp_posts SET comment_status = %s WHERE post_type = %s',
							$comment_status,
							$post_type
						)
					);
				}
			}
		}
	}
}

/**
 * Utility function to load minified version of CSS/JS assets.
 *
 * @since 3.0.3
 * @since 3.3.0 Renamed
 *
 * @return string Returns .min if the LEARNDASH_SCRIPT_DEBUG constant is false
 *                otherwise empty string.
 */
function learndash_min_asset() {
		return ( ( defined( 'LEARNDASH_SCRIPT_DEBUG' ) && ( LEARNDASH_SCRIPT_DEBUG === true ) ) ? '' : '.min' );
}

/**
 * Utility function to load minified version of CSS/JS builder assets.
 *
 * @since 3.0.3
 * @since 3.3.0 Renamed
 *
 * @return string Returns .min if the LEARNDASH_SCRIPT_DEBUG constant is false
 *                otherwise empty string.
 */
function learndash_min_builder_asset() {
		return ( ( defined( 'LEARNDASH_BUILDER_DEBUG' ) && ( LEARNDASH_BUILDER_DEBUG === true ) ) ? '' : '.min' );
}

/**
 * Builds a recursive listing of files from a given base path name.
 *
 * @since 3.0.3
 *
 * @param string $base Optional. Top-level directory of the tree to scan. Default empty.
 *
 * @return array An Array of files found.
 */
function learndash_scandir_recursive( $base = '' ) {
	if ( ( ! $base ) || ( ! strlen( $base ) ) ) {
		return array();
	}

	if ( ! file_exists( $base ) ) {
		return array();
	}

	$data = array_diff( scandir( $base ), array( '.', '..' ) );

	$subs = array();
	foreach ( $data as $key => $value ) {
		if ( is_dir( $base . '/' . $value ) ) {
			unset( $data[ $key ] );
			$subs[] = learndash_scandir_recursive( $base . '/' . $value );
		} elseif ( is_file( $base . '/' . $value ) ) {
			$data[ $key ] = $base . '/' . $value;
		}
	}

	if ( count( $subs ) ) {
		foreach ( $subs as $sub ) {
			$data = array_merge( $data, $sub );
		}
	}

	return $data;
}

/**
 * Prevents Custom Fields meta box from showing/saving LD keys.
 *
 * Fires on `is_protected_meta` hook.
 *
 * @since 3.0.4
 *
 * @global string $typenow
 *
 * @param boolean $protected Optional. Whether to protect the meta. Default false.
 * @param string  $meta_key  Optional. Meta key to check. Default empty.
 * @param string  $meta_type Optional. The type of the meta. Default empty.
 *
 * @return boolean Returns true if the meta is protected otherwise false.
 */
function learndash_is_protected_meta( $protected = false, $meta_key = '', $meta_type = '' ) {
	if ( ( 'post' === $meta_type ) && ( ! empty( $meta_key ) ) && ( '_' !== $meta_key[0] ) ) {

		// Try and determine the post type used.
		global $typenow;
		$post_type = $typenow;
		if ( empty( $post_type ) ) {
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				if ( ( isset( $_POST['action'] ) ) && ( 'add-meta' === $_POST['action'] ) ) {
					if ( ( isset( $_POST['post_id'] ) ) && ( ! empty( $_POST['post_id'] ) ) ) {
						$post_id   = absint( $_POST['post_id'] );
						$post_type = get_post_type( $post_id );
					}
				}
			}
		}

		// If post type is not empty and onf othe LD types.
		if ( ( ! empty( $post_type ) ) && ( in_array( $post_type, learndash_get_post_types(), true ) ) ) {
			$protected_meta_keys = array( 'course_id', 'lesson_id', 'course_price_billing_p3', 'course_price_billing_t3', 'course_sections', 'ld_course_steps', 'course_access_list', 'quiz_pro_id', 'ld_course_steps_dirty', 'ld_auto_enroll_group_courses', 'group_price_billing_p3', 'group_price_billing_t3', 'ld_auto_enroll_group_course_ids', 'question_pro_id', 'course_points', 'ld_quiz_questions', 'ld_quiz_questions_dirty', 'learndash_certificate_options', 'question_id', 'ld_essay_grading_response', 'question_points', 'question_type', 'question_pro_id', 'question_pro_category' );

			if ( ( in_array( $meta_key, $protected_meta_keys, true ) ) ) {
				$protected = true;
			} elseif ( 'ld_course_' === substr( $meta_key, 0, strlen( 'ld_course_' ) ) ) {
				$protected = true;
			} elseif ( 'quiz_pro_id_' === substr( $meta_key, 0, strlen( 'quiz_pro_id_' ) ) ) {
				$protected = true;
			} elseif ( 'quiz_pro_primary_' === substr( $meta_key, 0, strlen( 'quiz_pro_primary_' ) ) ) {
				$protected = true;
			} elseif ( 'learndash_group_enrolled_' === substr( $meta_key, 0, strlen( 'learndash_group_enrolled_' ) ) ) {
				$protected = true;
			} elseif ( 'learndash_group_users_' === substr( $meta_key, 0, strlen( 'learndash_group_users_' ) ) ) {
				$protected = true;
			}
		}
	}
	return $protected;
}
add_filter( 'is_protected_meta', 'learndash_is_protected_meta', 30, 3 );


/**
 * Updates the menus being displayed to show the login/logout.
 *
 * Fires on `wp_nav_menu_objects` hook.
 * Looks for items where the 'url' is '#login'.
 *
 * @since 3.0.7
 *
 * @param array $menu_items The WP Menu items to be displayed.
 * @param array $menu_args  Optional. The WP Menu args related to the menu set to be displayed. Default empty array.
 *
 * @return array $menu_items
 */
function learndash_login_menu_items( $menu_items, $menu_args = array() ) {

	foreach ( $menu_items as $menu_key => &$menu_item ) {
		/**
		 * Check the properties we need exist and not empty. We shouldn't need to do this
		 * since the array of menu items comes from WP. See LEARNDASH-3812.
		 */
		if ( ( ! isset( $menu_item->url ) ) || ( empty( $menu_item->url ) ) || ( ! isset( $menu_item->classes ) ) || ( ! is_array( $menu_item->classes ) ) || ( empty( $menu_item->classes ) ) ) {
			continue;
		}

		if ( ( strpos( $menu_item->url, '#login' ) !== false ) && ( in_array( 'ld-button', $menu_item->classes, true ) ) ) {
			/**
			 * Filters whether to process a menu_item or not.
			 *
			 * @since 3.0.7
			 *
			 * @param boolean $should_process Process this menu item. Return true if the menu should be processed otherwise false.
			 * @param WP_Post $menu_item      WP_Post object for menu item.
			 * @param array   $menu_args      An array of arguments related to menu being processed / displayed.
			 */
			if ( apply_filters( 'learndash_login_menu_item_process', true, $menu_item, $menu_args ) ) {
				if ( ( empty( $menu_item->post_content ) ) || ( strpos( $menu_item->post_content, '[learndash_login' ) === false ) ) {
					$shortcode = '[learndash_login return="atts"]';
				} else {
					$shortcode = str_replace( '[learndash_login', '[learndash_login return="atts" ', $menu_item->post_content );
				}

				$menu_item->post_content = '';
				$menu_item->description  = '';

				$active_template_key = LearnDash_Theme_Register::get_active_theme_key();
				$login_mode_enabled  = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Theme_LD30', 'login_mode_enabled' );
				if ( ( 'ld30' === $active_template_key ) && ( 'yes' === $login_mode_enabled ) ) {
					$shortcode_return = do_shortcode( $shortcode );
					$shortcode_atts   = maybe_unserialize( $shortcode_return );

					learndash_load_login_modal_html();
				} else {
					// If here we are not using the LD30 templates. So the handling of the menu item is simple link to WP login/logout.
					$shortcode      = str_replace( array( '[learndash_login', ']' ), '', $shortcode );
					$atts           = shortcode_parse_atts( $shortcode );
					$shortcode_atts = array();

					if ( is_user_logged_in() ) {
						if ( ( isset( $atts['logout_url'] ) ) && ( ! empty( $atts['logout_url'] ) ) ) {
							$shortcode_atts['url'] = $atts['logout_url'];
						} else {
							$shortcode_atts['url'] = wp_logout_url( get_permalink() );
						}

						if ( ( isset( $atts['logout_label'] ) ) && ( ! empty( $atts['logout_label'] ) ) ) {
							$shortcode_atts['title'] = $atts['logout_label'];
						} else {
							$shortcode_atts['title'] = __( 'Logout', 'learndash' );
						}
					} else {
						if ( ( isset( $atts['login_url'] ) ) && ( ! empty( $atts['login_url'] ) ) ) {
							$shortcode_atts['url'] = $atts['login_url'];
						} else {
							$shortcode_atts['url'] = wp_login_url( get_permalink() );
						}

						if ( ( isset( $atts['login_label'] ) ) && ( ! empty( $atts['login_label'] ) ) ) {
								$shortcode_atts['title'] = $atts['login_label'];
						} else {
							$shortcode_atts['title'] = __( 'Login', 'learndash' );
						}
					}
				}

				/**
				 * Filters menu_item attributes before they are applied.
				 *
				 * @since 2.0.7
				 *
				 * @param array   $shortcode_atts Shortcode array containing url, label, etc.
				 * @param WP_Post $menu_item      WP_Post object for menu item.
				 * @param array   $menu_args      An array of arguments related to menu being processed / displayed.
				 */
				$shortcode_atts = apply_filters( 'learndash_login_menu_item_atts', $shortcode_atts, $menu_item, $menu_args );
				if ( ( isset( $shortcode_atts['url'] ) ) && ( ! empty( $shortcode_atts['url'] ) ) ) {
					$menu_item->url = $shortcode_atts['url'];
				}
				if ( ( isset( $shortcode_atts['label'] ) ) && ( ! empty( $shortcode_atts['label'] ) ) ) {
					$menu_item->title = $shortcode_atts['label'];
				}

				/**
				 * Filters login menu item.
				 *
				 * @since 2.0.7
				 *
				 * @param WP_Post $menu_item WP_Post object for menu item.
				 * @param array   $menu_args An array of arguments related to menu being processed / displayed.
				 */
				$menu_item = apply_filters( 'learndash_login_menu_item', $menu_item, $menu_args );
			}
		}
	}
	return $menu_items;
}
add_filter( 'wp_nav_menu_objects', 'learndash_login_menu_items', 30, 2 );

global $learndash_login_model_html;
$learndash_login_model_html = false;
/**
 * Prints the login modal in the site footer.
 *
 * @global string $learndash_login_model_html Login modal HTML.
 */
function learndash_load_login_modal_html() {
	global $learndash_login_model_html;

	// Check that we are running the LD30 theme and login mode enabled.
	$active_template_key = LearnDash_Theme_Register::get_active_theme_key();
	$login_mode_enabled  = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Theme_LD30', 'login_mode_enabled' );
	if ( ( 'ld30' === $active_template_key ) && ( 'yes' === $login_mode_enabled ) ) {

		// Don't need to load the HTML if the user is already logged in.
		if ( ( ! is_user_logged_in() ) && ( function_exists( 'learndash_get_template_part' ) ) ) {
			if ( false === $learndash_login_model_html ) {
				$learndash_login_model_html = learndash_get_template_part( 'modules/login-modal.php', array(), false );
				if ( false !== $learndash_login_model_html ) {
					add_action(
						'wp_footer',
						function() {
							global $learndash_login_model_html;
							if ( ( isset( $learndash_login_model_html ) ) && ( ! empty( $learndash_login_model_html ) ) ) {
								echo '<div class="learndash-wrapper learndash-wrapper-login-modal ld-modal-closed">' . $learndash_login_model_html . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Need to output HTML.
							}
						}
					);
				}
			}
		}
	}
}

/**
 * Adds custom classes to the body.
 *
 * Fires on `body_class` hook.
 *
 * @since 3.1.0
 *
 * @param array $classes Optional. An array of current body classes. Default empty array.
 *
 * @return array $classes.
 */
function learndash_body_classes( $classes = array() ) {

	if ( in_array( get_post_type(), learndash_get_post_types(), true ) ) {
		$custom_classes   = array();
		$custom_classes[] = 'learndash-cpt';
		$custom_classes[] = 'learndash-cpt-' . get_post_type();

		// Add active LD theme template
		$custom_classes[] = 'learndash-template-' . LearnDash_Theme_Register::get_active_theme_key();

		// Add classes or current course steps.
		if ( in_array( get_post_type(), learndash_get_post_types( 'course_steps' ), true ) ) {
			$custom_classes[] = 'learndash-cpt-' . get_post_type( get_the_ID() ) . '-' . get_the_ID() . '-current';

			$course_id = learndash_get_course_id();
			if ( ! empty( $course_id ) ) {
				$custom_classes[] = 'learndash-cpt-' . get_post_type( $course_id ) . '-' . $course_id . '-parent';

				$parent_step_ids = learndash_course_get_all_parent_step_ids( $course_id, get_the_ID() );
				if ( ! empty( $parent_step_ids ) ) {
					foreach ( $parent_step_ids as $parent_step_id ) {
						$custom_classes[] = 'learndash-cpt-' . get_post_type( $parent_step_id ) . '-' . $parent_step_id . '-parent';
					}
				}
			}
		}

		/**
		 * Filters whether to make videos responsive or not.
		 *
		 * @param boolean      $is_responsive Whether to make videos responsive.
		 * @param string|false $post_type     Post Type slug.
		 * @param int|false    $post_id       Post ID.
		 */
		if ( true === apply_filters( 'learndash_responsive_video', true, get_post_type(), get_the_ID() ) ) {
			$custom_classes[] = 'learndash-embed-responsive';
		}

		/**
		 * Filters list of body tag CSS classes.
		 *
		 * @param string       $custom_classes Body css classes.
		 * @param string|false $post_type      Post Type slug.
		 * @param int|false    $post_id        Post ID.
		 */
		$custom_classes = apply_filters( 'learndash_body_classes', $custom_classes, get_post_type(), get_the_ID() );
		if ( ( ! empty( $custom_classes ) ) && ( is_array( $custom_classes ) ) ) {
			$classes = array_merge( $classes, $custom_classes );
			$classes = array_unique( $classes );
		}
	}

	return $classes;
}
add_filter( 'body_class', 'learndash_body_classes', 100, 1 );

/**
 * Recalcuates the length of string vars within serialized data.
 *
 * Taken from http://lea.verou.me/2011/02/convert-php-serialized-data-to-unicode/
 *
 * @since 3.1.0
 *
 * @param string $serialized_text Optional. Serialized text. Default empty.
 *
 * @return string The serialized text.
 */
function learndash_recount_serialized_bytes( $serialized_text = '' ) {
	if ( ! empty( $serialized_text ) ) {
		mb_internal_encoding( 'UTF-8' );
		mb_regex_encoding( 'UTF-8' );

		mb_ereg_search_init( $serialized_text, 's:[0-9]+:"' );

		$offset = 0;

		while ( preg_match( '/s:([0-9]+):"/u', $serialized_text, $matches, PREG_OFFSET_CAPTURE, $offset ) ||
			preg_match( '/s:([0-9]+):"/u', $serialized_text, $matches, PREG_OFFSET_CAPTURE, ++$offset ) ) {
			$number = $matches[1][0];
			$pos    = $matches[1][1];

			$digits    = strlen( "$number" );
			$pos_chars = mb_strlen( substr( $serialized_text, 0, $pos ) ) + 2 + $digits;

			$str = mb_substr( $serialized_text, $pos_chars, $number );

			$new_number = strlen( $str );
			$new_digits = strlen( $new_number );

			if ( $number != $new_number ) {
				// Change stored number
				$serialized_text = substr_replace( $serialized_text, $new_number, $pos, $digits );
				$pos            += $new_digits - $digits;
			}

			$offset = $pos + 2 + $new_number;
		}
	}

	return $serialized_text;
}

/**
 * Gets a single `WP_Post` for a given learndash post type.
 *
 * @param string $post_type Optional. The post type slug. Default empty.
 *
 * @return WP_Post|void The `WP_Post` object for a given post type.
 */
function learndash_get_single_post( $post_type = '' ) {
	if ( ( ! empty( $post_type ) ) && ( in_array( $post_type, learndash_get_post_types(), true ) ) ) {
		$post_query_args = array(
			'post_type'      => $post_type,
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'fields'         => 'ids',
		);

		$post_query = new WP_Query( $post_query_args );
		if ( ( is_a( $post_query, 'WP_Query' ) ) && ( property_exists( $post_query, 'posts' ) ) && ( ! empty( $post_query->posts ) ) ) {
			return $post_query->posts[0];
		}
	}
}

/**
 * Used to sanitize array keys and values.
 *
 * Would normally use various WP utility functions like wp_kses_post_deep()
 * but they only sanitize the data element not the key. This function
 * is recursive to handle nests arrays.
 *
 * @param array $data_in Source array to clean.
 */
function learndash_array_sanitize_keys_and_values( $data_in = array() ) {
	if ( ( is_array( $data_in ) ) && ( ! empty( $data_in ) ) ) {
		$data_out = array();
		foreach ( $data_in as $i_key => $i_val ) {
			$i_key = sanitize_text_field( $i_key );
			if ( ( is_array( $i_val ) ) && ( ! empty( $i_val ) ) ) {
				$i_val = learndash_array_sanitize_keys_and_values( $i_val );
			} elseif ( ! empty( $i_val ) ) {
				$i_val = wp_kses_post( $i_val );
			} else {
				$i_val = '';
			}
			$data_out[ $i_key ] = $i_val;
		}
		$data_in = $data_out;
	}

	return $data_in;
}

/**
 * Utility function to centralize all LearnDash redirect calls.
 *
 * @since 3.2.3
 *
 * @param string $location The URL to redirect the user to.
 * @param int    $status   The HTTP Status to set. Default 302.
 * @param bool   $exit     True if the function should exit on successful redirect.
 * @param string $context  Unique string provided by the caller to help filter conditions.
 *
 * @return bool The redirect status. Only if $exit is not true.
 */
function learndash_safe_redirect( $location = '', $status = null, $exit = true, $context = '' ) {
	if ( ! empty( $location ) ) {

		if ( empty( $status ) ) {
			$status = 302;
		}

		/**
		 * Filters the redirect location URL.
		 *
		 * @since 3.2.3
		 *
		 * @param string $location The URL to redirect the user to.
		 * @param int    $status   The HTTP Status to set. Default 302.
		 * @param string $context  Unique string provided by the caller to help filter conditions.
		 */
		$location = apply_filters( 'learndash_safe_redirect_location', $location, $status, $context );
		if ( ! empty( $location ) ) {
			/**
			 * Filters the redirect HTTP status.
			 *
			 * @since 3.2.3
			 *
			 * @param int    $status   The HTTP Status to set. Default 302.
			 * @param string $location The URL to redirect the user to.
			 * @param string $context  Unique string provided by the caller to help filter conditions.
			 */
			$status = apply_filters( 'learndash_safe_redirect_status', $status, $location, $context );

			/**
			 * Filters the redirect nocache_headers.
			 *
			 * @since 3.2.3
			 *
			 * @param bool   true      True to call nocache_headers().
			 * @param string $location The URL to redirect the user to.
			 * @param int    $status   The HTTP Status to set. Default 302.
			 * @param string $context  Unique string provided by the caller to help filter conditions.
			 */
			if ( apply_filters( 'learndash_safe_redirect_nocache_header', true, $location, $status, $context ) ) {
				nocache_headers();
			}

			/**
			 * Filters to override using the WordPress function wp_safe_redirect().
			 *
			 * @since 3.3.0.2
			 *
			 * @param bool   true      True to call wp_safe_redirect().
			 * @param string $location The URL to redirect the user to.
			 * @param int    $status   The HTTP Status to set. Default 302.
			 * @param string $context  Unique string provided by the caller to help filter conditions.
			 */
			if ( apply_filters( 'learndash_use_wp_safe_redirect', LEARNDASH_USE_WP_SAFE_REDIRECT, $location, $status, $context ) ) {
				$redirect_status = wp_safe_redirect( $location, $status );
			} else {
				$redirect_status = wp_redirect( $location, $status ); //phpcs:ignore WordPress.Security.SafeRedirect.wp_redirect_wp_redirect
			}

			if ( $redirect_status ) {
				if ( $exit ) {
					exit;
				}
			}

			// Only here if $exit is not true.
			return $redirect_status;
		}
	}
}

/**
 * Utility function to determine if we are using the Select2 library on selects.
 *
 * @since 3.2.3
 * @return bool true is select2 library is being used.
 */
function learndash_use_select2_lib() {
	/**
	 * Filters whether the select2 is loaded or not.
	 *
	 * @param boolean $learndash_select2 whether the select2 library is loaded or not.
	 */
	if ( ( defined( 'LEARNDASH_SELECT2_LIB' ) ) && ( true === apply_filters( 'learndash_select2_lib', LEARNDASH_SELECT2_LIB ) ) ) {
		return true;
	}
}

/**
 * Utility function to determine if we are using the Select2 library AJAX fetch option.
 *
 * @since 3.2.3
 * @return bool true is select2 library is being used.
 */
function learndash_use_select2_lib_ajax_fetch() {
	if ( learndash_use_select2_lib() ) {
		/**
		 * Filters whether the select2 is used to fetch AJAX data.
		 *
		 * @param boolean $learndash_select2_ajax_featch whether the select2 library is used to fetch AJAX data.
		 */
		if ( ( defined( 'LEARNDASH_SELECT2_LIB_AJAX_FETCH' ) ) && ( true === apply_filters( 'learndash_select2_lib_ajax_fetch', LEARNDASH_SELECT2_LIB_AJAX_FETCH ) ) ) {
			return true;
		}
	}
}

function learndash_put_directory_index_file( $index_filename = '' ) {
	if ( ! empty( $index_filename ) ) {
		global $wp_filesystem;

		// Initialize the WP filesystem, no more using 'file-put-contents' function
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}

		$wp_filesystem->put_contents( $index_filename, '//LearnDash is THE Best LMS', FS_CHMOD_FILE );
	}
}

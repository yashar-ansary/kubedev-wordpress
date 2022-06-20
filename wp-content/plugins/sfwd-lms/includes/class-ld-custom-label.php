<?php
/**
 * LearnDash Custom Label class.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class LearnDash_Custom_Label {
	/**
	 * Construct
	 */
	public function __construct() {
	}

	/**
	 * Get label based on key name
	 *
	 * @param  string $key Key name of setting field.
	 * @return string Label entered on settings page.
	 */
	public static function get_label( $key ) {
		$labels = array();
		$key    = strtolower( $key );

		$labels = get_option( 'learndash_settings_custom_labels', array() );
		if ( ! is_array( $labels ) ) {
			$labels = array();
		}

		switch ( $key ) {
			case 'course':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Course', 'learndash' );
				break;

			case 'courses':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Courses', 'learndash' );
				break;

			case 'lesson':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Lesson', 'learndash' );
				break;

			case 'lessons':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Lessons', 'learndash' );
				break;

			case 'topic':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Topic', 'learndash' );
				break;

			case 'topics':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Topics', 'learndash' );
				break;

			case 'quiz':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Quiz', 'learndash' );
				break;

			case 'quizzes':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Quizzes', 'learndash' );
				break;

			case 'question':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Question', 'learndash' );
				break;

			case 'questions':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Questions', 'learndash' );
				break;

			case 'group':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Group', 'learndash' );
				break;

			case 'groups':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Groups', 'learndash' );
				break;

			case 'group_leader':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Group Leader', 'learndash' );
				break;

			case 'button_take_this_course':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Take this Course', 'learndash' );
				break;

			case 'button_take_this_group':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Enroll in Group', 'learndash' );
				break;

			case 'button_mark_complete':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Mark Complete', 'learndash' );
				break;

			case 'button_click_here_to_continue':
				$label = ! empty( $labels[ $key ] ) ? $labels[ $key ] : esc_html__( 'Click Here to Continue', 'learndash' );
				break;

			default:
				$label = '';
		}
		/**
		 * Filters the value of label settings entered in the settings page. Used to filter label value in get_label function.
		 *
		 * @param string $label Label entered on settings page.
		 * @param string $key   Key name of setting field.
		 */
		return apply_filters( 'learndash_get_label', $label, $key );
	}

	/**
	 * Get slug-ready string
	 *
	 * @param  string $key Key name of setting field.
	 * @return string      Lowercase string
	 */
	public static function label_to_lower( $key ) {
		$label = strtolower( self::get_label( $key ) );
		/**
		 * Filters value of label after converting it to the lowercase. Used to filter label values in label_to_lower function.
		 *
		 * @param string $label Label entered on settings page.
		 * @param string $key   Key name of setting field.
		 */
		return apply_filters( 'learndash_label_to_lower', $label, $key );
	}

	/**
	 * Get slug-ready string
	 *
	 * @param  string $key Key name of setting field.
	 * @return string      Slug-ready string
	 */
	public static function label_to_slug( $key ) {
		$label = sanitize_title( self::get_label( $key ) );
		/**
		 * Filters the value of the slug after the conversion from the label. Used to filter slug value in label_to_slug function.
		 *
		 * @param string $label Label entered on settings page.
		 * @param string $key   Key name of setting field.
		 */
		return apply_filters( 'label_to_slug', $label, $key );
	}
}

add_action(
	'plugins_loaded',
	function() {
		new LearnDash_Custom_Label();
	}
);

/**
 * Utility function to get a custom field label.
 *
 * @since 2.6.0
 * @param string $field Field label to retreive.
 * @return string Field label. Empty of none found.
 */
function learndash_get_custom_label( $field = '' ) {
	return LearnDash_Custom_Label::get_label( $field );
}

/**
 * Utility function to get a custom field label lowercase.
 *
 * @since 2.6.0
 * @param string $field Field label to retreive.
 * @return string Field label. Empty of none found.
 */
function learndash_get_custom_label_lower( $field = '' ) {
	return LearnDash_Custom_Label::label_to_lower( $field );
}

/**
 * Utility function to get a custom field label slug.
 *
 * @since 2.6.0
 * @param string $field Field label to retreive.
 * @return string Field label. Empty of none found.
 */
function learndash_get_custom_label_slug( $field = '' ) {
	return LearnDash_Custom_Label::label_to_slug( $field );
}

/**
 * Get Course Step "Back to ..." label.
 *
 * @since 3.0.7
 * @param string  $step_post_type The post_type slug of the post to return label for.
 * @param boolean $plural True if the label should be the plural label. Default is false for single.
 * @return string label
 */
function learndash_get_label_course_step_back( $step_post_type = 0, $plural = false ) {
	$step_label = '';

	$post_type_object = get_post_type_object( $step_post_type );
	if ( ( $post_type_object ) && ( is_a( $post_type_object, 'WP_Post_Type' ) ) ) {
		switch ( $step_post_type ) {
			case learndash_get_post_type_slug( 'course' ):
				if ( true === $plural ) {
					$step_label = sprintf(
						// translators: placeholder: Courses.
						esc_html_x( 'Back to %s', 'placeholder: Courses', 'learndash' ),
						$post_type_object->labels->name
					);
				} else {
					$step_label = sprintf(
						// translators: placeholder: Course.
						esc_html_x( 'Back to %s', 'placeholder: Course', 'learndash' ),
						$post_type_object->labels->singular_name
					);
				}
				break;

			case learndash_get_post_type_slug( 'lesson' ):
				if ( true === $plural ) {
					$step_label = sprintf(
						// translators: placeholder: Lessons.
						esc_html_x( 'Back to %s', 'placeholder: Lessons', 'learndash' ),
						$post_type_object->labels->name
					);
				} else {
					$step_label = sprintf(
						// translators: placeholder: Lesson.
						esc_html_x( 'Back to %s', 'placeholder: Lesson', 'learndash' ),
						$post_type_object->labels->singular_name
					);
				}
				break;

			case learndash_get_post_type_slug( 'topic' ):
				if ( true === $plural ) {
					$step_label = sprintf(
						// translators: placeholder: Topics.
						esc_html_x( 'Back to %s', 'placeholder: Topics', 'learndash' ),
						$post_type_object->labels->name
					);
				} else {
					$step_label = sprintf(
						// translators: placeholder: Topic.
						esc_html_x( 'Back to %s', 'placeholder: Topic', 'learndash' ),
						$post_type_object->labels->singular_name
					);

				}
				break;

			case learndash_get_post_type_slug( 'quiz' ):
				if ( true === $plural ) {
					$step_label = sprintf(
						// translators: placeholder: Quizzes.
						esc_html_x( 'Back to %s', 'placeholder: Quizzes', 'learndash' ),
						$post_type_object->labels->name
					);
				} else {
					$step_label = sprintf(
						// translators: placeholder: Quiz.
						esc_html_x( 'Back to %s', 'placeholder: Quiz', 'learndash' ),
						$post_type_object->labels->singular_name
					);
				}
				break;

			case learndash_get_post_type_slug( 'question' ):
				if ( true === $plural ) {
					$step_label = sprintf(
						// translators: placeholder: Questions.
						esc_html_x( 'Back to %s', 'placeholder: Questions', 'learndash' ),
						$post_type_object->labels->name
					);
				} else {
					$step_label = sprintf(
						// translators: placeholder: Question.
						esc_html_x( 'Back to %s', 'placeholder: Question', 'learndash' ),
						$post_type_object->labels->singular_name
					);

				}
				break;

			case learndash_get_post_type_slug( 'transaction' ):
				if ( true === $plural ) {
					$step_label = sprintf(
						// translators: placeholder: Transactions.
						esc_html_x( 'Back to %s', 'placeholder: Transactions', 'learndash' ),
						$post_type_object->labels->name
					);
				} else {
					$step_label = sprintf(
						// translators: placeholder: Transaction.
						esc_html_x( 'Back to %s', 'placeholder: Transaction', 'learndash' ),
						$post_type_object->labels->singular_name
					);
				}
				break;

			case learndash_get_post_type_slug( 'group' ):
				if ( true === $plural ) {
					$step_label = sprintf(
						// translators: placeholder: Groups.
						esc_html_x( 'Back to %s', 'placeholder: Groups', 'learndash' ),
						$post_type_object->labels->name
					);
				} else {
					$step_label = sprintf(
						// translators: placeholder: Group.
						esc_html_x( 'Back to %s', 'placeholder: Group', 'learndash' ),
						$post_type_object->labels->singular_name
					);
				}
				break;

			case learndash_get_post_type_slug( 'assignment' ):
				if ( true === $plural ) {
					$step_label = sprintf(
						// translators: placeholder: Assignments.
						esc_html_x( 'Back to %s', 'placeholder: Assignments', 'learndash' ),
						$post_type_object->labels->name
					);
				} else {
					$step_label = sprintf(
						// translators: placeholder: Assignment.
						esc_html_x( 'Back to %s', 'placeholder: Assignment', 'learndash' ),
						$post_type_object->labels->singular_name
					);
				}
				break;

			case learndash_get_post_type_slug( 'essay' ):
				if ( true === $plural ) {
					$step_label = sprintf(
						// translators: placeholder: Essays.
						esc_html_x( 'Back to %s', 'placeholder: Essays', 'learndash' ),
						$post_type_object->labels->name
					);
				} else {
					$step_label = sprintf(
						// translators: placeholder: Essay.
						esc_html_x( 'Back to %s', 'placeholder: Essay', 'learndash' ),
						$post_type_object->labels->singular_name
					);
				}
				break;

			case learndash_get_post_type_slug( 'certificate' ):
				if ( true === $plural ) {
					$step_label = esc_html__( 'Back to Certificates', 'learndash' );
				} else {
					$step_label = esc_html__( 'Back to Certificate', 'learndash' );
				}
				break;

			default:
				if ( true === $plural ) {
					$step_label = sprintf(
						// translators: placeholder: Post Type Plural label.
						esc_html_x( 'Back to %s', 'placeholder: Post Type Plural label', 'learndash' ),
						$post_type_object->labels->name
					);
				} else {
					$step_label = sprintf(
						// translators: placeholder: Post Type Singular label.
						esc_html_x( 'Back to %s', 'placeholder: Post Type Singular label', 'learndash' ),
						$post_type_object->labels->singular_name
					);
				}
				break;
		}
	} else {
		$step_label = sprintf(
			// translators: placeholder: Post Type slug.
			esc_html_x( 'Back to %s', 'placeholder: Post Type slug', 'learndash' ),
			$step_post_type
		);
	}

	/**
	 * Filters value of course step back label. Used to update step back label in learndash_get_label_course_step_back function.
	 *
	 * @param string  $step_label     Course Step `Back to ...` label.
	 * @param string  $step_post_type The post_type slug of the post to return label for.
	 * @param boolean $plural         True if the label should be the plural label.
	 */
	return apply_filters( 'learndash_get_label_course_step_back', $step_label, $step_post_type, $plural );
}

/**
 * Get Course Step "Previous ..." label.
 *
 * @since 3.0.7
 * @param string $step_post_type The post_type slug of the post to return label for.
 * @return string label
 */
function learndash_get_label_course_step_previous( $step_post_type = 0 ) {
	$step_label = '';

	$post_type_object = get_post_type_object( $step_post_type );
	if ( ( $post_type_object ) && ( is_a( $post_type_object, 'WP_Post_Type' ) ) ) {
		switch ( $step_post_type ) {
			case learndash_get_post_type_slug( 'course' ):
				$step_label = sprintf(
					// translators: placeholder: Course.
					esc_html_x( 'Previous %s', 'placeholder: Course', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'lesson' ):
				$step_label = sprintf(
					// translators: placeholder: Lesson.
					esc_html_x( 'Previous %s', 'placeholder: Lesson', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'topic' ):
				$step_label = sprintf(
					// translators: placeholder: Topic.
					esc_html_x( 'Previous %s', 'placeholder: Topic', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'quiz' ):
				$step_label = sprintf(
					// translators: placeholder: Quiz.
					esc_html_x( 'Previous %s', 'placeholder: Quiz', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'question' ):
				$step_label = sprintf(
					// translators: placeholder: Question.
					esc_html_x( 'Previous %s', 'placeholder: Question', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'transaction' ):
				$step_label = sprintf(
					// translators: placeholder: Transaction.
					esc_html_x( 'Previous %s', 'placeholder: Transaction', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'group' ):
				$step_label = sprintf(
					// translators: placeholder: Group.
					esc_html_x( 'Previous %s', 'placeholder: Group', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'assignment' ):
				$step_label = sprintf(
					// translators: placeholder: Assignment.
					esc_html_x( 'Previous %s', 'placeholder: Assignment', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'essay' ):
				$step_label = sprintf(
					// translators: placeholder: Essay.
					esc_html_x( 'Previous %s', 'placeholder: Essay', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'certificate' ):
				$step_label = esc_html__( 'Previous Certificate', 'learndash' );
				break;

			default:
				$step_label = sprintf(
					// translators: placeholder: Post Type Singular label.
					esc_html_x( 'Previous %s', 'placeholder: Post Type Singular label', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;
		}
	} else {
		$step_label = sprintf(
			// translators: placeholder: Post Type slug.
			esc_html_x( 'Previous %s', 'placeholder: Post Type slug', 'learndash' ),
			$step_post_type
		);
	}

	/**
	 * Filters value of course step previous label. Used to update step previous label in learndash_get_label_course_step_previous function.
	 *
	 * @param string  $step_label     Course step `Previous ...` label.
	 * @param string  $step_post_type The post_type slug of the post to return label for.
	 */
	return apply_filters( 'learndash_get_label_course_step_previous', $step_label, $step_post_type );
}

/**
 * Get Course Step "Next ..." label.
 *
 * @since 3.0.7
 * @param string $step_post_type The post_type slug of the post to return label for.
 * @return string label
 */
function learndash_get_label_course_step_next( $step_post_type = 0 ) {
	$step_label = '';

	$post_type_object = get_post_type_object( $step_post_type );
	if ( ( $post_type_object ) && ( is_a( $post_type_object, 'WP_Post_Type' ) ) ) {
		switch ( $step_post_type ) {
			case learndash_get_post_type_slug( 'course' ):
				$step_label = sprintf(
					// translators: placeholder: Course.
					esc_html_x( 'Next %s', 'placeholder: Course', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'lesson' ):
				$step_label = sprintf(
					// translators: placeholder: Lesson.
					esc_html_x( 'Next %s', 'placeholder: Lesson', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'topic' ):
				$step_label = sprintf(
					// translators: placeholder: Topic.
					esc_html_x( 'Next %s', 'placeholder: Topic', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'quiz' ):
				$step_label = sprintf(
					// translators: placeholder: Quiz.
					esc_html_x( 'Next %s', 'placeholder: Quiz', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'question' ):
				$step_label = sprintf(
					// translators: placeholder: Question.
					esc_html_x( 'Next %s', 'placeholder: Question', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'transaction' ):
				$step_label = sprintf(
					// translators: placeholder: Transaction.
					esc_html_x( 'Next %s', 'placeholder: Transaction', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'group' ):
				$step_label = sprintf(
					// translators: placeholder: Group.
					esc_html_x( 'Next %s', 'placeholder: Group', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'assignment' ):
				$step_label = sprintf(
					// translators: placeholder: Assignment.
					esc_html_x( 'Next %s', 'placeholder: Assignment', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'essay' ):
				$step_label = sprintf(
					// translators: placeholder: Essay.
					esc_html_x( 'Next %s', 'placeholder: Essay', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'certificate' ):
				$step_label = esc_html__( 'Next Certificate', 'learndash' );
				break;

			default:
				$step_label = sprintf(
					// translators: placeholder: Post Type Singular label.
					esc_html_x( 'Next %s', 'placeholder: Post Type Singular label', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;
		}
	} else {
		$step_label = sprintf(
			// translators: placeholder: Post Type slug.
			esc_html_x( 'Next %s', 'placeholder: Post Type slug', 'learndash' ),
			$step_post_type
		);
	}

	/**
	 * Filters value of course step next label. Used to update step next label in learndash_get_label_course_step_next function.
	 *
	 * @param string  $step_label     Course step `Next ...` label.
	 * @param string  $step_post_type The post_type slug of the post to return label for.
	 */
	return apply_filters( 'learndash_get_label_course_step_next', $step_label, $step_post_type );
}

/**
 * Get Course Step "... Page" label.
 *
 * This is used on the Admin are when editing a post type. There is a return link in the top-left.
 *
 * @since 3.0.7
 * @param string $step_post_type The post_type slug of the post to return label for.
 * @return string label
 */
function learndash_get_label_course_step_page( $step_post_type = 0 ) {
	$step_label = '';

	$post_type_object = get_post_type_object( $step_post_type );
	if ( ( $post_type_object ) && ( is_a( $post_type_object, 'WP_Post_Type' ) ) ) {
		switch ( $step_post_type ) {
			case learndash_get_post_type_slug( 'course' ):
				$step_label = sprintf(
					// translators: placeholder: Course.
					esc_html_x( '%s page', 'placeholder: Course', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'lesson' ):
				$step_label = sprintf(
					// translators: placeholder: Lesson.
					esc_html_x( '%s page', 'placeholder: Lesson', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'topic' ):
				$step_label = sprintf(
					// translators: placeholder: Topic.
					esc_html_x( '%s page', 'placeholder: Topic', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'quiz' ):
				$step_label = sprintf(
					// translators: placeholder: Quiz.
					esc_html_x( '%s page', 'placeholder: Quiz', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'question' ):
				$step_label = sprintf(
					// translators: placeholder: Question.
					esc_html_x( '%s page', 'placeholder: Question', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'transaction' ):
				$step_label = sprintf(
					// translators: placeholder: Transaction.
					esc_html_x( '%s page', 'placeholder: Transaction', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'group' ):
				$step_label = sprintf(
					// translators: placeholder: Group.
					esc_html_x( '%s page', 'placeholder: Group', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'assignment' ):
				$step_label = sprintf(
					// translators: placeholder: Assignment.
					esc_html_x( '%s page', 'placeholder: Assignment', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'essay' ):
				$step_label = sprintf(
					// translators: placeholder: Essay.
					esc_html_x( '%s page', 'placeholder: Essay', 'learndash' ),
					$post_type_object->labels->singular_name
				);
				break;

			case learndash_get_post_type_slug( 'certificate' ):
				$step_label = esc_html__( 'Certificate page', 'learndash' );
				break;

			default:
				$post_type_object = get_post_type_object( $step_post_type );
				if ( ( $post_type_object ) && ( is_a( $post_type_object, 'WP_Post_Type' ) ) ) {
					$step_label = sprintf(
						// translators: placeholder: Post Type Singular label.
						esc_html_x( '%s page', 'placeholder: Post Type Singular label', 'learndash' ),
						$post_type_object->labels->singular_name
					);
				}

				break;
		}
	} else {
		$step_label = sprintf(
			// translators: placeholder: Post Type slug.
			esc_html_x( '%s page', 'placeholder: Post Type slug', 'learndash' ),
			$step_post_type
		);
	}

	/**
	 * Filters value of course step page label. Used to update step page label in learndash_get_label_course_step_page function.
	 *
	 * @param string  $step_label     Course Step `... Page` label.
	 * @param string  $step_post_type The post_type slug of the post to return label for.
	 */
	return apply_filters( 'learndash_get_label_course_step_page', $step_label, $step_post_type );
}

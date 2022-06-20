/**
 * LearnDash Block ld-user-groups
 *
 * @since 2.5.9
 * @package LearnDash
 */

/**
 * LearnDash block functions
 */
 import {
	ldlms_get_custom_label,
} from '../ldlms.js';

/**
 * Internal block libraries
 */
import { __, _x, sprintf } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';

registerBlockType(
	'learndash/ld-user-groups',
	{
		// translators: placeholder: Groups.
		title: sprintf(_x('LearnDash User %s', 'placeholder: Groups', 'learndash'), ldlms_get_custom_label('groups')),
		// translators: placeholder: Groups.
		description: sprintf(_x( 'This block displays the list of %s users are assigned to as users or leaders.', 'placeholder: groups', 'learndash'), ldlms_get_custom_label('groups')),
		icon: 'groups',
		category: 'learndash-blocks',
		example: {
			attributes: {
				example_show: 1,
			},
		},
		supports: {
			customClassName: false,
		},
		attributes: {
			user_id: {
				type: 'string',
				default: ''
			},
			preview_show: {
				type: 'boolean',
				default: 1
			},
			preview_user_id: {
				type: 'string',

			}
		},
		edit: function (props) {
			const { attributes: { user_id, preview_user_id, preview_show },
				setAttributes } = props;

			const inspectorControls = (
				<InspectorControls key='controls'>
					<PanelBody
						title={ __( 'Settings', 'learndash' ) }
					>
						<TextControl
							label={ __( 'User ID', 'learndash' ) }
							help={__('Enter specific User ID. Leave blank for current User.', 'learndash')}
							value={ user_id || '' }
							onChange={ user_id => setAttributes( { user_id } ) }
						/>
					</PanelBody>
					<PanelBody
						title={__('Preview', 'learndash')}
						initialOpen={false}
					>
						<ToggleControl
							label={__('Show Preview', 'learndash')}
							checked={!!preview_show}
							onChange={preview_show => setAttributes({ preview_show })}
						/>
						<TextControl
							label={__('User ID', 'learndash')}
							help={__('Enter a User ID to test preview', 'learndash')}
							value={preview_user_id || ''}
							type={'number'}
							onChange={preview_user_id => setAttributes({ preview_user_id })}
						/>
					</PanelBody>
				</InspectorControls>
			);

			function do_serverside_render(attributes) {
				if (attributes.preview_show == true) {
					return <ServerSideRender
						block="learndash/ld-user-groups"
						attributes={attributes}
						key="learndash/ld-user-groups"
					/>
				} else {
					return __('[user_groups] output shown here', 'learndash');
				}
			}

			return [
				inspectorControls,
				do_serverside_render(props.attributes)
			];
		},

		save: props => {
			// Delete preview_user_id from props to prevent it being saved.
			delete (props.attributes.preview_user_id);

			// Delete preview_user_id from props to prevent it being saved.
			delete (props.attributes.preview_user_id);
		}
	},
);

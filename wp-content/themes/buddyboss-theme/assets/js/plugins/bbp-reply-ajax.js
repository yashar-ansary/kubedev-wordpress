jQuery(
	function ( $ ) {
		function bbp_reply_ajax_call( action, nonce, form_data, form ) {
			var $data = {
				action: action,
				nonce: nonce
			};
			$.each(
				form_data,
				function ( i, field ) {
					if ( field.name === 'action' ) {
						$data.bbp_reply_form_action = field.value;
					} else {
						$data[field.name] = field.value;
					}
				}
			);
			var $bbpress_forums_element = form.closest( '#bbpress-forums' );
			$.post(
				window.bbpReplyAjaxJS.bbp_ajaxurl,
				$data,
				function ( response ) {
					if ( response.success ) {
						$bbpress_forums_element.find( '.bbp-reply-form form' ).removeClass( 'submitting' );
						var reply_list_item = '';
						var replyForm      = $( '.bb-quick-reply-form-wrap' );
						if ( 'edit' === response.reply_type ) {
							reply_list_item = '<li class="highlight">' + response.content + '</li>';
							// in-place editing doesn't work yet, but could (and should) eventually.
							$( '#post-' + response.reply_id ).parent( 'li' ).replaceWith( reply_list_item );
						} else {
							if ( window.bbpReplyAjaxJS.threaded_reply && response.reply_parent && response.reply_parent !== response.reply_id ) {
								// threaded comment.
								var $parent = null;
								var reply_list_item_depth = '1';
								if ( $( '#post-' + response.reply_parent ).parent( 'li' ).data( 'depth' ) == window.bbpReplyAjaxJS.threaded_reply_depth ) {
									var depth = parseInt( window.bbpReplyAjaxJS.threaded_reply_depth ) - 1;
									$parent = $( '#post-' + response.reply_parent ).closest( 'li.depth-' + depth );
									reply_list_item_depth = window.bbpReplyAjaxJS.threaded_reply_depth;
								} else {
									$parent = $( '#post-' + response.reply_parent ).parent( 'li' );
									reply_list_item_depth = parseInt( $parent.data( 'depth' ) ) + 1;
								}
								var list_type = 'ul';
								if ( $bbpress_forums_element.find( '.bb-single-reply-list' ).is( 'ol' ) ) {
									list_type = 'ol';
								}
								if ( !$parent.find( '>' + list_type + '.bbp-threaded-replies' ).length ) {
									$parent.append( '<' + list_type + ' class="bbp-threaded-replies"></' + list_type + '>' );
								}
								reply_list_item = '<li class="highlight depth-' + reply_list_item_depth + '" data-depth="' + reply_list_item_depth + '">' + response.content + '</li>';
								$parent.find( '>' + list_type + '.bbp-threaded-replies' ).append( reply_list_item );
							} else {
								/**
								* Redirect to last page when anyone reply from begging of the page.
								*/
								if ( response.current_page == response.total_pages ) {
									reply_list_item = '<li class="highlight depth-1" data-depth="1">' + response.content + '</li>';
									$bbpress_forums_element.find( '.bb-single-reply-list' ).append( reply_list_item );
								} else {
									var oldRedirectUrl = response.redirect_url;
									var newRedirectUrl = oldRedirectUrl.substring( 0, oldRedirectUrl.indexOf( '#' ) );
		
									// Prevent redirect for quick reply form for titmeline.
									if ( ! replyForm.length && ! replyForm.is(':visible') ) {
										window.location.href = newRedirectUrl;
									}
								}
								/**
								* Ended code for redirection to the last page
								*/
							}
							// replace dummy image with original image by faking scroll event to call bp.Nouveau.lazyLoad.
							jQuery( window ).scroll();
						}
						// Get all the tags without page reload.
						if ( response.tags !== '' ) {
							var tagsDivSelector = $( 'body .item-tags' );
							var tagsDivUlSelector = $( 'body .item-tags ul' );
							if ( tagsDivSelector.css( 'display' ) === 'none' ) {
								tagsDivSelector.append( response.tags );
								tagsDivSelector.show();
							} else {
								tagsDivUlSelector.remove();
								tagsDivSelector.append( response.tags );
							}
						}
						if ( reply_list_item != '' ) {
							$( 'body' ).animate(
								{
									scrollTop: $( reply_list_item ).offset().top
								},
								500
							);
							setTimeout(
								function () {
									$( reply_list_item ).removeClass( 'highlight' );
								},
								2000
							);
						}
						var media_element_key = $bbpress_forums_element.find( '.bbp-reply-form form' ).find( '#forums-post-media-uploader' ).data( 'key' );
						var media = false;
						if ( typeof bp !== 'undefined' &&
							typeof bp.Nouveau !== 'undefined' &&
							typeof bp.Nouveau.Media !== 'undefined' &&
							typeof bp.Nouveau.Media.dropzone_media !== 'undefined' &&
							typeof bp.Nouveau.Media.dropzone_media[media_element_key] !== 'undefined' &&
							bp.Nouveau.Media.dropzone_media[media_element_key].length
						) {
							media = true;
							for ( var i = 0; i < bp.Nouveau.Media.dropzone_media[media_element_key].length; i++ ) {
								bp.Nouveau.Media.dropzone_media[media_element_key][i].saved = true;
							}
						}
						var document_element_key = $bbpress_forums_element.find( '.bbp-reply-form form' ).find( '#forums-post-document-uploader' ).data( 'key' );
						var document = false;
						if ( typeof bp !== 'undefined' &&
							typeof bp.Nouveau !== 'undefined' &&
							typeof bp.Nouveau.Media !== 'undefined' &&
							typeof bp.Nouveau.Media.dropzone_media !== 'undefined' &&
							typeof bp.Nouveau.Media.dropzone_media[document_element_key] !== 'undefined' &&
							bp.Nouveau.Media.dropzone_media[document_element_key].length
						) {
							document = true;
							for ( var i = 0; i < bp.Nouveau.Media.dropzone_media[document_element_key].length; i++ ) {
								bp.Nouveau.Media.dropzone_media[document_element_key][i].saved = true;
							}
						}

						var video_element_key = $bbpress_forums_element.find( '.bbp-reply-form form' ).find( '#forums-post-video-uploader' ).data( 'key' );
						var video 			 = false;
						if ( typeof bp !== 'undefined' &&
							typeof bp.Nouveau !== 'undefined' &&
							typeof bp.Nouveau.Media !== 'undefined' &&
							typeof bp.Nouveau.Media.dropzone_media !== 'undefined' &&
							typeof bp.Nouveau.Media.dropzone_media[video_element_key] !== 'undefined' &&
							bp.Nouveau.Media.dropzone_media[video_element_key].length
						) {
							video = true;
							for ( var i = 0; i < bp.Nouveau.Media.dropzone_media[video_element_key].length; i++ ) {
								bp.Nouveau.Media.dropzone_media[video_element_key][i].saved = true;
							}
						}

						var editor_element_key = $bbpress_forums_element.find( '.bbp-reply-form form' ).find( '.bbp-the-content' ).data( 'key' );
						if ( typeof window.forums_medium_reply_editor !== 'undefined' && typeof window.forums_medium_reply_editor[editor_element_key] !== 'undefined' ) {
							// Reset formatting of editor
							window.forums_medium_reply_editor[editor_element_key].execAction( 'selectAll' );
							window.forums_medium_reply_editor[editor_element_key].execAction( 'removeFormate' );
							window.forums_medium_reply_editor[editor_element_key].resetContent();
						}
						$bbpress_forums_element.find( '.bbp-reply-form form' ).find( '.bbp-the-content' ).removeClass( 'error' );
						if ( replyForm.length && replyForm.is(':visible') ) {
							$bbpress_forums_element.find('.bbp-reply-form').hide();
						} else {
							$bbpress_forums_element.find( '#bbp-close-btn' ).trigger( 'click' );
						}
						$bbpress_forums_element.find( '#bbp_reply_content' ).val( '' );
						reset_reply_form( $bbpress_forums_element, media_element_key, media );
						reset_reply_form( $bbpress_forums_element, document_element_key, document );
						reset_reply_form( $bbpress_forums_element, video_element_key, video );

						var scrubberposts = $bbpress_forums_element.find( '.scrubberpost' );
						
						if ( scrubberposts.length ) {
							for ( var k in scrubberposts ) {
								if ( $( scrubberposts[k] ).hasClass( 'post-' + response.reply_id ) ) {
									window.BuddyBossThemeBbpScrubber.goToPost( parseInt( k,10 ) + 1,'' );
									break;
								}
							}
						}
						
					} else {
						if ( typeof response.content !== 'undefined' ) {
							$bbpress_forums_element.find( '.bbp-reply-form form' ).find( '#bbp-template-notices' ).html( response.content );
						}
					}
					$bbpress_forums_element.find( '.bbp-reply-form form' ).removeClass( 'submitting' );

					$( '.bbp-reply-form' ).trigger( 'bbp_after_submit_reply_form', {
						response: response, 
						topic_id: $data.bbp_topic_id 
					} );
				}
			);
		}
		function reset_reply_form( $element, media_element_key, media ) {
			// clear notices.
			$element.find( '.bbp-reply-form form' ).find( '#bbp-template-notices' ).html( '' );
			if (
				typeof bp !== 'undefined' &&
				typeof bp.Nouveau !== 'undefined' &&
				typeof bp.Nouveau.Media !== 'undefined'
			) {
				$element.find( '.gif-media-search-dropdown' ).removeClass( 'open' );
				$element.find( '#whats-new-toolbar .toolbar-button' ).removeClass( 'active disable' );
				var $forums_attached_gif_container = $element.find( '#whats-new-attachments .forums-attached-gif-container' );
				if ( $forums_attached_gif_container.length ) {
					$forums_attached_gif_container.addClass( 'closed' );
					$forums_attached_gif_container.find( '.gif-image-container img' ).attr( 'src', '' );
					$forums_attached_gif_container[0].style = '';
				}
				if ( $element.find( '#bbp_media_gif' ).length ) {
					$element.find( '#bbp_media_gif' ).val( '' );
				}
				if ( typeof media_element_key !== 'undefined' && media ) {
					if ( typeof bp.Nouveau.Media.dropzone_obj[media_element_key] !== 'undefined' ) {
						bp.Nouveau.Media.dropzone_obj[media_element_key].destroy();
						bp.Nouveau.Media.dropzone_obj.splice( media_element_key, 1 );
						bp.Nouveau.Media.dropzone_media.splice( media_element_key, 1 );
					}
					$element.find( 'div#forums-post-media-uploader[data-key="' + media_element_key + '"]' ).html( '' );
					$element.find( 'div#forums-post-media-uploader[data-key="' + media_element_key + '"]' ).addClass( 'closed' ).removeClass( 'open' );
					$element.find( 'div#forums-post-document-uploader[data-key="' + media_element_key + '"]' ).html( '' );
					$element.find( 'div#forums-post-document-uploader[data-key="' + media_element_key + '"]' ).addClass( 'closed' ).removeClass( 'open' );

					$element.find( 'div#forums-post-video-uploader[data-key="' + media_element_key + '"]' ).html( '' );
					$element.find( 'div#forums-post-video-uploader[data-key="' + media_element_key + '"]' ).addClass( 'closed' ).removeClass( 'open' );
				}
			}
		}
		if ( !$( 'body' ).hasClass( 'reply-edit' ) ) {
			$( '.bbp-reply-form form' ).on(
				'submit',
				function ( e ) {
					e.preventDefault();
					if ( $( this ).hasClass( 'submitting' ) ) {
						return false;
					}
					$( this ).addClass( 'submitting' );
					var valid = true;
					var media_valid = true;
					var editor_key = $( e.target ).find( '.bbp-the-content' ).data( 'key' );
					var editor = false;
					if ( typeof window.forums_medium_reply_editor !== 'undefined' && typeof window.forums_medium_reply_editor[editor_key] !== 'undefined' ) {
						editor = window.forums_medium_reply_editor[editor_key];
					}
					if (
					(
					$( this ).find( '#bbp_media' ).length > 0
					&& $( this ).find( '#bbp_document' ).length > 0
					&& $( this ).find( '#bbp_video' ).length > 0
					&& $( this ).find( '#bbp_media_gif' ).length > 0
					&& $( this ).find( '#bbp_media' ).val() == ''
					&& $( this ).find( '#bbp_document' ).val() == ''
					&& $( this ).find( '#bbp_video' ).val() == ''
					&& $( this ).find( '#bbp_media_gif' ).val() == ''
					)
					|| (
					$( this ).find( '#bbp_media' ).length > 0
					&& $( this ).find( '#bbp_document' ).length > 0
					&& $( this ).find( '#bbp_video' ).length > 0
					&& $( this ).find( '#bbp_media_gif' ).length <= 0
					&& $( this ).find( '#bbp_media' ).val() == ''
					&& $( this ).find( '#bbp_video' ).val() == ''
					&& $( this ).find( '#bbp_document' ).val() == ''
					)
					|| (
					$( this ).find( '#bbp_media_gif' ).length > 0
					&& $( this ).find( '#bbp_media' ).length <= 0
					&& $( this ).find( '#bbp_document' ).length <= 0
					&& $( this ).find( '#bbp_video' ).length <= 0
					&& $( this ).find( '#bbp_media_gif' ).val() == ''
					)
					) {
						media_valid = false;
					}
					if ( editor &&
						(
							$( $.parseHTML( $( this ).find( '#bbp_reply_content' ).val() ) ).text().trim() === ''
						) &&
						media_valid == false
					) {
						$( this ).find( '.bbp-the-content' ).addClass( 'error' );
						valid = false;
					} else if (
						(
							!editor &&
							$.trim( $( this ).find( '#bbp_reply_content' ).val() ) === ''
						) &&
						media_valid == false
					) {
						$( this ).find( '#bbp_reply_content' ).addClass( 'error' );
						valid = false;
					} else {
						if ( editor ) {
							$( this ).find( '.bbp-the-content' ).removeClass( 'error' );
						}
						$( this ).find( '#bbp_reply_content' ).removeClass( 'error' );
					}
					if ( valid ) {
						bbp_reply_ajax_call( 'reply', window.bbpReplyAjaxJS.reply_nonce, $( this ).serializeArray(), $( this ) );
					} else {
						$( this ).removeClass( 'submitting' );
					}
				}
			);
		}
	}
);

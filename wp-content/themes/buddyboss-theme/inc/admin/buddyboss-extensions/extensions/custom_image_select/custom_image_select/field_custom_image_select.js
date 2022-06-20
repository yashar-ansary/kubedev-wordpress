/* global confirm, redux, redux_change */

/*global redux_change, redux*/

( function ( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || { };
    redux.field_objects.custom_image_select = redux.field_objects.custom_image_select || { };

    $( document ).ready(
        function () {
            //redux.field_objects.custom_image_select.init();
        }
    );

    function coverImageOptionChanged( element ) {

        var parentElem = $( element ).parents( '.redux-main' );

        if ( parentElem.find( '.bb-confirm-dialog-wrapper.cover_image' ).length === 0 ) {
            parentElem.append( '<div class="bb-confirm-dialog-wrapper cover_image"><div class="bb-confirm-dialog-overlay"></div><div class="bb-confirm-dialog">Changing Member Profiles / Social Groups setting will reset all members / groups cover photo position. <div class="bb-button-wrap"><button class="bb-confirm button button-primary" type="button" data-action="confirm">Okay</button></div></div></div>' );
        }

        $( document ).on( 'click', '.cover_image .bb-button-wrap .button', function () {

            $( '.bb-confirm-dialog-wrapper.cover_image' ).remove();

        } );

    }

    //Trigger change for hidden inputs
    MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

    var trackChange = function(element) {
        var observer = new MutationObserver( function(mutations, observer) {
            if(mutations[0].attributeName == "value") {
                coverImageOptionChanged( element );
            }
        });
        observer.observe( element, {
            attributes: true
        });
    }
    
    trackChange( $( '#buddyboss_theme_options-buddyboss_profile_cover_default > #buddyboss_theme_options_buddyboss_profile_cover_default_thumbnail' )[0] );
    trackChange( $( '#buddyboss_theme_options-buddyboss_group_cover_default > #buddyboss_theme_options_buddyboss_group_cover_default_thumbnail' )[0] );

    $( document ).on( 'change', '#buddyboss_profile_cover_width-select, #buddyboss_profile_cover_height-select, #buddyboss_group_cover_width-select, #buddyboss_group_cover_height-select, #buddyboss_theme_options-buddyboss_profile_cover_default > #buddyboss_theme_options_buddyboss_profile_cover_default_thumbnail, #buddyboss_theme_options-buddyboss_group_cover_default > #buddyboss_theme_options_buddyboss_group_cover_default_thumbnail', function(){

        coverImageOptionChanged($(this)[0]);

    });

    redux.field_objects.custom_image_select.init = function ( selector ) {

        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-custom_image_select:visible' );
        }

        $( selector ).each(
            function () {
                var el = $( this );
                var parent = el;
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }
                // On label click, change the input and class
                el.find( '.redux-image-select label img, .redux-image-select label .tiles' ).click(
                    function ( e ) {
                        var id = $( this ).closest( 'label' ).attr( 'for' );

                        $( this ).parents( "fieldset:first" ).find( '.redux-image-select-selected' ).removeClass( 'redux-image-select-selected' ).find( "input[type='radio']" ).attr(
                            "checked", false
                            );
                        $( this ).closest( 'label' ).find( 'input[type="radio"]' ).prop( 'checked' );

                        if ( $( this ).closest( 'label' ).hasClass( 'redux-image-select-preset-' + id ) ) { // If they clicked on a preset, import!
                            e.preventDefault();

                            var presets = $( this ).closest( 'label' ).find( 'input' );
                            var data = presets.data( 'presets' );
                            var merge = presets.data( 'merge' );

                            if ( merge !== undefined && merge !== null ) {
                                if ( $.type( merge ) === 'string' ) {
                                    merge = merge.split( '|' );
                                }

                                $.each( data, function ( index, value ) {
                                    if ( ( merge === true || $.inArray( index, merge ) != -1 ) && $.type( redux.options[index] ) === 'object' ) {
                                        data[index] = $.extend( redux.options[index], data[index] );
                                    }
                                } );
                            }

                            if ( presets !== undefined && presets !== null ) {

                                var parentElem = $( this ).parents( '.redux-main' );

                                if ( parentElem.find( '.bb-confirm-dialog-wrapper' ).length === 0 ) {
                                    parentElem.append( '<div class="bb-confirm-dialog-wrapper"><div class="bb-confirm-dialog-overlay"></div><div class="bb-confirm-dialog">Your current options will be replaced with the values of this preset. Would you like to proceed? <div class="bb-button-wrap"><button class="bb-confirm button button-primary" type="button" data-action="confirm">Yes</button><button class="bb-cancel button" type="button" data-action="cancel">Cancel</button></div></div></div>' );
                                }

                                $( document ).on( 'click', '.bb-button-wrap .button', function () {

                                    var action = $( this ).data( 'action' );
                                    $( '.bb-confirm-dialog-wrapper' ).remove();

                                    if ( action === 'confirm' ) {
                                        el.find( 'label[for="' + id + '"]' ).addClass( 'redux-image-select-selected' ).find( "input[type='radio']" ).attr( "checked", true );
                                        if ( $( '#import-code-value' ).length === 0 ) {
                                            $( this ).append( '<textarea id="import-code-value" style="display:none;" name="' + redux.args.opt_name + '[import_code]">' + JSON.stringify( data ) + '</textarea>' );
                                        } else {
                                            $( '#import-code-value' ).val( JSON.stringify( data ) );
                                        }
                                        if ( $( '#publishing-action #publish' ).length !== 0 ) {
                                            $( '#publish' ).click();
                                        } else {
                                            $( '#redux-import' ).click();
                                        }
                                    } else {

                                    }

                                } );

                            } else {
                            }

                            return false;
                        } else {
                            el.find( 'label[for="' + id + '"]' ).addClass( 'redux-image-select-selected' ).find( "input[type='radio']" ).attr(
                                "checked", true
                                ).trigger( 'change' );

                            redux_change( $( this ).closest( 'label' ).find( 'input[type="radio"]' ) );
                        }
                    }
                );

                // Used to display a full image preview of a tile/pattern
                el.find( '.tiles' ).qtip(
                    {
                        content: {
                            text: function ( event, api ) {
                                return "<img src='" + $( this ).attr( 'rel' ) + "' style='max-width:150px;' alt='' />";
                            },
                        },
                        style: 'qtip-tipsy',
                        position: {
                            my: 'top center', // Position my top left...
                            at: 'bottom center', // at the bottom right of...
                        }
                    }
                );
            }
        );

    };
} )( jQuery );
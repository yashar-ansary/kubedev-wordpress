
jQuery(function($){
	var accountSwitch = $('input#createaccount');
	if(accountSwitch.length){
		accountSwitch.attr( 'checked', true ).parent().hide();
		$( '.create-account' ).show();
		accountSwitch.parent().hide();
	}
});

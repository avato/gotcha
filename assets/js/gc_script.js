jQuery( function ( $ ) {


	var Gotcha = {
	

		// register the click listener
		init: function() {

			if ( $( '.login-remember' ).length >= 1 ){


				$( '.login-remember label' ).append('<span class="gotcha-radio-beautifier"></span>')


			}

		}
		
	}

	// innitiate the function
	Gotcha.init();
});

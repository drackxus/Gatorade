(function( $ ){

	/*
	==============================================
	Scripts Ajax to send mail "Contact"
	==============================================
	*/

	SendForm = function ( idFom ){

		copyHtmlOk = $( '#alertSuccess span' ).html();

		$(idFom).find( ".input_submit" ).attr( 'disabled', 'disabled' );

		if ( $('.printErrors').is(':visible') ) {

			$('.printErrors').fadeOut(0);

		}

		var options = {
				type: "POST"
			,	url: MyAjax.url
			,	dataType: "json"
			,	resetForm: true
			,	beforeSubmit: validate
			,	beforeSend: function(){
					$( '#loader_special' ).fadeIn( 200 );
					$( '#loader_special .expecial_txt_loader' ).html( 'Enviando...' );
				}
			,	success: function( msn ){

					console.log( msn );
					
					if( msn.validate == true ){

						$( '#loader_special' ).fadeOut( 200 );
						$( '.alertOk' ).fadeIn( 0 );

					}else{

						if( msn.htmlErrors ) {
							// Print errors of validation
							$( '.printErrors' ).fadeIn().html( msn.htmlErrors );
						}

						$( '#alertFailSend' ).fadeIn( 200 );
						$( '#loader_special' ).fadeOut( 200 );
					}

			}
			, 	error: function( msn ){

					 console.log( msn );

				}

		}

		$( idFom ).ajaxSubmit( options );

		setTimeout( function(){
			$( '.alertFail' ).fadeOut( 2000, 'swing' );
			$( '.alertOk' ).fadeOut( 4000 );
			$(idFom).find( ".input_submit" ).removeAttr( 'disabled' );

		}, 8000 );

	}
	// Publicamos la funcion paraque sea visible desde afuera
	this.SendForm;

	


})( jQuery );
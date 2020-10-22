(function($){
	$(function(){
	"use strict";

		var makeCopy = function( el, text )
		{

			if ( $( 'textarea#fy-copy-code' ).length > 0 )
			{

				$( 'textarea#fy-copy-code' ).select();

				return false;

			}

			if ( $(this).attr( 'disabled' ) ) return false;

			var that   = $(this),
				code   = el,
				copy   = text,
				addEl  = $(this).parent().prepend( $( '<textarea />',{
					id : 'fy-copy-code'
				})),
				body   = $( 'body' ),
				scroll = body.scrollTop(),
				inp    = $(this).siblings( 'textarea#fy-copy-code' ).text( copy ).select();

			try
			{

				document.execCommand( 'copy' );

				inp.remove();

				$(this).attr( 'disabled', true ).addClass( 'disabled' ).text( enscPHPmb.copied );

				setTimeout(function()
				{

					that.removeAttr('disabled').removeClass('disabled').text( enscPHPmb.copy );

				},3500);

			}

			catch( err )
			{

					code.css({ border:'none', padding:0 }).html( inp );

				inp.css( 'height', inp[0].scrollHeight ).select();

				$(this).attr('disabled',true).addClass('disabled').text( enscPHPmb.desc );

				body.scrollTop( scroll );

			}
		}

		$( 'a#ensc-copy' ).on( 'click', function( e )
		{

			e.preventDefault();

			var code = $(this).parent().prev(),
				copy = code.find( 'code' ).text(),
				args = [ code, copy ];

				makeCopy.apply( $(this), args );

			return false;

		});

	});
}(jQuery));

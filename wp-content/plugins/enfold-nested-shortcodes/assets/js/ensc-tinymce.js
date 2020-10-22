(function($){
	"use strict";
	$(function()
	{

		tinymce.create( 'tinymce.plugins.enscShortcode',
		{

			init: function( editor, url )
			{

				var titles = JSON.parse( enscPHPtmce.titles ),
					values = [ { text: enscPHPtmce.value, value: false } ];

					if ( titles.length > 0 )
					{

						for ( var key in titles )
						{
							values.push( { text: titles[key], value: titles[key] } );
						}
					}

					else
					{

						values.push( { text: enscPHPtmce.empty, value: 'empty' } );
					}

				editor.addButton( 'ensc_button',
				{
					image   : enscPHPtmce.image,
					tooltip : enscPHPtmce.header,
					onclick : function()
					{
						editor.execCommand( 'ensc_shortcode_popup', '',
						{
							shortcode : '',
							checkbox  : ''
						});
					}
				});

				editor.addCommand( 'ensc_shortcode_popup', function( ui, v )
				{
					editor.windowManager.open(
					{
						id      : 'ensc-panel',
						classes : 'ensc-panel',
						title   : enscPHPtmce.header,
						body:
						[
							{
								type: 'container',
    							html: '<div style="max-width:430px;">' + enscPHPtmce.desc + '</div>'
    						},
							{
								id      : 'ensc-floatpanel',
								classes : 'ensc-floatpanel',
								type    : 'listbox',
								name    : 'title',
								'values': values,
							},
						],
						onsubmit: function( e )
						{
							var title, output;

							title = false == e.data.title ? '' : e.data.title;

							if ( title )
							{

								if ( 'empty' == title ) return;

								output = '[' + enscPHPtmce.prefix + ' title="' + title + '"]';

								editor.insertContent( output );
							}
						}
					});
			    });
			},

			createControl : function( n, cm )
			{
	               return null;
	        },
		});

		tinymce.PluginManager.add( 'ensc_shortcodes', tinymce.plugins.enscShortcode );

	});
}(jQuery));

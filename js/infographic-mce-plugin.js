/**
 * Infographic
 *
 * TinyMCE plugin
 */

// Infographic elements
var elements = [
	{
		name: 'Pie Chart',
		id: 'pie-chart',
		fields: [
			{
				type: 'textbox',
				name: 'multilineName',
				label: 'Multiline Text Box',
				value: 'You can say a lot of stuff in here',
				multiline: true,
				minWidth: 300,
				minHeight: 100				
			}
		]
	},
	{
		name: 'Progress Bar',
		id: 'progress-bar',
		fields: [
			{
				type: 'textbox',
				name: 'multilineName',
				label: 'Multiline Text Box',
				value: 'You can say a lot of stuff in here',
				multiline: true,
				minWidth: 300,
				minHeight: 100				
			}
		]
	},
];

// TinyMCE button and popup form
(function() {
	tinymce.PluginManager.add('infographic_mce_button', function( editor, url ) {
		editor.addButton( 'infographic_mce_button', {
			text: 'Infographic',
			icon: 'icon dashicons dashicons-chart-pie',
			type: 'button',
			tooltip: 'Insert Infographic Element',
			onclick: function() {
				editor.windowManager.open( {
					title: 'Insert Infographic Element',
					resizable: true,
					body: [
					{
						type: 'listbox',
						name: 'listboxName',
						label: 'List Box',
						'values': [
						{text: 'Option 1', value: '1'},
						{text: 'Option 2', value: '2'},
						{text: 'Option 3', value: '3'}
						]
					},
					{
						type: 'textbox',
						name: 'textboxName',
						label: 'Text Box',
						value: '30'
					},
					{
						type: 'textbox',
						name: 'multilineName',
						label: 'Multiline Text Box',
						value: 'You can say a lot of stuff in here',
						multiline: true,
						minWidth: 300,
						minHeight: 100
					}
					
					],
					onsubmit: function( e ) {
						editor.insertContent( '[random_shortcode textbox="' + e.data.textboxName + '" multiline="' + e.data.multilineName + '" listbox="' + e.data.listboxName + '"]');
					}
				});
			}
		});
	});
})();
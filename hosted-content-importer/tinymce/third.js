/**
 * Inserts an icon to use [third] tag
 */
(function() {
	tinymce.create('tinymce.plugins.HCIThirdShortcode', {
		init: function(editor, url) {
			editor.addCommand('addHCIThirdShortcode', function() {
				editor.insertContent('[third source="" id="" section=""]');
			});
			editor.addButton('third', {
				title: '[third] template',
				image: url + '/third.png',
				cmd: 'addHCIThirdShortcode'
			});
		}
	});

	tinymce.PluginManager.add('third', tinymce.plugins.HCIThirdShortcode);
})();

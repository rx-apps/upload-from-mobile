// noinspection ES6ConvertVarToLetConst

(function ($) {
	$(document).ready(function () {
		var editor_sequence = $('[data-editor-sequence]').attr('data-editor-sequence');
		startRefreshFileList(editor_sequence);
	});
}) (jQuery);

// noinspection ES6ConvertVarToLetConst

(function ($) {
	$(document).ready(function () {
		$('form[editor_sequence]').each(function () {
			var $input = $('<input type="hidden" name="editor_sequence" value="" />');
			$input.attr('value', $(this).attr('editor_sequence'));
			$input.prependTo($(this));
		});
	});
}) (jQuery);

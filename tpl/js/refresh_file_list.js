// noinspection ES6ConvertVarToLetConst

(function ($) {
	function replaceExecJson () {
		var tempExecJson = $.exec_json;
		$.exec_json = function (a, b, c, d) {
			return tempExecJson(a, b, function (res) {
				if (a !== 'file.getFileList') {
					return c(res);
				}

				var editor_sequence = res.editor_sequence;
				var $container = $('#xefu-container-' + editor_sequence);
				var data = $container.data();

				var selectors = [];
				$.each(res.files, function(idx, file) {
					selectors.push('[data-file-srl="' + file.file_srl + '"]');
				});
				data.settings.fileList.find('ul').find('li:not(' + selectors.join('):not(') + ')').remove();

				return c(res);
			}, d);
		};	
	}
	
	function startRefreshFileList (editor_sequence) {
		replaceExecJson();
		watchFileRefreshing(function () {
			reloadUploader(editor_sequence);
		});
		
		return true;
	}
	
	window.startRefreshFileList = startRefreshFileList;
}) (jQuery);

// noinspection ES6ConvertVarToLetConst

(function ($) {
	$(document).ready(function () {
		var $btn = $('.app-upload-from-mobile-button').appendTo('.xefu-dropzone');
		$btn.on('click', function () {
			var editor_sequence = $(this).closest('[editor_sequence]').attr('editor_sequence');
			getQrUrl(editor_sequence, function (url) {
				var screenLeft = typeof window.screenLeft != 'undefined' ? window.screenLeft : screen.left;
				var screenTop = typeof window.screenTop != 'undefined' ? window.screenTop : screen.top;
				var screenWidth = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
				var screenHeight = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
				
				var popupWidth = 360;
				var popupHeight = 480;
				var left = ((screenWidth / 2) - (popupWidth / 2)) + screenLeft;
				var top = ((screenHeight / 2) - (popupHeight / 2)) + screenTop;

				window.open(
					url,
					'_upload_from_mobile',
					'width=' + popupWidth + ', height=' + popupHeight + ', left=' + left + ', top=' + top + ', scrollbars=no, location=no, toolbars=no, status=no'
				);
			});
		});
	});
}) (jQuery);

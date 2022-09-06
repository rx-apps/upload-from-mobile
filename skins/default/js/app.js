// noinspection ES6ConvertVarToLetConst

(function ($) {
	$(document).ready(function () {
		var $qrBody = $('#app-upload-from-mobile-qr-body');
		if ($qrBody.length !== 0) {
			var $text = $('[data-expires-in-text]');
			var expiresIn = parseInt($text.attr('data-expires-in'));
			var expiresInText = $text.attr('data-expires-in-text');
			
			var interval = setInterval(function () {
				expiresIn--;
				if (expiresIn < 0) {
					clearInterval(interval);
					$qrBody.addClass('expired');
					return;
				}
				
				$text.html(expiresInText.replace('%s', expiresIn));
			}, 1000);
		}
	});
}) (jQuery);

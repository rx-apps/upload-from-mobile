// noinspection ES6ConvertVarToLetConst

(function ($) {
	$(document).ready(function () {
		function watchFileRefreshing (cb) {
			setInterval(function () {
				cb();
			}, 5000);
		}
		
		window.watchFileRefreshing = watchFileRefreshing;
	});
}) (jQuery);

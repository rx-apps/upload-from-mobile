// noinspection ES6ConvertVarToLetConst

(function ($) {
	$(document).ready(function () {
		function replaceExecJson () {
			var previousFiles = null;
			
			var tempExecJson = $.exec_json;
			$.exec_json = function (a, b, c, d) {
				return tempExecJson(a, b, function (res) {
					if (a !== 'file.getFileList') {
						return c(res);
					}
					if(previousFiles && previousFiles.length === res.files.length) {
						return;
					}
					
					var session_id = window.uploadFromMobileSessionId ? window.uploadFromMobileSessionId : current_url.getQuery('session_id');
					var fetch_url = 'https://ntfy.sh/' + btoa(default_url + '_' + session_id).substring(0, 32);
					fetch(fetch_url, { method: 'POST', body: '' }).then(function () {});
					previousFiles = res.files;
					
					return c(res);
				}, d);
			};
		}
		
		function watchFileRefreshing (cb) {
			replaceExecJson();
			
			var session_id = window.uploadFromMobileSessionId ? window.uploadFromMobileSessionId : current_url.getQuery('session_id');
			var socket_url = 'wss://ntfy.sh/' + btoa(default_url + '_' + session_id).substring(0, 32) + '/ws';
			
			var socket = new WebSocket(socket_url);
			socket.addEventListener('message', function (e) {
				cb();
			});
		}

		window.watchFileRefreshing = watchFileRefreshing;
	});
}) (jQuery);

// noinspection ES6ConvertVarToLetConst

(function () {
	var reloaders = {};
	
	function insertSession (editor_sequence, callback_success, callback_error) {
		exec_json('upload_from_mobile.procUpload_from_mobileInsertSession', {
			mid: current_mid,
			editor_sequence: editor_sequence
		}, function (data) {
			callback_success(data);
			return true;
		}, function (error) {
			callback_error(error);
			return true;
		});
	}
	
	function getQrUrl (editor_sequence, callback_success, callback_error) {
		insertSession(editor_sequence, function (data) {
			if (typeof callback_success != 'function') {
				return;
			}
			
			// noinspection JSUnresolvedVariable
			callback_success(data.qr_url);
			
			// noinspection JSUnresolvedVariable
			window.uploadFromMobileSessionId = data.session_id;

			if (typeof reloaders[editor_sequence] != 'undefined') {
				return;
			}
			reloaders[editor_sequence] = startRefreshFileList(editor_sequence);
		}, function (error) {
			if (typeof callback_error != 'function') {
				return;
			}
			callback_error(error);
		});
	}

	window.uploadFromMobileSessionId = null;
	window.getQrUrl = getQrUrl;
}) ();

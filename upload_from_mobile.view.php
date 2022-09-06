<?php

use Rhymix\Framework\Exceptions\DBError;

class Upload_from_mobileView extends Upload_from_mobile
{
	/**
	 * 초기화 시 호출됩니다.
	 * 
	 * @return void
	 */
	public function init()
	{
		$config = $this->getConfig();
		$skin = $config->skin ?: 'default';
		$this->setTemplatePath(__DIR__ . '/skins/' . $skin);
	}

	/**
	 * 업로드 링크를 담은 QR코드를 출력하는 메뉴입니다.
	 * 
	 * @return void
	 */
	public function dispUpload_from_mobileQr()
	{
		$mid = Context::get('mid');
		$session_id = Context::get('session_id');
		$session_url = getNotEncodedFullUrl('', 'mid', $mid, 'act', 'dispUpload_from_mobileSession', 'session_id', $session_id);
		Context::set('session_url', $session_url);
		
		$oModel = $this->getModel();
		$qrcode_url = $oModel->getQrCodeUrl($session_url);
		Context::set('qrcode_url', $qrcode_url);
		
		$config = $this->getConfig();
		Context::set('config', $config);
		
		Context::set('layout', 'none');
		$this->setTitle();
		$this->setTemplateFile('qr');
	}

	/**
	 * 실제 업로드를 진행하는 메뉴입니다.
	 *
	 * @return void
	 * @throws DBError
	 */
	public function dispUpload_from_mobileSession()
	{
		Context::set('layout', 'none');
		$this->setTitle();

		$session_id = Context::get('session_id');
		$oModel = $this->getModel();
		$session = $oModel->getSession($session_id);
		if(!$session)
		{
			$this->setTemplateFile('error');
			return;
		}
		
		if($session->expires_at < date('YmdHis'))
		{
			$oController = $this->getController();
			$oController->deleteSession($session_id);
			
			$this->setTemplateFile('error');
			return;
		}
		
		$oEditorModel = EditorModel::getInstance();
		$oEditorModel->getModuleEditor('upload_from_mobile', $this->module_srl, $session->upload_target_srl, '', '');
		
		$oTemplateHandler = TemplateHandler::getInstance();
		$file_uploader = $oTemplateHandler->compile(realpath(__DIR__ . '/../editor/skins/ckeditor'), 'file_upload');
		Context::set('file_uploader', $file_uploader);

		$editor_sequence = Context::get('editor_sequence');
		Context::loadFile([ __DIR__ . '/tpl/js/refresh_file_list.js', 'body', '', null ], true);
		Context::loadFile([ __DIR__ . '/tpl/js/watch_file_refreshing/ntfy.js', 'body', '', null ], true);
		Context::loadFile([ __DIR__ . '/tpl/js/trigger_mobile_refresher.js', 'body', '', null ], true);

		$this->setTemplateFile('session');
	}

	/**
	 * 브라우저 제목을 설정합니다.
	 * 
	 * @return void
	 */
	private function setTitle()
	{
		$seo_title = config('seo.document_title') ?: '$SITE_TITLE - $DOCUMENT_TITLE';
		$seo_title = Context::replaceUserLang($seo_title);
		Context::setBrowserTitle($seo_title, [
			'site_title' => Context::getSiteTitle(),
			'site_subtitle' => Context::getSiteSubtitle(),
			'subpage_title' => $this->module_info->browser_title,
			'document_title' => Context::getLang('upload_from_mobile_btn_upload_from_mobile')
		]);
	}
}

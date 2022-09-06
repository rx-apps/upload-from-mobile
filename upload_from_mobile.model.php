<?php

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Rhymix\Framework\Exceptions\DBError;

class Upload_from_mobileModel extends Upload_from_mobile
{
	/**
	 * 설정에 따라 QR코드를 생성합니다.
	 * 
	 * @param string $url
	 * @return string
	 */
	public function getQrCodeUrl(string $url): string
	{
		$config = $this->getConfig();
		$qr_generating_type = $config->qr_generating_type;
		
		if($qr_generating_type == 'google_api')
		{
			return $this->createQrCodeAsGoogleApi($url);
		}

		return $this->createQrCodeAsBase64($url);
	}
	
	/**
	 * QR코드를 생성하여 Base64 URI를 반환합니다.
	 * 
	 * @param string $url
	 * @return string
	 */
	private function createQrCodeAsBase64(string $url): string
	{
		require_once __DIR__ . '/vendor/autoload.php';

		$qr_options = new QROptions();
		$qr_options->outputType = 'svg';
		$qr_options->svgWidth = $qr_options->svgHeight = 525;
		$qr_options->addQuietzone = false;

		$qr_client = new QRCode($qr_options);
		return $qr_client->render($url);
	}

	/**
	 * 구글 차트 API를 이용하여 QR코드 URI를 획득합니다.
	 * 
	 * @param string $url
	 * @return string
	 */
	private function createQrCodeAsGoogleApi(string $url): string
	{
		return 'https://chart.googleapis.com/chart?cht=qr&chs=525x525&chld=L|0&chl=' . urlencode($url);
	}

	/**
	 * 에디터가 로드되었는지 확인합니다.
	 * 
	 * @return bool
	 */
	public function isEditorLoaded(): bool
	{
		$js_files = Context::getJsFile();
		foreach($js_files as $js_file)
		{
			if(strpos($js_file['file'], '/modules/editor/tpl/js/editor_common.js') !== false)
			{
				return true;
			}
		}
		
		return false;
	}

	/**
	 * 세션을 가져옵니다.
	 * 
	 * @param string $session_id
	 * @return mixed
	 * @throws DBError
	 */
	public function getSession(string $session_id)
	{
		$output = executeQuery('upload_from_mobile.getSession', [
			'session_id' => $session_id
		]);
		
		if(!$output->toBool())
		{
			throw new DBError($output->getMessage());
		}
		
		return $output->data;
	}
}

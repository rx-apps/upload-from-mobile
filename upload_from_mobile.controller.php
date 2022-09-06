<?php

use Rhymix\Framework\Exceptions\DBError;
use Rhymix\Framework\Exceptions\NotPermitted;

class Upload_from_mobileController extends Upload_from_mobile
{
	/**
	 * 화면 출력 전 에디터가 로드되었는지 확인하고, 버튼 템플릿을 추가합니다.
	 * 
	 * @param string $output
	 * @return bool
	 */
	public function triggerDisplayBefore(string &$output): bool
	{
		if(Context::get('act') == 'dispUpload_from_mobileSession')
		{
			return true;
		}
		
		$oModel = $this->getModel();
		if(!$oModel->isEditorLoaded())
		{
			return true;
		}
		
		$config = $this->getConfig();
		$skin = $config->skin ?: 'default';
		$skin_path = __DIR__ . '/skins/' . $skin;
		
		$oTemplateHandler = TemplateHandler::getInstance();
		$compiled = $oTemplateHandler->compile($skin_path, 'button');
		Context::addHtmlFooter($compiled);
		
		Context::loadFile([ __DIR__ . '/tpl/js/append_editor_sequence.js', 'body', '', null ], true);
		Context::loadFile([ __DIR__ . '/tpl/js/get_qr_url.js', 'body', '', null ], true);
		Context::loadFile([ __DIR__ . '/tpl/js/refresh_file_list.js', 'body', '', null ], true);
		Context::loadFile([ __DIR__ . '/tpl/js/watch_file_refreshing/ntfy.js', 'body', '', null ], true);

		return true;
	}

	/**
	 * 모듈 처리가 끝나면 호출됩니다.
	 * 
	 * @throws DBError
	 */
	public function triggerModuleProcAfter($obj): bool
	{
		$config = $this->getConfig();
		$finalizing_acts = /*explode("\n", $config->finalizing_acts) ?:*/ [ 'procBoardInsertDocument' ];
		foreach($finalizing_acts as $finalizing_act)
		{
			if($obj->act == $finalizing_act)
			{
				$editor_sequence = Context::get('editor_sequence');
				if(!$_SESSION['upload_info'][$editor_sequence]->enabled)
				{
					return true;
				}
				
				$upload_target_srl = $_SESSION['upload_info'][$editor_sequence]->upload_target_srl;
				$this->deleteSessionByUploadTargetSrl($upload_target_srl);
			}
		}
		
		return true;
	}

	/**
	 * 업로드 세션을 생성하는 메뉴입니다.
	 *
	 * @return void
	 * @throws NotPermitted
	 * @throws DBError
	 */
	public function procUpload_from_mobileInsertSession()
	{
		$editor_sequence = Context::get('editor_sequence');
		if(!$_SESSION['upload_info'][$editor_sequence]->enabled)
		{
			throw new NotPermitted();
		}

		$upload_target_srl = $_SESSION['upload_info'][$editor_sequence]->upload_target_srl;
		if(!$upload_target_srl)
		{
			$upload_target_srl = getNextSequence();
			$_SESSION['upload_info'][$editor_sequence]->upload_target_srl = $upload_target_srl;
		}

		$session_id = \Rhymix\Framework\Security::getRandomUUID();
		$this->insertSession($session_id, $upload_target_srl);
		
		$this->add('session_id', $session_id);
		$this->add('qr_url', getNotEncodedFullUrl('', 'mid', $this->mid, 'act', 'dispUpload_from_mobileQr', 'session_id', $session_id));
		$this->setMessage('success');
	}

	/**
	 * 세션을 등록합니다.
	 * 
	 * @param string $session_id
	 * @param int $upload_target_srl
	 * @return bool
	 * @throws DBError
	 */
	public function insertSession(string $session_id, int $upload_target_srl): bool
	{
		$config = $this->getConfig();
		$expires_in = $config->expires_in;
		if($expires_in > 0)
		{
			$expires_at = date('YmdHis', strtotime('+' . $expires_in . 'seconds'));
		}
		
		$output = executeQuery('upload_from_mobile.insertSession', [
			'session_id' => $session_id,
			'upload_target_srl' => $upload_target_srl,
			'expires_at' => $expires_at ?? null,
			'regdate' => date('YmdHis')
		]);
		
		if(!$output->toBool())
		{
			throw new DBError($output->getMessage());
		}
		
		return true;
	}

	/**
	 * 세션을 삭제합니다.
	 *
	 * @param string $session_id
	 * @return bool
	 * @throws DBError
	 */
	public function deleteSession(string $session_id): bool
	{
		$output = executeQuery('upload_from_mobile.deleteSession', [
			'session_id' => $session_id
		]);

		if(!$output->toBool())
		{
			throw new DBError($output->getMessage());
		}

		return true;
	}

	/**
	 * 업로드 대상 SRL을 기준으로 세션을 삭제합니다.
	 * 
	 * @param int $upload_target_srl
	 * @return bool
	 * @throws DBError
	 */
	public function deleteSessionByUploadTargetSrl(int $upload_target_srl): bool
	{
		$output = executeQuery('upload_from_mobile.deleteSessionByUploadTargetSrl', [
			'upload_target_srl' => $upload_target_srl
		]);

		if(!$output->toBool())
		{
			throw new DBError($output->getMessage());
		}

		return true;
	}
}

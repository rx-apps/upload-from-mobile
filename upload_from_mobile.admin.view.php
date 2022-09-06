<?php

class Upload_from_mobileAdminView extends Upload_from_mobile
{
	/**
	 * @var array 관리자 상단 메뉴
	 */
	protected static $_menus = [
		// [ string $menu_lang_key, [ string $act, string ...$sub_act ], (bool) $visibility = true ]
		[ 'upload_from_mobile_admin_menu_index', [ 'dispUpload_from_mobileAdminIndex' ] ]
	];

	/**
	 * 초기화 시 호출됩니다.
	 * 
	 * @return void
	 */
	public function init()
	{
		Context::set('menus', self::$_menus);
		$this->setTemplatePath(__DIR__ . '/tpl');
	}

	/**
	 * 메뉴의 출력 여부를 설정합니다.
	 *
	 * @param int $menu_index
	 * @param bool $visibility
	 * @return bool
	 */
	private function setMenuVisibility(int $menu_index, bool $visibility): bool
	{
		if(!isset(self::$_menus[$menu_index]))
		{
			return false;
		}

		self::$_menus[$menu_index][2] = $visibility;
		Context::set('menus', self::$_menus);

		return true;
	}

	/**
	 * 메뉴를 보이게 설정합니다.
	 *
	 * @param int $menu_index
	 * @return bool
	 */
	private function setMenuVisible(int $menu_index): bool
	{
		return $this->setMenuVisibility($menu_index, true);
	}

	/**
	 * 메뉴를 보이지 않게 설정합니다.
	 *
	 * @param int $menu_index
	 * @return bool
	 */
	private function setMenuInvisible(int $menu_index): bool
	{
		return $this->setMenuVisibility($menu_index, false);
	}

	/**
	 * 대시보드 역할을 하는 메인 메뉴입니다.
	 * 
	 * @return void
	 * @noinspection PhpUnused
	 */
	public function dispUpload_from_mobileAdminIndex()
	{
		$oAdminModel = $this->getAdminModel();
		
		$current_version = $oAdminModel->getCurrentVersion();
		Context::set('current_version', $current_version);
		
		$github_version = $oAdminModel->getGithubVersion();
		Context::set('github_version', $github_version);
		
		$is_github_updated = version_compare($current_version, $github_version, '>=');
		Context::set('is_github_updated', $is_github_updated);
		
		$github_url = $oAdminModel->getGithubUrl();
		Context::set('github_url', $github_url);
		
		$config = $this->getConfig();
		Context::set('config', $config);
		
		$oModuleModel = ModuleModel::getInstance();
		$skin_list = $oModuleModel->getSkins($this->module_path);
		Context::set('skin_list', $skin_list);
		
		$this->setTemplateFile('index');
	}
}

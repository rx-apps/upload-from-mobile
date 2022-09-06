<?php

class Upload_from_mobileAdminController extends Upload_from_mobile
{
	public function procUpload_from_mobileAdminIndex()
	{
		$vars = Context::getRequestVars();
		$vars->expires_in = $vars->expires_in ?? 0;
		$this->setConfig($vars);
		
		$this->setMessage('success_updated');
		$this->setRedirectUrl(getNotEncodedUrl('', 'module', 'admin', 'act', 'dispUpload_from_mobileAdminIndex'));
	}
}

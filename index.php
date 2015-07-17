<?php

/*
 * Copyright (C) 2002-2013 AfterLogic Corp. (www.afterlogic.com)
 * Distributed under the terms of the license described in LICENSE
 *
 */

class_exists('CApi') or die();

class CAboutPlugin extends AApiPlugin
{
	/**
	 * @param CApiPluginManager $oPluginManager
	 */
	public function __construct(CApiPluginManager $oPluginManager)
	{
		parent::__construct('1.0', $oPluginManager);
	}

	public function Init()
	{
		parent::Init();

		$this->SetI18N(true);
		$this->AddJsFile('js/CAboutViewModel.js');
		$this->AddTemplate('AboutTemplate', 'templates/AboutTemplate.html');

		$this->AddJsonHook('AjaxPluginGetAjaxData', 'AjaxPluginGetAjaxData');
	}

	public function AjaxPluginGetAjaxData()
	{
		// fake delay
		sleep(1);
		
		$oAccount = $this->oPluginManager->Actions()->GetCurrentAccount();
		
		return array(
			'Email' => $oAccount->Email,
			'Data' => 'Version: '.PSEVEN_APP_VERSION
		);
	}
}

return new CAboutPlugin($this);

<?php

class Promotion extends MX_Controller
{
	private $js;
	private $css;
	
	private $language;
	
	const MODULE_NAME			= 'promotion';
	const MODULE_PATH 			= 'modules/promotion';
	
	function __construct()
	{
		parent::__construct();
		
		$this->user->userArea();
		
		// Set JS and CSS paths
		$this->js 	= self::MODULE_PATH . "/js/promotion.js";
		$this->css 	= self::MODULE_PATH . "/css/promotion.css";
		
		$this->load->model("promotion_model");
		$this->load->config(self::MODULE_NAME . '/promotion_config');
		
		// Format the language strings
		$this->language = $this->config->item('cta_language');
		
		
		if ($this->user->getAccountStatus() != 'Active')
		{
			$this->BannedPage();
			die;
		}
	}
	
	/**
	 * Initialize
	 */
	public function index()
	{		
		requirePermission("use_cta");
		
		$this->template->setTitle($this->language['TITLE']);

		//$external = $this->external_account_model->getInfo($this->user->getId(), "last_ip");
		
		// Prepare the compitable realms
		$CompitableRealms = array();
		foreach ($this->realms->getRealms() as $realmData)
		{
			$CompitableRealms[] = array('id' => $realmData->getId(), 'name' => $realmData->getName(), 'characters' => $this->GetMyCharacters($realmData->getId()));
		}
		unset($realmData);
		
		if (empty($CompitableRealms))
		{
			$this->ErrorPage();
			return;
		}
		
		// Get the first compitable realm
		$FirstRealm = $CompitableRealms[0];
		
		// Set the page data
		$pageData = array(
			"url" 				=> $this->template->page_url,
			"first_realm"		=> $FirstRealm,
			"realms" 			=> $CompitableRealms,
			"cta_lang"			=> $this->language
		);
		
		unset($CompitableRealms, $FirstRealm);
		
		$pageTpl = $this->template->loadPage("promotion.tpl", $pageData);

		$data = array(
			"module" => "default", 
			"headline" => $this->language['TITLE'],
			"content" => $pageTpl
		);

		$page = $this->template->loadPage("page.tpl", $data);
		
		$keywords = $this->language['KEYWORDS'];
		$description = $this->language['DESCRIPTION'];
		
		$this->template->setDescription($description);
		$this->template->setKeywords($keywords);

		$this->template->view($page, $this->css, $this->js);
	}
	
	public function success($realmId = 1, $character = 'unknown', $account = 'unknown')
	{
		requirePermission("use_cta");
		
		// format the variables
		$character = preg_replace("/[^a-zA-z0-9_-]/", "", ucfirst(strtolower($character)));
		$account = preg_replace("/[^a-zA-z0-9_-]/", "", ucfirst(strtolower($account)));
		$realm = $this->realms->getRealm($realmId)->getName();
		
		$this->template->setTitle($this->language['TITLE']);
		
		// Fomat the success language message
		$this->language['SUCCESS_MSG'] = str_replace(array('[CHARACTER]', '[REALM_NAME]', '[ACCOUNT]'), array($character, $realm, $account), $this->language['SUCCESS_MSG']);
		
		// Set the page data
		$pageData = array(
			"url" 				=> $this->template->page_url,
			"realm"				=> $realm,
			"character"			=> $character,
			"account"			=> $account,
			"cta_lang"			=> $this->language
		);
		
		$pageTpl = $this->template->loadPage("promotion_success.tpl", $pageData);

		$data = array(
			"module" => "default", 
			"headline" => $this->language['TITLE'],
			"content" => $pageTpl
		);

		$page = $this->template->loadPage("page.tpl", $data);
		
		$keywords = $this->language['KEYWORDS'];
		$description = 'The character ' . $character . ' from realm '.$realm.' has been successfully transferred to account '.$account.'.';
		
		$this->template->setDescription($description);
		$this->template->setKeywords($keywords);

		$this->template->view($page, $this->css, false);
	}
	
	private function ErrorPage()
	{
		$this->template->setTitle("An error occured!");

		$data = array(
			"module" => "default", 
			"headline" => 'An error occured!', 
			"content" => "<center style='margin:10px;font-weight:bold;'>This module cannot work with no realms.</center>"
		);

		$page = $this->template->loadPage("page.tpl", $data);

		$this->template->view($page);
	}
	
	private function BannedPage()
	{
		$this->template->setTitle("An error occured!");

		$data = array(
			"module" => "default", 
			"headline" => 'An error occured!', 
			"content" => "<center style='margin:10px;font-weight:bold;'>" . (isset($this->language['BANNED_MSG']) ? $this->language['BANNED_MSG'] : 'Your account is banned!') . "</center>"
		);

		$page = $this->template->loadPage("page.tpl", $data);

		$this->template->view($page);
	}
	
	public function process()
	{
		requirePermission("use_cta");
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$max_character = $this->language['MAX_CHARACTERS'];
		$ally = $this->language['ALLY_PERMITED'];
		$horde = $this->language['HORDE_PERMITED'];
		
		// Get the post variables
		$RealmId = (int)$this->input->post('realmId');
		$Character = $this->input->post('character');
		
		// Get the realm object
		if (!($realmObj = $this->realms->getRealm($RealmId)))
		{
			die($this->language['ERROR_REALM']);
		}
		if($ally == 0 && $horde == 0)
		{
			die($this->language['PROMOTION_DISABLED']);
		}
		
		// Make sure the character exists and get the GUID
		if (!($GUID = $realmObj->getCharacters()->getGuidByName($Character)))
		{
			die($this->language['ERROR_CHARACTER']);
		}
		
		// Make sure the character belongs to this account
		if (!$realmObj->getCharacters()->characterBelongsToAccount($GUID, $this->user->getId()))
		{
			die($this->language['ERROR_BELONGS']);
		}
		
		// Check if the character is online
		if ($realmObj->getCharacters()->isOnline($GUID))
		{
			die($this->language['ERROR_ONLINE']);
		}
		if($this->promotion_model->totalCharacters($RealmId, $this->user->getId() ) > 0 )
		{
			die($this->language['ERROR_PROMOTION']);
		}
		if($this->promotion_model->countAccbyip($RealmId, $this->user->getLastIp()) >= $max_character)
		{
			die($this->language['ERROR_MAX_ACC']);
		}

		if($realmObj->getCharacters()->getFaction($GUID) == 1)
		{
			if($ally == 1)
			{
				if($this->promotion_model->setPromotion($GUID, $this->user->getId(), $RealmId))
				{
					// Coordenadas para promoción ally
					// Parameters
					// setLocation($x, $y, $z, $o, $mapId, $characterGuid, $realmConnection);
					$this->promotion_model->setLocation(-8833.379883, 628.627991, 100.006599, 1.065350, 0, $GUID, $RealmId);
					die('OK');
				}
				else
					// failure
					die($this->language['ERROR_WEB_FAIL']);

			}
			else
				die($this->language['ALLY_ERROR']);
			
		}
		else
		{
			if($horde == 1)
			{
				if($this->promotion_model->setPromotion($GUID, $this->user->getId(), $RealmId))
				{
					// Coordenadas para promoción Horda
					// Parameters
					// setLocation($x, $y, $z, $o, $mapId, $characterGuid, $realmConnection);
					$this->promotion_model->setLocation(1629.359985, -4373.390137, 36.256399, 3.548390, 1, $GUID, $RealmId);
					die('OK');
				}
				else
					// failure
					die($this->language['ERROR_WEB_FAIL']);
				
			}
			else
				die($this->language['HORDE_ERROR']);
		}
			
			// Log this transfer
			//$this->promotion_model->InsertLog($GUID, ucfirst(strtolower($Character)), $DestAccID, ucfirst(strtolower($destination)), $RealmId, $Price, $PriceCurrency, $StartCurrency, $EndCurrency);
	}
	
	private function GetMyCharacters($realmId)
	{
		if ($this->user->isOnline())
		{
			$CharObj = $this->realms->getRealm($realmId)->getCharacters();
			
			//Open the connection to the databases
			$CharObj->connect();
			
			// Get our characters in this realm
			return $CharObj->getCharactersByAccount($this->user->getId());
		}
		
		return false;
	}
}

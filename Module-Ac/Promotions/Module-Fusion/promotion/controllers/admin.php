<?php

class Admin extends MX_Controller
{	
	public function __construct()
	{
		// Make sure to load the administrator library!
		$this->load->library('administrator');
		$this->load->model("promotion_model");
		
		parent::__construct();

		requirePermission("canViewAdmin");
	}

	public function index()
	{
		$CompitableRealms = array();
		foreach ($this->realms->getRealms() as $realmData)
		{
			$CompitableRealms[] = array('id' => $realmData->getId(), 'name' => $realmData->getName());
		}
		unset($realmData);
		
		if (empty($CompitableRealms))
		{
			return;
		}
		
		// Get the first compitable realm
		$FirstRealm = $CompitableRealms[0];
		// Change the title
		$this->administrator->setTitle("Promociones");

		$arrayRaw = $this->promotion_model->getPromotion($FirstRealm['id']);

		if($arrayRaw)
		{
			foreach($arrayRaw as $k => $v)
			{
				$guid = $arrayRaw[$k]["guid"];
				$idACC = $arrayRaw[$k]["account"];
				$arrayRaw[$k]["guid"] = $this->promotion_model->getNameByGuid($FirstRealm['id'], $guid);
				$arrayRaw[$k]["account"] = $this->promotion_model->getNameAccount($idACC);
			}
		}

		// Prepare my data
		$data = array(
			'url' => $this->template->page_url,
			'promotions' => $arrayRaw,
			'realms' => $this->realms->getRealms(),
			'firstRealm' => $FirstRealm['id']
		);

		// Load my view
		$output = $this->template->loadPage("admin.tpl", $data);

		// Put my view in the main box with a headline
		$content = $this->administrator->box('Promociones', $output);

		// Output my content. The method accepts the same arguments as template->view
		$this->administrator->view($content, false, "modules/promotion/js/admin.js");
	}
	public function delete($id = false, $realm)
	{
		requirePermission("canDelete");
		if(!$id || !is_numeric($id))
		{
			die();
		}

		$this->promotion_model->delete($id, $realm);
	}
}
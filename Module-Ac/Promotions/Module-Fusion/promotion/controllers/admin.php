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
		// Change the title
		$this->administrator->setTitle("Promociones");

		// Prepare the compitable realms
		$CompitableRealms = array();

		foreach ($this->realms->getRealms() as $realmData)
		{
			$CompitableRealms[] = array('id' => $realmData->getId(), 'name' => $realmData->getName());
		}
		
		if (empty($CompitableRealms))
		{
			return;
		}

		// Prepare my data
		$data = array(
			'url' => $this->template->page_url,
			'realms' => $CompitableRealms,
			'tokenName' => $this->security->get_csrf_token_name(),
			'tokenValue' => $this->security->get_csrf_hash()
		);

		// Load my view
		$output = $this->template->loadPage("adminIndex.tpl", $data);

		// Put my view in the main box with a headline
		$content = $this->administrator->box('Promociones', $output);

		// Output my content. The method accepts the same arguments as template->view
		$this->administrator->view($content, false, "modules/promotion/js/admin.js");
	}
	public function viewRealm()
	{
		// Change the title
		$this->administrator->setTitle("Promociones");
		// Get the post variables
		$RealmId = (int)$this->input->post('realmId');
		$arrayRaw = $this->promotion_model->getPromotion($RealmId);

		if($arrayRaw)
		{
			foreach($arrayRaw as $k => $v)
			{
				$guid = $arrayRaw[$k]["guid"];
				$idACC = $arrayRaw[$k]["account"];
				$arrayRaw[$k]["guid"] = $this->promotion_model->getNameByGuid($RealmId, $guid);
				$arrayRaw[$k]["account"] = $this->promotion_model->getNameAccount($idACC);
			}
		}

		// Prepare my data
		$data = array(
			'url' => $this->template->page_url,
			'promotions' => $arrayRaw,
			'RealmId' => $RealmId,
			'RealmName' => $this->realms->getRealm($RealmId)->getName()
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
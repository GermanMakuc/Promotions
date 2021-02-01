<?php

class Promotion_model extends CI_Model
{
	public function getConnection()
	{
		$this->connect();

		return $this->connection;
	}
	
	public function connect()
	{
		if(empty($this->connection))
		{
			$this->connection = $this->load->database("account", true);
		}
	}
	
	public function getPromotion($realmConnection)
	{
		$db = $this->realms->getRealm($realmConnection)->getCharacters()->getConnection();
		$query = $db->query("SELECT * FROM character_promotion");
		
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return $result;
		}
		
		unset($query);
		
		return false;
	}
	public function getNameByGuid($Realm, $guid)
	{
		$db = $this->realms->getRealm($Realm)->getCharacters()->getConnection();
		$query = $db->query("SELECT name FROM characters WHERE guid = ?", array( $guid ));
		
		if($query->num_rows() > 0)
		{
			$row = $query->result_array();

			return $row[0]['name'];
		}
		
		unset($query);
		
		return "Desconocido";
	}
	public function getNameAccount($id)
	{
		$this->connect();
		
		$this->connection->select("username")->from(table("account"))->where(array(column("account", "id") => $id));
		$query = $this->connection->get();
		
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return $result[0]['username'];

		}
			unset($query);
			return "Desconocido";
	}
	public function delete($id, $realmConnection)
	{
		$db = $this->realms->getRealm($realmConnection)->getCharacters()->getConnection();
		$db->query("DELETE FROM character_promotion WHERE id = ?", array( $id ));
	}
	public function countAccbyip($realmId, $ip)
	{
		$count = 0;
		$this->connect();
		$this->connection->select("id,username")->from(table("account"))->where(array(column("account", "last_ip") => $ip));
		$query = $this->connection->get();

		if($query->num_rows() > 0)
		{
			$result = $query->result_array();

			foreach($result as $value)
			{
				$db = $this->realms->getRealm($realmId)->getCharacters()->getConnection();
				$q = $db->query("SELECT * FROM characters WHERE account = ? AND level >= 80", array( $value['id'] ));
				$count = $count + $q->num_rows();
			}
		
			return $count;
		}
		else 
		{
			return $count;
		}
	}
	public function setPromotion($guid, $account, $realmId)
	{
		$db = $this->realms->getRealm($realmId)->getCharacters()->getConnection();
		
		$query = $db->query(" INSERT INTO `character_promotion` (`guid`, `account`, `realm`) VALUES (?,?,?);", array($guid, $account, $realmId));
		
		if ($query)
		{
			return true;
		}
		
		return false;
	}

	 public function totalCharacters($realm, $account_id)
    {
        $db = $this->realms->getRealm($realm)->getCharacters()->getConnection();
        $q = $db->query("SELECT * FROM character_promotion WHERE account = ? AND entregado = 0", array( $account_id ));
        return $q->num_rows();
    }
    public function setLocation($x, $y, $z, $o, $mapId, $characterGuid, $realmConnection)
	{
		$db = $this->realms->getRealm($realmConnection)->getCharacters()->getConnection();
		$query = $db->query("UPDATE ".table("characters")." SET ".column("characters", "position_x")." = ?, ".column("characters", "position_y")." = ?, ".column("characters", "position_z")." = ?, ".column("characters", "orientation")." = ?, ".column("characters", "map")." = ? WHERE ".column("characters", "guid")." = ?", array($x, $y, $z, $o, $mapId, $characterGuid));
		
		if ($query)
		{
			return true;
		}
		
		return false;
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class WelcomeModel extends CI_Model
{
	
	public function LastDepositEndCashOut($Type)
	{
		$this->db->from("db_stat_coin");
		$this->db->where("sType", $Type);
		$this->db->where("sStatus", 1);
		$this->db->limit(20);
		$this->db->order_by("sUid", "DESC");
		$this->db->join("db_users", "db_users.uUid = db_stat_coin.sUserId");
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	public function ListCoinsFromCalculate()
	{
		$query = $this->db->where("cOnline", '1')->get("db_coin");
		return $query->result();
	}
	
	
	public function ListNews()
	{
		return $this->db->order_by("nUid", "DESC")->limit(10)->get("db_news")->result();
	}
	
	
	
}
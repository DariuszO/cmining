<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class CallbackModel extends CI_Model
{

	public function UpdateBalanceUserDeposit($Coin, $Wallet, $TxId, $Amount)
	{
		$this->db->trans_start();
		$query1 = $this->db->where("sTxId", $TxId)->get("db_stat_coin");
		
		$query = $this->db->where("bWallet", $Wallet)->get("db_user_balance");
		if($query->num_rows() == 1 && $query1->num_rows() == 0)
		{
			
			$this->db->set("bBalance", "bBalance + " . $Amount, FALSE);
			$this->db->where("bWallet", $Wallet);
			$this->db->update("db_user_balance");
			
			$row = $query->row_array();
			
			$arr = array("sUserId" => $row['bUserId'], "sType" => 1, "sAmount" => $Amount, "sTxId" => $TxId, "sDateAdd" => time(), "sCoin" => $Coin, "sStatus" => 1);
			$this->db->insert("db_stat_coin", $arr);
			
			$this->db->where("seNameCoin", $Coin);
			$this->db->set("seAmount", "seAmount + " . $Amount, FALSE);
			$this->db->update("db_stats_enter");
			
			$this->db->trans_complete();
		}
		
	}	
	
	
	public function UpdateBalanceUserFromPayeer($Uid, $Amount, $UserId)
	{
		$this->db->trans_start();
		$query = $this->db->where("cAbbr", "USD")->get('db_coin');
		$rows = $query->row_array();
		
		
		$this->db->where("ipUid", $Uid);
		$this->db->update("db_insert_payeer", array("ipStatus" => 1));
		
		$this->db->where("bUserId", $UserId);
		$this->db->where("bUidCoin", $rows['cUid']);
		$this->db->set("bBalance", "bBalance + " . $Amount, FALSE);
		$this->db->update("db_user_balance");
		
		$arr = array("sUserId" => $UserId, "sType" => 1, "sAmount" => $Amount, "sTxId" => $Uid, "sDateAdd" => time(), "sCoin" => "USD", "sStatus" => 1);
		$this->db->insert("db_stat_coin", $arr);
		
		$this->db->where("seNameCoin", $rows['cAbbr']);
		$this->db->set("seAmount", "seAmount + " . $Amount, FALSE);
		$this->db->update("db_stats_enter");
		$this->db->trans_complete();
		return TRUE;
	}
	
	
	
	public function InfoTransactionPayeer($Uid)
	{
		$query = $this->db->where("ipUid", $Uid)->get("db_insert_payeer");
		if($query->num_rows() == 1) return $query->row_array();
		return FALSE;
	}
	
}
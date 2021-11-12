<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Model
{
	
	
	public function ListCoins()
	{
		$query = $this->db->order_by("cUid", "asc")->get("db_coin");
		return $query->result();
	}
	
	
	public function SetCoins($CoinUid)
	{
		$query = $this->db->where("cUid", $CoinUid)->get("db_coin");
		if($query->num_rows() == 1)
		{
			$row = $query->row_array();
			
			if($row['cOnline'] == 1) 
			{
				$On = 0;
				$Act = 1;
			}
			else 
			{
				$On = 1;
				$Act = 2;
			}
			
			$this->db->where("cUid", $CoinUid);
			if($this->db->update("db_coin", array("cOnline" => $On))) return $Act;
			return FALSE;
		}
		else
			return FALSE;
	}
	
	
	
	public function ChangeMinAmountCoins($Amount, $Coin)
	{
		$this->db->where("cUid", $Coin);
		if($this->db->update("db_coin", array("cMinimum" => $Amount))) return TRUE;
		return FALSE;
	}
	
	
	
	public function ListUsers($num, $offset)
	{
		$query = $this->db->order_by("uUid", "DESC")->get("db_users", $num, $offset);
		return $query->result();
	}
	
	
	public function ListUsersOne($Uid)
	{
		$this->db->where("uUid", $Uid);
		$query = $this->db->get("db_users");
		return $query->row_array();
	}

	
	public function ListCoinsBalanceUsers($Uid)
	{
		$this->db->select('*');
		$this->db->from("db_user_balance");
		$this->db->where("bUserId", $Uid);
		$this->db->join("db_coin", "db_coin.cUid = db_user_balance.bUidCoin");
		//$this->db->where("db_coin.cOnline", 1);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	public function UpdateBalanceUsers($Uid, $Amount, $UidCoin)
	{
		$this->db->where("bUserId", $Uid);
		$this->db->where('bUid', $UidCoin);
		$this->db->set("bBalance", $Amount, FALSE);
		if($this->db->update("db_user_balance")) return TRUE;
		return FALSE;
	}
	
	
	public function CountPartnersUser($Uid)
	{
		$query = $this->db->where("uRefId", $Uid)->get("db_users");
		return (int)$query->num_rows();
	}
	
	
	public function ListCashOutUser($Uid)
	{
		/*
		$this->db->where("sUserId", $Uid);
		$this->db->where("sType", 2);
		$this->db->where("sStatus", 1);
		$query = $this->db->get("db_stat_coin");
		return $query->result();
		*/
		$this->db->where("bUserId", $Uid);
		$query = $this->db->get("db_user_balance");
	}
	
	
	public function ListEnterUser($Uid)
	{
		$this->db->where("sUserId", $Uid);
		$this->db->where("sType", 1);
		$this->db->where("sStatus", 1);
		$query = $this->db->get("db_stat_coin");
		return $query->result();
	}
	
	
	public function ListExchangeUsers($Uid)
	{
		$this->db->where("hUserId", $Uid);
		$this->db->order_by("hUid", "DESC");
		$query = $this->db->get("db_hystory_user");
		return $query->result();
	}
	
	
	
	public function ListTikets()
	{
		$query = $this->db->order_by("tUid", "DESC")->get("db_ticket");
		return $query->result();
	}
	
	
	public function InfoTicketFromAdmin($Uid)
	{
		$this->db->from("db_ticket");
		$this->db->where("tUid", $Uid);
		$this->db->join("db_ticket_info", "db_ticket_info.tiUidTicket = db_ticket.tUid");
		$query = $this->db->get();
		return $query->result();
	}
	
	
	public function AddOtvetToTicket($Uid, $Text)
	{
		
		$this->db->trans_start();
	
		$Arr_2 = array(
					"tiUidTicket" => $Uid,
					"tiLogin" => 'Support',
					"tiText" => $Text,
					"tiDateAdd" => time()
		
				);
				
		$this->db->insert("db_ticket_info", $Arr_2);
		
		
		$this->db->where("tUid", $Uid);
		$this->db->update("db_ticket", array("tRead" => 1));
		
		
		$this->db->trans_complete();
		
		if($this->db->trans_status() !== FALSE) return TRUE;
		return FALSE;
		
	}
	
	
	public function CountTicketRead()
	{
		$query = $this->db->where("tRead", 0)->get("db_ticket");
		return $query->num_rows();
	}
	
	
	
	public function CountUsers()
	{
		$query = $this->db->get("db_users");
		return $query->num_rows();
	}
	
	
	public function CountCashOutAndEnter($Type, $Status)
	{
		$query = $this->db->where("sType", $Type)->where("sStatus", $Status)->get("db_stat_coin");
		return $query->num_rows();
	}
	
	
	public function ListCoinEnter()
	{
		$query = $this->db->get("db_stats_enter");
		return $query->result();
	}
	
	
	public function ListCoinCashOut()
	{
		$query = $this->db->get("db_stats_cashout");
		return $query->result();
	}
	
	
	public function ListCahOutFull()
	{
		$this->db->from("db_stat_coin");
		$this->db->where("sType", 2);
		$this->db->where("sStatus", 0);
		$this->db->join("db_users", "db_users.uUid = db_stat_coin.sUserId");
		$query = $this->db->get();
		return $query->result();
	}
	
	/**
	* Удаляем выплату
	* @param undefined $Uid
	* 
	* @return
	*/
	public function DeleteCashOutId($Uid)
	{
		$this->db->where("sUid", $Uid);
		$this->db->delete("db_stat_coin");
	}
	
	
	/**
	* Выплачиваем и обновляем статус
	* @param undefined $Uid
	* 
	* @return
	*/
	public function SendCashOutId($Uid)
	{
		$query = $this->db->where("sUid", $Uid)->where("sStatus", 0)->get("db_stat_coin");
		if($query->num_rows() == 1)
		{
			$rowCoin = $query->row_array();
			
			if($rowCoin['sCoin'] != 'USD')
			{
				//Выплата криптовалюты
				include_once(APPPATH . 'libraries/coinpayments.inc.php');
				$WmRush = new CoinPaymentsAPI();
				$WmRush->Setup($this->config->item('PrivateAPIkey'), $this->config->item('PublicAPIkey'));
				$Payment = $WmRush->CreateWithdrawal($rowCoin['sAmount'], $rowCoin['sCoin'], $rowCoin['sWallet'], $this->config->item('AutoConfirmWithdraw'));
				if($Payment['error'] == 'ok')
				{
					$this->db->where("sUid", $Uid);
					$this->db->update("db_stat_coin", array("sStatus" => 1));
					
					$this->db->where("scNameCoin", $rowCoin['sCoin']);
					$this->db->set("scAmount", "scAmount + " . $rowCoin['sAmount'], FALSE);
					$this->db->update("db_stats_cashout");
					return TRUE;
					
				}
				else
					return FALSE;
			}
			elseif($rowCoin['sCoin'] == 'USD')
			{
				//Payeer.com
				require_once(APPPATH . '/libraries/cpayeer.php');
				$payeer = new CPayeer($this->config->item('WalletPayeerFromAutoPay'), $this->config->item('UidPayeerApi'), $this->config->item('SecretKeyPayeerApi'));
				if ($payeer->isAuth())
				{
					$arTransfer = $payeer->transfer(array(
						'curIn' => 'USD',
						'sum' => $rowCoin['sAmount'],
						'curOut' => 'USD',
						'to' => $rowCoin['sWallet'],
						
					));
					if (empty($arTransfer['errors']))
					{
						$this->db->where("sUid", $Uid);
						$this->db->update("db_stat_coin", array("sStatus" => 1));
						
						$this->db->where("scNameCoin", $rowCoin['sCoin']);
						$this->db->set("scAmount", "scAmount + " . $rowCoin['sAmount'], FALSE);
						$this->db->update("db_stats_cashout");
						return TRUE;
					}
					else
						return FALSE;
				}
				else
					return FALSE;					
			}
			else
				 return FALSE;			
		}
		return FALSE;
	}
	
	
	
	public function ListCahOutFullList($num, $offset)
	{
		$this->db->from("db_stat_coin");
		$this->db->where("sType", 2);
		$this->db->where("sStatus", 1);
		$this->db->order_by("sUid", "DESC");
		$this->db->join("db_users", "db_users.uUid = db_stat_coin.sUserId");
		$query = $this->db->get("", $num, $offset);
		return $query->result();
	}
	
	public function ListInsertFullList($num, $offset)
	{
		$this->db->from("db_stat_coin");
		$this->db->where("sType", 1);
		$this->db->where("sStatus", 1);
		$this->db->order_by("sUid", "DESC");
		$this->db->join("db_users", "db_users.uUid = db_stat_coin.sUserId");
		$query = $this->db->get("", $num, $offset);
		return $query->result();
	}
	
	
	
}
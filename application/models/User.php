<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Model
{
	
	/**
	* Данные юзера
	* 
	* @return
	*/
	public function InfoUserAccount()
	{
		$query = $this->db->where("uUid", $this->session->UserId)->get("db_users");
		if($query->num_rows() == 1) return $query->row_array();
		
		
		
		return FALSE;
	}
	
	
	/**
	* Стоимость валюты по отношению к биткоину
	* @param undefined $Miner
	* 
	* @return
	*/
	public function ViewPriceFromMinerUser($Miner)
	{
		$query = $this->db->where("cAbbr", $Miner)->get("db_coin");
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}
		return FALSE;
	}
	
	
	/**
	* Список валют
	* 
	* @return
	*/
	public function ListCoins()
	{
		$query = $this->db->order_by("cUid", "asc")->where("cOnline", 1)->get("db_coin");
		return $query->result();
	}
	
	/**
	* Список валют юзера
	* 
	* @return
	*/
	public function ListCoinsUsers()
	{
		$this->db->select('*');
		$this->db->from("db_user_balance");
		$this->db->where("bUserId", $this->session->UserId);
		$this->db->join("db_coin", "db_coin.cUid = db_user_balance.bUidCoin");
		$this->db->where("db_coin.cOnline", 1);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	/**
	* Включение нужной валюты для юзера
	* @param undefined $UidCoin
	* 
	* @return
	*/
	public function SetCoins($UidCoin)
	{
		
        
        $this->db->trans_start();
		$query = $this->db->where("bUidCoin", $UidCoin)->where("bUserId", $this->session->UserId)->get("db_user_balance");
		
		if($query->num_rows() > 0) return FALSE;
		
		$array = array(
					"bUserId" => $this->session->UserId,
					"bUidCoin" => $UidCoin,
					"bBalance" => 0.0000000,
					"bStatus" => 1
				);
		if($this->db->insert("db_user_balance", $array)) 
		{
			$this->db->trans_complete();
			return TRUE;
		}
		
		return FALSE;
		
	}
	
	
	/**
	* Смена валюты майнинга
	* @param undefined $Uid
	* 
	* @return
	*/
	public function SetMinerd($Uid)
	{
		if($Uid == 1990)
		{
			$this->db->where("uUid", $this->session->UserId);
			if($this->db->update("db_users", array("uMiner" => 'GHS', "uLastTime" => time()))) return TRUE;
			return FALSE;
		}
		else
		{
			$query = $this->db->where("cUid", $Uid)->where("cOnline", 1)->get("db_coin");
			if($query->num_rows() == 1)
			{
				$user = $this->db->where("bUidCoin", $Uid)->where("bUserId", $this->session->UserId)->get("db_user_balance");
				if($user->num_rows() == 1)
				{
					$row = $query->row_array();
					$this->db->where("uUid", $this->session->UserId);
					if($this->db->update("db_users", array("uMiner" => $row['cAbbr'], "uLastTime" => time()))) return TRUE;
					return FALSE;
				}
				return FALSE;
			}
		}
		
		return FALSE;
	}
	
	
	/**
	* Обновление баланса при майнинге
	* @param undefined $Amount
	* @param undefined $Val
	* 
	* @return
	*/
	public function UpdateBalanceMining($Amount, $Val)
	{
		
		if($Val != 'GHS')
		{
			$query = $this->db->where("cAbbr", $Val)->get("db_coin");
			$row = $query->row_array();
			$this->db->trans_start();
			$this->db->where("bUserId", $this->session->UserId);
			$this->db->where("bUidCoin", $row['cUid']);
			$this->db->set("bBalance", "bBalance + " . $Amount, FALSE);
			$this->db->update("db_user_balance");
			$this->db->trans_complete();
		}
		else
		{
			$this->db->trans_start();
			$this->db->where("uUid", $this->session->UserId);
			$this->db->set("uBalanceGHS", "uBalanceGHS + " . $Amount, FALSE);
			$this->db->update("db_users");
			$this->db->trans_complete();
		}
		
		
		$this->db->where("uUid", $this->session->UserId);
		$this->db->update("db_users", array("uLastTime" => time()));
	}
	
	
	/**
	* Проверка на существование валюты
	* @param undefined $Coin
	* 
	* @return
	*/
	public function CheckCoinUsers($Coin)
	{
		$query = $this->db->where("cAbbr", $Coin)->where("cOnline", 1)->get("db_coin");
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}
		return FALSE;
	}
	
	
	/**
	* Существование валюты у юзера
	* @param undefined $Coin
	* 
	* @return
	*/
	public function CheckCoinOnlineUser($Coin)
	{
		$query = $this->db->where("bUidCoin", $Coin)->where("bUserId", $this->session->UserId)->get("db_user_balance");
		if($query->num_rows() == 1) return $query->row_array();
		return FALSE;
	}
	
	
	
	/**
	* Добавление кошелька для депозита выбранному юзеру
	* @param undefined $Wallet
	* @param undefined $Coin
	* @param undefined $DestTag
	* 
	* @return
	*/
	public function UpdateWallet($Wallet, $Coin, $DestTag = '')
	{
		$this->db->where("bUserId", $this->session->UserId);
		$this->db->where("bUidCoin", $Coin);
		if($this->db->update("db_user_balance", array("bWallet" => $Wallet, "bDestTag" => $DestTag))) return TRUE;
		return FALSE;
	}
	
	
	/**
	* Баланы юзера где баланс больше нуля
	* 
	* @return
	*/
	public function ListCoinsUserBalanceNotNull()
	{
		$this->db->from("db_user_balance");
		$this->db->where("bBalance >= ", 0);
		$this->db->where("bUserId", $this->session->UserId);
		$this->db->join("db_coin", "db_coin.cUid = db_user_balance.bUidCoin");
		$this->db->where("db_coin.cOnline", 1);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	/**
	* Список валют разрешенных для обмена
	* 
	* @return
	*/
	public function ExchangeCoinSuccess($Uid)
	{
		$this->db->from("db_user_balance");
		$this->db->where("bUidCoin != ", $Uid);
		$this->db->where("bUserId", $this->session->UserId);
		$this->db->join("db_coin", "db_coin.cUid = db_user_balance.bUidCoin");
		$this->db->where("db_coin.cOnline", 1);
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	public function CheckCoinExchange($Coin)
	{
		$query = $this->db->where("cAbbr", $Coin)->where("cOnline", 1)->get("db_coin");
		if($query->num_rows() == 1) return $query->row_array();
		return FALSE;
	}
	
	
	public function CheckBalanceCoinExcange($Coin)
	{
		$query = $this->db->where("bUserId", $this->session->UserId)->where("bUidCoin", $Coin)->get("db_user_balance");
		if($query->num_rows() == 1) return $query->row_array();
		return FALSE;
	}
	
	
	public function ExchangeComplites($Name1, $Name2, $Amount1, $Amount2, $Uid1, $Uid2)
	{
		$this->db->trans_start();
		$this->db->where("bUserId", $this->session->UserId);
		$this->db->where("bUidCoin", $Uid1);
		$this->db->set("bBalance", "bBalance - " . $Amount1, FALSE);
		$this->db->update("db_user_balance");
		
		$this->AddMoneyParters($Amount1, $Uid1, $Name1);
		
		if($Name2 == 'GHS')
		{
			$Text = 'Exchange: <font color="red">' . $Amount1 . ' ' .$Name1 . '</font> => <font color="green">' . $Name2 . ' ' . $Amount2 . '</font>';
			$this->ReadHistoryFromUser($this->session->UserId, $Text);
			$this->db->where("uUid", $this->session->UserId);
			$this->db->set("uBalanceGHS", "uBalanceGHS + " . $Amount2, FALSE);
			if($this->db->update("db_users"))
			{
				$this->db->trans_complete();
				return TRUE;
			}
		}
		else
		{
			$Text = 'Exchange: <font color="red">' . $Amount1 . ' ' .$Name1 . '</font> => <font color="green">' . $Name2 . ' ' . $Amount2 . '</font>';
			$this->ReadHistoryFromUser($this->session->UserId, $Text);
			$this->db->where("bUserId", $this->session->UserId);
			$this->db->where("bUidCoin", $Uid2);
			$this->db->set("bBalance", "bBalance + " . $Amount2, FALSE);
			if($this->db->update("db_user_balance"))
			{
				$this->db->trans_complete();
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	
	private function AddMoneyParters($Amount, $UidCoin, $NameCoin)
	{
		$query = $this->db->where("uUid", $this->session->UserId)->get("db_users");
		$row = $query->row_array();
		
		if($row['uRefId'] != 0)
		{
			$RefMoney = $Amount * ($this->config->item('PercentPartners') / 100);
			$this->db->where("bUserId", $row['uRefId']);
			$this->db->where("bUidCoin", $UidCoin);
			$this->db->set("bBalance", "bBalance + " . $RefMoney, FALSE);
			$this->db->update("db_user_balance");
			
			$Arr = array(
			
					"hrUserId" => $row['uRefId'],
					"hrRefId" => $this->session->UserId,
					"hrCoin" => $NameCoin,
					"hrAmount" => $RefMoney,
					"hrDateAdd" => date("d.m.Y H:i")
					
					);
			$this->db->insert("db_history_ref_balance", $Arr);
		}
		
	}
	
	
	private function ReadHistoryFromUser($UserId, $Text)
	{
		$this->db->insert("db_hystory_user", array("hUserId" => $UserId, "hDateAdd" => date("d.m.Y H:i"), "hText" => $Text));
	}
	
	
	
	public function BalanceFromUserNotNull($Uid)
	{
		$this->db->where("cAbbr", $Uid);
		$this->db->where("cOnline", 1);
		$query = $this->db->get("db_coin");
		
		if($query->num_rows() == 1)
		{
			$rowCoin = $query->row_array();
			
			$User = $this->db->where("bUserId", $this->session->UserId)->where("bUidCoin", $rowCoin['cUid'])->get("db_user_balance");
			
			if($User->num_rows() == 1) return $User->row_array();
			return FALSE;
		}
	}
	
	
	
	public function BalanceWithdraw($Amount, $Wallet, $Curr)
	{
		$this->db->where("cAbbr", $Curr);
		$this->db->where("cOnline", 1);
		$query = $this->db->get("db_coin");
		
		if($query->num_rows() == 1)
		{
			$rowCoin = $query->row_array();
			$this->db->trans_start();
			$this->db->where("bUserId", $this->session->UserId);
			$this->db->where("bUidCoin", $rowCoin['cUid']);
			$this->db->set("bBalance", "bBalance - " . $Amount, FALSE);
			if($this->db->update("db_user_balance"))
			{
				
				
				$this->db->trans_complete();
				return TRUE;
			}
			return FALSE;
		}
	}
	
	
	public function ReturnBalanceUser($Amount, $Curr)
	{
		$this->db->where("cAbbr", $Curr);
		$this->db->where("cOnline", 1);
		$query = $this->db->get("db_coin");
		
		if($query->num_rows() == 1)
		{
			$rowCoin = $query->row_array();
			$this->db->trans_start();
			$this->db->where("bUserId", $this->session->UserId);
			$this->db->where("bUidCoin", $rowCoin['cUid']);
			$this->db->set("bBalance", "bBalance + " . $Amount, FALSE);
			if($this->db->update("db_user_balance"))
			{
				$this->db->trans_complete();
				return TRUE;
			}
			return FALSE;
		}
	}
	
	
	public function MinAmountWithdraw($Curr)
	{
		$query = $this->db->where("cAbbr", $Curr)->where("cOnline", 1)->get("db_coin");
		if($query->num_rows() == 1) return $query->row_array();
		return FALSE;
	}
	
	
	
	public function InsertHistoryPayCoin($Amount, $TxId, $Coin, $Status = 0, $Wallet)
	{
		$arr = array("sUserId" => $this->session->UserId, "sType" => 2, "sAmount" => $Amount, "sTxId" => $TxId, "sDateAdd" => time(), "sCoin" => $Coin, "sWallet" => $Wallet, "sStatus" => $Status);
		$this->db->insert("db_stat_coin", $arr);
		
		
		if($Status == 1)
		{
			//$this->db->trans_start();
		
			$this->db->where("scNameCoin", $Coin);
			$this->db->set("scAmount", "scAmount + " . $Amount, FALSE);
			$this->db->update("db_stats_cashout");
			
			//$this->db->trans_complete();
		}
		
		
	}
	
	
	public function UpdateProfileUserFromData($Fio = '', $Skype = '', $City = '', $Country = '')
	{
		$this->db->where("uUid", $this->session->UserId);
		if($this->db->update("db_users", array("uFIO" => $Fio, "uSkype" => $Skype, "uCity" => $City, "uCountry" => $Country))) return TRUE;
		return FALSE;
	}
	
	
	
	public function ChangePassword($Pass)
	{
		$this->db->where("uUid", $this->session->UserId);
		$this->db->update("db_users", array("uPassword" => $Pass));
	}
	
	
	
	public function InsertTicketUser($Theme, $Text)
	{
		$this->db->trans_start();
		
		$Arr_1 = array(
					"tUserId" => $this->session->UserId,
					"tTheme" => $Theme,
					"tDateAdd" => time(),
					"tRead" => 0 //0 - Для админа не прочитано, 1 - Для юзера не прочитано		
				);
		$this->db->insert("db_ticket", $Arr_1);
		$__LID = $this->db->insert_id();
		
		
		$Arr_2 = array(
					"tiUidTicket" => $__LID,
					"tiLogin" => $this->session->Login,
					"tiText" => $Text,
					"tiDateAdd" => time()
		
				);
				
		$this->db->insert("db_ticket_info", $Arr_2);
		$this->db->trans_complete();
		
		if($this->db->trans_status() !== FALSE) return TRUE;
		return FALSE;
	}
	
	
	public function ListTicketUser()
	{
		$query = $this->db->order_by("tUid", "DESC")->where("tUserId", $this->session->UserId)->get("db_ticket");
		return $query->result();
	}
	
	
	public function ExistTicketUser($Uid)
	{
		$query = $this->db->where("tUid", $Uid)->where("tUserId", $this->session->UserId)->get("db_ticket");
		if($query->num_rows() == 1) return TRUE;
		return FALSE;
	}
	
	
	public function ListTicketInfoFromUser($Uid)
	{
		$this->db->from("db_ticket");
		$this->db->where("tUserId", $this->session->UserId);
		$this->db->where("tUid", $Uid);
		$this->db->join("db_ticket_info", "db_ticket_info.tiUidTicket = db_ticket.tUid");
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	public function AddOtvetToTicket($Uid, $Text)
	{
		if($this->ExistTicketUser($Uid))
		{
			$this->db->trans_start();
		
			$Arr_2 = array(
						"tiUidTicket" => $Uid,
						"tiLogin" => $this->session->Login,
						"tiText" => $Text,
						"tiDateAdd" => time()
			
					);
					
			$this->db->insert("db_ticket_info", $Arr_2);
			
			
			$this->db->where("tUid", $Uid);
			$this->db->where("tUserId", $this->session->UserId);
			$this->db->update("db_ticket", array("tRead" => 0));
			
			
			$this->db->trans_complete();
			
			if($this->db->trans_status() !== FALSE) return TRUE;
			return FALSE;
		}
		return FALSE;
	}
	
	
	
	
	public function ListPartners($Count = FALSE, $Num = 0, $Offset = 0)
	{
		if($Count == TRUE)
		{
			
			$query = $this->db->where("uRefId", $this->session->UserId)->get("db_users");
			return $query->num_rows();
			
		}

		$query = $this->db->where("uRefId", $this->session->UserId)->get("db_users", $Num, $Offset);
			
		return $query->result();
	}
	
	
	public function InfoRefModal($RefId)
	{
		$query = $this->db->where("uUid", $RefId)->get("db_users");
		
		if($query->num_rows() == 0) return FALSE;
		
		$row = $query->row_array();
		
		if($row['uRefId'] != $this->session->UserId) return FALSE;
		
		$query_1 = $this->db->limit(50)->order_by("hrUid", "DESC")->where("hrUserId", $this->session->UserId)->where("hrRefId", $RefId)->get("db_history_ref_balance");
		if($query_1->num_rows() > 0)
			return $query_1->result();
		
	}
	
	
	
	/**
	* Заносим инфу в базу о пополнении через Payeer.com
	*/
	public function InsertPayeer($Amount)
	{
		//$this->db->trans_start();
		$this->db->insert("db_insert_payeer", array("ipUserId" => $this->session->UserId, "ipLogin" => $this->session->Login, "ipAmount" => $Amount, "ipWallet" => '', "ipDate" => date("d.m.Y H:i")));
		//$this->db->trans_complete();
		
		return $this->db->insert_id();
		
		return FALSE;
	}
	
	
	public function CountListExchange()
	{
		$query = $this->db->where("hUserId", $this->session->UserId)->get("db_hystory_user");
		return $query->num_rows();
	}
	
	
	public function ListHistoryExchange($num, $offset)
	{
		$query = $this->db->order_by("hUid", "DESC")->where("hUserId", $this->session->UserId)->get("db_hystory_user", $num, $offset);
		return $query->result();
	}
	
	
	public function HistoryPay($Num, $Offset)
	{
		$query = $this->db->where("sUserId", $this->session->UserId)->where("sType", 2)->get("db_stat_coin", $Num, $Offset);
		return $query->result();
	}
	
	public function CountHistoryPayment()
	{
		$query = $this->db->where("sUserId", $this->session->UserId)->where("sType", 2)->get("db_stat_coin");
		return $query->num_rows();
	}
	
}
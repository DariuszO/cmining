<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Callback extends CI_Controller
{
	
	/**
	* Обработка платежей по криптовалюте
	* 
	* @return
	*/
	public function Result()
	{
		if($this->input->post('address') && $this->input->post('txn_id') && $this->input->post('currency') && $this->input->post('amount') && $this->input->post('ipn_type') == 'deposit')
		{
			error_log(print_r($_POST, true), 3, 'status.txt'); 
			if($this->input->post('confirms') >= 2)
			{
				$this->CallbackModel->UpdateBalanceUserDeposit($this->input->post('currency'), $this->input->post('address'), $this->input->post('txn_id'), $this->input->post('amount'));
			}
		}
	}
	
	
	/**
	* Обработка платежей по Payeer.com
	* 
	* @return
	*/
	public function ResultPayeer()
	{
		//echo $_SERVER['REMOTE_ADDR'];
		// Отклоняем запросы с IP-адресов, которые не принадлежат Payeer
		//error_log('Hash OK', 3, 'status.txt');  
		if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) return;
		if ($this->input->post('m_operation_id') && $this->input->post('m_sign'))
		{
			
			$this->db->insert("db_log_payeer", array("logBatch" => $this->input->post('m_operation_id')));
			
			$m_key = $this->config->item('SecretKeyPayeerMerchant');
			 // Формируем массив для генерации подписи
			$arHash = array(
				$this->input->post('m_operation_id'),
				$this->input->post('m_operation_ps'),
				$this->input->post('m_operation_date'),
				$this->input->post('m_operation_pay_date'),
				$this->input->post('m_shop'),
				$this->input->post('m_orderid'),
				$this->input->post('m_amount'),
				$this->input->post('m_curr'),
				$this->input->post('m_desc'),
				$this->input->post('m_status'),
				$m_key
			);
			
			 // Добавляем в массив секретный ключ
			//$arHash[] = $m_key;
			 // Формируем подпись
			$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
			
			
			$query = $this->db->where("logBatch", $this->input->post('m_operation_id'))->get("db_log_payeer");
			if($query->num_rows() > 1) exit($this->input->post('m_orderid').'|error');
			
			 // Если подписи совпадают и статус платежа “Выполнен”
			if ($this->input->post('m_sign') == $sign_hash && $this->input->post('m_status') == 'success')
			{
				//error_log('Hash OK', 3, 'status.txt');  
			 	if($row = $this->CallbackModel->InfoTransactionPayeer($this->input->post('m_orderid')))
			 	{
					//error_log('Transaction OK', 3, 'status.txt');  
					if($row['ipAmount'] == $this->input->post('m_amount') && $this->input->post('m_curr') == 'USD')
					{
						//error_log('Value OK', 3, 'status.txt');  
						if($this->CallbackModel->UpdateBalanceUserFromPayeer($this->input->post('m_orderid'), $this->input->post('m_amount'), $row['ipUserId']))
						{
							//error_log('All OK', 3, 'status.txt');  
							exit($this->input->post('m_orderid').'|success');
						}
						else
						{
							exit($this->input->post('m_orderid').'|error');
						}
					}
					else
					{
						exit($this->input->post('m_orderid').'|error');
					}
				}
				else
				{
					exit($this->input->post('m_orderid').'|error');
				}
			}
			
			 // В противном случае возвращаем ошибку
			 exit($this->input->post('m_orderid').'|error');
		}

	}
	
	
	
	public function UpdateTxHash()
	{
		//echo 'aaa';
		$query = $this->db->where("sType", 2)->where("sTxStatus", 0)->get("db_stat_coin");
		if($query->num_rows() > 0)
		{
			include_once(APPPATH . 'libraries/coinpayments.inc.php');
			$WmRush = new CoinPaymentsAPI();
			$WmRush->Setup($this->config->item('PrivateAPIkey'), $this->config->item('PublicAPIkey'));
			foreach($query->result() as $List)
			{	
				
				if(is_numeric($List->sTxId)) continue;
			
				$Payment = $WmRush->TxInfo($List->sTxId);
				//echo $List->sTxId;
				//var_dump($Payment);
				if($Payment['error'] == 'ok' && $Payment['result']['status_text'] == 'Complete')
				{
					$this->db->where("sUid", $List->sUid);
					$this->db->update("db_stat_coin", array("sTxId" => $Payment['result']['send_txid'], "sTxStatus" => 1));
				}
			}
			
							
		}
	}
	
	
	
	public function UpdateMineUser()
	{
		$query = $this->db->where("uMiner", "GHS")->get("db_users");
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $List)
			{
				$Speed = ((($this->config->item('PriceCloudGHS') * $List->uBalanceGHS) / (60 * 60 * 24 * $this->config->item('ReturnDayFromDeposit'))) / $this->config->item('PriceCloudGHS'));
			
			
				if((time() - $List->uLastTime) >= 10 && (time() - $List->uLastTime) * $Speed >= 0.00000001)
				{
					$AmountCrypto = $Speed * (time() - $List->uLastTime);
					
					
					$this->db->trans_start();
					$this->db->where("uUid", $List->uUid);
					$this->db->set("uBalanceGHS", "uBalanceGHS + " . $AmountCrypto, FALSE);
					$this->db->set("uLastTime", time());
					$this->db->set("uMiner", "BTC");
					$this->db->update("db_users");
					$this->db->trans_complete();
					
					
					//$this->User->UpdateBalanceMining($AmountCrypto, $this->USER['uMiner']);
				}
			}
		}
	}
	
	
	
}
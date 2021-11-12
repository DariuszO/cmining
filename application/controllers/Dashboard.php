<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	
	private $USER; //Инфа по юзеру
	private $SPEED_MINING; //Скорость майнинга
	private $SELECTMINER; //Выбраная валюта для майнинга
	public $_LANG; //Язык 
	
	public function __construct()
	{
		parent::__construct();
		
		if($this->input->cookie('Lang'))
		{
			if($this->input->cookie('Lang') == 'russian' or $this->input->cookie('Lang') == 'english')
			{
				$this->_LANG = $this->input->cookie('Lang');
			}
			else
			{
				$this->_LANG = 'english';
			}
		}
		else
		{
			set_cookie(
				array(
					'name'   => 'Lang',
                    'value'  => 'english',
                    'expire' => '865000',
                    'path'   => '/',
				)
			);
			$this->_LANG = 'english';
		}
		
		
		$this->lang->load('language', $this->_LANG);
		
		if(!$this->session->UserId || !$this->session->Login)
		{
			$this->session->sess_destroy();
			redirect( base_url() . 'Auth'); exit;
		}
		
		if(!$this->USER = $this->User->InfoUserAccount())
		{
			$this->session->sess_destroy();
			redirect( base_url() . 'Auth'); exit;
		}
		
		
		$Hash = md5($this->USER['uUid'] . $this->input->server('HTTP_USER_AGENT') . $this->input->server('REMOTE_ADDR'));
		
		if($Hash != $this->USER['uHashLogin'])
		{
			$this->session->sess_destroy();
			redirect( base_url() . 'Auth'); exit;
		}
		
		
		if($this->USER['uMiner'] != '')
		{
			if($this->USER['uMiner'] == 'GHS')
			{
				$this->SELECTMINER = $this->config->item('PriceCloudGHS');
			}
			elseif($row = $this->User->ViewPriceFromMinerUser($this->USER['uMiner']))
			{
				$this->SELECTMINER = $row['cPrice'];
			}
			else
			{
				$this->SELECTMINER = 0;
			}
			
			
			
			$this->SPEED_MINING = ((($this->config->item('PriceCloudGHS') * $this->USER['uBalanceGHS']) / (60 * 60 * 24 * $this->config->item('ReturnDayFromDeposit'))) / $this->SELECTMINER);
			
			
			if((time() - $this->USER['uLastTime']) >= 10 && (time() - $this->USER['uLastTime']) * $this->SPEED_MINING >= 0.00000001)
			{
				$AmountCrypto = $this->SPEED_MINING * (time() - $this->USER['uLastTime']);
			
				$this->User->UpdateBalanceMining($AmountCrypto, $this->USER['uMiner']);
			}
		}
		
		
		
		
		//echo sprintf("%.20f", $this->SPEED_MINING / $this->SELECTMINER);
	}
	
	
	public function SetLang()
	{
		if($this->uri->segment(3) && ($this->uri->segment(3) == 'russian' or $this->uri->segment(3) == 'english'))
		{
			
			set_cookie(
				array(
					'name'   => 'Lang',
                    'value'  => $this->uri->segment(3),
                    'expire' => '865000',
                    'path'   => '/',
				)
			);
			$this->_LANG = $this->uri->segment(3);
			redirect(base_url() . 'Dashboard'); exit;
		}
		else
		{
			redirect(base_url() . 'Dashboard'); exit;
		}
	}
	
	
	/**
	* Главная страница кабинета
	* 
	* @return
	*/
	public function index()
	{
		//echo 'Dashboard';
		/*
		include_once(APPPATH . 'libraries/coinpayments.inc.php');
		$cps = new CoinPaymentsAPI();
		$cps->Setup('62265Ca2f6E353f2A7BDf9AcC037c3978a4324DDDbE12Bf31e821bcE1Ab6770b', 'f0aabbf04950453b514fbdfeba7c565233fc63bf25a63016e24fa66b8dc0822e');

		$result = $cps->GetBalances();
		
		print_r($result);
		*/

		$data['Speedmine'] = $this->SPEED_MINING;
		$data['SelectMinerd'] = $this->USER['uMiner'];
		$data['BalanceGHS'] = $this->USER['uBalanceGHS'];
		$data['List'] = $this->User->ListCoinsUsers();
		
		
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/cabinet', $data);
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	
	/**
	* Установка майнинга
	* 
	* @return
	*/
	public function SetMiner()
	{
		
		if($this->input->is_ajax_request())
		{
			
			if($this->input->post('id'))
			{
				
				$UidVal = (int)$this->input->post('id');
				
				if($UidVal == '1990') exit;
				
				if($this->User->SetMinerd($UidVal))
				{
					echo json_encode(array("status" => "OK")); exit;
				}
				else
				{
					echo json_encode(array("status" => "NO")); exit;
				}
				exit;
			}
			exit;
		}
		exit;
	}
	
	
	
	/**
	* Страница с коинами юзера
	* 
	* @return
	*/
	public function UserCoins()
	{
		
		if($this->input->post('coinSet'))
		{
			//print_r($this->input->post('coinSet'));
			
			$UidCoin = (int)$this->input->post('coinSet');
			//var_dump($this->Admin->SetCoins($UidCoin)); exit;
			
			if($Ons = $this->User->SetCoins($UidCoin))
			{
				echo json_encode(array("error" => 'no', "Uid" => $UidCoin)); exit;
			}
			else
			{
				echo json_encode(array("error" => 'yes', "Uid" => '')); exit;
			}
			
		}
		
		
		$data['List'] = $this->User->ListCoins();
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/coins', $data);
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	/**
	* Пополнение баланса через Payeer.com
	* 
	* @return
	*/
	
	public function EnterPayeer()
	{
		if($this->input->post('amount'))
		{
			$Amount = number_format($this->input->post('amount'), 2, '.', '');
			
			if($Amount < 0.1)
			{
				$this->session->set_flashdata(array("errorDepositPayeer" => $this->wmrush->Notice($this->lang->line('lang1'), "error")));
				redirect(base_url() . "Dashboard/Deposit/".$this->uri->segment(3)); exit;
			}
			
			if($__LID = $this->User->InsertPayeer($Amount))
			{
				$data['Amount'] = $Amount;
				$data['LID'] = $__LID;
				$this->load->view($this->_LANG . "/payeer_insert", $data);
			}
			else
			{
				$this->session->set_flashdata(array("errorDepositPayeer" => $this->wmrush->Notice($this->lang->line('lang2'), "error")));
				redirect(base_url() . "Dashboard/Deposit/".$this->uri->segment(3)); exit;
			}
		}
		else
			redirect(base_url() . 'Dashboard/Deposit');
	}
	
	
	/**
	* Страница пополнения баланса
	*/
	
	public function Deposit()
	{
		
		
		if($this->input->post('valuta')) //&& $this->input->post('amount'))
		{
			$Amount = sprintf("%.8f", $this->input->post('amount'));
			$Coin = $this->input->post('valuta');
			
			if($InfoCoin = $this->User->CheckCoinUsers($Coin))
			{
				if($ExistWallet = $this->User->CheckCoinOnlineUser($InfoCoin['cUid']))
				{
					
					if($ExistWallet['bWallet'] != '')
					{
						echo json_encode(array("status" => "error", "text" => $this->lang->line('lang3'))); exit;
					}
					
					//if($Amount >= $InfoCoin['cMinimum'])
					//{
						
						if($Coin == 'LUNA')
						{
							include_once(APPPATH . 'libraries/jsonRPCClient.php');
							$LunaCoin = new jsonRPCClient('http://user:FTw27fEViKRndlw@127.0.0.1:38356/');
							$Wallet = $LunaCoin->getnewaddress("");
							$result = true;
						}
						else
						{
							include_once(APPPATH . 'libraries/coinpayments.inc.php');
							$WmRush = new CoinPaymentsAPI();
							$WmRush->Setup($this->config->item('PrivateAPIkey'), $this->config->item('PublicAPIkey'));

							$result = $WmRush->GetCallbackAddress($Coin, base_url() . 'Callback/Result');
							
							//var_dump($result);
							
							$Wallet = $result['result']['address'];
							if($Coin == 'XMR') $DestTag = $result['result']['dest_tag']; else $DestTag = '';
						}
						if($result)
						{
							if($this->User->UpdateWallet($Wallet, $InfoCoin['cUid'], $DestTag))
							{
								if($Coin == 'XMR')
								{
									echo json_encode(array("status" => "ok", "text" => $this->lang->line('lang4') . " <br><b>" . $Wallet . "</b><br>" . $this->lang->line('lang5') . "<br><b>" . $result['result']['dest_tag'] . "</b>")); exit;
								}
								else
								{
									echo json_encode(array("status" => "ok", "text" => $this->lang->line('lang4') . " <br><b>" . $Wallet . "</b>")); exit;
								}
								
							}
							else
							{
								echo json_encode(array("status" => "error", "text" => "ERROR!!!")); exit;
							}
						}
						else
						{
							echo json_encode(array("status" => "error", "text" => "ERROR!!!")); exit;
						}
						
						
						
					//}
					//else
					//{
					//	echo json_encode(array("status" => "error", "text" => "Минимум для пополнения " . $InfoCoin['cMinimum'] . ' ' . $InfoCoin['cAbbr'])); exit;
					//}
				}
				else
				{
					echo json_encode(array("status" => "error", "text" => $this->lang->line('lang6'))); exit;
				}
			}
			else
			{
				echo json_encode(array("status" => "error", "text" => $this->lang->line('lang7'))); exit;
			}
			
		}
		
		$data['List'] = $this->User->ListCoinsUsers();
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/deposit', $data);
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	
	
	/**
	* Обменник
	* 
	* @return
	*/
	public function Exchange()
	{
		/**
		* Производим обмен по указанным валютам
		* @var 
		* 
		*/
		if($this->input->is_ajax_request() && $this->input->post('ExchangeComplite') && $this->input->post('ExchangeComplite') == 'true')
		{
			$NameCoin_1 = $this->input->post('Coin_1');
			$NameCoin_2 = $this->input->post('Coin_2');
			$AmountCoin_1 = abs($this->input->post('AmountCoin_1'));
			
			if($AmountCoin_1 <= 0)
			{
				echo json_encode(array("error" => 'ok', "text" => $this->lang->line('lang8'))); exit;
			}
			
			//Проверяем валюту 1
			if(!$InfoCoin_1 = $this->User->CheckCoinExchange($NameCoin_1))
			{
				//error exit
				echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang9') . ' ' . $NameCoin_1)); exit;
			}
			
			if($NameCoin_2 != 'GHS')
			{
				//Проверяем валюту 2
				if(!$InfoCoin_2 = $this->User->CheckCoinExchange($NameCoin_2))
				{
					//error exit
					echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang9') . ' ' . $NameCoin_2)); exit;
				}
			}
			
			
			
			
			//Проверяем баланс юзера по указанной валюте
			if(!$BalanceCoin1 = $this->User->CheckBalanceCoinExcange($InfoCoin_1['cUid']))
			{
				//error exit
				echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang10') . ' ' . $Coin1)); exit;
			}
			
			
			if($NameCoin_2 != 'GHS')
			{
				//Проверяем баланс юзера по указанной валюте
				if(!$BalanceCoin2 = $this->User->CheckBalanceCoinExcange($InfoCoin_2['cUid']))
				{
					//error exit
					echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang10') . ' ' . $Coin2)); exit;
				}
			}
			
			
			
			//Производим расчет
			if($BalanceCoin1['bBalance'] < $AmountCoin_1)
			{
				//error exit
				echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang11'))); exit;
			}
			
			
			$this->db->insert("db_log_exchange", array("logUserId" => $this->session->UserId, "logDateAdd" => time()));
			
			
			if($NameCoin_2 != 'GHS')
			{
				$AmountBtcCoin_1 = $AmountCoin_1 * $InfoCoin_1['cPrice'];
			
				$AmountCoin2 = sprintf("%.8f", $AmountBtcCoin_1 / $InfoCoin_2['cPrice']);
				
				$AmountPercent2 = sprintf("%.8f", $AmountCoin2 - ($AmountCoin2 * $this->config->item('PercentFromExhange'))); //Сумма за вычетом процентов
				
				$UidCoin1 = $InfoCoin_1['cUid'];
				$UidCoin2 = $InfoCoin_2['cUid'];
			}
			else
			{
				$AmountBtcCoin_1 = $AmountCoin_1 * $InfoCoin_1['cPrice'];
			
				$AmountCoin2 = sprintf("%.8f", $AmountBtcCoin_1 / $this->config->item('PriceCloudGHS'));
				
				$AmountPercent2 = $AmountCoin2;
				
				
				$UidCoin1 = $InfoCoin_1['cUid'];
				$UidCoin2 = 0;
			}
			
			
			$query = $this->db->where("logUserId", $this->session->UserId)->get("db_log_exchange");
			if($query->num_rows() > 1)
			{
				$this->db->where("logUserId", $this->session->UserId);
				$this->db->delete("db_log_exchange");
				echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang2'))); exit;
			}
			
			if($this->User->ExchangeComplites($NameCoin_1, $NameCoin_2, $AmountCoin_1, $AmountPercent2, $UidCoin1, $UidCoin2))
			{
				$this->db->where("logUserId", $this->session->UserId);
				$this->db->delete("db_log_exchange");
				//error exit
				echo json_encode(array("error" => "no", "text" => $this->lang->line('lang12'))); exit;
			}
			else
			{
				//error exit
				echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang2'))); exit;
			}
			
		}
		//Конец обмена
		
		
		
		if($this->input->is_ajax_request() && $this->input->post('Calc'))
		{
			$Coin1 = $this->input->post('Coin1');
			$Coin2 = $this->input->post('Coin2');
			$Amount = sprintf("%.8f", abs($this->input->post('Amount')));
			
			
			//echo json_encode(array("error" => "no", "text" => $Amount)); exit;
			
			//Проверяем валюту 1
			if(!$InfoCoin_1 = $this->User->CheckCoinExchange($Coin1))
			{
				//error exit
				echo json_encode(array("error" => "yes", "text" => $this->lang->line('lang9') . ' ' . $Coin1)); exit;
			}
			
			if($Coin2 != 'GHS')
			{
				//Проверяем валюту 2
				if(!$InfoCoin_2 = $this->User->CheckCoinExchange($Coin2))
				{
					//error exit
					echo json_encode(array("error" => "yes", "text" => $this->lang->line('lang9') . ' ' . $Coin2)); exit;
				}
			}
			
			
			//Проверяем баланс юзера по указанной валюте
			if(!$BalanceCoin1 = $this->User->CheckBalanceCoinExcange($InfoCoin_1['cUid']))
			{
				//error exit
				echo json_encode(array("error" => "yes", "text" => $this->lang->line('lang10') . ' ' . $Coin1)); exit;
			}
			
			
			if($Coin2 != 'GHS')
			{
				//Проверяем баланс юзера по указанной валюте
				if(!$BalanceCoin2 = $this->User->CheckBalanceCoinExcange($InfoCoin_2['cUid']))
				{
					//error exit
					echo json_encode(array("error" => "yes", "text" => $this->lang->line('lang10') . ' ' . $Coin2)); exit;
				}
			}
			
			
			/*

			//Производим расчет
			if($BalanceCoin1['bBalance'] < $Amount)
			{
				//error exit
				echo json_encode(array("error" => "yes", "text" => 'Недостаточно средств на балансе')); exit;
			}
			*/
			
			if($Coin2 != 'GHS')
			{
				$AmountBtcCoin_1 = $Amount * $InfoCoin_1['cPrice'];
			
				$AmountCoin2 = sprintf("%.8f", $AmountBtcCoin_1 / $InfoCoin_2['cPrice']);
				
				$AmountPercent2 = sprintf("%.8f", $AmountCoin2 - ($AmountCoin2 * $this->config->item('PercentFromExhange'))); //Сумма за вычетом процентов
			
			}
			else
			{
				$AmountBtcCoin_1 = $Amount * $InfoCoin_1['cPrice'];
			
				$AmountCoin2 = sprintf("%.8f", $AmountBtcCoin_1 / $this->config->item('PriceCloudGHS'));
				
				$AmountPercent2 = $AmountCoin2;
				
			}
			
			
			echo json_encode(array("error" => "no", "text" => $AmountPercent2)); exit;
			
			
		}
		
		
		if($this->input->is_ajax_request() && $this->input->post('ExchStepOne'))
		{
			$UidCoinOne = $this->input->post('ExchStepOne');
			
			if($Row = $this->User->CheckCoinUsers($UidCoinOne))
			{
				if($InfoCoin = $this->User->CheckCoinOnlineUser($Row['cUid']))
				{
                    if($InfoCoin['bBalance'] > 0)
                    {
                        $Lists = $this->User->ExchangeCoinSuccess($Row['cUid']);
                        $LictCoins = '<option value="">'.$this->lang->line('lang13').'</option>';
                        $LictCoins .= '<option dat="GHS" value="GHS">'.$this->lang->line('lang14').'(GHS)</option>';
                        
                        //foreach($Lists as $coins)
                        //{
                         //       $LictCoins .= '<option dat="'.$coins->cAbbr.'" value="'.$coins->cAbbr.'">'.$coins->cName.'('.$coins->cAbbr.')</option>';
                        //}

                        echo json_encode(array("error" => "no", "text" => $LictCoins)); exit;
                    }
                    else
                    {
                            echo json_encode(array("error" => "yes", "text" => $this->lang->line('lang15'))); exit;
                    }
				}
				else
				{
					echo json_encode(array("error" => "yes", "text" => $this->lang->line('lang16'))); exit;
				}
			}
			else
			{
				echo json_encode(array("error" => "yes", "text" => $this->lang->line('lang16'))); exit;
			}
			
		}
		
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/Dashboard/Exchange/';
		$config['total_rows'] = $this->User->CountListExchange();
		$config['per_page'] = 10;
		$config['attributes'] = array('class' => 'page-link');
		$config['first_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="paginate_button page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_link'] = '<<';
		$config['first_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '>>';
		$config['last_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['prev_tag_close'] = '</li>';

		$this->pagination->initialize($config); 
		
		$data['ListHistoryEchange'] = $this->User->ListHistoryExchange($config['per_page'], $this->uri->segment(3));
		
		$data['List'] = $this->User->ListCoinsUserBalanceNotNull();
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/exchange', $data);
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	
	
	
	
	public function Withdraw()
	{
		
		if($this->input->is_ajax_request() && $this->input->post('valuta'))
		{
			//Проверяем сумму
			if($this->input->post('amount') <= 0)
			{
				echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang17'))); exit;
			}
			
			//Проверяем кошелек
			if(!$this->input->post('wallet'))
			{
				echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang18'))); exit;
			}
			
			if($this->input->post('amount') <= 0)
			{
				echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang19'))); exit;
			}
			
			$Amount = $this->input->post('amount');
			$Wallet = $this->input->post('wallet');
			$Currency = $this->input->post('valuta');
			
			
			
			if($row = $this->User->BalanceFromUserNotNull($Currency))
			{
				
				if(!$Min = $this->User->MinAmountWithdraw($Currency))
				{
					echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang20'))); exit;
				}
				
				if($Min['cMinimum'] > $Amount)
				{
					echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang21') . " " . $Min['cMinimum'] . ' ' . $Currency)); exit;
				}
				
				
				if($Amount <= $row['bBalance'])
				{
					
					$this->db->insert("db_log_exchange", array("logUserId" => $this->session->UserId, "logDateAdd" => time()));
					
					
					$AmountFromPercent = $Amount - ($Amount * $this->config->item('PercentPayment')); //Сумма за вычетом процентов на вывод
					
					$query = $this->db->where("logUserId", $this->session->UserId)->get("db_log_exchange");
					if($query->num_rows() > 1)
					{
						$this->db->where("logUserId", $this->session->UserId);
						$this->db->delete("db_log_exchange");
						echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang2'))); exit;
					}
					
					
					if(!$this->User->BalanceWithdraw($Amount, $Wallet, $Currency))
					{
						echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang20'))); exit;
					}
					
					
					//Автовыплаты
					if($this->config->item('AutoPayment') == 'on')
					{
						$this->db->where("logUserId", $this->session->UserId);
						$this->db->delete("db_log_exchange");
						if($Currency != 'USD')
						{
							//Выплата криптовалюты
							include_once(APPPATH . 'libraries/coinpayments.inc.php');
							$WmRush = new CoinPaymentsAPI();
							$WmRush->Setup($this->config->item('PrivateAPIkey'), $this->config->item('PublicAPIkey'));
							
							$Payment = $WmRush->CreateWithdrawal($AmountFromPercent, $Currency, $Wallet, $this->config->item('AutoConfirmWithdraw'));
							
							//var_dump($Payment);
							
							if($Payment['error'] != 'ok')
							{
								//Возврат средств на баланс юзера
								$this->User->ReturnBalanceUser($Amount, $Currency);
								echo json_encode(array("error" => "ok", "text" => $Payment['error'])); exit;
							}
							else
							{
								//Заносим стату юзеру по выплате
								$this->User->InsertHistoryPayCoin($Amount, $Payment['result']['id'], $Currency, 1, $Wallet);
								echo json_encode(array("error" => "no", "text" => $this->lang->line('lang22'))); exit;
							}
						}
						else
						{
							//Выплата Паера
							require_once(APPPATH . '/libraries/cpayeer.php');
							$payeer = new CPayeer($this->config->item('WalletPayeerFromAutoPay'), $this->config->item('UidPayeerApi'), $this->config->item('SecretKeyPayeerApi'));
							if ($payeer->isAuth())
							{
								$arTransfer = $payeer->transfer(array(
									'curIn' => 'USD',
									'sum' => $Amount,
									'curOut' => 'USD',
									'to' => $Wallet,
									
								));
								if (empty($arTransfer['errors']))
								{
									
										//Заносим стату юзеру по выплате
										$this->User->InsertHistoryPayCoin($Amount, $arTransfer['historyId'], $Currency, 1, $Wallet);
										echo json_encode(array("error" => "no", "text" => $this->lang->line('lang22'))); exit;
								}
								else
								{
									//Возврат средств на баланс юзера
									$this->User->ReturnBalanceUser($Amount, $Currency);
									echo json_encode(array("error" => "ok", "text" => $Payment['error'])); exit;
								}
							}
							else
							{
								echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang23'))); exit;
								echo '<pre>'.print_r($payeer->getErrors(), true).'</pre>';
							}

						}
						
						
						
					}
					
					
					//Полуавтовыплаты
					if($this->config->item('AutoPayment') == 'off')
					{
						//Заносим стату юзеру по выплате
						$this->User->InsertHistoryPayCoin($Amount, '', $Currency, 0, $Wallet);
						echo json_encode(array("error" => "no", "text" => $this->lang->line('lang22'))); exit;
					}
					
					
					
				}
				else
				{
					echo json_encode(array("error" => "ok", "text" => $this->lang->line('lang11'))); exit;
				}
			}
			else
			{
				echo json_encode(array("error" => "ok", "text" => "ERROR!!!")); exit;
			}
			
			
		}
		
		
		
		$data['List'] = $this->User->ListCoinsUserBalanceNotNull();
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/withdraw', $data);
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	
	/**
	* Установка аватора юзеру
	* 
	* @return
	*/
	public function SetAvatar()
	{
		$config['upload_path'] = './avatar/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['file_name'] = $this->session->Login . $this->session->UserId.'.jpg';
		$config['overwrite'] = TRUE;
		$config['max_size']	= '50000';
		$config['max_width']  = '102400';
		$config['max_height']  = '102400';
		$config['encrypt_name']  = FALSE;
		
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			$Ava = $this->upload->data();
			$config['image_library'] = 'gd2'; // выбираем библиотеку
			$config['source_image']	= $Ava["full_path"]; 
			$config['create_thumb'] = FALSE; // ставим флаг создания эскиза
			$config['maintain_ratio'] = TRUE; // сохранять пропорции
			$config['width'] = 200; // и задаем размеры
			$config['height'] = 200;
			$this->load->library('image_lib', $config); // загружаем библиотеку 

			//$this->image_lib->resize(); // и вызываем функцию
			//$this->image_lib->watermark();
			if($this->image_lib->resize() && $this->image_lib->watermark())
			{
				redirect(base_url().'Dashboard/Profile');
				exit;
			}
			else
			{
				redirect(base_url().'Dashboard/Profile');
				exit;
			}
		}
		else
		{
			//echo 'изображение не загружено';
			redirect(base_url().'Dashboard/Profile');
			exit;
		}
	}
	
	
	
	public function Profile()
	{
		if($this->input->post('profile_save') && $this->input->post('profile_save') == 1)
		{
			$Fio = $this->input->post('fio');
			$Skype = $this->input->post('skype');
			$City = $this->input->post('city');
			$Country = $this->input->post('country');
			
			
			//Обновляем профиль юзера
			if($this->User->UpdateProfileUserFromData($Fio, $Skype, $City, $Country))
			{
				$this->session->set_flashdata(array("error" => '<div class="alert alert-success">'.$this->lang->line('lang24').'</div>')); 
				redirect(base_url() . 'Dashboard/Profile'); exit;
			}
			else
			{
				$this->session->set_flashdata(array("error" => '<div class="alert alert-danger">'.$this->lang->line('lang25').'</div>')); 
				redirect(base_url() . 'Dashboard/Profile'); exit;
			}
			
			
		}
		
		
		
		if($this->input->post('password_save') && $this->input->post('password_save') == 1)
		{
			
			$NewPass = $this->input->post('newpass');
			$ReNewPass = $this->input->post('renewpass');
			
			if($NewPass === $ReNewPass)
			{
				$this->User->ChangePassword($this->wmrush->ReturnPassword($ReNewPass));
				$this->session->set_flashdata(array("error" => '<div class="alert alert-success">'.$this->lang->line('lang26').'</div>')); 
				redirect(base_url() . 'Dashboard/Profile'); exit;
			}
			else
			{
				$this->session->set_flashdata(array("error" => '<div class="alert alert-danger">'.$this->lang->line('lang27').'</div>')); 
				redirect(base_url() . 'Dashboard/Profile'); exit;
			}
			
		}
		
		
		$data['User'] = $this->USER;
		$data['List'] = $this->User->ListCoinsUserBalanceNotNull();
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/profile', $data);
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	
	/**
	* Список тикетов
	* 
	* @return
	*/
	public function Ticket()
	{
		$data['User'] = $this->USER;
		$data['List'] = $this->User->ListTicketUser();
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/ticket', $data);
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	
	
	
	
	
	/**
	* Создание тикета
	* 
	* @return
	*/
	public function NewTicket()
	{
		if($this->input->post('send'))
		{
			require_once(APPPATH . 'libraries/Recaptcha2.php');
			
			$Recaptcha = new Recaptcha2();
			
			$Theme = htmlspecialchars($this->input->post('theme'));
			$Text = htmlspecialchars($this->input->post('text'));
			
			$recaptcha = $this->input->post('g-recaptcha-response');
			if(!empty($recaptcha) and $this->input->post('g-recaptcha-response'))
			{
				
				$res = $Recaptcha->verify($recaptcha);
				
				//reCaptcha введена
				if($res != TRUE)
				{
					$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang28'), "error")));
					redirect( base_url() . "Dashboard/NewTicket"); exit();
					exit;
				}
				
			}
			else
			{
				$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang28'), "error")));
				redirect( base_url() . "Dashboard/NewTicket"); exit();
				exit;
			}
			
			
			if(strlen($Theme) < 10 or strlen($Theme) > 255)
			{
				$this->session->set_flashdata(array("errorTicket" => $this->wmrush->Notice($this->lang->line('lang29'), "error")));
				redirect(base_url() . "Dashboard/NewTicket"); exit;
			}
			
			if(strlen($Text) < 10)
			{
				$this->session->set_flashdata(array("errorTicket" => $this->wmrush->Notice($this->lang->line('lang30'), "error")));
				redirect(base_url() . "Dashboard/NewTicket"); exit;
			}
			
			if($this->User->InsertTicketUser($Theme, $Text))
			{
				$this->session->set_flashdata(array("errorTicket" => $this->wmrush->Notice($this->lang->line('lang31')." <a href='/Dashboard/Ticket'>".$this->lang->line('lang32')."</a>", "success")));
				redirect(base_url() . "Dashboard/NewTicket"); exit;
			}
			else
			{
				$this->session->set_flashdata(array("errorTicket" => $this->wmrush->Notice($this->lang->line('lang2'), "error")));
				redirect(base_url() . "Dashboard/NewTicket"); exit;
			}
			
		}	
		
		$data['User'] = $this->USER;
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/new_ticket', $data);
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	
	
	public function TicketView()
	{
		
		if($this->uri->segment(3))
		{
			
			
			if($this->input->post('send') && $this->input->post('text'))
			{
				require_once(APPPATH . 'libraries/Recaptcha2.php');
			
				$Recaptcha = new Recaptcha2();
				
				$Text = htmlspecialchars($this->input->post('text'));
				
				$recaptcha = $this->input->post('g-recaptcha-response');
				if(!empty($recaptcha) and $this->input->post('g-recaptcha-response'))
				{
					
					$res = $Recaptcha->verify($recaptcha);
					
					//reCaptcha введена
					if($res != TRUE)
					{
						$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang28'), "error")));
						redirect( base_url() . "Dashboard/TicketView/".$this->uri->segment(3)); exit();
						exit;
					}
					
				}
				else
				{
					$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang28'), "error")));
					redirect( base_url() . "Dashboard/TicketView/".$this->uri->segment(3)); exit();
					exit;
				}
				
				if(strlen($Text) < 10)
				{
					$this->session->set_flashdata(array("errorTicket" => $this->wmrush->Notice($this->lang->line('lang30'), "error")));
					redirect(base_url() . "Dashboard/TicketView/".$this->uri->segment(3)); exit;
				}
				
				
				if($this->User->AddOtvetToTicket($this->uri->segment(3), $Text))
				{
					$this->session->set_flashdata(array("errorTicket" => $this->wmrush->Notice($this->lang->line('lang33'), "success")));
					redirect(base_url() . "Dashboard/TicketView/".$this->uri->segment(3)); exit;
				}
				else
				{
					$this->session->set_flashdata(array("errorTicket" => $this->wmrush->Notice($this->lang->line('lang2'), "error")));
					redirect(base_url() . "Dashboard/TicketView/".$this->uri->segment(3)); exit;
				}
				
				
			}
			
			
			$UidTicket = abs((int)$this->uri->segment(3));
			
			if(!$this->User->ExistTicketUser($UidTicket))
			{
				$this->session->set_flashdata(array("errorTicket" => $this->wmrush->Notice($this->lang->line('lang34'), "error")));
				redirect(base_url() . "Dashboard/Ticket"); exit;
			}
			
			//$this->db->where("tUid", $this->uri->segment(3));
			//$this->db->where("tUserId", $this->session->UserId);
			//$this->db->update("db_ticket", array("tRead" => 3));
			
			$data['List'] = $this->User->ListTicketInfoFromUser($UidTicket);
			$data['User'] = $this->USER;
			$this->load->view($this->_LANG . '/blocks_account/header');
			$this->load->view($this->_LANG . '/view_ticket', $data);
			$this->load->view($this->_LANG . '/blocks_account/footer');
		}
		else
		{
			redirect(base_url() . "Dashboard/Ticket"); exit;
		}
		
		
	}
	
	
	
	public function Partners()
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/Dashboard/Partners/';
		$config['total_rows'] = $this->User->ListPartners(TRUE);
		$config['per_page'] = 9;
		$config['attributes'] = array('class' => 'page-link');
		$config['first_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="paginate_button page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_link'] = '<<';
		$config['first_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '>>';
		$config['last_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['prev_tag_close'] = '</li>';

		$this->pagination->initialize($config); 
		
		$data['List'] = $this->User->ListPartners(FALSE, $config['per_page'], $this->uri->segment(3));
		$data['User'] = $this->USER;
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/partners', $data);
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	
	
	public function LoadInfoPartner()
	{
		if($this->input->post('ref') && $this->input->is_ajax_request())
		{
			$RefId = (int)$this->input->post('ref');
			$row = $this->User->InfoRefModal($RefId);
			if($row !== FALSE)
			{
				//var_dump($row);
				if(is_array($row)):
				$str = '<table class="table">
				<tr>
					<td>Date</td>
					<td>Coin</td>
					<td>Amount</td>
				</tr>';
				foreach($row as $Ref)
				{
					$str .= '
					<tr>
						<td>'.$Ref->hrDateAdd.'</td>	
						<td><img style="width: 20px;" src="https://www.coinpayments.net/images/coins/'.$Ref->hrCoin.'.png" alt="..."> '.$Ref->hrCoin.'</td>	
						<td>'.$Ref->hrAmount.' '.$Ref->hrCoin.'</td>	
					</tr>';
				}
				
				$str .= "</table>";
				else:
				$str = 'Empty';
				endif;
				echo json_encode(array("error" =>"no", "text" => $str)); exit;
				
			}
			else
			{
				echo json_encode(array("error" =>"yes", "text" => "ERROR!!!")); exit;
			}
		}
	}
	
	
	
	public function LogOut()
	{
		$arr = array("UserId", "Login");
		$this->session->unset_userdata($arr);
		redirect(base_url() . "Auth"); exit;
	}
	
	
	public function Promo()
	{
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/promo');
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	public function HistoryPayment()
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/Dashboard/HistoryPayment/';
		$config['total_rows'] = $this->User->CountHistoryPayment();
		$config['per_page'] = 10;
		$config['attributes'] = array('class' => 'page-link');
		$config['first_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="paginate_button page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="paginate_button page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_link'] = '<<';
		$config['first_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '>>';
		$config['last_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="paginate_button page-item previous">';
		$config['prev_tag_close'] = '</li>';

		$this->pagination->initialize($config); 
		
		
		$data['ListHistoryEchange'] = $this->User->HistoryPay($config['per_page'], $this->uri->segment(3));
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/historypay', $data);
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	
	public function VoteCoin()
	{
		$this->load->view($this->_LANG . '/blocks_account/header');
		$this->load->view($this->_LANG . '/votecoin');
		$this->load->view($this->_LANG . '/blocks_account/footer');
	}
	
	
}




<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flatpanel extends CI_Controller
{
	
	/**
	* Конструктор
	* 
	* @return
	*/
	public function __construct()
	{
		parent::__construct();
		
		if(!$this->session->Admin && $this->uri->segment(2) != 'login')
		{
			$this->session->unset_userdata('Admin');
			redirect( base_url() . 'Flatpanel/login'); exit;
		}
		
		
		$this->load->model('Admin');
		
		$this->session->set_userdata(array("CountTicket" => $this->Admin->CountTicketRead()));
		
	}
	
	
	/**
	* Главная админки
	* 
	* @return
	*/
	public function index()
	{
		$data['CountUsers'] = $this->Admin->CountUsers();
		$data['CountCashOut'] = $this->Admin->CountCashOutAndEnter(1, 1);
		$data['CountEnter'] = $this->Admin->CountCashOutAndEnter(2, 1);
		$data['CountEnterWait'] = $this->Admin->CountCashOutAndEnter(2, 0);
		$data['ListCoinEnter'] = $this->Admin->ListCoinEnter();
		$data['ListCoinCashOut'] = $this->Admin->ListCoinCashOut();
		
		/*
		$query = $this->db->get("db_coin");
		foreach($query->result() as $Coin)
		{
			$this->db->insert("db_stats_enter", array("seUidCoin" => $Coin->cUid, "seNameCoin" => $Coin->cAbbr));
		}
		*/
		
		
		
		$this->load->view('admin/header');
		$this->load->view('admin/index', $data);
		$this->load->view('admin/footer');
	}
	
	/**
	* Авторизация
	* 
	* @return
	*/
	public function login()
	{
		
		if($this->input->post('login') && $this->input->post('pass'))
		{
			if($this->input->post('login') == $this->config->item('AdminLogin') && $this->input->post('pass') == $this->config->item('AdminPassword'))
			{
				$this->session->set_userdata(array("Admin" => true));
				redirect( base_url() . 'Flatpanel/index'); exit;
			}
			else
			{
				$this->session->set_flashdata(array('error' => '<div class="alert alert-danger">Не верный логин или пароль</div>'));
				redirect( base_url() . 'Flatpanel/login'); exit;
			}
		}
		
		
		$this->load->view('admin/login');

	}
	
	/**
	* Выход из админки
	* 
	* @return
	*/
	public function logout()
	{
		$this->session->sess_destroy();
		redirect( base_url() . 'Flatpanel/login'); exit;
	}
	
	
	/**
	* Страница коинов
	* 
	* @return
	*/
	public function Coins()
	{
		
		if($this->input->post('minamount'))
		{
			$Amount = $this->input->post('minamount');
			$Val = $this->input->post('val');
			
			if($this->Admin->ChangeMinAmountCoins($Amount, $Val))
			{
				echo json_encode(array("status" => 'ok')); exit;
			}
			else
			{
				echo json_encode(array("status" => 'no')); exit;
			}
			
		}
		
		if($this->input->post('coinSet'))
		{
			//print_r($this->input->post('coinSet'));
			
			$UidCoin = (int)$this->input->post('coinSet');
			//var_dump($this->Admin->SetCoins($UidCoin)); exit;
			
			if($Ons = $this->Admin->SetCoins($UidCoin))
			{
				echo json_encode(array("error" => 'no', 'action' => $Ons, "Uid" => $UidCoin)); exit;
			}
			else
			{
				echo json_encode(array("error" => 'yes', 'action' => '', "Uid" => '')); exit;
			}
			
		}
		
		include_once(APPPATH . 'libraries/coinpayments.inc.php');
		$cps = new CoinPaymentsAPI();
		$cps->Setup('62265Ca2f6E353f2A7BDf9AcC037c3978a4324DDDbE12Bf31e821bcE1Ab6770b', 'f0aabbf04950453b514fbdfeba7c565233fc63bf25a63016e24fa66b8dc0822e');
		
		$res = $cps->GetRates('rates');
		
		//var_dump($res);
		
		$query = $this->db->get("db_coin");
		foreach($query->result() as $Coins)
		{
			
			foreach($res['result'] as $key => $val)
			{
				if($key == $Coins->cAbbr)
				{
					$this->db->where("cUid", $Coins->cUid);
					$this->db->where("cAbbr", $Coins->cAbbr);
					$this->db->update("db_coin", array("cPrice" => $val['rate_btc']));
				}
			}
			
			
		}
		
		$data['List'] = $this->Admin->ListCoins();
		$this->load->view('admin/header');
		$this->load->view('admin/coins', $data);
		$this->load->view('admin/footer');
	}
	
	
	
	/**
	* Список юзеров
	* 
	* @return
	*/
	public function Users()
	{
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/Flatpanel/Users/';
		$config['total_rows'] = $this->Admin->CountUsers();
		$config['per_page'] = 10;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_link'] = '<<';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '>>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$this->pagination->initialize($config); 
		
		$data['List'] = $this->Admin->ListUsers($config['per_page'], $this->uri->segment(3));
		$this->load->view('admin/header');
		$this->load->view('admin/users', $data);
		$this->load->view('admin/footer');
	}
	
	
	/**
	* Редактирование юзера
	* 
	* @return
	*/
	public function EditUser()
	{
		$Uid = (int)$this->uri->segment(3);
		
		$data['User'] = $this->Admin->ListUsersOne($Uid); //Инфа юзера
		$data['Balance'] = $this->Admin->ListCoinsBalanceUsers($Uid); //Балансы юзера
		$data['Partners'] = $this->Admin->CountPartnersUser($Uid); //Кол-во партнеров юзера
		$data['Cashout'] = $this->Admin->ListCoinsBalanceUsers($Uid); //Общая сумма выплат юзера по валютам
		$data['Enter'] = $this->Admin->ListCoinsBalanceUsers($Uid); //Общая сумма пополнения юзера по валютам
		$data['Exchange'] = $this->Admin->ListExchangeUsers($Uid); //Последние обмены валют
		$this->load->view('admin/header');
		$this->load->view('admin/users_edit', $data);
		$this->load->view('admin/footer');
	}
	
	
	/**
	* Обновление баланса юзера по выбранной валюте
	* 
	* @return
	*/
	public function UpdateBalanceUser()
	{
		
		if($this->input->post('user') && $this->input->is_ajax_request())
		{
			
			$Uid = $this->input->post('user');
			$Amount = $this->input->post('amount');
			$UidCoin = $this->input->post('coin');
			
			
			if($this->Admin->UpdateBalanceUsers($Uid, $Amount, $UidCoin))
			{
				echo json_encode(array("status" => 'ok')); exit;
			}
			else
			{
				echo json_encode(array("status" => 'no')); exit;
			}
			
		}
	}
	
	
	
	
	public function Tickets()
	{
		$data['List'] = $this->Admin->ListTikets();
		$this->load->view('admin/header');
		$this->load->view('admin/tickets', $data);
		$this->load->view('admin/footer');
	}
	
	
	
	public function ViewTicket()
	{
		if($this->uri->segment(3))
		{
			
			if($this->input->post('send') && $this->input->post('text'))
			{
				
				
				$Text = htmlspecialchars($this->input->post('text'));
				if($this->Admin->AddOtvetToTicket($this->uri->segment(3), $Text))
				{
					$this->session->set_flashdata(array("errorTicket" => $this->wmrush->Notice("Ответ успешно отправлен", "success")));
					redirect(base_url() . "Flatpanel/ViewTicket/".$this->uri->segment(3)); exit;
				}
				else
				{
					$this->session->set_flashdata(array("errorTicket" => $this->wmrush->Notice("Ошибка!!! Попробуйте позже!", "error")));
					redirect(base_url() . "Flatpanel/ViewTicket/".$this->uri->segment(3)); exit;
				}
				
				
			}
			
			//$this->db->where("tUid", $this->uri->segment(3));
			//$this->db->update("db_ticket", array("tRead" => 3));
			
			$data['InfoTicket'] = $this->Admin->InfoTicketFromAdmin($this->uri->segment(3));
			$this->load->view('admin/header');
			$this->load->view('admin/view_tickets', $data);
			$this->load->view('admin/footer');
		}
		else
			redirect(base_url() . 'Flatpanel/Tickets');
		
	}
	
	
	
	
	public function CashOutList()
	{
		$data['ListCashOut'] = $this->Admin->ListCahOutFull();
		$this->load->view('admin/header');
		$this->load->view('admin/list_cashout', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function DeleteCashOut()
	{
		if($this->uri->segment(3))
		{
			$Uid = (int)$this->uri->segment(3);
			$this->Admin->DeleteCashOutId($Uid);
			redirect(base_url() . 'Flatpanel/CashOutList'); exit;
		}
		else
			redirect(base_url() . 'Flatpanel/CashOutList');
	}
	
	
	
	public function SendCashOut()
	{
		if($this->uri->segment(3))
		{
			$Uid = (int)$this->uri->segment(3);
			if($this->Admin->SendCashOutId($Uid))
			{
				redirect(base_url() . 'Flatpanel/CashOutList'); exit;
			}
			else
			{
				redirect(base_url() . 'Flatpanel/CashOutList'); exit;
			}
			
		}
		else
			redirect(base_url() . 'Flatpanel/CashOutList');
	}
	
	
	public function CashOutListFull()
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/Flatpanel/CashOutListFull/';
		$config['total_rows'] = $this->Admin->CountCashOutAndEnter(2, 1);
		$config['per_page'] = 10;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_link'] = '<<';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '>>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$this->pagination->initialize($config); 
		
		
		$data['List'] = $this->Admin->ListCahOutFullList($config['per_page'], $this->uri->segment(3));
		$this->load->view('admin/header');
		$this->load->view('admin/list_cashout_full', $data);
		$this->load->view('admin/footer');
	}
	
	public function InsertListFull()
	{
		$this->load->library('pagination');
		$config['base_url'] = base_url().'/Flatpanel/InsertListFull/';
		$config['total_rows'] = $this->Admin->CountCashOutAndEnter(1, 1);
		$config['per_page'] = 10;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_link'] = '<<';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = '>>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$this->pagination->initialize($config); 
		
		$data['List'] = $this->Admin->ListInsertFullList($config['per_page'], $this->uri->segment(3));
		$this->load->view('admin/header');
		$this->load->view('admin/list_insert_full', $data);
		$this->load->view('admin/footer');
	}
	
	
	public function AddNews()
	{
		if($this->input->post('themeru'))
		{
			$arr = array(
				"nDateAdd" => date("d.m.Y"),
				"nTheme_ru" => $this->input->post('themeru'),
				"nTheme_en" => $this->input->post('themeen'),
				"nNews_ru" => $this->input->post('textru'),
				"nNews_en" => $this->input->post('texten')
			
			);
			
			$this->db->insert("db_news", $arr);
			$this->session->set_flashdata(array("error" => $this->wmrush->Notice("Новость добавлена", "success")));
			redirect(base_url() . "Flatpanel/AddNews/".$this->uri->segment(3)); exit;
		}
		$this->load->view('admin/header');
		$this->load->view('admin/addnews');
		$this->load->view('admin/footer');
	}
	
	
	
}
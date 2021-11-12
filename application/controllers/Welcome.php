<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public $_LANG;

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
		//echo $this->input->cookie('Lang');
		
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
			redirect(base_url() . ''); exit;
		}
		else
		{
			redirect(base_url() . ''); exit;
		}
	}


	public function index()
	{
		
		//$data['LastDeposit'] = $this->WelcomeModel->LastDepositEndCashOut(1);
		//$data['LastCashOut'] = $this->WelcomeModel->LastDepositEndCashOut(2);
		$data['CountUsers'] = $this->db->get("db_users")->num_rows();
		$this->load->view($this->_LANG . '/site/blocks/header');
		$this->load->view($this->_LANG . '/site/index', $data);
		$this->load->view($this->_LANG . '/site/blocks/footer');
	}
	
	
	public function Calculate()
	{
		$data['ListCoin'] = $this->WelcomeModel->ListCoinsFromCalculate();
		$this->load->view($this->_LANG . '/site/blocks/header');
		$this->load->view($this->_LANG . '/site/calculate', $data);
		$this->load->view($this->_LANG . '/site/blocks/footer');
	}
	
	
	public function News()
	{
		$data['NewsList'] = $this->WelcomeModel->ListNews();
		$this->load->view($this->_LANG . '/site/blocks/header');
		$this->load->view($this->_LANG . '/site/news', $data);
		$this->load->view($this->_LANG . '/site/blocks/footer');
	}
	
	
	public function Faq()
	{
		$this->load->view($this->_LANG . '/site/blocks/header');
		$this->load->view($this->_LANG . '/site/faq');
		$this->load->view($this->_LANG . '/site/blocks/footer');
	}
	
	
	public function Support()
	{
		
		if($this->input->post('name') && $this->input->post('email') && $this->input->post('text'))
		{
			require_once(APPPATH . 'libraries/Recaptcha2.php');
			
			$Recaptcha = new Recaptcha2();
			
			$recaptcha = $this->input->post('g-recaptcha-response');
			if(!empty($recaptcha) and $this->input->post('g-recaptcha-response'))
			{
				
				$res = $Recaptcha->verify($recaptcha);
				
				//reCaptcha введена
				if($res != TRUE)
				{
					$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang28'), "error")));
					redirect( base_url() . "Welcome/Support"); exit();
					exit;
				}
				
			}
			else
			{
				$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang28'), "error")));
				redirect( base_url() . "Welcome/Support"); exit();
				exit;
			}
			
			$Name = htmlspecialchars($this->input->post('name'));
			$Email = htmlspecialchars($this->input->post('email'));
			$Text = htmlspecialchars($this->input->post('text'));
			
			//$Text = $Text;
			//$q = $this->wmrush->SendEmail($this->input->post('email'), 'Сообщение с bitaltearning.com', $Text, 'support');
			$this->load->library('Libmail');
		
			$this->libmail->From($Email, $Name);
			$this->libmail->To('support@bitaltearning.com');
			$this->libmail->Subject('Message from bitaltearning.com');
			$this->libmail->Body($Text, 'text');
			//$this->_CI->libmail->smtp_on($this->_CI->config->item('smtp_host'), $this->_CI->config->item('smtp_user'), $this->_CI->config->item('smtp_pass'), $this->_CI->config->item('smtp_port'));
			$this->libmail->Send();    // а теперь пошла отправка
			$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang31'), "success")));
			redirect( base_url() . "Welcome/Support"); exit();
			exit;
			
		}
		
		$this->load->view($this->_LANG . '/site/blocks/header');
		$this->load->view($this->_LANG . '/site/support');
		$this->load->view($this->_LANG . '/site/blocks/footer');
	}
	
	
	public function About()
	{
		$this->load->view($this->_LANG . '/site/blocks/header');
		$this->load->view($this->_LANG . '/site/about');
		$this->load->view($this->_LANG . '/site/blocks/footer');
	}
	
	public function Stats()
	{
		$data['LastDeposit'] = $this->WelcomeModel->LastDepositEndCashOut(1);
		$data['LastCashOut'] = $this->WelcomeModel->LastDepositEndCashOut(2);
		$data['CountUsers'] = $this->db->get("db_users")->num_rows();
		
		$this->load->view($this->_LANG . '/site/blocks/header');
		$this->load->view($this->_LANG . '/site/stats', $data);
		$this->load->view($this->_LANG . '/site/blocks/footer');
	}
	
	
	public function Partner()
	{
		if($this->uri->segment(3))
		{
			$Partner = (int)$this->uri->segment(3);
			
			$this->db->where("uUid", $Partner);
			$query = $this->db->get("db_users");
			if($query->num_rows() == 1)
			{
				$RefId = $Partner;
			}
			else
			{
				$RefId = 1;
			}
			
			
			set_cookie(
				array(
					'name'   => 'Ref',
                    'value'  => $RefId,
                    'expire' => '8650000',
                    'path'   => '/',
				)
			);
			redirect(base_url()); exit;
			
			
		}
		else
		{
			redirect(base_url());exit;
		}
	}
	
}

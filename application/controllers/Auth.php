<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller
{
	
	
	public function __construct()
	{
		parent::__construct();
		
		
		if($this->session->UserId)
		{
			redirect( base_url() . 'Dashboard'); exit;
		}
		
		
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
		$this->load->model('AuthModel');
		
		//
		
		
	}
	
	
	/**
	* Авторизация
	* 
	* @return
	*/
	public function index()
	{
		
		
		if($this->input->post('a') && $this->input->post('a') == 'do_login')
		{
			
			
			$UserName = $this->input->post('username');
			$Password = $this->wmrush->ReturnPassword($this->input->post('password'));
			
			
			if(strtoupper($this->input->post('code')) != strtoupper($this->session->CaptWord))
			{
				//echo strtoupper($this->input->post('code')) . ' || ' . strtoupper($this->session->CaptWord);
				$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang28'), "error")));
				redirect( base_url() . "auth"); exit();
				exit;
			}
			
			
			
			if($row = $this->AuthModel->CheckLogin($UserName, $Password))
			{
				if($row['uStatus'] != 2)
				{
					
					
					if($row['uActivateEmail'] != '')
					{
						$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang53'), "error")));
						redirect( base_url() . "auth"); exit();
					}
					
					$MetaDis = explode('@', $row['uEmail']);
					if($MetaDis[1] == 'meta.ua' or $MetaDis[1] == 'binka.me' or $MetaDis[1] == '10host.top' or $MetaDis[1] == 'doanart.com' or $MetaDis[1] == '88clean.pro' or $MetaDis[1] == 'cloud99.pro' or $MetaDis[1] == 'wimsg.com' or $MetaDis[1] == 'vmani.com' or $MetaDis[1] == 'yopmail.com' or $MetaDis[1] == 'sezet.com' or $MetaDis[1] == 'fakeinbox.info' or $MetaDis[1] == 'sharklasers.com')
					{
						$this->session->set_flashdata(array("error" => $this->wmrush->Notice("Service ".$MetaDis[1]." blocked", "error")));
						redirect( base_url() . "Auth"); exit();
					}
					
					$Hash = md5($row['uUid'] . $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
					$this->AuthModel->UpdateInfoUserName($row['uUid'], $Hash);
					$array = array(
									"UserId" => $row['uUid'],
									"Login" => $row['uLogin'],
									"HashLogin" => $Hash
								);
					$this->session->set_userdata($array);
					
					redirect( base_url() . 'Dashboard'); exit;
				}
				else
				{
					$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang35'), "error")));
					redirect( base_url() . "auth"); exit();
				}
			}
			else
			{
				$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang36'), "error")));
				redirect( base_url() . "auth"); exit();
			}
			
			
		}
		
		
		
		
		//echo $this->session->CaptWord;	
		$this->session->set_userdata(array("Capt" => $this->wmrush->CapCode()));
		$this->load->view($this->_LANG . '/auth');
		
		
		
		
	}
	
	/**
	* Регистрация
	* 
	* @return
	*/
	public function Register()
	{
		if($this->input->post('a') && $this->input->post('a') == 'signup')
		{
			if(
					$this->input->post('email') && 
					$this->input->post('email1') && 
					$this->input->post('username') && 
					$this->input->post('password') && 
					$this->input->post('password2') && 
					$this->input->post('code') && 
					$this->input->post('agree')
				)
				{
					
					
					if(strtoupper($this->input->post('code')) != strtoupper($this->session->CaptWord))
					{
						//echo strtoupper($this->input->post('code')) . ' || ' . strtoupper($this->session->CaptWord);
						$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang28'), "error")));
						redirect( base_url() . "Auth/Register"); exit();
						exit;
					}
					
					$MetaDis = explode('@', $this->input->post('email'));
					if($MetaDis[1] == 'meta.ua' or $MetaDis[1] == 'binka.me' or $MetaDis[1] == '10host.top' or $MetaDis[1] == 'doanart.com' or $MetaDis[1] == '88clean.pro' or $MetaDis[1] == 'cloud99.pro' or $MetaDis[1] == 'wimsg.com' or $MetaDis[1] == 'vmani.com' or $MetaDis[1] == 'yopmail.com' or $MetaDis[1] == 'sezet.com' or $MetaDis[1] == 'fakeinbox.info' or $MetaDis[1] == 'sharklasers.com')
					{
						$this->session->set_flashdata(array("error" => $this->wmrush->Notice("Service ".$MetaDis[1]." blocked", "error")));
						redirect( base_url() . "Auth/Register"); exit();
					}
					
					if($this->input->post('email') == $this->input->post('email1'))
					{
						if($this->input->post('password') == $this->input->post('password2'))
						{
							if(strlen($this->input->post('username')) >= 4)
							{
								if($this->AuthModel->ExistUser($this->input->post('username'), 'login'))
								{
									if($this->AuthModel->ExistUser($this->input->post('email1'), 'email'))
									{
										if($this->AuthModel->ExistUser($_SERVER['REMOTE_ADDR'], 'ip'))
										{
											$ActCode = $this->wmrush->ReturnPassword($this->input->post('email1'));
											if($this->AuthModel->Reg($this->input->post('username'), $this->wmrush->ReturnPassword($this->input->post('password')), $this->input->post('email1'), (int)$this->input->cookie('Ref'), $ActCode))
											{
												
												$Text = $this->lang->line('lang44') . ' ' . $this->config->item('SiteName') . '<br>
														'.$this->lang->line('lang45').':<br>
														Login: '. $this->input->post('username') .'<br>
														Password: '. $this->input->post('password') .'<br>
														<br><br>
														'.$this->lang->line('lang46').': ' . base_url() . 'Auth/Activate/' . $ActCode . '
														
														<br><br>
														'.$this->lang->line('lang46').' ' . $this->config->item('SiteName') . '';
												$q = $this->wmrush->SendEmail($this->input->post('email'), $this->lang->line('lang48'), $Text);
												$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang37'), "success")));
												redirect( base_url() . "Auth/Register"); exit();
												//var_dump($q);
											}
											else
											{
												$this->session->set_flashdata(array("error" => $this->wmrush->Notice("ERROR!!! Try Again!!!", "error")));
												redirect( base_url() . "Auth/Register"); exit();
											}
										}
										else
										{
											$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang38'), "error")));
											redirect( base_url() . "Auth/Register"); exit();
										}
									}
									else
									{
										$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang39'), "error")));
										redirect( base_url() . "Auth/Register"); exit();
									}
								}
								else
								{
									$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang40'), "error")));
									redirect( base_url() . "Auth/Register"); exit();
								}
							}
							else
							{
								$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang41'), "error")));
								redirect( base_url() . "Auth/Register"); exit();
							}
						}
						else
						{
							$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang27'), "error")));
							redirect( base_url() . "Auth/Register"); exit();
						}
					}
					else
					{
						$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang42'), "error")));
						redirect( base_url() . "Auth/Register"); exit();
					}
				}
				else
				{
					$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang43'), "error")));
					redirect( base_url() . "Auth/Register"); exit();
				}
		}
		
		$this->session->set_userdata(array("Capt" => $this->wmrush->CapCode()));
		$this->load->view($this->_LANG . '/register');
	}
	
	
	
	
	
	
	public function Reminder()
	{
		if($this->input->post('a') && $this->input->post('a') == 'reminder' && $this->input->post('email'))
		{
			
			if(!$this->AuthModel->ExistUser($this->input->post('email'), 'email'))
			{
				$NewPass = $this->wmrush->GeneratePassword();
				if($this->AuthModel->UpdatePasswordFromUser($this->input->post('email'), $this->wmrush->ReturnPassword($NewPass)))
				{
					$Text = $this->lang->line('lang49') . ' ' . $this->config->item('SiteName') . '<br>
							You new Password: <b>'. $NewPass .'</b><br>
							<br><br>
							'.$this->lang->line('lang47').' ' . $this->config->item('SiteName') . '';
					$this->wmrush->SendEmail($this->input->post('email'), $this->lang->line('lang50'), $Text);
					$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang51'), "success")));
					redirect( base_url() . "Auth"); exit();
				}
				else
				{
					$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang2'), "error")));
					redirect( base_url() . "Auth/Reminder"); exit();
				}
				
			}
			else
			{
				$this->session->set_flashdata(array("error" => $this->wmrush->Notice($this->lang->line('lang52'), "error")));
				redirect( base_url() . "Auth/Reminder"); exit();
			}
			
			
		}
		
		
		$this->session->set_userdata(array("Capt" => $this->wmrush->CapCode()));
		$this->load->view($this->_LANG . '/reminder');
	}
	
	
	
	public function Activate()
	{
		if($this->uri->segment(3))
		{
			$ActCode = htmlspecialchars($this->uri->segment(3));
			if($this->AuthModel->CheckCodeActivate($ActCode))
			{
				echo '<center><h1>Your account has been successfully activated</h1><br><a href="/">GO TO WEBSITE</a></center>';
			}
			else
			{
				redirect(base_url());
			}
		}
		else
		{
			redirect(base_url()); exit;
		}
	}
	
	
	
}
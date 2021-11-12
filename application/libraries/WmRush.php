<?php

class WmRush
{
	
	
	private $_CI;
	
	public function __construct()
	{
		//parent::__construct();
		$this->_CI =& get_instance();
	}
	
	
	public function CapCode()
	{
		/**
		 * CAPTHA Config
		 * @var 
		 * 
		 */
		 
		$vals = array(
		        'word'          => random_string('numeric', 5),
		        'img_path'      => './captcha/',
		        'img_url'       => base_url() . 'captcha/',
		        'font_path'     => APPPATH . '/fonts/'.mt_rand(1,4).'.ttf',
		        'img_width'     => '90',
		        'img_height'    => 38,
		        'expiration'    => 3600,
		        //'word_length'   => 5,
		        'font_size'     => 14,
		        //'img_id'        => 'Imageid',
		        //'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

		        // White background and border, black text and red grid
		        'colors'        => array(
		                'background' => array(66,66,66),
		                'border' => array(255, 255, 255),
		                'text' => array(255, 255, 255),
		                'grid' => array(74,74,74)
		        )
		);

		$cap = create_captcha($vals);
		$this->_CI->session->unset_userdata("CaptWord", "CaptTicket");
		$this->_CI->session->set_userdata(array("CaptWord" => $cap['word'], "CaptTicket" => $cap['image']));
		
		return $cap['image'];
	}
	
	
	
	public function ReturnPassword($Pass)
	{
		return md5(md5(md5($this->_CI->config->item('encryption_key') . $Pass . $this->_CI->config->item('encryption_key'))));
	}
	
	
	public function Notice($Text, $Type = 'error')
	{
		if($Type == 'error')
			return '<div class="alert alert-danger">' . $Text . "</div>";
		if($Type == 'success')
			return '<div class="alert alert-success">' . $Text . "</div>";
	}
	
	
	public function SendEmail($Email, $Subject, $Message)
	{
		/*
		$this->_CI->load->library('email');
		
		//$this->_CI->email->initialize($config);
		$this->_CI->email->from($this->_CI->config->item('smtp_user'), 'Support');
		$this->_CI->email->to($Email);
		

		$this->_CI->email->subject($Subject);
		$this->_CI->email->message($Message);

		$this->_CI->email->send();
		*/
		/*
		$this->_CI->load->library('Libmail');
		
		$this->_CI->libmail->From($this->_CI->config->item('smtp_user'), 'Support');
		$this->_CI->libmail->To($Email);
		$this->_CI->libmail->Subject($Subject);
		$this->_CI->libmail->Body($Message, 'html');
		$this->_CI->libmail->smtp_on($this->_CI->config->item('smtp_host'), $this->_CI->config->item('smtp_user'), $this->_CI->config->item('smtp_pass'), $this->_CI->config->item('smtp_port'));
		$this->_CI->libmail->Send();    // а теперь пошла отправка
		*/
		require APPPATH . '/libraries/PHPMailerAutoload.php';

		$mail = new PHPMailer;
		$mail->SMTPDebug = 3;  
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $this->_CI->config->item('smtp_host');  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $this->_CI->config->item('smtp_user');                 // SMTP username
		$mail->Password = $this->_CI->config->item('smtp_pass');                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = $this->_CI->config->item('smtp_port');                                    // TCP port to connect to

		$mail->setFrom($this->_CI->config->item('smtp_user'), 'Support ' . $this->_CI->config->item('SiteName'));
		$mail->addAddress($Email);     // Add a recipient


		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $Subject;
		$mail->Body    = $Message;
		$mail->send();
		return $mail->ErrorInfo;
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
	}
	
	
	public function GeneratePassword()
	{
		$this->_CI->load->helper('string');
		return random_string('alnum', 8);
	}
	
	
	
	
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model
{
	
	/**
	* Проверка юзера на валидность
	* @param undefined $Login
	* @param undefined $Password
	* 
	* @return
	*/
	public function CheckLogin($Login, $Password)
	{
		$query = $this->db->where("uLogin", $Login)->where("uPassword", $Password)->get("db_users");
		
		if($query->num_rows() == 1)
			return $query->row_array();
		return FALSE;
	}
	
	
	
	public function UpdateInfoUserName($Uid, $Hash)
	{
		$Array = array(
				"uLastLogin" => time(),
				"uLastIpLogin" => $_SERVER['REMOTE_ADDR'],
				"uHashLogin" => $Hash
			);
			
		$this->db->where("uUid", $Uid);
		$this->db->update("db_users", $Array);
	}
	
	
	
	public function ExistUser($Value, $Type = 'login')
	{
		if($Type == 'login')
		{
			//Проверяем логин в базе
			$query = $this->db->where("uLogin", $Value)->get("db_users");
			if($query->num_rows() == 0) return TRUE;
			return FALSE;
		}
		
		if($Type == 'email')
		{
			//Проверяем мыло в базе
			$query = $this->db->where("uEmail", $Value)->get("db_users");
			if($query->num_rows() == 0) return TRUE;
			return FALSE;
		}
		
		if($Type == 'ip')
		{
			//Проверяем IP в базе
			$query = $this->db->where("uIpReg", $Value)->get("db_users");
			if($query->num_rows() <= 3) return TRUE;
			return FALSE;
		}
	}
	
	
	public function Reg($Login, $Pass, $Email, $RefId = 0, $ActivateEmail)
	{
		$Arr = array("uLogin" => $Login, "uEmail" => $Email, "uPassword" => $Pass, "uRefId" => $RefId, "uDateReg" => time(), "uIpReg" => $_SERVER['REMOTE_ADDR'], "uBalanceGHS" => 1, "uActivateEmail" => $ActivateEmail);
		if($this->db->insert("db_users", $Arr)) return TRUE;
		return FALSE;
	}
	
	
	public function UpdatePasswordFromUser($Email, $Pass)
	{
		$this->db->where("uEmail", $Email);
		if($this->db->update("db_users", array("uPassword" => $Pass))) return TRUE;
		return FALSE;
	}
	
	public function CheckCodeActivate($Act)
	{
		$query = $this->db->where("uActivateEmail", $Act)->get("db_users");
		if($query->num_rows() == 1)
		{
			$this->db->where("uActivateEmail", $Act);
			$this->db->update("db_users", array("uActivateEmail" => ''));
			return TRUE;
		}
		return FALSE;
	}
	
	
}
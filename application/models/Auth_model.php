<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_user($email, $password)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$this->db->where('password',md5($password));
		$this->db->where('status',1);
	 	$query = $this ->db-> get();
	 	return $query;
	}
}
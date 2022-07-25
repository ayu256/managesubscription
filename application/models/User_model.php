<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

    public function insert_user($post)
    {
      $this->db->insert('user',$post);
      return $this->db->insert_id();
    }
	
}
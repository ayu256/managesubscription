<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function get_user_plan()
    {

		$query =	$this->db->select('us.user_id,us.plan_name, us.plan_period_start, us.plan_period_end,u.first_name,u.last_name, u.id')
						->from('user_subscriptions as us')
						->join('user as u','us.user_id = u.id')
						->get();

      	return $query->result_array();
    }


	
}
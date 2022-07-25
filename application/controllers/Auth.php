<?php defined('BASEPATH' ) OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model("Auth_model");
	}

	public function login()
	{

		$this->form_validation->set_rules('email','Email','required'); 
		$this->form_validation->set_rules('password','Password','required'); 
        if($this->form_validation->run() === false)
	    	{

	    		$this->load->view('login');

	    	}else
	    	{
				$email    = $this->input->post('email',TRUE);
			    $password = $this->input->post('password',TRUE);

			    $validate = $this->Auth_model->get_user($email, $password);
			    
			    if($validate->num_rows() > 0){

			        $data  = $validate->row_array();

			        $uid =     $data['id'];
			        $status  = $data['status'];
			        $email = $data['email'];
			        $role = $data['role'];

			        $sesdata = array(
			            'userid'    => $uid,
			            'status'    => $status,
			            'email'     => $email,
			            'role' 		=> $role,
			            'logged_in' => TRUE
			        );

			        $this->session->set_userdata($sesdata);
			         redirect('plan');
			    }else{

			        echo $this->session->set_flashdata('msg','Invalid Credentials');
			        redirect('auth/login');
			    }
			}
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();

		redirect('auth/login');
	}

}
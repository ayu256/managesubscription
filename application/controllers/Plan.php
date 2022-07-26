<?php defined('BASEPATH' ) OR exit('No direct script access allowed');

class Plan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model("plan_model");
        $this->load->view('admin/header');
        require_once('application/libraries/stripe-php-master/init.php');

        if($this->session->userdata('logged_in') != TRUE){

            redirect('auth/login');

         }else{
            
         }   
	}

	public function index()
	{

        $stripe = new \Stripe\StripeClient(STRIPE_SECRET_KEY);
        $products = $stripe->products->all(['limit' => 2]);
      
        $data['plans'] = [];
        foreach($products as $product){

            $stripe = new \Stripe\StripeClient(STRIPE_SECRET_KEY);
            $actualprice =  $stripe->prices->retrieve( $product['default_price'],  [] );
            $product['actual_price'] = $actualprice['unit_amount']/100;
            $product['currency'] = $actualprice['currency'];
            $data['plans'][] = $product;
        }
       
        $this->load->view('admin/plan_list',$data);
        $this->load->view('admin/footer');
    }

    public function list()
    {
        $data['list'] = $this->plan_model->get_user_plan();
        
        $this->load->view('admin/user_list' , $data);
        $this->load->view('admin/footer');
    }
}
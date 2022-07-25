<?php defined('BASEPATH' ) OR exit('No direct script access allowed');

class Plan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model("plan_model");
        $this->load->view('admin/header');
        require_once('application/libraries/stripe-php-master/init.php');

	}

	public function index()
	{

        $stripe = new \Stripe\StripeClient(STRIPE_SECRET_KEY);
        $products = $stripe->products->all(['limit' => 2]);
        // echo"<pre>";
        // print_r($data);
        $data['plans'] = [];
        foreach($products as $product){

            $stripe = new \Stripe\StripeClient(STRIPE_SECRET_KEY);
            $actualprice =  $stripe->prices->retrieve( $product['default_price'],  [] );
            $product['actual_price'] = $actualprice['unit_amount'];
            $product['currency'] = $actualprice['currency'];
            $data['plans'][] = $product;
        }
        // echo"<pre>";
        // print_r($data);
        $this->load->view('admin/plan_list',$data);
        $this->load->view('admin/footer');
    }
}
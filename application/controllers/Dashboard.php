<?php defined('BASEPATH' ) OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model("user_model");
        $this->load->view('user/header');
        require_once('application/libraries/stripe-php-master/init.php');

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
        
        $this->load->view('user/pricing',$data);
        $this->load->view('user/footer');
    }

    public function checkout()
    {
        $this->load->view('user/checkout');
        $this->load->view('user/footer');
    }
    // create subscription
    public function create() {
       
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

        $token  = $this->input->post('stripeToken');
        $fname = $this->input->post('first_name');
        $lname = $this->input->post('last_name');
        $email  = $this->input->post('email');
        $plan_id  = $this->input->post('subscr_plan');
        $price  = $this->input->post('price');
        $amount  = $this->input->post('amount');
        

        $time = time();
        // $plan = \Stripe\Plan::create(array( 
        //     "product" => [
        //         "name" => $plan,
        //         "type" => "service"
        //     ],
        //     "nickname" => $plan,
        //     "interval" => $interval,
        //     "interval_count" => "1",
        //     "currency" => $currency,
        //     "amount" => ($price*100) ,
        // ));

        $customer = \Stripe\Customer::create([
            'name' => $fname.' '.$lname ,
            'email' => $email,
            'source'  => $token,
        ]);

      

        $subscription = \Stripe\Subscription::create(array(
            "customer" => $customer->id,
            "items" => array(
                array(
                    "price" =>   $price,
                ),
            ),
        ));
        print_r($subscription);
        $subscription_id =  $subscription->id;
      
        $customerdata = array(
            'first_name' => $fname,
            'last_name' => $lname,
            'email' =>  $email,
            'role' => 2,
            'password' => md5('12345'),
            'subscription_id' => $subscription_id,
            'status' => 1
        );

        $customer_id = $this->user_model->insert_user($customerdata);
        
        // $subscription_data = array(
        //     'user_id'=> $customer_id,
        //     'plan_id'=> $customer_id,
        //     'payment_method'=> $customer_id,
        //     'user_id'=> $customer_id,
        //     'user_id'=> $customer_id,
        //     'user_id'=> $customer_id,
        //     'user_id'=> $customer_id,
        //     'user_id'=> $customer_id,
        //     'user_id'=> $customer_id,
        //     'user_id'=> $customer_id,

        // );
        $data['amount'] = $amount;
        $this->session->set_flashdata('amount', $amount);  
        //redirect('dashboard/thankyou');
    }

    // successfully pay
    public function thankyou() {
       
        $data['amount'] = $this->session->flashdata('amount');
        $this->load->view('user/thankyou', $data);   
    }

}
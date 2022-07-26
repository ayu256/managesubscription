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

        //to fetch plan name 
        $plan = \Stripe\Plan::retrieve(
            $price
        );
        //to fetch product name
        $product = \Stripe\Product::retrieve(
            $plan->product
        );
          
        //customer insertion data
        $customerdata = array(
            'first_name' => $fname,
            'last_name' => $lname,
            'email' =>  $email,
            'role' => 2,
            'password' => md5('12345'),
            'subscription_id' => $subscription->id,
            'status' => 1
        );

        $customer_id = $this->user_model->insert_user($customerdata);
      

        //subcription insertion data
        $subscription_data = array(
            'user_id'=> $customer_id,
            'payment_method'=> 'card',
            'stripe_subscription_id'=> $subscription->id,
            'stripe_customer_id'=> $subscription->customer,
            'stripe_plan_id'=> $subscription->items->data[0]->plan->id,
            'plan_name'=>$product->name,
            'plan_amount'=> $amount,
            'plan_amount_currency'=> 'usd',
            'plan_period_start'=> date("Y-m-d H:i:s", $subscription->current_period_start),
            'plan_period_end'=> date("Y-m-d H:i:s", $subscription->current_period_end),
            'payer_email'=> $email,
            'status' => $subscription->status

        );
        
        $this->user_model->insert_subscription($subscription_data);

        $data['amount'] = $amount;
        $this->session->set_flashdata('amount', $amount);  
       redirect('dashboard/thankyou');
    }

    // successfully pay
    public function thankyou() {
       
        $data['amount'] = $this->session->flashdata('amount');
        $this->load->view('user/thankyou', $data);   
    }
    
}
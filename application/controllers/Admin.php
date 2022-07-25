<?php
class Admin extends CI_Controller {

        public function index()
        {
                $this->load->view('user/header');
                $this->load->view('user/pricing');
                $this->load->view('user/footer');
        }
}

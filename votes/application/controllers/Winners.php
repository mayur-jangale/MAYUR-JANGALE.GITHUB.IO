<?php
class Winners extends CI_Controller{
     public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('cookie');
        $this->load->model('Peoples');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('user_agent');
        $this->load->library('session');
    }
    public function index(){
            $this->load->view('winners');
    }
}
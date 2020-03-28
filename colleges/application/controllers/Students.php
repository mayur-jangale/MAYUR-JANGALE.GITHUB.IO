<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('cookie');
        $this->load->model('Studmodel');
         $this->load->model('user');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('user_agent');
        $this->load->library('session');
    }
    
    public function index()
    {
        $uid=$this->session->userdata('userId');
         
        
    }
    
    public function register()
    {
        $data = array();
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        $classrand=$this->uri->segment(3);
        
         if($classrand=='')
             echo 'invalid class url';
         else{
                $data['classdata']=$this->Studmodel->classdata($classrand);
                foreach( $data['classdata'] as $row)
                    $cid=$row->id;
                if($this->input->post('login')){
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('password', 'password', 'required');
                if ($this->form_validation->run() == true) {
                   $con['returnType'] = 'single';
                   $con['conditions'] = array(
                       'user_email'=>$this->input->post('email'),
                       'user_password' => strtolower(sha1(md5($this->input->post('password'))))
                   );
                   $checkLogin = $this->user->getRows($con);
                   if($checkLogin){
                       $this->session->set_userdata('isUserLoggedIn',TRUE);
                       $this->session->set_userdata('userId',$checkLogin['user_id']);
                       $this->Studmodel->userclass($checkLogin['user_id'],$cid);
                       $this->Studmodel->class_user_incre($cid);
                   }
                   else{
                       $data['error_msg'] = 'Wrong email or password, please try again.';
                   }
               }
           }elseif($this->input->post('signup'))
            {
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
                $this->form_validation->set_rules('password', 'password', 'required');
                $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');

                $userData = array(
                    'user_fullname' => strip_tags($this->input->post('name')),
                    'user_email' => strip_tags($this->input->post('email')),
                    'mobileno' => strip_tags($this->input->post('mobile')),
                    'user_password' => strtolower(sha1(md5($this->input->post('password')))),
                    'user_gender' => $this->input->post('gender'),
                    'type' => 1
                        );
                $data['user'] = $userData;
                if($this->form_validation->run() == true){
                    $insert = $this->user->insert($userData);
                    if($insert){
                        $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                        $this->Studmodel->userclass($insert,$cid);
                        $this->Studmodel->class_user_incre($cid);
                        $this->session->set_userdata('isUserLoggedIn',TRUE);
                        $this->session->set_userdata('userId',$insert);
                        //redirect('');
                    }else{
                        $data['error_msg'] = 'Some problems occured, please try again.';
                        echo 'eror';
                    }
                }
            }
          //load the view
            if($this->session->userdata('isUserLoggedIn')){
                $this->Studmodel->userclass($this->session->userdata('userId'),$cid);
                $this->Studmodel->class_user_incre($cid);
                redirect("/users/dash");  
            }else{
               $this->load->view('stud/register',$data);
           }
           
        } 
    }
    
    public function email_check($str){
        $con['returnType'] = 'count';
        $con['conditions'] = array('user_email'=>$str);
        $checkEmail = $this->user->getRows($con);
        if($checkEmail > 0){
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
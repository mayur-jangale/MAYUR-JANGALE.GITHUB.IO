<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller { 
        function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user');
        $this->load->model('Peoples');
         $this->load->model('Classrooms');
        $this->load->library('session');
         $this->load->helper('url');
        $this->load->database();
    }
    
    
    public function index()
	{
		redirect("/users/login"); 
	}
        
    
    public function dash(){
         $data = array();
        if($this->session->userdata('isUserLoggedIn')){
            $uid=$this->session->userdata('userId');
            $data['user'] = $this->user->getRows(array('id'=>$uid));
            $data['studno']=$this->Classrooms->countstud($uid);
            $data['classno']=$this->Classrooms->countclass($uid);
            $data['annono']=$this->Classrooms->countanno($uid);
            $data['data'] = $this->Classrooms->announceall($uid);
            $this->load->view('dash', $data);
        }else{
            redirect("/users/login");
        }
    }
        
    public function login(){
        $data = array();
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        if($this->input->post('email')){
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
                   header("Location: /users/step1");
                    
                }else{
                    $data['error_msg'] = 'Wrong email or password, please try again.';
                }
            }
        }
        //load the view
        if($this->session->userdata('isUserLoggedIn')){
          redirect("/users/dash");  
        }else{
        $this->load->view('login',$data);
        }
    }
    
    public function logout(){
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        header("Location: /users/login");
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
    
   
    
    public function delete(){
        $id=$this->uri->segment('3');
        $this->db->where('id', $id);
        $this->db->delete('comment');
        $this->session->set_flashdata('msg', 'Profile has been updated');
        redirect('/users/dash'); 
    }
     
    public function update(){
        $name=$this->input->post('name'); 
        $cityid=$this->input->post('city'); 
        $dat = array(
            'user_fullname'=>$name,
            'cityid'=>$cityid
            );
        $id=$this->session->userdata('userId'); 
        $this->user->updatepro($dat,$id);
        $this->session->set_flashdata('msg', 'Profile has been updated');
        redirect('/users/dash');
    }
    
	 public function rand_string( $length ) {  
		$chars = "abcdefghijklmnopqrstuvwxyz";  
		$size = strlen( $chars );  
		echo "Random string =";  
		for( $i = 0; $i < $length; $i++ ) {  
		$str= $chars[ rand( 0, $size - 1 ) ];  
		echo $str;  
		}  
	}  
 
	
    public function register(){
        if($this->session->userdata('isUserLoggedIn')){
          redirect("/users/dash");  
        }else{
            $data = array();
        $userData = array();
        if($this->input->post('Submit')){
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');
			
            $userData = array(
				
                'user_fullname' => strip_tags($this->input->post('name')),
                'user_email' => strip_tags($this->input->post('email')),
                'user_password' => strtolower(sha1(md5($this->input->post('password')))),
                'user_gender' => $this->input->post('gender'),
               
            );
            $dat['udata']=userData;
            if($this->form_validation->run() == true){
                $insert = $this->user->insert($userData);
                if($insert){
                    $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    redirect('/users/login');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }
        $data['user'] = $userData;
        //load the view
        $this->load->view('registration', $data);
        }
    }
}

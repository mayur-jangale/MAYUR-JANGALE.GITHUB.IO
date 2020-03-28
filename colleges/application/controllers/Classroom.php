<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('cookie');
        $this->load->model('user');
        $this->load->model('Classrooms');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('user_agent');
        $this->load->library('session');
        
    }
    
    public function index()
    {
        $uid=$this->session->userdata('userId');
        if(!$this->session->userdata('isUserLoggedIn')){
            redirect("/users/login");
        }
        $data['user'] = $this->user->getRows(array('id'=>$uid));
        $data['data']=$this->Classrooms->userall($uid);
        $data['studno']=$this->Classrooms->countstud($uid);
	$this->load->view('classrooms',$data);
    }
    
    public function newclass() 
    {
        $uid=$this->session->userdata('userId');
        if(!$this->session->userdata('isUserLoggedIn')){
            redirect("/users/login");
        }
        $data['user'] = $this->user->getRows(array('id'=>$uid));
        if($this->input->post('name')){
            $this->form_validation->set_rules('quantity', 'Quantity', 'required');
            $this->form_validation->set_rules('cname', 'College name', 'required');
            if ($this->form_validation->run() == true) {
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'id' => '', 
                    'name'=>$this->input->post('name'),
                    'owner' => $uid,
                    'max_quantity' => $this->input->post('quantity'),
                    'cname' => $this->input->post('cname'),
                    'time' => '',
                    'rands' => rand(1,9999999)
                );
           
                if($this->form_validation->run() == true){
                    $insert = $this->Classrooms->insert_classrooms($con['conditions']);
                    if($insert){
                        $this->session->set_userdata('success_msg', '<div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
              Classroom Created </div>');
                       redirect('/Classroom');
                    }else{
                        $data['error_msg'] = '<div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                Some problems occured, please try again.</div>';
                        redirect('');
                    }
            } 
            } 
        } else {
            
            $this->load->view('newclass',$data);
            }
          
    }
    
    public function edit()
    {
        if(!$this->session->userdata('isUserLoggedIn')){
            redirect("/users/login");
        }
        $uid=$this->session->userdata('userId');
        $data['user'] = $this->user->getRows(array('id'=>$uid));
        $id=$this->uri->segment(3); 
        $data['id']=$id;
        $data['row']=$this->Classrooms->classbyid($id,$uid);
        
            if($this->session->userdata('success_msg')){
                $data['success_msg'] = $this->session->userdata('success_msg');
                $this->session->unset_userdata('success_msg');
            }
            if($this->session->userdata('error_msg')){
                $data['error_msg'] = $this->session->userdata('error_msg');
                $this->session->unset_userdata('error_msg');
            }
            if($this->input->post('name')){
                $this->form_validation->set_rules('quantity', 'Quantity', 'required');
                $this->form_validation->set_rules('cname', 'College name', 'required');
                if ($this->form_validation->run() == true) {
                    $con['returnType'] = 'single';
                    $con['conditions'] = array(
                        
                        'name'=>$this->input->post('name'),
                        
                        'max_quantity' => $this->input->post('quantity'),
                        'cname' => $this->input->post('cname')
                    );

                    if($this->form_validation->run() == true){
                        $insert = $this->Classrooms->upadate_classrooms($con['conditions'],$id,$uid);
                       
                        if($insert){
                            $this->session->set_userdata('success_msg', '<div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
              Classroom Edited </div>');
                            redirect('/classroom');
                        }else{
                            $data['error_msg'] = '<div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                Some problems occured, please try again.</div>';
                            redirect('/classroom');
                        }
                    } 
                } 
            } else { 
                $this->load->view('editclass',$data);
            }      
        
    }
    public function open()
    {
        if(!$this->session->userdata('isUserLoggedIn')){
            redirect("/users/login");
        }
        $classid=$this->uri->segment(3); 
        $uid=$this->session->userdata('userId');
        $data['user'] = $this->user->getRows(array('id'=>$uid));
        $data['data']=$this->Classrooms->annouceall($classid,$uid);
        $data['class']=$this->Classrooms->classbyid($classid,$uid);
	$this->load->view('openclass',$data);
    }
    
    public function invite()
    {
        if(!$this->session->userdata('isUserLoggedIn')){
            redirect("/users/login");
        }
        $classid=$this->uri->segment(3); 
        $uid=$this->session->userdata('userId');
        $data['user'] = $this->user->getRows(array('id'=>$uid));
        $data['class']=$this->Classrooms->classbyid($classid,$uid);
	$this->load->view('invite',$data);
    }
    
    
    
}
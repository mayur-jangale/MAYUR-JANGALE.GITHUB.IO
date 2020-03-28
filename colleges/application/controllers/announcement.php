<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcement extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('user');
        $this->load->helper('cookie');
        $this->load->model('Classrooms');
        $this->load->library('form_validation');
        $this->load->helper('url');
		$this->load->library('email');
        $this->load->library('user_agent');
        $this->load->library('session');
    }
    
    public function index()
    {
        $uid=$this->session->userdata('userId');
        $data['user'] = $this->user->getRows(array('id'=>$uid));
        $data['class']=$this->Classrooms->userall($uid); 
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        if($this->input->post('title')){
            $this->form_validation->set_rules('desc', 'Description', 'required');
			$cid =$this->input->post('cid');
            if ($this->form_validation->run() == true) {
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'id' => '',
                    'owner' => $uid,
                    'title'=>$this->input->post('title'),
                    'content'=>$this->input->post('desc'),
                    'dlink' => $this->input->post('link'),
                    'cid' => $cid
                );
           
                if($this->form_validation->run() == true){
                    $insert = $this->Classrooms->insert_announce($con['conditions']);
					$emailarr= $this->Classrooms->fetchemails($cid);
					$email ='mayurjangale1@gmail.com';
					foreach($emailarr as $id)
						$email .= ','.$id->user_email;
                    if($insert){
						 //Send the email
                    $config['protocol'] = 'sendmail';
                    $config['mailpath'] = '/usr/sbin/sendmail';
                    $config['charset'] = 'iso-8859-1';
                    $config['wordwrap'] = TRUE;

                    $this->email->initialize($config);
                    $this->email->from('no-reply@classbroom.me', 'Classbroon.me Colleges');
                    $this->email->to('mayurjangule1@gmail.com');
                    $this->email->bcc($email);
                    $this->email->subject('New Announcement from Classbroom.me Colleges('.$insert.')');
                    $this->email->message('Hello Dear user you have new annoucement for the Classbroom.me Colleges Class. Click on the following link to login and check. https://colleges.classbroom.me/users/login/');

                    $this->email->send();
                    if ($this->email->send(FALSE))
{
       echo 'failed'; // Parameters won't be cleared
}
                    //end email sending
                        $this->session->set_userdata('success_msg', '<div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
              Announcement sent </div>');
                        redirect('/announcement');
                    }else{
                        $data['error_msg'] = '<div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                Some problems occured, please try again.</div>';
                        redirect('/announcement');
                    }
            } 
            } 
        } else {
	$this->load->view('newannounce',$data);
        }
    }   
    public function edit()
    {
        $annid=$this->uri->segment(3); 
        $uid=$this->session->userdata('userId');
        $data['user'] = $this->user->getRows(array('id'=>$uid));
        $data['data']=$this->Classrooms->annoucebyid($annid,$uid); 
        //$data['class']=$this->Classrooms->classname('');
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        if($this->input->post('title')){
            $this->form_validation->set_rules('desc', 'Description', 'required');
            if ($this->form_validation->run() == true) {
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'owner' => $uid,
                    'title'=>$this->input->post('title'),
                    'content'=>$this->input->post('desc'),
                    
                );
           
                if($this->form_validation->run() == true){
                    $insert = $this->Classrooms->update_announce($con['conditions'],$annid,$uid);
                    if($insert){
                        $this->session->set_userdata('success_msg', '<div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
              Announcement sent </div>');
                        redirect('/announcement');
                    }else{
                        $data['error_msg'] = '<div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                Some problems occured, please try again.</div>';
                       redirect('/announcement');
                    }
            } 
            } 
        } else {
	$this->load->view('editannouncement',$data);
        }
    } 
    
    public function open()
    {
        $annid=$this->uri->segment(3); 
        $uid=$this->session->userdata('userId');
        $data['user'] = $this->user->getRows(array('id'=>$uid));
        if($data['user']['type']==1){
            $data['data']=$this->Classrooms->annoucebyaid($annid);
        }
        else{
        $data['data']=$this->Classrooms->annoucebyid($annid,$uid);
        }
        $this->load->view('viewannouncement',$data);
    }
}
    
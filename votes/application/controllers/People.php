<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class People extends CI_Controller {
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
    
    
    
             
    public function index()
    {
        if(is_null(get_cookie('location')) || get_cookie('location')==0){
            $data['location']->name = 'India';
            $cid= 'India';
        }else{
            $cid = get_cookie('location');
            $data['location']=$this->Peoples->city($cid);
        } 
        $data['data']=$this->Peoples->all($cid);
	$this->load->view('people',$data);
    }
    
    public function vote()
    {   
        $id=  $this->uri->segment('3');
        if(is_null(get_cookie($id.'votescookie0000000000000000000000000000'))){
            $this->Peoples->vote($id);
            $this->input->set_cookie($id.'votescookie0000000000000000000000000000',$id.'votescookie0000000000000000000000000000',86000);
            $this->session->set_flashdata('msg', 'Your vote has been noted Successfully');
        }
        $data['row']=$this->Peoples->profile($id);
        $data['comment']=$this->Peoples->comments($id);
        //set location
        if(is_null(get_cookie('location'))){
            $city=$data['profile']->cityid;
            $this->input->set_cookie('location',$city,'86000');
        }
	$this->load->view('write',$data); 
    }
     
    public function write()
    {
        $id=$this->uri->segment('3');
        $by=$this->input->post('name'); 
        $this->form_validation->set_rules('comment', 'Comment', 'required');
        if ($this->form_validation->run() == TRUE)
        {
           $comment=   $this->input->post('comment');
           $ip=$this->input->ip_address();
           $dat = array(
            'comment'=>$comment,
            'ip'=>$ip,
            'user'=>$by,
            'stud'=>$id
            );
           $this->db->insert('comment',$dat);
           $this->session->set_flashdata('msg', 'Comment Added Successfully');
        }
        redirect($this->agent->referrer());  
    }
    
    public function search()
    {
      $this->load->view('search');   
    }
    
    public function results()
    {
        $key=$this->input->post('key'); 
        $cid=$this->input->post('city'); 
        $data['results']=$this->Peoples->search($key,$cid);
	$this->load->view('searchres',$data); 
    }
    
 
    
    public function newpro()
    {
        redirect("https://social.classbroom.me/register?redirect=resume"); 
    }
    
    
    public function contact(){
        $this->load->view('contact'); 
    }
    
    public function cwrite(){
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('num', 'Contact No', 'required');
        $this->form_validation->set_rules('sub', 'Subject', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        if ($this->form_validation->run() == TRUE)
        {   
            $name=   $this->input->post('name');
            $email=   $this->input->post('email');
            $con=   $this->input->post('num'); 
            $sub=   $this->input->post('sub'); 
            $message=   $this->input->post('message'); 
            $myfile = fopen("contact1/newfile.txt".rand(), "w") or die("Unable to open file!");
            $txt =  "Name:".$name
                    . "\nEmail:".$email  
                    . "\nContact:".$con
                    . "\nSubject:".$sub 
                    . "\nMessaage".$message
                    . "\n.....................................................................................\n\n";
            fwrite($myfile, $txt);
            fclose($myfile);
        }
        $this->load->view('contact');     
    }
    
    public function change(){
        if(is_null(get_cookie('location')) || get_cookie('location')==0){
            $data['location']->name= 'India';
        }else{
         $cid= get_cookie('location');
         $data['location']=$this->Peoples->city($cid);
        } 
        if(null !==($this->input->post('city'))){
           delete_cookie('location'); 
           $this->input->set_cookie('location',($this->input->post('city')),'86000');
           redirect('');
        }
        $this->load->view('changelocation', $data); 
    }
    

    
    
}


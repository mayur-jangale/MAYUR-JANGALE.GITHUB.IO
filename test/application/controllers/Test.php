<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Questions_model');
        $this->load->library('form_validation');
    
        $this->load->helper('url');
       
    }
	
	public function index()
	{
		$this->load->view('welcome_message');
	}
        
        public function que()
        {
            $type=$this->uri->segment('3');
            if($type=='')
                redirect('/'); 
            $qno=$this->input->post('qno');
             $result=$this->Questions_model->type($type)->row();
             $typeid=$result->id;
             if($typeid=='')
                redirect('/'); 
             
            $data['type']= $type;
            if($typeid=='')
               redirect('/'); 
            
            $correct=$this->input->post('correct');
            if($qno=='')   
            {
                $data['qno']=1;
                $data['correct']=$correct;
                $data['results']=$this->Questions_model->que($typeid);
                $this->load->view('que', $data);
            }
            elseif($qno>=21){
                $data['correct']=$correct;
                $this->load->view('result', $data);
            } else {
                $data['qno']= $qno;
                $data['correct']=$correct;
                $data['results']=$this->Questions_model->que($typeid);
                $this->load->view('que',$data); 
            }
        } 
        
        public function ans()
        {
            $type=$this->uri->segment('3');
            if($type=='')
                redirect('/'); 
           
             $result=$this->Questions_model->type($type)->row();
             $typeid=$result->id;
             if($typeid=='')
                redirect('/'); 
             
            $data['type']= $type;
            $qno=$this->input->post('qno');
            $correct=$this->input->post('correct');
            $data['qno']=$qno;
            $data['correct']=$correct;
            $data['results']=$this->Questions_model->queno($this->input->post('id'));
                
            $data['comment']=$this->Questions_model->comment($this->input->post('id'));
            $ans=$this->input->post('ans');
            $data['ans']=$ans;
            $this->load->view('ans',$data);        
        } 
		
        public function question()
        {
            $id=$this->uri->segment('3');
            if($id=='')
                redirect('/');  
            $data['results']=$this->Questions_model->queno($id);
            
            $this->form_validation->set_rules('comment', 'Comment', 'required');
            if ($this->form_validation->run() == TRUE)
            {
		$comment=   $this->input->post('comment');
		$ip=$this->input->ip_address();
		$dat = array(
		'comment'=>$comment,
		'ip'=>$ip,
		
		'que'=>$id
		);
		$this->db->insert('comment',$dat);
		
	
            }
	    $data['comment']=$this->Questions_model->comment($id);
            $this->load->view('question',$data);        
        }
}

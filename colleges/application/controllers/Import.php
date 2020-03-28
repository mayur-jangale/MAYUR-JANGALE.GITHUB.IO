<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class import extends CI_Controller {
 
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
		$this->load->library('excel');
         
    }
	
    function index()
	{
        if(!$this->session->userdata('isUserLoggedIn')){
            redirect("/users/login");
        }
        $uid=$this->session->userdata('userId');
        $data['class']=$this->Classrooms->userall($uid); 
        $data['user'] = $this->user->getRows(array('id'=>$uid));
       
        if($this->input->post('submit')){
            $this->form_validation->set_rules('cid', 'Class', 'required');
			
		    if($this->form_validation->run() == true){
				$config = array(
			'upload_path'   => 'upload/',
			'allowed_types' => 'xls|xlsx'
		);
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$s = $this->upload->do_upload('efile') ;
		echo $s;
		$data = $this->upload->data();
			@chmod($data['full_path'], 0777);
		/*	$this->load->library('Spreadsheet_Excel_Reader');
			$this->spreadsheet_excel_reader->setOutputEncoding('CP1251');
			$this->spreadsheet_excel_reader->read($data['full_path']);
			$sheets = $this->spreadsheet_excel_reader->sheets[0];
			error_reporting(0);
			$data_excel = array();
			for ($i = 2; $i <= $sheets['numRows']; $i++) {
				if ($sheets['cells'][$i][1] == '') break;
				$data_excel[$i - 1]['roll']    = $sheets['cells'][$i][1];
				$data_excel[$i - 1]['name']   = $sheets['cells'][$i][2];
				echo $data_excel[$i - 1]['name'];
			}
			$this->db->insert_batch('tb_import', $data_excel);
			// @unlink($data['full_path']);
			redirect('import');
*/		}
	
	
						$insert = 0;
                    
					if($insert){
                        $this->session->set_userdata('success_msg', '<div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
              Announcement sent </div>');
                      // redirect('/import');
                    }else{
                        $data['error_msg'] = '<div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                Some problems occured, please try again.</div>';
                      // redirect('/import');
                    }
            
		
        }else
	$this->load->view('import',$data);
        
    }
	
}

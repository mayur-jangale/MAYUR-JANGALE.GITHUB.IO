<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Attend extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('user');
        $this->load->helper('cookie');
        $this->load->model('Classrooms');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('user_agent');
        $this->load->library('session');
    }
    
    public function index()
    {
        if(!$this->session->userdata('isUserLoggedIn')){
            redirect("/users/login");
        }
        $uid=$this->session->userdata('userId');
        $data['class']=$this->Classrooms->userall($uid); 
        $data['user'] = $this->user->getRows(array('id'=>$uid));
       
        if($this->input->post('submit')){
            $this->form_validation->set_rules('cid', 'Class', 'required');
			$atttime=$this->input->post('date');
            $time  = strtotime($atttime);
            $d  = date('d',$time);
            $m = date('m',$time);
            $y  = date('Y',$time);
            $nooflec= $this->input->post('nooflecs');
            $arr[]=array(
            '1' => $this->input->post('roll1'),
            '2' => $this->input->post('roll2'),
            '3' => $this->input->post('roll3'),
            '4' => $this->input->post('roll4'),
            '5' => $this->input->post('roll5'),
            '6' => $this->input->post('roll6'),
            '7' => $this->input->post('roll7'),
            '8' => $this->input->post('roll8'),
            '9' => $this->input->post('roll9'),
            '10' => $this->input->post('roll10'),
            '11' => $this->input->post('roll11'),
            '12' => $this->input->post('roll12'),
            '13' => $this->input->post('roll13'),
            '14' => $this->input->post('roll14'),
            '15' => $this->input->post('roll15'),
            '16' => $this->input->post('roll16'),
            '17' => $this->input->post('roll17'),
            '18' => $this->input->post('roll18'),
            '19' => $this->input->post('roll19'),
            '20' => $this->input->post('roll20'),
            '21' => $this->input->post('roll21'),
            '22' => $this->input->post('roll22'),
            '23' => $this->input->post('roll23'),
            '24' => $this->input->post('roll24'),
            '25' => $this->input->post('roll25'),
            '26' => $this->input->post('roll26'),
            '27' => $this->input->post('roll27'),
            '28' => $this->input->post('roll28'),
            '29' => $this->input->post('roll29'),
            '30' => $this->input->post('roll30'),
            '31' => $this->input->post('roll31'),
            '32' => $this->input->post('roll32'),
            '33' => $this->input->post('roll33'),
            '34' => $this->input->post('roll34'),
            '35' => $this->input->post('roll35'),
            '36' => $this->input->post('roll36'),
            '37' => $this->input->post('roll37'),
            '38' => $this->input->post('roll38'),
            '39' => $this->input->post('roll39'),
            '40' => $this->input->post('roll40'),
            '41' => $this->input->post('roll41'),
            '42' => $this->input->post('roll42'),
            '43' => $this->input->post('roll43'),
            '44' => $this->input->post('roll44'),
            '45' => $this->input->post('roll45'),
            '46' => $this->input->post('roll46'),
            '47' => $this->input->post('roll47'),
            '48' => $this->input->post('roll48'),
            '49' => $this->input->post('roll49'),
            '50' => $this->input->post('roll50'),
            '51' => $this->input->post('roll51'),
            '52' => $this->input->post('roll52'),
            '53' => $this->input->post('roll53'),
            '54' => $this->input->post('roll54'),
            '55' => $this->input->post('roll55'),
            '56' => $this->input->post('roll56'),
            '57' => $this->input->post('roll57'),
            '58' => $this->input->post('roll58'),
            '59' => $this->input->post('roll59'),
            '60' => $this->input->post('roll60'),
            '61' => $this->input->post('roll61'),
            '62' => $this->input->post('roll62'),
            '63' => $this->input->post('roll63'),
            '64' => $this->input->post('roll64'),
            '65' => $this->input->post('roll65'),
            '66' => $this->input->post('roll66'),
            '67' => $this->input->post('roll67'),
            '68' => $this->input->post('roll68'),
            '69' => $this->input->post('roll69'),
            '70' => $this->input->post('roll70'),
            '71' => $this->input->post('roll71'),
            '72' => $this->input->post('roll72'),
            '73' => $this->input->post('roll73'),
            '74' => $this->input->post('roll74'),
            '75' => $this->input->post('roll75'),
            '76' => $this->input->post('roll76'),
            '77' => $this->input->post('roll77'),
            '78' => $this->input->post('roll78'),
            '79' => $this->input->post('roll79'),
            '80' => $this->input->post('roll80'),
            '81' => $this->input->post('roll81'),
            '82' => $this->input->post('roll82'),
            '83' => $this->input->post('roll83'),
            '84' => $this->input->post('roll84'),
            '85' => $this->input->post('roll85'),
            '86' => $this->input->post('roll86'),
            '87' => $this->input->post('roll87'),
            '88' => $this->input->post('roll88'),
            '89' => $this->input->post('roll89'),
            '90' => $this->input->post('roll90'),
            '91' => $this->input->post('roll91'),
            '92' => $this->input->post('roll92'),
            '93' => $this->input->post('roll93'),
            '94' => $this->input->post('roll94'),
            '95' => $this->input->post('roll95'),
            '96' => $this->input->post('roll96'),
            '97' => $this->input->post('roll97'),
            '98' => $this->input->post('roll98'),
            '99' => $this->input->post('roll99'),
            '100' => $this->input->post('roll100'),
            '101' => $this->input->post('roll101'),
            '102' => $this->input->post('roll102'),
            '103' => $this->input->post('roll103'),
            '104' => $this->input->post('roll104'),
            '105' => $this->input->post('roll105'),
            '106' => $this->input->post('roll106'),
            '107' => $this->input->post('roll107'),
            '108' => $this->input->post('roll108'),
            '109' => $this->input->post('roll109'),
            '110' => $this->input->post('roll110'),
            '111' => $this->input->post('roll111'),
            '112' => $this->input->post('roll112'),
            '113' => $this->input->post('roll113'),
            '114' => $this->input->post('roll114'),
            '115' => $this->input->post('roll115'),
            '116' => $this->input->post('roll116'),
            '117' => $this->input->post('roll117'),
            '118' => $this->input->post('roll118'),
            '119' => $this->input->post('roll119'),
            '120' => $this->input->post('roll120')
                        );
           
            if ($this->form_validation->run() == true) {
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'id' => '',
                    'data'=> json_encode($arr),
                    'cid' => $this->input->post('cid'),
                    'date' => $d,
                    'month' => $m,
                    'year' => $y,
                    'uid' => $uid,
					'dateofatt'	=>	$atttime
                );
                if($this->form_validation->run() == true){
					for($i=0;$i<$nooflec;$i++)
					{
						$insert = $this->Classrooms->insert_attend($con['conditions']);
                    }
					if($insert){
                        $this->session->set_userdata('success_msg', '<div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
              Announcement sent </div>');
                       redirect('/attend');
                    }else{
                        $data['error_msg'] = '<div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                Some problems occured, please try again.</div>';
                       redirect('/attend');
                    }
            } 
            } 
        } else {
	$this->load->view('attend',$data);
        }
    }
    
    public function edit()
    {
        if(!$this->session->userdata('isUserLoggedIn')){
            redirect("/users/login");
        }
        
        if(empty($id=$this->uri->segment(3)))
            {
            if(!$this->input->post('submit'))
            {
                $uid=$this->session->userdata('userId');
                $data['user'] = $this->user->getRows(array('id'=>$uid));
                $data['class']=$this->Classrooms->userall($uid); 
                $this->load->view('edit 1',$data);
            }else
            {
                $cid=$this->input->post('cid');
                $this->input->post('date');
                $time  = strtotime($this->input->post('date'));
                $d  = date('d',$time);
                $m = date('m',$time);
                $y  = date('Y',$time);
                $uid=$this->session->userdata('userId');
                $data['user'] = $this->user->getRows(array('id'=>$uid));
                $data['record']=$this->Classrooms->attedfetchedit($cid,$y,$m,$d,$uid);
                $this->load->view('edit 2',$data);
            }
        }else
        {
            $uid=$this->session->userdata('userId');
            $data['user'] = $this->user->getRows(array('id'=>$uid));
            $aid=$this->uri->segment(3);
            if($this->input->post('submit'))
            {
                $arr[]=array(
                '1' => $this->input->post('roll1'),
                '2' => $this->input->post('roll2'),
                '3' => $this->input->post('roll3'),
                '4' => $this->input->post('roll4'),
                '5' => $this->input->post('roll5'),
                '6' => $this->input->post('roll6'),
                '7' => $this->input->post('roll7'),
                '8' => $this->input->post('roll8'),
                '9' => $this->input->post('roll9'),
                '10' => $this->input->post('roll10'),
                '11' => $this->input->post('roll11'),
                '12' => $this->input->post('roll12'),
                '13' => $this->input->post('roll13'),
                '14' => $this->input->post('roll14'),
                '15' => $this->input->post('roll15'),
                '16' => $this->input->post('roll16'),
                '17' => $this->input->post('roll17'),
                '18' => $this->input->post('roll18'),
                '19' => $this->input->post('roll19'),
                '20' => $this->input->post('roll20'),
                '21' => $this->input->post('roll21'),
                '22' => $this->input->post('roll22'),
                '23' => $this->input->post('roll23'),
                '24' => $this->input->post('roll24'),
                '25' => $this->input->post('roll25'),
                '26' => $this->input->post('roll26'),
                '27' => $this->input->post('roll27'),
                '28' => $this->input->post('roll28'),
                '29' => $this->input->post('roll29'),
                '30' => $this->input->post('roll30'),
                '31' => $this->input->post('roll31'),
                '32' => $this->input->post('roll32'),
                '33' => $this->input->post('roll33'),
                '34' => $this->input->post('roll34'),
                '35' => $this->input->post('roll35'),
                '36' => $this->input->post('roll36'),
                '37' => $this->input->post('roll37'),
                '38' => $this->input->post('roll38'),
                '39' => $this->input->post('roll39'),
                '40' => $this->input->post('roll40'),
                '41' => $this->input->post('roll41'),
                '42' => $this->input->post('roll42'),
                '43' => $this->input->post('roll43'),
                '44' => $this->input->post('roll44'),
                '45' => $this->input->post('roll45'),
                '46' => $this->input->post('roll46'),
                '47' => $this->input->post('roll47'),
                '48' => $this->input->post('roll48'),
                '49' => $this->input->post('roll49'),
                '50' => $this->input->post('roll50'),
                '51' => $this->input->post('roll51'),
                '52' => $this->input->post('roll52'),
                '53' => $this->input->post('roll53'),
                '54' => $this->input->post('roll54'),
                '55' => $this->input->post('roll55'),
                '56' => $this->input->post('roll56'),
                '57' => $this->input->post('roll57'),
                '58' => $this->input->post('roll58'),
                '59' => $this->input->post('roll59'),
                '60' => $this->input->post('roll60'),
                '61' => $this->input->post('roll61'),
                '62' => $this->input->post('roll62'),
                '63' => $this->input->post('roll63'),
                '64' => $this->input->post('roll64'),
                '65' => $this->input->post('roll65'),
                '66' => $this->input->post('roll66'),
                '67' => $this->input->post('roll67'),
                '68' => $this->input->post('roll68'),
                '69' => $this->input->post('roll69'),
                '70' => $this->input->post('roll70'),
                '71' => $this->input->post('roll71'),
                '72' => $this->input->post('roll72'),
                '73' => $this->input->post('roll73'),
                '74' => $this->input->post('roll74'),
                '75' => $this->input->post('roll75'),
                '76' => $this->input->post('roll76'),
                '77' => $this->input->post('roll77'),
                '78' => $this->input->post('roll78'),
                '79' => $this->input->post('roll79'),
                '80' => $this->input->post('roll80'),
                '81' => $this->input->post('roll81'),
                '82' => $this->input->post('roll82'),
                '83' => $this->input->post('roll83'),
                '84' => $this->input->post('roll84'),
                '85' => $this->input->post('roll85'),
                '86' => $this->input->post('roll86'),
                '87' => $this->input->post('roll87'),
                '88' => $this->input->post('roll88'),
                '89' => $this->input->post('roll89'),
                '90' => $this->input->post('roll90'),
                '91' => $this->input->post('roll91'),
                '92' => $this->input->post('roll92'),
                '93' => $this->input->post('roll93'),
                '94' => $this->input->post('roll94'),
                '95' => $this->input->post('roll95'),
                '96' => $this->input->post('roll96'),
                '97' => $this->input->post('roll97'),
                '98' => $this->input->post('roll98'),
                '99' => $this->input->post('roll99'),
                '100' => $this->input->post('roll100'),
                '101' => $this->input->post('roll101'),
                '102' => $this->input->post('roll102'),
                '103' => $this->input->post('roll103'),
                '104' => $this->input->post('roll104'),
                '105' => $this->input->post('roll105'),
                '106' => $this->input->post('roll106'),
                '107' => $this->input->post('roll107'),
                '108' => $this->input->post('roll108'),
                '109' => $this->input->post('roll109'),
                '110' => $this->input->post('roll110'),
                '111' => $this->input->post('roll111'),
                '112' => $this->input->post('roll112'),
                '113' => $this->input->post('roll113'),
                '114' => $this->input->post('roll114'),
                '115' => $this->input->post('roll115'),
                '116' => $this->input->post('roll116'),
                '117' => $this->input->post('roll117'),
                '118' => $this->input->post('roll118'),
                '119' => $this->input->post('roll119'),
                '120' => $this->input->post('roll120')
                );
           
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'data'=> json_encode($arr), 
                );
                
                
                    $insert = $this->Classrooms->update_attend($con['conditions'],$aid,$uid);
                    if($insert){
                        $this->session->set_userdata('success_msg', '<div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
              Attendance Updated </div>');
                       redirect('/attend');
                    }else{
                        $data['error_msg'] = '<div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                Some problems occured, please try again.</div>';
                      redirect('/attend');
                    }
                
            }else{
                $uid=$this->session->userdata('userId');
                $data['user'] = $this->user->getRows(array('id'=>$uid));
                $aid=$id=$this->uri->segment(3);
                $data['record']=$this->Classrooms->attedfetchrow($uid,$aid);
                $this->load->view('edit 3',$data);
            }
        }
        
    }
    
    public function export()
    {
        if(!$this->session->userdata('isUserLoggedIn')){
            redirect("/users/login");
        }
        $uid=$this->session->userdata('userId');
        $data['user'] = $this->user->getRows(array('id'=>$uid));
        $data['class']=$this->Classrooms->userall($uid);
        $this->load->view('export',$data); 
    }
}
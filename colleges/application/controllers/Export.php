<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {
 
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

 function classid()
 {
   $uid=$this->session->userdata('userId'); 
   $classid=$this->uri->segment(3);   
   $class_data = $this->Classrooms->attendfetchall($uid,$classid);
  $this->load->library("excel");
  $object = new PHPExcel();

  $object->setActiveSheetIndex(0);

  //$table_columns = array("Roll No", "", "Gender", "Designation", "Age");

  
  $object->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'Roll No');
  for($a=2;$a<=121;$a++)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $a, $a-1);
  }
  $a=1;
  foreach($class_data as $row)
  {
    $object->getActiveSheet()->setCellValueByColumnAndRow($a, 1, $row->date.'-'.$row->month.'-'.$row->year.'/'.$a);  
    $a++;
  }
  
    $i=1;
    foreach($class_data as $row)
    {
        $arr= json_decode($row->data, true);
        for($a=2;$a<122;$a++)    
        {
           
            $status=($arr[0][$a-1]=='on')?'P':'A'; 
            $object->getActiveSheet()->setCellValueByColumnAndRow($i, $a, $status); 
            
        }
        $i++;
    }

  //$employee_data = $this->excel_export_model->fetch_data();

  /*$excel_row = 2;

  foreach($employee_data as $row)
  {
   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->name);
   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->address);
   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->gender);
   $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->designation);
   $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->age);
   $excel_row++;
  }
*/
  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Class Attendance('.date("Y-m-d").').xls"');
  $object_writer->save('php://output');
 }
}



<?php
class Studmodel extends CI_Model 
{
    function classdata($rand){
        $query=$this->db->query("select * from classroom where rands=".$rand." limit 1");
        return $query->result();
    }
    
    function userclass($uid,$cid){
        $query=$this->db->query("insert into studsclass values('',".$cid.",".$uid.",'')");
        
    }
    
    function class_user_incre($cid){
        $query=$this->db->query("update classroom set totals=totals+1 where id=".$cid);
        
    }
}

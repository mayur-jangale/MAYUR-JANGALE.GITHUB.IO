<?php
class Classrooms extends CI_Model 
{
    function userall($uid){
       $query=$this->db->query("select * from classroom where owner=".$uid);
       return $query->result();
    }
    
    function classbyid($id,$uid){
       $query=$this->db->query("select * from classroom where id=".$id." and owner=".$uid);
       return $query->result();
    }
    
    function annouceall($cid,$uid){
       $query=$this->db->query("select * from announcement where cid=".$cid." and owner=".$uid);
       return $query->result();
    }
    
    function annoucebyid($id,$uid){
       $query=$this->db->query("select * from announcement where id=".$id." and owner=".$uid);
       return $query->result();
    }
    
    function annoucebyaid($aid){
       $query=$this->db->query("select * from announcement where id=".$aid);
       return $query->result();
    }
    
    public function insert_classrooms($data = array()) {
        //insert user data to users table
        $insert = $this->db->insert('classroom', $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();;
        }else{
            return false;
        }
    }
    public function upadate_classrooms($data = array(),$id,$uid) {
        //insert user data to users table
        $this->db->where('id', $id);
        $this->db->where('owner', $uid);
        $update=$this->db->update('classroom', $data);
        
        //return the status
        if($upadate){
            return $this->db->update_id();;
        }else{
            return false;
        }
    }
    
    public function insert_announce($data = array()) {
        //insert user data to users table
        $insert = $this->db->insert('announcement', $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();;
        }else{
            return false;
        }
    }
    
    public function update_announce($data = array(),$id,$uid) {
        //insert user data to users table
                $this->db->where('id', $id);
        $this->db->where('owner', $uid);
        $insert = $this->db->update('announcement', $data);

        //return the status
        if($insert){
            return $this->db->insert_id();;
        }else{
            return false;
        }
    }
    
     public function insert_attend($data = array()) {
        //insert user data to users table
        $insert = $this->db->insert('attendance', $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();;
        }else{
            return false;
        }
    }
    
    public function attedfetchedit($cid,$y,$m,$d,$uid) {
        //insert user data to users table
         $query=$this->db->query("select * from attendance where cid=".$cid." and year=".$y." and month=".$m." and date=".$d." and uid=".$uid);
       return $query->result();
    }
    
    public function attedfetchrow($uid,$aid)
    {
       $query=$this->db->query("select * from attendance where id=".$aid." and uid=".$uid);
       return $query->result();
    }
    
    public function update_attend($data = array(),$aid,$uid) {
        //insert user data to users table
        $this->db->where('id', $aid);
        $this->db->where('uid', $uid);
        $insert = $this->db->update('attendance', $data);

        //return the status
        if($insert){
            return $aid;
        }else{
            return false;
        }
    }
    
    function announceall($uid){
       $query=$this->db->query("select a.id, a.title, a.timestamp from announcement a, studsclass sc where a.cid=sc.cid and sc.uid=".$uid);
       return $query->result();
    }
	
	function fetchemails($cid){
       $query=$this->db->query("select u.user_email from dot_users u, studsclass sc where u.user_id= sc.uid and sc.cid=".$cid);
       return $query->result();
    }
    
    function countstud($uid){
       $query=$this->db->query("SELECT sc.uid FROM classroom c, studsclass sc WHERE sc.cid=c.id and c.owner=".$uid);
        $result = $query->num_rows();
        //return fetched data
        return $result;
    }
    
    function countclass($uid){
       $query=$this->db->query("SELECT id FROM classroom WHERE owner=".$uid);
       $result = $query->num_rows();
        //return fetched data
        return $result;
    }
    
    function countanno($uid){
       $query=$this->db->query("SELECT id FROM announcement WHERE owner=".$uid);
       $result = $query->num_rows();
        //return fetched data
        return $result;
    }
    
    public function attendfetchall($uid,$cid)
    {
       $query=$this->db->query("select * from attendance where cid=".$cid." and uid=".$uid." order by DATE(dateofatt)");
       return $query->result();
    }
    
}
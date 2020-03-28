
<?php
class Peoples extends CI_Model 
{
    
    function all($location){
        if($location=='India'){
        $query=$this->db->query("select * from dot_users order by votes DESC LIMIT 100");
        }else
        $query=$this->db->query("select * from dot_users where cityid=".$location." order by votes DESC LIMIT 100");
        return $query->result();
    }
    
    function profile($id){ 
        $query=$this->db->query('select * from dot_users where user_id='.$id);
        return $query->row();
    } 
    
    function vote($id){
   $this->db->query('update dot_users set votes=votes+1 where user_id='.$id);   
    } 
 
   function comments($id){ 
        $query=$this->db->query("select * from comment where stud=".$id);
        return $query->result();
    } 
    
    function search($key,$cid){
        if(!isset($cid)){
            $cid='*';
        }
        $this->db->where('cityid', $cid); 
        $this->db->like('user_fullname', $key);
        $this->db->or_like('user_name', $key); 
        $query = $this->db->get('dot_users');
        return $query->result();
    }
    
    function findfriends($key,$city){
        $this->db->like('user_fullname', $key);
        $this->db->or_like('user_name', $key); 
        $this->db->where('cityid', $city);
        $this->db->order_by("user_id", "asc"); 
        $query = $this->db->get('dot_users');
        return $query->result();
    }
    function city($key){
        $query=$this->db->query("select * from cities where id=".$key." limit 1");
        return $query->row();
    }
} 
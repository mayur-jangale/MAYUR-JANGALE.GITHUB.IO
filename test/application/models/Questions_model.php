<?php

class Questions_model extends CI_Model 
{
  function que($id){
        $query=$this->db->query('select * from que where course= '.$id.' ORDER BY RAND() LIMIT 1');
        return $query->result();
    }
    
    function type($name){
        $query=$this->db->query("select id from course where name='".$name."' LIMIT 1");
        return $query;
    }
    
    
    function ans($id){
        $query=$this->db->query('select ans from que where id= '.$id.' ORDER BY RAND() LIMIT 1');
        return $query;
    }
    
    function queno($id){
        $query=$this->db->query('select * from que where id= '.$id.' LIMIT 1');
        return $query->result();
    }
    
    function comment($id){
        $query=$this->db->query('select * from comment where que='.$id.' order by id desc');
        return $query->result();
    }
}
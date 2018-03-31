<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_usuario extends CI_Model {
    function login($email, $senha) {
        $this->db->select('id','nome','login','email');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('senha',$senha);
        $this->db->limit(1);
        $query = $this->db->get();

        if($query->num_rows()==1){
            return $query->result();
        } else {
            return FALSE;
        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_template extends CI_Model {
    public function __construct()
	{
		$this->db2 = $this->load->database('db2', TRUE);
	}
    public function menu(){
        $query = $this->db2->join('relasi','menu.id_menu=relasi.id_menu')
                          ->join('level','relasi.id_level=level.id_level')
						  ->where('relasi.id_level',$this->session->userdata('id_level'))
                          ->get('menu');

        if($this->db2->affected_rows() > 0){
      //  echo $this->db->last_query()
            $data = $query->result_array();
            return $data;
    }

	
}}
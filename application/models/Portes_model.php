<?php
class Portes_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_porte($id_porte = FALSE)
        {
            if ($id_porte === FALSE)
            {
                $query = $this->db->get('porte');
                return $query->result_array();
            }
    
            $query = $this->db->get_where('porte', array('id_porte' => $id_porte));
            return $query->row_array();
        }
}
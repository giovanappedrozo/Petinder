<?php
class Outros_animais_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_outros($id_outros = FALSE)
        {
            if ($id_outros === FALSE)
            {
                $query = $this->db->get('outrosanimais');
                return $query->result_array();
            }
    
            $query = $this->db->get_where('outrosanimais', array('id_outrosanimais' => $id_outros));
            return $query->row_array();
        }
}
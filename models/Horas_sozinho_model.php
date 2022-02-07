<?php
class Horas_sozinho_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_horas($id_horas = FALSE)
        {
            if ($id_horas === FALSE)
            {
                $query = $this->db->get('horassozinho');
                return $query->result_array();
            }
    
            $query = $this->db->get_where('horassozinho', array('id_horassozinho' => $id_horas));
            return $query->row_array();
        }
}
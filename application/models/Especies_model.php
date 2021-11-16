<?php
class Especies_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_especie($id_especies = FALSE)
        {
            if ($id_especies === FALSE)
            {
                $query = $this->db->get('especie');
                return $query->result_array();
            }
      
            $query = $this->db->get_where('especie', array('id_especies' => $id_especies));
            return $query->result_array();
        }
}
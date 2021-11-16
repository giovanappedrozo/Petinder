<?php
class Generos_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_genero($id_genero = FALSE)
        {
            if ($id_genero === FALSE)
            {
                $query = $this->db->get('genero');
                return $query->result_array();
            }
    
            $query = $this->db->get_where('genero', array('id_genero' => $id_genero));
            return $query->row_array();
        }
}
<?php
class Pelagens_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_pelagem($id_pelagem = FALSE)
        {
            if ($id_pelagem === FALSE)
            {
                $query = $this->db->get('pelagem');
                return $query->result_array();
            }
    
            $query = $this->db->get_where('pelagem', array('id_pelagem' => $id_pelagem));
            return $query->row_array();
        }
}
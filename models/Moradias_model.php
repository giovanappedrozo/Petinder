<?php
class Moradias_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_moradias($id_moradia = FALSE)
        {
            if ($id_moradia === FALSE)
            {
                $query = $this->db->get('moradia');
                return $query->result_array();
            }
    
            $query = $this->db->get_where('moradia', array('id_moradia' => $id_moradia));
            return $query->row_array();
        }
}
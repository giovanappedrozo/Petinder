<?php
class Status_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_status($id_status = FALSE)
        {
            if ($id_status === FALSE)
            {
                $query = $this->db->get('statusanimal');
                return $query->result_array();
            }
    
            $query = $this->db
            ->get_where('statusanimal', array('id_status' => $id_status));

            return $query->result_array();
        }
}
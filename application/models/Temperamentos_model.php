<?php
class Temperamentos_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_temperamento($id_temperamento = FALSE)
        {
            if ($id_temperamento === FALSE)
            {
                $this->db->order_by('temperamento', 'ASC');
                $query = $this->db->get('temperamento');
                return $query->result_array();
            }
    
            $query = $this->db->get_where('temperamento', array('id_temperamento' => $id_temperamento));
            return $query->row_array();
        }
}
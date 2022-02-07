<?php
class Motivos_denuncia_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_motivo($id_motivo = FALSE)
        {
            if ($id_motivo === FALSE)
            {
                $query = $this->db->get('motivos_denuncia');
                return $query->result_array();
            }
      
            $query = $this->db->get_where('motivos_denuncia', array('id_motivo' => $id_motivo));
            return $query->row_array();
        }
}
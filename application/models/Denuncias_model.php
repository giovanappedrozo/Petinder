<?php
class Denuncias_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function get_denuncia($id_denuncia = FALSE){
        if ($id_denuncia === FALSE){
            $query = $this->db->get('denuncia');
            return $query->result_array();
        } 
    
        $query = $this->db->get_where('denuncia', array('id_denuncia' => $id_denuncia));
        return $query->row_array();
    }

    public function get_denuncia_by_denunciado($id_denunciado = FALSE){
        $query = $this->db->get_where('denuncia', array('id_denunciado' => $id_denunciado));
        return $query->result_array();
    }
 
    public function set_denuncia($id_denunciante, $id_denunciado, $denuncia){
            $data = array(
                'id_denunciante' => $id_denunciante,
                'id_denunciado' => $id_denunciado,
                'denuncia' => $denuncia
            );

            return $this->db->insert('denuncia', $data);
    }
}
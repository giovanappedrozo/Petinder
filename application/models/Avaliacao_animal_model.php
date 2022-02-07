<?php
class Avaliacao_animal_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_avaliacao($id_avaliacao = FALSE)
        {
            if ($id_avaliacao === FALSE)
            {
                $query = $this->db->get('avaliacao_animal');
                return $query->result_array();
            }
    
            $query = $this->db->get_where('avaliacao_animal', array('id_avaliacao' => $id_avaliacao));
            return $query->row_array();
        }

        public function get_avaliacao_by_usuario($id_usuario, $avaliacao, $id_animal = FALSE)
        {   
            if($id_animal === FALSE){
                $query = $this->db->get_where('avaliacao_animal', array('id_usuario' => $id_usuario, 'avaliacao' => $avaliacao));            
                return $query->result_array();
            } 
            else{
                $query = $this->db->get_where('avaliacao_animal', array('id_usuario' => $id_usuario, 'id_animal' => $id_animal, 'avaliacao' => $avaliacao));
                return $query->row_array();
            }
        }

        public function get_avaliacao_by_both($id_usuario, $id_animal)
        {    
            $query = $this->db->get_where('avaliacao_animal', array('id_usuario' => $id_usuario, 'id_animal' => $id_animal, 'avaliacao' => TRUE));
            return $query->row_array();
        }

        public function get_avaliacao_by_animal($id_animal){
            $query = $this->db->get_where('avaliacao_animal', array('id_animal' => $id_animal, 'avaliacao' => 'TRUE'));
            return $query->result_array();
        }
    
        public function set_avaliacao()
        {
            $avaliacao = $this->input->post('avaliacao');
            $id_usuario = $this->session->userdata('id');
            $id_animal = $this->input->post('id_animal');

            $query = self::get_avaliacao_by_usuario($id_usuario, $avaliacao, $id_animal);

            if(!$query){
                $data = array(
                    'avaliacao' => $avaliacao,
                    'id_animal' => $id_animal,
                    'id_usuario' => $id_usuario,
                    'status_solicitacao' => 1
                );

                return $this->db->insert('avaliacao_animal', $data);
            }
        }

        public function set_match($id_avaliacao, $id_animal)
        {
            $this->load->model('animais_model');

            if($this->input->post('avaliacao') == 'TRUE'){
                $avaliacao = array(
                    'status_solicitacao' => 2
                );

                $animal = array(
                    'id_status' => 2
                );

                $this->db->update('animal', $animal, array('id_animal' => $id_animal));
                return $this->db->update('avaliacao_animal', $avaliacao, array('id_avaliacao' => $id_avaliacao));        
            }
            else{
                $avaliacao = array(
                    'status_solicitacao' => 3
                );

                return $this->db->update('avaliacao_animal', $avaliacao, array('id_avaliacao' => $id_avaliacao));        
            }
        } 

        public function get_match_by_usuario($id_usuario){
            $query = $this->db->get_where('avaliacao_animal', array('id_usuario' => $id_usuario, 'status_solicitacao' => 2));            
            return $query->result_array();
        }

        public function get_match_by_animal($id_animal){
            $query = $this->db->get_where('avaliacao_animal', array('id_animal' => $id_animal, 'status_solicitacao' => 2));            
            return $query->result_array();
        }

        public function get_like($animal){
            if($animal['id_status'] != 2){
                $query = "SELECT *
                FROM avaliacao_animal a1
                where id_animal = ".$animal['id_animal'].
                "and status_solicitacao = '1' 
                and datahora = (SELECT min(datahora)
                
                FROM avaliacao_animal a2
                where a2.id_animal       = a1.id_animal
                and   a2.status_solicitacao = a1.status_solicitacao)";
                        
                return $this->db->query($query)->row_array(); 
            } 
        }

        public function delete_avaliacao($id_usuario, $avaliacao, $id_animal)
        {   
            $av = self::get_avaliacao_by_both($id_usuario, $id_animal);

            if($av){
                if($av['status_solicitacao'] == 2 && $avaliacao == 'TRUE'){
                        $animal = $this->animais_model->get_animais($id_animal);

                        if($animal['id_status'] == 2 ){
                            $data = array('id_status' => 1);
                            $this->db->update('animal', $data, array('id_animal' => $id_animal));
                        }
                }
            }
            $this->db->where(array('id_usuario' => $id_usuario, 'avaliacao' => $avaliacao, 'id_animal' => $id_animal))->delete('avaliacao_animal');
        }

        public function delete_avaliacao_by_id($id_avaliacao)
        {   
            return  $this->db->where(array('id_avaliacao' => $id_avaliacao))->delete('avaliacao_animal');
        }

        public function adopted($id_animal, $id_usuario, $answer){
            $animal = $this->animais_model->get_animais($id_animal);

            if($animal['id_doador'] == $this->session->userdata('id'))
                $match = self::get_avaliacao_by_both($id_usuario, $id_animal);
            else
                $match = self::get_avaliacao_by_both($this->session->userdata('id'), $id_animal);

            if(!$match['status_adopted'] && $answer == 'TRUE'){
                $data = array(
                    'status_adopted' => 1
                );
                return $this->db->update('avaliacao_animal', $data, array('id_avaliacao' => $match['id_avaliacao']));        
            }
            elseif($match['status_adopted'] == 1 && $answer == 'TRUE'){
                $data = array(
                    'status_adopted' => 2
                );
                $animal = array(
                    'id_status' => 3,
                    'id_adotante' => $id_usuario
                );

                $this->db->update('animal', $animal, array('id_animal' => $id_animal));
                return $this->db->update('avaliacao_animal', $data, array('id_avaliacao' => $match['id_avaliacao']));        
            }

            elseif($answer == 'FALSE'){
                $data = array(
                    'id_status' => 1
                );

                $this->db->update('animal', $data, array('id_animal' => $id_animal));
                return self::delete_avaliacao_by_id($match['id_avaliacao']);
            }
        }
}

<?php
class Mensagens_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_mensagem_by_usuario($id_usuario =  FALSE){
            if ($id_usuario === FALSE)
            {
                $query = $this->db->get('mensagem');
                return $query->result_array();
            }
    
            $where = "id_remetente='$id_usuario' OR id_destinatario='$id_usuario'";
            $this->db->where($where);
            $query = $this->db->get("mensagem");

            return $query->result_array();
        }

        public function get_mensagem_by_usuario_status($id_usuario, $status){
            $where = "id_destinatario='$id_usuario' AND status_msg = '$status'";
            $this->db->where($where);
            $query = $this->db->get("mensagem");

            return $query->result_array();
        }

        public function get_mensagem($id_usuario, $animal, $id_outro_usuario = FALSE)
        {
            if ($id_usuario === FALSE)
            {
                $query = $this->db->get('mensagem');
                return $query->result_array();
            }

            if(!$animal){
                return $this->session->set_flashdata("danger", $this->lang->line("LocationNull")."<a href='".site_url('usuarios/register')."'></a>");
            }
            else{
                if($id_usuario == $animal['id_doador']){
                    if($id_outro_usuario != $id_usuario){
                        $id_animal = $animal['id_animal'];

                        $where = "(id_remetente='$id_usuario' OR id_destinatario='$id_usuario') AND (id_remetente='$id_outro_usuario' OR id_destinatario='$id_outro_usuario') AND (id_animal='$id_animal')";
                        $this->db->where($where);
                
                        $query = $this->db->get("mensagem");
                        return $query->result_array();
                    }
                    else 
                        show_404();
                }
                else{
                    if($id_outro_usuario == $animal['id_doador']){
                        $id_doador = $animal['id_doador'];
                        $id_animal = $animal['id_animal'];

                        $where = "(id_remetente='$id_usuario' OR id_destinatario='$id_usuario') AND (id_remetente='$id_doador' OR id_destinatario='$id_doador') AND (id_animal='$id_animal')";
                        $this->db->where($where);
                
                        $query = $this->db->get("mensagem");
                        return $query->result_array();
                    }
                    else
                        show_404();
                }
            }
        }

        public function verify_status($id_mensagem){
            $query = $this->db->get_where('mensagem', array('id_mensagem' => $id_mensagem));
            return $query->row_array();
        }

        public function change_status($id_mensagem){
            $query = self::verify_status($id_mensagem);

            if($query['id_destinatario'] == $this->session->userdata('id')){
                $data = array(
                    'status_msg' => TRUE
                );

                return $this->db->update('mensagem', $data, array('id_mensagem' => $id_mensagem));
            }
        }
        
        public function set_mensagem($animal = FALSE)
        {
            $this->load->helper('url');

            $data = array(
                'conteudo' => $this->input->post('mensagem'),
                'id_remetente' => $this->session->userdata('id'),
                'id_destinatario' => $this->input->post('usuario'),
                'id_animal' => $animal['id_animal'],
                'status_msg' => FALSE
            );

            return $this->db->insert('mensagem', $data);
        } 
    }
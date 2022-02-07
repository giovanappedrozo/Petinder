<?php
class ResetPassword_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_by_token($token)
        {
            $query = $this->db
            ->get_where('resetsenha', array('token' => $token));

            return $query->row_array();
        }

        public function set_token($token, $email){
            $usuario = $this->db->get_where('usuario', array('email' => $email))->row_array();
            $data = array(
                'token' => $token,
                'id_usuario' => $usuario['id_usuario']
            );

            $this->db->insert('resetsenha', $data);
        }

        public function delete_token($id_token){
            $query = $this->db
                    ->where('id_reset', $id_token)
                    ->delete('resetsenha');
        }
}
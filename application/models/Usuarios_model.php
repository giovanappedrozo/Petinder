<?php
class Usuarios_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function get_usuario($id_usuario = FALSE){
        if ($id_usuario === FALSE){
            $query = $this->db->get('usuario');
            return $query->result_array();
        } 
    
        $query = $this->db->get_where('usuario', array('id_usuario' => $id_usuario));
        return $query->row_array();
    }
 
    public function set_usuario(){
        $this->load->helper('url');

        $email = $this->input->post('email');

        $this->db->where('email', $email); 
        $query = $this->db->get('usuario')->row_array();

        if(!$query){
            $senha = $this->input->post('senha');
            
            $criptografada = password_hash($senha, PASSWORD_BCRYPT);

            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');

            if($latitude && $longitude)
                $ponto = "($latitude, $longitude)";
            else $ponto = null;

            $nome = $this->input->post('nome');
            $nome = ucfirst(strtolower($nome));

            $data = array(
                'nome' => $nome,
                'email' => $email,
                'senha' => $criptografada,
                'id_genero' => $this->input->post('genero'),
                'datanasci' => $this->input->post('data'),
                'localizacao' => $ponto,
                'disponivel' => TRUE
            );

            $this->db->insert('usuario', $data);
        }
        else 
            return $this->session->set_flashdata("danger", $this->lang->line("EmailRepeated")."<a href='".site_url('usuarios/register')."'>".$this->lang->line("Here")."</a>");
    }

    public function set_application(){
        $this->load->helper('url');
        $id_usuario = $this->input->post('id_usuario');

        $data = array(
            'id_moradia' => $this->input->post('moradia'),
            'id_horassozinho' => $this->input->post('horas'),
            'criancas' => $this->input->post('criancas'),
            'qtdmoradores' => $this->input->post('moradores'),
            'id_outrosanimais' => $this->input->post('outros'),
            'acessoprotegido' => $this->input->post('acesso'),
            'gastos' => $this->input->post('gastos'),
            'alergia' => $this->input->post('alergias')
        );

        $this->db->update('usuario', $data, array('id_usuario' => $id_usuario));
    }

    function validate($email, $senha) {
        $this->db->where('email', $email);
        $query = $this->db->get('usuario')->row_array();
        
        if($query && $query['disponivel'] != 0){
            $senhaguardada = $query['senha'];

            if(crypt($senha,$senhaguardada) == $senhaguardada)        
                return $query;
        }
    }

    function confirm_password($senha) {
        $query = self::get_usuario($this->session->userdata('id'));
        
        if($query){
            $senhaguardada = $query['senha'];

            if(crypt($senha,$senhaguardada) == $senhaguardada)        
                return true;
        }
    }

    function distance($id_usuario = FALSE){
        $usuario_logado = $this->session->userdata("id");
        $usuario = $this->usuarios_model->get_usuario($id_usuario);

        if(isset($usuario['localizacao'])) $localizacao = $usuario['localizacao'];
        else $localizacao = NULL;

        if($localizacao){
            $this->db
            ->select("ST_Distance(localizacao::geometry, POINT('".$localizacao."')::geometry) AS dist")
            ->where('id_usuario='.$usuario_logado);

            $query = $this->db->get('usuario');

            return $query->row_array();
        }
    }

    public function update_usuario($id_usuario)
    {
        $nome = $this->input->post('nome');
        $nome = ucfirst(strtolower($nome));

        if($this->input->post('senha')){
            $senha = $this->input->post('senha');
                
            $options = ['cost' => 12,];
            $criptografada = password_hash($senha, PASSWORD_BCRYPT, $options);
        
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');

            if($latitude && $longitude){
                $ponto = "($latitude, $longitude)";

                $data = array(
                    'nome' => $nome,
                    'email' => $this->input->post('email'),
                    'senha' => $criptografada,
                    'localizacao' => $ponto,
                    'id_genero' => $this->input->post('genero')
                );
            } 
            else   
                $data = array(
                    'nome' => $nome,
                    'email' => $this->input->post('email'),
                    'senha' => $criptografada,
                    'id_genero' => $this->input->post('genero')
                ); 
        }  
        else {
            $latitude = $this->input->post('latitude');
            $longitude = $this->input->post('longitude');

            if($latitude && $longitude){
                $ponto = "($latitude, $longitude)";

                $data = array(
                    'nome' => $nome,
                    'email' => $this->input->post('email'),
                    'localizacao' => $ponto,
                    'id_genero' => $this->input->post('genero')
                );
            }    
            else   
                $data = array(
                    'nome' => $nome,
                    'email' => $this->input->post('email'),
                    'id_genero' => $this->input->post('genero')
                ); 
        }
        $session = array(
            'usuario' => $nome
            );
        $this->session->set_userdata($session);
        return $this->db->update('usuario', $data, array('id_usuario' => $id_usuario));        
    } 

    public function delete_usuario($id_usuario = FALSE){
        if ($id_usuario != FALSE){
            $query = $this->db
                ->where('id_usuario', $id_usuario)
                ->delete('usuario');
        }
    }

    public function get_notificacao_by_animal($id_animal){
        $this->load->model('animais_model');
        $animais = $this->animais_model->get_animais($id_animal);

        if($animais){
            $output = $this->db->get_where('avaliacao_animal', array('id_animal' => $animais['id_animal'], 'status_solicitacao' => 1));       

            return $output;
        }
        else
            show_404();
    }

    public function verify_animals(){
        $doador = $this->animais_model->get_animais_by_usuario($this->session->userdata('id'));

        if($doador){
                $data = array(
                        'doador' => true
                );
                $this->session->set_userdata($data);
        }
        else{
                $data = array(
                        'doador' => false
                );
                $this->session->set_userdata($data);
        }
    }

    public function perfect_match(){
        $usuario = self::get_usuario($this->session->userdata('id'));

        if($usuario['id_moradia'] == 1)
            $moradia = "AND id_porte = '2' OR id_porte = '3' OR id_porte = '1'";
    
        elseif($usuario['id_moradia'] == 2)
            $moradia = "AND id_porte = '1' OR id_porte = '2'";
        
        
        else
            $moradia = '';

        if($usuario['id_outrosanimais'] != 1)
            $outros = "AND id_temperamento <> '2'";
        
        else
            $outros = '';

        if($usuario['id_horassozinho'] > 2)
            $horas = "AND especial = 'FALSE'";
        
        else
            $horas = '';

        if($usuario['alergia'] == TRUE)
            $alergia = "AND id_pelagem < '3'";
        
        else 
            $alergia = '';

        if($usuario['criancas'] == TRUE)
            $criancas = "AND id_temperamento = '4' OR id_temperamento = '7' OR id_temperamento = '8'";
        
        else
            $criancas = '';

        if($usuario['qtdmoradores'] > 4)
            $moradores = "AND id_temperamento > '3'";
        
        else
            $moradores = '';

        $query = $this->db
                    ->select("*")
                    ->where("id_doador <>".$usuario['id_usuario'].$moradia.$outros.$horas.$alergia.$criancas.$moradores)
                    ->get('animal');

        $result = $query->result_array();

        return $result;
    }

    public function banir($denunciado){
        $data = array(
            'disponivel' => FALSE
        );
        $this->db->update('usuario', $data, array('id_usuario' => $denunciado));
    }

    public function verify_email($email){
        $this->db->where('email', $email);
        return $this->db->get('usuario')->row_array();
    }

    public function change_passwd(){
        $senha = $this->input->post('senha');
            
        $criptografada = password_hash($senha, PASSWORD_BCRYPT);

        $data = array(
            'senha' => $criptografada
            );

        return $this->db->update('usuario', $data, array('email' => $this->input->post('email')));        
    }
}

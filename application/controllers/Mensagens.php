<?php
class Mensagens extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('mensagens_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('animais_model');
        $this->load->model('motivos_denuncia_model');
        $this->load->model('usuarios_model');
    }

    public function chat($id_animal, $id_usuario){
        if($this->session->userdata('logged')){
            $data['animal'] = $this->animais_model->get_animais($id_animal);
            $data['usuario'] = null;
            $data['remetente'] = null;
            $data['motivos'] = $this->motivos_denuncia_model->get_motivo();
            $usuario = $this->usuarios_model->get_usuario($id_usuario);

            if($id_usuario){
                $data['mensagens'] = $this->mensagens_model->get_mensagem($this->session->userdata('id'), $data['animal'], $id_usuario);
                $data['usuario'] = $usuario;
            }
            else
                $data['mensagens'] = $this->mensagens_model->get_mensagem($this->session->userdata('id'), $data['animal']);

            if($data['mensagens']){
                foreach($data['mensagens'] as $msg){
                    if($msg['status_msg'] == 0)
                        $this->mensagens_model->change_status($msg['id_mensagem']);

                    if($msg['id_remetente'] == $this->session->userdata('id'))
                        $data['remetente'] = 'TRUE';
                }
            }

            if(!$this->input->post('action')){
                $data['title'] = $usuario['nome'].' - '.$data['animal']['nome'];

                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/chat', $data);
                $this->load->view('templates/footer');
            }
            else{
                $output = array();
                if($data['mensagens'])
                {
                    foreach($data['mensagens'] as $msg)
                    {
                        $hora = explode(" ",$msg['datahora']);
                        $hora = explode(":",$hora[1]);
                        $msg['datahora'] = $hora[0].":".$hora[1];

                        if($msg['id_remetente'] != $this->session->userdata('id'))
                            $output[] = array(
                            'conteudo'  => $msg['conteudo'],
                            'datahora' => $msg['datahora'],
                            'direcao' => 'esquerda'
                            ); 
                        else
                        $output[] = array(
                            'conteudo'  => $msg['conteudo'],
                            'datahora' => $msg['datahora'],
                            'direcao' => 'direita'
                        );
                    }
                    echo json_encode($output);
                }
            }
        }
        else
            show_404();
    }

    public function addMessage()
    {
        $this->form_validation->set_rules('mensagem', 'Mensagem', 'required');
        $usuario = $this->input->post('usuario');
        $animal = $this->animais_model->get_animais($this->input->post('animal'));
            
        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('usuarios/register', $data);
            $this->load->view('templates/footer');
        }
        else { 
            $this->mensagens_model->set_mensagem($animal);

            header('Location: '.$animal['id_animal'].'/'.$usuario);
        }
    }
 
    public function load_messages(){
        if($this->session->userdata('logged')){
            $data = $this->mensagens_model->get_mensagem_by_usuario($this->session->userdata('id'));

            $output = array();
            if($data)
            {
                foreach($data as $row)
                {
                    if($row['status_msg'] == FALSE && ($row['id_destinatario'] == $this->session->userdata('id'))){
                        $userdata = $this->usuarios_model->get_usuario($row['id_remetente']);
                        $animais = $this->animais_model->get_animais($row['id_animal']);

                        $output[] = array(
                        'id_usuario'  => $row['id_remetente'],
                        'nome' => $userdata['nome'],
                        'id_animal' => $row['id_animal'],
                        'conteudo' => $row['conteudo'],
                        'animal' => $animais['nome']
                        );
                    }
                }
            }
            echo json_encode($output); 
        }  
    }

    public function verify_message(){
        if($this->session->userdata('logged')){
            if($this->input->post('action')){
                $mensagens = $this->mensagens_model->get_mensagem_by_usuario_status($this->session->userdata('id'), 'FALSE');

            echo json_encode($mensagens);
            }
        }
    }
}
?> 
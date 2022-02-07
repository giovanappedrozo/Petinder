<?php
class Usuarios extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('usuarios_model');
                $this->load->model('mensagens_model');
                $this->load->model('animais_model');
                $this->load->model('generos_model');
                $this->load->model('horas_sozinho_model');
                $this->load->model('outros_animais_model');
                $this->load->model('moradias_model');
                $this->load->model('denuncias_model');
                $this->load->model('avaliacao_animal_model');
                $this->load->model('resetPassword_model');
                $this->load->helper('url_helper');
                $this->load->helper('form');
                $this->load->library('form_validation');
        }

        public function index()
        {
                $lang = $this->session->get_userdata('site_lang');
                $lang = $lang['site_lang'];
                if($lang == 'portuguese') $data['lang'] = 'pt_br';
                else $data['lang'] = 'en_us';

                $data['usuarios'] = $this->usuarios_model->get_usuario();
                $data['title'] = $this->lang->line('Title_user');
                
                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/index', $data);
                $this->load->view('templates/footer');
        } 

        public function view($id_usuario, $id_animal = FALSE)
        {
                $data['dislikes'] = $this->avaliacao_animal_model->get_avaliacao_by_usuario($this->session->userdata('id'), 'FALSE', $id_animal);
                $data['likes'] = $this->avaliacao_animal_model->get_avaliacao_by_usuario($this->session->userdata('id'), 'TRUE', $id_animal);
                $lang = $this->session->get_userdata('site_lang');
                $lang = $lang['site_lang'];
                if($lang == 'portuguese') $data['lang'] = 'pt_br';
                else $data['lang'] = 'en_us';

                $doador = $this->animais_model->get_animais_by_usuario($this->session->userdata('id'));

                if($doador == null && $id_usuario != $this->session->userdata('id'))
                        show_404();
                else {
                        $data['usuario'] = $this->usuarios_model->get_usuario($id_usuario);
                        $data['distance'] = $this->usuarios_model->distance($id_usuario);
                        $data['generos'] = $this->generos_model->get_genero();
                        $data['moradias'] = $this->moradias_model->get_moradias();
                        $data['outros'] = $this->outros_animais_model->get_outros();
                        $data['horas'] = $this->horas_sozinho_model->get_horas();

                        if($id_animal)
                                $data['animal'] = $id_animal;

                        if (empty($data['usuario']))
                        {
                                show_404();
                        }

                        $data['title'] = $data['usuario']['nome'];

                        $this->load->view('templates/header', $data);
                        $this->load->view('usuarios/view', $data);
                        $this->load->view('templates/footer');
                }
        }

        public function register()
        {
                $lang = $this->session->get_userdata('site_lang');
                $lang = $lang['site_lang'];
                if($lang == 'portuguese') $data['lang'] = 'pt_br';
                else $data['lang'] = 'en_us';

                $data['title'] = $this->lang->line('Title_reg');
                $data['generos'] = $this->generos_model->get_genero();

                $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]|max_length[100]');
                $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
                $this->form_validation->set_rules('genero', 'Genero', 'required');
                $this->form_validation->set_rules('data', 'Data de nascimento', 'required');
                $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');
                $this->form_validation->set_rules('confirmacao', 'Confirmação de Senha','required|matches[senha]');
                
                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('templates/header', $data);
                        $this->load->view('usuarios/register', $data);
                        $this->load->view('templates/footer');

                }
                else
                { 
                        $this->usuarios_model->set_usuario();

                        if($this->session->flashdata("danger"))
                                redirect('usuarios/register', 'refresh');
                        else {
                                $this->login($this->input->post('email'), $this->input->post('senha'));
                                redirect('animais', 'refresh');  
                        }
                }
        }

        public function recover_password(){
                if($this->input->post('action')){
                        $query = $this->usuarios_model->verify_email($this->input->post('action'));
                        if($query){
                                $config = array(
                                        'protocol' => 'smtp',
                                        'smtp_host' => 'smtp.sendgrid.net',
                                        'smtp_user' => 'apikey',
                                        'smtp_pass' => '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',
                                        'charset' => 'utf-8',
                                        'mailtype' => 'html',
                                        'smtp_port' => 587,
                                        'crlf' => "\r\n",
                                        'newline' => "\r\n"
                                );

                                $this->load->library('email', $config);
                                
                                $to = $this->input->post('action');

                                $token = $to.rand(1, 999999999);
                                $token = password_hash($token, PASSWORD_DEFAULT);
                                $token = str_replace("/", rand(1, 9), $token);
                                $token = str_replace(".", rand(1, 9), $token);

                                $this->resetPassword_model->set_token($token, $to);

                                $subject = $this->lang->line('Recover_passwd');
                                $message = "<h2>".$this->lang->line('Recover_passwd')."</h2><p>".$this->lang->line('Reset_passwd_msg').site_url('usuarios/resetpassword/'.$token)."<br>".$this->lang->line('Email_conf_wrong')."</p>";
                                

                                $this->email->set_newline("\r\n");
                                $this->email->from('grupo6pds@gmail.com', 'PETINDER');
                                $this->email->to($to);
                                $this->email->subject($subject);
                                $this->email->message($message);

                                if($this->email->send())
                                   $this->session->set_flashdata("success", $this->lang->line("Verify_recover"));
                                else
                                   $this->session->set_flashdata("danger", $this->lang->line("Error"));
                        }
                        else
                                echo $this->session->set_flashdata("danger", $this->lang->line("Wrong_email")."<a href='".site_url('usuarios/register')."'>".$this->lang->line("Here")."</a>");
                }

        }

        public function resetpassword($token){
                $query = $this->resetPassword_model->get_by_token($token);

                if($query){
                        $datacriacao =  new DateTime($query['datahora']);
                        $dataatual = new DateTime();

                        $datediff = $datacriacao->diff($dataatual);

                        $data['email'] = $this->usuarios_model->get_usuario($query['id_usuario']);
                        $data['email'] = $data['email']['email'];
                        $data['title'] = $this->lang->line('Recover_title');

                        if($datediff->h <= 24){
                                $this->resetPassword_model->delete_token($query['id_reset']);

                                $this->load->view('templates/header', $data);
                                $this->load->view('usuarios/resetpassword', $data);
                                $this->load->view('templates/footer');  
                        }
                        else
                                show_404();
                }
                else
                        show_404();
        }

        public function application()
        {
                $lang = $this->session->get_userdata('site_lang');
                $lang = $lang['site_lang'];
                if($lang == 'portuguese') $data['lang'] = 'pt_br';
                else $data['lang'] = 'en_us';
                
                $data['title'] = $this->lang->line('Title_form');
                $data['moradias'] = $this->moradias_model->get_moradias();
                $data['outros'] = $this->outros_animais_model->get_outros();
                $data['horas'] = $this->horas_sozinho_model->get_horas();

                $this->form_validation->set_rules('moradia', 'Moradia', 'required');
                $this->form_validation->set_rules('horas', 'Horas sozinho', 'required');
                $this->form_validation->set_rules('outros', 'Outros animais', 'required');
                $this->form_validation->set_rules('acesso', 'Acesso', 'required');
                $this->form_validation->set_rules('moradores', 'Moradores', 'required|greater_than[0]');
                $this->form_validation->set_rules('criancas', 'Criancas', 'required');
                $this->form_validation->set_rules('gastos', 'Gastos', 'required');
                $this->form_validation->set_rules('alergias', 'Alergias', 'required');

                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('templates/header', $data);
                        $this->load->view('usuarios/adoption_form', $data);
                        $this->load->view('templates/footer');

                }
                else
                {
                        $this->usuarios_model->set_application();
                        redirect('animais', 'refresh');  
                }
        }

        public function my_animals()
        { 
                if(!$this->session->userdata("logged")){
                        show_404();
                }
                
                $data['dislike'] = NULL;
                $data['animais'] = $this->animais_model->get_animais_by_usuario($this->session->userdata('id'));
                $data['title'] = $this->lang->line('Title_animal');

                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/my_animals', $data);
                $this->load->view('templates/footer');
        }

        public function my_donated(){
                if(!$this->session->userdata("logged")){
                        show_404();
                }
                
                $data['animais'] = $this->animais_model->get_animais_by_usuario($this->session->userdata('id'));
                $data['title'] = $this->lang->line('Title_animal');

                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/my_donated', $data);
                $this->load->view('templates/footer');
        }

        public function my_adopted(){
                if(!$this->session->userdata("logged")){
                        show_404();
                }
                
                $data['animais'] = $this->animais_model->get_animais_by_adotante($this->session->userdata('id'));
                $data['title'] = $this->lang->line('Title_animal');

                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/my_adopted', $data);
                $this->load->view('templates/footer');
        }

        public function my_chats_donate()
        { 
                $animais = $this->animais_model->get_animais_by_usuario($this->session->userdata('id'));
                $data['conversas'] = null;
                
                $output = array();
                foreach($animais as $animal){
                        $matches = $this->avaliacao_animal_model->get_match_by_animal($animal['id_animal']);

                        foreach($matches as $match){
                                if($match && $animal['id_status'] != 3){
                                        $usuarios = $this->usuarios_model->get_usuario($match['id_usuario']);

                                        $data['conversas'][] = array(
                                                'id_usuario' => $usuarios['id_usuario'],
                                                'nome' => $usuarios['nome'], 
                                                'id_animal' => $match['id_animal'],
                                                'animal' => $animal['nome']
                                        );
                                }
                        }
                }
                
                $data['title'] = $this->lang->line('Chat');

                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/my_chats_donate', $data);
                $this->load->view('templates/footer');
        }

        public function my_chats_adopt()
        { 
                $data['conversas'] = null;
                
                $output = array();
                $matches = $this->avaliacao_animal_model->get_match_by_usuario($this->session->userdata('id'));

                foreach($matches as $match){
                        $animal = $this->animais_model->get_animais($match['id_animal']);

                        if($match && $animal['id_status'] != 3){
                                $usuarios = $this->usuarios_model->get_usuario($animal['id_doador']);

                                $data['conversas'][] = array(
                                        'id_usuario' => $usuarios['id_usuario'],
                                        'nome' => $usuarios['nome'], 
                                        'id_animal' => $match['id_animal'],
                                        'animal' => $animal['nome']
                                );
                        }
                }
                
                $data['title'] = $this->lang->line('Chat');

                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/my_chats_adopt', $data);
                $this->load->view('templates/footer');
        }

        public function my_dislikes()
        { 
                if(!$this->session->userdata("logged")){
                        show_404();
                }

                $dislikes = $this->avaliacao_animal_model->get_avaliacao_by_usuario($this->session->userdata('id'), 'FALSE');

                if($dislikes){
                        foreach($dislikes as $dislike){
                                $query = $this->animais_model->get_animais($dislike['id_animal']);
                                $data['animais'][] = array(
                                        'id_animal' => $query['id_animal'],
                                        'imagem' => $query['imagem'],
                                        'nome' => $query['nome'],
                                        'id_doador' => $query['id_doador'],
                                        'id_status' => $query['id_status']
                                );
                        }
                }
                else 
                $data['animais'] = NULL;
                $data['dislike'] = TRUE;

                $data['title'] = $this->lang->line('Interactions');  
                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/my_dislikes', $data);
                $this->load->view('templates/footer');              
        }

        public function my_likes()
        { 
                if(!$this->session->userdata("logged")){
                        show_404();
                }

                $likes = $this->avaliacao_animal_model->get_avaliacao_by_usuario($this->session->userdata('id'), 'TRUE');

                if($likes){
                        foreach($likes as $like){
                                $query = $this->animais_model->get_animais($like['id_animal']);
                                $data['animais'][] = array(
                                        'id_animal' => $query['id_animal'],
                                        'imagem' => $query['imagem'],
                                        'nome' => $query['nome'],
                                        'id_doador' => $query['id_doador'],
                                        'id_status' => $query['id_status']
                                );
                        }
                }
                else 
                $data['animais'] = NULL;
                $data['like'] = TRUE;

                $data['title'] = $this->lang->line('Interactions');  
                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/my_likes', $data);
                $this->load->view('templates/footer');              
        }

        public function login(){
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('senha', 'Password', 'required');

                $email = $this->input->post('email');
                $senha = $this->input->post('senha');

                $query = $this->usuarios_model->validate($email, $senha);
                $data['title'] = $this->lang->line('Login');


                if ($this->form_validation->run() === FALSE) {

                        $this->load->view('templates/header', $data);
                        $this->load->view('usuarios/login');
                        $this->load->view('templates/footer');
                } 
                else {

                        if ($query) { 
                                $data = array(
                                        'usuario' => $query['nome'],
                                        'id' => $query['id_usuario'],
                                        'logged' => true,
                                        'localizacao' => $query['localizacao']
                                        );
                                $this->session->set_userdata($data);
                                $this->usuarios_model->verify_animals();
                                redirect('animais', 'refresh');

                        } 
                        else {
                                $this->session->set_flashdata("danger", $this->lang->line("Danger")."<a href='".site_url('usuarios/register')."'>".$this->lang->line("Here")."</a>");
                                redirect('usuarios/login', 'refresh');
                        }
                }
        }

        public function change_password(){       
                $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[6]');
                $this->form_validation->set_rules('confirmacao', 'Confirmação de Senha','required|matches[senha]');

                if ($this->form_validation->run() != FALSE){                      
                        $update = $this->usuarios_model->change_passwd();
                        if($update){
                                $this->session->set_flashdata('success', $this->lang->line('Passwd_recovered'));
                                redirect('usuarios/login');
                        }
                }
        
        }

        public function confirm_password(){  
                if($this->input->post('action')){    
                        $senha = $this->input->post('action');
                        $confirm = $this->usuarios_model->confirm_password($senha);
                        if($confirm === true)
                                echo true;
                }
        }
        
        public function review($id_usuario, $id_animal){
                if($this->session->userdata('logged')){
                        $query = $this->avaliacao_animal_model->get_avaliacao_by_both($id_usuario, $id_animal);

                        if($query && ($query['status_solicitacao'] == 1)){
                                $this->avaliacao_animal_model->set_match($query['id_avaliacao'], $id_animal);
                                redirect('animais/');
                        }
                }
                else
                        redirect('usuarios/login', 'refresh');
        }

        public function edit($id_usuario){
                $this->form_validation->set_rules('email', 'E-mail', 'valid_email');
                $this->form_validation->set_rules('senha', 'Senha', 'min_length[6]');

                if ($this->form_validation->run() === FALSE)
                {
                        redirect('usuarios/'.$id_usuario, 'refresh');

                }
                else
                {
                        $this->usuarios_model->update_usuario($id_usuario);
                        redirect('animais', 'refresh');
                }
        }

        public function delete(){
                if($this->session->userdata('logged')){
                        $this->usuarios_model->delete_usuario($this->session->userdata('id'));
                        self::logout();
                }
                else
                        redirect('usuarios/login', 'refresh');
        }
                        
        public function logout(){
                $this->session->sess_destroy();
                redirect('/');
        }

        public function load_match($doador = FALSE){
                $animais = $this->animais_model->get_animais_by_usuario($this->session->userdata('id'));
                
                $output = array();
                if($doador){
                        if($animais){
                                foreach($animais as $animal){
                                                $matches = $this->avaliacao_animal_model->get_match_by_animal($animal['id_animal']);
                                                
                                        foreach($matches as $match){
                                                if($match && $animal['id_status'] != 3){
                                                        $usuarios = $this->usuarios_model->get_usuario($match['id_usuario']);
                
                                                        $output[] = array(
                                                                'id_usuario' => $usuarios['id_usuario'],
                                                                'nome' => $usuarios['nome'], 
                                                                'id_animal' => $match['id_animal'],
                                                                'animal' => $animal['nome'],
                                                                'id_doador' => $animal['id_doador']
                                                        );
                                                }
                                        }   
                                }
                        }
                }
                else{
                        $matches = $this->avaliacao_animal_model->get_match_by_usuario($this->session->userdata('id'));
                        $mensagens = $this->mensagens_model->get_mensagem_by_usuario($this->session->userdata('id'));

                        foreach($matches as $match){
                                if($match && !$mensagens){
                                        $animal = $this->animais_model->get_animais($match['id_animal']);
                                        $usuarios = $this->usuarios_model->get_usuario($animal['id_doador']);

                                        if($animal['id_status'] != 3)
                                        $output[] = array(
                                                'id_usuario' => $this->session->userdata('id'),
                                                'nome' => $usuarios['nome'], 
                                                'id_animal' => $match['id_animal'],
                                                'animal' => $animal['nome'],
                                                'id_doador' => $animal['id_doador']
                                        );
                                }
                        }
                }
                return $output;
        }

        public function load_like()
        {
                $animais = $this->animais_model->get_animais_by_usuario($this->session->userdata('id'));
                $output = array();
                foreach($animais as $animal){
                        $like = $this->avaliacao_animal_model->get_like($animal);
                        
                        if($like){
                                $usuarios = $this->usuarios_model->get_usuario($like['id_usuario']);

                                $output[] = array(
                                        'id_usuario' => $usuarios['id_usuario'],
                                        'nome' => $usuarios['nome'], 
                                        'id_animal' => $like['id_animal'],
                                        'animal' => $animal['nome']
                                );
                        }
                }
                return $output;
        }

        public function view_likes($id_animal = FALSE){
                $likes = self::load_like(0);

                
                $data['title'] = $this->lang->line('Notification_title');
                $data['animais'] = $this->animais_model->get_animais_by_usuario($this->session->userdata('id'));

                if($likes){
                        $data['likes'] = $likes;
                }
                else
                        $data['likes'] = NULL;

                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/requests', $data);
                $this->load->view('templates/footer');
        }

        public function view_matches_adotar(){
                $data['title'] = $this->lang->line('Notification_title');

                $matches = self::load_match();

                if($matches)
                        $data['matches'] = $matches;
                else
                        $data['matches'] = NULL;

                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/match_adopter', $data);
                $this->load->view('templates/footer');
        }

        public function view_matches_doar(){
                $data['title'] = $this->lang->line('Notification_title');
                $data['animais'] = $this->animais_model->get_animais_by_usuario($this->session->userdata('id'));

                $matches = self::load_match('TRUE');

                if($matches)
                        $data['matches'] = $matches;
                else
                        $data['matches'] = NULL;

                $this->load->view('templates/header', $data);
                $this->load->view('usuarios/match_donor', $data);
                $this->load->view('templates/footer');
        }

        public function perfect_match(){
                $usuario = $this->usuarios_model->get_usuario($this->session->userdata('id'));

                if($usuario['qtdmoradores'] != null){
                        sleep(1);
                        $animais = $this->usuarios_model->perfect_match();

                        $animal['id_status'] = 3;

                        while($animal['id_status'] == 3){
                                $animal = array_rand($animais, 1);
                        }

                        redirect('animais/view/'.$animais[$animal]['id_animal']); 
                }
                else
                        redirect('usuarios/application');
        }

        public function denuncia($denunciante, $denunciado, $denuncia, $animal){
                $denuncias = $this->denuncias_model->get_denuncia_by_denunciado($denunciado);
                $usuario = $this->usuarios_model->get_usuario($denunciado);
                if($denuncias && sizeof($denuncias) >= 2){
                        self::notify_ban($usuario['email']);
                        $this->usuarios_model->banir($denunciado);
                }

                $this->denuncias_model->set_denuncia($denunciante, $denunciado, $denuncia);
                $doador = $this->animais_model->get_animais($animal);
                if($doador['id_doador'] == $denunciante)
                        $this->avaliacao_animal_model->delete_avaliacao($denunciado, 'TRUE', $animal);
                else
                        $this->avaliacao_animal_model->delete_avaliacao($denunciante, 'TRUE', $animal);

                redirect('animais');
        }

        public function notify_ban($email){
                $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'smtp.sendgrid.net',
                    'smtp_user' => 'apikey',
                    'smtp_pass' => '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',
                    'charset' => 'utf-8',
                    'mailtype' => 'html',
                    'smtp_port' => 587,
                    'crlf' => "\r\n",
                    'newline' => "\r\n"
                );

                $this->load->library('email', $config);
                
                $to = $email;
                $subject = $this->lang->line('Suspended_account');
                $message = '<h2>'.$this->lang->line('Suspended_account').'</h2><p">'.$this->lang->line('Sa_message').'</p>';

                $this->email->set_newline("\r\n");
                $this->email->from('grupo6pds@gmail.com', 'PETINDER');
                $this->email->to($to);
                $this->email->subject($subject);
                $this->email->message($message);

                $this->email->send();
        }

        public function verify_notifications(){
                if($this->session->userdata('logged')){
                        $likes = self::load_like();
                        $match_donor = self::load_match($this->session->userdata('id'));
                        $match_adopter = self::load_match();

                        if($match_donor){
                                foreach($match_donor as $match){
                                        $animal = $this->animais_model->get_animais($match['id_animal']);
                                        $mensagens  = $this->mensagens_model->get_mensagem($match['id_usuario'], $animal, $match['id_doador']);
                                        $result = 'FALSE';
                                        if(!$mensagens){
                                                $result = 'TRUE';
                                        }
                                }
                                if($result == 'TRUE')
                                        echo 'TRUE';
                        }
                        elseif($match_adopter){
                                foreach($match_adopter as $match){
                                        $animal = $this->animais_model->get_animais($match['id_animal']);
                                        $mensagens  = $this->mensagens_model->get_mensagem($match['id_usuario'], $animal, $match['id_doador']);
                                        $result = 'FALSE';
                                        if(!$mensagens){
                                                $result = 'TRUE';
                                        }
                                }
                                if($result == 'TRUE')
                                        echo 'TRUE';
                        }
                        elseif($likes)
                                echo 'TRUE';
                }
        }

}

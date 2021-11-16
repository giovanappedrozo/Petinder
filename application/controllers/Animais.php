<?php
class Animais extends CI_Controller {
        public function __construct()
        {
                parent::__construct();
                $this->load->model('usuarios_model');
                $this->load->model('animais_model');
                $this->load->model('generos_model');
                $this->load->model('especies_model');
                $this->load->model('racas_model');
                $this->load->model('portes_model');
                $this->load->model('pelagens_model');
                $this->load->model('avaliacao_animal_model');
                $this->load->model('temperamentos_model');
                $this->load->model('status_model');
                $this->load->helper('url', 'form');
                $this->load->library('form_validation');
                
        }

        public function index()
        { 
                $animais = self::filter();

                $lang = $this->session->get_userdata('site_lang');
                $lang = $lang['site_lang'];
                if($lang == 'portuguese') $data['lang'] = 'pt_br';
                else $data['lang'] = 'en_us';

                if($animais === FALSE){
                        if($this->session->userdata("logged")){
                                $data['animais'] = array($this->animais_model->distance());

                                if($this->session->flashdata("danger")){
                                        $data['animais'] = array($this->animais_model->get_animais());
                                }
                                else
                                        $this->session->set_flashdata("success", $this->lang->line("LocationOn")."<a href='".site_url('usuarios/register')."'></a>");
                        }
                        else{
                                $data['animais'] = array($this->animais_model->get_animais());
                        }
                }
                else{
                        if($animais != 0)
                                $data['animais'] = $animais;
                        else
                                $data['animais'] = null;
                }

                $dislikes = $this->avaliacao_animal_model->get_avaliacao_by_usuario($this->session->userdata('id'), 'FALSE');

                $data['animais'] = self::delete_dislike($data['animais'], $dislikes);


                $data['title'] = $this->lang->line('Title_animal');
                $data['generos'] = $this->generos_model->get_genero();
                $data['especies'] = $this->especies_model->get_especie();
                $data['racas'] = $this->racas_model->get_raca();
                $data['portes'] = $this->portes_model->get_porte();
                $data['pelagens'] = $this->pelagens_model->get_pelagem();
                $data['temperamentos'] = $this->temperamentos_model->get_temperamento();

                $this->load->view('templates/header', $data);
                $this->load->view('animais/index', $data);
                $this->load->view('templates/footer');
        }

        public function select_racas(){
                if($this->input->post('especie')){
                        $racas = $this->racas_model->get_raca($this->input->post('especie'));

                        $output = array(array('id_raca' => '', 'raca' => $this->lang->line('Breed')));
                        if($this->session->userdata('site_lang') == 'portuguese') $lang = 'pt_br';
                        else $lang = 'en_us';

                        if($racas){
                                foreach($racas as $raca){
                                        $output[] = array(
                                        'id_raca'  => $raca['id_raca'],
                                        'raca' => $raca[$lang]
                                        );
                                }
                                echo json_encode($output);
                        }
                }
        }

        public function delete_dislike($animais, $dislikes){
                foreach($dislikes as $dislike){
                        foreach($animais as $a){
                                foreach($a as $chave => $animal){
                                                if($animal['id_animal'] == $dislike['id_animal'])
                                                        unset($animais[0][$chave]);
                                        }
                                }
                        }
                return $animais;

        }
        
        public function view($id_animal = NULL)
        {
                $lang = $this->session->get_userdata('site_lang');
                $lang = $lang['site_lang'];
                if($lang == 'portuguese') $data['lang'] = 'pt_br';
                else $data['lang'] = 'en_us';

                $data['dislikes'] = $this->avaliacao_animal_model->get_avaliacao_by_usuario($this->session->userdata('id'), 'FALSE', $id_animal);
                $data['likes'] = $this->avaliacao_animal_model->get_avaliacao_by_usuario($this->session->userdata('id'), 'TRUE', $id_animal);

                $data['animal'] = $this->animais_model->get_animais($id_animal);
                $data['status'] = $this->status_model->get_status();
                $data['distance'] = $this->animais_model->distance($id_animal);
                $data['generos'] = $this->generos_model->get_genero();
                $data['especies'] = $this->especies_model->get_especie();
                $data['racas'] = $this->racas_model->get_raca();
                $data['portes'] = $this->portes_model->get_porte();
                $data['pelagens'] = $this->pelagens_model->get_pelagem();
                $data['temperamentos'] = $this->temperamentos_model->get_temperamento();
                $data['queue'] = self::queue($id_animal);


                if (empty($data['animal']))
                {
                        show_404();
                }

                $data['title'] = $data['animal']['nome'];

                $this->load->view('templates/header', $data);
                $this->load->view('animais/view', $data);
                $this->load->view('templates/footer');
        }

        public function register()
        {
                $lang = $this->session->get_userdata('site_lang');
                $lang = $lang['site_lang'];
                if($lang == 'portuguese') $data['lang'] = 'pt_br';
                else $data['lang'] = 'en_us';
                
                $data['title'] = $this->lang->line('Title_pet_register');
                $data['generos'] = $this->generos_model->get_genero();
                $data['especies'] = $this->especies_model->get_especie();
                $data['racas'] = $this->racas_model->get_raca();
                $data['portes'] = $this->portes_model->get_porte();
                $data['pelagens'] = $this->pelagens_model->get_pelagem();
                $data['temperamentos'] = $this->temperamentos_model->get_temperamento();

                $config['upload_path'] = './assets/fotos';
                $config['allowed_types'] = 'jpeg|jpg|png|gif';
                $config['file_name'] = md5(uniqid(time()));

                $this->load->library('upload', $config);

                $this->form_validation->set_rules('nome', 'nome', 'required');

                if (($this->form_validation->run() === FALSE) || (!$this->upload->do_upload('profile_pic')))
                {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        $this->load->view('templates/header', $data);
                        $this->load->view('animais/register', $data);
                        $this->load->view('templates/footer');

                }
                else
                {
                        $usuario = $this->usuarios_model->get_usuario($this->session->userdata('id'));
                        if($usuario['localizacao']){
                                $data = array('image_metadata' => $this->upload->data());
                                $this->animais_model->set_animais();

                                $session = array(
                                        'doador' => true
                                        );
                                        $this->session->set_userdata($session);

                                redirect('animais', 'refresh');
                        }
                        else{
                                $this->session->set_flashdata("danger", $this->lang->line("Need_location"));
                                redirect('usuarios/'.$this->session->userdata('id'));
                        }
                }
        }

        public function review(){
                if($this->session->userdata('logged')){
                        $usuario = $this->usuarios_model->get_usuario($this->session->userdata('id'));

                        if($this->input->post('avaliacao') == 'FALSE'){
                                $dislikes = $this->avaliacao_animal_model->get_avaliacao_by_usuario($this->session->userdata('id'), 'FALSE', $this->input->post('id_animal'));

                                if($this->input->post('avaliacao') == 'FALSE' && $dislikes)
                                        $this->avaliacao_animal_model->delete_avaliacao($this->session->userdata('id'), "FALSE", $this->input->post('id_animal'));
                                else
                                        $this->avaliacao_animal_model->set_avaliacao();
                                
                                redirect('animais/view/'.$this->input->post('id_animal'));

                        }
                        else{   
                                if($usuario['qtdmoradores'] != NULL){
                                        $likes = $this->avaliacao_animal_model->get_avaliacao_by_usuario($this->session->userdata('id'), 'TRUE', $this->input->post('id_animal'));

                                        if($this->input->post('avaliacao') == 'TRUE' && $likes)
                                                $this->avaliacao_animal_model->delete_avaliacao($this->session->userdata('id'), "TRUE", $this->input->post('id_animal'));
                                        else
                                                $this->avaliacao_animal_model->set_avaliacao();

                                        redirect('animais/view/'.$this->input->post('id_animal'));
                                }
                                else
                                        redirect('usuarios/application');
                        }
                }
                else
                        redirect('usuarios/login', 'refresh');
        }

        public function delete($id_animal){
                $animal = $this->animais_model->get_animais($id_animal);
                if($this->session->userdata('id') == $animal['id_doador']){
                        $this->animais_model->delete_animal($id_animal);
                        $this->usuarios_model->verify_animals();

                        redirect('usuarios/my_animals', 'refresh');
                }
                else
                        redirect('usuarios/login', 'refresh');
                
        }
        
        public function edit($id_animal){
                $lang = $this->session->get_userdata('site_lang');
                $lang = $lang['site_lang'];
                if($lang == 'portuguese') $data['lang'] = 'pt_br';
                else $data['lang'] = 'en_us';
                
                $data['animal'] = $this->animais_model->get_animais($id_animal);
                $data['title'] = $this->lang->line('Title_pet_edit');
                $data['generos'] = $this->generos_model->get_genero();
                $data['especies'] = $this->especies_model->get_especie();
                $data['racas'] = $this->racas_model->get_raca();
                $data['portes'] = $this->portes_model->get_porte();
                $data['pelagens'] = $this->pelagens_model->get_pelagem();
                $data['temperamentos'] = $this->temperamentos_model->get_temperamento();

                $this->form_validation->set_rules('nome', 'nome', 'required');

                if ($this->form_validation->run() === FALSE)
                {
                        $this->load->view('templates/header', $data);
                        $this->load->view('animais/edit', $data);
                        $this->load->view('templates/footer');

                }
                else
                {
                        $this->animais_model->update_animal($id_animal);
                        redirect('usuarios/my_animals', 'refresh');
                }
        }

        public function filter(){
                if($this->input->post()){
                        if($this->input->post('nome')){
                                $animais = $this->animais_model->get_animal_by_nome($this->input->post('nome'));

                                if($animais) return array($animais);
                                else return 0;
                        }
                        else{
                                $result = $this->animais_model->filter();
                                if($result)
                                         return array($result);
                                else
                                        return NULL;
                        }
                }
                else
                        return FALSE;         
        }

        public function adopted($id_animal, $id_usuario, $answer){
                $this->avaliacao_animal_model->adopted($id_animal, $id_usuario, $answer);
                redirect('animais');
        }

        public function back_to_adoption($id_animal){
                $animal = $this->animais_model->get_animais($id_animal);

                if($animal['id_adotante'] == $this->session->userdata('id')){
                        $this->animais_model->reset_animal($animal);
                        redirect('usuarios/my_animals');
                }
                else
                        redirect('usuarios/login');
        }

        public function queue($id_animal){
                $avaliacoes = $this->avaliacao_animal_model->get_avaliacao_by_animal($id_animal);
                
                return sizeof($avaliacoes)-1;
        }
}

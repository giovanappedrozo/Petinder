<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TesteUnitario extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model('especies_model');
        $this->load->model('generos_model');
        $this->load->model('horas_sozinho_model');
        $this->load->model('mensagens_model');
        $this->load->model('moradias_model');
        $this->load->model('motivos_denuncia_model');
        $this->load->model('outros_animais_model');
        $this->load->model('pelagens_model');
        $this->load->model('portes_model');
        $this->load->model('racas_model');
        $this->load->model('status_model');
        $this->load->model('temperamentos_model');
        $this->load->model('usuarios_model');
        $this->load->model('animais_model');
        $this->load->model('avaliacao_animal_model');
        $this->load->model('denuncias_model');
    }

    public function especie(){
        echo "Using Unit Test";
        $test = $this->especies_model->get_especie(1);
        $expected_result = array(array('id_especies'=>1, 'pt_br'=>'Cachorro','en_us'=>'Dog'));
        $test_name = "Especies funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function genero(){
        echo "Using Unit Test";
        $test = $this->generos_model->get_genero(1);
        $expected_result = array('id_genero'=>1, 'pt_br'=>'Masculino','en_us'=>'Male');
        $test_name = "Genero funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function horassozinho(){
        echo "Using Unit Test";
        $test = $this->horas_sozinho_model->get_horas(1);
        $expected_result = array('id_horassozinho'=>1, 'pt_br'=> 'Nem uma hora', 
        'en_us'=> 'Not even an hour');
        $test_name = "Horas_Sozinho funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 
        
    public function mudar_status_msg(){
        echo "Using Unit Test";
        $test = $this->mensagens_model->change_status(2);
        $expected_result = 1;
        $test_name = "Mudar status da mensagem funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function moradia(){
        echo "Using Unit Test";
        $test = $this->moradias_model->get_moradias(1);
        $expected_result = array('id_moradia'=>1, 'pt_br'=> 'Casa', 'en_us'=> 'House');
        $test_name = "Moradia funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function motivos_denuncia(){
        echo "Using Unit Test";
        $test = $this->motivos_denuncia_model->get_motivo(1);
        $expected_result = array('id_motivo'=>1, 'pt_br'=> 'Roubo de dados e informações', 
        'en_us'=> 'Data and information theft');
        $test_name = "motivos denuncia funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 
    
    public function outros_animais(){
        echo "Using Unit Test";
        $test = $this->outros_animais_model->get_outros(1);
        $expected_result = array('id_outrosanimais'=>1, 
        'pt_br'=> 'Sim. Em minha casa não vive nenhum outro animal.', 
        'en_us'=> 'Yes. No other animal lives in my house.');
        $test_name = "Outros animais funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function pelagem(){
        echo "Using Unit Test";
        $test = $this->pelagens_model->get_pelagem(1);
        $expected_result = array('id_pelagem'=>1, 'pt_br'=> 'Curta', 'en_us'=> 'Short');
        $test_name = "Pelagem funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function porte(){
        echo "Using Unit Test";
        $test = $this->portes_model->get_porte(1);
        $expected_result = array('id_porte'=>1, 'pt_br'=> 'Miniatura', 
        'en_us'=> 'Miniature');
        $test_name = "Porte funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function status_animal(){
        echo "Using Unit Test";
        $test = $this->status_model->get_status(1);
        $expected_result = array(array('id_status'=>1, 'pt_br'=> 'Disponível', 
        'en_us'=> 'Available'));
        $test_name = "Status Animal funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function temperamento(){
        echo "Using Unit Test";
        $test = $this->temperamentos_model->get_temperamento(1);
        $expected_result = array('id_temperamento'=>1, 'pt_br'=> 'Medroso', 
        'en_us'=> 'Fearful');

        $test_name = "Temperamento funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function login(){
        echo "Using Unit Test";
        $test = $this->usuarios_model->validate('rod@teste.com', '123456');

        $expected_result = array('id_usuario' => 2, 'nome' => 'Rodrigo', 
        'email' => 'rod@teste.com', 
        'senha' => '$2y$10$bkE8qltt7O9/91GGoUCfUOume9TpG9jTRJQFVVQdPc9CqnOyxRMgi', 
        'id_genero' => 1, 'datanasci' => '1996-11-01', 
        'localizacao' => '(-23.5700224,-46.4683008)', 'criancas' => null, 
        'acessoprotegido' => null, 'gastos' => 1, 'alergia' => 1, 'qtdmoradores' => 3, 
        'id_moradia' => 2, 'id_horassozinho' => 2, 'id_outrosanimais' => 2, 
        'disponivel' => 1);

        $test_name = "Login funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function match(){
        echo "Using Unit Test";
        $test = $this->usuarios_model->perfect_match(2);
        $expected_result = 1;
        $test_name = "Match funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    }

    public function distance(){
        echo "Using Unit Test";
        $test = $this->animais_model->distance();
        $expected_result = array(array( 'id_animal' => 1, 
        'imagem' => 'bdd5e8243cd10bf6d9e7c3c40403aac9.png', 'nome' => 'Fofo', 
        'id_genero' => 1, 'datanasci' => '2018-10-11', 'id_raca' => 1, 'id_porte' => 3, 
        'castrado' => null, 'especial' => null, 'infoadicional' => null, 'id_status' => 2, 
        'id_pelagem' => 1, 'id_temperamento' => 5, 'id_doador' => 1, 'id_adotante' => null));
        $test_name = "Animais proximos funcional";

        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function delete_animal(){
        echo "Using Unit Test";
        $test = $this->animais_model->delete_animal(1);
        $expected_result = 1;
        $test_name = "Deletar animal funcional";
        echo $test;
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function set_match(){
        echo "Using Unit Test";
        $test = $this->avaliacao_animal_model->set_match(2,2);
        $expected_result = 1;
        $test_name = "Avaliacao funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    } 

    public function denuncia(){
        echo "Using Unit Test";
        $test = $this->denuncias_model->set_denuncia(1,2,5);
        $expected_result = 1;
        $test_name = "Denuncia funcional";
        echo $this->unit->run($test,$expected_result,$test_name);
    }
}
<?php
class Animais_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();
        }

        public function get_count() {
            return $this->db->count_all('animal');
        }

        public function get_animais($id_animal = FALSE)
        {
            if ($id_animal === FALSE)
            {
                $query = $this->db->get('animal');
                return $query->result_array();
            }
    
            $query = $this->db->get_where('animal', array('id_animal' => $id_animal));
            return $query->row_array();
        }

        public function get_animais_by_usuario($id_usuario = FALSE)
        {
            if ($id_usuario === FALSE)
            {
                $query = $this->db->get('animal');
                return $query->result_array();
            }
    
            $query = $this->db->get_where('animal', array('id_doador' => $id_usuario));
            return $query->result_array();
        }

        public function get_animais_by_adotante($id_usuario = FALSE)
        {
            if ($id_usuario === FALSE)
            {
                $query = $this->db->get('animal');
                return $query->result_array();
            }
    
            $query = $this->db->get_where('animal', array('id_adotante' => $id_usuario));
            return $query->result_array();
        }
        
        public function set_animais()
        {
            $this->load->helper('url');
 
            $cast = $this->input->post('castrado');
            $img = $this->upload->data();
            $img = $img['file_name'];

            if($cast == 'castrado') $cast = TRUE;
            else $cast = FALSE;

            $status = 1;

            $nome = $this->input->post('nome');
            $nome = ucfirst(strtolower($nome));

            $data = array(
                'imagem' => $img,
                'nome' => $nome,
                'id_genero' => $this->input->post('genero'),
                'datanasci' => $this->input->post('data'),
                'id_raca' => $this->input->post('raca'),
                'id_porte' => $this->input->post('porte'),
                'id_pelagem' => $this->input->post('pelagem'),
                'especial' => $this->input->post('especial'),
                'id_temperamento' => $this->input->post('temperamento'),
                'infoadicional' => $this->input->post('info'),
                'castrado' => $cast,
                'id_status' => $status,
                'id_doador' => $this->input->post('doador')
            );

            return $this->db->insert('animal', $data);
        } 

        public function distance($id_animal = FALSE){
            $this->load->model('usuarios_model');

            $id_usuario = $this->session->userdata("id");
            $usuario = $this->usuarios_model->get_usuario($id_usuario);
    
            if(isset($usuario['localizacao'])) $localizacao = $usuario['localizacao'];
            else $localizacao = NULL;

            if ($id_animal === FALSE){

                if($localizacao){   
                    $this->db
                    ->select("id_usuario, nome, ST_Distance(localizacao::geometry, POINT('".$localizacao."')::geometry) AS dist")
                    ->order_by('dist', 'ASC')
                    ->where("ST_Distance(localizacao::geometry, POINT('".$localizacao."')::geometry) < 1");
            
                    $query = $this->db->get('usuario');
            
                    $array = [];
            
                    foreach($query->result_array() as $usuario){
                        $this->db
                        ->where("id_doador =".$usuario['id_usuario']);
                        $result = $this->db->get('animal');
                        $result = $result->result_array();
            
                        foreach($result as $r){
                            if($r != 0)
                                array_push($array, $r);
                        }
                    }
                    return $array;
                }

                else
                    return $this->session->set_flashdata("danger", $this->lang->line("LocationNull")."<a href='".site_url('usuarios/register')."'></a>");
            }

            if($localizacao){
                $this->db
                ->select("id_doador")
                ->where('id_animal', $id_animal);

                $query = $this->db->get('animal');

                $id_doador = $query->row_array();

                $this->db
                ->select("ST_Distance(localizacao::geometry, POINT('".$localizacao."')::geometry) AS dist")
                ->where('id_usuario='.$id_doador['id_doador']);

                $query = $this->db->get('usuario');

                return $query->row_array();
            }
        }

        public function delete_animal($id_animal = FALSE){
            if ($id_animal != FALSE){
                return $query = $this->db
                ->where('id_animal', $id_animal)
                ->delete('animal');
            }
        }

        public function update_animal($id_animal)
        {
            $cast = $this->input->post('castrado');

            if($cast == 'castrado') $cast = TRUE;
            else $cast = FALSE;

            $nome = $this->input->post('nome');
            $nome = ucfirst(strtolower($nome));

            $especial = $this->input->post('especial');
            if(!$especial) $especial = TRUE;

            $data = array(
                'nome' => $nome,
                'id_porte' => $this->input->post('porte'),
                'id_pelagem' => $this->input->post('pelagem'),
                'especial' => $especial,
                'id_temperamento' => $this->input->post('temperamento'),
                'infoadicional' => $this->input->post('info'),
                'castrado' => $cast
            );

            return $this->db->update('animal',$data,array('id_animal' => $id_animal));        
        } 

        public function get_animal_by_nome($nome){
            $nome = $this->input->post('nome');
            $nome = ucfirst(strtolower($nome));
            
            $query = $this->db->like('nome', $nome, 'both');
            return $query->get('animal')->result_array();
        }

        public function reset_animal($animal)
        {
            $data = array(
                'imagem' => $animal['imagem'],
                'nome' => $animal['nome'],
                'id_genero' => $animal['id_genero'],
                'datanasci' => $animal['datanasci'],
                'id_raca' => $animal['id_raca'],
                'id_porte' => $animal['id_porte'],
                'id_pelagem' => $animal['id_pelagem'],
                'especial' => $animal['especial'],
                'id_temperamento' => $animal['id_temperamento'],
                'infoadicional' => $animal['infoadicional'],
                'castrado' => $animal['castrado'],
                'id_status' => 1,
                'id_doador' => $this->session->userdata('id')
            );

            return $this->db->insert('animal', $data);
        } 

        public function filter(){
            if($this->input->post('genero')) $genero = "AND id_genero = ".$this->input->post('genero'); else $genero = "";
                
            if($this->input->post('raca')) $raca = "AND id_raca = ".$this->input->post('raca'); else $raca = "";

            if($this->input->post('porte')) $porte = "AND id_porte = ".$this->input->post('porte'); else $porte = "";

            if($this->input->post('pelagem')) $pelagem = "AND id_pelagem = ".$this->input->post('pelagem'); else $pelagem = "";

            if($this->input->post('especie')){
                if($this->input->post('especie') == 1)
                    $especie = "AND id_raca < 51";
                else
                    $especie = "AND id_raca > 50";
            }  
            else $especie = "";

            if($this->input->post('castrado')) $castrado = "AND castrado = ".$this->input->post('castrado'); else $castrado = "";

            $query = $this->db
            ->select("*")
            ->where("id_animal != '0'".$genero.$raca.$porte.$pelagem.$castrado.$especie)
            ->get('animal');

            return $query->result_array();
        }
}

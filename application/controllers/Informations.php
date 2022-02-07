<?php
class Informations extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }

    public function about(){
        $data['title'] = "PETINDER";
        $this->load->view('templates/header', $data);
        $this->load->view('info/about');
        $this->load->view('templates/footer');
    }

    public function adoption(){
        $data['title'] = $this->lang->line('About_adoption');
        $this->load->view('templates/header', $data);
        $this->load->view('info/adoption');
        $this->load->view('templates/footer');
    }

    public function how_to(){
        $data['title'] = $this->lang->line('How_to');
        $this->load->view('templates/header', $data);
        $this->load->view('info/how_to');
        $this->load->view('templates/footer');
    }

    public function match(){
        $data['title'] = $this->lang->line('How_to');
        $this->load->view('templates/header', $data);
        $this->load->view('info/match');
        $this->load->view('templates/footer');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('database_model');
        $this->load->helper('url_helper');
    }

    public function add_school()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Kooli lisamine';

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'E-Mail', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('add/add_school');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_school();

            $data['message'] = 'Kooli lisamine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function add_class($school_id = NULL)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Klassi lisamine';
        $data['schools'] = $this->database_model->get_schools();
        $data['default_school'] = $school_id;

        $schools = array();
        foreach ($data['schools'] as $school) {
            $schools[$school['id']] = $school['name'];
        }
        $data['schools'] = $schools;

        $this->form_validation->set_rules('school_id', 'School Name', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('add/add_class', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_class();

            $data['message'] = 'Klassi lisamine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }
}
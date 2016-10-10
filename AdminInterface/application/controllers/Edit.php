<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('database_model');
        $this->load->helper('url_helper');
    }

    public function edit_school($id) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Kooli muutmine';
        $data['id'] = $id;
        $data['current_value'] = $this->database_model->get_school_name($id);

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('edit/edit_school', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_school($id);

            $data['message'] = 'Kooli muutmine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function edit_class($id) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Klassi muutmine';
        $data['schools'] = $this->database_model->get_schools();
        $class = $this->database_model->get_class_by_id($id);
        $data['current_name'] = $class['name'];
        $data['current_school'] = $class['school_id'];
        $data['id'] = $id;

        $schools = array();
        foreach ($data['schools'] as $school) {
            $schools[$school['id']] = $school['name'];
        }
        $data['schools'] = $schools;

        $this->form_validation->set_rules('school_id', 'School Name', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('edit/edit_class');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_class($id);

            $data['message'] = 'Klassi muutmine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function edit_book($id) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Raamatu muutmine';
        $book = $this->database_model->get_book_by_id($id);
        $data['current_title'] = $book['title'];
        $data['current_author'] = $book['author'];
        $data['current_year'] = $book['year'];
        $data['id'] = $id;

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('year', 'Year', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('edit/edit_book');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_book($id);

            $data['message'] = 'Raamatu muutmine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }
}